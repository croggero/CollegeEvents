<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rso;
use App\User_rso;
use Auth;
use DB;


class RsoController extends Controller
{
    public function start()
    {   
        return view('createrso');
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

        return redirect()->route('login');
    }

    public function join()
    {   
        $user = Auth::user();
        $rsos = DB::select(DB::raw("SELECT DISTINCT r.name, r.id
                        FROM user_rsos as ur RIGHT JOIN rsos as r ON ur.rso_id = r.id
                        WHERE (r.id NOT IN (SELECT user_rsos.rso_id 
                            FROM user_rsos 
                            WHERE user_rsos.user_id = ". $user->id .")
                        AND (r.uni_id = ". $user->uni_id ."));"));

        return view('joinrso', compact('rsos'));
    }

    public function joined() {
        $data = $_POST;
        
        User_Rso::create(array(
            'user_id' => Auth::id(),
            'rso_id' => $data['id']
        ));

        return redirect()->route('login');
    }

    public function leaveRso() {

        $data = $_POST;
        $userid = Auth::id();
        DB::select(DB::raw("DELETE FROM user_rsos WHERE (user_rsos.user_id = ". $userid ." AND user_rsos.rso_id = ". $data['id'] .");"));

        return redirect()->route('login');
    }

    public function deleteRso() {

        $data = $_POST;
        $userid = Auth::id();
        DB::select(DB::raw("DELETE FROM user_rsos WHERE (user_rsos.rso_id = ". $data['id'] .");"));
        DB::select(DB::raw("DELETE FROM rsos WHERE (rsos.id = ". $data['id'] .");"));
        DB::select(DB::raw("DELETE FROM events WHERE (events.rso_id = ". $data['id'] .");"));

        return redirect()->route('login');
    }
}
