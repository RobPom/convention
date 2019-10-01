@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="card border-0 mx-auto">
        <div class="row">
            <div class="col mb-3 mt-2">
                <h2><strong>IntrigueCon T-Shirts</strong></h2>
                <h2><small>Order Cancelled</small></h2>
                
                <p>Your order was cancelled and you will not be charged.</p>

                <p>If you had problems completing this order please <a href="mailto:intriguecon@gmail.com?subject=IntrigueCon T-Shirt Order">contact us</a></p>
                        
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a class="btn btn-outline-secondary btn-sm" href="/tshirts">T-Shirt Order Form</a>
                    <a class="btn btn-outline-secondary btn-sm" href="/">Home Page</a>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection