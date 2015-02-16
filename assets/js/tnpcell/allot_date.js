// JavaScript Document

$(document).ready(function(){
	$date_from = $("#date_from");
	$date_to = $("#date_to");
	$box_makeschedule_top = $("#box_makeschedule_top");
	$box_makeschedule_bottom = $("#box_makeschedule_bottom");
	
	$box_reschedule_top = $("#box_reschedule_top");
	$box_reschedule_bottom = $("#box_reschedule_bottom");
	$box_makeschedule_bottom.hide();
	$box_reschedule_bottom.hide();
	
	//$date_to.on('change',function(){
	//	checkslot($date_from.val(),$date_to.val());
	//});
	
	$("#btn_checkslot").on('click',function(){
		if($date_from.val() == "" && $date_to.val() == "")
		{
			$date_from.focus();
			alert("Please Select a Valid Date");
		}
		else if($date_from.val() == "")
			$date_from.focus();
		else if($date_to.val() == "")
			$date_to.focus();
		else
			checkslot($date_from.val(),$date_to.val());
	});
	
	$("#btn_checkslot_reschedule").on('click',function(){
		if($("#date_reschedulefrom").val() == "" && $("#date_rescheduleto").val() == "")
		{
			$("#date_reschedulefrom").focus();
			alert("Please Select a Valid Date");
		}
		else if($("#date_reschedulefrom").val() == "")
			$("#date_reschedulefrom").focus();
		else if($("#date_rescheduleto").val() == "")
			$("#date_rescheduleto").focus();
		else
			checkslot_reschedule($("#date_reschedulefrom").val(),$("#date_rescheduleto").val());
	});

	
	function checkslot($from,$to)
	{
		$box_makeschedule_top.showLoading();
		$.ajax({
			url:site_url("tnpcell/allot_date/json_get_company_inrange/"+$from+"/"+$to),
			success:function(data){
				$box_makeschedule_bottom.show();
				//console.log(data[0]['date_from']);
				$base_str = "<thead><tr><th>S.No</th><th>Company Name</th><th>Date</th><th>Status</th></tr></thead>";
				if(data.length == 0)
					$base_str += "<tr><td colspan = '4'>No Company in this Slot.</td></tr>";
				for($d = 0;$d<data.length;$d++)
				{
					$base_str += "<tr><td>"+($d+1)+"</td><td>"+data[$d]['company_name']+"</td><td>"+data[$d]['date_from'] + " to " + data[$d][
					'date_to']+"</td><td>"+data[$d]['status']+"</td></tr>";
				}
				$("#table_makeschedule_bottom").html($base_str);
				$box_makeschedule_top.hideLoading();
			},
			type:"post",
			dataType:"json",
			fail:function(error){
				console.log(error);
				$box_makeschedule_top.hideLoading();
			}
		});
	}
	
	
	function checkslot_reschedule($from,$to)
	{
		//alert($from);
		//alert($to);
		$box_reschedule_top.showLoading();
		$.ajax({
			url:site_url("tnpcell/allot_date/json_get_company_inrange/"+$from+"/"+$to),
			success:function(data){
				$box_reschedule_bottom.show();
				//console.log(data[0]['date_from']);
				$base_str = "<thead><tr><th>S.No</th><th>Company Name</th><th>Date</th><th>Status</th></tr></thead>";
				if(data.length == 0)
					$base_str += "<tr><td colspan = '4'>No Company in this Slot.</td></tr>";
				for($d = 0;$d<data.length;$d++)
				{
					$base_str += "<tr><td>"+($d+1)+"</td><td>"+data[$d]['company_name']+"</td><td>"+data[$d]['date_from'] + " to " + data[$d][
					'date_to']+"</td><td>"+data[$d]['status']+"</td></tr>";
				}
				$("#table_reschedule_bottom").html($base_str);
				$box_reschedule_top.hideLoading();
			},
			type:"post",
			dataType:"json",
			fail:function(error){
				console.log(error);
				$box_reschedule_top.hideLoading();
			}
		});
	}
});

