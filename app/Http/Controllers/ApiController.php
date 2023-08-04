<?php

namespace App\Http\Controllers;

use App\Models\Banks;
use App\Models\LuckyNumber;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public static function response($code, $data, $msg = null)
    {
        if ($code <= 200)
        {
            return response()->json([
                'success' => true,
                'code' => $code,
                'message' => $msg,
                'data' => $data
            ]);
        }else{
            return response()->json([
                'success' => false,
                'code' => $code,
                'message' => $msg,
                'data' => $data
            ]);
        }
    }

    public static function currentUsers($real = false)
    {
        return ($real) ? User::all()->count() : ceil(User::all()->count() * 69 * 3.14);
    }

    public static function getSetting($name)
    {
        return Settings::where('name', $name)->first()->value;
    }

    public static function gameIdToId(string $gameid)
    {
        return LuckyNumber::where('game_id', $gameid)->first()->id ?? 0;
    }

    public static function textToTime($time)
    {
        $reuslt = Carbon::createFromFormat('YmdHis', $time);
        return $reuslt->format('Y-m-d H:i:s');
    }

    public static function generate_random_md5() {
        $random_string = uniqid(mt_rand(), true);
        $md5_hash = md5($random_string);
        $stripped_md5 = substr($md5_hash, 0, 24);
        return $stripped_md5;
    }

    public static function extractNumbersFromString($str) {
        preg_match_all('/\d+/', $str, $matches);
        return implode('', $matches[0]);
    }

    public static function getSessionFromGameId(string $gameid)
    {
        return LuckyNumber::where('game_id', $gameid)->first();
    }

    public static function getNameFromBankId(string $bank)
    {
        return Banks::where('id', $bank)->first()->name;
    }

    public static function getFromBankId(string $bank)
    {
        return Banks::where('id', $bank)->first();
    }
}
