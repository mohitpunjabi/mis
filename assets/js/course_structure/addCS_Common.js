
$(document).ready(function(){
	$group_1 = $("#group_1");
	$group_2 = $("#group_2");
	$cont_group_1 = $("#cont_group1");
	$cont_group_2 = $("#cont_group2");
	
	$cont_group_1.hide();
	$cont_group_2.hide();
	
	$group_1.hide();
	$group_2.hide();
	
	
	$("#semester").change(function(){
		if($("#semester").val() == "1")
		{
			$cont_group_2.hide();
			$group_2.hide();
			$cont_group_1.show();
			$group_1.prop('disabled',false);
			$group_1.show();
		}
		else
		{
			$cont_group_1.hide();
			$group_1.hide();
			$cont_group_2.show();
			$group_2.prop('disabled',false);
			$group_2.show();
		}
	});

});