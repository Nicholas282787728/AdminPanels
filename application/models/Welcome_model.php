<?php
class Welcome_model extends CI_Model {

	function __construct()
     {
        parent::__construct();        

     }
	 function admin_login($username,$password){
		$resultarray = array();
		$pwd = MD5($password);
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where('email',$username);
		$this->db->where('password',$pwd);
		$query = $this->db->get(); //echo "<pre/>"; print_r($query); die('m here');
		$resultarray = $query->row_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;	
	}
	function auth_login($email,$password){
		$resultarray = array();
		$pwd = MD5($password);
		$this->db->select('*');
		$this->db->from('authenticated_users');
		$this->db->where('email',$email);
		$this->db->where('password',$pwd);
		$query = $this->db->get(); //echo "<pre/>"; print_r($query); die('m here');
		$resultarray = $query->row_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;	
	}
	public function reset_auth_pwd($email,$newpwd){
		//echo $email.' '.$newpwd ;die('here');
		$data= array(
				'password'=> MD5($newpwd),
			);
		$data = array_filter($data);
		$this->db->where("email",$email);
		$this->db->update("authenticated_users",$data);
		return true;	
	}
	function getservice(){
		
		$sql = "SELECT * FROM `cp_services_content` ";
          $query = $this->db->query($sql);
          $res = $query->result_array();
		  return $res;
	}
	
   /*  public function login(){
     
     	  $sql = "select * from mg_users where email = '" . $usr . "' and password = '" .md5($pwd). "'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }

      public function users(){
     
     	  $sql = "SELECT * FROM `mg_users` WHERE `user_type` = '0' order by id DESC";
          $query = $this->db->query($sql);
          $res = $query->result_array();
		  foreach ($res as $key=>$row){
                $id = $row['id'];  
                
                $this->db->select('*');
                $this->db->from('cr_booking');
                $this->db->where('user_id',$id);
                $query1 = $this->db->get();
                $total_booking = $query1->num_rows();       
                $res[$key]['count'] = $total_booking;      
			}
		return $res;		 
		  
     }
	function active_user($id){		//$data = array('status' => '0'); $this->db->where('id',$id); $this->db->update("codeigniter_student",$data);
		$this->db->set('auth_status','1');
		$this->db->where('id',$id);		
		$this->db->update("mg_users");
	}
	function deactive_user($id){
		$data = array('auth_status' => '0');
		$this->db->where('id',$id);		
		$this->db->update("mg_users",$data);
	}
	 public function edit_user($id){
     
     	  $sql = "SELECT * FROM `mg_users` WHERE `id` ='$id'";
          $query = $this->db->query($sql);
          return $query->result_array();
     }
	 function update_user($id){
		$data     = array(
		
			'first_name'		=> $this->input->post('edit_firstname'),
			'last_name'			=> $this->input->post('edit_lastname'),
			'email'				=> $this->input->post('edit_email'),
			'phone_no'			=> $this->input->post('edit_phone'),
			//'profile_pic'		=> $this->input->post('image')			
			
		);         //echo "<pre/>"; print_r($data); die('m here');
			$data = array_filter($data);
			$this->db->where('id',$id);
			$this->db->update("mg_users",$data);			
	}
	   public function vendors(){
     
     	  $sql = "SELECT * FROM `mg_users` WHERE `user_type` = '1' order by id DESC";
          $query = $this->db->query($sql);
          $res = $query->result_array();
		  foreach ($res as $key=>$row){
                $id = $row['id'];  
                
                $this->db->select('*');
                $this->db->from('cr_booking');
                $this->db->where('driver_id',$id);
                $query1 = $this->db->get();
                $total_booking = $query1->num_rows();       
                $res[$key]['count'] = $total_booking;      
			}
			return $res;
     }
     
     public function vendor_detail($id)
     {
     	 $sql = "SELECT * FROM `mg_user_details` where user_id='$id' ";
          $query = $this->db->query($sql); 
          return $query->result_array();   
     } 
     
	 public function currency(){
     
     	  $sql = "SELECT * FROM `cr_currencies`";
          $query = $this->db->query($sql);
          return $query->result_array();
     }
	 	public function set_price(){
		$data = array(
						'currency_code' 		 => $this->input->post('code'),
						'country' 			 	 => $this->input->post('country'),
						'currency' 				 => $this->input->post('currency'),
						'price' 				 => $this->input->post('price')
									
  		);
		$this->db->insert('cr_country_price' , $data);
		$priceid = $this->db->insert_id();   
        if(!empty($priceid)){
            return $priceid;
        }else{
            return false;
        }
	}
	 public function booking_his($id){
     
     	  $sql = "SELECT cr_booking.*,mg_users.first_name,mg_users.last_name FROM `cr_booking` LEFT JOIN mg_users on mg_users.id = cr_booking.user_id WHERE `user_id` = '$id'";
          $query = $this->db->query($sql);
          return $query->result_array();		  
		  
     }
	 public function vendorbooking($id){
     
     	  $sql = "SELECT cr_booking.*,mg_users.first_name,mg_users.last_name FROM `cr_booking` LEFT JOIN mg_users on mg_users.id = cr_booking.driver_id WHERE `driver_id` = '$id'";
          $query = $this->db->query($sql);
          return $query->result_array();
     }
     public function all_booking(){
     
     	  $sql = "SELECT * FROM `cr_booking`";
          $query = $this->db->query($sql);
          return $query->result_array();
	}
	function setting($id){
		$data     = array(
		
			'stripe_payment_key'		=> $this->input->post('payment_key'),
			'stripe_secret_key'			=> $this->input->post('secret_key')				
			
		);         //echo "<pre/>"; print_r($data); die('m here');
			$data = array_filter($data);
			$this->db->where('id',$id);
			$this->db->update("cr_admin",$data);			
	}
	function get_count(){
		 $sql = "SELECT count(*),
					(SELECT count(*) FROM `mg_users` WHERE `user_type` = '0') as user,
					(SELECT count(*) FROM `mg_users` WHERE `user_type` = '1') as vendor,
                    (SELECT count(*) FROM `mg_users` WHERE `user_profile_type` = '1') as water,
                    (SELECT count(*) FROM `mg_users` WHERE `user_profile_type` = '2') as driver,
                    (SELECT count(*) FROM `mg_users` WHERE `user_profile_type` = '3') as plumber,
					(SELECT count(*) FROM `mg_users` WHERE `user_profile_type` = '4') as helper,
					(SELECT count(*) FROM `mg_users` WHERE `user_profile_type` = '5') as painter,
					(SELECT count(*) FROM `mg_users` WHERE `user_profile_type` = '6') as electrician,
					(SELECT count(*) FROM `mg_users` WHERE `user_profile_type` = '7') as carpenter,
					(SELECT count(*) FROM `mg_users` WHERE `user_profile_type` = '8') as cargo,
					(SELECT count(*) FROM `mg_users` WHERE `user_profile_type` = '9') as shipping
					
				FROM `mg_users` as `mu`"; 
		  $query = $this->db->query($sql);
          return $query->result_array();
	}*/
} 

