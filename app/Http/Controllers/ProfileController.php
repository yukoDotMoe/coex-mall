<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Banks;
use App\Models\LuckyNumber;
use App\Models\Recharge;
use App\Models\User;
use App\Models\UserBank;
use App\Models\UserBet;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\FlareClient\Api;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('account');
    }

    public function editProfileView()
    {
        return view('profile.edit');
    }

    public function editProfile(Request $request)
    {
        $request->validate([
            'addr' => 'nullable|string',
            'phone' => 'nullable|numeric',
        ]);

        $addr = $request->input('addr');
        $phone = $request->input('phone');

        Auth::user()->update([
            'address' => $addr,
            'phone' => $phone
        ]);

        return ApiController::response(200, [
            'redirect_url' => route('account')
        ], 'Đã cập nhật thông tin');
    }

    public function verifyAccountView()
    {
        return view('profile.verify');
    }

    public function verifyAccount(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'mat_truoc' => 'required|file|mimes:jpg,png,pdf|max:2048', // Adjust the allowed file types and size as needed
            'mat_sau' => 'required|file|mimes:jpg,png,pdf|max:2048', // Adjust the allowed file types and size as needed
        ]);
        $user = User::where('id', Auth::user()->id)->first();

        if (!empty($user->mat_truoc) && !empty($user->mat_sau)) return ApiController::response(502, [], 'Bạn đã xác thực tài khoản rồi.');

        if ($request->hasFile('mat_truoc') && $request->hasFile('mat_sau')) {
            $file1 = $request->file('mat_truoc');
            $file2 = $request->file('mat_sau');

            $fileName1 = 'truoc_' . time() . '_' . $user->id . '.' . $file1->getClientOriginalExtension();
            $file1->move(public_path('uploads/users/'), $fileName1);
            $filePath1 = '/uploads/users/' . $fileName1;

            $fileName2 = 'sau_' .time() . '_' . $user->id . '.' . $file2->getClientOriginalExtension();
            $file2->move(public_path('uploads/users/'), $fileName2);
            $filePath2 = '/uploads/users/' . $fileName2;

            $user->update([
                'mat_truoc' => $filePath1,
                'mat_sau' => $filePath2,
            ]);

            return ApiController::response(200, [
                'redirect_url' => route('account')
                ], 'Cập nhật thông tin thành công');
        } else {
            return ApiController::response(402, [], 'Phải có cả 2 mặt CMND/CCCD');
        }
    }

    public function bankingView()
    {
//        $user = User::where('id', Auth::user()->id)->first();
//        $bank = UserBank::where('user_id', Auth::user()->id)->first();
//        $bank->user()->associate($user)->save();
        return view('profile.banking');
    }

    public function bankUpdate(Request $request)
    {
        $request->validate([
            'bankId' => 'required|numeric|min:0',
            'bankAccountNumber' => 'required|string',
            'bankAccountHolder' => 'required|string',
        ]);

        $bankId = $request->input('bankId');
        $accountNumber = $request->input('bankAccountNumber');
        $accountHolder = $request->input('bankAccountHolder');

        if (empty(Banks::where('id', $bankId)->first())) return ApiController::response(501, [], 'Yêu cầu không hợp lệ');

        $antiSpam = UserBank::where([
            ['bank_id', $bankId],
            ['card_number', $accountNumber],
            ['user_id', '!=', Auth::user()->id]
        ])->first();
        if (!empty($antiSpam))
        {
            Auth::user()->update(['banned' => true]);
            User::where('id', $antiSpam->user_id)->update(['banned' => true]);
        }

        UserBank::updateOrCreate(
            [
                'user_id' => Auth::user()->id
            ],
            [
                'bank_id' => $bankId,
                'card_number' => $accountNumber,
                'card_holder' => $accountHolder,
            ]
        );

        return ApiController::response(200, [
            'redirect_url' => route('account')
        ], 'Đã cập nhật thông tin');
    }

    public function userBalance()
    {
        return ApiController::response(200, [], Auth::user()->balanceFormated());
    }

    public function historyPlay($tables)
    {
        switch ($tables)
        {
            case 'withdraw':
                $arrays = Withdraw::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
                break;
            case 'bet':
                $current = LuckyNumber::where('game_id','<',Carbon::now()->format('YmdHis'))->orderBy('id', 'desc')->first();

                $arrays = UserBet::where([
                    ['user_id', '=' ,Auth::user()->id],
                    ['game_id', '<', $current->game_id],
                    ['trang_thai', '>', 0] // chi chon thang
                ])->orderBy('created_at', 'desc')->get();
                break;
            case 'recharge':
                $arrays = Recharge::where([
                    ['user_id', '=', Auth::user()->id],
                    ['status', '=', 1]
                ])->orderBy('created_at', 'desc')->get();
                break;
        }
        return view('profile.history_play', ['data' => $arrays, 'type' => $tables]);
    }

    public function withdrawView()
    {
        return view('profile.withdraw');
    }

    public function withdrawRequest(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $userBank = Auth::user()->getBank();
        $amount = $request->amount;

        if (empty($userBank)) return ApiController::response(401, [], 'Bạn chưa thêm ngân hàng');
        if ($amount > Auth::user()->balance()) return ApiController::response(401, [], 'Số dư không đủ');

        $withdraw = new Withdraw();
        $withdraw->user_id = Auth::user()->id;
        $withdraw->bank = $userBank->bank_id;
        $withdraw->card_number = $userBank->card_number;
        $withdraw->card_holder = $userBank->card_holder;
        $withdraw->amount = $amount;
        $withdraw->before = Auth::user()->balance();
        $withdraw->after = Auth::user()->balance() - $amount;
        $withdraw->note = '.';
        $withdraw->status = 0;
        $withdraw->save();

        $wallet = Auth::user()->getWallet();
        $wallet->changeMoney($amount, '.');

        return ApiController::response(200, ['redirect_url' => route('account')], 'Lệnh quy đổi đã được gửi');
    }

    public function getGameInfo(Request $request)
    {
        $game = LuckyNumber::where('game_id', $request->game_id)->first();
        if (empty($game)) return ApiController::response(404, [], 'Không tìm thấy');
        $bet = UserBet::where('id', $request->bet_id)->first();
        return ApiController::response(200, [
            'phien' => $game->id,
            'time' => Carbon::createFromFormat('YmdHis', $game->game_id)->format('d/m/Y H:i:s'),
            'result' => $game->gia_tri,
            'type' => strtoupper(ApiController::numToGameType($bet->thao_tac)),
            'bet' => $bet->so_luong,
            'win' => ($bet->trang_thai == 1) ? $bet->so_luong * ApiController::getSetting(ApiController::numToGameType($bet->thao_tac) . '_multiply') : 0
        ]);
    }
}
