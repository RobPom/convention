<?php

namespace App\Http\Controllers\Calendar;

use App\GameSession;
use App\Game;
use App\Convention;
use App\Timeslot;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameSessionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show' , 'devshow');
    }

    public function show($id){
       
        $gamesession = GameSession::where('id' ,$id)->first();

        if(isset($gamesession)){
           return view('calendar.sessions.show')
                ->with('gamesession' , $gamesession); 
        } else {
                abort(404, 'This Game Session does not exist.');
        }
    }

    public function devshow($id){
       
        $gamesession = GameSession::where('id' ,$id)->first();

        if(isset($gamesession)){
           return view('calendar.sessions.devshow')
                ->with('gamesession' , $gamesession); 
        } else {
                abort(404, 'This Game Session does not exist.');
        }
    }

    public function userCalendar($id){
        $user = User::find($id);
        $convention = Convention::where('status' , 'active')->first();
        $attendee = $convention->attendees->contains( Auth::user());
        $organizer = Auth::user()->hasRole('organizer');

        if($attendee || $organizer) {

            if($organizer){
                return view('calendar.conventions.usercalendar')
                    ->with('convention' , $convention)
                    ->with('user', $user );
            }

            if($attendee){
                if(Auth::user() == $user) {
                    return view('calendar.conventions.usercalendar')
                    ->with('convention' , $convention)
                    ->with('user', $user );
                } 
            }  
        }
        abort(403, 'Not Authorized.');       
    }

    public function home(){
        return view('home');
    }
}
