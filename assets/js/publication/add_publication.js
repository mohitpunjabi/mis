function insert_department_options(index){
	$.ajax({
		url : site_url('publication/publication/json_get_all_departments'),
		dataType:'json',
		type:'post'
	}).done(function(data){
		base_str = '';
		for($row in data){
			base_str +="<option value='"+data[$row].id+"'>"+data[$row].name+"</option>";
		}
		//console.log(base_str);
		//return base_str;
		$('#author_'+index+'_department').append(base_str);
	});
}

function get_emp(index){
	val = $('select#author_'+index+'_department').find(':selected').val();
	console.log(val);
	$.ajax({
		url : site_url('publication/publication/json_get_emp_by_dept/'+val+'/'),
		dataType:'json',
		type:'post'
	}).done(function(data){
		console.log(data);
		base_str = '';
		for($row=0;$row<data.length;$row++){
			base_str +="<option value='"+data[$row].id+"'>"+data[$row].name+"</option>";
		}
		console.log(base_str);
		//return base_str;
		$('#author_'+index+'_emp').append(base_str);
	});
}


function add_template_author_ism(index){
	//remove already inserted author_`index`_removable trs
	$('.author_'+index+'_removable').remove();
	base_str = '<tr class="author_'+index+'_removable">';
    base_str+= '<td>Department</td>';
    base_str+= '<td>';
    base_str+= '<select name="author_'+index+'_department" id="author_'+index+'_department" onchange="get_emp('+index+')" data-author_index="'+index+'" class="author_department">';
    base_str += insert_department_options(index);      
	base_str+= '</select>';
	base_str+= '</td>';
	base_str+= '</tr>';
	base_str+= '<tr class="author_'+index+'_removable">';
	base_str+= '<td>Name</td>';
	base_str+= '<td>';
	base_str+= '<select name="author_'+index+'_emp_id" id="author_'+index+'_emp">';
	base_str+= '<option value="12">Select Department to see List</option>';
	base_str+= '</select>';
	base_str+= '</td>';
	base_str+= '</tr>';
	$('#author_'+index+'_table').append(base_str);
}
function add_template_author_other(index){
	$('.author_'+index+'_removable').remove();
	base_str = '<tr class="author_'+index+'_removable">';
	base_str += '<td>Name</td>';
	base_str += '<td><input type="text" name="author_'+index+'_fname" placeholder="First Name"></td>';
	base_str += '<td><input type="text" name="author_'+index+'_mname" placeholder="Middle name"></td>';
	base_str += '<td><input type="text" name="author_'+index+'_lname" placeholder="Last Name"></td>';
	base_str += '</tr>';
	base_str += '<tr class="author_'+index+'_removable">';
	base_str += '<td>Email Id</td>';
	base_str += '<td><input name="author_'+index+'_email" type="text"></td>';
	base_str += '</tr>';
	base_str += '<tr class="author_'+index+'_removable">';
	base_str += '<td>Institution</td>';
	base_str += '<td><input name="author_'+index+'_institution" type="text"></td>';
	base_str += '</tr>';
	base_str += '<tr class="author_'+index+'_removable">';
	base_str += '<td>Any Other Information</td>';
	base_str += '<td><textarea name="author_'+index+'_other_info"></textarea></td>';
	base_str += '</tr>';
	$('#author_'+index+'_table').append(base_str);
}

function author_template(){
	base_str ='';
	base_str += '<fieldset class="author_wrapper">';
	base_str += '<legend>Author Details *</legend>';
	base_str += '<table>';
	base_str += '<tr>';
	base_str += '<td>Number Of Authors</td>';
	base_str += '<td><input type="text" name="no_of_authors" onchange="author_fun()" class="no_of_authors" id="no_of_authors"></td>';
	base_str += '</tr>';
	base_str += '</table>';
	base_str += '</fieldset>';
	return base_str;
}
function author_detail_template(val){
	base_str ='';
	for(index=1;index <=val;index++){
		base_str+= '<fieldset class="author_box">';
		base_str+= '<legend>Author '+index+'</legend>';
		base_str+= '<table id="author_'+index+'_table">';
		base_str+= '<tr>';
		base_str+= '<td>Author Type</td>';
		base_str+= '<td>';
		base_str+= '<input type="radio" name="author_'+index+'_type" value="ISM" id="author_ism_'+index+'" onclick="add_template_author_ism('+index+');">';
		base_str+= '<label for="author_ism_'+index+'">ISM</label>';
		base_str+= '<input type="radio" name="author_'+index+'_type" value="OTHER" id="author_other_'+index+'" onclick="add_template_author_other('+index+');">';
		base_str+= '<label for="author_other_'+index+'">OTHERS</label>';
		base_str+= '</td>';
		base_str+= '</tr>';
		base_str+= '</table>';
		base_str+= '</fieldset>';
	}
	return base_str;
}

