@extends('layouts.admin')

@section('content')

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                                <h4 class="title">Medical History</h4>
                                <p class="category">Register your medical info</p>
                            </div>
                            <div class="content table-responsive table-full-width">

                     <div class="content">
                         <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('admin.medical_history.store') }}">
                                {{ csrf_field() }}

                                    <div class="row smpad">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name *</label>
                                                <input type="text" name="name" class="form-control" placeholder="Input Name.." value="{{old('name')}}">
                                             <p class="help-block error">
                                                {!! $errors->has('name') ? $errors->first('name') : '' !!}
                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row smpad">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" name="description" class="form-control" placeholder="Input Description.." value="{{old('description')}}">
                                                <p class="help-block error">
                                                {!! $errors->has('description') ? $errors->first('description') : '' !!}
                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row smpad">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Upload File *</label>
                                                <input type="file" name="medical_scan" class="form-control" placeholder="Upload Scan Copy">
                                                {!! $errors->has('medical_scan') ? $errors->first('medical_scan') : '' !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row smpad">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date *</label>
                                                <input type="text" id="datepicker" class="form-control" name="medical_scan_dt" placeholder="Input Scan Date" value="{{old('medical_scan_dt')}}">
                                            </div>
                                        </div>
                                    
                                    <div class="row smpad"> 
                                    <button type="submit" class="medicineBtn btn btn-info btn-fill pull-right">Submit</button>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        
                    </form>

                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>

@endsection

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>