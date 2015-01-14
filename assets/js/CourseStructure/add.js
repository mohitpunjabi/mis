/*
* Add.js -  javascript file used in add.php
*/
$(document).ready(function(){

	$add_course_form = $("#add_course_form");
	$form_table = $("#form_table");
	$course_selection = $('#course_selection');
	$duration = 1;

	function add_branch(){
		$.ajax({url:"http://localhost/mis/index.php/CourseStructure/add/json_get_branch",
			success:function(data){
				base_str = "<tr class=\"branch_selection\"><td><label for=\"branch\">Branch</label></td><td><select id=\"branch\" name=\"branch\">";
				for($d=0 ; $d < data.length;$d++){
					console.log(data[$d]);
					base_str += "<option value=\""+ data[$d]["id"]+"\">"+data[$d]["name"]+"</option>";
				}
				base_str += "</select></td></tr>";
				$form_table.append(base_str);
			},
			type:"GET",
			dataType:"json",
			fail:function(error){
				console.log(error);
			}
		});
	}

	function add_session(){
		base_str = "<tr class=\"session_selection\"><td> <label for=\"session\">Session</label></td><td><select id=\"session\" name=\"session\">";
		//console.log((new Date).getYear()); 
		//For now i don't remeber the exact function to get the current year
		// so using counter 20
		for(counter = 10; counter <=20 ; counter++){
			base_str += "<option value=\""+counter+''+(parseInt(counter)+1)+"\">20"+counter+" - 20"+(parseInt(counter)+1)+"</option>";
		}
		base_str +="</select></td></tr>";
		$form_table.append(base_str);
	}

	function add_semester(duration){
		base_str = "<tr class=\"session_selection\"><td> <label for=\"semester\">Semester</label></td><td><select id=\"semester\" name=\"sem\">";
		//console.log((new Date).getYear()); 
		//For now i don't remeber the exact function to get the current year
		// so using counter 20
		if(duration < 4){
			for(counter = 1; counter <= 2*duration ; counter++){
				base_str += "<option value=\""+counter+"\">"+counter+"</option>";
			}
		}
		else{
			for(counter = 3; counter <= 2*duration ; counter++){
				base_str += "<option value=\""+counter+"\">"+counter+"</option>";
			}
		}
		base_str +="</select></td></tr>";
		$form_table.append(base_str);
	}

	$course_selection.change(function(){
		$duration = $course_selection.find(":selected").data('duration');
		if(parseInt($duration) > 1){
			//If the value duration is less than 2 then load the branch selection
			$(".branch_selection").remove();
			$(".session_selection").remove();
			$(".semester_selection").remove();
			add_branch();
			add_session();
			add_semester(parseInt($duration));
		}
		else{
			$(".branch_selection").remove();
			$(".session_selection").remove();
			$(".semester_selection").remove();
			add_session();
			add_semester(parseInt($duration));
		}
	});

});