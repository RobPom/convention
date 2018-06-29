@extends('layouts.app')

@section('content')

<div class='card'>
    <div class='card-body'>
            <h3>Archive</h3>
            <hr>
            <h5>Categories</h5>

            @foreach($categories as $link)
            <a href="/posts/category/{{$link->id}}">{{$link->title }} </a>@if( ! $loop->last) ,  @endif
            @endforeach

            <br>
            <hr>
        @if ($posts)
            <table class="table table-sm sortable">  
                <thead>
                    <tr>
                        <th scope="col-2" class="d-none d-sm-table-cell">Published</th>
                        <th scope="col-8" class="d-sm-table-cell">Title</th>
                        <th scope="col-2" class="d-none d-md-table-cell">Category</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        @if($post->published())
                            @php
                                $category = App\BlogCategory::find($post->category);
                            @endphp
                            <tr>
                                <td class="d-none d-sm-table-cell">{{$post->shortDate()}}</td>
                                <td class="d-sm-table-cell"><a href='/post/{{$post->id}}'>{{$post->title}}</a></td>
                                <td class="d-none d-md-table-cell"><a href='/posts/category/{{$category->id}}'>{{$category->title}}</a></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No posts to show</p>
        @endif

    </div>
</div>


@endsection


