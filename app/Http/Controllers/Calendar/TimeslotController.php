<?php

namespace App\Http\Controllers\Calendar;
use App\Convention;
use App\Timeslot;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Controllers\Controller;

class TimeslotController extends Controller
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
    
    public function manage($id){
        $convention = Convention::find($id);
        return view('calendar.convention.manage')->with('convention' , $convention);
    }

    public function add($id){
        $convention = Convention::find($id);
        return view('calendar.timeslots.create')->with('convention' , $convention);
    }

    public function edit($id){

        $timeslot = Timeslot::find($id);
        return view('calendar.timeslots.edit')->with('timeslot', $timeslot);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'title'  => 'required|max:140',
            'start_time'=> 'required',
            'end_time' => 'required',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $timeslot = new Timeslot();
        $timeslot->title = $request->title;
        $timeslot->start_time = $request->day .' '. $request->start_time;
        $timeslot->end_time = $request->day .' '. $request->end_time;
        if($request->convention) {
            $timeslot->convention_id = $request->convention;
        }

        $timeslot->save();

        if($request->convention) {
            $convention = Convention::find($timeslot->convention_id);
            return redirect('/calendar/convention/' . $convention->id . '/timeslots')
            ->with('convention' , $convention)
            ->with('status', 'Time Slot Created');
        }   
    }

    public function update(Request $request, $id)
    {        
        $validator = Validator::make($request->all(), [
            'title'  => 'required|max:140',
            'start_time'=> 'required',
            'end_time' => 'required',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $timeslot = Timeslot::find($id);
        $convention = Convention::find($timeslot->convention_id);

        $timeslot->title = $request->title;
        $timeslot->start_time = $request->day .' '. $request->start_time;
        $timeslot->end_time = $request->day .' '. $request->end_time;
        $timeslot->convention_id = $request->convention;

        $timeslot->save();

        return redirect('/calendar/convention/' . $convention->id . '/timeslots')
        ->with('convention' , $convention)
        ->with('status', 'Timeslot Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    
        $timeslot = Timeslot::find($id);
        $convention = Convention::find($timeslot->convention_id);

        if( Auth::user()->hasRole('organizer') ){
            $timeslot->delete();
            return redirect('/calendar/convention/' . $convention->id . '/timeslots')
            ->with('convention' , $convention)
            ->with('status', 'Time Slot Deleted');
        }
            abort(403, 'This action is unauthorized.');
        
    }

    public function addEvent($id){
        $convention = Convention::find($id);
        return view('calendar.events.create')->with('convention' , $convention);
    }

    public function editEvent($id){

        $timeslot = Timeslot::find($id);
        return view('calendar.events.edit')->with('timeslot', $timeslot);
    }

    public function storeEvent(Request $request) {

        $validator = Validator::make($request->all(), [
            'title'  => 'required|max:140',
            'start_time'=> 'required',
            'end_time' => 'required',
            'description'  => 'max:1000',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $timeslot = new Timeslot();
        $timeslot->title = $request->title;
        $timeslot->start_time = $request->day .' '. $request->start_time;
        $timeslot->end_time = $request->day .' '. $request->end_time;
        $timeslot->accept_games = false;
        if($request->convention) {
            $timeslot->convention_id = $request->convention;
        }
        if($request->description) {
            $timeslot->description = $request->description;
        }

        $timeslot->save();

        if($request->convention) {
            $convention = Convention::find($timeslot->convention_id);
            return redirect('/calendar/convention/' . $convention->id . '/manage')
            ->with('convention' , $convention)
            ->with('status', 'Event Slot Created');
        }   
    }

    public function updateEvent(Request $request, $id)
    {        
        $validator = Validator::make($request->all(), [
            'title'  => 'required|max:140',
            'start_time'=> 'required',
            'end_time' => 'required',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $timeslot = Timeslot::find($id);
        $convention = Convention::find($timeslot->convention_id);

        $timeslot->title = $request->title;
        $timeslot->start_time = $request->day .' '. $request->start_time;
        $timeslot->end_time = $request->day .' '. $request->end_time;
        $timeslot->convention_id = $request->convention;

        $timeslot->save();

        return redirect('/calendar/convention/' . $convention->id . '/timeslots')
        ->with('convention' , $convention)
        ->with('status', 'Timeslot Saved');
    }

}
