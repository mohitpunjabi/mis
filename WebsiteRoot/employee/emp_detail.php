<?php
	require_once("../Includes/Auth.php");
	auth("deo");
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	drawHeader("Add Candidate Details");
	if(!(isset($_SESSION['EMP_CURRSTEP']) && $_SESSION['EMP_CURRSTEP'] == 0))
		header("Location: add_employee.php");
	
	if(isset($_GET['error']))
	{
		drawNotification($_GET['error'],"", "error");
	}
?>

<script type="text/javascript">

	function teaching_handler(auth)
	{
		designation_dropdown(auth);
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
	
	function designation_dropdown(auth)
	{
		if(auth=="ft")
			document.getElementById("des").innerHTML="<select name=\"designation\"><option value=\"professor\">Professor</option><option value=\"associate professor\">Associate Professor</option><option value=\"assistant professor\">Assistant Professor</option></select>";
		else
			document.getElementById("des").innerHTML="<input type=\"text\" name=\"designation\" required=\"required\" />";
	}
	
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

	function fetch_details()
		{
		var emp_id = document.getElementsByName("emp_id")[0].value;
		alert(emp_id);
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
		xmlhttp.open("GET","ajax_fetch_emp_details?emp_id="+emp_id,true);
		xmlhttp.send();	
	}
</script>
<h1>Step 1 :Fill up the details</h1>
<form method = "post" action=  "entrySQL1.php" enctype="multipart/form-data" onsubmit="return image_validation();" >
Fields marked with <span style= "color:red;">*</span> are mandatory.
<table width='90%'>
	<tr><th colspan=4></th></tr>
    <tr>
    	<td width='20%'>
        	Employee Id<span style= "color:red;"> *</span>
        </td>
        <td width='30%'>
        	<input type="text" name="emp_id" required="required" /> 
            <!-- <input type="button" value="Go" id="fetch_id_btn" />-->
        </td>
        <td width='20%'>
        	Physically Challenged<span style= "color:red;"> *</span>
        </td>
        <td width='30%'>
   	      	<input type="radio" name="pd" value="Yes" />Yes
            <input type="radio" name="pd" checked value="No" />No       
        </td>
    </tr>
	<tr>
    	<td>
        	Salutation<span style= "color:red;"> *</span>
        </td>
        <td>
			<select name="salutation" >
            	<option value="Dr" >Dr</option>
                <option value="Prof">Prof</option>
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Ms">Ms</option>
             </select>
        </td>
        <td>
        	First Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name = "firstname" required="required"/>
        </td>
    </tr>
   	<tr>
    	<td>
        	Middle Name
        </td>
        <td>
        	<input type="text" name = "middlename" />
        </td>
        <td>
        	Last Name
        </td>
        <td>
        	<input type="text" name = "lastname" />
        </td>
   </tr>
   <tr>
    	<td>
        	Gender<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="radio" name="sex" checked value="male">Male</input>
            <input type="radio" name="sex" value="female">Female</input>
        </td>
        <td>
        	Nationality<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="nationality" required="required" value="Indian"/>
        </td>
   </tr>
	   <tr>
    	<td>
        	Father's Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="father" required="required" />
        </td>
        <td>
			Mother's Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="mother" required="required" />
        </td>
   </tr>
   <tr>
    	<td>
			Employee Type<span style= "color:red;"> *</span>
       	</td>
        <td>
        	<select name="tstatus" onchange="teaching_handler(this.value);" >
            	<option value="ft" selected="selected" >Faculty</option>
                <option value="nfta">Non Faculty (Academic)</option>
                <option value="nftn">Non Faculty (Non Academic)</option>
             </select>
        </td>
   		<td>
        	Research Interest
        </td>
        <td>
        	<input type="text" name="research_int" id="res_int_id"/>
        </td>
   </tr>
   <tr>
	   	<td>
        	Marital Status<span style= "color:red;"> *</span>
        </td>
    	<td>
        	<select name="mstatus" >
            	<option value="married">Married</option>
                <option value="unmarried">Unmarried</option>
                <option value="widow">Widow</option>
                <option value="widower">Widower</option>
                <option value="separated">Separated</option>
                <option value="divorced">Divorced</option>
             </select>
        </td>
    	<td>
        	Kashmiri Immigrant<span style= "color:red;"> *</span>
        </td>
    	<td>
			<input type="radio" name="kashmiri" value="yes"/>Yes
            <input type="radio" name="kashmiri" checked value="no"/>No
        </td> 
    </tr>
    <tr>
       	<td>
        	Date of Joining<span style= "color:red;"> *</span>
        </td>
    	<td>
			<input type="date" name="entrance_age" value="<?php echo date("Y-m-d",time()+(19800));?>" required="required" >
        </td>
    	<td>
        	Designation<span style= "color:red;"> *</span>
        </td>
    	<td id="des">
			<select name="designation">
            	<option value="professor">Professor</option>
            	<option value="associate professor">Associate Professor</option>
            	<option value="assistant professor">Assistant Professor</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td>
        	Post Concerned
        </td>
    	<td>
  	      	<input type="text" name="post" />
        </td>
    	<td>
        	Department/Section<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<select name="department" id="depts" >
            	<?php
					$qry=mysql_query("select id,name from departments where type='academic'");
					while($row=mysql_fetch_row($qry))
					{
						echo '<option value="'.$row[0].'">'.$row[1].'</option>';
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
        	<select name="category">
				<option value="General">GEN</option>
                <option value="OBC">OBC</option>
                <option value="SC">SC</option>
                <option value="ST">ST</option>
                <option value="Others">Others</option>
             </select>
        </td>
    	<td>
        	Religion<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="religion" required="required"/>
        </td>
    </tr>
    <tr>
    	<td>
        	DOB<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="date" name="dob" value="<?php echo date("Y-m-d",time()+(19800));?>" max=<?php echo date("Y-m-d", time()+(19800)); ?>  required="required" />
        </td>
    	<td>
        	Place of Birth<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="pob" required="required" />
        </td>
    </tr>
     <tr>
    	<td>
        	Pay Band+gradepay+basic (tobe aded)<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<select name="payscale" >
            	<option value="" disabled selected>Pay Band </option>
				<?php
					$qry=mysql_query("select distinct pay_band from pay_scales");
					while($row=mysql_fetch_row($qry))
					{
						echo '<option value="'.$row[0].'">'.$row[0].'</option>';
					}
                ?>
            </select>
        </td>
        <td>Nature of Employment<span style= "color:red;"> *</span></td>
       	<td>
        	<select name="empnature" >
            	<option value="permanent">Permanent</option>
                <option value="temporary">Temporary</option>
                <option value="probation">Probation</option>
                <option value="contract">Contract</option>
                <option value="others">Others</option>
            </select>
        </td>
   </tr>
   <tr>
		<td>
        	Date of Retirement
        </td>
        <td>
        	<input type="date" name="retire" />
        </td>
    </tr>
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
        	Address Line 1<span style= "color:red;"> *</span>
        </td>
    	<td>
			<textarea name="line11" required="required"></textarea>
        </td>
    	<td>
        	Address Line 1<span style= "color:red;"> *</span>
        </td>
    	<td>
			<textarea name="line12" required="required"></textarea>
        </td>
    </tr>
    <tr>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line21" />
        </td>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line22" />
        </td>
    </tr>
	<tr>
    	<td>
        	City<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="city1" required="required"/>
        </td>
        <td>
        	City<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="city2" required="required"/>
        </td>
    </tr>
    <tr>
    	<td>
        	State<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="state1" required="required"/>
        </td>
    	<td>
        	State<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="state2" required="required"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Pin code<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="pincode1" required="required"/>
        </td>
    	<td>
        	Pin code<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="pincode2" required="required"/>
        </td>
    </tr>
	    <tr>
    	<td>
        	Country<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="country1" value="India" required="required"/>
        </td>
    	<td>
        	Country<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="country2" value="India" required="required"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Contact No<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="contact1" required="required"/>
        </td>
    	<td>
        	Contact No<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="contact2" required="required"/>
        </td>
    </tr>
    <tr><th colspan=4></th></tr>
		<tr><td>Hobbies</td>
        	<td><input type="text" name="hobbies"></td>
            <td>Favourite Past Time</td>
        	<td><input type="text" name="favpast"></td>
        </tr>
        <tr>
            <td>Fax</td>
        	<td><input type="tel" name="fax" ></td>
            <td>Office No</td>
        	<td><input type="tel" name="office"></td>
        </tr>
        <tr>
        	<td>Email</td>
        	<td><input type="email" name="email" ></td>
            <td>Mobile No</td>
        	<td><input type="tel" name="mobile" ></td>
        </tr>
</table>
<table width="90%">
        <tr><th colspan=2 >Photograph</th></tr><tr></tr>
        <tr  height="150">
            <td width="145" id="preview"><?php echo '<img src="Images/noProfileImage.png" id="view_photo" width="145" height="150"/>'; ?></td>
        	<td align="center">Click on choose file to select picture<span style= "color:red;"> *</span><br>
            	<input type="file" name="photo" id="photo" required="required" ><br>
                <input type="button" value="preview" onClick="preview_pic();">	
            </td>
		</tr>
</table>
<input type = "submit" value="Next"/>
</form>

<?php
	mysql_close();
	drawFooter();
?>