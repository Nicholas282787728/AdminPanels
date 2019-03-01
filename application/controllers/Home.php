<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Dashboard_model');
	}

    public function index()
	{
	 	if ($this->session->userdata('adminlogin')) {
			if ($this->session->userdata('adminlogin') == '1') {
				$this->session->set_flashdata('successmessage', 'On demand Login Successfully.');
				redirect('ondemand-admin');
			} elseif ($this->session->userdata('adminlogin') == '2') {
				$this->session->set_flashdata('successmessage', 'Doctor Login Successfully.');
			 	redirect('doctor-admin');
			} elseif ($this->session->userdata('adminlogin') == '3') {
				$this->session->set_flashdata('successmessage', 'Store Login Successfully.');
				redirect('/panels/supermacdaddy/Storefronts');
			} elseif ($this->session->userdata('adminlogin') == '4') {
				$this->session->set_flashdata('successmessage', 'Sales Login Successfully.');
				redirect('sales-admin');
			} elseif ($this->session->userdata('adminlogin') == '5'){
				$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
				redirect('super-admin');
			}elseif ($this->session->userdata('adminlogin') == '10'){
				$this->session->set_flashdata('successmessage', 'Affiliate Partner Login Successfully.');
				redirect('affiliate-partners');
			}

		}
		else
		{
			$data = array();
			$nm	 = "hiring";
			$row= $this->Dashboard_model->getdataconfigration($nm);
			$data['config_on_off']=!empty($row['value'])?$row['value']:'0';
			$data['captchdata'] = array(
			            'widget' => $this->recaptcha->getWidget(),
			            'script' => $this->recaptcha->getScriptTag(),
			        );
			$this->form_validation->set_rules('login_email', 'Username', 'trim|required|min_length[3]|max_length[32]');
			$this->form_validation->set_rules('login_password', 'Password', 'required');

				$where = array('section'=> 'web');
		 $data['getTermsAndCondtionWebs'] = $this->Dashboard_model->getTermsAndCondtion('uf_tos',$where);
		 $where = array('section'=> 'app');
		 $data['getTermsAndCondtionapps'] = $this->Dashboard_model->getTermsAndCondtion('uf_tos',$where);
			
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('home', $data);
			} else {
				$email		= $this->input->post('login_email');
				$password	= $this->input->post('login_password');
				$result		= $this->Dashboard_model->admin_login($email, $password);
				if (!empty($result)) {
					
					if($result['flag_enabled'] == "1" && $result['is_verify'] == "1")
					{
						$this->Dashboard_model->update_last_login($result['id']);
						$datas = array(
							'id'		=> $result['id'],
							'name'		=> $result['user_name'],
							'username'	=> $result['email'],
							'password'	=> $result['password'],
							'title'		=> $result['title'],
							'adminlogin' => $result['user_type'],
						);

						$this->session->set_userdata($datas);
						if ($datas['adminlogin'] == '1') {
							$this->session->set_flashdata('successmessage', 'On demand Login Successfully.');
							redirect('ondemand-admin');
						} elseif ($datas['adminlogin'] == '2') {
							$this->session->set_flashdata('successmessage', 'Doctor Login Successfully.');
							redirect('doctor-admin');
						} elseif ($datas['adminlogin'] == '3') {
							$this->session->set_flashdata('successmessage', 'Store Login Successfully.');
							redirect('storefronts-admin');
						} elseif ($datas['adminlogin'] == '4') {
							$this->session->set_flashdata('successmessage', 'Sales Login Successfully.');
							redirect('sales-admin');
						} elseif ($datas['adminlogin'] == '5'){
							$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
							redirect('super-admin');
						}elseif ($this->session->userdata('adminlogin') == '10'){
							$this->session->set_flashdata('successmessage', 'Affiliate Partner Login Successfully.');
							redirect('affiliate-partners');
								}
						else
						{
							$this->session->set_flashdata('errormessage', 'Invalid credentials..!!');
							redirect('/');
						}	
					
					}
					else
					{
						$this->session->set_flashdata('errormessage', 'Congratulations! Sign Up Successful. Please wait account approve!!');
						redirect('/');
					}
					
				} else {
					$this->session->set_flashdata('errormessage', 'Username and Password is Wrong!!');

					$this->load->view('home', $data);
				}
			}
		}	
	}
	
	
