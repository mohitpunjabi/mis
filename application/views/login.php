<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Please login to continue</title>
</head>

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/mis-layout.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/login.css" />
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/mis-layout.js"></script>

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

                if($error_code == 0) $this->notification->drawNotification("Login", "Please enter your username and password");
                else                 $this->notification->drawNotification($errorHead, $errorMessage, "error");

                echo form_open('login/login_user',"'id'='login'");   ?>
            	<table align="center" nozebra>
                	<tr>
                    	<td align="right">Username</td>
                        <td align="left"><input type="text" placeholder="Username" name="username" value=""
                        required /></td>
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
                <?php echo form_close(); ?>

                <hr />
                <a href="#">Forgot Password</a> |
                <a href="#">Online Help</a> |
                <a href="#">Indian School of Mines, Dhanbad</a>
            </div>
        </div>
    </div>
</body>
</html>