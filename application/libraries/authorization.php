<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	 * Authorization
	 *
	 *
	 */
class Authorization
{

	var $CI;

	public function __construct()
	{
		log_message('debug', "Authorization Class Initialized");

		// Set the super object to a local variable for use throughout the class
		$this->CI =& get_instance();
	}
/*
	function auth()
	{
		$this->session->session_start_sec();
		$args = func_get_args();

		if(!$this->login_check()) {
			//Page to redirect here
			//header("Location: ".WEBSITE_ROOT."/Logout.php?error=2");
			exit;
		}

		if(sizeof($args) == 0) return true;
		foreach($args as $aid) if($this->is_auth($aid)) return true;
		//Page to redirect here
		//header("Location: ".WEBSITE_ROOT."/Logout.php?error=2");
		exit;
	}


	function is_auth($auth, $module = "")
	{
		if($auth == "")    return false;
		if($auth != "deo") return in_array($auth, $_SESSION['auth']);
		else {
			if($module == "") {
				// This is a bad hack! Using debug_backtrace to find the module where the function was called.
				$backtrace = debug_backtrace();
				$module = _moduleFromURL($backtrace[sizeof($backtrace)-1]['file']);
			}
			$deoRes = $mysqli->query("SELECT * FROM deo_modules where id = '".$_SESSION['id']."'");
			$deoModules = array();
			while($row = $deoRes->fetch_assoc()) array_push($deoModules, $row['module_id']);
			return (in_array($auth, $_SESSION['auth']));
//			return (in_array($auth, $_SESSION['auth']) && in_array($module, $deoModules));
		}
	}
	*/


	function login_check()
	{
		$CI = &get_instance();
		if(isset($_SESSION['id'], $_SESSION['login_string']))
		{
			$user_id = $_SESSION['id'];
			$login_string = $_SESSION['login_string'];
			$user_browser = $_SERVER['HTTP_USER_AGENT'];

			if($query = $CI->db->get_where("users",array("id" => $user_id)))
			{
				if($query->num_rows == 1)
				{
					$row = $query->row_array();
					$password = $row["password"];
					return (hash('sha512', $password . $user_browser) == $login_string);
				}
			}
		}
		return false;
	}

	function check_brute($user_id) {
		return true;
	}

	function encode_password($pass, $created_date)
	{
		$date = strtotime($created_date);
		$year = date('Y', $date);
		$salt = 'ISM';

		$tempHash = $pass . (string)$date . (string)$salt;
		for($i=0; $i < $year; $i++) $tempHash = md5($tempHash);
		return $tempHash;
	}

	function error($message)
	{
		//header("Location: Error.php?err=".urlencode($message));
		exit();
	}

	function strclean($str)
	{
		//global $mysqli;
		$str = @trim($str);
		if(get_magic_quotes_gpc()) $str = stripslashes($str);

		$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    	$replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

    	return str_replace($search, $replace, $str);
	}

	function esc_url($url)
	{

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
}
