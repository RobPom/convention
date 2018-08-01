@php 
$convention = App\Convention::where('status' , 'active')->first();
@endphp

<h3>
    @if($member->hasRole('organizer'))
    {{$member->firstname}} {{$member->lastname}}
    @else
        {{$member->username}}
    @endif
</h3>

<small>member since {{ (new \Carbon\Carbon($member->created_at))->toFormattedDateString() }} </small>
<br>
<hr>
<ul class="nav nav-tabs" id="dashboard-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true">Profile</a>
    </li>
    @if($member->blogPosts()->whereNotNull('posted_on')->get()->count())
    <li class="nav-item">
        <a class="nav-link" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">Posts</a>
    </li>
    @endif
    @if($member->games()->whereHas('timeslots')->get()->count())
        <li class="nav-item">
            <a class="nav-link" id="games-tab" data-toggle="tab" href="#games" role="tab" aria-controls="games" aria-selected="false">Games</a>
        </li>
    @endif
    @auth
    @if( $convention->attendees()->where('user_id', $member->id)->exists() )
    @if(Auth::user() == $member || $user->hasRole('organizer') || $user->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link" id="calendar-tab" data-toggle="tab" href="#calendar" role="tab" aria-controls="calendar" aria-selected="false">Convention Schedule</a>
            </li>
            @endif
        @endif
    @endauth
</ul>

<div class="tab-content" id="dashboardTabContent">
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <small>{{$member->username}}'s</small><br>
                        <strong>Community Profile</strong>
                    </div>
                    <div class="col text-right">
                        @auth
                            @if( $user->id == $member->id ||$user->hasRole('organizer') ||  $user->hasRole('admin') )
                                <a href="/profile/{{$user->id}}/edit" class="mt-2 btn btn-sm btn-secondary">Edit</a>
                            @endif
                        @endauth
                    </div>
                </div>
                
            </div>
            <div class="card-body">

                <p>
                    <strong>email: </strong>{{$member->email}} <br>
                    <strong>about: </strong>{{$member->profile->description}} 
                </p>
                @auth
                    @if( $user->id == $member->id ||$user->hasRole('organizer') ||  $user->hasRole('admin') )
                        <p>
                            <h6> <strong> Private Info</strong></h6>
                            <strong>Full Name:</strong> {{$member->firstname}} {{$member->lastname}}<br>
                            <strong>Location: </strong> {{$member->profile->location}}
                        </p>
                    @endif
                @endauth
            </div>   
        </div> 
    </div>

    @if($member->blogPosts()->whereNotNull('posted_on')->get()->count())
        <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                                <small>{{$member->username}}'s</small><br>
                                <strong>Latest Posts</strong>
                        </div>
                        <div class="col text-right">
                            @auth
                                @if($member->hasAnyRole(['organizer' , 'admin']))
                                    <a href="/posts/new" class="mt-2 btn btn-sm btn-secondary">New</a>
                                @endif
                            @endauth
                            
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    @auth
                        @if ($user->id == $member->id)
                            @include('layouts.include.post-list', array('showUnpublished' => true, 'edit' => true,  'posts' => $member->blogPosts, 'archive' => true))
                        @else
                            @include('layouts.include.post-list', array('showUnpublished' => false, 'edit' => false,'posts' => $member->blogPosts, 'archive' => true))
                        @endif
                
                      
                    @else
                        @include('layouts.include.post-list', array('showUnpublished' => false, 'edit' => false,'posts' => $member->blogPosts, 'archive' => true))
                    @endauth

                </div>
            </div>
        </div>
    @endif

    @if($member->games()->whereHas('timeslots')->get()->count())
        <div class="tab-pane fade" id="games" role="tabpanel" aria-labelledby="games-tab"> 
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                                <small>{{$member->username}}'s</small><br>
                                <strong>Games</strong>
                        </div>
                        <div class="col text-right">
                            @auth
                                @if($member->hasAnyRole(['organizer' , 'admin']))
                                    <a href="/posts/new" class="mt-2 btn btn-sm btn-secondary">New</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-deck">
                        @foreach($member->games as $game)
                            <div class="card">
                                <div class="card-header">
                                    {{$game->title}}
                                    @if($game->isActive($game->id))
                                        <small> - <a href="/game/{{$game->id}}">scheduled</a></small>
                                    @endif
                                </div>
                                <div class="card-body">
                                    {{$game->tagline}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
   
    @endif

@auth
    @if( $convention->attendees()->where('user_id', $member->id)->exists() )
        @if(Auth::user() == $member || $user->hasRole('organizer') || $user->hasRole('admin'))
            <div class="tab-pane fade" id="calendar" role="tabpanel" aria-labelledby="calendar-tab">   
                @include('profile.attendee.calendar', ['user' => $member])

            </div>
        @endif
    @endif
@endauth   
</div>
