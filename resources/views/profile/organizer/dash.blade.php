<div class="card">
    <div class="card-header"> 
        <h5>Organizer</h5>
    </div>

    <div class="card-body">
        <h5>
            {{$members->count() + $organizers->count() + $admins->count()}} 
            Registered Users</h5>
        <ul>
            <li><a href="/profiles/all">{{$members->count()}} {{$members->count() == 1 ? 'member' : 'members' }} </a></li>
            <li>{{$organizers->count()}} {{$organizers->count() == 1 ? 'organizer' : 'organizers' }} </li>
            <li>{{$admins->count()}} {{$admins->count() == 1 ? 'admin' : 'admins' }}</li>
        </ul>

    </div>
    <div class="card-body">
        <h5> Front Page </h5>
        <p>The latest 2 blog posts are shown on the front page for now.</p>
    </div>
</div>