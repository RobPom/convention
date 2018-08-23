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
                <a href="/calendar/convention">{{$timeslot->convention->title}}</a> <br>

                <small>{{$timeslot->convention->start_date()->format('l F jS')}} to {{$timeslot->convention->end_date()->format('l F jS')}}</small>
            </div>

            <div class="card-body">
                <div class="card-title">
                    <h5>Edit Timeslot</h5>
                </div>
            <div class="card-body">
                
                <form method="POST" 
                    action="{{ action('Calendar\TimeslotController@update' , $timeslot->id) }}">

                    @method('PATCH')
                    @csrf

                    <div class="form-group">
                        <label for="inputTitle">Title</label>
                        <input type="text" class="form-control" 
                        id="title" name='title' 
                        value="{{$timeslot->title}}"
                        required>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="day">Day</label>
                            <select class="form-control" name='day'>
                                @foreach($timeslot->convention->days() as $day)
                                    <option value="{{$day->format('Y-m-d')}}"
                                        @if($timeslot->start_time()->format('l') == $day->format('l')))
                                            selected
                                        @endif
                                    >{{$day->format('l')}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="start_time">Start Time</label>
                            <input type="time" class="form-control" 
                                id="start_time" name="start_time" 
                                value="{{$timeslot->start_time()->format('H:i:s')}}"
                                required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="end_time">End Time</label>
                            <input type="time" class="form-control" 
                            id="end_time" name="end_time" 
                            value="{{$timeslot->end_time()->format('H:i:s')}}"
                            required>
                        </div>
                    </div>
                    <input type="hidden" name="convention" value="{{$timeslot->convention->id}}">
                    <button type="submit" class="btn btn-primary">Save</button>

                </form>    
            </div>
        </div>
    </div>
</div>


@endsection