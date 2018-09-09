@extends('layouts.app')

@section('styles')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=b9tfpcb0j76alyl72v128r8su9jlpgn769z8y3khuea30h7u"></script>
<script>
    tinymce.init({
        selector: '1#description',
        plugins: 'link lists xhtmlxtras' , 
        height : "200",
        menubar: false
    });

    tinymce.init({
        selector: '#description',
        height: 500,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo | formatselect | bold italic  | alignleft aligncenter alignright alignjustify | bullist numlist | link',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css']
        });
</script>

@endsection

@section('content')

<div class="card p-2">

    <div class="card-header bg-white">
        <h5>@if(Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin'))
                {{Auth::user()->firstname}} {{Auth::user()->lastname}}
            @else
                {{Auth::user()->username}}
            @endif</h5>
        <h5><small>{{Auth::user()->profile->description}}</small></h5>
    </div>
    

    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item">
                    <a href="/profile/show/{{Auth::user()->id}}">Profile</a>
                </li>
                <li class="breadcrumb-item">
                        <a href="/profile/{{Auth::user()->id}}/games">Games</a>
                    </li>
                <li class="breadcrumb-item active" aria-current="page">Create Game</li>
            </ol>
        </nav>
        <div class="card ">
            <div class="card-header">Create a Game</div>
            <div class="card-body">
                <form method="POST" action="{{ action('GameController@store') }}" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="title">Title</label>
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                                        name="title" value="{{ old('title') }}" >
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="tagline">Tagline</label>
                                <input id="tagline" type="text" 
                                    class="form-control{{ $errors->has('tagline') ? ' is-invalid' : '' }}" 
                                    name="tagline" value="{{ old('tagline') }}" > 
                                    @if ($errors->has('tagline'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('tagline') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="system">System</label>
                                <input id="system" type="text" 
                                class="form-control{{ $errors->has('system') ? ' is-invalid' : '' }}" 
                                name="system" value="{{ old('system') }}" >
                                @if ($errors->has('system'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('system') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="advisory">Advisory</label>
                                <input id="advisory" type="text" class="form-control{{ $errors->has('advisory') ? ' is-invalid' : '' }}" 
                                name="advisory" value="{{ old('advisory') }}">
                                @if ($errors->has('advisory'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('advisory') }}</strong>
                                    </span>
                               @endif

                            </div>
                        </div>
            
                        <div class="form-row border rounded p-3 my-3">
                            <div class="form-group col-md-6 ">
                                <strong>Players</strong>
                            </div>
        
                            <div class="col-sm-3">     
                                <label for="min">Minimum</label>
                                <input id="min" type="number" name="min" 
                                    min="1" max="12" name="min" 
                                    value="{{ old('min') }}"
                                    class="form-control{{ $errors->has('min') ? ' is-invalid' : '' }}" >

                                    @if ($errors->has('min'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('min') }}</strong>
                                        </span>
                                    @endif
    
                            </div>
        
                            <div class="col-sm-3">
                                <label for="max">Max </label>
                                <input id="max" type="number" name="max" 
                                    min="1" max="12" name="max" 
                                    value="{{ old('max') }}"
                                    class="form-control{{ $errors->has('max') ? ' is-invalid' : '' }}" >
                                    @if ($errors->has('min'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('max') }}</strong>
                                        </span>
                                    @endif
                                    
                            </div>
                        </div>
                        <hr>
                            <label>Select image to upload: </label>
                            <input type="file" name="image" id="file">
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="lead">Lead Text</label>
                                <textarea class="form-control{{ $errors->has('lead') ? ' is-invalid' : '' }}"
                                    name="lead" id="lead" cols="30" rows="2">
                                    {{ old('lead') }}
                                </textarea>
                                @if ($errors->has('lead'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lead') }}</strong>
                                    </span>
                                @endif    
                            </div>
                        </div>
                                
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                                    id="description" name='description'>
                                </textarea>
                                @if ($errors->has('description')) 
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif    
                            </div>
                        </div>
        
                        <div class="form-row">
                            <div class="form-check m-2">
                                
                                <input class="form-check-input" type="checkbox" id="active" name='active'>
                                <label class="form-check-label" for="draft">
                                        Save as Draft
                                </label>
                            </div>
                        </div>

                        <div class="form-row m-2">
                            <div class="col-sm-6 offset-sm-3">
                                <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
                            </div>   
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

        
@endsection