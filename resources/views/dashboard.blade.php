@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>{{$user->name}}<br><small>{{ $user->roles()->first()->name }}</small></h4></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        You are logged in! 
                        <hr>
                </div>

                <div class="card-body">
                    Here are some members only data and tools.
                </div>

            </div>

            
        </div>
    </div>
</div>
@endsection