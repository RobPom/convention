<?php

namespace App\Http\Controllers\Calendar;

use App\GameSession;
use App\Timeslot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameSessionController extends Controller
{
    public function show($id){
       
        $gamesession = GameSession::where('id' ,$id)->first();
        

        if(isset($gamesession)){
           return view('calendar.sessions.show')
                ->with('gamesession' , $gamesession); 
        } else {
                abort(404, 'This Game Session does not exist.');
        }
    }
}
