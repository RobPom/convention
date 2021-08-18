@extends('layouts.app')

@section('content')

@if ( App\Convention::where('status' , 'active')->count() == 1)

      @include('calendar.convention.banners.fall2021.fall2021')

    @else 
    
      @include('calendar.convention.banners.fall2021.fall2021')
   
@endif

<div class="container ">
    <div class="row">
        <div class="col-sm-12 pl-0 pr-1 mb-2 ">
            <div class="card border-0">
                <div class="card-body">

                    <h2 class="card-title">IntrigueCon 2021</h2>
                   
                    <p class="lead">
                      Well, here it is, the big announcement!
                    </p>
                    <p>But first… thank you for the support and patience you’ve shown over the years.</p>
                    <p>It’s a testament to how you all pitch in that we never even considered not returning. From writing games, juggling players, switching tables, promoting the con in your day-to-day, helping with setup and tear down, and welcoming people of all stripes into our little corner of the world, truly, it’s you guys that make the con.
                      Enough soppy stuff let’s get down to brass tacks:</p>
                    <p>Everyone, who hasn’t already made a profile for previous years, needs to create an <a href="http://convention.test/register">intriguecon</a> account. You’ll need a profile before you can buy a registration for any con we hold. If you’ve made a profile before you are all set.
                    </p>
                    <h4>Registration</h4>
                    <p>GM registration and game submissions will open Friday, the 20th of August.</p>
                    <p>Player registrations will open at the beginning of September.</p>
                    <h4>Date and Time</h4>
                    <p>Con begins Friday the 15th of October at 7pm, with doors open at 6pm for chatting, reminiscing, and doing some of that helping I was talking about before. Ends Sunday 3pm-ish. One session on Friday and Sunday, three on Saturday (exact times to follow but pretty much the same as other years).</p>

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