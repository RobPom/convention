@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <img  src="holder.js/100px275?text=Convention Banner" class="img-fluid" alt="Responsive image">
    </div>
</div>
<br>
    
<div class="card">
    <div class="card-body">
        <div class='row'>
            <div class="col">
                <h6><small>{{App\BlogCategory::find($posts[0]->category)->title}}</small></h6>
                <h3>{{$posts[0]->title}}</h3>
                <h6><small>posted by 
                    <a href='/profile/show/{{$posts[0]->user->id}}'>{{$posts[0]->user->firstname}} {{$posts[0]->user->lastname}} </a>
                    on 
                    {{ Carbon\Carbon::parse($posts[0]->posted_on)->format('F jS, Y') }}
                    </small>
                </h6>
                <hr>
                <p class="lead">{{$posts[0]->lead}}</p>
                <a class='float-right' href='post/{{$posts[0]->id}}'>Read More...</a>
                <br>
            </div>   
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h6><small>{{App\BlogCategory::find($posts[1]->category)->title}}</small></h6>
                    <h5 class="card-title">{{$posts[1]->title}}</h5>
                    <h6><small>posted by <a href='/profile/show/{{$posts[1]->user->id}}'>{{$posts[1]->user->firstname}} {{$posts[1]->user->lastname}} </a>
                        on 
                        {{ Carbon\Carbon::parse($posts[1]->posted_on)->format('F jS, Y') }}
                    </small></h6>
                    <br>
                    <p class="lead">{{substr($posts[1]->lead , 1 , 120) }} ...</p>
                    <a class='float-right' href='post/{{$posts[1]->id}}'>Read More...</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-2">
        <div class="card">
            <div class="card-body">
                <h5>The Con</h5>
                <p>All about IntrigueCon, convention archive, photos</p>
                <a class='float-right' href='post/{{$posts[0]->id}}'>More...</a>
            </div>
        </div>
    </div>
    </div>
</div>



@endsection