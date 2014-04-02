<?php	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$sno=$_GET['s'];
	$prof=$_GET['p'];
	$addr=$_GET['a'];
	$dob=$_GET['d'];
	$active=$_GET['act'];
	if($active=="Active")
		$style="background:#DFD";
	else
		$style="background:#FDD";
	$updatefam_detail=mysql_query("update emp_family_details 
									set profession='".clean(strtolower($prof))."' , present_post_addr='".clean(strtolower($addr))."' , dob='".$dob."' , active_inactive='".$active."'
									where id='".$emp."' and sno=".$sno);
	if($updatefam_detail)
		notify($emp_id, "Details Edited", "Your dependent family member details have been successfully edited by Data Entry Operator ".$_SESSION['id'], "show_emp.php?form_name=2","success");
	
	$fam_detail=mysql_query("select * 
							from emp_family_details 
							where id='".$emp."' and sno=".$sno);
							
	if(mysql_num_rows($fam_detail)!=0)
	{
		$row=mysql_fetch_row($fam_detail);
			echo '	<td>'.$sno.'</td>
			    	<td>'.ucwords($row[2]).'</td>
				    <td>'.$row[3].'</td>
					<td>'.date('d M Y', strtotime($row[7])).'<br>(Age: '.floor((time() - strtotime($row[7]))/(365*24*60*60)).' years)</td>
				    <td>'.ucwords($row[4]).'</td>
				   	<td>'.$row[5].'</td>
					<td style="'.$style.'">'.$row[8].'</td>
			    	<td><img src="Images/'.$emp.'/'.$row[6].'" name="image3[]" width="145" height="150"/></td>
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$sno.')"><br>
					</td>';
	}
	mysql_close();
?>