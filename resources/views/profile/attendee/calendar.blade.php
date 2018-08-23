<div class="card">
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
        <table class="table">
            @foreach($convention->timeslots as $timeslot)
            <tr>
                <th>{{$timeslot->title}} - <small>{{$timeslot->pretty_times()}}</small></th>
   
                @if($user->gamemaster($timeslot->id))
                    <td>
                        You are hosting <a href="/calendar/convention/timeslot/game/{{$user->gamemaster($timeslot->id)->id}}">
                                            {{$user->gamemaster($timeslot->id)->game->title}}.
                                        </a>
                    </td>
                    <td></td>
                @else
                        @if($gamesession = $user->gamesessions->where('timeslot_id' , $timeslot->id)->first())
                            <td> You are playing {{$gamesession->game->title}}</td>
                            <td><a href="/calendar/convention/session/{{$timeslot->id}}/edit" class="btn btn-sm btn-secondary">Change</a></td>
                        @else
                            @if($timeslot->gamesessions()->count())
                                <td>{{$timeslot->gamesessions()->count()}} games to choose from</td>
                                <td><a href="/calendar/convention/session/{{$timeslot->id}}/edit" class="btn btn-sm btn-secondary">Select a Game</a></td>
                            @else
                                <td>No games scheduled.</td>
                                <td></td>
                            @endif
                        @endif

                    </tr>
                @endif
            @endforeach
        </table>
    </div>
</div>