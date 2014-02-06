<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/Layout.php");
	auth();
	drawHeader();
?>
<h1 class="page-head">Notifications</h1>

<h2>Today</h2>
<?php
	if(is_auth("emp")) {
		drawNotification("Username created", "Your username and password have been created. <a href=\"employee/show_emp.php\">Click here</a> to view your details.", "success");
		drawNotification("Feedback: Submission going on", "The feedback submission is going on.");
		drawNotification("Result: Result declared", "The result declaration has been completed. <a href=\"employee/show_emp.php\">Click here</a> to view the results of this session.");

		echo "<h2>Yesterday</h2>";
		drawNotification("Inventory: Item rejected", "The item you tried to issue was rejected. <a href=\"employee/show_emp.php\">Click here</a> to know more.", "error");
	}
	if(is_auth("deo")) {
		drawNotification("Username created", "Your username and password have been created. <a href=\"employee/show_emp.php\">Click here</a> to view your details.", "success");
		drawNotification("Feedback: Submission going on", "The feedback submission is going on.");
	}	

	drawFooter();
?>
