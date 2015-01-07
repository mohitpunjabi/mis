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
	    }
	}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */