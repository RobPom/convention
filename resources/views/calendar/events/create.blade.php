@extends('layouts.app')

@section('content')

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=b9tfpcb0j76alyl72v128r8su9jlpgn769z8y3khuea30h7u"></script>
<script>
    tinymce.init({
        selector: '1#description',
        plugins: 'link lists xhtmlxtras' , 
        height : "140",
        menubar: false
    });

    tinymce.init({
        selector: '#description',
        height: 140,
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

<div class="card p-2">
    <div class="card-header bg-white">
        <h5>Manage {{$convention->title}}</h5>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <strong>New Event Slot</strong>
            </div>
            <div class="card-body">   

            <form method="POST" action="{{ action('Calendar\TimeslotController@storeEvent') }}">

                @csrf

                <div class="form-group">
                    <label for="inputTitle">Title</label>
                    <input type="text" class="form-control" id="title" name='title' required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="day">Day</label>
                        <select class="form-control" name='day'>
                            @foreach($convention->days() as $day)
                                <option value="{{$day->format('Y-m-d')}}">{{$day->format('l')}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="start_time">Start Time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" value="{{Carbon::now()->format('H:00')}}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="end_time">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time"  value="{{Carbon::now()->addHour()->format('H:00')}}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description">Description <em class='text-muted'>Optional</em></label>
                        <textarea  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                            id="description" name='description' >
                            {{ old('description') }}
                        </textarea>
                        @if ($errors->has('description')) 
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif    
                    </div>
                </div>
                <input type="hidden" name="convention" value="{{$convention->id}}">
                <input type="hidden" name="accept_games" value="0">
                <button type="submit" class="btn btn-primary">Save</button>
            </form>

            
        </div>
    </div>
    </div>
</div>


@endsection