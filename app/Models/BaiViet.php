<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    use HasFactory;
    protected $table = 'bai_viet';
    protected $fillable = ['thumbnail', 'title', 'content', 'danh_muc', 'post_id', 'vote', 'like', 'small_title', 'order', 'limit_vote', 'limit_like'];
}
