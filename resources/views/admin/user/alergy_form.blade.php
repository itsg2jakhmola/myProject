@extends('layouts.admin')

@section('content')

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                                <h4 class="title">Allergy History</h4>
                                <p class="category">Register your alergy info</p>
                            </div>
                            <div class="content table-responsive table-full-width">

                     <div class="content">
                         <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('admin.alergic_history.store') }}">
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
                                                <br>
                                                <textarea name="description" placeholder="Description of drugs/food you are allergic to..">{{old('description')}}</textarea>
                                                <p class="help-block error">
                                                {!! $errors->has('description') ? $errors->first('description') : '' !!}
                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="row smpad">
                                        <div class="col-md-6">
                                            
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