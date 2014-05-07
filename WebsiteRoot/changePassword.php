<?php
	require_once("Includes/Auth.php");
	require_once("Includes/Layout.php");
	
	auth();
	
	if(isset($_POST['changeSubmit'])) {
		$oldP = $_POST['oldPassword'];
		$newP = $_POST['newPassword'];
		$newP2 = $_POST['newPassword2'];
		
		$oldPEnc = encode_password($oldP, $_SESSION['created_date']);
		var_dump($oldPEnc);
		$res = $mysqli->query("SELECT COUNT(*) count FROM users WHERE id = '".$_SESSION['id']."' AND password = '$oldPEnc'");
		$row = $res->fetch_assoc();
		if($row['count'] == 1) {
			if($newP == $newP2 && $newP != "") {
				$password = encode_password($newP, $_SESSION['created_date']);
				$mysqli->query("UPDATE users SET password = '".$password."' WHERE id = '".$_SESSION['id']."'");
				$_SESSION['login_string'] = hash('sha512', $password . $_SERVER['HTTP_USER_AGENT']);
				header("Location: changePassword.php?success=1");
				exit;
			}
			else {				
				header("Location: changePassword.php?error=2");
				exit;
			}
		}
		else {
			header("Location: changePassword.php?error=1");
			exit;
		}
	}
	
	drawHeader();
?>
<h1 class="page-head">Change your password</h1>

<?php
	if(isset($_GET['error'])) {
		if($_GET['error'] == 1) drawNotification("Incorrect Password", "Your old password was incorrect. Please try again.", "error");
		if($_GET['error'] == 2) drawNotification("Passwords don't match", "The new passwords do not match or they are left blank. Please try again", "error");
	}

	if(isset($_GET['success'])) {
		drawNotification("Password changed", "Your password has been changed.", "success");
	}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<table align="center">
        <tr>
            <th>Old Password</th>
            <td><input type="password" name="oldPassword" placeholder="Your old password" /></td>
        </tr>
        <tr>
            <th>New Password</th>
            <td><input type="password" name="newPassword" placeholder="Your new password" required /></td>
        </tr>
        <tr>
            <th>Verify New Password</th>
            <td><input type="password" name="newPassword2" placeholder="Re-type new password" required /></td>
        </tr>
        
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Change Password" name="changeSubmit" /></td>
        </tr>
    </table>
</form>

<?php
	drawFooter();
?>
