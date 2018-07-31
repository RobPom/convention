@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        @include('calendar.conventions.conventionheader')
        
        <p class="lead">
            {{$convention->lead}}
        </p>
        <p>
            {{$convention->description}}
        </p>
    </div>
</div>
<br>      
<div class="card">
    <div class="card-body">
        <h4>Schedule</h4>
        <h4><small>{{$convention->start_date()->format('M jS')}} to {{$convention->end_date()->format('jS, o')}} </small></h4>
        <hr>
        <div class="card-deck">
            @foreach($convention->days() as $day)
                <div class="card">
                    <div class="card-header">
                        {{$day->format('l')}}
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group">
                            @foreach($convention->timeslots as $timeslot)
                                @if($day->isSameDay($timeslot->start_time()))
                                    <a href="/calendar/convention/timeslot/{{$timeslot->id}}" class="list-group-item list-group-item-action">
                                        {{$timeslot->title}}
                                    </a>      
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div> 
    </div>
</div>

@endsection