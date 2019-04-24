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


    <!-- Dev Fonts, Trim after Spring 2019 Banner is complete-->
    <link href="https://fonts.googleapis.com/css?family=BenchNine|Cuprum|Julius+Sans+One|Lato|Oswald|Questrial|Staatliches" rel="stylesheet">

    <!-- Styles -->
    
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @yield('styles')


</head>
<body>
    <header>
        @include('layouts.include.nav')
    </header>

        
    <main role='main' class="container mt-3">
        <div class="container">

            @if (session('status'))

            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>Info</strong><br> {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @endif
            @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning</strong><br> {{ session('warning') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

        
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </main> 
        
    <footer class="footer font-small text-white">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="text-muted"></span>
                    </div>
                    <div class="col-sm-6 ">
                        <a href="https://twitter.com/intriguecon" class="text-secondary">Our Twitter</a> <br>
                        <a href="https://www.facebook.com/groups/663587420414716/" class="text-secondary">Our Facebook Page</a> <br>
                        <a href="/about" class="text-secondary">About Us</a> <br>
                        <a href="/codeofconduct" class="text-secondary">Code of Conduct</a>
                    </div>
                </div>
              
            </div>
        </footer>
   {{-- @include('layouts.include.footer') --}}
</body>
</html>
