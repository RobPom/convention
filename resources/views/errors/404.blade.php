@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"><h4>404 Not Found</h4></div>
        <div class="card-body">
                <p>{{ $exception->getMessage() }}</p>
        </div>
    </div>
        
@endsection