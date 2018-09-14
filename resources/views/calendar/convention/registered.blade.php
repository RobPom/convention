@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        
@guest

You are a guest.
@endguest

    @auth
    <div class="lead mb-3 text-center">Welcome to {{$convention->title}}, {{Auth::user()->firstname}}!</div>
    <p class='text-center mb-4'>You’ve just entered a pretty exclusive club: IntrigueCon 2018 attendee!</p> 

    <p>Take a quick look over the particulars below and with a couple of clicks, you’ll be all signed up and ready for the con.
        Give yourself a pat on the back. You did good!</p>

    <div class="row">
        <div class="col">
            <div class="card mt-2">
                <div class="card-header">
                    {{$convention->title}} Information
                </div>
                <div class="card-body">
                    <div class="lead">{{$convention->pretty_dates()}}</div>
                    <p>{!! count($convention->days()) !!} days, 
                        <a href="/calendar/convention/{{$convention->id}}/schedule"> {{$convention->timeslots()->where('accept_games' , 1 )->count() }} game sessions</a>,  
                        <a href="/calendar/convention/{{$convention->id}}/games">{{$convention->games->count()}} games</a>. 
                    </p>
                </div>
            </div>
            
        </div>
        <div class="col">
            <div class="card mt-2">
                <div class="card-header">
                    Your Calendar
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            Use your personal Con Calendar to sign up for or leave games.
                        </div>
                        <div class="col-md-8 offset-md-2 col-lg-6 offset-md-3 mt-2">
                             <a  class='btn btn-sm btn-primary d-block' href="/calendar/convention/{{$convention->id}}/attendee/schedule/">
                                 {{Auth::user()->username}}'s Con Calendar</a>
                        </div>
                    </div>
                    

                </div>
            </div>
    
        </div>
    </div>

    @endauth

    
    </div>
</div>
@endsection