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
		gp.style.visibility = "visible";
		document.getElementById('basicpay').style.visibility='visible';
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
		$("#fetch_id_btn").hide();
		$("#empIdIcon").show();
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
				if(xmlhttp.responseText != "") {
					var details = eval(xmlhttp.responseText);
					$("select[name=salutation]").val(details['salutation']);
					$("input[name=firstname]").val(details['first_name']);
					$("input[name=middlename]").val(details['middle_name']);
					$("input[name=lastname]").val(details['last_name']);
					$("select[name=tstatus]").val('ft');
					$("input[name=research_int]").val(details['research_int']);
					$("select[name=category]").val(details['category']);
					$("input[name=mobile]").val(details['ph_no']);
				}
				else {
					$("select[name=salutation]").val("Dr");
					$("input[name=firstname]").val("");
					$("input[name=middlename]").val("");
					$("input[name=lastname]").val("");
					$("select[name=tstatus]").val('ft');
					$("input[name=research_int]").val("");
					$("select[name=category]").val("");
					$("input[name=mobile]").val("");
				}
				$("td, th").css("visibility", "visible");
				$("#fetch_id_btn").show();
				$("#empIdIcon").hide();
		    }
	  	}
		xmlhttp.open("GET","AJAX_fetch_emp_details.php?emp_id="+emp_id,true);
		xmlhttp.send();	
	}
	
	$(document).ready(function() {
		$("td, th").css("visibility", "hidden");
		$("td#empId").css("visibility", "visible");
		$("#empIdIcon").hide();
	});
</script>
<h1>Step 1 :Fill up the details</h1>
<form method = "post" action=  "entrySQL1.php" enctype="multipart/form-data" onsubmit="return image_validation();" >
Fields marked with <span style= "color:red;">*</span> are mandatory.
<table width='90%'>
	<tr><th colspan=4></th></tr>
    <tr>
    	<td width='20%' id="empId">
        	Employee Id<span style= "color:red;"> *</span>
        </td>
        <td width='30%' id="empId">
        	<input type="text" name="emp_id" required="required" tabindex="1" /> 
            <input type="button" value="Go" id="fetch_id_btn" onClick="fetch_details()" tabindex="1" />
            <i class="loading" id="empIdIcon"></i>
        </td>
        <td width='20%'>
        	Physically Challenged<span style= "color:red;"> *</span>
        </td>
        <td width='30%'>
   	      	<input type="radio" name="pd" value="Yes" tabindex="2" />Yes
            <input type="radio" name="pd" checked value="No" tabindex="3" />No       
        </td>
    </tr>
	<tr>
    	<td>
        	Salutation<span style= "color:red;"> *</span>
        </td>
        <td>
			<select name="salutation" tabindex="4" >
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
        	<input type="text" name = "firstname" required="required" tabindex="5"/>
        </td>
    </tr>
   	<tr>
    	<td>
        	Middle Name
        </td>
        <td>
        	<input type="text" name = "middlename" tabindex="6" />
        </td>
        <td>
        	Last Name
        </td>
        <td>
        	<input type="text" name = "lastname" tabindex="7" />
        </td>
   </tr>
   <tr>
    	<td>
        	Gender<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="radio" name="sex" checked value="male" tabindex="8">Male</input>
            <input type="radio" name="sex" value="female" tabindex="9">Female</input>
        </td>
        <td>
        	Nationality<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="nationality" required="required" value="Indian" tabindex="10"/>
        </td>
   </tr>
	   <tr>
    	<td>
        	Father's Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="father" required="required" tabindex="11" />
        </td>
        <td>
			Mother's Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="mother" required="required" tabindex="12" />
        </td>
   </tr>
   <tr>
    	<td>
			Employee Type<span style= "color:red;"> *</span>
       	</td>
        <td>
        	<select name="tstatus" onchange="teaching_handler(this.value);" tabindex="13" >
            	<option value="ft" selected="selected" >Faculty</option>
                <option value="nfta">Non Faculty (Academic)</option>
                <option value="nftn">Non Faculty (Non Academic)</option>
             </select>
        </td>
   		<td>
        	Research Interest
        </td>
        <td>
        	<input type="text" name="research_int" id="res_int_id" tabindex="14"/>
        </td>
   </tr>
   <tr>
	   	<td>
        	Marital Status<span style= "color:red;"> *</span>
        </td>
    	<td>
        	<select name="mstatus" tabindex="15" >
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
			<input type="radio" name="kashmiri" value="yes" tabindex="16"/>Yes
            <input type="radio" name="kashmiri" checked value="no" tabindex="17"/>No
        </td> 
    </tr>
    <tr>
       	<td>
        	Date of Joining<span style= "color:red;"> *</span>
        </td>
    	<td>
			<input type="date" name="entrance_age" value="<?php echo date("Y-m-d",time()+(19800));?>" onchange="retirement_handler()" required="required" tabindex="18" >
        </td>
    	<td>
        	Designation<span style= "color:red;"> *</span>
        </td>
    	<td id="des">
			<select name="designation" tabindex="19">
            	<option value="professor">Professor</option>
            	<option value="associate professor">Associate Professor</option>
            	<option value="assistant professor">Assistant Professor</option>
                <option value="senior lecturer">Senior Lecturer</option>
                <option value="lecturer">Lecturer</option>
                <option value="demonstrator">Demonstrator</option></select>
            </select>
        </td>
    </tr>
    <tr>
    	<td>
        	Post Concerned
        </td>
    	<td>
  	      	<input type="text" name="post" tabindex="20" />
        </td>
    	<td>
        	Department/Section<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<select name="department" id="depts" tabindex="21" >
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
        	<select name="category" tabindex="22">
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
  	      	<input type="text" name="religion" required="required" tabindex="23"/>
        </td>
    </tr>
    <tr>
    	<td>
        	DOB<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="date" name="dob" value="<?php echo date("Y-m-d",time()+(19800));?>" max=<?php echo date("Y-m-d", time()+(19800)); ?>  required="required" tabindex="24" onchange="retirement_handler()" />
        </td>
    	<td>
        	Place of Birth<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="pob" required="required" tabindex="25" />
        </td>
    </tr>
     <tr>
    	<td>
        	Pay Details<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<select name="payscale" tabindex="26"  onchange="payband_handler(this.value);" required >
            	<option value="" disabled selected>Pay Band </option>
				<?php
					$qry=mysql_query("select distinct pay_band,pay_band_description from pay_scales");
					while($row=mysql_fetch_row($qry))
					{
						echo '<option value="'.$row[0].'">'.strtoupper($row[0]).' ('.$row[1].')</option>';
					}
                ?>
            </select>
            <select name="gradepay" tabindex="26" onchange="javascript: document.getElementById('basicpay').style.visibility='visible'"style="visibility:hidden" required >
            </select>
            <input type="text" name="basicpay" id="basicpay" style="visibility:hidden" size="10"  placeholder="Basic Pay" required />
        </td>
        <td>Nature of Employment<span style= "color:red;"> *</span></td>
       	<td>
        	<select name="empnature" tabindex="27" >
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
<?php        
	$date = new DateTime(date("Y-m-d",time()+(19800)));
	$date->modify('+65 year');
