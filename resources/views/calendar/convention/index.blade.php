@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5>Conventions, Past and Present</h5>
        </div>
        @auth
            @if(Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin') )
            <a href="/calendar/convention/new">Create a new convention</a>
            @endif
        @endauth
        
        @if($conventions->where('status' , 'active')->count())
            <ul class="list-group list-group-flush m-2 mt-4">
                <strong>Upcoming</strong>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-6">
                            <strong><a href="/calendar/convention/{{$conventions->where('status' , 'active')->first()->id}}"> {{$conventions->where('status' , 'active')->first()->title}}</a></strong>
                        </div>
                        <div class="col-md-6 text-right">
                            <small>{{$conventions->where('status' , 'active')->first()->start_date()->format('M jS')}} to {{$conventions->where('status' , 'active')->first()->end_date()->format('M jS, Y')}}</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{$conventions->where('status' , 'active')->first()->tagline}}
                        </div>
                        <div class="col-md-6 text-right">
                            @auth
                                @if(Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin') )
                                <a href="/calendar/convention/{{$conventions->where('status' , 'active')->first()->id}}/manage" class="m-1 btn btn-sm btn-secondary" >Manage</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </li>
            </ul>
        @endif
        
        @if($conventions->where('status' , 'archived')->count())
            <ul class="list-group list-group-flush m-2 mt-4">
                <strong>Archived</strong>
                @foreach($conventions->where('status' , 'archived') as $archived)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-6">
                                <strong><a href="/calendar/convention/{{$archived->id}}"> {{$archived->title}}</a></strong>
                            </div>
                            <div class="col-md-6 text-right">
                                <small>{{$archived->start_date()->format('M jS')}} to {{$archived->end_date()->format('M jS, Y')}}</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {{$archived->tagline}}
                            </div>
                            <div class="col-md-6">
                               
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

        @auth
            @if(Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin'))
                @if($conventions->where('status' , 'inactive')->count())
                    <ul class="list-group list-group-flush m-2 mt-4">
                        <strong>Inactive</strong>
                        @foreach($conventions->where('status' , 'inactive') as $inactive)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong><a href="/calendar/convention/{{$inactive->id}}"> {{$inactive->title}}</a></strong>
                                    </div>
                                    <div class="col-md-6">
                                           
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{$inactive->tagline}}
                                    </div>
                                    <div class="col-md-6">
                                        <form class='form-inline float-right'
                                            onsubmit="return confirm('You cannot undo this. Are you sure you want to delete this convention?');"
                                            action="{{action('Calendar\ConventionController@destroy', $inactive->id)}}" 
                                            method="post">

                                            @csrf
                                            @method('DELETE')
                                      
                                            <a href="/calendar/convention/{{$inactive->id}}/manage" class="m-1 btn btn-sm btn-secondary" >Manage</a>
                                         
                                            <button class="m-1 btn btn-sm btn-danger" type="submit">Delete</button>

                                        </form> 
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                @endif
            @endif
        @endauth
        
    </div>
</div>



@endsection