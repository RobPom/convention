<?php

namespace App\Http\Controllers;

use App\User;
use App\BlogPost;
use App\BlogCategory;
use App\Role;
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
           
            $posts = BlogPost::all()->sortByDesc('posted_on');
           

            $posts = $posts->reject(function($posts) {
                return $posts->posted_on == null;
            });

            
            return view('home')
                ->with('posts' , $posts); 
        }
        
        return redirect('welcome')->cookie('visited','true' , 280060);

    }

    public function welcome(){
        return view('welcome');
    }
    
}
