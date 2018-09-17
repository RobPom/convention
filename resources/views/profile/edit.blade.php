@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        @include('profile.member.header')
    </div>
    <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item">
                        <a href="/profile/show/{{$member->id}}">Profile</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        <div class="card">
            <div class="card-header">
                <strong>{{$member->username}}'s Games </strong>
            </div>
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


        <form method="POST" 
                action="{{action('ProfileController@update', $member->id)}}" 
                enctype="multipart/form-data">

            @method('put')
            @csrf

            <div class="form-group row">
                
                <label class="col-sm-4 col-form-label text-md-right">Update Avatar <br>
                    <div class="small em text-muted">For best results make sure your profile pic is square!</div>
                </label>
                
                
                <!-- <label for="avatar" class="ml-3 mt-1 btn btn-sm btn-secondary">Change Image</label> -->
                <input type="file" name="avatar" id="avatar""> 
                @if ($errors->has('avatar'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('avatar') }}</strong>
                </span>
            @endif
            </div>

            <div class="form-group row">

                <label for="firstname" class="col-sm-4 col-form-label text-md-right">First Name</label>

                <div class="col-md-6">
                    <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" 
                        name="firstname" value="{{ $member->firstname }}" maxlength="50" required autofocus>

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
                        name="lastname" value="{{ $member->lastname }}" required maxlength="50">

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
                        name="location" value="{{ $member->profile->location }}" maxlength="50">

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
                        name="description" rows='4' cols="50" maxlength="144"
                        >{{$member->profile->description}}
                    </textarea>

                    @if ($errors->has('about'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            @if(Auth::user()->hasRole('admin'))
            <div class="form-group row" >
                <label for="radio" class="col-sm-4 col-form-label text-md-right"> Verify Email? </label>
                <label class="radio-inline mt-2 ml-3"><input type="radio" name="verify" value="1" {{ $member->verified ? 'checked'  : ''  }} > Yes</label>
                <label class="radio-inline mt-2 ml-2"><input type="radio" name="verify" value="0" {{ $member->verified ? ''  : 'checked'  }} > No</label>
                
            </div>
            <div class="form-group row" >
                <label for="radio" class="col-sm-4 col-form-label text-md-right"> Set as Organizer? </label>
                <label class="radio-inline mt-2 ml-3"><input type="radio" name="organizer" value="1" {{ $member->hasRole('organizer') ? 'checked'  : ''  }} > Yes</label>
                <label class="radio-inline mt-2 ml-2"><input type="radio" name="organizer" value="0" {{ $member->hasRole('organizer') ? ''  : 'checked'  }} > No</label>
                
            </div>

            
            @else
            <input type="hidden" name="verify" value={{ $member->verified ? true  : false  }}>
                @if ($member->hasRole('organizer'))
                    <input type="hidden" name="organizer" value='1'>
                @endif
            @endif
            

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