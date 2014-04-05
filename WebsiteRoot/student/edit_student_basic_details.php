<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
    auth('deo');
	
	drawHeader("Add Candidate Details");
	if(isset($_SESSION['EDIT_STU']))
		$stu_id = $_SESSION['EDIT_STU'];
	else
	{
		drawNotification("Student Admission No. not selected", "<a href='edit_student.php'>Click here</a> to select Student Admission Number.", "error");
		die();
	}
	
	
	//fetching the details for update purpose from basic details table
		
	$stu_details=mysql_query("select * 
								from user_details NATURAL JOIN user_other_details NATURAL JOIN stu_details
								where id='".$stu_id."'");
	
	$user=mysql_fetch_assoc($stu_details);
	
	//fetching the address of the student 
		$stu_present_addr_details=mysql_query("select * from user_address where id='".$stu_id."' and type='present'");
		$stu_permanent_addr_details=mysql_query("select * from user_address where id='".$stu_id."' and type='permanent'");
		$stu_corres_addr_details=mysql_query("select * from user_address where id='".$stu_id."' and type='correspondence'");
		$addr1=mysql_fetch_assoc($stu_present_addr_details);
		$addr2=mysql_fetch_assoc($stu_permanent_addr_details);
		$addr3=mysql_fetch_assoc($stu_corres_addr_details);
	
	?>



<script type="text/javascript">

	function preview_pic()
	{
		var file=document.getElementById('photo').files[0];
		if(!file)
			document.getElementById('view_photo').src =  "Images/noProfileImage.png";
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
	
	function image_validation()
	{
		var file=document.getElementById('photo').files[0];
		var ext=file.name.substring(file.name.lastIndexOf('.') + 1);
		if(ext == "bmp" || ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg" )
		{
			if(file.size>204800)
			{
				alert('The file size must be less than 200KB');
				return false;
			}
			else
				return true;
		}
		else
		{
			alert('The image should be in bmp, gif, png, jpg or jpeg format.');
			return false;
		}
	}
	
	function depends_on_whom()
	{
		var dpe = document.getElementById("depends_on").checked;
		var m=document.getElementById("mother_name");
		var f= document.getElementById("father_name");
		var g=document.getElementById("guardian_name");
		if(dpe)
		{
			g.disabled=false;
			g.style.backgroundColor='#FCFCBA';
			m.style.backgroundColor='#DDf';
			f.style.backgroundColor='#DDf';
			m.disabled=true;
			f.disabled=true;
			
		}
		else
		{
		g.style.backgroundColor='#DDf';
		m.style.backgroundColor='#FCFCBA';
		f.style.backgroundColor='#FCFCBA';
		m.disabled=false;
		f.disabled=false;
		g.disabled=true;
		}
		
	}
</script>
<!-- Style to show the upadate process is going on      -->
<style>
input,select,date,tel,checkbox,radio{
background-color:#FCFCBA;
}
input.-mis-search-text{
background-color:#FFF;
}
</style>

<center>
<h1>Update Student Details</h1>
<form method = "post" action=  "updateSQL1.php" enctype="multipart/form-data" onsubmit="return image_validation();" >
<table width='90%'>
	<tr>
   <th colspan="4">Student Admission No : <?php echo $stu_id ?>  -  Change Basic Details</th>
   </tr>
    <tr>
    	<td width='15%'>
        	Admission No.
        </td>
        <td width='35%'>
        	<input type="text" name="stu_id" value=<?php echo $stu_id ?> required="required" />
            <!-- <input type="button" value="Go" id="fetch_id_btn" />-->
        </td>
			<td>
        	Date of Admission
        </td>
    	<td>
			<input type="date" name="entrance_age" value="<?php echo $user['admn_date']; ?>" required="required" >
        </td>
        
    </tr>
	<tr>
    	<td>
        	Salutation
        </td>
        <td>
			<select name="salutation" >
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Ms">Ms</option>
                <option value="Dr">Dr</option>
             </select>
        </td>
        <td>
        	First Name
        </td>
        <td>
        	<input type="text" name = "firstname" value="<?php echo $user['first_name']; ?>" required="required"/>
        </td>
    </tr>
   	<tr>
    	<td>
        	Middle Name
        </td>
        <td>
        	<input type="text" value="<?php echo $user['middle_name']; ?>" name = "middlename" />
        </td>
        <td>
        	Last Name
        </td>
        <td>
        	<input type="text" value="<?php echo $user['last_name']; ?>" name = "lastname" />
        </td>
   </tr>
      <tr>
        <td>
            Father's Name
        </td>
        <td>
            <input type="text" value="<?php echo $user['father_name']; ?>" id="father_name" name="father_name"  />
        </td>
        <td>
            Mother's Name
        </td>
        <td>
            <input type="text" value="<?php echo $user['mother_name']; ?>" id="mother_name" name="mother_name" />
        </td>
   </tr>
    <tr>
	    <td>
            
			Guardian's Name
        </td>
        <td>
             <input type="text" value="<?php echo "Removed"; ?>" style="background-color:#DDf;" id="guardian_name" name="guardian_name" disabled />
			 <input style="margin-top:2.5px;"  type='checkbox' id ="depends_on"  name="depends_on"  onchange="depends_on_whom()"/>
        </td>
		<td>
        	Gender
        </td>
        <td>
        	<input type="radio" name="sex" value="male" checked>Male</input>
            <input type="radio" name="sex" value="female">Female</input>
        </td>
		
    </tr>
   <tr>
    	<td>
        	Date Of Birth
        </td>
    	<td>
  	      	<input type="date" name="dob" value="<?php echo date("Y-m-d",time()+(19800));?>" max=<?php echo date("Y-m-d", time()+(19800)); ?> placeholder="<?php echo $user['dob']; ?>" >
        </td>
		<td>
        	Place of Birth
        </td>
    	<td>
  	      	<input type="text" name="pob" value="<?php echo $user['birth_place']; ?>" />
        </td>
		
    </tr>
	
    <tr>
		<td>
        	Kashmiri Immigrant
        </td>
    	<td>
			<input type="radio" name="kashmiri" value="Yes"/>Yes
            <input type="radio" name="kashmiri" checked value="No"/>No
        </td>   
		<td width='15%'>
        	Physically Challenged
        </td>
        <td width='35%'>
   	      	<input type="radio" name="pd" value="yes" />Yes
            <input type="radio" name="pd" value="no" checked />No       
        </td>
			
    </tr>
   <tr>
		<td>
			Identification Mark
		</td>
		<td>
			<input type="text" name="identification_mark" value="<?php echo $user['identification_mark']; ?>" required="required"/>
		</td>
		<td>
        	Marital Status
        </td>
    	<td>
        	<select name="mstatus" >
            	<option value="Unmarried">Unmarried</option>
				<option value="Married">Married</option>
                <option value="Widow">Widow</option>
                <option value="Widower">Widower</option>
                <option value="Separated">Separated</option>
                <option value="Divorced">Divorced</option>
             </select>
        </td>
    </tr>
	<tr>
    	<td>
            Category
        </td>
    	<td>
        	<select name="category">
				<option value="General">GEN</option>
                <option value="OBC">OBC</option>
                <option value="SC">SC</option>
                <option value="ST">ST</option>
                <option value="Others">Others</option>
             </select>
        </td>
		<td>
        	Religion
        </td>
    	<td>
  	      	<input type="text" value="<?php echo $user['religion']; ?>"name="religion" />
        </td>
		
    </tr>
    <tr>
    	 <td>
            Nationality
        </td>
        <td>
            <input type="text" name="nationality" value="<?php echo $user['nationality']; ?>" required="required" value="Indian"/>
        </td>
		<td>
        	Department
        </td>
    	<td>
  	      	<select name="department" id="depts" >
            	<?php
                    $qry=mysql_query("select dept_id from user_details where id='$stu_id'");
                    $dept_id=mysql_fetch_assoc($qry);
					$qry=mysql_query("select id,name from departments where type='academic'");
					while($row=mysql_fetch_row($qry))
					{
                        if($row[0]==$dept_id['dept_id'])
                            echo '<option selected value="'.$row[0].'">'.$row[1].'</option>';
                        else
                            echo '<option value="'.$row[0].'">'.$row[1].'</option>';
					}
				?>
            </select>
        </td>
    </tr>
	 <tr>
        	<td>Email</td>
        	<td><input type="email" value="<?php echo $user['email']; ?>" name="email" required="required"></td>
            <td>Mobile No</td>
        	<td><input type="tel" name="mobile" value="<?php echo $user['mobile_no']; ?>" required="required"></td>
        </tr>
		<tr>
        	<td>Hobbies</td>
        	<td><input type="text" name="hobbies" value="<?php echo $user['hobbies']; ?>" /></td>
            <td>Favourite Pass Time</td>
        	<td><input type="text" name="favpast" value="<?php echo $user['fav_past_time']; ?>" /></td>
        </tr>
   <tr/>
    <tr>
    	<th width='50%' colspan=2>
        	Present Address
        </th>
        <th width='50%' colspan=2>
        	Permanent Address
        </th>
        
    </tr>    
    <tr>
    	<td>
        	Address Line 1
        </td>
    	<td>
  	      	<input type="text" name="line11" value="<?php echo $addr1['line1']; ?>" required="required" tabindex="10" />
        </td>
    	<td>
        	Address Line 1
        </td>
    	<td>
  	      	<input type="text" name="line13" value="<?php echo $addr2['line1']; ?>" required="required" tabindex="17" />
        </td>
    </tr>
    <tr>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line21" value="<?php echo $addr1['line2']; ?>" required="required" tabindex="11"/>
        </td>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line23" value="<?php echo $addr2['line2']; ?>" tabindex="18" required="required"/>
        </td>
    </tr>
	<tr>
    	<td>
        	City
        </td>
    	<td>
  	      	<input type="text" name="city1" value="<?php echo $addr1['city']; ?>" tabindex="12" required="required"/>
        </td>
        <td>
        	City
        </td>
    	<td>
  	      	<input type="text" name="city3" value="<?php echo $addr2['city']; ?>" tabindex="18" required="required"/>
        </td>
    </tr>
    <tr>
    	<td>
        	State
        </td>
    	<td>
  	      	<input type="text" name="state1" value="<?php echo $addr1['state']; ?>" tabindex="13" required="required"/>
        </td>
    	<td>
        	State
        </td>
    	<td>
  	      	<input type="text" name="state3" value="<?php echo $addr2['state']; ?>" tabindex="19" required="required"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Pin code
        </td>
    	<td>
  	      	<input type="tel" name="pincode1" value="<?php echo $addr1['pincode']; ?>" tabindex="14" required="required"/>
        </td>
    	<td>
        	Pin code
        </td>
    	<td>
  	      	<input type="tel" name="pincode3" value="<?php echo $addr2['pincode']; ?>" tabindex="19" required="required"/>
        </td>
    </tr>
	<tr>
    	<td>
        	Country
        </td>
    	<td>
  	      	<input type="text"  tabindex="15" value="<?php echo $addr1['country']; ?>"  name="country1" required="required"/>
        </td>
    	<td>
        	Country
        </td>
    	<td>
  	      	<input type="text" name="country3" value="<?php echo $addr2['country']; ?>" tabindex="20" required="required"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Contact No
        </td>
    	<td>
  	      	<input type="tel"  tabindex="16" value="<?php echo $addr1['contact_no']; ?>" name="contact1" required="required"/>
        </td>
    	<td>
        	Contact No
        </td>
    	<td>
  	      	<input type="tel" name="contact3" value="<?php echo $addr2['contact_no']; ?>" tabindex="21" required="required"/>
        </td>
    </tr>
    <tr>
	<td colspan=4 align='center'>
	</tr>
	<tr >
		<td colspan='4'><div id="corr_addr">
			<table   width='100%' >
				<th colspan='4'>Correspondance Address</th>
		
				<tr >
					<td  align="right">
						Address Line 1
					</td>
					<td colspan="2">
						<input type="text" value="<?php echo $addr3['line1']; ?>" style="background-color:#eee" name="line12"   />
					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						Address Line 2
					</td>
					<td colspan="2">
						<input type="text" value="<?php echo $addr3['line2']; ?>" style="background-color:#eee" name="line22"    />
					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						City
					</td>
					<td colspan="2">
						<input type="text" value="<?php echo $addr3['city']; ?>" style="background-color:#eee" name="city2"   />
					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						State
					</td>
					<td colspan="2">
						<input type="text" value="<?php echo $addr3['state']; ?>" style="background-color:#eee" name="state2"    />
					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						Pin code
					</td>
					<td colspan="2">
						<input type="tel" value="<?php echo $addr3['pincode']; ?>" style="background-color:#eee" name="pincode2"/>
					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						Country
					</td>
					<td colspan="2">
						<input type="text" value="<?php echo $addr3['country']; ?>" style="background-color:#eee" name="country2"   />
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right">
						Contact No
					</td>
					<td colspan="2">
						<input type="tel" value="<?php echo $addr3['contact_no']; ?>" style="background-color:#eee" name="contact2"   />
					</td>
				</tr>
 
			</table>
		</div></td>
	</tr>
    
	
       
</table>

<br/><input type = "submit" name="submit" value="Save"/>
<?php
	echo '<a href="edit_student.php" style=""><input type="button" Value="Back" /></a>';
	
?>
<br/>
</form>

</center>

<?php
	mysql_close();
	drawFooter();
?>
