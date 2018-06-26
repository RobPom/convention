@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        @php $member = $user; @endphp
        @include('profile.member.dash')
    </div>
    <div class="card-body">
        <h5 class='d-inline'>Profile</h5>  
        <a href='/profile/{{$user->id}}/edit'> - edit</a>
        <br><br>
        <h6>Community Info</h6>
        <p><strong>email: </strong>{{$member->email}} <br>
            <strong>about: </strong>{{$member->profile->description}} </p>


    @if( $user->id == $member->id || $user->hasRole('organizer') ||  $user->hasRole('admin') )
        <h6>Private Info</h6>
        <strong>Full Name: </strong>{{$member->firstname}} {{$member->lastname}}<br>
        <strong>Location: </strong> {{$member->profile->location}}
    @endif
    </div>

</div>

<br>

@if( $user->hasRole('organizer') ||  $user->hasRole('admin') )
    @include('profile.organizer.dash')
@endif

<br>
@if( $user->hasRole('admin') )
    @include('profile.admin.dash')
@endif



@endsection