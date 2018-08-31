@extends('layouts.app')

@section('content')

<div class="card p-2">
        <div class="card-header bg-white">
            <h5><a href="/calendar/convention/{{$convention->id}}/manage">Manage {{$convention->title}}</h5></a>
        </div>
        <div class="card-body">
            
            <div class="card">
                <div class="card-header">
                    <strong>Edit Location</strong>
                </div>
                <div class="card-body">
    
                </div>
            </div>
        </div>
    </div> 

@endsection