@extends('layouts.app')

@section('content')

<div class='card'>
    <div class='card-body'>
        <h3>Archive</h3>

        @include('layouts.include.archivenav')

        @if ($posts)
        
        @include('layouts.include.post-list', array('showUnpublished' => false , 'edit' => false, 'archive' => true))
            
        @else
            <p>No posts to show</p>
        @endif

    </div>

    <footer>@include('layouts.include.archivefooter')</footer>
</div>


@endsection


