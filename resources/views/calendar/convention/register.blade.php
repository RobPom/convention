@extends('layouts.app')

@section('content')

<h3>Early Bird Registration</h3>
    <p>Early bird registration is now open. Get your three day pass and save $5 by registering early. Once the games are scheduled, you'll be among the first to reserve your seat at the tables.</p>
    <br>
    <h3>Looking to host a game?</h3>
    <p>If you are interested in running a game, after registering, we'll send you instructions on how to submit and schedule a game for the con.</p>

    <hr>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="K6KG2ZGJQYBDN">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

 
@endsection