@extends('layouts.admin')

@section('content')

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                                <h4 class="title">Alergy History</h4>
                                <p class="category"> <b> Total : </b> {{count($alergy_detail)}}</p>
                            </div>

                            <ul class="nav nav-tabs">
                                  <li>
                                  <a  href="{{ url('/admin/patient/medical_history') }}" class="btn btn-xs btn-info pull-right">General</a></li>
                                  <li class="active">
                                  <a  href="{{ url('/admin/alergic_history') }}" class="btn btn-xs btn-info pull-right">Alergic</a>
                                  </li>
                            </ul>

                           
                              <div class="tab-content">

                                  <div id="home" class="tab-pane fade in active">


                                     <div class="content table-responsive table-full-width">

                                <table id="myMedicalHistory" class="table table-hover table-striped display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <th>Name</th>
                                        <th>Remarks</th>
                                        <th>Created at</th>
                                        <!-- <th>Action</th> -->
                                    </thead>
                                   
                    <tbody>
                        @if (count($alergy_detail) > 0)

                            @foreach ($alergy_detail as $info)
                                 <tr data-entry-id="{{ $info->id }}">
                                    <td> {{ ucfirst($info->name) }} </td>
                                    <td> {{ ucfirst(substr($info->remarks,0,10). ".....") }} </td>
                                    <!-- <td> {{ $info->medical_scan }}</td> -->
                                    
                                    <td> 
                                        <span style="display:none;">                                            
                                            {{ \Carbon\Carbon::parse($info->created_at)->format('Y/m/d')}}
                                        </span>
                                        {{ $info->created_at }}                                         
                                    </td>
                                     <td>
                                        <!--<a href="{{ route('admin.medical_history.show',[$info->id]) }}" class="btn btn-xs btn-primary" title="View"><i class="mdi mdi-magnify"></i>View</a>-->
                                        <!-- <a href="{{ route('admin.alergic_history.show',[$info->id]) }}" target="_blank" class="btn btn-xs btn-primary" title="View"><i class="mdi mdi-magnify"></i>View</a> -->
                                        <!-- <a href="{{ route('admin.alergic_history.edit',[$info->id]) }}" class="btn btn-xs btn-info" title="Edit">Edit<i class="mdi mdi-pencil"></i></a>
                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Are you Sure ?")."');",
                                        'route' => ['admin.alergic_history.destroy', $info->id])) !!}
                                        <button type="submit" class="btn btn-xs btn-danger" title="Delete"><i class="mdi mdi-delete">Delete</i></button>
                                        {!! Form::close() !!}                     -->                    
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