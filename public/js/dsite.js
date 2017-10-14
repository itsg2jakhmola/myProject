$( function() {
	$( "#appointment_date_edit" ).datepicker({
		dateFormat: 'dd-mm-yy'
	});
	$( "#appointment_date" ).datepicker({
		dateFormat: 'dd-mm-yy'
	});
    $("#pickup_date").datepicker({
    	dateFormat: 'dd-mm-yy'
    });
   

 $('.replydoctor').click(function(){

 	$(".replydoctorSetting").css('display', 'block');
 	
 });



});

