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
            'insertdatetime media contextmenu paste code help wordcount'
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
        <h5>Manage {{$convention->title}}</h5>
    </div>
    <div class="card-body">
        
        <div class="card">
            <div class="card-header">
                <strong>Edit Basic Info</strong>
            </div>
            <div class="card-body">                          

                <form method="POST" action="{{ action('Calendar\ConventionController@update' , $convention->id) }}">
                    @method('PATCH')
                    @csrf

                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="title">Title</label>
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                                        name="title" value="{{ $convention->title }}" required>
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
                                    name="tagline" value="{{ $convention->tagline }}" required > 
                                    @if ($errors->has('tagline'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('tagline') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dates">Dates</label>
                                <div class="row">
                                    <div class="col-md-5 m-1">
                                        <label for="start_date">Start</label><br>
                                        <input type="date" name='start_date' value="{{ $convention->start_date()->format('Y-m-d') }}"
                                        class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                                        required>
                                        @if ($errors->has('start_date'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('start_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-5 m-1">
                                        <label for="end_date">End</label><br>
                                        <input type="date" name='end_date' value="{{ $convention->end_date()->format('Y-m-d') }}"
                                        class="form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                                        required>
                                        @if ($errors->has('end_date'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('end_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>
        
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="lead">Lead Text</label>
                                <textarea class="form-control{{ $errors->has('lead') ? ' is-invalid' : '' }}"
                                    name="lead" id="lead" cols="30" rows="3" >{{ $convention->lead }}
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
                                    id="description" name='description' >
                                    {{ $convention->description }}
                                </textarea>
                                @if ($errors->has('description')) 
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif    
                            </div>
                        </div>
        
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