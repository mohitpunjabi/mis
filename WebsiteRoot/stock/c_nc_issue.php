<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	drawHeader("Consumable/Non-Consumable issue");
?>

<?php
if(!isset($_GET["Go1"]) && !isset($_GET["Go2"]))
	header("Location:issue1.php");

if(isset($_GET['Go1']))
	echo '<h1 align="center" class="page-head">Issue for Consumable Items</h1>';
else
	echo '<h1 align="center" class="page-head">Issue for Non-Consumable Items</h1>';
?>

<script language="javascript" type="text/javascript">
function getID(item)
	{
		var type=document.getElementById('txtType').value;
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
		xmlhttp.open("GET","AJX_getID_query.php?ITEM="+item+"&TYPE="+type,true);
		xmlhttp.send();
	}
</script>


<?php

if(isset($_GET["Go1"]))
{
	$_SESSION['C_NC_TYPE']='Consumable';
	$sql="SELECT * FROM stockandinventory_stock_item where c_nc='Consumable' ";
}
else
{
	$_SESSION['C_NC_TYPE']= 'Non-Consumable';
	$sql="SELECT * FROM stockandinventory_stock_item where c_nc='Non-Consumable' ";
}

$result = mysql_query($sql);
?>

	<br>
	<form method="post" action="c_nc_issue_query.php">
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
<tr> <td>Employee ID</td> <td><input name="txtEmpId" value="<?php echo $_SESSION["SESS_USERNAME"]?>" readonly></td> </tr>

<?php
if(isset($_GET['Go1']))
{
?>

<tr> <td>Item Type</td> <td><input name="txtItemType" id="txtType" value="Consumable" readonly></td> </tr>

<tr> <td>Location </td>  <td><input name="txtLoc" required></td> </tr>

<tr> <td>Date</td> <td><input value="<?php echo date("d-m-y", time()+(19800)); ?>" name="txtDate" readonly></td> </tr>

<?php
}
else if(isset($_GET['Go2']))
{
?>

<tr> <td>Item Type</td> <td><input name="txtItemType" id="txtType" value="Non-Consumable" readonly></td> </tr>

<tr> <td>Location </td> <td><input name="txtLoc"></td> </tr>

<tr> <td>Date</td> <td><input value="<?php echo date("d-m-y", time()+(19800)); ?>" name="txtDate" readonly></td> </tr>

<?php
}
?>

<tr align="center">
<th colspan=2 align="center"><input type="submit" value="submit"></th>
</tr>
</table>
</form>

<br><br>
  <p align="center"><a href='index.php'>Back to Home</a> </p>

<?php
	drawFooter();
?>