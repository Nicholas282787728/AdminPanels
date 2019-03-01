<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Dashboard_model');
		$this->load->model('common_model');
	}

	public function index() {
		redirect('panels/supermacdaddy/login/login');
	}

	public function login() {

		if (!empty($this->session->userdata('adminlogin')) && $this->session->userdata('adminlogin') == 5) {
			redirect('panels/supermacdaddy/dashboard/admin');
		} else {
			$data['title'] = 'Login';
			$data['file'] = 'admin/login';

			$username = $this->input->post('user_name');
			$password = $this->input->post('password');

			/*			 * ******************************************************* */
			if ($this->input->post('login_btn') == 'LOGIN') { 
				$result = $this->Dashboard_model->admin_login($username, $password); 
				if (!empty($result))
				{
					$datas = array(
						'id'		=> $result['id'],
						'name'		=> $result['user_name'],
						'username'	=> $result['email'],
						'password'	=> $result['password'],
						'title'		=> $result['title'],
						//'profile' =>	$result['profile'],
						'adminlogin' => $result['user_type'],
					);
					$this->session->set_userdata($datas);
					
					if ($datas['adminlogin'] == '5') {
						$this->session->set_flashdata('successmessage', 'Login Successfully.');
						redirect('panels/supermacdaddy/dashboard/admin');
					} else {
						$this->session->set_flashdata('errormessage', 'Invalid credentials..!!');
						redirect('/');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Invalid credentials..!!');
					$this->load->view('admin/login');
				}
			} else {
				$this->load->view('admin/login');
			}
		}
	}

	public function register() {
		$data['title'] = 'Register';
		$data['file'] = 'admin/register';
		//$data['notification'] = $this->Dashboard_model->notification_history(10); 	
		//$data['salcount']= $this->Dashboard_model->sal_login();
		if ($this->input->post('btn_register') == 'Register') {
			$password = $this->input->post('password');
			$passwordc = $this->input->post('passwordc');

			if ($password == $passwordc) {
				$result = $this->Dashboard_model->user_reg();
				redirect('panels/supermacdaddy/login/login');
			}
		}
		$this->load->view('admin/register');
	}

}
