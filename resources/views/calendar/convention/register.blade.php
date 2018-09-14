@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="lead mb-3">
            This is the page where you can register for the con. 
        </div>
        <p>You should totally click that button because IntrigueCon is awesome and, 
                by proxy, attending will make you awesome too! It’s also a great way to show your support for a dedicated roleplaying convention 
                        in Edmonton and keep it going for years to come.</p>
        <p>Here’s a question. Did you make already make an account on the WS? </p>

        <p>Great! Make sure you're logged in then click the paypal button. 
            Once you’re done with Paypal you can use that sweet, sweet, account to sign up for games. </p>

         <p>If you didn’t, it’s okay! You can follow <a href="/register">this link to make an account</a>. </p>
         
         <p>If you really, really don't want to make an account, that's okay too. You can still attend without one.
             We'll add you to the calendar manually (we'll be in contact).
         </p>
            
         <hr>
         <div class="row">
             <div class="col-sm-6 text-center text-sm-right">
                 <strong>$30 for a weekend pass</strong>
             </div>
             <div class="col-sm-6 text-center text-sm-left">
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="K6KG2ZGJQYBDN">
                    <input type="image" src="/img/paypal.jpg" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
             </div>
         </div>
         
        
    </div>
    
    

    
    
    
   
    



 
@endsection