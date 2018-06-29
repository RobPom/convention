<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\BlogCategory;
use Illuminate\Http\Request;

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
        $category = BlogCategory::find($id);
        $categories = BlogCategory::orderBy('title')->get();
        $posts = BlogPost::where('category' , $category->id)->orderBy('posted_on', 'DESC')->get();
        return view ('blog.categories.index')
            ->with('category' , $category)
            ->with('categories' , $categories)
            ->with('posts' , $posts );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $categoryPosts = BlogPost::where('category' , $category->id)->orderBy('posted_on', 'DESC')->get();

        //dd($category);
        return view('blog.show')
            ->with('post' , $post)
            ->with('category' , $category)
            ->with('categoryPosts' , $categoryPosts);
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
