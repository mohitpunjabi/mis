<?php
	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	drawHeader("Change employee picture");
	 
	if(isset($_GET['error']))
	{
		drawNotification($_GET['error'],"", "error");
	}
	
	if(isset($_GET['emp_id']))
		$emp_id = $_GET['emp_id'];
	else
	{
		drawNotification("Employee Id not selected", "<a href='edit_employee.php'>Click here</a> to select Employee Id.", "error");
		die();
	}
	
	//extracting photograph from database
	$emp_detail=mysql_query("select photopath 
							from user_details
							where id='".$emp_id."'");
	$row=mysql_fetch_row($emp_detail);
	$EMP_PIC=$row[0];
?>
<script type="text/javascript">
	function preview_pic()
	{
		var file=document.getElementById('photo').files[0];
		if(!file)
			alert("!! Select a file first !!");
      	else
		{
			oFReader = new FileReader();
        	oFReader.onload = function(oFREvent)
			{
				var dataURI = oFREvent.target.result;
				document.getElementById('view_photo').src = dataURI;
			};
			oFReader.readAsDataURL(file);
		}
	}
</script>

<body>
<h1>Change Employee picture</h1>
<form method = "post" action="updateSQL0.php" enctype="multipart/form-data">
<table>
    <tr>
    	<th>
        	Employee Id
        </th>
        <td colspan="2">
        	<input type="text" name="emp_id" id="emp_id" readonly value=<?php echo $emp_id;?>  >
        </td>
     </tr>
        <tr><th>Photograph</th>
        	<td id="preview"><?php echo '<br><img src="Images/'.$emp_id.'/'.$EMP_PIC.'" id="view_photo" width="145" height="150"/>'; ?></td>
        	<td align="center">Click on choose file to select other picture<br>
            	<input type="file" name="photo" id="photo" />
                <br><input type="button" value="preview" onClick="preview_pic();">
            </td>
		</tr>
</table>
<input type = "submit" name="submit" value="Save"/>
</form>

<?php
	echo '<a href="edit_employee.php"><button>Back</button></a>';
	drawFooter();
?>
</body>