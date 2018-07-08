<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use App\User;
use Purifier;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPost::orderByDesc('posted_on')->get();
        $categories = BlogCategory::orderBy('title')->get();
        return view ('blog.index')->with('posts' , $posts)->with('categories' , $categories);
    }

    public function categoryIndex( $id )
    {
        $user = Auth::user();
        if($id == 0) {
            $category = new BlogCategory();
            $category->title = 'unpublished';
            $posts = BlogPost::whereNull('posted_on')->get();
        } else {
            $category = BlogCategory::find($id); 
            $posts = BlogPost::where('category' , $category->id)->whereNotNull('posted_on')->orderBy('posted_on', 'DESC')->get();   
        }
        
        $categories = BlogCategory::orderBy('title')->get();
       
        return view ('blog.categories.index')
            ->with('category' , $category)
            ->with('categories' , $categories)
            ->with('posts' , $posts )
            ->with('user' , $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategory::orderBy('title')->get();
        return view('blog.create')->with('categories' , $categories);
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

        return redirect('post/' . $post->id);
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
        $category = BlogCategory::find($post->category);
        $categoryPosts = BlogPost::where('category' , $category->id)->whereNotNull('posted_on')->orderBy('posted_on', 'DESC')->get();

        //dd($category);
        return view('blog.show')
            ->with('post' , $post)
            ->with('category' , $category)
            ->with('categoryPosts' , $categoryPosts);
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
    public function edit(BlogPost $blogPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        //
    }
}
