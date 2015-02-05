<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ui_example extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->drawHeader("A UI Library Demo", "See <a href='#'>views/ui_tester/example.php</a> for the source");
		$this->load->view('ui_example/example');
		$this->drawFooter();
	}
}