?>
        	Date of Retirement
        </td>
        <td>
	       	<input type="date" id="retire" name="retire" value="<?php 	echo $date->format('Y-m-d'); ?>" tabindex="28" />
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
			<textarea name="line11" required="required" tabindex="29"></textarea>
        </td>
    	<td>
        	Address Line 1<span style= "color:red;"> *</span>
        </td>
    	<td>
			<textarea name="line12" required="required" tabindex="36"></textarea>
        </td>
    </tr>
    <tr>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line21" tabindex="30" />
        </td>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line22" tabindex="36" />
        </td>
    </tr>
	<tr>
    	<td>
        	City<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="city1" required="required" tabindex="31"/>
        </td>
        <td>
        	City<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="city2" required="required" tabindex="37"/>
        </td>
    </tr>
    <tr>
    	<td>
        	State<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="state1" required="required" tabindex="32"/>
        </td>
    	<td>
        	State<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="state2" required="required" tabindex="38"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Pin code<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="pincode1" required="required" tabindex="33"/>
        </td>
    	<td>
        	Pin code<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="pincode2" required="required" tabindex="39"/>
        </td>
    </tr>
	    <tr>
    	<td>
        	Country<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="country1" value="India" required="required" tabindex="34"/>
        </td>
    	<td>
        	Country<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="country2" value="India" required="required" tabindex="40"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Contact No<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="contact1" required="required" tabindex="35"/>
        </td>
    	<td>
        	Contact No<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="contact2" required="required" tabindex="41"/>
        </td>
    </tr>
    <tr><th colspan=4></th></tr>
		<tr><td>Hobbies</td>
        	<td><input type="text" name="hobbies" tabindex="42"></td>
            <td>Favourite Past Time</td>
        	<td><input type="text" name="favpast" tabindex="43"></td>
        </tr>
        <tr>
            <td>Fax</td>
        	<td><input type="tel" name="fax" tabindex="44"></td>
            <td>Office No</td>
        	<td><input type="tel" name="office" tabindex="45"></td>
        </tr>
        <tr>
        	<td>Email</td>
        	<td><input type="email" name="email" tabindex="46" ></td>
            <td>Mobile No</td>
        	<td><input type="tel" name="mobile" tabindex="47" ></td>
        </tr>
</table>
<table width="90%">
        <tr><th colspan=2 >Photograph</th></tr><tr></tr>
        <tr  height="150">
            <td width="145" id="preview"><?php echo '<img src="Images/noProfileImage.png" id="view_photo" width="145" height="150"/>'; ?></td>
        	<td align="center">Click on choose file to select picture<span style= "color:red;"> *</span><br>
            	<input type="file" name="photo" id="photo" required="required" tabindex="48" ><br>
                <input type="button" value="preview" onClick="preview_pic();" tabindex="49">	
            </td>
		</tr>
</table>
<input type = "submit" value="Next" tabindex="50"/>
</form>

<?php
	mysql_close();
	drawFooter();
?>