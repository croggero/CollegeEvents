<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rso;
use App\User_rso;
use Auth;
use DB;


class StartRsoController extends Controller
{
    public function index()
    {   
        return view('startrso');
    }
    public function create() {
        
        $data = $_POST;
        $user = Auth::user();
        $rso = Rso::create(array(
            'name' => $data['name'],
            'admin_id' => $user->id,
            'uni_id' => $user->uni_id,
        ));
        
        User_rso::create(array(
            'user_id' => $user->id,
            'rso_id' => $rso['id'],
        ));

        return view('rsocreated');
    }
}
