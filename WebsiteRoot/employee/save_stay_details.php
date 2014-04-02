<?php	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$sno=$_GET['s'];
	$from=$_GET['f'];
	$to=$_GET['t'];
	$addr=$_GET['a'];
	$dist=$_GET['d'];
	
	$updatestay_detail=mysql_query("update emp_last5yrstay_details 
									set 
									`from`='".$from."' ,
									`to`='".$to."' ,
									res_addr='".clean($addr)."' ,
									dist_hq_name='".clean(strtolower($dist))."' 
									where id='".$emp."' and sno=".$sno);
	if($updatestay_detail)
		notify($emp, "Details Edited", "Your last 5 year stay details have been successfully edited by Data Entry Operator ".$_SESSION['id'], "show_emp.php?form_name=4","success");
	
	$stay_detail=mysql_query("select * 
							from emp_last5yrstay_details 
							where id='".$emp."' and sno=".$sno);
							
	if(mysql_num_rows($stay_detail)!=0)
	{
		$row=mysql_fetch_row($stay_detail);
			echo '	<td>'.$sno.'</td>
			    	<td>'.date('d M Y', strtotime($row[2])).'</td>
			    	<td>'.date('d M Y', strtotime($row[3])).'</td>
			    	<td>'.$row[4].'</td>
			    	<td>'.ucwords($row[5]).'</td>
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$sno.')">
						<input type="button" class="error" name="delete5[]" value="Delete" onClick="onclick_delete('.$sno.');" >
					</td>';
	}
	mysql_close();
?>