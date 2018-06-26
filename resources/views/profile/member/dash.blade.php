<h3>
    @if($member->hasRole('organizer'))
    {{$member->firstname}} {{$member->lastname}}
    @else
        {{$member->username}}
    @endif
</h3>

<small>member since {{ (new \Carbon\Carbon($member->created_at))->toFormattedDateString() }} </small>
<br>

@if($member->blogPosts->count())
<br>
    <h6>Latest Posts</h6>

    <table class="table table-sm sortable">  
        <thead>
            <tr>
                <th scope="col" class="d-none d-md-table-cell">Date</th>
                <th scope="col" class="d-none d-sm-table-cell">Title</th>
                <th scope="col" class="d-none d-md-table-cell">Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach($member->blogPosts as $post)
            <tr>
                <td class="d-none d-md-table-cell">{{$post->shortDate()}}</td>
                <td class="d-none d-sm-table-cell">
                    <a href='/post/{{$post->id}}'>{{$post->title}}</a>
                </td>
                <td class="d-none d-md-table-cell">
                    <a href='/posts/category/{{$post->category()->id}}'>{{$post->category()->title}}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif