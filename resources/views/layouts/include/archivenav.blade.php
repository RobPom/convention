<hr>
<h5>Categories</h5>
    @foreach($categories as $link)
        @isset($category)
                @if($link->title == $category->title)
                    {{$link->title }}
                @else
                    <a href="/posts/category/{{$link->id}}"> {{$link->title }} </a>
                @endif
                @if( ! $loop->last) |  
                @endif
        @else
            <a href="/posts/category/{{$link->id}}"> {{$link->title }} </a> @if( ! $loop->last) |  @endif
        @endisset
    @endforeach
    @auth
        @if( Auth::user()->hasRole('organizer') ||  Auth::user()->hasRole('admin') )
         | <em><a href="/posts/category/0">unpublished</a></em>
        @endif
    @endauth
<hr>