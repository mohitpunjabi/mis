// JavaScript Document
$(document).ready(function() {
	$("#usersBox").showLoading();
	$.ajax({
		url: site_url("ui_example/loadUsers")
	}).done(function(userData) {
		(function() {
			var users = eval(userData);
			console.log(users.length);
			var $usersTable = $("#usersTable").dataTable();
			console.log($usersTable);
			
			var data = [];
			for(var i = 0; i < users.length; i++) {
				data[i] = [
					users[i].id,
					users[i].salutation,
					users[i].first_name,
					users[i].middle_name,
					users[i].last_name,
					users[i].dept_name
				];
			}

			$usersTable.fnAddData(data);
		})();
	}).always(function() {
		$("#usersBox").hideLoading();
	});

});