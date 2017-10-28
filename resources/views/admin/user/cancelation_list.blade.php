@extends('layouts.admin')

@section('content')

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                       
                    </div>
                    <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Patient Name</th>
                                        <th>Patient Email</th>
                                        <th>Status</th>
                                        
                                    </thead>
                                    <tbody>
                                        @if (count($viewCancel) > 0)

			                                @foreach ($viewCancel as $info)
			                                 <tr data-entry-id="{{ $info->id }}">
			                                    <td> {{ ucfirst($info['users']->name) }} </td>
                                    			<td> {{ $info['users']->email }}</td> 
                                    			<td style="margin-top:15px;" class="btn btn-xs btn-danger">Cancelled by You</td>
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

@endsection