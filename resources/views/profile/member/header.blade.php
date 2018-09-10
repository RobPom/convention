<div class="media avatar-container">
    <img class="img-fluid align-self-center mr-3 mb-2" src="/uploads/avatars/{{$member->avatar}}" alt="Generic placeholder image">
    <div class="media-body">
        <h5>@if($member->hasRole('organizer') || $member->hasRole('admin'))
                {{$member->firstname}} {{$member->lastname}}
            @else
                {{$member->username}}
            @endif</h5>
        <h5><small>{{$member->profile->description}}</small></h5>
        
    </div>
    
</div>