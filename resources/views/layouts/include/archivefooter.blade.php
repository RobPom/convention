<div class='footer archive'>
    <div class="container">
        <span class="text-muted">

                @auth
                    @if( Auth::user()->hasRole('organizer') ||  Auth::user()->hasRole('admin') )
                    <br><a href="/posts/new">Create a Post</a>
                    @endif
                @endauth
           
        </span>
    </div>
</div>