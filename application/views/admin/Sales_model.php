<?php
class Sales_model extends CI_Model {

	function __construct() {
		parent::__construct();
		//$this->load->library('cart');
		//$this->load->library("security");
		// $this->load->library('form_validation');
	}

	public function sales_login($username, $password) {

		$resultarray = array();
		$pwd = MD5($password);
		$this->db->select('*');
		$this->db->from('sal_login');
		$this->db->where('email', $username);
		$this->db->where('password', $pwd);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function editSalesPanel() {
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('uf_general_sale');
		$this->db->where("id", $id);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}
	
	public function general_chart() {
		
//		
		$querys_where='';
		if(!empty($_POST))
		{
			$fliter_type= $this->input->post('fliter_type');
			if($fliter_type == "Weekly"){
				$querys_where='AND created_at BETWEEN NOW() - INTERVAL 7 DAY AND NOW()';
			}elseif($fliter_type == "Monthly"){
				$querys_where='AND created_at BETWEEN NOW() - INTERVAL 30 DAY AND NOW()';
			}
		}
		$sql = "SELECT  CAST(`service_date` AS DATE) as dates,count(case when service_type in ('Standard','Premium') then 1 end) as contractor_count,count(*) as overall_sales_count FROM `uf_user` WHERE `user_type`='4' AND `flag_enabled`='1' AND `is_verify` = '1' ".$querys_where."GROUP BY `dates`";
		
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}
	
	public function advertisement_chart() {
		
		$querys_where='';
		if(!empty($_POST))
		{
			$fliter_type= $this->input->post('fliter_type');
			if($fliter_type == "Weekly"){
				$querys_where='AND created_at BETWEEN NOW() - INTERVAL 7 DAY AND NOW()';
			}elseif($fliter_type == "Monthly"){
				$querys_where='AND created_at BETWEEN NOW() - INTERVAL 30 DAY AND NOW()';
			}
		}
		$sql = "SELECT  CAST(uf_user.service_date AS DATE) as dates,count(case when uf_user.service_type in ('Standard','Premium') then 1 end) as contractor_count,count(uf_user.id) as overall_sales_count"
				. " FROM `sal_advertisement` join `uf_user` on sal_advertisement.created_by = uf_user.id  WHERE uf_user.user_type='4' AND uf_user.flag_enabled='1' AND uf_user.is_verify = '1' ".$querys_where."GROUP BY `dates`";

		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}
		public function notification_add($message)
	{
		  $id = $this->session->userdata('id');
		  $name = $this->session->userdata('name');
		  $sql = "SELECT * FROM `uf_user` WHERE `user_type` = '4'  AND `id` = '$id'";
          $query = $this->db->query($sql);
          $res = $query->row();
		  $adminid= $res->id;
		  $data = array(
			   'user_id' =>'1', 
			   'message' =>$message.' '.$name, 
			   'sender_id' => $adminid,
			   'advertisement' => '1'
		       );
		$this->db->insert('notification_history',$data);
		return true;
	}
	public function save_promo() {
		$data = array(
			'code' => $this->input->post('code'),
			'type' => $this->input->post('type'),
			'offer' => $this->input->post('offer'),
			'description' => $this->input->post('description'),
			'service_type' => $this->input->post('service_type'),
			'start' => $this->input->post('starts'),
			'end' => $this->input->post('ends'),
			'created_by' => $this->session->userdata('id'),
		);

		$data = array_filter($data);
		$this->db->insert("uf_promo_codes", $data);
		return true;
	}

	public function update_promo($id) {
		$data = array(
			'code' => $this->input->post('code'),
			'type' => $this->input->post('type'),
			'offer' => $this->input->post('offer'),
			'description' => $this->input->post('description'),
			'service_type' => $this->input->post('service_type'),
			'start' => date('Y-m-d', strtotime($this->input->post('starts'))),
			'end' => date('Y-m-d', strtotime($this->input->post('ends'))),
			'created_by' => $this->session->userdata('id'),
		);
		$data = array_filter($data);
		$this->db->where("id", $id);
		$this->db->update("uf_promo_codes", $data);
		return true;
	}
	public function allpromo() {
		$this->db->select('*, (select display_name FROM uf_user WHERE uf_user.id = uf_promo_codes.created_by) as created_by');
		$this->db->from('uf_promo_codes');
		$this->db->where("created_by", $this->session->userdata('id'));
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;
	}
	public function promodetail() {
		$id = $this->input->post('id');
		$this->db->select('*, (select display_name FROM uf_user WHERE uf_user.id = uf_promo_codes.created_by) as created_by_name');
		$this->db->from('uf_promo_codes');
		$this->db->where("id", $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->row_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;
	}

	public function editAdverSale() {
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('sal_advertisement');
		$this->db->where("ad_id", $id);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function editAttachSale() {
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('sal_zip');
		$this->db->where("zip_id", $id);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function update_user() {
		
		$data = array(
			'email' => $this->input->post('email'),
		//	'user_name' => $this->input->post('username'),
			'contact_no' => $this->input->post('contactno'),
			'zip_code' => $this->input->post('zip'),
			'location_name' => $this->input->post('location_name'),
			//'title' => $this->input->post('title'),
		
		);
		$data = array_filter($data);
		$this->db->where("id", $this->input->post('id'));
		$this->db->update("uf_general_sale", $data);
		return true;
	}
	public function update_status_user($dataarr,$user_id) {
		$this->db->where("id", $user_id);
		$this->db->update("uf_user", $dataarr);
		return true;
	}
	public function update_status_sal_advertisement($dataarr,$ad_id) {
		$this->db->where("ad_id", $ad_id);
		$this->db->update("sal_advertisement", $dataarr);
		return true;
	}
	
	public function document_doctor_signup() {
		$this->db->select('uf_user_documents.*,uf_user_documents.id as user_document_id');
		$this->db->from('uf_user_documents');
		$this->db->join('uf_user', 'uf_user.id = uf_user_documents.user_id', 'left');
		$this->db->where("uf_user_documents.user_id", $this->session->userdata('id'));
		$query = $this->db->get();
		return $query->result();
	}
	public function edit_document_data($id) {
		$this->db->select('*');
		$this->db->from('uf_user_documents');
		$this->db->where("id", $id);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}
	public function update_advr($img) {
		$data = array(
			'ad_type' => $this->input->post('ad_type'),
			'ad_title' => $this->input->post('ad_title'),
			'size' => $this->input->post('ad_size'),
//			'state'=> $this->input->post('state'),
			'description' => $this->input->post('description'),
//			'region'=> $this->input->post('region'),
			'ad_image' => $img,
			'insert_date' =>$this->input->post('insert_date'),
			'end_date' =>$this->input->post('end_date'),
			'update_date' =>date('Y-m-d H:i:s'),
		);
		$data = array_filter($data);
		$this->db->where("ad_id", $this->input->post('ad_id'));
		$this->db->update("sal_advertisement", $data);
		return true;
	}
	
	
		public function historyData($table='',$where)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by('id','desc');
		$query=$this->db->get();
		// echo $this->db->last_query();
		// exit();
		return $query->result();
	}
	public function insert_advr($img,$lat,$lng,$storeId) {


			// $zipcode = $this->input->post('zip');
			// if(!empty($zipcode)){
			// 	   $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&sensor=false&key=AIzaSyBT4Ll-DEXGLSemUGlDPgqH9UADeIzQq3Y";
   //  $details=file_get_contents($url);
   //  $result = json_decode($details,true);
   //  if(!empty($result['results'][0]['geometry']['location']['lat'])){
   //  	    $lat=$result['results'][0]['geometry']['location']['lat'];
   //  $lng=$result['results'][0]['geometry']['location']['lng'];
   //  }
   //  else{
   //  	redirect('/');

			// 	$lat= '';
   //  $lng= '';
			// }

			// }
			// else{
			// 	$lat= '';
   //  $lng= '';
			// }

		// 	$query="SELECT  id FROM  uf_user WHERE   email = '".$this->input->post('email')."'";
  //       $result=$this->db->query($query);
  //      // echo $this->db->last_query();

		// $storeId = $result->row();

 
 $screenshotspace = implode(',', $this->input->post('screenshotspace'));
    
		$data = array(
				'providername' => $this->input->post('providername'),
				'screenshotspace' =>   !empty($screenshotspace) ? $screenshotspace : '',
				'contact' => $this->input->post('contact'),
				'email' => $this->input->post('email'),
				'store_id' => $storeId,

			'ad_type' => $this->input->post('ad_type'),
			//'ad_title' => $this->input->post('ad_title'),
			'zip' => $this->input->post('zip'),
			'size' => $this->input->post('ad_size'),
			'state' => $this->input->post('state'),
			'description' => !empty($this->input->post('description')) ? $this->input->post('description') : '',
			'region' => $this->input->post('region'),
			'ad_image' => $img,
			'latitude' => $lat,
			'longitude' => $lng,
			'insert_date' => $this->input->post('insert_date'),
			'end_date' => $this->input->post('end_date'),
			'update_date' =>date('Y-m-d H:i:s'),
			'created_by' =>$this->session->userdata('id'),
		);
		$data = array_filter($data);
		$this->db->insert("sal_advertisement", $data);
		return true;
	}

	public function get_availiblity_sal_advertisement()
	{
		// $this->db->select('count(ad_id) as count');
		// $this->db->from('sal_advertisement');
		// $this->db->where("ad_type", $this->input->post('ad_type'));
		// // $this->db->where("state", $this->input->post('state'));
		// // $this->db->where("size", $this->input->post('ad_size'));
		
		// $subquery = "((insert_date  BETWEEN '".$this->input->post('insert_date')."' AND '".$this->input->post('end_date')."')  OR (end_date BETWEEN '".$this->input->post('insert_date')."' AND '".$this->input->post('end_date')."')) ";
		// $this->db->where($subquery);
		// $query = $this->db->get();
		// echo $this->db->last_query();
		// die();

		$query="SELECT  * FROM    sal_advertisement WHERE   end_date  >= '".$this->input->post('insert_date')."' AND insert_date   <= '".$this->input->post('end_date')."'";
        $result=$this->db->query($query);
       // echo $this->db->last_query();

		return $result->num_rows();
	}
	
	public function getsal_advertisement()
	{
		$id=$this->session->userdata('id');
		// $this->db->select('sal_advertisement.*,uf_user.id,uf_user.mob_number,uf_user.email,uf_user.user_name,uf_user.user_type');
		// $this->db->from('sal_advertisement');
		// $this->db->join('uf_user', 'uf_user.id = sal_advertisement.created_by', 'left');
		// $this->db->order_by('sal_advertisement.ad_id', "desc");
		// $query = $this->db->get();
		// $resultarray = $query->result_array();
		// return $resultarray;

$this->db->select('*');
		$this->db->from('sal_advertisement');
		$this->db->where('created_by', $id);
		$this->db->order_by('sal_advertisement.ad_id', "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;

	}
	
	public function get_user_match($id) {
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where("id", $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function last_ticket_no() {
		$this->db->select('*');
		$this->db->from('ost_ticket__cdata');
		$this->db->order_by("ticket_id", "desc");
		$this->db->limit(1);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray['ticket_id'] + 1;
	}

	function check_ticket($email, $ticket_no) {
		$this->db->select('*');
		$this->db->from('ost_ticket__cdata');
		$this->db->where("ticket_id", $ticket_no);
		$this->db->where("email", $email);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function insert_attachment($img) {
		$data = array(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'upload_file' => $img,
			'insert_date' => date('Y-m-d H:i:s'),
			'upadate_date' => date('Y-m-d H:i:s')
		);
		$data = array_filter($data);
		//$this->db->where("ad_id",$this->input->post('ad_id'));
		$this->db->insert("sal_zip", $data);
		return true;
	}

	public function update_attach($img) {
		$data = array(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'upload_file' => $img,
			'upadate_date' => date('Y-m-d H:i:s')
		);
//		$data = array_filter($data);
		$this->db->where("zip_id", $this->input->post('zip_id'));
		$this->db->update("sal_zip", $data);
		return true;
	}

	public function all_zip_files() {
		$this->db->select('*');
		$this->db->from('sal_zip');
		$this->db->order_by("zip_id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function edit_zip_files($zip_id) {
		$this->db->select('*');
		$this->db->from('sal_zip');
		$this->db->where("zip_id", $zip_id);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function all_staff() {
		
		$this->db->select('*');
		$this->db->from('uf_user');
//		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	
	public function getAdminIds($where)
   {
      $this->db->select('*');
      $this->db->from('uf_user');
      $this->db->where($where);
      $query= $this->db->get();
      $data =$query->result();
      return $data;
   }
	public function all_task_sales($sales_id) {
		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->where("staff_id", $sales_id);
		$this->db->order_by("staff_id", 'desc');
		$querys = $this->db->get();
		return $querys->result_array();
	}

	public function count_task_sales($sales_id) {
		$this->db->select('count(id) as totals,count(case when status="1" then 1 end) as completed,count(case when status="0" then 1 end) as pendding');
		$this->db->from('sal_task');
		$this->db->where("staff_id", $sales_id);
		$querys = $this->db->get();
		return $querys->row_array();
	}

	public function sales_details($sales_id) {
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where("id", $sales_id);
		$querys = $this->db->get();
		return $querys->row_array();
	}

	public function common_query($table, $order_id = '') {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($order_id, "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function task_list() {

		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->order_by("sal_task.id", "desc");
		$this->db->join('sal_login', 'sal_login.uid = sal_task.staff_id', 'left');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	function deactive_user($id) {
		$this->db->set('status', '0');
		$this->db->where('uid', $id);
		$this->db->update("sal_login");
	}

	function active_user($id) {
		$this->db->set('status', '1');
		$this->db->where('uid', $id);
		$this->db->update("sal_login");
	}

	public function sales_task($id) {

		$sql = "SELECT * FROM `sal_task` WHERE `staff_id`='$id' ";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}

	public function save_task() {

		$data = array(
			'staff_id' => $this->input->post('staff_id'),
			'task_name' => $this->input->post('task_name'),
			'task_description' => $this->input->post('task_description'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
		);
		$data = array_filter($data);
		$this->db->insert("sal_task", $data);
		return true;
	}

	public function delete_task($id) {

		$this->db->where('id', $id);
		$this->db->delete('sal_task');
	}



public function delete($table,$where) {

		$this->db->where($where);
		$this->db->delete($table);
	}
	public function store_fronts() {

		$sql = "SELECT * FROM `sal_login`";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}

	public function drivers() {

		$sql = "SELECT * FROM `uf_user` WHERE `title` = 'Driver' ";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}

	public function doctor() {

		$sql = "SELECT * FROM `uf_user` WHERE `title` = 'Doctor' ";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}

	public function products() {

		$sql = "SELECT * FROM `cp_products` ";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}

	public function msgnotification($limit) {
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("admin_chat.msg_id", "desc");
		$this->db->where("admin_chat.sender_name!=", "Admin");
		if ($limit != 0) {
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = admin_chat.message_by', 'left');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function tasknotification($limit) {
		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->order_by("sal_task.id", "desc");
		if ($limit != 0) {
			$this->db->limit(5);
		}
		$this->db->join('sal_login', 'sal_login.uid = sal_task.staff_id', 'left');
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;
	}

	public function all_notification_history($limit) {
		$this->db->select('*,notification_history.id as notification_id');
		$this->db->from('notification_history');
		if ($limit != 0) {
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		$this->db->where('notification_history.user_id', $this->session->userdata('id'));
		$this->db->order_by("notification_history.id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function notification_history($limit, $type_read) {
		$this->db->select('*,notification_history.id as notification_id');
		$this->db->from('notification_history');
		if ($limit != 0) {
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		$this->db->where('notification_history.user_id', $this->session->userdata('id'));
		$this->db->where('notification_history.type_read', $type_read);
		$this->db->order_by("notification_history.id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}


	public function getId() {
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->where('message_by !=', '1');
		$this->db->order_by("msg_id", "desc");
		$this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->row();
	}
	public function chat_history($sid){
		$id=$this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("msg_id", "asc");
		$this->db->group_start();
		$this->db->where("message_by",$id);
		$this->db->or_where("message_to",$id);
		$this->db->group_end();
		$this->db->group_start();
		$this->db->where("message_by",$sid);
		$this->db->or_where("message_to",$sid);
		$this->db->group_end();
		
		$query = $this->db->get();
		 //echo $this->db->last_query();
		$resultarray = $query->result_array();   
		return $resultarray;	
	
	}
	
	public function sendmassage(){
		//message  img uid settlestatus mid caseid username  
		//INSERT INTO `tblmessagecases`( `CaseID`, `UserID`, `mid_id`, `SendDate`, `Message`, `attachment`) VALUES (
		  $id = $this->session->userdata('id');
		  $sql = "SELECT * FROM `uf_user` WHERE `user_type` = '5' limit 0,1 ";
          $query = $this->db->query($sql);
          $res = $query->row();
		  $adminid= $res->id;
			
		$data = array(
				"message_to"=>$this->input->post("id"),
				"message_by"=>$id,
				"sender_name"=>'Admin',
				"message"=>$this->input->post("message"),
				"message_date"=>date("Y-m-d H:m:s"),
			);
		//print_r($data);die;	
		$this->db->insert('admin_chat',$data);
		$lastid= $this->db->insert_id();
		$this->db->where('message_by',$this->input->post("id"));
		$this->db->where('message_to',$id);
		$this->db->update('admin_chat', array('read_status' =>'1'));
		return $lastid;		
	}

	

	public function sal_login() {
		$this->db->select('*');
		$this->db->from('sal_login');
		$this->db->order_by("uid", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();

		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->order_by("id", "desc");
		$querys = $this->db->get();
		$user = $querys->result_array();
		$counts = array('sales' => $resultarray, 'users' => count($user));
		return $counts;
	}

	public function unq_edit_task() {
		$task_id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->where('id', $task_id);
		$query = $this->db->get();
		$result = $query->result_array();
		foreach ($result as $key => $row) {
			$staff_id = $row['staff_id'];

			$this->db->select('*');
			$this->db->from('sal_login');
			$this->db->where('uid', $staff_id);
			$query1 = $this->db->get();
			$result[$key]['staff_detail'] = $query1->row_array();
		}
		return $result;
	}

	public function edit_sale_staff($task_id) {
		$data = array(
			'task_name' => $this->input->post('task_name'),
			'task_description' => $this->input->post('task_description'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
		);
		$result = array_filter($data);
		$this->db->where('id', $task_id);
		$this->db->update('sal_task', $result);
		return true;
	}

	public function save_stafflist() {

		$data = array(
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'contact' => $this->input->post('contact'),
			'last_sign_in_time' => $this->input->post('last_sign_in_time'),
			'sign_up_time' => $this->input->post('sign_up_time'),
		);
		$data = array_filter($data);
		$this->db->insert("sal_login", $data);
		return true;
	}

	function active_task($id) {
		$this->db->set('status', '1');
		$this->db->where('uid', $id);
		$this->db->update("sal_login");
	}

	function deactive_task($id) {
		$this->db->set('status', '0');
		$this->db->where('uid', $id);
		$this->db->update("sal_login");
	}

	public function edit_staffmember() {
		$staff_id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('sal_login');
		$this->db->where('uid', $staff_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function edit_staff_member($staff_id) {
		$data = array(
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'contact' => $this->input->post('contact'),
		);
		$result = array_filter($data);
		$this->db->where('uid', $staff_id);
		$this->db->update('sal_login', $result);
		return true;
	}

	public function delete_staff($staffid) {
		$this->db->where('uid', $staffid);
		$this->db->delete('sal_login');
	}

	function active_product($id) {
		$this->db->set('status', '1');
		$this->db->where('id', $id);
		$this->db->update("cp_products");
	}

	function deactive_product($id) {
		$this->db->set('status', '0');
		$this->db->where('id', $id);
		$this->db->update("cp_products");
	}

	public function delete_product($productid) {
		$this->db->where('id', $productid);
		$this->db->delete('cp_products');
	}
		public function general_sales() {
		
		$this->db->select('*');
		$this->db->from('uf_general_sale');
		$this->db->limit(100);
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}
		public function getDataWhere($table,$where) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
	}


function getCompActive(){

$query=$this->db->query("select count(id) as count from uf_general_sale where comp = 1");
    $row=$query->result();

    return $row;
}


function insertTransaction($data){
		$this->db->insert("transactions", $data);

}

		public function getUsers() {
		
		$query=$this->db->query("select user_name,logo,display_name,email,title,is_verify,state,city,street,mob_number,address,zip,profile_pic,created_at from uf_user where is_verify = '1' ");
    		$result = $query->result_array();
    		return $result;


	}


	public function insertCsvData($table,$data) {
	
		//$data = array_filter($data);
		//$this->db->where("ad_id",$this->input->post('ad_id'));
		// echo "<pre>"; print_r($data);
		// die();
		$this->db->insert($table, $data);
		return true;
		echo "<pre>"; print_r($data);
		die();
	}

}
