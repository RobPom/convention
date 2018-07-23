<?php

namespace App\Http\Controllers\Calendar;

use App\Convention;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConventionController extends Controller
{
    //shows the active convention, it will take the first if more than one is active.
    public function show(){
        $con = Convention::where('status' , 'active')->first();
        return view('calendar.conventions.show')->with('convention' , $con );
    }
}
