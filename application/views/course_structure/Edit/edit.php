<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}
	input[type="text"]
	{
		width:30px;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>
<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center><h3>Course Structure for  
  <?php
 
    $course_name=$CS_session['course_name'];
    $course_duration=$CS_session['duration'];
    $branch_name=$CS_session['branch_name'];
    $aggr_id= $CS_session['aggr_id'];
    $session=$CS_session['session'];
    echo $CS_session['course_name']." ";
    echo "(".$branch_name.")"."<br>";
    echo "Applicable for the Session "."20".$session[0].$session[1]."-20".$session[2].$session[3];
  ?>
  </h3>
  <?php
  if($CS_session["semester"] != 0)
	{
		$start_semester = $CS_session["semester"];
		$course_duration = 1;
		$end_semester = $start_semester;
	}
	else
	{
		$start_semester = 1;
		$end_semester = 2*$course_duration;
	}	
      for($semester=$start_semester;$semester<=$end_semester;$semester++)
      {
        echo "<h3>Subjects for Semester". $semester."<br></h3>";
  ?>
  <table border="1">
    <tr>
      <th style = "width:15px;">Sl. No</th>
      <th style = "width:70px;">Subject ID</th>
      <th style = "width:80px;">Subject Name</th>
      <th>Lecture</th>
      <th>Tutorial</th>
      <th>Practical</th>
      <th style = "width:15px;">Credit Hours</th>
      <th style = "width:15px;">Contact Hours</th>
      <th>Elective</th>
      <th style = "width:15px;">Type</th>
      <th style = "width:15px;">Edit</th>
    </tr>
  		<?php
        for($i=1;$i<=$subjects["count"][$semester];$i++)
        {
            if(isset($subjects["group_details"][$semester][$i]->group_id))
			{
				echo "<tr><td colspan='10' style = 'text-align:center;font-size:16px;font-weight:bold;'>".$subjects["group_details"][$semester][$i]->elective_name."
				</td></tr>";
				$group_id = $subjects["group_details"][$semester][$i]->group_id;
				for($j = 0;$j<$subjects["elective_count"][$group_id];$j++)
				{
					
		?>
        			<?php
						$seq_no = intval($i)+intval($j);
                    	echo 
						'<tr>
							<td>';
								echo $subjects["sequence_no"][$semester][$i+$j];
								echo '
							</td>
							<td>
								<input disabled style = "width:70px;" type = "text" name = "subjectid_'.$semester.'_'.$seq_no.'" value = "'.$subjects[
								"subject_details"][$semester][$i+$j]->subject_id.'"></input>
							</td>
							<td>
								<input disabled style = "width:120px;" type = "text" name = "subjectname_'.$semester.'_'.$seq_no.'" value = "'.$subjects[
								"subject_details"][$semester][$i+$j]->name.'"></input>
							</td>
							<td>
								<input disabled type = "text" name = "subjectL_'.$semester.'_'.$seq_no.'" value = "'.$subjects["subject_details"][$semester][$i+$j]
								->lecture.'"></input>
							</td>
							<td>
								<input disabled type = "text" name = "subjectT_'.$semester.'_'.$seq_no.'" value = "'.$subjects["subject_details"][$semester][$i+$j]
								->tutorial.'" ></input>
							</td>
							<td>
								<input disabled type = "text" name = "subjectP_'.$semester.'_'.$seq_no.'" value = "'.$subjects["subject_details"][$semester][$i+$j]
								->practical.'" ></input>
							</td>
							<td>
								<input disabled type = "text" name = "subjectcredithours_'.$semester.'_'.$seq_no.'" value = "'.$subjects["subject_details"][
								$semester][$i+$j]->credit_hours.'" ></input>
							</td>
							<td>
								<input disabled type = "text" name = "subjectcontacthours_'.$semester.'_'.$seq_no.'" value = "'.$subjects["subject_details"][
								$semester][$i+$j]->contact_hours.'"></input>
							</td>
							<td>';
                             
                                  if($subjects["subject_details"][$semester][$i+$j]->elective==0) 
                                     echo "No";
                                  else 
                                    echo "Yes";
						echo '
                        	</td>
							<td>';
                              if($subjects["subject_details"][$semester][$i+$j]->type=="Theory") echo "Theory";
                              if($subjects["subject_details"][$semester][$i+$j]->type=="Practical") echo "Practical";
                              if($subjects["subject_details"][$semester][$i+$j]->type=="Sessional") echo "Sessional";
                              if($subjects["subject_details"][$semester][$i+$j]->type =="Non-Contact") echo "Non-Contact";
						echo '
                        	</td>	
							<td>';
								$seq_no = intval($i)+intval($j);
						echo '
								<input id = "editbutton_'.$semester.'_'.$seq_no.'" type = "button" name = "editbutton()" value = "Edit" style = "width:50px;" 
								onclick = EditSubject("'.$semester.'","'.$seq_no.'")></input>
							</td>		
						</tr>';	
				}//for closed..
				$i = $j+$i-1;
				}//if closed.
				else
				{
				echo '
					<tr>
						<td>';
							echo $subjects["sequence_no"][$semester][$i];
							echo '
						</td>
						<td>
							<input disabled style = "width:70px;" type = "text" name = "subjectid_'.$semester.'_'.$i.'" value = "'.$subjects["subject_details"][
							$semester][$i]->subject_id.'" ></input>
						</td>
						<td>
							<input disabled style = "width:120px;" type = "text" name = "subjectname_'.$semester.'_'.$i.'" value = "'.$subjects["subject_details"][
							$semester][$i]->name.'"></input>
						</td>
						<td>
							<input disabled type = "text" name = "subjectL_'.$semester.'_'.$i.'" value = "'.$subjects["subject_details"][$semester][$i]->lecture.'">
							</input>
						</td>
						<td>
							<input disabled type = "text" name = "subjectT_'.$semester.'_'.$i.'" vlaue = "'.$subjects["subject_details"][$semester][$i]->tutorial.
							'"></input>
						</td>
						<td>
							<input disabled type = "text" name = "subjectP_'.$semester.'_'.$i.'" value = "'.$subjects["subject_details"][$semester][$i]->practical.
							'"></input>
						</td>
						<td>
							<input disabled type = "text" name = "subjectcredithours_'.$semester.'_'.$i.'" value = "'.$subjects["subject_details"][$semester][$i]->
							credit_hours.'"></input>
						</td>
						<td>
							<input disabled type = "text" name = "subjectcontacthours_'.$semester.'_'.$i.'" value = "'.$subjects["subject_details"][$semester][$i]->
							contact_hours.'"></input>
						</td>
						<td>';
						 
							  if($subjects["subject_details"][$semester][$i]->elective==0) 
								 echo "No";
							  else 
								echo "Yes";
					echo '
						</td>
						<td>';
						  if($subjects["subject_details"][$semester][$i]->type=="Theory") echo "Theory";
						  if($subjects["subject_details"][$semester][$i]->type=="Practical") echo "Practical";
						  if($subjects["subject_details"][$semester][$i]->type=="Sessional") echo "Sessional";
						  if($subjects["subject_details"][$semester][$i]->type =="Non-Contact") echo "Non-Contact";
					echo '
						</td>	
						<td>
								<input id = "editbutton_'.$semester.'_'.$i.'" type = "button" name = "editbutton()" value = "Edit" style = "width:50px;" onclick = 
								EditSubject("'.$semester.'","'.$i.'")></input>
						</td>		
					</tr>';
				}//else closed
           }//inner for loop 
		   $aggr_id = $CS_session['aggr_id'];
	echo '
					<tr>
						<td>
							<input type = "button" onclick = DeleteSemester("'.$semester.'","'.$aggr_id.'") value = "Delete" ></input>
						</td>
					</tr>
  	</table>';
      }
  ?>
  </table>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<script>