// public function affiliateSignup(){

		
// 			$data = array();
// 			$nm	 = "hiring";
// 			$row= $this->Dashboard_model->getdataconfigration($nm);
// 			$data['config_on_off']=!empty($row['value'])?$row['value']:'0';
// 			$data['captchdata'] = array(
// 			            'widget' => $this->recaptcha->getWidget(),
// 			            'script' => $this->recaptcha->getScriptTag(),
// 			        );
// 			$this->form_validation->set_rules('login_email', 'Username', 'trim|required|min_length[3]|max_length[32]');
// 			$this->form_validation->set_rules('login_password', 'Password', 'required');

// 				$where = array('section'=> 'web');
// 		 $data['getTermsAndCondtionWebs'] = $this->Dashboard_model->getTermsAndCondtion('uf_tos',$where);
// 		 $where = array('section'=> 'app');
// 		 $data['getTermsAndCondtionapps'] = $this->Dashboard_model->getTermsAndCondtion('uf_tos',$where);
			
// 			if ($this->form_validation->run() == FALSE) {
// 				$this->load->view('affiliateSignup', $data);
// 			} else {
// 				$email		= $this->input->post('login_email');
// 				$password	= $this->input->post('login_password');
// 				$result		= $this->Dashboard_model->admin_login($email, $password);
// 				if (!empty($result)) {
					
// 					if($result['flag_enabled'] == "1" && $result['is_verify'] == "1")
// 					{
// 						$this->Dashboard_model->update_last_login($result['id']);
// 						$datas = array(
// 							'id'		=> $result['id'],
// 							'name'		=> $result['user_name'],
// 							'username'	=> $result['email'],
// 							'password'	=> $result['password'],
// 							'title'		=> $result['title'],
// 							'adminlogin' => $result['user_type'],
// 						);

// 						$this->session->set_userdata($datas);
// 						if ($datas['adminlogin'] == '1') {
// 							$this->session->set_flashdata('successmessage', 'On demand Login Successfully.');
// 							redirect('ondemand-admin');
// 						} elseif ($datas['adminlogin'] == '2') {
// 							$this->session->set_flashdata('successmessage', 'Doctor Login Successfully.');
// 							redirect('doctor-admin');
// 						} elseif ($datas['adminlogin'] == '3') {
// 							$this->session->set_flashdata('successmessage', 'Store Login Successfully.');
// 							redirect('storefronts-admin');
// 						} elseif ($datas['adminlogin'] == '4') {
// 							$this->session->set_flashdata('successmessage', 'Sales Login Successfully.');
// 							redirect('sales-admin');
// 						} elseif ($datas['adminlogin'] == '5'){
// 							$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
// 							redirect('super-admin');
// 						}elseif ($this->session->userdata('adminlogin') == '10'){
// 							$this->session->set_flashdata('successmessage', 'Affiliate Partner Login Successfully.');
// 							redirect('affiliate-partners');
// 								}
// 						else
// 						{
// 							$this->session->set_flashdata('errormessage', 'Invalid credentials..!!');
// 							redirect('/');
// 						}	
					
// 					}
// 					else
// 					{
// 						$this->session->set_flashdata('errormessage', 'Congratulations! Sign Up Successful. Please wait account approve!!');
// 						redirect('/');
// 					}
					
// 				} else {
// 					$this->session->set_flashdata('errormessage', 'Username and Password is Wrong!!');

// 					$this->load->view('affiliateSignup', $data);
// 				}
// 			}
		
	

// }

// public function affiliateMap(){
// 		if ($this->session->userdata('adminlogin')) {
// 			if ($this->session->userdata('adminlogin') == '1') {
// 				$this->session->set_flashdata('successmessage', 'On demand Login Successfully.');
// 				redirect('ondemand-admin');
// 			} elseif ($this->session->userdata('adminlogin') == '2') {
// 				$this->session->set_flashdata('successmessage', 'Doctor Login Successfully.');
// 			 	redirect('doctor-admin');
// 			} elseif ($this->session->userdata('adminlogin') == '3') {
// 				$this->session->set_flashdata('successmessage', 'Store Login Successfully.');
// 				redirect('/panels/supermacdaddy/Storefronts');
// 			} elseif ($this->session->userdata('adminlogin') == '4') {
// 				$this->session->set_flashdata('successmessage', 'Sales Login Successfully.');
// 				redirect('sales-admin');
// 			} elseif ($this->session->userdata('adminlogin') == '5'){
// 				$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
// 				redirect('super-admin');
// 			}elseif ($this->session->userdata('adminlogin') == '10'){
// 				$this->session->set_flashdata('successmessage', 'Affiliate Partner Login Successfully.');
// 				redirect('affiliate-partners');
// 			}

