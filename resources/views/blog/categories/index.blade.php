@extends('layouts.app')

@section('content')

<div class='card'>
    <div class="card-body">
        <h3>All {{$category->title}}</h3>
        <h5><small><a href="/posts">Archive</a></small></h5>

        @include('layouts.include.archivenav')

        @if($posts->count() > 0)

            @include('layouts.include.post-list', array('showUnpublished' => true , 'edit' => false,  'archive' => false))

        @else
            <p>{{$category->title}} archive is empty!</p>
        @endif
       
        
    </div>

     <footer>@include('layouts.include.archivefooter')</footer>

</div>


@endsection