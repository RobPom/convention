<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'IntrigueCon') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sorttable.js') }}"></script>
    <script src="{{ asset('js/holder.js') }}"></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" 
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" 
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">

    <!-- Styles -->
    
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @yield('styles')


</head>
<body>

    <style>
        body {
            background: url(/img/board-background.jpg) center center no-repeat ;
            background-size: cover;
            margin-bottom: 0px;
        }   

        .board-card {
            background: #dadddf;
            box-shadow: 3px 3px 40px 2px #0f2027; 
        }

        .white {
            color: white;
            font-weight: 300;
            font-family: 'Raleway', sans-serif;
        }

        .yellow {
            color: yellow;
            font-weight: 500;
        }

        .muted-yellow {
            color: rgb(252, 252, 141);
            font-weight: 500;
        }

        .container-fluid {
           
        }
    </style>


<div class="container-fluid">
    <div class="row" >
        <div class="col mt-2" style="text-shadow: 3px 3px 8px #0f2027; ">
            <h1 class='white'>Intrigue<span class="yellow">Con</span> 5</h1> 
        </div>
       
    </div>
    <div class="row">
        <div class="col text-center">
            <h2 class='white display-6' style="text-shadow: 3px 3px 8px #0f2027; ">{{$timeslot->title}} <br>
                <small class="muted-yellow">{{$timeslot->only_times()}}</small>
            </h2>
        </div>
    </div>

    
        @if($timeslot->gamesessions->count())
            <div class="card-group">
                <div class="row">
                    @foreach($timeslot->gamesessions as $gamesession)
                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2" >
                        <div class="card board-card mt-4">      
                            <img class="card-img-top" src="/storage/uploads/game_images/{{$gamesession->game->image}}" 
                                style="max-height:120px; object-fit: cover;"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$gamesession->game->title}}</h5>
                                <p class="card-text">{{$gamesession->game->tagline}}</p>
                                
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">
                                    @if($gamesession->attendees->count() == $gamesession->game->max)
                                       <strong>Full</strong>
                                    @elseif($gamesession->game->max - $gamesession->attendees->count() == 1)
                                        <strong>Only 1 seat left!</strong>
                                    @else
                                        Players: {{$gamesession->attendees->count()}} / {{$gamesession->game->max}}
                                    @endif
                                        
                                </small>
                            </div>
                        </div>
                    </div> 
                    @endforeach
                </div>
            </div>
        @endif
</div>

</body>