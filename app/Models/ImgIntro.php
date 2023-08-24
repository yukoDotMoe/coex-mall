<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgIntro extends Model
{
    use HasFactory;
    protected $table = 'intro_img';
    protected $fillable = ['order', 'path'];
}
