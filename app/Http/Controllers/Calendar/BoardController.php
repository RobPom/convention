<?php

namespace App\Http\Controllers\Calendar;

use App\Convention;
use App\GameSession;
use App\Timeslot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoardController extends Controller
{
    public function index($id){
        $convention = Convention::find($id);
        return view('calendar.convention.board.index')->with('convention',$convention);
    }

    public function show($id, $timeslot){
        $convention = Convention::find($id);
        $timeslot = Timeslot::find($timeslot);
        return view('calendar.convention.board.show')
            ->with('convention',$convention)
            ->with('timeslot',$timeslot);
    }
}
