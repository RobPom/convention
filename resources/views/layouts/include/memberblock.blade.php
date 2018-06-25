
<a href='/profile/show/{{$post->user->id}}' class='card-link'>
<div class="card flex-row flex-wrap">
    <div class="card-header d-none d-sm-block horizontal-header">
        <img src="//placehold.it/60" alt="">
    </div>
    <div class="card-block px-2">
        <p class='authorTitle'>{{$post->user->firstname}} {{$post->user->lastname}}</p>
        <p class='authorLead'>{{$post->user->profile->description}}</p>
    </div>    
</div>
</a>