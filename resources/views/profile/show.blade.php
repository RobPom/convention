@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">      
        <h3>
            <small><i class="far  fa-user"></i></small>
            {{$member->username}}<br>
        </h3>
    </div>
    <div class="card-body">

        <h5>Info Visible to Community Members</h5>
        
        <p><strong>email: </strong>{{$member->email}}<br>
            member since {{ (new \Carbon\Carbon($member->created_at))->toFormattedDateString() }}</p>
            <strong>about: </strong>{{$member->profile->description}} 
   

        @if( $user->id == $member->id || $user->hasRole('organizer') ||  $user->hasRole('admin') )
            <hr>
            <h5>Info Visible to Organizers</h5>
            <strong>Full Name: </strong>{{$member->firstname}} {{$member->lastname}}<br>
            <strong>Location: </strong> {{$member->profile->location}}
        @endif
        
    </div>
</div>

@endsection