<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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

    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the user dashboard
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
        $user = Auth::user();

        return view('dashboard')->with('user', $user);

    }
}
