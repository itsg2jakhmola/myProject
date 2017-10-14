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


     {!! Form::model( $medicalhistory, ['route' => ['admin.medical_history.update', $medicalhistory->id], 'method' => 'PATCH', 'files'=>true]) !!}

        <div class="row">
            <div class="col-xs-12 form-group">

                {!! Form::label('name', 'Name*', ['class'=>'control-label']) !!}

                {!! Form::text('name', $medicalhistory->name, ['placeholder'=>'Input name ..', 'id'=>'name', 'class'=>'form-control']) !!}

                <p class="help-block error">
                    {!! $errors->has('name') ? $errors->first('name') : '' !!}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 form-group">

                {!! Form::label('description', 'Description*', ['class'=>'control-label']) !!}

                {!! Form::text('description', $medicalhistory->description, ['placeholder'=>'Input last name ..', 'id'=>'description', 'class'=>'form-control']) !!}
                <p class="help-block error">
                    {!! $errors->has('description') ? $errors->first('description') : '' !!}
                </p>
            </div>
        </div>

         <div class="row">
            <div class="col-xs-12 form-group">

                {!! Form::label('medical_scan', 'Medical Scan *', ['class'=>'control-label']) !!}

                {!! Form::file('medical_scan', ['class'=>'filestyle', 'data-input' => 'false']) !!}
                <!-- <p class="help-block" style="color:#0b6ad3">(Recommended size is: 45 x 45)</p> -->
                <p class="help-block error">
                    {!! $errors->has('medical_scan') ? $errors->first('medical_scan') : '' !!}
                </p>
                @if($medicalhistory->medical_scan != '' && $medicalhistory->medical_scan != null)
                <img width="200" height="200" src="{{url('images/medicalhistory/' . $medicalhistory->medical_scan)}}" alt="Icon Image"/>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 form-group">

                {!! Form::label('medical_scan_dt', 'Medical Scan Date *', ['class'=>'control-label']) !!}

                {!! Form::text('medical_scan_dt', $medicalhistory->medical_scan_dt, ['placeholder'=>'Input medical_scan_dt address ..', 'id'=>'medical_scan_dt', 'class'=>'form-control']) !!}
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