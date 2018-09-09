<?php

namespace App\Http\Controllers\Calendar;
use App\User;
use App\Role;
use App\Timeslot;
use App\Convention;
use App\GameSession;
use Auth;
use Validator;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add($id)
    {   
        $convention = Convention::find($id);
        $users = User::all();

        return view('calendar.convention.attendee.add')->with('convention' , $convention)->with('users', $users);
       
    }

    public function addAttendee(Request $request)
    {   
        $convention = Convention::find($request->convention);
        $member = User::find($request->member);

        $convention->attendees()->attach($member);
        return redirect('/calendar/convention/' . $convention->id . '/attendees')->with('status', 'User added to convnetion');
        
        //return view('/member/add');
    }

    public function removeAttendee(Request $request)
    {   
        $convention = Convention::find($request->convention);
        $member = User::find($request->member);

        $convention->attendees()->detach($member);
        return redirect('/calendar/convention/' . $convention->id . '/attendees')->with('status', 'user removed from attendance');
        
        //return view('/member/add');
    }
    
    public function new($id)
    {   
        $convention = Convention::find($id);

        return view('calendar.convention.attendee.create')->with('convention' , $convention);
        //return view('/member/add');
    }

    public function view($convention_id, $user_id)
    {   
       
        $member = User::find($user_id);
        
        $convention = Convention::find($convention_id);

        return view('calendar.convention.attendee.view')
            ->with('convention' , $convention)
            ->with('member' , $member);
        //return view('/member/add');
    }
    
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'username'  => 'required|max:255',
            'firstname'  => 'required|max:255',
            'lastname'  => 'required|max:255',
            'email' => 'required|email|unique:users',
        ]);
        // If validator fails, short circut and redirect with errors
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $convention = Convention::find($request->convention);
        //generate a password for the new users
        $pw = User::generatePassword();

        //add new user to database
        $user = new User;
        $user->username = $request->input('username');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = $pw;
        $user->verified = true;
        $user->save();
        $user->roles()->attach(Role::where('name', 'member')->first());
        $convention->attendees()->attach($user);
        
        User::sendWelcomeEmail($user);
        return redirect('/calendar/convention/' . $convention->id . '/attendees')->with('status', 'member added');
    }

    public function destroy($id)
    {
        $member = User::find($id);
        $user = User::find(Auth::id());
        
        if( $user->hasRole('organizer') ||  $user->hasRole('admin') ){
            $member->delete();
            return redirect('profiles/all')->with('status', 'member deleted');
        }
        
            abort(403, 'This action is unauthorized.');
        
    }

    public function attendeeSchedule($id ){
        $user = Auth::user();
        $convention = Convention::find($id);
        return view('calendar.convention.attendee.schedule')
            ->with('user', $user)->with('convention', $convention);
    }

    /*
      users editing their own schedule
    */
    public function attendeeTimeslot($id){
        $timeslot = Timeslot::find($id);
        $user = Auth::user();
        $convention = Convention::find($timeslot->convention_id);

        return view('calendar.convention.attendee.timeslot')
            ->with('user', $user)->with('convention', $convention)->with('timeslot', $timeslot);
    }
    
    public function attendGamesession($id){
        $gamesession = GameSession::find($id);
        $gamesession->attendees()->attach(Auth::user());
        return redirect('/calendar/convention/' . $gamesession->timeslot->convention->id . '/attendee/schedule');
    }

    public function leaveGamesession($id){
        $gamesession = GameSession::find($id);
        $user = Auth::user();
        $timeslot = Timeslot::find($gamesession->timeslot->id);  
        $convention = Convention::find($timeslot->convention_id);
        $gamesession->attendees()->detach(Auth::user());

        return view('calendar.convention.attendee.timeslot')
        ->with('user', $user)->with('convention', $convention)->with('timeslot', $timeslot);

    }

    /*
        organizers editing user schedule
    */
    public function viewAttendeeTimeslot($member, $timeslot){
        $timeslot = Timeslot::find($timeslot);
        $member = User::find($member);
        $convention = Convention::find($timeslot->convention_id);

        return view('calendar.convention.attendee.edit.timeslot')
            ->with('member', $member)->with('convention', $convention)->with('timeslot', $timeslot);
    }

    public function addAttendGamesession(Request $request , $id){
        $gamesession = GameSession::find($request->gamesession);
        $member = User::find($id);
        $gamesession->attendees()->attach($member);
        return redirect('/calendar/convention/' . $gamesession->timeslot->convention->id . '/attendee/'. $member->id);
    }
    
    public function removeAttendeeGamesession(Request $request , $id){
        
        $gamesession = GameSession::find($request->gamesession);
        $member = User::find($id);
        $gamesession->attendees()->detach($member);
        return redirect('/calendar/convention/'. $request->convention .'/attendee/' .$member->id);
    }

    public function remove(Request $request)
    { 
        $convention = Convention::find($request->convention);
        $attendee = User::find($request->attendee);

        if( Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin') ){
            //if there are any games in convention where user is gm
            if($convention->games()->where('user_id' , $attendee->id)->count()){
                //go through each game
                foreach($convention->games()->where('user_id' , $attendee->id)->get() as $game){
                    //check if game is scheduled
                    if($game->timeslots->count()){
                        //go through each timeslot the game is assigned
                        foreach($game->timeslots as $timeslot){
                            $gamesession = $timeslot->gamesession($game);
                            //remove all attendees from the game session
                            $gamesession->attendees()->detach();
                            //remove game from timeslot
                            $timeslot->games()->detach($game);
                        }
                    }
                    $game->delete();
                }
            }
            //remove the user from any gamesessions they are attending
            //finally remove the user from the convention
            $convention->attendees()->detach($attendee);
            return redirect('/calendar/convention/'. $request->convention .'/attendees')->with('status', 'Attendee removed from convention');
        }
            abort(403, 'This action is unauthorized.');

    }

}
