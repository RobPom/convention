@extends('layouts.app')

@section('content')
<div class="card p-2 border-0">

        <div class="card-header bg-white border-0">
                @include('profile.member.header')
        </div>
        
    
        <div class="card-body">
                <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item">
                        <a href="/profile/show/{{$member->id}}">Profile</a>
                    </li>
                    <li class="breadcrumb-item">
                            <a href="/profile/{{$member->id}}/games">Games</a>
                        </li>
                    <li class="breadcrumb-item active" aria-current="page">{{$game->title}}</li>
                </ol>
            </nav>
            <div class="card ">
                <div class="card-header">
                    <strong>{{$game->title}}</strong> <br>
                    <small>{{$game->tagline}}</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 text-center">
                                @if($game->image == 'default.jpg')
                                <img class="img-fluid align-self-center pull-left mr-3 mb-2" 
                                    style="max-height:240px ;"
                                    src='/img/game_images/default.jpg'
                                    alt="Avatar Placeholder">
                            @else
                                <img class="img-fluid align-self-center mr-3 mb-2" 
                                    style="max-height:240px ;"
                                    src="/storage/uploads/game_images/{{$game->image}}"
                                    alt="Avatar Placeholder">
                            @endif
                        </div>
                        <div class="col-sm-9">
                            <div class="lead mb-3">
                                {{$game->lead}}
                            </div>
                            {!!$game->description!!}
                        </div>
                    </div>
                  
                    
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm text-center"><small><strong>{{$game->system}}</strong></small></div>
                        <div class="col-sm text-center"><small><strong>{{$game->advisory}}</strong></small></div>
                        <div class="col-sm text-center"><small><strong>{{$game->max}} seats total</strong></small></div>
                    </div>
                </div>
            </div>
      
    </div>
</div>


@endsection