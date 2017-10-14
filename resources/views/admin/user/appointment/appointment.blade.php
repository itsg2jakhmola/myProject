@extends('layouts.admin')

@section('content')

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                                @include('includes.flash')

                                <a href="{{route('admin.appointment_setting.create')}}" class="btn btn-info btn-fill pull-right">Add Appointment</a>

                                <h4 class="title">Appointment History</h4>
                                <p class="category"> <b> Total : {{count($appointment_list)}} </b> </p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <!-- <th>Doctor Speciality</th> -->
                                        <th>Notes</th>
                                        <th>Nearby_doctor</th>
                                        <th>Seen By Doctor</th>
                                        <th>Appointment Date/Time</th>
                                        <th>Action</th>
                                        
                                    </thead>
                                    <tbody>
                                        @if (count($appointment_list) > 0)

                                @foreach ($appointment_list as $info)

                                 <tr data-entry-id="{{ $info->id }}">
                                    <!-- <td> {{ ($info->doctor_speciality) ? ucfirst($info->doctor_speciality) : '' }} </td> -->
                                    <td> {{ $info->notes }} </td>
                                    <td> {{ $info['appointment_request']['assigned_name'] }}</td> 
                                    <td> {{ ($info['appointment_request']) ? $info['appointment_request']->seen : 'No'}}</td> 
                                    <td>
                                        <span style="display:none;">                                            
                                            {{ \Carbon\Carbon::parse($info->created_at)->format('Y/m/d')}}
                                        </span>
                                        {{ $info->created_at }}                                         
                                    </td>
                                     <td>
                                        <!--<a href="{{ route('admin.medical_history.show',[$info->id]) }}" class="btn btn-xs btn-primary" title="View"><i class="mdi mdi-magnify"></i>View</a>-->
                                        <a href="{{ route('admin.appointment_setting.show',[$info->id]) }}" class="btn btn-xs btn-primary" title="View"><i class="mdi mdi-magnify"></i>View</a>
                                        
                                        @if($info['appointment_request']['seen'] == 'Pending')

                                        <a href="{{ route('admin.appointment_setting.edit',[$info->id]) }}" class="btn btn-xs btn-info" title="Edit">Edit<i class="mdi mdi-pencil"></i></a>
                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Are you Sure ?")."');",
                                        'route' => ['admin.appointment_setting.destroy', $info->id])) !!}
                                        <button type="submit" class="btn btn-xs btn-danger" title="Delete"><i class="mdi mdi-delete">Delete</i></button>

                                        @endif

                                        {!! Form::close() !!}                                        
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