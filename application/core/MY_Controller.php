<?php if(!defined("BASEPATH")){ exit("No direct script access allowed"); }
	/**
	 * Authorization Extended Controller Class
	 *
	**/
	class MY_Controller extends CI_Controller {

		var $CI;

    	function __construct($args = array())
    	{
	        parent::__construct();
	        $this->CI =& get_instance();
			if(!$this->CI->authorization->auth($args))
				redirect('login/logout/2');

	    	$this->load->model('modules_model', '', TRUE);
	    	$this->load->model('auth_types_model', 'auth_types', TRUE);

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

		function drawHeader($title = "MIS") {
			$this->load->view("templates/header", array("menu" => $this->getMenu(),
														"title" => $title,
														"authKeys" => $this->getAuthKeys()));
		}
	}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */