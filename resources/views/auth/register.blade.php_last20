@extends('layouts.auth')

@section('content')
  <aside class="rights register">
    
      
      <div class="radio">
        <label>
          <input type="radio" onchange="swapConfig(this)" id="patient" checked="" name="user_type_check" value="1">
          <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
          <span>Patients</span>
        </label>
        <label>
          <input type="radio" onchange="swapConfig(this)" id="doctor" name="user_type_check" value="2">
          <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
          <span>Doctor</span>
        </label>
        <label>
          <input type="radio" onchange="swapConfig(this)" id="pharmacy" name="user_type_check" value="3">
          <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
          <span>Pharmacies</span>
        </label>
      </div>

<form class="form-horizontal" role="form" method="POST" action="{{ url('/register/patient') }}">
      {{ csrf_field() }}

    <div id="patientSettings">

     <input type="hidden" name="user_type" value="1">
     <input type="hidden" name="doctor_practice">
      <input type="hidden" name="fax_number">
      <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Patient Name">
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Email">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group">
        <input type="text" name="dob" id="dob" class="form-control" placeholder="Date of Birth">
        @if ($errors->has('dob'))
            <span class="help-block">
                <strong>{{ $errors->first('dob') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <input type="text" name="medical_number" class="form-control" placeholder="Medical Number">
      </div>
      <div class="form-group">
        <input type="text" name="address" id="address" class="form-control" placeholder="Address">
        @if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
        @if ($errors->has('phone_number'))
            <span class="help-block">
                <strong>{{ $errors->first('phone_number') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <input type="text" name="insurance_company" class="form-control" placeholder="Insurance Company">
      </div>
      <div class="form-group">
        <input type="text" name="insurance_number" class="form-control" placeholder="Insurance Number">
      </div>
      <div class="form-group geo-details">
          <input placeholder="Input Latitude .." id="latitude" class="form-control" name="lat" type="hidden" value="">
      </div>

     <div class="form-group geo-details">
        <input placeholder="Input Longitude .." id="longitude" class="form-control" name="lng" type="hidden" value="">
     </div> 
     <div class="form-group patientSettings">
        <button class="btn btn-info col-md-12">Register</button>
      </div>
    </div>
        
    </form>

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register/doctor') }}">
      {{ csrf_field() }}

  <div id="doctorSettings" style="display:none">

  <input type="hidden" name="user_type" value="2">
  <input type="hidden" name="dob" id="dobDoctor">
  <input type="hidden" name="medical_number">
  <input type="hidden" name="insurance_company">
  <input type="hidden" name="insurance_number">
      <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Doctor Name">
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Email">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
      </div>

     <!--  <div class="form-group">
        <input type="text" name="dob" class="form-control" placeholder="Date of Birth">
      </div> -->
      <div class="form-group">
        <input type="text" name="doctor_practice" class="form-control" placeholder="Name of Doctor Practice">
      </div>
      <div class="form-group">
        <input type="text" name="address" id="doctor_address" class="form-control" placeholder="Address">
      </div>
      <div class="form-group">
        <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
      </div>
      <div class="form-group">
        <input type="text" name="fax_number" class="form-control" placeholder="Fax Number">
      </div>
      <div class="form-group geo-details">
          <input placeholder="Input Latitude .." id="doctor_latitude" class="form-control" name="lat" type="hidden" value="">
      </div>

     <div class="form-group geo-details">
        <input placeholder="Input Longitude .." id="doctor_longitude" class="form-control" name="lng" type="hidden" value="">
     </div> 
     <div class="form-group patientSettings">
        <button class="btn btn-info col-md-12">Register</button>
      </div>
    </div>
</form>

<form class="form-horizontal" role="form" method="POST" action="{{ url('/register/pharmacy') }}">
      {{ csrf_field() }}

  <div id="pharmacySettings" style="display:none">

  <input type="hidden" name="user_type" value="3">
  <input type="hidden" name="dob" id="dobPharmacy">
  <input type="hidden" name="medical_number">
  <input type="hidden" name="insurance_company">
  <input type="hidden" name="insurance_number">
  <input type="hidden" name="doctor_practice">
      <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Name of Pharmacy">
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Email">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group">
        <input type="text" name="address" id="pharmacy_address" class="form-control" placeholder="Address">
      </div>
       <div class="form-group">
        <input type="text" name="practice_licence" class="form-control" placeholder="Practise Licence">
      </div>
      <div class="form-group">
        <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
      </div>
      <div class="form-group">
        <input type="text" name="fax_number" class="form-control" placeholder="Fax Number">
      </div>
     <div class="form-group geo-details">
          <input placeholder="Input Latitude .." id="pharmacy_latitude" class="form-control" name="lat" type="hidden" value="">
      </div>

     <div class="form-group geo-details">
        <input placeholder="Input Longitude .." id="pharmacy_longitude" class="form-control" name="lng" type="hidden" value="">
     </div> 
    <div class="form-group">
        <button class="btn btn-info col-md-12">Register</button>
      </div>
    </div>

    </form>
  </aside>
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

 <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script src="http://dev.demosparx.in/CSS5772/public/admin/plugins/location-tracker/jquery.geocomplete.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
          alert("s");
            $("#location1").geocomplete({
              details: ".geo-details",
              detailsAttribute: "data-geo",
            });   


              $("#location1")
                .geocomplete()
                .bind("geocode:result", function (event, result) {            
                  $("#latitude").val(result.geometry.location.lat());
                  $("#longitude").val(result.geometry.location.lng());
                  /*console.log(result);*/
              });
            
            jQuery('#dob').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
                todayHighlight: true
            }); 
            

        });              
    </script>