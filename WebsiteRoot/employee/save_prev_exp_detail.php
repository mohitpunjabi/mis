<?php	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$sno=$_GET['s'];
	$addr=$_GET['a'];
	$designation=$_GET['d'];
	$from=$_GET['f'];
	$to=$_GET['t'];
	$payscale=$_GET['p'];
	$reason=$_GET['r'];
	
	$updateprev_detail=mysql_query("update emp_prev_exp_details 
									set 
									designation='".clean(strtolower($designation))."' ,
									`from`='".$from."' ,
									`to`='".$to."' ,
									pay_scale='".clean(strtolower($payscale))."' ,
									address='".clean(strtolower($addr))."' ,
									remarks='".clean(strtolower($reason))."' 
									where id='".$emp."' and sno=".$sno);
	if($updateprev_detail)
		notify($emp, "Details Edited", "Your previous employment details have been successfully edited by Data Entry Operator ".$_SESSION['id'], "show_emp.php?form_name=1","success");
	
	$prev_detail=mysql_query("select * 
							from emp_prev_exp_details 
							where id='".$emp."' and sno=".$sno);
							
	if(mysql_num_rows($prev_detail)!=0)
	{
			$prev_emp=mysql_fetch_assoc($prev_detail);
			echo '	<td>'.$sno.'</td>
					<td>'.ucwords($prev_emp['address']).'</td>
			    	<td>'.ucwords($prev_emp['designation']).'</td>
			    	<td>'.date('d M Y', strtotime($prev_emp['from'])).'</td>
			    	<td>'.date('d M Y', strtotime($prev_emp['to'])).'</td>
			    	<td>'.$prev_emp['pay_scale'].'</td>
			    	<td>'.ucfirst($prev_emp['remarks']).'</td>
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$sno.')">
						<input type="button" class="error" name="delete2[]" value="Delete" onClick="onclick_delete('.$sno.');" >
					</td>';
	}
	mysql_close();
?>