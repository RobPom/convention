@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
            
        <h3>
            <small><i class="far fa-user"></i></small>
            {{$user->username}}
        </h3>
    </div>
    <div class="card-body">

        @if (session('profileUpdate'))
            <div class="alert alert-success">
                    <i class="far fa-address-card"></i> {{ session('profileUpdate') }}
            </div>
        @endif

        <h4 class='d-inline'>Profile   </h4>  <a class="btn btn-secondary btn-sm" href='/profile/{{$user->id}}/edit'>edit</a><br><br>
        <h5>Community Info</h5>

        Member since {{Carbon\Carbon::parse($user->created_at)->format('F jS, Y')}}<br>
        <strong>Email: </strong>{{$user->email}}<br>
        <strong>About: </strong>{{$user->profile->description}} <br>
        <hr>
        <h5>Private Info</h5>
        <strong>Member Level: </strong> {{$user->roles->first()->name}} <br>
        <strong>Full Name: </strong>{{$user->firstname}} {{$user->lastname}}<br>
        <strong>Location: </strong> {{$user->profile->location}}

    </div>
</div>

<br>

@if( $user->hasRole('organizer') ||  $user->hasRole('admin') )
    <div class="card">
        <div class="card-header"> 
            <h4>Organizer</h4>
        </div>

        <div class="card-body">
            <h5>Members</h5>
            <a href="/profiles/all">{{$members->count()}} Registered Users</a>

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
            @foreach($organizers as $member)
                @include('member.horizontalCard')<br>
            @endforeach
        </div>
    </div>
@endif



@endsection