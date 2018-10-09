@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="lead mb-3">
            <!-- This is the page where you can register for the con.  -->
            Registration is closed, sort of...
        </div>
        <p>If you're prepared to run at least one game then we'll make an exception, just for you! 
            Once you submit a game you're prepared to run to <a href="mailto:intrigueregistrar@gmail.com?Subject=IntrigueCon%20Registration" target="_new">intrigueregistrar@gmail.com</a>, 
            we'll schedule it, and then we'll send you a link  where you can buy your registration for the con. </p>

        <!-- <p>You should totally click that button because IntrigueCon is awesome and, 
                by proxy, attending will make you awesome too! It’s also a great way to show your support for a dedicated roleplaying convention 
                        in Edmonton and keep it going for years to come.</p>
        <p>Here’s a question. Did you make already make an account on the website? </p>

        <p>Great! Make sure you're logged in then click the paypal button. 
            Once you’re done with Paypal you can use that sweet, sweet, account to sign up for games. </p>

         <p>If you didn’t, it’s okay! You can follow <a href="/register">this link to make an account</a>. </p>
         
         <p>If you really, really don't want to make an account, that's okay too. You can still attend without one.
             We'll add you to the calendar manually (we'll be in contact).
         </p>
            
         <hr>
         <div class="row">
             <div class="col-sm-3 offset-sm-3 text-center text-sm-right mb-2">
                <small><em>After payment is complete, click 'Return to Merchant' to come back to this site, and start picking games!</em></small>
             </div>
             <div class="col-sm-6 text-center text-sm-left">
               
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="UQUE4TAZLFLFE">
                    <table>
                    <tr><td><input type="hidden" name="on0" value="Number of Attendees">Number of Attendees</td></tr><tr><td><select name="os0">
                        <option value="One person">One person $30.00 CAD</option>
                        <option value="Two people">Two people $60.00 CAD</option>
                        <option value="Three people">Three people $90.00 CAD</option>
                    </select> </td></tr>
                    </table>
                    <input type="hidden" name="currency_code" value="CAD">
                    <input class='mt-2' type="image" src="/img/paypal.jpg" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form>

             </div> -->
         </div>
         
        
    </div>
    
    

    
    
    
   
    



 
@endsection