// 		}
// 		else
// 		{
// 			$data = array();
// 			$nm	 = "hiring";
// 			$row= $this->Dashboard_model->getdataconfigration($nm);
// 			$data['config_on_off']=!empty($row['value'])?$row['value']:'0';
// 			$data['captchdata'] = array(
// 			            'widget' => $this->recaptcha->getWidget(),
// 			            'script' => $this->recaptcha->getScriptTag(),
// 			        );
// 			$this->form_validation->set_rules('login_email', 'Username', 'trim|required|min_length[3]|max_length[32]');
// 			$this->form_validation->set_rules('login_password', 'Password', 'required');

// 				$where = array('section'=> 'web');
// 		 $data['getTermsAndCondtionWebs'] = $this->Dashboard_model->getTermsAndCondtion('uf_tos',$where);
// 		 $where = array('section'=> 'app');
// 		 $data['getTermsAndCondtionapps'] = $this->Dashboard_model->getTermsAndCondtion('uf_tos',$where);
			
// 			if ($this->form_validation->run() == FALSE) {
// 				$this->load->view('affiliateMap', $data);
// 			} else {
// 				$email		= $this->input->post('login_email');
// 				$password	= $this->input->post('login_password');
// 				$result		= $this->Dashboard_model->admin_login($email, $password);
// 				if (!empty($result)) {
					
// 					if($result['flag_enabled'] == "1" && $result['is_verify'] == "1")
// 					{
// 						$this->Dashboard_model->update_last_login($result['id']);
// 						$datas = array(
// 							'id'		=> $result['id'],
// 							'name'		=> $result['user_name'],
// 							'username'	=> $result['email'],
// 							'password'	=> $result['password'],
// 							'title'		=> $result['title'],
// 							'adminlogin' => $result['user_type'],
// 						);

// 						$this->session->set_userdata($datas);
// 						if ($datas['adminlogin'] == '1') {
// 							$this->session->set_flashdata('successmessage', 'On demand Login Successfully.');
// 							redirect('ondemand-admin');
// 						} elseif ($datas['adminlogin'] == '2') {
// 							$this->session->set_flashdata('successmessage', 'Doctor Login Successfully.');
// 							redirect('doctor-admin');
// 						} elseif ($datas['adminlogin'] == '3') {
// 							$this->session->set_flashdata('successmessage', 'Store Login Successfully.');
// 							redirect('storefronts-admin');
// 						} elseif ($datas['adminlogin'] == '4') {
// 							$this->session->set_flashdata('successmessage', 'Sales Login Successfully.');
// 							redirect('sales-admin');
// 						} elseif ($datas['adminlogin'] == '5'){
// 							$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
// 							redirect('super-admin');
// 						}elseif ($this->session->userdata('adminlogin') == '10'){
// 							$this->session->set_flashdata('successmessage', 'Affiliate Partner Login Successfully.');
// 							redirect('affiliate-partners');
// 								}
// 						else
// 						{
// 							$this->session->set_flashdata('errormessage', 'Invalid credentials..!!');
// 							redirect('/');
// 						}	
					
// 					}
// 					else
// 					{
// 						$this->session->set_flashdata('errormessage', 'Congratulations! Sign Up Successful. Please wait account approve!!');
// 						redirect('/');
// 					}
					
// 				} else {
// 					$this->session->set_flashdata('errormessage', 'Username and Password is Wrong!!');

// 					$this->load->view('affiliateMap', $data);
// 				}
// 			}
// 		}
	

// }




// public function affiliatePQR(){
// 		if ($this->session->userdata('adminlogin')) {
// 			if ($this->session->userdata('adminlogin') == '1') {
// 				$this->session->set_flashdata('successmessage', 'On demand Login Successfully.');
// 				redirect('ondemand-admin');
// 			} elseif ($this->session->userdata('adminlogin') == '2') {
// 				$this->session->set_flashdata('successmessage', 'Doctor Login Successfully.');
// 			 	redirect('doctor-admin');
// 			} elseif ($this->session->userdata('adminlogin') == '3') {
// 				$this->session->set_flashdata('successmessage', 'Store Login Successfully.');
// 				redirect('/panels/supermacdaddy/Storefronts');
// 			} elseif ($this->session->userdata('adminlogin') == '4') {
// 				$this->session->set_flashdata('successmessage', 'Sales Login Successfully.');
// 				redirect('sales-admin');
// 			} elseif ($this->session->userdata('adminlogin') == '5'){
// 				$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
// 				redirect('super-admin');
// 			}elseif ($this->session->userdata('adminlogin') == '10'){
// 				$this->session->set_flashdata('successmessage', 'Affiliate Partner Login Successfully.');
// 				redirect('affiliate-partners');
// 			}

// 		}
// 		else
// 		{
// 			$data = array();
// 			$nm	 = "hiring";
// 			$row= $this->Dashboard_model->getdataconfigration($nm);
// 			$data['config_on_off']=!empty($row['value'])?$row['value']:'0';
// 			$data['captchdata'] = array(
// 			            'widget' => $this->recaptcha->getWidget(),
// 			            'script' => $this->recaptcha->getScriptTag(),
// 			        );
// 			$this->form_validation->set_rules('login_email', 'Username', 'trim|required|min_length[3]|max_length[32]');
// 			$this->form_validation->set_rules('login_password', 'Password', 'required');

// 				$where = array('section'=> 'web');
// 		 $data['getTermsAndCondtionWebs'] = $this->Dashboard_model->getTermsAndCondtion('uf_tos',$where);
// 		 $where = array('section'=> 'app');
// 		 $data['getTermsAndCondtionapps'] = $this->Dashboard_model->getTermsAndCondtion('uf_tos',$where);
			
// 			if ($this->form_validation->run() == FALSE) {
// 				$this->load->view('affiliatePQR', $data);
// 			} else {
// 				$email		= $this->input->post('login_email');
// 				$password	= $this->input->post('login_password');
// 				$result		= $this->Dashboard_model->admin_login($email, $password);
// 				if (!empty($result)) {
					
// 					if($result['flag_enabled'] == "1" && $result['is_verify'] == "1")
// 					{
// 						$this->Dashboard_model->update_last_login($result['id']);
// 						$datas = array(
// 							'id'		=> $result['id'],
// 							'name'		=> $result['user_name'],
// 							'username'	=> $result['email'],
// 							'password'	=> $result['password'],
// 							'title'		=> $result['title'],
// 							'adminlogin' => $result['user_type'],
// 						);

// 						$this->session->set_userdata($datas);
// 						if ($datas['adminlogin'] == '1') {
// 							$this->session->set_flashdata('successmessage', 'On demand Login Successfully.');
// 							redirect('ondemand-admin');
// 						} elseif ($datas['adminlogin'] == '2') {
// 							$this->session->set_flashdata('successmessage', 'Doctor Login Successfully.');
// 							redirect('doctor-admin');
// 						} elseif ($datas['adminlogin'] == '3') {
// 							$this->session->set_flashdata('successmessage', 'Store Login Successfully.');
// 							redirect('storefronts-admin');
// 						} elseif ($datas['adminlogin'] == '4') {
// 							$this->session->set_flashdata('successmessage', 'Sales Login Successfully.');
// 							redirect('sales-admin');
// 						} elseif ($datas['adminlogin'] == '5'){
// 							$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
// 							redirect('super-admin');
// 						}elseif ($this->session->userdata('adminlogin') == '10'){
// 							$this->session->set_flashdata('successmessage', 'Affiliate Partner Login Successfully.');
// 							redirect('affiliate-partners');
// 								}
// 						else
// 						{
// 							$this->session->set_flashdata('errormessage', 'Invalid credentials..!!');
// 							redirect('/');
// 						}	
					
// 					}
// 					else
// 					{
// 						$this->session->set_flashdata('errormessage', 'Congratulations! Sign Up Successful. Please wait account approve!!');
// 						redirect('/');
// 					}
					
// 				} else {
// 					$this->session->set_flashdata('errormessage', 'Username and Password is Wrong!!');

// 					$this->load->view('affiliatePQR', $data);
// 				}
// 			}
// 		}
	

