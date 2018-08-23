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
                    <h5>Manage Timeslots</h5>
                </div>
                
                <table class='table mt-4'>
                    <tr>
                        <td>Add a timeslot</td><td colspan='2'><a href="/calendar/convention/{{$convention->id}}/timeslot/new" class="btn btn-sm btn-secondary">Add</a></td>
                    </tr>
               
                @foreach($convention->timeslots as $timeslot)
                    <tr>
                        <td>{{$timeslot->title}}</td> 
                        <td>{{$timeslot->pretty_times()}}</td>
                        <td> <a href="/calendar/convention/timeslot/{{$timeslot->id}}/edit" class="btn btn-sm btn-secondary">Edit</a></td>
                        <td>
                            <form 
                                onsubmit="return confirm('You cannot undo this. Are you sure you want to delete this time slot?');"
                                action="{{action('Calendar\TimeslotController@destroy', $timeslot->id)}}" 
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach


                </table>
            </div>
        </div>
    </div>
    

</div>

@endsection