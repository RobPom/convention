@extends('layouts.app')

@section('content')

<div class="card p-2">
        <div class="card-header bg-white">
            <h5><a href="/calendar/convention/{{$convention->id}}/manage">Manage {{$convention->title}}</h5></a>
        </div>
        <div class="card-body">
            
            <div class="card">
                <div class="card-header">
                    <strong>Change Location</strong>
                </div>
                <div class="card-body">
                    <a href="/calendar/convention/{{$convention->id}}/location/create" class="btn btn-sm btn-secondary mb-3">add new</a>
                
                @if($locations->isEmpty())
                    <p>no locations</p>
                @else
                    @foreach($locations as $location)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-8">
                                    {{$location->name}} <br>
                                    <small>{{$location->address1}} {{$location->address2}}</small>
                                </div>
                                <div class="col-sm-4 text-right">
                                  @if($convention->location !== null)
                                    @if($location->id == $convention->location->id)
                                       <em> selected</em>
                                    @else
                                    <form 
                                        action="{{action('LocationController@set')}}" 
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="location" value="{{$location->id}}">
                                        <input type="hidden" name="convention" value="{{$convention->id}}">
                                        <button class="btn btn-sm btn-primary mb-1" type="submit">select</button>
                                    </form>
                                    @endif
                                  @else
                                  <form 
                                    action="{{action('LocationController@set')}}" 
                                    method="post">
                                    @csrf
                                    <input type="hidden" name="location" value="{{$location->id}}">
                                    <input type="hidden" name="convention" value="{{$convention->id}}">
                                    <button class="btn btn-sm btn-primary mb-1" type="submit">select</button>
                                </form>
                                  @endif
                                </div>
                            </div>
                           
                        </li>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </div> 

@endsection