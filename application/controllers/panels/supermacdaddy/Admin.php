<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Admin_model');
	}
	
	public function index()
	{
		$data['title']='Dashboard :: Home';
		$data['file']='sub_admin/index';		
		$data['notification'] = $this->Admin_model->notification_history(10); 	

		$data['salcount']= $this->Admin_model->sal_login();
		$this->load->view('sub_admin_template',$data);
	}
	/*------------- LOGIN ----------------*/
	public function login(){
		if($this->session->userdata('adminlogin')){
			redirect('panels/supermacdaddy/admin');
		}else{
			$data['title']  = 'Login';
			$data['file']	= 'sub_admin/login';			
			
			$this->load->view('sub_admin/login');
			
			$username = $this->input->post('user_name');
			$password = $this->input->post('password');
			
			/**********************************************************/
			if($this->input->post('login_btn') == 'LOGIN'){
				
				$result = $this->Admin_model->admin_login($username,$password); //echo '$result'; die('yes');
				if(!empty($result)){
					$data = array(
							'id' 			=>	$result['id'],
							'name' 			=>	$result['user_name'],
							'username' 		=>	$result['email'],
							'password' 		=>	$result['password'],
							//'profile' 		=>	$result['profile'],
							'adminlogin' 	=> '1'
					);
					$this->session->set_userdata($data);
					$dataDetail = $this->session->userdata(); 
					$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
					redirect('panels/supermacdaddy/admin/');
				}else{
					$this->session->set_flashdata('errormessage','Invalid credentials..!!');
					redirect('panels/supermacdaddy/admin/login');
				}
			}
		}	 
	}
	
	public function create_task(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Users';
			$data['file']='sub_admin/creat_task';	
			if(isset($_POST['save'])){  
				 $task = $this->Admin_model->save_task(); 
				 $this->session->set_flashdata('success_msg', 'Check Your <strong>'.$email.' </strong> to recover you password');
				redirect("panels/supermacdaddy/admin/sales");
			}
		$data['all_staff'] = $this->Admin_model->all_staff(); 		

		}
		$this->load->view('sub_admin_template',$data);
	}
	
	public function task_list(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Users';
			$data['file']='sub_admin/task_list';	
			if(isset($_POST['save'])){
				$task = $this->Admin_model->save_task(); 
				$this->session->set_flashdata('success_msg', 'Task Save Successfully');
                redirect("panels/supermacdaddy/admin/task_list");
			}
			$data['all_task'] = $this->Admin_model->all_task(); 
			$data['all_staff'] = $this->Admin_model->all_staff(); 
		}
		$this->load->view('sub_admin_template',$data);
	}		
	
	public function sendmassage(){
		if($this->session->userdata('adminlogin')){
			$data =$this->Admin_model->sendmassage();
		 }else{
			redirect("/login");	
		 }
		
	}
	public function chat_history(){
		$id = $this->session->userdata('id');
		$history =$this->Admin_model->chat_history();
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
	public function edit_promo(){
		$result = $this->Admin_model->promodetail();
		echo '
	     <div class="col-sm-4">
            <div class="form-group">
                <label>Promo Code</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-cut"></i></span-->
                    <input class="form-control" name="code" autocomplete="off" value="'.$result['code'].'" placeholder="" type="text">
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                <label for="input_locale">Promo Type</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-language"></i></span-->
                   	<select id="input_locale" class="form-control select2 select2-offscreen" name="type" tabindex="-1" title="Promo Type">
                        <option value="1" selected="">Dollar $ Off</option>
                        <option value="2">Percentage % Off</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                <label>Promo Offer</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-cut"></i></span-->
                    <input class="form-control" name="offer" autocomplete="off" value="'.$result['offer'].'" placeholder="" type="text">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group ">
                <label>Promo Description</label>
                <div class="input-group"  style="width: 100%;">
                    <textarea name="description" style="width: 100%;" rows="5">'.$result['description'].'</textarea>
                </div>
            </div>
        </div>
          
		<div class="col-sm-4">
            <div class="form-group ">
                <label>Service Type</label>
                <div class="input-group">
                   	<select id="input_locale" class="form-control select2 select2-offscreen" name="service_type" tabindex="-1" title="Service Type">
                        <option value="1" selected="">Standard</option>
                        <option value="2">Premium</option>
						<option value="3">Affiliate</option>
                    </select>
                </div>
            </div>
        </div>
              
        <div class="col-sm-4">
            <div class="form-group ">
                <label>Promo Start Date</label>
                <div class="input-group">
                    <input name="starts" placeholder="'.$result['start'].'" type="date">
                </div>
            </div>
        </div>
        
        
        <div class="col-sm-4">
            <div class="form-group ">
                <label>Promo End Date</label>
                <div class="input-group">
                    <input name="ends" placeholder="'.$result['end'].'" type="date">
                </div>
            </div>
        </div>
        
        
        <div class="" style="clear:both">
                <div class="creatUserBottom">
                    <div class="">
                        <div class="vert-pad">
                            <button type="submit" name="update" value="'.$result['id'].'" class="btn-green">
                                 Update Promo
                            </button> 
                        </div>          
                    </div>       
                    <div class="">
                        <div class="vert-pad">
                            <button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>';
	}
	public function promo_list(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Promo codes';
			$data['file']='sub_admin/promo_list';			
			if(isset($_POST['save'])){
				$checkservice = $this->input->post('service_type');
				$records = $this->Admin_model->allservicelist($checkservice); 
				/*------ if service does not exist insert record else update it -----*/
					if(empty($records)){				
						$task = $this->Admin_model->save_promo(); 
						$this->session->set_flashdata('success_msg', 'Promo Save Successfully');
						redirect("panels/supermacdaddy/admin/promo_list");
					}else{
						$id = $records['id']; //echo $id; die('got id');
						$task = $this->Admin_model->update_promo($id); 
						$this->session->set_flashdata('success_msg', 'Promo Updated Successfully');
						redirect("panels/supermacdaddy/admin/promo_list");
					}
			} 
			
			if(isset($_POST['enable'])){ //die('e here');
				$id = $_POST['enable'];
				$data= array("status"=>'1');
				$this->db->where('id', $id);
				$this->db->update('uf_promo_codes',$data); 
				$this->db->last_query();
				$this->session->set_flashdata('success_msg', 'Promo code Enable successfully');
				redirect("panels/supermacdaddy/admin/promo_list");
			}  
			if(isset($_POST['disable'])){ //die('d here');
				$id = $_POST['disable'];
				$data= array("status"=>'0');
				$this->db->where('id', $id);
				$this->db->update('uf_promo_codes',$data); 
				$this->session->set_flashdata('success_msg', 'Promo code Disable successfully');
				redirect("panels/supermacdaddy/admin/promo_list");
			}	
			if(isset($_POST['update'])){  
				$updateid = $_POST['update'];   
				$promo = $this->Admin_model->update_promo($updateid); 
				$this->session->set_flashdata('success_msg', 'Promo code Updated Successfully');
				redirect("panels/supermacdaddy/admin/promo_list");
			} 
		if(isset($_POST['delete'])){  
				$promoid = $_POST['delete'];   
				$category = $this->Admin_model->delete_promo($promoid); 
				$this->session->set_flashdata('success_msg', 'Promo Deleted Successfully');
				redirect("panels/supermacdaddy/admin/promo_list");
			} 
			
			$data['allpromo'] = $this->Admin_model->allpromo(); 

			$this->load->view('sub_admin_template',$data);
					
		}else{
			redirect('panels/supermacdaddy/admin/login');
		} 
	
	}
	public function notification(){
		if($this->session->userdata('adminlogin')){
			
			$notification = $this->Admin_model->notification_history(5); 
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
			redirect('panels/supermacdaddy/admin/login');
		}
	}
	
	
	public function notificationcount(){
			$notification = $this->Admin_model->notification_history(0); 
			echo count($notification);
	}
	public function tasknotification(){
		if($this->session->userdata('adminlogin')){
			
			$tasknotification = $this->Admin_model->tasknotification(5); 
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
			redirect('panels/supermacdaddy/admin/login');
		}
	}
	public function tasknotificationcount(){
			$notification = $this->Admin_model->tasknotification(0); 
			echo count($notification);
	}
	public function msgnotification(){
		if($this->session->userdata('adminlogin')){
			 
			$notification = $this->Admin_model->msgnotification(5); 
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
			redirect('panels/supermacdaddy/admin/login');
		}
	}
	public function msgnotificationcount(){
			$notification = $this->Admin_model->msgnotification(0); 
			echo count($notification);
	}
	public function promo_code(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Promo codes';
			$data['file']='sub_admin/promo_code';			
			$this->load->view('sub_admin_template',$data);
		}else{
			redirect('panels/supermacdaddy/admin/login');
		}
	}
	public function edit_user(){
		$result = $this->Admin_model->userdetail();
		echo '
		<div class="col-sm-6">
            <div class="form-group">
                <label>User Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input  name="user_id"  value="'.$result['id'].'"  type="hidden">

                    <input readonly class="form-control" name="user_name" autocomplete="off" value="'.$result['user_name'].'" placeholder="Please enter the First Name" type="text">
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label>Display Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="display_name" autocomplete="off" value="'.$result['display_name'].'" placeholder="Please enter the Last Name" type="text">
                </div>
            </div>
        </div>               
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Title </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                     <select id="input_locale" class="form-control" name="title" title="Locale" required>
                            <option value="Store" selected="">Store</option>
                            <option value="Driver">Driver</option>
                            <option value="Driver">Doctor</option>
                        </select>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Email</label>
                <div class="input-group">
                    <span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
                    <input class="form-control" name="email" autocomplete="off" value="'.$result['email'].'" placeholder="Email address" type="text">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Contact </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="contact" value="'.$result['mob_number'].'" autocomplete="off" placeholder="" type="text">
                </div>
            </div>
        </div>
		';
		//echo  json_encode($result);
		
	}
	public function users(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Users';
			$data['file']='sub_admin/users';	
			if(isset($_POST['enable'])){
				$uid = $_POST['enable'];
				$dataa= array("flag_enabled"=>'0');
				$this->db->where('id', $uid);
      			$this->db->update('uf_user',$dataa); 
				$this->db->last_query();
				$this->session->set_flashdata('success_msg', 'Disable successfully');
                redirect("panels/supermacdaddy/admin/users");
			}
			if(isset($_POST['disable'])){
				$uid = $_POST['disable'];
				$dataa= array("flag_enabled"=>'1');
				$this->db->where('id', $uid);
      			$this->db->update('uf_user',$dataa); 
				$this->session->set_flashdata('success_msg', 'Enable successfully');
                redirect("panels/supermacdaddy/admin/users");
			}	
			if(isset($_POST['delete'])){
				$uid = $_POST['delete'];
				$this->db->where('id', $uid);
      			$this->db->delete('uf_user'); 
				$this->session->set_flashdata('success_msg', 'Delete successfully');
                redirect("panels/supermacdaddy/admin/users");
			}		
			if(isset($_POST['save'])){
				
				if(!empty($this->input->post('contact')) && !empty($this->input->post('user_name')) && !empty($this->input->post('email'))){
				$result = $this->Admin_model->add_user(); 
		 	 	if($result){
		 	 			$email = $this->input->post('email');
		 	 			$en_id = $result;// $time.$this->security->get_csrf_hash();//$this->encrypt->encode($id);
        				$this->load->library('email');
           				$this->email->set_mailtype("html");
						$this->email->from('info@meddev.imvisile.com', 'MedConnx');
						$this->email->to($email); 	
						$this->email->subject('MedConnx::Set Password');
						$this->email->message('Hello '.$email.',
							<br>Your account has been created on <b>MedConnx</b> team.<br><br>Please set password for your account
							<a href="'.base_url().'setpassword?auth_token='.$en_id.'">'.base_url().'setpassword?auth_token='.$en_id.'</a>
							<br> contact our staff at info@meddev.imvisile.comk
							<br>
							Thank you,<br>
							MedConnx');	
							$mailsend = $this->email->send();
			
						if($mailsend){
                        	$this->session->set_flashdata('success_msg', 'Check Your <strong>'.$email.' </strong> to recover you password');
                         	redirect("panels/supermacdaddy/admin/users");
                	    }else{
							$this->session->set_flashdata('success_msg', 'Sorry '.base_url().'opening?token='.$en_id.' mail not sent');
                         	redirect("panels/supermacdaddy/admin/users");
                		}
		 	 	}else{
		 	 		$this->session->set_flashdata('success_msg', $user_result);
                	redirect("panels/supermacdaddy/admin/users");
                }
		 	}else{
		 		$error='<div   style="padding: 5px;" class="alert alert-danger" > First Name, Email,Company Name,Comp. Telephone No. Required! </div>';
		 	}
			}
			if(isset($_POST['update'])){
				
					
			if(!empty($this->input->post('contact')) && !empty($this->input->post('user_name')) && !empty($this->input->post('email'))){
		 	 		$result = $this->Admin_model->update_user(); 
		 	 	if($result){
		 	 			$this->session->set_flashdata('success_msg', "User data updated successfully");
                	redirect("panels/supermacdaddy/admin/users");
		 	 	}else{
		 	 		$this->session->set_flashdata('success_msg', "User data not updated");
                	redirect("panels/supermacdaddy/admin/users");
                }
		 	}else{
		 		$error='<div   style="padding: 5px;" class="alert alert-danger" > First Name, Email,Company Name,Comp. Telephone No. Required! </div>';
		 	}
			}
			if(isset($_POST['type'])){
				$type = $_POST['type'];
                $data['alluser'] = $this->Admin_model->alluser($type); 
			}else{
				$data['alluser'] = $this->Admin_model->alluser(); 
			}
			$this->load->view('sub_admin_template',$data);
					
		}else{
			redirect('panels/supermacdaddy/admin/login');
		}
	}
	
	public function logout(){            
        $this->session->unset_userdata('login');
        $this->session->sess_destroy();
        redirect('panels/supermacdaddy/admin');        
    }


}
