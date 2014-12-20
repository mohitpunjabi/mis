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

/*
		function notify($user_id_to, $title, $description, $path, $type = "")
		{

			$title = strclean($title);
			$description = strclean($description);
			$path = strclean($path);
			$type = strclean($type);

			$mysqli->query("INSERT into user_notifications
							VALUES('$user_id_to', '".$_SESSION['id']."', now(), NULL, '".currentModule()."', '$title', '$description', '$path', '$type')");
		}
*/
	}

