@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                            @include('includes.flash')

                                <h4 class="title">Find Doctor</h4>
                               
                            </div>
                            <div class="content table-responsive table-full-width">

                             
                              <form class="form-horizontal" enctype="multipart/form-data" role="form" method="get" action="{{ route('admin.user.view_detail') }}">

                                <div class="input-group">
                                    <select class="form-control" id="findUserType" name="finduser">
                                        <option value="">--Select--</option>
                                        @if(Auth::user()->user_type == 1)
                                        <option value="2">Doctor</option>
                                        <option value="3">Pharmacy</option>
                                        @else
                                        <option value="1">Patient</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="input-group">
                                      <div id="textboxes" hidden>
                                    <input type="text" id="skills" class="form-control" placeholder="Write user's email address" name="email" style="margin-right: 65%;">
                                   
                                    <p class="help-block error">
                                                {!! $errors->has('email') ? $errors->first('email') : '' !!}
                                    </p>

                                    <div class="row">
                                        <span style="margin-left: 50%;">Or</span>
                                    </div>

                                    <input type="text" id="phones" class="form-control" placeholder="Write user's phone number" name="phone">
                                     <p class="help-block error">
                                                {!! $errors->has('phone') ? $errors->first('phone') : '' !!}
                                    </p>

                                     <div class="row">
                                        <span style="margin-left: 50%;">Or</span>
                                    </div>

                                    <input type="text" id="doctor_practice" class="form-control" placeholder="Write Name of practice" name="doctor_practice">
                                     <p class="help-block error">
                                                {!! $errors->has('doctor_practice') ? $errors->first('doctor_practice') : '' !!}
                                    </p>

                                     <div class="row">
                                        <span style="margin-left: 50%;">Or</span>
                                    </div>

                                    <input type="text" id="address" class="form-control" placeholder="Write Address" name="address">
                                     <p class="help-block error">
                                                {!! $errors->has('address') ? $errors->first('address') : '' !!}
                                    </p>
                                    </div>

                                    <!-- <div class="row">
                                        <span style="margin-left: 50%;">Or</span>
                                    </div>

                                    <input type="text" id="invite_user" class="form-control" placeholder="Invite user write email Address" name="invite_user">
                                     <p class="help-block error">
                                                {!! $errors->has('invite_user') ? $errors->first('invite_user') : '' !!}
                                    </p> -->

                                  


                                    <span class="input-group-btn find-doctor">

                                    <button type="submit" class="btn btn-success">Search User</button>

                                    </span>
                                </div>

                            </form>

                             <div>
                             
                             <div>  
                               Current Active Default Doctor :
                               
                              <span class="active"> <b>{{  $doctorInfo ? $doctorInfo->name : 'Oh snap! Currently no user is assgined as default'}}</b> </span>
                            </div>

                            <div>
                               Current Active Default Pharmist :

                               <span class="active"> <b>{{ $pharmistInfo ? $pharmistInfo->name : 'Oh snap! Currently no user is assgined as default'}}</b> </span>
                            </div>

                             </div> 

                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>

@endsection

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
    
    $(function() {


    $("#findUserType").change(function() {
          if ($(this).val() == "") {
            $("#textboxes").hide();
          } else {
            $("#textboxes").show();
      }

    });

        var src = '{{Request::root()}}/api/user/suggestion/email';
        var srcPhone = '{{Request::root()}}/api/user/suggestion/phone';
        var PracticeName = '{{Request::root()}}/api/user/suggestion/practicename';
        var address = '{{Request::root()}}/api/user/suggestion/address';

    
   /* var skills = $("#skills").val();

    var phone = $("#phones").val();*/
    // Load the Users from the server, passing the usertype as an extra param
    $("#skills").autocomplete({
          source: function(request, response) {
            $.ajax({
              url: src,
              method: 'GET',
              dataType: "json",
              data: {
                term: $("#skills").val(),
                user_type: $("#findUserType").val()
              },
              success: function(data) {
                response(data);
              }
            });
          },
          min_length: 3,
          delay: 300
     });

    // Load the Users from phone to the server, passing the usertype as an extra param
        $("#phones").autocomplete({
          source: function(request, response) {
            $.ajax({
              url: srcPhone,
              dataType: "json",
              data: {
                term: $("#phones").val(),
                user_type: $("#findUserType").val()
              },
              success: function(data) {
                response(data);
              }
            });
          },
          min_length: 3,
          delay: 300
        });

    // Load the Users from practiceName to the server, passing the usertype as an extra param
        $("#doctor_practice").autocomplete({
          source: function(request, response) {
            $.ajax({
              url: PracticeName,
              dataType: "json",
              data: {
                term: $("#doctor_practice").val(),
                user_type: $("#findUserType").val()
              },
              success: function(data) {
                response(data);
              }
            });
          },
          min_length: 3,
          delay: 300
        });

     // Load the Users from practiceName to the server, passing the usertype as an extra param
        $("#address").autocomplete({
          source: function(request, response) {
            $.ajax({
              url: address,
              dataType: "json",
              data: {
                term: $("#address").val(),
                user_type: $("#findUserType").val()
              },
              success: function(data) {
                response(data);
              }
            });
          },
          min_length: 3,
          delay: 300
        });

  });  


         /*$( "#phones" ).autocomplete({
            source: '{{Request::root()}}/api/user/suggestion/phone'
    });*/

        $("#skills").click(function(){
            $("#phone").attr("disabled", "disabled");
        });

        $("#phone").click(function(){
            $("#skills").prop('disabled', true);
        })
//});
</script>