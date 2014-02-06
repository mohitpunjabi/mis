<?php
	require_once("ConfigSQL.php");
	
	function auth() {
		global $mysqli; // Use the $mysqli defined in ConfigSQL
		
		session_start_sec();
		$args = func_get_args();

		if(!login_check($mysqli)) {
			header("Location: ".WEBSITE_ROOT."/Logout.php?error=2");
			exit;
		}
		
		if(sizeof($args) == 0) return true;
		foreach($args as $aid) if(in_array($aid, $_SESSION['auth'])) return true;

		header("Location: ".WEBSITE_ROOT."/Logout.php?error=2");
		exit;
	}
	
	function is_auth($auth) {
		session_start_sec();
		return in_array($auth, $_SESSION['auth']);
	}
	
	function session_start_sec() {
		$session_name = "mis_sess_id";
		$secure = SECURE;
		$httponly = true;
		
		if(ini_set("session.use_only_cookies", 1) === false) error("Unable to start secured session");

		$cookieParams = session_get_cookie_params();
	    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
		
		session_name($session_name);
		@session_start();
		@session_regenerate_id();
	}
		
	function login($user_id, $password, $mysqli) {
		$user_id = strclean($user_id);
		$password = strclean($password);
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
					set_session($user_id, $password, $mysqli);
					return true;
				}
				else {
					//Incorrect Password
					$mysqli->query("INSERT INTO user_login_attempts values('$user_id', now())");
					return false;
				}
			}
		}
		//Login Fail
		return false;
	}
	
	function set_session($user_id, $password, $mysqli) {
		$_SESSION['id'] = $user_id;
		$_SESSION['login_string'] = hash('sha512', $password . $_SERVER['HTTP_USER_AGENT']);
		$_SESSION['auth'] = array();

		if($result = $mysqli->query("SELECT u . * , d.name AS dept_name, d.type AS dept_type
			FROM (
				SELECT * 
				FROM users
				NATURAL JOIN user_details
				WHERE id =  '$user_id'
			) AS u, departments AS d
			WHERE u.dept_id = d.id")) {
			$row = $result->fetch_assoc();
			$_SESSION['name'] = $row['salutation'] . ' ' . $row['first_name'] . (($row['middle_name'] != '')? ' '.$row['middle_name']: '') . (($row['last_name'] != '')? ' '.$row['last_name']: '');
			$_SESSION['sex'] = $row['sex'];
			$_SESSION['category'] = $row['category'];
			$_SESSION['dob'] = $row['dob'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['photopath'] = $row['photopath'];
			$_SESSION['marital_status'] = $row['marital_status'];
			$_SESSION['physically_challenged'] = $row['physically_challenged'];
			$_SESSION['dept_id'] = $row['dept_id'];
			$_SESSION['created_date'] = $row['created_date'];
			$_SESSION['dept_name'] = $row['dept_name'];
			$_SESSION['dept_type'] = $row['dept_type'];
			array_push($_SESSION['auth'], $row['auth_id']);
			
			if($row['auth_id'] == 'emp') {
				if($result = $mysqli->query("SELECT * 
					FROM  `emp_basic_details` 
					WHERE id =  '$user_id'")) {
					$row = $result->fetch_assoc();
					$_SESSION['designation'] = $row['designation'];
					array_push($_SESSION['auth'], $row['auth_id']);
				}
			}
			
			_set_old_session_values();
		}
	}
	
	// Set all old session values for compatibility.
	function _set_old_session_values() {
			$_SESSION['SESS_USERNAME'] = $_SESSION['id'];
			$_SESSION['SESS_AUTH'] = $_SESSION['auth'][0];
			$_SESSION['SESS_AUTHFULL'] = $_SESSION['auth'][0];
			$_SESSION['SESS_BRANCH'] = '';
			$_SESSION['SESS_COURSE'] = '';
			$_SESSION['SESS_SEMESTER'] = '';
			$_SESSION['SESS_NAME'] = $_SESSION['name'];
			$_SESSION['SESS_DEPT'] = $_SESSION['dept_id'];
			if(is_auth('emp')) $_SESSION['SESS_DESIGN'] = $_SESSION['designation'];
	}
	
	function login_check($mysqli) {
		if(isset($_SESSION['id'], $_SESSION['login_string'])) {
			$user_id = $_SESSION['id'];
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