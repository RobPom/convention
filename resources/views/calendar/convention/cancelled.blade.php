@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="lead mb-3">
            Your transaction was cancelled. 
        </div>
        <p>That’s weird. Don’t give up though. Be the little engine that could. We know you can do it!</p>
        <a class='btn btn-sm btn-primary mb-2' href="/calendar/convention/{{$convention->id}}/register">Try Again!</a> <br>
        <a href="/calendar/convention/{{$convention->id}}">Go Back to the Convention Page</a>
    </div>
</div>

@endsection