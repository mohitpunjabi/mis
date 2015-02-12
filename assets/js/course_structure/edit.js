$box_form = $("#box_form");

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
		//alert($("#editbutton_"+semester+"_"+seq_no).val());
		$("#editbutton_"+semester+"_"+seq_no).val("Save");	
	}
	else if($("#editbutton_"+semester+"_"+seq_no).val() == "Save")
	{
		$subjectid = $("[name='subjectid_"+semester+"_"+seq_no+"']");
		$subjectname = $("[name='subjectname_"+semester+"_"+seq_no+"']");
		$subjectL = $("[name='subjectL_"+semester+"_"+seq_no+"']");
		$subjectT = $("[name='subjectT_"+semester+"_"+seq_no+"']");
		$subjectP = $("[name='subjectP_"+semester+"_"+seq_no+"']");
		$subjectcredithours = $("[name='subjectcredithours_"+semester+"_"+seq_no+"']");
		$subjectcontacthours = $("[name='subjectcontacthours_"+semester+"_"+seq_no+"']");
		
		$subjectid.prop("disabled",true);
		$subjectname.prop("disabled",true);
		$subjectL.prop("disabled",true);
		$subjectT.prop("disabled",true);
		$subjectP.prop("disabled",true);
		$subjectcredithours.prop("disabled",true);
		$subjectcontacthours.prop("disabled",true);
		var $subjectdetails = {'id':$subjectid.attr('id'),'subject_id':$subjectid.val(),'name':$subjectname.val(),'L':$subjectL.val(),'T':$subjectT.val(),'P':$subjectP.val(),'credit_hours':$subjectcredithours.val(),'contacthours':$subjectcontacthours.val()};
		$subjectdetails = JSON.stringify($subjectdetails);
		
		$box_form.showLoading();
		
		$.ajax({url:site_url("course_structure/edit/Json_UpdateCourseStructure/"),
			success:function(data){
				alert("Updated Successfully");
				$box_form.hideLoading();
			},
			type:"POST",
			data:$subjectdetails,
			fail:function(error){
				$box_form.hideLoading();
				console.log(error);
			}
		});
		$("#editbutton_"+semester+"_"+seq_no).val("Edit");	
	}
	
}
function DeleteSemester(semester,aggr_id)
{	
	$box_form = $("#box_form_"+semester);
	if(confirm("Delete Course Structure for Semester "+semester))
	{
		$box_form.showLoading();
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
				$box_form.hideLoading();
				//alert("Deleted Successfully");
				document.location.href = site_url("course_structure/edit/EditCourseStructure  ");
			}
		}	
		xmlhttp.open("GET",site_url("course_structure/edit/DeleteCourseStructure/"+semester+"/"+aggr_id),true);
		xmlhttp.send()	
	}
}