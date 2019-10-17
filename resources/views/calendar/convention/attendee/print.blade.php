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

    <script src="https://use.fontawesome.com/a28d7caf8c.js"></script>
    

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

    <main role='main' class="container mt-3">
        <div class="container p-0">

            <div class="row justify-content-center ">
                <div class="col-md-12 p-0">
                    <table class="table border-0">
                        <thead>
                            <tr style=" border-top: hidden;">
                                <th scope="col" class="text-center">Checked In</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendees as $attendee)
                            <tr>
                                <td class="text-center " style="font-size: 1.2rem; color: lightskyblue;">
                                        <i class="fas fa-square"></i>
                                </td>
                                <td>{{$attendee->firstname}}</td>
                                <td>{{$attendee->lastname}}</td>
                                <td>{{$attendee->email}}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </main> 
        
    

</body>
</html>
