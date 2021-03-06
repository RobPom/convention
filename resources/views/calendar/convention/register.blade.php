@extends('layouts.app')

@section('content')

<div class="card border-0">
    <div class="card-body">
        <h4 class="mb-4">
            This is the page where you can register for the con 
        </h4>
        <!-- <p>If you're prepared to run at least one game then we'll make an exception, just for you! 
            Once you submit a game you're prepared to run to <a href="mailto:intrigueregistrar@gmail.com?Subject=IntrigueCon%20Registration" target="_new">intrigueregistrar@gmail.com</a>, 
            we'll schedule it, and then we'll send you a link  where you can buy your registration for the con. </p> 
          -->
        <p>You should totally click that button because IntrigueCon is awesome and, 
                by proxy, attending will make you awesome too! It’s also a great way to show your support for a dedicated roleplaying convention 
                        in Edmonton and keep it going for years to come.</p>
        <p>Here’s a question. Did you make already make an account on the website? </p>

        <p>Great! Make sure you're logged in then click the paypal button. 
            Once you’re done with Paypal you can use that sweet, sweet, account to sign up for games. </p>

         <p>If you didn’t, it’s okay! You can follow <a href="/register">this link to make an account</a>. </p>
         
         <p>If you really, really don't want to make an account, that's okay too. You can still attend without one.
             We'll add you to the calendar manually (we'll be in contact).
         </p>
            
         <hr class="p-2 mt-4">
         <div class="row">
             <div class="col-sm-3 offset-sm-3 text-center text-sm-right mb-2">
                <small><em>After payment is complete, click 'Return to Merchant' to come back to this site, and start picking games!</em></small>
             </div>
             <div class="col-sm-6 text-center text-sm-left">
               
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="9TU4JJSXHDHNA"
                    <table>
                    <tr><td><input type="hidden" name="on0" value="Number of Attendees">Number of Attendees </td></tr><tr><td><select name="os0">
                        <option value="One person">One person $5.00 CAD</option>
                        <option value="Two people">Two people $10.00 CAD</option>
                        <option value="Three people">Three people $15.00 CAD</option>
                    </select> </td></tr>
                    </table>
                    <input type="hidden" name="currency_code" value="CAD">
                    <input class='mt-2' type="image" src="/img/paypal.jpg" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form>

             </div>
         </div>
         

         <hr class="p-2 mt-4">
        <h4 class="mb-4">Still not sold?</h4>
         <div class="lead mb-3">See what <s>nice</s> things roleplaying game designers and publishers are saying about IntrigueCon</div>
         
         <div class="card border-0">
                <div class="card-body ">
                    <blockquote class="blockquote text-center">
                        <p class="mb-0">"I regret not having the time to attend more conventions, but at least it means I don't have to go to IntrigueCon.</p>
                        <footer class="blockquote-footer">Epidiah Ravachol | <a href="https://dig1000holes.wordpress.com">dig1000holes.wordpress.com</a> 
                            </footer>
                    </blockquote>
                </div>
            </div>
         
         <div class="card border-0">
            <div class="card-body ">
                <blockquote class="blockquote text-center">
                    <p class="mb-0">“You’ll never drag me to Edmonton for IntrigueCon.”</p>
                    <footer class="blockquote-footer">Luke Crane | <a href="https://www.burningwheel.com">www.burningwheel.com</a> 
                        </footer>
                </blockquote>
            </div>
        </div>

        <div class="card border-0"">
            <div class="card-body ">
                <blockquote class="blockquote text-center">
                    <p class="mb-0">“I will not be attending IntrigueCon because Canada frightens me.”</p>
                    <footer class="blockquote-footer">Jason Morningstar | <a href="https://bullypulpitgames.com">bullypulpitgames.com</a> 
                        </footer>
                </blockquote>
            </div>
        </div>

        <div class="card border-0"">
            <div class="card-body ">
                <blockquote class="blockquote text-center">
                    <p class="mb-0">“Outside of GenCon, IntrigueCon is the best convention you can visit. Inside of GenCon, we all secretly pledge to never, ever attend this mess.”</p>
                    <footer class="blockquote-footer">Brendan LaSalle | <a href="https://goodman-games.com/xcrawl/">goodman-games.com/xcrawl</a> 
                        </footer>
                </blockquote>
            </div>
        </div>

        <div class="card border-0"">
            <div class="card-body ">
                <blockquote class="blockquote text-center">
                    <p class="mb-0">“IntrigueCon? Why the hell would I go to Canada? I'm too busy soaking up all the swamp-like heat and gun-related terror I can handle at home. There's no way I'm leaving my house!”</p>
                    <footer class="blockquote-footer">Fred Hicks | <a href="https://www.evilhat.com/home/">www.evilhat.com</a> 
                        </footer>
                </blockquote>
            </div>
        </div>
</div>
    
    

    

    
   
    



 
@endsection