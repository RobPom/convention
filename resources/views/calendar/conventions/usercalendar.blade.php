@extends('layouts.app')

@section('content')

<div class="card mb-3">
    <div class="card-body">
        @include('calendar.conventions.conventionheader')   
        @include('profile.attendee.calendar')
    </div>
</div>

@endsection