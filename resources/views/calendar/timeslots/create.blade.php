@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5> <small> Organizer Dashboard </small></h5>
            <h3>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h3>
        </div>
        <div class="card mt-4">
            <div class="card-header lead bg-white">
                <a href="/calendar/convention">{{$convention->title}}</a> <br>
                <small>{{$convention->start_date()->format('l F jS')}} to {{$convention->end_date()->format('l F jS')}}</small>
            </div>

            <div class="card-body">
                <div class="card-title">
                    <h5>Add a Timeslot</h5>
                </div>

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
                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="end_time">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" required>
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