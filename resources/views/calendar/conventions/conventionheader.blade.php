<div class="mb-4">

    @if(Request::path() == 'calendar/convention')
        <h3>{{$convention->title}}</h3>
    @else
    <h3><a href="/calendar/convention">{{$convention->title}}</a></h3>
    @endif
    
    <h5><small>{{$convention->tagline}}</small></h5>

</div>

