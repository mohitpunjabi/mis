<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ui_example extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->drawHeader("UI Library Example", "See <code>views/ui_tester/example.php</code> for the source");
		$this->load->view('ui_example/example');
		$this->drawFooter();
	}
}