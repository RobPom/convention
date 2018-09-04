@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        <h5><a href="/calendar/convention/{{$convention->id}}/manage">Manage {{$convention->title}}</h5></a>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <a href="/calendar/convention/{{$convention->id}}/manage" class=""><i class="material-icons text-with-icon">event</i></a>
                <div class="inline-block text-with-icon "><strong>Attendees</strong></div> 
            </div>
            <div class="body">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="/calendar/convention/{{$convention->id}}/attendee/new">Add New</a> <br>
                            <a href="/calendar/convention/{{$convention->id}}/attendee/add">Add from Users</a> <br>
                        </div>
                            

                        <div class="card-body">

                                <table class="table table-sm sortable">  
                                        <thead>
                                            <tr>
                                                <th scope="col">User</th>
                                       
                                                <th scope="col" class="d-none d-sm-table-cell">email</th>
                                             
                                             
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               
                                            @foreach($convention->attendees as $member)
                                             
                                                <tr>
                                                    <th scope="row">
                                                        <a href='/profile/show/{{$member->id}}'>{{$member->username}}</a>
                                                    </th>
                                                    <td class="d-none d-sm-table-cell">{{$member->email}}</td>
                                     
                                                    <td>
                                                        <a class="btn btn-sm btn-primary mb-1" 
                                                            href="/calendar/convention/{{$convention->id}}/attendee/{{$member->id}}">View Info
                                                        </a>
                                                       
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                      
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>

@endsection