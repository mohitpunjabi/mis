/*
* Add.js -  javascript file used in add.php
*/
$(document).ready(function(){

	$add_course_form = $("#add_course_form");
	//$form_table = $("#form_table");
	$dept_selection = $('#dept_selection');
	$course_selection = $('#course_selection');
	$branch_selection = $('#branch_selection');
	$semester_selection = $("#semester");
	
	$course_selection.hide();
	$branch_selection.hide();
	$semester_selection.hide();
	
	$duration = 1;
	
	function add_course(){
		$.ajax({url:site_url("course_structure/add/json_get_course/"+$dept_selection.find(':selected').val()),
			success:function(data){
				var base_str = "<option value = '0' selected='selected' disabled>Select Course</option>";
				for($d=0 ; $d < data.length;$d++) {
					base_str += "<option data-duration='"+data[$d]['duration']+"' value='"+ data[$d]['id']+"'>"+data[$d]["name"]+"</option>";
				}
				
				$course_selection.show().html(base_str);
				$select_course = $('select#course_selection');
				$select_course.on('change',function(){
					$branch_selection.hide();
					$semester_selection.hide();
					add_branch(parseInt($('#course_selection option:selected').data('duration')));
				});
			},
			type:"POST",
			//data :JSON.stringify({course:$course_selection.find(':selected').val()}),
			dataType:"json",
			fail:function(error){
				console.log(error);
			}
		});
	}
	
	
	function add_branch(duration){
		$course_selection = $('#course_selection');
		$dept_selection = $('#dept_selection');

		//alert($course_selection.find(':selected').val());
		$.ajax({url:site_url("course_structure/add/json_get_branch/"+$course_selection.find(':selected').val()+"/"+$dept_selection.find(':selected').val()),
			success:function(data){
				
				base_str_branch = "<option selected = 'selected' disabled>Select Branch</option>";
				for($d=0 ; $d < data.length;$d++){
					base_str_branch += "<option value=\""+ data[$d]["id"]+"\">"+data[$d]["name"]+"</option>";
				}
				base_str_branch += "<option>Select Branch</option>";
				$branch_selection.show().html(base_str_branch);
				
				var d = new Date();
				var n = d.getFullYear();
				base_str = "<option selected = 'selected' disabled>Valid From</option>";
				
				for($d=n-5;$d<=n+5;$d++)
				{
					var session = $d+"_"+($d+1);
					base_str += "<option value= '"+session+"'>"+$d+"-"+($d+1)+"</option>"
				}	
				
				$semester_selection.show().html(base_str);
				//$select_branch = $('select#branch');
				$branch_selection.on('change',function(){
					$semester_selection.hide();
					add_semester(duration);
				});
				
			},
			type:"POST",
			//data :JSON.stringify({course:$course_selection.find(':selected').val()}),
			dataType:"json",
			fail:function(error){
				console.log(error);
			}
		});
	}
	
	function add_semester(duration){
		base_str = "";
		if($course_selection.find(':selected').val() == 'ug_comm')
		{
			for(counter = 1; counter <= 2 ; counter++){
				if(counter == 1)
					base_str += "<option value=\""+counter+"\">"+"Physics(Group "+counter+")"+"</option>";
				else if(counter == 2)
					base_str += "<option value=\""+counter+"\">"+"Chemistry(Group "+counter+")"+"</option>";
			}
			
		}
		else if(duration < 4){
			
			for(counter = 1; counter <= 2*duration ; counter++){
				base_str += "<option value=\""+counter+"\">"+counter+"</option>";
			}
		}
		else{
			for(counter = 3; counter <= 2*duration ; counter++){
				base_str += "<option value=\""+counter+"\">"+counter+"</option>";
			}
			
		}
		$semester_selection.show().html(base_str);
	}

	$dept_selection.change(function(){
		$("#branch_selection").hide();
		$("#session_selection").hide();
		$("#semester").hide();
		add_course();
	});

});