<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class Uni extends Model
{
    protected $fillable = [
        'superadmin_id'
    ];

    public function uniupdate(array $data) {
        if (isset($data['permission'])) {
            $uni = Uni::find($data['uni']);
            $user = DB::table('users')->orderBy('id', 'desc')->first();
            $uni->superadmin_id = $user->id;
            $uni->save();
        }
        return;
    }
}
