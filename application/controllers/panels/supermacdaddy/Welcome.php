<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	  public function __construct()
     {
          parent::__construct();
		  $this->load->database();
          $this->load->model('Welcome_model');
		  
     }
	public function index()
	{		
		
		$data['res'] = $this->Welcome_model->getservice(); //echo '<pre/>';print_r($res);die('got service');
		$this->load->view('index',$data);
		$username = $this->input->post('email');
		$password = $this->input->post('password');
		$logintype = $this->input->post('login_as');
		
		if($this->input->post('signup') == 'Log in'){ //die('here');//echo $username .''.$password .''.$logintype; die('data'); 
				
				if($logintype == "super_admin"){					
					$result = $this->Welcome_model->admin_login($username,$password); //echo '$result'; die('yes');
							
				if(!empty($result)){
					$data = array(
							'id' 			=>	$result['id'],
							'name' 			=>	$result['user_name'],
							'username' 		=>	$result['email'],
							'password' 		=>	$result['password'],
							'title' 		=>	$result['title'],
							'adminlogin' 	=> '1'
					);
					$this->session->set_userdata($data);
					$dataTitle = $this->session->userdata('title');
					
					if($dataTitle == 'Driver'){
						redirect('panels/supermacdaddy/ondemand/');
					}elseif($dataTitle == 'Super Admin'){
						redirect('panels/supermacdaddy/dashboard/');
					}elseif($dataTitle == 'Store'){
						redirect('panels/supermacdaddy/storefronts/');
					}elseif($dataTitle == 'Doctor'){
						redirect('panels/supermacdaddy/doctor/');
					}
						//redirect('dashboard/');
				}else{
					$this->session->set_flashdata('errormessage','Invalid credentials..!!');
					redirect('panels/supermacdaddy/dashboard/login');
				}
			}else{								
					$result = $this->Welcome_model->auth_login($username,$password);
					//echo '<pre/>';print_r($result);die('got it');
					if(!empty($result)){
					$data = array(
							'id' 			=>	$result['id'],
							'name' 			=>	$result['name'],
							'username' 		=>	$result['email'],
							'password' 		=>	$result['password'],
							'title' 		=>	$result['user_type'],
							'profile_type' 	=>	$result['profile_type'],
							'adminlogin' 	=> '1'
					);
					$this->session->set_userdata($data);
					$Title = $this->session->userdata('title'); 
					$profile_type = $this->session->userdata('profile_type'); 
					
					if($profile_type == 'super admin'){
						if($Title == 'Admin'){
							redirect('panels/supermacdaddy/admin/');
						}elseif($Title == 'Sales'){
							redirect('panels/supermacdaddy/sales/');
						}
						
					}elseif($profile_type == 'Ondemand'){						
						if($Title == 'Admin'){
							redirect('panels/supermacdaddy/ondemand/admin');
						}elseif($Title == 'Sales'){
							redirect('panels/supermacdaddy/ondemand/sales');
						}
					}elseif($profile_type == 'Store'){
						if($Title == 'Admin'){
							redirect('panels/supermacdaddy/store/admin');
						}elseif($Title == 'Sales'){
							redirect('store/sales');
						}
					}elseif($profile_type == 'Doctor'){
						if($Title == 'Admin'){
							redirect('panels/supermacdaddy/doctor/admin');
						}elseif($Title == 'Sales'){
							redirect('panels/supermacdaddy/doctor/sales');
						}
					}
						//redirect('dashboard/');
				}else{
					$this->session->set_flashdata('errormessage','Invalid credentials..!!');
					redirect('panels/supermacdaddy/dashboard/login');
				}
				}
				
	}	
	// reset password
		if($this->input->post('signup') == 'Reset'){ //die('here');//echo $username .''.$password .''.$logintype; die('data'); 
			//die('got');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$newpwd = $this->input->post('newpassword');
			$confirmpwd = $this->input->post('confirmpassword');
			
			//echo $username .' '.$password .' '.$newpwd.' '.$confirmpwd; die(' data');
			$result = $this->Welcome_model->auth_login($email,$password); //echo '<pre/>';print_r($result); 
								
					if(!empty($result)){ //die('yes');
							
							if($newpwd == $confirmpwd){
								$result = $this->Welcome_model->reset_auth_pwd($email,$newpwd);
								if(!empty($result)){
									redirect('/');
								}
							}else{
							 'password incorrect';
							}
					}else{
						
					}
				
		}
	
	}
	public function logins()
	{
		$this->load->view('welcome_message');
	}
}
