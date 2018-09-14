@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
       <div class="lead my-3"> Welcome to the home of IntrigueCon, a tabletop roleplaying game convention based in Edmonton, Alberta, Canada. </div>

        <p>Since 2013 Edmonton’s roleplaying community has gathered in October (and now April too) to share their love of games from Dungeons & Dragons to The Quiet Year and everything in between. In fact, at last count, attendees have run almost 100 different game systems. So, it’s fair to say that if trying new things with great people passionate about roleplaying is your thing, there’s no better place to be than IntrigueCon.</p>
        
        <p>Oh, and you needn’t worry about fitting in! We’re fiercely supportive of gamers of all kinds and experience levels. The Game Masters at IntrigueCon love the games they’re running and are excited to be able to share them with you, and to share in the experiences you bring to the table.</p>
        
        <p>So come on, join us!</p>
        
    </div>
    <div class="col-md-4">

        <div class="row mt-3">
            <div class="col-12">
                @include('calendar.convention.banners.fall2018narrow')
            </div>
            <div class="col-12">
                <div class="card mt-2">
                   
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
                                                        style="height:20px ; border-radius: 50%;"
                                                        src='/img/avatar/default.jpg'
                                                        alt="Avatar Placeholder">
                                                @else
                                                    <img class="img-fluid align-self-center mb-1" 
                                                        style="height:20px ; border-radius: 50%;"
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

                </div>
            </div>
        </div>
      
    </div>
</div>



@endsection