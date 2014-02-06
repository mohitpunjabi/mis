<?php
	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$e=$_GET['e'];
	$prev_detail=mysql_query("select * 
							from emp_prev_exp_details 
							where id='".$emp."' and sno=".$e);

	$find_date=mysql_query("select joining_date from emp_basic_details where id='".$emp."'");
		$row=mysql_fetch_row($find_date);
		$date=$row[0];
														
	if(mysql_num_rows($prev_detail)!=0)
	{
		$prev_emp=mysql_fetch_assoc($prev_detail);
	
			echo '	<td>'.$e.'</td>
					<td><textarea rows=5 cols=20 name="addr'.$e.'" id="addr'.$e.'" >'.$prev_emp['address'].'</textarea></td>
    				<td><input type="text" id="designation'.$e.'" name="designation'.$e.'" size="35" value="'.$prev_emp['designation'].'"></td>
			        <td><input type="date" name="from'.$e.'" id="from'.$e.'" value="'.$prev_emp['from'].'" max="'.$date.'" ></td>
			        <td><input type="date" name="to'.$e.'" id="to'.$e.'" value="'.$prev_emp['to'].'" max="'.$date.'" ></td>
			    	<td><input type="text" name="payscale'.$e.'" id="payscale'.$e.'" value="'.$prev_emp['pay_scale'].'" ></td>
			        <td><textarea rows=5 cols=20 name="reason'.$e.'" id="reason'.$e.'" >'.$prev_emp['remarks'].'</textarea></td>
					<td>
						<input type="button" name="save" value="Save" onClick="onclick_save('.$e.')">
						<input type="button" class="error" name="delete2[]" value="Delete" onClick="onclick_delete('.$e.');" >
					</td>
				';
	}
	mysql_close();
?>