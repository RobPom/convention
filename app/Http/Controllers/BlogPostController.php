<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use Purifier;
use Carbon\Carbon;
use App\BlogPost;
use App\BlogCategory;
use App\User;
use App\Page;

class BlogPostController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show', 'latest', 'categoryIndex',  'userPosts']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPost::orderByDesc('posted_on')->whereNotNull('posted_on')->paginate(6);
        $categories = BlogCategory::orderBy('title')->get();
        return view ('blog.index')
            ->with('posts' , $posts)
            ->with('categories' , $categories)
            ->with('pagetitle' , 'Latest Posts');
    }

    public function categoryIndex( $id )
    {
     
        $category = BlogCategory::find($id); 
        $posts = BlogPost::where('category' , $category->id)->whereNotNull('posted_on')->orderBy('posted_on', 'DESC')->paginate(6);   
        $categories = BlogCategory::orderBy('title')->get();
       
        return view ('blog.index')
            ->with('category' , $category)
            ->with('categories' , $categories)
            ->with('posts' , $posts )
            ->with('pagetitle' , $category->title);
    }

    public function userPosts($id){
        $member = User::find($id);
        $posts = BlogPost::orderByDesc('posted_on')->where('user_id' , $id)->whereNotNull('posted_on')->paginate(6);
        $categories = BlogCategory::orderBy('title')->get();
        return view('blog.index')
            ->with('posts' , $posts)
            ->with('categories' , $categories)
            ->with('pagetitle' , 'Posts by '. $member->firstname. ' '. $member->lastname);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin')) {
            $categories = BlogCategory::orderBy('title')->get();
            return view('blog.create')->with('categories' , $categories);
        }
        abort(403, 'This action is unauthorized.');
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
            'title'  => 'required|max:255',
            'lead'  => 'max:255',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $user = User::find(Auth::id());

        $post = new BlogPost();
        $post->title = $request->title;
        $post->lead = $request->lead;
        $post->body = Purifier::clean($request->body);
        $post->category = $request->category;
        $post->user_id = $user->id;
        $post->save();

        return redirect('post/' . $post->id)->with('status', 'Post Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show( $post_id )
    {
        $post = BlogPost::find($post_id);
        if($post->posted_on  === null ){
            if(Auth::guest()) {
                abort(403, 'This action is unauthorized.');
            } else {
                if(Auth::user()->id != $post->user->id){
                    abort(403, 'This action is unauthorized.');
                }
            }
        }
        $category = BlogCategory::find($post->category);
        $categories = BlogCategory::orderBy('title')->get();
        $frontpage = Page::where('title' , 'Front Page')->first();

        //dd($category);
        return view('blog.show')
            ->with('post' , $post)
            ->with('category' , $category)
            ->with('categories' , $categories)
            ->with('frontpage' , $frontpage);
    }


    public function latest()
    {
        $posts = BlogPost::whereNotNull('posted_on')->orderBy('posted_on', 'DESC')->take(5)->get();

        //dd($category);
        return view('blog.latest')
            ->with('posts' , $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $blogPost = BlogPost::find($id);
        if(Auth::user()->hasRole('admin') || Auth::user()->id == $blogPost->user->id ) {
            $categories = BlogCategory::orderBy('title')->get();
            return view('blog.edit')->with('blogPost', $blogPost)->with('categories' , $categories);
        }
        abort(403, 'This action is unauthorized.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        $validator = Validator::make($request->all(), [
            'title'  => 'required|max:255',
            'lead'  => 'max:255',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $blogPost = BlogPost::find($id);

        $blogPost->title = $request->title;
        $blogPost->lead = $request->lead;
        $blogPost->body = Purifier::clean($request->body);
        $blogPost->category = $request->category;
        $blogPost->save();

        return redirect('post/' . $blogPost->id)->with('status', 'Post Updated');
    }

    public function publish(Request $request, $id)
    {
        $blogPost = BlogPost::find($id);
        $blogPost->posted_on = Carbon::now()->toDateTimeString();
        $blogPost->save();
        return redirect('post/' . $blogPost->id)->with('status', 'Post Published');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $blogPost = BlogPost::find($id);

        if( Auth::user()->id == $blogPost->user->id ||  Auth::user()->hasRole('admin') ){
            $blogPost->delete();
            return redirect('/profile/show/'. $blogPost->user->id)->with('status', 'Post Deleted');
        }
        
            abort(403, 'This action is unauthorized.');
        
    }
}