function author_fun(){
	val = parseInt($('.no_of_authors').val())
	console.log("Here",val);
	$('.author_box').remove();
	$('.author_wrapper').append(author_detail_template(val));
}
$(document).ready(function(){
	$pub_types = $('#publication_type');
	$pub_wrapper = $('#publication_wrapper');
	$no_of_authors = $('#no_of_authors');
	$author_wrapper = $('.author_wrapper');

	function publication_details(val){
		if(val === 1 || val === 2){
			base_str = '<fieldset class="publication_details">';
	      	base_str += '<legend>Journal Details</legend>';
	      	base_str += '<table>';
	      	base_str += '<tr>';
	        base_str += '<td>Name of the Journal *</td>';
	        base_str += '  <td><input type="text" name="publication_name"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Volume No.</td>';
	        base_str += '  <td><input type="text" name="vol_no"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Issue No.</td>';
	        base_str += '<td><input type="text" name="issue_no"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Date of Publication *</td>';
	        base_str += '<td><input type="date" name="begin_date"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Page Range *</td>';
	        base_str += '<td><input type="text" name="page_range"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Any Other Information</td>';
	        base_str += '<td><textarea name="other_info"></textarea></td>';
	        base_str += '</tr>';
	      	base_str += '</table>';
	    	base_str += '</fieldset>';
	    	return base_str;
		}
		else if(val === 3 || val === 4){
			base_str = '<fieldset class="publication_details">';
			base_str += '<legend>Conference Details</legend>';
	      	base_str += '<table>';
	      	base_str += '<tr>';
	        base_str += '<td>Name of the Conference *</td>';
	        base_str += '  <td><input type="text" name="publication_name"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '  <td>Venue *</td>';
	        base_str += '  <td><input type="text" name="venue"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Start Date *</td>';
	        base_str += '<td><input type="date" name="begin_date"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>End Date *</td>';
	        base_str += '<td><input type="date" name="end_date"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Page Range *</td>';
	        base_str += '<td><input type="text" name="page_range"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Any Other Information</td>';
	        base_str += '<td><textarea name="other_info"></textarea></td>';
	        base_str += '</tr>';
	      	base_str += '</table>';
	    	base_str += '</fieldset>';
	    	return base_str;
		}
		else if(val === 5){
			base_str = '<fieldset class="publication_details">';
	      	base_str += '<legend>Details</legend>';
	      	base_str += '<table>';
	      	base_str += '<tr>';
	        base_str += '<td>Name *</td>';
	        base_str += '  <td><input type="text" name="publication_name"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '  <td>Venue *</td>';
	        base_str += '  <td><input type="text" name="venue"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Volume No.</td>';
	        base_str += '  <td><input type="text" name="vol_no"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Issue No.</td>';
	        base_str += '<td><input type="text" name="issue_no"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Date *</td>';
	        base_str += '<td><input type="date" name="begin_date"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Page Range *</td>';
	        base_str += '<td><input type="text" name="page_range"></td>';
	        base_str += '</tr>';
	        base_str += '<tr>';
	        base_str += '<td>Any Other Information</td>';
	        base_str += '<td><textarea name="other_info"></textarea></td>';
	        base_str += '</tr>';
	      	base_str += '</table>';
	    	base_str += '</fieldset>';
	    	return base_str;
		}
	}
	$pub_types.on('change',function(){
		val = parseInt($pub_types.find(':selected').val());
		$('.publication_details').remove();
		$('.author_wrapper').remove();
		base_str=publication_details(val);
		base_str += author_template();
		$pub_wrapper.append(base_str);
	});

	/*$('.no_of_authors').on('change',function(){
		val = parseInt($('.no_of_authors').val())
		console.log("Here",val);
		$('.author_box').remove();
		$author_wrapper.append(author_detail_template(val));
	});*/
});