function EditSubject(semester,seq_no)
{
	if($("#editbutton_"+semester+"_"+seq_no).val() == "Edit")
	{
		$("[name='subjectid_"+semester+"_"+seq_no+"']").prop('disabled',false);
		$("[name='subjectname_"+semester+"_"+seq_no+"']").prop('disabled',false);
		$("[name='subjectL_"+semester+"_"+seq_no+"']").prop('disabled',false);
		$("[name='subjectT_"+semester+"_"+seq_no+"']").prop('disabled',false);
		$("[name='subjectP_"+semester+"_"+seq_no+"']").prop('disabled',false);
		$("[name='subjectcredithours_"+semester+"_"+seq_no+"']").prop('disabled',false);
		$("[name='subjectcontacthours_"+semester+"_"+seq_no+"']").prop('disabled',false);
		$("#editbutton_"+semester+"_"+seq_no).val("Save");	
	}
	else if($("#editbutton_"+semester+"_"+seq_no).val() == "Save")
	{
		var subjectid = $("[name='subjectid_"+semester+"_"+seq_no+"']").prop('disabled',true);
		var subjectname = $("[name='subjectname_"+semester+"_"+seq_no+"']").prop('disabled',true);
		var subjectL = $("[name='subjectL_"+semester+"_"+seq_no+"']").prop('disabled',true);
		var subjectT = $("[name='subjectT_"+semester+"_"+seq_no+"']").prop('disabled',true);
		var subjectP = $("[name='subjectP_"+semester+"_"+seq_no+"']").prop('disabled',true);
		var subjectcredithours = $("[name='subjectcredithours_"+semester+"_"+seq_no+"']").prop('disabled',true);
		var subjectcontacthours = $("[name='subjectcontacthours_"+semester+"_"+seq_no+"']").prop('disabled',true);
		
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
				alert("updated successfully");
				//document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
			}
		}
		var subjectdetails = [];
		subjectdetails['id'] = subjectid;
		subjectdetails['name'] = subjectname;
		subjectdetails['L'] = subjectL;
		subjectdetails['T'] = subjectT;
		subjectdetails['P'] = subjectP;
		subjectdetails['credithours'] = subjectcredithours;
		subjectdetails['contacthours'] = subjectcontacthours;
		xmlhttp.open("GET","edit/UpdateCourseStructure/"+subjectdetails,true);
		xmlhttp.send();
		
		$("#editbutton_"+semester+"_"+seq_no).val("Edit");	
	}
	
}
function DeleteSemester(semester,aggr_id)
{
	alert("edit/DeleteCourseStructure/"+semester+"/"+aggr_id);
	//alert(aggr_id);
	
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
			alert("Deleted");
			alert(xmlhttp.responseText);
			//document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
		}
	}
	//var coursestructure_details = [];
	//coursestructure_details['semester'] = semester;
	//coursestructure_details['aggr_id'] = aggr_id;
	
	xmlhttp.open("GET","edit/DeleteCourseStructure/"+semester+"/"+aggr_id,true);
	xmlhttp.send();
	
	
}
	//alert("hii");	

</script>
</body>
</html>