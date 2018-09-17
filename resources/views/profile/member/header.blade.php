<div class="media avatar-container">

    @if($member->avatar == 'default.jpg')
        <img class="img-fluid align-self-center mr-3 mb-2" 
            style="height:60px ; max-width: 60px; border-radius: 50%;"
            src='/img/avatar/default.jpg'
            alt="Avatar Placeholder">
    @else
        <img class="img-fluid align-self-center mr-3 mb-2" 
            style="height:60px ; max-width: 60px;  border-radius: 50%;"
            src="/storage/uploads/avatars/{{$member->avatar}}"
            alt="Avatar Placeholder">
    @endif
    <div class="media-body">
        <h5>@if($member->hasRole('organizer') || $member->hasRole('admin'))
                {{$member->firstname}} {{$member->lastname}}
            @else
                {{$member->username}}
            @endif</h5>
        <h5><small>{{$member->profile->description}}</small></h5>
    </div>
</div>
