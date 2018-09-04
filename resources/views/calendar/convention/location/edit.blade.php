@extends('layouts.app')

@section('content')

<div class="card p-2">
        <div class="card-header bg-white">
            <h5><a href="/calendar/convention/{{$convention->id}}/manage">Manage {{$convention->title}}</h5></a>
        </div>
        <div class="card-body">
            
            <div class="card">
                <div class="card-header">
                    <strong>Edit Location</strong>
                </div>
                <div class="card-body">
                        <form method="POST" action="{{ action('LocationController@update' , $convention->location_id) }}">
                                @method('PATCH')
                                @csrf
        
                                <div class="form-group">

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="name">Name</label>
                                            <input id="name" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                                                    name="name" value="{{ $location->name}}" required>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="address1">Address 1</label>
                                            <input id="address1" type="text" class="form-control{{ $errors->has('address1') ? ' is-invalid' : '' }}" 
                                                    name="address1" value="{{ $location->address1}}" required>
                                                @if ($errors->has('address1'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('address1') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="address2">Address 2</label>
                                            <input id="address2" type="text" class="form-control{{ $errors->has('address2') ? ' is-invalid' : '' }}" 
                                                    name="address2" value="{{ $location->address2}}" required>
                                                @if ($errors->has('address2'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('address2') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="link">Google Maps Link</label>
                                            <input id="link" type="text" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" 
                                                    name="link" value="{{ $location->link}}" required>
                                                @if ($errors->has('link'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('link') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>
        
                                   
                                    <input type="hidden" name="convention" value="{{$convention->id}}">
                                    <div class="form-row m-2">
                                        <div class="col-sm-6 offset-sm-3">
                                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                                        </div>   
                                    </div>
                                </div>
                        </form>
                </div>
            </div>
        </div>
    </div> 

@endsection