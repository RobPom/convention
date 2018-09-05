@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        <h5> <a href="/calendar/convention/{{$convention->id}}/manage">Manage {{$convention->title}}</h5></a>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <strong>New Game Slot</strong>
            </div>
            <div class="card-body">   

            <form method="POST" action="{{ action('Calendar\TimeslotController@store') }}">

                @csrf

                <div class="form-group">
                    <label for="inputTitle">Title</label>
                    <input type="text" class="form-control" id="title" name='title' required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="day">Day</label>
                        <select class="form-control" name='day'>
                            @foreach($convention->days() as $day)
                                <option value="{{$day->format('Y-m-d')}}">{{$day->format('l')}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="start_time">Start Time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" value="12:00")}}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="end_time">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time"  value="16:00" required>
                    </div>
                </div>
                <input type="hidden" name="convention" value="{{$convention->id}}">
                <button type="submit" class="btn btn-primary">Save</button>
            </form>

            
        </div>
    </div>
    </div>
</div>


@endsection