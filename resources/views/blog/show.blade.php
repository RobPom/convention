@extends('layouts.app')

@section('content')

<div class="card">
        
              
    <div class="card-body">
        <div class='row'>
            <div class="col-lg-9">
                <h6><small><a href='/posts/category/{{$category->id}}'>{{$category->title}} </a>
                     {{$post->published() ?  ' - ' . $post->datePostedString() : ''}}</small></h6>
                <h3>{{$post->title}}</h3>
                
                @if(  !$post->published())
                    <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Unpublished. </h4>
                            <p>This post is unpublished. Once it is published you will still be able to edit, but not delete the post.</p>

                        <form 
                            onsubmit="return confirm('Publish Post?');"
                            action="{{action('BlogPostController@publish', $post->id)}}" 
                            method="post">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-outline-success" type="submit">Publish</button>
                        </form>


                    </div>
                @endif

                @auth
                    @if(Auth::user()->id =- $post->user->id)
                        <a href="/post/{{$post->id}}/edit" class="btn btn-sm btn-primary">edit</a>
                        @if(! $post->published())
                             <form 
                            onsubmit="return confirm('You cannot undo this. Are you sure you want to delete this post?');"
                            action="{{action('BlogPostController@destroy', $post->id)}}" 
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                        @endif
                    @endif
                @endauth
                <hr>
                <p class="lead">{{$post->lead}}</p>
                <p>{!! $post->body !!}</p>
                
                <br>
                <hr>

                @include('layouts.include.memberblock')

                <hr class="d-lg-none">
            </div>
            <br>
            <div class="col">
                <br>
                    <h5>Latest {{$category->title}}</h5>
                    <br>
                @if($categoryPosts->count() > 1)
                    
                    <ul class='archiveList'>
                        @foreach($categoryPosts as $categoryPost)
                            @if($categoryPost->id !== $post->id)
                                <li> {{$categoryPost->shortDate()}} - <a href='/post/{{$categoryPost->id}}'>{{$categoryPost->title}}</a></li>
                            @endif
                        @endforeach
                    </ul>

                @else
                    <p>No other {{$category->title}} in archives.</p>
                    
                @endif
                    <br>
                    <a href="/posts" class='float-right'>Post Archives</a>
            </div>
    </div>
</div>



@endsection