@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-md-8 text-center text-md-left">
                <h5>{{$convention->title}}</h5>
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
        <div class="lead">{{$convention->lead}}</div>
        <p class='mt-3'>{!!$convention->description!!}</p>
        <hr class="my-3">

        <div class="row">
            <div class="col-lg-10 offset-lg-1 ">
                <div class="m-2 p-1 text-center">
                    <strong> <a href="/calendar/convention/{{$convention->id}}/schedule">Schedule</a></strong>
                </div>
                <div class="p-1 mt-3">
                    <div class="row">
                        @foreach($convention->days() as $day)
                            @if( (count($convention->days()) % 2) == 0)
                                <div class="col-md-6">
                            @else
                                <div class="col-md-8 offset-md-2 col-lg-4 offset-lg-0">

                            @endif
                        
                            <div class="card">
                                <div class="card-header">
                                    {{$day->format('l')}} <small>{{$day->format('M jS')}}</small>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach($convention->timeslots()->orderBy('start_time', 'asc')->get() as $timeslot)
                                            @if($day->isSameDay($timeslot->start_time()))
                                                <a href="/calendar/convention/timeslot/{{$timeslot->id}}" class="list-group-item list-group-item-action">
                                                    <div class="row">
                                                        <div class="col text-left">
                                                           <small>{{$timeslot->only_times()}}</small>
                                                        </div>
                                                        <div class="col text-right">
                                                            {{$timeslot->title}}
                                                        </div>
                                                    </div> 
                                                </a>      
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

        <div class="row">
            @if($convention->games->count())
            <div class="col-md-6">
                <hr class="my-3">
                <div class="m-2 p-1 text-center">
                    <strong>
                        <a href="/calendar/convention/{{$convention->id}}/games">Games</a>
                    </strong>
                    <div id="carouselExampleControls" class="carousel slide mt-3" data-ride="carousel">
                        <div class="carousel-inner">

                            @foreach($convention->games as $game)
                                @if($loop->first)
                                    <div class="card carousel-item active border-0" style="height:200px;">
                                @else
                                    <div class="card carousel-item border-0" style="height:200px;">
                                @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{$game->title}}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">{{$game->tagline}}</h6>
                                            <p class="card-text">{{ str_limit($game->lead, 240) }}</p>
                                            <a href="#" class="card-link">More Info</a>
                                        </div>
                                    </div>

                            @endforeach

                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                        <div class="m-3 text-right">
                            <a href="#" class='btn btn-sm btn-secondary'>all games</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-6">
                <hr class="my-3">
                <div class="m-2 p-1 text-center">
                    <div class="card mt-3 border-0" style="height:100px;">
                        <div class="card-body">
                            <h5 class="card-title">No Games</h5>
                            <h6 class="card-subtitle mb-2 text-muted">(yet)</h6>
                        </div>
                        
                        
                    </div>
                </div>
               
            </div>

            @endif

            <div class="col-md-6">
                    <hr class="my-3">
                <div class="m-2 p-1 text-center">
                        <strong>Location</strong>
                    <div class="card mt-3 border-0">    
                        <div class="card-body">
                            <h5 class="card-title">Queen Alexandra Community League</h5>
                            <h6 class="card-subtitle mb-2 text-muted">10425 University Ave, <br> Edmonton, AB</h6>
                            
                            <a href="https://goo.gl/maps/hDGp7AQkAQF2" class="card-link">Google Maps</a>
                        </div>
                    </div>
                </div>
            </div>  
        </div> 
    </div>
    <div class="card-footer bg-white">
        <div class="row">
            <div class="col text-center"> <small><a href="/calendar/conventions">Index</a></small></div>
            <div class="col text-center"></div>
            <div class="col text-center">
                @auth
                    @if( Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin')  ) 
                        <small>{{$convention->status}}</small>
                    @endif
                @endauth             
            </div>
        </div>
    </div>
</div>

@endsection