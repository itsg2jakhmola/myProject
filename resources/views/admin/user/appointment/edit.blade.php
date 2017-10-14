@extends('layouts.admin')

@section('content')
    <h3 class="page-title">Edit Medical History</h3>

<style>
.delete-image{
    background-color:transparent;
     border:none;
      margin-left:16px;
}
.error{
    color:red;
}
</style>

<div class="panel panel-default">
    <div class="panel-heading">
        Edit

        @include('includes.flash')
    </div>



    <div class="panel-body">


     {!! Form::model( $appointmentRequest, ['route' => ['admin.appointment_setting.update', $appointmentRequest->id], 'method' => 'PATCH', 'files'=>true]) !!}

        <div class="row">
            <div class="col-xs-12 form-group">

                 <!-- <select class="form-control" name="doctor_speciality">
                    <option value="">-- Select Speciality --</option>
                    @foreach ($users as $user)
                      @if($user->user_type == '2')
                      <option value='{{$user->doctor_practice}}'> {{$user->doctor_practice}} </option>
                      @endif
                    @endforeach
                  </select>
             <p class="help-block error">
                {!! $errors->has('doctor_speciality') ? $errors->first('doctor_speciality') : '' !!}
            </p> -->

            {!! Form::label('speciality', 'Doctor Speciality*', ['class'=>'control-label']) !!}

                {!! Form::text('doctor_speciality', $appointmentRequest->doctor_speciality, ['placeholder'=>'Input Notes/Description Here ..', 'id'=>'doctor_speciality', 'class'=>'form-control', 'readonly']) !!}

                
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 form-group">

                {!! Form::label('description', 'Description*', ['class'=>'control-label']) !!}

                {!! Form::text('notes', $appointmentRequest->notes, ['placeholder'=>'Input Notes/Description Here ..', 'id'=>'notes', 'class'=>'form-control']) !!}
                <p class="help-block error">
                    {!! $errors->has('notes') ? $errors->first('notes') : '' !!}
                </p>
            </div>
        </div>

        

        <div class="row">
            <div class="col-xs-12 form-group">

                {!! Form::label('medical_scan_dt', 'Appointment Date *', ['class'=>'control-label']) !!}

                {!! Form::text('medical_scan_dt', $appointmentRequest->appointment_time, ['placeholder'=>'Input medical_scan_dt address ..', 'id'=>'appointment_date_edit', 'class'=>'form-control']) !!}
                <p class="help-block error">
                    {!! $errors->has('medical_scan_dt') ? $errors->first('medical_scan_dt') : '' !!}
                </p>
            </div>
        </div>

        {!! Form::submit('Update', ['id'=>'next', 'class'=>'btn btn-primary next']) !!}

        {!! Form::close() !!}

</div>

</div>

@endsection
