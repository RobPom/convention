<?php

namespace App\Http\Controllers\Calendar;

use App\GameSession;
use App\Game;
use App\Convention;
use App\Timeslot;
use App\User;
use Redirect;
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
        $this->middleware('auth')->except('show');
    }

    public function show($id){

        $gamesession = GameSession::find($id);        

        if(isset($gamesession)){
           
            $convention = Convention::find($gamesession->timeslot->convention_id);
            
            return view('calendar.sessions.show')
               ->with('gamesession' , $gamesession)
               ->with('convention' , $convention); 
        } else {
                abort(404, 'This Game Session does not exist.');
        }

       
    }

    public function home(){
        return view('home');
    }
}
