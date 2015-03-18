$(document).ready(function(){	
	$("select[name='type']").on('change', function() {
		$.ajax({url : site_url("leave/leave_ajax/get_dept/"+this.value),
				success : function (result) {
					$('#department_name').html(result);
				}});
	});

	$('#department_name').on('change', function() {
		$.ajax({url : site_url("leave/leave_ajax/get_designation/"+this.value),
				success : function (result) {
					$('#designation').html(result);
				}});
	});
	$('#designation').on('change', function() {
		$.ajax({url : site_url("leave/leave_ajax/get_emp_name/"+$(this).val()+"/"+$('#department_name').val()),
				success : function (result) {
					$('#emp_name').html(result);
				}});	
	});
        $('#leave_end_date').on('change', function() {
		$.ajax({url : site_url("leave/leave_ajax/get_leave_by_emp_id/"+$('#emp_name').val()+"/"+$('#leave_start_date').val()+"/"+$('#leave_end_date').val()),
				success : function (result) {
					$('#leave_details').html(result);
				}});	
	});
});




