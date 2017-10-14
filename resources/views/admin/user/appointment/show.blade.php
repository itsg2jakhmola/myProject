@extends('layouts.admin')

@section('content')
    <h3 class="page-title">Medical Detail</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            View
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Doctor Speciality</th>
                            <td>{{ ucfirst($appointment_detail->doctor_speciality)}}</td>
                        </tr>
                        <tr>
                            <th>Description/Notes</th>
                            <td>{{ $appointment_detail->notes }}</td>
                        </tr>
                        <!-- <tr>
                            <th>Nearby Doctor</th>
                            <td>{{ $appointment_detail->nearby_doctor }}</td>
                        </tr> -->
                        <tr>
                            <th>Appointment Date/Time</th>
                            <td>{{ $appointment_detail->appointment_time }}</td>
                        </tr>
                        
                        <tr>
                            <th>Doctor Recommended Prescription</th>
                            <td>{{ ($appointment_detail['appointment_request']->seen) ? $appointment_detail['appointment_request']->seen : 'Pending'}}</td>
                        </tr>

                        <tr>
                            <th>Doctor Name</th>
                            <td>{{ $appointment_detail['users']->name }}</td>
                        </tr>

                        <tr>
                            <th>Doctor Email</th>
                            <td>
                            <a href="mailto:{{$appointment_detail['users']->email}}">{{$appointment_detail['users']->email}}</a>
                            </td>
                            
                        </tr>

                        <tr>
                            <th>Doctor Phone</th>
                            <td>{{ $appointment_detail['users']->phone_number }}</td>
                        </tr>
                        
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.appointment_setting.index') }}" class="btn btn-default">Back to List</a>
        </div>
    </div>
@stop
