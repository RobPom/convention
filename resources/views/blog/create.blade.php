@extends('layouts.app')

@section('styles')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=b9tfpcb0j76alyl72v128r8su9jlpgn769z8y3khuea30h7u"></script>
<script>
    tinymce.init({
        selector: '1#post-body',
        plugins: 'link lists xhtmlxtras' , 
        height : "200",
        menubar: false
    });

    tinymce.init({
        selector: '#post-body',
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

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<div class='card'>
    <div class='card-body'>
            
        <h3>Create a Post</h3>

        <form method="POST" action="{{ action('BlogPostController@store') }}">
                @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name='title' class="form-control" required
                oninvalid="this.setCustomValidity('This post needs a name!')"
                oninput="setCustomValidity('')">
            </div>
            <div class="form-group">
                <label for="category">Select a Category</label>
                <select name="category" id="category" class="form-control form-control-sm">
                    @foreach( $categories as $category)
                        @if($category->title == 'Uncategorized')
                        <option value="{{$category->id}}" selected>{{$category->title}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endif         
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="lead">Lead Text</label>
                <textarea class="form-control" name="lead" id="lead" cols="30" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="body">Post</label>

                <textarea id="post-body" name='body'></textarea>
                
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>
</div>

@endsection
