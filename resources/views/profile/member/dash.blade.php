<h3>
    @if($member->hasRole('organizer'))
    {{$member->firstname}} {{$member->lastname}}
    @else
        {{$member->username}}
    @endif
</h3>

<small>member since {{ (new \Carbon\Carbon($member->created_at))->toFormattedDateString() }} </small>
<br>

@auth
    @if( $user->hasRole('organizer') ||  $user->hasRole('admin') )
    <hr>
    <h5>Private Info</h5>
    <strong>Full Name:</strong> {{$member->firstname}} {{$member->lastname}}<br>
    <strong>Location: </strong> {{$member->profile->location}}
    @endif
@endauth
@if($member->blogPosts->count())
<hr>
    <h5>Latest Posts</h5>


    @include('layouts.include.post-list', array('showUnpublished' => false, 'posts' => $member->blogPosts, 'archive' => true))

   
@endif