@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-md-8 text-center text-md-left">
                <h5> <a href="/calendar/convention/{{$convention->id}}">{{$convention->title}}</a> </h5>
            </div>
            <div class="col-md-4 text-center text-md-right">
                <small>{{$convention->pretty_dates()}}</small>
            </div>
        </div>
        <div class="row mt-1">

            <div class="col-md-8 text-center text-md-left">
                <h5><small>{{$convention->tagline}}</small></h5>
            </div>
            
            @auth
                @if( Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin')  )
                    @if($convention->status != 'archived')
                        <div class="col-md-4 text-right">
                            <a href="/calendar/convention/{{$convention->id}}/manage" class="btn btn-sm btn-primary">Manage</a>
                        </div>
                    @endif
                @endif
            @endauth

        </div>  
    </div>
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item">
                    <a href="/calendar/convention/{{$convention->id}}">Convention</a>
                </li>
                <li class="breadcrumb-item"><a href="/calendar/convention/{{$convention->id}}/games">Games</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$game->title}}</li>
            </ol>
        </nav>
        
            <div class="card">
                <div class="card-header">
                <strong> Game</strong>
                </div>
                <div class="card-body">
                    
                    <div class="card-title">
                        <h5>{{$game->title}}</h5>
                        <h5><small>{{$game->tagline}}</small></h5>
                    </div>
                    <div class="my-2 lead">
                        {{$game->lead}}
                    </div>
                    <div class="my-2">
                        <p>{!! $game->description !!}</p>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <strong>Gamemaster: </strong>
                            {{$game->user->username}}
                        </div>
                        <div class="col">
                            {{$game->system}}
                        </div>
                        <div class="col">
                            {{$game->max}} Players
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>
@endsection