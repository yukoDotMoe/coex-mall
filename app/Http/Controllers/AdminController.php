<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\LuckyNumber;
use App\Models\Recharge;
use App\Models\Settings;
use App\Models\User;
use App\Models\UserBank;
use App\Models\UserBet;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use DB;

class AdminController extends Controller
{
    public function loginView()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors(['login_error' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.auth.dashboard');
    }

    public function settingsView()
    {
        return view('admin.auth.settings');
    }
    public function luckyGameView()
    {
        $current = LuckyNumber::where('game_id','<',Carbon::now()->format('YmdHis'))->orderBy('id', 'desc')->first();
        $nextGame = LuckyNumber::where('id', $current->id + 1)->first();
        $list = LuckyNumber::whereBetween('id', [$current->id+1, $current->id + 10])->get();
        return view('admin.auth.lucky_game', ['data' => $list, 'current' => $current, 'next' => $nextGame]);
    }

    public function luckyUpdate(Request $request)
    {
        $row = LuckyNumber::where('id', $request->id)->first();
        if (empty($row)) return ApiController::response(404, [], 'Không tìm thấy game');
        if (Carbon::now()->format('YmdHis') >= $row->game_id) return ApiController::response(401, [], 'Game đã sổ rồi');
        $row->update(['gia_tri' => $request->gia_tri]);
        return ApiController::response(200, [], 'Thành công');
    }

    public function saveSettings(Request $request)
    {
        $data = $request->except('_token');
        $arrays = [];
        foreach ($data as $key => $value) {
            $arrays[$key] = $value;
            Settings::where('name', $key)->update(['value' => $value]);

        }

        return redirect()->route('admin.settings');
    }

    public function postview()
    {
        return view('admin.auth.post');
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'price' => 'required',
            'danh_muc' => 'required|numeric',
            'thumbnail' => 'required|file|mimes:jpg,png,pdf|max:2048', // Adjust the allowed file types and size as needed
            'inside_content' => 'required',
            'vote' => 'required|numeric',
            'like' => 'required|numeric',
            'limit_vote' => 'required|numeric',
            'limit_like' => 'required|numeric',
            'vote_stars' => 'required|numeric',
        ]);

        $file = $request->file('thumbnail');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/posts/'), $fileName);
        $filePath = '/uploads/posts/' . $fileName;

        $post = new BaiViet();
        $post->price = ApiController::extractNumbersFromString($request->price);
        $post->post_id = ApiController::generate_random_md5();
        $post->title = $request->title;
        $post->small_title = '..';
        $post->danh_muc = $request->danh_muc;
        $post->thumbnail = $filePath;
        $post->content = $request->inside_content;
        $post->limit_vote = $request->limit_vote;
        $post->limit_like = $request->limit_like;
        $post->vote = $request->vote;
        $post->like = $request->like;
        $post->order = $request->vote_stars;
        $post->save();

