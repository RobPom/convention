@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="card-title">
                Index
        </div>
        
        <ul class="list-group list-group-flush">
            @foreach($conventions as $convention)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-6">
                            <strong><a href="/calendar/convention/{{$convention->id}}"> {{$convention->title}}</a></strong>
                        </div>
                        <div class="col-md-6">
                            <small>{{$convention->start_date()->format('l M jS')}} to {{$convention->end_date()->format('l M jS')}}</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col md-6">
                            {{$convention->tagline}}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>



@endsection