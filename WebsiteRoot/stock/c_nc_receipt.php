<?php
	include_once('../Includes/Layout.php');
	require_once('../Includes/Auth.php');
	require_once('connectDB.php');
	auth('deo');
	drawHeader("Consumable/Non-consumable receipt");
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
		xmlhttp.open("GET","ajax_fetch_rqd_info.php?ITEM="+item+"&TYPE="+type,true);
		xmlhttp.send();
	}
</script>
<?php
if(isset($_GET['Go1']))
	echo '<h1 align="center" class="page-head">Receipt for Consumable Items</h1>';

else 
	echo '<h1 align="center" class="page-head">Receipt for Non-Consumable Items</h1>';
	
	if(isset($_GET["Go1"]))
	{
		$_SESSION['Go1value']= $_GET["Go1"];
		$sql="SELECT * FROM stockandinventory_stock_item where c_nc='Consumable' ";
	}
	else
	{
		$_SESSION['Go2value']= $_GET["Go2"];
		$sql="SELECT * FROM stockandinventory_stock_item where c_nc='Non-Consumable' ";
	}

if(isset($sql))
{
	$result = mysql_query($sql);

?>
	<form method="post" action="c_nc_receipt_query.php">
	<table align="center">
<tbody id="FETCH_ITEM_INFO">
	<tr> <td>Item Name</td> 
		<td>
	       		<?php
		echo "<select name='txtItemName' id='txtItemName' onChange='getID(this.value)'>";
		echo "<option value='null' selected='selected' disabled='disabled'> Select An Item </option>";
		while ($row= mysql_fetch_assoc($result)) 
		{  
			echo "<option value='".$row['item_name']."'>" . $row['item_name'] . "</option>";
		}
		 	echo "<option value='new'>Add new item</option>";
			?>
			</select>
	</td>
	</tr>
	<tr> <td>Item Id</td> <td><input name="txtItemId" id="txtItemId" ></td> </tr>	

	<tr> <td>Item Specification</td> <td><input name="txtItemSpec" id="txtItemSpec" ></td> </tr>
</tbody>
	<tr> <td>Date of receipt</td> <td><input type="date" name="txtDate"></td> </tr>
	
	<tr> <td>Quantity</td> <td><input name="txtQuantity" type="number" min="1" ></td> </tr>
	
	<tr> <td>Unit Price</td> <td><input name="txtUprice" type="number" min="0"></td> </tr>
	
	<tr> <td>Description</td> <td><input name="txtDescription"></td> </tr>

<?php
	if(isset($_GET['Go1']))
	{
		//$c_nc='Consumable';
?>

	<tr> <td>Type</td> <td><input name="txtType" id="txtType" value="Consumable" readonly></td> </tr>
	
	<tr> <td>Po. no.</td> <td><input name="txtPoNumber"></td> </tr>
	
	<tr> <td>Seller's name</td> <td><input name="txtSellerName"></td> </tr>
	
	<tr> <td>Seller's Address</td> <td><input name="txtSellerAddr"></td> </tr>
	
	<tr> <td>Invoice No.</td> <td><input name="txtInvoiceNo"></td> </tr>
	
	<tr> <td>Remark</td> <td><input name="txtRemark"></td> </tr>
	
	<tr> <td>Name of Intender</td> <td><input name="txtIntender"></td> </tr>
	
	<tr align="center"> <th colspan=2 align="center"><input type="submit" value="submit" name="submit"></th> </tr>

<?php
	}
	else if($_GET['Go2'])
	{
	//$c_nc='Non-Consumable';
?>
	
	<tr> <td>Type</td> <td><input id="txtType" name="txtType" value="Non-Consumable" readonly></td> </tr> 
	
	<tr> <td>Company Name</td> <td><input name="txtCname"></td> </tr>
	
	<tr> <td>Challan No.</td> <td><input name="txtChallan"></td> </tr>
	
	<tr> <td>Remark</td> <td><input name="txtRemark"></td> </tr>
	
	<tr align="center"> <th colspan=2 align="center"><input type="submit" value="submit" name="submit2"></th> </tr>
<?php
	}
	echo '</table>
	</form>';
}
?>
<br><br>
  <p align="center"><a href='index.php'>Back to Home</a> </p>
<?php
	drawFooter();
?>