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
<hr>
    @if( $user->id == $member->id ||$user->hasRole('organizer') ||  $user->hasRole('admin') )
        
    @endif
    
    <div class="card">
        <div class="card-body">
            <h5>Community Profile</h5>
            <p>
                <strong>email: </strong>{{$member->email}} <br>
                <strong>about: </strong>{{$member->profile->description}} 
            </p>

            @if( $user->id == $member->id ||$user->hasRole('organizer') ||  $user->hasRole('admin') )
                <p>
                    <h5>Private Info</h5>
                    <strong>Full Name:</strong> {{$member->firstname}} {{$member->lastname}}<br>
                    <strong>Location: </strong> {{$member->profile->location}}
                </p>
                <a class='btn btn-primary' href='/profile/{{$user->id}}/edit'>edit</a>
            @endif
        </div>   
    </div> 
   
    
    

    
    
@endauth

@if($member->blogPosts->count())
<hr>
    <h5>Latest Posts</h5>
    @auth
        @if ($user->id == $member->id)
            @include('layouts.include.post-list', array('showUnpublished' => true, 'edit' => true,  'posts' => $member->blogPosts, 'archive' => true))
        @else
            @include('layouts.include.post-list', array('showUnpublished' => false, 'edit' => false,'posts' => $member->blogPosts, 'archive' => true))
        @endif

        @if($member->hasAnyRole(['organizer' , 'admin']))
            <a href="/posts/new" class="btn btn-primary">New Post</a>
        @endif
    @else
        @include('layouts.include.post-list', array('showUnpublished' => false, 'edit' => false,'posts' => $member->blogPosts, 'archive' => true))
    @endauth

   
@endif