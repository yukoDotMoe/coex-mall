<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    use HasFactory;
    protected $table = 'recharge';
    protected $fillable = ['user_id', 'amount', 'before', 'after', 'note', 'status', 'bill', 'show'];
}
