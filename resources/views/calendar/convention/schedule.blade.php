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
                <li class="breadcrumb-item active" aria-current="page">Schedule</li>
            </ol>
        </nav>
        
        <div class="card" style="max-width: 600px;">
            <div class="card-header">
                <strong>Convention Schedule</strong>
            </div>
            <div class="card-body">
                @foreach($convention->days() as $day)
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <strong class='lead'>{{$day->format('l')}}</strong> 
                            <ul class="list-group mt-2">
                                
                                @foreach($convention->timeslots()->orderBy('start_time', 'asc')->get() as $timeslot)
                                    @if($day->isSameDay($timeslot->start_time()))
                                    <a href="/calendar/convention/timeslot/{{$timeslot->id}}" class="list-group-item list-group-item-action">
                                        <div class="row">
                                            
                                            @if($timeslot->accept_games == true)
                                                <div class="col-md-3 ">
                                                    <div class="small text-muted">
                                                        {{$timeslot->only_times()}}
                                                        
                                                    </div>
                                                    <div class="strong">
                                                            {{$timeslot->title}}
                                                    </div>
                                                   
                                                
                                                </div>
                                        
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6  text-center small">  
                                                            Games: {{$timeslot->games->count()}}
                                                        </div>
                    
                                                        <div class="col-sm-12 col-md-6 text-center small">
                                                            Players: {{$timeslot->players()}} / {{$timeslot->max_players()}}
                                                        </div>
                                                    </div>
                                                </div>

                                            @else
                                                <div class="col-md-3">
                                                    <div class="small text-muted">
                                                        {{$timeslot->only_times()}}
                                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-9 text-center">
                                                    
                                                    {{$timeslot->title}}
                                                
                                                </div>
                                                
                                            @endif
                                        </div>   
                                        

                                       <a>
                                    @endif
                                @endforeach

                            </ul>
                            
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection