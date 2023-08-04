<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    use HasFactory;
    protected $table = "wallet_activities";
    protected $fillable = [
        'uid',
        'type',
        'before',
        'after',
        'reason',
    ];
}
