<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Wallet extends Model
{
    use HasFactory;
    protected $table = "wallet";
    protected $fillable = ["userid", "amount", "amount_freeze", "amount_availability", "like", "vote"];
    public function changeMoney(float $amount, string $reason, int $type = 0)
    {
        $amountBefore = $this->amount;
        $this->amount = ($type == 0 ) ? $this->amount - $amount : $this->amount + $amount;
        $this->amount_availability = ($type == 0 ) ? $this->amount_availability - $amount : $this->amount_availability + $amount;
        if ($this->amount < 0) {
            $this->amount = 0;
            $this->amount_availability = 0;
        }
        $this->save();
        $dataHistory = array(
            'user_id' => $this->id,
            'type' => $type,
            'amount' => (int)($amount),
            'before' => (int)($amountBefore),
            'after' => (int)($this->amount),
            'reason' => $reason,
            'created_at' => now(),
            'updated_at' => now()
        );
        WalletHistory::insert($dataHistory);
    }

    public function changeIneract(int $interact,float $amount, string $reson, int $type = 0)
    {
        if ($interact == 1)
        {
            Log::info('vote');
            $amountBefore = $this->vote;
            $this->vote = ($type == 0 ) ? $this->vote - $amount : $this->vote + $amount;
        }else{
            Log::info('like');
            $amountBefore = $this->like;
            $this->like = ($type == 0 ) ? $this->like - $amount : $this->like + $amount;
        }
        $this->save();
        $dataHistory = array(
            'user_id' => $this->id,
            'interact_type' => $interact,
            'type' => $type,
            'amount' => (int)($amount),
            'before' => (int)($amountBefore),
            'after' => (int)( ($interact == 1) ? $this->vote : $this->like ),
            'reason' => $reson,
            'created_at' => now(),
            'updated_at' => now()
        );
        ReactHistory::insert($dataHistory);
    }
}
