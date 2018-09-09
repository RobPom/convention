@extends('layouts.app')

@section('content')

<div class='card border-0'>
    <div class='card-body'>
        <h3>{{$pagetitle}}</h3>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-8">        
                @foreach($posts as $post)
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

                    <p class='mt-3'>{{$post->lead}}</p>

                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="/post/{{$post->id}}" class="btn btn-sm btn-primary">Read More</a>
                        </div>
                    </div>
                    
                    <hr class="m-4">
                    
                @endforeach
                {{ $posts->links() }}
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
                           
                            @if(Request::segment(2) == 'category' && Request::segment(3) == $category->id) 
                            <a href="/posts/category/{{$category->id}}"  class="btn disabled text-muted p-0">
                                {{$category->title}}
                            </a> <br>
                            @else
                            <a href="/posts/category/{{$category->id}}">
                                {{$category->title}}
                            </a> <br>
                            @endif
                            
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection