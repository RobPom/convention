<?php

namespace App\Http\Controllers\Calendar;

use App\Convention;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConventionController extends Controller
{
    private $active_convention;
    
    public function __construct()
    {
        $this->active_convention = Convention::where('status' , 'active')->first();
        $this->middleware('auth')->except('show');
    }

    //shows the active convention, it will take the first if more than one is active.

    public function show()
    {
        return view('calendar.conventions.show')->with('convention' , $this->active_convention );
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

}
