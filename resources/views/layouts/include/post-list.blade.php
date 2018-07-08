<table class="table table-sm sortable">  
    <thead>
        <tr>
            <th scope="col" class="d-none d-md-table-cell">Date</th>
            <th scope="col">Title</th>
            <th scope="col" class="d-none d-md-table-cell">
                {{$archive ? 'Category' : 'Author'}}
            </th>
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
                </tr>
                @endif
            @endif
        

        @endforeach
    </tbody>
</table>