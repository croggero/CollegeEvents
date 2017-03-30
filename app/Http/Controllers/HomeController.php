<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Uni;
use App\User;
use App\Rso;
use App\User_rso;
use App\Categorie;
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
        $unis = DB::select(DB::raw("SELECT uni.*
                                FROM unis as uni, users as u
                                WHERE uni.id = u.uni_id
                                AND u.id = ". $userid));
        $rsos = DB::select(DB::raw("SELECT r.name, r.id, r.admin_id
                                    FROM rsos as r, user_rsos as ur
                                    WHERE r.id = ur.rso_id
                                    AND ur.user_id =". $userid));
        if (empty($rsos))
            $rsos = array();

        $events = DB::select(DB::raw("SELECT events.id, events.name, events.date, events.time, events.description, events.img, events.phone, locations.loc_name, events.email, events.permission, categories.cat_name, locations.loc_name, rsos.name as rso_name, rsos.admin_id, rsos.uni_id, unis.name as uni_name
                                    FROM (rsos INNER JOIN (((events INNER JOIN user_rsos ON events.rso_id = user_rsos.rso_id) INNER JOIN categories ON events.cat_id = categories.id) INNER JOIN locations ON events.location_id = locations.id) ON rsos.id = user_rsos.rso_id) INNER JOIN unis ON rsos.uni_id = unis.id
                                    WHERE (((user_rsos.user_id)=". $userid .")) OR (((events.permission)=1)) OR (((events.permission)=2))
                                    GROUP BY events.id, events.name, events.date, events.time, events.description, events.img, events.phone, locations.loc_name, events.email, events.permission, categories.cat_name, locations.loc_name, rsos.name, events.id, events.Date, rsos.admin_id, rsos.uni_id, unis.name
                                    ORDER BY events.Date;
                                    "));

        return view('home', compact('unis','rsos', 'events'));
    }
}
