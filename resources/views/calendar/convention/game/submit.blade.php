@extends('layouts.app')

@section('content')
    <div class="card border-0">
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
                                @foreach($member->games->where('event_id' , 0 ) as $game)
                                <li class="list-group-item">

                                    <!-- game is already submitted-->
                                    @if( $convention->submissions()->where('game_id' , $game->id)->first())
                                    <div class="row">
                                        <div class="col">{{$game->title}}</div>
                                        <div class="col text-muted">
                                            <em>submitted</em>   
                                        </div>
                                    </div>
                        
                                    @endif

                                   
                                    
                                    <!-- if it is the parent-->
                                    @if($convention->games()->where('parent_id', $game->id)->first())
                                    <div class="row">
                                        <div class="col">
                                            {{$convention->games()->where('parent_id', $game->id)->first()->title}}
                                        </div>
                                        <div class="col text-muted">
                                            <em>approved</em>   
                                        </div>
                                    </div>
                                        
                                    @else
                                    <!-- if not a parent, and not in the convention game list, show the submit button-->
                                        @if(! $convention->games()->where('id' , $game->id)->first() && ! $convention->submissions()->where('game_id' , $game->id)->first())
                                            <div class="row">
                                                <div class="col">
                                                        {{$game->title}} 
                                                </div>
                                                <div class="col">
                                                    <form 
                                                        action="{{action('Calendar\ConventionController@submit')}}" 
                                                        method="post">
                                                        @csrf
                                                        
                                                        <input type="hidden" value="{{$convention->id}}" name="convention_id">
                                                        <input type="hidden" value="{{$game->user->id}}" name="user_id">
                                                        <input type="hidden" value="{{$game->id}}" name="game_id">
                                                        <button class="btn btn-sm btn-danger" type="submit">submit</button>
                                                    </form>

                                                </div>
                                            </div>    
                                        
                                            

                                        @endif

                                            
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