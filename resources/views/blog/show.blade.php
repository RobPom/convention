@extends('layouts.app')

@section('content')

<div class='card border-0'>
    <div class='card-body'>
        <h3>{{$post->title}}</h3>
        <hr class="my-3">
        <div class="row">
            <div class="col-md-8">        
              
                <span class="small text-muted">
                    {{$post->datePosted()}}
                </span>

                <h5> {{$post->title}} </h5>
                
                <h5 class="small mt-2">
                    @if(Request::segment(2) != 'user')
                        <span class="mr-4">
                            <strong>Author: </strong>
                            <a href="/posts/user/{{$post->user->id}}" >
                                {{$post->user->firstname}} {{$post->user->lastname}}
                            </a>
                        </span>
                    @endif

                    @if(Request::segment(2) != 'category') 
                        <strong>Category: </strong>
                        <a href="/posts/category/{{$post->category}}">
                            {{$categories->find($post->category)->title}}
                        </a>
                    @endif

                    
                </h5>

                <p class='my-4 lead'>{{$post->lead}}</p>

                <p>{!!$post->body!!}</p>

                
                <div class="card border-0">
                    
                    <div class="card-body text-center">
                        <div class="btn-group" role="group" aria-label="Edit Buttons">
                            @if(!$post->published())
                                @auth
                                    @if(Auth::user()->id == $post->user->id)
                                    <form 
                                        onsubmit="return confirm('Publish Post? (You will only be able to edit, not delete a post once it\'s published)');"
                                        action="{{action('BlogPostController@publish', $post->id)}}" 
                                        method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-success mx-1" type="submit">Publish</button>
                                    </form>
                                    @else
                                    
                                        <strong>Not Published</strong>
                                        
                                    @endif
                                    
                                @endauth
                            @endif

                            @auth
                                @if(Auth::user()->id == $post->user->id)
                                    <a href="/post/{{$post->id}}/edit" class="btn btn-sm btn-primary mb-1 d-inline-block">edit</a>
                                    @if(! $post->published())
                                    <form 
                                        onsubmit="return confirm('You cannot undo this. Are you sure you want to delete this post?');"
                                        action="{{action('BlogPostController@destroy', $post->id)}}" 
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger mx-1 " type="submit">Delete</button>
                                    </form>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
                
                
                    
            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">
                        Categories
                    </div>
                    <div class="card-body">
                        @if(Request::segment(2) == null)
                            <a href="/posts" >
                                <div class="mb-2 btn disabled text-muted p-0">Latest</div>
                            </a> <br>
                        @else
                            <a href="/posts" >
                                <div class="mb-2">Latest</div>
                            </a>
                        @endif
                        @foreach($categories as $category)                          
                            
                            @if(App\BlogPost::where('category' , $category->id)->where('posted_on', '!=', NULL)->count() && $category->title != 'Uncategorized') 
                                <a href="/posts/category/{{$category->id}}">
                                    {{$category->title}}
                                </a> <br>
                            @endif
                           
                        @endforeach
                    </div>
                </div>

                @auth
                    @if(Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin'))

                    <div class="card my-3">
                        <div class="card-header text-white bg-success ">
                                Front Page 
                        </div>
                        <div class="card-body">
                            <div class="row">
                                
                                    @if($frontpage->lead_article == $post->id)
                                        <div class="col">
                                            This is the lead article.
                                        </div>
                                    @else
                                        <div class="col">
                                            Lead
                                        </div>
                                        <div class="col text-right">
                                            <form method="POST" action="{{ action('FrontPageController@update' , $post->id) }}">
                                                @method('PATCH')
                                                @csrf
                                                <input type="hidden" id="type" name="type" value="lead">
                                                <input type="hidden" id="article" name="article" value="{{$post->id}}">
                                                <button type="submit" class="btn btn-danger btn-sm" style="display: inline;" >Set</button>
                                            </form>
                                        </div>
                                    @endif
                               
                            </div>
                            <div class="row mt-2">
                                
                                    @if($frontpage->featured_article == $post->id)
                                        <div class="col-12">
                                            This is the featured article.
                                        </div>
                                    @else
                                        <div class="col">
                                            Featured
                                        </div>
                                        <div class="col text-right">
                                            <form method="POST" action="{{ action('FrontPageController@update' , $post->id) }}">
                                                @method('PATCH')
                                                @csrf
                                                <input type="hidden" id="type" name="type" value="featured">
                                                <input type="hidden" id="article" name="article" value="{{$post->id}}">
                                                <button type="submit" class="btn btn-danger btn-sm" >Set</button>
                                            </form>
                                        </div>
                                    @endif

                                
                            </div>

                           
                        </div>
                    </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>





@endsection