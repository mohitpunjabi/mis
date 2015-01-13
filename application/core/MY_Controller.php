<?php if(!defined("BASEPATH")){ exit("No direct script access allowed"); }
	/**
	 * Authorization Extended Controller Class
	 *
	**/
	class MY_Controller extends CI_Controller {

		var $CI;
		var $javascript = '';
		var $css = '';

    	function __construct($args = array())
    	{
	        parent::__construct();
	        $this->CI =& get_instance();
			if(!$this->CI->authorization->auth($args))
				redirect('login/logout/2');

	    	$this->load->model('modules_model', '', TRUE);
	    	$this->load->model('auth_types_model', 'auth_types', TRUE);
			$this->load->model('user_notifications_model', '', TRUE);
	    }

	    function getMenu()
	    {
	    	$user_id = $this->CI->session->userdata('id');
	    	$auths = $this->CI->session->userdata('auth');

	    	$modules = $this->modules_model->getModules();

	    	$menu = array();
	    	foreach($auths as $i => $auth)
	    	{
	    		$menu[$auth] = array();
	    		foreach($modules as $row)
	    		{
	    			$module = $row->id;
	    			$this->load->model($module.'/menu_model','',TRUE);
	    			$model_menu = $this->menu_model->getMenu();
	    			if(isset($model_menu[$auth]) && is_array($model_menu[$auth]))
	    				$menu[$auth] = array_merge($menu[$auth], $model_menu[$auth]);
	    		}
	    	}
	    	return $menu;
	    }

		function getAuthKeys() {
	    	$auths = $this->CI->session->userdata('auth');
			foreach($auths as $i => $auth) {
				$keys[$auth] = $this->auth_types->getAuthTypeById($auth);
			}
			return $keys;
		}

		function getNotifications() {
			$auths = $this->CI->session->userdata('auth');
			foreach($auths as $i => $auth) {
				$notifications[$auth] = $this->user_notifications_model->getUserNotifications($this->session->userdata('id'), $auth);
			}
			return $notifications;
		}

		function drawHeader($title = "MIS") {
			$this->load->view("templates/header", array("menu" => $this->getMenu(),
														"title" => $title,
														"javascript" => $this->javascript,
														"css" => $this->css,
														"authKeys" => $this->getAuthKeys(),
														"notifications" => $this->getNotifications()));
		}

		function drawFooter() {
			$this->load->view("templates/footer");
		}

		function addJS($js='') {
			$this->javascript .= "<script type=\"text/javascript\" src=\"".base_url()."assets/js/".$js." \" ></script>";
		}

		function addCSS($css = '') {
			$this->css .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."assets/css/".$css."\" />";
		}
	}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */