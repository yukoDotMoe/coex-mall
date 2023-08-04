<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftOpenHistory extends Model
{
    use HasFactory;
    protected $table = "lich_su_mo_qua";
    protected $fillable = [
        "uid",
        "id_qua",
        "trang_thai",
    ];
}
