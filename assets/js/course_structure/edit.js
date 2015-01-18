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
				alert(xmlhttp.responseText);
				//document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
			}
		}
		
		//subjectdetails[6];
		subjectdetails['id'] = subjectid;
		subjectdetails['name'] = subjectname;
		subjectdetails['L'] = subjectL;
		subjectdetails['T'] = subjectT;
		subjectdetails['P'] = subjectP;
		subjectdetails['credithours'] = subjectcredithours;
		subjectdetails['contacthours'] = subjectcontacthours;
		
		alert(subjectdetails['name']);
		xmlhttp.open("GET",js_site_url("course_structure/edit/UpdateCourseStructure/"+subjectdetails),true);
		xmlhttp.send();
		
		$("#editbutton_"+semester+"_"+seq_no).val("Edit");	
	}
	
}
function DeleteSemester(semester,aggr_id)
{	
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
			alert("Deleted Successfully");
			document.location.href = js_site_url("course_structure/edit");
		}
	}
	
	xmlhttp.open("GET",js_site_url("course_structure/edit/DeleteCourseStructure/"+semester+"/"+aggr_id),true);
	xmlhttp.send()	
}