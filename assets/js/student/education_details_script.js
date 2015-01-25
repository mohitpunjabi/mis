$( document ).ready(function() {
	onclick_add_row();
	var student_type = document.getElementById('student_type').value;
	//<?php echo $stu_type; ?>
	//var abcd = <?php echo $stu_type; ?>;
	//console.log(abcd);
	if(student_type == 'ug')
		document.getElementById('add').style.display='none';
	var row=document.getElementById("tableid").rows;
	var branch1 = document.getElementsByName('branch4[]')[row.length-3];
	var branch2 = document.getElementsByName('branch4[]')[row.length-2];
	branch1.value = '10';
	branch1.disabled = true;
	branch2.value = '12';
	branch2.disabled = true;
});
	/*$(function(){
			alert("hi");
			onclick_add_row();
			if(<?$stu_type?> == 'ug')
				document.getElementById('add').style.display='none';
	});*/

	function onclick_add_row()
	{
		var row=document.getElementById("tableid").rows;
		var newrow=document.getElementById("tableid").insertRow(row.length);
		newrow.innerHTML=document.getElementById("addrow").innerHTML;
		var newid=newrow.cells[0].id="sno"+Number(row.length-2);
		document.getElementById(newid).innerHTML=row.length-1;
		//document.getElementsByName('branch4[]')[row.length-1].disabled=false;
	}

	function onclick_add()
	{	
		var row=document.getElementById("tableid").rows;
		var e=document.getElementsByName("exam4[]")[row.length-2].value;
		var b=document.getElementsByName("branch4[]")[row.length-2].value;
		var c=document.getElementsByName("clgname4[]")[row.length-2].value;
		var g=document.getElementsByName("grade4[]")[row.length-2].value;

		if(e=="" || b=="" || c=="" || g=="" )
			alert('Sno '+(row.length-1)+' : Please fill up all the fields !!');
		else
		{
			if(row.length > 6)
			{
				alert('You are not allowed to add more rows.');
				return false;
			}
			//onclick_add_row();
			var newrow=document.getElementById("tableid").insertRow(row.length);
			newrow.innerHTML=document.getElementById("addrow").innerHTML;
			var newid=newrow.cells[0].id="sno"+Number(row.length-2);
			document.getElementById(newid).innerHTML=row.length-1;
			document.getElementsByName('branch4[]')[row.length-2].disabled=false;
		}
	}
	
	function validate()
	{
		var n_row=document.getElementById("tableid").rows.length;
		var i=0;
		for(i=0;i<=n_row-2;i++)
		{
			var e=document.getElementsByName("exam4[]")[i].value;
			var b=document.getElementsByName("branch4[]")[i].value;
			var c=document.getElementsByName("clgname4[]")[i].value;
			var g=document.getElementsByName("grade4[]")[i].value;
				
			if(e=="" || b=="" || c=="" || g=="" )
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
		/*var row=document.getElementById("tableid").rows;
		var e=document.getElementsByName("exam4[]")[row.length-2].value;
		var b=document.getElementsByName("branch4[]")[row.length-2].value;
		var c=document.getElementsByName("clgname4[]")[row.length-2].value;
		var y=document.getElementsByName("year4[]")[row.length-2].value;
		var g=document.getElementsByName("grade4[]")[row.length-2].value;
		var d=document.getElementsByName("div4[]")[row.length-2].value;

		if(e=="" || b=="" || c=="" || y=="" || g=="" || d=="" )
		{
			alert('Sno '+': Please fill up all the fields !!');
			return false;
		}
		else*/
			return true;

		/*if((e=="" && b=="" && c=="" && y=="" && g=="" && d=="" && row.length!=2)	||	(e!="" && b!="" && c!="" && y!="" && g!="" && d!=""))
			return true;
		else
		{
			alert('Sno '+(row.length-1)+' : Please fill up all the fields !!');
			return false;
		}*/
	}