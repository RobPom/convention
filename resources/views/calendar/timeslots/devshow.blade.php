@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        @isset($timeslot->convention)
            @php
                $convention = $timeslot->convention
            @endphp
            @include('calendar.conventions.conventionheader')
        @endisset
        
        <ul class="nav nav-tabs" id="timeslotTabs" role="tablist">

            @foreach($timeslot->convention->timeslots as $ts)
                <li class="nav-item">
                    @if($ts->id == $timeslot->id)
                        <a class="nav-link active" id="{{$ts->id}}tab" data-toggle="tab" href="#tab{{$ts->id}}" role="tab" aria-controls="home" aria-selected="true">{{$ts->title}}</a>
                    @else
                        <a class="nav-link" id="{{$ts->id}}tab" data-toggle="tab" href="#tab{{$ts->id}}" role="tab" aria-controls="home" aria-selected="false">{{$ts->title}}</a>
                    @endif
                </li>
            @endforeach
        </ul>
        <div class="tab-content" id="timeslotTabContent">

            @foreach($timeslot->convention->timeslots as $ts)
                @php 
                    $time = $ts->pretty_times();
                @endphp
                
                @if($ts->id == $timeslot->id)
                    <div class="tab-pane fade show active" id="tab{{$ts->id}}" role="tabpanel" aria-labelledby="{{$ts->id}}tab">
                @else
                    <div class="tab-pane fade" id="tab{{$ts->id}}" role="tabpanel" aria-labelledby="{{$ts->id}}tab">
                @endif
                        <div class="card">
                            <div class="card-header">
                                {{$ts->pretty_times()}}
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                        
                               
 

                    </div>
        
            @endforeach
        </div>
    </div>
</div>

@endsection