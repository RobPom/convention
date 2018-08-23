@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h3>{{$game->user->username}}</h3>
        <small>{{$game->user->profile->description}}</small>
        <hr>
    
    <ul class="nav nav-tabs" id="dashboard-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="games-tab" href="/profile/show/{{$game->user->id}}?tab=games">Games</a>
        </li>
    </ul>
    <div class="tab-content" id="dashboardTabContent">
        <div class="tab-pane fade {{ ! count($_GET) ? 'active show' : '' }}" id="games" role="tabpanel" aria-labelledby="games-tab">
            <div class="card">
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
</div>
</div>

@endsection