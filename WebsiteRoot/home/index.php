<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/Layout.php");
	auth();
	drawHeader();
?>
<h1 class="page-head">Notifications</h1>

<a href="notify_someone.php">Notify</a>
<?php
	$res = $mysqli->query("SELECT * from user_notifications
						   WHERE user_to = '".$_SESSION['id']."' AND
						   ISNULL(rec_date)
						   ORDER BY send_date DESC");

	if(!$res) drawNotification("No more notifications", "You do not have any unread notifications");
	else {
		echo "<h2>Unread Notifications</h2>";
		while($row = $res->fetch_assoc()) {
			drawNotification($row["module_id"] . ": " . $row["title"], "<b>" . date("d M Y", strtotime($row['send_date'])) . "</b>: " . $row["description"] . " <a href=\"".$row["path"]."\">Know more &raquo;</a>", $row["type"]);
		}
	}

	drawFooter();
?>
