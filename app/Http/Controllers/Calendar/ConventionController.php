<?php

namespace App\Http\Controllers\Calendar;

use App\Convention;
use App\User;
use App\Game;
use App\Submission;
use App\Timeslot;
use Carbon\Carbon;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ConventionController extends Controller
{
    private $active_convention;
    
    public function __construct()
    {
        $this->active_convention = Convention::where('status' , 'active')->first();
        $this->middleware('auth')->except('show' , 'index' , 'showActive', 'schedule', 'showGame' , 'allGames' , 'register' , 'registered', 'cancelled');
    }

    public function index() {
        $conventions = Convention::all()->sortByDesc('start_date');
        return view('calendar.convention.index')->with('conventions' , $conventions);

    }
    public function show($id) {
        $convention = Convention::find($id);
        return view('calendar.convention.show')->with('convention' , $convention);
    }

    public function manage($id) {
        if(Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin')){
            $convention = Convention::find($id);
            if($convention->status != 'archived'){
                return view('calendar.convention.manage')->with('convention' , $convention);
            }
            
        }
        abort(403, 'Not Authorized.'); 
    }

    //shows the active convention, it will take the first if more than one is active.

    public function showActive()
    {
        if( $this->active_convention ) {
            return view('calendar.convention.show')->with('convention' , $this->active_convention );
        }

        abort(403, 'No conventions scheduled.'); 
    }

    public function attendees($id)
    {
        if(Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin')){
            $convention = Convention::find($id);
            return view('calendar.convention.attendee.index')
                ->with('convention' , $convention );
        } 
            abort(403, 'Not Authorized.');    
    }

    public function printAttendees($id)
    {
        if(Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin')){
            $convention = Convention::findOrFail($id);
            $attendees = $convention->attendees;
            return view('calendar.convention.attendee.print')
                ->with('attendees' , $attendees );
        } 
            abort(403, 'Not Authorized.');    
    }


    public function storeAttendees(Request $request)
    {
        $users = User::all();
        $this->active_convention->attendees()->sync($request->attending);
        return view('calendar.conventions.attendees')
            ->with('convention' , $this->active_convention )
            ->with('users' , $users );
    }

    public function schedule($id){
        $convention = Convention::find($id);
        return view('calendar.convention.schedule')->with('convention' , $convention);
    }

    

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin')){
            return view('calendar.convention.create');
        }
        abort(403, 'This action is unauthorized.');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required|max:140',
            'tagline'  => 'required|max:140',
            'start_date'=> 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'lead'  => 'required|max:350',
            'description'  => 'required|max:8000',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $convention = new Convention();
        $convention->title = $request->title;
        $convention->tagline = $request->tagline;
        $convention->start_date = date( 'Y-m-d', strtotime( $request->start_date ) );
        $convention->end_date = date( 'Y-m-d', strtotime( $request->end_date ) );
        $convention->lead = $request->lead;
        $convention->description = $request->description;
        $convention->status = 'inactive';
       
        $convention->save();

        return redirect('/calendar/conventions')->with('status', 'Convention Created');

    }

    public function edit($id){

        $convention = Convention::find($id);
        return view('calendar.convention.edit')->with('convention', $convention);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $validator = Validator::make($request->all(), [
            'title'  => 'required|max:140',
            'tagline'  => 'required|max:140',
            'status'  => 'max:10',
            'start_date'=> 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'lead'  => 'required|max:350',
            'description'  => 'required|max:8000',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $convention = Convention::find($id);
        $convention->title = $request->title;
        $convention->tagline = $request->tagline;
        $convention->status = $request->status;
        $convention->start_date = date( 'Y-m-d', strtotime( $request->start_date ) );
        $convention->end_date = date( 'Y-m-d', strtotime( $request->end_date ) );
        $convention->lead = $request->lead;
        $convention->description = $request->description;
       
        $convention->save();

        return redirect('/calendar/convention/' . $id . '/manage')->with('status', 'Changes Saved');
    }



     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $convention = Convention::find($id);

        if( Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin') ){
            if($convention->status == 'inactive') {
                $convention->delete();
                return redirect('/calendar/conventions')->with('status', 'Convention Deleted');
            }   
        }
            abort(403, 'This action is unauthorized.');

    }

    public function allGames($id){
        $convention = Convention::find($id);
        $games = Game::where('event_id' , $id)->orderBy('title', 'ASC')->get();
        return view('calendar.convention.game.index')->with('games' , $games)->with('convention', $convention);
        
    }

    public function pool($id) {
        if( Auth::user()->hasRole('organizer') ){
            $convention = Convention::find($id);
            $games = Game::where('event_id' , $id)->get();
            return view('calendar.convention.game.pool')->with('games' , $games)->with('convention' , $convention);
        }
        abort(403, 'This action is unauthorized.');
    }

    public function editGame($id)
    {   
        $game = Game::find($id);
        $convention = Convention::find($game->event_id);
        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('organizer')  ) {
            return view('calendar.convention.game.edit')->with('game' , $game)->with('convention' , $convention);
        }
        abort(403, 'This action is unauthorized.');
    }

    public function updateGame(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'title'  => 'required|max:140',
            'tagline'  => 'required|max:140',
            'system'  => 'max:140',
            'advisory'  => 'max:140',
            'min'=> 'required',
            'max' => 'required|gte:min|max:12',
            'lead'  => 'required|max:350',
            'description'  => 'required|max:4000',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1000',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $game = Game::find($id);
        //if the user selected an image to upload
        if($request->hasFile('image')){
            //see if they are using the default profile image, if not delete the old image
            if($game->image != 'default.jpg'){
                Storage::delete('public/uploads/game_images/' . $game->image);
            }          
            //set up the file extention, construct the path, then save the image to disk
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/uploads/game_images', $fileNameToStore);
            //add the new image name to the user model
            $game->image = $fileNameToStore;
         }

        
        $game->title = $request->title;
        $game->tagline = $request->tagline;
        $game->system = $request->system;
        $game->advisory = $request->advisory;
        $game->min = $request->min;
        $game->max = $request->max;
        $game->lead = $request->lead;
        $game->description = $request->description;
        $game->active = true ;
        $game->event_id = $request->event_id ;
        $game->save();
        $convention = Convention::find($request->event_id);
        return redirect('/calendar/convention/game/' . $game->id . '/schedule')->with('status', 'Changes Saved');
    }

    public function showGame($convention_id, $game_id) {
        $convention = Convention::find($convention_id);
        $game = Game::find($game_id);
        return view('calendar.convention.game.show')->with('game' , $game)->with('convention' , $convention);
    }

    public function gameSchedule($id) {
       
        $game = Game::find($id);
        $convention = Convention::find($game->event_id);
        return view('calendar.convention.game.schedule')->with('game' , $game)->with('convention' , $convention);
    }

    public function addToTimeslot(Request $request){
        $timeslot = Timeslot::find($request->timeslot);
        $convention = Convention::find($timeslot->convention_id);
        $game = Game::find($request->game);
        $member = User::find($game->user->id);
        
       if($member->gamesessions->where('timeslot_id' , $timeslot->id)->count()){
            $slot = $member->gamesessions->where('timeslot_id' , $timeslot->id)->first();
            $slot->attendees()->detach($member);
           
       }
        
        $timeslot->games()->attach($game);
        return redirect('/calendar/convention/game/' . $game->id . '/schedule')->with('game' , $game)->with('convention' , $convention);
    }

    public function removeFromTimeslot(Request $request){
        $timeslot = Timeslot::find($request->timeslot);
        $convention = Convention::find($timeslot->convention_id);
        $game = Game::find($request->game);
        $gamesession = $timeslot->gamesession($game);
        $gamesession->attendees()->detach();
        $timeslot->games()->detach($game);
        return redirect('/calendar/convention/game/' . $game->id . '/schedule')->with('game' , $game)->with('convention' , $convention);
    }

    public function deleteGame($id){
        $game = Game::find($id);
        $convention = Convention::find($game->event_id);
        if($game->timeslots->count()){
            foreach($game->timeslots as $timeslot){
                $gamesession = $timeslot->gamesession($game);
                $gamesession->attendees()->detach();
                $timeslot->games()->detach($game);
            }
        }
        $games = Game::where('event_id' , $game->event_id)->get();
        $game->delete();
        return redirect('calendar/convention/' . $convention->id . '/pool')->with('games', $games)->with('convention' , $convention)->with('status', 'game removed');

    }

    public function submitGame() {
        $member = Auth::user();
        $convention = Convention::where('status' , 'active')->first();
        return view('calendar.convention.game.submit')->with('member' , $member)->with('convention' , $convention);
    }

    public function submit(Request $request) {

        $game = Game::find($request->game_id);

        $submission = new Submission();
        $submission->convention_id = $request->convention_id;
        $submission->user_id = $request->user_id;
        $submission->game_id = $request->game_id;

        $submission->save();

        return redirect('calendar/convention/game/submit')->with('status' , 'Game Submitted');

    }

    public function submissions($id){
        if( Auth::user()->hasRole('organizer') ){
            $convention = Convention::find($id);
            return view('calendar.convention.game.submissions')->with('convention', $convention);
        }
        abort(403, 'This action is unauthorized.');
    }

    public function acceptSubmission(Request $request){
        if( Auth::user()->hasRole('organizer') ){

            $submission = Submission::find($request->submission_id);
            $convention = $submission->convention;
           
            $game = new Game();
            $game->title = $submission->game->title;
            $game->tagline = $submission->game->tagline;
            $game->system = $submission->game->system;
            $game->advisory = $submission->game->advisory;
            $game->min = $submission->game->min;
            $game->max = $submission->game->max;
            $game->lead = $submission->game->lead;
            $game->description = $submission->game->description;
            $game->active  = true ;
            $game->user_id = $submission->user->id;
            $game->event_id = $submission->convention->id;
            $game->parent_id = $submission->game->id;
            $game->save();
            $submission->delete();
            
            return redirect('/calendar/convention/game/' . $game->id . '/schedule')
            ->with('convention', $convention)
            ->with('game' , $game)
            ->with('status' , 'Game added to the convention game pool.');
        }
        abort(403, 'This action is unauthorized.');
    }

    public function rejectSubmission($id){
        if( Auth::user()->hasRole('organizer') ){

            $submission = Submission::find($id);
            $convention = $submission->convention;
            $submission->delete();

            return view('calendar.convention.game.submissions')->with('convention', $convention)->with('status' , 'Game removed ');
        }
        abort(403, 'This action is unauthorized.');
    }

    public function register($id){
        return view('calendar.convention.register');
    }

    public function registered(Request $request, $id){
        $convention = Convention::find($id);
        //dd($request);
        
        if($request('PayerID') ) {
            if($user = Auth::user())
            {
                if( ! $convention->attendees()->where('user_id' , Auth::user()->id)->count()){
                    $convention->attendees()->attach($user);
                }
            }
            return view('calendar.convention.registered')->with('convention' , $convention);
          } else {
            return view('calendar.convention.registration-error');
        };
    }

    public function cancelled($id){
        $convention = Convention::find($id);
        return view('calendar.convention.cancelled')->with('convention' , $convention);;
    }
}
