var xmlhttp;
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}

$(document).ready(function(){
	
	
	$form_table = $("#form_table");
	$course = $("#course_selection");	
	$branch_selection = $("#branch_selection").hide();
	$session = $("#session_selection").hide();
	$semester = $("#semester").hide();
	
	$cont_branch_selection = $("#cont_branch_selection").hide();
	$cont_session = $("#cont_session_selection").hide();
	$cont_semester = $("#cont_semester").hide();
	
	$course.on('change',function(){
		
		//alert($course.find(":selected").val());		
		$.ajax({url:site_url('course_structure/elective_offered_home/json_get_branch/'+$course.find(":selected").val()),
			success:function(data){
				
			if(parseInt($course.find(':selected').val())!=0){
				var base_str = '<option value = "0" disbaled = "true" selected>Select Branch</option>';
					
				for($d=0 ; $d < data.length;$d++){
					//alert("inside branches");
					//console.log(branch,data.branches[branch]);
					base_str+='<option value="'+data[$d]['id']+'">'+data[$d]['name']+'</option>';
				}
				$cont_branch_selection.show();
				$branch_selection.html(base_str).show();
				
				base_str = '<option disabled="true" selected>Select Batch</option>';

				var now = new Date();
				var duration = parseInt($course.find(':selected').data('duration'));
				
				for(var i=parseInt(now.getFullYear());i<=parseInt(now.getFullYear())-1+duration;i++){
					
					base_str += '<option value="'+i+'">'+i+'</option>';
				}
				
				alert(base_str);
				$cont_session.show();
				$session.html(base_str).show();	
				
				
				base_str += '<tr class="semester_option"><td>Choose Semester</td><td><select name = "semester"><option value = "0">Select Semester</option>';			
				for(var i=1;i<=duration*2;i++){
					base_str += '<option calue="'+i+'">'+i+'</option>';
				}
				base_str += '</select></td></tr>';
				
				
				$form_table.append(base_str);
			   }
			}
		});
		
	
	});
});

/*
$(document).ready(function()
{
	$course = $("#course");
	$form_table = $("#form_table");
	
	$course.on('change',function(){
		alert($course.find(":selected").val());
		
		
		//console.log(JSON.stringify({course:$course.find(":selected").val()}));
		$.ajax({url:site_url('course_structure/elective_offered_home/json_get_branch/'+$course.find(":selected").val()),
			success:function(data){
			alert("hii");
			
			if(parseInt($course.find(':selected').val())!=0){
				var base_str = '<tr class="branch_option"><td>Choose Branch</td><td><select name = "branch"><option value = "0">Select Branch</option>';
				for(branch in data.branches){
					//console.log(branch,data.branches[branch]);
					base_str+='<option value="'+branch+'">'+data.branches[branch]+'</option>';
				}
				base_str += '</select></td></tr>';
				base_str += '<tr class="branch_option"><td>Choose Batch</td><td><select name = "batch">';

				var now = new Date();
				var duration = parseInt($course.find(':selected').data('duration'));
				for(var i=parseInt(now.getFullYear());i<=parseInt(now.getFullYear())-1+duration;i++){
					base_str += '<option value="'+i+'">'+i+'</option>';
				}
				base_str += '</select></td></tr>';
				base_str += '<tr class="branch_option"><td>Choose Semester</td><td><select name = "semester"><option value = "0">All</option>';			
				for(var i=1;i<=duration*2;i++){
					base_str += '<option calue="'+i+'">'+i+'</option>';
				}
				base_str += '</select></td></tr>';
				//curr_sess='';
				now = new Date();
				if(now.getMonth() >= 6 && now.getMonth() <= 11){
					curr_sess = (parseInt(now.getFullYear())-2000)*100+((parseInt(now.getFullYear())-2000+1));
				}
				else{
					curr_sess = (parseInt(now.getFullYear())-2000-1)*100+((parseInt(now.getFullYear())-2000));
				}
			}
				//console.log(curr_sess);
				//console.log(base_str);
				//$form_table.append(base_str);
				//console.log(data);
			}
		}).fail(function(err,hr){
			//console.log(err,hr);
		});
		
		});
});*/