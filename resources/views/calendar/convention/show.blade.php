@extends('layouts.app')

@section('content')

<div class="card p-2 border-0">
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
            <div class="col-md-6">
                    <h5 class="mb-3"> <a href="/calendar/convention/{{$convention->id}}/schedule">Schedule</a></h5>
                @foreach($convention->days() as $day)
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
                                                   <div>{{$timeslot->title}}</div>
                                                <small>{{$timeslot->only_times()}}</small>
                                                </div>
                                                <div class="col text-right">
                                                    @if($timeslot->accept_games == true)
                                                    <small>
                                                        Players: {{$timeslot->players()}} / {{$timeslot->max_players()}}
                                                    </small>
                                                    @endif
                                                </div>

                                            </div> 
                                        </a>      
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <div class="row">
                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5>Attendance</h5>
                                    </div>
                                    @auth
                                        @if($convention->attendees()->where('user_id', Auth::user()->id)->count())
                                            <p>You are signed up and ready to go.</p>
                                            <a href="/calendar/convention/{{$convention->id}}/attendee/schedule">Your Convention Calendar</a>
                                        @else
                                        <div class="text-center">
                                                <a href="/calendar/convention/{{$convention->id}}/register" class="btn btn-info btn-sm mt-2" style="background-color: #2c6459 ; border-color: #642c37">Register Now!</a>
                                            </div>
                                        @endif
                                    @endauth

                                    @guest
                                        <div class="text-center">
                                            <a href="/calendar/convention/{{$convention->id}}/register" class="btn btn-info btn-sm mt-2" style="background-color: #2c6459 ; border-color: #642c37">Register Now!</a>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                                
                               
                          </div> 
                    <div class="col-md-12 mt-3">

                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5>Location</h5>
                                </div>
                                @isset($convention->location) 
                                    <h5>{{$convention->location->name}}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{$convention->location->address1}} <br> {{$convention->location->address2}}</h6>
                                    <a href="{{$convention->location->link}}" class=" m-2 card-link btn btn-sm btn-primary">Google Maps</a>
                                @else
                                    <div class="text-center">
                                        <h5 class="card-title">No Location</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">(yet)</h6>
                                    </div>
                                @endisset
                            </div>
                        </div>
                        
                       
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                @if($convention->games->count())
                                    @php $game = $convention->games->shuffle()->first(); @endphp
                                        <div class="card-title">
                                            <h5>Games</h5>  
                                        </div>
                                        <div class="p-3">
                                            
                                            <div class="m-1">
                                                {{$convention->games->count()}} Games<a href="/calendar/convention/{{$convention->id}}/games"> <em>see all</em></a>
                                            </div>
                                        
                                            <small class="text-muted"> <em> Like this one at random</em></small>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            @if($game->image == 'default.jpg')
                                                                <img class="img-fluid align-self-center pull-left mr-3 mb-2" 
                                                                    style="max-height:100px ;"
                                                                    src='/img/game_images/default.jpg'
                                                                    alt="Avatar Placeholder">
                                                            @else
                                                                <img class="img-fluid align-self-center mr-3 mb-2" 
                                                                    style="max-height:100px ;"
                                                                    src="/storage/uploads/game_images/{{$game->image}}"
                                                                    alt="Avatar Placeholder">
                                                            @endif
                                                        </div>
                                                        <div class="col-9">
                                                            <h5 class="card-title">{{$game->title}}</h5>
                                                            <h6 class="card-subtitle mb-2 text-muted">{{$game->tagline}}</h6>
                                                            <a href="/calendar/convention/{{$convention->id}}/game/{{$game->id}}" class="text-right">More Info</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                @else
                                    <div class="text-center">       
                                        <h5 class="card-title">No Games</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">(yet)</h6>
                                    </div> 
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="card-footer bg-white">
        <div class="row">
            <div class="col text-center"></div>
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