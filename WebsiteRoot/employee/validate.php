<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	auth("est_ar","deo");
	require_once("connectDB.php");
	drawHeader("Validation requests");
?>
<h1 align="center">Validation Requests</h1><br>
<script type="text/javascript">
	function reject_reason(i)
	{
		alert("Reason behind Rejection : '"+document.getElementById('rejected'+i).innerHTML+"'");
	}
</script>

<?php
	$validate_query=$mysqli->query("select * from emp_validation_details");
	if($validate_query->num_rows==0)
		drawNotification("No Pending Requests","There are no pending requests left.");
	else
	{
		echo "<table align=\"center\">
				<tr>
					<th rowspan='2' >Employee Id</th>
					<th rowspan='2'>Employee Name</th>
					<th colspan='6'>Status</th>
				</tr>
				<tr>
					<th>Profile Pic</th>
					<th>Basic Details</th>
					<th>Previous Employment Details</th>
					<th>Dependent Family Member Details</th>
					<th>Educational Details</th>
					<th>Last 5 Year Stay Details</th>
				</tr>";
		$i=0;		
		while($v_row=$validate_query->fetch_assoc())
		{
			$i++;
			$emp_name_query=$mysqli->query("select salutation,first_name,last_name from user_details where id='".$v_row['id']."'");
			$emp_name_row=$emp_name_query->fetch_assoc();
			$emp_name=ucwords($emp_name_row['salutation']).' '.ucwords($emp_name_row['first_name']).' '.ucwords($emp_name_row['last_name']);
			echo "<tr>
					<td align=\"center\" >".$v_row['id']."</td>
					<td align=\"center\">".$emp_name."</td>";
			//profile step
			if($v_row['profile_pic_status']=='pending')
			{	
				echo "<td align=\"center\">";
				if(is_auth('est_ar'))
					echo "<a href='validate_step.php?step=profile&emp=".$v_row['id']."'>".ucwords($v_row['profile_pic_status'])."</a></td>";
				else
					echo ucwords($v_row['profile_pic_status'])."</td>";
			}
			else if($v_row['profile_pic_status']=='rejected')
			{
				echo "<td align=\"center\"><a onclick=\"reject_reason('0".$i."')\" >".ucwords($v_row['profile_pic_status'])."</a></td>";
				$rejected0_query=$mysqli->query("select reason from emp_reject_reason where step=0 and id='".$v_row['id']."'");
				$rejectrow0=$rejected0_query->fetch_assoc();
				echo "<div id='rejected0".$i."' style='display:none'>".$rejectrow0['reason']."</div>";
			}
			else
				echo "<td align=\"center\">".ucwords($v_row['profile_pic_status'])."</td>";
			
			//basic details
			if($v_row['basic_details_status']=='pending')
			{	
				echo "<td align=\"center\">";
				if(is_auth('est_ar'))
					echo "<a href='validate_step.php?step=basic&emp=".$v_row['id']."'>".ucwords($v_row['basic_details_status'])."</a></td>";
				else
					echo ucwords($v_row['basic_details_status'])."</td>";
			}
			else if($v_row['basic_details_status']=='rejected')
			{
				echo "<td align=\"center\"><a onclick=\"reject_reason('1".$i."')\" >".ucwords($v_row['basic_details_status'])."</a></td>";
				$rejected1_query=$mysqli->query("select reason from emp_reject_reason where step=1 and id='".$v_row['id']."'");
				$rejectrow1=$rejected1_query->fetch_assoc();
				echo "<div id='rejected1".$i."' style='display:none'>".$rejectrow1['reason']."</div>";
			}
			else
				echo "<td align=\"center\">".ucwords($v_row['basic_details_status'])."</td>";	
			
			
			//previous emp details
			if($v_row['prev_exp_status']=='pending')
			{
				echo "<td align=\"center\">";
				if(is_auth('est_ar'))
					echo "<a href='validate_step.php?step=prevemp&emp=".$v_row['id']."'>".ucwords($v_row['prev_exp_status'])."</a></td>";
				else
					echo ucwords($v_row['prev_exp_status'])."</td>";

			}
			else if($v_row['prev_exp_status']=='rejected')	//changes to be done in rejected
			{
				echo "<td align=\"center\"><a onclick=\"reject_reason('2".$i."')\" >".ucwords($v_row['prev_exp_status'])."</a></td>";
				$rejected2_query=$mysqli->query("select reason from emp_reject_reason where step=2 and id='".$v_row['id']."'");
				$rejectrow2=$rejected2_query->fetch_assoc();
				echo "<div id='rejected2".$i."' style='display:none'>".$rejectrow2['reason']."</div>";
			}
			else
				echo "<td align=\"center\">".ucwords($v_row['prev_exp_status'])."</td>";		


			//family details
			if($v_row['family_details_status']=='pending')
			{
				echo "<td align=\"center\">";
				if(is_auth('est_ar'))
					echo "<a href='validate_step.php?step=family&emp=".$v_row['id']."'>".ucwords($v_row['family_details_status'])."</a></td>";
				else
					echo ucwords($v_row['family_details_status'])."</td>";
			}
			else if($v_row['family_details_status']=='rejected')	//changes to be done in rejected
			{
				echo "<td align=\"center\"><a onclick=\"reject_reason('3".$i."')\" >".ucwords($v_row['family_details_status'])."</a></td>";
				$rejected3_query=$mysqli->query("select reason from emp_reject_reason where step=3 and id='".$v_row['id']."'");
				$rejectrow3=$rejected3_query->fetch_assoc();
				echo "<div id='rejected3".$i."' style='display:none'>".$rejectrow3['reason']."</div>";
			}
			else
				echo "<td align=\"center\">".ucwords($v_row['family_details_status'])."</td>";
				
			//educational details
			if($v_row['educational_status']=='pending')
			{	
				echo "<td align=\"center\">";
				if(is_auth('est_ar'))
					echo "<a href='validate_step.php?step=educational&emp=".$v_row['id']."'>".ucwords($v_row['educational_status'])."</a></td>";
				else
					echo ucwords($v_row['educational_status'])."</td>";
			}
			else if($v_row['educational_status']=='rejected')	//changes to be done in rejected
			{	
				echo "<td align=\"center\"><a onclick=\"reject_reason('4".$i."')\" >".ucwords($v_row['educational_status'])."</a></td>";
				$rejected4_query=$mysqli->query("select reason from emp_reject_reason where step=4 and id='".$v_row['id']."'");
				$rejectrow4=$rejected4_query->fetch_assoc();
				echo "<div id='rejected4".$i."' style='display:none'>".$rejectrow4['reason']."</div>";
			}
			else
				echo "<td align=\"center\">".ucwords($v_row['educational_status'])."</td>";
				
			//last 5 yr stay details
			if($v_row['stay_status']=='pending')
			{	
				echo "<td align=\"center\">";
				if(is_auth('est_ar'))
					echo "<a href='validate_step.php?step=stay&emp=".$v_row['id']."'>".ucwords($v_row['stay_status'])."</a></td>";
				else
					echo ucwords($v_row['stay_status'])."</td>";

			}
			else if($v_row['stay_status']=='rejected')	//changes to be done in rejected
			{	
				echo "<td align=\"center\"><a onclick=\"reject_reason('5".$i."')\" >".ucwords($v_row['stay_status'])."</a></td>";
				$rejected5_query=$mysqli->query("select reason from emp_reject_reason where step=5 and id='".$v_row['id']."'");
				$rejectrow5=$rejected5_query->fetch_assoc();
				echo "<div id='rejected5".$i."' style='display:none'>".$rejectrow5['reason']."</div>";
			}
			else
				echo "<td align=\"center\">".ucwords($v_row['stay_status'])."</td>";	
			echo "</tr>";
		}
		echo "</table>";
	}
	mysql_close();
	drawFooter();
?>
