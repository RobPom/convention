@extends('layouts.app')

@section('content')

<div class='card'>
    <div class="card-body">
        <h3>All {{$category->title}}</h3><br>

        @if($posts->count() > 0)

        <table class="table table-sm sortable">  
                <thead>
                    <tr>
                        <th scope="col" class="d-none d-md-table-cell">Date</th>
                        <th scope="col" class="d-none d-sm-table-cell">Title</th>
                        <th scope="col" class="d-none d-md-table-cell">Author</th>
                    </tr>
                </thead>
                <tbody>


            @foreach($posts as $post)
            <tr>
                    <td class="d-none d-md-table-cell">{{$post->shortDate()}}</td>
                    <td class="d-none d-sm-table-cell">
                        <a href='/post/{{$post->id}}'>{{$post->title}}</a>
                    </td>
                    <td class="d-none d-md-table-cell">
                        <a href='/profile/show/{{$post->user->id}}'>{{$post->user->firstname}} {{$post->user->lastname}}</a>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>

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