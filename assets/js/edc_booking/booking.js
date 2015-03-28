$(document).ready(function(){
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
});