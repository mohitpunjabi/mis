<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->checkPassword();

		$this->load->model("information/view_notice_model", "notice", TRUE);

		$this->addCSS("home/home-style.css");
		$this->addCSS("home/home-feed-style.css");
		$this->addCSS("home/home-calendar.css");

		$this->addJS("home/home-script.js");
		$this->addJS("home/home-feed-script.js");
		$this->addJS("home/home-calendar.js");
		$this->drawHeader("MIS");

		//related to notice, minutes or circular module
		$this->checkCircularValidity();
		$this->checkNoticeValidity();
		$this->checkMinuteValidity();

		$this->load->view('home', array("notices" => $this->notice->get_notices()));
		$this->drawFooter();
	}


	private function checkCircularValidity()
	{
		$this->load->model('information/search_edit_circular_model','',TRUE);
		$this->search_edit_circular_model->remove();
	}

	private function checkNoticeValidity()
	{
		$this->load->model('information/search_edit_notice_model','',TRUE);
		$this->search_edit_notice_model->remove();
	}

	private function checkMinuteValidity()
	{
		$this->load->model('information/search_edit_minute_model','',TRUE);
		$this->search_edit_minute_model->remove();
	}

	private function checkPassword()
	{
		$this->load->model('user/users_model','',TRUE);
		$user = $this->users_model->getUserById($this->session->userdata('id'));
		$id_pass=$this->authorization->strclean($this->session->userdata('id'));
		if($user && $user->password == $this->authorization->encode_password($id_pass, $user->created_date))
			redirect('change_password');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