        return ApiController::response(200, ['redirect_url' => route('admin.bai_viet')], 'Thêm bài viết thành công, ID: ' . $post->id);
    }

    public function usersView()
    {
        $users = User::all();
        return view('admin.auth.users.list', ['users' => $users]);
    }

    public function liveSearch(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        if (!empty($searchTerm))
        {
            $users = User::where('username', 'like', '%' . $searchTerm . '%')
                ->orWhere('promo_code', 'like', '%' . $searchTerm . '%')
                ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                ->get();
        }else{
            $users = User::all();
        }
        return view('admin.auth.users.liveSearch', compact('users'));
    }

    public function liveSearchRecharge(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $recharges = Recharge::select(
            'recharge.user_id',
            'users.username',
            'users.promo_code',
            'recharge.amount',
            'recharge.bill',
            'recharge.created_at',
            'recharge.note'
        )
            ->join('users', 'recharge.user_id', '=', 'users.id')
            ->where('users.username', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('users.promo_code', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('recharge.user_id', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('recharge.note', 'LIKE', '%' . $searchTerm . '%')
            ->get();
        return view('admin.auth.liveRecharge', compact('recharges'));
    }
    public function liveSearchWithdraw(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $withdraws = Withdraw::select(
            'withdraw.user_id',
            'users.username',
            'users.promo_code',
            'withdraw.amount',
            'withdraw.created_at',
            'withdraw.note',
            'withdraw.status',
            'withdraw.card_number',
            'withdraw.card_holder',
            'user_bank.bank_id'
        )
            ->join('users', 'withdraw.user_id', '=', 'users.id')
            ->leftJoin('user_bank', 'withdraw.user_id', '=', 'user_bank.user_id')
            ->where('users.username', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('users.promo_code', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('withdraw.note', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('withdraw.amount', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('withdraw.card_number', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('withdraw.card_holder', 'LIKE', '%' . $searchTerm . '%')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.auth.liveWithdraw', compact('withdraws'));
    }



    public function findUser($id)
    {
        $user = User::where('id', $id)->first();
        $trans = UserBet::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $recharge = Recharge::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $withdraw = Withdraw::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('admin.auth.users.view', ['user' => $user, 'games' => $trans, 'recharge' => $recharge, 'withdraw' => $withdraw]);
    }

    public function updateBalance(Request $request)
    {
        $request->validate([
            'userid' => 'required|string',
            'balType' => 'required|numeric',
            'balAmount' => 'required|numeric',
            'balMsg' => 'nullable',
        ]);

        $user = User::where('id', $request->userid)->first();
        if (empty($user)) return ApiController::response(404, [], 'Không tìm thấy người dùng');
        // 1 = plus | 2 = minus
        $wallet = $user->getWallet();
        $oldBal = $user->balance();
        if ($request->balType == 1)
        {
            Log::info('recharge');
            $wallet->changeMoney($request->balAmount, $request->balMsg ?? 'Nạp điểm', 1);
            $recharge = new Recharge();
            $recharge->user_id = $user->id;
            $recharge->amount = $request->balAmount;
            $recharge->before = $oldBal;
            $recharge->bill = true;
            $recharge->after = $user->balance();
            $recharge->note = $request->balMsg ?? 'Nạp điểm';
            $recharge->status = 1;
            $recharge->save();
        }else{
            Log::info('withdraw');

            $wallet->changeMoney($request->balAmount, $request->balMsg ?? 'Rút điểm');
            $bank = $user->getBank();
            $withdraw = new Withdraw();
            $withdraw->user_id = $user->id;
            $withdraw->bank = $bank->bank_id ?? 1;
            $withdraw->card_number = $bank->card_number ?? rand(696969, 99999999);
            $withdraw->card_holder = $bank->card_holder ?? 'Nguyen Van D';
            $withdraw->amount = $request->balAmount;
            $withdraw->before = $oldBal;
            $withdraw->after = $user->balance();
            $withdraw->note = $request->balMsg ?? 'Rút điểm';
            $withdraw->status = 1;
            $withdraw->save();
        }

        return ApiController::response(200, ['new_balance' => $user->balanceFormated()], 'Thay đổi số dư thành công');
    }

    public function bankView()
    {

    }

    public function bankRequest(Request $request)
    {

    }

    public function rechargeView()
    {
        $recharges = Recharge::select(
            'recharge.id',
            'recharge.user_id',
            'users.username',
            'users.promo_code',
            'recharge.amount',
            'recharge.bill',
            'recharge.created_at',
            'recharge.note',
            'recharge.status'
        )
            ->join('users', 'recharge.user_id', '=', 'users.id')
            ->orderBy('created_at', 'desc')->get();
        return view('admin.auth.recharge', ['recharges' => $recharges]);
    }

    public function rechargeNormalView()
    {
        return view('admin.auth.recharge.normal');
    }

    public function rechargeAdView()
    {
        return view('admin.auth.recharge.ad');
    }

    public function rechargeRequest(Request $request)
    {
        $user = User::where('id', $request->user_id ?? $request->user_id1)->first();
        $wallet = $user->getWallet();
        $beforeBal = $user->balance();
        if ($request->type == 'normal')
        {
            $wallet->changeMoney($request->amount, $request->reason ?? '.', 1);
            $recharge = new Recharge();
            $recharge->user_id = $user->id;
            $recharge->bill = true;
            $recharge->amount = $request->amount;
            $recharge->before = $beforeBal;
            $recharge->after = $beforeBal - $request->amount;
            $recharge->note = $request->reason ?? '.';
            $recharge->status = 1;
            $recharge->save();

            return ApiController::response(200, ['redirect_url' => route('admin.recharge')], 'Nạp thành công');
        } else {
            $wallet->changeMoney($request->amount1, $request->reason ?? '.', 1);
            $recharge = new Recharge();
            $recharge->user_id = $user->id;
            $recharge->bill = false;
            $recharge->show = false;
            $recharge->amount = $request->amount1;
            $recharge->before = $beforeBal;
            $recharge->after = $beforeBal - $request->amount1;
            $recharge->note = $request->reason1 ?? '.';
            $recharge->status = 1;
            $recharge->save();

            return ApiController::response(200, ['redirect_url' => route('admin.recharge')], 'Tạo thông báo nạp thành công');
        }
    }

    public function rechargeRevoke(Request $request)
    {
        $id = $request->input('chargeId');
        $recharge = Recharge::where('id', $id)->first();
        $user = User::where('id', $recharge->user_id)->first();
        $wallet = $user->getWallet();
        $recharge->update(['status' => 2]);
        if ($recharge->amount > $user->balance()) $recharge->amount = $user->balance();
        $wallet->changeMoney($recharge->amount, 'Thu hồi lệnh nạp tiền ' . $recharge->id);
        return ApiController::response(200, [], 'Thu hồi thành công');
    }

    public function findById(Request $request)
    {
        $user = User::where('id', $request->input('idUser'))->first();
        if (empty($user)) return response('không tìm thấy người dùng');
        return response()->json([
            'user' => $user->toArray(),
            'balance' => $user->balanceFormated(),
            'bank' => $user->getBank()
        ]);
    }

    public function lockUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->banned = ($user->banned == 1) ? 0 : 1;
        $user->save();
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return ApiController::response(200, [], 'Thay đổi mật khẩu thành công');
    }

    public function updateUser(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user->promo_code = $request->promo_code;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();

        $bank = UserBank::where('user_id', $user->id)->first();
        if (!empty($bank))
        {
            $bank->bank_id = $request->bank_id;
            $bank->card_number = $request->card_number;
            $bank->card_holder = $request->card_holder;
            $bank->save();
        }

        return ApiController::response(200, [], 'Cập nhật thành công');
    }

    public function withdrawView()
    {
//        $withdraw = Withdraw::orderBy('created_at', 'desc')->paginate(10);
        $withdraw = Withdraw::select(
            'withdraw.id',
            'withdraw.user_id',
            'users.username',
            'users.promo_code',
            'withdraw.amount',
            'withdraw.created_at',
            'withdraw.note',
            'withdraw.status',
            'withdraw.card_number',
            'withdraw.card_holder',
            'user_bank.bank_id'
        )
            ->join('users', 'withdraw.user_id', '=', 'users.id')
            ->leftJoin('user_bank', 'withdraw.user_id', '=', 'user_bank.user_id')
            ->orderBy('created_at', 'desc')->get();
        return view('admin.auth.withdraw', ['withdraws' => $withdraw]);
    }

    public function updateWithdraw(Request $request)
    {
        $withdraw = Withdraw::where('id', $request->input('wid'))->first();
        if ($request->input('action') == '1')
        {
            // approve
            $withdraw->update(['status' => 1]);
        }else{
            // denied
            $withdraw->update(['status' => 2]);
            $wallet = User::where('id', $withdraw->user_id)->first()->getWallet();
            $wallet->changeMoney($withdraw->amount, 'Từ chối lệnh rút tiền ' . $withdraw->id, 1);
        }

        return ApiController::response(200, [], 'Cập nhật thành công');
    }

    public function findWithdraw(Request $request)
    {
        $result = Withdraw::where('id', $request->wid)->first();
        $user = User::where('id', $result->user_id)->first();
        $finalAmount = $result->amount * 1000;
        $bank = ApiController::getFromBankId($result->bank);
        $result['bank'] = $bank->code . ' | ' . $bank->name;
        $result->bankNote = 'TRA LUONG ' . $result->user_id . ' ' . $user->promo_code;
        $qrImg = 'https://img.vietqr.io/image/'. $bank->code .'-'. $result->card_number .'-compact.jpg?amount=' . $finalAmount . '&addInfo=TRA%LUONG%20' . $result->user_id . '%20' . $user->promo_code;
        return ApiController::response(200, [
            'data' => $result,
            'user' => $user,
            'final' => number_format($finalAmount, 0, '', ','),
            'qr' => $qrImg
        ]);
    }

    public function gameManagerView()
    {
        $list = UserBet::join('users', 'lich_su_danh_gia.user_id', '=', 'users.id')
            ->join('lich_su_danh_gia_game', 'lich_su_danh_gia.game_id', '=', 'lich_su_danh_gia_game.game_id')
            ->select(
                'lich_su_danh_gia.*',
                'users.promo_code as dai_li',
                'users.username as username',
                'lich_su_danh_gia_game.id as phien',
                'lich_su_danh_gia_game.gia_tri as ketqua_phien',
            )
            ->orderBy('created_at', 'desc')->get();
        return view('admin.auth.gameManager', ['data' => $list]);
    }

    public function gameManager(Request $request)
    {

    }
}
