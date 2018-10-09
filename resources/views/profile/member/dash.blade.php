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
                       
                    </li>
                   
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
                            <strong>Email: </strong>{{$member->email}} <br>
                            <strong>Location: </strong> {{$member->profile->location}} <br>
                        @endif
                        
                        
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
                    <strong>Game Library</strong>
                </div>
            @if($member->games->where('event_id' , 0 )->count())
            <a href="/profile/{{$member->id}}/games">
                {{$member->games->where('parent_id' , 0 )->count()}} Games </a><br>
            @endif

            @auth
                @if($member->id == Auth::user()->id)
                    <a href="/games/new" >Add a Game</a>
                @endif
            @endauth

            @if( $member->games->where('event_id','!=', 0)->count() )
                <hr>
                <div class="card-title">
                    <strong>Game Sessions</strong>
                </div>

                @foreach($member->games->where('event_id','!=', 0)->unique('event_id') as $con)
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <strong>{{App\Convention::find($con)->first()->title}}</strong>
                        </div>
                        
                        @foreach($member->games->where('event_id', $con->event_id) as $game)
                            <a href="/calendar/convention/{{$game->event_id}}/game/{{$game->id}}">{{$game->title}}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
                    

                @endforeach
                
                
            @endif

            
    
    </div>
</div>

@endsection
