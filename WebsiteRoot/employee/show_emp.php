<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	auth('emp','deo');
	require_once("connectDB.php");
	drawHeader("View Employee Details");
?>
<script type="text/javascript">

	function printContent(id)
	{
		str=document.getElementById(id).innerHTML
		newwin=window.open('','printwin','left=100,top=100,width=400,height=400')
		newwin.document.write('<HTML>\n<HEAD>\n')
		newwin.document.write('<TITLE>Print Page</TITLE>\n')
		newwin.document.write('<script>\n')
		newwin.document.write('function chkstate(){\n')
		newwin.document.write('if(document.readyState=="complete"){\n')
		newwin.document.write('window.close()\n')
		newwin.document.write('}\n')
		newwin.document.write('else{\n')
		newwin.document.write('setTimeout("chkstate()",2000)\n')
		newwin.document.write('}\n')
		newwin.document.write('}\n')
		newwin.document.write('function print_win(){\n')
		newwin.document.write('window.print();\n')
		newwin.document.write('chkstate();\n')
		newwin.document.write('}\n')
		newwin.document.write('<\/script>\n')
		newwin.document.write('</HEAD>\n')
		newwin.document.write('<BODY onload="print_win()">\n')
		newwin.document.write(str)
		newwin.document.write('</BODY>\n')
		newwin.document.write('</HTML>\n')
		newwin.document.close()
	}
	
