<?php

namespace App\Http\Controllers\Calendar;

use App\Convention;
use App\User;
use App\Submission;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConventionController extends Controller
{
    private $active_convention;
    
    public function __construct()
    {
        $this->active_convention = Convention::where('status' , 'active')->first();
        $this->middleware('auth')->except('show' , 'index');
    }

    public function index() {
        $conventions = Convention::all();
        return view('calendar.convention.index')->with('conventions' , $conventions);

    }
    public function show($id) {
        $convention = Convention::find($id);
        return view('calendar.convention.show')->with('convention' , $convention);
    }

    //shows the active convention, it will take the first if more than one is active.

    public function showActive()
    {
        if( $this->active_convention ) {
            return view('calendar.conventions.show')->with('convention' , $this->active_convention );
        }

        abort(403, 'No conventions scheduled.'); 
    }

    public function attendees()
    {
        if(Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin')){
            $users = User::all();
            return view('calendar.conventions.attendees')
                ->with('convention' , $this->active_convention )
                ->with('users' , $users );

        } else {
            abort(403, 'Not Authorized.');   
        }
        
    }

    public function storeAttendees(Request $request)
    {
        $users = User::all();
        $this->active_convention->attendees()->sync($request->attending);
        return view('calendar.conventions.attendees')
            ->with('convention' , $this->active_convention )
            ->with('users' , $users );
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.conventions.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required|max:140',
            'tagline'  => 'required|max:140',
            'start_date'=> 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'lead'  => 'required|max:350',
            'description'  => 'required|max:2000',
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

        return redirect('/organizer')->with('status', 'Convention Created');

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

        if( Auth::user()->hasRole('organizer') ){
            $convention->delete();
            return redirect('/organizer')->with('status', 'Convention Deleted');
        }
        
            abort(403, 'This action is unauthorized.');
        

    }

    public function submitGame() {
        $member = Auth::user();
        $convention = Convention::where('status' , 'active')->first();
        return view('calendar.conventions.games.submit')->with('member' , $member)->with('convention' , $convention);
    }

    public function submit(Request $request) {
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
            return view('calendar.conventions.games.submissions')->with('convention', $convention);
        }
        abort(403, 'This action is unauthorized.');
    }

    public function acceptSubmission(Request $request){
        if( Auth::user()->hasRole('organizer') ){

            $submission = Submission::find($request->submission_id);
            dd($submission->game);
            //return view('calendar.conventions.games.submissions')->with('convention', $convention);
        }
        abort(403, 'This action is unauthorized.');
    }

    public function rejectSubmission($id){
        if( Auth::user()->hasRole('organizer') ){

            $submission = Submission::find($id);
            $convention = $submission->convention;
            $submission->delete();

            return view('calendar.conventions.games.submissions')->with('convention', $convention)->with('status' , 'Game removed ');
        }
        abort(403, 'This action is unauthorized.');

    }
}
