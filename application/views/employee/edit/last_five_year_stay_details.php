 <table>
	<tr>
		<th>Employee Id</th>
		<td><?= $emp_id?></td>
	</tr>
</table>
<h1>Last 5 year stay details</h1>
<?php

	$date = date("Y-m-d", time());
	$newdate = strtotime('-5 year',strtotime ($date )) ;
	$newdate = date("Y-m-d", $newdate);

	if($emp_last5yrstay_details)
	{
		echo '<table id="tbl5">
				<tr>
					<th rowspan=2>S no.</th>
					<th colspan=2>Duration</th>
				   	<th rowspan=2>Residential Address</th>
				    <th rowspan=2>Name of District Headquarters</th>
					<th rowspan=2>Edit/Delete</th>
			    </tr>
			    <tr>
		     		<th>From</th>
		      		<th>To</th>
				</tr>';
		$i=1;
		foreach($emp_last5yrstay_details as $row)
		{
			echo '<tr name=row[] align="center">
					<td>'.$i.'</td>
			    	<td>'.date('d M Y', strtotime($row->from)).'</td>
			    	<td>'.date('d M Y', strtotime($row->to)).'</td>
			    	<td>'.$row->res_addr.'</td>
			    	<td>'.ucwords($row->dist_hq_name).'</td>
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.',\''.$row->from.'\',\''.$row->to.'\',\''.$date.'\',\''.$newdate.'\')">
						<input type="button" class="error" name="delete5[]" value="Delete" onClick="onclick_delete('.$i.');" >
					</td>
			    </tr>';
			$i++;
		}
		echo '</table>';
	}
	else
		$this->notification->drawNotification("Empty","No last five year stay details found.","error");
?>

<input type="button" id='add_new' name="add_new" value="Add" onClick="onclick_add_new();"/><br>
<div id='addnew' style="display: none">
<h1>Add here</h1>
<?php  echo form_open('employee/edit/update_last_5yr_stay_details/'.$emp_id,'onSubmit="return onclick_submit();"');   ?>
	<table id="tableid">
    <tr>
     	<th rowspan=2>S no.</th>
	    <th colspan=2>Duration</th>
	   	<th rowspan=2>Residential Address</th>
	    <th rowspan=2>Name of District Headquarters</th>
    </tr>
    <tr>
     	<th>From</th>
      	<th>To</th>
    </tr>
    <tr id="addrow">
    	<td id="sno">1</td>
	    <td><input type="date" name="from5[]" max=<?= $date ?>
        			min = <?= $newdate ?> ></td>
        <td><input type="date" name="to5[]" max=<?= $date ?>
        			min = <?= $newdate ?> ></td>
        <td><textarea rows=4 cols=30 name="addr5[]" ></textarea></td>
		<td align="center"><input type="text" size=30 name="dist5[]"></td>
    </tr>
</table>
<input type="button" name="add" value="Add More" onClick="onclick_add();" >
<br>
<input type="submit" name="submit5" value="Save" >
<?php echo form_close(); ?>
</div>
<a href= <?= site_url('employee/edit')?> ><button>Back</button></a>