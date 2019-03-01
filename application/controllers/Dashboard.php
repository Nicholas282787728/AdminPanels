<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->library('form_validation');
	 	$this->load->library('encrypt');
 		$this->load->library('email');
		//load the login model
		$this->load->helper('security');
		$this->load->model('Dashboard_model');
	 	$this->load->model('common_model');
	 		require_once APPPATH . 'third_party/PHPExcel.php';

		if ($this->session->userdata('adminlogin') == "") {
			redirect('/');
		} elseif ($this->session->userdata('adminlogin') == '1') {
			redirect('/panels/supermacdaddy/Ondemand');
		} elseif ($this->session->userdata('adminlogin') == '2') {
			redirect('/panels/supermacdaddy/doctor');
		} elseif ($this->session->userdata('adminlogin') == '3') {
			redirect('/panels/supermacdaddy/Storefronts');
		} elseif ($this->session->userdata('adminlogin') == '4') {
			redirect('sales-admin');
		}
	}

	public function index() {
		redirect('super-admin');
	}

	public function admin() {
		$data['title'] = 'Dashboard :: Home';
		$data['file'] = 'admin/index';

		$data['usercount'] = $this->Dashboard_model->user_count();
		$data['usertype_count'] = $this->Dashboard_model->usertype_count();
		$data['provider_usertype_count'] = $this->Dashboard_model->Provider_usertype_count();
		$data['notification'] = $this->Dashboard_model->notification_history(10);
	    $data['allAdmins'] = $this->Dashboard_model->getAdminIds(array('user_type' => '5'));
		//$data['allAdmins'] = array();
		// $where = array('section'=> 'web');
		//  $data['getTermsAndCondtionWebs'] = $this->Dashboard_model->getTermsAndCondtion('uf_tos',$where);
		//  $where = array('section'=> 'app');
		//  $data['getTermsAndCondtionapps'] = $this->Dashboard_model->getTermsAndCondtion('uf_tos',$where);

		$this->load->view('admin_templates', $data);
		
	}

	public function viewchat() {
		$data['title'] = 'Dashboard :: View Chat';
		$data['file'] = 'admin/view_chat';
		$data['lastuser'] = $this->Dashboard_model->view_chat();

		$this->load->view('admin_templates', $data);
	}

	public function getChatLIst() {
		$allAdmins = $this->Dashboard_model->getAdminIds(array('user_type' => '5'));
		$adminCount = count($allAdmins);
		$data = '';
		if ($adminCount > 0) {
			foreach ($allAdmins as $all) {
				$count = $this->Dashboard_model->countUnreadMessages($all->id);
				if ($count > 0) {
					if ($all->on_off_status == '1') {
						$online = "style='background-color: green !important'";
					} else {
						$online = "style='background-color: #d45226 !important '";
					}
					$color = "style='color:#000;top:-0.7em'";

					$data .= '<div class="panel-heading adi-head-orange2 getCourser" onclick="getChatPanel(' . $all->id . ');" ' . $online . '><i class="fa fa-comments fa-fw"><sup ' . $color . '>' . $count . '</sup></i> User Chat  ' . $all->email . '
                                    </div>';
				}
			}
		} else {
			$data = '<div class="panel-heading adi-head-orange2"  >There is a no admins</div>';
		}

		echo $data;
	}
	
	 
	public function get_provider_list()
	{
		$user_type = $this->input->post('provider_id');
		$getdata = $this->Dashboard_model->get_provider_specificview($user_type);
		$html='';
		if(!empty($getdata))
		{
			foreach($getdata as $view)
			{
				
				$url_visit_panel='';
				if ($user_type == '1') {
					$url_visit_panel = '<a href="'.base_url().'panels/supermacdaddy/Ondemand'.'" class="btn btn-success" target="_blank">Visit Panel</a>';
				} elseif ($user_type == '2') {
					$url_visit_panel= '<a href="'.base_url().'panels/supermacdaddy/doctor'.'" class="btn btn-success" target="_blank">Visit Panel</a>';
				} elseif ($user_type == '3') {
					$url_visit_panel = '<a href="'.base_url().'panels/supermacdaddy/Storefronts'.'" class="btn btn-success" target="_blank">Visit Panel</a>';
				} 
				
				$total_task =$view['totals'];
				$total_comple=$view['completed'];
				$persatage_completed='0';
				if(!empty($total_task))
				{
					$persatage_completed=(100/$total_task)*$total_comple;
				}
				$completed_task= round($persatage_completed,2).'%';
				
				
				$html.='<tr>
				<td>'.$view['id'].'</td>
				<td>'.$view['mob_number'].'</td>
				<td class="getname'.$view['id'].'">'.$view['email'].'</td>
				<td>'.$view['display_name'].'</td>
				<td>'.$view['created_at'].'</td>
				<td>'.$view['last_login'].'</td>
				<td>
				<div class="btn-group">
					<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span> View</button>
					<ul class="dropdown-menu" role="menu">
					  <li>
							<a href="javascript:void(0)" data-id="'.$view['id'].'" class="ratingUsers">Rating</a>
						</li>
						<li>
							<a href="javascript:void(0)" data-id="'.$view['id'].'"><i class="fa fa-edit"></i> Review</a>
						</li>
						
						<li>
							<a href="javascript:void(0)" data-id="'.$view['id'].'"><i class="fa fa-edit"></i> Quality</a>
						</li>
					</ul>
				</div>
				</td>
				<td>'.$url_visit_panel.'</td>
				<td>'.$completed_task.'</td>
				</tr>';
			}
		}
		else
		{
			$msg="No record found..!";
			if(empty($user_type) && $user_type =="")
			{
				$msg="Please Select Provider..";
			}
			$html.='<tr><td colspan="100%" align="center">'.$msg.'</td></tr>';
		}
		$data['success'] = $html;
		echo json_encode($data);
	}
	
	
	
	public function affiliate() {
		if ($this->session->userdata('adminlogin')) {
			$id = $this->session->userdata('id');
			$data['title'] = 'Affiliate Partners';
			$data['file'] = 'admin/affiliate';

			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}



public function citySateAproved() {
		if ($this->session->userdata('adminlogin')) {
			$id = $this->session->userdata('id');
			$data['title'] = 'State City Approved';
			$data['file'] = 'admin/citySateAproved';
			
		
			if(isset($_POST['update']))
			{
				$state	=  $this->input->post('state');
				$city	=  $this->input->post('city');
					$type	=  $this->input->post('type');
				$where = array("state"=>$state,"city"=>$city,"user_type"=>$type);
				$stateCityStatus	=  $this->input->post('stateCityStatus');
				// $dates	= date('Y-m-d H:i:s');
				$data=array("stateCityStatus"=>$stateCityStatus);
				$this->db->where($where);
				$this->db->update('uf_user',$data);


				$data1=array("stateCityStatus"=>$stateCityStatus);
					$where1 = array("state"=>$state,"city"=>$city,"provider_type"=>$type);
				$this->db->where($where1);
				$this->db->update('uf_general_sale',$data1);
				$this->session->set_flashdata('success_msg', 'update successfully');
				redirect("Dashboard/citySateAproved");
			}
		
			
			$data['citySateAprovedStore'] = $this->Dashboard_model->citySateAprovedStore();
						$data['citySateAprovedOndemand'] = $this->Dashboard_model->citySateAprovedOndemand();
								$data['citySateAprovedDoctor'] = $this->Dashboard_model->citySateAprovedDoctor();
			
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}


		function citySatesSearch() {

		$resultarray = array();
		$state = $_REQUEST['state'];
		$type = $_REQUEST['type'];
		
		
	
		$sql = "select distinct (city),stateCityStatus from uf_user where user_type = '".$type."' AND city <>'' AND state = '".$state."'  order by city ASC";
		$query = $this->db->query($sql);
		 $result =$query->result_array();
    		 	echo json_encode($result);
	}




	public function faq_ask_que() {
		if ($this->session->userdata('adminlogin')) {
			$id = $this->session->userdata('id');
			$data['title'] = 'FREQUENTLY ASKED QUESTIONS';
			$data['file'] = 'admin/faq_ask_que';
			
			if(isset($_POST['save']))
			{
				$que	=  $this->input->post('que');
				$ans	=  $this->input->post('ans');
				$dates	= date('Y-m-d H:i:s');
				$dataarr=array("que"=>$que,"ans"=>$ans,"created_date"=>$dates,"update_date"=>$dates,"created_by"=>$id);
				$this->db->insert('faq_ask_que',$dataarr);
				$this->session->set_flashdata('success_msg', 'add successfully');
				redirect("faq");
			}
			if(isset($_POST['update']))
			{
				$que	=  $this->input->post('que');
				$ans	=  $this->input->post('ans');
				$up_id	=  $this->input->post('update');
				$dates	= date('Y-m-d H:i:s');
				$dataarr=array("que"=>$que,"ans"=>$ans,"update_date"=>$dates,"created_by"=>$id);
				$this->db->where('f_id',$up_id);
				$this->db->update('faq_ask_que',$dataarr);
				$this->session->set_flashdata('success_msg', 'update successfully');
				redirect("faq");
			}
			if(isset($_POST['delete']))
			{
				$delete_id	=  $this->input->post('delete');
				$this->db->where('f_id',$delete_id);
				$this->db->delete('faq_ask_que');
				$this->session->set_flashdata('success_msg', 'Delete successfully');
				redirect("faq");
			}
			
			$data['getfaq_ask_que'] = $this->Dashboard_model->getfaq_ask_que();
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}
	
		public function edit_faq_ask_que() {
		$result = $this->Dashboard_model->edit_faqaskque();
		echo '<div class="form-group">
					<label>Question</label>
					<input class="form-control valid" name="que" autocomplete="off" value="'.$result['que'].'" type="text" required="">
				</div>
				<div class="form-group">
					<label>Answer</label>
					<textarea rows="5" cols="117" name="ans" class="note-codable form-control" required="">'.$result['ans'].'</textarea>
				</div>

				<div class="row">
					<div class="col-xs-12">
						<button name="update" type="submit" value="'.$result['f_id'].'" class="btn-green js-location-create">Update</button>
					</div>
				</div>
		';
	}
	
	public function ratings() {
		if ($this->session->userdata('adminlogin')) {
			$id = $this->session->userdata('id');
			$data['title'] = 'ratings_list';
			$data['file'] = 'admin/ratings_list';
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function reject_pending_providers() {
		$user_id = $this->input->post('user_id');
		$user_email = $this->input->post('user_email');
		$user_reason_msg = $this->input->post('user_reason_msg');
		$this->Dashboard_model->uf_user_remove($user_id);
		$email = $user_email;
		$this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnex');
		$this->email->to($email);
		$this->email->subject('MedConnex::Reject Your Account');
		$this->email->message('Hello ' . $user_email . ',
				<br>Your account has been Reject on <b>MedConnex</b> team.<br><br>Reason of ' . $user_reason_msg . '
				<br> contact our staff at info@medconnex.net
				<br>
				Thank you,<br>
				MedConnex');
		$this->email->send();
		$msg = "<div class='alert alert-info' style='float: center;text-transform: capitalize;' id='success-alert'>$user_email Reject Successfully</div>";
		$data['msg'] = $msg;
		$data['success'] = true;
		echo json_encode($data);
	}

	public function chat_history_userwise() {
		$user_id = $this->input->post('id');
		$history = $this->Dashboard_model->chat_history_userwise($user_id);
		$html = '';
		if (!empty($history)) {
			foreach ($history as $val) {
				$mid = $val['message_by'];
				if ($val['message_by'] == $user_id) {
					$html .= '<li class="left clearfix " >
							<span class="chat-img pull-left"><img src="' . base_url() . 'public/images/member.jpg" width="50px" alt="me" class="img-circle" /></span>
							<div class="chat-body clearfix">
								<div class="header">
									<strong class="primary-font pull-left">Me</strong>
									<small class="pull-right text-muted">
									<i class="fa fa-clock-o fa-fw"></i> ' . $val['message_date'] . '</small>
								</div><br/>
								<p class="pull-left">' . $val['message'] . '</p>
							</div>
						</li>';
				}
				if ($val['message_by'] != $user_id) {
					$html .= '<li style="cursor:pointer;" class="right clearfix" >
							<span class="chat-img  pull-right"><img src="' . base_url() . 'public/images/member.jpg" width="50px" alt=' . $val['user_name'] . ' class="img-circle" /></span>
							<div class="chat-body clearfix">
								<div class="header">
									<strong class="primary-font pull-right" >' . $val['user_name'] . ' </strong>
									<small class="pull-left text-muted"><i class="fa fa-clock-o fa-fw"></i> ' . $val['message_date'] . '</small>
								</div><br/>
								<p class="pull-right">' . $val['message'] . '</p>
							</div>
						</li>';
				}
			}
		} else {
			$html .= '<div>Empty Chat History....</div>';
		}

		$data['success'] = $html;
		echo json_encode($data);
	}
	
	

	public function edit_user() {
		$result = $this->Dashboard_model->userdetail();
		$title = !empty($result['user_type']) ? $result['user_type'] : '';
		$selected1 = $selected2 = $selected3 = "";
		if (strtolower($title == "1")) {
			$selected1 = "selected";
		} elseif (strtolower($title == "2")) {
			$selected2 = "selected";
		} elseif (strtolower($title == "3")) {
			$selected3 = "selected";
		}
		echo '<div class="col-sm-6">
            <div class="form-group">
                <label>User Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input  name="user_id"  value="' . $result['id'] . '"  type="hidden">
                    <input  class="form-control" name="user_name" autocomplete="off" value="' . $result['user_name'] . '" placeholder="Please enter the First Name" type="text" >
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label>Display Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="display_name" autocomplete="off" value="' . $result['display_name'] . '" placeholder="Please enter the Last Name" type="text" required>
                </div>
            </div>
        </div>               
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Provider Type </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
					<select id="input_locale" class="form-control" name="user_type" title="Locale" required>
						<option value="1" ' . $selected1 . '>Driver</option>
						<option value="2" ' . $selected2 . '>Doctor</option>
						<option value="3" ' . $selected3 . '>Storefront</option>
					</select>
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Email</label>
                <div class="input-group">
                    <span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
                    <input readonly class="form-control" name="email" autocomplete="off" value="' . $result['email'] . '" placeholder="Email address" type="text">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Contact </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="contact" value="' . $result['mob_number'] . '" autocomplete="off" placeholder="" type="text" required>
                </div>
            </div>
        </div>
		';
	}

	public function pending_providers() {
		$data['title'] = 'pending_providers';
		$data['file'] = 'admin/pending_providers';

		if (isset($_POST['deactive'])) {
			$uid = $_POST['deactive'];
			$dataa = array("is_verify" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("pending-providers");
		}
		if (isset($_POST['active'])) {
			$uid = $_POST['active'];
			$get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `id` = '" . $uid . "' ")->row_array();
			$en_id = md5($get_query['email']);
			$pro_img=base_url().'public/images/logo.png';
			$dataa = array("is_verify" => '1', 'secret_token' => $en_id, 'password' => $en_id,"profile_pic"=>$pro_img);
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			if (!empty($get_query['email'])) {
				$email = $get_query['email'];
				$this->email->set_mailtype("html");
				$this->email->from('info@medconnex.net', 'MedConnex');
				$this->email->to($email);
				$this->email->subject('MedConnex::Set Password');
				$this->email->message('Hello ' . $get_query['email'] . ',
						<br>Your account has been created on <b>MedConnex</b> team.<br><br>Please set password for your account
						<a href="' . base_url() . 'home/setpassword?auth_token=' . $en_id . '">' . base_url() . 'home/setpassword?auth_token=' . $en_id . '</a>
						<br> contact our staff at info@medconnex.net
						<br>
						Thank you,<br>
						MedConnex');
				$mailsend = $this->email->send();
			}
			$this->session->set_flashdata('success_msg', 'Active successfully');
			redirect("pending-providers");
		}
		if (isset($_POST['type'])) {
			$type = $_POST['type'];
			$data['alluser'] = $this->Dashboard_model->alluserpandding_provider($type);
		} else {
			$data['alluser'] = $this->Dashboard_model->alluserpandding_provider();
		}
		$this->load->view('admin_templates', $data);
	}
	public function user_verification($value='')
	{
			$data['title'] = 'pending_providers';
		$data['file'] = 'admin/user_verifications';

		if (isset($_POST['deactive'])) {
			$uid = $_POST['deactive'];
			$dataa = array("is_verify" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'User is Disable successfully');
			redirect("user-verification");
		}
		if (isset($_POST['active'])) {
			$uid = $_POST['active'];
			$get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `id` = '" . $uid . "' ")->row_array();
			$en_id = md5($get_query['email']);
			$pro_img=base_url().'public/images/logo.png';
			$dataa = array("is_verify" => '1', 'secret_token' => $en_id, 'password' => $en_id,"profile_pic"=>$pro_img);
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			if (!empty($get_query['email'])) {
				$email = $get_query['email'];
				$this->email->set_mailtype("html");
				$this->email->from('info@medconnex.net', 'MedConnex');
				$this->email->to($email);
				$this->email->subject('MedConnex::Set Password');
				$this->email->message('Hello ' . $get_query['email'] . ',
						<br>Your account has been created on <b>MedConnex</b> team.<br><br>Please set password for your account
						<a href="' . base_url() . 'home/setpassword?auth_token=' . $en_id . '">' . base_url() . 'home/setpassword?auth_token=' . $en_id . '</a>
						<br> contact our staff at info@medconnex.net
						<br>
						Thank you,<br>
						MedConnex');
				$mailsend = $this->email->send();
			}
			$this->session->set_flashdata('success_msg', 'user is active successfully');
			redirect("user-verification");
		}
	
			$data['alluser'] = $this->Dashboard_model->getWhereMore('uf_user', array('user_type' =>'0' , "is_verify" => '0'));
		
		$this->load->view('admin_templates', $data);
	}
	
	public function pending_interviews() {
		$data['title'] = 'pending_interviews'; 
		$data['file'] = 'admin/pending_interviews';

		if (isset($_POST['deactive'])) {
			$uid = $_POST['deactive'];
			$dataa = array("is_verify" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			$this->db->last_query();			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("pending-providers");
		}
		if (isset($_POST['active'])) {
			$uid = $_POST['active'];
			$get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `id` = '" . $uid . "' ")->row_array();
			$en_id = md5($get_query['email']);
			$pro_img=base_url().'public/images/logo.png';
			$dataa = array("is_verify" => '1', 'secret_token' => $en_id, 'password' => $en_id,"profile_pic"=>$pro_img);
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			if (!empty($get_query['email'])) {
				$email = $get_query['email'];
				$this->email->set_mailtype("html");
				$this->email->from('info@medconnex.net', 'MedConnex');
				$this->email->to($email);
				$this->email->subject('MedConnex::Set Password');
				$this->email->message('Hello ' . $get_query['email'] . ',
						<br>Your account has been created on <b>MedConnex</b> team.<br><br>Please set password for your account
						<a href="' . base_url() . 'home/setpassword?auth_token=' . $en_id . '">' . base_url() . 'home/setpassword?auth_token=' . $en_id . '</a>
						<br> contact our staff at info@medconnex.net
						<br>
						Thank you,<br>
						MedConnex');
				$mailsend = $this->email->send();
			}
			$this->session->set_flashdata('success_msg', 'Active successfully');
			redirect("pending-providers");
		}
		$data['alluser'] = $this->Dashboard_model->get_Pendding_interviews();
		$this->load->view('admin_templates', $data);
	}

	public function users() {
		$data['title'] = 'Users';
		$data['file'] = 'admin/users';

		if (isset($_POST['enable'])) {
			$uid = $_POST['enable'];
			$dataa = array("flag_enabled" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("authorized-users");
		} elseif (isset($_POST['disable'])) {
			$uid = $_POST['disable'];
			$dataa = array("flag_enabled" => '1');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			$this->session->set_flashdata('success_msg', 'Enable successfully');
			redirect("authorized-users");
		} elseif (isset($_POST['delete'])) {
			$uid = $_POST['delete'];
			$this->db->where('id', $uid);
			$this->db->delete('uf_user');
			$this->session->set_flashdata('success_msg', 'Delete successfully');
			redirect("authorized-users");
		} elseif (isset($_POST['save'])) {


			$sql = "select id from uf_user where email = 	'".$this->input->post('email')."' ";
			
		$query = $this->db->query($sql);
		$existEmail = $query->result();
		if(!empty($existEmail)){
			$this->session->set_flashdata('error_msg', 'This <strong>' . $this->input->post('email'). ' </strong> Is Already Exist  ');
				redirect("authorized-users");

		}
		else{



			if (!empty($this->input->post('contact')) && !empty($this->input->post('user_name')) && !empty($this->input->post('email'))) {
				$result = $this->Dashboard_model->add_user();
				if ($result) {
					$email = $this->input->post('email');
					$en_id = $result; // $time.$this->security->get_csrf_hash();//$this->encrypt->encode($id);
					$this->email->set_mailtype("html");
					$this->email->from('info@medconnex.net', 'MedConnex');
					$this->email->to($email);
					$this->email->subject('MedConnex::Set Password');
					$this->email->message('Hello ' . $email . ',
						<br>Your account has been created on <b>MedConnex</b> team.<br><br>Please set password for your account
						<a href="' . base_url() . 'setpassword?auth_token=' . $en_id . '">Mail send fail click below link</a>
						<br> contact our staff at info@medconnex.net
						<br>
						Thank you,<br>
						MedConnex');
					$mailsend = $this->email->send();

					if ($mailsend) {
						$this->session->set_flashdata('success_msg', 'Check Your <strong>' . $email . ' </strong> to recover you password');
						redirect("authorized-users");
					} else {
						$this->session->set_flashdata('success_msg', 'Sorry  mail not sent');
						// $this->session->set_flashdata('success_msg', 'Sorry ' . base_url() . 'opening?token=' . $en_id . ' mail not sent');
						redirect("authorized-users");
					}
				} else {
					$this->session->set_flashdata('success_msg', $user_result);
					redirect("authorized-users");
				}
			} else {
				$this->session->set_flashdata('error_msg', 'User Name, Email, Telephone No. Required! ');
				redirect("authorized-users");
			}
}

		} elseif (isset($_POST['update'])) {
			if (!empty($this->input->post('contact')) && !empty($this->input->post('user_name')) && !empty($this->input->post('email'))) {
				$result = $this->Dashboard_model->update_user();
				if ($result) {
					$this->session->set_flashdata('success_msg', "User data updated successfully");
					redirect("authorized-users");
				} else {
					$this->session->set_flashdata('success_msg', "User data not updated");
					redirect("authorized-users");
				}
			} else {
				$this->session->set_flashdata('error_msg', 'User Name, Email, Telephone No. Required! ');
				redirect("authorized-users");
			}
		} elseif (isset($_POST['save_authorized_task'])) {
			$ids = $this->input->post('user_id'); //multi user

			$task_details = $this->input->post('task_details');
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			$session_uid = $this->session->userdata('id');
			$created_mail = $this->session->userdata('username');
			$image = '';
			if (!empty($_FILES["image"]["name"])) {
				if(file_exists(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image_task')))
				{
					unlink(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image_task'));
				}
				$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				$path = 'uploads';
				$this->upload_image($image, $path);
			}


			if (!empty($task_details) && $task_details != "<br>") {
				foreach ($ids as $id) {
					$match_user = $this->Dashboard_model->get_user_match($id);
					$user_mail = $match_user['email'];
					$end_date_last = date('Y-m-d', strtotime($end_date));
					$start_date_last = date('Y-m-d', strtotime($start_date));
					$data_arr = array("staff_id" => $id, "task_description" => $task_details, "start_date" => $start_date_last, "end_date" => $end_date_last, "close_date" => $end_date_last, "crdate" => date('Y-m-d H:i:s'), "attachment" => $image);
					$this->db->insert("sal_task", $data_arr);

					$notify_ins = array("user_id" => $id, "read_status" => 1, "type_read" => 2, "created_by" => $session_uid, "message" => 'Authorized Users Task Created By ' . $created_mail, "created_at" => date('Y-m-d H:i:s'));
					$this->db->insert('notification_history', $notify_ins);

					if (!empty($user_mail)) { //user
						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnex');
						$this->email->to($user_mail);
						$this->email->subject('MedConnex::Authorized Task Created');
						$this->email->message('Hello ' . $user_mail . ',
								<br>Your task has been created on <b>MedConnex</b> team.<br><br>
								' . $task_details . '
								<br> contact our staff at info@medconnex.net
								<br>
								Thank you,<br>
								MedConnex');
						if (!empty($image)) {
							$this->email->attach(base_url() . 'uploads' . $image . '');
						}
						$mailsend = $this->email->send();
					}
					if (!empty($created_mail)) { //admin	
						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnex');
						$this->email->to($created_mail);
						$this->email->subject('MedConnex::Authorized Task Created');
						$this->email->message('Hello ' . $created_mail . ',
								<br>Task has been created <br><br>
								' . $task_details . '
								<br> contact our staff at info@medconnex.net
								<br>
								Thank you,<br>
								MedConnex');
						if (!empty($image)) {
							$this->email->attach(base_url() . 'uploads' . $image . '');
						}
						$mailsend = $this->email->send();
					}
				}

				$this->session->set_flashdata('success_msg', 'add task successfully');
				redirect("authorized-users");
			} else {
				$this->session->set_flashdata('error_msg', 'Empty Task Details..!');
				redirect("authorized-users");
			}
		} elseif (isset($_POST['send_authorized_message'])) {
			$user_ids = $this->input->post('message_user_id');
			$message_details = $this->input->post('message_details');
			$created_id = $this->session->userdata('id');
			$image = '';
			if (!empty($_FILES["image"]["name"])) {
				//tmp_view remove
				if(file_exists(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image')))
				{
					unlink(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image'));
				}
				$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				$path = 'uploads';
				$this->upload_image($image, $path);
			}

			$created_mail = $this->session->userdata('username');

			if (!empty($message_details) && $message_details != "<br>") {

				foreach ($user_ids as $user_id) {
					$match_user = $this->Dashboard_model->get_user_match($user_id);
					$user_mail = $match_user['email'];
					$notify_ins = array("user_id" => $user_id, "read_status" => 1, "type_read" => 3, "created_by" => $created_id, "message" => 'MESSAGE ! ' . $message_details, "created_at" => date('Y-m-d H:i:s'), "attachment" => $image);
					$this->db->insert('notification_history', $notify_ins);

					if (!empty($user_mail)) {
						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnex');
						$this->email->to($user_mail);
						$this->email->subject('MedConnex::Authorized Message');
						$this->email->message('Hello ' . $user_mail . ',
								<br>
								' . $message_details . '
								<br> contact our staff at info@medconnex.net
								<br>
								Thank you,<br>
								MedConnex');
						if (!empty($image)) {
							$this->email->attach(base_url() . 'uploads' . $image . '');
						}
						$mailsend = $this->email->send();
					}
					if (!empty($created_mail)) {
						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnex');
						$this->email->to($created_mail);
						$this->email->subject('MedConnex::Authorized Message');
						$this->email->message('Hello ' . $created_mail . ',
								<br>
								' . $message_details . '
								<br> contact our staff at info@medconnex.net
								<br>
								Thank you,<br>
								MedConnex');
						if (!empty($image)) {
							$this->email->attach(base_url() . 'uploads' . $image . '');
						}
						$mailsend = $this->email->send();
					}
				}
				$this->session->set_flashdata('success_msg', 'send message successfully');
				redirect("authorized-users");
			} else {
				$this->session->set_flashdata('error_msg', 'Empty Message..!');
				redirect("authorized-users");
			}
		} elseif (isset($_POST['save_password'])) {
			$user_id = $this->input->post('user_id');
			$flag_password_reset = $this->input->post('flag_password_reset');
			$password_mode = $this->input->post('change_password_mode');
			if ($password_mode == "link") {
				$get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `id` = '" . $user_id . "' ")->row_array();
				$en_id = md5($get_query['email']);
				$dataa = array('secret_token' => $en_id);
				$this->db->where('id', $user_id);
				$this->db->update('uf_user', $dataa);
				if (!empty($get_query['email'])) {
					$email = $get_query['email'];
					$this->email->set_mailtype("html");
					$this->email->from('info@medconnex.net', 'MedConnex');
					$this->email->to($email);
					$this->email->subject('MedConnex::Set Password');
					$this->email->message('Hello ' . $get_query['email'] . ',
							<br>Your Forget Password has been created on <b>MedConnex</b> team.<br><br>Please set password for your account
							<a href="' . base_url() . 'home/setpassword?auth_token=' . $en_id . '">' . base_url() . 'home/setpassword?auth_token=' . $en_id . '</a>
							<br> contact our staff at info@medconnex.net
							<br>
							Thank you,<br>
							MedConnex');
					$mailsend = $this->email->send();
				}
				$this->session->set_flashdata('success_msg', 'send link successfully ! ');
			} else {
				$password = md5($this->input->post('password'));
				$data_arr = array('password' => $password);
				$this->db->where('id', $user_id);
				$this->db->update('uf_user', $data_arr);
				$this->session->set_flashdata('success_msg', 'updated password successfully ! ');
			}
			redirect("authorized-users");
		} 
          $config = array();
		      $config["base_url"] = base_url('authorized-users');
		      $config["total_rows"] = $this->Dashboard_model->record_count('uf_user');
		      $config["per_page"] = 20;
		      $config["uri_segment"] = 2;
		      $config['full_tag_open']    = "<ul class='pagination'>";
		      $config['full_tag_close']   = "</ul>";
		      $config['num_tag_open']     = '<li class="page-item">';
		      $config['num_tag_close']    = '</li>';
		      $config['cur_tag_open']     = "<li class='page-item disabled paginate_button active'><a class='page-link' href='javascript:void(0)'>";
		      $config['cur_tag_close']    = "</a></li>";
		      $config['first_link'] = false;
		      $config['last_link'] = false;
		      $config['prev_link'] = '</i> Previous';
		      $config['prev_tag_open'] = '<li>';
		      $config['prev_tag_close'] = '</li>';
		      $config['next_link'] = 'Next ';
		      $config['next_tag_open'] = '<li>';
		      $config['next_tag_close'] = '</li>';
		      $this->pagination->initialize($config);
		      $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			if (isset($_POST['type'])) {
			$type = $_POST['type'];


			$data['alluser'] = $this->Dashboard_model->alluser($config["per_page"], $page,$type);
			} else {
			$data['alluser'] = $this->Dashboard_model->alluser($config["per_page"], $page,$type='');
			}
		    
		      $data['links']= $this->pagination->create_links();
		      $data["total_rows"] = $this->Dashboard_model->record_count('uf_user');
              

		$this->load->view('admin_templates', $data);
	}
	
	public function dataview()
	{
		$image = '';
		if (!empty($_FILES["image"]["name"])) {
			$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
			$path = 'uploads/tmp_file';
			$this->upload_image($image, $path);
			
		}
		$data['success']=$image;
		echo json_encode($data);
	}
	
	public function get_user_provider() {
		$user_type = $this->input->post('user_type');
		$getdata = $this->Dashboard_model->get_provider_specific($user_type);
		$html ="";
		if(!empty($getdata))
		{
			foreach($getdata as $view)
			{
				$username = !empty($view['user_name'])?($view['user_name']):'' ;
				$html .= '<option value='.$view['id'].'>'.$view['email'].$username.'</option>';
			}
		}
		$data['success'] = $html;
		echo json_encode($data);
	}
	
	
	public function aut_users() {
		$result = $this->Dashboard_model->aut_users_detail();
			$user_type=$result['user_type'];
			$sel_1	=	($user_type == "5")?'selected':'';
			$sel_2	=	($user_type == "4")?'selected':'';
			$sel_3	=	($user_type == "6")?'selected':'';
			$sel_4	=	($user_type == "7")?'selected':'';
			$sel_5	=	($user_type == "8")?'selected':'';
			$sel_6	=	($user_type == "9")?'selected':'';
			
		echo '<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Contractor Name</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="user_name" autocomplete="off" value="' . $result['user_name'] . '"   placeholder="" type="text">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Display Name</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control"  name="display_name" autocomplete="off" value="' . $result['display_name'] . '" required placeholder="Please enter the Display Name" type="text">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group ">
						<label>Email</label>
						<div class="input-group">
							<span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
							<input class="form-control" name="email" autocomplete="off" value="' . $result['email'] . '" placeholder="" readonly type="email">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group ">
						<label>Contact </label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control"  name="contact" autocomplete="off" value="' . $result['mob_number'] . '" required placeholder="Contact number" type="text">
						</div>
					</div>
				</div>
				  <div class="col-sm-6">
					<div class="form-group ">
						<label>User Type</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<select id="input_locale" class="form-control" name="user_type"  required>
								<option value="5" '.$sel_1.'>Admin</option>
								<option value="4" '.$sel_2.'>Sales</option>
								<option value="6" '.$sel_3.'>Promotions</option>
								<option value="7" '.$sel_4.'>Marketing</option>
								<option value="8" '.$sel_5.'>Development</option>
								<option value="9" '.$sel_6.'>Editorial</option>
							</select>
						</div>
					</div>
				</div>	 					
			</div><br>
			<div class="row modal-footer">
				<div class="creatUserBottom ">
					<div class="">
						<div class="vert-pad">
							<button type="submit" name="updatesale" value="' . $result['id'] . '" class="btn-green">Update User</button>
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
	
	public function bulk_upload_storefornt(){
		require_once APPPATH . 'third_party/PHPExcel.php';
		$this->load->model('Store_model');
		$this->excel = new PHPExcel();

		if ($_POST['upload_data']) {
			$user_id = $this->session->userdata('id');
			ini_set('max_execution_time', -1);

			$file_info = pathinfo($_FILES["upload_sheet"]["name"]);
			$file_directory = "uploads/";
			$new_file_name = "store".date("d-m-Y ") . rand(000000, 999999) . "." . $file_info["extension"];

			if (move_uploaded_file($_FILES["upload_sheet"]["tmp_name"], $file_directory . $new_file_name)) {
				$file_type = PHPExcel_IOFactory::identify($file_directory . $new_file_name);
				$objReader = PHPExcel_IOFactory::createReader($file_type);
				$objPHPExcel = $objReader->load($file_directory . $new_file_name);

				$sheet_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
								
				$i = 0;
				foreach ($sheet_data as $row) {
					      print_r($row);
                               die();

					if ($i == 0) {
						
					} else {
						if(!empty($row['P']))
						{

                             
							$get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `email` = '" . $row['P'] . "' ")->row_array();
							if(empty($get_query))
							{
								$data_bl_user = array(
									"email"=>$row['P'],
									"display_name" => $row['B'], 
									"state"=>$row['E'],
									"zip"=>$row['F'],
									"mob_number"=>$row['Q'],
									"last_login"=>$row['S'],
									"user_lat"=>$row['W'],
									"user_long"=>$row['X'],
									"on_off_status"=> "0",
									"title" => "Storefront",
									"user_type" => 3,
									"is_verify" => 1,
									"about_me" => $row['AD'],
									);

								$data_bulk_location = array("paypal_business_name"=>$row['B'],
									"city"=>$row['D'],
									"email"=>$row['P'],
									"phone_number"=>$row['Q'],
									"longitude"=>$row['X'],
									"latitude"=>$row['W']);

								$bulk1 = $this->Store_model->insert_user_data($data_bl_user, $data_bulk_location);
								$this->session->set_flashdata('success_msg', 'Upload successfully');
							}
						}
						else
						{
							$this->session->set_flashdata('error_msg', 'Please Fill Your Email on Your Sheet');
						}
					}
					$i++; 
				}
			}
		}
		redirect('authorized-users');
	}

	public function bulk_upload_ondemand(){
		require_once APPPATH . 'third_party/PHPExcel.php';
		$this->load->model('Store_model');
		$this->excel = new PHPExcel();

		if ($_POST['upload_ondemand']) {
			$user_id = $this->session->userdata('id');
			ini_set('max_execution_time', -1);

			$file_info = pathinfo($_FILES["upload_sheet"]["name"]);
			$file_directory = "uploads/";
			$new_file_name = "store".date("d-m-Y ") . rand(000000, 999999) . "." . $file_info["extension"];

			if (move_uploaded_file($_FILES["upload_sheet"]["tmp_name"], $file_directory . $new_file_name)) {
				$file_type = PHPExcel_IOFactory::identify($file_directory . $new_file_name);
				$objReader = PHPExcel_IOFactory::createReader($file_type);
				$objPHPExcel = $objReader->load($file_directory . $new_file_name);

				$sheet_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				$i = 0;
				foreach ($sheet_data as $row) {

					if ($i == 0) {
						
					} else {
						if(!empty($row['P']))
						{
							$get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `email` = '" . $row['P'] . "' ")->row_array();
							if(empty($get_query))
							{
								$data_bl_user = array(
											"email"=>$row['P'],
											"display_name" => $row['B'], 
											"state"=>$row['E'],
											"zip"=>$row['F'],
											"mob_number"=>$row['Q'],
											"last_login"=>$row['S'],
											"user_lat"=>$row['W'],
											"user_long"=>$row['X'],
											"on_off_status"=> "0",
											"title" => "Ondemand",
											"user_type" => 1,
											"is_verify" => 1,
											"socialid" =>$row['AA'],
											"about_me" => $row['AD'],
											);

								$data_bulk_location = array("paypal_business_name"=>$row['B'],
											"city"=>$row['D'],
											"email"=>$row['P'],
											"phone_number"=>$row['Q'],
											"longitude"=>$row['X'],
											"latitude"=>$row['W']);
								
								$this->Store_model->insert_user_data($data_bl_user, $data_bulk_location);
								$this->session->set_flashdata('success_msg', 'Upload successfully');
							}
						}
						else
						{
							$this->session->set_flashdata('error_msg', 'Please Fill Your Email on Your Sheet');
						}
					}
					$i++; 
				}
			}
		}
		redirect('authorized-users');
	}

	public function hiring_on_off() {
		$on_off_val = $this->input->post('on_off_val');
	
		$nm = "hiring";
		$msg = false;
		$detail = '';
		if ($on_off_val != "") {
			$row = $this->Dashboard_model->getdataconfigration($nm);
			if (!empty($row)) {
				$msg = true;
				$data_arr = array("value" => $on_off_val);
				$this->Dashboard_model->update_configration($row['id'], $data_arr);
				$detail .= '<div role="alert" class="alert alert-success">
                            <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                           update successfully!
                    </div>';
			}
		}
		$data['success'] = $msg;
		$data['msg'] = $detail;
		echo json_encode($data);
	}

	public function sales() {
		$data['title'] = 'Users';
		$data['file'] = 'admin/sales_list';

		$nm = "hiring";
		$row = $this->Dashboard_model->getdataconfigration($nm);
		$data['config_on_off'] = !empty($row['value']) ? $row['value'] : '0';
		$data['all_staff'] = $this->Dashboard_model->all_auth_user();
		$data['totalContractors'] = $this->Dashboard_model->totalContractors();
		$session_uid = $this->session->userdata('id');
		if (isset($_POST['enable'])) {
			$uid = $_POST['enable'];
			$data = array("flag_enabled" => '1', "is_verify" => '1');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $data);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Enabled successfully');
			redirect("sales");
		} elseif (isset($_POST['disable'])) {
			$uid = $_POST['disable'];
			$data = array("flag_enabled" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $data);
			$this->session->set_flashdata('success_msg', 'Disabled successfully');
			redirect("sales");
		} elseif (isset($_POST['delete'])) {
			$uid = $_POST['delete'];
			$this->db->where('id', $uid);
			$this->db->delete('uf_user');
			$this->session->set_flashdata('success_msg', 'Deleted successfully');
			redirect("sales");
		} elseif (isset($_POST['save'])) {
			$this->form_validation->set_rules('contact', 'contact', 'trim|required');
			$this->form_validation->set_rules('user_name', 'user name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin_templates', $data);
			} else {
				$result = $this->Dashboard_model->add_auth_user();
				if ($result) {
					$email = $this->input->post('email');
					$en_id = md5($email);
					$this->email->set_mailtype("html");
					$this->email->from('info@medconnex.net', 'MedConnex');
					$this->email->to($email);
					$this->email->subject('MedConnex::Set Password');
					$msg = $this->email->message('Hello ' . $email . ',
						<br>Your account has been created on <b>MedConnex</b> team<br><br>
						Please set password for your account
						<a href="' . base_url() . 'home/setpassword?auth_token=' . $en_id . '">' . base_url() . 'setpassword?auth_token=' . $en_id . '</a>
						<br> contact our staff at info@medconnex.net
						<br>
						Thank you,<br>
						MedConnex');
					$mailsend = $this->email->send();
					if ($mailsend) {
						$this->session->set_flashdata('success_msg', 'Email send to <strong>' . $email . ' </strong>');
						redirect("sales");
					} else {
						$this->session->set_flashdata('success_msg', 'Sorry mail not sent');
						redirect("sales");
					}
				} else {
					$this->session->set_flashdata('success_msg', "something went wrong.");
					redirect("sales");
				}
			}
		} elseif (isset($_POST['updatesale'])) {
			$id = $this->input->post('updatesale');
			$this->form_validation->set_rules('contact', 'contact', 'trim|required');
			$this->form_validation->set_rules('user_name', 'user name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin_templates', $data);
			} else {
				$result = $this->Dashboard_model->update_aut_user($id);
				$this->session->set_flashdata('success_msg', 'Data Updated successfully');
				redirect("sales");
			}
		} elseif (isset($_POST['save_task'])) {
			$ids = $this->input->post('user_id');
			$task_details = $this->input->post('task_details');
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			$user_name = $this->session->userdata('name');

			$created_mail = $this->session->userdata('username');

			$image = '';
			if (!empty($_FILES["image"]["name"])) {
				if(file_exists(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image_task')))
				{
					unlink(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image_task'));
				}
				$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				$path = 'uploads';
				$this->upload_image($image, $path);
			}



			if (!empty($task_details) && $task_details != "<br>") {
				foreach ($ids as $id) {
					$match_user = $this->Dashboard_model->get_user_match($id);
					$user_mail = $match_user['email'];
					$start_date_last = date('Y-m-d', strtotime($start_date));
					$end_date_last = date('Y-m-d', strtotime($end_date));
					$data_arr = array("staff_id" => $id, "task_description" => $task_details, "start_date" => $start_date_last, "end_date" => $end_date_last, "close_date" => $end_date_last, "crdate" => date('Y-m-d H:i:s'), "attachment" => $image);
					$this->db->insert("sal_task", $data_arr);

					$notify_ins = array("user_id" => $id, "read_status" => 1, "type_read" => 2, "created_by" => $session_uid, "message" => 'Sales Task Created By ' . $user_name, "created_at" => date('Y-m-d H:i:s'));
					$this->db->insert('notification_history', $notify_ins);
					if (!empty($user_mail)) { //user
						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnex');
						$this->email->to($user_mail);
						$this->email->subject('MedConnex::Sales Task Created');
						$this->email->message('Hello ' . $user_mail . ',
								<br>Your task has been created on <b>MedConnex</b> team.<br><br>
								' . $task_details . '
								<br> contact our staff at info@medconnex.net
								<br>
								Thank you,<br>
								MedConnex');
						if (!empty($image)) {
							$this->email->attach(base_url() . 'uploads' . $image . '');
						}
						$mailsend = $this->email->send();
					}
					if (!empty($created_mail)) { //admin	
						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnex');
						$this->email->to($created_mail);
						$this->email->subject('MedConnex::Sales Task Created');
						$this->email->message('Hello ' . $created_mail . ',
								<br>Task has been created <br><br>
								' . $task_details . '
								<br> contact our staff at info@medconnex.net
								<br>
								Thank you,<br>
								MedConnex');
						if (!empty($image)) {
							$this->email->attach(base_url() . 'uploads' . $image . '');
						}
						$mailsend = $this->email->send();
					}
				}
				$this->session->set_flashdata('success_msg', 'add task successfully');
				redirect("sales");
			} else {
				$this->session->set_flashdata('error_msg', 'Empty Task Details..!');
				redirect("sales");
			}
		} elseif (isset($_POST['send_message'])) {
			$user_ids = $this->input->post('message_user_id');
			$message_details = $this->input->post('message_details');
			$created_id = $this->session->userdata('id');
			$created_mail = $this->session->userdata('username');
			$image = '';
			if (!empty($_FILES["image"]["name"])) {
				
				if(file_exists(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image')))
				{
					unlink(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image'));
				}
				$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				$path = 'uploads';
				$this->upload_image($image, $path);
			}

			foreach ($user_ids as $user_id) {
				$match_user = $this->Dashboard_model->get_user_match($user_id);
				$user_mail = $match_user['email'];

				$notify_ins = array("user_id" => $user_id, "read_status" => 1, "type_read" => 3, "created_by" => $session_uid, "message" => 'MESSAGE ! ' . $message_details, "created_at" => date('Y-m-d H:i:s'), "attachment" => $image);
				$this->db->insert('notification_history', $notify_ins);

				if (!empty($user_mail)) {
					$this->email->set_mailtype("html");
					$this->email->from('info@medconnex.net', 'MedConnex');
					$this->email->to($user_mail);
					$this->email->subject('MedConnex::Sales Message');
					$this->email->message('Hello ' . $user_mail . ',
							<br>
							' . $message_details . '
							<br> contact our staff at info@medconnex.net
							<br>
							Thank you,<br>
							MedConnex');
					if (!empty($image)) {
						$this->email->attach(base_url() . 'uploads' . $image . '');
					}
					$mailsend = $this->email->send();
				}
				if (!empty($created_mail)) {
					$this->email->set_mailtype("html");
					$this->email->from('info@medconnex.net', 'MedConnex');
					$this->email->to($created_mail);
					$this->email->subject('MedConnex::Sales Message');
					$this->email->message('Hello ' . $created_mail . ',
							<br>
							' . $message_details . '
							<br> contact our staff at info@medconnex.net
							<br>
							Thank you,<br>
							MedConnex');
					if (!empty($image)) {
						$this->email->attach(base_url() . 'uploads' . $image . '');
					}
					$mailsend = $this->email->send();
				}
			}
			$this->session->set_flashdata('success_msg', 'send message successfully');
			redirect("sales");
		} else {
			$this->load->view('admin_templates', $data);
		}
	}

	public function distributionZone() {
		$data['title'] = 'Users';
		$data['file'] = 'admin/dropzone';
		$data['all_staff'] = $this->Dashboard_model->getAllDropZones();
		$data['affiliate_partners'] = $this->Dashboard_model->getWhereMore('uf_affiliate',array('flag_enabled' => '1'));
		$session_uid = $this->session->userdata('id');
		if (isset($_POST['enable'])) {
			$uid = $_POST['enable'];
			$data = array("flag_enabled" => '1',);
			$this->db->where('id', $uid);
			$this->db->update('uf_dropzone', $data);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Enabled successfully');
			redirect("distribution-zone");
		} elseif (isset($_POST['disable'])) {
			$uid = $_POST['disable'];
			$data = array("flag_enabled" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_dropzone', $data);
			$this->session->set_flashdata('success_msg', 'Disabled successfully');
			redirect("distribution-zone");
		} elseif (isset($_POST['delete_all'])) {
			$this->db->truncate('uf_dropzone');
			$this->session->set_flashdata('success_msg', 'All Records are deleted successfully');
			redirect("distribution-zone");
		} 
		elseif (isset($_POST['delete_chekbox'])) { 
			
				$checks = $_POST['check'];
				$ids = join(',',$checks);

				$sql = "delete from uf_dropzone where id In($ids)	";
			
		$this->db->query($sql);
			
		 $this->session->set_flashdata('success_msg', 'Delete successfully');
			 redirect("distribution-zone");
		}

		elseif (isset($_POST['delete'])) { 
				$id = $_POST['id'];
			$this->db->where('id', $id);
			$this->db->delete('uf_dropzone');
			$this->session->set_flashdata('success_msg', 'Delete successfully');
			redirect("distribution-zone");
		}
		// $zip_code=$this->input->post('zip_code');

		// $query="select id  from uf_dropzone  where zip_code = '$zip_code'";

  //       $result=$this->db->query($query);


		// $existdata = $result->row();

		// if(!empty($existdata)){
		// 		$this->session->set_flashdata('success_msg', 'This Zip Code Is Already Exist');
				
	
		// 			redirect("distribution-zone");

		// }

		elseif (isset($_POST['save'])) {
				$business_name=$this->input->post('business_name');
				$zip_code=$this->input->post('zip_code');
				$flag_enabled=$this->input->post('flag_enabled');
				$assign_affiliate=!empty($this->input->post('assign_affiliate')) ? $this->input->post('assign_affiliate') : '';

				$affiliatePartnerId=$this->input->post('affiliatePartnerId');
				$affiliateFullName=$this->input->post('affiliateFullName');
				$contact=$this->input->post('contact');
				$email=$this->input->post('email');
				$city=$this->input->post('city');
				$state=$this->input->post('state');
				//$community_name=$this->input->post('community_name');
				$assign_affiliate_name=$this->input->post('assign_affiliate_name');

				




				$data = array(
					 'business_name' =>$business_name, 
					'affiliatePartnerId' =>$affiliatePartnerId, 
					'affiliateFullName' =>$affiliateFullName,
					// 'contact' =>$contact, 
					 'email' =>$email, 
					 'city' =>$city, 
					 'state' =>$state, 
					//'community_name' =>$community_name, 
					'zip_code' =>$zip_code, 
					'assign_affiliate' =>$assign_affiliate, 
					'flag_enabled' =>$flag_enabled, 
					'assign_affiliate_name' =>$assign_affiliate_name, 
			       );

		// 		$query = $this->db->query("select id from uf_dropzone where zip_code = '$zip_code' ");
		// 								//$resultarray = $query->result();

										
 

		// $existResult = $query->row();

		// if($existResult->id != ''){
		// 	$this->session->set_flashdata('success_msg', '"'.$zip_code.'" Zip Code Is Allready Added');
				

		// }
		// else{
			$this->db->insert('uf_dropzone',$data);
				$this->session->set_flashdata('success_msg', 'Territories is added successfully');
				
		//}
					redirect("distribution-zone");

				
			
		} elseif (isset($_POST['updateTerritories'])) {
				$business_name=$this->input->post('business_name');
                //$community_name=$this->input->post('community_name');
			    $zip_code=$this->input->post('zip_code');

				//$flag_enabled=$this->input->post('flag_enabled');
				$assign_affiliate=$this->input->post('assign_affiliate');

				$affiliatePartnerId=$this->input->post('affiliatePartnerId');
				$affiliateFullName=$this->input->post('affiliateFullName');
				$contact=$this->input->post('contact');
				$email=$this->input->post('email');
				$city=$this->input->post('city');
				$state=$this->input->post('state');
				$assign_affiliate_name=$this->input->post('assign_affiliate_name');
				$data = array(
						 'business_name' =>$business_name, 
					'affiliatePartnerId' =>$affiliatePartnerId, 
					'affiliateFullName' =>$affiliateFullName,
					// 'contact' =>$contact, 
				 'email' =>$email, 
					 'city' =>$city, 
					 'state' =>$state, 
					//'community_name' =>$community_name , 
					'zip_code' =>$zip_code , 
					'assign_affiliate' =>$assign_affiliate , 
					'assign_affiliate_name' =>$assign_affiliate_name, 
					//'flag_enabled' =>$flag_enabled , 
			       );
				$this->db->where('id',$_POST['updateTerritories']);
				$this->db->update('uf_dropzone',$data);
				$this->session->set_flashdata('success_msg', 'Territories is updated successfully');
				redirect("distribution-zone");
			
		}
		elseif (isset($_POST['edit_territories'])) {
				$test = array();
				$business_name=$this->input->post('business_name');
                //$community_name=$this->input->post('community_name');

              
                // print_r($test);
			     $zip_code=$this->input->post('zip_code');


				//$flag_enabled=$this->input->post('flag_enabled');
				$assign_affiliate=$this->input->post('assign_affiliate');

				$affiliatePartnerId=$this->input->post('affiliatePartnerId');
				$affiliateFullName=$this->input->post('affiliateFullName');
				$contact=$this->input->post('contact');
				$email=$this->input->post('email');
				$city=$this->input->post('city');
				$state=$this->input->post('state');
				// $assign_affiliate_name=$this->input->post('assign_affiliate_name');
				$data = array(
						 'business_name' =>$business_name, 
					'affiliatePartnerId' =>$affiliatePartnerId, 
					'affiliateFullName' =>$affiliateFullName,
					// 'contact' =>$contact, 
				 // 'email' =>$email, 
					 'city' =>$city, 
					 'state' =>$state, 
					//'community_name' =>$community_name , 
					'zip_code' =>$zip_code , 
					'assign_affiliate' =>$assign_affiliate , 
					// 'assign_affiliate_name' =>$assign_affiliate_name, 
					//'flag_enabled' =>$flag_enabled , 
			       );
			
				$this->db->where('id',$_POST['edit_territories']);
				$this->db->update('uf_dropzone',$data);
				$this->session->set_flashdata('success_msg', 'Territories is updated successfully');
				redirect("distribution-zone");
			
		 }
		 //elseif (isset($_POST['zipcode'])) {
		// 	$zipcode = $_POST['zipcode'];
		// 	$id = $_POST['id'];
		// 	$data = array("zip_code" => $zipcode);
		// 	$this->db->where('id', $id);
		// 	$this->db->update('uf_dropzone', $data);
		
		// }



		


		
			$this->load->view('admin_templates', $data);
	}

		public function getDropzone() {
		$result = $this->Dashboard_model->getDropzone();
		$user_type=$result['flag_enabled'];
		$assign_affiliate=$result['assign_affiliate'];
			$sel_1	=	($user_type == "1")?'selected':'';
			$sel_2	=	($user_type == "0")?'selected':'';
		
	     $affiliate_partners = $this->Dashboard_model->getWhereMore('uf_affiliate',array('flag_enabled' => '1'));
	      $option ='<option value="">--select assing affiliate--</option>';
		   foreach ($affiliate_partners as $a ) {
		   	$selected	=	($assign_affiliate == $a['current_email'])?'selected':'';
		    $option .='<option value="'.$a['current_email'].'" '.$selected.'>'.$a['current_email'].'</option>';
		   }
			
		echo '
<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Affiliate Partner Id</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="affiliatePartnerId" autocomplete="off" value="' . $result['affiliatePartnerId'] . '"   placeholder="" type="text">
						</div>
					</div>
				</div>
					<div class="col-sm-6">
					<div class="form-group">
						<label>Affiliate Business Name</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="business_name" autocomplete="off" value="' . $result['business_name'] . '"   placeholder="" type="text">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Affiliate Full Name</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="affiliateFullName" autocomplete="off" value="' . $result['affiliateFullName'] . '"   placeholder="" type="text">
						</div>
					</div>
				</div>
				 <div class="col-sm-6">
							<div class="form-group">
								<label>Affiliate Email</label>
								<input class="form-control" name="email" autocomplete="off" value="' . $result['email'] . '"  placeholder="Please enter the Email" required="required" type="text">
							</div>
						</div> 
		






				<div class="col-sm-6">
							<div class="form-group">
								<label>Assignee Name</label>
									<input class="form-control"  name="assign_affiliate_name" value="' . $result['assign_affiliate_name'] . '" autocomplete="off"   type="text">
							</div>
						</div>  

				<div class="col-sm-6">
					<div class="form-group ">
						<label>Assign Email</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<select id="input_locale" class="form-control" name="assign_affiliate"  required>
							'.$option.'
							
							
							</select>
						</div>
					</div>
				</div>

					<div class="col-sm-6">
					<div class="form-group">
						<label>Zip Code</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="zip_code" autocomplete="off" value="' . $result['zip_code'] . '"   placeholder="" type="text">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>State</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="state" autocomplete="off" value="' . $result['state'] . '"   placeholder="" type="text">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>County</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="city" autocomplete="off" value="' . $result['city'] . '"   placeholder="" type="text">
						</div>
					</div>
				</div>

				
				
					
			</div><br>

			<div class="row modal-footer">
				<div class="creatUserBottom ">
				
							<button type="submit" name="updateTerritories" value="' . $result['id'] . '" class="btn-green">Update Affiliate</button>
						
					
							<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
						
				</div>
			</div>';
	}



	public function staff_tasklist() {
		$data['title'] = 'Users';
		$data['file'] = 'admin/sales_task_list';
		$staff_id = $this->input->get('staff_id');

		if (isset($_POST['completed'])) {
			$task_id = $_POST['completed'];
			$data = array("status" => '1');
			$this->db->where('id', $task_id);
			$this->db->update('sal_task', $data);
			$this->session->set_flashdata('success_msg', 'Task completed successfully');

			$getuserdetaslis = $this->Dashboard_model->get_username($staff_id);
			$user_name = !empty($getuserdetaslis['user_name']) ? $getuserdetaslis['user_name'] : $getuserdetaslis['display_name'];
			$user_name = !empty($user_name) ? $user_name : $getuserdetaslis['title'];

			$notify_ins = array("user_id" => $staff_id, "type_read" => 2, "message" => $getuserdetaslis['title'] . ' Task Completed By ' . $user_name, "created_at" => date('Y-m-d H:i:s'));
			$this->db->insert('notification_history', $notify_ins);
			redirect("panels/supermacdaddy/dashboard/staff_tasklist?staff_id=$staff_id");
		}
		$data['list_task'] = $this->Dashboard_model->staff_task_deatils($staff_id);
		$this->load->view('admin_templates', $data);
	}

	public function create_task() {
		$data['title'] = 'Users';
		$data['file'] = 'admin/creat_task';
		if (isset($_POST['save'])) {
			$task = $this->Dashboard_model->save_task();
			$this->session->set_flashdata('success_msg', 'Check Your <strong>' . $email . ' </strong> to recover you password');
			redirect("sales");
		}
		$data['all_staff'] = $this->Dashboard_model->all_staff();
		$this->load->view('admin_templates', $data);
	}

	public function task_list() {
		$data['title'] = 'Users';
		$data['file'] = 'admin/task_list';
		if (isset($_POST['save'])) {
			$task = $this->Dashboard_model->save_task();
			$this->session->set_flashdata('success_msg', 'Task Save Successfully');
			redirect("task-list");
		}
		$data['all_task'] = $this->Dashboard_model->all_task();
		$data['all_staff'] = $this->Dashboard_model->all_staff();
		$this->load->view('admin_templates', $data);
	}

	public function zerglings() {
		$data['title'] = 'Zerglings';
		$data['file'] = 'admin/zerglings';
		$this->load->view('admin_templates', $data);
	}

	public function sendmassage() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data = $this->Dashboard_model->sendmassage();
		} else {
			redirect("/login");
		}
	}

	public function getId() {
		$result = $this->Dashboard_model->getId();
		echo $result->message_by;
		exit;
	}

	public function chat_history() {
		$id = $this->session->userdata('id');
		$adminIds = $this->Dashboard_model->getAdminIds(array('user_type' => '5'));


		foreach ($adminIds as $a) {

			$baseAdminId = $a->id;
			$history = $this->Dashboard_model->chat_history($baseAdminId);
			// echo "<pre>";
			//print_r($history);

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
                                        <p>
                                            ' . $val['message'] . '
                                        </p>
                                    </div>
                                </li>';
					} else {
						$data .= '<li class="right clearfix"><span class="chat-img  pull-right"><img src="http://placehold.it/50/55C1E7/' . $val['sender_name'] . '" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">' . $val['sender_name'] . '</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> ' . $val['message_date'] . '</small>
                                        </div>
                                        <p>
                                            ' . $val['message'] . '
                                        </p>
                                    </div>
                                </li>';
					}
				}
				$result[$baseAdminId] = $data;
			}
		}
		echo json_encode($result);
	}

	public function chat_history_march_backup() {

		$id = $this->session->userdata('id');
		$history = $this->Dashboard_model->chat_history();
		$user = $this->Dashboard_model->getAllUsers();

		foreach ($user as $u) {
			$username[$u->id] = $u->user_name;
		}

		foreach ($history as $val) {
			$mid = $val['message_by'];

			if ($val['message_by'] == $id) {
				echo '<li class="left clearfix " data-user_id="">
						<span class="chat-img pull-left"><img src="' . base_url() . 'public/images/logo.png" width="50px" alt="' . $this->session->userdata('name') . '" class="img-circle" /></span>
						<div class="chat-body clearfix">
							<div class="header">
								<strong class="primary-font">Me</strong>
								<small class="pull-right text-muted">
								<i class="fa fa-clock-o fa-fw"></i> ' . $val['message_date'] . '</small>
							</div>
							<p>' . $val['message'] . '</p>
						</div>
					</li>';
			}
			if ($val['message_by'] != $id) {
				echo '<li style="cursor:pointer;" class="right clearfix newmessage' . $mid . '" onclick="sendMessageClick(' . $mid . ')" >
						<span class="chat-img  pull-right"><img src="' . base_url() . 'public/images/member.jpg" width="50px" alt="' . $username[$mid] . '" class="img-circle" /></span>
						<div class="chat-body clearfix">
							<div class="header">
								<strong class="primary-font pull-right" onclick="senduserClick(' . $mid . ')">' . $username[$mid] . '</strong>
								<small class="pull-left text-muted"><i class="fa fa-clock-o fa-fw"></i> ' . $val['message_date'] . '</small>
							</div><br/>
							<p class="pull-right">' . $val['message'] . '</p>
						</div>
					</li>';
			}
		}
	}

	public function getuserdetails() {

		$userid = $this->input->post('id');
		$geteuser = $this->db->get_where('uf_user', array('id' => $userid))->row();
		$html = '';
		$html .= '
			<div class="col-sm-6">
				<div class="form-group">
					<label>User Name</label>
					<div class="input-group">
					  ' . $geteuser->user_name . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Display Name</label>
					<div class="input-group">
					  ' . $geteuser->display_name . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Email</label>
					<div class="input-group">
					  ' . $geteuser->email . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Phoneno</label>
					<div class="input-group">
					  ' . $geteuser->mob_number . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Title</label>
					<div class="input-group">
					  ' . $geteuser->title . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Scoial id</label>
					<div class="input-group">
					  ' . $geteuser->socialid . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>State</label>
					<div class="input-group">
					  ' . $geteuser->state . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Latitude </label>
					<div class="input-group">
					  ' . $geteuser->user_lat . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Longitude</label>
					<div class="input-group">
					  ' . $geteuser->user_long . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Address</label>
					<div class="input-group">
					  ' . $geteuser->address . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Zip code</label>
					<div class="input-group">
					  ' . $geteuser->zip . '
					</div>
				</div>
			</div>
       ';

		$data['result'] = $html;
		$data['username'] = $geteuser->user_name;
		echo json_encode($data);
	}

	public function chat_history_backup() {
		$id = $this->session->userdata('id');
		$history = $this->Dashboard_model->chat_history();
		foreach ($history as $val) {
			if ($val['message_by'] == $id) {
				echo '<li class="left clearfix"><span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/Me" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Me</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> ' . $val['message_date'] . '</small>
                                        </div>
                                        <p>
                                            ' . $val['message'] . '
                                        </p>
                                    </div>
                                </li>';
			}
			if ($val['message_by'] != $id) {
				echo '<li class="right clearfix"><span class="chat-img  pull-right"><img src="http://placehold.it/50/55C1E7/' . $val['sender_name'] . '" alt="User Avatar" class="img-circle" />
							</span>
							<div class="chat-body clearfix">
								<div class="header">
									<strong class="primary-font">' . $val['sender_name'] . '</strong>
									<small class="pull-right text-muted">
										<i class="fa fa-clock-o fa-fw"></i> ' . $val['message_date'] . '</small>
								</div>
								<p>
									' . $val['message'] . '
								</p>
							</div>
						</li>';
			}
		}
	}

	public function promo_code() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = 'Promo codes';
			$data['file'] = 'admin/promo_code';
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function CheckCode() {
		$requestedcode = $this->input->post('code');
		$getecode = $this->db->get_where('uf_promo_codes', array('code' => $requestedcode))->num_rows();
		if ($getecode == 0) {
			echo 'true';
		} else {
			echo 'false';
		}
	}

	public function ufuser_EmailCheck() {
		$requestedcode = $this->input->post('email');
		$getecode = $this->db->get_where('uf_user', array('email' => $requestedcode))->num_rows();
		if ($getecode == 0) {
			echo 'true';
		} else {
			echo 'false';
		}
	}

	public function edit_promo() {
		$result = $this->Dashboard_model->promodetail();
		$selected1 = $selected2 = $selected3 = '';
		$selected1 = ($result['service_type'] == 1) ? "selected" : '';
		$selected2 = ($result['service_type'] == 2) ? "selected" : '';
		$selected3 = ($result['service_type'] == 3) ? "selected" : '';

		$selectedtype1 = $selectedtype2 = '';
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
                        <option value="1" ' . $selectedtype1 . '>Dollar $ Off</option>
                        <option value="2" ' . $selectedtype2 . '>Percentage % Off</option>
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
                        <option value="1" ' . $selected1 . '>Standard</option>
                        <option value="2" ' . $selected2 . '>Premium</option>
						<option value="3" ' . $selected3 . '>Affiliate</option>
                    </select>
                </div>
            </div>
        </div>
              
        <div class="col-sm-4">
            <div class="form-group">
                <label>Promo Start Date</label>
                <div class="input-group">
                    <input name="starts" type="text" value="' . date('Y-m-d', strtotime($result["start"])) . '" class="form-control datetimepicker4" required>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group ">
                <label>Promo End Date</label>
                <div class="input-group">
                    <input name="ends"  type="text" value="' . date('Y-m-d', strtotime($result['end'])) . '" class="form-control datetimepicker4" required>
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

	public function referralCode() {
		$data['title'] = 'Referral codes';
		$data['file'] = 'admin/referralCode';

		if (isset($_POST['save'])) 
		{
			$status = '0';
						$data = array('userId'	=> $this->input->post('userId'),
			'referralCode'	=>  !empty($this->input->post('referralCode')) ? $this->input->post('referralCode') : '',
		
			'description'	=> $this->input->post('description'),
				'status'	=> $status,
			'amount'	=> $this->input->post('amount'));
						// echo "<pre>"; print_r($data);
						// die();

			$task = $this->Dashboard_model->saveReferralCode('uf_referral',$data);
			$this->session->set_flashdata('success_msg', 'Referral Save Successfully');
			redirect("referralCode");
			}
			
		if (isset($_POST['statusUpdate'])) {

							$data1 = array('status'	=> 0);
					
					$where1 = array('userid' => 1);
					$this->Dashboard_model->updateReferralCode('uf_referral',$data1,$where1);






					$data = array('status'	=> $this->input->post('status'));
					
					$where = array('id' => $this->input->post('id'));

					$this->Dashboard_model->updateReferralCode('uf_referral',$data,$where);
					if($this->input->post('status') == '1')
					{
						$this->session->set_flashdata('success_msg', 'Active Referral Code Successfully');
					}
					else{
						$this->session->set_flashdata('success_msg', 'Deactive Referral Code Successfully');
					}
					

		 			redirect("referralCode");
		}

		if (isset($_POST['DeleteReferral'])) {

						
					
					$where = array('id' => $_REQUEST['id']);
					$this->db->where($where);
					$this->db->delete('uf_referral');
			
					$this->session->set_flashdata('success_msg', 'Referral Code Successfully Deleted');
		 			redirect("referralCode");
		}

		

		if (isset($_POST['update'])) 
		{
			

			$where = array('id' => $this->input->post('id'));


		
					$data = array('referralCode'	=>  !empty($this->input->post('referralCode')) ? $this->input->post('referralCode') : '',
									'description'	=> $this->input->post('description'),
									'amount'	=> $this->input->post('amount')
			
		);

					$this->Dashboard_model->updateReferralCode('uf_referral',$data,$where);
					$this->session->set_flashdata('success_msg', 'Updated Successfully');
					redirect("referralCode");
			
			
			
		}
	
$data['getReferralCode'] = $this->Dashboard_model->checkReferralCode('uf_referral');

		$this->load->view('admin_templates', $data);
	}


	public function promo_list() {
		$data['title'] = 'Promo codes';
		$data['file'] = 'admin/promo_list';

		if (isset($_POST['save'])) 
		{
//			$checkservice = $this->input->post('service_type');
//			$records = $this->Dashboard_model->allservicelist($checkservice);
			$task = $this->Dashboard_model->save_promo();
			$this->session->set_flashdata('success_msg', 'Promo Save Successfully');
			redirect("promo-list");
//			if (empty($records)) {
//				$task = $this->Dashboard_model->save_promo();
//				$this->session->set_flashdata('success_msg', 'Promo Save Successfully');
//				redirect("promo-list");
//			} else {
//				$id = $records['id']; //echo $id; die('got id');
//				$task = $this->Dashboard_model->update_promo($id);
//				$this->session->set_flashdata('success_msg', 'Promo Updated Successfully');
//				redirect("promo-list");
//			}
		}
		
		if (isset($_POST['enable']))
		{ //die('e here');
			$id = $_POST['enable'];
			$data = array("status" => '1');
			$this->db->where('id', $id);
			$this->db->update('uf_promo_codes', $data);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Promo code Enable successfully');
			redirect("promo-list");
		}
		if (isset($_POST['disable'])) { //die('d here');
			$id = $_POST['disable'];
			$data = array("status" => '0');
			$this->db->where('id', $id);
			$this->db->update('uf_promo_codes', $data);
			$this->session->set_flashdata('success_msg', 'Promo code Disable successfully');
			redirect("promo-list");
		}
		if (isset($_POST['update'])) {
			$updateid = $_POST['update'];
			//$created_by =  $records['created_by'];
			$promo = $this->Dashboard_model->update_promo($updateid);
			$this->session->set_flashdata('success_msg', 'Promo code Updated Successfully');
			redirect("promo-list");
		}
		if (isset($_POST['delete'])) {
			$promoid = $_POST['delete'];
			$category = $this->Dashboard_model->delete_promo($promoid);
			$this->session->set_flashdata('success_msg', 'Promo Deleted Successfully');
			redirect("promo-list");
		}

		$data['allpromo'] = $this->Dashboard_model->allpromo();
		$this->load->view('admin_templates', $data);
	}

	public function notification() {
		$data = $chat = $inpdex_notiy = '';
		$notification = $this->Dashboard_model->notification_history(0);
		$i = 0;
		if (!empty($notification)) {
			foreach ($notification as $val) {
				if ($i > 2)
					break;
				$chat .= '<li class="update_status_read" id="' . $val['notification_id'] . '" >
						<a  style="cursor:pointer;">
							<div>
								<i class="fa fa-envelope fa-fw"></i> <b>' . $val['user_name'] . '</b><br>' . $val['message'] . '
								<span class="pull-right text-muted small">' . $val['created_at'] . '</span>
							</div>
						</a>
					</li>';

				$inpdex_notiy .= '<a style="cursor:pointer;" class="list-group-item update_status_read" id="' . $val['notification_id'] . '">
									<i class="fa fa-envelope fa-fw"></i> <b>' . $val['user_name'] . '</b><br>' . $val['message'] . '
									<span class="pull-right text-muted small"><em>' . $val['created_at'] . '</em>
									</span>
								</a>';

				$i++;
			}
		}
		else {
			$chat .= '<div align="center">Empty Notifications</div>';
			$inpdex_notiy .= '<div align="center">Empty Notifications</div>';
		}
		$chat .= '<li align="center">
				<a href="' . base_url() . '/notifications" style="cursor:pointer;text-align: center;color:#FF8961;">
					<div>
					 <b>View All</b>
					</div>
				</a>
			</li>';

		$inpdex_notiy .= '<div style="cursor:pointer;text-align: center;"><a href="' . base_url('notifications') . '" style="color:#BAA2E0 !important;" >
							<br> <b>View All</b>
						</a></div>';

		$data['chat'] = $chat;
		$data['inpdex_notiy'] = $inpdex_notiy;
		$data['count'] = count($notification);
		echo json_encode($data);
	}

	public function notifications() {
		$data['title'] = 'Dashboard :: Notifications';
		$data['file'] = 'admin/notifications';
		$data['notification'] = $this->Dashboard_model->notification_historyAll(0);
		if (isset($_POST['update_read_status'])) {
			$uid = $_POST['update_read_status'];
			$dataa = array("read_status" => '1');
			$this->db->where('id', $uid);
			$this->db->update('notification_history', $dataa);
			$this->session->set_flashdata('success_msg', 'Read successfully');
			redirect("notifications");
		}
		$this->load->view('admin_templates', $data);
	}

	public function update_notification() {
		$uid = $this->input->post('notify_id');
		$dataa = array("read_status" => '1');
		$this->db->where('id', $uid);
		$this->db->update('notification_history', $dataa);
		$json['success'] = true;
		echo json_encode($json);
	}

	public function tasknotification() {
		$data = $chat = '';
		$tasknotification = $this->Dashboard_model->tasknotification(0);
		$i = 0;
		foreach ($tasknotification as $val) {
			if ($i > 5)
				break;
			$chat .= '<li>
				<a href="#">
					<div>
						<p>
							<strong>' . $val['task_name'] . '</strong>
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
			$i++;
		}
		$data['chat'] = $chat;
		$data['count'] = count($tasknotification);
		echo json_encode($data);
	}

	public function msgnotification() {
		$data = $chat = '';
		$notification = $this->Dashboard_model->msgnotification(0);
		$i = 0;
		$chat .=' <li><a href="javascript:void(0);"  data-toggle="modal" data-target="#composemail" ><i class="fa fa-envelope" aria-hidden="true"></i> Compose</a>
                        </li>';
		if (!empty($notification)) {

			foreach ($notification as $val) {
				if ($i > 5)
					break;
				$chat .= '<li>
							<a class="chat_msg_update" id=' . $val['msg_id'] . '>
								<div>
									<strong>' . $val['display_name'] . '</strong>
									<span class="pull-right text-muted">
										<em>' . $val['message_date'] . '</em>
									</span>
								</div>
								<div> ' . $val['message'] . '</div>
							</a>
						</li>';
				$i++;
			}
		}
		else {
			$chat .= '<li align="center"><a href="javascript:void(0);">Empty Messages</a></li>';
		}
		$data['chat'] = $chat;
		$data['count'] = count($notification);
		echo json_encode($data);
	}

	public function msgnotificationcount() {
		$notification = $this->Dashboard_model->msgnotification(0);
		echo count($notification);
	}

	public function chat_msg_update() {
		$notify_id = $this->input->post('notify_id');
		$data_arr = array("status" => "0");
		$this->db->where("msg_id", $notify_id);
		$this->db->update('admin_chat', $data_arr);
		$data['success'] = true;
		echo json_encode($data);
	}

	public function industries() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = 'Industries';
			$data['file'] = 'admin/industries';

			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function locations() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = 'Locations';
			$data['file'] = 'admin/locations';
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function edit_cat() {
		$result = $this->Dashboard_model->catdetail();
		echo '<div class="col-sm-12">
					<div class="form-group">
						<label>Category Name or Title</label>
						<input class="form-control" id="category_id" name="category_id" type="hidden">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control"  name="category_name" autocomplete="off" value="' . $result['name'] . '" placeholder="" required="" aria-required="true" type="text">
						</div>
					</div>
				</div>
				<div class="modal-footer" style="clear:both">
					<div class="creatUserBottom ">
					
								<button type="submit" name="updatecategory" value="' . $result['id'] . '" class="btn-green">
									Update Category
								</button> 
						
								<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
						
					</div>
				</div>';
	}

  public function edit_our_team() {
		$result = $this->Dashboard_model->ourteamDetail();
		$our_team_image=$result['our_team_image'];
									$imageurl=base_url('uploads/'.$our_team_image);
		echo '<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Our Team Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="our_team_name" autocomplete="off" value="' . $result['our_team_name'] . '" placeholder="" required="" aria-required="true" type="text">
								</div>
							</div>
						</div>
					<div class="col-sm-6">
							<div class="form-group">
								<label>Our Team Image</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control get_image" type="file" name="image" autocomplete="off"  placeholder="" id="get_image" required="" aria-required="true" type="text">
									<input type="hidden" name="our_team_image"  value="' .$result['our_team_image'] . '">
								</div>
								<img src="'.$imageurl.'" class="myImg1" width="200px" height="200px">

							</div>
						</div>  
			 
						<div class="modal-footer" style="clear:both">
							<div class="creatUserBottom ">
								<div class="">
									<div class="vert-pad">
										<button type="submit" name="updateOurTeam"  value="' .$result['id'] . '" class="btn-green">
											Create our team
										</button> 
									</div>          
								</div>       
								<div class="">
									<div class="vert-pad">
										<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</div>';
	}






	public function edit_Subcat() {
		$result = $this->Dashboard_model->Subcatdetail();
		$all_cat = $this->Dashboard_model->all_categories_enable();
		echo '<div class="col-sm-12">
						<div class="form-group">
						<label>Category Name</label>
						<select class="form-control" name="main_category">';
		foreach ($all_cat as $v_catg) {
			$select = '';
			if ($result['uf_categories_id'] == $v_catg['id']) {
				$select = 'selected';
			}
			echo '<option value=' . $v_catg['id'] . ' ' . $select . '>' . $v_catg['name'] . '</option>';
		}
		echo'	</select>
					</div>
					<div class="form-group">
						<label>Sub Category Name </label>
						<input class="form-control" id="category_id" name="category_id" type="hidden">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control"  name="sub_category" autocomplete="off" value="' . $result['sub_category'] . '" placeholder="" required="" aria-required="true" type="text">
						</div>
					</div>
				</div>
				<div class="modal-footer" style="clear:both">
					<div class="creatUserBottom ">
						<div class="">
							<div class="vert-pad">
								<button type="submit" name="updatesubcategory" value="' . $result['id'] . '" class="btn-green">
									Update Sub Category
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

	public function categories() {
		$data['title'] = 'Categories';
		$data['file'] = 'admin/categories';

		if (isset($_POST['save'])) {
			$task = $this->Dashboard_model->savecat();
			$this->session->set_flashdata('success_msg', 'Categories Save Successfully');
			redirect("categories");
		}
		if (isset($_POST['enable'])) { //die('e here');
			$id = $_POST['enable'];
			$data = array("status" => '1');
			$this->db->where('id', $id);
			$this->db->update('uf_categories', $data);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Enable successfully');
			redirect("categories");
		}
		if (isset($_POST['disable'])) { //die('d here');
			$id = $_POST['disable'];
			$data = array("status" => '0');
			$this->db->where('id', $id);
			$this->db->update('uf_categories', $data);
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("categories");
		}
		if (isset($_POST['updatecategory'])) {
			$updateid = $_POST['updatecategory'];
			$category = $this->Dashboard_model->update_category($updateid);
			$this->session->set_flashdata('success_msg', 'Category Updated Successfully');
			redirect("categories");
		}
		if (isset($_POST['delete'])) {
			$categoryid = $_POST['delete'];
			$subcategorycheck = $this->Dashboard_model->check_sub_category($categoryid);
			if ($subcategorycheck == 0) {
				$category = $this->Dashboard_model->delete_category($categoryid);
				$this->session->set_flashdata('success_msg', 'Category Deleted Successfully');
			} else {
				$this->session->set_flashdata('error_msg', 'Sub category remove after main category..!');
			}
			redirect("categories");
		}

		$data['all_cat'] = $this->Dashboard_model->all_categories();
		$this->load->view('admin_templates', $data);
	}

	public function subcategories() {
		redirect('/');
		$data['title'] = 'Categories';
		$data['file'] = 'admin/sub_categories';

		if (isset($_POST['save'])) {
			$task = $this->Dashboard_model->saveSubcat();
			$this->session->set_flashdata('success_msg', 'Sub Categories Save Successfully');
			redirect("subcategories");
		}
		if (isset($_POST['enable'])) { //die('e here');
			$id = $_POST['enable'];
			$data = array("status" => '1');
			$this->db->where('id', $id);
			$this->db->update('uf_categories_sub', $data);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Enable successfully');
			redirect("subcategories");
		}
		if (isset($_POST['disable'])) { //die('d here');
			$id = $_POST['disable'];
			$data = array("status" => '0');
			$this->db->where('id', $id);
			$this->db->update('uf_categories_sub', $data);
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("subcategories");
		}
		if (isset($_POST['delete'])) {
			$categoryid = $_POST['delete'];
			$this->db->where('id', $categoryid);
			$this->db->delete('uf_categories_sub');
			$this->session->set_flashdata('success_msg', 'Sub Category Deleted Successfully');
			redirect("subcategories");
		}
		if (isset($_POST['updatesubcategory'])) {
			$updateid = $_POST['updatesubcategory'];
			$category = $this->Dashboard_model->update_Subcategory($updateid);
			$this->session->set_flashdata('success_msg', 'Sub Category Updated Successfully');
			redirect("subcategories");
		}
		$data['all_cat'] = $this->Dashboard_model->all_categories_enable();
		$data['allsub_cat'] = $this->Dashboard_model->all_sub_categories();
		$this->load->view('admin_templates', $data);
	}

	public function products() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = 'Products';
			$data['file'] = 'admin/products';
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function edit_services() {
		$result = $this->Dashboard_model->service_details();
		echo '<textarea rows="5" cols="117" name="content" class="note-codable form-control">' . $result['services_content'] . '</textarea>
				<div class="row">
					<div class="col-xs-12">
						<button name="update" type="submit" value="' . $result['services_content_id'] . '"class="btn-green js-location-create">Update</button>
					</div>
				</div>
		';
	}

	public function standard_services() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = 'Standard Services';
			$data['file'] = 'admin/standard_services';
			if (isset($_POST['delete'])) {
				$delete = $_POST['delete'];
				$this->db->where('services_content_id 	', $delete);
				$this->db->delete('cp_services_content');
				$this->session->set_flashdata('success_msg', 'Deleted successfully');
				redirect("standard-services");
			}
			if (isset($_POST['save'])) {
				$res = $this->Dashboard_model->savecontent(1);
				$this->session->set_flashdata('success_msg', 'Save successfully');
				redirect("standard-services");
			}
			if (isset($_POST['update'])) {
				$id = $_POST['update'];
				$res = $this->Dashboard_model->updatecontent($id);
				$this->session->set_flashdata('success_msg', 'Updated successfully');
				redirect("standard-services");
			}
			$data['standard_services'] = $this->Dashboard_model->standard_services(1);
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function premium_services() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = 'Premium Services';
			$data['file'] = 'admin/premium_services';
			if (isset($_POST['delete'])) {
				$delete = $_POST['delete'];
				$this->db->where('services_content_id 	', $delete);
				$this->db->delete('cp_services_content');
				$this->session->set_flashdata('success_msg', 'Deleted successfully');
				redirect("premium-services");
			}
			if (isset($_POST['save'])) {
				$res = $this->Dashboard_model->savecontent(2);
				$this->session->set_flashdata('success_msg', 'Save successfully');
				redirect("premium-services");
			}
			if (isset($_POST['update'])) {
				$id = $_POST['update'];
				$res = $this->Dashboard_model->updatecontent($id);
				$this->session->set_flashdata('success_msg', 'Updated successfully');
				redirect("premium-services");
			}
			$data['standard_services'] = $this->Dashboard_model->standard_services(2);

			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function on_demand_services() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = 'On-Demand Services';
			$data['file'] = 'admin/on_demand_services';
			if (isset($_POST['delete'])) {
				$delete = $_POST['delete'];
				$this->db->where('services_content_id 	', $delete);
				$this->db->delete('cp_services_content');
				$this->session->set_flashdata('success_msg', 'Deleted successfully');
				redirect("ondemand-services");
			}
			if (isset($_POST['save'])) {
				$res = $this->Dashboard_model->savecontent(3);
				$this->session->set_flashdata('success_msg', 'Save successfully');
				redirect("ondemand-services");
			}
			if (isset($_POST['update'])) {
				$id = $_POST['update'];
				$res = $this->Dashboard_model->updatecontent($id);
				$this->session->set_flashdata('success_msg', 'Updated successfully');
				redirect("ondemand-services");
			}
			$data['standard_services'] = $this->Dashboard_model->standard_services(3);

			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function web_tos() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = "Website's Terms and Conditions";
			$data['file'] = 'admin/web_tos';
			if (isset($_POST['save'])) {
				$res = $this->Dashboard_model->WebSaveTos('web');
				$this->session->set_flashdata('success_msg', 'Save successfully');
				redirect("web-tos");
			}
			//$data['tos'] = $this->Dashboard_model->savetosdata('web');
			$data['all_states'] = $this->Dashboard_model->all_states();
          
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}
	public function get_web_term()
	{
		 $state_id= trim($this->input->post('state_id'));
		 $section= trim($this->input->post('section'));
		 $where = array('state_id' =>$state_id , 'section'=>$section);
		 $this->db->select('*');
		 $this->db->from('uf_tos');
		 $this->db->where($where);
		 $query=$this->db->get();
		 $result=$query->row();
		 if($result){
           echo json_encode($result);
		  }else{
		  	echo '0';
		  }
	}

	public function app_tos() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = "Mobile App's Terms and Conditions";
			$data['file'] = 'admin/app_tos';
			if (isset($_POST['save'])) {
				$res = $this->Dashboard_model->WebSaveTos('app');
				$this->session->set_flashdata('success_msg', 'Save successfully');
				//redirect("app-tos");
			}
		//	$data['tos'] = $this->Dashboard_model->savetosdata('app');
          	$data['all_states'] = $this->Dashboard_model->all_states();

			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function loyalty_tos() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = "Loyalty Program's Terms and Conditions";
			$data['file'] = 'admin/loyalty_tos';
			if (isset($_POST['save'])) {
				$res = $this->Dashboard_model->savetos('loyalty');
				$this->session->set_flashdata('success_msg', 'Save successfully');
				redirect("loyalty-tos");
			}
			$data['tos'] = $this->Dashboard_model->savetosdata('loyalty');
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function on_demand_tos() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = "On-Demand Driver's Terms and Conditions";
			$data['file'] = 'admin/on_demand_tos';
			if (isset($_POST['save'])) {
				$res = $this->Dashboard_model->savetos('affiliate_partners');
				$this->session->set_flashdata('success_msg', 'Save successfully');
				redirect("ondemand-tos");
			}
			$data['tos'] = $this->Dashboard_model->savetosdata('affiliate_partners');

			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}




	public function advertismentSales() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = "On-Demand Driver's Terms and Conditions";
			$data['file'] = 'admin/advertismentSales';
			if (isset($_POST['save'])) {
				$res = $this->Dashboard_model->savetos('sale_partners');
				$this->session->set_flashdata('success_msg', 'Save successfully');
				redirect("advertismentSales");
			}
			$data['tos'] = $this->Dashboard_model->savetosdata('sale_partners');

			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}



	public function certifiedProviders() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = "On-Demand Driver's Terms and Conditions";
			$data['file'] = 'admin/certifiedProviders';
			if (isset($_POST['save'])) {
				$res = $this->Dashboard_model->savetos('store_partners');
				$this->session->set_flashdata('success_msg', 'Save successfully');
				redirect("certifiedProviders");
			}
			$data['tos'] = $this->Dashboard_model->savetosdata('store_partners');

			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}




	public function support_tickets() {

		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'Support Ticket';
			$data['file'] = 'admin/support_tickets';
			$data['ticket_id'] = $this->input->get('id');
			$created_id = $this->session->userdata('id');
			$created_mail = $this->session->userdata('username');
			if (isset($_POST['createdticket'])) {
				$ticket_sub = $this->input->post('ticket_sub');
				$ticket_email = $this->input->post('ticket_email');
				$message_ticket = $this->input->post('message_ticket');
				$date = date('Y-m-d H:i:s');
				if (!empty($message_ticket) && $message_ticket != "<br>" ) {
					$image='';
					if( $_FILES["image"]["name"] != '')
					{
						$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
						$path = 'uploads';
						$this->upload_image($image, $path);
					}
					$data_arr = array(
						"subject" => $ticket_sub,
						"email" => $ticket_email,
						"message" => $message_ticket,
						"attach" => $image,
						"created_date" => $date,
						"user_id" => $created_id,
					);
					$this->db->insert("ost_ticket__cdata", $data_arr);


					if (!empty($ticket_email)) { //user

						
						$ticket_email = $this->input->post('ticket_email');

						$cc = $this->input->post('cc');

						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnex');
						$this->email->to($ticket_email);
						$this->email->cc($cc);
						$this->email->subject('MedConnex::New Ticket Created');
						$this->email->message('Hello ' . $created_mail . ',
							<br>Ticket has been created .<br><br>
							' . $ticket_sub . '<br>
							' . $message_ticket . '
							<br> contact our staff at info@medconnex.net
							<br>
							Thank you,<br>
							MedConnex');
						$mailsend = $this->email->send();

						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnex');
						$this->email->to($ticket_email);
						$this->email->subject('MedConnex::New Ticket Created');
						$this->email->message('Hello ' . $ticket_email . ',
							<br>Your Ticket has been created on <b>MedConnex</b> team.<br><br>
							' . $ticket_sub . '<br>
							' . $message_ticket . '
							<br> contact our staff at info@medconnex.net
							<br>
							Thank you,<br>
							MedConnex');
						$this->email->send();
					}

					$this->session->set_flashdata('success_msg', 'created ticket successfully');
					redirect("support-tickets");
				} else {
					$this->session->set_flashdata('error_msg', 'Empty Details..!');
					redirect("support-tickets");
				}
			}
			else if (isset($_POST['replyticket'])) {
			 {
					if (!empty($ticket_email)) { //user

						
						$ticket_email = $this->input->post('ticket_email');

						$cc = $this->input->post('cc');

						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnex');
						$this->email->to($ticket_email);
						$this->email->cc($cc);
						$this->email->subject('MedConnex::New Ticket Created');
						$this->email->message('Hello ' . $created_mail . ',
							<br>Ticket has been created .<br><br>
							' . $ticket_sub . '<br>
							' . $message_ticket . '
							<br> contact our staff at info@medconnex.net
							<br>
							Thank you,<br>
							MedConnex');
						$mailsend = $this->email->send();

						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnex');
						$this->email->to($ticket_email);
						$this->email->subject('MedConnex::New Ticket Created');
						$this->email->message('Hello ' . $ticket_email . ',
							<br>Your Ticket has been created on <b>MedConnex</b> team.<br><br>
							' . $ticket_sub . '<br>
							' . $message_ticket . '
							<br> contact our staff at info@medconnex.net
							<br>
							Thank you,<br>
							MedConnex');
						$this->email->send();
					}
			}
		}



			 else if (isset($_POST['updateticket'])) {
				$ticket_no = $this->input->post('ticket_no');
				$ticket_email = $this->input->post('ticket_email');
				$ticket_sub = $this->input->post('ticket_sub');
				$message_ticket = $this->input->post('message_ticket');

				$old_image = $this->input->post('old_image');
				if (!empty($message_ticket) && $message_ticket != "<br>") {
					$image = $old_image;
					if ($_FILES["image"]["name"] != '') {
						$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
						$path = 'uploads';
						$this->upload_image($image, $path);
					}
					$data_arr = array(
						"email" => $ticket_email,
						"subject" => $ticket_sub,
						"message" => $message_ticket,
						"attach" => $image,
						"user_id" => $created_id,
					);

					$this->db->where('ticket_id', $ticket_no);
					$resultarray = $this->db->update('ost_ticket__cdata', $data_arr);

					$this->session->set_flashdata('success_msg', 'update ticket successfully');
					redirect("support-tickets");
				} else {
					$this->session->set_flashdata('error_msg', 'Empty Details..!');
					redirect("support-tickets");
				}
			} else if (isset($_POST['process'])) {
				$uid = $_POST['process'];
				$data = array("status" => '1');
				$this->db->where('ticket_id', $uid);
				$this->db->update('ost_ticket__cdata', $data);
				$this->db->last_query();
				$this->session->set_flashdata('success_msg', 'Proccess successfully');
				redirect("support-tickets");
			} elseif (isset($_POST['completed'])) {
				$uid = $_POST['completed'];
				$data = array("status" => '2');
				$this->db->where('ticket_id', $uid);
				$this->db->update('ost_ticket__cdata', $data);
                $query=  $this->db->select('*')->from('ost_ticket__cdata')->where('ticket_id', $uid)->get();
                  $result=$query->row();
                  $ticket_user_id=$result->user_id;
                  $session_uid = $this->session->userdata('id');
                  $notify_ins = array("user_id" => $ticket_user_id, "read_status" => 0, "type_read" => 2, "created_by" => $session_uid, "message" => 'Support ticket is completed Ticket-' . $uid, "created_at" => date('Y-m-d H:i:s'));
					$this->db->insert('notification_history', $notify_ins);
				$this->session->set_flashdata('success_msg', 'Completed successfully');
				redirect("support-tickets");
			}
			$data['last_ticket_no'] = $this->Dashboard_model->last_ticket_no();
			$data['list_ticket_data'] = $this->Dashboard_model->list_ticket_data();
			$data['ticket_count'] = $this->Dashboard_model->ticket_count();
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function edit_ticket() {
		$id = $this->input->post('ticket_id');
		$edit_data = $this->Dashboard_model->edit_tickit_data($id);
		echo '<div class="col-sm-12">
					<div class="form-group">
						<label>Ticket No </label>
						<div class="input-group">
							<input class="form-control " type="text" name="ticket_no" readonly="" value="' . $id . '" required="" >
						</div>
					</div>
					<div class="form-group">
						   <label for="email">Email Address</label>
						   <div class="input-group">
							   <input class="form-control" type="email" name="ticket_email" style="width:530px !important;" value="' . $edit_data['email'] . '" required="">
						   </div>
					   </div>

					<div class="form-group">
						<label>Subject </label>
						<div class="input-group">
							<input class="form-control" type="text" name="ticket_sub" style="width:530px !important;" value="' . $edit_data['subject'] . '" required="">
						</div>
					</div>
					<div class="form-group">
						<label>Message</label>
						<div class="input-group">
							<textarea class="form-control" id="edit_message_ticket" name="message_ticket" rows="4" cols="20" style="width:530% !important; height:100%;">' . $edit_data['message'] . '</textarea>
						</div>
					</div>
					<div class="form-group">
						<label>Attach File </label>
						<div class="input-group">
							<input type="file" name="image" class="create_new_ticket" >
							<input type="hidden" name="old_image" value="' . $edit_data['attach'] . '" >
							<span class="docurlUpdate"></span>
							<img src="" class="myImgUpdate" style="max-width:100px;max-height:100px;"/>
						</div>
					</div>
				</div>';
	}

	public function delete_ticket($ticket_id) {
		$this->db->where('ticket_id', $ticket_id);
		$this->db->delete('ost_ticket__cdata');

		$this->db->where('ticket_id', $ticket_id);
		$this->db->delete('ticket_comment');

		$this->session->set_flashdata('success_msg', 'Deleted successfully');
		redirect("support-tickets");
	}

	public function ticket_replay($ticket_no) {
		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'Ticket Comment';
			$data['file'] = 'admin/ticket_replay';
			$data['ticket_no'] = $ticket_no;
			if (isset($_POST['replay_btn'])) {
				$comment_ticket = $this->input->post('comment_ticket');
				$date = date('Y-m-d H:i:s');
				$data_arr = array(
					"ticket_id" => $ticket_no,
					"comment" => $comment_ticket,
					"commentator_id" => $this->session->userdata('id'),
					"created_date" => $date,
				);
				$this->db->insert("ticket_comment", $data_arr);
				$this->session->set_flashdata('success_msg', 'send successfully');
				redirect("panels/supermacdaddy/dashboard/ticket_replay/$ticket_no");
			}
			$data['list_ticket_comment'] = $this->Dashboard_model->list_ticket_comment($ticket_no);
			$data['ticket_file']=$this->Dashboard_model->ticket_file($ticket_no);
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	function upload_image($image, $path) {
		$config['upload_path'] = $path;
		$config['allowed_types'] = '*';
		$config['overwrite'] = FALSE;
		$config['file_name'] = $image;
		$config['max_size'] = '1000000';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('image')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}else{
			$result=$this->upload->data();
			return $result;
		} 
	}

	public function setting() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = "Site Settings";
			$data['file'] = 'admin/setting';
			$profile_user = $this->common_model->get_data_tbl('uf_user', 'id', $this->session->userdata('id'));
			$email = $profile_user->email;
			$username = $profile_user->user_name;
			$data['email'] = $email;
			$data['username'] = $username;
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function updatePassword() {
		if (isset($_POST) && $this->input->post('password') != '') {
			if ($this->input->post('password') == $this->input->post('confirmPass')) {
				$data = array('password' => MD5($this->input->post('password')), 'email' => $this->input->post('email'), 'user_name' => $this->input->post('user_name'));
				$this->common_model->update_record($data, 'uf_user', 'id', $this->session->userdata('id'));
				$this->session->set_flashdata('successmessage', 'Profile Updated Successfully');
				redirect('panels/supermacdaddy/dashboard/setting');
			} else {
				$this->session->set_flashdata('errormessage', 'Password not match.');
				redirect('panels/supermacdaddy/dashboard/setting');
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Password required.');
			redirect('panels/supermacdaddy/dashboard/setting');
		}
	}

	public function config_setting() {
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = "Site Settings";
			$data['file'] = 'admin/config_setting';
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function groups() {
		if ($this->session->userdata('adminlogin')) {
			$data['title'] = "Groups";
			$data['file'] = 'admin/groups';
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

	

	public function our_team(){
             $data['title'] = 'Our Team';
		    $data['file'] = 'admin/our_team';

		if (isset($_POST['save'])) {
			    $image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				$path = 'uploads';
				$this->upload_image($image, $path);
				 $data = array(
					'our_team_name'		=> $this->input->post('our_team_name'),
					'our_team_image'	=> $image,
					
				);
			$task = $this->Dashboard_model->saveOurTeam($data);
			$this->session->set_flashdata('success_msg', 'Our team is Saved Successfully');
			redirect("our-team");
		}
		if (isset($_POST['enable'])) { //die('e here');
			$id = $_POST['enable'];
			$data = array("status" => '1');
			$this->db->where('id', $id);
			$this->db->update('uf_our_team', $data);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Enable successfully');
			redirect("our-team");
		}
		if (isset($_POST['disable'])) { //die('d here');
			$id = $_POST['disable'];
			$data = array("status" => '0');
			$this->db->where('id', $id);
			$this->db->update('uf_our_team', $data);
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("our-team");
		}
		if (isset($_POST['delete'])) { 
				$id = $_POST['delete'];
			$this->db->where('id', $id);
			$this->db->delete('uf_our_team');
			$this->session->set_flashdata('success_msg', 'Delete successfully');
			redirect("our-team");
		}
		if (isset($_POST['updateOurTeam'])) {
			 if(!empty($_FILES["image"]["name"])){

              $image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
			  $path = 'uploads';
				$this->upload_image($image, $path);
			}else{
				 $image=$this->input->post('our_team_image');
			}
				 $data = array(
					'our_team_name'		=> $this->input->post('our_team_name'),
					'our_team_image'	=> $image,
					
				);
			$id=$_POST['updateOurTeam'];
			$this->db->where('id', $id);
			$this->db->update('uf_our_team', $data);
			$this->session->set_flashdata('success_msg', 'our team is Updated Successfully');
			redirect("our-team");
		}
		
		$data['all_cat'] = $this->Dashboard_model->all_Our_team();
		$this->load->view('admin_templates', $data);


	}
	public function opt()
	{
		if ($this->session->userdata('adminlogin') == 5) {
			$data['title'] = "Opt In/Out";
			$data['file'] = 'admin/opt';
			if (isset($_POST['save'])) {
				$optout_id=$this->input->post('optout_id');
				$optout_content=$this->input->post('optout_content');
				$optin_id=$this->input->post('optin_id');
				$optin_content=$this->input->post('optin_content');
				$outres = $this->Dashboard_model->optSave('optout',$optout_id,$optout_content);
				$inres = $this->Dashboard_model->optSave('optin',$optin_id,$optin_content);
				$this->session->set_flashdata('success_msg', 'Save successfully');
				redirect("opt");
			}
			$data['optin'] = $this->Dashboard_model->savetosdata('optin');
			$data['optout'] = $this->Dashboard_model->savetosdata('optout');
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
		
		
	}
	public function attachment_zip() {
		if ($this->session->userdata('adminlogin')) {
			$data['all_advrZip'] = $this->Dashboard_model->all_zip_files();
			$data['all_staff'] = $this->Dashboard_model->all_staff_attachement();
			$data['title'] = 'General Sales';
			$data['file'] = 'admin/attachment-zip';
 			$data['zip_id'] = $this->input->get('id');
			if (!empty($data['zip_id'])) {
				$data['edit_zip'] = $this->Dashboard_model->edit_zip_files($data['zip_id']);
			}
			$this->load->view('admin_templates', $data);
		} else {
			redirect('/');
		}
	}

		public function advertisements() {
		if ($this->session->userdata('adminlogin')) {



			
		

			if (isset($_POST['statusUpdate'])) {

					

					$data = array('status'	=> $this->input->post('status'));
					
					$where = array('ad_id' => $this->input->post('ad_id'));
					$userEmail = $this->input->post('userEmail');
					


					$this->Dashboard_model->updateReferralCode('sal_advertisement',$data,$where);
					$createdBy = $this->input->post('created_by');

				 	$query="select distinct(u.email) as email  from sal_advertisement as ad inner join  uf_user as u on u.id=ad.created_by where ad.created_by = '$createdBy'";

        $result=$this->db->query($query);
       // echo $this->db->last_query();

		$dataResult = $result->row();
		

					if($this->input->post('status') == 1){

			
			$subject='Approved';
			$send_message = 'Advertisement Approved Successfully';

				$this->email->set_mailtype("html");
			$this->email->from('info@medconnex.net', 'MedConnex');
			$this->email->to($userEmail);
			
			$this->email->subject('MedConnex:: '.$subject);
			$this->email->message('Hello ' . $userEmail . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnex');

			$this->email->send();

			$email=$dataResult->email;
			$this->email->set_mailtype("html");
			$this->email->from('info@medconnex.net', 'MedConnex');
			$this->email->to($email);
		
			$this->email->subject('MedConnex:: '.$subject);
			$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnex');

			$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('success_msg', 'Advertisement Approved Successfully');
			$data1 = array('user_id' =>$this->input->post('created_by'),'message' => 'Advertisement Is Sold Successfully. '.$this->input->post('ad_type').'','created_at'=> date('Y-m-d H:i:s'),'status' => '1');
			$this->db->insert("history", $data1);

			$data2 = array('user_id' =>'1','message' => 'Advertisement Is Sold Successfully. '.$this->input->post('ad_type').'','created_at'=> date('Y-m-d H:i:s'),'read_status' => '0','sender_id' => $this->input->post('created_by'));
			$this->db->insert("notification_history", $data2);
	//redirect('super-admin');
		} 
		// redirect('/');

					}
					else{
		
			$email=$dataResult->email;
			$subject='Dispproved';
			$send_message = 'Advertisement Dispproved Successfully';

				$this->email->from('info@medconnex.net', 'MedConnex');
			$this->email->to($userEmail);
			
			$this->email->subject('MedConnex:: '.$subject);
			$this->email->message('Hello ' . $userEmail . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnex');

			$this->email->send();

			$this->email->set_mailtype("html");
			$this->email->from('info@medconnex.net', 'MedConnex');
			$this->email->to($email);
			
			$this->email->subject('MedConnex:: '.$subject);
			$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnex');

		$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('success_msg', 'Advertisement Dispproved Successfully');
			//redirect('super-admin');
					}
					

		 			
		 			// redirect('/');
		}

		}
			$data['advertisements'] = $this->Dashboard_model->advertisements();
			$data['title'] = 'Advertisement Sales';
			$data['file'] = 'admin/advertisements';
 			
			$this->load->view('admin_templates', $data);
		
		} else {
			redirect('/');
		}
	}

	public function updateAttach() {
		if (isset($_POST['update'])) {
			if (!empty($this->input->post('title'))) {
				$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				if ($_FILES["image"]["name"] == '') {
					$image = $this->input->post('image_old');
				}
				$path = 'uploads';
				if ($_FILES["image"]["name"] != '') {
					if (file_exists(FCPATH . 'uploads/' . $this->input->post('image_old'))) {
						unlink(FCPATH . 'uploads/' . $this->input->post('image_old'));
					}
					$this->upload_image($image, $path);
				}

				$result = $this->Dashboard_model->update_attach($image);
				if ($result) {
					
					$mail_send = $this->input->post('mail_send');
					if(!empty($mail_send))
					{
						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnex');
						$this->email->to($mail_send);
						$this->email->subject('MedConnex::Document');
						$this->email->message('Hello ' . $user_mail . ',
								<br>Your task has been created on <b>MedConnex</b> team.<br><br>
								Check Attachment Document...
								<br> contact our staff at info@medconnex.net
								<br>
								Thank you,<br>
								MedConnex');
						if (!empty($image)) {
							$this->email->attach(base_url() . 'uploads' . $image . '');
						}
						$this->email->send();
					}
					
					$this->session->set_flashdata('success_msg', "Attachment updated successfully");
					redirect("attachment-zip");
				} else {
					$this->session->set_flashdata('success_msg', "Attachment data not updated");
					redirect("attachment-zip");
				}
			} else {
				$error = '<div   style="padding: 5px;" class="alert alert-danger" > Something wrong..! </div>';
			}
		}
	}


	public function saveZipFile() {
		if (isset($_POST)) {

			if (!empty($this->input->post('title'))) {
				$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				$path = 'uploads';
				if ($_FILES["image"]["name"] != '') {
					$this->upload_image($image, $path);
				}
				$result = $this->Dashboard_model->insert_attachment($image);
				if ($result) {
					$this->session->set_flashdata('success_msg', "Attachments added successfully");
					redirect("attachment-zip");
				} else {
					$this->session->set_flashdata('success_msg', "Attachments data not added");
					redirect("attachment-zip");
				}
			} else {
				$error = '<div   style="padding: 5px;" class="alert alert-danger" > Attachments </div>';
			}
		}
	}

	public function deleteAttach($zip_id) {
		$this->db->where('zip_id', $zip_id);
		$this->db->delete('sal_zip');
		$this->session->set_flashdata('success_msg', 'Deleted successfully');
		redirect("attachment-zip");
	}

	  	public function background_image(){
             $data['title'] = 'Our Team';
		     $data['file'] = 'admin/background_image';

		if (isset($_POST['save'])) {
			    $image = $_FILES["image"]["name"];
				$path = 'public/images/coverImages';
			    $dataResult=$this->upload_image($image, $path);
			    if($dataResult['image_width'] >= 800){

			    	 $data = array(
					'img_url'	=> $dataResult['file_name']
				 );
			    }else{
		    	$this->session->set_flashdata('error_msg', 'please upload proper size of backgroundimage min-width 800px. Current upload image width'.$dataResult['image_width']);
	        	redirect("background-image");
		    	}
				
			$task = $this->Dashboard_model->saveBackgroundImage($data);
			$this->session->set_flashdata('success_msg', 'background Image is Saved Successfully');
			redirect("background-image");
		}
		if (isset($_POST['enable'])) { //die('e here');
			$id = $_POST['enable'];
			$data = array("status" => '1');
			$this->db->where('id', $id);
			$this->db->update('cp_banner_slider', $data);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Enable successfully');
			redirect("background-image");
		}
		if (isset($_POST['disable'])) { //die('d here');
			$id = $_POST['disable'];
			$data = array("status" => '0');
			$this->db->where('id', $id);
			$this->db->update('cp_banner_slider', $data);
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("background-image");
		}
		if (isset($_POST['delete'])) { 
				$id = $_POST['delete'];
			$this->db->where('id', $id);
			$this->db->delete('cp_banner_slider');
			$this->session->set_flashdata('success_msg', 'Delete successfully');
			redirect("background-image");
		}
		if (isset($_POST['updateOurTeam'])) {
			 if(!empty($_FILES["image"]["name"])){
			 	  $image = $_FILES["image"]["name"];
				 $path = 'public/images/coverImages';
			    $dataResult=$this->upload_image($image, $path);
			    if($dataResult['image_width'] >= 800){
					$image=$dataResult['file_name'];
				 
			    }else{
		    	$this->session->set_flashdata('error_msg', 'please upload proper size of backgroundimage min-width 800px. Current upload image width'.$dataResult['image_width']);
	        	redirect("background-image");
		    	}

			}else{
				 $image=$this->input->post('img_url');
			}
				 $data = array(
					'img_url'	=> $image,
					
				);
			$id=$_POST['updateOurTeam'];
			$this->db->where('id', $id);
			$this->db->update('cp_banner_slider', $data);
			$this->session->set_flashdata('success_msg', 'background image is Updated Successfully');
			redirect("background-image");
		}
		
		$data['all_cat'] = $this->Dashboard_model->all_background_images();
		$this->load->view('admin_templates', $data);


	}
	public function edit_background_image() {
		$result = $this->Dashboard_model->ourBackgroundImage();
		$our_team_image=$result['img_url'];
		$imageurl=base_url('public/'.$our_team_image);
		echo '<div class="row">
						
					<div class="col-sm-6">
							<div class="form-group">
								<label>Background Image</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control get_image" type="file" name="image" autocomplete="off"  placeholder="" id="get_image" required="" aria-required="true" type="text">
									<input type="hidden" name="img_url"  value="' .$result['img_url'] . '">
								</div>
							

							</div>
						</div>  
							<img src="'.base_url('public/images/coverImages/'.$our_team_image).'" class="myImg1" width="1000px" height="800px" style="padding:5px">
			 
						<div class="modal-footer" style="clear:both">
							<div class="creatUserBottom ">
								<div class="">
									<div class="vert-pad">
										<button type="submit" name="updateOurTeam"  value="' .$result['id'] . '" class="btn-green">
											Update Background Image
										</button> 
									</div>          
								</div>       
								<div class="">
									<div class="vert-pad">
										<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</div>';
	}


  public function composemail()
  {

        $email=$this->input->post('send_to');
        $subject=$this->input->post('send_subject');
        $send_message=$this->input->post('send_message');
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnex');
		$this->email->to($email);
		$this->email->subject('MedConnex:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnex');

		$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('successmessage', 'Mail has sent successfully');
			redirect("super-admin");
		} else {
			$this->session->set_flashdata('successmessage', 'Sorry  Mail is not sent');
			redirect("super-admin");
		}
  }


  public function affiliatesComposemail()
  {

        $email=$this->input->post('send_to');
         $cc=$this->input->post('cc');
        $subject=$this->input->post('send_subject');
        $send_message=$this->input->post('send_message');
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnex');
		$this->email->to($email);
		$this->email->cc($cc);
		$this->email->subject('MedConnex:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnex');

		$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('success_msg', 'Mail has sent successfully');
			redirect("distribution-zone");
		} else {
			$this->session->set_flashdata('error_msg', 'Sorry  Mail is not sent');
			redirect("distribution-zone");
		}
  }



  public function pending_affiliate() {
		$data['title'] = 'pending_providers';
		$data['file'] = 'admin/pending_affiliate';
        $data['alluser']=$this->Dashboard_model->getAffiliates();

        if (isset($_POST['updateNote'])) {
			$notes = $_POST['notes'];
			$user_id = $_POST['user_id'];
			$dataa = array("notes" => $notes);
			$this->db->where('user_id', $user_id);
			$this->db->update('uf_affiliate_detail', $dataa);
			$this->session->set_flashdata('success_msg', 'Note Update successfully');
			redirect("pending-affiliate");
		}


		if (isset($_POST['deactive'])) {
			$uid = $_POST['deactive'];
			$dataa = array("is_verify" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("pending-affiliate");
		}
		if (isset($_POST['active'])) {
			$uid = $_POST['active'];
			$user_name = $_POST['user_name'];
			
			$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
				$password =  substr(str_shuffle($str_result),  
				0, 7);

			$dataa = array("is_verify" => 1,"password" => md5($password));
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);

	$email=$this->input->post('send_to');

			$name = explode('@', $email);

  
				$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
				$randomId1 =  substr(str_shuffle($str_result),  
				0, 7);
				$randomId = $randomId1.'-'.$name[0];
				$dataarr = array('randomId' => $randomId);
				$this->db->where('email', $email);
				$this->db->update('uf_user', $dataarr);



		
			$subject='Activate Account';
			$send_message='Welcome to our team, we look forward to working together and learning from each other. We have attached training manuals along with some tutorial information to help navigate your back panel process.<br>Below is your permanent Affiliate Partner ID # which is used for identification purposes so make sure to remember it because you will use in replacement of your name. We have also sent temporary credentials to enter into your back panel. (www.medconnex.net> login icon) to begin organizing your information and managing your appointed territory.<br>Remember to contact your handler for 1-1 assistance when needed, we will send further instructions on our next Affiliate Partner gathering soon.<br>Affiliate Partner ID<br>('.$randomId.')<br><br> Temporary(back-panel) Credentials<br>username:'.$user_name.'<br>password:'.$password.'';
			$this->email->set_mailtype("html");
			$this->email->from('info@medconnex.net', 'MedConnex');
			$this->email->to($email);
			 
			$this->email->subject('MedConnex:: '.$subject);
			$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'<br>
			
			MedConnex');

		 	$mailsend = $this->email->send();

		 	if(!empty($mailsend)){
		 			$this->session->set_flashdata('success_msg', 'Enabled successfully');
			redirect("pending-affiliate");
		 	}

		 	    
			
    		 }
    		 	if (isset($_POST['changePassword'])) {
				$password=$this->input->post('password');
                 $newpassword=$this->input->post('newpassword');

               
                $password1 =  md5($password);
                $newpassword1 =  md5($newpassword);
                $id = $_POST['user_id'];


				$query = $this->db->query("select id from uf_user where password = '$password1' AND id =  '$id'");
				$existResult = $query->row();
				if($existResult->id != ''){
					$data = array(
						 'password' =>$newpassword1
				
			       );
				$this->db->where('id',$_POST['user_id']);
				$this->db->update('uf_user',$data);
				$this->session->set_flashdata('success_msg', 'Password updated successfully');
				redirect("pending-affiliate");
			
				}
				else{
						$this->session->set_flashdata('success_msg', 'Old Password Is Not Match Database');
							redirect("pending-affiliate");
				}
			    

				
			
		}

			
			
			
			
		
	
		$this->load->view('admin_templates', $data);
	}

    public function generalSalesBulkUpload()
    {
    	//print_r($_FILES);
        $image = $_FILES["image"]["name"];
	    $path = 'uploads';
	    $ext = end((explode(".", $image)));
	    $extension=strtolower($ext);
	    if($extension !='csv'){
	      $this->session->set_flashdata('error_msg', "Please upload csv file ");
		  redirect("general-sales");
	    }

        $result=$this->upload_image($image, $path);
        
	    $file = fopen("uploads/".$result['file_name'],"r");
	    $i=0;
	  //  echo "<pre>";
	    while(($line = fgetcsv($file)) !== FALSE){
	    	$i++;
	    	if($i == '1'){
	    		continue;
	    	}
	    	$data = array(
		    		'email' =>$line[0] , 
		    		'contact_no' =>$line[1] , 
		    		'zip_code' =>$line[2] , 
		    		'city' =>$line[3] , 
		    		'provider_type' =>$line[4] , 
		    		'notes' =>$line[5] , 
		    		'trash' =>$line[6] , 
		    		'state' =>$line[7] , 
		    		'pageurl' =>$line[8] , 
		    		'location_name' =>$line[9] , 
		    		'street' =>$line[10] , 
		    	    );

		     $this->db->insert('uf_general_sale',$data);
		   
	     }
	     fclose($file);
	      $this->session->set_flashdata('success_msg', "General Sales bulk upload is done successfully ");
		  redirect("general-sales");

    }


      public function ondemandBulkUpload()
    {
    	
        $image = $_FILES["image"]["name"];
	    $path = 'uploads';
	    $ext = end((explode(".", $image)));
	    $extension=strtolower($ext);
	    if($extension !='csv'){
	      $this->session->set_flashdata('error_msg', "Please upload csv file ");
		  redirect("authorized-users");
	    }

        $result=$this->upload_image($image, $path);
        
	    $file = fopen("uploads/".$result['file_name'],"r");
	    $i=0;
	  
	    while(($row = fgetcsv($file)) !== FALSE){
	    	$i++;
	    	if($i == '1'){
	    		continue;
	    	} 
	    	  if(!empty($row[0])){
                $result=$this->db->select('*')->from('uf_user')->where('email',$row[0])->get()->num_rows();
                if($result > 0){
                	continue;
                 }
           
	    	            $data = array(
									"email"=>$row[0],
									'password'=>md5($row[0]),
									"user_name" => $row[1], 
									"display_name" => $row[1], 
									"state"=>$row[2],
									"zip"=>$row[3],
									"city"=>$row[10],
									"facebook"=>$row[11],
									"twitter"=>$row[12],
									"instagram"=>$row[13],
									"complimentary_ad_space"=>$row[14],
									"page_url"=>$row[15],
									"mob_number"=>$row[4],
									"user_lat"=>$row[5],
									"user_long"=>$row[6],
									"on_off_status"=>'1',
									"street"=>$row[7],
									"title" => "ondemand",
									"user_type" => 1,
									"is_verify" => 1,
									"profile_pic" => $row[16],
									"profile_url" =>$row[17],
									"about_me" => $row[8],
									"created_by_id" =>$this->session->userdata('id'),
									);
			
		      $this->db->insert('uf_user',$data);
		     $insertid=$this->db->insert_id();
		     $location = array(
				       	            "user_id"=>$insertid,
				       	            "paypal_business_name"=>$row[9] ==''?$row[0]:$row[9],
									"city"=>$row[10],
									"email"=>$row[0],
									"phone_number"=>$row[4],
									"longitude"=>$row[5],
									"latitude"=>$row[6]
								);
		   
		     $day = array(
		     	'user_id' =>$insertid ,
		     	'day_name' =>'SUNDAY,MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY',
		     	'day_timings' =>$row[18].','.$row[19].','.$row[20].','.$row[21].','.$row[22].','.$row[23].','.$row[24] ,
		     	 );
		    
		      $this->db->insert('uf_delivery_timings',$day);
		      $this->db->insert('cp_locations',$location);
		     
		   }
	     }
	     fclose($file);
	      $this->session->set_flashdata('success_msg', "Ondemand bulk upload is done successfully ");
		  redirect("authorized-users");

    }
      public function ondemandBulkUpload_Backup()
    {
    	//print_r($_FILES);
        $image = $_FILES["image"]["name"];
	    $path = 'uploads';
	    $ext = end((explode(".", $image)));
	    $extension=strtolower($ext);
	    if($extension !='csv'){
	      $this->session->set_flashdata('error_msg', "Please upload csv file ");
		  redirect("authorized-users");
	    }

        $result=$this->upload_image($image, $path);
        
	    $file = fopen("uploads/".$result['file_name'],"r");
	    $i=0;
	  //  echo "<pre>";
	    while(($row = fgetcsv($file)) !== FALSE){
	    	$i++;
	    	if($i == '1'){
	    		continue;
	    	} 
	    	  if(!empty($row[0])){
               $result=$this->db->select('*')->from('uf_user')->where('email',$row[0])->get()->num_rows();
                if($result > 0){
                	continue;
                 }

	    	            $data = array(
									"email"=>$row[0],
									'password'=>md5($row[0]),
									"user_name" => $row[1], 
									"display_name" => $row[1], 
									"state"=>$row[2],
									"zip"=>$row[3],
									"mob_number"=>$row[4],
									"user_lat"=>$row[5],
									"user_long"=>$row[6],
									"on_off_status"=>$row[7],
									"title" => "ondemand",
									"user_type" => 1,
									"is_verify" => 1,
									"about_me" => $row[8],
									"created_by_id" =>$this->session->userdata('id'),
									);
		      $this->db->insert('uf_user',$data);
		     $insertid=$this->db->insert_id();
		     $location = array(
				       	            "user_id"=>$insertid,
				       	            "paypal_business_name"=>$row[9],
									"city"=>$row[10],
									"email"=>$row[0],
									"phone_number"=>$row[4],
									"longitude"=>$row[5],
									"latitude"=>$row[6]
								);

		      $this->db->insert('cp_locations',$location);
		     
		   }
	     }
	     fclose($file);
	      $this->session->set_flashdata('success_msg', "Ondemand bulk upload is done successfully ");
		  redirect("authorized-users");

    }
         public function storefrontBulkUpload_backup()
    {
    	//print_r($_FILES);
        $image = $_FILES["image"]["name"];
	    $path = 'uploads';
	    $ext = end((explode(".", $image)));
	    $extension=strtolower($ext);
	    if($extension !='csv'){
	      $this->session->set_flashdata('error_msg', "Please upload csv file ");
		  redirect("authorized-users");
	    }

        $result=$this->upload_image($image, $path);
        
	    $file = fopen("uploads/".$result['file_name'],"r");
	    $i=0;
	  //  echo "<pre>";
	    while(($row = fgetcsv($file)) !== FALSE){
	    	$i++;
	    	if($i == '1'){
	    		continue;
	    	}
	    	  if(!empty($row[0])){
               $result=$this->db->select('*')->from('uf_user')->where('email',$row[0])->get()->num_rows();
                if($result > 0){
                	continue;
                 }

	    	            $data = array(
									"email"=>$row[0],
									'password'=>md5($row[0]),
									"user_name" => $row[1], 
									"display_name" => $row[1], 
									"state"=>$row[2],
									"zip"=>$row[3],
									"mob_number"=>$row[4],
									"user_lat"=>$row[5],
									"user_long"=>$row[6],
									"on_off_status"=>$row[7],
									"title" => "storefront",
									"user_type" => 3,
									"is_verify" => 1,
									"about_me" => $row[8],
									"created_by_id" =>$this->session->userdata('id'),
									);
		      $this->db->insert('uf_user',$data);
		     $insertid=$this->db->insert_id();
		     $location = array(
				       	            "user_id"=>$insertid,
				       	            "paypal_business_name"=>$row[9],
									"city"=>$row[10],
									"email"=>$row[0],
									"phone_number"=>$row[4],
									"longitude"=>$row[5],
									"latitude"=>$row[6]
								);

		      $this->db->insert('cp_locations',$location);
		     
		   }
	     }
	     fclose($file);
	      $this->session->set_flashdata('success_msg', "storefront bulk upload is done successfully ");
		  redirect("authorized-users");

    }

          public function doctorBulkUpload_backup()
    {
    	//print_r($_FILES);
        $image = $_FILES["image"]["name"];
	    $path = 'uploads';
	    $ext = end((explode(".", $image)));
	    $extension=strtolower($ext);
	    if($extension !='csv'){
	      $this->session->set_flashdata('error_msg', "Please upload csv file ");
		  redirect("authorized-users");
	    }

        $result=$this->upload_image($image, $path);
        
	    $file = fopen("uploads/".$result['file_name'],"r");
	    $i=0;
	  //  echo "<pre>";
	    while(($row = fgetcsv($file)) !== FALSE){
	    	$i++;
	    	if($i == '1'){
	    		continue;
	    	}
	    	  if(!empty($row[0])){
               $result=$this->db->select('*')->from('uf_user')->where('email',$row[0])->get()->num_rows();
                if($result > 0){
                	continue;
                 }

	    	            $data = array(
									"email"=>$row[0],
									'password'=>md5($row[0]),
									"user_name" => $row[1], 
									"display_name" => $row[1], 
									"state"=>$row[2],
									"zip"=>$row[3],
									"mob_number"=>$row[4],
									"user_lat"=>$row[5],
									"user_long"=>$row[6],
									"on_off_status"=>$row[7],
									"title" => "doctor",
									"user_type" => 2,
									"is_verify" => 1,
									"about_me" => $row[8],
									"created_by_id" =>$this->session->userdata('id'),
									);
		      $this->db->insert('uf_user',$data);
		     $insertid=$this->db->insert_id();
		     $location = array(
				       	            "user_id"=>$insertid,
				       	            "paypal_business_name"=>$row[9],
									"city"=>$row[10],
									"email"=>$row[0],
									"phone_number"=>$row[4],
									"longitude"=>$row[5],
									"latitude"=>$row[6]
								);

		      $this->db->insert('cp_locations',$location);
		     
		   }
	     }
	     fclose($file);
	      $this->session->set_flashdata('success_msg', "Doctor bulk upload is done successfully ");
		  redirect("authorized-users");

    }
      public function storefrontBulkUpload()
    {
    	
        $image = $_FILES["image"]["name"];
	    $path = 'uploads';
	    $ext = end((explode(".", $image)));
	    $extension=strtolower($ext);
	    if($extension !='csv'){
	      $this->session->set_flashdata('error_msg', "Please upload csv file ");
		  redirect("authorized-users");
	    }

        $result=$this->upload_image($image, $path);
        
	    $file = fopen("uploads/".$result['file_name'],"r");
	    $i=0;
	  
	    while(($row = fgetcsv($file)) !== FALSE){
	    	$i++;
	    	if($i == '1'){
	    		continue;
	    	} 
	    	  if(!empty($row[0])){
                $result=$this->db->select('*')->from('uf_user')->where('email',$row[0])->get()->num_rows();
                if($result > 0){
                	continue;
                 }
           
	    	            $data = array(
									"email"=>$row[0],
									'password'=>md5($row[0]),
									"user_name" => $row[1], 
									"display_name" => $row[1], 
									"state"=>$row[2],
									"zip"=>$row[3],
									"city"=>$row[10],
									"facebook"=>$row[11],
									"twitter"=>$row[12],
									"instagram"=>$row[13],
									"complimentary_ad_space"=>$row[14],
									"page_url"=>$row[15],
									"mob_number"=>$row[4],
									"user_lat"=>$row[5],
									"user_long"=>$row[6],
									"on_off_status"=>'1',
									"street"=>$row[7],
									"title" => "storefront",
									"user_type" => 3,
									"is_verify" => 1,
									"profile_pic" => $row[16],
									"profile_url" =>$row[17],
									"about_me" => $row[8],
									"created_by_id" =>$this->session->userdata('id'),
									);
			
		      $this->db->insert('uf_user',$data);
		     $insertid=$this->db->insert_id();
		     $location = array(
				       	            "user_id"=>$insertid,
				       	            "paypal_business_name"=>$row[9] ==''?$row[0]:$row[9],
									"city"=>$row[10],
									"email"=>$row[0],
									"phone_number"=>$row[4],
									"longitude"=>$row[5],
									"latitude"=>$row[6]
								);
		   
		     $day = array(
		     	'user_id' =>$insertid ,
		     	'day_name' =>'SUNDAY,MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY',
		     	'day_timings' =>$row[18].','.$row[19].','.$row[20].','.$row[21].','.$row[22].','.$row[23].','.$row[24] ,
		     	 );
		    
		      $this->db->insert('uf_delivery_timings',$day);
		      $this->db->insert('cp_locations',$location);
		     
		   }
	     }
	     fclose($file);
	      $this->session->set_flashdata('success_msg', "Storefront bulk upload is done successfully ");
		  redirect("authorized-users");

    }
    public function doctorBulkUpload()
    {
    	
        $image = $_FILES["image"]["name"];
	    $path = 'uploads';
	    $ext = end((explode(".", $image)));
	    $extension=strtolower($ext);
	    if($extension !='csv'){
	      $this->session->set_flashdata('error_msg', "Please upload csv file ");
		  redirect("authorized-users");
	    }

        $result=$this->upload_image($image, $path);
	    $file = fopen("uploads/".$result['file_name'],"r");
	    $i=0;
	  
	    while(($row = fgetcsv($file)) !== FALSE){
	    	$i++;
	    	if($i == '1'){
	    		continue;
	    	} 
	    	  if(!empty($row[0])){
                $result=$this->db->select('*')->from('uf_user')->where('email',$row[0])->get()->num_rows();
                if($result > 0){
                	continue;
                 }
           
	    	            $data = array(
									"email"=>$row[0],
									'password'=>md5($row[0]),
									"user_name" => $row[1], 
									"display_name" => $row[1], 
									"state"=>$row[2],
									"zip"=>$row[3],
									"city"=>$row[10],
									"facebook"=>$row[11],
									"twitter"=>$row[12],
									"instagram"=>$row[13],
									"complimentary_ad_space"=>$row[14],
									"page_url"=>$row[15],
									"mob_number"=>$row[4],
									"user_lat"=>$row[5],
									"user_long"=>$row[6],
									"on_off_status"=>'1',
									"street"=>$row[7],
									"title" => "Doctor",
									"user_type" => 2,
									"is_verify" => 1,
									"profile_pic" => $row[16],
									"profile_url" =>$row[17],
									"about_me" => $row[8],
									"created_by_id" =>$this->session->userdata('id'),
									);
			
		      $this->db->insert('uf_user',$data);
		     $insertid=$this->db->insert_id();
		     $location = array(
				       	            "user_id"=>$insertid,
				       	            "paypal_business_name"=>$row[9] ==''?$row[0]:$row[9],
									"city"=>$row[10],
									"email"=>$row[0],
									"phone_number"=>$row[4],
									"longitude"=>$row[5],
									"latitude"=>$row[6]
								);
		   
		     $day = array(
		     	'user_id' =>$insertid ,
		     	'day_name' =>'SUNDAY,MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY',
		     	'day_timings' =>$row[18].','.$row[19].','.$row[20].','.$row[21].','.$row[22].','.$row[23].','.$row[24] ,
		     	 );
		    
		      $this->db->insert('uf_delivery_timings',$day);
		      $this->db->insert('cp_locations',$location);
		     
		   }
	     }
	     fclose($file);
	      $this->session->set_flashdata('success_msg', "Doctor bulk upload is done successfully ".$i);
		  redirect("authorized-users");
    }

   
    

    public function general_sales() {
		if ($this->session->userdata('adminlogin')) {
		      $config = array();
		      $config["base_url"] = base_url('general-sales');
		      $config["total_rows"] = $this->Dashboard_model->record_count('uf_general_sale');
		      $config["per_page"] = 20;
		      $config["uri_segment"] = 2;
		      $config['full_tag_open']    = "<ul class='pagination'>";
		      $config['full_tag_close']   = "</ul>";
		      $config['num_tag_open']     = '<li class="page-item">';
		      $config['num_tag_close']    = '</li>';
		      $config['cur_tag_open']     = "<li class='page-item disabled paginate_button active'><a class='page-link' href='javascript:void(0)'>";
		      $config['cur_tag_close']    = "</a></li>";
		      $config['first_link'] = false;
		      $config['last_link'] = false;
		      $config['prev_link'] = '</i> Previous';
		      $config['prev_tag_open'] = '<li>';
		      $config['prev_tag_close'] = '</li>';
		      $config['next_link'] = 'Next ';
		      $config['next_tag_open'] = '<li>';
		      $config['next_tag_close'] = '</li>';
		      $config['reuse_query_string'] = true;

		      $this->pagination->initialize($config);
		      $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		      $data["all_staff"] = $this->Dashboard_model->general_sales($config["per_page"], $page);
		      $data['links']= $this->pagination->create_links();
		      $data["total_rows"] = $this->Dashboard_model->record_count('uf_general_sale');
			  $data['title'] = 'General Sales';
			  $data['file'] = 'admin/general-sales';
			if (isset($_POST['update'])) {
				$result = $this->Dashboard_model->updateGeneralSaleUser();
				$this->session->set_flashdata('success_msg', "General Sales updated successfully");
				redirect("general-sales");
			}
			if (isset($_POST['enable'])) {

				$user_id = $this->input->post('enable');
				$dataarr = array('is_verify' => 1);
				$this->db->where('id', $user_id);
			    $this->db->update('uf_general_sale', $dataarr);

			        $email = $this->input->post('email');
				$dataarr1 = array('approve' => 1);
				$this->db->where('email', $email);
					    $this->db->update('uf_user', $dataarr1);
				$this->session->set_flashdata('success_msg', "Enable Successfully");
				redirect("general-sales");
			}
			if (isset($_POST['disable'])) {

				$user_id = $this->input->post('disable');
				$dataarr = array('is_verify' => 0);
		        $this->db->where('id', $user_id);
			    $this->db->update('uf_general_sale', $dataarr);

			        $email = $this->input->post('email');
				$dataarr1 = array('approve' => 0);
				$this->db->where('email', $email);
					    $this->db->update('uf_user', $dataarr1);
				$this->session->set_flashdata('success_msg', "Disable Successfully");
				redirect("general-sales");
 			}


 			if (isset($_POST['contact'])) {

				$statusContact = $this->input->post('statusContact');
				$id = $this->input->post('id');
				$data = array('statusContact' => $statusContact);
		        $this->db->where('id', $id);
			    $this->db->update('uf_general_sale', $data);
			    if($statusContact == 1){
			    	$this->session->set_flashdata('success_msg', "1st Contact Successfully");
			    }
			    else{
			    		$this->session->set_flashdata('success_msg', "2nd Contact Successfully");
			    }
				
				redirect("general-sales");
 			}
 				if (isset($_POST['compStatus'])) {
 					  $email=$this->input->post('useremail');

				$compStatus = $_REQUEST['compStatus'];
				$id = $_REQUEST['id'];
				$compStartDate = date("Y-m-d");
				$comstartendtime = date("H:i:s");
    			$compEndDate = date('Y-m-d', strtotime($compStartDate. ' + 13 days'));

    					$query=$this->db->query("SELECT randomId from uf_general_sale where email = '".$email."' ");
    		 $existdata =$query->row();
    	

    		 if($existdata->randomId !=''){
    		 	$randomId  = $existdata->randomId;
    		 }
    		 else{
    		 	// $randomId = uniqid();
    		 	$name = explode('@', $email);

  
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
	    $randomId1 =  substr(str_shuffle($str_result),  
                       0, 7);
	    $randomId = $randomId1.'-'.$name[0];
    		 }
    		

				$dataarr = array('comp' => $compStatus,'compStartDate' => $compStartDate,'comstartendtime'=>$comstartendtime,'compEndDate' => $compEndDate,'randomId' => $randomId);

				///$dataarr = array('comp' => $compStatus,'compStartDate' => $compStartDate,'comstartendtime'=>$comstartendtime,'compEndDate' => $compEndDate);
		        $this->db->where('id', $id);
			    $this->db->update('uf_general_sale', $dataarr);
				$this->session->set_flashdata('success_msg', "Update Comp Successfully");



  $email=$this->input->post('useremail');

        //$cc=$this->input->post('cc');

        $subject='Provider Email Notice:';
        $send_message='Thank You for trying out our 2 Week  Complimentary Trial , web are sure you will stay after experiencing our great service. After your 2 Week Trial your back panel will FREEZE and you will need to contact our Sales Department to activate your account again and your id "'.$randomId.'"';
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnex');
		$this->email->to($email);
		//$this->email->cc($cc);
		$this->email->subject('MedConnex:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'<br>
			
			MedConnex');

		 	$mailsend = $this->email->send();
			//redirect("sales-general-sales");
			}
			
			$this->load->view('admin_templates', $data);
		} else {
			redirect('general-sales');
		}
	}




  public function pendingUpgrades() {
		if ($this->session->userdata('adminlogin')) {
		      
		      
		   
		      $data["all_staff"] = $this->Dashboard_model->pendingUpgrades();
		   
			  $data['title'] = 'Pending Upgrades';
			  $data['file'] = 'admin/pendingUpgrades';
			// if (isset($_POST['update'])) {
			// 	$result = $this->Dashboard_model->updateGeneralSaleUser();
			// 	$this->session->set_flashdata('success_msg', "General Sales updated successfully");
			// 	redirect("general-sales");
			// }
			if (isset($_POST['enable'])) {

				 $id = $this->input->post('enable');
				

	$sql ="update uf_user_documents set document_status = '1' where user_id = '$id'";
		$query = $this->db->query($sql);
				
				$this->session->set_flashdata('success_msg', "Enable Successfully");
				redirect("Dashboard/pendingUpgrades");
			}
			if (isset($_POST['disable'])) {

				$id = $this->input->post('disable');

				$sql ="update uf_user_documents set document_status = '0' where user_id = '$id'";
		$query = $this->db->query($sql);

				$this->session->set_flashdata('success_msg', "Disable Successfully");
				redirect("Dashboard/pendingUpgrades");
 			}
			
			$this->load->view('admin_templates', $data);
		} else {
			redirect('dashboard/pendingUpgrades');
		}
	}

	  	 public function twoweekCompEmail()
  {

        $email=$this->input->post('send_to');

        $cc=$this->input->post('cc');

        $subject=$this->input->post('send_subject');
        $send_message=$this->input->post('send_message');
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnex');
		$this->email->to($email);
		$this->email->cc($cc);
		$this->email->subject('MedConnex:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'<br>
			Thank You for trying out our 2 Week  Complimentary Trial , web are sure you will stay after experiencing our great service. After your 2 Week Trial your back panel will FREEZE and you will need to contact our Sales Department to activate your account again.<br>
			MedConnex');

		 	$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('successmessage', 'Mail has sent successfully');
			redirect("general-sales");
		} else {
			$this->session->set_flashdata('successmessage', 'Sorry  Mail is not sent');
			redirect("general-sales");
		}
  }




	  	 public function affiliateEmail()
  {

        $email=$this->input->post('send_to');

        $cc=$this->input->post('cc');

        $subject=$this->input->post('send_subject');
        $send_message=$this->input->post('send_message');
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnex');
		$this->email->to($email);
		$this->email->cc($cc);
		$this->email->subject('MedConnex:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'<br>
			
			MedConnex');

		 	$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('successmessage', 'Mail has sent successfully');
			redirect("pending-affiliate");
		} else {
			$this->session->set_flashdata('successmessage', 'Sorry  Mail is not sent');
			redirect("pending-affiliate");
		}
  }


	  	 public function pendingUpgradesEmail()
  {

        $email=$this->input->post('send_to');

        //$cc=$this->input->post('cc');

        $subject=$this->input->post('send_subject');
        $send_message=$this->input->post('send_message');
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnex');
		$this->email->to($email);
		//$this->email->cc($cc);
		$this->email->subject('MedConnex:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'<br>
			Thank You for .<br>
			MedConnex');

		 	$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('successmessage', 'Mail has sent successfully');
			redirect("Dashboard/pendingUpgrades");
		} else {
			$this->session->set_flashdata('successmessage', 'Sorry  Mail is not sent');
			redirect("Dashboard/pendingUpgrades");
		}
  }
	public function ratingUsers()
	{
		$id=$this->input->post('id');
		 $this->db->select('*,(select u.user_name from uf_user u where u.id=uf_user_rating.store_id) as storename,(select u.user_name from uf_user u where u.id=uf_user_rating.user_id) as username');
		 $this->db->from('uf_user_rating');
		 $this->db->where('store_id',$id);
		 $query=$this->db->get();
		 $data=$query->result_array();
         $html='';
         if(count($data) > 0){
         	foreach($data as $view)
			{
								
				$html.='<tr>
				<td>'.$view['username'].'</td>
				<td>'.$view['storename'].'</td>
				<td>'.$view['rating'].'stars</td>
				<td>'.$view['reviews'].'</td>
				<td>'.$view['created_at'].'</td>
				
				</tr>';
			}


         }else{
         	$msg="No records found..!!";
         	$html.='<tr><td colspan="100%" align="center">'.$msg.'</td></tr>';
         }
         echo $html;
		
	}
	public function updatepricing()
	{
		$id=$this->input->post('id');

		$result = $this->Dashboard_model->getDataWhere('cp_our_services',array('services_id' =>$id));
			
		echo '<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Pricing $	</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="pricing" autocomplete="off" value="' . $result['pricing'] . '"   placeholder="Enter Pricing" type="number" required> 
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Percentage %</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control"  name="percentage" autocomplete="off" value="' . $result['percentage'] . '" required placeholder="Enter Precentage" type="number" min="1" max="100"> 
						</div>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label>Member Ship</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control"  name="membership" autocomplete="off" value="' . $result['membership'] . '" required placeholder="Enter MemberShip" type="text">
						</div>
					</div>
				</div>

			
					
			</div><br>

			<div class="row modal-footer">
				<div class="creatUserBottom ">
					<div class="">
						<div class="vert-pad">
							<button type="submit" name="services_id" value="' . $result['services_id'] . '" class="btn-green">Update </button>
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

	public function pricingUpdated()
	{
		$services_id=$this->input->post('services_id');
		$pricing=$this->input->post('pricing');
		$percentage=$this->input->post('percentage');
		$membership=$this->input->post('membership');
		$data = array(
					'pricing' =>$pricing , 
					'percentage' =>$percentage , 
					'membership' =>$membership , 
				);
		$this->Dashboard_model->getUpdatedData('cp_our_services',$data, array('services_id' =>$services_id));
		if($services_id == '1'){
			$this->session->set_flashdata('success_msg', 'Standard Service updated successfully');
			redirect("standard-services");

		}elseif ($services_id == '2') {
			$this->session->set_flashdata('success_msg', 'Premium Service updated successfully');
			redirect("premium-services");
			
		}elseif ($services_id == '3') {
			$this->session->set_flashdata('success_msg', 'Affiliate Service updated successfully');
		    redirect("ondemand-services");
			
		}
	}
	public function generalSalesTrash($value='')
	{
		$id= $this->uri->segment(2);
		$this->db->delete('uf_general_sale', array('id' =>$id));
		$this->session->set_flashdata('success_msg', 'General Sales is deleted ');
		    redirect("general-sales");

	}
	public function generalTrashAll(){
		 $book =$this->input->post('book');
		
	
		
		     foreach($book as $where){
	          $this->db->delete('uf_general_sale', array('id' =>$where));
		     }
		
           if($book){
		        $this->session->set_flashdata('success_msg', 'Records are deleted successfully');
	   		    redirect('general-sales');
		     }else{
		       $this->session->set_flashdata('error_msg', 'Please checked atleast one or more');
	   		   redirect('general-sales');
		     }


	}
	public function generalSalesNote($value='')
	{
		
		$id=$this->input->post('id');
		$result = $this->Dashboard_model->getDataWhere('uf_general_sale',array('id' =>$id));
			
		echo '<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Note	</label>
						<div >
							
							<textarea class="form-control" name="note" required row="10" style="resize:none" cols="50">' . $result['notes'] .'</textarea>
						</div>
					</div>
				</div>
			</div><br/>

			<div class="row modal-footer">
				<div class="creatUserBottom ">
				
							<button type="submit" name="id" value="' . $result['id'] . '" class="btn-green">Update </button>
					
							<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
					
				</div>
			</div>
			<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <script>
      CKEDITOR.replace("note");

    </script>';

	}
	public function generalSalesUpdate($value='')
	{
		$notes=$this->input->post('note');
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$result=$this->db->update('uf_general_sale',array('notes' => $notes,'notesupdate' => date('Y-m-d H:i:s')));
		if($result){
		        $this->session->set_flashdata('success_msg', 'Notes is updated successfully');
	   		    redirect('general-sales');
		     }else{
		       $this->session->set_flashdata('error_msg', 'Notes is not updated successfully');
	   		   redirect('general-sales');
		     }

	}


	public function logout() {
		$user_id = $this->session->userdata('id');

		$this->Dashboard_model->update_logout($user_id);

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

		function documentVerificationStatusOnOff(){
		if ($this->session->userdata('adminlogin')) {
			$data = array();
			$data['all_data'] = $this->Dashboard_model->documentVerificationStatusOnOff();
			$data['title'] = 'Document Verificatioin';
			$data['file'] = 'admin/documentVerificationStatusOnOff';

			if (isset($_POST['active'])) {
				$ind = $_POST['activeUserId'];
				$result = $this->Dashboard_model->update_documentSeeStatus($ind);
				//$this->session->set_flashdata('success_msg', "General Sales updated successfully");
				redirect("dashboard/documentVerificationStatusOnOff");
			}
			// if (isset($_POST['enable'])) {

			// 	$user_id = $this->input->post('enable');
			// 	$dataarr = array('is_verify' => 1);
			// 	$this->db->where('id', $user_id);
			//     $this->db->update('uf_general_sale', $dataarr);
			// 	$this->session->set_flashdata('success_msg', "Enable Successfully");
			// 	redirect("panels/supermacdaddy/dashboard/general_sales");
			// }
			// if (isset($_POST['disable'])) {

			// 	$user_id = $this->input->post('disable');
			// 	$dataarr = array('is_verify' => 0);
		 //        $this->db->where('id', $user_id);
			//     $this->db->update('uf_general_sale', $dataarr);
			// 	$this->session->set_flashdata('success_msg', "Disable Successfully");
			// 	redirect("panels/supermacdaddy/dashboard/general_sales");
			// }
			//echo "<pre>"; print_r($data);
			$this->load->view('admin_templates', $data);
		} else {
			redirect('panels/supermacdaddy/dashboard/login');
		}

	}




public function convertmembership() {
		
			
		
			
				$id	=  $this->input->post('id');
				
				$where = array("id"=>$id);
			
				$data=array("user_type"=>'3');
				$this->db->where($where);
				$this->db->update('uf_user',$data);
				$this->session->set_flashdata('success_msg', 'update successfully');
				redirect("Dashboard/pendingUpgrades");
			
		
			
			$data['getDatas'] = $this->Dashboard_model->citySateAproved();
			$this->load->view('admin_templates', $data);
		
	}



	    public function exportpendingUpgrades() {
    
        $fileName = 'advertisement-'.time().'.xlsx';  
		// load excel library
        ///$this->load->library('excel');
        // $empInfo = $this->Sales_model->getsal_advertisement();
        // echo "<pre>"; print_r($empInfo);
        // die();
 
$object = new PHPExcel();

  $object->setActiveSheetIndex(0);

  $table_columns = array("User Id", "User Name", "State Id", "Email", "Social Id","Documents");

  $column = 0;

  foreach($table_columns as $field)
  {
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $employee_data = $this->Dashboard_model->pendingUpgrades();

  $excel_row = 2;

  foreach($employee_data as $row)
  {
   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['id']);
   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['display_name']);
   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['state']);
   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['email']);
   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['socialid']);



$get_query  = $this->db->query("SELECT * FROM `uf_user_documents` WHERE `user_id` = '".$row['id']."' AND pendingUpgrades='1' ");
$document_view = $get_query->result();
$document0 =  base_url().'uploads/'. $document_view[0]->document;

$document1 =  base_url().'uploads/'. $document_view[1]->document;
								    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $document0.' / '.$document1 );
							// 		foreach ($get_query->result() as $document_view) 
							// 		{
										
							// $document =  base_url().'uploads/'. $document_view->document;
							// 		    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $document);
							//  }  


  
   
   $excel_row++;
  }

  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Employee Data.xls"');
  $object_writer->save('php://output');
 }


}




