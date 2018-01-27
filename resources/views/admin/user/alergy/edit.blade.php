@extends('layouts.admin')

@section('content')
    <h3 class="page-title">Edit Alergy History</h3>

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


     {!! Form::model( $medicalhistory, ['route' => ['admin.alergic_history.update', $medicalhistory->id], 'method' => 'PATCH', 'files'=>true]) !!}

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

                {!! Form::label('description', 'Remarks*', ['class'=>'control-label']) !!}

                {!! Form::text('description', $medicalhistory->remarks, ['placeholder'=>'Input last name ..', 'id'=>'description', 'class'=>'form-control']) !!}
                <p class="help-block error">
                    {!! $errors->has('description') ? $errors->first('description') : '' !!}
                </p>
            </div>
        </div>

        
        {!! Form::submit('Update', ['id'=>'next', 'class'=>'btn btn-primary next']) !!}

        {!! Form::close() !!}

</div>

</div>

@endsection