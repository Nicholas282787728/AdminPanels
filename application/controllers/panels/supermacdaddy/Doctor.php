<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Doctor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('email');
		$this->load->model('Doctor_model');
		$this->load->model('common_model');
		
		if ($this->session->userdata('adminlogin') == "") {
				 redirect('/');
		}elseif($this->session->userdata('adminlogin') == '1') {
			redirect('/panels/supermacdaddy/Ondemand');
		}  elseif ($this->session->userdata('adminlogin') == '3') {
			redirect('/panels/supermacdaddy/Storefronts');
		} elseif ($this->session->userdata('adminlogin') == '4') {
			redirect('/panels/supermacdaddy/sales');
		}
	}
     
	public function index()
	{	
		if($this->session->userdata('adminlogin')){
			$data['title']='Dashboard :: Home';
			$data['file']='doctor/index';
			
			$this->load->model('Ondemand_model');
			$data['allAdmins'] = $this->Ondemand_model->getAdminIds(array('user_type' => '5'));
			$this->load->view('doctor_template',$data);
		}else{
			redirect('panels/supermacdaddy/dashboard/login');
		}
	}
	
	/*------------- LOGIN ----------------*/
	public function login(){
		if($this->session->userdata('adminlogin')){
			redirect('panels/supermacdaddy/doctor');
		}else{
			$data['title']  = 'Login';
			$data['file']	= 'doctor/login';
			
			$username = $this->input->post('email');
			$password = $this->input->post('password');
			
			/**********************************************************/
			if($this->input->post('login_btn') == 'Login'){
				
				//$this->input->cookie('remember_me',true); 
				$result = $this->Doctor_model->doctor_login($username,$password);
				if(!empty($result)){
					$data = array(
							'email' 		=>	$result['email'],
							'password' 		=>	$result['password'],
							'adminlogin' 	=> '1'
					);
					$this->session->set_userdata($data);
					$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
						redirect('panels/supermacdaddy/doctor');
				}else{
					$this->session->set_flashdata('errormessage','Invalid credentials..!!');
					redirect('panels/supermacdaddy/doctor/login');
				}
			}
			 $this->load->view('doctor/login');
		}	
	}
	
	public function visibility()
	{
		if($this->session->userdata('adminlogin')){
			$data['title']	= 'Visibility';
			$data['file']	= 'doctor/visibility';		
			
			$user_id	= $this->session->userdata('id');
			$data['getvisibility'] = $this->Doctor_model->get_visibility_data($user_id);
			
			$this->load->view('doctor_template',$data);
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	
	public function visibility_action()
	{
		$created_id	= $this->session->userdata('id');
		$date		= date('Y-m-d H:i:s');
		if(isset($_POST['save_change']))
		{
			$image = "";
			if($_FILES["image"]["name"] != "")
			{
				$image = trim(str_replace (" ","_",time().$_FILES["image"]["name"]));
				$path = 'uploads';
				$this->upload_image($image, $path);
			}
		
			$data_arr = array(
				'location_name'			=> $this->input->post('location_name'),
				'opening_hour'			=> $this->input->post('opening_hrs'),
				'closing_hour'			=> $this->input->post('closing_hours'),
				'postal_code'			=> $this->input->post('postal_code'),
				'city'					=> $this->input->post('city'),
				'paypal_business_name'	=> $this->input->post('paypal_business'),
				'country_code'			=> $this->input->post('country_code'),
				'paypal_client_id'		=> $this->input->post('paypal_id'),
				'email'					=> $this->input->post('email'),
				'time_zone'				=> $this->input->post('time_zone'),
				'phone_number'			=> $this->input->post('phone_no'),
				'patient_tax'			=> $this->input->post('patient_tax'),
				'adult_use_tax'			=> $this->input->post('adult_use_tax'),
				'logo'					=> $image,
				'address'				=> $this->input->post('address'),
				'latitude'				=> $this->input->post('latitude'),
				'longitude'				=> $this->input->post('longitude'),
				'user_id'				=> $created_id,
				'update_by'				=> $created_id,
				'created_date'			=> $date,
				'update_date'			=> $date,
			);
			
			$insert = $this->common_model->insert_record($data_arr, 'cp_locations');
			
			$historydata_arr = array("user_id"=>$created_id,"message"=>"Visibility !  Add Company Details Successfully.","created_at"=>$date);
			$this->common_model->insert_record($historydata_arr, 'history');
			
			$this->session->set_flashdata('success_msg', 'Save Successfully..!');
		}
		
		if(isset($_POST['update_change']))
		{
			$image=$this->input->post('old_image');
			if($_FILES["image"]["name"] != "")
			{
				$image = trim(str_replace (" ","_",time().$_FILES["image"]["name"]));
				$path = 'uploads';
				$this->upload_image($image, $path);
			}
			$data_uparr = array(
				'location_name'			=> $this->input->post('location_name'),
				'opening_hour'			=> $this->input->post('opening_hrs'),
				'closing_hour'			=> $this->input->post('closing_hours'),
				'postal_code'			=> $this->input->post('postal_code'),
				'city'					=> $this->input->post('city'),
				'paypal_business_name'	=> $this->input->post('paypal_business'),
				'country_code'			=> $this->input->post('country_code'),
				'paypal_client_id'		=> $this->input->post('paypal_id'),
				'email'					=> $this->input->post('email'),
				'time_zone'				=> $this->input->post('time_zone'),
				'phone_number'			=> $this->input->post('phone_no'),
				'patient_tax'			=> $this->input->post('patient_tax'),
				'adult_use_tax'			=> $this->input->post('adult_use_tax'),
				'logo'					=> $image,
				'address'				=> $this->input->post('address'),
				'latitude'				=> $this->input->post('latitude'),
				'longitude'				=> $this->input->post('longitude'),
				'update_by'				=> $created_id,
				'update_date'			=> $date,
			);
			
			$this->db->where('loc_id',$this->input->post('loc_id'));
			$this->db->update('cp_locations',$data_uparr);
			
			$historydata_arr=array("user_id"=>$created_id,"message"=>"Visibility !  Update Company Details Successfully.","created_at"=>$date);
			$this->common_model->insert_record($historydata_arr, 'history');
		
			$this->session->set_flashdata('success_msg', 'Update Successfully..!');
		}
		redirect('panels/supermacdaddy/doctor/visibility');
	}
	
	public function availble_on_off()
	{
		$on_off_val=$this->input->post('on_off_val');
		$user_id = $this->session->userdata('id');
		$msg = false;
		$detail = '';
		if($on_off_val != "")
		{
			$data_arr = array("on_off_status"=>$on_off_val);
			$where_arr = array("id"=>$user_id);
			$this->Doctor_model->update_data('uf_user',$data_arr,$where_arr);
			$msg =true;

			$detail .= '<div role="alert" class="alert alert-info">
						<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
					   update successfully!
				</div>';
		}
		$data['success']=$msg;
		$data['msg'] = $detail;
		echo json_encode($data);
	}
	
	public function opt_in_out_status()
	{
		$in_out_val=$this->input->post('in_out_val');
		$user_id = $this->session->userdata('id');
		$msg = false;
		$detail = '';
		if($in_out_val != "")
		{
			$data_arr = array("opt_in_out"=>$in_out_val);
			$where_arr = array("id"=>$user_id);
			$this->Doctor_model->update_data('uf_user',$data_arr,$where_arr);
			$msg =true;
			$status ="In";
			if($in_out_val == 1)
			{
				$status ="Out";
			}
			$detail .= '<div role="alert" class="alert alert-info">
						<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
					   OPT '.$status.' successfully!
				</div>';
		}
		$data['success']=$msg;
		$data['msg'] = $detail;
		echo json_encode($data);
	}
	
	public function submitVisibility($value='')
	{
		$user_id =$this->session->logged_in['user_id_f'];
		$data = array(
		   'user_id'    => $user_id,
		   'title'    =>$this->input->post('location_name'),
		   'category'    =>$this->input->post('category'),
		   'currency'    =>$this->input->post('currency'),
		   'description'    =>$this->input->post('description'),
		   'price'    =>$this->input->post('price'),
		   'country'    =>$this->input->post('country'),
		   'city'    =>$this->input->post('city'),
		   'event_date'    =>$this->input->post('event_date'),
		   'create_time'    =>strtotime('now'),
	 	);
		$insert = $this->common_model->insert_record($data, 'events');
		if($insert){
		 	$this->session->set_flashdata('success_msg', 'Event add successfull.');
	        redirect('home/view_events');
		}
	}
	
	public function locations(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Locations';
			$data['file']='doctor/locations';			
			$this->load->view('doctor_template',$data);
					
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	
	public function reservation(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Reservation';
			$data['file']='doctor/reservations';			
			$this->load->view('doctor_template',$data);
					
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	
	public function schedule()
	{
		if($this->session->userdata('adminlogin'))
		{
			$data['getscheduling'] =$this->Doctor_model->getscheduling();
			$data['title']='Schedule';
			$data['file']='doctor/scheduling';	
			$created_id=$this->session->userdata('id');
			$date=date('Y-m-d H:i:s');
			if(isset($_POST['updatescheduling']))
			{
				$this->Doctor_model->update_scheduling();
				$historydata_arr=array("user_id"=>$created_id,"message"=>"Scheduling !  Update Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
				$this->session->set_flashdata('success_msg', 'update successfully');
				redirect("panels/supermacdaddy/doctor/schedule");
			}
			$this->load->view('doctor_template',$data);
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	
	public function delSchedule($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('app_reservations'); 
		
		$created_id=$this->session->userdata('id');
		$date=date('Y-m-d H:i:s');
		$historydata_arr=array("user_id"=>$created_id,"message"=>"Scheduling !  Delete Successfully. ","created_at"=>$date);
		$this->common_model->insert_record($historydata_arr, 'history');
		
		$this->session->set_flashdata('success_msg', 'Deleted successfully');
        redirect("panels/supermacdaddy/doctor/schedule");
	}
	
	public function edit_scheduling()
	{
		$id = $this->input->post('id');
		$edit_data = $this->Doctor_model->edit_scheduling($id);
		echo	'<div class="col-sm-12">
					<div class="form-group">
						<label>Full Name </label>
						<div class="input-group">
							<input class="form-control " type="hidden" name="scheduling_id" readonly="" value="'.$id.'" required="" >
							<input class="form-control" type="text" name="fullname" style="width:530px !important;" value="'.$edit_data['full_name'].'" required="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="email">Email </label>
						<div class="input-group">
							<input class="form-control" type="email" name="email" style="width:530px !important;" value="'.$edit_data['email'].'" readonly>
						</div>
					</div>
					<div class="form-group">
						<label>Contact </label>
						<div class="input-group">
							<input class="form-control" type="text" name="contact" style="width:530px !important;" value="'.$edit_data['phone'].'" required="">
						</div>
					</div>
					<div class="form-group">
						<label>Preferred Date </label>
						<div class="input-group">
							<input class="form-control datetimepicker4" type="text" name="preferr_date" style="width:530px !important;" value="'.date('Y-m-d',strtotime($edit_data['date'])).'" required="">
						</div>
					</div>
					<div class="form-group">
						<label>Preferred Time </label>
						<div class="input-group">
							<input class="form-control " type="time" name="preffer_time" style="width:530px !important;" value="'.$edit_data['time'].'" required="">
						</div>
					</div>
				</div>';
	}

	public function viewandlikes(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Schedule';
			$data['viewLikes'] =$this->Doctor_model->get_view_like();
 			$data['file']='doctor/viewandlikes';
			$this->load->view('doctor_template',$data);
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	
	public function pendingApproval(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Schedule';
			$data['file']='doctor/pending-approval';
			$data['viewLikes'] =$this->Doctor_model->getPendingApprovals();
			$data['getpendingApproval'] =$this->Doctor_model->getPendingApprovals();
			$created_id=$this->session->userdata('id');
			$date=date('Y-m-d H:i:s');
		
			if(isset($_POST['approved_btn']))
			{
				$id = $_POST['approved_btn'];
				$data_arr = array("accepted" => 1);
				$this->db->where('id', $id);
				$this->db->update('app_reservations', $data_arr);
				
				$historydata_arr=array("user_id"=>$created_id,"message"=>"Pending Approvals !  Approvals Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
				
				$this->session->set_flashdata('success_msg', 'approved successfully');
				redirect("panels/supermacdaddy/doctor/pendingApproval");
			}
			if(isset($_POST['reject_btn']))
			{
				$id = $_POST['reject_btn'];
				$data_arr = array("accepted" => 2);
				$this->db->where('id', $id);
				$this->db->update('app_reservations', $data_arr);
				
				$historydata_arr=array("user_id"=>$created_id,"message"=>"Pending Approvals !  Reject Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
				
				$this->session->set_flashdata('success_msg', 'reject successfully');
				redirect("panels/supermacdaddy/doctor/pendingApproval");
			}
			if(isset($_POST['delete']))
			{
				$id = $_POST['delete'];
				$this->db->where('id', $id);
				$this->db->delete('app_reservations');
				
				$historydata_arr=array("user_id"=>$created_id,"message"=>"Pending Approvals !  Delete Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
				
				$this->session->set_flashdata('success_msg', 'Delete successfully');
				redirect("panels/supermacdaddy/doctor/pendingApproval");
			}
			
			$this->load->view('doctor_template',$data);
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	
	public function support_ticket()
	{
		if($this->session->userdata('adminlogin')){
			$data['title']	= 'Support Ticket';
			$data['file']	= 'doctor/support_tickets';	
			$id				= $this->session->userdata('id');
			$created_mail	= $this->session->userdata('username');
			$date= date('Y-m-d H:i:s');
			
			if (isset($_POST['createdticket'])) 
			{
				
				$ticket_sub		= $this->input->post('ticket_sub');
				$ticket_email		= $this->input->post('ticket_email');
				$message_ticket	= $this->input->post('message_ticket');
				if(!empty($message_ticket) && $message_ticket !="<br>" )
				{
					$image='';
					if($_FILES["image"]["name"] != '')
					{
						$image = trim(str_replace (" ","_",time().$_FILES["image"]["name"]));
						$path = 'uploads';
						$this->upload_image($image, $path);
					}
					$data_arr=array(
						"subject"=>$ticket_sub,
						"email"=>$ticket_email,
						"message"=>$message_ticket,
						"attach"=>$image,
						"created_date"=>$date,
//						"created_by"=>$id,
						"user_id"=>$id,
					);		
					$this->db->insert("ost_ticket__cdata",$data_arr);
					$notify_ins=array("user_id"=>$id,"read_status"=>0,"type_read"=>"00","created_by"=>$id,"message"=>'New Ticket Created By '.$created_mail,"created_at"=>date('Y-m-d H:i:s'));
					$this->db->insert('notification_history',$notify_ins);
					
					if (!empty($created_mail)) //user
					{
						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnx');
						$this->email->to($created_mail);
						$this->email->subject('MedConnx::New Ticket Created');
						$this->email->message('Hello ' . $created_mail . ',
								<br>Ticket has been created .<br><br>
								'.$ticket_sub.'<br>
								'.$message_ticket.'
								<br> contact our staff at info@medconnex.net
								<br>
								Thank you,<br>
								MedConnx');
						$mailsend = $this->email->send();

						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnx');
						$this->email->to($ticket_email);
						$this->email->subject('MedConnx::New Ticket Created');
						$this->email->message('Hello ' . $ticket_email . ',
								<br>Your Ticket has been created on <b>MedConnx</b> team.<br><br>
								'.$ticket_sub.'<br>
								'.$message_ticket.'
								<br> contact our staff at info@medconnex.net
								<br>
								Thank you,<br>
								MedConnx');
						$this->email->send();
					}
					
					$historydata_arr=array("user_id"=>$id,"message"=>"Tickets !  Created Successfully. ","created_at"=>$date);
					$this->common_model->insert_record($historydata_arr, 'history');
					
					$this->session->set_flashdata('success_msg', 'created ticket successfully');
					redirect("panels/supermacdaddy/doctor/support_ticket");
				}
				else
				{
					$this->session->set_flashdata('error_msg', 'Empty Details..!');
					redirect("panels/supermacdaddy/doctor/support_ticket");
				}
			}
			else if (isset($_POST['updateticket'])) 
			{
				$ticket_no		= $this->input->post('ticket_no');
				$ticket_email		= $this->input->post('ticket_email');
				$ticket_sub		= $this->input->post('ticket_sub');
				$message_ticket	= $this->input->post('message_ticket');
				
				$old_image	= $this->input->post('old_image');
				if(!empty($message_ticket) && $message_ticket !="<br>")
				{
					$image = $old_image;
					if($_FILES["image"]["name"] != '')
					{
						$image = trim(str_replace (" ","_",time().$_FILES["image"]["name"]));
						$path = 'uploads';
						$this->upload_image($image, $path);
					}
					$data_arr=array(
						"email"=>$ticket_email,
						"subject"=>$ticket_sub,
						"message"=>$message_ticket,
						"attach"=>$image,
//						"created_by"=>$id,
						"user_id"=>$id,
					);
					$this->db->where('ticket_id', $ticket_no);
					$resultarray= $this->db->update('ost_ticket__cdata', $data_arr);
					
					$historydata_arr=array("user_id"=>$id,"message"=>"Tickets !  Update Successfully. ","created_at"=>$date);
					$this->common_model->insert_record($historydata_arr, 'history');
					
					$this->session->set_flashdata('success_msg', 'update ticket successfully');
					redirect("panels/supermacdaddy/doctor/support_ticket");
				}
				else
				{
					$this->session->set_flashdata('error_msg', 'Empty Details..!');
					redirect("panels/supermacdaddy/doctor/support_ticket");
				}
			}
			else if (isset($_POST['process']))
			{
				$uid = $_POST['process'];
				$data = array("status" => '1');
				$this->db->where('ticket_id', $uid);
				$this->db->update('ost_ticket__cdata', $data);
				$this->db->last_query();
				
				$historydata_arr=array("user_id"=>$id,"message"=>"Tickets !  Process Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
				
				$this->session->set_flashdata('success_msg', 'Proccess successfully');
				redirect("panels/supermacdaddy/doctor/support_ticket");
			}
			elseif (isset($_POST['completed'])) 
			{
				$uid = $_POST['completed'];
				$data = array("status" => '2');
				$this->db->where('ticket_id', $uid);
				$this->db->update('ost_ticket__cdata', $data);
				
				$historydata_arr=array("user_id"=>$id,"message"=>"Tickets !  Completed Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
				
				$this->session->set_flashdata('success_msg', 'Completed successfully');
				redirect("panels/supermacdaddy/doctor/support_ticket");
			}
			
			$data['last_ticket_no']		= $this->Doctor_model->last_ticket_no();
			$data['list_ticket_data']	= $this->Doctor_model->list_ticket_data();
			$data['ticket_count']		= $this->Doctor_model->ticket_count();


			$this->load->view('doctor_template',$data);
					
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	
	public function ticket_replay($ticket_no)
	{
		if($this->session->userdata('adminlogin'))
		{
			$data['title']	= 'Ticket Comment';
			$data['file']	= 'doctor/ticket_replay';	
			$data['ticket_no']	= $ticket_no;
			$user_id=$this->session->userdata('id');
			$date= date('Y-m-d H:i:s');
			if (isset($_POST['replay_btn'])) 
			{
				$comment_ticket	= $this->input->post('comment_ticket');
				$data_arr=array(
					"ticket_id"=>$ticket_no,
					"comment"=>$comment_ticket,
					"commentator_id"=>$user_id,
					"created_date"=>$date,
				);		
				$this->db->insert("ticket_comment",$data_arr);
				
				$historydata_arr=array("user_id"=>$user_id,"message"=>"Comment Ticket !  Reply Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
		
				$this->session->set_flashdata('success_msg', 'send successfully');
				redirect("panels/supermacdaddy/doctor/ticket_replay/$ticket_no");
			}
			$data['list_ticket_comment'] = $this->Doctor_model->list_ticket_comment($ticket_no);
		    $data['ticket_file']=$this->Doctor_model->ticket_file($ticket_no);

			$this->load->view('doctor_template',$data);
			
		}else{
			redirect('/');
		}
	}
	
	public function edit_ticket()
	{	
		$id = $this->input->post('ticket_id');
		$edit_data = $this->Doctor_model->edit_tickit_data($id);
		echo	'<div class="col-sm-12">
					<div class="form-group">
						<label>Ticket No </label>
						<div class="input-group">
							<input class="form-control " type="text" name="ticket_no" readonly="" value="'.$id.'" required="" >
						</div>
					</div>
					<div class="form-group">
						<label for="email">Email Address</label>
						<div class="input-group">
							<input class="form-control" type="email" name="ticket_email" style="width:530px !important;" value="'.$edit_data['email'].'" required="">
						</div>
					</div>
					<div class="form-group">
						<label>Subject </label>
						<div class="input-group">
							<input class="form-control" type="text" name="ticket_sub" style="width:530px !important;" value="'.$edit_data['subject'].'" required="">
						</div>
					</div>
					<div class="form-group">
						<label>Message</label>
						<div class="input-group">
							<textarea class="form-control" id="edit_message_ticket" name="message_ticket" rows="4" cols="20" style="width:530% !important; height:100%;">'.$edit_data['message'].'</textarea>
						</div>
					</div>
					<div class="form-group">
						<label>Attach File </label>
						<div class="input-group">
							<input type="file" name="image" >
							<input type="hidden" name="old_image" value="'.$edit_data['attach'].'" >
						</div>
						 <span class="docurlUpdate"></span>
                         <img src="'.base_url('uploads/'.$edit_data['attach']).'" class="myImgUpdate" style="max-width:100px;max-height:100px;"/>
					</div>
				</div>';
	}
	
	public function delete_ticket($ticket_id)
	{
		$this->db->where('ticket_id', $ticket_id);
		$this->db->delete('ost_ticket__cdata'); 
		
		$this->db->where('ticket_id', $ticket_id);
		$this->db->delete('ticket_comment'); 
		
		$id = $this->session->userdata('id');
		$date = date('Y-m-d H:i:s');
		$historydata_arr=array("user_id"=>$id,"message"=>"Tickets !  Deleted Successfully. ","created_at"=>$date);
		$this->common_model->insert_record($historydata_arr, 'history');
		
		$this->session->set_flashdata('success_msg', 'Deleted successfully');
		redirect("panels/supermacdaddy/doctor/support_ticket");
	}
	
	public function history(){
		if($this->session->userdata('adminlogin')){
			$data['title']='History';
			$data['file']='doctor/history';
			$id=$this->session->userdata('id');
			$where=array('status' =>1, 'user_id'=>$id);
			if(isset($_POST['delete_history'])){
				 $uid= $_POST['delete_history'];
				 $dwhere= array('id' =>$uid);
			     $this->Doctor_model->deletRecord('history',$dwhere);
			     $this->session->set_flashdata('success_msg', 'history is deleted Successfully..!');
			}
			$data['historyData']=$this->Doctor_model->historyData('history',$where);
			$this->load->view('doctor_template',$data);
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	
	public function signupdocuments(){
		if($this->session->userdata('adminlogin')){
			$data['title']='sign up documents';
			$data['file']='doctor/signupdocuments';	
			$created_id = $this->session->userdata('id');
			$date = date('Y-m-d H:i:s');
			
			if(isset($_POST['updatedocument']))
			{
				$document_id	= $this->input->post('document_id');
				$document_name	= $this->input->post('document_name');
				$old_image		= $this->input->post('old_image');
				$image			= $old_image;
				if($_FILES["image"]["name"] != '')
				{
					$filename	= $_FILES["image"]["name"];
					$extension	= end(explode(".", $filename));
					$image		= $document_name .".".$extension;
					$path		= 'uploads';
					$this->upload_image_overwrite($image, $path);
				}
				$data_arr = array(
					"document" => $image,
				);

				$this->db->where('id', $document_id);
				$resultarray= $this->db->update('uf_user_documents', $data_arr);
				
				$historydata_arr=array("user_id"=>$created_id,"message"=>"Sign Up Documents !  Update Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
		
				$this->session->set_flashdata('success_msg', 'update document successfully');
				redirect("panels/supermacdaddy/doctor/signupdocuments");
			}
			
			$data['document_list'] = $this->Doctor_model->document_doctor_signup();
			$this->load->view('doctor_template',$data);
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	public function edit_signupdocuments()
	{	
		$id = $this->input->post('document_id');
		$edit_data = $this->Doctor_model->edit_document_data($id);
		$link_name = explode( '.', $edit_data['document']);
		echo	'<div class="col-sm-12">
					<input class="form-control " type="hidden" name="document_id" readonly="" value="'.$id.'" required="" >
					<input class="form-control " type="hidden" name="document_name" readonly="" value="'.$link_name[0].'" required="" >
					<div class="form-group">
						<label>Attach File </label>
						<div class="input-group">
							<input type="file" name="image" >
							<input type="hidden" name="old_image" value="'.$edit_data['document'].'" >
						</div>
					</div>
				</div>';
	}
	
	public function delete_document($document_id)
	{
		$this->db->where('id', $document_id);
		$this->db->delete('uf_user_documents'); 
		
		$created_id = $this->session->userdata('id');
		$date		= date('Y-m-d H:i:s');
		$historydata_arr=array("user_id"=>$created_id,"message"=>"Sign Up Documents !  Deleted Successfully. ","created_at"=>$date);
		$this->common_model->insert_record($historydata_arr, 'history');
		
		$this->session->set_flashdata('success_msg', 'Deleted successfully');
		redirect("panels/supermacdaddy/doctor/signupdocuments");
	}
	public function promo_list() {
		$data['title'] = 'Promo codes';
		$data['file'] = 'doctor/promo_list';
		$created_id	= $this->session->userdata('id');
		$date		= date('Y-m-d H:i:s');
		if (isset($_POST['save'])) {
				$task = $this->Doctor_model->save_promo();
				
				$historydata_arr=array("user_id"=>$created_id,"message"=>"Promo Codes ! Created Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
				
				$this->session->set_flashdata('success_msg', 'Promo code created Successfully');
				redirect("panels/supermacdaddy/doctor/promo_list");
		}
		if (isset($_POST['enable'])) { 
			$id = $_POST['enable'];
			$data = array("status" => '1');
			$this->db->where('id', $id);
			$this->db->update('uf_promo_codes', $data);
//			$this->db->last_query();
			$historydata_arr=array("user_id"=>$created_id,"message"=>"Promo Codes ! Enable Successfully. ","created_at"=>$date);
			$this->common_model->insert_record($historydata_arr, 'history');
			$this->session->set_flashdata('success_msg', 'Promo code Enable successfully');
			redirect("panels/supermacdaddy/doctor/promo_list");
		}
		if (isset($_POST['disable'])) { //die('d here');
			$id = $_POST['disable'];
			$data = array("status" => '0');
			$this->db->where('id', $id);
			$this->db->update('uf_promo_codes', $data);
			$historydata_arr=array("user_id"=>$created_id,"message"=>"Promo Codes ! Disable Successfully. ","created_at"=>$date);
			$this->common_model->insert_record($historydata_arr, 'history');
			$this->session->set_flashdata('success_msg', 'Promo code Disable successfully');
			redirect("panels/supermacdaddy/doctor/promo_list");
		}
		if (isset($_POST['update'])) {
			$updateid = $_POST['update'];
			$promo = $this->Doctor_model->update_promo($updateid);
			$historydata_arr=array("user_id"=>$created_id,"message"=>"Promo Codes ! Updated Successfully. ","created_at"=>$date);
			$this->common_model->insert_record($historydata_arr, 'history');
			$this->session->set_flashdata('success_msg', 'Promo code Updated Successfully');
			redirect("panels/supermacdaddy/doctor/promo_list");
		}
		if (isset($_POST['delete'])) {
			$promoid = $_POST['delete'];
			$this->db->where('id',$promoid);
			$this->db->delete('uf_promo_codes');
			$historydata_arr=array("user_id"=>$created_id,"message"=>"Promo Codes ! Deleted Successfully. ","created_at"=>$date);
			$this->common_model->insert_record($historydata_arr, 'history');
			$this->session->set_flashdata('success_msg', 'Promo code Deleted Successfully');
			redirect("panels/supermacdaddy/doctor/promo_list");
		}

		$data['allpromo'] = $this->Doctor_model->allpromo();
		$this->load->view('doctor_template', $data);
	}
	
	public function CheckCode()
	{
		$requestedcode = $this->input->post('code');
		$getecode=$this->db->get_where('uf_promo_codes',array('code' => $requestedcode))->num_rows();
		if($getecode == 0)
		{
			echo 'true';
		}
		else
		{
			echo 'false';
		}
	}
	
	public function edit_promo() {
		$result = $this->Doctor_model->promodetail();
		$selected1 = $selected2 = $selected3 = '';
		$selected1 = ($result['service_type'] == 1) ? "selected" : '';
		$selected2 = ($result['service_type'] == 2) ? "selected" : '';
		$selected3 = ($result['service_type'] == 3) ? "selected" : '';
		$selectedtype1 = $selectedtype2  = '';
		$selectedtype1 = ($result['type'] == 1) ? "selected" : '';
		$selectedtype2 = ($result['type'] == 2) ? "selected" : '';
		
		echo '<div class="col-sm-4">
            <div class="form-group">
                <label>Promo Code</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-cut"></i></span-->
                    <input class="form-control" name="code" autocomplete="off" value="' . $result['code'] . '" placeholder="" type="text" required>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                <label for="input_locale">Promo Type</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-language"></i></span-->
                   	<select id="input_locale" class="form-control select2 select2-offscreen" name="type" tabindex="-1" title="Promo Type" required>
                        <option value="1" '.$selectedtype1 .'>Dollar $ Off</option>
                        <option value="2" '.$selectedtype2 .'>Percentage % Off</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                <label>Promo Offer</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-cut"></i></span-->
                    <input class="form-control" name="offer" autocomplete="off" value="' . $result['offer'] . '" placeholder="" type="text" required> 
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group ">
                <label>Promo Description</label>
                <div class="input-group"  style="width: 100%;">
                    <textarea name="description" style="width: 100%;" rows="5">' . $result['description'] . '</textarea>
                </div>
            </div>
        </div>
          
		<div class="col-sm-4">
            <div class="form-group ">
                <label>Service Type</label>
                <div class="input-group">
                   	<select id="input_locale" class="form-control select2 select2-offscreen" name="service_type" tabindex="-1" title="Service Type" required>
                        <option value="1" '.$selected1 .'>Standard</option>
                        <option value="2" '.$selected2 .'>Premium</option>
						<option value="3" '.$selected3 .'>Affiliate</option>
						<option value="">New Patients</option>
						<option value="">New Customer</option>
						<option value="">Reoccurring Patients</option>
						<option value="">Reoccurring Customer</option>
						<option value="">Other</option>
                    </select>
                </div>
            </div>
        </div>
              
        <div class="col-sm-4">
            <div class="form-group">
                <label>Promo Start Date</label>
                <div class="input-group">
                    <input name="starts"  type="text" value="'.  date('Y-m-d', strtotime($result['start'])).'" class="form-control testing datetimepicker4" required>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group ">
                <label>Promo End Date</label>
                <div class="input-group">
                    <input name="ends" type="text" value="'.  date('Y-m-d', strtotime($result['end'])).'" class="form-control testing datetimepicker4" required>
                </div>
            </div>
        </div>
        
        <div class="" style="clear:both">
                <div class="creatUserBottom">
                    <div class="">
                        <div class="vert-pad">
                            <button type="submit" name="update" value="' . $result['id'] . '" class="btn-green udate_promocode">
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
	public function payouts(){
	
		if($this->session->userdata('adminlogin')){
			$data['title']='sign up documents';
			$data['file']='doctor/payout';			
			$user_id=$this->session->userdata('id');
			$date	=date('Y-m-d H:i:s');
			$data['orders']= $this->Doctor_model->orders($user_id);
			$data['getPayoutDetails'] =$this->Doctor_model->getPayoutDetails();	
			$data['payments']= $this->Doctor_model->payments();
		
			$data['payout'] =$this->Doctor_model->getSingleRecord('payout_details',$user_id);
			if(isset($_POST['save']))
			{
				$this->Doctor_model->save_payout();
				$historydata_arr=array("user_id"=>$user_id,"message"=>"Payout Details ! Add Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
				$this->session->set_flashdata('success_msg', "add successfully");
				redirect('panels/supermacdaddy/doctor/payouts');
			}
			if(isset($_POST['updatepayout']))
			{
				$this->Doctor_model->update_payout();
				$historydata_arr=array("user_id"=>$user_id,"message"=>"Payout Details ! Update Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
				$this->session->set_flashdata('success_msg', "update successfully");
				redirect('panels/supermacdaddy/doctor/payouts');
			}
			$this->load->view('doctor_template',$data);
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	
	public function delete_payoutdetails($payout_id)
	{
		$this->db->where('payout_id', $payout_id);
		$this->db->delete('payout_details'); 
		
		$user_id = $this->session->userdata('id');
		$date	 = date('Y-m-d H:i:s');
		$historydata_arr=array("user_id"=>$user_id,"message"=>"Payout Details ! Deleted Successfully. ","created_at"=>$date);
		$this->common_model->insert_record($historydata_arr, 'history');
				
		$this->session->set_flashdata('success_msg', 'Deleted successfully');
		redirect("panels/supermacdaddy/doctor/payouts");
	}
	
	public function edit_payout()
	{	
		$id = $this->input->post('payout_id');
		$edit_data = $this->Doctor_model->edit_payout_data($id);
		echo	'<div class="col-sm-12">
					<input class="form-control " type="hidden" name="payout_id" readonly="" value="'.$id.'" required="" >
					<div class="form-group">
						<label for="email">WA Information Form</label>
						<div class="input-group">
							<input class="form-control" type="text" name="info_form" style="width:530px !important;" value="'.$edit_data['info_form'].'" required="">
						</div>
					</div>
					<div class="form-group">
						<label>Banking Info </label>
						<div class="input-group">
							<input class="form-control" type="text" name="info_banking" style="width:530px !important;" value="'.$edit_data['info_banking'].'" required="">
						</div>
					</div>
					<div class="form-group">
						<label>Paypal Name</label>
						<div class="input-group">
							<input class="form-control" type="text" name="paypal_name" style="width:530px !important;" value="'.$edit_data['paypal_name'].'" required="">
						</div>
					</div>
					<div class="form-group">
						<label for="email">Paypal Email</label>
						<div class="input-group">
							<input class="form-control" type="email" name="paypal_email" style="width:530px !important;" value="'.$edit_data['paypal_email'].'" required="">
						</div>
					</div>
				</div>';
	}
	
	public function complimentaryAd(){
	
		if($this->session->userdata('adminlogin')){
	 		$data['title']='sign up documents';
			$data['file']='doctor/complemn-ad';			
			$user_id = $this->session->userdata('id');
			$date	 = date('Y-m-d H:i:s');
			if(isset($_POST['save_btn']))
			{
				
				if(file_exists(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image_task')))
				{
					unlink(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image_task'));
				}
				
				$ad_size = explode("x",$this->input->post('ad_size'));
				$image = trim(str_replace (" ","_",time().$_FILES["image"]["name"]));
				$path = 'uploads';
				$width	= $ad_size[0];
				$height = $ad_size[1];
				
				$this->upload_image($image, $path);
				$this->uploadimageResize50X50($width,$height);
			
				$result = $this->Doctor_model->insert_comp_ads($image); 
				
				$historydata_arr=array("user_id"=>$user_id,"message"=>"Complimentary ! Add Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
				
				$this->session->set_flashdata('success_msg', "complimentary add successfully");
				redirect("panels/supermacdaddy/doctor/complimentaryAd");

			}
			if(isset($_POST['update_btn']))
			{
				$image =$this->input->post('image_old');
				$path = 'uploads';
				if($_FILES["image"]["name"] != ''){
					$image = trim(str_replace (" ","_",time().$_FILES["image"]["name"]));
					if(file_exists(FCPATH.'uploads/'.$this->input->post('image_old'))){
					  unlink(FCPATH.'uploads/'.$this->input->post('image_old'));
					}
					$ad_size = explode("x",$this->input->post('ad_size'));
					$width	= $ad_size[0];
					$height = $ad_size[1];
					
					$this->upload_image($image, $path);
					$this->uploadimageResize50X50($width,$height);
				}
				$result = $this->Doctor_model->update_comp($image); 
				
				$historydata_arr=array("user_id"=>$user_id,"message"=>"Complimentary ! Update Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
				$this->session->set_flashdata('success_msg', "complimentary updated successfully");
				redirect("panels/supermacdaddy/doctor/complimentaryAd");
			}
			$data['complist'] =$this->Doctor_model->getdata_complimentaryAd();
			$this->load->view('doctor_template',$data);
					
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
		
	public function edit_complimentary(){
		$result = $this->Doctor_model->editcomplimePanel();
		$selected="";
		if($result['ad_size'] == "1280x1024")
		{
			$selected="selected";
		}
		$imageUrl=base_url('uploads/'.$result['image']);
		echo '
		 <div class="col-sm-6">
            <div class="form-group">
                <label>Ad Title</label>
                <div class="input-group">
					<input type="hidden" name="image_old" value="'.$result['image'].'">
                    <input  name="ad_id"  value="'.$result['id'].'"  type="hidden">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="title" autocomplete="off" value="'.$result['title'].'" placeholder="Please enter title" type="text" required=""> 
                </div>
            </div>
        </div>  

        <div class="col-sm-6">
            <div class="form-group">
                <label>Ad Size</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
					<select class="form-control" name="ad_size" required="">
						<option value="1080x1920" '.$selected.'>1080 x 1920</option>
					</select>
                </div>
            </div> 
        </div>  
        <div class="col-sm-6">
            <div class="form-group">
                <label>Active Since </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
					<input class="form-control datetimepicker4" type="text" name="created"  autocomplete="off" placeholder="DD/MM/YYY" value="'.$result['created'].'" required="">
                </div>
            </div>
        </div>  
        
          <div class="col-sm-6">
            <div class="form-group ">
                <label for="extra">Choose File</label>
                <div class="input-group">                    
                    <input type="file" class="form-control" id="ext" name="image">
                    <img src="'.$imageUrl.'" width="100px" height="100px">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group ">
                <label>Description </label>
                <div class="input-group">
                    <textarea class="form-control" name="description"  placeholder="" rows="8" cols="80" required="">'.$result['description'].'</textarea>
                </div>
            </div>
        </div>
		';
	}
	public function deletecomplim($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('cp_complimentary_ad'); 
		$user_id = $this->session->userdata('id');
		$date	 = date('Y-m-d H:i:s');
		$historydata_arr=array("user_id"=>$user_id,"message"=>"Complimentary ! Deleted Successfully. ","created_at"=>$date);
		$this->common_model->insert_record($historydata_arr, 'history');
		$this->session->set_flashdata('success_msg', 'Deleted successfully');
        redirect("panels/supermacdaddy/doctor/complimentaryAd");
	}
	
	public function notifications()
	{
		if($this->session->userdata('adminlogin'))
		{
			$data['notifiy_list']=$this->Doctor_model->all_notification_history(0); 	
			$data['title']='Notifications';
			$data['file'] = 'doctor/notifications';
			if (isset($_POST['update_read_notifiy']))
			{
				$updateid = $_POST['update_read_notifiy'];
				$type_read = $_POST['type_read'];
				$dataa = array("type_read"=>$type_read);
				$this->db->where('id', $updateid);
				$this->db->update('notification_history', $dataa);
			
				$this->session->set_flashdata('success_msg', 'Read Successfully');
				redirect("panels/supermacdaddy/doctor/notifications");
			}
			$this->load->view('doctor_template', $data);
		}
		else
		{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	
	
	public function notification()
	{
		if($this->session->userdata('adminlogin')){
			$data = $chat = $inpdex_notiy ='';
			$type_read = "0";
			$notification = $this->Doctor_model->notification_history(0,$type_read); 

			$i = 0;
			if(!empty($notification))
			{
				foreach($notification as $val){
	 				if($i > 2)
					break;
						
						$inpdex_notiy.='<li class="update_status_read" id="'.$val['notification_id'].'" data-typeread="00" >
									<a style="cursor:pointer;">
										<div>
											<i style="color:#fe8860 !important;" class="fa fa-envelope fa-fw"></i> <b>'.$val['user_name'].'</b><br>'.$val['message'].' 
											<span class="pull-right text-muted small">'.$val['created_at'].'</span>
										</div>
									</a>
								</li>';	
						$i++;
				}
			}
			else
			{
				$inpdex_notiy.='<div align="center">Empty Notifications</div>';
			}
			$inpdex_notiy .='<li>
				<a class="text-center brdr-0" href="'.base_url().'panels/supermacdaddy/doctor/notifications">
				   <strong>See All Alerts</strong>
				   <i class="fa fa-angle-right"></i>
			   </a>
			</li>';
			$data['inpdex_notiy'] = $inpdex_notiy;
			$data['count'] = count($notification);
			echo json_encode($data);
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	
	public function tasknotification()
	{
		$data = $chat = $inpdex_notiy ='';
		$type_read = "2";
		$notification = $this->Doctor_model->notification_history(0,$type_read); 
		$i = 0;
		if(!empty($notification))
		{
			foreach($notification as $val){
				if($i > 2)
				break;
					$inpdex_notiy.='<li class="update_status_read" id="'.$val['notification_id'].'" data-typeread="22" >
								<a style="cursor:pointer;">
									<div>
										<i style="color:#56bddc;" class="fa fa-envelope fa-fw"></i> <b>'.$val['user_name'].'</b><br>'.$val['message'].'
										<span class="pull-right text-muted small">'.$val['created_at'].'</span>
									</div>
								</a>
							</li>';	
					$i++;
			}
		}
		else
		{
			$inpdex_notiy.='<div align="center">Empty Tasks</div>';
		}
			$inpdex_notiy .='<li>
				<a class="text-center brdr-0" href="'.base_url().'panels/supermacdaddy/doctor/notifications">
				   <strong>See All Alerts</strong>
				   <i class="fa fa-angle-right"></i>
			   </a>
			</li>';
		$data['inpdex_notiy'] = $inpdex_notiy;
		$data['count'] = count($notification);
		echo json_encode($data);
	}
	
	public function msg_notification()
	{
		$data = $chat = $inpdex_notiy ='';
		$type_read = "3";
		$notification = $this->Doctor_model->notification_history(0,$type_read); 
		$inpdex_notiy .=' <li><a href="javascript:void(0);"  data-toggle="modal" data-target="#composemail" ><i class="fa fa-envelope" aria-hidden="true"></i> Compose</a>
                        </li>';
		$i = 0;
		if(!empty($notification))
		{
			foreach($notification as $val){
				if($i > 2)
				break;
				
				$parth ='';
				$filename = 'uploads/'.$val['attachment'];
				if (file_exists($filename)) 
				{
					$parth="<a href=".base_url().$filename." download><i class='fa fa-download' style='font-size:20px'></i></a>";

				}
					$inpdex_notiy.='<li class="update_status_read" id="'.$val['notification_id'].'" data-typeread="33" style="cursor:pointer;">
						  
								<div>
									<strong>'.$val['user_name'].'</strong>
									<span class="pull-right text-muted">
										<em>'.$val['created_at'].'</em>
									</span>
								</div>
								<div> '.$val['message'].$parth.'</div>
							
						</li>';   
					$i++;
			}
		}
		else
		{
			$inpdex_notiy.='<div align="center">Empty Messages</div>';
		}
			$inpdex_notiy .='<li>
				<a class="text-center brdr-0" href="'.base_url().'panels/supermacdaddy/doctor/notifications">
				   <strong>See All Alerts</strong>
				   <i class="fa fa-angle-right"></i>
			   </a>
			</li>';
		$data['inpdex_notiy'] = $inpdex_notiy;
		$data['count'] = count($notification);
		echo json_encode($data);
	}
	public function update_notification()
	{
		$uid=$this->input->post('notify_id');
		$typeread=$this->input->post('typeread');
		$dataa = array("type_read"=>$typeread);
		$this->db->where('id', $uid);
		$this->db->update('notification_history', $dataa);
		$json['success']=true;
		echo json_encode($json);
	}
	
	public function sendmassage()
	{
		if($this->session->userdata('adminlogin')){
			$data = $this->Doctor_model->sendmassage();
		 }else{
			redirect("/login");	
		 }
	}
	
	public function getId()
    {	
		$result= $this->Doctor_model->getId();
    	echo $result->message_by;
		exit;
    }
	
	public function getuserdetails()
	{
		
		$userid		= $this->input->post('id');
		$geteuser	= $this->db->get_where('uf_user',array('id' => $userid))->row();
		$html='';
		$html.='
			<div class="col-sm-6">
				<div class="form-group">
					<label>User Name</label>
					<div class="input-group">
					  '.$geteuser->user_name.'
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Display Name</label>
					<div class="input-group">
					  '.$geteuser->display_name.'
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Email</label>
					<div class="input-group">
					  '.$geteuser->email.'
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Phoneno</label>
					<div class="input-group">
					  '.$geteuser->mob_number.'
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Title</label>
					<div class="input-group">
					  '.$geteuser->title.'
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Scoial id</label>
					<div class="input-group">
					  '.$geteuser->socialid.'
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>State</label>
					<div class="input-group">
					  '.$geteuser->state.'
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Latitude </label>
					<div class="input-group">
					  '.$geteuser->user_lat.'
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Longitude</label>
					<div class="input-group">
					  '.$geteuser->user_long.'
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Address</label>
					<div class="input-group">
					  '.$geteuser->address.'
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Zip code</label>
					<div class="input-group">
					  '.$geteuser->zip.'
					</div>
				</div>
			</div>
       ';
		
		$data['result'] = $html;
		$data['username'] = $geteuser->user_name;
		echo json_encode($data);
	}
	
	public function chat_history()
	{
		$result = "";
		$id = $this->session->userdata('id');
		$this->load->model('Ondemand_model');
		$adminIds = $this->Ondemand_model->getAdminIds(array('user_type' => '5'));
		
		foreach ($adminIds as $a) {

			$baseAdminId = $a->id;
			$history = $this->Doctor_model->chat_history($baseAdminId);
			if (count($history) > 0) {

				$data = '';
				foreach ($history as $val) {

					if ($val['message_by'] == $id) {
						$data .= '<li class="left clearfix"><span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/Me" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Me</strong>
                                            <small class="pull-right text-muted">
											<i class="fa fa-clock-o fa-fw"></i> ' . $val['message_date'] . '</small>
                                        </div>
                                        <p>' . $val['message'] . '</p>
                                    </div>
                                </li>';
					} else {
						$data .= '<li class="right clearfix"><span class="chat-img  pull-right"><img src="'.base_url().'/public/images/logo.png" alt="' . $val['sender_name'] . '" class="img-circle" height="50px" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">' . $val['sender_name'] . '</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> ' . $val['message_date'] . '</small>
                                        </div>
                                        <p>' . $val['message'] . '</p>
                                    </div>
                                </li>';
					}
				}
				$result[$baseAdminId] = $data;
			}
		}
		echo json_encode($result);
	}
	
	public function setting(){
		if($this->session->userdata('adminlogin')){
			$data['title']="Site Settings";
			$data['file']='doctor/setting';
			$data['profile'] =$this->common_model->get_data_tbl('uf_user','id',$this->session->userdata('id'));
			$this->load->view('doctor_template',$data);
		}else{
			redirect('panels/supermacdaddy/doctor/login');
		}
	}
	public function updatePassword()
	{
		if(isset($_POST) && $this->input->post('password') !='')
		{
			$user_id = $this->session->userdata('id'); 
			$date	 = date('Y-m-d H:i:s');
			if($this->input->post('password') == $this->input->post('confirmPass')){
				$data = array(
					'password' => md5($this->input->post('password')),
					'user_name' => $this->input->post('user_name'));
			   $this->common_model->update_record($data, 'uf_user', 'id', $this->session->userdata('id'));
				
				$historydata_arr=array("user_id"=>$user_id,"message"=>"Settings ! Updated Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
		
				$this->session->set_flashdata('success_msg', 'Profile Updated Successfully');
				redirect('panels/supermacdaddy/doctor/setting');
			}else{
				$this->session->set_flashdata('error_msg', 'Password not match.');
				redirect('panels/supermacdaddy/doctor/setting');
			}
		}
	}
	
	public function logout()
	{
		$data = array(
				'id' 			=>	"",
				'name' 			=>	"",
				'username' 		=>	"",
				'password' 		=>	"",
				'title'			=>  "",
				'adminlogin' 	=>  "", 
		);
		$this->session->set_userdata($data);       
        $this->session->unset_userdata('login');
        $this->session->sess_destroy();
	    redirect('/');        
    }
	
	public function temp_view()
	{
		$image = '';
		if (!empty($_FILES["image"]["name"])) {
			
			$ad_size = explode("x",$this->input->post('ad_size'));
			$width	= $ad_size[0];
			$height = $ad_size[1];
			$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
			$path = 'uploads/tmp_file';
			$this->upload_image($image, $path);
			$this->uploadimageResize50X50($width,$height);
		}
		$data['success']=$image;
		echo json_encode($data);
	}
	
	
	function uploadimageResize50X50($width,$height){
		$this->load->library('image_lib');
		$image_data =   $this->upload->data();
		$configer =  array(
			'image_library'   => 'gd2',
			'source_image'    =>  $image_data['full_path'],
			'maintain_ratio'  =>  FALSE,
			'width'           =>  $width,
			'height'          =>  $height,
		  );
		  $this->image_lib->clear();
		  $this->image_lib->initialize($configer);
		  $this->image_lib->resize();
	}
	
	function upload_image($image, $path){
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['overwrite'] = FALSE;
        $config['file_name'] = $image;
        $config['max_size'] = '1000000';
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('image')) 
        {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }
    }
	function upload_image_overwrite($image, $path){
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $image;
        $config['max_size'] = '1000000';
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('image')) 
        {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }
    }

      public function composemail()
  {

        $email=$this->input->post('send_to');
        $subject=$this->input->post('send_subject');
        $send_message=$this->input->post('send_message');
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnx');
		$this->email->to($email);
		$this->email->subject('MedConnx:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnx');

		$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('success_msg', 'Mail has sent successfully');
			redirect("panels/supermacdaddy/doctor");
		} else {
			$this->session->set_flashdata('error_msg', 'Sorry  Mail is not sent');
			redirect("panels/supermacdaddy/doctor");
		}
  }
		
}