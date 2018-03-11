@extends('layouts.admin')

@section('content')

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                                @include('includes.flash')

                                <h4 class="title">Orders</h4>
                                <p class="category"> <b> Total : {{count($orders)}} </b> </p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Appointment ID</th>
                                        <th>Doctor Name</th>
                                        <th>Pharmist Name</th>
                                        <th>Amount</th>
                                        <th>Rating</th>
                                        <th>Action</th>
                                        
                                    </thead>
                                    <tbody>
                               
                                @if (count($orders) > 0)

                                @foreach ($orders as $info)

                                 <tr data-entry-id="{{ $info->id }}">
                                    <td> {{ ucfirst($info->appointment_id) }} </td>
                                    <td> {{ $info['doctor']->name }} </td>
                                    <td> {{ $info->pharma_name }}</td> 
                                    <td> {{ $info->amount }}</td> 
                                    <td> Nothing</td> 
                                    <td>
                                        <span style="display:none;">                                            
                                            {{ \Carbon\Carbon::parse($info->created_at)->format('Y/m/d')}}
                                        </span>
                                        {{ $info->created_at }}                                         
                                    </td>
                                     <td>
                                        <!--<a href="{{ route('admin.medical_history.show',[$info->id]) }}" class="btn btn-xs btn-primary" title="View"><i class="mdi mdi-magnify"></i>View</a>-->
                                        <a href="{{ route('admin.review.show',[$info->appointment_id]) }}" class="btn btn-xs btn-primary" title="View"><i class="mdi mdi-magnify"></i>View</a>
                                        
                                        <!-- @if($info['appointment_request']['seen'] == 'Pending')

                                        <a href="{{ route('admin.appointment_setting.edit',[$info->id]) }}" class="btn btn-xs btn-info" title="Edit">Edit<i class="mdi mdi-pencil"></i></a>
                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Are you Sure ?")."');",
                                        'route' => ['admin.appointment_setting.destroy', $info->id])) !!}
                                        <button type="submit" class="btn btn-xs btn-danger" title="Delete"><i class="mdi mdi-delete">Delete</i></button>

                                        @endif -->

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