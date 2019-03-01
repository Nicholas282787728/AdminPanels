<?php
ob_start();
class Dashboard_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function admin_login($username, $password) {
		$pwd = MD5($password);
		$sql = "select * from uf_user where (email = '" . $username . "' OR user_name  = '" . $username . "') and password = '" . $pwd . "' ";
		$query = $this->db->query($sql);
		$resultarray = $query->row_array();
		return $resultarray;
	}
 
	function update_last_login($id) {
		$data = array('last_login' => date('Y-m-d H:i:s'),'on_off_status' =>'1');
		
		$this->db->where("id", $id);
		$this->db->update("uf_user", $data);
		return true;
	}
	function update_documentSeeStatus($id) {
		$data = array('seeStatus' => '0');
		
		$this->db->where("id", $id);
		$this->db->update("uf_user_doc_store", $data);
		return true;
	}
	
	 public function record_count($table) {
        return $this->db->count_all($table);
    }
	
	function admin_login_token($username, $auth_token) {
		$resultarray = array();
		$sql = "select * from uf_user where email = '" . $username . "' and secret_token = '" . $auth_token . "' and is_verify = '1'";
		$query = $this->db->query($sql);
		$resultarray = $query->row_array();
		return $resultarray;
	}

	
		function documentVerificationStatusOnOff() {
		$resultarray = array();
		//	$query = $this->db->query("SELECT s.*, s.id as ind,u.* from `uf_user_doc_store` as s LEFT JOIN `uf_user` as u ON s.user_id= u.id where status = '0'  AND store_id = '$userId' "); 
		//$sql = "select docs.*,docs.id as ind,u.* from uf_user_doc_store as docs inner join notification_history as noti on  docs.id=noti.verficationId inner join uf_user as u on docs.user_id=u.id where docs.seeStatus = '1'";
		$sql ="select  distinct (docs.id) as ind,docs.*,u.* from uf_user_doc_store as docs inner join notification_history as noti on  docs.id=noti.verficationId inner join uf_user as u on docs.user_id=u.id where docs.seeStatus = '2'";
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}


		function citySateAprovedStore() {
		$resultarray = array();
		
		//$sql ="select distinct (city),state,stateCityStatus from uf_user where user_type = '3'";
		// $sql = "select distinct (city),state,stateCityStatus from uf_user where user_type = '3' AND city <>''  order by state ASC";
		$sql = "select distinct (state) from uf_user where user_type = '3' AND city <>''  order by state ASC";
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}

			function citySateAprovedOndemand() {
		$resultarray = array();
		
		//$sql ="select distinct (city),state,stateCityStatus from uf_user where user_type = '3'";
		// $sql = "select distinct (city),state,stateCityStatus from uf_user where user_type = '3' AND city <>''  order by state ASC";
		$sql = "select distinct (state) from uf_user where user_type = '1' AND city <>''  order by state ASC";
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}

			function citySateAprovedDoctor() {
		$resultarray = array();
		
		//$sql ="select distinct (city),state,stateCityStatus from uf_user where user_type = '3'";
		// $sql = "select distinct (city),state,stateCityStatus from uf_user where user_type = '3' AND city <>''  order by state ASC";
		$sql = "select distinct (state) from uf_user where user_type = '2' AND city <>''  order by state ASC";
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}




	

	function getfaq_ask_que() {
		$query = $this->db->get('faq_ask_que');
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function alluser($limit, $start,$type) {
//		$this->db->select('*');
//		$this->db->from('uf_user');
//		$this->db->order_by("id", "desc");
//		$this->db->where_in("user_type", array(0,1,2,3));
//		if(isset($_POST['type'])){
//			$this->db->where("title", $_POST['type']);
//		}
//		
//		if(@$_POST['type'] != "User")
//		{
//			$this->db->where("is_verify", 1);
//		}
//		$query = $this->db->get();
//		$resultarray = $query->result_array();
//		return $resultarray;	

		$this->db->select('uf_user.*,count(sal_task.id) as totals,count(case when sal_task.status="1" then 1 end) as completed');
		$this->db->from('uf_user');
		$this->db->join('sal_task', 'sal_task.staff_id = uf_user.id', 'left');
		$this->db->where_in("uf_user.user_type", array(0, 1, 2, 3));
		if (isset($_POST['type'])) {

			$post = $_POST['type'];


			$this->db->where("uf_user.user_type", $_POST['type']);
		}
		// else if (@$_POST['type'] != "User") {
		// 	$this->db->where("uf_user.is_verify", 1);
		// }
		$this->db->order_by("id", "desc");
		$this->db->group_by("uf_user.id");
		 $this->db->limit($limit, $start);

		$query = $this->db->get();
		$resultarray = $query->result_array();
		
		return $resultarray;
	}
	
	public function get_provider_specific($user_type)
	{
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where("user_type",$user_type);
		if ($user_type != 0) { // users
			$this->db->where("is_verify", 1);
		}
		$this->db->where("flag_enabled", 1);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}
	public function get_provider_specificview($user_type)
	{
		$this->db->select('uf_user.*,count(sal_task.id) as totals,count(case when sal_task.status="1" then 1 end) as completed,(select avg(r.rating) FROM uf_user_rating r where r.store_id=uf_user.id) as ratingavg');
		$this->db->from('uf_user');
		$this->db->join('sal_task', 'sal_task.staff_id = uf_user.id', 'left');
		$this->db->where("uf_user.user_type",$user_type);
		$this->db->where("uf_user.is_verify", 1);
		$this->db->where("uf_user.flag_enabled", 1);
		//$this->db->order_by("uf_user.id", "desc");
		$this->db->order_by("ratingavg", "asc");
		$this->db->limit(1000);
		$this->db->group_by("uf_user.id");
		$query = $this->db->get();
		$resultarray = $query->result_array();
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

	public function list_ticket_data() {
		$count_list = $this->input->post('count_list');
		$this->db->select('*');
		$this->db->from('ost_ticket__cdata');
		if ($count_list != "") {
			$this->db->where("status", $count_list);
		}
		$this->db->order_by("created_date", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function ticket_count() {
		$this->db->select("COUNT(status) as all_ticket, COUNT(IF(status=0,1,NULL)) as padding, COUNT(IF(status=1,1,NULL)) as process, COUNT(IF(status=2,1,NULL)) as completed");
		$this->db->from('ost_ticket__cdata');
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}
	public function totalprovider_count() {
		$this->db->select("COUNT(id) as totalprovider_count");
		$this->db->from('uf_user');
		$this->db->where_in('user_type',array(1,2,3));
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}
	public function Promocode_count() {
		$this->db->select("COUNT(id) as promocode_userwise_count");
		$this->db->from('uf_promo_codes');
		$this->db->where("created_by", $this->session->userdata('id'));
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function edit_tickit_data($id) {
		$this->db->select('*');
		$this->db->from('ost_ticket__cdata');
		$this->db->where("ticket_id", $id);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}
	
	public function view_chat()
	{
		$sql = "SELECT a.message,a.message_to,a.message_by,a.msg_id,uf_user.user_name,uf_user.email,uf_user.id FROM `uf_user` Left join (Select * from admin_chat order by msg_id desc) as a on uf_user.id = a.message_by group by uf_user.id";
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}
	

	public function alluserpandding_provider() {
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->order_by("id", "desc");
		if (isset($_POST['type'])) 
		{
			$this->db->where("title", $_POST['type']);
		}
		$this->db->where("is_verify", '0');
		$this->db->where_in("user_type", array(1,2,3,4,10));
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}
	public function get_Pendding_interviews() {
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->order_by("id", "desc");
		$this->db->where("is_verify", '0');
		$this->db->where("user_type", 4);
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function getdataconfigration($nm) {
		$this->db->select('*');
		$this->db->from('uf_configuration');
		$this->db->where("name", $nm);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function get_username($nm) {
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where("id", $nm);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function staff_task_deatils($id) {
		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->where("staff_id", $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
//		return $resultarray;	

		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->join('uf_user', 'uf_user.id = sal_task.staff_id');
		$this->db->where("sal_task.staff_id", $id);
		$this->db->group_by("sal_task.staff_id");
		$querys = $this->db->get();
		$user = $querys->row_array();
		$alldata = array('sales_task' => $resultarray, 'user_name_join' => $user);
		return $alldata;
	}

	public function list_ticket_comment($id) {
		$this->db->select('*');
		$this->db->from('ticket_comment');
		$this->db->join('uf_user', 'uf_user.id =  ticket_comment.commentator_id', 'left');
		$this->db->where("ticket_comment.ticket_id", $id);
		$this->db->order_by("ticket_comment.created_date", 'desc');
		$querys = $this->db->get();
		$resultarray = $querys->result_array();
		return $resultarray;
	}

	public function ticket_file($id)
	{
		
		$this->db->select('*');
		$this->db->from('ost_ticket__cdata');
		$this->db->where('ticket_id',$id);
		$query = $this->db->get();
        return $query->row();
	}

	public function update_configration($id, $datas) {
		$this->db->where("id", $id);
		$this->db->update("uf_configuration", $datas);
		return true;
	}

	//------------------------------------------------------
	public function userdetail() {
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where("id", $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function catdetail() {
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('uf_categories');
		$this->db->where("id", $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}


   public function ourteamDetail() {
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('uf_our_team');
		$this->db->where("id", $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function Subcatdetail() {
		$id = $this->input->post('id');
		$this->db->select('uf_categories_sub.*,uf_categories.name as maincategory_nm ,uf_user.user_type');
		$this->db->from('uf_categories_sub');
		$this->db->join('uf_categories', 'uf_categories.id = uf_categories_sub.uf_categories_id');
		$this->db->join('uf_user', 'uf_user.id = uf_categories_sub.user_id', 'left');
		$this->db->where("uf_categories_sub.id", $id);
		$this->db->order_by("uf_categories_sub.id", "desc");
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function user_count_typedata() {
		$sql = "SELECT count(case when user_type in ('1','2','3') then 1 end) as provider,count(case when user_type='4' then 1 end) as sales FROM `uf_user` where `is_verify` = '1'";
		$query = $this->db->query($sql);
		$resultarray = $query->row();
		return $resultarray;
	}

	public function aut_users_detail() {
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where("id", $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->row_array();
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

	public function user_reg() {
		$type = $this->input->post('provider_type');
		if ($this->input->post('provider_type') == '1') {
			$user = 'Driver';
		} elseif ($this->input->post('provider_type') == '2') {
			$user = 'Doctor';
		} elseif ($this->input->post('provider_type') == '3') {
			$user = 'Store';
		} elseif ($this->input->post('provider_type') == '4') {
			$user = 'Sales';
		}

		$data = array(
			'user_name' => $this->input->post('user_name'),
			'display_name' => $this->input->post('display_name'),
			'email' => $this->input->post('email'),
			'title' => $user,
			'user_type' => $type,
			'password' => MD5($this->input->post('password'))
		);

		$this->db->insert('uf_user', $data);
		$userid = $this->db->insert_id();
		if (!empty($userid)) {
			return $userid;
		} else {
			return false;
		}
	}

	public function add_user() {
		
		$user_type = $this->input->post('user_type');
		$title="";
		if($user_type == 1){
			$title="Driver";	
		}elseif($user_type == 2){
			$title="Doctor";
		}elseif($user_type == 3){
			$title="Storefront";
		}
		
		
		
		$data = array(
			'user_name'		=> $this->input->post('user_name'),
			'display_name'  => $this->input->post('display_name'),
			'title' => $title,
			'user_type' => $this->input->post('user_type'),
			'email' => $this->input->post('email'),
			'mob_number'=> $this->input->post('contact'),
			'password'	=> md5($this->input->post('email')),
			'flag_password_reset' => 1,
			'flag_enabled'	=> 0,
			'flag_verified' => "1",
			'is_verify' => "1",
			'addDate' => date('Y-m-d')
		);
		$data = array_filter($data);
		$this->db->insert("uf_user", $data);
		return sha1($this->input->post('email'));
	}
	public function updateGeneralSaleUser() {
		




if($this->input->post('comp') == 1){

		$compStartDate = date("Y-m-d");
				$comstartendtime = date("H:i:s");
    			$compEndDate = date('Y-m-d', strtotime($date. ' + 13 days'));
    				$data = array(
					'email' => $this->input->post('email'),
					'contact_no' => $this->input->post('contactno'),
					'zip_code' => $this->input->post('zip'),
					'location_name' => $this->input->post('location_name'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'provider_type' => $this->input->post('provider_type'),
					'comp' => $this->input->post('comp'),
					'compStartDate' => $compStartDate,
					'comstartendtime'=>$comstartendtime,
					'compEndDate' => $compEndDate
			
		
		);
}
else{
		$data = array(
					'email' => $this->input->post('email'),
					'contact_no' => $this->input->post('contactno'),
					'zip_code' => $this->input->post('zip'),
					'location_name' => $this->input->post('location_name'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'provider_type' => $this->input->post('provider_type'),
					'comp' => $this->input->post('comp'),
					'compStartDate' => '',
					'comstartendtime'=>'',
					'compEndDate' => ''
			
		
		);
}


	
	


		//$data = array_filter($data);
		$this->db->where("id", $this->input->post('id'));
		$this->db->update("uf_general_sale", $data);
		return true;
	}
	public function update_user() {
		
		$user_type = $this->input->post('user_type');
		$title="";
		if($user_type == 1){
			$title="Driver";	
		}elseif($user_type == 2){
			$title="Doctor";
		}elseif($user_type == 3){
			$title="Storefront";
		}
		
		$data = array(
			'user_name'		=> $this->input->post('user_name'),
			'display_name'	=> $this->input->post('display_name'),
			'title' => $title,
			'user_type' => $this->input->post('user_type'),
			'email' => $this->input->post('email'),
			'mob_number'=> $this->input->post('contact'),
//			'password'	=> md5($this->input->post('email')),
//			'flag_password_reset' => 1,
		);
		$data = array_filter($data);
		$this->db->where("id", $this->input->post('user_id'));
		$this->db->update("uf_user", $data);
		return true;
	}

	public function allpromo() {
		$this->db->select('*, (select display_name FROM uf_user WHERE uf_user.id = uf_promo_codes.created_by) as created_by');
		$this->db->from('uf_promo_codes');
		$this->db->where("created_by", $this->session->userdata('id'));
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function promodetail() {
		$id = $this->input->post('id');
		$this->db->select('*, (select display_name FROM uf_user WHERE uf_user.id = uf_promo_codes.created_by) as created_by_name');
		$this->db->from('uf_promo_codes');
		$this->db->where("id", $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function save_promo() {
		$data = array(
			'code'	=> $this->input->post('code'),
			'type'	=> $this->input->post('type'),
			'offer' => $this->input->post('offer'),
			'description'	=> $this->input->post('description'),
			'service_type'	=> $this->input->post('service_type'),
			'start' => $this->input->post('starts'),
			'end'	=> $this->input->post('ends'),
			'created_by' => $this->session->userdata('id'),
		);

		$data = array_filter($data);
		$this->db->insert("uf_promo_codes", $data);
		return true;
	}

	public function saveReferralCode($table,$data) {
		

		//$data = array_filter($data);
		$this->db->insert($table, $data);
		return true;
	}

public function advertisements() {
		$this->db->select('*');
		$this->db->from('sal_advertisement');
		
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}
public function checkReferralCode($table) {
		$this->db->select('*');
		$this->db->from($table);
		
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}
public function updateReferralCode($table,$data,$where) {

		//$data = array_filter($data);

		$this->db->where($where);
		$this->db->update($table,$data);
		return true;
	}


// public function updateReferralCode1($table,$data,$where) {

// 		$data = array_filter($data);
// 		$this->db->where($where);
// 		$this->db->update($table,$data);
// 		return true;
// 	}

	public function update_promo($id) {
		$data = array(
			'code'	=> $this->input->post('code'),
			'type'	=> $this->input->post('type'),
			'offer' => $this->input->post('offer'),
			'description'	=> $this->input->post('description'),
			'service_type'	=> $this->input->post('service_type'),
			'start' => date('Y-m-d', strtotime($this->input->post('starts'))),
			'end'	=> date('Y-m-d', strtotime($this->input->post('ends'))),
			'created_by' => $this->session->userdata('id'),
		);
		$data = array_filter($data);
		$this->db->where("id", $id);
		$this->db->update("uf_promo_codes", $data);
		return true;
	}

	public function allservicelist($checkservice) {
		$this->db->select('*');
		$this->db->from('uf_promo_codes');
		$this->db->where("service_type", $checkservice);
		$this->db->where("created_by", $this->session->userdata('id'));
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function sendmassage() {
		$id = $this->session->userdata('id');
		$data = array(
			"message_to"	=> $this->input->post("id"),
			"message_by"	=> $id,
			"sender_name"	=> 'Admin',
			"message"		=> $this->input->post("message"),
			"message_date"	=> date("Y-m-d H:m:s"),
		);
		$this->db->insert('admin_chat', $data);
		$lastid = $this->db->insert_id();
		$this->db->where('message_by',$this->input->post("id"));
		$this->db->where('message_to',$id);
		$this->db->update('admin_chat', array('read_status' =>'1'));
		return $lastid;
	}

	public function chat_history_backup()
	{
		$id=$this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->where("message_by",$id);
		$this->db->or_where("message_to",$id);
		$this->db->order_by("msg_id", "asc");
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;
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
	public function chat_history_userwise($id)
	{
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->join('uf_user', 'uf_user.id = admin_chat.message_by', 'left');
		$this->db->where("message_by",$id);
		$this->db->or_where("message_to",$id);
		$this->db->order_by("msg_id", "asc");
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;
	}
	
	public function notification_history($limit) {
		// $this->db->select('*,notification_history.id as notification_id');
		// $this->db->from('notification_history');
		// $this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		// $this->db->where('notification_history.read_status', "0");
		// $this->db->order_by("notification_history.id", "desc");
		// if ($limit != 0) {
		// 	$this->db->limit(5);
		// }
		// $query = $this->db->get();


		$sql = "select *,notification_history.id as notification_id from notification_history inner join uf_user on uf_user.id = notification_history.user_id where notification_history.read_status = '0' AND message = 'Congratulations! Sign Up Successful. Please Check Your Email for Verification Link.' or ((message = 'Advertisement Is Sold Successfully. Weekly Specials') or (message = 'Advertisement Deleted Successfully. Platinum')) or (message = 'Congratulations! Sign Up Successful. Please Check Pending Providers Salesteam')";
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}





	public function notification_historyAll() {
		// $this->db->select('*,notification_history.id as notification_id');
		// $this->db->from('notification_history');
		// $this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		// $this->db->order_by("notification_history.id", "desc");
		// $query = $this->db->get();
			$sql = "select *,notification_history.id as notification_id from notification_history inner join uf_user on uf_user.id = notification_history.user_id where notification_history.read_status = '0' AND message = 'Congratulations! Sign Up Successful. Please Check Your Email for Verification Link.' or ((message = 'Advertisement Is Sold Successfully. Weekly Specials') or (message = 'Advertisement Deleted Successfully. Platinum')) or (message = 'Congratulations! Sign Up Successful. Please Check Pending Providers Salesteam')";
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function standard_services($type) {
		$this->db->select('*');
		$this->db->from('cp_our_services');
		$this->db->where('cp_our_services.services_id', $type);
		$this->db->order_by("cp_our_services.services_id", "desc");
		$this->db->join('cp_services_content', 'cp_services_content.services_id_fk = cp_our_services.services_id', 'left');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function savecontent($type) {
		$data = array(
			"services_id_fk " => $type,
			"services_content " => $this->input->post('content'),
		);
		//print_r($data);die;	
		$this->db->insert('cp_services_content', $data);
		$lastid = $this->db->insert_id();
		return $lastid;
	}

	public function updatecontent($id) {
		$data = array(
			"services_content " => $this->input->post('content'),
		);
		$data = array_filter($data);
		$this->db->where("services_content_id", $id);
		$this->db->update("cp_services_content", $data);
		return true;
	}

	public function service_details() {
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('cp_services_content');
		$this->db->where("services_content_id", $id);
		$this->db->order_by("services_content_id", "desc");
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}
	public function edit_faqaskque() {
		$id = $this->input->post('id');
		$this->db->where('f_id',$id);
		$query = $this->db->get('faq_ask_que');
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function savetos($type) {
		$data = array(
			"state_id"=>$type,
			"section " => $type,
			"content " => $this->input->post('content'),
		);
		
		$this->db->where('section', $type);
		$query = $this->db->get('uf_tos');
		$resultarray = $query->num_rows();
		if($resultarray == 0)
		{
			$this->db->insert('uf_tos', $data);
		}
		else
		{
			$this->db->where('section', $type);
			$this->db->update('uf_tos', $data);
		}
		
		return $type;
	}
	public function WebSaveTos($section)
	{
		$id=$this->input->post('term_id');
		$state_id=$this->input->post('state_id');
		 $data = array(
			"state_id"=>$this->input->post('state_id'),
			"section " => $section,
			"content " => $this->input->post('content'),
			"user_id " => $this->session->userdata('id')
		  );
		if(!empty($id)){

           $this->db->where('id',$id);
           $this->db->update('uf_tos', $data);
		}else{
			$this->db->insert('uf_tos', $data);
		}
		return $state_id;
		
	}
	public function optSave($section,$id,$content)
	{
		 $data = array(
			"section " => $section,
			"content " => $content,
			"user_id " => $this->session->userdata('id')
		  );
		if(!empty($id)){

           $this->db->where('id',$id);
           $this->db->update('uf_tos', $data);
		}else{
			$this->db->insert('uf_tos', $data);
		}
		return true;
		
	}

	public function all_states()
	{
		$this->db->select('*');
		$this->db->from('all_states');
		$query=$this->db->get();
		return $query->result();
	}
	public function get_condition($type) {
		
		$this->db->where('section', $type);
		$query = $this->db->get('uf_tos');
		$resultarray = $query->row_array();
		return $resultarray;
	}

	
	
	public function savetosdata($type) {
		$this->db->select('*');
		$this->db->from('uf_tos');
		$this->db->where('uf_tos.section', $type);
		$query = $this->db->get();
		$resultarray = $query->row_array();
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
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function msgnotification($limit) {
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("admin_chat.msg_id", "desc");
		$this->db->where("admin_chat.sender_name!=", "Admin");
		$this->db->where("admin_chat.status!=", "0");
		if ($limit != 0) {
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = admin_chat.message_by', 'left');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	/* 	public function add_staff(){

	  $data= array(
	  'user_name'=> $this->input->post('user_name'),
	  'display_name'=> $this->input->post('display_name'),
	  'title'=> $this->input->post('title'),
	  'email'=> $this->input->post('email'),
	  'mob_number'=> $this->input->post('contact'),
	  'pass_encrpt'=>sha1($this->input->post('email')),

	  );
	  $data = array_filter($data);
	  $this->db->insert("uf_user",$data);
	  return sha1($this->input->post('email'));
	  } */

	public function add_auth_user() {
		$user_type = $this->input->post('user_type');
		$title="";
		if($user_type == 5){
			$title="Admin";
		}elseif($user_type == 4){
			$title="Sales";
		}elseif($user_type == 6){
			$title="Promotions";
		}elseif($user_type == 7){
			$title="Marketing";
		}elseif($user_type == 8){
			$title="Development";
		}elseif($user_type == 9){
			$title="Editorial";
		}
		
		
		
		$data = array(
			'user_name'		=> $this->input->post('user_name'),
			'display_name'	=> $this->input->post('display_name'),
			'mob_number'	=> $this->input->post('contact'),
			'title' => $title,
			'email' => $this->input->post('email'),
			'secret_token'	=> md5($this->input->post('email')),
			'password'		=> md5($this->input->post('email')),
			'flag_enabled'	=> "1",
			'flag_verified' => "1",
			'is_verify' => "1",
			'user_type' => $user_type,
			'addDate' => date('Y-m-d')
		);
		$data = array_filter($data);
		$this->db->insert("uf_user", $data);
		return sha1($this->input->post('email'));
	}

	public function all_user() {
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function all_staff() {
		$this->db->select('*');
		$this->db->from('sal_login');
		$this->db->order_by("uid", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function all_auth_user() {
		$this->db->select('uf_user.*,count(sal_task.id) as totals,count(case when sal_task.status="1" then 1 end) as completed');
		$this->db->from('uf_user');
		$this->db->join('sal_task', 'sal_task.staff_id = uf_user.id', 'left');
//		$this->db->where("uf_user.user_type", "4");
		$this->db->where_in("uf_user.user_type", array(4,6,7,8,9));
		$this->db->order_by("uf_user.id", "desc");
		$this->db->group_by("uf_user.id");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}
	public function totalContractors() {
		$this->db->select('count(id) as totalcontractor');
		$this->db->from('uf_user');
		$this->db->where_in("user_type", array(4,6,7,8,9));
		$query = $this->db->get();
		$resultarray = $query->row();
		return $resultarray;
	}

	public function update_aut_user($id) {
		
		$user_type = $this->input->post('user_type');
		$title="";
		if($user_type == 5){
			$title="Admin";
		}elseif($user_type == 4){
			$title="Sales";
		}elseif($user_type == 6){
			$title="Promotions";
		}elseif($user_type == 7){
			$title="Marketing";
		}elseif($user_type == 8){
			$title="Development";
		}elseif($user_type == 9){
			$title="Editorial";
		}
		
		$data = array(
			'user_name'		=> $this->input->post('user_name'),
			'display_name'	=> $this->input->post('display_name'),
			'mob_number'	=> $this->input->post('contact'),
			'title' => $title,
			'email' => $this->input->post('email'),
			'user_type' => $user_type,
		);
		$data = array_filter($data);
		$this->db->where("id", $id);
		$this->db->update("uf_user", $data);
		return true;
	}

	public function save_task() {
		$data = array(
			'staff_id'		=> $this->input->post('staff_id'),
			'task_name'		=> $this->input->post('task_name'),
			'task_description'	=> $this->input->post('task_description'),
			'start_date'		=> $this->input->post('start_date'),
			'end_date'			=> $this->input->post('end_date'),
		);
		$data = array_filter($data);
		$this->db->insert("sal_task", $data); 
		return true;
	}

	public function savecat() {

		$data = array(
			'name'		=> $this->input->post('category_name'),
			'type'		=> $this->input->post('category_type'),
			'industry'	=> $this->input->post('industry'),
			'location'	=> $this->input->post('location'),
			'description'	=> $this->input->post('description'),
			'user_id'		=> $this->session->userdata('id'),
			'status'		=>'1'
		);
		$data = array_filter($data);
		$this->db->insert("uf_categories", $data);
		return true;
	}

	public function update_category($id) {
		$data = array(
			'name'		=> $this->input->post('category_name'),
			'user_id'	=> $this->session->userdata('id'),
		);
		$data = array_filter($data);
		$this->db->where("id", $id);
		$this->db->update("uf_categories", $data);
		return true;
	}

	public function update_Subcategory($id) {
		$data = array(
			'sub_category'		=> $this->input->post('sub_category'),
			'uf_categories_id'	=> $this->input->post('main_category'),
			'user_id'			=> $this->session->userdata('id'),
			'date'				=> date('Y-m-d H:i:s'),
		);

		$data = array_filter($data);
		$this->db->where("id", $id);
		$this->db->update(" uf_categories_sub", $data);
		return true;
	}

	public function getAllUsers($value = '') {
		$this->db->select('*');
		$this->db->from('uf_user');
		$query = $this->db->get();
		return $query->result();
	}

	public function check_sub_category($category_id) {
		$this->db->select('*');
		$this->db->from('uf_categories_sub');
		$this->db->where("uf_categories_id", $category_id);
		$query = $this->db->get();
		$resultarray = $query->num_rows();
		return $resultarray;
	}

	public function all_categories() {
		$this->db->select('*, (select display_name FROM uf_user WHERE uf_user.id = uf_categories.user_id) as created_by');
		$this->db->from('uf_categories');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

   public function all_Our_team()
   {
       	$this->db->select('*');
		$this->db->from('uf_our_team');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
  
   }
     public function all_background_images()
   {
       	$this->db->select('*');
		$this->db->from('cp_banner_slider');
		//$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
  
   }
    public function saveOurTeam($data)
   { 
		$data = array_filter($data);
		$this->db->insert("uf_our_team", $data);
		return true;
  
   }
    public function saveBackgroundImage($data)
   { 
		$data = array_filter($data);
		$this->db->insert("cp_banner_slider", $data);
		return true;
  
   }


	public function all_sub_categories() {
		$this->db->select('uf_categories_sub.*,uf_categories.name as maincategory_nm ,uf_user.user_type');
		$this->db->from('uf_categories_sub');
		$this->db->join('uf_categories', 'uf_categories.id = uf_categories_sub.uf_categories_id');
		$this->db->join('uf_user', 'uf_user.id = uf_categories_sub.user_id', 'left');
		$this->db->order_by("uf_categories_sub.id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function all_categories_enable() {
		$this->db->select('*, (select display_name FROM uf_user WHERE uf_user.id = uf_categories.user_id) as created_by');
		$this->db->from('uf_categories');
		$this->db->where("status", 1);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function saveSubcat() {
		$data = array(
			'sub_category'		=> $this->input->post('sub_category'),
			'uf_categories_id'	=> $this->input->post('main_category'),
			'user_id'			=> $this->session->userdata('id'),
			'date'				=> date('Y-m-d H:i:s'),
			'status'				=> '1',
		);
		$data = array_filter($data);
		$this->db->insert("uf_categories_sub", $data);
		return true;
	}

	public function all_task() {
		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->order_by("sal_task.id", "desc");
		$this->db->join('sal_login', 'sal_login.uid = sal_task.staff_id', 'left');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}
	
	public function user_count() 
	{
	
		$querys_where='AND created_at BETWEEN NOW() - INTERVAL 10 DAY AND NOW()';
		if(!empty($_POST))
		{
			$startdate	=	$this->input->post('startdate');
			$enddate	=	$this->input->post('enddate');
			$querys_where='AND created_at >="'.$startdate.'" AND created_at <="'.$enddate.'"';
		}
		$sql = "SELECT  CAST(`created_at` AS DATE) as dates,device_type,count(case when device_type='1' then 1 end) as ios,count(case when device_type='0' then 1 end) as android  FROM `uf_user` WHERE `is_verify` = '1' ".$querys_where." GROUP BY `dates` ";
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
		
		
	}
	
	public function usertype_count() 
	{

		$querys_where='AND created_at BETWEEN NOW() - INTERVAL 10 DAY AND NOW()';
		if(!empty($_POST))
		{
			$startdate	=	$this->input->post('startdate');
			$enddate	=	$this->input->post('enddate');
			$querys_where='AND created_at >="'.$startdate.'" AND created_at <="'.$enddate.'"';
		}
		$sql = "SELECT  CAST(`created_at` AS DATE) as dates,user_type,count(case when user_type='3' then 1 end) as store_count,count(case when user_type='2' then 1 end) as docotor_count,count(case when user_type='1' then 1 end) as driver_count FROM `uf_user` WHERE `is_verify` = '1' ".$querys_where." GROUP BY `dates` ";
		
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}
	public function Provider_usertype_count() 
	{
		$querys_where='AND created_at BETWEEN NOW() - INTERVAL 10 DAY AND NOW()';
		if(!empty($_POST))
		{
			$startdate	=	$this->input->post('startdate');
			$enddate	=	$this->input->post('enddate');
			$querys_where='AND created_at >="'.$startdate.'" AND created_at <="'.$enddate.'"';
		}
		$sql = "SELECT CAST(`created_at` AS DATE) as dates,count(case when user_type in ('1','2','3') then 1 end) as provider,count(*) as users FROM `uf_user` where `is_verify` = '1' ".$querys_where." GROUP BY `dates` order by id asc";
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}

	

	public function unq_edit_sales($sales_id) {
		$this->db->select('*');
		$this->db->from('sal_login');
		$this->db->where('uid', $sales_id);
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function edit_sale($sales_id) {
		$data = array(
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'contact' => $this->input->post('contact'),
		);
		$result = array_filter($data);
		$this->db->where('uid', $sales_id);
		$this->db->update('sal_login', $result);
		return true;
	}

	public function unq_category($category_id) {
		$this->db->select('*');
		$this->db->from('uf_categories');
		$this->db->where('id', $category_id);
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function edit_category($category_id) {
		$data = array(
			'name' => $this->input->post('name'),
		);
		$result = array_filter($data);
		$this->db->where('id', $category_id);
		$this->db->update('uf_categories', $result);
		return true;
	}

	public function delete_category($category_id) {
		$this->db->where('id', $category_id);
		$this->db->delete('uf_categories');
	}

	public function delete_promo($promoid) {
		$this->db->where('id', $promoid);
		$this->db->delete('uf_promo_codes');
	}
	public function uf_user_remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('uf_user');
		return true;
	}

	public function getId() 
	{
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->where('message_by !=', '1');
		$this->db->order_by("msg_id", "desc");
		$this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->row();
	}
	public function getAdminIds($where)
   {
      $this->db->select('*');
      $this->db->from('uf_user');
      $this->db->where('user_type != 5');
      $this->db->where('email !=""');
      $query= $this->db->get();
      $data =$query->result();
      return $data;
   }
   public function update_logout($id)
   {
     	$data = array('on_off_status' =>'0');
		$this->db->where("id", $id);
		$this->db->update("uf_user", $data);
		return true;
   }
   public function countUnreadMessages($id)
   {
   	$uid=$this->session->userdata('id');
   	 $this->db->select('*');
   	 $this->db->from('admin_chat');
   	 $this->db->where('message_to', $uid);
   	 $this->db->where('message_by', $id);
   	 $this->db->where('read_status', '0');
   	 $query= $this->db->get();
   	 return $query->num_rows();
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

	public function all_staff_attachement() {
		
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
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
	public function getAllDropZones()
	{
		$query=$this->db->select('*')->from('uf_dropzone')->get();
		if($query){
			return $query->result_array();
		}
	}
	public function getDropzone() {
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('uf_dropzone');
		$this->db->where("id", $id);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	
	  public function ourBackgroundImage() {
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('cp_banner_slider');
		$this->db->where("id", $id);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}
     	public function getAffiliates()
	{
			//$sql = "select u.id,u.mob_number,u.email,u.is_verify,u.user_name,a.notes from uf_user as u inner join uf_affiliate_detail as a on u.id=a.user_id where u.user_type= '10'";
			$sql = "select *,u.id as user_id from uf_user as u inner join uf_affiliate_detail as a on u.id=a.user_id where u.user_type= '10'";
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;

		// $this->db->select('*');
		// $this->db->from('uf_user');
		// $this->db->where("user_type", '10');
		// $query = $this->db->get();
		// $resultarray = $query->result_array();
		// return $resultarray;
		
	}
		public function general_sales($limit, $start) {
		
		$this->db->select('*');
		$this->db->from('uf_general_sale');
        $this->db->limit($limit, $start);
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}
	public function getWhereMore($table,$where)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$query=$this->db->get();
		if($query){
			return $query->result_array();
		}else{
	       return false;
		}

	}
	public function getDataWhere($table,$where) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
	}
	public function getUpdatedData($table,$data,$where)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
		return true;
	}

		public function pendingUpgrades() {
	
			///$sql = "select doc.*,u.display_name,u.state,u.email,u.socialid from uf_user_documents as doc inner join uf_user as u on doc.user_id=u.id where u.user_type='1'";
			$sql = "select distinct (user_id) as id,u.display_name,u.state,u.email,u.socialid,doc.document_status from uf_user_documents as doc inner join uf_user as u on doc.user_id=u.id where u.user_type='1'	";
			
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;

		// $this->db->select('*');
		// $this->db->from('uf_user');
		// $this->db->order_by("id", "desc");
	
		// $this->db->where("user_type", 1);
		// $query = $this->db->get();
		// $resultarray = $query->result_array();
		// return $resultarray;
	
	}






		public function getTermsAndCondtion($table,$where) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function countries($table) {
		$this->db->select('*');
		$this->db->from($table);
		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	

}