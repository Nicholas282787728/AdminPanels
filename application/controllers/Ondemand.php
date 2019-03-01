<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ondemand extends CI_Controller {

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
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
		  $this->load->helper('cookie');
          $this->load->helper('html');
          $this->load->library('form_validation');
          $this->load->library('encrypt');
		  $this->load->library('email');
          //load the login model
          $this->load->helper('security');
          $this->load->model('Ondemand_model');
          $this->load->model('common_model');
          $this->load->model('Store_model');
          $this->load->model('Dashboard_model');
          require_once APPPATH . 'third_party/PHPExcel.php';
		  $this->excel = new PHPExcel();
          $user_type=$this->session->userdata('adminlogin');

	      	if($user_type =='0' || $user_type =='2' || $user_type =='4' || $user_type =='3'){
	      		 redirect('panels/supermacdaddy/dashboard/admin');
		       }
		  
     } 
     
	public function index()
	{	//$this->load->view('ondemand/index');  

		 $user_type=$this->session->userdata('adminlogin');
		if($user_type =='1' || $user_type =='5'){

			$id=$this->session->userdata('id');		
			$data['title']='Dashboard :: Home';
			$data['file']='ondemand/index';			
			$data['notification'] = $this->Ondemand_model->notification_history(5,$id); 
			$data['supportCount'] = $this->Ondemand_model->recordsCount($id,'ost_ticket__cdata'); 
//			$data['ratingArray'] = $this->Ondemand_model->ratingArray($id,'uf_user_rating'); 
//			$data['getSalesGraph'] = $this->Ondemand_model->getSalesGraph($id); 
			
			$data['getSalesGraph']=array();
			$data['ratingArray']=array();
			$data['allAdmins']=$this->Ondemand_model->getAdminIds(array('user_type' =>'5'));
			
			$this->load->view('ondemand_template',$data);
		}
		else 
		{
			 redirect('panels/supermacdaddy/dashboard/admin');
		}
		
//		
//		if($this->session->userdata('adminlogin')){
//			$data['title']='Dashboard :: Home';
//			$data['file']='ondemand/index';			
//			$data['notification'] = $this->Ondemand_model->notification_history(10); 
//			$this->load->view('ondemand_template',$data);
//					
//		}else{
//			redirect('/');
//		}
	} 
	/*------------- LOGIN ----------------*/
	
	public  function service_update()
	{
		if(isset($_REQUEST['services_type']))
		{
			$id = $this->session->userdata('id');
			$dataarr=array("service_type"=>$this->input->post('services_name'),"service_date"=>date('Y-m-d H:i:s'));
			$this->db->where('id',$id);
			$this->db->update(' uf_user',$dataarr);
			$this->session->set_flashdata('successmessage', 'Services update Successfully.');
		}
		 redirect('panels/supermacdaddy/ondemand');
	}
		public  function service_update_document()
	{
		$user_email=$this->input->post('email');
		$userquery =$this->db->query("SELECT * FROM uf_user WHERE email = '".$user_email."' ");  
		if($userquery->num_rows() == '0')
		{
		
	    $socialid	= !empty($_POST['socialmedialink'])?$_POST['socialmedialink']:'';
	    // print_r($_FILES['upload']['name']);
	    // exit();
	    $arraydata	= array("valid_state_id","monthly_utility_bill");
		if(is_array($_FILES))
			{
				$datauser_ins = array(
				'email'=>$user_email,
				'socialid'	=> $socialid,
				'user_type'	=> '3',
				'title'		=> 'Storefront',
				'is_driver' => '0',
				);
			
			$this->db->insert('uf_user',$datauser_ins);
			$user_id=$this->db->insert_id();
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
			if(!empty($user_id)){
				  $this->db->where('id',$user_id);
		           $this->db->update('uf_user', array('service_type' =>'Premium'));
			}
		 
			
			$notify_ins=array("user_id"=>$user_id,"message"=>'Congratulations! Sign Up Successful. Please Check Pending Providers Storefront ',"created_at"=>date('Y-m-d H:i:s'),"type_read"=>4);
			
			$this->db->insert('notification_history',$notify_ins);
			$this->session->set_flashdata('successmessage', 'Upgrade is  Successfully.');
			  redirect('panels/supermacdaddy/ondemand');
		}else{
			$this->session->set_flashdata('errormessage', 'Email is already existed  Successfully.');
			  redirect('panels/supermacdaddy/ondemand');
		}

	}
	


	// public function verification() {
	// 	$data['title'] = 'Verification';
	// 	$data['file'] = 'ondemand/verification';

	// 	if (isset($_POST['deactive'])) {
	// 		$uid = $_POST['deactive'];
	// 		$dataa = array("is_verify" => '0');
	// 		$this->db->where('id', $uid);
	// 		$this->db->update('uf_user', $dataa);
	// 		$this->db->last_query();
	// 		$this->session->set_flashdata('success_msg', 'Disable successfully');
	// 		redirect("panels/supermacdaddy/ondemand/verification");
	// 	}
	// 	if (isset($_POST['active'])) {
	// 		$uid = $_POST['active'];
	// 		$get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `id` = '" . $uid . "' ")->row_array();
	// 		$en_id = md5($get_query['email']);
	// 		$pro_img=base_url().'public/images/logo.png';
	// 		$dataa = array("is_verify" => '1', 'secret_token' => $en_id, 'password' => $en_id,"profile_pic"=>$pro_img);
	// 		$this->db->where('id', $uid);
	// 		$this->db->update('uf_user', $dataa);
	// 		if (!empty($get_query['email'])) {
	// 			$email = $get_query['email'];
	// 			$this->email->set_mailtype("html");
	// 			$this->email->from('info@medconnex.net', 'MedConnx');
	// 			$this->email->to($email);
	// 			$this->email->subject('MedConnex::Set Password');
	// 			$this->email->message('Hello ' . $get_query['email'] . ',
	// 					<br>Your account has been created on <b>MedConnx</b> team.<br><br>Please set password for your account
	// 					<a href="' . base_url() . 'home/setpassword?auth_token=' . $en_id . '">' . base_url() . 'home/setpassword?auth_token=' . $en_id . '</a>
	// 					<br> contact our staff at info@medconnex.net
	// 					<br>
	// 					Thank you,<br>
	// 					MedConnx');
	// 			$mailsend = $this->email->send();

	// 			$this->email->set_mailtype("html");
	// 			$this->email->from('info@medconnex.net', 'MedConnx');
	// 			$this->email->to($email);
	// 			$this->email->subject('MedConnex:Verification Approved');
	// 			$this->email->message('Thank you for the Verification, please proceed to the following location');
	// 			$mailsend1 = $this->email->send();
	// 		}

	// 		 $notify_ins=array("user_id"=>$uid,"message"=>'Thank you for the Verification, please proceed to the following location',"created_at"=>date('Y-m-d H:i:s'),"type_read"=>4);
	// 		   $this->db->insert('notification_history',$notify_ins);
	// 		$this->session->set_flashdata('success_msg', 'Active successfully');
	// 		redirect("panels/supermacdaddy/ondemand/verification");
	// 	}

	// 	if(isset($_POST['reject'])){
	// 		  $rejectid=$_POST['reject'];
		
	// 	   $get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `id` = '" . $rejectid . "' ")->row_array();
	// 	   $email = $get_query['email'];
	// 		$this->email->set_mailtype("html");
	// 			$this->email->from('info@medconnex.net', 'MedConnex');
	// 			$this->email->to($email);
	// 			$this->email->subject('MedConnex:Verification Denied');
	// 			$this->email->message('Your Verification has been denied at the moment, please submitted an updated version to proceed. Thank You');
	// 			$mailsend1 = $this->email->send();

           
	// 		$notify_ins=array("user_id"=>$rejectid,"message"=>'Your Verification has been denied at the moment, please submitted an updated version to proceed. Thank You!',"created_at"=>date('Y-m-d H:i:s'),"type_read"=>4);
	// 		   $this->db->insert('notification_history',$notify_ins);
	// 		   redirect("panels/supermacdaddy/ondemand/verification");

	// 	}
	// 	if(isset($_POST['document_verify'])){
	// 		$user_id=$_POST['document_verify'];
	// 		$where = array('document_status' =>'1');
	// 		$this->db->where('id',$user_id);
	// 		$this->db->update('uf_user_documents',$where);
	// 		$this->session->set_flashdata('success_msg', 'Document verify is done successfully');
	// 		redirect("panels/supermacdaddy/ondemand/verification");

	// 	}
	// 	if(isset($_POST['need_premission'])){
	// 		$user_id=$_POST['document_id'];
	// 		$where = array('admin_permission' =>'1');
	// 		$this->db->where('id',$user_id);
	// 		$this->db->update('uf_user_documents',$where);
	// 		$admin=$this->db->query('select * from uf_user where user_type ="5"');
	// 		$result=$admin->row();
	// 		$notify_ins=array("user_id"=>$result->id,"message"=>'admin premission is needed for document verificaion',"created_at"=>date('Y-m-d H:i:s'),"read_status"=>0);
	// 		$this->db->insert('notification_history',$notify_ins);
	// 		$this->session->set_flashdata('success_msg', 'Permission has sent successfully to admin');
	// 		redirect("panels/supermacdaddy/ondemand/verification");
	// 	}

	// 	$vuid=$this->session->userdata('id');
	// 	$data['alluser'] = $this->Ondemand_model->get_Pendding_interviews($vuid);

	// 	$this->load->view('ondemand_template', $data);
	// }

	
		public function verification() {
		$data['title'] = 'pending_interviews';
		$data['file'] = 'ondemand/verification';
		if (isset($_POST['deactive'])) {
			$uid = $_POST['deactive'];
			$dataa = array("is_verify" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			$this->db->last_query();
			$this->session->set_flashdata('successmessage', 'Disable successfully');
			redirect("storefronts-verification");
		}


		if (isset($_POST['activeUserId'])) {
			 $uid = $_POST['activeUserId'];

			// $get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `id` = '" . $uid . "' ")->row_array();
			// $en_id = md5($get_query['email']);
			// $pro_img = base_url() . 'public/images/logo.png';
			// $dataa = array("is_verify" => '1', 'secret_token' => $en_id, 'password' => $en_id, "profile_pic" => $pro_img);
			// $this->db->where('id', $uid);
			// $this->db->update('uf_user', $dataa);

			$data1 = array("status" => '1');
			$this->db->where('id', $uid);
			$this->db->update('uf_user_doc_store', $data1);

			if (!empty($get_query['email'])) {
				$email = $get_query['email'];

				$this->email->set_mailtype("html");
				$this->email->from('info@medconnex.net', 'MedConnx');
				$this->email->to($email);
				$this->email->subject('MedConnex::Set Password');
				$this->email->message('Hello ' . $get_query['email'] . ',
						<br>Your account has been created on <b>MedConnx</b> team.<br><br>Please set password for your account
						<a href="' . base_url() . 'home/setpassword?auth_token=' . $en_id . '">' . base_url() . 'home/setpassword?auth_token=' . $en_id . '</a>
						<br> contact our staff at info@medconnex.net
						<br>
						Thank you,<br>
						MedConnx');
				$mailsend = $this->email->send();

				$this->email->set_mailtype("html");
				$this->email->from('info@medconnex.net', 'MedConnx');
				$this->email->to($email);
				$this->email->subject('MedConnex:Verification Approved');
				$this->email->message('Thank you for the Verification, please proceed to the following location');
				$mailsend1 = $this->email->send();
			}

			$notify_ins = array("user_id" => $uid, "message" => 'Thank you for the Verification, please proceed to the following location', "created_at" => date('Y-m-d H:i:s'), "type_read" => 4);
			$this->db->insert('notification_history', $notify_ins);
			$this->session->set_flashdata('successmessage', 'Approved successfully');
			redirect("storefronts-verification");
		}

		if (isset($_POST['reject'])) {
			  $rejectid = $_POST['rejectUserId'];

			$data1 = array("status" => '2');
			$this->db->where('id', $rejectid);
			$this->db->update('uf_user_doc_store', $data1);
			

			$email = $_POST['email'];
			$this->email->set_mailtype("html");
			$this->email->from('info@medconnex.net', 'MedConnex');
			$this->email->to($email);
			$this->email->subject('MedConnex:Verification Denied');
			$this->email->message('Your Verification has been denied at the moment, please submitted an updated version to proceed. Thank You');
			$mailsend1 = $this->email->send();


			$notify_ins = array("user_id" => $rejectid, "message" => 'Your Verification has been denied at the moment, please submitted an updated version to proceed. Thank You!', "created_at" => date('Y-m-d H:i:s'), "type_read" => 4);
			$this->db->insert('notification_history', $notify_ins);
			$this->session->set_flashdata('successmessage', 'Denied  successfully');

			redirect("storefronts-verification");
		}
		if(isset($_POST['document_verify'])){
			 $user_id=$_POST['document_verify'];
			$where = array('document_status' =>'1');
			$this->db->where('id',$user_id);
			$this->db->update('uf_user_documents',$where);
			$this->session->set_flashdata('successmessage', 'Document verify is done successfully');
			redirect("storefronts-verification");

		}
		if(isset($_POST['need_premission'])){
			$user_id=$_POST['document_id'];
			$where = array('admin_permission' =>'1');
			$this->db->where('id',$user_id);
			$this->db->update('uf_user_documents',$where);
			$admin=$this->db->query('select * from uf_user where user_type ="5"');
			$result=$admin->row();
			$notify_ins=array("user_id"=>$result->id,"message"=>'admin premission is needed for document verificaion',"created_at"=>date('Y-m-d H:i:s'),"read_status"=>0);
			$this->db->insert('notification_history',$notify_ins);
			$this->session->set_flashdata('success_msg', 'Permission has sent successfully to admin');
			redirect("storefronts-verification");
		}
		

				if(isset($_POST['seeStatusId'])){
			 $id=$_POST['seeStatusId'];
			//$where = array('id' =>$id);
		$where = array('seeStatus' =>'1');
			$this->db->where('id',$id);
			$this->db->update('uf_user_doc_store',$where);
			//$this->session->set_flashdata('successmessage', 'Document verify is done successfully');
			

		}

		$uid = $this->session->userdata('id');
		// $where = array('store_id' => $uid);
		// $getVerificationDataStore  = $this->Store_model->getVerificationDataStore('uf_user_doc_store',$where);
		// $getVerificationDataStore1 = array('VerificationDataStore' => $getVerificationDataStore);

		// 	$where = array('id' => $uid);
		// $getUserDataForVerifacation = $this->Store_model->getUserDataForVerifacation('uf_user',$where);
		// // echo "<pre>"; print_r($getUserDataForVerifacation);
		// // die();

		// $getUserDataForVerifacation1 = array('user_name' => $getUserDataForVerifacation->user_name,
		// 	'mob_number' => $getUserDataForVerifacation->mob_number,
		// 	'user_type' => $getUserDataForVerifacation->user_type,
		// 	'created_at' => $getUserDataForVerifacation->created_at,
		// 'email' => $getUserDataForVerifacation->email);



$data['alluser'] = $this->Ondemand_model->getUserDataForVerifacation();
// echo "<pre>"; print_r($alluser);
// 		die();
		$this->load->view('ondemand_template', $data);
	}
	
	
	public function login(){ //die('got it');
		if($this->session->userdata('adminlogin')){
			redirect('panels/supermacdaddy/ondemand');
		}else{
			$data['title']  = 'Login';
			$data['file']	= 'ondemand/login';			
			
			$this->load->view('ondemand/login');
			
			$username = $this->input->post('ondemand_email');
			$password = $this->input->post('ondemand_password');
			//echo $username .''.$password ; 
			
		
			/**********************************************************/
			if($this->input->post('ondemand_btn') == 'Login'){ 			
				
				$result = $this->Ondemand_model->admin_login($username,$password); //print_r($result); die('yes');
				if(!empty($result)){
					$data = array(
							'id' 			=>	$result['id'],
							'display_name' 			=>	$result['display_name'],
							'user_name' 		=>	$result['user_name'],
							'password' 		=>	$result['password'],
							//'profile' 		=>	$result['profile'],
							'adminlogin' 	=> '1'
					);
					$this->session->set_userdata($data);
					$dataDetail = $this->session->userdata(); 
					$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
						redirect('panels/supermacdaddy/ondemand/');
				}else{
					$this->session->set_flashdata('errormessage','Invalid credentials..!!');
					redirect('/');
				}
			}
			
		}	 
	}
  public function getChatLIst()
  {
   $allAdmins=$this->Ondemand_model->getAdminIds(array('user_type' =>'5'));
     $adminCount=count($allAdmins); 
                  $data='';
                        if($adminCount > 0){ 
                          foreach ($allAdmins as $all) { 
                             $count=  $this->Dashboard_model->countUnreadMessages($all->id);
                            if($all->on_off_status =='1'){
                                $online="style='background-color: green !important'";
                            }else{
                                    $online="style='background-color: #d45226 !important'";
                            }
                              $color="style='color:#000;top:-0.7em'";
                             $data .='<div class="panel-heading adi-head-orange2" onclick="getChatPanel('.$all->id.');" '.$online.'><i class="fa fa-comments fa-fw"><sup '.$color.'>'.$count.'</sup></i> Admin Chat  '.$all->email.'
                                    </div>';
                                      }
                          }else{
                            $data='<div class="panel-heading adi-head-orange2"  >There is a no admins</div>';
                          }
                          echo $data;
                                 

  }
	// public function visibility(){
		
	
	// 	if($this->session->userdata('adminlogin')){
	// 		$data['title']='Visibility';
	// 		$data['file']='ondemand/visibility';			
			
	// 		$this->load->view('ondemand_template',$data);
					
	// 	}else{
	// 		redirect('/');
	// 	}
	// }
  
  
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
			$this->Ondemand_model->update_data('uf_user',$data_arr,$where_arr);
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
  public function visibility() {
    if ($this->session->userdata('adminlogin')) {
      $data['title'] = 'Visibility';
      $data['file'] = 'ondemand/visibility';
      $this->load->model('Doctor_model');
      $user_id  = $this->session->userdata('id');
      $data['getvisibility'] = $this->Ondemand_model->get_visibility_data($user_id);
        $data['optin'] = $this->Ondemand_model->savetosdata('optin');
	  $data['optout'] = $this->Ondemand_model->savetosdata('optout');
      $this->load->view('ondemand_template', $data);
    } else {
      redirect('/');
    }
  }
  
  public function visibility_action() {
    
    $created_id = $this->session->userdata('id');
    $date   = date('Y-m-d H:i:s');
    
    if (isset($_POST['save_change'])) {
      $image = "";
      if ($_FILES["image"]["name"] != "") {
        $image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
        $path = 'uploads';
        $this->upload_image($image, $path);
      }
      $data_arr = array(
        'location_name' => $this->input->post('location_name'),
        'opening_hour'  => $this->input->post('opening_hrs'),
        'closing_hour'  => $this->input->post('closing_hours'),
        'postal_code' => $this->input->post('postal_code'),
        'city'      => $this->input->post('city'),
        'country_code'  => $this->input->post('country_code'),
        'paypal_business_name' => $this->input->post('paypal_business'),
        'paypal_client_id' => $this->input->post('paypal_id'),
        'email'     => $this->input->post('email'),
        'time_zone'   => $this->input->post('time_zone'),
        'phone_number'  => $this->input->post('phone_no'),
        'patient_tax'  => $this->input->post('patient_tax'),
        'adult_use_tax'  => $this->input->post('adult_use_tax'),
        'logo'      => $image,
        'address'   => $this->input->post('address'),
        'latitude'    => $this->input->post('latitude'),
        'longitude'   => $this->input->post('longitude'),
        'longitude'   => $this->input->post('longitude'),
        'user_id'   => $created_id,
        'update_by'   => $created_id,
        'created_date'  => $date,
        'update_date' => $date,
      );
      $insert = $this->common_model->insert_record($data_arr, 'cp_locations');
      
      $this->Ondemand_model->recentActivity('visibility is  added Successfully.');
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
        'location_name'     => $this->input->post('location_name'),
        'opening_hour'      => $this->input->post('opening_hrs'),
        'closing_hour'      => $this->input->post('closing_hours'),
        'postal_code'     => $this->input->post('postal_code'),
        'city'          => $this->input->post('city'),
        'paypal_business_name'  => $this->input->post('paypal_business'),
        'country_code'      => $this->input->post('country_code'),
        'paypal_client_id'    => $this->input->post('paypal_id'),
        'email'         => $this->input->post('email'),
        'time_zone'       => $this->input->post('time_zone'),
        'phone_number'      => $this->input->post('phone_no'),
		'patient_tax'  => $this->input->post('patient_tax'),
        'adult_use_tax'  => $this->input->post('adult_use_tax'),
        'logo'          => $image,
        'address'       => $this->input->post('address'),
        'latitude'        => $this->input->post('latitude'),
        'longitude'       => $this->input->post('longitude'),
        'update_by'       => $created_id,
        'update_date'     => $date,
      );
      
      $this->db->where('loc_id',$this->input->post('loc_id'));
      $this->db->update('cp_locations',$data_uparr);
      
      $historydata_arr=array("user_id"=>$created_id,"message"=>"Visibility !  Update Company Details Successfully.","created_at"=>$date);
      $this->common_model->insert_record($historydata_arr, 'history');
    
      $this->session->set_flashdata('success_msg', 'Update Successfully..!');
    }
    redirect('panels/supermacdaddy/ondemand/visibility');
  }
	
	public function orders(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Orders';
			$data['file']='ondemand/orders';	
			$driver_id = $this->session->userdata('id');		
			$data['orders']= $this->Ondemand_model->orders($driver_id);
			$this->load->view('ondemand_template',$data);
					
		}else{
			redirect('/');
		}
	}
	public function products(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Products';
			$data['file']='ondemand/products';	
	 		$user_id = $this->session->userdata('id');		
			$data['products']= $this->Ondemand_model->products($user_id);
			// echo "<pre>";
			// print_r($data);
			$data['main_categories']= $this->Ondemand_model->main_categories();
			if(isset($_POST['deactive'])){ 
				$id = $_POST['deactive']; 
				$product = $this->Ondemand_model->active_product($id); 
				$this->Ondemand_model->recentActivity('Product Activated Successfully.');
				$this->session->set_flashdata('success_msg', 'Product Activated Successfully');
				redirect("panels/supermacdaddy/ondemand/products");
			}
			if(isset($_POST['active'])){ 
			$id = $_POST['active']; 
			$product = $this->Ondemand_model->deactive_product($id); 
			$this->Ondemand_model->recentActivity('Product Deactivated Successfully.');
			$this->session->set_flashdata('success_msg', 'Product Deactivated Successfully');
            redirect("panels/supermacdaddy/ondemand/products");
		}
		
		if(isset($_POST['delete_product'])){ 
			 $productid = $_POST['delete_product']; 
			 $checkProduct = $this->Ondemand_model->checkProduct($productid); 
			 if($checkProduct > 0){
		      $this->session->set_flashdata('success_msg', 'This product is existed in another table');
			 }else{
			 $product = $this->Ondemand_model->delete_product($productid); 
			 $this->Ondemand_model->recentActivity('Product Deleted Successfully.');
			 $this->session->set_flashdata('success_msg', 'Product Deleted Successfully');
			 redirect("panels/supermacdaddy/ondemand/products");
			 }
			
		}
		if(isset($_POST['save_product'])){ 

			$result = $this->Ondemand_model->add_product();
     	    if($result){
     		    $product_name=$this->input->post('product_name');
			     $messageValue='The Product '.$product_name.' is added  is added by ';
		 	 	$this->Ondemand_model->notification_add($messageValue);
     			$this->session->set_flashdata('success_msg', 'Product is added successfully.');
     			redirect('panels/supermacdaddy/ondemand/products');
     		}else{
                $this->session->set_flashdata('error_msg', 'Product image is not upload something went wrong.');
     			redirect('panels/supermacdaddy/ondemand/products');
     		}
		}

		if(isset($_POST['update'])){ 
			$result = $this->Ondemand_model->update_product();

     		if($result==true){
                $this->Ondemand_model->recentActivity('Product Updated Successfully.');
     			$this->session->set_flashdata('success_msg', 'Product is Updated successfully.');
     			redirect('panels/supermacdaddy/ondemand/products');
     		}
		}
		
			$this->load->view('ondemand_template',$data);
					
		}else{
			redirect('/');
		}
	}
	
	public function edit_product(){
    $result = $this->Ondemand_model->product_detail();
    $productId=$result[0]['product_category'];
    $main_categories = $this->Ondemand_model->main_categories();
      $main="<option>--Choose One--</option>";
      foreach($main_categories as $single) {
        if($single['id'] ==$result[0]['product_category'] ){
          $selected="selected";
        }else{
          $selected="";
        }
                $main.= ' <option value="'.$single['id'].'" '. $selected.'>'.$single['name'].'</option>';
                 }
		$getsubCategory = $this->Ondemand_model->getsubCategoryData($productId);
     $subCata ="<option>--Choose One--</option>";
      if(count($getsubCategory)){
      
       foreach ($getsubCategory as $g) {


        if($g->id ==$result[0]['product_sub_category'] ){
          $selected="selected";
        }else{
          $selected="";
        }
        $subCata .=" <option value='".$g->id."' ".$selected.">".$g->sub_category."</option>";
       }
      }
	  $checked=($result[0]['happy_hour'] == "1")?'checked':'';
		//echo "<pre/>"; print_r($result); die('m here');
		$image=$result[0]['image'];
		echo '
		 <div class="col-sm-6">
            <div class="form-group">
                <label>Product Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input  name="product_id"  value="'.$result[0]['pid'].'"  type="hidden">
                    <input class="form-control" name="product_name" value="'.$result[0]['product_name'].'" placeholder="Please enter the Product Name" type="text" required="required">
                </div>
            </div>  
        </div>
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Product Category </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                     <select id="input_locale" class="form-control mainCategoryChanges" value="'.$result[0]['product_category'].'" name="product_category" title="Locale" required="required"
                     '.$main.'
                     </select>
                </div>
            </div> 
        </div>
         
         <div class="col-sm-6">
            <div class="form-group">
                <label>Product Sub-Category</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <select id="input_locale" class="form-control subc" name="product_sub_category" title="Locale" required="required"  value="'.$result[0]['product_sub_category'].'">
                    "'.$subCata.'"
					</select>
                </div>
            </div>
        </div>               
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Preparation Time in Hours </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                     <select name="preparation_time" class="form-control " required="required">
						<option value="10" '.(($result[0]["preparation_time"]=='10')?'selected=""':"").'>10 mins</option>
						<option value="20" '.(($result[0]["preparation_time"]=='20')?'selected=""':"").'>20 mins</option>
						<option value="30" '.(($result[0]["preparation_time"]=='30')?'selected=""':"").'>30 mins</option>
						<option value="60" '.(($result[0]["preparation_time"]=='60')?'selected=""':"").'>60 mins</option>
					</select> 
					<span class="input-group-addon"><a href="javascript:void(0);" data-toggle="tooltip" title="Preparation Time in Minutes"><img src="'.base_url('uploads/info.png').'" style=" width: 20px;"></a></span> 
                </div>
            </div>
        </div>
                              
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Amount & Price</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="amt_d_price" autocomplete="off" value="'.$result[0]['amt_d_price'].'" placeholder="Amount & Price" type="text" >
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
			 <label>Happy Hour</label>
			 <div class="form-check">
				<label class="form-check-label">
					<input  name="happy_hour" id="" class="happu_hour" type="checkbox" value="'.$result[0]['happy_hour'].'" '.$checked.'>
					Happy Hour specials
				</label>
			  </div>
        </div>
         </div>     
      
      

			<div class="col-sm-12 display_hidden" style="padding: 0px;'.(($result[0]["happy_hour"]=='0')?'display:none;':"").'">
				
				<div class="col-sm-6">
					 <label>Day </label>
					<div class="form-group ">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<select name="happy_day" class="form-control display_disabled" style="width:100%" '.(($result[0]["happy_hour"]=='0')?'disabled=""':"").'>
							   <option value="Monday" '.(($result[0]["happy_day"]=='Monday')?'selected="selected"':"").'>Monday</option>
							   <option value="Tuesday" '.(($result[0]["happy_day"]=='Tuesday')?'selected="selected"':"").'>Tuesday</option>
							   <option value="Wednesday" '.(($result[0]["happy_day"]=='Wednesday')?'selected="selected"':"").'>Wednesday</option>
							   <option value="Thursday" '.(($result[0]["happy_day"]=='Thursday')?'selected="selected"':"").'>Thursday</option>
							   <option value="Friday" '.(($result[0]["happy_day"]=='Friday')?'selected="selected"':"").'>Friday</option>
							   <option value="Saturday" '.(($result[0]["happy_day"]=='Saturday')?'selected="selected"':"").'>Saturday</option>
							   <option value="Sunday" '.(($result[0]["happy_day"]=='Sunday')?'selected="selected"':"").'>Sunday</option>
						   </select>
					   </div>
				   </div>
			   </div>
				<div class="col-sm-6">
					<div class="col-sm-6" style="padding-left:0px;">
						<label>To</label>
						<input class="form-control display_disabled" name="happy_time_to"  value="'.$result[0]['happy_time_to'].'" type="time" required="" '.(($result[0]["happy_hour"]=='0')?'disabled=""':"").'>
					</div>
					<div class="col-sm-6" style="padding-right:0px;">
						<label>From</label>
						<input class="form-control display_disabled" name="happy_time_from"  value="'.$result[0]['happy_time_from'].'" type="time" required="" '.(($result[0]["happy_hour"]=='0')?'disabled=""':"").'>
					</div>
					
			   </div>
				
				
			</div>









 <div class="col-sm-12 " style="padding: 0px;">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1G</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k1" value="'.$result[0]['k1'].'" placeholder="Enter k1" type="text" required="required">
                </div>
            </div>
        </div>
     
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/8</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k3" value="'.$result[0]['k3'].'" placeholder="Enter k3" type="text" required="required">
                </div>
            </div>
        </div>
		
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/2</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k5" value="'.$result[0]['k5'].'" placeholder="Enter k5" type="text" required="required">
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Description</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="product_notes" value="'.$result[0]['product_notes'].'" placeholder="Enter description" type="text" required="required">
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Upload Image</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="image" type="file" id="edit_get_image">
                  
                </div>
            </div>  
               <div class="form-group">
           
               <input type="hidden" name="hiddenimage" value="'.$result[0]['image'].'">
               <img src="'.base_url('uploads/').$result[0]['image'].'" id="edit_image" width="100px" height="100px" class="edit_image">
               <span class="docurlImage"></span>
            </div> 
        </div>
		</div>
		';
		//echo  json_encode($result);
		
	}
	
	public function support_tickets(){
	
		if($this->session->userdata('adminlogin')){
			$data['title']	= 'Support Ticket';
			$data['file']	= 'ondemand/support_tickets';	
			$data['ticket_id']=$this->input->get('id');
			if (isset($_POST['createdticket'])) {
			    $id=$this->session->userdata('id');
				$ticket_sub		= $this->input->post('ticket_sub');
				$message_ticket	= $this->input->post('message_ticket');
				$date= date('Y-m-d H:i:s');
				if(!empty($message_ticket) && $message_ticket !="<br>")
				{
					 if($_FILES["image"]["name"] != ''){
					 		$image = trim(str_replace (" ","_",time().$_FILES["image"]["name"]));
				        	$path = './uploads/';
					        $result=$this->upload_image($image, $path);
					         if($result != '1'){
					         	$this->session->set_flashdata('error_msg', $result);
				             	redirect("panels/supermacdaddy/ondemand/support_tickets");
					         }
					 }else{
                         $image='';
					 }
				
					
					$data_arr=array(
						"user_id"=>$id,
						"subject"=>$ticket_sub,
						"message"=>$message_ticket,
						"attach"=>$image,
						"created_date"=>$date,
					);		
					$this->db->insert("ost_ticket__cdata",$data_arr);
					$messageValue='The Support Ticket is Raised by ';
		 	     	$this->Ondemand_model->notification_add($messageValue);
		 	     	$this->Ondemand_model->recentActivity('Support ticket is created successfully.');
					$this->session->set_flashdata('success_msg', 'created ticket successfully');
					redirect("panels/supermacdaddy/ondemand/support_tickets");
				}
				else
				{
					$this->session->set_flashdata('error_msg', 'Empty Details..!');
					redirect("panels/supermacdaddy/ondemand/support_tickets");
				}
			}
			else if (isset($_POST['updateticket'])) {
				$ticket_no		= $this->input->post('ticket_no');
				$ticket_sub		= $this->input->post('ticket_sub');
				$message_ticket	= $this->input->post('message_ticket');
				
				$old_image	= $this->input->post('old_image');
				if(!empty($message_ticket) && $message_ticket !="<br>")
				{
					$image = $old_image;
					if($_FILES["image"]["name"] != '')
					{
						$image = trim(str_replace (" ","_",time().$_FILES["image"]["name"]));
						$path = './uploads/';
						$this->upload_image($image, $path);
					}
					$data_arr=array(
						"subject"=>$ticket_sub,
						"message"=>$message_ticket,
						"attach"=>$image,
					);
					
					$this->db->where('ticket_id', $ticket_no);
					$resultarray= $this->db->update('ost_ticket__cdata', $data_arr);
					$this->Ondemand_model->recentActivity('Support ticket is Updated successfully.');
					$this->session->set_flashdata('success_msg', 'update ticket successfully');
					redirect("panels/supermacdaddy/ondemand/support_tickets");
				}
				else
				{
					$this->session->set_flashdata('error_msg', 'Empty Details..!');
					redirect("panels/supermacdaddy/ondemand/support_tickets");
				}
			}
			else if (isset($_POST['process'])) {
				$uid = $_POST['process'];
				$data = array("status" => '1');
				$this->db->where('ticket_id', $uid);
				$this->db->update('ost_ticket__cdata', $data);
				$this->db->last_query();
				$this->Ondemand_model->recentActivity('Support ticket  is Proccessed successfully.');
				$this->session->set_flashdata('success_msg', 'Proccess successfully');
				redirect("panels/supermacdaddy/ondemand/support_tickets");
			}
			elseif (isset($_POST['completed'])) {
				$uid = $_POST['completed'];
				$data = array("status" => '2');
				$this->db->where('ticket_id', $uid);
				$this->db->update('ost_ticket__cdata', $data);
				$this->Ondemand_model->recentActivity('Support ticket is Completed successfully.');
				$this->session->set_flashdata('success_msg', 'Completed successfully');
				redirect("panels/supermacdaddy/ondemand/support_tickets");
			}
			$data['last_ticket_no'] = $this->Ondemand_model->last_ticket_no();
			$data['list_ticket_data'] = $this->Ondemand_model->list_ticket_data();
			$this->load->view('ondemand_template',$data);
		}else{
			redirect('/');
		}
	}
	public function edit_ticket()
	{	
		$id = $this->input->post('ticket_id');
		$edit_data = $this->Dashboard_model->edit_tickit_data($id);
		echo	'<div class="col-sm-12">
					<div class="form-group">
						<label>Ticket No </label>
						<div class="input-group">
							<input class="form-control " type="text" name="ticket_no" readonly="" value="'.$id.'" required="" >
						</div>
					</div>

					<div class="form-group">
						<label>Subject </label>
						<div class="input-group">
							<input class="form-control" type="text" name="ticket_sub" style="width:100% !important;min-width:530px" value="'.$edit_data['subject'].'" required="">
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
							<input type="file" name="image" class="create_new_ticket" >
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
			$this->Ondemand_model->recentActivity('Support ticket is Deleted successfully.');
		$this->session->set_flashdata('success_msg', 'Deleted successfully');
		redirect("panels/supermacdaddy/ondemand/support_tickets");
	}
	public function ticket_replay($ticket_no)
	{
		if($this->session->userdata('adminlogin'))
		{
			$data['title']	= 'Ticket Comment';
			$data['file']	= 'ondemand/ticket_replay';	
			$data['ticket_no']	= $ticket_no;
		 	if (isset($_POST['replay_btn'])) 
			{
				$comment_ticket	= $this->input->post('comment_ticket');
				$date= date('Y-m-d H:i:s');
				$data_arr=array(
					"ticket_id"=>$ticket_no,
					"comment"=>$comment_ticket,
					"commentator_id"=>$this->session->userdata('id'),
					"created_date"=>$date,
				);		
				$this->db->insert("ticket_comment",$data_arr);
			    $this->Ondemand_model->recentActivity(' ticket replay is sent successfully.');
				$this->session->set_flashdata('success_msg', 'send successfully');
				redirect("panels/supermacdaddy/ondemand/ticket_replay/$ticket_no");
			}
			$data['list_ticket_comment'] = $this->Ondemand_model->list_ticket_comment($ticket_no);
			$data['ticket_file']=$this->Dashboard_model->ticket_file($ticket_no);
			$this->load->view('ondemand_template',$data);
			
		}else{
			redirect('/');
		}
	}
	
	
	public function notification(){
		if($this->session->userdata('adminlogin')){
			$id=$this->input->post('id');
			
			$notification = $this->Ondemand_model->notification_history(5,$id); 
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
                            <a class="text-center brdr-0" href="'.base_url('panels/supermacdaddy/ondemand/notifications').'">
                                <strong>View All</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
		}else{
			redirect('/');
		}
	}
	public function notificationcount(){
					$id=$this->session->userdata('id');
			$notification = $this->Ondemand_model->notification_history_user(0,$id); 
			echo count($notification);
	}
	public function tasknotification(){
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');
			$tasknotification = $this->Ondemand_model->tasknotification(5, $id); 
			foreach($tasknotification as $val){
            echo '<li>
                            <a href="javascript:void(0)">
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
                            <a class="text-center brdr-0" href="'.base_url('panels/supermacdaddy/ondemand/tasks').'">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
		}else{
			redirect('/');
		}
	}
	public function tasknotificationcount(){
		   $id=$this->session->userdata('id');
			$notification = $this->Ondemand_model->tasknotification_message(0,$id); 
			echo count($notification);
	}
	public function tasks(){
		    $data['title'] = 'Dashboard :: Tasks';
		$data['file'] = 'ondemand/tasks';
		$data['tasks'] = $this->Ondemand_model->task_list();
		$tasks = $this->Ondemand_model->task_list();
		
		if (isset($_POST['update_read_status'])) {
			$uid = $_POST['update_read_status'];
			$dataa = array("read_status" => '1');
			$this->db->where('id', $uid);
			$this->db->update('sal_task', $dataa);
           $this->Ondemand_model->recentActivity(' Task is Read successfully.');

			$this->session->set_flashdata('success_msg', 'Task is Read successfully');
			redirect("panels/supermacdaddy/ondemand/tasks");
		}
		$this->load->view('ondemand_template', $data);
	}
	public function msgnotification(){
		if($this->session->userdata('adminlogin')){
			 $id=$this->session->userdata('id');
			$notification = $this->Ondemand_model->msgnotification(5,$id); 
			$chat =' <li><a href="javascript:void(0);"  data-toggle="modal" data-target="#composemail" > <i class="fa fa-envelope" aria-hidden="true"></i> Compose</a>
                        </li>';
             echo $chat;
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
                            <a class="text-center brdr-0" href="'.base_url('panels/supermacdaddy/ondemand').'">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
		}else{
			redirect('/');
		}
	}
	public function msgnotificationcount(){
		    $id=$this->session->userdata('id');
			$notification = $this->Ondemand_model->msgnotification_message(0,$id); 
			echo count($notification);
	}
	public function chat_history(){
		$id = $this->session->userdata('id');
        $adminIds=$this->Ondemand_model->getAdminIds(array('user_type' =>'5'));
		$result = array();
	
	 foreach ($adminIds as $a ) {

	     	 $baseAdminId=$a->id;
	 		$history =$this->Ondemand_model->chat_history($baseAdminId);
	 		// echo "<pre>";
	 		//print_r($history);

		   if(count($history) > 0){
            
             	$data ='';
			foreach($history as $val){

				if($val['message_by']==$id){
				
				  
				  $data .= '<li class="left clearfix"><span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/Me" alt="User Avatar" class="img-circle" />
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
				
				}else{
						  $data .= '<li class="right clearfix"><span class="chat-img  pull-right"><img src="http://placehold.it/50/55C1E7/'.$val['sender_name'].'" alt="User Avatar" class="img-circle" />
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
            	$result[$baseAdminId]=$data;
		}
	}
	  echo json_encode($result);
	}
	public function sendmassage(){
		if($this->session->userdata('adminlogin')){
			$data =$this->Ondemand_model->sendmassage();
		 }else{
			redirect("/login");	
		 }
		
	}
	public function drivers()
	{
		$data['title']='Drivers';
		$data['file'] = 'ondemand/drivers';
		$data['drivers']= $this->Ondemand_model->drivers();
		$this->load->view('ondemand_template', $data);
	}
	public function logout(){            
   $user_id=$this->session->userdata('id');
    $this->Ondemand_model->update_logout($user_id);
		$data = array(
			'id' => "",
			'name' => "",
			'username' => "",
			'password' => "",
			'title' => "",
			'adminlogin' => "",
		);
	   $this->Ondemand_model->recentActivity(' User is logout successfully.');
		$this->session->set_userdata($data);
		$this->session->unset_userdata('login');
		$this->session->sess_destroy();
		redirect('/');
		
		
    }
	
	public function aut_users(){
		$result = $this->Ondemand_model->aut_users_detail();
		
		$title = !empty($result->user_type) ? $result->user_type : '';
		$selected1 = $selected2 = $selected3 = "";
		if (strtolower($title == "1")) {
			$selected1 = "selected";
		} elseif (strtolower($title == "2")) {
			$selected2 = "selected";
		} elseif (strtolower($title == "3")) {
			$selected3 = "selected";
		}
		
		
		echo '<div class="row">
			<div class="col-sm-6">
            <div class="form-group">
                <label>User Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input  name="user_id"  value="' .$result->id . '"  type="hidden">
                    <input  class="form-control" name="user_name" autocomplete="off" value="' . $result->user_name . '" placeholder="Please enter the First Name" type="text" >
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label>Display Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="display_name" autocomplete="off" value="' . $result->display_name . '" placeholder="Please enter the Last Name" type="text" required>
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
                    <input readonly class="form-control" name="email" autocomplete="off" value="' . $result->email . '" placeholder="Email address" type="text">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Contact </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="contact" value="' .$result->mob_number. '" autocomplete="off" placeholder="" type="text" required>
                </div>
            </div>
        </div></div>
		<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="updatesale" value="'.$result->id.'" class="btn-green">Update User</button>
								</div>          
							</div>
							<div class="">
								<div class="vert-pad">
									<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>
		';
	
	}
	public function updateDriverDocuments()
	{
		$id    =  $this->input->post('id');
		$result=  $this->Ondemand_model->updateDriverDocuments('uf_user_documents',$id);
		echo json_encode($result);

	}

	
	public function edit_signupdocuments()
	{	
		$id = $this->input->post('document_id');
		$edit_data = $this->Ondemand_model->edit_document_data($id);
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
	
	
	
	
	public function auth_user()
	{
		if($this->session->userdata('adminlogin')){
			$data['title']='Users';
			$data['file']='ondemand/auth_users';
			
			
			
			
			if(isset($_POST['enable'])){
				 $uid = $_POST['enable'];
				$data= array("flag_enabled"=>'1');
				$this->db->where('id', $uid);
      			$this->db->update('uf_user',$data); 
      			 $this->db->last_query();
      			 $this->Ondemand_model->recentActivity(' Auth User is Enabled successfully.');
				$this->session->set_flashdata('success_msg', 'Enabled successfully');
                redirect("panels/supermacdaddy/ondemand/auth_user");
			}
			if(isset($_POST['disable'])){
				$uid = $_POST['disable'];
				$data= array("flag_enabled"=>'0');
				$this->db->where('id', $uid);
      			$this->db->update('uf_user',$data); 
      			 $this->Ondemand_model->recentActivity(' Auth User is Disabled successfully.');
				$this->session->set_flashdata('success_msg', 'Disabled successfully');
                redirect("panels/supermacdaddy/ondemand/auth_user");
			}	
			if(isset($_POST['delete'])){
				$uid = $_POST['delete'];
				$this->db->where('id', $uid);
      			$this->db->delete('uf_user'); 
      			$this->Ondemand_model->recentActivity(' Auth User is Deleted successfully.');
				$this->session->set_flashdata('success_msg', 'Deleted successfully');
                redirect("panels/supermacdaddy/ondemand/auth_user");
			}			
			
			if (isset($_POST['save'])) 
			{
				if (!empty($this->input->post('contact')) && !empty($this->input->post('user_name')) && !empty($this->input->post('email'))) 
				{
					$result = $this->Ondemand_model->add_user();
					if ($result) {
						$email = $this->input->post('email');
						$en_id = $result; 
						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnx');
						$this->email->to($email);
						$this->email->subject('MedConnx::Set Password');
						$this->email->message('Hello ' . $email . ',
							<br>Your account has been created on <b>MedConnx</b> team.<br><br>Please set password for your account
							<a href="' . base_url() . 'setpassword?auth_token=' . $en_id . '">' . base_url() . 'setpassword?auth_token=' . $en_id . '</a>
							<br> contact our staff at info@medconnex.net
							<br>
							Thank you,<br>
							MedConnx');
						$mailsend = $this->email->send();

						if ($mailsend) {
							$this->session->set_flashdata('success_msg', 'Check Your <strong>' . $email . ' </strong> to recover you password');
							redirect('panels/supermacdaddy/ondemand/auth_user');
						} else {
							$this->session->set_flashdata('success_msg', 'Sorry ' . base_url() . 'opening?token=' . $en_id . ' mail not sent');
							redirect('panels/supermacdaddy/ondemand/auth_user');
						}
					} else {
						$this->session->set_flashdata('success_msg', $user_result);
						redirect('panels/supermacdaddy/ondemand/auth_user');
					}
				}
				else 
				{
					$this->session->set_flashdata('error_msg', 'User Name, Email, Telephone No. Required! ');
					redirect('panels/supermacdaddy/ondemand/auth_user');
				}
			}
		
		
		
		
		
			if(isset($_POST['updatesale'])){		
				if (!empty($this->input->post('contact')) && !empty($this->input->post('user_name')) && !empty($this->input->post('email'))) {
						$result = $this->Ondemand_model->update_user();
						if ($result) {
							$this->session->set_flashdata('success_msg', "User data updated successfully");
							redirect('panels/supermacdaddy/ondemand/auth_user');
						} else {
							$this->session->set_flashdata('success_msg', "User data not updated");
							redirect('panels/supermacdaddy/ondemand/auth_user');
						}
					} else {
						$this->session->set_flashdata('error_msg', 'User Name, Email, Telephone No. Required! ');
						redirect('panels/supermacdaddy/ondemand/auth_user');
					}
			}
			
			
			
			$data['all_staff'] = $this->Ondemand_model->auth_user();
			$all_staff = $this->Ondemand_model->auth_user();
			$data['userdetails'] = $this->db->get_where('uf_user', array('id' => $this->session->userdata('id')))->row();
			$this->load->view('ondemand_template',$data);
					
		}else{
			redirect('panels/supermacdaddy/ondemand');
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
	public function categories()
	{
		if($this->session->userdata('adminlogin')){

			  if(isset($_POST['updatecategory'])){
				$id = $_POST['id']; 
				 $result = $this->Ondemand_model->update_category($id); 
			   if($result){
			   	   $this->Ondemand_model->recentActivity(' Category updated successfully.');
     				$this->session->set_flashdata('success_msg', 'Category updated successfully.');
    			redirect('panels/supermacdaddy/ondemand/categories');
     			}

			} 
			 if(isset($_POST['save'])){
			 	$data = array(
			 		     'name' =>$this->input->post('category_name') , 
			 		     'status' =>$this->input->post('status') ,
			 		     'user_id' =>$this->session->userdata('id') 
			 	    );
			   $category_name=$this->input->post('category_name');
		       $result= $this->db->insert('uf_categories',$data);
		       $messageValue=$category_name.' This Category User  is added by ';
		 	   $this->Ondemand_model->notification_add($messageValue);
		 	   	$this->Ondemand_model->recentActivity(' Category is Added successfully.');
               $this->session->set_flashdata('success_msg', 'Category is added successfully.');
               redirect("panels/supermacdaddy/ondemand/categories");	
			} 
			if(isset($_POST['delete'])){
			   $uid = $_POST['delete'];
			   $result= $this->Ondemand_model->subcategoriesCheck($uid);
			    if($result) {
  	             $this->session->set_flashdata('success_msg', 'This Category is already existed in sub categires it is not deleted');
                redirect("panels/supermacdaddy/ondemand/categories");	
			    }
			     $productResult= $this->Ondemand_model->productCheck($uid);
			      if($productResult) {
  	             $this->session->set_flashdata('success_msg', 'This Category is already existed in product it is not deleted');
                redirect("panels/supermacdaddy/ondemand/categories");	
			    }
			    	
				$this->db->where('id', $uid);
      			$this->db->delete('uf_categories'); 
      			$this->Ondemand_model->recentActivity(' Category is Deleted successfully.');
				$this->session->set_flashdata('success_msg', 'Category is Deleted successfully');
                redirect("panels/supermacdaddy/ondemand/categories");	

			}
			if(isset($_POST['disable'])){
			     $uid = $_POST['disable'];
		      	$data= array("status"=>'0');
				$this->db->where('id', $uid);
      			$this->db->update('uf_categories',$data); 
      			$this->Ondemand_model->recentActivity(' Category is Disabled successfully.');
				$this->session->set_flashdata('success_msg', 'Category is  Disabled successfully');
                redirect("panels/supermacdaddy/ondemand/categories");	

			}
			if(isset($_POST['enable'])){
			   $uid = $_POST['enable'];
				$data= array("status"=>'1');
				$this->db->where('id', $uid);
      			$this->db->update('uf_categories',$data); 
      			$this->Ondemand_model->recentActivity(' Category is Enabled successfully.');
				$this->session->set_flashdata('success_msg', 'Category is Enabled successfully');
                redirect("panels/supermacdaddy/ondemand/categories");	

			}
			$data['title']='Category';
			$data['file']='ondemand/category';
			$data['all_staff'] = $this->Ondemand_model->get_all_product(); 
			$this->load->view('ondemand_template',$data);
			}else{
			redirect('panels/supermacdaddy/ondemand');
		}
	}
	public function edit_category()
	{
		if($this->session->userdata('adminlogin')){
		
			$id=$this->input->post('id');
			$result=$this->Ondemand_model->edit_category($id); 
		 	echo json_encode($result);
            
			}else{
			redirect('panels/supermacdaddy/ondemand');
		}
	}


	public function promo_codes()
	{
		if($this->session->userdata('adminlogin')){
			$data['title']='Users';
			$data['file']='ondemand/promo_code';
			
			if(isset($_POST['enable'])){
				 $uid = $_POST['enable'];
				$data= array("flag_enabled"=>'1');
				$this->db->where('id', $uid);
      			$this->db->update('authenticated_users',$data); 
      			$this->db->last_query();
      			$this->Ondemand_model->recentActivity(' Promo is Enabled successfully.');
				$this->session->set_flashdata('success_msg', 'Enabled successfully');
                redirect("panels/supermacdaddy/ondemand/promo_code");
			}
			if(isset($_POST['disable'])){
				$uid = $_POST['disable'];
				$data= array("flag_enabled"=>'0');
				$this->db->where('id', $uid);
      			$this->db->update('authenticated_users',$data); 
      		    $this->Ondemand_model->recentActivity(' Promo is Disabled successfully.');
				$this->session->set_flashdata('success_msg', 'Disabled successfully');
                redirect("panels/supermacdaddy/ondemand/promo_code");
			}	
			if(isset($_POST['delete'])){
				$uid = $_POST['delete'];
				$this->db->where('id', $uid);
      			$this->db->delete('authenticated_users'); 
      			$this->Ondemand_model->recentActivity(' Promo is Deleted successfully.');
				$this->session->set_flashdata('success_msg', 'Deleted successfully');
                redirect("panels/supermacdaddy/ondemand/promo_code");
			}			
			
			if(isset($_POST['save'])){


				$result = $this->Ondemand_model->add_user();
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
							  $this->Ondemand_model->recentActivity(' Promo is added successfully. Check Your <strong>'.$email.' </strong> to recover you password');
                        	$this->session->set_flashdata('success_msg', 'Check Your <strong>'.$email.' </strong> to recover you password');
                         	redirect("panels/supermacdaddy/ondemand/promo_code");
                         	//$error='1';
					    }else{
					    //echo "hii";
					    	  $this->Ondemand_model->recentActivity('Sorry '.base_url().'opening?token='.$en_id.' mail not sent');
							$this->session->set_flashdata('success_msg', 'Sorry '.base_url().'opening?token='.$en_id.' mail not sent');
                         	redirect("panels/supermacdaddy/ondemand/promo_code");
                         	//$error='<div style="padding: 5px;"  class="alert alert-danger" >Sorry '.base_url().'opening?token='.$en_id.' mail not sent</div>';
						}
		 	 	}else{
		 	 		$this->session->set_flashdata('success_msg', $user_result);
                	redirect("panels/supermacdaddy/ondemand/promo_code");
                	//$error='<div style="padding: 5px;"  class="alert alert-danger" >'.$user_result.'</div>';
		 	 	}
     			// if($result==true){
//      				$this->session->set_flashdata('successmessage', 'User added successfully.');
//      				redirect('panels/supermacdaddy/ondemand/auth_user');
//      			}
			}
			if(isset($_POST['updatesale'])){		
				$id = $_POST['updatesale']; 
				 $result = $this->Ondemand_model->update_aut_user($id); 
			 if($result==true){
                $this->Ondemand_model->recentActivity(' promo codes is updated successfully.');
     		    $this->session->set_flashdata('success_msg', 'promo codes is updated successfully.');
    			redirect('panels/supermacdaddy/ondemand/promo_code');
     			}
		 	}
			
			$data['all_staff'] = $this->Ondemand_model->auth_user(); 
			$this->load->view('ondemand_template',$data);
					
		}else{
			redirect('panels/supermacdaddy/ondemand');
		}
	}
  public function promo_list() {

		if($this->session->userdata('adminlogin')){
			$data['title'] = 'Promo codes';
			$data['file'] = 'ondemand/promo_list';
			$user_id = $this->session->userdata('id');		
			$data['products']= $this->Ondemand_model->products($user_id);
			$data['allproducts']= $this->Ondemand_model->All_products($user_id);

			//$_SESSION['id']		= 	$this->session->userdata('id');	
			//echo $_SESSION['id']	;die('got it');
			if (isset($_POST['save'])) {
				$code=$this->input->post('code');
				    $messageValue='This promo Code '.$code. ' is added by ';
				    $this->Ondemand_model->notification_add($messageValue);
				
				    $check_promo = $this->Ondemand_model->check_promo();
				     
				    if($check_promo > 0){
				    	 $this->Ondemand_model->recentActivity(' promo codes is already successfully.');
				    	$this->session->set_flashdata('error_msg', 'Promo code is already existed');
				         redirect("panels/supermacdaddy/ondemand/promo_list");
				    }else{
				    	
				        $task = $this->Ondemand_model->save_promo();
				        $this->Ondemand_model->recentActivity(' promo codes is added successfully.');
				       $this->session->set_flashdata('success_msg', 'Promo Save Successfully');
				       redirect("panels/supermacdaddy/ondemand/promo_list");
				    }

				
			}

			if (isset($_POST['enable'])) { //die('e here');
				$id = $_POST['enable'];
				$data = array("status" => '1');
				$this->db->where('id', $id);
				$this->db->update('uf_promo_codes', $data);
				$this->db->last_query();
				$this->Ondemand_model->recentActivity(' promo codes is Enable successfully.');
				$this->session->set_flashdata('success_msg', 'Promo code Enable successfully');
				redirect("panels/supermacdaddy/ondemand/promo_list");
			}
			if (isset($_POST['disable'])) { //die('d here');
				$id = $_POST['disable'];
				$data = array("status" => '0');
				$this->db->where('id', $id);
				$this->db->update('uf_promo_codes', $data);
			    $this->Ondemand_model->recentActivity(' promo codes is Disable successfully.');
				$this->session->set_flashdata('success_msg', 'Promo code Disable successfully');
				redirect("panels/supermacdaddy/ondemand/promo_list");
			}
			if (isset($_POST['update'])) {
				$updateid = $_POST['id'];
				//$created_by =  $records['created_by'];
				$promo = $this->Ondemand_model->update_promo($updateid);
				$this->Ondemand_model->recentActivity(' promo codes is Updated successfully.');
				$this->session->set_flashdata('success_msg', 'Promo code Updated Successfully');
				redirect("panels/supermacdaddy/ondemand/promo_list");
			}
			if (isset($_POST['delete'])) {
				$promoid = $_POST['delete'];
				$category = $this->Dashboard_model->delete_promo($promoid);
				$this->Ondemand_model->recentActivity(' promo codes is Deleted successfully.');
				$this->session->set_flashdata('success_msg', 'Promo Deleted Successfully');
				redirect("panels/supermacdaddy/ondemand/promo_list");
			}

			$data['allpromo'] = $this->Ondemand_model->allpromo($user_id);

			$this->load->view('ondemand_template', $data);
		} else {
			redirect('/');
		}
	}
	public function edit_promo()
	{
		$pid=$this->input->post('id');
		$result=$this->Ondemand_model->edit_promo($pid);
		echo json_encode($result);
	}

	public function setting($value='')
	{
		if($this->session->userdata('adminlogin')){
			$driverid=$this->session->userdata('id');
			//$whereData = array('id' =>$driverid,'user_type' => '1' );
			$whereData = array('id' =>$driverid );
			$data['title']="Site Settings";
			$data['file']='ondemand/setting';
			$data['profile'] =$this->Ondemand_model->getUserData($whereData);
			$this->load->view('ondemand_template',$data);
		}else{
			redirect('panels/supermacdaddy/sales/login');
		}
	}

	public function updatePassword(){
		if($this->session->userdata('adminlogin')){
			 extract($_POST);
			 $driverid=$this->session->userdata('id');
			  if(!empty($password)){
			 	 $data = array('user_name' =>$user_name,'password'=>md5($password));
			 	}else{
                $data = array('user_name' =>$user_name);
			 	}
		 	 	
			
			 $whereData = array('id' =>$driverid);
			 $table ='uf_user';
             $result=$this->Ondemand_model->getUpdate($table, $data, $whereData);
            if($result){
             $this->Ondemand_model->recentActivity('settings are updated Successfully.');
             $this->session->set_flashdata('success', 'settings are updated Successfully.');
			 redirect('panels/supermacdaddy/ondemand/setting');

            }else{
            	$this->Ondemand_model->recentActivity('settings are not updated Successfully.');
            	$this->session->set_flashdata('error', 'settings are not updated Successfully.');
             redirect('panels/supermacdaddy/ondemand/setting');
            }

		}else{
			redirect('panels/supermacdaddy/sales/login');
		}
	}

	public function signupdocuments(){
	
		if($this->session->userdata('adminlogin')){
			$data['title']='sign up documents';
			$user_id=$this->session->userdata('id');
			$data['file']='ondemand/signupdocuments';			
			$data['uploadDocuments'] =$this->Ondemand_model->document_ondemand_signup();	
			$created_id = $this->session->userdata('id');
			$date = date('Y-m-d H:i:s');
			if(isset($_POST['updatedocument']))
			{
				$document_id	= $this->input->post('document_id');
				$document_name	= $this->input->post('document_name');
				$old_image		= $this->input->post('old_image');
	 			$image			= $old_image;
				
				if(!empty($_FILES["image"]["name"]))
				{
					$filename	= $_FILES["image"]["name"];
					$tmp        =explode(".", $filename);
					$extension	= end($tmp);
					$image		= $document_name .".".$extension;
					$path		= 'uploads';
					$this->upload_image_overwrite($image, $path);
				}
				
				$data_arr = array(
					"document" => $image,
				);

				$this->db->where('id', $document_id);
				$resultarray= $this->db->update('uf_user_documents', $data_arr);
				//echo $this->db->last_query();
				$historydata_arr=array("user_id"=>$created_id,"message"=>"Sign Up Documents !  Update Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
		
				$this->session->set_flashdata('success_msg', 'update document successfully');
				 // redirect('panels/supermacdaddy/ondemand/signupdocuments');
				redirect("panels/supermacdaddy/ondemand/signupdocuments");
			}
			if(isset($_POST['delete_product'])){
				$this->db->where('id', $_POST['delete_product']);
				$this->db->delete('uf_user_documents');
			    $this->session->set_flashdata('success_msg', ' document is deleted successfully');
				redirect("panels/supermacdaddy/ondemand/signupdocuments");

			}
			
			$this->load->view('ondemand_template',$data);
			 		
		}else{
			redirect('/');
		}
	}
	public function payouts(){
	
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');
			$data['title']='sign up documents';
			$data['file']='ondemand/payout';			
			//$data['documents'] =$this->common_model->get_data('cp_doctor_documents','desc','id');	
			$result =$this->Ondemand_model->getSingleRecord('payout_details',$id);
			$data['orders']= $this->Ondemand_model->orders($id);
			$data['payments']= $this->Ondemand_model->payments($id);
	     	$data['payout']=$result;
	     	if (isset($_POST['save'])) {
	     		$this->Ondemand_model->save_payout();
	     		$this->Ondemand_model->recentActivity('Payout details  are added Successfully.');

	           $this->session->set_flashdata('success_msg', 'Payout details  are added Successfully.');
			   redirect('panels/supermacdaddy/ondemand/payouts');
	     	}
	     	if (isset($_POST['update'])) {
	     		$this->Ondemand_model->update_payout();
	     		$this->Ondemand_model->recentActivity('Payout details  are updated Successfully.');
	           $this->session->set_flashdata('success_msg', 'Payout details  are updated Successfully.');
			   redirect('panels/supermacdaddy/ondemand/payouts');
	     	}
			
			$this->load->view('ondemand_template',$data);
					
		}else{
			redirect('/');
		}
	}
	public function complimentaryAd(){
	
		if($this->session->userdata('adminlogin')){
			$data['title']='sign up documents';
			$data['file']='ondemand/complemn-ad';			
			$data['comp'] =$this->common_model->get_data_tbl('cp_complimentary_ad','user_id',$this->session->userdata('id'));	
			$this->load->view('ondemand_template',$data);
					
		}else{
			redirect('/');
		}
	}
	
	
	public function updateComp($value='')
	{ 
		if(isset($_POST)){ 
					$image = trim(str_replace (" ","_",time().$_FILES["image"]["name"]));
			 		if($_FILES["image"]["name"] ==''){
						$image =$this->input->post('image_old');
					}
					$path = 'uploads';
					if($_FILES["image"]["name"] != ''){
				        if(file_exists(FCPATH.'uploads/'.$this->input->post('image_old'))){
				          unlink(FCPATH.'uploads/'.$this->input->post('image_old'));
				        }
				        if(file_exists(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image_task'))){
				          unlink(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image_task'));
				        }
						
						$ad_size = explode("x",$this->input->post('ad_size'));
						$width	= $ad_size[0];
						$height = $ad_size[1];
						
						$this->upload_image($image, $path);
						$this->uploadimageResize50X50($width,$height);
					}

		 	 		$result = $this->Ondemand_model->update_comp($image); 
		 	 	if($result){
		 	 	    $this->Ondemand_model->recentActivity('complimentary Sales updated successfully.');
		 	 		$this->session->set_flashdata('success_msg', "complimentary Sales updated successfully");
                	redirect("panels/supermacdaddy/ondemand/complimentaryAd");
		 	 	}else{
		 	 		$this->Ondemand_model->recentActivity('complimentary Sales is not updated successfully.');
		 	 		$this->session->set_flashdata('success_msg', "complimentary Sales data not updated");
                	redirect("panels/supermacdaddy/ondemand/complimentaryAd");
		 	 	}
		 	}else{
		 		$error='<div   style="padding: 5px;" class="alert alert-danger" > Ad Type </div>';
		 	} 
	}
	public function add_insertComp($value='')
	{ 
		if(isset($_POST)){ 
					$image = trim(str_replace (" ","_",time().$_FILES["image"]["name"]));
			 		$path = 'uploads';
					if($_FILES["image"]["name"] != ''){
				        if(file_exists(FCPATH.'uploads/'.$this->input->post('image_old'))){
				          unlink(FCPATH.'uploads/'.$this->input->post('image_old'));
				        }
				       	if(file_exists(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image_task')))
						{
							unlink(FCPATH.'uploads/tmp_file/'.$this->input->post('remove_image_task'));
						}
						$ad_size = explode("x",$this->input->post('ad_size'));
						$width	= $ad_size[0];
						$height = $ad_size[1];
						$this->upload_image($image, $path);
						$this->uploadimageResize50X50($width,$height);
					}

		 	 		$result = $this->Ondemand_model->add_new_comp($image); 
		 	 	if($result){
		 	 	    $this->Ondemand_model->recentActivity('complimentary Sales add successfully.');
		 	 		$this->session->set_flashdata('success_msg', "complimentary Sales add successfully");
                	redirect("panels/supermacdaddy/ondemand/complimentaryAd");
		 	 	}else{
		 	 		$this->Ondemand_model->recentActivity('complimentary Sales is not add successfully.');
		 	 		$this->session->set_flashdata('success_msg', "complimentary Sales data not updated");
                	redirect("panels/supermacdaddy/ondemand/complimentaryAd");
		 	 	}
		 	}else{
		 		$error='<div   style="padding: 5px;" class="alert alert-danger" > Ad Type </div>';
		 	} 
	}
	
	
	
	
		public function readMessages(){
		$name=$this->input->post('name');

		if($name =='notification'){
			$id     = $this->session->userdata('id');
		    $result = $this->Ondemand_model->readMessages($id,$name);
		    echo '0';
		}else if($name =='task'){
		
			$id     = $this->session->userdata('id');
		    $result = $this->Ondemand_model->readMessages($id,$name);
            echo '0';
		}else if($name =='message'){
		
			$id     = $this->session->userdata('id');
		    $result = $this->Ondemand_model->readMessages($id,$name);
            echo '0';
		}
       

	}
	public function affiliate()
	{
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');		
			$data['title']='sign up documents';
			$data['file']='ondemand/affiliate';	
			$data['supportCount'] = $this->Ondemand_model->recordsCount($id,'ost_ticket__cdata'); 		
			//$data['comp'] =$this->common_model->get_data_tbl('cp_complimentary_ad','id','01');	
			$this->load->view('ondemand_template',$data);
					
		}else{
			redirect('/');
		}
	}
	public function notifications()
	{
		$data['title'] = 'Dashboard :: Notifications';
		$data['file'] = 'ondemand/notifications';
		$data['notification'] = $this->Ondemand_model->notification_historyAll();
		if (isset($_POST['update_read_status'])) {
			$uid = $_POST['update_read_status'];
			$dataa = array("read_status" => '1');
			$this->db->where('id', $uid);
			$this->db->update('notification_history', $dataa);
			$this->Ondemand_model->recentActivity('Notification is Read successfully.');
			$this->session->set_flashdata('success_msg', 'Notification is Read successfully');
			redirect("panels/supermacdaddy/ondemand/notifications");
		}
		$this->load->view('ondemand_template', $data);
	}
	public function setpassword(){
    	$auth_token=$this->input->get('auth_token');
    	$result= $this->Ondemand_model->auth_token_check($auth_token);
    	if($result){
		$data['id'] = $result->id;
		$data['emailtoken'] = $result->email;
		$data['passwordtoken'] =  $result->password; 
		$data['secret_token'] = $result->secret_token; 
        $this->load->view('ondemand/login', $data);
    	 }else{
    		$this->session->set_flashdata('errormessage', 'Invalid User!!');
			redirect('/');
    	}
    	
    }
    public function truncateData(){
    	$data=$this->input->get('tblname');
    	$this->db->query("TRUNCATE TABLE ".$data);
    	$query=$this->db->get();
    	echo $query;
    }
    public function restPassword()
    {
    	$email=trim($this->input->post('email'));
    	$auth_check=trim($this->input->post('auth_check'));
        $password=trim($this->input->post('password'));
    	$dataa = array('secret_token' => '', 'password' =>md5($password));
		$this->db->where('email', $email);
		$result=$this->db->update('uf_user', $dataa);
		if($result){
			  $this->Ondemand_model->recentActivity('Password is Updated Successfully.');
		       $this->session->set_flashdata('successmessage', 'Password Update Successfully.');
		       redirect('/');
		}else{
			  $this->Ondemand_model->recentActivity('Password is not Update Successfully.');
			  $this->session->set_flashdata('errormessage', 'Password is not Update Successfully.');
			  $url=base_url('panels/supermacdaddy/ondemand/setpassword?auth_token='.$auth_check);
		      redirect($url);
		}
	
    }
    public function graph($value='')
    {
    	$this->load->view('ondemand/graph');
    }

 //    	public function visibility_action()
	// {
	// 	$created_id=$this->session->userdata('id');
	// 	$date=date('Y-m-d H:i:s');
	// 	if(isset($_POST['save_change']))
	// 	{
	// 		$image="";
	// 		if($_FILES["image"]["name"] != "")
	// 		{
	// 			$image = trim(str_replace (" ","_",time().$_FILES["image"]["name"]));
	// 			$path = 'uploads';
	// 			$this->upload_image($image, $path);
	// 		}
		
	// 		$data_arr = array(
	// 			'location_name'			=> $this->input->post('location_name'),
	// 			'opening_hour'			=> $this->input->post('opening_hrs'),
	// 			'closing_hour'			=> $this->input->post('closing_hours'),
	// 			'postal_code'			=> $this->input->post('postal_code'),
	// 			'city'					=> $this->input->post('city'),
	// 			'paypal_business_name'	=> $this->input->post('paypal_business'),
	// 			'country_code'			=> $this->input->post('country_code'),
	// 			'paypal_client_id'		=> $this->input->post('paypal_id'),
	// 			'email'					=> $this->input->post('email'),
	// 			'time_zone'				=> $this->input->post('time_zone'),
	// 			'phone_number'			=> $this->input->post('phone_no'),
	// 			'logo'					=> $image,
	// 			'address'				=> $this->input->post('address'),
	// 			'latitude'				=> $this->input->post('latitude'),
	// 			'longitude'				=> $this->input->post('longitude'),
	// 			'longitude'				=> $this->input->post('longitude'),
	// 			'user_id'				=> $created_id,
	// 			'update_by'				=> $created_id,
	// 			'created_date'			=> $date,
	// 			'update_date'			=> $date,
	// 		);
			
	// 		$insert = $this->common_model->insert_record($data_arr, 'cp_locations');
 //              $this->Ondemand_model->recentActivity('visibility is  added Successfully.');
	// 		$this->session->set_flashdata('success_msg', 'Save Successfully..!');
	// 	}
	// 	redirect('panels/supermacdaddy/ondemand/visibility');
	// }
	
	public function locations(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Locations';
			$data['file']='ondemand/locations';			
			$this->load->view('ondemand_template',$data);
					
		}else{
			redirect('/');
		}
	}
	public function history(){
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');
			$data['title']='History';
			$data['file']='ondemand/history';
			$where=array('status' =>1, 'user_id'=>$id);
			if(isset($_POST['delete_history'])){
				 $uid= $_POST['delete_history'];
				 $dwhere= array('id' =>$uid);
			     $this->Ondemand_model->deletRecord('history',$dwhere );
			     $this->session->set_flashdata('success_msg', 'history is deleted Successfully..!');
			}
			$data['historyData']=$this->Ondemand_model->historyData('history',$where );
			$this->load->view('ondemand_template',$data);
		}else{
			redirect('/');
		}
	}
	public function subcategories() {
		$data['title'] = 'Categories';
		$data['file'] = 'ondemand/sub_categories';
	
		if (isset($_POST['save'])) {
			$task = $this->Dashboard_model->saveSubcat();
			 $this->Ondemand_model->recentActivity('Sub Category is Saved Successfully.');
			$this->session->set_flashdata('success_msg', 'Sub Categories Save Successfully');
			redirect("panels/supermacdaddy/ondemand/subcategories");
		}
		if (isset($_POST['enable'])) { //die('e here');
			$id = $_POST['enable'];
			$data = array("status" => '1');
			$this->db->where('id', $id);
			$this->db->update('uf_categories_sub', $data);
			$this->db->last_query();
			 $this->Ondemand_model->recentActivity('Sub Category is  Enabled Successfully.');
			$this->session->set_flashdata('success_msg', 'Enable successfully');
			redirect("panels/supermacdaddy/ondemand/subcategories");
		}
		if (isset($_POST['disable'])) { //die('d here');
			$id = $_POST['disable'];
			$data = array("status" => '0');
			$this->db->where('id', $id);
			$this->db->update('uf_categories_sub', $data);
			 $this->Ondemand_model->recentActivity('Sub Category is Disabled Successfully.');
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("panels/supermacdaddy/ondemand/subcategories");
		}
		if (isset($_POST['delete'])) {
			$categoryid = $_POST['delete'];
			$this->db->where('id',$categoryid);
			$this->db->delete('uf_categories_sub');
			 $this->Ondemand_model->recentActivity('Sub Category is Deleted Successfully.');
			$this->session->set_flashdata('success_msg', 'Sub Category Deleted Successfully');
			redirect("panels/supermacdaddy/ondemand/subcategories");
		}
		if (isset($_POST['updatesubcategory'])) {
			$updateid = $_POST['updatesubcategory'];
			$category = $this->Ondemand_model->update_Subcategory($updateid);
			$this->Ondemand_model->recentActivity('Sub Category is Updated Successfully.');
			$this->session->set_flashdata('success_msg', 'Sub Category Updated Successfully');
			redirect("panels/supermacdaddy/ondemand/subcategories");
		}
		$data['all_cat'] = $this->Ondemand_model->all_categories_enable();
		$data['allsub_cat'] = $this->Ondemand_model->all_sub_categories();
		$this->load->view('ondemand_template', $data);
	}
	public function edit_Subcat() {
		$result = $this->Dashboard_model->Subcatdetail();
		$all_cat = $this->Dashboard_model->all_categories_enable();
		echo '<div class="col-sm-12">
						<div class="form-group">
						<label>Category Name</label>
						<select class="form-control" name="main_category">';
						foreach($all_cat as $v_catg)
						{	$select='';
							if($result['uf_categories_id'] == $v_catg['id'])
							{
								$select='selected';
							}
							echo '<option value='.$v_catg['id'].' '.$select.'>'.$v_catg['name'].'</option>';
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
	
		public function visibility_list(){
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');
			$data['title']='History';
			$data['file']='ondemand/visibility_list';
			$where=array('user_id'=>$id);
			if(isset($_POST['delete_history'])){
				 $uid= $_POST['delete_history'];
				 $dwhere= array('loc_id' =>$uid);
			     $this->Ondemand_model->deletRecord('cp_locations',$dwhere );
			     $this->session->set_flashdata('success_msg', 'visibility location  is deleted Successfully..!');
			}
			$data['historyData']=$this->Ondemand_model->visibilityData('cp_locations',$where );
			$this->load->view('ondemand_template',$data);
		}else{
			redirect('/');
		}
	}
	public function latitude()
	{
		$this->load->view('ondemand/latitude');
	}
	public function getAdminIds()
	{
		$adminIds=$this->Ondemand_model->getAdminIds(array('user_type' =>'5'));
		echo json_encode($adminIds);
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
	
	function upload_image($image, $path){

        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['overwrite'] = FALSE;
        $config['file_name'] = $image;
        $config['max_size'] = '1000000';
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('image')) 
        //incase file uploading fails give name of field in arguments
        {
            $error = array('error' => $this->upload->display_errors());
           return $error;
        }else{
        	$result=$this->upload->data();
			return $result;
        }
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
  public function getsubCategory()
  {
     $id= $this->input->post('id');
     $result=$this->Ondemand_model->getsubCategoryData($id);
     $data='<option>--Choose One--</option>';
       if(count($result)){
           foreach ($result as $r) {
             $data .=" <option value=".$r->id.">".$r->sub_category."</option>";
           }

       }
       echo $data;
  }



	public function bulk_backup() {
		$data['title'] = 'Products';
		$data['file'] = 'ondemand/products';

		if ($_POST['upload_product']) {
			$user_id = $this->session->userdata('id');
			ini_set('max_execution_time', -1);
			//$json = array();
			$file_info = pathinfo($_FILES["image"]["name"]);
			$file_directory = "uploads/";
			$new_file_name = date("d-m-Y ") . rand(000000, 999999) . "." . $file_info["extension"];

			if (move_uploaded_file($_FILES["image"]["tmp_name"], $file_directory . $new_file_name)) {
				$file_type = PHPExcel_IOFactory::identify($file_directory . $new_file_name);
				$objReader = PHPExcel_IOFactory::createReader($file_type);
				$objPHPExcel = $objReader->load($file_directory . $new_file_name);

				$sheet_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				$i = 0;
				foreach ($sheet_data as $row) {
					if ($i == 0) {
						
					} else {
						if (!empty($row['F']) && !empty($row['G'])) {
							$qu = $this->Ondemand_model->main_categories_bulk($row['F']);
							$category_id = @$qu[0]['id'];
							if (empty($category_id)) {
								$data_array = array("name" => trim($row['F']));
								$category_id = $this->Ondemand_model->insert_category_bulk($data_array);
							}

							$subquery = $this->Ondemand_model->sub_categories_bulk($row['G']);
							$subcategory_id = @$subquery[0]['id'];
							if (empty($subcategory_id)) {
								$data_array = array("sub_category" => trim($row['F']));
								$subcategory_id = $this->Ondemand_model->insert_sub_category_bulk($data_array);
							}


							$content = file_get_contents($row['O']);
							$file_name = rand(000000, 999999);
							$ready = $file_name . '.jpg';
							$new_image = file_put_contents('uploads/' . $ready, $content);

							if (!empty($ready)) {
								$data_value = array(
									 'user_id' => $user_id,
									 'location_name' => $row['B'], 
									 'location_id' => $row['C'], 
									 'product_type' => $row['D'], 
									 'product_name' => $row['E'], 
									 'product_category' => $category_id, 
									 'product_sub_category' => $subcategory_id,
									 'preparation_time' => $row['H'], 
									 'tax_patients' => $row['I'],
									 'mrp' => $row['J'], 
									 'happy_hour' => $row['K'], 
									 'happy_day' => $row['L'], 
									 'happy_time_to' => $row['M'], 'happy_time_from' => $row['N'], 'image' => $ready, 'product_notes' => $row['P'], 'status' => "0", 'identifier' => $row['R'], 'amt_d_price' => $row['S']);
								  $prodcut_size = array(
								  	'k1' => $row['T'],
								  	'k2' => $row['U'],
								  	'k3' => $row['V'],
								  	'k4' => $row['W'],
								  	'k5' => $row['x'],
								  	 );
								$task = $this->Ondemand_model->add_product_bulk($data_value, $prodcut_size);

								$this->session->set_flashdata('success_msg', 'Upload successfully');
							}
						}
					}
					$i++;
				}
			}
		}
		redirect('panels/supermacdaddy/ondemand/products');
	}


	public function bulk()
    {
    	
        $image = $_FILES["image"]["name"];
	    $path = 'uploads';
	    $ext = end((explode(".", $image)));
	    $extension=strtolower($ext);
	    if($extension !='csv'){
	      $this->session->set_flashdata('error_msg', "Please upload csv file ");
		  redirect("panels/supermacdaddy/ondemand/products");
	    }

        $result=$this->upload_image($image, $path);
      //  print_r($result);
//echo "<pre>";
	    $file = fopen("uploads/".$result['file_name'],"r");
	    $i=0;
	  $user_id = $this->session->userdata('id');
	    while(($row = fgetcsv($file)) !== FALSE){
	    	$i++;
	    	if($i == '1'){
	    		continue;
	    	} 
	    	 
                        $data_value = array(
									'user_id' => $user_id,
									'location_name' => $row[0], 
									'location_id' =>$user_id,
									'product_type' => 'Driver', 
									'product_name' => $row[1], 
									'product_category' =>$row[2], 
									'product_sub_category' =>$row[3],
									'preparation_time' =>$row[5], 
									'tax_patients' =>$row[6],
									'mrp' => $row[7], 
									'happy_hour' => $row[8], 
									'happy_day' =>$row[9], 
									'happy_time_to' => $row[10],
									'happy_time_from' =>  $row[11],
									'image' => $row[16], 
									'image_url' => $row[17], 
									'page_url' => $row[18], 
									'product_notes' =>$row[12],
									'status' => "1", 
									'identifier' =>  $row[14],
									'amt_d_price' =>  $row[15]
									 );
								  $prodcut_size = array(
								  	'k1' => $row[19],
								  	'k2' => $row[21],
								  	'k3' => $row[20],
								  	'k4' =>$row[23],
								  	'k5' => $row[22],
								  	 );
								 
								$task = $this->Ondemand_model->add_product_bulk($data_value, $prodcut_size);
								

	     }
	     fclose($file);
	      $this->session->set_flashdata('success_msg', "Products are updated successfully ".$i);
		  redirect("panels/supermacdaddy/ondemand/products");
    }

  public function liveOrders() {

		$data['title'] = 'Products';
		$data['file'] = 'ondemand/live_order';
		
		$user_id = $this->session->userdata('id');
		$data['products'] = $this->Store_model->live_order($user_id);
		$data['main_categories'] = $this->Store_model->main_categories();
		
		if (isset($_POST['Order'])) {
			$user_id = $_POST['user_id'];
			$id = $_POST['Order'];
			$notify_ins = array("user_id" => $user_id, "message" => 'Your order is ready. Thank you for Using Med Connex Mobile App', "created_at" => date('Y-m-d H:i:s'), "type_read" => 4);
			$this->db->insert('notification_history', $notify_ins);
			$product = $this->Store_model->order_process($id, '1');
			$this->session->set_flashdata('successmessage', ' Order is ready');
			redirect("panels/supermacdaddy/ondemand/liveOrders");
		}
		if (isset($_POST['Delay'])) {
			$id = $_POST['Delay'];
			$user_id = $_POST['user_id'];
			$product = $this->Store_model->order_process($id, '2');
			$this->session->set_flashdata('successmessage', ' Order is Delay  ');
			$notify_ins = array("user_id" => $user_id, "message" => 'Your order is being reviewed and will be processed shortly. Thank you for Using Med Connex Mobile App', "created_at" => date('Y-m-d H:i:s'), "type_read" => 4);

			$this->db->insert('notification_history', $notify_ins);
			redirect("panels/supermacdaddy/ondemand/liveOrders");
		}
		if (isset($_POST['Cancel'])) {
			$id = $_POST['Cancel'];
			$user_id = $_POST['user_id'];
			$product = $this->Store_model->order_process($id, '3');
			$this->session->set_flashdata('successmessage', ' Order is Canceled ');
			$notify_ins = array("user_id" => $user_id, "message" => 'This order was Cancelled. you were not charged at all.Thank you for Using Med Connex Mobile App', "created_at" => date('Y-m-d H:i:s'), "type_read" => 4);

			$this->db->insert('notification_history', $notify_ins);
			redirect("panels/supermacdaddy/ondemand/liveOrders");
		}

		$this->load->view('ondemand_template', $data);
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
			$this->session->set_flashdata('successmessage', 'Mail has sent successfully');
			redirect("panels/supermacdaddy/ondemand");
		} else {
			$this->session->set_flashdata('successmessage', 'Sorry  Mail is not sent');
			redirect("panels/supermacdaddy/ondemand");
		}
  }


public function giftedProducts() {
		
		$data['title'] = 'Favorites';
		$data['file'] = 'ondemand/giftedProducts';


		if(!empty($_REQUEST['searchrandom_code'])){

			$random_code = $this->input->post('random_code');
				$sql = "SELECT random_code from send_gift where random_code = '$random_code'";
		$query = $this->db->query($sql);
		$getRandom_code = $query->row();
	

		if($getRandom_code->random_code != ''){

				$random_code = $this->input->post('random_code');
		$data['giftedProducts'] = $this->Store_model->giftedProducts($random_code);
	}
	else{
		$this->session->set_flashdata('successmessage', 'Your '.$random_code.' Referral Code Is Not Exist');
			redirect("ondemand/giftedProducts");
	}

		}
		if(!empty($_REQUEST['complete_product'])){
				$id = $this->input->post('id');
		$this->Store_model->complete_product($id);

		}
		if(!empty($_REQUEST['Deny_product'])){
				$id = $this->input->post('id');
		$this->Store_model->Deny_product($id);
		}
		
		
	

		
	
		$this->load->view('ondemand_template', $data);
	}




}
 