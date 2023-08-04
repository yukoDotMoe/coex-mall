<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBet extends Model
{
    use HasFactory;
    protected $table = 'lich_su_danh_gia';
    protected $fillable = [
        'game_id',
        'user_id',
        'thao_tac',
        'so_luong',
        'trang_thai',
    ];
}
