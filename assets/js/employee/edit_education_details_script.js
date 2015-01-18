
	function onclick_add()
	{
		var row=document.getElementById("tableid").rows;
		var e=document.getElementsByName("exam4[]")[row.length-2].value;
		var b=document.getElementsByName("branch4[]")[row.length-2].value;
		var c=document.getElementsByName("clgname4[]")[row.length-2].value;
		var y=document.getElementsByName("year4[]")[row.length-2].value;
		var g=document.getElementsByName("grade4[]")[row.length-2].value;
		var d=document.getElementsByName("div4[]")[row.length-2].value;

		if(e=="" || b=="" || c=="" || y=="" || g=="" || d=="" )
			alert('Sno '+(row.length-1)+' : Please fill up all the fields !!');
		else
		{
			var newrow=document.getElementById("tableid").insertRow(row.length);
			newrow.innerHTML=document.getElementById("addrow").innerHTML;
			var newid=newrow.cells[0].id="sno"+Number(row.length-2);
			document.getElementById(newid).innerHTML=row.length-1;
		}
	}

	function validate()
	{
		var n_row=document.getElementById("tableid").rows.length;
		var i=0;
		for(i=0;i<n_row-2;i++)
		{
			var e=document.getElementsByName("exam4[]")[i].value;
			var b=document.getElementsByName("branch4[]")[i].value;
			var c=document.getElementsByName("clgname4[]")[i].value;
			var y=document.getElementsByName("year4[]")[i].value;
			var g=document.getElementsByName("grade4[]")[i].value;
			var d=document.getElementsByName("div4[]")[i].value;

			if(e=="" || b=="" || c=="" || y=="" || g=="" || d=="" )
			{
				alert('Sno '+(i+1)+': Please fill up all the fields !!');
				return false;
			}
		}
		return true;
	}

	function onclick_submit()
	{
		if(!validate())			//validation of rows except last one
			return false;
		//validation of last row
		var row=document.getElementById("tableid").rows;
		var e=document.getElementsByName("exam4[]")[row.length-2].value;
		var b=document.getElementsByName("branch4[]")[row.length-2].value;
		var c=document.getElementsByName("clgname4[]")[row.length-2].value;
		var y=document.getElementsByName("year4[]")[row.length-2].value;
		var g=document.getElementsByName("grade4[]")[row.length-2].value;
		var d=document.getElementsByName("div4[]")[row.length-2].value;

		if((e=="" && b=="" && c=="" && y=="" && g=="" && d=="" && row.length!=2)	||	(e!="" && b!="" && c!="" && y!="" && g!="" && d!=""))
			return true;
		else
		{
			alert('Sno '+(row.length-1)+' : Please fill up all the fields !!');
			return false;
		}
	}

	function onclick_delete(i)
	{
		var result=confirm("Do you really want to delete ?");
		if(result==true)
		{
			var table=document.getElementById('tbl4');
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
				    table.innerHTML=xmlhttp.responseText;
			    }
		  	}
		  	xmlhttp.open("POST",site_url("employee/emp_ajax/delete_record/4/"+i),true);
			xmlhttp.send();
		}
	}

	function onclick_edit(i)
	{
		var row=document.getElementsByName("row[]")[i-1];
		var x = '<form action="'+site_url('employee/edit/update_old_education_details/'+i)+'" onSubmit="return onclick_save('+i+');" method="post" accept-charset="utf-8" >';
		x+='<table><tr>';
		x+='<th>Examination</th><td><select name="exam'+i+'" id="exam'+i+'" onChange="examination_editbtn_handler('+i+');" ><option disabled value="" >Select Examination</option><option value="non-matric" '+((row.cells[1].innerHTML.toLowerCase() == 'non-matric')? 'selected':'')+'>Non-Matric</option><option value="matric" '+((row.cells[1].innerHTML.toLowerCase() == 'matric')? 'selected':'')+'>Matric</option><option value="intermediate" '+((row.cells[1].innerHTML.toLowerCase() == 'intermediate')? 'selected':'')+'>Intermediate</option><option value="graduation" '+((row.cells[1].innerHTML.toLowerCase() == 'graduation')? 'selected':'')+'>Graduation</option><option value="post-graduation" '+((row.cells[1].innerHTML.toLowerCase() == 'post-graduation')? 'selected':'')+'>Post Graduation</option><option value="doctorate" '+((row.cells[1].innerHTML.toLowerCase() == 'doctorate')? 'selected':'')+'>Dropped Away</option><option value="post-doctorate" '+((row.cells[1].innerHTML.toLowerCase() == 'post-doctorate')? 'selected':'')+'>Post Doctorate</option><option value="others" '+((row.cells[1].innerHTML.toLowerCase() == 'others')? 'selected':'')+'>Others</option></select></td></tr>';
		x+='<tr><th>Course(Specialization)</th><td><input type="text" name="branch'+i+'" id="branch'+i+'" value="'+row.cells[2].innerHTML.toLowerCase()+'" /></td></tr>';
		x+='<tr><th>College/University/Institute</th><td><input type="text" name="clgname'+i+'" id="clgname'+i+'" value="'+row.cells[3].innerHTML.toLowerCase()+'" /></td></tr>';
		x+='<tr><th>Year</th><td><input type="text" name="year'+i+'" id="year'+i+'" value="'+row.cells[4].innerHTML.toLowerCase()+'" /></td></tr>';
		x+='<tr><th>Percentage/Grade</th><td><input type="text" name="grade'+i+'" id="grade'+i+'" value="'+row.cells[5].innerHTML.toLowerCase()+'" /></td></tr>';
		x+='<tr><th>Class/Division</th><td><input type="text" name="div'+i+'" id="div'+i+'" value="'+row.cells[6].innerHTML.toLowerCase()+'" /></td></tr>';
		x+='<tr style="background:#00092a;" align="center"><td colspan=2><input type="submit" name="save" value="Save" /><input type="button" name="cancel" value="Cancel" onClick="closeframe();" />';
		x+='</td></tr></table>';
		x+='</form>';

		var coverdiv = '<div id="coverdiv" style="height: 100%; width: 100%; top: 0px; left: 0px; opacity: 0.5; position: fixed; z-index: 2000; background: rgb(170, 170, 170);"></div>';
		var formdiv = '<div id="formdiv" style="height: auto; width: auto; top: 20%; left: 35%; display: block; position: absolute; z-index: 2001; background: #FEFEFE;">';
		formdiv+=x+'</div>';
		var div = document.createElement('div');
		div.setAttribute("id", "edit_div");
		div.innerHTML=coverdiv+formdiv;
		document.body.appendChild(div);
	}

	function onclick_save(i)
	{
		var e=document.getElementById("exam"+i).value;
		var b=document.getElementById("branch"+i).value;
		var c=document.getElementById("clgname"+i).value;
		var y=document.getElementById("year"+i).value;
		var g=document.getElementById("grade"+i).value;
		var d=document.getElementById("div"+i).value;

		if(e=="" || b=="" || c=="" || y=="" || g=="" || d=="" )
			alert("!! Please fill up all the fields !!");
		else
		{
			return true;
		}
		return false
	}

	function examination_editbtn_handler(i)
	{
		var exam=document.getElementById("exam"+i).value;
		if(exam=="non-matric")
		{
			document.getElementById("branch"+i).value="n/a";
			document.getElementById("clgname"+i).value="n/a";
			document.getElementById("year"+i).value="n/a";
			document.getElementById("grade"+i).value="n/a";
			document.getElementById("div"+i).value="n/a";
		}
	}

	function examination_handler(obj)
	{
		var row=document.getElementById("tableid").rows.length;
		var i=0;
		for(i=0;i<row;i++)
		{
			var exam=document.getElementsByName("exam4[]")[i].value;
			if(exam=="non-matric")
			{
				document.getElementsByName("branch4[]")[i].value="n/a";
				document.getElementsByName("clgname4[]")[i].value="n/a";
				document.getElementsByName("year4[]")[i].value="n/a";
				document.getElementsByName("grade4[]")[i].value="n/a";
				document.getElementsByName("div4[]")[i].value="n/a";
			}
		}
	}

	function closeframe()
	{
		$('#edit_div').remove();
	}

	function onclick_add_new()
	{
		document.getElementById('add_new').style.display='none';
		document.getElementById('addnew').style.display='block';
	}