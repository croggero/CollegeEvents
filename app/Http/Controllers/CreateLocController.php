<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\User;
use App\User_rso;
use DB;
use Auth;

class CreateLocController extends Controller
{
    public function index()
    {   
        return view('createloc');
    }

    public function create() {
        $data = $_POST;
        
        $user = Auth::user();

        Location::create(array(
            'loc_name' => $data['name'],
            'latt' => $data['latt'],
            'long' => $data['long'],
            'uni_id' => $user->uni_id
        ));

        return redirect()->route('login');
    }
}
