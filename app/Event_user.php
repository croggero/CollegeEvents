<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_user extends Model
{
    protected $fillable = [
            'event_id', 'user_id',
    ];
}
