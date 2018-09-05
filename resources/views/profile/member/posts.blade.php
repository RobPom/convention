@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        <h5>@if($member->hasRole('organizer') || $member->hasRole('admin'))
                {{$member->firstname}} {{$member->lastname}}
            @else
                {{$member->username}}
            @endif</h5>
        <h5><small>{{$member->profile->description}}</small></h5>
    </div>
    <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item">
                        <a href="/profile/show/{{$member->id}}">Profile</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Games</li>
                </ol>
            </nav>
        <div class="card">
            <div class="card-header">
                <strong>{{$member->username}}'s Games </strong>
            </div>
            <div class="card-body">

            @auth
                @if ($user->id == $member->id)
                    @include('layouts.include.post-list', array('showUnpublished' => true, 'edit' => true,  'posts' => $member->blogPosts, 'archive' => true))
                @else
                    @include('layouts.include.post-list', array('showUnpublished' => false, 'edit' => false,'posts' => $member->blogPosts, 'archive' => true))
                @endif
            @else
                @include('layouts.include.post-list', array('showUnpublished' => false, 'edit' => false,'posts' => $member->blogPosts, 'archive' => true))
            @endauth
            @auth
            @if($member->hasAnyRole(['organizer' , 'admin']))
            <div class="text-right">
                <a href="/posts/new" class="mt-2 btn btn-sm btn-secondary">New</a>
            </div>
            @endif
        @endauth

        </div>
    </div>
</div> 

@endsection