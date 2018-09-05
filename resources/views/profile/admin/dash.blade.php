@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
       <h5>{{$user->firstname}} {{$user->lastname}} </h5>
    </div>
    <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item">
                        <!-- <a href="/calendar/convention/{{$convention->id}}">Convention</a> -->
                    </li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Schedule</li> -->
                </ol>
            </nav>
        <div class="card">
            <div class="card-header">
                <strong>Admin </strong>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="card-title lead">
                                    Users
                                </div>
                            </div>
                            <div class="col text-center">
                                <a href="/profiles/all">{{$users->count()}} Users</a>
                            </div>
                            <div class="col text-center">
                                <a href=""># Organizers</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection