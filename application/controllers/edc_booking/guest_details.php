<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guest_details extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','stu'));
		
	}
}