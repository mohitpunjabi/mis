<?php
	require_once("Includes/Auth.php");
	require_once("Includes/Layout.php");

	session_start_sec();
	if(login_check($mysqli)) {
			header("Location: ".WEBSITE_ROOT."/home/");
			exit;
	}
	
	$error_code = 0;	
	if(isset($_POST['username'], $_POST['password'])) {
		$user_id = $_POST['username'];
		$password = $_POST['password'];
		
		if(login($user_id, $password, $mysqli)) {
			header("Location: ".WEBSITE_ROOT."/home/");
			exit;
		}
		else $error_code = 1;
	}
	
	if(isset($_GET['error'])) {
		if($_GET['error'] == '2') $error_code = 2;
		else					  $error_code = 3;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Please login to continue</title>
</head>

<link rel="stylesheet" type="text/css" href="../css/mis-layout.css" />
<link rel="stylesheet" type="text/css" href="../css/login.css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/mis-layout.js"></script>

<body>
	<div class="container">
    	<div class="big-logo">
        </div>
        
        <div class="login-box">
			<div class="inner-box">
            <h1 class="page-head">Login to continue</h1>
			<?php
				$errorHead = "Error";
				$errorMessage = "An error occured while logging in. Please try again.";
				if($error_code == 1) $errorMessage = "Invalid username or password. Please try again.";
				if($error_code == 2) $errorMessage = "You do not have access to that location.";
				
				if($error_code == 0) drawNotification("Login", "Please enter your username and password");
				else				 drawNotification($errorHead, $errorMessage, "error");
            ?>
            
			<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" id="login" method="post" >
            	<table align="center" nozebra>
                	<tr>
                    	<td align="right">Username</td>
                        <td align="left"><input type="text" placeholder="Username" name="username" value="<?php if($error_code == 1) echo $_POST['username']; ?>" required /></td>
                    </tr>

                	<tr>
                    	<td align="right">Password</td>
                        <td align="left"><input type="password" placeholder="Password" name="password" required /></td>
                    </tr>
                    <tr>
                    	<td></td>
                        <td align="left"><input type="submit" value="Login" id="submit" /></td>
                    </tr>
                </table>
            </form>
                <hr />
                <a href="#">Forgot Password</a> | 
                <a href="#">Online Help</a> | 
                <a href="#">Indian School of Mines, Dhanbad</a>
            </div>
        </div>
    </div>
</body>
</html>