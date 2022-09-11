@extends('layouts.app')

@section('content')

@if ( App\Convention::where('status' , 'active')->count() == 1)

      @include('calendar.convention.banners.fall2022.default')

    @else

      @include('calendar.convention.banners.default')

@endif

<div class="container ">
    <div class="row">
        <div class="col-sm-12 pl-0 pr-1 mb-2 ">
            <div class="card border-0">
                <div class="card-body">

                    <h2 class="card-title">IntrigueCon X</h2>

                    <p class="lead">We're back Babies!</p>
                    <p>For those who attended online we never really left but for those in-person types, we're like, back back.</p>
                    <p>IntrigueCon 10 or X as we like to call it, you know, for the kids, is set to go. We run October 14th-16th at the awesome Meadowlark Community Centre. There will be 5 game slots: one on Friday night, three on Saturday, and, for the diehards, one on Sunday. Price of admission is $36 for the whole shooting match. </p>
                    <p>We know that people's comfort with masks falls somewhere on a spectrum. Because we're a group of welcoming people who know all too well the stigma attached to our hobby, we want everyone to be able to participate and we hope. Here's our plan to please all of the people all of the time which is sure to succeed.</p>
                    <p>
                        <ul>
                            <li>If you want to wear a mask, wear a mask</li>
                            <li>If you don't want to wear a mask, don't wear a mask</li>
                            <li>If you are a GM and want to stipulate that your players wear a mask make that stipulation at the <em>top</em> of your write up and stick to it.</li>
                            <li>If you don't want to wear a mask and you want to play a game that requires a mask you'll have to decide which is more important to you</li>
                            <li>If you want to wear a mask and you want to play in a game that doesn't require masks, you'll have to decide if you're okay potentially playing with folks who aren't wearing a mask</li>
                        </ul>
                    </p>
                    <p>Our theme for the Con this year is The Prophecy Is Fulfilled. There's no need to incorporate our theme but with a fine theme like that why wouldn't you want to!</p>
                    <p>So come join us for IntrigueCon 10</p>

                    <h3>Registration</h3>
                    <p>Everyone, who hasn’t already made a profile for previous years, needs to create an intriguecon <a href="https://intriguecon.com/register">account</a>. You’ll need a profile before you can buy a registration for any con we hold. If you’ve made a profile before you are all set.</p>
                    <p><a href="https://intriguecon.com/calendar/convention">Register and find out more about the convention </a>.</p>

                
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
