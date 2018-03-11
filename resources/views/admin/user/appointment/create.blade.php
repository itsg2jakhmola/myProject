@extends('layouts.admin')

@section('content')

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            @if(!$nearbyUser['assignedUser'])

                            <div>
                                Assign your default doctor first.
                                <a href="{{url('admin/find_user')}}">Click here to set default user</a>
                            </div>
                            @else
                            

                            <div class="header">

                                <h4 class="title">Appointment</h4>
                                <p class="category">Register your appointment</p>
                            </div>
                            <div class="content table-responsive table-full-width">

                     <div class="content">
                         <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('admin.appointment_setting.store') }}">
                                {{ csrf_field() }}

                                    <!-- <div class="row smpad">
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
                                    </div> -->
                                    <div class="row smpad">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Reason to see your doctor</label>
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
                                    
                                    <div>
                                        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                                    </div>
                                    
                                    <div>
                                        <input type="hidden" name="request_to" id="request_to" value="">
                                    </div>
                                    

                                    <div class="row smpad"> 
                                    <button type="submit" class="medicineBtn btn btn-info btn-fill pull-right">Submit</button>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>
                            </div>
                       

                            </div>
                           @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>

@endsection
