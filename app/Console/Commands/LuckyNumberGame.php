<?php
namespace App\Console\Commands;

use App\Events\LuckyNumberEvent;
use App\Events\UserInformationEvent;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\LuckyNumberController;
use App\Models\LuckyNumber;
use App\Services\Game;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class LuckyNumberGame extends Command
{
    protected $signature = 'game:run';

    protected $description = 'Command description';

    public function handle()
    {
        $hLock=fopen(base_path("cronGame.lock"), "w+");
        if(!flock($hLock, LOCK_EX | LOCK_NB)){
            die("Already running. Exiting.. sex");
        }
        try {
            $server = IoServer::factory(
                new HttpServer(
                    new WsServer(
                        new Game()
                    )
                ),
                env('GAME_PORT')
            );
            $server->run();
        } catch (\Exception $e) {
            Log::error($e);
        }
        flock($hLock, LOCK_UN);
        fclose($hLock);
        unlink(base_path("cronGame.lock"));
    }

//    public function handle()
//    {
//        $hLock=fopen(base_path("cronLuckyGame.lock"), "w+");
//        if(!flock($hLock, LOCK_EX | LOCK_NB)){
//            die("Already running. Exiting...");
//        }
//        while (true) {
//            $lastRecord = LuckyNumber::latest()->first();
//            if (!$lastRecord) {
//                $this->info('No records found in LuckyNumber model.');
//                return;
//            }
//
//            $random = rand(0, 9) . '-' . rand(0, 9) . '-' . rand(0, 9);
//            $this->info('Next: ' . $random);
//
//            $endTime = Carbon::now()->addMinutes(ApiController::getSetting('game_length') ?? 1);
//            $duration = $endTime->diffInSeconds();
//            $nextId = $lastRecord->id + 1;
//
//
//            while ($duration > 0) {
//                $minutes = floor($duration / 60);
//                $seconds = $duration % 60;
//                $formattedTime = sprintf('%02d:%02d', $minutes, $seconds); // Format as mm:ss
//
//                event(new LuckyNumberEvent(json_encode([
//                    'time' => $formattedTime,
//                    'next' => $nextId,
//                    'number' => $lastRecord->gia_tri
//                ])));
//
//                event(new UserInformationEvent(json_encode([
//                    'next_id' => $lastRecord->game_id + 1,
//                    'next_result' => $random,
//                    'time' => $formattedTime,
//                ])));
//
//
//                sleep(1); // Wait for 1 second before sending the next event
//
//                $duration--;
//            }
//
//            // Fetch the latest record again for the next iteration
//            LuckyNumberController::endGame($lastRecord->game_id);
//
//            $lastRecord = LuckyNumber::latest()->first();
//
//            LuckyNumber::insert([
//                'game_id' => Carbon::now()->format('YmdHi'),
//                'gia_tri' => $random,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now(),
//            ]);
//
//            $lastRecord = LuckyNumber::latest()->first();
//        }
//        flock($hLock, LOCK_UN);
//        fclose($hLock);
//        unlink(base_path("cronLuckyGame.lock"));
//    }
}
