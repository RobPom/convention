@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">      
        <h4>
            <small><i class="far  fa-user"></i></small>
            {{$user->username}}<br>
        </h4>
    </div>
    <div class="card-body">
        <div class="card-body">
            <h5>Info Visible to Community Members</h5>
            
            <p><strong>email: </strong>{{$user->email}}<br>
                member since {{ (new \Carbon\Carbon($user->created_at))->toFormattedDateString() }} <br>
                <strong>about: </strong>{{$user->profile->description}}    
                </p>
            <hr>
            <h5>Info Visible to Organizers</h5>
            <strong>Full Name: </strong>{{$user->firstname}} {{$user->lastname}}<br>
            <strong>Location: </strong> {{$user->profile->location}}
        </div>
    </div>
</div>

@endsection