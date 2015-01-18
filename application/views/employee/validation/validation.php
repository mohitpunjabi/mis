<?php
	$show = true;
	if($step != '')
	{
		switch($step)
		{
			case 0: if($emp_validation_details->profile_pic_status != "pending")	$show=false;break;
			case 1: if($emp_validation_details->basic_details_status != "pending")	$show=false;break;
			case 2: if($emp_validation_details->prev_exp_status != "pending")	$show=false;break;
			case 3: if($emp_validation_details->family_details_status != "pending")	$show=false;break;
			case 4: if($emp_validation_details->educational_status != "pending")	$show=false;break;
			case 5: if($emp_validation_details->stay_status != "pending")	$show=false;break;
			default : $show=false;
		}
	}else $show = false;
?>
<?php if($show)	{ ?>
<?= form_open('employee/validation/validate_details/'.$emp_id.'/'.$step); ?>
	<br>
	<center>
	<input type='submit' id='approve' name='approve' value='Approve'></input>
	<input type='button' id='b_reject' value='Reject' onclick="javascript:document.getElementById('reason_cover').style.display='block';document.getElementById('b_reject').style.display='none';document.getElementById('approve').style.display='none';document.getElementById('reason').required=true;" ></input><br>
	<div id='reason_cover' style='display:none' >
		<input type='text' id='reason' name='reason' placeholder='Reason for rejection' />
		<input type='submit' name='reject' value='Reject' ></input>
	</div>
	</center>
<?= form_close() ?>
<?php }	?>
<a href= <?= site_url('employee/validation')?> ><center><button>Back</button></center></a>
