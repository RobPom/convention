@extends('layouts.app')

@section('content')

<!-- Button trigger modal -->

      
<!-- Modal -->
<div class="modal fade" id="addAttendees" tabindex="-1" role="dialog" aria-labelledby="addAttendees" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="eaddAttendeesLabel">Manage Attendees</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                <strong>Registered Users</strong>
            </div>
        <form method='post' action="{{ action('Calendar\ConventionController@storeAttendees') }}">
            
            @csrf

            <table class="table table-sm sortable">  
                <thead>
                    <tr>
                        <th scope="col" >First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                
                    @foreach($users as $user)

                        <tr>
                            <td>{{$user->firstname}} </td>
                            <td>{{$user->lastname}} </td>
                            <td>
                                @if( $convention->attendees()->where('user_id', $user->id)->get()->count())
                                    <div class="form-check">
                                        <input class="form-check-input" name="attending[]" type="checkbox" 
                                        value="{{$user->id}}" id="check{{$user->id}}" checked="checked">
                                    </div>
                                @else
                                    <div class="form-check">
                                        <input class="form-check-input" name="attending[]" type="checkbox" 
                                        value="{{$user->id}}" id="check{{$user->id}}">
                                    </div>
                                @endif
                                
                            </td>
                        </tr>

                    @endforeach
                        
                </tbody> 
                </table>
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm f">Save changes</button>
</div>
                

            </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    
                </div>
            
        </div>
    </div>
</div>


<div class="card">
    <div class="card-body">
            @include('calendar.conventions.conventionheader')
        <div class="card-title">
            <strong>{{$convention->attendees()->count()}} Attendees</strong>
        </div>
        @isset($convention->attendees)
        <div class="list-group">
            @foreach($convention->attendees as $attendee)
            <a href="/calendar/convention/sessions/{{$attendee->id}}" class="list-group-item list-group-item-action">{{$attendee->firstname}} {{$attendee->lastname}}</a>
            @endforeach
        @endisset
        </div>
        <hr>
        <div class="row">
            <div class="col">
        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addAttendees">
               Manage Attendees
        </button>
    </div>
        </div>
    </div>
</div>
@endsection