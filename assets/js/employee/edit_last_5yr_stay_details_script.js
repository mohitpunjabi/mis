
	function onclick_add()
	{
		var row=document.getElementById("tableid").rows;
		var f=document.getElementsByName("from5[]")[row.length-3].value;
		var t=document.getElementsByName("to5[]")[row.length-3].value;
		var a=document.getElementsByName("addr5[]")[row.length-3].value;
		var d=document.getElementsByName("dist5[]")[row.length-3].value;

		if(f=="" || t=="" || a=="" || d=="" )
			alert('Sno '+(row.length-2)+': Please fill up all the fields !!');
		else if((new Date(f).getTime()) > (new Date(t).getTime()))
			alert('Sno '+(row.length-2)+': Error : Fill the period of entering and leaving correctly !!');
		else
		{
			var newrow=document.getElementById("tableid").insertRow(row.length);
			newrow.innerHTML=document.getElementById("addrow").innerHTML;
			var newid=newrow.cells[0].id="sno"+Number(row.length-3);
			document.getElementById(newid).innerHTML=row.length-2;
		}
	}

	function validate()
	{
		var n_row=document.getElementById("tableid").rows.length;
		var i=0;
		for(i=0;i<n_row-3;i++)
		{
			var f=document.getElementsByName("from5[]")[i].value;
			var t=document.getElementsByName("to5[]")[i].value;
			var a=document.getElementsByName("addr5[]")[i].value;
			var d=document.getElementsByName("dist5[]")[i].value;

			if(f=="" || t=="" || a=="" || d=="" )
			{
				alert('Sno '+(i+1)+' : Please fill up all the fields !!');
				return false;
			}
			else if((new Date(f).getTime()) > (new Date(t).getTime()))
			{
				alert('Sno '+(i+1)+' : Fill the period correctly !!');
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
		var f=document.getElementsByName("from5[]")[row.length-3].value;
		var t=document.getElementsByName("to5[]")[row.length-3].value;
		var a=document.getElementsByName("addr5[]")[row.length-3].value;
		var d=document.getElementsByName("dist5[]")[row.length-3].value;

		if(f!="" && t!="" && (new Date(f).getTime()) > (new Date(t).getTime()))
		{
			alert("!! Error : Fill the period of entering and leaving correctly !!");
			return false;
		}
		else if((f=="" && t=="" && a=="" && d=="")	||	(f!="" && t!="" && a!="" && d!=""))
			return true;
		else
		{
			alert("!! Please fill up all the fields !!");
			return false;
		}
	}

	function onclick_delete(i)
	{
		var result=confirm("Do you really want to delete ?");
		if(result==true)
		{
			var table=document.getElementById('tbl5');
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
			xmlhttp.open("POST",js_site_url("employee/emp_ajax/delete_record/5/"+i),true);
			xmlhttp.send();
		}
	}

	function onclick_edit(i,from,to,maxdate,mindate)
	{
		var row=document.getElementsByName("row[]")[i-1];
		var x = '<form action="'+js_site_url('employee/edit/update_old_last_5yr_stay_details/'+i)+'" onSubmit="return onclick_save('+i+');" method="post" accept-charset="utf-8" >';
		x+='<table><tr>';
		x+='<th>From</th><td><input type="date" name="from'+i+'" id="from'+i+'" value="'+from+'" max='+maxdate+' min='+mindate+' ></td></tr>';
		x+='<tr><th>To</th><td><input type="date" name="to'+i+'" id="to'+i+'" value="'+to+'" max='+maxdate+' min='+mindate+' ></td></tr>';
		x+='<tr><th>Residential Address</th><td><textarea rows=4 cols=30 name="addr'+i+'" id="addr'+i+'" >'+row.cells[3].innerHTML+'</textarea></td></tr>';
		x+='<tr><th>Name of District Headquarters</th><td align="center"><input type="text" size=30 name="dist'+i+'" id="dist'+i+'" value="'+row.cells[4].innerHTML.toLowerCase()+'" ></td></tr>';
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
		var f=document.getElementById("from"+i).value;
		var t=document.getElementById("to"+i).value;
		var a=document.getElementById("addr"+i).value;
		var d=document.getElementById("dist"+i).value;

		if(f=="" || t=="" || a=="" || d=="" )
			alert("!! Please fill up all the fields !!");
		else if((new Date(f).getTime()) > (new Date(t).getTime()))
			alert("!! Error : Fill the period of entering and leaving correctly !!");
		else
		{
			return true;
		}
		return false;
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