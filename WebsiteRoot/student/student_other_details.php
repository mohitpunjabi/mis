
<?php
	require_once("../Includes/Auth.php");
    auth('deo');
	require_once("../Includes/ConfigSQL.php");
	require_once("../Includes/Layout.php");
	
	if((isset($_SESSION['STUDENT_CURRSTEP']) && $_SESSION['STUDENT_CURRSTEP'] == 1) == FALSE)
	{
		if(!isset($_SESSION['STUDENT_CURRSTEP']))
			$_SESSION['STUDENT_CURRSTEP'] = 1;
		header("Location: add_student.php");
	}	
	drawHeader("Add Admission Details");
	
?>

<script type="text/javascript">
    function mode_of_payment(x)
    {
        //var x=document.getElementById('pay_mode').value;
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


<?php	echo '<table>
				<tr>
					<th>Student Id</th>
					<td>'.$_SESSION['ADD_STUDENT_ID'].'</td>
				</tr>
				</table>' ;
 ?>
<!-- -->

<h1>Step 2 :Please Fill Up Admission Details</h1>
<form method = "post" action="entrySQL2.php" enctype="multipart/form-data" onsubmit="" >
<table width='90%'>
	<th colspan=4></th>
    <tr>
    	<td >
        	Enrollnment No.
        </td>
        <td >
        	<input type="text" name="enroll_no" required="required" /> 
            <!-- <input type="button" value="Go" id="fetch_id_btn" />-->
        </td>
			<td>
        	Enrollnment Year
        </td>
    	<td>
			<input type="tel" max='4' name="enroll_year" required="required" >
        </td>
        
    </tr>
	<tr>
    	<td>
			Admission Based On
       	</td>
        <td>
        	<select name="adm_on" >
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
        	<select name="stu_type"  >
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
        	<input type="text" name = "session" />
        </td>
        <td>
        	Alternate Email id
        </td>
        <td>
        	<input type="email" name= "alternate_email_id" />
        </td>
   </tr>
   	<tr>
    	<td>
        	Parent/Guardian Mobile No.
        </td>
        <td>
        	<input type="tel" name = "parent_mob" required="required"/>
        </td>
        <td>
        	Parent/Guardian Landline No.
        </td>
        <td>
        	<input type="tel" name = "parent_lan" />
        </td>
   </tr>
   <tr>
		<td>
        	Migration Certificate Received
        </td>
    	<td>
			<input type="radio" name="migration_certificate" value="t"/>Yes
            <input type="radio" name="migration_certificate" checked value="f"/>No
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
        	<select name="pay_mode" onchange="mode_of_payment(this.value)">
				<option value='sp'>Select Payment</option>
            	<option value='dd'>Demand Draft</option>
                <option value='ob'>Online Banking</option>
                <option value='c'>Cheque</option>
                <!--option>Fees Deposit</option!-->
             </select>
        </td>
    	
    	<td>
        	Receipt Number
        </td>
    	<td>
  	      	<input type="text" name="receipt_no" required="required"/>
        </td>
    </tr>
	<tr>
    	<td>
        	Fees Amount Paid
        </td>
    	<td>
  	      	<input type="text" name="fees_paid" required="required"/>
        </td>
        <td>
            Fees Paid On
        </td>
        <td>
            <input type="date" name="fee_date" required="required"/>
        </td>
    </tr>
    <tr id="online_banking" style="display:none;" >
        
			<div  >
				
                
					<th >
						Transaction Id
					</th>
					<td>
						<input type="text" name="transac_id" />
					</td>
					<th>
						Date of Payment
					</th>
					<td>
                        <input type="date" name="ob_payment_date" value="<?php echo date("Y-m-d",time()+(19800));?>" max=<?php echo date("Y-m-d", time()+(19800)); ?> >
					</td>
				 
				
			</div>
		
	</tr>
    <tr/><tr id="dd_c"  style="display:none;">
        <div >
            
                <th >
                    Demand Draft / Cheque No.
                </th>
                <td>
                    <input type="text" name="dd_c_no" />
                </td>
                 <th>
                    Demand Draft / Cheque Date
                </th>
                <td>
                    <input type="date" name="dd_payment_date" value="<?php echo date("Y-m-d",time()+(19800));?>" max=<?php echo date("Y-m-d", time()+(19800)); ?> >
                </td>
            
            
        </div>
    </tr>
	<tr>
		<td>
            Bank
        </td>
        <td>
            <input type="text" name="bank" required />
        </td>
    	<td>
        	Fees paid in Favour
        </td>
    	<td>
  	      	<input type="text" name="fee_favour" required="required"/>
        </td>
    </tr>
	<tr />
   
</table>
<hr/>
<input type = "submit" value="Next"/>
</form>


<?php
	drawFooter();
?>
