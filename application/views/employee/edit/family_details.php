 <table>
	<tr>
		<th>Employee Id</th>
		<td><?= $emp_id?></td>
	</tr>
</table>
<h1>Dependent Family Members</h1>
<?php
	if($emp_family_details != FALSE)
	{
		echo '<table id="tbl">
				<tr>
					 <th>S no.</th>
					 <th>Name</th>
				   	 <th>Relationship</th>
					 <th>Date of Birth</th>
				     <th>Profession</th>
				 	 <th>Present Postal Address</th>
					 <th>Active/Inactive</th>
					 <th>Photograph</th>
					 <th>Edit</th>
				</tr>';
		$i=1;
		foreach($emp_family_details as $row)
		{
			if($row->active_inactive=="Active")
				$style="background:#DFD";
			else
				$style="background:#FDD";
			echo '<tr name="row[]" align="center" >
						<td>'.$i.'</td>
						<td>'.ucwords($row->name).'</td>
					    <td>'.$row->relationship.'</td>
						<td>'.date('d M Y', strtotime($row->dob)).'<br>(Age: '.floor((time() - strtotime($row->dob))/(365*24*60*60)).' years)</td>
					    <td>'.ucwords($row->profession).'</td>
					   	<td>'.$row->present_post_addr.'</td>
					    <td style="'.$style.'">'.$row->active_inactive.'</td>
					    <td><img src="'.base_url().'assets/images/'.$row->photopath.'" width="145" height="150"/></td>
						<td>
							<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.',\''.$row->dob.'\')"><br>
						</td>
			    </tr>';
			$i++;
		}
		echo '</table>';
	}
	else
		$this->notification->drawNotification("Empty","No dependent family member details found.","error");
?>

<input type="button" id='add_new' name="add_new" value="Add" onClick="onclick_add_new();"/><br>
<div id='addnew' style="display: none">
<h1>Add here</h1>
<?= form_open_multipart('employee/edit/update_family_details/'.$emp_id,'onSubmit="return onclick_submit();"'); ?>
    <table id="tableid">
        <tr>
            <th align="center">S no.</th>
            <th>Name</th>
            <th>Relationship</th>
            <th>Date of Birth</th>
            <th>Profession</th>
            <th>Present Postal Address</th>
            <th>Active/Inactive</th>
            <th colspan="2">Photograph</th>
        </tr>
        <tr id="addrow">
            <td align="center" id="sno">1</td>
            <td align="center"><input type="text" name="name3[]"/></td>
            <td align="center">
	            <select name="relationship3[]" >
	                <option value="" disabled="disabled" selected="selected">Choose One</option>
	                <option value="Father">Father</option>
	                <option value="Mother">Mother</option>
	                <option value="Spouse">Spouse</option>
	                <option value="Son">Son</option>
	                <option value="Daughter">Daughter</option>
	            </select>
	        </td>
	        <td>
	            <input type="date" name="dob3[]" max="<?php echo date("Y-m-d",time());?>" >
	        </td>
	        <td align="center"><input type="text" name="profession3[]"/></td>
	        <td align="center"><textarea rows=4 cols=25 name="addr3[]"></textarea></td>
	        <td align="center">
	            <input type="text" name="active3[]" value="Active" style="background:#DFD" onClick="change_act(this)" readonly  />
	        </td>
	        <td align="center">
	            <input type="file" name="photo3[]" ><br>
	            <input type="button" value="preview" name="preview3[]" onClick="preview_pic(this);"><br>
	        </td>
	        <td><img src="<?= base_url() ?>assets/images/employee/noProfileImage.png" name="view_photo3[]" width="145" height="150"/></td>
        </tr>
    </table>
    <input type="button" name="add" value="Add More" onClick="onclick_add();"/>
    <br>
    <input type="submit" name="submit3" value="Save" />
    <?php echo form_close(); ?>
</div>
<a href= <?= site_url('employee/edit')?> ><button>Back</button></a>