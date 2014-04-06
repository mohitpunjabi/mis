<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");	
	auth();
	drawHeader("Return Non-Consumable items");

	echo '<h1 align="center" class="page-head">Return for Non-Consumable Items</h1>';
?>
<script language="javascript" type="text/javascript">
function getID(item)
	{
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  	}
		xmlhttp.onreadystatechange=function()
	  	{
		 	if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    	document.getElementById("FETCH_ITEM_INFO").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","ajax_return.php?ITEM="+item,true);
		xmlhttp.send();
	}
</script>

<?php

	$sql="SELECT  DISTINCT item_name
			FROM 
				(select item_id from stockandinventory_nc_issue where username='".$_SESSION["id"]."') as a
				NATURAL JOIN
				(select item_id,item_name from stockandinventory_stock_item) as b";


if(isset($sql))
{
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0)
	{
		
		if(is_auth('hod'))
			header("Location: Startpage_hod.php?ITEMS=0");
		else if(is_auth('ft'))
			header("Location: Startpage_faculty.php?ITEMS=0");
		else if(is_auth('deo','stock'))
			header("Location: Startpage_dataOP.php?ITEMS=0");
		
		exit(0);
	}
?>

	<br>
	<form method="post" action="return_query.php">
		<table align="center">
		<tr> <td>Item Name</td> 
			<td>
		       		<?php
		echo "<select name='txtItemName' id='txtItemName' onChange='getID(this.value)'>";
		echo "<option value='null' selected='selected' disabled='disabled'> Select An Item </option>";
		while ($row= mysql_fetch_assoc($result)) 
		{  
			echo "<option value='".$row['item_name']."'>" . $row['item_name'] . "</option>";
		}
			?>
			</select>
		</td>
		</tr>
	<tbody id="FETCH_ITEM_INFO">
		<tr> <td>Item Id</td> <td><input name="txtItemId" id="txtItemId" readonly></td> </tr>	
	
	<tr> <td>Quantity</td> <td><input name="txtQuantity" type="number" min="1" ></td> </tr>
		</tbody>
<tr> <td>Employee ID</td> <td><input name="txtEmpId" value="<?php echo $_SESSION["SESS_USERNAME"]; ?>" readonly></td> </tr>

<tr> <td>Item Type</td> <td><input name="txtItemType" id="txtType" value="Non-Consumable" readonly></td> </tr>

<tr> <td>Date</td> <td><input value="<?php echo date("d-m-y", time()+(19800)); ?>" name="txtDate" readonly></td> </tr>

<tr align="center">
<th colspan=2 align="center"><input type="submit" value="submit"></th>
</tr>
</table>
</form>

<br><br>
  <p align="center"><a href='index.php'>Back to Home</a> </p>

<?php
}
	drawFooter();
	mysql_close();
?>