@extends('layouts.admin')

@section('content')

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                                <h4 class="title">Prescription written by doctor</h4>
                                <p class="category">Here is the list of prescription</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    @if(Auth::user()->user_type == 1) 
                                    <thead>
                                        <th>Appointment ID</th>
                                    	<th>Doctor Name</th>
                                    	<th>Appointment Date</th>
                                        <th>Seen</th>
                                    	<th>Action</th>
                                    </thead>
                                    @else
                                    <thead>
                                        <th>Appointment ID</th>
                                        <th>Doctor Name</th>
                                        <th>Prescription</th>
                                        <th>Written At</th>
                                        <th>Action</th>
                                    </thead>
                                    @endif
                                    <tbody>
                            @if (count($prescription_list) > 0)

                                @foreach ($prescription_list as $info)
                                 <tr data-entry-id="{{ $info->id }}">
                                    @if(Auth::user()->user_type == 1)
                                    
                                    <td> #{{ $info->appointment_id }} </td>

                                    <td> {{ ucfirst($info['doctor']->name) }}  </td>
                                    <td> <span style="display:none;">                                            
                                            {{ \Carbon\Carbon::parse($info['booking_request']->appointment_time)->format('Y/m/d')}}
                                        </span>
                                        {{ $info['booking_request']->appointment_time }} </td>
                                    
                                    <td> {{ $info['booking_request']->seen }} </td>
                                    

                                    @else
                                    <td> #{{ $info->appointment_id }} </td>
                                    <td> {{ ucfirst($info['doctor']->name) }} </td>
                                    <td> {{ ucfirst($info->prescription) }} </td>
                                    
                                    <td>
                                        <span style="display:none;">                                            
                                            {{ \Carbon\Carbon::parse($info->created_at)->format('Y/m/d')}}
                                        </span>
                                        {{ $info->created_at }}                                         
                                    </td>
                                    @endif

                                     <td>
                                        <!--<a href="{{ route('admin.medical_history.show',[$info->id]) }}" class="btn btn-xs btn-primary" title="View"><i class="mdi mdi-magnify"></i>View</a>-->
                                        <a href="{{ route('admin.pharmist_setting.show',[$info->id]) }}" class="btn btn-xs btn-primary" title="View"><i class="mdi mdi-magnify"></i>View</a>
                                        <!-- <a href="{{ route('admin.medical_history.edit',[$info->id]) }}" class="btn btn-xs btn-info" title="Edit">Edit<i class="mdi mdi-pencil"></i></a>
                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Are you Sure ?")."');",
                                        'route' => ['admin.medical_history.destroy', $info->id])) !!}
                                        <button type="submit" class="btn btn-xs btn-danger" title="Delete"><i class="mdi mdi-delete">Delete</i></button>
                                        {!! Form::close() !!}    -->                                     
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>

@endsection