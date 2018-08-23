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
        if( Convention::where('status' , 'active')->first() ) {
            $gamesession = GameSession::where('id' ,$id)->first();

            if(isset($gamesession)){
                 return view('calendar.sessions.show')
                    ->with('gamesession' , $gamesession); 
            } else {
                    abort(404, 'This Game Session does not exist.');
            }
        } else {
            abort(403, 'No upcoming conventions scheduled.');   
        }
    }

    public function userCalendar($id){
        $user = User::find($id);
        $convention = Convention::where('status' , 'active')->first();
        $attendee = $convention->attendees->contains( Auth::user());
        $organizer = Auth::user()->hasRole('organizer');
        $scheduled_games = [];

        if($user->games()->exists()){
            foreach($user->games as $game) {
                if($game->timeslots()->exists()){

                }
            }
        }

        if($attendee || $organizer) {
           
            if($organizer){
                return view('calendar.conventions.usercalendar')
                    ->with('convention' , $convention)
                    ->with('user', $user );
            }

            if($attendee){
                if(Auth::user()->id == $user->id){
                    return view('calendar.conventions.usercalendar')
                    ->with('convention' , $convention)
                    ->with('user', $user );
                }
                
            }  
        }
        abort(403, 'Not Authorized. Bitch');       
    }

    public function setGameSession($id){
        $user = Auth::user();
        $timeslot = Timeslot::find($id);
        $convention = Convention::where('status' , 'active')->first();
        
        $attendee = $convention->attendees->contains( Auth::user());

        if($attendee){

            return view('profile.attendee.setGameSession')
                ->with('convention' , $convention)
                ->with('timeslot' , $timeslot)
                ->with('user' , $user);

        }
        abort(403, 'Not Authorized.'); 
         
    }

    public function updateUserGameSession(Request $request){

        if(!$request->game_session) {
            // 'No Selection was selected'

            $timeslot = Timeslot::find($request->timeslot_id);

            //see if the user has a gamesession with the timeslot already save
            if(Auth::user()->gamesessions()->where('timeslot_id' , $timeslot->id)->exists()) {
                $session = Auth::user()->gamesessions()->where('timeslot_id' , $timeslot->id)->first();
                $session->attendees()->detach(Auth::user());
                return redirect('/calendar/convention/sessions/' . Auth::user()->id)->with('status', 'You have no games selected for ' . $timeslot->title);
            } else {
                return redirect('/calendar/convention/sessions/' . Auth::user()->id);
            }
            
        } else {
            //load the selected gamesession
            $gamesession = GameSession::find($request->game_session);
            
            //see if the user has a gamesession with the timeslot already save
            if(Auth::user()->gamesessions()->where('timeslot_id' , $gamesession->timeslot->id)->exists()) {

                //if so, fetch the saved session as $session
                $session = Auth::user()->gamesessions()->where('timeslot_id' , $gamesession->timeslot->id)->first();
                
                //compare $session to the selected $gamesession
                if(  $session->id == $gamesession->id) {
                    return redirect('/calendar/convention/session/'.$gamesession->timeslot->id .'/edit');
                } else {
                    //its different, detach user from $session, then attach to $gamesession, then save $gamesession
                  
                    $session->attendees()->detach(Auth::user());
                    $gamesession->attendees()->attach(Auth::user());
                    return redirect('/calendar/convention/sessions/' . Auth::user()->id)->with('status', 'You are now scheduled to play "' . $gamesession->game->title . '"');
                }

            } else {
                $gamesession->attendees()->attach(Auth::user());
                return redirect('/calendar/convention/sessions/' . Auth::user()->id)->with('status', 'You are now scheduled to play "' . $gamesession->game->title . '"');
            }

           
        }
        
    }

    public function home(){
        return view('home');
    }
}
