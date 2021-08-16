@extends('layouts.app')

@section('content')

@if ( App\Convention::where('status' , 'active')->count() == 1)

      @include('calendar.convention.banners.fall2021.fall2021')

    @else 
    
      @include('calendar.convention.banners.fall2021.fall2021')
   
@endif

<div class="container ">
    <div class="row">
        <div class="col-sm-12 pl-0 pr-1 mb-2 ">
            <div class="card border-0">
                <div class="card-body">

                    <h5 class="card-title">IntrigueCon 2021</h5>
                   
                    <p class="lead">
                      IntrigueCon is coming back this fall!
                    </p>
                    <p>Stay tuned for information and registration.</p>

                </div>
            </div>
        </div>
        <!-- <div class="col-sm-4 pl-0 pr-0 ">
        <div class="card">
            <div class="card-header">
              <h5>Community</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <p >Our collections of links to Edmonton based RPG community and Facebook Groups.</p>
                        <div class="text-center">
                        <a class='btn btn-small btn-primary' href='community'>See All</a>
                    </div>
                    </div>
                </div>  
            </div>
        </div>
        </div> -->
    </div>
</div>



@endsection