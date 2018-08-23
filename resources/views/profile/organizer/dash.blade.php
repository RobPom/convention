@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <h5> <small> Organizer Dashboard </small></h5>
        <h3>{{$user->firstname}} {{$user->lastname}}</h3>
        <div class="card mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <strong>All Conventions</strong>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="/calendar/convention/new" class="btn btn-sm btn-secondary">New</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($conventions->where('status' , 'active')->first())
                    <div class="card">
                        <div class="card-header lead bg-white">
                            <a href="/calendar/convention">{{$conventions->where('status' , 'active')->first()->title}}</a> <br>
                            <small>{{$convention->start_date()->format('l F jS')}} to {{$convention->end_date()->format('l F jS')}}</small>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-white">
                                            <div class="row">
                                                <div class="col">
                                                    <strong>Time Slots</strong>
                                                </div>
                                                <div class="col text-right">
                                                    <a href="/calendar/convention/{{$convention->id}}/timeslots" class="btn btn-sm btn-secondary">Edit</a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="card-body">
                                            <div class="list-group">
                                            @foreach($convention->timeslots as $timeslot)
                                                <a href="/calendar/convention/timeslot/{{$timeslot->id}}" class="list-group-item list-group-item-action">
                                                    <div class="row">
                                                        <div class="col">
                                                                {{$timeslot->title}}
                                                        </div>
                                                        <div class="col">
                                                            {{$timeslot->games()->count()}} games <br>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-md-0 mt-sm-3" >
                                    <div class="card">
                                        <div class="card-header bg-white">
                                            <strong>Games</strong>
                                        </div>
                                        <div class="card-body">
                                            <strong>Submissions</strong> - 
                                            <a href="/calendar/convention/submissions/{{$convention->id}}">{{$convention->submissions()->count()}} Submissions</a> <br>
                                            <strong>Pool</strong> - 
                                            <a href=""> {{$convention->games->count() }} games</a> <br>
                                            <strong>Sessions</strong> - {{$convention->gameSessionsCount()}} <br>
                                            <strong>Scheduled Games</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header bg-white">
                                            <strong> Attendees</strong>
                                        </div>
                                        <div class="card-body">
                                            <a href="/calendar/convention/attendees">{{$conventions->where('status' , 'active')->first()->attendees->count()}}  Attendees</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="lead">No Active Conventions</div>
                        </div>
                    </div>
                @endif

                @if($conventions->where('status' , 'inactive')->first())
                <hr class='m-4'>
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="card-title mb-4">
                                <strong>Inactive Conventions</strong>
                            </div>
                                
                            <div class="list-group">
                                @foreach($conventions->where('status' , 'inactive') as $con)
                                    <div class="list-group-item">
                                        <div class= "row">
                                            <div class="col-sm-4">
                                                <a href="/calendar/conventions/{{$con->id}}"><strong>{{$con->title}}</strong></a>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                <small>more text</small>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <form class='form-inline '
                                                    onsubmit="return confirm('You cannot undo this. Are you sure you want to delete this convention?');"
                                                    action="{{action('Calendar\ConventionController@destroy', $con->id)}}" 
                                                    method="post">

                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="" class="m-1 btn btn-sm btn-primary">Edit</a>
                                                    <button href='/calendar/convention/{{$con->id}}' class="m-1 btn btn-sm btn-danger" type="submit">Delete</button>

                                                </form>        
                                            </div>
                                        </div>
                                    </div>   
                                @endforeach
                            </div>
                        </div>
                    </div>   
                @endif
            </div>
        </div>
    </div>
</div>
    
@endsection