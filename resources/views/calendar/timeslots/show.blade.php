@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-md-8 text-center text-md-left">
                <h5> <a href="/calendar/convention/{{$convention->id}}">{{$convention->title}}</a> </h5>
            </div>
            <div class="col-md-4 text-center text-md-right">
                <small>{{$convention->pretty_dates()}}</small>
            </div>
        </div>
        <div class="row mt-1">

            <div class="col-md-8 text-center text-md-left">
                <h5><small>{{$convention->tagline}}</small></h5>
            </div>
            
            @auth
                @if( Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin')  )
                    @if($convention->status != 'archived')
                        <div class="col-md-4 text-right">
                            <a href="/calendar/convention/{{$convention->id}}/manage" class="btn btn-sm btn-primary">Manage</a>
                        </div>
                    @endif
                @endif
            @endauth

        </div>  
    </div>
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item">
                    <a href="/calendar/convention/{{$convention->id}}">Convention</a>
                </li>
                <li class="breadcrumb-item"><a href="/calendar/convention/{{$convention->id}}/schedule">Schedule</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$timeslot->title}}</li>
            </ol>
        </nav>
        
        <div class="card">
            <div class="card-header">
               <strong> {{$timeslot->start_time()->format('l')}}</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 card-title">
                        <div class='lead'>{{$timeslot->title}}</div>
                        <small class="text-muted">{{$timeslot->only_times()}}</small>
                        @if($timeslot->accept_games == true)
                            <br><br>
                            <small class='text-muted'>
                                Players : ## <br>
                                GMs : {{$timeslot->games->count()}}
                            </small>
                        @endif
                    </div>
                    <div class="col-md-8">
                        @if($timeslot->accept_games)
                        <ul class="list-group">
                            @if($timeslot->games->count())
                                @foreach($timeslot->games as $game)
                                
                                    <a href='/calendar/convention/session/{{$timeslot->gamesession($game)->id}}' class="list-group-item list-group-item-action">
                                        <div class="row">
                                            <div class="col">
                                                <div class=''>{{$game->title}}</div>
                                            </div>
                                            <div class="col text-right">
                                                <small>Seats: ## / {{$game->max}}</small>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <p>No Games Scheduled</p>
                            @endif
                        </ul>
                        @else
                            {!!$timeslot->description!!}
                       @endif

                    </div>
                </div>
   
            </div>
        </div>
    </div>
</div>
@endsection