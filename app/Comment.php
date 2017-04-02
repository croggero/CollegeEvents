<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['event_id', 'user_id', 'comment', 'created_at', 'updated_at'];
}
