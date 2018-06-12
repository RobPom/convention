<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the user profile
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $member = User::find($id);
        $user = Auth::user();
        return view('profile.show')
            ->with('user', $user)
            ->with('member', $member);
    }

    public function user()
    {
        $user = Auth::user();
        return view('profile.user')->with('user', $user);
    }


    /**
     * Show the user dashboard
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
        $user = Auth::user();

        $members = User::whereHas('roles', function($query)
                        { $query->where('name', 'like', 'member'); }
                    ) ->get();

        $organizers = User::whereHas('roles', function($query)
            { $query->where('name', 'like', 'organizer'); }
        ) ->get();

        return view('profile.dashboard')
            ->with('user', $user)
            ->with('members', $members)
            ->with('organizers', $organizers);
    }



     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $user = Auth::user();
        $member = User::find($id); 
        return view('profile.edit')
            ->with('user', $user)
            ->with('member' , $member);
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
        $member = USER::find($id);
       
        $this->validate($request, [
            'firstname'  => 'required|alpha|max:50',
            'lastname'  => 'required|alpha|max:50',
            'location'  => 'max:50',
            'description'  => 'max:144',
        ]);

       
        $member->firstname = $request->input('firstname');
        $member->lastname = $request->input('lastname');
        $member->save();
        if( Profile::where('user_id', $member->id )->first()){
            $profile = Profile::where('user_id', $member->id )->first();
            $profile->delete();
        }

        $profile = new Profile();
        $profile->location = $request->input('location');
        $profile->description =  $request->input('description');
       
        $member->profile()->save($profile);
        
      
        
       /*  dd($member);
        return redirect('/events/'. $member->id)->with('success', 'profile updated');
 */
        return redirect('/profile/show/'.$member->id)->with('success', 'profile updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        
        if($event->event_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/event_images/' . $event->event_image);
        }
        
        $event->delete();
        return redirect('/events')->with('success', 'Event Removed');
    }




}
