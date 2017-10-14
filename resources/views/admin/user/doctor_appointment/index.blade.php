@extends('layouts.admin')

@section('content')

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                            @include('includes.flash')

                                @if(Auth::user()->user_type == 1)
                                <a href="{{route('admin.docappoint_setting.create')}}" class="btn btn-info btn-fill pull-right">Add Appointment</a>
                                @endif

                                <h4 class="title">Appointment History</h4>
                                <p class="category"> <b> Total : {{count($appointment_list)}} </b> </p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Patient Name</th>
                                        <th>Notes</th>
                                        <th>Patient Email</th>
                                        <th>Appointment Date/Time</th>
                                        
                                    </thead>
                                    <tbody>
                                        @if (count($appointment_list) > 0)

                                @foreach ($appointment_list as $info)
                                 <tr data-entry-id="{{ $info->id }}">
                                    <td> {{ ucfirst($info['users']->name) }} </td>
                                    <td> {{ ucfirst($info->notes) }} </td>
                                    <td> {{ $info['users']->email }}</td> 
                                    <td>
                                        <span style="display:none;">                                            
                                            {{ \Carbon\Carbon::parse($info->created_at)->format('Y/m/d')}}
                                        </span>
                                        {{ $info->created_at }}                                         
                                    </td>
                                     <td>
                                        <!--<a href="{{ route('admin.medical_history.show',[$info->id]) }}" class="btn btn-xs btn-primary" title="View"><i class="mdi mdi-magnify"></i>View</a>-->
                                        <a href="{{ route('admin.docappoint_setting.show',[$info->id]) }}" class="btn btn-xs btn-primary" title="View"><i class="mdi mdi-magnify"></i>View</a>
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