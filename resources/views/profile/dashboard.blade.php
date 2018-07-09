@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        @php $member = $user; @endphp
        @include('profile.member.dash')
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