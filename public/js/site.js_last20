function swapConfig(x) {
    var medCrip = document.getElementsByName(x.name);
    for(i = 0 ; i < medCrip.length; i++){
     document.getElementById(medCrip[i].id.concat("Settings")).style.display="none";
    }
    document.getElementById(x.id.concat("Settings")).style.display="initial";
  }

   $("#address, #doctor_address, #pharmacy_address").geocomplete({
              details: ".geo-details",
              detailsAttribute: "data-geo",
            });   


	  $("#address, #doctor_address, #pharmacy_address")
	    .geocomplete()
	    .bind("geocode:result", function (event, result) {            
	      $("#latitude, #doctor_latitude, #pharmacy_latitude").val(result.geometry.location.lat());
	      $("#longitude, #doctor_longitude, #pharmacy_longitude").val(result.geometry.location.lng());
	      /*console.log(result);*/
	  });

	$('#dob').datepicker({
	    dateFormat: 'dd-mm-yy', 
	    autoclose: true,
	    todayHighlight: true
	}); 