    <p><?php if($error!="")  $this->notification->drawNotification('',$error,'error'); ?></p>
    <table>
    	<tr>
            <th>Employee Id</th>
            <td><?= $add_emp_id ?></td>
        </tr>
    </table>

	<h1>Step 5 :Please fill up last 5 year stay details</h1>
	<?php echo form_open('employee/add/insert_last_5yr_stay_details/'.$add_emp_id,'onSubmit="return onclick_submit();"');  ?>
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
			    <td><input 	type="date" name="from5[]"
			    			max = <?php echo date("Y-m-d", time()); ?>
	                        min = <?php $date=date("Y-m-d", time());
	                                    $newdate = strtotime ( '-5 year' , strtotime ( $date ) ) ;
	                                    echo date("Y-m-d", $newdate); ?> >
	            </td>
			    <td><input  type="date"
			    			name="to5[]"
			    			max = <?php echo date("Y-m-d", time()); ?>
	                        min = <?php $date=date("Y-m-d", time());
	                                    $newdate = strtotime ( '-5 year' , strtotime ( $date ) ) ;
	                                    echo date("Y-m-d", $newdate); ?> >
	            </td>
				<td><textarea rows=4 cols=30 name="addr5[]" ></textarea></td>
	        	<td align="center"><input type="text" size=30 name="dist5[]"></textarea></td>
			</tr>
		</table>
		<input type="button" name="add" value="Add More" onClick="onclick_add();"/>
		<br>
		<input type="submit" name="submit5"/>
	<?php echo form_close(); ?>