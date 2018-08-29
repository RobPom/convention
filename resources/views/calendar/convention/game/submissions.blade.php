@extends('layouts.app')

@section('content')
<div class="card p-2">
        <div class="card-header bg-white">
           <h5>Manage {{$convention->title}}</h5>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <strong>Game Submissions</strong>
                </div>
                <div class="card-body">
                    @if($convention->submissions->count())
                        <div class="list-group">
                            
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
                    @else
                        <p>No Game Submissions</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection