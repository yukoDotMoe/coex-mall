<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgAbout extends Model
{
    use HasFactory;
    protected $table = 'about_img';
    protected $fillable = ['order', 'path'];
}
