<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliate extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Affiliate_model');
		$this->load->model('Dashboard_model');
	}
	
	public function index()
	{	
		if (!empty($this->session->userdata('id')) && $this->session->userdata('adminlogin') == 5) {
			$data['title']			= 'Affiliate :: Home';
			$data['file']			= 'admin/affiliate';
			$data['notification']	= $this->Dashboard_model->notification_history(10);
			$data['salcount']		= $this->Dashboard_model->sal_login();
			$data['ticket_count'] = $this->Dashboard_model->ticket_count();
			$this->load->view('admin_templates', $data);
		} else {
			redirect('panels/supermacdaddy/dashboard/login');
		}
		
	}	
}
