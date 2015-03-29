$(document).ready(function(){

	$("#application_file_row").hide();
	$("#application_file").removeAttr("required");

	$('select[name="purpose"]').change(function(){
		var value  = this.value;
		if(value == 'Personal'){
			$("#application_file").removeAttr("required");
			$("#school_guest_row").hide();
		}
		else{
			$("#application_file").attr("required","required");
			$("#school_guest_row").show();
		}
	});

	$('select[name="school_guest"]').change(function(){
		var value  = this.value;
		if(value == '0'){
			$("#application_file").removeAttr("required");
			$("#application_file_row").hide();
		}
		else{
			$("#application_file").attr("required","required");
			$("#application_file_row").show();
		}
	});
	$('select[name="building"]').change(function(){
		$.ajax({url : site_url("edc_booking/room_allotment/get_floor_plans/"+$(this).val()),
				success : function (result) {
					$('select[name="floor"]').html(result);
				}});
	});
	$('select[name="floor"]').change(function(){
		$.ajax({url : site_url("edc_booking/room_allotment/get_room_plans/"+$('select[name="building"]').val()+"/"+$(this).val()+"/"+$('select[name="check_in"]').val()+"/"+$('select[name="check_out"]').val()),
				success : function (result) {
					$('select[name="room"]').html(result);
				}});
	});
});
