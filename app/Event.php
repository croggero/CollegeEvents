<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
            'name',
            'description',
            'cat_id',
            'location_id',
            'time',
            'date',
            'email',
            'phone',
            'rso_id',
            'permission',
    ];
}
