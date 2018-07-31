@extends('layouts.app')

@section('content')

<div class='card'>
    <div class='card-body'>
        <h3>Latest Posts</h3>
        <h5><small><a href="/posts">Archive</a></small></h5>
        <br>
        @if ($posts) 
            @foreach($posts as $post)
            <div class="card">
                <div class="card-body">
                    <div class='row'>
                            <div class="col">
                                <h6><small><a href='/posts/category/{{App\BlogCategory::find($post->category)->id}}'>
                                    {{App\BlogCategory::find($post->category)->title}}</a></small></h6>
                                <h3>{{$post->title}}</h3>
                                <h6><small>posted by 
                                    <a href='/profile/show/{{$post->user->id}}'>{{$post->user->firstname}} {{$post->user->lastname}} </a>
                                    on 
                                    {{ $post->datePosted()}}
                                    </small>
                                </h6>
                                <hr>
                                <p class="lead">{{$post->lead}}</p>
                                <a class='float-right' href='/post/{{$post->id}}'>Read More...</a>
                                <br>
                            </div>   
                        </div>
                    </div> 
            </div>
            <br> 
            @endforeach
        @endif

    </div>

    <footer>@include('layouts.include.archivefooter')</footer>
</div>


@endsection