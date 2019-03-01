<?php
class Staff_model extends CI_Model {

	function __construct()
     {
        parent::__construct();
        //$this->load->library('cart');
        //$this->load->library("security");
      
       // $this->load->library('form_validation');

     }
 	public function staff_login($username,$password){
     
     	$resultarray = array();
		$pwd = MD5($password);
		$this->db->select('*');
		$this->db->from('sal_login');
		$this->db->where('email',$username);
		$this->db->where('password',$pwd);
		$query = $this->db->get();
		$resultarray = $query->row_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;	
     }   
	public function task_list($id){
     
     	  $sql = "SELECT * FROM `sal_task` WHERE `staff_id`='$id' ";
          $query = $this->db->query($sql);
          $res = $query->result_array();
		  return $res;
     } 
	 public function staff_task($id){
     
     	  $sql = "SELECT * FROM `sal_task` WHERE `staff_id`='$id' ";
          $query = $this->db->query($sql);
          $res = $query->result_array();
		  return $res;
     } 
 	public function store_fronts(){
     
     	  $sql = "SELECT * FROM `sal_login` ORDER BY UID DESC";
          $query = $this->db->query($sql);
          $res = $query->result_array();
		  foreach ($res as $key=>$row){
                $id = $row['uid'];  
                
                $this->db->select('*');
                $this->db->from('sal_task');
                $this->db->where('staff_id',$id);
                $query1 = $this->db->get();
                $total_booking = $query1->num_rows();       
                $res[$key]['count'] = $total_booking;      
			}
		
		return $res;
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
	public function tasknotification($limit){
		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->order_by("sal_task.id", "desc");	
		if($limit!=0){
			$this->db->limit(5);
		}
		$this->db->join('sal_login', 'sal_login.uid = sal_task.staff_id', 'left');
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;
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
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;
	}
	public function chat_history(){
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("msg_id", "asc");	
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;	
	
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
}