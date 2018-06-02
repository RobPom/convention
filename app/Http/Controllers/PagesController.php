<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Request;
use Redirect;
use Cookie;
use DB;



class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('dashboard');
    }


    /**
     *  default home page
     *
     * @return \Illuminate\Http\Response
     */

    public function home()
    {
        return view('home');
    }

    /**
     * A landing page for first time visitors
     *
     * @return \Illuminate\Http\Response
     */

    public function checkCookie()
    {
        if (Cookie::get('visited') !== null){
            return view('home');
        }
        
        return redirect('welcome')->cookie('visited','true' , 280060);

    }

    public function welcome(){
        return view('welcome');
    }

    
}
