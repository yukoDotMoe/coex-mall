<?php

namespace App\Http\Controllers;

use App\Models\GiftOpenHistory;
use App\Models\HopQua;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GiftController extends Controller
{
    protected function getRandomElementWithPercentage($model) {
        $rows = $model::all();
        $totalPercentage = $rows->sum('ratio');

        $distribution = [];
        $cumulative = 0;
        foreach ($rows as $row) {
            $probability = $row->ratio / $totalPercentage;
            $cumulative += $probability;
            $distribution[$row->id] = $cumulative;
        }

        $randomNumber = mt_rand() / mt_getrandmax();
        $selectedId = null;

        foreach ($distribution as $id => $cumulativeProbability) {
            if ($randomNumber <= $cumulativeProbability) {
                $selectedId = $id;
                break;
            }
        }

        if ($selectedId !== null) {
            return $rows->find($selectedId);
        }

        return null;
    }

    public function view() {
        return view('gifts');
    }

    public function open_gift()
    {
        $user = User::find(Auth::user()->id);
        $wallet = $user->getWallet();
        $openCount = GiftOpenHistory::where('uid', Auth::user()->id)->count();
        if ($openCount >= 3) return ApiController::response(201, [], "Bạn đã mở 3 lần rồi.");
        if (intval($wallet->amount) <= 0) return ApiController::response(201, [], "Số dư không đủ");

        $wallet->changeMoney(intval(Settings::where('name','open_gift_cost')->first()->value ?? 10000), 'Mở quà', 0);

        $randomGift = $this->getRandomElementWithPercentage(HopQua::class);

        GiftOpenHistory::insert([
            'uid' => Auth::user()->id,
            'id_qua' => $randomGift->id,
        ]);

        return ApiController::response(200, [
            'ten' => $randomGift->name,
            'ti_le' => $randomGift->ratio
        ]);
    }
}
