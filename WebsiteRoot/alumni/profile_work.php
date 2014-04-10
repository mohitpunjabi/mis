<?php
	require_once("../Includes/Auth.php");
	auth();
	drawHeader("Work Profile");
?>

<style>
#basinfo td{
	width:25%;
	border-left:thin dotted #000;
	border-bottom:thin dotted #000;
}

.worktr{
	height:50px;
}
#workinfo td{
	width:20%;
}
[hide]{
	visibility:hidden;
}
</style>
<script>
	function editinfo(){
		
	}
	function newcomp(){
		alert(arguments.callee.caller.toString());
	}
</script>

<table id="basinfo" style="margin:5%; margin-bottom:2%; padding:10px; border:thick dashed #ddd;" width="90%" nozebra>
	<tr>
		<td hide>a</td>
		<td hide>a</td>
		<td hide>a</td>
		<td rowspan="5">
			<img src="<?php echo WEBSITE_ROOT."/alumni/Images/".$_SESSION['id']."/".$_SESSION['photopath']; ?>" width="150px" />
		</td>
	</tr>
	<tr>
		<td hide>a</td>
		<td hide>a</td>
		<td>ISM</td>
	</tr>
	<tr>
		<td hide>a</td>
		<td>Name: Mr. Vishal Vitthal Hanjagi</td>
		<td>Alumni</td>
	</tr>
	<tr>
		<td>inISM: Batch of 2015</td>
		<td colspan="2">Qualification: B.Tech from ISM Dhanbad, MS from some crap insti.</td>
	</tr>
	<tr>
		<td>Contact: 89986825112</td>
		<td>email: vishalhanjagi@gmail.com</td>
		<td>Place: India</td>
	</tr>
</table>
<button id="edit" style="margin-left:45%;" onclick="editinfo()">EditWorkProfile</button>
<table width="90%" style="margin-left:5%;" id="workinfo">
	<tr>
		<th>Duration</th>
		<th style="background-color:#eee; color:#000;">Company</th>
		<th>Country</th>
		<th style="background-color:#eee; color:#000;">Place</th>
		<th>JobProfile</th>
	</tr>
	<tr class="worktr">
		<td>2011-2013</td>
		<td><input type="text" name="compname" value="Arista Networks"/><br/><button style="font-size:0.7em; margin-left:30%;" onclick="newcomp()">add new</button></td>
		<td>India</td>
		<td>Bangalore</td>
		<td>Software Analyst</td>
	</tr>
	<tr class="worktr">
		<td>2011-2013
			<!--<div style="width:49%; float:left;>
				<label for="jd">Joining Date</label>
				<br/>
				<input type="text" size="4" name="join" id="jd" value="2011"/>
			</div>
			<div style="width:49%; float:right;">
			<label for="ld">Leaving Date</label>
			<br/>
			<input type="text" size="4" name="leave" id="ld" value="2013"/>
			</div>-->
		</td>
		<td>Arista Networks</td>
		<td>India</td>
		<td>Bangalore</td>
		<td>Software Analyst</td>
	</tr>
</table>

<?php
	drawFooter();
?>