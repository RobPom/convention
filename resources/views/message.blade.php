@extends('layouts.app')

@section('content')

@if ( App\Convention::where('status' , 'active')->count() == 1)

      @include('calendar.convention.banners.default')

    @else 
    
      @include('calendar.convention.banners.default')
   
@endif

<div class="container my-4">
    <div class="row">
        <div class="col-sm-8 pl-0 pr-1 mb-2">
            <div class="card border-0">
                <div class="card-body">

                    <h5 class="card-title">{{$featured->title}}</h5>
                   
                    <p class="lead">{{substr($featured->lead , 0 , 120) }} ...</p>
                    <a class='float-right' href='post/{{$featured->id}}'>Read More...</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 pl-0 pr-0 ">
        <div class="card">
            <div class="card-header mt-1">
              <h4>Community</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <p class="lead">Our collections of links to Edmonton based RPG community and Facebook Groups.</p>
                        <div class="text-center">
                        <a class='btn btn-small btn-primary' href='community'>See All</a>
                    </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    </div>
</div>



@endsection