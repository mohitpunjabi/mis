 <table>
	<tr>
		<th>Employee Id</th>
		<td><?= $emp_id?></td>
	</tr>
</table>
<h1>Previous employment details</h1>
<?php
	if($emp_prev_exp_details != FALSE)
	{
		echo '<table id="tbl2">
    			<tr>
    				<th rowspan="2">S no.</th>
			        <th rowspan="2">Full address of Employer</th>
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
		$i=1;
		foreach($emp_prev_exp_details as $row)
		{
			if($row->remarks == "")	$remarks='NA';
			else	$remarks = $row->remarks;
			echo '<tr name="row[]" align="center">
					<td>'.$i.'</td>
					<td>'.ucwords($row->address).'</td>
			    	<td>'.ucwords($row->designation).'</td>
			    	<td>'.date('d M Y', strtotime($row->from)).'</td>
			    	<td>'.date('d M Y', strtotime($row->to)).'</td>
			    	<td>'.$row->pay_scale.'</td>
		    		<td>'.ucfirst($remarks).'</td>
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.',\''.$row->from.'\',\''.$row->to.'\',\''.$joining_date.'\')" />
						<input type="button" class="error" name="delete2[]" value="Delete" onClick="onclick_delete('.$i.');" />
					</td>
			    </tr>';
			$i++;
		}
		echo '</table>';
	}
	else
		$this->notification->drawNotification("Empty","No previous employment details found.","error");
?>

<input type="button" id='add_new' name="add_new" value="Add" onClick="onclick_add_new();"/><br>
<div id='addnew' style="display: none">
<h1>Add here</h1>
<?php  echo form_open('employee/edit/update_prev_emp_details/'.$emp_id,'onSubmit="return onclick_submit();"');   ?>
	<table id="tableid">
    	<tr>
        	<th rowspan="2">S no.</th>
        	<th rowspan="2">Full address of Employer</th>
            <th rowspan="2">Position held</th>
        	<th colspan="2">Organization</th>
        	<th rowspan="2">Pay Scale</th>
        	<th rowspan="2">Remarks</th>
    	</tr>
    	<tr>
        	<th>From</th>
        	<th>To</th>
    	</tr>
    	<tr id="addrow">
    	    <td id="sno">1</td>
        	<td><textarea rows=5 cols=20 name="addr2[]" ></textarea></td>
        	<td><input type="text" name="designation2[]" size="35" ></td>
        	<td><input type="date" name="from2[]" max=<?php echo $joining_date; ?> ></td>
        	<td><input type="date" name="to2[]" max=<?php echo $joining_date; ?>  ></td>
        	<td><input type="text" name="payscale2[]" ></td>
        	<td><textarea rows=5 cols=20 name="reason2[]" ></textarea></td>
    	</tr>
	</table>
	<input type="button" name="add" value="Add More" onClick="onclick_add();"/><br>
	<input type="submit" name="submit2" value="Save" />
<?php echo form_close(); ?>
</div>
<a href= <?= site_url('employee/edit')?> ><button>Back</button></a>