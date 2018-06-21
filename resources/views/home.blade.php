@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <img  src="holder.js/100px275?text=Convention Banner" class="img-fluid" alt="Responsive image">
    </div>
</div>
<br>
    
<div class="card">
    <div class="card-body">
        <div class='row'>
            <div class="col-md-9">
                <h3>{{$latestPost->title}}</h3>
                <p>posted on 
                    {{ Carbon\Carbon::parse($latestPost->created_at)->format('F jS, Y') }}
                    </p>
                <hr>
                <p class="lead">{{$latestPost->lead}}</p>
                <p>{!! nl2br(e($latestPost->body)) !!}</p>
                <hr>

                <div class='row'>
                    <div class="col-md-2 col-4">
                            <img  src="holder.js/80px80?text=Profile \n Image" class="img-fluid" alt="Responsive image">
                    </div>
                    <div class="col-md-10 col-8" >
                        <p class='authorTitle'>{{$latestAuthor->firstname}} {{$latestAuthor->lastname}}</p>
                        <p class='authorLead'>{{$latestAuthor->email}}</p>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col">
                    <h4>Recent Posts</h4>
                    <br>
                
                    <ul class='archiveList'>
                        @foreach($latestPosts as $post)
                            @if($post !== $latestPost)
                                <li><a href=''>{{$post->title}}</a></li>
                            @endif

                        @endforeach
                    </ul>
            </div>
    </div>
</div>


@endsection