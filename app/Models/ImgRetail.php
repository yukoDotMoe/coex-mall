<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgRetail extends Model
{
    use HasFactory;
    protected $table = 'retail_img';
    protected $fillable = ['order', 'path'];
}
