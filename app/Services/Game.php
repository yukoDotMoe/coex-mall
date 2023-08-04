<?php

namespace App\Services;

use App\Http\Controllers\ApiController;
use App\Models\LuckyNumber;
use App\Models\Recharge;
use App\Models\User;
use App\Models\UserBet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use DB;

class Game implements MessageComponentInterface
{
    protected $clients;
    protected $userList;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->userList = new Collection;
    }

    private static function generateUserAuthKey()
    {
        $userId = Auth::id();
        $hash = $userId.rand(100,999);
        $hash = base64_encode($hash);
        $hash = base64_encode($hash.Str::random(100));
        $hash = base64_encode(Str::random(100).$hash);
        return $hash;
    }
    private static function unHashUserAuthKey($key)
    {
        $userId = base64_decode($key);
        $userId = Str::substr($userId,100,Str::length($userId));
        $userId = base64_decode($userId);
        $userId = Str::substr($userId,0,Str::length($userId) - 100);
        $userId = base64_decode($userId);
        $userId = Str::substr($userId,0,Str::length($userId) - 3);
        return (int)$userId;
    }
    public static function getTokenUserKey()
    {
        if (!Auth::check()) {
            return '';
        }
        return self::generateUserAuthKey();
    }
    public static function getUserByKey($key)
    {
        $userId = self::unHashUserAuthKey($key);
        return User::find($userId);
    }

    protected function getCurrentGame()
    {
        return LuckyNumber::latest()->first()->game_id;
    }

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

    private function buildMessage($type, $data)
    {
        $dataMessage = [];
        $dataMessage['type'] = $type;
        $dataMessage['data'] = $data;
        return json_encode($dataMessage);
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        parse_str($conn->httpRequest->getUri()->getQuery(), $clientInfoParam);
        $itemData = [];
        $itemData['type'] = $clientInfoParam['type'] ?? '';
        $itemData['user'] = $this->getUserByKey($clientInfoParam['auth_token'] ?? '');
        $itemData['isLogin'] = isset($itemData['user']);
//         Log::info('WS open: '. json_encode($itemData));
        $this->userList->put($conn->resourceId, $itemData);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        if (!isset($this->userList[$from->resourceId])) {
            if ($this->userList[$from->resourceId]['type'] != 'admin' && !isset($this->userList[$from->resourceId]['user'])) {
                $from->send($this->buildMessage('authentication_false', ['message' => 'Bạn cần đăng nhập.']));
                return;
            }
        }

        $data = json_decode($msg, true);
        if (!empty($data['action'])) {
            switch ($data['action']) {
                case 'game_information':
                    $dataGameItemValue = $this->game_round();
                    $from->send($this->buildMessage('game_information', $dataGameItemValue));
                    break;
                case 'balance':
                    $userShowAmount = $this->user_balance($from);
                    $from->send($this->buildMessage('user_info', $userShowAmount));
                    break;
                case 'promote':
                    $thongBao = $this->checkPromote($from);
                    $from->send($this->buildMessage('thong_bao', $thongBao));
                    break;
                case 'mark_seen':
                    $this->handleSeen($data);
                    break;
            }
        }
    }

    protected function handleSeen($data)
    {
        Recharge::where('id', $data['rid'])->update(['show' => 1]);
    }

    protected function checkPromote($from)
    {
        $user = $this->userList[$from->resourceId]['user'];
        if (!$user) return 0;
        return Cache::remember('thongbao' . $user->id, 2, function () use ($user) {
            $promote = Recharge::where([
                ['user_id','=', $user->id],
                ['bill', 0],
                ['show', 0],
                ['note', '!=', '.']
            ])->orderBy('created_at', 'desc')->first();

            return $promote;
        });
    }

    protected function game_round()
    {
        return Cache::remember('game_info', 2, function (){

            $oldGame = LuckyNumber::where('game_id','<',Carbon::now()->format('YmdHis'))->orderBy('id', 'desc')->first();

            $nextGame = LuckyNumber::where('id', $oldGame->id + 1)->first();

            $time_hold_s = Carbon::now()->DiffInSeconds( Carbon::createFromFormat('YmdHis',  $nextGame->game_id));

            return [
                //'old_game_id' => $oldGame->game_id,
                'next_game_id' => $nextGame->game_id,
                'next_id' => $oldGame->id + 1,
                'time_hold_s' => $time_hold_s,
                'old_value' => $oldGame->gia_tri
            ];
        });
    }
    protected function user_balance($from)
    {
        $user = $this->userList[$from->resourceId]['user'];
        if (!$user) return 0;
        return Cache::remember('refreshUserInfo' . $user->id, 2, function () use ($user) {
            return $user->balanceFormated();
        });
    }

    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}
