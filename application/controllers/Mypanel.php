<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mypanel extends CI_Controller {

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
          $this->load->model('Store_model');
          $this->load->model('Mypanel_model');
          $this->load->model('common_model');
          $user_type =  $this->session->userdata('adminlogin');
          if($user_type != '3'){
        	redirect('/');
        }
		  
     }

     public function notification(){
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');
			
			$notification = $this->Mypanel_model->notification_history_user_message(5,$id); 
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
			redirect('panels/supermacdaddy/ondemand/login');
		}
	}
	public function notificationcount(){
			  $id=$this->session->userdata('id');
			 $notification = $this->Mypanel_model->notification_history_user(0,$id); 
			 echo count($notification);
	}
	public function tasknotification(){
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');
			$tasknotification = $this->Mypanel_model->tasknotification(5, $id); 
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
			redirect('panels/supermacdaddy/ondemand/login');
		}
	}
	public function tasknotificationcount(){
		   $id=$this->session->userdata('id');
			$notification = $this->Mypanel_model->tasknotification_message(0,$id); 
			echo count($notification);
	}
	public function msgnotification(){
		if($this->session->userdata('adminlogin')){
		    $id=$this->session->userdata('id');
			$notification = $this->Mypanel_model->msgnotification(5,$id); 
			foreach($notification as $val){
				
                echo '<li>
                            <a href="javascript:void(0);">
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
			redirect('panels/supermacdaddy/ondemand/login');
		}
	}
	public function msgnotificationcount(){
		    $id=$this->session->userdata('id');
			$notification = $this->Mypanel_model->msgnotification_message(0,$id); 
			echo count($notification);
	}
	public function chat_history(){
		$id = $this->session->userdata('id');
		$history =$this->Mypanel_model->chat_history();
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

	public function readMessages(){
		$name=$this->input->post('name');

		if($name =='notification'){
			$id     = $this->session->userdata('id');
		    $result = $this->Mypanel_model->readMessages($id,$name);
		    echo '0';
		}else if($name =='task'){
		
			$id     = $this->session->userdata('id');
		    $result = $this->Mypanel_model->readMessages($id,$name);
            echo '0';
		}else if($name =='message'){
		
			$id     = $this->session->userdata('id');
		    $result = $this->Mypanel_model->readMessages($id,$name);
            echo '0';
		}
       

	}

	

 }