<?php if(!defined("BASEPATH")){ exit("No direct script access allowed"); }
	/**
	 * Notifications
	 *
	 *
	 */

	class Notification {

		var $notification_table_name = 'user_notifications';
		var $CI;

		public function __construct()
		{
			log_message('debug', "Notification Class Initialized");

			// Set the super object to a local variable for use throughout the class
			$this->CI =& get_instance();
		}

		function drawNotification($title, $description, $type = "")
		{
			echo '
			<div class="notification '.$type.'">
				<h2>'.$title.'</h2>
				'.$description.'
			</div>';
		}


		function notify($user_id_to, $title, $description, $path, $type = "")
		{

			$title = $this->CI->authorization->strclean($title);
			$description = $this->CI->authorization->strclean($description);
			$path = $this->CI->authorization->strclean($path);
			$type = $this->CI->authorization->strclean($type);

			$this->CI->db->query("INSERT into user_notifications
							VALUES('$user_id_to', '".$this->CI->session->userdata('id')."', now(), NULL, '".$this->currentModule()."', '$title', '$description', '$path', '$type')");
		}

		function currentModule()
		{
			return $this->_moduleFromURL($_SERVER['PHP_SELF']);
		}

		function _moduleFromURL($url)
		{
			$i = 0;
			$urlParts = explode("\\", $url);
			if(sizeof($urlParts) == 1) $urlParts = explode("/", $url);
			for($i = 0; $i < sizeof($urlParts); $i++) if(strtolower($urlParts[$i]) == "index.php") break;

			return $urlParts[$i+1];
		}
	}

