<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rso extends Model
{
    protected $fillable = [
        'name', 'admin_id', 'uni_id'
    ];
    public $timestamps = false;
}
