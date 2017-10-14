@extends('layouts.admin')

@section('content')
    <h3 class="page-title">User Detail</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            View
            @include('includes.flash')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Doctor Name </th>
                            <td>{{ ucfirst($userDetail->name)}}</td>
                        </tr>
                        
                        <tr>
                            <th>Doctor Email</th>
                            <td> {{ $userDetail->email }}</td> 
                        </tr>
                        <tr>
                            <th>Doctor Location</th>
                            <td>{{ $userDetail->address }}</td>
                        </tr>
                        
                        <tr>
                              
                              <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="{{ route('admin.find_user.updateCreate', ['id'=> $userDetail->id]) }}">
                              
                                {{ csrf_field() }}

                                <input type="hidden" id="" class="form-control" placeholder="Write doctor's email address" name="email" value="{{$userDetail->email}}" style="margin-right: 65%;">
    

                                <input type="hidden" id="" class="form-control" placeholder="Write doctor's phone number" name="phone" value="{{$userDetail->phone_number}}">
                                
                                <input type="hidden" name="user_type" value="{{$userDetail->user_type}}">

                                <input type="hidden" name="id" value="{{$userDetail->id}}">
                                <span class="input-group-btn find-doctor">
                                <tr>
                                <td>
                                <button type="submit" class="btn btn-success">Send Request</button>
                                </td>
                                </tr>
                                </span>
                            </form>
                                
                        </tr>
                                
                       
                        
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.find_user.index') }}" class="btn btn-default">Back to List</a>
        </div>
    </div>
@stop
