<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add Previous Employment Details</title>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.js"></script>
    <?php echo $javascript; ?>
</head>
<body>
    <p><?php echo $error; ?></p>
    <table>
    	<tr>
            <th>Employee Id</th>
            <td><?= $add_emp_id ?></td>
        </tr>
    </table>

	<h1>Step 2 :Please fill up previous employment details</h1>
	<?php  echo form_open_multipart('employee/add/insert_prev_emp_details/'.$add_emp_id,'onSubmit="return onclick_submit();"');   ?>

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
	<input type="submit" name="submit2" value="Next" />
    <?php echo form_close(); ?>
</body>
</html>