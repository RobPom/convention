@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5> <small> Organizer Dashboard </small></h5>
        <h3>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h3>
        <div class="card mt-4">
            <div class="card-header lead bg-white">
                <a href="/calendar/convention">{{$convention->title}}</a> <br>
                <small>{{$convention->start_date()->format('l F jS')}} to {{$convention->end_date()->format('l F jS')}}</small>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <h5>Game Submissions</h5>
                    @foreach($convention->submissions as $submission)
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col">
                                {{$submission->game->title}}
                            </div>
                            <div class="col">
                                {{$submission->user->firstname}} {{$submission->user->lastname}}
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col p-1">
                                        <form 
                                            action="{{action('Calendar\ConventionController@acceptSubmission')}}" 
                                            method="post">

                                            @csrf
                                            
                                            <input type="hidden" value="{{$submission->id}}" name="submission_id">
                                            <button class="btn btn-sm btn-primary" type="submit">Edit</button>
                                        </form>
                                    </div>
                                    <div class="col p-1">
                                        <form 
                                            
                                            action="{{action('Calendar\ConventionController@acceptSubmission')}}" 
                                            method="post">

                                            @csrf
                                            
                                            <input type="hidden" value="{{$submission->id}}" name="submission_id">
                                            <button class="btn btn-sm btn-secondary" type="submit">Accept</button>
                                        </form>
                                    </div>
                                    <div class="col p-1">
                                        <form 
                                            onsubmit="return confirm('You cannot undo this. Are you sure you want to remove this game submission?');"
                                            action="{{action('Calendar\ConventionController@rejectSubmission' , $submission->id)}}" 
                                            method="post">

                                            @csrf
                                            @method('delete')
                                            
                                            <button class="btn btn-sm btn-danger" type="submit">reject</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection