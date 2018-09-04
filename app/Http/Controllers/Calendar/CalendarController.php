<?php

namespace App\Http\Controllers\Calendar;

use App\Convention;
use App\GameSession;
use App\Timeslot;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show' , 'index']);
    }

    public function index(){
        $timeslots = Timeslot::all();
        return view('calendar.timeslots.index')->with('timeslots',$timeslots);
    }

    public function show($id){
        if( Convention::where('status' , 'active')->first() ) {
            $timeslot = Timeslot::find($id);
            return view('calendar.timeslots.show')->with('timeslot' , $timeslot)->with('convention' , $timeslot->convention);
        } else {
            abort(403, 'No upcoming conventions scheduled.');   
        }
    }

    

}
