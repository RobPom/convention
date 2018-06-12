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
            <div class="col-md-9">
                <h3>Blog Post Title</h3>
                <p>posted on this date</p>
                <hr>
                <p class="lead">For the last time, I don't like lilacs! Your 'first' wife was the one who liked lilacs! So, how 'bout them Knicks? There, now he's trapped in a book I wrote: a crummy world of plot holes and spelling errors!</p>
                <p>Fry! Stay back! He's too powerful! Do a flip! With gusto. Man, I'm sore all over. I feel like I just went ten rounds with mighty Thor. Oh, I don't have time for this. I have to go and buy a single piece of fruit with a coupon and then return it, making people wait behind me while I complain.</p>
                <p>Ven ve voke up, ve had zese wodies. And when we woke up, we had these bodies. Well I'da done better, but it's plum hard pleading a case while awaiting trial for that there incompetence. You won't have time for sleeping, soldier, not with all the bed making you'll be doing.</p>
                <hr>

                <div class='row'>
                    <div class="col-md-2 col-4">
                            <img  src="holder.js/80px80?text=Profile \n Image" class="img-fluid" alt="Responsive image">
                    </div>
                    <div class="col-md-10 col-8" >
                        <p class='authorTitle'>The Author</p>
                        <p class='authorLead'>author@intriguecon.com || hazardgaming.com</p>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col">
                    <h4>Recent Posts</h4>
                    <br>
                
                    <ul class='archiveList'>
                        <li><a href=''>Professor, make a woman out of me.</a></li>
                        <li><a href=''>You are the last hope of the universe.</a></li>
                        <li><a href=''>Interesting. No, wait, the other thing: tedious.</a></li>
                        <li><a href=''>You guys realize you live in a sewer, right?</a></li>
                        <li><a href=''>We're also Santa Claus!</a></li>
                    </ul>
            </div>
    </div>
</div>


@endsection