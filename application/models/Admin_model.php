<?php
class Admin_model extends CI_Model {

	function __construct()
     {
        parent::__construct();
        //$this->load->library('cart');
        //$this->load->library("security");
       // $this->load->library('form_validation');

     }
	 public function admin_login($username,$password){
     
      	$resultarray = array();
		$pwd = MD5($password);
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where('email',$username);
		$this->db->where('password',$pwd);
		$query = $this->db->get();
		$resultarray = $query->row_array();   
		return $resultarray;	
     } 
	public function sal_login(){
		$this->db->select('*');
		$this->db->from('sal_login');
		$this->db->order_by("uid", "desc");	
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		 
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->order_by("id", "desc");	
		$querys = $this->db->get();
		$user = $querys->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		$counts = array('sales'=>$resultarray,'users'=>count($user));
		return $counts;	
	
	}
 	public function notification_history($limit){
		$this->db->select('*');
		$this->db->from('notification_history');
		$this->db->order_by("notification_history.id", "desc");	
		if($limit!=0){
		$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		$query = $this->db->get();
		$resultarray = $query->result_array();   
		return $resultarray;
	}
	
 	public function store_fronts(){
     
     	  $sql = "SELECT * FROM `uf_user` WHERE `title` = 'Store' ";
          $query = $this->db->query($sql);
          $res = $query->result_array();
		return $res;
     }    
     
     public function drivers(){
     
     	  $sql = "SELECT * FROM `uf_user` WHERE `title` = 'Driver' ";
          $query = $this->db->query($sql);
          $res = $query->result_array();
		return $res;
     }    
     public function doctor(){
     
     	  $sql = "SELECT * FROM `uf_user` WHERE `title` = 'Doctor' ";
          $query = $this->db->query($sql);
          $res = $query->result_array();
		return $res;
     }  
		public function sendmassage(){
		//message  img uid settlestatus mid caseid username  
		//INSERT INTO `tblmessagecases`( `CaseID`, `UserID`, `mid_id`, `SendDate`, `Message`, `attachment`) VALUES (
		$id = $this->session->userdata('id');
		$data = array(
				"message_by"=>1,
				"sender_name"=>'Admin',
				"message"=>$this->input->post("message"),
				"message_date"=>date("Y-m-d H:m:s"),
			);
		//print_r($data);die;	
		$this->db->insert('admin_chat',$data);
		$lastid= $this->db->insert_id();
		return $lastid;		
	}
	public function chat_history(){
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("msg_id", "asc");	
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;	
	
	}
	public function msgnotification($limit){
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("admin_chat.msg_id", "desc");
		$this->db->where("admin_chat.sender_name!=", "Admin");	
		if($limit!=0){
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = admin_chat.message_by', 'left');
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;
	
	}
	public function allservicelist($checkservice){
		$this->db->select('*');
		$this->db->from('uf_promo_codes');
		$this->db->where("service_type",$checkservice);			
		$query = $this->db->get();
		$resultarray = $query->row_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray; 
	
	}
	public function save_promo(){
		$data= array(
				'code'=> $this->input->post('code'),
				'type'=> $this->input->post('type'),
				'offer'=> $this->input->post('offer'),
				'description'=> $this->input->post('description'),
				'service_type'=> $this->input->post('service_type'),
				'start'=> $this->input->post('starts'),
				'end'=>$this->input->post('ends'),
				'user_id'=>1,

			);
			
		$data = array_filter($data);
		$this->db->insert("uf_promo_codes",$data);
		return true;		
	}
	public function update_promo($id){
		$data= array(
				'code'=> $this->input->post('code'),
				'type'=> $this->input->post('type'),
				'offer'=> $this->input->post('offer'),
				'description'=> $this->input->post('description'),
				'service_type'=> $this->input->post('service_type'),
				'start'=> $this->input->post('starts'),
				'end'=>$this->input->post('ends'),
				'user_id'=>1,

			);
		$data = array_filter($data);
		$this->db->where("id",$id);
		$this->db->update("uf_promo_codes",$data);
		return true;	
	}
	public function delete_promo($promoid){
		$this->db->where('id',$promoid);
		$this->db->delete('uf_promo_codes');
	}
	public function allpromo(){
		$this->db->select('*');
		$this->db->from('uf_promo_codes');
		$this->db->order_by("id", "desc");	
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;	
	
	}
	public function promodetail(){
		$id =  $this->input->post('id');
		$this->db->select('*');
		$this->db->from('uf_promo_codes');
		$this->db->where("id", $id);	
		$this->db->order_by("id", "desc");	
		$query = $this->db->get();
		$resultarray = $query->row_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		
		return $resultarray;	
	
	}
	public function add_user(){
		$data= array(
				'user_name'=> $this->input->post('user_name'),
				'display_name'=> $this->input->post('display_name'),
				'title'=> $this->input->post('title'),
				'email'=> $this->input->post('email'),
				'mob_number'=> $this->input->post('contact'),
				'password'=>md5($this->input->post('email')),
				'flag_password_reset'=>1,

			);
		$data = array_filter($data);
		$this->db->insert("uf_user",$data);
		return sha1($this->input->post('email'));	
	}
	public function update_user(){
		$data= array(
				'user_name'=> $this->input->post('user_name'),
				'display_name'=> $this->input->post('display_name'),
				'title'=> $this->input->post('title'),
				'email'=> $this->input->post('email'),
				'mob_number'=> $this->input->post('contact'),
				'password'=>md5($this->input->post('email')),
				'flag_password_reset'=>1,

			);
		$data = array_filter($data);
		$this->db->where("id",$this->input->post('user_id'));
		$this->db->update("uf_user",$data);
		return true;	
	}
	public function alluser(){
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->order_by("id", "desc");
		if(isset($_POST['type'])){
			$this->db->where("title", $_POST['type']);
		}	
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		
		return $resultarray;	
	
	}
		public function aut_users_detail(){
		$id =  $this->input->post('id');
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where("id", $id);	
		$this->db->order_by("id", "desc");	
		$query = $this->db->get();
		$resultarray = $query->row_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		
		return $resultarray;	
	
	}
	public function userdetail(){
		$id =  $this->input->post('id');
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where("id", $id);	
		$this->db->order_by("id", "desc");	
		$query = $this->db->get();
		$resultarray = $query->row_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		
		return $resultarray;	
	
	}
}