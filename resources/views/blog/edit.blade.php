@extends('layouts.app')

@section('content')

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
        relative_urls : false,
        remove_script_host : true,
        document_base_url : "http://www.intriguecon.com",
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


<div class="card p-2 border-0">
        <div class="card-header bg-white border-0">
            @php $member = Auth::user() @endphp
                @include('profile.member.header')
        </div>
        <div class="card-body">
            <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item">
                        <a href="/profile/show/{{Auth::user()->id}}">Profile</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    <strong> Create a New Post </strong>
                </div>
                <div class="card-body">

        <form method="POST" action="{{ action('BlogPostController@update' , $blogPost->id) }}">
                @method('PATCH')
                @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name='title' class="form-control" required
                oninvalid="this.setCustomValidity('This post needs a name!')"
                oninput="setCustomValidity('')" value="{{$blogPost->title}}">
            </div>
            <div class="form-group">
                <label for="category">Select a Category</label>
                <select name="category" id="category" class="form-control form-control-sm">
                    @foreach( $categories as $category)
                        @if($category->id == $blogPost->category)
                            <option value="{{$category->id}}" selected>{{$category->title}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endif         
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="lead">Lead Text</label>
                <textarea class="form-control" name="lead" id="lead" cols="30" rows="2">{{$blogPost->lead}}</textarea>
            </div>
            <div class="form-group">
                <label for="body">Post</label>

                <textarea id="post-body" name='body'>{!!$blogPost->body!!}</textarea>
                
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>
</div>

@endsection