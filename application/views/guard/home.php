<script>
$(document).ready(function(){
	$('select[name="mode"]').change(function(){
		var value  = this.value;
		if(value==''){
			return;
		}
		$("#postname, #date, #rangeofdates, #rangeofdates_postname, #rangeofdates_guard").hide();
		$("#" + value).show();
	});
	$('select[name="mode"]').val("<?php if(isset($mode)) echo $mode; ?>").trigger('change');
	$('select[name="postname"]').val("<?php if(isset($postname)) echo $postname;?>");
	$('select[name="postnamer"]').val("<?php if(isset($postnamer)) echo $postnamer;?>");
	$('select[name="guardname"]').val("<?php if(isset($guardname)) echo $guardname;?>");
	$('#selectdate').val("<?php if(isset($selectdate)) echo $selectdate; else echo date("Y-m-d");?>");
	$('#fromdate').val("<?php if(isset($fromdate)) echo $fromdate; else echo date("Y-m-d");?>");
	$('#fromdateg').val("<?php if(isset($fromdateg)) echo $fromdateg; else echo date("Y-m-d");?>");
	$('#fromdatep').val("<?php if(isset($fromdatep)) echo $fromdatep; else echo date("Y-m-d");?>");
	$('#todate').val("<?php if(isset($todate)) echo $todate; else echo date("Y-m-d");?>");
	$('#todateg').val("<?php if(isset($todateg)) echo $todateg; else echo date("Y-m-d");?>");
	$('#todatep').val("<?php if(isset($todatep)) echo $todatep; else echo date("Y-m-d");?>");
});
</script>

<center><h2>Welcome to Guard Tracking System</center></h2>
<table width="100%">
<tr><th></th><th></th></tr>

<tr>
<td width="20%">
Search Assigned Duties
</td>
<td>
	<select name="mode">
		<option value="" selected="selected" disabled="disabled">Select Mode</option>
		<option value ="postname">By Post Name</option>
		<option value ="date">By A Date</option>
		<option value ="rangeofdates">By A Range of Dates</option>
		<option value ="rangeofdates_postname">By A Range of Dates for a postname</option>
		<option value ="rangeofdates_guard">By A Range of Dates for a guard</option>
	</select>
</td>
</tr>
</table>

<div id="postname" style="display: none;">
<?php  echo form_open_multipart('guard/home');   ?>
<table>
	 <tr>
	 <td>Select the postname to get details of guards</td>
 	 <td>
		<select name="postname">
            <?php
				foreach ($postnames as $row)
				{
					echo '<option value="'.$row->post_id.'">'.$row->postname.'</option>';
				}
			?>	
		</select>
	</td>
	</tr>
</table>
	 <?php
	echo form_submit('postsubmit','Submit');
	echo form_close(); 
	?>
</div>

<div id="date" style="display: none;">
 <?php  echo form_open_multipart('guard/home');   ?>
 <table>
	 <tr>
	<td> Select a date to get guards list</td>	
	<td>
	<input type="date" id="selectdate" name="selectdate" /></td>
	</tr>
</table>
	 <?php
	echo form_submit('datesubmit','Submit');
	echo form_close(); 
	?>
</div>
<div id="rangeofdates" style="display: none;">
 <?php  echo form_open_multipart('guard/home');   ?>
 <table>
 <tr>
 <td>Select Range to get Guard's Duty</td>
 <td>From Date: <input type="date" id="fromdate" name="fromdate" required="required"/></td>
 <td>To Date:<input type="date" id="todate" name="todate" required="required" /></td>
 </tr>
 </table>
  <?php
	$js = 'onClick="javasript: if(document.getElementById(\'fromdate\').value > document.getElementById(\'todate\').value) {
									document.getElementById(\'fromdate\').value=\'\';
									document.getElementById(\'todate\').value=\'\';
									return false;
								}
								return true;
					"
		  ';
	echo form_submit('rangesubmit','Submit',$js);
	echo form_close(); 
	?>
</div>

<div id="rangeofdates_guard" style="display: none;">
 <?php  echo form_open_multipart('guard/home');   ?>
 <table>
 <tr>
 <td>Select Range to get Guard's Duty</td>
 <td>From Date: <input type="date" id="fromdateg" name="fromdateg" required="required"/></td>
 <td>To Date:<input type="date" id="todateg" name="todateg" required="required" /></td>
 <td>Guard Name 
	<select name="guardname">
            <?php
				foreach ($guardnames as $row)
				{
					echo '<option value="'.$row->Regno.'">'.$row->firstname.' '.$row->lastname.'</option>';
				}
			?>	
		</select>
 
 </td>
 </tr>
 </table>
  <?php
	$js = 'onClick="javasript: if(document.getElementById(\'fromdateg\').value > document.getElementById(\'todateg\').value) {
									document.getElementById(\'fromdateg\').value=\'\';
									document.getElementById(\'todateg\').value=\'\';
									return false;
								}
								return true;
					"
		  ';
	echo form_submit('rangeguardsubmit','Submit',$js);
	echo form_close(); 
	?>
</div>

<div id="rangeofdates_postname" style="display: none;">
 <?php  echo form_open_multipart('guard/home');   ?>
 <table>
 <tr>
 <td>Select Range to get Guard's Duty</td>
 <td>From Date: <input type="date" id="fromdatep" name="fromdatep" required="required"/></td>
 <td>To Date:<input type="date" id="todatep" name="todatep" required="required" /></td>
 <td>Post Name 
	<select name="postnamer">
            <?php
				foreach ($postnames as $row)
				{
					echo '<option value="'.$row->post_id.'">'.$row->postname.'</option>';
				}
			?>	
		</select>
 
 </td>
 </tr>
 </table>
  <?php
	$js = 'onClick="javasript: if(document.getElementById(\'fromdatep\').value > document.getElementById(\'todatep\').value) {
									document.getElementById(\'fromdatep\').value=\'\';
									document.getElementById(\'todatep\').value=\'\';
									return false;
								}
								return true;
					"
		  ';
	echo form_submit('rangepostsubmit','Submit',$js);
	echo form_close(); 
	?>
</div>

