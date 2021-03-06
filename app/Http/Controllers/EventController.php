<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Route;
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
use App\Comment;
use App\Event;
use App\Event_user;
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

        DB::table('events')->where('id', $event->id)->update(['img' => "images/event/". $event->id]);

        return redirect()->route('login');
    }

    public function delete() {

        $data = $_POST;
        $userid = Auth::id();
        DB::select(DB::raw("DELETE FROM events WHERE (events.id = ". $data['id'] .");"));

        return redirect()->route('login');
    }

    public function edit() {

        $userid = Auth::id();
        $event_id = $_POST;

        $events = DB::select(DB::raw("SELECT *
                            FROM events
                            WHERE (((events.id)=". $event_id['id'] ."));
                            "));

        foreach($events as $event){
            $data = $event;
            break;
        }
        $event = $data;

        $cats = DB::select(DB::raw("SELECT *
                            FROM categories as c;"));

        $locs = DB::select(DB::raw("SELECT DISTINCT(locations.id), locations.loc_name
                                FROM locations INNER JOIN (users INNER JOIN unis ON users.uni_id = unis.id) 
                                ON locations.uni_id = unis.id
                                WHERE users.id = ". Auth::id() .";"));

        return view('editevent', compact('event', 'cats', 'locs'));
    }

    public function update(Request $request) {

        $data = $_POST;
        $userid = Auth::id();

        
        if(Input::hasFile('image')) {
            $file = Input::file('image');
            $file->move('images/event/', $data['eventid'] . $time());
           
            DB::table('events')->where('id', $data['eventid'])->update(['name' => $data['eventname'],
                'description' => $data['desc'],
                'cat_id' => $data['cat'],
                'location_id' => $data['loc'],
                'time' => $data['time'],
                'date' => $data['date'],
                'email' => $data['contactemail'],
                'phone' => $data['contactphone'],
                'permission' => $data['permission'],
                'img' => "images/event/". $data['eventid'] . $time()]);

        } else {
            
            DB::table('events')->where('id', $data['eventid'])->update(['name' => $data['eventname'],
                'description' => $data['desc'],
                'cat_id' => $data['cat'],
                'location_id' => $data['loc'],
                'time' => $data['time'],
                'date' => $data['date'],
                'email' => $data['contactemail'],
                'phone' => $data['contactphone'],
                'permission' => $data['permission']]);
        }


        return redirect()->route('login');
    }

    public function joinevent() {
        Event_user::create(array('event_id' => $_POST['event_id'], 'user_id' => Auth::id()));
        return redirect()->route('login');
    }
    
    public function leaveevent() {
        DB::select(DB::raw("DELETE FROM event_users WHERE (event_users.event_id = ". $_POST['event_id'] ." AND event_users.user_id = ". Auth::id() .");"));
        return redirect()->route('login');
    }

    public function approve(){
        DB::table('events')->where('id', $_POST['id'])->update(['approved' => 1]);
        return redirect()->route('login');
    }

    public function info($event_id) {
        
        $comments = DB::select(DB::raw("SELECT *, DATE_FORMAT(comments.created_at, '%d/%m/%Y') as date
                                    FROM users INNER JOIN comments ON users.id = comments.user_id
                                    WHERE comments.event_id = ". $event_id .";"));
        $events = DB::select(DB::raw("SELECT *
                                FROM events INNER JOIN locations ON events.location_id = locations.id
                                WHERE (((events.id)=". $event_id ."));
                            "));

        foreach($events as $event) {                    
            $latt = $event->latt;
            $long = $event->long;
        }

        Mapper::map($latt, $long,
            [
                'zoom' => 16,
                'markers' => ['animation' => 'DROP']
            ]
        );

        return view('info', compact('comments', 'events', 'event_id'));
    }

    public function addcomment($event_id) {
        Comment::create(array(
            'comment' => $_POST['comment'],
            'event_id' => $_POST['event_id'],
            'user_id' => Auth::id(),
        ));
        
        return redirect()->action('EventController@info', ['event_id' => $event_id]);
    }
}
