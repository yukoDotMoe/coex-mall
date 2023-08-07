<?php

namespace App\Http\Controllers;

use App\Models\LuckyNumber;
use App\Models\User;
use App\Models\UserBet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Log;

class LuckyNumberController extends Controller
{
    public function view()
    {
        return view('lucky');
    }

    // pre-config side:
    // 1. like: 5 6 7 8 9
    // 2. vote: 0 1 2 3 4
    // 3. 5 sao: 0 2 4 6 8
    // 4. 3 sao: 1 3 5 7 9

    // Ô đầu: > 5 = Like | < 4 = vote
    // Ô cuối: 0, 2, 4 ,6 ,8 = 5 sao | 1, 3, 5, 7, 9 = 3 sao

    protected function getBetType()
    {
        return array('like', 'vote', '5sao', '3sao');
    }

    protected function sideNameToNumber($side): int
    {
        $result = 0;
        switch ($side)
        {
            case 'like':
                $result = 1;
                break;
            case 'vote':
                $result = 2;
                break;
            case '5sao':
                $result = 3;
                break;
            case '3sao':
                $result = 4;
                break;
        }

        return $result;
    }

    public function doBet(Request $request)
    {
        try {
            $request->validate([
                'sideChoosed' => 'required|string',
                'amount' => 'required|numeric',
            ]);

            $side = $request->sideChoosed;
            $amount = $request->amount;
            $currentGame = LuckyNumber::where('game_id','<',Carbon::now()->format('YmdHis'))->orderBy('id', 'desc')->first()->id;
            $game_id = LuckyNumber::where('id', $currentGame+1)->first()->game_id;

            if ($amount > Auth::user()->balance()) return ApiController::response(404, [], 'Số dư không đủ.');

            if (!preg_match('('.implode('|',$this->getBetType()).')', $side)) return ApiController::response(501, [], 'Request không hợp lệ.');

            DB::beginTransaction();
            $betQuery = new UserBet();
            $betQuery->game_id = $game_id;
            $betQuery->user_id = Auth::user()->id;
            $betQuery->thao_tac = $this->sideNameToNumber($side);
            $betQuery->so_luong = $amount;
            $betQuery->trang_thai = 0;
            $betQuery->save();
            DB::commit();

            $wallet = Auth::user()->getWallet();
            $wallet->changeMoney($amount, 'Đánh giá');

            return ApiController::response(200, [], 'Đánh giá thành công');
        } catch (\Exception $e)
        {
            DB::rollback();
            Log::error($e);
            return ApiController::response(502, [], 'Hệ thống đang gặp sự cố, vui lòng thử lại sau');
        }
    }
}
