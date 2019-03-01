<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

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
           $this->load->model('Staff_model');
		  
     }
     
    public function index()
	{	
		if($this->session->userdata('adminlogin')){
			$data['title']='Dashboard :: Home';
			$data['file'] = 'staff/index';
			$data['notification'] = $this->Staff_model->notification_history(10); 	
			
			$data['salcount']= $this->Staff_model->sal_login(); 
			$this->load->view('staff_template', $data);
		}else{
			redirect('panels/supermacdaddy/staff/login');
		}
		
	}
     
     /**************** LOGIN **********************/
		public function login(){
		if($this->session->userdata('adminlogin')){
			redirect('panels/supermacdaddy/staff');
		}else{
			$data['title']  = 'Login';
			$data['file']	= 'staff/login';
			
			$username = $this->input->post('email');
			$password = $this->input->post('password');
			
			
			/**********************************************************/
			if($this->input->post('login_btn') == 'Login'){
				
				//$this->input->cookie('remember_me',true); 
				$result = $this->Staff_model->staff_login($username,$password);
				//echo "<pre/>"; print_r($result['data']); die('m here');
				if(!empty($result)){
					$data = array(
							'id' 			=>	$result['uid'],
							'firstname' 	=>	$result['firstname'],
							'lastname' 		=>	$result['lastname'],
							'username' 		=>	$result['username'],
							'email' 		=>	$result['email'],
							'password' 		=>	$result['pass_encrpt'],
							'contact' 		=>	$result['contact'],
							'adminlogin' 	=> '1'
					);
					$this->session->set_userdata($data);
					//$dataDetail = $this->session->userdata(); //echo "<pre/>"; print_r($dataDetail); die('m here');
					$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
						redirect('panels/supermacdaddy/staff');
				}else{
					$this->session->set_flashdata('errormessage','Invalid credentials..!!');
					redirect('panels/supermacdaddy/staff/login');
				}
			}
			$this->load->view('staff/login');
		}	
	}
	
	public function staff_list()
	{
		$data['title']='Sales Staff';
		
		$data['stafflist']= $this->Staff_model->store_fronts();
		 //echo '<pre/>';print_r($data['Sales']);die('got data');
		$data['file'] = 'staff/staff_list';
		$this->load->view('staff_template', $data);
	}
	public function staff_task()
	{
		$data['title']='Staff Task';
		$id = $_GET['id'];
		$data['person_task']= $this->Staff_model->staff_task($id);
		 //echo '<pre/>';print_r($data['person_task']);die('got data');
		$data['file'] = 'staff/staff_task';
		$this->load->view('staff_template', $data);
	}
	public function tasks()
	{
		if($this->session->userdata('adminlogin')){
			$data['title']='Tasks';
			$data['file'] = 'staff/task_list';
			$_SESSION['id'] 	= $this->session->userdata('id');
			$data['staff_task']= $this->Staff_model->task_list($_SESSION['id']);
			//echo '<pre/>';print_r($data['sales_task']);die('got data');
			$this->load->view('staff_template', $data);
		}else{
			redirect('panels/supermacdaddy/staff/login');
		}
	}
	
	public function notification(){
		if($this->session->userdata('adminlogin')){
			
			$notification = $this->Staff_model->notification_history(5); 
			foreach($notification as $val){
			echo '<li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> <b>'.$val['user_name'].'</b><br>'.$val['message'].'
                                    <span class="pull-right text-muted small">'.$val['created_at'].'</span>
                                </div>
                            </a>
                        </li>';	
			}
			echo '<li>
                            <a class="text-center brdr-0" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
		}else{
			redirect('panels/supermacdaddy/staff/login');
		}
	}
	
	
	public function notificationcount(){
			$notification = $this->Staff_model->notification_history(0); 
			echo count($notification);
	}
	public function tasknotification(){
		if($this->session->userdata('adminlogin')){
			
			$tasknotification = $this->Staff_model->tasknotification(5); 
			foreach($tasknotification as $val){
            echo '<li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>'.$val['task_name'].'</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>';            	
			}
			echo '<li>
                            <a class="text-center brdr-0" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
		}else{
			redirect('panels/supermacdaddy/staff/login');
		}
	}
	public function tasknotificationcount(){
			$notification = $this->Staff_model->tasknotification(0); 
			echo count($notification);
	}
	public function msgnotification(){
		if($this->session->userdata('adminlogin')){
			 
			$notification = $this->Staff_model->msgnotification(5); 
			foreach($notification as $val){
				
                echo '<li>
                            <a href="#">
                                <div>
                                    <strong>'.$val['display_name'].'</strong>
                                    <span class="pull-right text-muted">
                                        <em>'.$val['message_date'].'</em>
                                    </span>
                                </div>
                                <div> '.$val['message'].'</div>
                            </a>
                        </li>';        
			}
			echo '<li>
                            <a class="text-center brdr-0" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
		}else{
			redirect('panels/supermacdaddy/staff/login');
		}
	}
	public function msgnotificationcount(){
			$notification = $this->Staff_model->msgnotification(0); 
			echo count($notification);
	}
	public function sendmassage(){
		if($this->session->userdata('adminlogin')){
			$data =$this->Staff_model->sendmassage();
		 }else{
			redirect("/login");	
		 }
		
	}
	public function chat_history(){
		$id = $this->session->userdata('id');
		$history =$this->Staff_model->chat_history();
			foreach($history as $val){
				if($val['message_by']==$id){
				
				
				echo '<li class="left clearfix"><span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/Me" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Me</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> '.$val['message_date'].'</small>
                                        </div>
                                        <p>
                                            '.$val['message'].'
                                        </p>
                                    </div>
                                </li>';
				
				}	
				if($val['message_by']!=$id){
						echo '<li class="right clearfix"><span class="chat-img  pull-right"><img src="http://placehold.it/50/55C1E7/'.$val['sender_name'].'" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">'.$val['sender_name'].'</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> '.$val['message_date'].'</small>
                                        </div>
                                        <p>
                                            '.$val['message'].'
                                        </p>
                                    </div>
                                </li>';
				}
				
			}
	
	}
	public function logout(){            
//        $this->session->unset_userdata('login');
//        $this->session->sess_destroy();
//        redirect('panels/supermacdaddy/staff');
		$data = array(
			'id' => "",
			'name' => "",
			'username' => "",
			'password' => "",
			'title' => "",
			'adminlogin' => "",
		);
		$this->session->set_userdata($data);
		$this->session->unset_userdata('login');
		$this->session->sess_destroy();
		redirect('/');
    }
	
}