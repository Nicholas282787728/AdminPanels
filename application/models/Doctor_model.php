<?php

class Doctor_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function doctor_login($username, $password) {

		$resultarray = array();
		$pwd = MD5($password);
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where('email', $username);
		$this->db->where('password', $pwd);
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

	public function edit_tickit_data($id) {
		$this->db->select('*');
		$this->db->from('ost_ticket__cdata');
		$this->db->where("ticket_id", $id);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function edit_payout_data($id) {
		$this->db->select('*');
		$this->db->from('payout_details');
		$this->db->where("payout_id", $id);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
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

	public function list_ticket_data()
	{
		$count_list = $this->input->post('count_list');
		$this->db->select('*');
		$this->db->from('ost_ticket__cdata');
		if ($count_list != "") {
			$this->db->where("status", $count_list);
		}
		$this->db->where("user_id", $this->session->userdata('id'));
		$this->db->order_by("created_date", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function ticket_count() 
	{
		$this->db->select("COUNT(status) as all_ticket,COUNT(IF(status=0,1,NULL)) as padding,COUNT(IF(status=1,1,NULL)) as process,COUNT(IF(status=2,1,NULL)) as completed");
		$this->db->from('ost_ticket__cdata');
		$this->db->where("user_id", $this->session->userdata('id'));
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function historyData($table = '', $where) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function deletRecord($table = '', $where) {
		$this->db->where($where);
		$this->db->delete($table);
		return true;
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

	public function sendmassage() {
		$id = $this->session->userdata('id');
		$data = array(
			"message_to" => $this->input->post("id"),
			"message_by" => $id,
			"sender_name" => '',
			"message" => $this->input->post("message"),
			"message_date" => date("Y-m-d H:m:s"),
		);
		$this->db->insert('admin_chat', $data);
		$lastid = $this->db->insert_id();
		return $lastid;
	}

	public function chat_history($sid) {
		$id = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("msg_id", "asc");
		$this->db->group_start();
		$this->db->where("message_by", $id);
		$this->db->or_where("message_to", $id);
		$this->db->group_end();
		$this->db->group_start();
		$this->db->where("message_by", $sid);
		$this->db->or_where("message_to", $sid);
		$this->db->group_end();

		$query = $this->db->get();
		//echo $this->db->last_query();
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

	public function getdata_complimentaryAd() {
		$this->db->select('*');
		$this->db->from('cp_complimentary_ad');
		$this->db->where("user_id", $this->session->userdata('id'));
		$this->db->order_by("created_date", "desc");
		$query = $this->db->get();
		return $query->result();  //echo "<pre/>"; print_r($resultarray); die('m here');
	}

	public function editcomplimePanel() {
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('cp_complimentary_ad');
		$this->db->where("id", $id);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function insert_comp_ads($image) {
		$data = array(
			'user_id' => $this->session->userdata('id'),
			'title' => $this->input->post('title'),
			'ad_size' => $this->input->post('ad_size'),
			'description' => $this->input->post('description'),
			'created' => date("Y-m-d", strtotime($this->input->post('created'))),
			'created_date' => date("Y-m-d H:i:s"),
			'image' => $image
		);
		$data = array_filter($data);
		$this->db->insert("cp_complimentary_ad", $data);
		return true;
	}

	public function update_comp($img) {
		$data = array(
			'title' => $this->input->post('title'),
			'ad_size' => $this->input->post('ad_size'),
			'description' => $this->input->post('description'),
			'created' => date("Y-m-d", strtotime($this->input->post('created'))),
			'image' => $img
		);
		$data = array_filter($data);
		$this->db->where("id", $this->input->post('ad_id'));
		$this->db->update("cp_complimentary_ad", $data);
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
	
	public function getPayoutDetails() {
		$this->db->select('*');
		$this->db->from('payout_details');
		$this->db->where("user_id", $this->session->userdata('id'));
		$this->db->order_by("created_date", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	public function payments() {
		$this->db->select('SUM(amount) as total_amount');
		$this->db->from('payment_details');
		$this->db->where("user_id", $this->session->userdata('id'));
		$query = $this->db->get();
		return $query->row();
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

	public function getPendingApprovals() {
		$this->db->select('app_reservations.*,uf_user.display_name');
		$this->db->from('app_reservations');
		$this->db->join('uf_user', 'uf_user.id = app_reservations.user_id', 'left');
		$this->db->where("app_reservations.doctor_id", $this->session->userdata('id'));
		$this->db->where("app_reservations.accepted = '0' or app_reservations.accepted = '2'");
		$this->db->order_by("app_reservations.id", "desc");
		// print_r($this->db->last_query());	
		$query = $this->db->get();
		return $query->result();
	}

	public function getscheduling() {
		$this->db->select('app_reservations.*,uf_user.display_name');
		$this->db->from('app_reservations');
		$this->db->join('uf_user', 'uf_user.id = app_reservations.user_id', 'left');
		$this->db->where("app_reservations.doctor_id", $this->session->userdata('id'));
		$this->db->where("app_reservations.accepted", 1);
		$this->db->order_by("app_reservations.id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	public function edit_scheduling($id) {
		$this->db->select('*');
		$this->db->from('app_reservations');
		$this->db->where("id", $id);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function update_scheduling() {
		$data = array(
			'full_name' => $this->input->post('fullname'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('contact'),
			'date' => date('Y-m-d', strtotime($this->input->post('preferr_date'))),
			'time' => date('H:i A', strtotime($this->input->post('preffer_time'))),
		);
		$data = array_filter($data);
		$this->db->where("id", $this->input->post('scheduling_id'));
		$this->db->update("app_reservations", $data);
		return true;
	}

	public function get_view_like() {
		$this->db->select('*');
		$this->db->from('app_favorites');
		$this->db->join('uf_user', 'uf_user.id = app_favorites.user_id', 'left');
		$this->db->join('cp_products', 'cp_products.id = app_favorites.product_id', 'left');
		$this->db->where("app_favorites.user_id", $this->session->userdata('id'));
		$query = $this->db->get();
		return $query->result();
	}

	public function getSingleRecord($table = '', $id = '') {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function save_payout() {
		$data = array(
			'info_form' => $this->input->post('info_form'),
			'info_banking' => $this->input->post('info_banking'),
			'paypal_name' => $this->input->post('paypal_name'),
			'paypal_email' => $this->input->post('paypal_email'),
			'user_id' => $this->session->userdata('id'),
			'created_date' => date('Y-m-d H:i:s'),
		);
		$query = $this->db->insert('payout_details', $data);
		return $query;
	}

	public function update_payout() {
		$data = array(
			'info_form' => $this->input->post('info_form'),
			'info_banking' => $this->input->post('info_banking'),
			'paypal_name' => $this->input->post('paypal_name'),
			'paypal_email' => $this->input->post('paypal_email'),
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->db->where('payout_id', $this->input->post('payout_id'));
		$query = $this->db->update('payout_details', $data);
		return $query;
	}

	public function update_data($table, $data_arr, $where_arr) {
		$this->db->where($where_arr);
		$query = $this->db->update($table, $data_arr);
		return $query;
	}

	public function get_visibility_data($user_id) {
		$this->db->select('cp_locations.*,uf_user.on_off_status,uf_user.opt_in_out');
		$this->db->from('cp_locations');
		$this->db->join('uf_user', 'uf_user.id = cp_locations.user_id', 'left');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function orders($driver_id) {//ondemand check 
		$sql = "SELECT *,`id` as `order_id`, (SELECT count(*) FROM `app_orders` WHERE `order_id` = `order_id`) as `total_products` FROM `app_order_detail` WHERE `driver_id` = $driver_id ";
		$query = $this->db->query($sql);
		// echo $this->db->last_query();
		// exit;
		$res = $query->result_array();
		return $res;
	}

}