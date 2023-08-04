<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReactVote extends Model
{
    use HasFactory;
    protected $table = 'danh_gia';
    protected $fillable = ['post_id', 'user_id', 'vote'];
}
