<?php
	require_once("../Includes/SessionAuth.php");
	require_once("../Includes/AuthDo.php");
	require_once("../Includes/ConfigSQL.php");
	require_once("../Includes/FeedbackLayout.php");
	require_once("connectDB.php");
	
	drawHeader("Update Student Admission Details");
	if(isset($_SESSION['EDIT_STU']))
		$stu_id = $_SESSION['EDIT_STU'];
	else
	{
		drawNotification("Student Admission No. not selected", "<a href='edit_student.php'>Click here</a> to select Student Admission Number.", "error");
		die();
	}
	
	
	//fetching the details for update purpose from basic details table
		
	$stu_adm_details=mysql_query("select * 
								from stu_details NATURAL JOIN stu_fee_details  
								where id='".$stu_id."'");
	
	$user=mysql_fetch_assoc($stu_adm_details);
	

	
	?>

<script type="text/javascript">
    function mode_of_payment(x)
    {
        
        if(x=='ob')
        {
            document.getElementById('online_banking').style.display='table-row';
            document.getElementById('dd_c').style.display='none';
        }
		else if(x=='sp')
		{
			document.getElementById('dd_c').style.display='none';
			document.getElementById('online_banking').style.display='none';
		}
        else
        {
            document.getElementById('dd_c').style.display='table-row';
            document.getElementById('online_banking').style.display='none';
        }
    }
</script>

<!-- Style to show the upadate process is going on      -->
<style>
input,select,date,tel,checkbox,radio{
background-color:#FCFCBA;
}
input.-feedback-search-text{
background-color:#FFF;
}
</style>


<?php	echo '<table>
				<tr>
					<th>Student Id</th>
					<td>'.$stu_id.'</td>
				</tr>
				</table>' ;
 ?>
<!-- -->

<h1>Step 2 :Please Fill Up Admission Details</h1>
<form method = "post" action="updateSQL2.php" enctype="multipart/form-data" onsubmit="" >
<table width='90%'>
	<th colspan=4></th>
    <tr>
    	<td >
        	Enrollnment No.
        </td>
        <td >
        	<input type="text" name="enroll_no" value="<?php echo $user['enrollment_no']; ?>" required="required" /> 
            
        </td>
			<td>
        	Enrollnment Year
        </td>
    	<td>
			<input type="tel" max='4' name="enroll_year" value="<?php echo $user['enrollment_year']; ?>"  required="required" >
        </td>
        
    </tr>
	<tr>
    	<td>
			Admission Based On
       	</td>
        <td>
        	<select name="adm_on" value="<?php echo $user['admn_based_on']; ?>" >
            	<option value="ee" selected="selected" >Entrance Exam</option>
                <option value="sa">Spot Admission</option>
                <option value="wl">Waiting List</option>
				<option value="pl">Provisional List</option>
             </select>
        </td>
      <td>
			Student Type
       	</td>
        <td>
        	<select name="stu_type" value="<?php echo $user['type']; ?>" >
            	<option value="ug" selected="selected" >Under Graduate</option>
                <option value="pg">Post Graduate</option>
                <option value="jrf">Junior Research Faculty</option>
             </select>
        </td>
    </tr>
	<tr>
    	<td>
        	Session
        </td>
        <td>
        	<input type="text" name = "session" value="<?php echo $user['session']; ?>"  required="required" />
        </td>
        <td>
        	Alternate Email id
        </td>
        <td>
        	<input type="email" value="<?php echo $user['alternate_email_id']; ?>" name= "alternate_email_id" />
        </td>
   </tr>
   	<tr>
    	<td>
        	Parent/Guardian Mobile No.
        </td>
        <td>
        	<input type="tel" name = "parent_mob"  value="<?php echo $user['parent_mobile_no']; ?>" required="required" /> 
        </td>
        <td>
        	Parent/Guardian Landline No.
        </td>
        <td>
        	<input type="tel" name = "parent_lan" required="required" value="<?php echo $user['parent_landline_no']; ?>" required="" /> 
        </td>
   </tr>
   <tr>
		<td>
        	Migration Certificate Received
        </td>
    	<td>
		
			<input type="radio" name="migration_certificate" <?php 
				$migration=$user['migration_cert']; 
				if($migration=='t') echo 'checked'; ?> value="t"/>Yes
            <input type="radio" name="migration_certificate" <?php 
				$migration=$user['migration_cert']; 
				if($migration=='f') echo 'checked'; ?> value="f"/>No
        </td>   
   </tr>
	
    <tr>
        <th colspan="4">
            Fee Details
        </th>
    </tr>    
    <tr>
    	<td>
        	Mode of Payment
        </td>
    	<td>
        	<select name="pay_mode" onchange="mode_of_payment(this.value)"  >
			<option value='sp' <?php $fee_mode=$user['fee_mode']; if($fee_mode=='sp') echo 'selected'; ?> >Select Payment</option>
            <option value='dd' <?php $fee_mode=$user['fee_mode']; if($fee_mode=='dd') echo 'selected'; ?> >Demand Draft</option>
            <option value='ob' <?php $fee_mode=$user['fee_mode']; if($fee_mode=='ob') echo 'selected'; ?> >Online Banking</option>
            <option value='c' <?php $fee_mode=$user['fee_mode']; if($fee_mode=='c') echo 'selected'; ?>>Cheque</option>
			
            </select>
        </td>
    	
    	<td>
        	Receipt Number
        </td>
    	<td>
  	      	<input type="text" name="receipt_no" required="required" value="<?php echo $user['fee_reciept_no']; ?>" />
        </td>
    </tr>
	<tr>
    	<td>
        	Fees Amount Paid
        </td>
    	<td>
  	      	<input type="text" name="fees_paid" required="required" value="<?php echo $user['fee_amount']; ?>" />
        </td>
        <td>
            Fees Paid On
        </td>
        <td>
            <input type="date" name="fee_date" required="required" value="<?php echo $user['fee_date']; ?>" />
        </td>
    </tr>
    <tr id="online_banking" style="
	<?php 
		$fee_mode=$user['fee_mode']; 
		if($fee_mode=='ob') 
			echo 'display:table-row;'; 
		else echo 'display:none;';
			?>" >
        
			<div  >
				
                
					<th >
						Transaction Id
					</th>
					<td>
						<input type="text" name="transac_id" value="<?php echo $user['transaction_id']; ?>"  />
					</td>
					<th>
						Date of Payment
					</th>
					<td>
                        <input type="date" name="ob_payment_date" value="<?php echo $user['payment_made_on']; ?>" max=<?php echo date("Y-m-d", time()+(19800)); ?> >
					</td>
				 
				
			</div>
		
	</tr>
    <tr/><tr id="dd_c"  style="
	<?php 
		$fee_mode=$user['fee_mode']; 
		if($fee_mode!='ob') 
			echo 'display:table-row;'; 
		else echo 'display:none;';
			?>" >
        <div >
            
                <th >
                    Demand Draft / Cheque No.
                </th>
                <td>
                    <input type="text" name="dd_c_no" value="<?php echo $user['fee_reciept_no']; ?>" />
                </td>
                 <th>
                    Demand Draft / Cheque Date
                </th>
                <td>
                    <input type="date" name="dd_payment_date" value="<?php echo $user['payment_made_on']; ?>" max=<?php echo date("Y-m-d", time()+(19800)); ?> >
                </td>
            
            
        </div>
    </tr>
	<tr>
		<td>
            Bank
        </td>
        <td>
            <input type="text" name="bank" value="<?php echo $user['bank_name']; ?>" required />
        </td>
    	<td>
        	Fees paid in Favour
        </td>
    	<td>
  	      	<input type="text" name="fee_favour" value="<?php echo $user['fee_in_favour']; ?>" required="required"/>
        </td>
    </tr>
	<tr />
   
</table>
<hr/>


<input type = "submit" value="Save"/>
<input type="text" id="student_id" name="student_id" style="visibility:hidden;" value="<?php echo $stu_id; ?>" />

</form>


<?php
	drawFooter();
?>
