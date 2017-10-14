<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{asset('admin/assets/img/favicon.ico')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="_token" content="{{ csrf_token() }}" />
	<title>MedCrip</title>
	<script type="text/javascript">
		window.Laravel = {
			csrfToken : '{!! csrf_token() !!}',
			basePath : '{!! url('/') !!}'
		}
	</script>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

     <link href = "http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel = "stylesheet">
     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.css">


    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.css" type="text/css" media="all" />

    

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" />

    <link href="{{asset('admin/assets/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" />


    <!-- Animation library for notifications   -->
    <link href="{{asset('admin/assets/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{asset('admin/assets/css/light-bootstrap-dashboard.css')}}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('admin/assets/css/demo.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/css/lightbox.min.css')}}" rel="stylesheet" />

    <!--  DataTable CSS     -->

    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" rel="stylesheet">

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('admin/assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="{{asset('admin/assets/img/sidebar-5.jpg')}}">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.medcrip.com" class="simple-text">
                    MedCrip
                </a>
            </div>

            <ul class="nav">
             <li {{ (current_page('welcome')) ? 'class=active' : ''}}>
                   <!--  <a href="{{url('/admin/welcome')}}">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a> -->
                    <a href="{{url('/admin/welcome')}}">
                        <i class="pe-7s-user"></i>
                        <p>User Profile </p>
                    </a>
                </li>
               <!--  <li {{ (current_page('user')) ? 'class=active' : ''}}>
                    <a href="{{url('/admin/user')}}">
                        <i class="pe-7s-user"></i>
                        <p>User Profile </p>
                    </a>
                </li> -->

                @if(auth()->user()->user_type == 1)
                <li {{ (current_page('appointment_setting')) ? 'class=active' : ''}}>
                    <a href="{{url('/admin/appointment_setting')}}">
                        <i class="pe-7s-note2"></i>
                        <p>Apppoinment</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->user_type == 2)
                <li {{ (current_page('docappoint_setting')) ? 'class=active' : ''}}>
                    <a href="{{url('/admin/docappoint_setting')}}">
                        <i class="pe-7s-note2"></i>
                        <p>Apppoinment List</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->user_type == 2)
                <li {{ (current_page('appoinment_reminder')) ? 'class=active' : ''}}>
                    <a href="{{url('/admin/appoinment_reminder')}}">
                        <i class="pe-7s-note2"></i>
                        <p>Appoinment Reminder</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->user_type == 2)
                <li {{ (current_page('cancelation_list')) ? 'class=active' : ''}}>
                    <a href="{{url('/admin/cancelation_list')}}">
                        <i class="pe-7s-note2"></i>
                        <p>Cancelation List</p>
                    </a>
                </li>
                @endif

                @if( auth()->user()->user_type == 1 || auth()->user()->user_type == 3)
                <li {{ (current_page('pharmist_setting')) ? 'class=active' : ''}}>
                    <a href="{{url('/admin/pharmist_setting')}}">
                        <i class="pe-7s-news-paper"></i>
                        <p>Prescription List</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->user_type == 3)
                <li {{ (current_page('add_prscription')) ? 'class=active' : ''}}>
                    <a href="{{url('/admin/add_prscriptions')}}">
                        <i class="pe-7s-news-paper"></i>
                        <p>New Prescription</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->user_type == 1)
                <li {{ (current_page('medical_history')) ? 'class=active' : ''}}>
                    <a href="{{url('/admin/medical_history')}}">
                        <i class="pe-7s-science"></i>
                        <p>Medical History</p>
                    </a>
                </li>
                @endif


                <li {{ (current_page('find_user')) ? 'class=active' : ''}}>
                    <a href="{{url('/admin/find_user')}}">
                        <i class="pe-7s-search"></i>
                        <p>
                          @if(auth()->user()->user_type == 1)  
                            Find Doctor/Pharmacy
                            @else
                            Find Patient
                          @endif
                        </p>
                    </a>
                </li>
                

                @if(auth()->user()->user_type == 1)
                <li {{ (current_page('review')) ? 'class=active' : ''}}>

                    <a href="{{url('/admin/review')}}">
                        <i class="pe-7s-map-marker"></i>
                        <p>Review</p>
                    </a>
                </li>
                @endif
                <!-- <li>
                    <a href="notifications.html">
                        <i class="pe-7s-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li> -->

            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">

                             <!-- <div class="deshboard-links nlist">
                                <a href="javascript:void(0)" class="dropdown-toggle ncount" data-toggle="dropdown" data-ncount="{{Auth::user()->notification_count}}">
                                    <i class="mdi mdi-bell"></i>
                                    <span class="label label-danger">{{Auth::user()->notification_count}}</span>
                                </a>
                                <div class="ncontainer">
                                    <ul class="nscroll" data-total="" data-nextPage="" style="overflow-y:scroll; max-height: 330px; cursor:pointer">
                                    </ul>
                                </div>
                            </div> -->

                            <div class="deshboard-links nlist">
                                <a href="javascript:void(0)" class="ncount" data-ncount="{{Auth::user()->notification_count}}">
                                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                                    <span class="label label-danger">{{Auth::user()->notification_count}}</span>
                                </a>
                                <div class="ncontainer">
                                    <ul class="nscroll" data-total="" data-nextPage="" style="  cursor:pointer">
                                    </ul>
                                </div>
                            </div>
                              <!-- <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul> -->
                        </li>
                        <!-- <li>
                           <a href="">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li> -->
                    </ul>

                    <!-- <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p>Account</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
										Dropdown
										<b class="caret"></b>
									</p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li> -->
                         <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

          @yield('content')


                        <div class="footer">
                            <hr>
                            <!-- <div class="stats">
                                <i class="fa fa-history"></i> Updated 3 minutes ago
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.medcrip.com">MedCrip</a>, made with love for a better service
                </p>
            </div>
        </footer> -->

    </div>
</div>


</body>


    <!--   Core JS Files   -->
    <script src="{{asset('admin/assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>

     <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

    <script src="{{asset('admin/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('admin/assets/js/jquery-ui-timepicker-addon.js')}}" type="text/javascript"></script>

	<script src="{{asset('admin/assets/js/jquery-ui-sliderAccess.js')}}" type="text/javascript"></script>

    <script src="{{asset('js/notify.js')}}" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="{{asset('admin/assets/js/bootstrap-checkbox-radio-switch.js')}}"></script>

	<!--  Charts Plugin -->
	<script src="{{asset('admin/assets/js/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('admin/assets/js/bootstrap-notify.js')}}"></script>

    <!--  Google Maps Plugin    -->
    {{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> --}}

    <!--  Data Table JS Plugin    -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>


    <script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>

    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>


    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="{{asset('admin/assets/js/light-bootstrap-dashboard.js')}}"></script>

    <script src="{{asset('admin/assets/js/lightbox-plus-jquery.js')}}"></script>


	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="{{asset('admin/assets/js/demo.js')}}"></script>

    <script src="{{asset('admin/assets/js/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>

    <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

    <script src="{{asset('admin/assets/js/locales/bootstrap-datetimepicker.fr.js')}}" type="text/javascript"></script>

     @yield('page.bottom-script')

    <script src="{{asset('js/dsite.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/review.js')}}" type="text/javascript"></script>



	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	// $.notify({
          //   	icon: 'pe-7s-gift',
          //   	message: "Welcome to <b>MedCrip</b> - a beautiful freebie for every web developer."
					//
          //   },{
          //       type: 'info',
          //       timer: 4000
          //   });

    	});
	</script>

</html>
