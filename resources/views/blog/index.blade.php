@extends('layouts.app')

@section('content')


<div class='card border-0'>
    <div class='card-body'>
        <h3>{{$pagetitle}}</h3>
        
        
        <hr class="my-3">
        <div class="row">
            <div class="col-md-8">
                @if(Request::segment(2) == 'user')
                    @php
                        $member = $posts->first()->user;
                    @endphp
                    
                    <div class="mt-3 mb-4">@include('profile.member.header')</div>

                    <hr class="my-3">
                    <br>
                @endif 

                @if($posts->where('posted_on', '!=', NULL)->count()) 
                    @foreach($posts as $post)
                    
                        <span class="small text-muted">
                            {{$post->datePosted()}}
                        </span>

                        <h5> {{$post->title}} </h5>
                        
                        <h5 class="small mt-2">
                            @if(Request::segment(2) != 'user')
                                <span class="mr-4">
                                    <strong>Author: </strong>
                                    <a href="/posts/user/{{$post->user->id}}" >
                                        {{$post->user->firstname}} {{$post->user->lastname}}
                                    </a>
                                </span>
                            @endif

                            @if(Request::segment(2) != 'category') 
                                <strong>Category: </strong>
                                <a href="/posts/category/{{$post->category}}">
                                    {{$categories->find($post->category)->title}}
                                </a>
                            @endif

                            
                        </h5>

                        <p class='mt-3'>{{$post->lead}}</p>

                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="/post/{{$post->id}}" class="btn btn-sm btn-primary">Read More</a>
                            </div>
                        </div>
                        
                        <hr class="m-4">
                        
                    @endforeach
                @else
                    no posts
                @endif
                {{ $posts->links() }}
            </div>
            <div class="col-md-4">
                @include('blog.menu')
            </div>
        </div>

    </div>

</div>

@endsection