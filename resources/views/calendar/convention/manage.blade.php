@extends('layouts.app')

@section('content')

<div class="card p-2 border-0">
    <div class="card-header bg-white">
       <h5>Manage {{$convention->title}}</h5>
    </div>
    <div class="card-body">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <strong> Basic Info </strong>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="/calendar/convention/{{$convention->id}}/edit" class="btn btn-sm btn-secondary">edit</a> 
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h5>{{$convention->title}}</h5>
                    </div>
                    <div class="col-sm-6 text-md-right">
                        <h5><small class='text-muted'>  {{$convention->pretty_dates()}}</small></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5><small>{{$convention->tagline}}</small></h5>
                    </div>
                </div>

                <hr class="m-4">
                
                <div class="lead m-2 mt-4">{{$convention->lead}}</div>
                <p class='mt-4'>{!! $convention->description !!}</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Schedule</strong>
                    </div>
                    <div class="col-md-6 text-right">
                            
                    </div>
                </div>
            </div>
            <div class="card-body"> 
                <div class="row">
                    <div class="ml-2 p-2">
                        <a href="/calendar/convention/{{$convention->id}}/timeslot/new" class="btn btn-sm btn-secondary">New Game Slot</a>
                    </div>
                    <div class="p-2">
                        <a href="/calendar/convention/{{$convention->id}}/event/new" class="btn btn-sm btn-secondary">New Event Slot</a>
                    </div>
                </div>
                      
                    <table class='table'>
                    @foreach($convention->timeslots()->orderBy('start_time', 'asc')->get() as $timeslot)
                        <tr>
                            <td> <a href="/calendar/convention/timeslot/{{$timeslot->id}}">{{$timeslot->title}}</a></td> 
                            <td>{{$timeslot->pretty_times()}}</td>
                            <td> 
                                <form 
                                    onsubmit="return confirm('You cannot undo this. Are you sure you want to delete this time slot?');"
                                    action="{{action('Calendar\TimeslotController@destroy', $timeslot->id)}}" 
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    @if($timeslot->accept_games)
                                        <a href="/calendar/convention/timeslot/{{$timeslot->id}}/edit" class="btn btn-sm btn-secondary mb-1">Edit</a>
                                    @else
                                        <a href="/calendar/convention/event/{{$timeslot->id}}/edit" class="btn btn-sm btn-secondary mb-1">Edit</a>
                                    @endif
                                    <button class="btn btn-sm btn-danger mb-1" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Games</strong>
                            </div>
                            <div class="col-md-6 text-right">
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        @if($convention->games->count())    
                            <strong> Total: </strong> <a href="/calendar/convention/{{$convention->id}}/pool">{{$convention->games->count() }} games </a><br>
                            <strong> Not on Schedule: </strong><a href="/calendar/convention/{{$convention->id}}/games/unscheduled">{{$convention->games()->doesntHave('timeslots')->count()}} games</a>  <br>
                        @else
                            no games! <br>
                        @endif 

                        @if($convention->submissions->count())
                            <strong> Submissions: </strong><a href="/calendar/convention/submissions/{{$convention->id}}">{{$convention->submissions->count()}} submissions</a><br>
                        @else
                            no game submissions! <br>
                        @endif
                    
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <strong>Attendees</strong>
                    </div>
                    <div class="card-body">
                        <a href="/calendar/convention/{{$convention->id}}/attendees">{{$convention->attendees->count()}} Attendees</a> <br>
                        <a href="/calendar/convention/{{$convention->id}}/attendee/new">Add New</a> <br>
                        <a href="/calendar/convention/{{$convention->id}}/attendee/add">Add from Users</a> <br>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Location</strong>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="/calendar/convention/{{$convention->id}}/location/change" class="btn btn-sm btn-secondary">change</a> 
                                @if($convention->location !== null)
                                    <a href="/calendar/convention/{{$convention->id}}/location/edit" class="btn btn-sm btn-secondary">edit</a> 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($convention->location !== null)
                        <h5>{{$convention->location->name}}</h5>
                        <h6 class="text-muted">{{$convention->location->address1}}<br>{{$convention->location->address2}}</h6>
                        <a href="{{$convention->location->link}}" class="card-link">Google Maps</a>
                        @endif
                        
                    </div>
                </div>  
            </div>

            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Paypal</strong>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="/calendar/convention/location/{{$convention->id}}/edit" class="btn btn-sm btn-secondary">edit</a> 
                                </div>
                            </div>
                    </div>
                    <div class="card-body">
                        
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
 
                    <small>{{$convention->status}}</small>

                @endauth             
            </div>
        </div>
    </div>
</div>
</div>

@endsection