@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>
                @if($member->hasRole('organizer'))
                    {{$member->firstname}} {{$member->lastname}}
                @else
                    {{$member->username}}
                @endif
            </h3>
    
            <small>member since {{ (new \Carbon\Carbon($member->created_at))->toFormattedDateString() }} </small>
            <br>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            <small>{{$convention->start_date()->format('F jS')}}
                                    to
                                    {{$convention->end_date()->format('jS')}}
                            </small> <br>
                            <strong>{{$convention->title}}</strong>
                        </div> 
                        <div class="card-body">
                            <div class="card-title">
                                <strong>Submissions</strong> 
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($member->games as $game)
                                <li class="list-group-item">
                                    @if( $convention->games()->where('game_id' , $game->id)->first())
                                        {{$game->title}} - approved
                                    @elseif( $convention->submissions()->where('game_id' , $game->id)->first())
                                        {{$game->title}} - submitted
                                    @else
                                        {{$game->title}} 
                     
                                    <form 
                                        action="{{action('Calendar\ConventionController@submit')}}" 
                                        method="post">
                                        @csrf
                                        
                                        <input type="hidden" value="{{$convention->id}}" name="convention_id">
                                        <input type="hidden" value="{{$game->user->id}}" name="user_id">
                                        <input type="hidden" value="{{$game->id}}" name="game_id">
                                        <button class="btn btn-sm btn-danger" type="submit">submit</button>
                                    </form>
                                
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            
                            <div class="mx-2 mt-4 mb-2">
                                <a href="/profile?tab=games">back to your games</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection