@extends('layouts.app')

@section('content')
<div class="card p-2">

        <div class="card-header bg-white">
            <h5>@if($member->hasRole('organizer') || $member->hasRole('admin'))
                    {{$member->firstname}} {{$member->lastname}}
                @else
                    {{$member->username}}
                @endif</h5>
            <h5><small>{{$member->profile->description}}</small></h5>
        </div>
        
    
        <div class="card-body">
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
                    <div class="lead mb-3">
                        {{$game->lead}}
                    </div>
                    {!!$game->description!!}
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