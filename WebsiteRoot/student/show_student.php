<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	auth('deo','stu');
	require_once("connectDB.php");
	drawHeader("View Student Details");
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
	
	function onclick_step(step)
	{
		$("#"+step).slideToggle("fast");
	}
</script>
<?php
	$c=0;
	if(is_auth('stu'))
		$stu=$_SESSION['SESS_USERNAME'];
	else if(is_auth('deo'))
		$stu=$_GET['stu_id'];
		
	$stu_details=mysql_query("select * 
								from user_details, user_other_details, stu_details
								WHERE user_details.id='".$stu."' AND
									  user_details.id = user_other_details.id AND
									  user_details.id = stu_details.admn_no");
	
	$user=mysql_fetch_assoc($stu_details);
	
	if(mysql_num_rows($stu_details)!=0)
	{
		echo '<div id="print" ><table>
				<tr>
					<th>Student Admission No.</th>
					<td>'.$user['id'].'</td>					
				</tr></table>';
		echo '<center><img src="Images/'.$stu.'/'.$user['photopath'].'" width="145" height="150" /></center>';
		echo '<center><h2><a onClick="onclick_step(\'step1\');">Student Basic Details</a></h2>';

		echo '	<div id="step1" style="display:none">
			<table width="90%">
				<tr>
					<th>Name</th><td>'.$user['salutation'].' '.$user['first_name'].' '.$user['middle_name'].' '.$user['last_name'].'</td>
					<th>Marital Status</th><td>'.$user['marital_status'].'</td>
					<th>Physically Challenged</th><td>'.$user['physically_challenged'].'</td>
				</tr>
				<tr>';
				
				$dept=mysql_query("select name,id from departments where id='".$user['dept_id']."'");
				$dept=mysql_fetch_row($dept);
				$dept_id=strtoupper($dept[1]);
				
				//$db = mysql_select_db("feedback_sfstest");
	//retrieving course id from feedback_sfstest
		//$ret_course_id=mysql_query("SELECT course_name FROM feedback_course INNER JOIN feedback_numsubjects WHERE branch_id='$dept_id'");//'$dept_id'");
		//$db = mysql_select_db("mis");
				//$course_id=mysql_fetch_row($ret_course_id);
				$course_branch_id = mysql_query("select course_id,branch_id from stu_academic where id='".$stu."'");
				$id_row=mysql_fetch_array($course_branch_id);
				$course_name = mysql_query("select name from courses where id='".$id_row[0]."'");
				$course_name_row = mysql_fetch_array($course_name);
				$course_name = $course_name_row[0];
				$branch_name = mysql_query("select name from branches where id='".$id_row[1]."'");
				$branch_name_row = mysql_fetch_array($branch_name);
				$branch_name = $branch_name_row[0];
				//$course="";//$course_id[0];
				$stu_detail=mysql_query("select * from stu_details where admn_no='".$stu."'");
				$row=mysql_fetch_row($stu_detail);
								
				if(empty($user['guardian_name']))
					{
						echo '<th>Father Name</th><td>'.$user['father_name'].'</td>
						<th>Mother Name</th><td>'.$user['mother_name'].'</td>
						<th>Identity Mark</th><td>'.$row[7].'</td>';
					}
				else
					{
						echo '<th >Guardian Name</th><td >'.$user['guardian_name'].'</td>
							<th>Relationship</th><td>To be Added</td>
							<th>Identity Mark</th><td>'.$row[7].'</td>';
					}
					
				echo '</tr>
				<tr>
					
					<th>Gender</th><td>';
					if($user['sex']=='m') echo 'Male';
					else echo 'Female';
					echo '</td>
					<th>Category</th><td>'.$user['category'].'</td>
					<th>Kashmiri Immigrant</th><td>'.$user['kashmiri_immigrant'].'</td>
				</tr>';
					
				
					echo '
				
				<tr>
					<th>DOB</th><td>'.date('d M Y', strtotime($user['dob'])).'</td>
					<th>Place of Birth</th><td>'.$user['birth_place'].'</td>
					<th>Religion</th><td>'.$user['religion'].'</td>
				</tr>
				<tr>';
				if($user['type']=='ug')
						$type='Under Graduate';
				else if($user['type']=='pg')
						$type='Post Graduate';
				else
						$type='Junior Research Faculty';
					echo '<th>Student Type</th><td>'.$type.'</td>
					<th>Course</th><td>'.$course_name.'</td>
					<th>Branch</th><td>'.$dept[0].'</td>
				</tr>
				<tr>
					<th>Email</th><td>'.$user['email'].'</td>
					<th>Alternate Email</th><td>'.$user['alternate_email_id'].'</td>
					<th>Mobile no.</th><td>'.$user['mobile_no'].'</td>
					
				</tr>
					<tr>
					<th>Nationality</th><td>'.$user['nationality'].'</td>
					<th >Favourite Past Time </th><td >'.$user['fav_past_time'].'</td>
					<th>Hobbies</th><td>'.$user['hobbies'].'</td>
				</tr>
				</table>
				<table>';
		
		$stu_present_addr_details=mysql_query("select * from user_address where id='".$stu."' and type='present'");
		$stu_permanent_addr_details=mysql_query("select * from user_address where id='".$stu."' and type='permanent'");
		$addr1=mysql_fetch_assoc($stu_present_addr_details);
		$addr2=mysql_fetch_assoc($stu_permanent_addr_details);
		echo 	'<table width="90%">
				<tr/><tr>
					<th>Present Address</th>
					<th>Permanent Address</th>
					<th>Correspondence Address</th>
					
				</tr>
				<tr>
					<td>'.$addr1['line1'].',<br>'.$addr1['line2'].',<br>'
						.$addr1['city'].', '.$addr1['state'].'- '.$addr1['pincode'].'<br>'
						.$addr1['country'].'<br>
						Contact no. '.$addr1['contact_no'].'</td>
					<td>'.$addr2['line1'].',<br>'.$addr2['line2'].',<br>'
						.$addr2['city'].', '.$addr2['state'].'- '.$addr2['pincode'].'<br>'
						.$addr2['country'].'<br>
						Contact no. '.$addr2['contact_no'].'</td>';
					$stu_correspondence_addr_details=mysql_query("select * from user_address where id='".$stu."' and type='correspondence'");
					$addr3=mysql_fetch_assoc($stu_correspondence_addr_details);
					if($addr3)
					{
						echo '<td>'.$addr3['line1'].',<br>'.$addr3['line2'].',<br>'
							.$addr3['city'].', '.$addr3['state'].'- '.$addr3['pincode'].'<br>'
							.$addr3['country'].'<br>
							Contact no. '.$addr3['contact_no'].'</td>';
					}
					else
					{
						echo '<td>'.$addr2['line1'].',<br>'.$addr2['line2'].',<br>'
						.$addr2['city'].', '.$addr2['state'].'- '.$addr2['pincode'].'<br>'
						.$addr2['country'].'<br>
						Contact no. '.$addr2['contact_no'].'</td>';
					}

				echo '</tr>
				</table>';


			echo 	'</div></center>' ;			
	}
	

	
	
		
	
	/*	echo '<br><center><h2><a onClick="onclick_step(\'step4\');">Student Admission Details</a></h2>';
		echo '<div id="step4" style="display:none">
				<table align="center" width="90%"> 
				<tr>
					<th>Age Group</th><td>To be Calulated</td>
					<th>Enrollnment Number</th><td>'.$row[2].'</td>
					<th>Enrollnment Year</th><td>'.$row[3].'</td>
				</tr>';
				if($row[4]=='ee')
					$admn='Entrance Exam';
				else if($row[4]=='wl')
					$admn='Waiting List';
				else if($row[4]=='pl')
					$admn='Provisional List';
				else
					$admn='Spot Admission';
					
				if($row[11]=='t')
					$mc ='<td style="background-color:#DFD;">Received</td>';
				else
					$mc ='<td style="background-color:#FDD;">Pending</td>';
					
				echo'
				<tr>
					<th>Date of Admission</th><td>'.date('d M Y', strtotime($row[1])).'</td>
					<th>Admission Based On</th><td>'.$admn.'</td>
					<th>Session</th><td>'.$row[6].'</td>
				</tr>
				
				<tr>
					
					<th>Parent Mobile No.</th><td>'.$row[8].'</td>
					<th>Parent Landline No.</th><td>'.$row[9].'</td>
					<th>Migration Certificate</th>'.$mc.'
				</tr>';
		
		echo "</table></div></center>";
	
	
		$stu_fee_details=mysql_query("select * from stu_fee_details where id='".$stu."' ");
		$sfee=mysql_fetch_assoc($stu_fee_details);
		
		if($sfee['fee_mode']=='ob')
			$mode_fee='Online Banking';
		elseif($sfee['fee_mode']=='dd')
			$mode_fee='Demand Draft';
		else
			$mode_fee='Cheque';
		
		echo '<br><center><h2><a onClick="onclick_step(\'step5\');">Fees Details</a></h2>';
		echo '<div id="step5" style="display:none">
				<table align="center" width="90%"> 
				<tr>
					<th>Mode of Payment</th><td>'.$mode_fee.'</td>
					<th>Receipt Number</th><td>'.$sfee['fee_reciept_no'].'</td>
					<th>Date of Payment</th><td>'.$sfee['fee_date'].'</td>
				</tr>
				<tr>
					<th>'.$mode_fee.' Date </th><td>'.$sfee['payment_made_on'].'</td>
					<th>Bank Name</th><td>'.$sfee['bank_name'].'</td>
					<th>Transaction ID </th><td>'.$sfee['transaction_id'].'</td>
				</tr>
				<tr>
					<th>Fees Paid</th><td>'.$sfee['fee_amount'].'</td>
					<th>Fees in Favour</th><td>'.$sfee['fee_in_favour'].'</td>
					<th>Remarks</th><td>About Fees</td>
				</tr>';
		
		echo "</table></div></center>";
	
	*/
	
		echo '<br><br><center><button onclick="printContent(\'print\')" >PRINT</button>';
	if($_SESSION['SESS_AUTH']=="DO")
	{	
		?>
            <a href="stu_view.php"><button>Back</button></a></center>
		<?php 
	}
	mysql_close();
	drawFooter();
?>