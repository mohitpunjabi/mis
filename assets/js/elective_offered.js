$(document).ready(function(){
	$course = $("#course");
	$form_table = $("#form_table");
	$course.on('change',function(){
		//console.log(JSON.stringify({course:$course.find(":selected").val()}));
		$.ajax({
			type:"POST",
			url:site_url('course_structure/elective_offered_home/json_get_branch/'+$course.find(":selected").val()),
			//data:{course:$course.find(":selected").val()},
			dataType:"json"
		}).always(function(){
			$('.branch_option').remove();
		}).done(function(data){
			if(parseInt($course.find(':selected').val())!=0){
				var base_str = '<tr class="branch_option"><td>Choose Branch</td><td><select name = "branch"><option>Select Branch</option>';
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
				base_str += '<tr class="branch_option"><td>Choose Semester</td><td><select name = "semester">';			
				for(var i=1;i<=duration*2;i++){
					base_str += '<option calue="'+i+'">'+i+'</option>';
				}
				base_str += '</select></td></tr>';
				//curr_sess='';
				/*now = new Date();
				if(now.getMonth() >= 6 && now.getMonth() <= 11){
					curr_sess = (parseInt(now.getFullYear())-2000)*100+((parseInt(now.getFullYear())-2000+1));
				}
				else{
					curr_sess = (parseInt(now.getFullYear())-2000-1)*100+((parseInt(now.getFullYear())-2000));
				}*/
				//console.log(curr_sess);
				//console.log(base_str);
				$form_table.append(base_str);
				//console.log(data);
			}
		}).fail(function(err,hr){
			console.log(err,hr);
		});
	});
});