@extends('layouts.app')

@section('content')

@if ( App\Convention::where('status' , 'active')->count() == 1)

      @include('calendar.convention.banners.spring2023.default')

    @else

      @include('calendar.convention.banners.default')

@endif

<div class="container ">
    <div class="row">
        <div class="col-sm-12 pl-0 pr-1 mb-2 ">
            <div class="card border-0">
                <div class="card-body">
                 
                    <h3>Registration</h3>
                    <p>Everyone, who hasn’t already made a profile for previous years, needs to create an intriguecon <a href="https://intriguecon.com/register">account</a>. You’ll need a profile before you can buy a registration for any con we hold. If you’ve made a profile before you are all set.</p>
                    <p><a href="https://intriguecon.com/calendar/convention">Register and find out more about the convention </a>.</p>

                
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
