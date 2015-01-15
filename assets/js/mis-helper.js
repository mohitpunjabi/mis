function js_base_url()
{
	return "<?= base_url()?>";
}

function js_site_url(uri)
{
	return js_base_url()+"index.php/"+uri;
}

function send_to()
{
	x='<table style="height:auto;width:1000px;"><tr>';
	x+='<th colspan=2 >List By</th><td colspan=2><select id="select_list_by" onchange="selectListBy()"><option value = "auth">Auth</option><option value = "dept">Department</option></select></td></tr>';
	x+='<tr><th colspan=4></th></tr>';
	x+='<tr id="ajax_fetch"></tr>';
	x+='<tr style="background:#00092a;" align="center"><td colspan=4 ><input type="button" name="cancel" value="Cancel" onClick="closeframe();" /></td></tr>';
	x+='</table>';

	var coverdiv = '<div id="coverdiv" style="height: 100%; width: 100%; top: 0px; left: 0px; opacity: 0.5; position: fixed; z-index: 2000; background: rgb(170, 170, 170);"></div>';
	var formdiv = '<div id="formdiv" style="height: auto; width: auto; top: 20%; left: 15%; display: block; position: absolute; z-index: 2001; background: #FEFEFE;">';
	formdiv+=x+'</div>';
	var div = document.createElement('div');
	div.setAttribute("id", "edit_div");
	div.innerHTML=coverdiv+formdiv;
	document.body.appendChild(div);
}

function selectListBy()
{
	var list=document.getElementById('select_list_by').value;
	if(list=='auth')	get_ajax_auth();
		
}

function closeframe()
{
	$('#edit_div').remove();
}