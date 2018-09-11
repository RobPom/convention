@extends('layouts.app')

@section('content')

<div class="card p-2 border-0">
    <div class="card-header bg-white">
        @include('profile.member.header')
    </div>
    <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item">
                        <!-- <a href="/calendar/convention/{{$convention->id}}">Convention</a> -->
                    </li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Schedule</li> -->
                </ol>
            </nav>
        <div class="card">
            <div class="card-header">
                <strong>Profile </strong>
            </div>
            <div class="card-body">
                <div class="card-title">
                    <strong class='d-block' >Member Info</strong>  
                    @auth
                        @if( $user->id == $member->id )
                            <a href="/profile/{{$user->id}}/edit" class="mt-2 btn btn-sm btn-primary ">Edit</a>
                        @endif
                    @endauth
                </div>
                <p>
                    <strong>About: </strong>{{$member->profile->description}} <br>
                    @auth
                        @if( $user->id == $member->id ||$user->hasRole('organizer') ||  $user->hasRole('admin') )
                            <strong>Full Name:</strong> {{$member->firstname}} {{$member->lastname}}<br>
                        @endif
                        <strong>Email: </strong>{{$member->email}} <br>
                        <strong>Location: </strong> {{$member->profile->location}} <br>
                        <strong>Joined: </strong>  {{ (new \Carbon\Carbon($member->created_at))->toFormattedDateString() }} <br>
                    @endauth
                </p>    
                    
                

            @if($member->hasRole('organizer'))

                @php
                    $unpublished = DB::table('blog_posts')->where('user_id' , $member->id)->whereNull('posted_on')->get();
                @endphp
            
               

                <hr>
                <div class="card-title">
                    <strong>Posts</strong>
                </div>
                @if($member->blogPosts()->whereNotNull('posted_on')->count())
                    <a href="/profile/{{$member->id}}/posts"">
                    {{$member->blogPosts()->whereNotNull('posted_on')->count()}} Published</a><br>
                @endif

                @auth
                    @if(Auth::user()->hasRole('organizer') && Auth::user()->id == $member->id)
                        @if($unpublished->count())    
                        <a href="/profile/{{$member->id}}/unpublished">
                            {{$unpublished->count()}} Unpublished</a><br>
                        @endif
                        <a href="/posts/new">Create a new post</a> <br>
                    @endif
                @endauth
                
            @endif
            
            <hr>
                <div class="card-title">
                    <strong>Games</strong>
                </div>
            @if($member->games->count())
            <a href="/profile/{{$member->id}}/games">
                {{$member->games->count()}} Games </a><br>
            @endif

            @auth
                @if($member->id == Auth::user()->id)
                    <a href="/games/new" >Create a new Game</a>
                @endif
            @endauth

            

            
    
    </div>
</div>

@endsection
