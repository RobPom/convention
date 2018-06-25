@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <div class='row'>
            <div class="col-lg-9">
                <h6><small>{{$category->title}} - {{$post->datePostedString()}}</small></h6>
                <h3>{{$post->title}}</h3>
                <hr>
                <p class="lead">{{$post->lead}}</p>
                <p>{!! nl2br(e($post->body)) !!}</p>
                
                <br>
                <hr>

                @include('layouts.include.memberblock')

                <hr class="d-lg-none">
            </div>
            <br>
            <div class="col">
                    <h4>Latest {{$category->title}}</h4>
                    <br>
                @if($categoryPosts->count() > 1)
                    
                    <ul class='archiveList'>
                        @foreach($categoryPosts as $categoryPost)
                            @if($categoryPost->id !== $post->id)
                                <li> {{$categoryPost->shortDate()}} - <a href='/post/{{$categoryPost->id}}'>{{$categoryPost->title}}</a></li>
                            @endif
                        @endforeach
                    </ul>

                @else
                    <p>No other {{$category->title}} in archives.</p>
                    
                @endif
                    <br>
                    <a href="/posts" class='float-right'>Post Archives</a>
            </div>
    </div>
</div>



@endsection