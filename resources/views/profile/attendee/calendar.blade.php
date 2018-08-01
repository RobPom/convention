<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                    <small>{{$user->username}}'s</small><br>
                    <strong>Convention Schedule</strong>
            </div>
            <div class="col text-right">
                <a href="" class="mt-2 btn btn-sm btn-secondary">Edit</a>
            </div>
        </div>
        
    </div>
    <div class="card-body">
        <table class="table">
         
        
        @foreach($convention->timeslots as $timeslot)
        @php $game = null; @endphp
            <tr>
                <td>
                    <strong>
                        {{$timeslot->title}}
                    </strong> <br>
                    <small>
                            @include('layouts.include.prettydate')
                    </small>
                </td>
                <td>                  
                    @php
                        $game_sessions = App\GameSession::where('timeslot_id' , $timeslot->id)->get()
                    @endphp
                   
                    @foreach($game_sessions as $gs)
                        @php
                            if($gs->attendees()->where('user_id' , $user->id)->first())
                            {
                                $game = $gs->game;
                                $session = $gs;
                            } 
                        @endphp
                    @endforeach

                    @isset($game)
                        <small>You are playing </small><br>
                        <strong> <a href="/calendar/convention/timeslot/game/{{$session->id}}"> {{$game->title}}</a></strong>
                    @else    
                        @if($timeslot->games->count())
                            @if($timeslot->games->count() == 1)
                                <small>{{$timeslot->games->count()}} Game Available</small><br>
                            @else
                                <small>{{$timeslot->games->count()}} Games to Choose From</small><br>
                            @endif
                            
                        @else
                            <small>No Games Scheduled</small><br>
                        @endempty                  
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    </div>
</div>