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
                            <th>Name</th>
                            <td>{{ ucfirst($medical_detail->name)}}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $medical_detail->description }}</td>
                        </tr>
                        <tr>
                            <th>Scan</th>
                            <td>{{ $medical_detail->medical_scan }}</td>
                        </tr>
                        <tr>
                            <th>Scan Date</th>
                            <td>{{ $medical_detail->medical_scan_dt }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $medical_detail->created_at }}</td>
                        </tr>
                        
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.medical_history.index') }}" class="btn btn-default">Back to List</a>
        </div>
    </div>
@stop
