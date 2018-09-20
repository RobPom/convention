@extends('layouts.app')

@section('content')

<div class="card p-2 border-0">
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
                            @auth
                                @if(Auth::user()->hasRole('organizer'))
                                    <small class='text-muted'>
                                        Players : {{$timeslot->players()}} <br>
                                        GMs : {{$timeslot->games->count()}} <br>
                                        Total: {!! $timeslot->players() + $timeslot->games->count() !!}
                                    </small>
                                @endif
                            @endauth
                        @endif
                    </div>
                    <div class="col-md-8">
                        @if($timeslot->accept_games)
                        <ul class="list-group">
                            @if($timeslot->games->count())
                            <div class="row">
                                @foreach($timeslot->games as $game)
                                <div class="col-sm-6 col-md-12 col-lg-6 mt-1">
                                    <a href='/calendar/convention/session/{{$timeslot->gamesession($game)->id}}' class="list-group-item list-group-item-action" style="min-height: 96px;">
                                        <div class="row">
                                            <div class="col-4 text-center" >
                                                @if($game->image == 'default.jpg')
                                                    <img class="img-responsive" 
                                                        style="max-height:80px; max-width: 50px;"
                                                        src='/img/game_images/default.jpg'
                                                        alt="Avatar Placeholder">
                                                @else
                                                    <img class=img-responsive" 
                                                        style="max-height:80px ;max-width: 50px;"
                                                        src="/storage/uploads/game_images/{{$game->image}}"
                                                        alt="Avatar Placeholder">
                                                @endif
                                            </div>
                                            <div class="col-8 text-right">
                                                <small style="display:block;"> <strong>{{$game->title}}</strong></small> 
                                                <small>Players: {{$timeslot->gamesession($game)->attendees->count()}} / {{$game->max}}</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
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