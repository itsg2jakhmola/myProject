@extends('layouts.admin')

@section('content')

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                                <h4 class="title">Medical History</h4>
                                <p class="category"> <b> Total : </b> {{count($medical_detail)}}</p>
                            </div>

                            <ul class="nav nav-tabs">
                                  <li class="active"><a data-toggle="tab" href="#home">General</a></li>
                                  <li>
                                  <a  href="{{ url('/admin/alergic_history') }}" class="btn btn-xs btn-info pull-right">Allergy Details</a>
                                  </li>
                            </ul>

                           
                              <div class="tab-content">

                                  <div id="home" class="tab-pane fade in active">

                                  <a href="{{route('admin.medical_history.create')}}" class="btn btn-info btn-fill pull-right">Add Medical</a>

                                     <div class="content table-responsive table-full-width">

                                <table id="myMedicalHistory" class="table table-hover table-striped display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Medical Scan</th>
                                        <th>Medical Scan Date</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </thead>
                                   
                    <tbody>
                        @if (count($medical_detail) > 0)

                            @foreach ($medical_detail as $info)
                                 <tr data-entry-id="{{ $info->id }}">
                                    <td> {{ ucfirst($info->name) }} </td>
                                    <td> {{ ucfirst(substr($info->description,0,10). ".....") }} </td>
                                    <!-- <td> {{ $info->medical_scan }}</td> -->
                                    <td>
                                        <a class="example-image-link imgLightBox" href="{{url( $info->medical_scan_path )}}" data-lightbox="example-1"> 


                                        <img src="{{url( $info->medical_scan_path )}}" class="img-circle imgLightBox img-thumbnail example-image" alt="profile-image"> </a> </td>
                                        <td> 
                                        {{ \Carbon\Carbon::parse($info->medical_scan_dt)->format('m/d/Y')}}</td>                        
                                    <td> 
                                        <span style="display:none;">                                            
                                            {{ \Carbon\Carbon::parse($info->created_at)->format('Y/m/d')}}
                                        </span>
                                        {{ \Carbon\Carbon::parse($info->created_at)->format('m/d/Y')}}                        
                                    </td>
                                     <td>
                                        <!--<a href="{{ route('admin.medical_history.show',[$info->id]) }}" class="btn btn-xs btn-primary" title="View"><i class="mdi mdi-magnify"></i>View</a>-->
                                        <a href="{{ route('admin.medical_history.show',[$info->id]) }}" target="_blank" class="btn btn-xs btn-primary" title="View"><i class="mdi mdi-magnify"></i>View</a>
                                        <a href="{{ route('admin.medical_history.edit',[$info->id]) }}" class="btn btn-xs btn-info" title="Edit">Edit<i class="mdi mdi-pencil"></i></a>
                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Are you Sure ?")."');",
                                        'route' => ['admin.medical_history.destroy', $info->id])) !!}
                                        <button type="submit" class="btn btn-xs btn-danger" title="Delete"><i class="mdi mdi-delete">Delete</i></button>
                                        {!! Form::close() !!}                                        
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    </table>

                            </div>
                                  </div>
                                  <div id="menu1" class="tab-pane fade">
                                    <a href="{{route('admin.alergic_history.create')}}" class="btn btn-info btn-fill pull-right">Add Alergic</a>

                                    
                                  </div>
                                </div> 

                           
                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection

<script>
$(document).ready(function() {
    $('#myMedicalHistory').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>