@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"><h4>403 Forbidden</h4></div>
        <div class="card-body">
                <p>{{ $exception->getMessage() }}</p>
        </div>
    </div>
        
@endsection