<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_supplier extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
			public function index()
			{
										
					$this->load->model('healthcenter/supplier_model','',TRUE);
					$data['show_list'] = $this->supplier_model->getAll_Suppliers();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_suppliers',$data);
					$this->drawFooter();
					
					
				
			}
			
			
	
	
}
?>

