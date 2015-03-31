$(document).ready(function(){

	$('#room_alloc_button').attr('disabled','disabled');
	if($('input[name="room_total"]').val() != 'No room left to be allocated.'){
		//alert('gkhkdfg');
		$('#room_alloc_button').removeAttr('disabled');
	}

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

	$('#booking_form').click(function() {
		var checkin = $('#checkin').val();
		var checkout = $('#checkout').val();
		if (checkin>checkout) {
			alert ("Check In Date can't be earlier than Check Out Date.");
			return false;
		}
	});

	$('select[name="building"]').change(function(){
		//alert($('#check_in').val());
		$.ajax({url : site_url("edc_booking/room_allotment/get_room_plans/"+$(this).val()+"/"+$('#check_in').val()+"/"+$('#check_out').val()),
				success : function (result) {
					$('#floor').html(result);
				}});
	});
	$('select[name="floor"]').change(function(){
		$.ajax({url : site_url("edc_booking/room_allotment/get_room_plans/"+$('select[name="building"]').val()+"/"+$(this).val()+"/"+$('select[name="check_in"]').val()+"/"+$('select[name="check_out"]').val()),
				success : function (result) {
					$('#room_container').html(result);
				}});
	});
	/*$("input[type=checkbox][name=room_list[]]").click(function() {

    var bol = $("input[type=checkbox][name=room_list[]]:checked").length >= 4;
    $("input[type=checkbox][name=room_list[]]").not(":checked").attr("disabled",bol);

	});*/
	$('#floor').click(function () {
		var limit = $('input[name="room_total"]').val();
    if ($('input[type=checkbox]:checked').length == limit) {
        $('input[type=checkbox]').not(":checked").attr('disabled', true);
        alert("You are only allowed to allocate "+limit+" rooms.");
    }
		if ($('input[type=checkbox]:checked').length < limit) {
        $('input[type=checkbox]').not(":checked").attr('disabled', false);
        //alert("You are only allowed to allocate "+limit+" rooms.");
    }
	});

});
