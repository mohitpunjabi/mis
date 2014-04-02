<?php
	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$s=$_GET['s'];
	$qry=mysql_query("DELETE FROM emp_prev_exp_details WHERE id='".$emp."' AND sno=".$s);
	notify($emp, "Details Edited", "Your previous employment details have been successfully edited by Data Entry Operator ".$_SESSION['id'], "show_emp.php?form_name=1","success");
	$i=1;
	$prev_detail=mysql_query("select * 
							from emp_prev_exp_details
							where id='".$emp."'");

	if(mysql_num_rows($prev_detail)!=0)
	{
		echo '<tr>
    				<th rowspan="2">S no.</th>
			        <th rowspan="2">Full address of the office, firm or institution</th>
					<th rowspan="2">Position held</th>
			        <th colspan="2">Organization</th>
			        <th rowspan="2">Pay Scale</th>
			        <th rowspan="2">Remarks</th>
			        <th rowspan="2">Edit/Delete</th>
    		</tr>
    		<tr>
    			<th>From</th>
    			<th>To</th>
    		</tr>';

		while($prev_emp=mysql_fetch_assoc($prev_detail))
		{
				if($prev_emp['remarks']=="")	$remarks='NA';
				else	$remarks=$prev_emp['remarks'];
				echo '<tr name="row[]" align="center">
						<td>'.$i.'</td>
				    	<td>'.$prev_emp['address'].'</td>
				    	<td>'.$prev_emp['designation'].'</td>
				    	<td>'.date('d M Y',strtotime($prev_emp['from'])).'</td>
				    	<td>'.date('d M Y',strtotime($prev_emp['to'])).'</td>
				    	<td>'.$prev_emp['pay_scale'].'</td>
				    	<td>'.$remarks.'</td>
						<td>
							<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.')">
							<input type="button" class="error" name="delete2[]" value="Delete" onClick="onclick_delete('.$i.');" >
						</td>
				    </tr>';
				mysql_query("update emp_prev_exp_details set sno=".$i." 
								where 
								id='".$emp."' and 
								designation='".$prev_emp['designation']."' and 
								`from`='".$prev_emp['from']."' and 
								`to`='".$prev_emp['to']."' and 
								pay_scale='".$prev_emp['pay_scale']."' and 
								address='".$prev_emp['address']."' and 
								remarks='".$prev_emp['remarks']."'");
				$i++;
		}
	}
	mysql_close();
?>