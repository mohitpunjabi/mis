
/*
* Add.js -  javascript file used in add.php
*/
$(document).ready(function(){

	$add_course_form = $("#add_course_form");
	$form_table = $("#form_table");
	$course_selection = $('#course_selection');
	$duration = 1;

	function add_branch(){
		$.ajax({url:site_url("course_structure/add/json_get_branch/"+$course_selection.find(':selected').val()),
			s0uccess:function(data){
				base_str = "<tr class=\"branch_selection\"><td><label for=\"branch\">Branch</label></td><td><select id=\"branch\" name=\"branch\"><option>Select Branch</option>";
				for($d=0 ; $d < data.length;$d++){
					base_str += "<option value=\""+ data[$d]["id"]+"\">"+data[$d]["name"]+"</option>";
				}
				base_str += "</select></td></tr>";
				$form_table.append(base_str);
				$select_branch = $('select#branch');
				$select_branch.on('change',function(){
					add_session($course_selection.find(':selected').val(),$select_branch.find(':selected').val());
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

	function add_session($course,$branch){
		$.ajax({url:site_url("course_structure/add/json_get_session/"+$course+"/"+$branch),
			success:function(data){
				//console.log(data);
				base_str = "<tr class=\"session_selection\"><td> <label for=\"session\">Session</label></td><td><select id=\"session\" name=\"session\">";
				for(counter = 0; counter <data.length ; counter++){
					first = parseInt(parseInt(data[counter].year)/100);
					second = parseInt(data[counter].year) - first*100;
					//console.log(first,second);
					base_str += "<option value=\""+data[counter].year+"\">20"+first+" - 20"+second+"</option>";
				}
				base_str +="</select></td></tr>";
				$form_table.append(base_str);
				add_semester(parseInt($course_selection.find(':selected').data('duration')));
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
		//base_str = "<tr class=\"session_selection\"><td> <label for=\"semester\">Semester</label></td><td><select id=\"semester\" name=\"sem\">";
		//console.log((new Date).getYear()); 
		//For now i don't remeber the exact function to get the current year
		// so using counter 20
		if($course_selection.find(':selected').val() == 'ug_comm'){
			base_str = "<tr class=\"session_selection\"><td> <label for=\"semester\">Group</label></td><td><select id=\"semester\" name=\"sem\">";
			for(counter = 1; counter <= 2*duration ; counter++){
				if(counter == 1)
					base_str += "<option value=\""+counter+"\">"+"Physics(Group "+counter+")"+"</option>";
				else if(counter == 2)
					base_str += "<option value=\""+counter+"\">"+"Chemistry(Group "+counter+")"+"</option>";
			}
			
		}
		else if(duration < 4){
			base_str = "<tr class=\"session_selection\"><td> <label for=\"semester\">Semester</label></td><td><select id=\"semester\" name=\"sem\">";
			for(counter = 1; counter <= 2*duration ; counter++){
				base_str += "<option value=\""+counter+"\">"+counter+"</option>";
			}
		}
		else{
			base_str = "<tr class=\"session_selection\"><td> <label for=\"semester\">Semester</label></td><td><select id=\"semester\" name=\"sem\">";
			base_str += "<option value=\"0\">All"+"</option>";
			for(counter = 3; counter <= 2*duration ; counter++){
				base_str += "<option value=\""+counter+"\">"+counter+"</option>";
			}
			
		}
		base_str +="</select></td></tr>";
		$form_table.append(base_str);
	}

	$course_selection.change(function(){
		$(".branch_selection").remove();
		$(".session_selection").remove();
		$(".semester_selection").remove();
		add_branch();		
	});

});