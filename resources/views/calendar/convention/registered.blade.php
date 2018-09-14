@extends('layouts.app')

@section('content')

<h4>registered</h4>
@guest

You are a guest.
@endguest

@auth

You are you, {{Auth::user()->firstname}}
@endauth
@endsection