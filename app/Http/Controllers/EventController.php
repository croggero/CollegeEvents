<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use Redirect;
use Session;
use App\Uploads;
use App\Uni;
use App\User;
use App\Rso;
use App\User_rso;
use App\Categorie;
use App\Event;
use DB;
use Auth;

class EventController extends Controller
{
        public function index() {

        $data = $_POST;
        $cats = DB::select(DB::raw("SELECT *
                            FROM categories as c;"));

        $userid = Auth::id();
        
        $locs = DB::select(DB::raw("SELECT DISTINCT(locations.id), locations.loc_name
                                FROM locations INNER JOIN (users INNER JOIN unis ON users.uni_id = unis.id) 
                                ON locations.uni_id = unis.id
                                WHERE users.id = ". $userid .";"));

        return view('createevent', compact('data', 'cats', 'locs'));
    }

    public function create(Request $request) {

        $data = $_POST;

        $event = Event::create(array(
            'name' => $data['eventname'],
            'description' => $data['desc'],
            'cat_id' => $data['cat'],
            'location_id' => $data['loc'],
            'time' => $data['time'],
            'date' => $data['date'],
            'email' => $data['contactemail'],
            'phone' => $data['contactphone'],
            'rso_id' => $data['rso_id'],
            'permission' => $data['permission'],
        ));

        if(Input::hasFile('image')) {
                $file = Input::file('image');
                $file->move('images/event/', $event->id);
        }

        DB::table('events')->where('id', $event->id)->update(['img'=> "images/event/". $event->id]);

        return redirect()->route('login');
    }

    public function delete() {

        $data = $_POST;
        $userid = Auth::id();
        DB::select(DB::raw("DELETE FROM events WHERE (events.id = ". $data['id'] .");"));

        return redirect()->route('login');
    }
}
