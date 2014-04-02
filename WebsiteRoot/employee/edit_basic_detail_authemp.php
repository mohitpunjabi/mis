<?php
	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	drawHeader("Edit Basic Details");
	if(isset($_GET['emp_id']))
		$emp_id = $_GET['emp_id'];
	else if(is_auth('emp'))
	{
		$emp_id=$_SESSION['id'];
		if(isset($_GET['update']))
		{
			drawNotification("Your basic details have been saved", "<a href='show_emp.php?form_name=0'>Click here</a> to view your basic details", "success");
		}
	}
	else
	{
		drawNotification("Employee Id not selected", "<a href='edit_employee.php'>Click here</a> to select Employee Id.", "error");
		die();
	}
	// extracting existing details from the database
	
	$emp_user_details=mysql_query("select * 
								from user_details NATURAL JOIN user_other_details NATURAL JOIN emp_basic_details NATURAL JOIN faculty_details
								where id='".$emp_id."'");
	$emp_pay_details=mysql_query("select pay_code,pay_band,grade_pay,basic_pay 
								from emp_pay_details NATURAL JOIN pay_scales
								where id='".$emp_id."'");
	$emp_present_addr_details=mysql_query("select * from user_address where id='".$emp_id."' and type='present'");
	$emp_permanent_addr_details=mysql_query("select * from user_address where id='".$emp_id."' and type='permanent'");

	$user=mysql_fetch_assoc($emp_user_details);
	$pay=mysql_fetch_assoc($emp_pay_details);
	$addr1=mysql_fetch_assoc($emp_present_addr_details);
	$addr2=mysql_fetch_assoc($emp_permanent_addr_details);
	
	//END
	$_SESSION['EDIT_DEPT']=$user['dept_id'];
	$_SESSION['EMPLOYEE_PIC']=$user['photopath'];
	
?>
<script type="text/javascript">

	function payband_handler(pb)
	{
		var gp = document.getElementsByName("gradepay")[0];
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
			    gp.innerHTML=xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("GET","AJAX_gradepay.php?pb="+pb,true);
		xmlhttp.send();
		gp.innerHTML="<option selected=\"selected\">Loading...</option>";
	}

	function teaching_handler(auth)
	{
		designation_dropdown(auth);
		retirement_handler();
		if(auth =='ft')
		{
			document.getElementById('res_int_id').disabled=false;
			document.getElementById('res_int_id').value="";
		}
		else
			document.getElementById('res_int_id').disabled=true;
		
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
			    document.getElementById("depts").innerHTML=xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("GET","emp_detail1.php?t="+auth,true);
		xmlhttp.send();	
		document.getElementById("depts").innerHTML="<option selected=\"selected\">Loading...</option>";
	}
	
	function retirement_handler()
	{
		var retire = document.getElementById("retire");
		var auth = document.getElementsByName("tstatus")[0].value;
		var source=document.getElementsByName("dob")[0].value;
		var new_date=new Date(source);
	
		if(auth=="ft")
			new_date.setFullYear(new_date.getFullYear() + 65);
		else if(auth=="nfta")
			new_date.setFullYear(new_date.getFullYear() + 62);
		else if(auth=="nftn")
			new_date.setFullYear(new_date.getFullYear() + 60);

		var month=new_date.getMonth();
		var year=new_date.getFullYear();
		if(month==0 || month==2 || month==4 || month==6 || month==7 || month==9 || month==11)
			new_date.setDate(31);
		else if(month!=1)
			new_date.setDate(30);
		else
		{
			if(year%4==0 && year%100!=0)
				new_date.setDate(29);
			else
				new_date.setDate(28);
		}
		var date='';
		if(new_date.getDate()<10)	date='0'+new_date.getDate();
		else	date=''+new_date.getDate();
		
		retire.value=new_date.getFullYear()+source.substr(source.indexOf('-'),[3])+'-'+date;
	}	
	
	function designation_dropdown(auth)
	{
		if(auth=="ft")
			document.getElementById("des").innerHTML="<select name=\"designation\"><option value=\"professor\">Professor</option><option value=\"associate professor\">Associate Professor</option><option value=\"assistant professor\">Assistant Professor</option><option value=\"senior lecturer\">Senior Lecturer</option><option value=\"lecturer\">Lecturer</option><option value=\"demonstrator\">Demonstrator</option></select>";
		else
			document.getElementById("des").innerHTML="<input type=\"text\" name=\"designation\" required=\"required\" />";
	}

</script>
<body>
<h1>Edit the Basic details</h1>
<form method = "post" action="updateSQL1emp.php" >
Fields marked with <span style= "color:red;">*</span> are mandatory.
<table width='90%'>
	<tr><th colspan=4></th></tr>
    <tr>
    	<td width='20%'>
        	Employee Id<span style= "color:red;"> *</span>
        </td>
        <td width='30%'>
        	<input type="text" name="emp_id" id="emp_id" readonly value="<?php echo $emp_id;?>"  >
        </td>
        <td width='20%'>
        	Physically Challenged<span style= "color:red;"> *</span>
        </td>
        <td width='30%'>
            <input type="radio" name="pd" value="yes" <?php if($user['physically_challenged']=="yes") echo 'checked="checked"'; ?>  />Yes
            <input type="radio" name="pd" value="no" <?php if($user['physically_challenged']=="no") echo 'checked="checked"'; ?> />No
        </td>
    </tr>
	<tr>
    	<td>
        	Salutation<span style= "color:red;"> *</span>
        </td>
        <td>
			<select name="salutation" >
            	<option value="Dr" <?php if($user['salutation']=="Dr")echo "selected"; ?> >Dr</option>
                <option value="Prof"  <?php if($user['salutation']=="Prof")echo "selected"; ?> >Prof</option>
                <option value="Mr"  <?php if($user['salutation']=="Mr")echo "selected"; ?> >Mr</option>
                <option value="Mrs"  <?php if($user['salutation']=="Mrs")echo "selected"; ?> >Mrs</option>
                <option value="Ms"  <?php if($user['salutation']=="Ms")echo "selected"; ?> >Ms</option>
             </select>
        </td>
        <td>
        	First Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input  type="text" name = "firstname" required value="<?php echo $user['first_name'];?>" <?php if(is_auth('emp'))echo "disabled"; ?> >
        </td>
    </tr>
   	<tr>
    	<td>
        	Middle Name
        </td>
        <td>
        	<input disabled type="text" name = "middlename" value=<?php echo $user['middle_name'];?> >
        </td>
        <td>
        	Last Name
        </td>
        <td>
        	<input disabled type="text" name = "lastname" value=<?php echo $user['last_name'];?> >
        </td>
   </tr>
   <tr>
    	<td>
        	Gender<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="radio" name="sex" value="male" <?php if($user['sex']=='male' || $user['sex']=='m') echo 'checked="checked"'; ?> <?php if(is_auth('emp'))echo "disabled"; ?> >Male</input>
            <input type="radio" name="sex" value="female" <?php if($user['sex']=='female' || $user['sex']=='f') echo 'checked="checked"'; ?> <?php if(is_auth('emp'))echo "disabled"; ?> >Female</input>
        </td>
        <td>
        	Nationality<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="nationality" required value=<?php echo $user['nationality'];?> <?php if(is_auth('emp'))echo "disabled"; ?> >
        </td>
   </tr>
   <tr>
    	<td>
        	Father's Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="father" required value=<?php echo $user['father_name']; ?> <?php if(is_auth('emp'))echo "disabled"; ?> >
        </td>
        <td>
			Mother's Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="mother" required value=<?php echo $user['mother_name'];?> <?php if(is_auth('emp'))echo "disabled"; ?> >
        </td>
   </tr>
   <tr>
    	<td>
			Employee Type<span style= "color:red;"> *</span>
       	</td>
        <td>
        	<select name="tstatus" onChange="teaching_handler(this.value);" id="teaching" <?php if(is_auth('emp'))echo "disabled"; ?> >
            	<option value="ft" <?php if($user['auth_id']=="ft")echo "selected"; ?> >Faculty</option>
                <option value="nfta" <?php if($user['auth_id']=="nfta")echo "selected"; ?> >Non Faculty (Academic)</option>
                <option value="nftn" <?php if($user['auth_id']=="nftn")echo "selected"; ?> >Non Faculty (Non Academic)</option>
             </select>
        </td>
   		<td>
        	Research Interest
        </td>
        <td>
        	<?php 
				if($user['auth_id']=='ft') 
        			echo '<input type="text" name="research_int" id="res_int_id"  value="'.$user['research_interest'].'" >';
				else
					echo '<input type="text" name="research_int" id="res_int_id"  disabled >';
             ?>
        </td>
   </tr>
   <tr>
	   	<td>
        	Marital Status<span style= "color:red;"> *</span>
        </td>
    	<td>
        	<select name="mstatus" >
            	<option value="married" <?php if($user['marital_status']=="married")echo "selected"; ?> >Married</option>
                <option value="unmarried" <?php if($user['marital_status']=="unmarried")echo "selected"; ?> >Unmarried</option>
                <option value="widow" <?php if($user['marital_status']=="widow")echo "selected"; ?> >Widow</option>
                <option value="widower" <?php if($user['marital_status']=="widower")echo "selected"; ?> >Widower</option>
                <option value="separated" <?php if($user['marital_status']=="separated")echo "selected"; ?> >Separated</option>
                <option value="divorced" <?php if($user['marital_status']=="divorced")echo "selected"; ?> >Divorced</option>
             </select>
        </td>
    	<td>
        	Kashmiri Immigrant<span style= "color:red;"> *</span>
        </td>
    	<td>
			<input type="radio" name="kashmiri" value="yes" <?php if($user['kashmiri_immigrant']=='yes') echo 'checked="checked"'; ?> <?php if(is_auth('emp'))echo "disabled"; ?> />Yes
            <input type="radio" name="kashmiri" value="no" <?php if($user['kashmiri_immigrant']=='no') echo 'checked="checked"'; ?> <?php if(is_auth('emp'))echo "disabled"; ?> />No
        </td> 
    </tr>
    <tr>
       	<td>
        	Date of Joining<span style= "color:red;"> *</span>
        </td>
    	<td>
			<input type="date" name="entrance_age" value="<?php echo $user['joining_date'];?>" required <?php if(is_auth('emp'))echo "disabled"; ?> >
        </td>
    	<td>
        	Designation<span style= "color:red;"> *</span>
        </td>
    	<td id="des">
        <?php 
			if($user['auth_id']=="ft")
			{
				echo '<select name="designation" '; 
				if(is_auth('emp'))	echo 'disabled  >';
				else	echo '>';
		        echo '<option value="professor" '; if($user['designation']=="professor") echo 'selected';
										echo  '>Professor</option>';
            	echo '<option value="associate professor" '; if($user['designation']=="associate professor") echo 'selected';
										echo  '>Associate Professor</option>';
				echo '<option value="assistant professor" '; if($user['designation']=="assistant professor") echo 'selected';
										echo  '>Assistant Professor</option>';
				echo '<option value="senior lecturer" '; if($user['designation']=="senior lecturer") echo 'selected';
										echo  '>Senior Lecturer</option>';
				echo '<option value="lecturer" '; if($user['designation']=="lecturer") echo 'selected';
										echo  '>Lecturer</option>';
				echo '<option value="demonstrator" '; if($user['designation']=="demonstrator") echo 'selected';
										echo  '>Demonstrator</option></select>';
			}
        	else 
           	{	echo '<input type="text" name="designation" value="'.$user['designation'].'" required ';
				if(is_auth('emp'))
					echo 'disabled >';
				else
					echo '>';
			}
		?>
        </td>
    </tr>
	<tr>
        <td>
        	Post Concerned
        </td>
    	<td>
  	      	<input type="text" name="post" value="<?php echo $user['post_concerned'];?>" >
        </td>
    	<td>
        	Department/Section<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<select name="department" id="depts" <?php if(is_auth('emp'))echo "disabled"; ?> >
            	<?php
					if($user['auth_id']=='ft')
					{
						$qry=mysql_query("select id,name from departments where type='academic'");
						while($row=mysql_fetch_row($qry))
						{
							if($user['dept_id']==$row[0])
								echo '<option value="'.$row[0].'" selected>'.$row[1].'</option>';
							else
								echo '<option value="'.$row[0].'">'.$row[1].'</option>';
						}
					}
					else if($user['auth_id']=='nftn')
					{
						$qry=mysql_query("select id,name from departments where type='nonacademic'");
						while($row=mysql_fetch_row($qry))
						{
							if($user['dept_id']==$row[0])
								echo '<option value="'.$row[0].'" selected>'.$row[1].'</option>';
							else
								echo '<option value="'.$row[0].'">'.$row[1].'</option>';
						}
					}
					else
					{
						$qry=mysql_query("select id,name from departments");
						while($row=mysql_fetch_row($qry))
						{
							if($user['dept_id']==$row[0])
								echo '<option value="'.$row[0].'" selected>'.$row[1].'</option>';
							else
								echo '<option value="'.$row[0].'">'.$row[1].'</option>';
						}
					}

				?>
            </select>
        </td>
    </tr>
    <tr>
    	<td>
            Category<span style= "color:red;"> *</span>
        </td>
    	<td>
        	<select name="category" <?php if(is_auth('emp'))echo "disabled"; ?> >
				<option value="General" <?php if($user['category']=="General")echo "selected"; ?> >GEN</option>
                <option value="OBC" <?php if($user['category']=="OBC")echo "selected"; ?> >OBC</option>
                <option value="SC" <?php if($user['category']=="SC")echo "selected"; ?> >SC</option>
                <option value="ST" <?php if($user['category']=="ST")echo "selected"; ?> >ST</option>
                <option value="Others" <?php if($user['category']=="Others")echo "selected"; ?> >Others</option>
             </select>
        </td>
    	<td>
        	Religion<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="religion" value="<?php echo $user['religion']; ?>" required <?php if(is_auth('emp'))echo "disabled"; ?> >
        </td>
    </tr>
    <tr>
    	<td>
        	DOB<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="date" name="dob"  onChange="retirement_handler()" value=<?php echo $user['dob'];?> max=<?php echo date("Y-m-d", time()+(19800)); ?> <?php if(is_auth('emp'))echo "disabled"; ?> >
        </td>
    	<td>
        	Place of Birth<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="pob" value=<?php echo $user['birth_place']; ?> required <?php if(is_auth('emp'))echo "disabled"; ?> >
        </td>
    </tr>
    <tr>
    	<td>
        	Pay Scale<span style= "color:red;"> *</span>
        </td>
    	<td>
        	<select name="payscale" tabindex="26"  onchange="payband_handler(this.value);" <?php if(is_auth('emp'))echo "disabled"; ?> >
            	<option value="" disabled>Pay Band </option>
				<?php
					$qry=mysql_query("select distinct pay_band,pay_band_description from pay_scales");
					while($row=mysql_fetch_row($qry))
					{
						if($pay['pay_band']==$row[0])
							echo '<option selected="selected" value="'.$row[0].'">'.strtoupper($row[0]).' ('.$row[1].')</option>';
						else
							echo '<option value="'.$row[0].'">'.strtoupper($row[0]).' ('.$row[1].')</option>';
					}
                ?>
            </select>
            <select name="gradepay" tabindex="26" <?php if(is_auth('emp'))echo "disabled"; ?> >
				<?php
					$qry=mysql_query("select * from pay_scales where pay_band='".$pay['pay_band']."'");
					while($row=mysql_fetch_row($qry))
					{
						if($pay['pay_code']==$row[0])
							echo '<option selected="selected" value="'.$row[0].'" >'.$row[3].'</option>';
						else
							echo '<option value="'.$row[0].'">'.$row[3].'</option>';
					}
                ?>
            </select>
            <input type="text" name="basicpay" id="basicpay" size="10"  placeholder="Basic Pay" value="<?php echo $pay['basic_pay']; ?>" <?php if(is_auth('emp'))echo "disabled"; ?> />
        </td>
        <td>Nature of Employment<span style= "color:red;"> *</span></td>
       	<td>
            <select name="empnature" <?php if(is_auth('emp'))echo "disabled"; ?> >
            	<option value="permanent" <?php if($user['employment_nature']=="permanent")echo "selected"; ?> >Permanent</option>
                <option value="temporary" <?php if($user['employment_nature']=="temporary")echo "selected"; ?> >Temporary</option>
                <option value="probation" <?php if($user['employment_nature']=="probation")echo "selected"; ?> >Probation</option>
                <option value="contract" <?php if($user['employment_nature']=="contract")echo "selected"; ?> >Contract</option>
                <option value="others" <?php if($user['employment_nature']=="others")echo "selected"; ?> >Others</option>
            </select>
        </td>
   </tr>
   <tr>
		<td>
        	Date of Retirement
        </td>
        <td>
        	<input type="date" name="retire" id="retire" value=<?php echo $user['retirement_date'];?> <?php if(is_auth('emp'))echo "disabled"; ?> />
        </td>
    </tr>
    <tr>
    	<th width="50%" colspan=2>
        	Present Address
        </th>
        <th width="50%" colspan=2>
        	Permanent Address
        </th>
        
    </tr>    
    <tr>
        <td>
        	Address Line 1<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<textarea type="text" name="line11" required ><?php echo $addr1['line1']; ?> </textarea>
        </td>
        <td>
        	Address Line 1<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<textarea type="text" name="line12" disabled readonly ><?php echo $addr2['line1']; ?> </textarea>
        </td>
    </tr>
     <tr>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line21" value=<?php echo $addr1['line2']; ?> >
        </td>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line22" readonly disabled value=<?php echo $addr2['line2']; ?> >
        </td>
    </tr>
	<tr>
    	<td>
        	City<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="city1" required value="<?php echo $addr1['city']; ?>" >
        </td>
        <td>
        	City<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="city2" readonly disabled value="<?php echo $addr2['city']; ?>" >
        </td>
    </tr>
    <tr>
    	<td>
        	State<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="state1" required value="<?php echo $addr1['state']; ?>" >
        </td>
    	<td>
        	State<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="state2" disabled value="<?php echo $addr2['state']; ?>" readonly >
        </td>
    </tr>
    <tr>
    	<td>
        	Pin code<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="pincode1" required value="<?php echo $addr1['pincode']; ?>" >
        </td>
    	<td>
        	Pin code<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="pincode2" value="<?php echo $addr2['pincode']; ?>" readonly disabled >
        </td>
    </tr>
    <tr>
    	<td>
        	Country<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="country1" value="<?php echo $addr1['country']; ?>" required />
        </td>
    	<td>
        	Country<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="country2" value="<?php echo $addr2['country']; ?>" readonly disabled />
        </td>
    </tr>
    <tr>
    	<td>
        	Contact No<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="contact1" value="<?php echo $addr1['contact_no']; ?>" required >
        </td>
    	<td>
        	Contact No<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="contact2" value="<?php echo $addr2['contact_no']; ?>" readonly disabled >
        </td>
    </tr>
	<tr><th colspan=4></th></tr>
		<tr><td>Hobbies</td>
        	<td><input type="text" name="hobbies" value=<?php echo $user['hobbies'];?> ></td>
            <td>Favourite Past Time</td>
        	<td><input type="text" name="favpast" value=<?php echo $user['fav_past_time'];?> ></td>
        </tr>
        <tr>
            <td>Fax</td>
        	<td><input type="tel" name="fax" value=<?php echo $user['fax'];?> ></td>
            <td>Office No</td>
        	<td><input type="tel" name="office" value=<?php echo $user['office_no'];?> ></td>
        </tr>
		<tr><td>Email</td>
        	<td><input type="email" name="email" value=<?php echo $user['email'];?> ></td>
            <td>Mobile No</td>
        	<td><input type="tel" name="mobile" value=<?php echo $user['mobile_no'];?> ></td>
        </tr>
</table>
<input type = "submit" value="Save"/>
</form>

<?php
	echo '<a href="edit_employee.php"><button>Back</button></a>';
	mysql_close();
	drawFooter();
?>
</body>