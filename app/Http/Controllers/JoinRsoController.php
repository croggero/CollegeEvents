<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rso;
use App\User_rso;
use DB;
use Auth;

class JoinRsoController extends Controller
{
    public function index()
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
    public function create() {
        $data = $_POST;
        
        User_Rso::create(array(
            'user_id' => Auth::id(),
            'rso_id' => $data['id']
        ));

        return redirect()->route('login');
    }
}
