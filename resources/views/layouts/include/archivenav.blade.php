<hr>
<h5>Categories</h5>
@foreach($categories as $link)

    @isset($category)
        @if($link->title == $category->title)
            <span class="m-3 p-2" style="line-height: 3em;"><strong>{{$link->title }}</strong></span>
        @else
            <a class="m-3  p-2" style="line-height: 3em;" href="/posts/category/{{$link->id}}"> {{$link->title }} </a>
        @endif
        @if( ! $loop->last) |  @endif
    @else
        <a class="m-4" style="line-height: 3em;" href="/posts/category/{{$link->id}}"> {{$link->title }} </a> @if( ! $loop->last) |  @endif
    @endisset

@endforeach
@auth
    @if( Auth::user()->hasRole('organizer') ||  Auth::user()->hasRole('admin') )
        | <a href="/posts/category/0">unpublished</a>
    @endif
@endauth
