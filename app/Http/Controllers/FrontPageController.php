<?php

namespace App\Http\Controllers;

use App\User;
use App\BlogPost;
use App\BlogCategory;
use App\Role;
use App\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        $frontpage = ''; $lead = null ; $featured = null;
            if($frontpage = Page::where('title' , 'Front Page')->first()) {
                $lead = BlogPost::find($frontpage->lead_article);
                $featured = BlogPost::find($frontpage->featured_article);
            }
            
           
            $posts = BlogPost::orderByDesc('posted_on')->get();
           
            $posts = $posts->reject(function($posts) {
                return $posts->posted_on == null;
            });
        
        if (Cookie::get('visited') !== null){
            return view('home')
                ->with('posts' , $posts)
                ->with('lead' , $lead)
                ->with('featured' , $featured); 
        } else {
            return redirect('welcome')->cookie('visited','true' , 280060);           
        }

        

    }

    public function update(Request $request)
    {
        if(  Auth::user()->hasRole('admin')|| Auth::user()->hasRole('organizer') ){

            $frontpage = Page::where('title' , 'Front Page')->first();
            if( $request->input('type') == 'lead' ) {
                $frontpage->lead_article = $request->input('article');
                $frontpage->save();
                $status = 'Set as the lead article on the front page';
            }

            if( $request->input('type') == 'featured' ) {
                $frontpage->featured_article = $request->input('article');
                $frontpage->save();
                $status = 'Set as the featured article on the front page';
            }

        return redirect("/post/" . $request->input('article'))->with('status', $status); 
            
        }
        abort(403, 'This action is unauthorized.');
    }

    public function landing(){
        $frontpage = ''; $lead = null ; $featured = null;
        if($frontpage = Page::where('title' , 'Front Page')->first()) {
            $lead = BlogPost::find($frontpage->lead_article);   
        }
        return view('landing')->with('lead', $lead);
    }

    public function home(){
        return $this->checkCookie();
    }

    public function about(){
        return view('about');
    }

    public function codeofconduct(){
        return view('codeofconduct');
    }
    
}
