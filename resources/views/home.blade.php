@extends('layouts.app')

@section('content')

@if ( App\Convention::where('status' , 'active')->count() )
    @include('calendar.convention.banners.spring2019')
@endif

@isset($lead)
<div class="card my-2 border-0">
    <div class="card-body ">
        <div class='row'>
            <div class="col">
                <h6><small>
                    <a href="/posts/category/{{$lead->category()->id}}">
                        {{$lead->category()->title}}
                    </a>
                </small></h6>
                <h3>{{$lead->title}}</h3>
                <h6><small>

                    @if($lead->user->avatar == 'default.jpg')
                        <img class="img-fluid align-self-centerb-1 mb-1" 
                            style="height:20px ; max-width: 20px; border-radius: 50%;"
                            src='/img/avatar/default.jpg'
                            alt="Avatar Placeholder">
                    @else
                        <img class="img-fluid align-self-center mb-1" 
                            style="height:20px ; max-width: 20px; border-radius: 50%;"
                            src="/storage/uploads/avatars/{{$lead->user->avatar}}"
                            alt="Avatar Placeholder">
                    @endif

                     <a href='/profile/show/{{$lead->user->id}}'>{{$lead->user->firstname}} {{$lead->user->lastname}} </a>
                     on 
                     {{ $lead->datePosted() }}
                    </small>
                </h6>
                <hr>
                <p class="lead">{{$lead->lead}}</p>
                <a class='float-right' href='post/{{$lead->id}}'>Read More...</a>
                <br>
            </div>   
        </div>
    </div>
</div>
@endisset

@isset($featured)
<div class="container">
    <div class="row">
        <div class="col-sm-6 pl-0 pr-1 mb-2">
            <div class="card border-0">
                <div class="card-body">
                    <h6><small>
                        <a href="/posts/category/{{$featured->category()->id}}">{{$featured->category()->title}}</a>
                    </small></h6>
                    <h5 class="card-title">{{$featured->title}}</h5>
                    <h6><small>
                        @if($featured->user->avatar == 'default.jpg')
                            <img class="img-fluid align-self-center mb-1" 
                                style="height:20px ; max-width: 20px; border-radius: 50%;"
                                src='/img/avatar/default.jpg'
                                alt="Avatar Placeholder">
                        @else
                            <img class="img-fluid align-self-center mb-1" 
                                style="height:20px ;max-width: 20px;  border-radius: 50%;"
                                src="/storage/uploads/avatars/{{$featured->user->avatar}}"
                                alt="Avatar Placeholder">
                        @endif
                        <a href='/profile/show/{{$featured->user->id}}'>{{$featured->user->firstname}} {{$featured->user->lastname}} </a>
                        on 
                        {{ $featured->datePosted() }}
                    </small></h6>
                    <br>
                    <p class="lead">{{substr($featured->lead , 0 , 120) }} ...</p>
                    <a class='float-right' href='post/{{$featured->id}}'>Read More...</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 pl-0 pr-0 ">
        <div class="card">
            <div class="card-body">
                <h5>The Con</h5>
                <p>All about IntrigueCon, convention archive, photos</p>
                <a class='float-right' href='post/{{$lead->id}}'>More...</a>
            </div>
        </div>
    </div>
    </div>
</div>
@endisset


@endsection