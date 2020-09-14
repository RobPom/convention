@extends('layouts.app')

@section('content')

@if ( App\Convention::where('status' , 'active')->count() == 1)

      @include('calendar.convention.banners.fall2020.fall2020')

    @else 
    
      @include('calendar.convention.banners.default')
   
@endif

<div class="container ">
    <div class="row">
        <div class="col-sm-12 pl-0 pr-1 mb-2 ">
            <div class="card border-0">
                <div class="card-body">

                    <h5 class="card-title">IntrigueCon in 2020</h5>
                   
                    <p class="lead">
                      2020 has been a difficult year for a lot of people, and in a lot of different ways. We hope that you’ve managed to navigate your personal challenges or, at the very least, have found a support network to lean on as you persevere. 
                    </p>
                    <p>In an objective sense, when weighed against the scale of global upheaval, the cancellation of an in-person roleplaying convention is trivial. For us though, not being able to get together once a year and share something few other people really understand comes with a genuine sense of loss. Roleplaying is a part of the fabric of many of our lives, and preparing for that weekend in October is an important touchstone along the way. </p>

                    <p>So, in an imperfect world we have an imperfect solution that may allow you to capture just enough of the real thing to carry you through until we can get back around a table together</p>

                    <p>On Saturday, October the 17th we will be hosting an online event so people can get together to play some games, chat with friends, or just lurk in a familiar environment. We’ll be based in and monitoring a discord server to host the games. Of course, as the GM you can choose to facilitate the game any way you want we’re just saying that the IntrigueCon team will only be monitoring the things going on in our <a href="https://discord.gg/DqWAFn">Discord Server</a>. </p>

                    <p>Registration is $5 and for that you’ll be able to submit and play games, and we’ll be able to maintain the servers, renew the domain, and not have to spend hours preventing the schedule getting filled up with what most people would consider spam e.g. games called Rescue Sexy Singles In Your Area or Help the King Discover Ancient Scrolls of Knowledge About How To Lose a Little Belly Fat Each Day. Oh, and I forgot to mention you’ll also get this year’s button mailed out to you</p>
                    <a class='float-center' href='message/1'>Sign Up Today!</a>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-4 pl-0 pr-0 ">
        <div class="card">
            <div class="card-header">
              <h5>Community</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <p >Our collections of links to Edmonton based RPG community and Facebook Groups.</p>
                        <div class="text-center">
                        <a class='btn btn-small btn-primary' href='community'>See All</a>
                    </div>
                    </div>
                </div>  
            </div>
        </div>
        </div> -->
    </div>
</div>



@endsection