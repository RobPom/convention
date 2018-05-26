<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        $users = DB::table('users')->where('id', '!=', Auth::id())->get();

        $role = $user->roles()->first()->name;
        return view('dashboard')
            ->with('user', $user)
            ->with('users', $users);
    }
}
