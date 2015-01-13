<?php if(!defined("BASEPATH")){ exit("No direct script access allowed"); }
	/**
	 * Notifications
	 *
	 *
	 */

	class Notification {

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


		function notify($user_id_to, $auth, $title, $description, $path, $type = "")
		{
			$data['user_to'] = $user_id_to;
			$data['user_from'] = $this->CI->session->userdata('id');
			$data['send_date'] = date('Y-m-d H:i:s');
			$data['auth_id'] = $auth;
			$data['module_id'] = $this->currentModule();
			$data['title'] = $this->CI->authorization->strclean($title);
			$data['description'] = $this->CI->authorization->strclean($description);
			$data['path'] = $this->CI->authorization->strclean($path);
			$data['type'] = $this->CI->authorization->strclean($type);

			$this->load->model('user_notifications_model','',TRUE);
			$this->user_notifications_model->insert($data);
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

