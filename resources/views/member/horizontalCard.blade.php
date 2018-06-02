<div class="container">
    <a href='/profile/show/{{$member->id}}'>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5>{{$member->firstname}}  {{$member->lastname}}</h5>
                        <h6 class="text-muted">{{$member->email}}</h6>
                    </div>
                    <div class="col">
                        <h6 class="text-muted">{{$member->roles->first()->name}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
