<?php

namespace App\Http\Controllers;

use App\Game;
use App\Submission;
use App\Convention;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Redirect;

class GameController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unscheduled($id)
    {
        $convention = Convention::find($id);
        $games = $convention->games()->doesntHave('timeslots')->get();
  
        return view('calendar.convention.game.unscheduled')->with('convention' , $convention)->with('games' , $games);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('games.create');
    }

    public function createAttendeeGame($convention_id, $user_id)
    {
        $convention = Convention::find($convention_id);
        $member = User::find($user_id);
        return view('calendar.convention.game.create')
            ->with('convention' , $convention)
            ->with('member' , $member);
    }

    public function storeAttendeeGame(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required|max:140',
            'tagline'  => 'required|max:140',
            'system'  => 'max:140',
            'advisory'  => 'max:140',
            'min'=> 'required',
            'max' => 'required|gte:min|max:12',
            'lead'  => 'required|max:350',
            'description'  => 'required|max:2000',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $usergame = new Game();
        $usergame->title = $request->title;
        $usergame->tagline = $request->tagline;
        $usergame->system = $request->system;
        $usergame->advisory = $request->advisory;
        $usergame->min = $request->min;
        $usergame->max = $request->max;
        $usergame->lead = $request->lead;
        $usergame->description = $request->description;
        $usergame->active  = true ;
        $usergame->user_id = $request->user;
        $usergame->save();

        $conventiongame = new Game();
        $conventiongame->title = $request->title;
        $conventiongame->tagline = $request->tagline;
        $conventiongame->system = $request->system;
        $conventiongame->advisory = $request->advisory;
        $conventiongame->min = $request->min;
        $conventiongame->max = $request->max;
        $conventiongame->lead = $request->lead;
        $conventiongame->description = $request->description;
        $conventiongame->active  = true ;
        $conventiongame->user_id = $request->user;
        $conventiongame->event_id = $request->convention;
        $conventiongame->parent_id = $usergame->id;
        $conventiongame->save();

        return redirect('/calendar/convention/' . $request->convention. '/attendee/' . $request->user)->with('status', 'Game Created');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required|max:140',
            'tagline'  => 'required|max:140',
            'system'  => 'max:140',
            'advisory'  => 'max:140',
            'min'=> 'required',
            'max' => 'required|gte:min|max:12',
            'lead'  => 'required|max:350',
            'description'  => 'required|max:2000',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $game = new Game();
        $game->title = $request->title;
        $game->tagline = $request->tagline;
        $game->system = $request->system;
        $game->advisory = $request->advisory;
        $game->min = $request->min;
        $game->max = $request->max;
        $game->lead = $request->lead;
        $game->description = $request->description;
        $request->active ?  $game->active = false : $game->active = true ;
        $game->user_id = Auth::user()->id;
        $game->save();

        return redirect('/profile?tab=games')->with('status', 'Game Created');

    }

   /*  public function copy($id){
        $oldGame = Game::find($id);
        $game = new Game();
        $game->title = "Copy of " .  $oldGame->title ;
        $game->tagline = $oldGame->tagline;
        $game->system = $oldGame->system;
        $game->advisory = $oldGame->advisory;
        $game->min = $oldGame->min;
        $game->max = $oldGame->max;
        $game->lead = $oldGame->lead;
        $game->description = $oldGame->description;
        $game->active =  false;
        $game->user_id = Auth::user()->id;
        $game->save();

        return redirect('/profile?tab=games')->with('status', 'A Copy of the game has been saved');
    }
 */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::find($id);
        return view('profile.member.game')->with('game' , $game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game::find($id);
        return view('games.edit')->with('game' , $game);
    }

    public function editAttendeeGame($id)
    {
        $game = Game::find($id);
        return view('calendar.convention.games.edit')->with('game' , $game);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required|max:140',
            'tagline'  => 'required|max:140',
            'system'  => 'max:140',
            'advisory'  => 'max:140',
            'min'=> 'required',
            'max' => 'required|gte:min|max:12',
            'lead'  => 'required|max:350',
            'description'  => 'required|max:2000',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $game = Game::find($id);
        $game->title = $request->title;
        $game->tagline = $request->tagline;
        $game->system = $request->system;
        $game->advisory = $request->advisory;
        $game->min = $request->min;
        $game->max = $request->max;
        $game->lead = $request->lead;
        $game->description = $request->description;
        $request->active ?  $game->active = true : $game->active = false ;
        $game->save();

        return redirect('/profile?tab=games')->with('status', 'Changes Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $game = Game::find($id);
        $submissions = Submission::where('game_id' , $game->id)->get();

        if( Auth::user()->id == $game->user->id ||  Auth::user()->hasRole('organizer') ){
            foreach($submissions as $submission){
                $submission->delete();
            }
            $game->delete();
            return redirect('profile?tab=games')->with('status', 'Game Deleted');
        }
        
            abort(403, 'This action is unauthorized.');
    }
}
