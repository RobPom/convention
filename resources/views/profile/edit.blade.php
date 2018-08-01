@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header"><h5>Edit Profile</h5></div>

    <div class="card-body">

        
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif


        <form method="POST" action="{{action('ProfileController@update', $member->id)}}" >
            @method('put')
            @csrf

            <div class="form-group row">

                <label for="firstname" class="col-sm-4 col-form-label text-md-right">First Name</label>

                <div class="col-md-6">
                    <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" 
                        name="firstname" value="{{ $member->firstname }}" required autofocus>

                    @if ($errors->has('firstname'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                
                <label for="lastname" class="col-sm-4 col-form-label text-md-right">Last Name</label>

                <div class="col-md-6">
                    <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" 
                        name="lastname" value="{{ $member->lastname }}" required>

                    @if ($errors->has('lastname'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                
                <label for="location" class="col-sm-4 col-form-label text-md-right">Location</label>

                <div class="col-md-6">
                    <input id="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" 
                        name="location" value="{{ $member->profile->location }}" >

                    @if ($errors->has('location'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                
                <label for="description" class="col-sm-4 col-form-label text-md-right">About</label>

                <div class="col-md-6">

                    <textarea id="description"  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                        name="description" rows='4' cols="50"
                        >{{$member->profile->description}}
                    </textarea>

                    @if ($errors->has('about'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row" >
                <label for="radio" class="col-sm-4 col-form-label text-md-right"> Verify Email? </label>
                <label class="radio-inline mt-2 ml-3"><input type="radio" name="verify" {{ $member->verified ? 'checked'  : ''  }} > Yes</label>
                <label class="radio-inline mt-2 ml-2"><input type="radio" name="verify" {{ $member->verified ? ''  : 'checked'  }} > No</label>
                
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection