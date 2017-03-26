<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UniController extends Controller
{
    public function getuniname() {
        $data['unis'] = Level::get()->pluck('name', 'id');
        return view('register', $data);
    }
    
}
