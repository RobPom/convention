@extends('layouts.app')

@section('content')


<h3>This is a terrible email</h3>
<h4>Fix it</h4>

Hey {{$user->username}}, <br>
<a href='http://127.0.0.1:8000/password/reset/{{$token}}?email={{$user->email}}'>Create a Password</a>

@endsection