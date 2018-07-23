<?php

namespace App\Http\Controllers;

use App\User;
use App\BlogPost;
use App\BlogCategory;
use App\Role;
use App\Page;
use Illuminate\Support\Facades\Auth;
use Request;
use Redirect;
use Cookie;
use DB;



class FrontPageController extends Controller
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
     * A landing page for first time visitors
     *
     * @return \Illuminate\Http\Response
     */

    public function checkCookie()
    {
        if (Cookie::get('visited') !== null){

            $frontpage = Page::where('title' , 'Front Page')->first();
            $lead = BlogPost::find($frontpage->lead_article);
            $featured = BlogPost::find($frontpage->featured_article);
           
            $posts = BlogPost::orderByDesc('posted_on')->get();;
           
            $posts = $posts->reject(function($posts) {
                return $posts->posted_on == null;
            });

            return view('home')
                ->with('posts' , $posts)
                ->with('lead' , $lead)
                ->with('featured' , $featured); 
        }
        
        return redirect('welcome')->cookie('visited','true' , 280060);

    }

    public function welcome(){
        return view('welcome');
    }
    
}
