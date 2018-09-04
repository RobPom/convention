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
                <div class="inline-block text-with-icon "><strong>Add Attendees</strong></div> 
            </div>
            <div class="body">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            Add Attendee from User Account
                        </div>
                         
                        <div class="card-body">

                            <table class="table table-sm sortable">  
                                    <thead>
                                        <tr>
                                            <th scope="col">User</th>
                                            <th scope="col" class="d-none d-md-table-cell">First</th>
                                            <th scope="col" class="d-none d-md-table-cell">Last</th>
                                            <th scope="col" class="d-none d-sm-table-cell">email</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $member)
                                            @if(! $convention->attendees->find( $member->id))
                                            <tr>
                                                <th scope="row">
                                                    <a href='/profile/show/{{$member->id}}'>{{$member->username}}</a>
                                                </th>
                                                <td class="d-none d-md-table-cell">{{$member->firstname}}</td>
                                                <td class="d-none d-md-table-cell">{{$member->lastname}}</td>
                                                <td class="d-none d-sm-table-cell">{{$member->email}}</td>
                                    
                                                <td>
                                                    <form 
                                                        
                                                        action="{{action('Calendar\AttendeeController@addAttendee')}}" 
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="convention" value="{{$convention->id}}">
                                                        <input type="hidden" name="member" value="{{$member->id}}">
                                                        <button class="btn btn-sm btn-primary mb-1" type="submit">Add</button>
                                                    </form>
                                                    
                                                
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                            </table>
                            
                        </div>
                     
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>

@endsection