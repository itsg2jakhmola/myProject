@extends('layouts.admin')

@section('content')

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                                <h4 class="title">Appointment</h4>
                                <p class="category">Register your appointment</p>
                            </div>
                            <div class="content table-responsive table-full-width">

                     <div class="content">
                         <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('admin.docappoint_setting.store') }}">
                                {{ csrf_field() }}

                                    <div class="row smpad">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="form-control" name="doctor_speciality">
                                                    <option value="">-- Select Speciality --</option>
                                                    @foreach ($users as $user)
                                                      @if($user->user_type == '2')
                                                      <option value='{{$user->doctor_practice}}'> {{$user->doctor_practice}} </option>
                                                      @endif
                                                    @endforeach
                                                  </select>
                                             <p class="help-block error">
                                                {!! $errors->has('doctor_speciality') ? $errors->first('doctor_speciality') : '' !!}
                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row smpad">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Notes/Description</label>
                                                <textarea name="notes" class="form-control" placeholder="Input Your Notes/Description.."></textarea>
                                               <!--  <input type="text" name="notes" class="form-control" placeholder="Input Your Notes/Description.." value="{{old('notes')}}"> -->
                                                <p class="help-block error">
                                                {!! $errors->has('notes') ? $errors->first('notes') : '' !!}
                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="row smpad">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Appointment Date/Time *</label>
                                                <input type="text" id="appointment_date" class="form-control" name="medical_scan_dt" placeholder="Input Scan Date" value="{{old('medical_scan_dt')}}">
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
    $( "#appointment_date" ).datepicker();
  } );
</script>