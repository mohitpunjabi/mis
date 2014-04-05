<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/Layout.php");
	auth('deo');
	require_once("connectDB.php");
	
	drawHeader("Add Candidate Details");
	if(!(isset($_SESSION['STUDENT_CURRSTEP']) && $_SESSION['STUDENT_CURRSTEP'] == 0))
		header("Location: add_student.php");
	
	if(isset($_GET['error']))
	{
		drawNotification($_GET['error'],"", "error");
	}
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

	
	function corrAddr()
    {
        var x=document.getElementById("corr_addr");
        var y=document.getElementById("correspondence_addr");
        if(!y.checked)
        {
            x.style.display='block';
            //document.getElementById("line13").='true';
        }
        else
        {
            x.style.display='none';
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
			m.disabled=true;
			f.disabled=true;
			
		}
		else
		{
		m.disabled=false;
		f.disabled=false;
		g.disabled=true;
		}
		
	}

    function options_of_branches()
    {
        var tr=document.getElementById('branch');
        var dept=document.getElementById('depts').value;
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
                tr.innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","AJAX_branches_by_dept.php?dept="+dept,true);
        xmlhttp.send();
        tr.innerHTML = "<td><i class=\"loading\"></i></td>";
    }

    function options_of_courses()
    {
        //set_id_of_branch();
        var tr=document.getElementById('course');
        var branch=document.getElementById('branch_id').value;
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
                tr.innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","AJAX_courses_by_branch.php?branch="+branch,true);
        xmlhttp.send();
        tr.innerHTML = "<td><i class=\"loading\"></i></td>";
    }

    function set_id_of_branch()
    {
        var branch_id=document.getElementById('branch_id').value;
        document.getElementById('id_of_branch').value=branch_id;
        return 0;
    }

    function set_id_of_course()
    {
        var course_id=document.getElementById('course_id').value;
        document.getElementById('id_of_course').value=course_id;
    }

</script>


