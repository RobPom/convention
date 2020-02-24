@extends('layouts.app')

@section('content')

  @if ( App\Convention::where('status' , 'active')->count() == 1)

    @include('calendar.convention.banners.default')

  @else 

    @include('calendar.convention.banners.default')

  @endif
<div class="row">
    <div class="col-md-8">
       <div class="lead my-1"> Welcome to the home of IntrigueCon, a tabletop roleplaying game convention based in Edmonton, Alberta, Canada. </div>

        <p>Since 2013 Edmonton’s roleplaying community has gathered in October (and now April too) to share their love of games from Dungeons & Dragons to The Quiet Year and everything in between. In fact, at last count, attendees have run almost 100 different game systems. So, it’s fair to say that if trying new things with great people passionate about roleplaying is your thing, there’s no better place to be than IntrigueCon.</p>
        
        <p>Oh, and you needn’t worry about fitting in! We’re fiercely supportive of gamers of all kinds and experience levels. The Game Masters at IntrigueCon love the games they’re running and are excited to be able to share them with you, and to share in the experiences you bring to the table.</p>
        
        <p>So come on, join us!</p>
        
    </div>
    <div class="col-md-4">

        <div class="row mt-3">

            <div class="col-12">
                <div class="card mt-2">
                   
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

                                            
                                            <a href='/profile/show/{{$lead->user->id}}'>{{$lead->user->firstname}} {{$lead->user->lastname}} </a>
                                            on 
                                            {{ $lead->datePosted() }}
                                            </small>
                                        </h6>
                                        <hr>
                                        <p>{{$lead->lead}}</p>
                                        <a class='btn btn-sm btn-secondary float-right' href='post/{{$lead->id}}'>Read More...</a>
                                        <br>
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