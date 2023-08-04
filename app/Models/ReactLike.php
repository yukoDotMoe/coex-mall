<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReactLike extends Model
{
    use HasFactory;
    protected $table = 'yeu_thich';
    protected $fillable = ['post_id', 'user_id', 'likes'];
}
