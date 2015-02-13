// JavaScript Document

$(document).ready(function(){
	$date_from = $("#date_from");
	$date_to = $("#date_to");
	$box_form = $("#box_makeschedule");
	$box_alreadyscheduled = $("#box_alreadyscheduled");
	$box_alreadyscheduled.hide();
	//	alert($date_from.val());
	
	//$date_to.on('change',function(){
	//	checkslot($date_from.val(),$date_to.val());
	//});
	
	$("#btn_checkslot").on('click',function(){
		checkslot($date_from.val(),$date_to.val());
	});
	
	function checkslot($from,$to)
	{
		$box_form.showLoading();
		$.ajax({
			url:site_url("tnpcell/allot_date/json_get_company_inrange/"+$from+"/"+$to),
			success:function(data){
				$box_alreadyscheduled.show();
				alert(data.length);	
				$box_form.hideLoading();
			},
			type:"post",
			dataType:"json",
			fail:function(error){
				console.log(error);
				$box_form.hideLoading();
			}
		});
	}
});

