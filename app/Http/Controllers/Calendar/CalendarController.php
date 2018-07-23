<?php

namespace App\Http\Controllers\Calendar;

use App\Timeslot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function index(){
        $timeslots = Timeslot::all();
        return view('calendar.timeslots.index')->with('timeslots',$timeslots);
    }

    public function show($id){
        $timeslot = Timeslot::find($id);
        return view('calendar.timeslots.show')->with('timeslot' , $timeslot);
    }
}