/*
	function onclick_step(step)
	{
		$("#"+step).slideToggle("fast");
	}
*/
</script>
<?php
	$c=0;
	if(is_auth("emp"))
		$emp=$_SESSION['SESS_USERNAME'];
	else if(is_auth("deo"))
		$emp=$_GET['emp_id'];
	
	if(isset($_GET['form_name']))
		$form=$_GET['form_name'];	
	else
		echo "form_name not set";
	
	$emp_photo=mysql_query("select photopath from user_details where id='".$emp."'");
	$photo=mysql_fetch_row($emp_photo);
	echo '<div id="print" >
			<table>
			<tr>
				<th>Employee Id</th>
				<td>'.$emp.'</td>
			</tr></table>';
	if(mysql_num_rows($emp_photo)!=0)
		echo '<center><img src="Images/'.$emp.'/'.$photo[0].'" width="145" height="150" /></center>';

	if($form==0 || $form==5)
	{
		$emp_user_details=mysql_query("select * 
								from user_details NATURAL JOIN user_other_details NATURAL JOIN emp_basic_details
								where id='".$emp."'");
		$emp_pay_deatils=mysql_query("select pay_band,grade_pay,basic_pay 
								from emp_pay_details NATURAL JOIN pay_scales
								where id='".$emp."'");

		$user=mysql_fetch_assoc($emp_user_details);
		$pay=mysql_fetch_assoc($emp_pay_deatils);
		if($user['auth_id']=='ft')
		{	$research_query=mysql_query("select research_interest from faculty_details where id='".$emp."'");
			$research=mysql_fetch_assoc($research_query);
		}

		if(mysql_num_rows($emp_user_details)!=0)
		{
			$status_query=$mysqli->query("select * from emp_validation_details where id='".$emp."'");
			if($status_query->num_rows!=0)
			{
				$status_row=$status_query->fetch_assoc();
				if($status_row['profile_pic_status']=='pending')
					drawNotification("Pending : Profile Picture","Your profile picture is sent for validation.");
				else if($status_row['profile_pic_status']=='rejected')
				{
					$rejectreason0_query=$mysqli->query("select reason from emp_reject_reason where id='".$emp."' and step=0");
					$reject_row=$rejectreason0_query->fetch_assoc();
					drawNotification("Rejected : Profile Picture","Your profile picture is rejected. Please contact the Establishment Section for the same.<br>Reason behind rejection : ".$reject_row['reason'],"error");
				}

				if($status_row['basic_details_status']=='pending')
					drawNotification("Pending : Basic Details","Your basic details have been sent for validation.");
				else if($status_row['basic_details_status']=='rejected')
				{
					$rejectreason1_query=$mysqli->query("select reason from emp_reject_reason where id='".$emp."' and step=1");
					$reject_row=$rejectreason1_query->fetch_assoc();
					drawNotification("Rejected : Basic Details","Your basic details have been rejected. Please contact the Establishment Section for the same.<br>Reason behind rejection : ".$reject_row['reason'],"error");
				}
			}
			echo '<center><h2>Employee Basic Details</h2>';
			echo '	<table width="90%">
					<tr>
						<th>Name</th><td>'.$user['salutation'].' '.ucwords(trim($user['first_name'])).' '.ucwords($user['middle_name']).' '.ucwords(trim($user['last_name'])).'</td>
						<th>Marital Status</th><td>'.ucwords($user['marital_status']).'</td>
						<th>Physically Challenged</th><td>'.ucwords($user['physically_challenged']).'</td>
					</tr>
					<tr>
						<th>Gender</th><td>'.ucwords($user['sex']).'</td>
						<th>Category</th><td>'.ucwords($user['category']).'</td>
						<th>Kashmiri Immigrant</th><td>'.ucwords($user['kashmiri_immigrant']).'</td>
					</tr>
				<tr>
					<th>DOB</th><td>'.date('d M Y', strtotime($user['dob'])).'</td>
					<th>Place of Birth</th><td>'.ucwords($user['birth_place']).'</td>
					<th>Date of joining</th><td>'.date('d M Y', strtotime($user['joining_date'])).'</td>
				</tr>
				<tr>
					<th>Department</th>';
						
			$dept=mysql_query("select name from departments where id='".$user['dept_id']."'");
			$row=mysql_fetch_row($dept);
			
			$dt = DateTime::createFromFormat("Y-m-d", $user['retirement_date']);
			//var_dump($dt->format("d M Y"));
			//(strtotime("2041-01-31"));

			echo 	'<td>'.$row[0].'</td>
					<th>Designation</th>
					<td>'.ucwords($user['designation']).'</td>
					<th>Employment Nature</th><td>'.ucwords($user['employment_nature']).'</td>
				</tr>
				<tr>
					<th>Father\'s Name</th><td>'.$user['father_name'].'</td>
					<th>Mother\'s Name</th><td>'.$user['mother_name'].'</td>
					<th>Date of Retirement</th><td>'.$dt->format("d M Y").'</td>
				</tr>
				<tr>
					<th>Email</th><td>'.$user['email'].'</td>
					<th>Mobile no.</th><td>'.$user['mobile_no'].'</td>
				</tr>
				</table>';
	
			$emp_present_addr_details=mysql_query("select * from user_address where id='".$emp."' and type='present'");
			$emp_permanent_addr_details=mysql_query("select * from user_address where id='".$emp."' and type='permanent'");
			$addr1=mysql_fetch_assoc($emp_present_addr_details);
			$addr2=mysql_fetch_assoc($emp_permanent_addr_details);
			echo '<table width="90%">
				<tr>
					<th>Present Address</th>
					<th>Permanent Address</th>
				</tr>
				<tr>
					<td>'.$addr1['line1'].',<br>'.$addr1['line2'].',<br>'
						.ucwords($addr1['city']).', '.ucwords($addr1['state']).' - '.$addr1['pincode'].'<br>'
						.ucwords($addr1['country']).'<br>
						Contact no. '.$addr1['contact_no'].'</td>
					<td>'.$addr2['line1'].',<br>'.$addr2['line2'].',<br>'
						.ucwords($addr2['city']).', '.ucwords($addr2['state']).' - '.$addr2['pincode'].'<br>'
						.ucwords($addr2['country']).'<br>
						Contact no. '.$addr2['contact_no'].'</td>

				</tr>
				</table>';
	
				$emp_type=mysql_query("select type from auth_types where id='".$user['auth_id']."'");
				$row=mysql_fetch_row($emp_type);
				
			echo '<table  width="90%">
				<tr>
					<th>Employee Type</th><td>'.$row[0].'</td>
					<th>Research Interest</th>
					<td>'.(($user['auth_id']!='ft')?	'NA' : ucwords($research['research_interest'])).'</td>
					<th>Religion</th><td>'.ucwords($user['religion']).'</td>
					<th>Nationality</th><td>'.ucwords($user['nationality']).'</td>
				</tr>
				<tr>
					<th>Office no.</th><td>'.$user['office_no'].'</td>
					<th>Fax</th><td>'.$user['fax'].'</td>
					<th>Hobbies</th><td>'.ucfirst($user['hobbies']).'</td>
					<th>Favourite Past Time</th><td>'.ucfirst($user['fav_past_time']).'</td>
				</tr>
				<tr>
					<th>Pay Scale</th>
					<td><u>Pay Band</u> =>'.strtoupper($pay['pay_band']).'<br>
						<u>Grade Pay</u> =>'.$pay['grade_pay'].'<br>
						<u>Basic Pay</u> =>'.$pay['basic_pay'].'
					</td>
				</tr>
				</table></center>';
		}
		else 
		{
			
			if($form==0)
			{
				echo '<center><h2>Employee Basic Details</h2>';
				drawNotification("Not Found","Your details have not been updated. Please check after some time.","error");
			}
			$c=$c+1;
		}
	}
	if($form==1 || $form==5)
	{
		$prev_detail=mysql_query("select * from emp_prev_exp_details where id='".$emp."'");
		if(mysql_num_rows($prev_detail)!=0)
		{
			$status_query=$mysqli->query("select * from emp_validation_details where id='".$emp."'");
			if($status_query->num_rows!=0)
			{
				$status_row=$status_query->fetch_assoc();
				if($status_row['prev_exp_status']=='pending')
					drawNotification("Pending : Previous Employment Details","Your previous employment details have been sent for validation.");
				else if($status_row['prev_exp_status']=='rejected')
				{
					$rejectreason2_query=$mysqli->query("select reason from emp_reject_reason where id='".$emp."' and step=2");
					$reject_row=$rejectreason2_query->fetch_assoc();
					drawNotification("Rejected : Previous Employment Details","Your previous employment details have been rejected. Please contact the Establishment Section for the same.<br>Reason behind rejection : ".$reject_row['reason'],"error");
				}
			}
			echo '<br><center><h2>Previous Employment Details</h2>';
			echo '<table align="center" width="90%"> 
				<tr>
			        <th>Full address of Employer</th>
					<th>Position held</th>
			        <th>Date of joining</th>
			        <th>Date of leaving</th>
			        <th>Pay Scale</th>
			        <th>Remarks</th>
				</tr>';
				
			while($row=mysql_fetch_assoc($prev_detail))
			{
				echo '<tr>
			    	<td>'.ucwords($row['address']).'</td>
			    	<td>'.ucwords($row['designation']).'</td>
			    	<td>'.date('d M Y', strtotime($row['from'])).'</td>
			    	<td>'.date('d M Y', strtotime($row['to'])).'</td>
			    	<td>'.$row['pay_scale'].'</td>
			    	<td>'.ucfirst($row['remarks']).'</td>
				    </tr>';
			}
			echo "</table></center>";
		}
		else	
		{
			if($form==1)
			{
				echo '<br><center><h2>Previous Employment Details</h2>';
				drawNotification("Not Found","Your details have not been updated. Please check after some time.","error");
			}
			$c=$c+1;
		}
	}
	if($form==2 || $form==5)
	{
		$fam_detail=mysql_query("select * from emp_family_details where id='".$emp."'");
		if(mysql_num_rows($fam_detail)!=0)
		{
			$status_query=$mysqli->query("select * from emp_validation_details where id='".$emp."'");
			if($status_query->num_rows!=0)
			{
				$status_row=$status_query->fetch_assoc();
				if($status_row['family_details_status']=='pending')
					drawNotification("Pending : Dependent Family Member Details","Your dependent family member details have been sent for validation");
				else if($status_row['family_details_status']=='rejected')
				{
					$rejectreason3_query=$mysqli->query("select reason from emp_reject_reason where id='".$emp."' and step=3");
					$reject_row=$rejectreason3_query->fetch_assoc();
					drawNotification("Rejected : Dependent Family Member Details","Your dependent family member details have been rejected. Please contact the Establishment Section for the same.<br>Reason behind rejection : ".$reject_row['reason'],"error");
				}
			}
			echo '<br><center><h2>Employee Family Details</h2>';
			echo '<table align="center"> 
				<tr>
					 <th>Name</th>
				   	 <th>Relationship</th>
					 <th>Date of Birth</th>
				     <th>Profession</th>
				 	 <th>Present Postal Address</th>
					 <th>Photograph</th>
					 <th>Active/Inactive</th>
				</tr>';
				
			while($row=mysql_fetch_row($fam_detail))
			{
				if($row[8]=="Active")
					$style="background:#DFD";
				else
					$style="background:#FDD";
				echo '<tr align="center">
				    	<td>'.ucwords($row[2]).'</td>
					    <td>'.$row[3].'</td>
						<td>'.date('d M Y', strtotime($row[7])).'<br>(Age: '.floor((time() - strtotime($row[7]))/(365*24*60*60)).' years)</td>
					    <td>'.ucwords($row[4]).'</td>
					   	<td>'.$row[5].'</td>
					    <td><img src="Images/'.$emp.'/'.$row[6].'" name="image3[]" height="80"/></td>
						<td style="'.$style.'">'.$row[8].'</td>
				    </tr>';
			}
			echo "</table></center>";
		}
		else	
		{
			if($form==2)
			{
				echo '<br><center><h2>Employee Family Details</h2>';
				drawNotification("Not Found","Your details have not been updated. Please check after some time.","error");
			}
			$c=$c+1;
		}
	}
	if($form==3 || $form==5)
	{
		$edu_detail=mysql_query("select * from emp_education_details where id='".$emp."'");
		if(mysql_num_rows($edu_detail)!=0)
		{
			$status_query=$mysqli->query("select * from emp_validation_details where id='".$emp."'");
			if($status_query->num_rows!=0)
			{
				$status_row=$status_query->fetch_assoc();
				if($status_row['educational_status']=='pending')
					drawNotification("Pending : Educational Details","Your educational details have been sent for validation.");
				else if($status_row['educational_status']=='rejected')
				{
					$rejectreason4_query=$mysqli->query("select reason from emp_reject_reason where id='".$emp."' and step=4");
					$reject_row=$rejectreason4_query->fetch_assoc();
					drawNotification("Rejected : Educational Details","Your educational details have been rejected. Please contact the Establishment Section for the same.<br>Reason behind rejection : ".$reject_row['reason'],"error");
				}
			}
			echo '<br><center><h2>Employee Education Details</h2>';
			echo '<table align="center" width="90%"> 
					<tr>
					 <th>Examination</th>
				     <th>Course(Specialization)</th>
				   	 <th>College/University/Institute</th>
				     <th>Year</th>
				     <th>Percentage/Grade</th>
				     <th>Class/Division</th>
					</tr>';
				
			while($row=mysql_fetch_row($edu_detail))
			{
				echo '<tr align="center">
				    	<td>'.strtoupper($row[2]).'</td>
				    	<td>'.strtoupper($row[3]).'</td>
				    	<td>'.strtoupper($row[4]).'</td>
			    		<td>'.$row[5].'</td>
			    		<td>'.strtoupper($row[6]).'</td>
				    	<td>'.ucwords($row[7]).'</td>
				    </tr>';
			}
			echo "</table></center>";
		}
		else
		{
			if($form==3)
			{
				echo '<br><center><h2>Employee Education Details</h2>';
				drawNotification("Not Found","Your details have not been updated. Please check after some time.","error");
			}
			$c=$c+1;
		}
	}
	if($form==4 || $form==5)
	{
		$last5_detail=mysql_query("select * from emp_last5yrstay_details where id='".$emp."'");
		if(mysql_num_rows($last5_detail)!=0)
		{
			if($status_query->num_rows!=0)
			{
				$status_query=$mysqli->query("select * from emp_validation_details where id='".$emp."'");
				$status_row=$status_query->fetch_assoc();
				if($status_row['stay_status']=='pending')
					drawNotification("Pending : Last 5 Year Stay Details","Your last 5 year stay details have been sent for validation");
				else if($status_row['stay_status']=='rejected')
				{
					$rejectreason5_query=$mysqli->query("select reason from emp_reject_reason where id='".$emp."' and step=5");
					$reject_row=$rejectreason5_query->fetch_assoc();
					drawNotification("Rejected : Last 5 Year Stay Details","Your last 5 year stay details have been rejected. Please contact the Establishment Section for the same.<br>Reason behind rejection : ".$reject_row['reason'],"error");
				}
			}
			echo '<br><center><h2>Employee Last 5 Year Stay Details</h2>';
			echo '<table align="center" width="90%"> 
					<tr>
						<th colspan=2>Duration</th>
					   	 <th rowspan=2>Residential Address</th>
					     <th rowspan=2>Name of District Headquarters</th>
				     </tr>
				     <tr>
				     	<th>From</th>
				      	<th>To</th>
					</tr>';
				
			while($row=mysql_fetch_row($last5_detail))
			{
				echo '<tr align="center">
				    	<td>'.date('d M Y', strtotime($row[2])).'</td>
				    	<td>'.date('d M Y', strtotime($row[3])).'</td>
				    	<td>'.$row[4].'</td>
				    	<td>'.ucwords($row[5]).'</td>
				    </tr>';
			}
			echo "</table></center>";
		}
		else
		{
			
			if($form==4)
			{
				echo '<br><center><h2>Employee Last 5 Year Stay Details</h2>';
				drawNotification("Not Found","Your details have not been updated. Please check after some time.","error");
			}
			$c=$c+1;
		}
	}
	echo "</div>";
	if($c==5)
		drawNotification("Not Found","Your details have not been updated. Please check after some time.","error");
	else
		echo '<br><br><center><button onclick="printContent(\'print\')" >PRINT</button>';
	
	mysql_close();
	drawFooter();
?>