@extends('layouts.app')

@section('content')




        
    <div class="container mb-3">
            
        <div class="card border-0 mx-auto">
            <div class="row">
                <div class="col mb-3 mt-2">
                    <h2><strong>IntrigueCon T-Shirts</strong></h2>
                </div>
            </div>

            <div class="row">
                
                <div class="col-md-6 mb-4">

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">                                   
                                    <img class="d-block w-100" src="/img/generic_shirt.png" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block ">
                                        <h5 class="text-dark"> <strong>Straight Cut</strong> </h3>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="/img/generic_shirt_w.png" alt="Second slide">
                                    <div class="carousel-caption d-none d-md-block ">
                                        <h5 class="text-dark "> <strong>Fitted Tee</strong> </h5>
                                    </div>
                                </div>
                                
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only ">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                </div>
                
                <div class="col-md-6">
                    <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <div class="row">
                       
                        <div class="col-12">
                            <div class="pr-3">
                                <p class="lead">Dark cerulean t-shirt with IntrigueCon D20 logo.</p>

                                <p> <strong>$24.00 cdn</strong></p>
                                
                                <p>Since this is our first year offering shirts we do not have a stock of them. This means if your shirt doesn’t hug your curves in just the right way, all we’ll be able to do is commiserate.</p> 
                                <p> <small> <strong> <em>Small, Medium, Large, XL, 2XL</em></strong></small></p>
                                <p class="card-text">Here's a handy chart to help with sizing.</p>
                                        <div class="row">
                                                <div class="col text-center mb-2">
                                                        <a class="btn btn-outline-secondary btn-sm mx-auto" href="https://www.vistaprint.ca/tshirt-sizing.aspx?GP=09%2f30%2f2019+15%3a53%3a50&GPS=5487857627&GNF=1">T-Shirt Size Chart</a>
                                                </div>
                                            </div>
                                        </div>
                                <div class="card border-secondary  my-3" >
                                    
                                        <div class="card-body">
                                        
                                        <h5 class="card-title"> <strong> <em> Sizing Tip</em></strong></h5>
                                        <p class="card-text">If you find you’re on the borderline between two sizes, simply select the larger of the two and make a few extra stops at the concession; you’ll fill it out in no time!</p>
                                        
                                </div>    
                            </div>
                            
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group p-2">
                                        <div class="pb-2"  for="quantity">Quantity</div> 
                                        <input type="number" class="form-control" id="quantity"  name="quantity" 
                                        min="1" max="12" value="1" >
                                    </div>
                                </div>

                                <div class="col-8"> 
                                    <div class="form-group p-2 pr-4">
                                        <label class="" for="sizeselect">Size</label>
                                        
                                        <select name="os0" class="form-control" id="sizeselect" >
                                            <option value="Small" >Small </option>
                                            <option value="Medium">Medium </option>
                                            <option value="Large" selected>Large </option>
                                            <option value="X-Large">X-Large </option>
                                            <option value="2X-Large">2X-Large </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                    
                            <div class="row">
                                <div class="col">
                                    <div class="form-group p-2 pr-4">
                                        <label class="" for="sizeselect">Style</label>
                                        
                                        <select name="os1" class="custom-select " id="sizeselect">
                                            <option value="mens">Straight Cut </option>
                                            <option value="womens">Fitted Tee </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col text-center">
                                    <div class="form-group p-2 pr-4">
                                        <input type="hidden" name="cmd" value="_s-xclick">
                                        <input type="hidden" name="hosted_button_id" value="BTSUMQ3979NU8">
                                
                                        <button class="btn btn-primary btn-block" type="submit">Pay with Paypal</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    </form>
                </div>   

            </div>

        </div>

    </div>

@endsection

