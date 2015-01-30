<script>
function showGuards()
{
	var post_id= document.getElementById('post_id').value;
	var date= document.getElementById('date').value;
	var hours_from= document.getElementById('hours_from').value;
	var minutes_from= document.getElementById('minutes_from').value;
	var hours_to= document.getElementById('hours_to').value;
	var minutes_to= document.getElementById('minutes_to').value;
	var from_time = parseFloat(hours_from + minutes_from);
	var to_time = parseFloat(hours_to + minutes_to);
	var range = from_time + to_time;
	if(post_id == "")
	{
		alert("Fill post name");
		$("#post_id").focus();
	}
	else if(hours_from == "")
	{	
		alert("Fill from hours");
		$("#hours_from").focus();
	}
	else if(minutes_from == "")
	{	
		alert("Fill from minutes");
		$("#minutes_from").focus();
	}
	else if(hours_to == "")
	{	
		alert("Fill to hours");
		$("#hours_to").focus();
	}
	else if(minutes_to == "")
	{	
		alert("Fill to minutes");
		$("#hours_to").focus();
	}
	else if(!(from_time >=21.0 && to_time <= 8.0) && from_time > to_time)
	{
		alert("Time Range Invalid");
		document.getElementById('hours_from').value="";
		document.getElementById('hours_to').value="";
		document.getElementById('minutes_from').value="";
		document.getElementById('minutes_to').value="";
		$("#hour_from").focus();
	}
	else if(to_time - from_time >= 8.0 )
	{
		alert("Sorry, you are not allowed to assign duty for more than 8 hours.");
		document.getElementById('hours_from').value="";
		document.getElementById('hours_to').value="";
		document.getElementById('minutes_from').value="";
		document.getElementById('minutes_to').value="";
		$("#hour_from").focus();
	}
	else 
	{
		//alert(post_id + " " + date + " " + range);
		var xmlhttp;
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		  
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("guard-div").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("POST",site_url("guard/get_guards/index/" + post_id + "/" + date + "/" + from_time + "/" + to_time + "/" + range),true);
		xmlhttp.send();
		$("#get_guards").hide();
		return false;
	}
}	

</script>

<center><h2>Assign Overtime Duty to a guard</h2>
<?php 
echo form_open_multipart('guard/over_time/assign_to_a_guard');
?>
<table>
	<tr>
		<td>Post Name</td>
		<td>
			<select name="post_id" id="post_id" required="required">
			<option value=""  disabled="disabled" selected="selected" disabled="disabled">Select Post Name</option>
			<?php
				foreach($posts as $row)
				{
					echo '<option value="'.$row['post_id'].'">'.$row['postname'].'</option>';
				}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Date</td>
		<td>
			<input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d',strtotime(date('Y-m-d')) + 86400); ?>">
		</td>
	</tr>
	<tr>
		<td>From</td>
		<td>
			<select name="hours_from"  id="hours_from" required="required" onchange='$("#get_guards").show();'>
				<option value="" disabled="disabled" selected="selected" >--</option>
				<option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
				<option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option>
				<option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option>
				<option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option>
				<option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option>
			</select>
			:
			<select name="minutes_from"  id="minutes_from" required="required" onchange='$("#get_guards").show();'>
				<option value="" disabled="disabled"  selected="selected">--</option>
				<option value=".0">00</option>
				<option value=".5">30</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>To</td>
		<td>
			<select name="hours_to" id="hours_to" required="required" onchange='$("#get_guards").show();'>
				<option value="" disabled="disabled" selected="selected" >--</option>
				<option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
				<option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option>
				<option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option>
				<option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option>
				<option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option>
			</select>
			:
			<select name="minutes_to" id="minutes_to" required="required" onchange='$("#get_guards").show();'>
				<option value="" disabled="disabled" selected="selected">--</option>
				<option value=".0">00</option>
				<option value=".5">30</option>
			</select>
		</td>
	</tr>
</table>
<input type="button" value="Get Available Guards" name="get_guards" id="get_guards" onClick="showGuards()"/>
<div id="guard-div">
</div>
</center>