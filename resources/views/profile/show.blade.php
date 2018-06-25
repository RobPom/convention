@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">      
        <h3>
            @if($member->hasRole('organizer'))
            {{$member->firstname}} {{$member->lastname}}
            @else
                {{$member->username}}
            @endif
        </h3>
    </div>
    <div class="card-body">


        <small>member since {{ (new \Carbon\Carbon($member->created_at))->toFormattedDateString() }} </small>
        <br>

        @if($member->blogPosts->count())
        <br>
            <h6>Latest Posts</h6>

            @foreach($member->blogPosts as $post)
                <a href='/post/{{$post->id}}'>{{$post->title}}</a> <br>
            @endforeach
        @endif

        @if($user)
        <hr>
            <h6>Community Info</h6>
            <p><strong>email: </strong>{{$member->email}} <br>
                <strong>about: </strong>{{$member->profile->description}} </p>
    
            @if( $user->id == $member->id || $user->hasRole('organizer') ||  $user->hasRole('admin') )
                <hr>
                <h6>Private Info</h6>
                <strong>Full Name: </strong>{{$member->firstname}} {{$member->lastname}}<br>
                <strong>Location: </strong> {{$member->profile->location}}
            @endif

        @endif
        
    </div>
</div>

@endsection