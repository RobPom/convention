@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card">
                <div class="card-header">
                    <h4>{{$user->name}}<br>
                        <small>{{$user->roles->first()->name}}</small>
                    </h4>
                </div>
                <div class="card-body">
                    - members, organizer and admin data and tools.
                </div>
            </div>
            <br>
            @if( $user->hasRole('organizer') ||  $user->hasRole('admin') )
                <div class="card">
                    <div class="card-header">
                        <h5>Organizer Tools</h5>
                    </div>
                    <div class="card-body">

                        <h5>Users</h5>
                        
                        @foreach($users as $member)
                            {{$member->name}} <br>
                        @endforeach

                    </div>
                </div>
            @endif
            <br>
            @if( $user->hasRole('admin') )
            <div class="card">
                    <div class="card-header">
                        <h5>Admin Tools</h5>
                    </div>
                    <div class="card-body">
                        - admin data and tools.
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>



@endsection