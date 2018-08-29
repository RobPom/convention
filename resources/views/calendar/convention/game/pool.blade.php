@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        <h5>Manage {{$convention->title}}</h5>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <strong>Game Pool</strong>
            </div>
            <div class="card-body">
                <div class="card-title">
                    {{$games->count()}} Games
                </div>      
                
                @foreach($games as $game)
                <div class="row p-2">
                    <div class="col-sm-4">
                        <a href="/calendar/convention/game/{{$game->id}}/schedule">
                        {{$game->title}}</a>
                    </div>
                    <div class="col-sm-4 ">
                        <strong class=' d-block' > {{$game->user->username}} </strong> 
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