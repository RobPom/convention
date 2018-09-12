@extends('layouts.app')

@section('content')

<div class="card p-2 border-0">
    <div class="card-header bg-white">
        <h5><a href="/calendar/convention/{{$convention->id}}/manage">Manage {{$convention->title}}</h5></a>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                
                <div class="inline-block text-with-icon "><strong>Unscheduled Games </strong></div> 
            </div>
            <div class="card-body">
                <div class="card-title">
                    {{$games->count()}} Games
                </div>      
                
                @foreach($games as $game)
                    @if($game->timeslots->count())
                        <div class="row p-2 bg-light">
                    @else
                        <div class="row p-2">
                    @endif
                    <div class="col-sm-4">
                        <a href="/calendar/convention/game/{{$game->id}}/schedule">
                        {{$game->title}}</a>
                    </div>
                    <div class="col-sm-4 ">
                        <a href="/calendar/convention/{{$convention->id}}/attendee/{{$game->user->id}}">
                            <strong class=' d-block' > {{$game->user->username}} </strong> 
                        </a>
                        <span class="text-muted d-block">{{$game->user->email}}</span>
                    </div>
                    <div class="col-xs-2">
                         <a href="/calendar/convention/game/{{$game->id}}/edit" class="m-2 btn btn-sm btn-primary ">edit</a>
                   
                         <form 
                         class="m-2 d-inline"
                            onsubmit="return confirm('You cannot undo this. Are you sure you want to remove this game?');"
                            action="{{action('Calendar\ConventionController@deleteGame' , $game->id)}}" 
                            method="post">

                            @csrf
                            @method('delete')
                            
                            <button class="btn btn-sm btn-danger" type="submit">remove</button>
                        </form>
                        
                    </div>
                </div>
                    
                @endforeach
                
        </div>
    </div>
</div>

@endsection