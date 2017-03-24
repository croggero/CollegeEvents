<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Uni;
use App\User;
use App\Rso;
use App\User_rso;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $userid = Auth::id();
        $unis = DB::select(DB::raw("SELECT uni.name, uni.initials
                                FROM unis as uni, users as u
                                WHERE uni.id = u.uni_id
                                AND u.id = ". $userid));
        $rsos = DB::select(DB::raw("SELECT r.name
                                    FROM rsos as r, user_rsos as ur
                                    WHERE r.id = ur.rso_id
                                    AND ur.user_id =". $userid));
        return view('home', compact('unis','rsos'));
    }

}
