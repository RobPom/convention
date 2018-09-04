@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        <h5><a href="/calendar/convention/{{$convention->id}}/manage">Manage {{$convention->title}}</h5></a>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <a href="/calendar/convention/{{$convention->id}}/manage" class=""><i class="material-icons text-with-icon">event</i></a>
                <div class="inline-block text-with-icon "><strong>New Attendee</strong></div> 
            </div>
            <div class="body">
                <div class="card">
                    <div class="card-body">
                            <form method="POST" action="{{ action('Calendar\AttendeeController@store') }}">
            
                                    @csrf
                        
                                    <div class="form-group row">
                                        <label for="firstname" class="col-md-4 col-form-label text-md-right">First Name</label>
                        
                                        <div class="col-md-6">
                                            <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>
                        
                                            @if ($errors->has('firstname'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('firstname') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                    
                                    <div class="form-group row">
                                            <label for="lastname" class="col-md-4 col-form-label text-md-right">Last Name</label>
                            
                                            <div class="col-md-6">
                                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>
                            
                                                @if ($errors->has('lastname'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('lastname') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                    
                                        <div class="form-group row">
                                                <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                                
                                                <div class="col-md-6">
                                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                                
                                                    @if ($errors->has('username'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                        
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <input type="hidden" name="convention" value="{{$convention->id}}">
                        
                        
                                    <div class="form-group row mb-0">
                                        <div class="col-md-4 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Create and Add to Convention
                                            </button>
                                        </div>
                                    </div>
                            </form>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>

@endsection