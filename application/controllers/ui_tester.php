<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ui_tester extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('ui_tester/header');
	}
}