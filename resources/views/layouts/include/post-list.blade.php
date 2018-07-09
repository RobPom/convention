<table class="table table-sm sortable">  
    <thead>
        <tr>
            <th scope="col" class="d-none d-md-table-cell">Date</th>
            <th scope="col">Title</th>
            <th scope="col" class="d-none d-md-table-cell">
                {{$archive ? 'Category' : 'Author'}}
            </th>
            @auth
                @if(Auth::user()->id == $posts->first()->user->id ||  Auth::user()->hasRole('admin') )
                    <th scope="col" colspan="2"></th>
                @endif
            @endauth
        </tr>
    </thead>
    <tbody>

        @foreach($posts as $post)
            @if($post->published())
            <tr>
                <td class="d-none d-md-table-cell text-center" style='min-width: 70px;'>
                    {{$post->shortDate()}}
                </td>
                <td><a href='/post/{{$post->id}}'>{{$post->title}}</a></td>
                <td class="d-none d-md-table-cell">
                    @if($archive)
                        <a href='/posts/category/{{$post->category()->id}}'>{{$post->category()->title}}</a>
                    @else
                        <a href='/profile/show/{{$post->user->id}}'>{{$post->user->firstname}} {{$post->user->lastname}}</a>
                    @endif  
                </td>
                @auth
                @if($edit)
                    @if(Auth::user()->id == $posts->first()->user->id ||  Auth::user()->hasRole('admin') )
                        <td colspan='2'><a href="/post/{{$post->id}}/edit" class="btn btn-sm btn-primary">edit</a></td>   
                    @endif
                @endif
                @endauth
            </tr>
            @else
                @if($showUnpublished)
                <tr>
                    <td class="d-none d-md-table-cell text-center" style='min-width: 70px;'>
                        <small><em> {{$post->shortDate()}}</em></small>
                    </td>
                    <td><a href='/post/{{$post->id}}'>{{$post->title}}</a></td>
                    <td class="d-none d-md-table-cell">
                        <a href='/posts/category/{{$post->category()->id}}'>{{$post->category()->title}}</a>
                    </td>
                    @auth
                    @if(Auth::user()->id == $posts->first()->user->id ||  Auth::user()->hasRole('admin') )
                        <td><a href="/post/{{$post->id}}/edit" class="btn btn-sm btn-primary">edit</a></td>
                        <td>
                        <form 
                            onsubmit="return confirm('You cannot undo this. Are you sure you want to delete this post?');"
                            action="{{action('BlogPostController@destroy', $post->id)}}" 
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                        
                    @endif
                @endauth
                </tr>
                @endif
            @endif
        

        @endforeach
    </tbody>
</table>