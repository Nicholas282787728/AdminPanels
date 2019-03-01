<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliatepartner extends CI_Controller {

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
          $this->load->model('Partner_model');
          $this->load->model('common_model');
          $this->load->model('Dashboard_model');
          $user_type=$this->session->userdata('adminlogin');

	      	if($user_type =='0' || $user_type =='2' || $user_type =='4' || $user_type =='3'){
	      		 redirect('panels/supermacdaddy/dashboard/admin');
		       }
		  
     } 
     
	public function index()
	{	//$this->load->view('partner/index');  

		 $user_type=$this->session->userdata('adminlogin');
		if($user_type =='10' || $user_type =='5'){

			$id=$this->session->userdata('id');		
			$data['title']='Dashboard :: Home';
			$data['file']='partner/index';			
			$data['notification'] = $this->Partner_model->notification_history(5,$id); 
			$data['supportCount'] = $this->Partner_model->recordsCount($id,'ost_ticket__cdata'); 
//			$data['ratingArray'] = $this->Partner_model->ratingArray($id,'uf_user_rating'); 
//			$data['getSalesGraph'] = $this->Partner_model->getSalesGraph($id); 
			$data['usercount'] = $this->Partner_model->user_count();
			$data['usertype_count'] = $this->Partner_model->usertype_count();
			$data['provider_usertype_count'] = $this->Partner_model->Provider_usertype_count();

			$data['getSalesGraph']=array();
			$data['ratingArray']=array();
			$data['allAdmins']=$this->Partner_model->getAdminIds(array('user_type' =>'5'));
			
			$this->load->view('partner_templates',$data);
		}
		else 
		{
			 redirect('panels/supermacdaddy/dashboard/admin');
		}
		
//		
//		if($this->session->userdata('adminlogin')){
//			$data['title']='Dashboard :: Home';
//			$data['file']='partner/index';			
//			$data['notification'] = $this->Partner_model->notification_history(10); 
//			$this->load->view('partner_templates',$data);
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
		 redirect('affiliate-partners');
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
			  redirect('affiliate-partners');
		}else{
			$this->session->set_flashdata('errormessage', 'Email is already existed  Successfully.');
			  redirect('affiliate-partners');
		}

	}
	


	public function verification() {
		$data['title'] = 'Verification';
		$data['file'] = 'partner/verification';

		if (isset($_POST['deactive'])) {
			$uid = $_POST['deactive'];
			$dataa = array("is_verify" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("affiliate-partners/verification");
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

			 $notify_ins=array("user_id"=>$uid,"message"=>'Thank you for the Verification, please proceed to the following location',"created_at"=>date('Y-m-d H:i:s'),"type_read"=>4);
			   $this->db->insert('notification_history',$notify_ins);
			$this->session->set_flashdata('success_msg', 'Active successfully');
			redirect("affiliate-partners/verification");
		}

		if(isset($_POST['reject'])){
			  $rejectid=$_POST['reject'];
		
		   $get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `id` = '" . $rejectid . "' ")->row_array();
		   $email = $get_query['email'];
			$this->email->set_mailtype("html");
				$this->email->from('info@medconnex.net', 'MedConnex');
				$this->email->to($email);
				$this->email->subject('MedConnex:Verification Denied');
				$this->email->message('Your Verification has been denied at the moment, please submitted an updated version to proceed. Thank You');
				$mailsend1 = $this->email->send();

           
			$notify_ins=array("user_id"=>$rejectid,"message"=>'Your Verification has been denied at the moment, please submitted an updated version to proceed. Thank You!',"created_at"=>date('Y-m-d H:i:s'),"type_read"=>4);
			   $this->db->insert('notification_history',$notify_ins);
			   redirect("affiliate-partners/verification");

		}
		$vuid=$this->session->userdata('id');
		$data['alluser'] = $this->Partner_model->get_Pendding_interviews($vuid);
		$this->load->view('partner_templates', $data);
	}

	
	
	
	
	public function login(){ //die('got it');
		if($this->session->userdata('adminlogin')){
			redirect('affiliate-partners');
		}else{
			$data['title']  = 'Login';
			$data['file']	= 'partner/login';			
			
			$this->load->view('partner/login');
			
			$username = $this->input->post('ondemand_email');
			$password = $this->input->post('ondemand_password');
			//echo $username .''.$password ; 
			
		
			/**********************************************************/
			if($this->input->post('ondemand_btn') == 'Login'){ 			
				
				$result = $this->Partner_model->admin_login($username,$password); //print_r($result); die('yes');
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
						redirect('affiliate-partners/');
				}else{
					$this->session->set_flashdata('errormessage','Invalid credentials..!!');
					redirect('/');
				}
			}
			
		}	 
	}
  public function getChatLIst()
  {
   $allAdmins=$this->Partner_model->getAdminIds(array('user_type' =>'5'));
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
	// 		$data['file']='partner/visibility';			
			
	// 		$this->load->view('partner_templates',$data);
					
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
			$this->Partner_model->update_data('uf_user',$data_arr,$where_arr);
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
      $data['file'] = 'partner/visibility';
      $this->load->model('Doctor_model');
      $user_id  = $this->session->userdata('id');
      $data['getvisibility'] = $this->Partner_model->get_visibility_data($user_id);
        $data['optin'] = $this->Partner_model->savetosdata('optin');
	  $data['optout'] = $this->Partner_model->savetosdata('optout');
      $this->load->view('partner_templates', $data);
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
      
      $this->Partner_model->recentActivity('visibility is  added Successfully.');
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
    redirect('affiliate-partners/visibility');
  }
	
	public function orders()
	{
		if($this->session->userdata('adminlogin')){
			$data['title']='Orders';
			$data['file']='partner/orders';	
			$driver_id = $this->session->userdata('id');		
			$data['orders']= $this->Partner_model->orders($driver_id);
			$this->load->view('partner_templates',$data);
					
		}else{
			redirect('/');
		}
	}
	public function products(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Products';
			$data['file']='partner/products';	
	 		$user_id = $this->session->userdata('id');		
			$data['products']= $this->Partner_model->products($user_id);
			$data['main_categories']= $this->Partner_model->main_categories();
			if(isset($_POST['deactive'])){ 
				$id = $_POST['deactive']; 
				$product = $this->Partner_model->active_product($id); 
				$this->Partner_model->recentActivity('Product Activated Successfully.');
				$this->session->set_flashdata('success_msg', 'Product Activated Successfully');
				redirect("affiliate-partners/products");
			}
			if(isset($_POST['active'])){ 
			$id = $_POST['active']; 
			$product = $this->Partner_model->deactive_product($id); 
			$this->Partner_model->recentActivity('Product Deactivated Successfully.');
			$this->session->set_flashdata('success_msg', 'Product Deactivated Successfully');
            redirect("affiliate-partners/products");
		}
		
		if(isset($_POST['delete_product'])){ 
			 $productid = $_POST['delete_product']; 
			 $checkProduct = $this->Partner_model->checkProduct($productid); 
			 if($checkProduct > 0){
		      $this->session->set_flashdata('success_msg', 'This product is existed in another table');
			 }else{
			 $product = $this->Partner_model->delete_product($productid); 
			 $this->Partner_model->recentActivity('Product Deleted Successfully.');
			 $this->session->set_flashdata('success_msg', 'Product Deleted Successfully');
			 redirect("affiliate-partners/products");
			 }
			
		}
		if(isset($_POST['save_product'])){ 

			$result = $this->Partner_model->add_product();
     	    if($result){
     		    $product_name=$this->input->post('product_name');
			     $messageValue='The Product '.$product_name.' is added  is added by ';
		 	 	$this->Partner_model->notification_add($messageValue);
     			$this->session->set_flashdata('success_msg', 'Product is added successfully.');
     			redirect('affiliate-partners/products');
     		}else{
                $this->session->set_flashdata('error_msg', 'Product image is not upload something went wrong.');
     			redirect('affiliate-partners/products');
     		}
		}

		if(isset($_POST['update'])){ 
			$result = $this->Partner_model->update_product();

     		if($result==true){
                $this->Partner_model->recentActivity('Product Updated Successfully.');
     			$this->session->set_flashdata('success_msg', 'Product is Updated successfully.');
     			redirect('affiliate-partners/products');
     		}
		}
		
			$this->load->view('partner_templates',$data);
					
		}else{
			redirect('/');
		}
	}
	
	public function edit_product(){
    $result = $this->Partner_model->product_detail();
    $productId=$result[0]['product_category'];
    $main_categories = $this->Partner_model->main_categories();
      $main="<option>--Choose One--</option>";
      foreach($main_categories as $single) {
        if($single['id'] ==$result[0]['product_category'] ){
          $selected="selected";
        }else{
          $selected="";
        }
                $main.= ' <option value="'.$single['id'].'" '. $selected.'>'.$single['name'].'</option>';
                 }
		$getsubCategory = $this->Partner_model->getsubCategoryData($productId);
     $subcat="<option>--Choose One--</option>";
      if(count($getsubCategory)){
      
       foreach ($getsubCategory as $g) {
        if($g->id ==$result[0]['product_sub_category'] ){
          $selected="selected";
        }else{
          $selected="";
        }
        $subCata =" <option value='".$g->id."' ".$selected.">".$g->sub_category."</option>";
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
			$data['file']	= 'partner/support_tickets';	
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
				             	redirect("affiliate-partners/support_tickets");
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
		 	     	$this->Partner_model->notification_add($messageValue);
		 	     	$this->Partner_model->recentActivity('Support ticket is created successfully.');
					$this->session->set_flashdata('success_msg', 'created ticket successfully');
					redirect("affiliate-partners/support_tickets");
				}
				else
				{
					$this->session->set_flashdata('error_msg', 'Empty Details..!');
					redirect("affiliate-partners/support_tickets");
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
					$this->Partner_model->recentActivity('Support ticket is Updated successfully.');
					$this->session->set_flashdata('success_msg', 'update ticket successfully');
					redirect("affiliate-partners/support_tickets");
				}
				else
				{
					$this->session->set_flashdata('error_msg', 'Empty Details..!');
					redirect("affiliate-partners/support_tickets");
				}
			}
			else if (isset($_POST['process'])) {
				$uid = $_POST['process'];
				$data = array("status" => '1');
				$this->db->where('ticket_id', $uid);
				$this->db->update('ost_ticket__cdata', $data);
				$this->db->last_query();
				$this->Partner_model->recentActivity('Support ticket  is Proccessed successfully.');
				$this->session->set_flashdata('success_msg', 'Proccess successfully');
				redirect("affiliate-partners/support_tickets");
			}
			elseif (isset($_POST['completed'])) {
				$uid = $_POST['completed'];
				$data = array("status" => '2');
				$this->db->where('ticket_id', $uid);
				$this->db->update('ost_ticket__cdata', $data);
				$this->Partner_model->recentActivity('Support ticket is Completed successfully.');
				$this->session->set_flashdata('success_msg', 'Completed successfully');
				redirect("affiliate-partners/support_tickets");
			}
			$data['last_ticket_no'] = $this->Partner_model->last_ticket_no();
			$data['list_ticket_data'] = $this->Partner_model->list_ticket_data();
			$this->load->view('partner_templates',$data);
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
			$this->Partner_model->recentActivity('Support ticket is Deleted successfully.');
		$this->session->set_flashdata('success_msg', 'Deleted successfully');
		redirect("affiliate-partners/support_tickets");
	}
	public function ticket_replay($ticket_no)
	{
		if($this->session->userdata('adminlogin'))
		{
			$data['title']	= 'Ticket Comment';
			$data['file']	= 'partner/ticket_replay';	
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
			    $this->Partner_model->recentActivity(' ticket replay is sent successfully.');
				$this->session->set_flashdata('success_msg', 'send successfully');
				redirect("affiliate-partners/ticket_replay/$ticket_no");
			}
			$data['list_ticket_comment'] = $this->Partner_model->list_ticket_comment($ticket_no);
			$data['ticket_file']=$this->Dashboard_model->ticket_file($ticket_no);
			$this->load->view('partner_templates',$data);
			
		}else{
			redirect('/');
		}
	}
	
	
	public function notification(){
		if($this->session->userdata('adminlogin')){
			$id=$this->input->post('id');
			
			$notification = $this->Partner_model->notification_history(5,$id); 
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
                            <a class="text-center brdr-0" href="'.base_url('affiliate-notifications').'">
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
			$notification = $this->Partner_model->notification_history_user(0,$id); 
			echo count($notification);
	}
	public function tasknotification(){
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');
			$tasknotification = $this->Partner_model->tasknotification(5, $id); 
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
			$notification = $this->Partner_model->tasknotification_message(0,$id); 
			echo count($notification);
	}
	public function tasks(){
		    $data['title'] = 'Dashboard :: Tasks';
		$data['file'] = 'partner/tasks';
		$data['tasks'] = $this->Partner_model->task_list();
		$tasks = $this->Partner_model->task_list();
		
		if (isset($_POST['update_read_status'])) {
			$uid = $_POST['update_read_status'];
			$dataa = array("read_status" => '1');
			$this->db->where('id', $uid);
			$this->db->update('sal_task', $dataa);
           $this->Partner_model->recentActivity(' Task is Read successfully.');

			$this->session->set_flashdata('success_msg', 'Task is Read successfully');
			redirect("affiliate-partners/tasks");
		}
		$this->load->view('partner_templates', $data);
	}
	public function msgnotification(){
		if($this->session->userdata('adminlogin')){
			 $id=$this->session->userdata('id');
			$notification = $this->Partner_model->msgnotification(5,$id); 
			echo ' <li><a href="javascript:void(0);"  data-toggle="modal" data-target="#composemail" ><i class="fa fa-envelope" aria-hidden="true"></i> Compose</a>
                        </li>';
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
                            <a class="text-center brdr-0" href="'.base_url('affiliate-message').'">
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
			$notification = $this->Partner_model->msgnotification_message(0,$id); 
			echo count($notification);
	}
	public function chat_history(){
		$id = $this->session->userdata('id');
        $adminIds=$this->Partner_model->getAdminIds(array('user_type' =>'5'));
		
	
	 foreach ($adminIds as $a ) {

	     	 $baseAdminId=$a->id;
	 		$history =$this->Partner_model->chat_history($baseAdminId);
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
			$data =$this->Partner_model->sendmassage();
		 }else{
			redirect("/login");	
		 }
		
	}
	public function drivers()
	{
		$data['title']='Drivers';
		$data['file'] = 'partner/drivers';
		$data['drivers']= $this->Partner_model->drivers();
		$this->load->view('partner_templates', $data);
	}
	public function logout(){            
   $user_id=$this->session->userdata('id');
    $this->Partner_model->update_logout($user_id);
		$data = array(
			'id' => "",
			'name' => "",
			'username' => "",
			'password' => "",
			'title' => "",
			'adminlogin' => "",
		);
	   $this->Partner_model->recentActivity(' User is logout successfully.');
		$this->session->set_userdata($data);
		$this->session->unset_userdata('login');
		$this->session->sess_destroy();
		redirect('/');
		
		
    }
	
	public function aut_users(){
		$result = $this->Partner_model->aut_users_detail();
		
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
		$result=  $this->Partner_model->updateDriverDocuments('uf_user_documents',$id);
		echo json_encode($result);

	}

	
	public function edit_signupdocuments()
	{	
		$id = $this->input->post('document_id');
		$edit_data = $this->Partner_model->edit_document_data($id);
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
			$data['file']='partner/auth_users';
			
			
			
			
			if(isset($_POST['enable'])){
				 $uid = $_POST['enable'];
				$data= array("flag_enabled"=>'1');
				$this->db->where('id', $uid);
      			$this->db->update('uf_user',$data); 
      			 $this->db->last_query();
      			 $this->Partner_model->recentActivity(' Auth User is Enabled successfully.');
				$this->session->set_flashdata('success_msg', 'Enabled successfully');
                redirect("affiliate-partners/auth_user");
			}
			if(isset($_POST['disable'])){
				$uid = $_POST['disable'];
				$data= array("flag_enabled"=>'0');
				$this->db->where('id', $uid);
      			$this->db->update('uf_user',$data); 
      			 $this->Partner_model->recentActivity(' Auth User is Disabled successfully.');
				$this->session->set_flashdata('success_msg', 'Disabled successfully');
                redirect("affiliate-partners/auth_user");
			}	
			if(isset($_POST['delete'])){
				$uid = $_POST['delete'];
				$this->db->where('id', $uid);
      			$this->db->delete('uf_user'); 
      			$this->Partner_model->recentActivity(' Auth User is Deleted successfully.');
				$this->session->set_flashdata('success_msg', 'Deleted successfully');
                redirect("affiliate-partners/auth_user");
			}			
			
			if (isset($_POST['save'])) 
			{
				if (!empty($this->input->post('contact')) && !empty($this->input->post('user_name')) && !empty($this->input->post('email'))) 
				{
					$result = $this->Partner_model->add_user();
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
							redirect('affiliate-partners/auth_user');
						} else {
							$this->session->set_flashdata('success_msg', 'Sorry ' . base_url() . 'opening?token=' . $en_id . ' mail not sent');
							redirect('affiliate-partners/auth_user');
						}
					} else {
						$this->session->set_flashdata('success_msg', $user_result);
						redirect('affiliate-partners/auth_user');
					}
				}
				else 
				{
					$this->session->set_flashdata('error_msg', 'User Name, Email, Telephone No. Required! ');
					redirect('affiliate-partners/auth_user');
				}
			}
		
		
		
		
		
			if(isset($_POST['updatesale'])){		
				if (!empty($this->input->post('contact')) && !empty($this->input->post('user_name')) && !empty($this->input->post('email'))) {
						$result = $this->Partner_model->update_user();
						if ($result) {
							$this->session->set_flashdata('success_msg', "User data updated successfully");
							redirect('affiliate-partners/auth_user');
						} else {
							$this->session->set_flashdata('success_msg', "User data not updated");
							redirect('affiliate-partners/auth_user');
						}
					} else {
						$this->session->set_flashdata('error_msg', 'User Name, Email, Telephone No. Required! ');
						redirect('affiliate-partners/auth_user');
					}
			}
			
			
			
			$data['all_staff'] = $this->Partner_model->auth_user();
			$all_staff = $this->Partner_model->auth_user();
			$data['userdetails'] = $this->db->get_where('uf_user', array('id' => $this->session->userdata('id')))->row();
			$this->load->view('partner_templates',$data);
					
		}else{
			redirect('affiliate-partners');
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
				 $result = $this->Partner_model->update_category($id); 
			   if($result){
			   	   $this->Partner_model->recentActivity(' Category updated successfully.');
     				$this->session->set_flashdata('success_msg', 'Category updated successfully.');
    			redirect('affiliate-partners/categories');
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
		 	   $this->Partner_model->notification_add($messageValue);
		 	   	$this->Partner_model->recentActivity(' Category is Added successfully.');
               $this->session->set_flashdata('success_msg', 'Category is added successfully.');
               redirect("affiliate-partners/categories");	
			} 
			if(isset($_POST['delete'])){
			   $uid = $_POST['delete'];
			   $result= $this->Partner_model->subcategoriesCheck($uid);
			    if($result) {
  	             $this->session->set_flashdata('success_msg', 'This Category is already existed in sub categires it is not deleted');
                redirect("affiliate-partners/categories");	
			    }
			     $productResult= $this->Partner_model->productCheck($uid);
			      if($productResult) {
  	             $this->session->set_flashdata('success_msg', 'This Category is already existed in product it is not deleted');
                redirect("affiliate-partners/categories");	
			    }
			    	
				$this->db->where('id', $uid);
      			$this->db->delete('uf_categories'); 
      			$this->Partner_model->recentActivity(' Category is Deleted successfully.');
				$this->session->set_flashdata('success_msg', 'Category is Deleted successfully');
                redirect("affiliate-partners/categories");	

			}
			if(isset($_POST['disable'])){
			     $uid = $_POST['disable'];
		      	$data= array("status"=>'0');
				$this->db->where('id', $uid);
      			$this->db->update('uf_categories',$data); 
      			$this->Partner_model->recentActivity(' Category is Disabled successfully.');
				$this->session->set_flashdata('success_msg', 'Category is  Disabled successfully');
                redirect("affiliate-partners/categories");	

			}
			if(isset($_POST['enable'])){
			   $uid = $_POST['enable'];
				$data= array("status"=>'1');
				$this->db->where('id', $uid);
      			$this->db->update('uf_categories',$data); 
      			$this->Partner_model->recentActivity(' Category is Enabled successfully.');
				$this->session->set_flashdata('success_msg', 'Category is Enabled successfully');
                redirect("affiliate-partners/categories");	

			}
			$data['title']='Category';
			$data['file']='partner/category';
			$data['all_staff'] = $this->Partner_model->get_all_product(); 
			$this->load->view('partner_templates',$data);
			}else{
			redirect('affiliate-partners');
		}
	}
	public function edit_category()
	{
		if($this->session->userdata('adminlogin')){
		
			$id=$this->input->post('id');
			$result=$this->Partner_model->edit_category($id); 
		 	echo json_encode($result);
            
			}else{
			redirect('affiliate-partners');
		}
	}


	public function promo_codes()
	{
		if($this->session->userdata('adminlogin')){
			$data['title']='Users';
			$data['file']='partner/promo_code';
			
			if(isset($_POST['enable'])){
				 $uid = $_POST['enable'];
				$data= array("flag_enabled"=>'1');
				$this->db->where('id', $uid);
      			$this->db->update('authenticated_users',$data); 
      			$this->db->last_query();
      			$this->Partner_model->recentActivity(' Promo is Enabled successfully.');
				$this->session->set_flashdata('success_msg', 'Enabled successfully');
                redirect("affiliate-partners/promo_code");
			}
			if(isset($_POST['disable'])){
				$uid = $_POST['disable'];
				$data= array("flag_enabled"=>'0');
				$this->db->where('id', $uid);
      			$this->db->update('authenticated_users',$data); 
      		    $this->Partner_model->recentActivity(' Promo is Disabled successfully.');
				$this->session->set_flashdata('success_msg', 'Disabled successfully');
                redirect("affiliate-partners/promo_code");
			}	
			if(isset($_POST['delete'])){
				$uid = $_POST['delete'];
				$this->db->where('id', $uid);
      			$this->db->delete('authenticated_users'); 
      			$this->Partner_model->recentActivity(' Promo is Deleted successfully.');
				$this->session->set_flashdata('success_msg', 'Deleted successfully');
                redirect("affiliate-partners/promo_code");
			}			
			
			if(isset($_POST['save'])){


				$result = $this->Partner_model->add_user();
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
							  $this->Partner_model->recentActivity(' Promo is added successfully. Check Your <strong>'.$email.' </strong> to recover you password');
                        	$this->session->set_flashdata('success_msg', 'Check Your <strong>'.$email.' </strong> to recover you password');
                         	redirect("affiliate-partners/promo_code");
                         	//$error='1';
					    }else{
					    //echo "hii";
					    	  $this->Partner_model->recentActivity('Sorry '.base_url().'opening?token='.$en_id.' mail not sent');
							$this->session->set_flashdata('success_msg', 'Sorry '.base_url().'opening?token='.$en_id.' mail not sent');
                         	redirect("affiliate-partners/promo_code");
                         	//$error='<div style="padding: 5px;"  class="alert alert-danger" >Sorry '.base_url().'opening?token='.$en_id.' mail not sent</div>';
						}
		 	 	}else{
		 	 		$this->session->set_flashdata('success_msg', $user_result);
                	redirect("affiliate-partners/promo_code");
                	//$error='<div style="padding: 5px;"  class="alert alert-danger" >'.$user_result.'</div>';
		 	 	}
     			// if($result==true){
//      				$this->session->set_flashdata('successmessage', 'User added successfully.');
//      				redirect('affiliate-partners/auth_user');
//      			}
			}
			if(isset($_POST['updatesale'])){		
				$id = $_POST['updatesale']; 
				 $result = $this->Partner_model->update_aut_user($id); 
			 if($result==true){
                $this->Partner_model->recentActivity(' promo codes is updated successfully.');
     		    $this->session->set_flashdata('success_msg', 'promo codes is updated successfully.');
    			redirect('affiliate-partners/promo_code');
     			}
		 	}
			
			$data['all_staff'] = $this->Partner_model->auth_user(); 
			$this->load->view('partner_templates',$data);
					
		}else{
			redirect('affiliate-partners');
		}
	}
  public function promo_list() {

		if($this->session->userdata('adminlogin')){
			$data['title'] = 'Promo codes';
			$data['file'] = 'partner/promo_list';
			$user_id = $this->session->userdata('id');		
			$data['products']= $this->Partner_model->products($user_id);
			$data['allproducts']= $this->Partner_model->All_products($user_id);

			//$_SESSION['id']		= 	$this->session->userdata('id');	
			//echo $_SESSION['id']	;die('got it');
			if (isset($_POST['save'])) {
				$code=$this->input->post('code');
				    $messageValue='This promo Code '.$code. ' is added by ';
				    $this->Partner_model->notification_add($messageValue);
				
				    $check_promo = $this->Partner_model->check_promo();
				     
				    if($check_promo > 0){
				    	 $this->Partner_model->recentActivity(' promo codes is already successfully.');
				    	$this->session->set_flashdata('error_msg', 'Promo code is already existed');
				         redirect("affiliate-partners/promo_list");
				    }else{
				    	
				        $task = $this->Partner_model->save_promo();
				        $this->Partner_model->recentActivity(' promo codes is added successfully.');
				       $this->session->set_flashdata('success_msg', 'Promo Save Successfully');
				       redirect("affiliate-partners/promo_list");
				    }

				
			}

			if (isset($_POST['enable'])) { //die('e here');
				$id = $_POST['enable'];
				$data = array("status" => '1');
				$this->db->where('id', $id);
				$this->db->update('uf_promo_codes', $data);
				$this->db->last_query();
				$this->Partner_model->recentActivity(' promo codes is Enable successfully.');
				$this->session->set_flashdata('success_msg', 'Promo code Enable successfully');
				redirect("affiliate-partners/promo_list");
			}
			if (isset($_POST['disable'])) { //die('d here');
				$id = $_POST['disable'];
				$data = array("status" => '0');
				$this->db->where('id', $id);
				$this->db->update('uf_promo_codes', $data);
			    $this->Partner_model->recentActivity(' promo codes is Disable successfully.');
				$this->session->set_flashdata('success_msg', 'Promo code Disable successfully');
				redirect("affiliate-partners/promo_list");
			}
			if (isset($_POST['update'])) {
				$updateid = $_POST['id'];
				//$created_by =  $records['created_by'];
				$promo = $this->Partner_model->update_promo($updateid);
				$this->Partner_model->recentActivity(' promo codes is Updated successfully.');
				$this->session->set_flashdata('success_msg', 'Promo code Updated Successfully');
				redirect("affiliate-partners/promo_list");
			}
			if (isset($_POST['delete'])) {
				$promoid = $_POST['delete'];
				$category = $this->Dashboard_model->delete_promo($promoid);
				$this->Partner_model->recentActivity(' promo codes is Deleted successfully.');
				$this->session->set_flashdata('success_msg', 'Promo Deleted Successfully');
				redirect("affiliate-partners/promo_list");
			}

			$data['allpromo'] = $this->Partner_model->allpromo($user_id);

			$this->load->view('partner_templates', $data);
		} else {
			redirect('/');
		}
	}
	public function edit_promo()
	{
		$pid=$this->input->post('id');
		$result=$this->Partner_model->edit_promo($pid);
		echo json_encode($result);
	}

	public function setting($value='')
	{
		if($this->session->userdata('adminlogin')){
			$driverid=$this->session->userdata('id');
			//$whereData = array('id' =>$driverid,'user_type' => '1' );
			$whereData = array('id' =>$driverid );
			$data['title']="Site Settings";
			$data['file']='partner/setting';
			$data['profile'] =$this->Partner_model->getUserData($whereData);
			$this->load->view('partner_templates',$data);
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
             $result=$this->Partner_model->getUpdate($table, $data, $whereData);
            if($result){
             $this->Partner_model->recentActivity('settings are updated Successfully.');
             $this->session->set_flashdata('success', 'settings are updated Successfully.');
			 redirect('affiliate-partners/setting');

            }else{
            	$this->Partner_model->recentActivity('settings are not updated Successfully.');
            	$this->session->set_flashdata('error', 'settings are not updated Successfully.');
             redirect('affiliate-partners/setting');
            }

		}else{
			redirect('panels/supermacdaddy/sales/login');
		}
	}

	public function signupdocuments(){
	
		if($this->session->userdata('adminlogin')){
			$data['title']='sign up documents';
			$user_id=$this->session->userdata('id');
			$data['file']='partner/signupdocuments';			
			$data['uploadDocuments'] =$this->Partner_model->document_ondemand_signup();	
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
					"notes" => $this->input->post('notes')
				);

				$this->db->where('id', $document_id);
				$resultarray= $this->db->update('uf_user_documents', $data_arr);
				//echo $this->db->last_query();
				$historydata_arr=array("user_id"=>$created_id,"message"=>"Sign Up Documents !  Update Successfully. ","created_at"=>$date);
				$this->common_model->insert_record($historydata_arr, 'history');
		
				$this->session->set_flashdata('success_msg', 'update document successfully');
				 // redirect('affiliate-partners/signupdocuments');
				redirect("affiliate-signupdocuments");
			}

			if(isset($_POST['delete_product'])){
				$this->db->where('id', $_POST['delete_product']);
				$this->db->delete('uf_user_documents');
			    $this->session->set_flashdata('successmessage', ' document is deleted successfully');
				redirect("affiliate-signupdocuments");

			}
			
			$this->load->view('partner_templates',$data);
			 		
		}else{
			redirect('/');
		}
	}
	public function payouts(){
	
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');
			$data['title']='sign up documents';
			$data['file']='partner/payout';			
			//$data['documents'] =$this->common_model->get_data('cp_doctor_documents','desc','id');	
			$result =$this->Partner_model->getSingleRecord('payout_details',$id);
			$data['orders']= $this->Partner_model->orders($id);
			$data['payments']= $this->Partner_model->payments($id);
	     	$data['payout']=$result;
	     	if (isset($_POST['save'])) {
	     		$this->Partner_model->save_payout();
	     		$this->Partner_model->recentActivity('Payout details  are added Successfully.');

	           $this->session->set_flashdata('success_msg', 'Payout details  are added Successfully.');
			   redirect('affiliate-payouts');
	     	}
	     	if (isset($_POST['update'])) {
	     		$this->Partner_model->update_payout();
	     		$this->Partner_model->recentActivity('Payout details  are updated Successfully.');
	           $this->session->set_flashdata('success_msg', 'Payout details  are updated Successfully.');
			   redirect('affiliate-payouts');
	     	}
			
			$this->load->view('partner_templates',$data);
					
		}else{
			redirect('/');
		}
	}
	public function complimentaryAd(){
	
		if($this->session->userdata('adminlogin')){
			$data['title']='sign up documents';
			$data['file']='partner/complemn-ad';			
			$data['comp'] =$this->common_model->get_data_tbl('cp_complimentary_ad','user_id',$this->session->userdata('id'));	
			$this->load->view('partner_templates',$data);
					
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

		 	 		$result = $this->Partner_model->update_comp($image); 
		 	 	if($result){
		 	 	    $this->Partner_model->recentActivity('complimentary Sales updated successfully.');
		 	 		$this->session->set_flashdata('success_msg', "complimentary Sales updated successfully");
                	redirect("affiliate-partners/complimentaryAd");
		 	 	}else{
		 	 		$this->Partner_model->recentActivity('complimentary Sales is not updated successfully.');
		 	 		$this->session->set_flashdata('success_msg', "complimentary Sales data not updated");
                	redirect("affiliate-partners/complimentaryAd");
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

		 	 		$result = $this->Partner_model->add_new_comp($image); 
		 	 	if($result){
		 	 	    $this->Partner_model->recentActivity('complimentary Sales add successfully.');
		 	 		$this->session->set_flashdata('success_msg', "complimentary Sales add successfully");
                	redirect("affiliate-partners/complimentaryAd");
		 	 	}else{
		 	 		$this->Partner_model->recentActivity('complimentary Sales is not add successfully.');
		 	 		$this->session->set_flashdata('success_msg', "complimentary Sales data not updated");
                	redirect("affiliate-partners/complimentaryAd");
		 	 	}
		 	}else{
		 		$error='<div   style="padding: 5px;" class="alert alert-danger" > Ad Type </div>';
		 	} 
	}
	
	
	
	
		public function readMessages(){
		$name=$this->input->post('name');

		if($name =='notification'){
			$id     = $this->session->userdata('id');
		    $result = $this->Partner_model->readMessages($id,$name);
		    echo '0';
		}else if($name =='task'){
		
			$id     = $this->session->userdata('id');
		    $result = $this->Partner_model->readMessages($id,$name);
            echo '0';
		}else if($name =='message'){
		
			$id     = $this->session->userdata('id');
		    $result = $this->Partner_model->readMessages($id,$name);
            echo '0';
		}
       

	}
	public function affiliate()
	{
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');		
			$data['title']='sign up documents';
			$data['file']='partner/affiliate';	
			$data['supportCount'] = $this->Partner_model->recordsCount($id,'ost_ticket__cdata'); 		
			//$data['comp'] =$this->common_model->get_data_tbl('cp_complimentary_ad','id','01');	
			$this->load->view('partner_templates',$data);
					
		}else{
			redirect('/');
		}
	}
	public function notifications()
	{
		$data['title'] = 'Dashboard :: Notifications';
		$data['file'] = 'partner/notifications';
		$data['notification'] = $this->Partner_model->notification_historyAll();
		if (isset($_POST['update_read_status'])) {
			$uid = $_POST['update_read_status'];
			$dataa = array("read_status" => '1');
			$this->db->where('id', $uid);
			$this->db->update('notification_history', $dataa);
			$this->Partner_model->recentActivity('Notification is Read successfully.');
			$this->session->set_flashdata('success_msg', 'Notification is Read successfully');
			redirect("affiliate-partners/notifications");
		}
		$this->load->view('partner_templates', $data);
	}
	public function setpassword(){
    	$auth_token=$this->input->get('auth_token');
    	$result= $this->Partner_model->auth_token_check($auth_token);
    	if($result){
		$data['id'] = $result->id;
		$data['emailtoken'] = $result->email;
		$data['passwordtoken'] =  $result->password; 
		$data['secret_token'] = $result->secret_token; 
        $this->load->view('partner/login', $data);
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
			  $this->Partner_model->recentActivity('Password is Updated Successfully.');
		       $this->session->set_flashdata('successmessage', 'Password Update Successfully.');
		       redirect('/');
		}else{
			  $this->Partner_model->recentActivity('Password is not Update Successfully.');
			  $this->session->set_flashdata('errormessage', 'Password is not Update Successfully.');
			  $url=base_url('panels/supermacdaddy/ondemand/setpassword?auth_token='.$auth_check);
		      redirect($url);
		}
	
    }
    public function graph($value='')
    {
    	$this->load->view('partner/graph');
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
 //              $this->Partner_model->recentActivity('visibility is  added Successfully.');
	// 		$this->session->set_flashdata('success_msg', 'Save Successfully..!');
	// 	}
	// 	redirect('affiliate-partners/visibility');
	// }
	
	public function locations(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Locations';
			$data['file']='partner/locations';			
			$this->load->view('partner_templates',$data);
					
		}else{
			redirect('/');
		}
	}
	public function history(){
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');
			$data['title']='History';
			$data['file']='partner/history';
			$where=array('status' =>1, 'user_id'=>$id);
			if(isset($_POST['delete_history'])){
				 $uid= $_POST['delete_history'];
				 $dwhere= array('id' =>$uid);
			     $this->Partner_model->deletRecord('history',$dwhere );
			     $this->session->set_flashdata('success_msg', 'history is deleted Successfully..!');
			}
			$data['historyData']=$this->Partner_model->historyData('history',$where );
			$this->load->view('partner_templates',$data);
		}else{
			redirect('/');
		}
	}
	public function subcategories() {
		$data['title'] = 'Categories';
		$data['file'] = 'partner/sub_categories';
	
		if (isset($_POST['save'])) {
			$task = $this->Dashboard_model->saveSubcat();
			 $this->Partner_model->recentActivity('Sub Category is Saved Successfully.');
			$this->session->set_flashdata('success_msg', 'Sub Categories Save Successfully');
			redirect("affiliate-partners/subcategories");
		}
		if (isset($_POST['enable'])) { //die('e here');
			$id = $_POST['enable'];
			$data = array("status" => '1');
			$this->db->where('id', $id);
			$this->db->update('uf_categories_sub', $data);
			$this->db->last_query();
			 $this->Partner_model->recentActivity('Sub Category is  Enabled Successfully.');
			$this->session->set_flashdata('success_msg', 'Enable successfully');
			redirect("affiliate-partners/subcategories");
		}
		if (isset($_POST['disable'])) { //die('d here');
			$id = $_POST['disable'];
			$data = array("status" => '0');
			$this->db->where('id', $id);
			$this->db->update('uf_categories_sub', $data);
			 $this->Partner_model->recentActivity('Sub Category is Disabled Successfully.');
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("affiliate-partners/subcategories");
		}
		if (isset($_POST['delete'])) {
			$categoryid = $_POST['delete'];
			$this->db->where('id',$categoryid);
			$this->db->delete('uf_categories_sub');
			 $this->Partner_model->recentActivity('Sub Category is Deleted Successfully.');
			$this->session->set_flashdata('success_msg', 'Sub Category Deleted Successfully');
			redirect("affiliate-partners/subcategories");
		}
		if (isset($_POST['updatesubcategory'])) {
			$updateid = $_POST['updatesubcategory'];
			$category = $this->Partner_model->update_Subcategory($updateid);
			$this->Partner_model->recentActivity('Sub Category is Updated Successfully.');
			$this->session->set_flashdata('success_msg', 'Sub Category Updated Successfully');
			redirect("affiliate-partners/subcategories");
		}
		$data['all_cat'] = $this->Partner_model->all_categories_enable();
		$data['allsub_cat'] = $this->Partner_model->all_sub_categories();
		$this->load->view('partner_templates', $data);
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
			$data['file']='partner/visibility_list';
			$where=array('user_id'=>$id);
			if(isset($_POST['delete_history'])){
				 $uid= $_POST['delete_history'];
				 $dwhere= array('loc_id' =>$uid);
			     $this->Partner_model->deletRecord('cp_locations',$dwhere );
			     $this->session->set_flashdata('success_msg', 'visibility location  is deleted Successfully..!');
			}
			$data['historyData']=$this->Partner_model->visibilityData('cp_locations',$where );
			$this->load->view('partner_templates',$data);
		}else{
			redirect('/');
		}
	}
	public function latitude()
	{
		$this->load->view('partner/latitude');
	}
	public function getAdminIds()
	{
		$adminIds=$this->Partner_model->getAdminIds(array('user_type' =>'5'));
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
        	return '1';
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
     $result=$this->Partner_model->getsubCategoryData($id);
     $data='<option>--Choose One--</option>';
       if(count($result)){
           foreach ($result as $r) {
             $data .=" <option value=".$r->id.">".$r->sub_category."</option>";
           }
       }
       echo $data;
  }
  public function pending_interviews() {
		$data['title'] = 'pending_interviews';
		$data['file'] = 'partner/pending_interviews';

		if (isset($_POST['deactive'])) {
			$uid = $_POST['deactive'];
			$dataa = array("is_verify" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("affiliate-partners/pending_providers");
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
				$this->email->from('info@medconnex.net', 'MedConnx');
				$this->email->to($email);
				$this->email->subject('MedConnx::Set Password');
				$this->email->message('Hello ' . $get_query['email'] . ',
						<br>Your account has been created on <b>MedConnx</b> team.<br><br>Please set password for your account
						<a href="' . base_url() . 'home/setpassword?auth_token=' . $en_id . '">' . base_url() . 'home/setpassword?auth_token=' . $en_id . '</a>
						<br> contact our staff at info@medconnex.net
						<br>
						Thank you,<br>
						MedConnx');
				$mailsend = $this->email->send();
			}
			$this->session->set_flashdata('success_msg', 'Active successfully');
			redirect("affiliate-partners/pending_interviews");
		}
		$data['alluser'] = $this->Dashboard_model->get_Pendding_interviews();
		$this->load->view('partner_templates', $data);
	}

	public function pending_providers() {
		$data['title'] = 'pending_providers';
		$data['file'] = 'partner/pending_providers';

		if (isset($_POST['deactive'])) {
			$uid = $_POST['deactive'];
			$dataa = array("is_verify" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("affiliate-partners/pending_providers");
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
				$this->email->from('info@medconnex.net', 'MedConnx');
				$this->email->to($email);
				$this->email->subject('MedConnx::Set Password');
				$this->email->message('Hello ' . $get_query['email'] . ',
						<br>Your account has been created on <b>MedConnx</b> team.<br><br>Please set password for your account
						<a href="' . base_url() . 'home/setpassword?auth_token=' . $en_id . '">' . base_url() . 'home/setpassword?auth_token=' . $en_id . '</a>
						<br> contact our staff at info@medconnex.net
						<br>
						Thank you,<br>
						MedConnx');
				$mailsend = $this->email->send();
			}
			$this->session->set_flashdata('success_msg', 'Active successfully');
			redirect("affiliate-partners/pending_providers");
		}
		if (isset($_POST['type'])) {
			$type = $_POST['type'];
			$data['alluser'] = $this->Dashboard_model->alluserpandding_provider($type);
		} else {
			$data['alluser'] = $this->Dashboard_model->alluserpandding_provider();
		}
		$this->load->view('partner_templates', $data);
	}

	public function pending_affiliate() {
		$data['title'] = 'pending_providers';
		$data['file'] = 'partner/pending_affiliate';
        $data['alluser']=$this->Partner_model->getAffiliates();
		if (isset($_POST['deactive'])) {
			$uid = $_POST['deactive'];
			$dataa = array("flag_enabled" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_affiliate', $dataa);
			$this->session->set_flashdata('success_msg', 'Disable successfully');
			redirect("affiliate-partners/pending_affiliate");
		}
		if (isset($_POST['active'])) {
			$uid = $_POST['active'];
			$dataa = array("flag_enabled" => '1');
			$this->db->where('id', $uid);
			$this->db->update('uf_affiliate', $dataa);
			$this->session->set_flashdata('success_msg', 'Enabled successfully');
			redirect("affiliate-partners/pending_affiliate");
			
			}
			
		
	
		$this->load->view('partner_templates', $data);
	}
	public function attachment_zip() {
		if ($this->session->userdata('adminlogin')) {
			$data['all_advrZip'] = $this->Dashboard_model->all_zip_files();
			$data['all_staff'] = $this->Dashboard_model->all_staff_attachement();
			$data['title'] = 'General Sales';
			$data['file'] = 'partner/attachment-zip';
 			$data['zip_id'] = $this->input->get('id');
			if (!empty($data['zip_id'])) {
				$data['edit_zip'] = $this->Dashboard_model->edit_zip_files($data['zip_id']);
			}
			$this->load->view('partner_templates', $data);
		} else {
			redirect('panels/supermacdaddy/dashboard/login');
		}
	}

	public function distributionZone() {
		$data['title'] = 'Users';
		$data['file'] = 'partner/dropzone';
		$data['all_staff'] = $this->Dashboard_model->getAllDropZones();
		$session_uid = $this->session->userdata('id');
		if (isset($_POST['enable'])) {
			$uid = $_POST['enable'];
			$data = array("flag_enabled" => '1',);
			$this->db->where('id', $uid);
			$this->db->update('uf_dropzone', $data);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Enabled successfully');
			redirect("affiliate-distributionZone");
		} elseif (isset($_POST['disable'])) {
			$uid = $_POST['disable'];
			$data = array("flag_enabled" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_dropzone', $data);
			$this->session->set_flashdata('success_msg', 'Disabled successfully');
			redirect("affiliate-distributionZone");
		} elseif (isset($_POST['delete_all'])) {
			$this->db->truncate('uf_dropzone');
			$this->session->set_flashdata('success_msg', 'All Records are deleted successfully');
			redirect("affiliate-distributionZone");
		} elseif (isset($_POST['save'])) {
				$community_name=$this->input->post('community_name');
					$state=$this->input->post('state');
						$city=$this->input->post('city');
				$zip_code=$this->input->post('zip_code');
				$flag_enabled=$this->input->post('flag_enabled');
				$data = array(
					'community_name' =>$community_name , 
					'state' =>$state ,
					'user_id' =>$this->session->userdata('id'),
					'city' =>$city ,
					'zip_code' =>$zip_code , 
					'flag_enabled' =>$flag_enabled , 
			       );
			
					$sql = "select id from uf_dropzone  where  zip_code = '$zip_code'	";
			
		$query = $this->db->query($sql);
		$existrecord = $query->row();
		if(!empty($existrecord)){
				$this->session->set_flashdata('success_msg', 'This Record Is Allready Exist');
				redirect("affiliate-distributionZone");
		}
		else{
			$this->db->insert('uf_dropzone',$data);
				$this->session->set_flashdata('success_msg', 'Territories is added successfully');
				redirect("affiliate-distributionZone");
		}
		
				
			
		} elseif (isset($_POST['updateTerritories'])) {
                $community_name=$this->input->post('community_name');
			    $zip_code=$this->input->post('zip_code');
				$flag_enabled=$this->input->post('flag_enabled');
				$data = array(
					'community_name' =>$community_name , 
					'zip_code' =>$zip_code , 
					'flag_enabled' =>$flag_enabled , 
			       );
				$this->db->where('id',$_POST['updateTerritories']);
				$this->db->update('uf_dropzone',$data);
				$this->session->set_flashdata('success_msg', 'Territories is updated successfully');
				redirect("affiliate-distributionZone");
			
		}
			$this->load->view('partner_templates', $data);
	}

	 public function mailSendDistribution()
    {
    	  $email=$this->input->post('sender_email');
    	  $email_subject=$this->input->post('subject');
    	  $email_description=$this->input->post('description');
    	 
    	 if(!empty($email_description) && !empty($email)){
    	 	$this->email->set_mailtype("html");
			$this->email->from('info@medconnex.net', 'MedConnex Distribution Zone');
			$this->email->to($email);
			$this->email->subject('MedConnx:: '.$email_subject);
			$this->email->message($email_description);
			$mailsend = $this->email->send();
			$this->session->set_flashdata('success_msg', 'Mail has been sent successfully');
			redirect('affiliate-distributionZone');
		}else{
             $this->session->set_flashdata('error_msg', 'Mail is not sent..!!, May be Email description is empty');
			  redirect('affiliate-distributionZone');
    	   
         }
		}
	  	

    public function composemail()
  {

        $email=$this->input->post('send_to');
       /// $cc=$this->input->post('cc');
        $subject=$this->input->post('send_subject');
        $send_message=$this->input->post('send_message');
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnx');
		$this->email->to($email);
		//$this->email->cc($cc);
		$this->email->subject('MedConnx:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnx');

		$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('success_msg', 'Mail has sent successfully');
			redirect("affiliate-partners");
		} else {
			$this->session->set_flashdata('error_msg', 'Sorry  Mail is not sent');
			redirect("affiliate-partners");
		}
  }


    public function composemailMessage()
  {
  		$id=$this->session->userdata('id');
        $email=$this->input->post('send_to');
        $cc=$this->input->post('cc');
        $subject=$this->input->post('send_subject');
        $send_message=$this->input->post('send_message');
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnx');
		$this->email->to($email);
		$this->email->cc($cc);
		$this->email->subject('MedConnx:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnx');

		$mailsend = $this->email->send();

		if ($mailsend) {
			$data= array('user_id' => $id,
							'senderemail' => $email,
							'subject' => $subject,
							'message' => $send_message);
			$this->db->insert('sentMessage',$data);
			$this->session->set_flashdata('success_msg', 'Mail has sent successfully');
			redirect("affiliate-message");
		} else {
			$this->session->set_flashdata('error_msg', 'Sorry  Mail is not sent');
			redirect("affiliate-message");
		}
  }
    public function shareEmail()
  {

        $email=$this->input->post('send_to');
        $image=$this->input->post('image');
        
        $cc=$this->input->post('cc');
        $subject=$this->input->post('send_subject');
        $id=$this->input->post('id');
         $where = array('zip_id' =>$id);
	    $result=$this->Partner_model->getDataWhere('sal_zip',$where);
        $send_message=$result['description'];
        $upload_file=$result['upload_file'];
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnx');
		$this->email->to($email);
		$this->email->cc($cc);
		$this->email->subject('MedConnx:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnx');
			if (!empty($upload_file)) {
			$this->email->attach(base_url('uploads/'.$image));
			}

		 	$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('success_msg', 'Mail has sent successfully');
			redirect("affiliate-attachment_zip");
		} else {
			$this->session->set_flashdata('error_msg', 'Sorry  Mail is not sent');
			redirect("affiliate-attachment_zip");
		}
  }

public function message()
	{
		$data['title'] = 'Messages';
		$data['file'] = 'partner/message';
		$id = $this->session->userdata('id');
		$where = array('user_id' =>$id);
		$data['message'] = $this->Partner_model->getDataWhere('sentMessage',$where);

		if (isset($_POST['delete'])) {
			$id = $_POST['id'];
			
			$dwhere= array('id' =>$id);
			     $this->Partner_model->deletRecord('sentMessage',$dwhere );
			
			$this->session->set_flashdata('success_msg', 'Record Deleted successfully');
			redirect("affiliate-message");
		}
		$this->load->view('partner_templates', $data);
	}



		public  function acceptTerms()
	{
		
			$id = $this->session->userdata('id');
				$acceptTerms = $_POST['acceptTerms'];
			
			$dataarr=array("acceptTerms"=>$acceptTerms);
			$this->db->where('id',$id);
			$this->db->update(' uf_user',$dataarr);
			$this->session->set_flashdata('successmessage', 'Terms & Conditions Successfully.');
			redirect("affiliate-partners");
		
	}

}
 