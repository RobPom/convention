@extends('layouts.app')

@section('content')

<div class='card'>
    <div class="card-body">
        <h5>{{$category->title}}</h5><br>


        @if($posts->count() > 0)
            @foreach($posts as $post)
        <div class="container">
            <div class="row">
                <div class="col-3">
                    {{$post->shortDate()}}
                </div>
                <div class="col-9">
                    <a href='/post/{{$post->id}}'>{{$post->title}}</a>
                </div>
            </div>
        </div>
            @endforeach
        @else
            <p>{{$category->title}} archive is empty!</p>
        @endif
        <br>
        <hr>
        <h6>Other Categories</h6>
        
        <p>
            @foreach($categories as $cat)
                @if($category->id !== $cat->id)
                    <a href='/posts/category/{{$cat->id}}'>{{$cat->title}}</a>
                        @if (! $loop->last)
                            ,
                        @endif 
                @endif
                
            @endforeach
        </p>
    </div>

</div>


@endsection