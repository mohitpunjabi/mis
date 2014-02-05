<?php
	require_once("ConfigSQL.php");
	
	function session_start_sec() {
		$session_name = "mis_sess_id";
		$secure = SECURE;
		$httponly = true;
		
		if(ini_set("session.use_only_cookies", 1) === false) error("Unable to start secured session");

		$cookieParams = session_get_cookie_params();
	    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
		
		session_name($session_name);
		session_start();
		session_regenerate_id();
	}
		
	function login($user_id, $password, $mysqli) {
		if($result = $mysqli->query("SELECT * FROM users WHERE id = '$user_id' LIMIT 1")) {
			if($result->num_rows == 1) {
				if(!check_brute($user_id, $mysqli)) {
					// Block account
					return false;
				}
				
				$row = $result->fetch_assoc();
				$password = encode_password($password, $row['created_date']);
				if($password == $row['password']) {
					// Login Successful
					$user_id = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user_id);
					set_session($user_id, $password);
					return true;
				}
				else {
					//Incorrect Password
					$mysqli->query("INSERT INTO user_login_attempt values('$user_id', now())");
					return false;
				}
			}
		}
		else {
			//Login Fail
			return false;
		}
	}
	
	function set_session($user_id, $password) {
		$_SESSION['users']['id'] = $user_id;
		$_SESSION['login_string'] = hash('sha512', $password . $_SERVER['HTTP_USER_AGENT']);
	}
	
	function login_check($mysqli) {
		if(isset($_SESSION['users']['id'], $_SESSION['login_string'])) {
			$user_id = $_SESSION['users']['id'];
			$login_string = $_SESSION['login_string'];
			$user_browser = $_SERVER['HTTP_USER_AGENT'];
			
			if($result = $mysqli->query("SELECT password FROM users WHERE id = '$user_id'")) {
				if($result->num_rows == 1) {
					$row = $result->fetch_assoc();
					$password = $row["password"];
					return (hash('sha512', $password . $user_browser) == $login_string);
				}
			}
		}
		
		return false;
	}
	
	
	// Check for failed logins in the past few hours
	function check_brute($user_id, $mysqli) {
		return true;
	}
	
	function encode_password($pass, $created_date) {
			$date = strtotime($created_date);
			$year = date('Y', $date);
			$salt = 'ISM';
			
			$tempHash = $pass . (string)$date . (string)$salt;
			for($i=0; $i < $year; $i++) $tempHash = md5($tempHash);
			return $tempHash;
	}

	function error($message) {
		header("Location: Error.php?err=".urlencode($message));
		exit();
	}

	function strclean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) $str = stripslashes($str);
		return mysql_real_escape_string($str);
	}

	function esc_url($url) {
	 
		if ('' == $url) return $url;
	 
		$url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
	 
		$strip = array('%0d', '%0a', '%0D', '%0A');
		$url = (string) $url;
	 
		$count = 1;
		while ($count) $url = str_replace($strip, '', $url, $count);
	 
		$url = str_replace(';//', '://', $url);
		$url = htmlentities($url);
		$url = str_replace('&amp;', '&#038;', $url);
		$url = str_replace("'", '&#039;', $url);
	 
		if ($url[0] !== '/') return '';
		else return $url;
	}