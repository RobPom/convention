@extends('layouts.app')

@section('content')

<div class="card">
        <div class="card-header">
            <h5>All Members</h5>
            <a href="/profile/dashboard">Back to Dashboard</a>
        </div>
        <div class="card-body">

            <table class="table table-sm sortable">  
                <thead>
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col" class="d-none d-md-table-cell">First</th>
                        <th scope="col" class="d-none d-md-table-cell">Last</th>
                        <th scope="col" class="d-none d-sm-table-cell">email</th>
                        <th scope="col" class="d-none d-lg-table-cell">verified</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                      
                        <tr>
                            <th scope="row">
                                <a href='/profile/show/{{$member->id}}'>{{$member->username}}</a>
                            </th>
                            <td class="d-none d-md-table-cell">{{$member->firstname}}</td>
                            <td class="d-none d-md-table-cell">{{$member->lastname}}</td>
                            <td class="d-none d-sm-table-cell">{{$member->email}}</td>
                            @if($member->verified)
                                <td class="d-none d-lg-table-cell">Yes</td>
                            @else
                                <td class="d-none d-lg-table-cell">No</td>
                            @endif
                            <td><a class="btn btn-secondary btn-sm" href='/profile/{{$member->id}}/edit'>edit</a></td>
                            <td>
                                @if(Auth::user()->hasRole('admin'))
                                    <form 
                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
                                        action="{{action('ContactController@destroy', $member->id)}}" 
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger  btn-sm" type="submit">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                     
                    @endforeach
                </tbody>
            </table>
        <a href='/users/add' class="btn btn-small btn-primary col-md-4 offset-md-4"> Add </a>
        </div>
    </div>
    @endsection