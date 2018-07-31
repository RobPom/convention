<div class="card ">
    <div class="card-header text-white bg-success"> 
        <h5>Organizer Tools</h5>
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
        <h5> Conventions </h5>
        <p><strong>Active</strong></p>
        @php
            $active_con = $conventions->where('status' , 'active')->first();
            $inactive_cons = $conventions->where('status' , 'inactive');
        @endphp
        <a href="/calendar/convention">{{$active_con->title}} | <a href="/calendar/convention/attendees">Attendees</a></a><br>
        <br>

        <p><strong>Inactive</strong></p>
        @foreach($inactive_cons as $con)
            {{$con->title}}<br>
        @endforeach
    </div>
</div>