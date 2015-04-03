$(document).ready(function() {
	var stu_id = document.getElementById('stu_id').value;
	$("#UsersEducationBox").showLoading();
	$.ajax({
		url: site_url("student_view_report/view/loadUsersEducationDetails/".stu_id)
	}).done(function(userData) {
		(function() {
			var users = eval(userData);
			var $UsersEducationTable = $("#UsersEducationTable").dataTable();
			var data = [];
			for(var i = 0; i < users.length; i++) {
				data[i] = [
					users[i].exam,
					users[i].branch,
					users[i].institute,
					users[i].year,
					users[i].grade,
					users[i].division
				];
			}

			$UsersEducationTable.fnAddData(data);
		})();
	}).always(function() {
		// Hide the loading gif, when request is complete.
		$("#UsersEducationBox").hideLoading();
	});
	alert(users);
	alert('hi');

});