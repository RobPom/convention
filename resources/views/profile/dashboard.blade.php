@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
            
        <h3>
            <small><i class="far  fa-user"></i></small>
            {{$user->username}}<br>
            <small>{{$user->roles->first()->name}}</small>
        </h3>
    </div>
    <div class="card-body">
        <h4 class='d-inline'>Profile</h5><a href='#'> - edit</a><br><br>
        <h5>Community Info</h5>
            
        <strong>Email: </strong>{{$user->email}}<br>
        <strong>Joined: </strong>{{ (new \Carbon\Carbon($user->created_at))->toFormattedDateString() }}<br>
        <strong>About: </strong>{{$user->profile->description}} <br>
        <hr>
        <h5>Private Info</h5>
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
                <h5>All Members</h5>
                <br>
                <table class="table table-sm sortable">
                        
                    <thead>
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">email</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                        <tr >
                            <a href="#">
                            <th scope="row">{{$member->username}}</th>
                            <td>{{$member->firstname}}</td>
                            <td>{{$member->lastname}}</td>
                            <td>{{$member->email}}</td>
                            <td><a href=''>edit</a></td>
                            </a>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <a href='/users/add' class="btn btn-small btn-primary col-md-4 offset-md-4"> Add </a>

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