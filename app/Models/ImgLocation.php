<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgLocation extends Model
{
    use HasFactory;
    protected $table = 'location_img';
    protected $fillable = ['order', 'path'];
}