// }
	public function upload_signup()
	{		
		$user_email = $_POST['drive_email'];
		$userquery =$this->db->query("SELECT * FROM uf_user WHERE email = '".$user_email."' ");  
		if($userquery->num_rows() == '0')
		{
			$socialid		= !empty($_POST['socialmedialink'])?$_POST['socialmedialink']:'';
			$user_type		= !empty($_POST['user_type'])?$_POST['user_type']:'';
			
			$usertype	= "admin";
			$is_driver	= "0";
			$arraydata	= array("document","document","document","document","document","document");
			if($user_type == "1")
			{
				$is_driver	= "1";
				$usertype	= "Driver";
				$arraydata	= array("valid_driver_license","vehicle_registration","vehicle_insurance","vehicle_inspection","doctors_recommendation");
			}
			else if($user_type == "2")
			{
				$usertype	= "Doctor";
				$arraydata	= array("valid_state_id","monthly_utility_bill");
			}
			else if($user_type == "3")
			{
				$usertype	= "Storefront";
				$arraydata	= array("valid_state_id","monthly_utility_bill");
			}
			else if($user_type == "4")
			{
				$usertype	= "Salesteam";    
				$arraydata	= array("resume_curriculum","references_page","monthly_utility_bill");
			}

			$datauser_ins = array(
				'email'=>$user_email,
				'socialid'	=> $socialid,
				'user_type'	=> $user_type,
				'title'		=> $usertype,
				'is_driver' => $is_driver,
				'device_type' => '2',
				'addDate' => date('Y-m-d')
				);
			
			$this->db->insert('uf_user',$datauser_ins);
			$user_id=$this->db->insert_id();
			
			$notify_ins=array("user_id"=>$user_id,"message"=>'Congratulations! Sign Up Successful. Please Check Pending Providers '.$usertype.' ',"created_at"=>date('Y-m-d H:i:s'),"type_read"=>4);
			
			$this->db->insert('notification_history',$notify_ins);
			
			if(is_array($_FILES))
			{
				$uniqid=1;
				foreach ($_FILES['upload']['name'] as $name => $value)
				{
					$file_name	= $_FILES['upload']['name'][$name];
					$parts		= explode('.',$file_name);
					$ext		= strtolower($parts[count($parts)-1]);
					$ImageName	= $arraydata[$name].'_'.$uniqid.date('msih')."_".$user_id. ".".$ext;
					
					move_uploaded_file($_FILES['upload']['tmp_name'][$name],'uploads/' . $ImageName);
					
					$data_ins	= array('user_id'=>$user_id, 'document'=>$ImageName, 'document_name' => $arraydata[$name]);
					$this->db->insert('uf_user_documents',$data_ins);
					$uniqid++;
				}
			}

				//	$to = 'sales@medconnex.net';
				$to = $user_email;
				$subject ='Thank You :'.$user_email;
				$message="<style>#maindiv {
				width:800px;
				margin:0  auto;
				padding:0px 10px 0px 10px;
				border:#0058A0 solid 6px;
				}
				#logo{
				margin-top:60px;
				margin-left:60px;
				}
				.mailtable
			 	{
				font-size:11px;
				color:#999999;
				line-height:30px;
				font-family:Verdana, Arial, Helvetica, sans-serif;
				margin-bottom:5px;
				}
				.mailcenter
				{
				font-size:12px;
				font-family:Verdana, Arial, Helvetica, sans-serif;
				line-height:19px;
				color:#005F82;
				padding:5px 10px 0px 10px;
				}
				h3{
				color:#005AA1;}
				</style>
				</head>
				<body>
				<div id='maindiv'>
				<table width='70%' border='0' cellpadding='0' cellspacing='0' class='mailtable' align='center' style='border:2px solid #005AA1;'>
				<tr>
				<td bgcolor='#005AA1'>
				<table width='100%' border='0' cellpadding='0' cellspacing='0'>
				<tr>
				<td id='logo' align='center'>&nbsp;</td>
				<td nowrap='nowrap'><h2 style='color:#FFFFFF;'>Med Connex</h2></td>
				</tr>
				</table></td>
				</tr>
				<tr>
				<td bgcolor='#FFFFF2'  class='mailcenter' valign='top' colspan='3'  style='padding:20px;'>
				<table width='100%' border='1px solid' cellpadding='0' cellspacing='0'>
					<tr>
						<td nowrap='nowrap' style='text-align:center;'><h4>Thank You For Signup..</h4></td>
					</tr>
					<tr>
						<td nowrap='nowrap' style='text-align:center;'>Your account has been verified by MedConnx team. Please wait form Approvel Message.</td>
					</tr>
					<tr>
						<td nowrap='nowrap' style='text-align:center;'>if any Problem please contact our staff at info@medconnex.net</td>
					</tr>
				<tr>
				<td align='center' bgcolor='#005AA1' height='25' style='color:#fff; padding:10px;' colspan='2'>Best Wishes, Customer Services.</td>
				</tr>
				</table>
				</div>
				</body>
				</html>";  
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: <sales@medconnex.net>' . "\r\n";
				mail($to,$subject,$message,$headers);
				$data['success'] = 'true';
		}
		else
		{
			$data['error'] = 'false';
		}
		echo json_encode($data);
	}
	
	public function careers()
	{
		$nm	 = "hiring";
		$row= $this->Dashboard_model->getdataconfigration($nm);
		$data['config_on_off']=!empty($row['value'])?$row['value']:'0';
		
		if(!empty($_POST))
		{
			
			$fname	= $this->input->post('fname');
			$lname	= $this->input->post('lname');
			$email	= $this->input->post('email');
			$mobile	= $this->input->post('mobile');
			$sociallinks	= $this->input->post('sociallinks');
			
			$getemail=$this->db->get_where('uf_user',array('email' => $email))->num_rows();
			if($getemail == 0)
			{
				$file_name=$_FILES['img']['name'];
				$parts = explode('.',$file_name);
				$ext = strtolower($parts[count($parts)-1]);
				$ImageName = 'sales_'.$fname.$lname.date('msih').".".$ext;
				move_uploaded_file($_FILES['img']['tmp_name'],'uploads/' . $ImageName);

				$data_ins=array(
					'display_name'=>$fname.' '.$lname,
					'email'=>$email,
					'mob_number'=>$mobile,
					'socialid'=>$sociallinks,
					'user_type'=>4,
					'title'=>'Sales',
					'flag_verified'=>0,
					'flag_enabled'=>0,
					);

				$this->db->insert('uf_user',$data_ins);
				$last_id =	$this->db->insert_id();
				if(!empty($last_id))
				{
						
					$notify_ins=array("user_id"=>$last_id,"message"=>'Congratulations! Careers Successful. Please Check Pending Providers '.$fname .$lname.' ',"created_at"=>date('Y-m-d H:i:s'));
					$this->db->insert('notification_history',$notify_ins);
					
					$data_img	= array('user_id'=>$last_id, 'document'=>$ImageName, 'document_name' => "careers");
					$this->db->insert('uf_user_documents',$data_img);
					$emergencyContact1=array(
						              'user_id' =>$last_id ,
						              'relation_name' =>$this->input->post('emergencyname1') ,
									  'relation_phone' =>$this->input->post('emergencyphone1') ,
									  'relation_email' =>$this->input->post('emergencyemail1') ,
									  'relationship' =>$this->input->post('emergencyrelation1') );

				    $emergencyContact2=array(
				    	              'user_id' =>$last_id ,
						              'relation_name' =>$this->input->post('emergencyname2') ,
									  'relation_phone' =>$this->input->post('emergencyphone2') ,
									  'relation_email' =>$this->input->post('emergencyemail2') ,
									  'relationship' =>$this->input->post('emergencyrelation2') );
					$this->db->insert('uf_emergency_contacts',$emergencyContact1);
					$this->db->insert('uf_emergency_contacts',$emergencyContact2);
				
					$this->session->set_flashdata('successmessage', 'you have been registerd successfully');
				     redirect('careers');
				}
				$this->session->set_flashdata('successmessage', 'successfully send');
				redirect('careers');
			}
			else
			{
				$this->session->set_flashdata('errormessage', 'already email !!');
			}
		}
		$this->load->view('hiring',$data);
	}
	public function term_condition()
	{
		$nm	 = "hiring";
		$row= $this->Dashboard_model->getdataconfigration($nm);
		$data['config_on_off']=!empty($row['value'])?$row['value']:'0';
		$type	 = "web";
		$data['term_condition'] = $this->Dashboard_model->get_condition($type);
		$this->load->view('term_condition',$data);
	}
	



	public function contctus()
	{
		if (!empty($_POST)) 
		{
			$email	= $this->input->post('email');
			$fname	= $this->input->post('fname');
			$subj	= $this->input->post('subj');
			$mssg	= $this->input->post('mssg');
			
			$to = 'info@medconnex.net';
			$subject = 'Enquiry';
			$message = "<style>#maindiv {
			width:800px;
			margin:0  auto;
			padding:0px 10px 0px 10px;
			border:#0058A0 solid 6px;
			}
			#logo{
			margin-top:60px;
			margin-left:60px;
			}
			.mailtable
			{
			font-size:11px;
			color:#999999;
			line-height:30px;
			font-family:Verdana, Arial, Helvetica, sans-serif;
			margin-bottom:5px;
			}
			.mailcenter
			{
			font-size:12px;
			font-family:Verdana, Arial, Helvetica, sans-serif;
			line-height:19px;
			color:#005F82;
			padding:5px 10px 0px 10px;
			}
			h3{
			color:#005AA1;}
			</style>
			</head>
			<body>
			<div id='maindiv'>
			<table width='70%' border='0' cellpadding='0' cellspacing='0' class='mailtable' align='center' style='border:2px solid #005AA1;'>
			<tr>
			<td bgcolor='#005AA1'>
			<table width='100%' border='0' cellpadding='0' cellspacing='0'>
			<tr>
			<td id='logo' align='center'>&nbsp;</td>
			<td nowrap='nowrap'><h2 style='color:#FFFFFF;'>Med Connex</h2></td>
			</tr>
			</table></td>
			</tr>
			<tr>
			<td bgcolor='#FFFFF2'  class='mailcenter' valign='top' colspan='3'  style='padding:20px;'>
			<table width='100%' border='1px solid' cellpadding='0' cellspacing='0'>
			<tr>
			<td width='210' height='30px'> Email</td>
			<td width='216'>" . $email . "</td>
			</tr>
			<tr>
			<td width='210' height='30px'> First Name</td>
			<td width='216'>" . $fname . "</td>
			</tr>
			<tr>
			<td width='210' height='30px'>Subject</td>
			<td width='216'>" . $subj . "</td>
			</tr>
			<tr>
			<td width='210' height='30px'> Message</td>
			<td width='216'>" . $mssg . "</td>
			</tr>

			<tr>
			<td align='center' bgcolor='#005AA1' height='25' style='color:#fff; padding:10px;' colspan='2'>Best Wishes,Customer Services .</td>
			</tr>
			</table>
			</div>
			</body>
			</html>";
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.$email.'' . "\r\n";
				mail($to, $subject, $message, $headers);
				$this->session->set_flashdata('successmessage', 'send successfully.');
				redirect('/home');
		}
		else
		{
				$this->session->set_flashdata('errormessage', 'somthing wrong..!.');
				redirect('/home');
		}
		
	}
	
	public function setpassword() {
		
		$auth_token = $this->input->get('auth_token');
		$get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `secret_token` = '" . $auth_token . "' ")->row_array();

		if(!empty($get_query['email']))
		{
			$data['emailtoken'] = $get_query['email'];
			$data['passwordtoken'] = $get_query['password'];
			$data['secret_token'] = $get_query['secret_token'];
			if (!empty($_POST)) {
				$name = $this->input->post('name');
				$username = $this->input->post('user_name');
				$password = $this->input->post('password');
				$conformpassword = $this->input->post('conformpassword');
				/** ******************************************************* */
				if ($password == $conformpassword) { //die('here');				
					$result = $this->Dashboard_model->admin_login_token($username, $auth_token); // print_r($result); die('yes');
					if (!empty($result)) {
						$pwd = md5($conformpassword);
						$dataa = array('secret_token' => '', 'password' => "$pwd",'user_name'=>$name,'user_name'=>$name, 'display_name' => $name);
						$this->db->where('id', $result['id']);
						$this->db->update('uf_user', $dataa);
						$this->session->set_flashdata('successmessage', 'Password Update Successfully.');
						redirect('/');
					} else {
						$this->session->set_flashdata('errormessage', 'Invalid credentials..!!');
						$this->load->view('admin/setpassword', $data);
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Password Not Match..!!');
					$this->load->view('admin/setpassword', $data);
				}
			}
			$this->load->view('admin/setpassword', $data);
		}
		else
		{
			if (empty($get_query['secret_token']) && $auth_token != $get_query['secret_token']) {
				$this->session->set_flashdata('errormessage', 'Invalid Attempt !');
			}
			redirect('/');
		}
	}
	
	public function admin_login()
	{
		
			$this->form_validation->set_rules('login_email', 'Username', 'trim|required|min_length[3]|max_length[32]');
			$this->form_validation->set_rules('login_password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('home', $data);
			} else {
				$email		= $this->input->post('login_email');
				$password	= $this->input->post('login_password');
				$result		= $this->Dashboard_model->admin_login($email, $password);
				if (!empty($result)) {
					
					
					
						$datas = array(
							'id'		=> $result['id'],
							'name'		=> $result['user_name'],
							'username'	=> $result['email'],
							'password'	=> $result['password'],
							'title'		=> $result['title'],
							'adminlogin' => $result['user_type'],
						);

						$this->session->set_userdata($datas);
						if ($datas['adminlogin'] == '1') {
							$this->session->set_flashdata('successmessage', 'On demand Login Successfully.');
							redirect('/panels/supermacdaddy/Ondemand');
						} elseif ($datas['adminlogin'] == '2') {
							$this->session->set_flashdata('successmessage', 'Doctor Login Successfully.');
							redirect('/panels/supermacdaddy/doctor');
						} elseif ($datas['adminlogin'] == '3') {
							$this->session->set_flashdata('successmessage', 'Store Login Successfully.');
							redirect('/panels/supermacdaddy/Storefronts');
						} elseif ($datas['adminlogin'] == '4') {
							$this->session->set_flashdata('successmessage', 'Sales Login Successfully.');
							redirect('sales-admin');
						} elseif ($datas['adminlogin'] == '5'){
							$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
							redirect('super-admin');
						}
						elseif ($datas['adminlogin'] == '10'){
				$this->session->set_flashdata('successmessage', 'Affiliate Partner Login Successfully.');
				redirect('affiliate-partners');
			}
						else
						{
							$this->session->set_flashdata('errormessage', 'Invalid credentials..!!');
							redirect('/');
						}	
					
					
				} else {
					$this->session->set_flashdata('errormessage', 'Username and Password is Wrong!!');
					redirect('super-admin');
				}
			}
		
	}
	
	public function verification() {
		
		$auth_token = $this->uri->segment(3);
		$get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `secret_token` = '" . $auth_token . "' ")->row_array();

		if(!empty($get_query['email']))
		{
			$data = array('secret_token' => '', 'flag_verified' => '1', 'is_verify' => '1');
			$this->db->where('id', $get_query['id']);
			$this->db->update('uf_user', $data);
			
			$this->session->set_flashdata('successmessage', 'Successfully verified.');
			redirect('/');
		}
		else
		{
			$this->session->set_flashdata('successmessage', 'Invalid Varifiacation link.');
			redirect('/');
		}
	}

	public function staff_login()
	{
		 $data = "";
			$nm	 = "hiring";
			$row= $this->Dashboard_model->getdataconfigration($nm);
			$data['config_on_off']=!empty($row['value'])?$row['value']:'0';
			$this->form_validation->set_rules('login_email', 'Username', 'trim|required|min_length[3]|max_length[32]');
			$this->form_validation->set_rules('login_password', 'Password', 'required');
			
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('home', $data);
			} else {
				$email		= $this->input->post('login_email');
				$password	= $this->input->post('login_password');
				$result		= $this->Dashboard_model->admin_login($email, $password);
				if (!empty($result)) {
					
					if($result['flag_enabled'] == "1" && $result['is_verify'] == "1" && $result['user_type'] =="5" ||  $result['user_type'] =="4" )
					{
						$this->Dashboard_model->update_last_login($result['id']);
						$datas = array(
							'id'		=> $result['id'],
							'name'		=> $result['user_name'],
							'username'	=> $result['email'],
							'password'	=> $result['password'],
							'title'		=> $result['title'],
							'adminlogin' => $result['user_type'],
						);

						$this->session->set_userdata($datas);
					    if ($datas['adminlogin'] == '5'){
							$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
							redirect('/panels/supermacdaddy/dashboard/admin');
						}else if ($datas['adminlogin'] == '4'){
							$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
							redirect('/panels/supermacdaddy/sales');
						}else
						{
							$this->session->set_flashdata('errormessage', 'Invalid credentials..!!');
							redirect('/');
						}	
					
					}
					else
					{
						$this->session->set_flashdata('errormessage', 'This is staff login only');
						redirect('/');
					}
					
				} else {
					$this->session->set_flashdata('errormessage', 'Username and Password is Wrong!!');
					redirect('/');
				}
			}

	}

	// public function affliate($value='')
	// {  $data = array();
	// 	$this->load->view('affiliate-partner',$data);
	// }

	public function affiliate()
	{
		$nm	 = "hiring";
		$row= $this->Dashboard_model->getdataconfigration($nm);
		$data['config_on_off']=!empty($row['value'])?$row['value']:'0';
		
		
		$this->load->view('affiliate',$data);
	}
	public function affiliateForm()
	{
		$nm	 = "hiring";
		$row= $this->Dashboard_model->getdataconfigration($nm);
		$data['config_on_off']=!empty($row['value'])?$row['value']:'0';
		
		
		$this->load->view('affiliate-form',$data);
	}
	public function marketUsa()
	{
		$nm	 = "hiring";
		$row= $this->Dashboard_model->getdataconfigration($nm);
		$data['config_on_off']=!empty($row['value'])?$row['value']:'0';
		
		
		$this->load->view('market',$data);
	}
	 public function recaptcha()
    {
      
        $recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) and $response['success'] === true) {
                echo "You got it!";
            }
        }

        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );
        print_r($data);
    }
	
	
	
}