<div class="tab-pane fade {{ Request::get('tab') == 'posts'? 'active show' : '' }}" id="posts" role="tabpanel" aria-labelledby="posts-tab">
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