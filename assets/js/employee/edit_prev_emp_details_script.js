
	function js_base_url()
	{
		return window.location.protocol+'//'+window.location.hostname+'/index.php/';
	}

	function onclick_add()
	{
		var row=document.getElementById("tableid").rows;
		var d=document.getElementsByName("designation2[]")[row.length-3].value;
		var f=document.getElementsByName("from2[]")[row.length-3].value;
		var t=document.getElementsByName("to2[]")[row.length-3].value;
		var a=document.getElementsByName("addr2[]")[row.length-3].value;
		var r=document.getElementsByName("payscale2[]")[row.length-3].value;


		if(d=="" || f=="" || t=="" || a=="" || r=="")
			alert('Sno '+(row.length-2)+': Please fill up all the fields !!');
		else if((new Date(f).getTime()) > (new Date(t).getTime()))
			alert('Sno '+(row.length-2)+': Fill the period correctly !!');
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
			var d=document.getElementsByName("designation2[]")[i].value;
			var f=document.getElementsByName("from2[]")[i].value;
			var t=document.getElementsByName("to2[]")[i].value;
			var a=document.getElementsByName("addr2[]")[i].value;
			var r=document.getElementsByName("payscale2[]")[i].value;

			if(d=="" || f=="" || t=="" || a=="" || r=="")
			{
				alert('Sno '+(i+1)+': Please fill up all the fields !!');
				return false;
			}
			else if((new Date(f).getTime()) > (new Date(t).getTime()))
			{
				alert('Sno '+(i+1)+': Fill the period correctly !!');
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
		var d=document.getElementsByName("designation2[]")[row.length-3].value;
		var f=document.getElementsByName("from2[]")[row.length-3].value;
		var t=document.getElementsByName("to2[]")[row.length-3].value;
		var a=document.getElementsByName("addr2[]")[row.length-3].value;
		var r=document.getElementsByName("payscale2[]")[row.length-3].value;

		if(f!="" && t!="" && (new Date(f).getTime()) > (new Date(t).getTime()))
		{
			alert('Sno '+(row.length-2)+': Error : Fill the period of entering and leaving correctly !!');
			return false;
		}
		else if((d=="" && f=="" && t=="" && a=="" && r=="")||(d!="" && f!="" && t!="" && a!="" && r!=""))
			return true;
		else
		{
			alert('Sno '+(row.length-2)+': Please fill up all the fields !!');
			return false;
		}
	}

	function onclick_delete(i)
	{
		var result=confirm("Do you really want to delete ?");
		if(result==true)
		{
			var table=document.getElementById('tbl2');
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
		  	xmlhttp.open("POST",js_base_url()+"employee/emp_ajax/delete_record/2/"+i,true);
			xmlhttp.send();
		}
	}

	function closeframe()
	{
		$('#edit_div').remove();
	}

	function onclick_edit(i, from, to, date)
	{
		var row = document.getElementsByName("row[]")[i-1];
		var x = '<form action="'+js_base_url()+'employee/edit/update_old_prev_emp_details/'+i+'" onSubmit="return onclick_save('+i+');" method="post" accept-charset="utf-8" >';
		x+='<table><tr>';
		x+='<th>Full address of Employer</th><td><textarea rows=2 cols=50 name="addr'+i+'" id="addr'+i+'" >'+row.cells[1].innerHTML+'</textarea></td></tr>';
		x+='<tr><th>Position held</th><td><input type="text" id="designation'+i+'" name="designation'+i+'" size="35" value="'+row.cells[2].innerHTML+'"></td></tr>';
		x+='<tr><th>From</th><td><input type="date" name="from'+i+'" id="from'+i+'" value="'+from+'" max="'+date+'" ></td></tr>';
		x+='<tr><th>To</th><td><input type="date" name="to'+i+'" id="to'+i+'" value="'+to+'" max="'+date+'" ></td></tr>';
		x+='<tr><th>Pay Scale</th><td><input type="text" name="payscale'+i+'" id="payscale'+i+'" value="'+row.cells[5].innerHTML+'" ></td></tr>';
		x+='<tr><th>Remarks</th><td><textarea rows=2 cols=50 name="reason'+i+'" id="reason'+i+'" >'+row.cells[6].innerHTML+'</textarea></td></tr>';
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
		var a=document.getElementById("addr"+i).value;
		var d=document.getElementById("designation"+i).value;
		var f=document.getElementById("from"+i).value;
		var t=document.getElementById("to"+i).value;
		var p=document.getElementById("payscale"+i).value;
		var r=document.getElementById("reason"+i).value;

		if(a=="" || d=="" || f=="" || t=="" || p=="" || r=="")
			alert("!! Please fill up all the fields !!");
		else if((new Date(f).getTime()) > (new Date(t).getTime()))
			alert("!! Fill the period correctly !!");
		else
		{
			return true;
		}
		return false;
	}

	function onclick_add_new()
	{
		document.getElementById('add_new').style.display='none';
		document.getElementById('addnew').style.display='block';
	}
