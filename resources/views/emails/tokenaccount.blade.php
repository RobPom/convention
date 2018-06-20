@extends('layouts.email')

@section('content')


<h4>Temporary Account Created</h4>
<br>
<p>Hi {{$user->username}}, </p>
<p>A temporary account using your provided email address was created to allow our organizers reserve seats at games on your behalf.</p>
<p>If you would like to manage your own convention calendar
<a href='http://127.0.0.1:8000/password/reset/{{$token}}?email={{$user->email}}'>follow this link</a> to 
complete the registration for our website. Or if you prefer, just talk to one of our convention Organizers to
reserve a spot at a table</p>

@endsection