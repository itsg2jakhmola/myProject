@extends('layouts.auth')

@section('content')
  <aside class="rights">
    <h3>Login Into Your Account</h3>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
      {{ csrf_field() }}
      <div class="radio">
        <label>
          <input type="radio" onclick="showLogin(event);" class="LoginScreen" id="patientLogin" name="user_type" value="1">
          <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
          <span>Patients</span>
        </label>
        <label>
          <input type="radio" onclick="showLogin(event);" class="LoginScreen" id="doctorLogin" name="user_type" value="2">
          <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
          <span>Doctor</span>
        </label>
        <label>
          <input type="radio" onclick="showLogin(event);" class="LoginScreen" id="pharmistLogin" name="user_type" value="3">
          <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
          <span>Pharmacies</span>
        </label>
      </div>

      <div class="LoginScreenSetting">
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="text" name="email" class="form-control users" placeholder="Username/Email">

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" name="password" class="form-control pass" placeholder="Password">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <button class="btn btn-info col-md-12">Sign In</button>
      </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <span><a href="{{ url('/password/reset') }}">Forgot Password</a></span>
          <span><a href="{{ url('/register') }}" id="createAccount">Create An Account</a></span>
        </div>
      </div>
    </form>
  </aside>
@endsection

<script>
  
</script>

 @if(count($errors) > 0)
        <script>
            $("#patientLogin").click();
        </script>
    @endif 