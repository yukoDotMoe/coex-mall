<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HopQua extends Model
{
    use HasFactory;
    protected $table = "hop_qua";

    protected $fillable = [
        "gift_id",
        "name",
        "ratio",
    ];
}
