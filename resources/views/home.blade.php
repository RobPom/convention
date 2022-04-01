@extends('layouts.app')

@section('content')

@if ( App\Convention::where('status' , 'active')->count() == 1)

      @include('calendar.convention.banners.spring2022.spring2022')

    @else

      @include('calendar.convention.banners.spring2022.spring2022')

@endif

<div class="container ">
    <div class="row">
        <div class="col-sm-12 pl-0 pr-1 mb-2 ">
            <div class="card border-0">
                <div class="card-body">

                    <h2 class="card-title">IntrigueCon Spring 2022</h2>

                    <p class="lead">Hello new visitors, and old friends alike!</p>
                    <p>First the good news. We’re back! It’s taken us a little longer than anticipated to get on top of the virus, but we’ve proven, once again. why we’re the world’s premier roleplaying convention/bio-tech company.</p>
                    <p>IntrigueCon’s spring event, perfectly entitled, “The Return of the Spring”, is set to go May 6th and 7th. Registration will be $32 and both players and GMs will be given the opportunity to part with your hard earned cash on April 1st sometime around second breakfast.</p>
                    <p>What does all of this mean? Well, it’s definitely an indication that you should start writing those games and promoting the con in your day-to-day. You’d also be well-advised to to keep in mind that this event has about half of the usual spots available at our October con, so, don’t delay or prevaricate. There’s maybe an opportunity for a short shilly-shally but I wouldn’t consider even a modest hem and/or haw.</p>
                    <p>Now that you’re fully committed, if you’re new to the con, and you haven’t already made a profile, your first move is to create an IntrigueCon account. Why? Well, you’ll need a profile before you can buy a registration for any con we hold, and you’ll need to be registered to book your spots in games and submit any games of your own. Now, if you’ve made a profile before, you are all set and probably know what to do.</p>
                    <p>At this point we'd be remiss if we didn’t acknowledge all of you who have stood behind us through all the on-again off-again over the past few years. Your enthusiasm for the event and your willingness to pitch-in are what make it a no-brainer to keep IntrigueCon going.</p>
                    <p>You’ve become a community to be proud of.</p>

                    <h3>Registration</h3>
                    <p>Everyone, who hasn’t already made a profile for previous years, needs to create an intriguecon <a href="https://intriguecon.com/register">account</a>. You’ll need a profile before you can buy a registration for any con we hold. If you’ve made a profile before you are all set.</p>
                    <p>You can register for the convention <a href="https://intriguecon.com/calendar/convention/11/register"></a></p>

                    <h3>Date and Time</h3>
                    <p>It begins Friday the 6th of May at 7pm, with doors open at 6pm for chatting, reminiscing, and doing some of that helping I was talking about before. Ends Saturday the 7th at midnight-ish. One session on Friday and three on Saturday (exact times to follow but pretty much the same as other years).</p>

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
