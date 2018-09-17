@extends('layouts.app')

@section('content')

<div class="card p-2 border-0">
    <div class="card-header bg-white border-0">
            @include('profile.member.header')
    </div>
    <div class="card-body">
        <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item">
                        <a href="/profile/show/{{$member->id}}">Profile</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{$pagename}}</li>
                </ol>
            </nav>
        <div class="card">
            <div class="card-header">
                <strong>{{$pagename}}</strong>
            </div>
            <div class="card-body">
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
                
            @auth
                @if(Auth::user()->id == $post->user->id)
                <div class="text-right">
                    <a href="/posts/new" class="mt-2 btn btn-sm btn-secondary">New</a>
                </div>
                @endif
            @endauth
            {{ $posts->links() }}
        </div>
    </div>
</div> 

@endsection