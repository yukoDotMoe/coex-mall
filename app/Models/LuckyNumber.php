<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuckyNumber extends Model
{
    use HasFactory;
    protected $table = "lich_su_danh_gia_game";
    protected $fillable = [
        "game_id", "gia_tri"
    ];
}
