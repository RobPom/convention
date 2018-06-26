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
                <h3>{{$latestPost->title}}</h3>
                <h6><small>posted by 
                    <a href='/profile/show/{{$latestPost->user->id}}'>{{$latestPost->user->firstname}} {{$latestPost->user->lastname}} </a>
                    on 
                    {{ Carbon\Carbon::parse($latestPost->created_at)->format('F jS, Y') }}
                    </small>
                </h6>
                <h6><small>
                        {{App\BlogCategory::find($latestPost->category)->title}}
                    </small>
                </h6>
                <hr>
                <p class="lead">{{$latestPost->lead}}</p>
                <a class='btn btn-primary btn-sm float-right' href='post/{{$latestPost->id}}'>Read More...</a>
                <br>
            </div>   
        </div>
    </div>
</div>


@endsection