<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	auth('est_ar');
	require_once("connectDB.php");
	drawHeader("Employee Validation");
?>
<script	type="text/javascript">
	function onclick_submit(id,step)
	{
		if(document.getElementById('div'+step).style.display=='none' )
			return true;
		else
		{
			var reason=document.getElementById(id).value;
			if(reason=="")
				return false;
			else
				return true;
		}
	}
	
	function reject_reason(i)
	{
		alert("Reason behind Rejection : '"+document.getElementById('rejected'+i).innerHTML+"'");
	}
</script>
<?php
	if(isset($_GET['emp']))
	{
		$_SESSION['EMP_VALIDATE']=$emp=$_GET['emp'];
		$validate_query=$mysqli->query("select * from emp_validation_details where id='".$emp."'");
		$emp_name_query=$mysqli->query("select salutation,first_name,last_name from user_details where id='".$emp."'");
		$emp_name_row=$emp_name_query->fetch_assoc();
		$emp_name=ucwords($emp_name_row['salutation']).' '.ucwords($emp_name_row['first_name']).' '.ucwords($emp_name_row['last_name']);
		if($validate_query->num_rows==0)
		{
			drawNotification("Employee Validation","The employee ".$emp." ".$emp_name." details have been Approved","success");
		}
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
				echo "<tr>
					<td align=\"center\" >".$v_row['id']."</td>
					<td align=\"center\">".$emp_name."</td>";
				//profile step
				if($v_row['profile_pic_status']=='pending')
					echo "<td align=\"center\"><a onclick=\"javascript: document.getElementById('profile').style.display='block';document.getElementById('basic').style.display='none';document.getElementById('prevemp').style.display='none';document.getElementById('family').style.display='none';document.getElementById('educational').style.display='none';document.getElementById('stay').style.display='none';\">".ucwords($v_row['profile_pic_status'])."</a></td>";
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
					echo "<td align=\"center\"><a onclick=\"javascript: document.getElementById('profile').style.display='none';document.getElementById('basic').style.display='block';document.getElementById('prevemp').style.display='none';document.getElementById('family').style.display='none';document.getElementById('educational').style.display='none';document.getElementById('stay').style.display='none';\">".ucwords($v_row['basic_details_status'])."</a></td>";
				else if($v_row['basic_details_status']=='rejected')	//changes to be done in rejected
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
					echo "<td align=\"center\"><a onclick=\"javascript: document.getElementById('profile').style.display='none';document.getElementById('basic').style.display='none';document.getElementById('prevemp').style.display='block';document.getElementById('family').style.display='none';document.getElementById('educational').style.display='none';document.getElementById('stay').style.display='none';\">".ucwords($v_row['prev_exp_status'])."</a></td>";
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
					echo "<td align=\"center\"><a onclick=\"javascript: document.getElementById('profile').style.display='none';document.getElementById('basic').style.display='none';document.getElementById('prevemp').style.display='none';document.getElementById('family').style.display='block';document.getElementById('educational').style.display='none';document.getElementById('stay').style.display='none';\">".ucwords($v_row['family_details_status'])."</a></td>";
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
					echo "<td align=\"center\"><a onclick=\"javascript: document.getElementById('profile').style.display='none';document.getElementById('basic').style.display='none';document.getElementById('prevemp').style.display='none';document.getElementById('family').style.display='none';document.getElementById('educational').style.display='block';document.getElementById('stay').style.display='none';\">".ucwords($v_row['educational_status'])."</a></td>";
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
					echo "<td align=\"center\"><a onclick=\"javascript: document.getElementById('profile').style.display='none';document.getElementById('basic').style.display='none';document.getElementById('prevemp').style.display='none';document.getElementById('family').style.display='none';document.getElementById('educational').style.display='none';document.getElementById('stay').style.display='block';\">".ucwords($v_row['stay_status'])."</a></td>";
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

		//profile pic		
		if(isset($_GET['step']) && $_GET['step']=='profile')
			echo "<div id='profile'>";
		else
			echo "<div id='profile' style='display:none'>";

		$emp_photo=$mysqli->query("select photopath from user_details where id='".$emp."'");
		$photo=$emp_photo->fetch_row();
		echo '<br><br><center><h2>Employee Profile Picture</h2><img src="Images/'.$emp.'/'.$photo[0].'" width="145" height="150" /><br>';
		echo "<form action='validate_query.php' method='post' onSubmit='return onclick_submit(\"reason0\",0)' >
				<input type='submit' id='approve0' name='approve0' value='Approve'></input>
				<input type='button' id='b_reject0' value='Reject' onclick=\"javascript:document.getElementById('div0').style.display='block';document.getElementById('b_reject0').style.display='none';document.getElementById('approve0').style.display='none';\" ></input><br>
				<div id='div0' style='display:none' >
					<input type='text' id='reason0' name='reason0' placeholder='Reason for rejection'/>
					<input type='submit' name='reject0' value='Reject' ></input>
				</div></form></center></div>";
		
		//basic details
		if(isset($_GET['step']) && $_GET['step']=='basic')
			echo "<div id='basic'>";
		else
			echo "<div id='basic' style='display:none'>";

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
				</table>';
		
			echo "<form action=\"validate_query.php\" method=\"post\" onSubmit='return onclick_submit(\"reason1\",1)' >
				<input type='submit' id='approve1' name='approve1' value='Approve'></input>
				<input type='button' id='b_reject1' value='Reject' onclick=\"javascript:document.getElementById('div1').style.display='block';document.getElementById('b_reject1').style.display='none';document.getElementById('approve1').style.display='none';\" ></input><br>
				<div id='div1' style='display:none' >
					<input type='text' id='reason1' name='reason1' placeholder='Reason for rejection'/>
					<input type='submit' name='reject1' value='Reject' ></input>
				</div></form></center></div>";
				
		}
		
		//previous employment details		
		if(isset($_GET['step']) && $_GET['step']=='prevemp')
			echo "<div id='prevemp'>";
		else
			echo "<div id='prevemp' style='display:none'>";

		$prev_detail=mysql_query("select * from emp_prev_exp_details where id='".$emp."'");
		if(mysql_num_rows($prev_detail)!=0)
		{
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
			echo "</table>";
		
			echo "<form action=\"validate_query.php\" method=\"post\" onSubmit='return onclick_submit(\"reason2\",2)' >
					<input type='submit' name='approve2' id='approve2' value='Approve'></input>
					<input type='button' id='b_reject2' value='Reject' onclick=\"javascript:document.getElementById('div2').style.display='block';document.getElementById('b_reject2').style.display='none';document.getElementById('approve2').style.display='none';\" ></input><br>
					<div id='div2' style='display:none' >
						<input type='text' id='reason2' name='reason2' placeholder='Reason for rejection'/>
						<input type='submit' name='reject2' value='Reject' ></input>
					</div></form></center>";
		}
		echo "</div>";
		
		//dependent family details
		if(isset($_GET['step']) && $_GET['step']=='family')
			echo "<div id='family'>";
		else
			echo "<div id='family' style='display:none'>";

		$fam_detail=mysql_query("select * from emp_family_details where id='".$emp."'");
		if(mysql_num_rows($fam_detail)!=0)
		{
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
			echo "</table>";
		
			echo "<form action=\"validate_query.php\" method=\"post\" onsubmit='return onclick_submit(\"reason3\",3)' >
					<input type='submit' id='approve3' name='approve3' value='Approve'></input>
					<input type='button' id='b_reject3' value='Reject' onclick=\"javascript:document.getElementById('div3').style.display='block';document.getElementById('b_reject3').style.display='none';document.getElementById('approve3').style.display='none';\" ></input><br>
					<div id='div3' style='display:none' >
						<input type='text' id='reason3' name='reason3' placeholder='Reason for rejection'/>
						<input type='submit' name='reject3' value='Reject' ></input>
					</div></form></center>";
		}
		echo "</div>";
		
		//educational details
		if(isset($_GET['step']) && $_GET['step']=='educational')
			echo "<div id='educational'>";
		else
			echo "<div id='educational' style='display:none'>";

		$edu_detail=mysql_query("select * from emp_education_details where id='".$emp."'");
		if(mysql_num_rows($edu_detail)!=0)
		{
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
			echo "</table>";
		
			echo "<form action=\"validate_query.php\" method=\"post\" onSubmit=\"return onclick_submit('reason4',4)\" >
					<input type='submit' id='approve4' name='approve4' value='Approve'></input>
					<input type='button' id='b_reject4' value='Reject' onclick=\"javascript:document.getElementById('div4').style.display='block';document.getElementById('b_reject4').style.display='none';document.getElementById('approve4').style.display='none';\" ></input><br>
					<div id='div4' style='display:none' >
						<input type='text' id='reason4' name='reason4' placeholder='Reason for rejection'/>
						<input type='submit' name='reject4' value='Reject' ></input>
					</div></form></center>";
		}
		echo "</div>";
		
		//last 5 yr stay details
		if(isset($_GET['step']) && $_GET['step']=='stay')
			echo "<div id='stay'>";
		else
			echo "<div id='stay' style='display:none'>";

		$last5_detail=mysql_query("select * from emp_last5yrstay_details where id='".$emp."'");
		if(mysql_num_rows($last5_detail)!=0)
		{
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
			echo "</table>";
		
			echo "<form action=\"validate_query.php\" method=\"post\" onSubmit='return onclick_submit(\"reason5\",5)'>
					<input type='submit' id='approve5' name='approve5' value='Approve'></input>
					<input type='button' id='b_reject5' value='Reject' onclick=\"javascript:document.getElementById('div5').style.display='block';document.getElementById('b_reject5').style.display='none';document.getElementById('approve5').style.display='none';\" ></input><br>
					<div id='div5' style='display:none' >
						<input type='text' id='reason5' name='reason5' placeholder='Reason for rejection'/>
						<input type='submit' name='reject5' value='Reject' ></input>
					</div></form></center>";
		}
		echo "</div>";
	}
	else
	{
		echo "You are not allowed here.";die();
	}
	
	drawFooter();
	mysql_close();
?>