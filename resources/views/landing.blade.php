@extends('layouts.app')

@section('content')

  @if ( App\Convention::where('status' , 'active')->count() == 1)

    @include('calendar.convention.banners.fall2021.fall2021')

  @else 

    @include('calendar.convention.banners.fall2021.fall2021')

  @endif
<div class="row">
    <div class="col-md-12">
       <div class="lead my-1"> Welcome to the home of IntrigueCon, a tabletop roleplaying game convention based in Edmonton, Alberta, Canada. </div>

        <p>Since 2013 Edmonton’s roleplaying community has gathered in October (and now April too) to share their love of games from Dungeons & Dragons to The Quiet Year and everything in between. In fact, at last count, attendees have run almost 100 different game systems. So, it’s fair to say that if trying new things with great people passionate about roleplaying is your thing, there’s no better place to be than IntrigueCon.</p>
        
        <p>Oh, and you needn’t worry about fitting in! We’re fiercely supportive of gamers of all kinds and experience levels. The Game Masters at IntrigueCon love the games they’re running and are excited to be able to share them with you, and to share in the experiences you bring to the table.</p>
        
        <p>So come on, join us!</p>
        
    </div>

</div>



@endsection