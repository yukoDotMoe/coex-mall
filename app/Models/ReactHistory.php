<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReactHistory extends Model
{
    use HasFactory;
    protected $table = 'interactions_activities';
    protected $fillable = ['user_id', 'amount', 'interact_type', 'before', 'after', 'type', 'reason'];
}
