<?php
	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$s=$_GET['s'];
	$qry=mysql_query("DELETE FROM emp_last5yrstay_details WHERE id='".$emp."' AND sno=".$s);
	$i=1;
	$stay_detail=mysql_query("select * 
							from emp_last5yrstay_details
							where id='".$emp."'");

	if(mysql_num_rows($stay_detail)!=0)
	{
		echo '<tr>
				<th rowspan=2>S no.</th>
				<th colspan=2>Duration</th>
				<th rowspan=2>Residential Address</th>
				<th rowspan=2>Name of District Headquarters of address mentioned previously</th>
				<th rowspan=2>Edit/Delete</th>
			  </tr>
			  <tr>
			    <th>From</th>
			    <th>To</th>
			  </tr>';
				
		while($row=mysql_fetch_row($stay_detail))
		{
			echo '<tr name=row[] align="center">
					<td>'.$i.'</td>
			    	<td>'.date('d M Y', strtotime($row[2])).'</td>
			    	<td>'.date('d M Y', strtotime($row[3])).'</td>
			    	<td>'.$row[4].'</td>
			    	<td>'.ucwords($row[5]).'</td>
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.')">
						<input type="button" class="error" name="delete5[]" value="Delete" onClick="onclick_delete('.$i.');" >
					</td>
			    </tr>';
			
			mysql_query("update emp_last5yrstay_details set sno=".$i." where id='".$emp."' and `from`='".$row[2]."' and `to`='".$row[3]."' and res_addr='".$row[4]."' and dist_hq_name='".$row[5]."'");
			$i++;
		}
	}
	mysql_close();
?>