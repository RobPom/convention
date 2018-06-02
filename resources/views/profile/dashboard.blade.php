@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
            
        <h4>
            <small><i class="far  fa-user"></i></small>
            {{$user->username}}<br>
            <small>{{$user->roles->first()->name}}</small>
        </h4>
    </div>
    <div class="card-body">
        <p>This is where common tools to all registered users will go </p>

        
    </div>
</div>

<br>

<div class="card">
    <div class="card-header">
        <h5>Profile</h5>
    </div>
    <div class="card-body">
            @include('layouts.profileHorizontalCard')
        
    </div>
</div>

<br>

@if( $user->hasRole('organizer') ||  $user->hasRole('admin') )
    <div class="card">
        <div class="card-header">
            <h5>Organizer Tools</h5>
        </div>
        <div class="card-body">

            <h5>Members</h5>
            
            @foreach($members as $user)
                @include('layouts.profileSmallHorizontalCard')<br>
            @endforeach
            
            <a href='/users/add' class="btn btn-small btn-primary"> Add a Member </a>

        </div>
    </div>
    
@endif
<br>
@if( $user->hasRole('admin') )
    <div class="card">
        <div class="card-header">
            <h5>Admin Tools</h5>
        </div>
        <div class="card-body">
                <h5>Organizers</h5>
            
                @foreach($organizers as $organizer)
                    {{$organizer->username}} <br>
                @endforeach

        </div>
    </div>
@endif

@endsection