<h1>Step 1 :Fill up the details</h1>
<form method = "post" action=  "entrySQL1.php" enctype="multipart/form-data" onsubmit="return image_validation();" >
<!--input type="text" name="id_of_course" id="id_of_course"/>
<input type="text" name="id_of_branch" id="id_of_branch"/-->
<table width='90%'>
	<th colspan=4></th>
    <tr>
    	<td width='15%'>
        	Admission No.
        </td>
        <td width='35%'>
        	<input type="text" name="stu_id" required="required" /> 
            <!-- <input type="button" value="Go" id="fetch_id_btn" />-->
        </td>
			<td>
        	Date of Admission
        </td>
    	<td>
			<input type="date" name="entrance_age" value="<?php echo date("Y-m-d",time()+(19800));?>" required="required" >
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
            Father's Name
        </td>
        <td>
            <input type="text" id="father_name" name="father_name"  />
        </td>
        <td>
            Mother's Name
        </td>
        <td>
            <input type="text" id="mother_name" name="mother_name" />
        </td>
   </tr>
    <tr>
	    <td>
            
			Guardian's Name<br/>
        </td>
        <td>
             <input type="text" id="guardian_name" name="guardian_name" disabled />
			 <input style="margin-top:2.5px;" type='checkbox' id ="depends_on"  name="depends_on"  onchange="depends_on_whom()"/>
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
  	      	<input type="date" name="dob" value="<?php echo date("Y-m-d",time()+(19800));?>" max=<?php echo date("Y-m-d", time()+(19800)); ?> >
        </td>
		<td>
        	Place of Birth
        </td>
    	<td>
  	      	<input type="text" name="pob" />
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
			<input type="text" name="identification_mark" required="required"/>
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
  	      	<input type="text" name="religion" />
        </td>
		
    </tr>
    <tr>
    	 <td>
            Nationality
        </td>
        <td>
            <input type="text" name="nationality" required="required" value="Indian"/>
        </td>
		<td>
        	Department
        </td>
    	<td>
  	      	<select name="department" id="depts" onchange="options_of_branches()">
            	<?php
                    echo '<option disabled="disabled" selected>Select Department</option>';
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
            Branch
        </td>
        <td id="branch">
            <!--select name="branch">
                <option disabled="disabled" selected>Select Branches</option>
            </select-->
        </td>
        <td>
            Course
        </td>
        <td id="course">
            <!--select name="course">
                <option disabled="disabled" selected>Select Course</option>
            </select-->
        </td>
    </tr>
    <!--tr >
    </tr!-->
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
  	      	<input type="text" name="line11" required="required" tabindex="10" />
        </td>
    	<td>
        	Address Line 1
        </td>
    	<td>
  	      	<input type="text" name="line12" required="required" tabindex="17" />
        </td>
    </tr>
    <tr>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line21" required="required" tabindex="11"/>
        </td>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line22" tabindex="18" required="required"/>
        </td>
    </tr>
	<tr>
    	<td>
        	City
        </td>
    	<td>
  	      	<input type="text" name="city1" tabindex="12" required="required"/>
        </td>
        <td>
        	City
        </td>
    	<td>
  	      	<input type="text" name="city2"  tabindex="18" required="required"/>
        </td>
    </tr>
    <tr>
    	<td>
        	State
        </td>
    	<td>
  	      	<input type="text" name="state1" tabindex="13" required="required"/>
        </td>
    	<td>
        	State
        </td>
    	<td>
  	      	<input type="text" name="state2" tabindex="19" required="required"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Pin code
        </td>
    	<td>
  	      	<input type="tel" name="pincode1" tabindex="14" required="required"/>
        </td>
    	<td>
        	Pin code
        </td>
    	<td>
  	      	<input type="tel" name="pincode2" tabindex="19" required="required"/>
        </td>
    </tr>
	<tr>
    	<td>
        	Country
        </td>
    	<td>
  	      	<input type="text"  tabindex="15" name="country1" required="required"/>
        </td>
    	<td>
        	Country
        </td>
    	<td>
  	      	<input type="text" name="country2" tabindex="20" required="required"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Contact No
        </td>
    	<td>
  	      	<input type="tel"  tabindex="16" name="contact1" required="required"/>
        </td>
    	<td>
        	Contact No
        </td>
    	<td>
  	      	<input type="tel" name="contact2"  tabindex="21" required="required"/>
        </td>
    </tr>
    <tr>
	<td colspan=4 align='center'>
	<input type='checkbox' id ="correspondence_addr"  name="correspondence_addr" checked="checked" onchange="corrAddr()"/> 
	<b>Correspondence address same as Permanent address.</b></td>
	</tr>

	<tr >
		<td colspan='4'><div id="corr_addr" style="display:none;">
			<table   width='100%' >
				<th colspan='4'>Corresspondence Address</th>
		
				<tr >
					<td  align="right">
						Address Line 1
					</td>
					<td colspan="2">
						<input type="text" name="line13" />
					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						Address Line 2
					</td>
					<td colspan="2">
						<input type="text" name="line23" />
					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						City
					</td>
					<td colspan="2">
						<input type="text" name="city3" />
					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						State
					</td>
					<td colspan="2">
						<input type="text" name="state3" />
					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						Pin code
					</td>
					<td colspan="2">
						<input type="tel" name="pincode3" />
					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						Country
					</td>
					<td colspan="2">
						<input type="text" name="country3" />
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right">
						Contact No
					</td>
					<td colspan="2">
						<input type="tel" name="contact3" />
					</td>
				</tr>
 
			</table>
		</div></td>
	</tr>
    
	<tr><th colspan=4></th></tr>
        <tr>
        	<td>Email</td>
        	<td><input type="email" name="email" required="required"></td>
            <td>Mobile No</td>
        	<td><input type="tel" name="mobile" required="required"></td>
        </tr>
		<tr>
        	<td>Hobbies</td>
        	<td><input type="text" name="hobbies" ></td>
            <td>Favourite Pass Time</td>
        	<td><input type="text" name="favpast" ></td>
        </tr>
</table>
<table width="90%">
        <tr><th colspan=2 >Photograph</th></tr><tr></tr>
        <tr  height="150">
            <td width="145" id="preview"><?php echo '<img src="Images/noProfileImage.png" id="view_photo" width="145" height="150"/>'; ?></td>
        	<td align="center">Click on choose file to select picture<br>
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
