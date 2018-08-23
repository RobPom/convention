@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        @include('calendar.conventions.conventionheader')   


        <div class="card mb-3">
            
            <div class="card-header">
                    
                <div class="row">
                    <div class="col">
                        <small>{{$user->username}}'s</small><br>
                        <strong>Convention Schedule</strong>
                    </div>
                    <div class="col text-right">
        
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-title">
                    <strong>{{$timeslot->title}} <small>{{$timeslot->pretty_times()}}</small></strong> 
                    <p class='ml-3 mt-2'>Select a game to play</p>
                </div>
                <div class="ml-3">
                    <form method="POST" action="{{ action('Calendar\GameSessionController@updateUserGameSession') }}">
                            @csrf
                        <input name='timeslot_id' type="hidden" value="{{$timeslot->id}}">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="game_session" id="default" value="0" 
                                @if( ! $user->gamesessions()->where('timeslot_id' , $timeslot->id)->exists())
                                    checked
                                @endif
                            >
                            <label class="form-check-label" for="default">
                                No Selection
                            </label>
                        </div>

                        @foreach($timeslot->gamesessions as $gamesession)
                        
                            <div class="form-check">
                                <input class="form-check-input" type="radio" 
                                    name="game_session" id="game{{$gamesession->game->id}}" 
                                    value="{{$gamesession->id}}" 
                                    @if($user->gamesessions()->where('timeslot_id' , $timeslot->id)->where('game_id' , $gamesession->game->id)->exists())
                                        checked
                                    @endif
                                    >
                                <label class="form-check-label" for="game{{$gamesession->game->id}}">
                                    {{$gamesession->game->title}}
                                </label>
                            </div>
                        @endforeach

                    
                        <div class="form-row">
                            <div class="col-sm-6 offset-sm-3  mt-3">
                                <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
                            </div>   
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection