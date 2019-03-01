<?php

class Store_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function admin_login($username, $password) {

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

	public function notification_history($limit, $id = '') {
		$this->db->select('*');
		$this->db->from('notification_history');
		$this->db->order_by("notification_history.id", "desc");
		if ($limit != 0) {
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		$this->db->where('uf_user.id', $id);
		$this->db->where('notification_history.read_status', '0');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function notification_history_user($limit, $id) {
		$this->db->select('*');
		$this->db->from('notification_history');
		$this->db->order_by("notification_history.id", "desc");
		if ($limit != 0) {
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		$this->db->where('uf_user.id', $id);
		$this->db->where('notification_history.read_status', '0');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function tasknotification($limit, $id) {
		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->order_by("sal_task.id", "desc");
		if ($limit != 0) {
			$this->db->limit(5);
		}
		$this->db->join('sal_login', 'sal_login.uid = sal_task.staff_id', 'left');
		$this->db->where('sal_task.staff_id', $id);
		$this->db->where('sal_task.read_status', '0');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function tasknotification_message($limit, $id) {
		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->order_by("sal_task.id", "desc");
		if ($limit != 0) {
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = sal_task.staff_id', 'left');
		$this->db->where('sal_task.staff_id', $id);
		$this->db->where('sal_task.read_status', '0');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function task_list() {
		$id = $this->session->userdata('id');
		$this->db->select('sal_task.*');
		$this->db->from('sal_task');
		$this->db->order_by("sal_task.id", "desc");
		$this->db->join('uf_user', 'uf_user.id = sal_task.staff_id', 'left');
		$this->db->where('sal_task.staff_id', $id);
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function msgnotification($limit, $id) {
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("admin_chat.msg_id", "desc");
		$this->db->where("admin_chat.sender_name!=", "Admin");

		if ($limit != 0) {
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = admin_chat.message_by', 'left');
		$this->db->where("uf_user.id", $id);
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function msgnotification_message($limit, $id) {
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("admin_chat.msg_id", "desc");
		$this->db->where("admin_chat.sender_name !=", "Admin");

		if ($limit != 0) {
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = admin_chat.message_by', 'left');
		$this->db->where("uf_user.id", $id);
		$this->db->where("admin_chat.read_status", '0');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
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

	public function sendmassage() {
		//message  img uid settlestatus mid caseid username
		//INSERT INTO `tblmessagecases`( `CaseID`, `UserID`, `mid_id`, `SendDate`, `Message`, `attachment`) VALUES (
		$id = $this->session->userdata('id');
		$sql = "SELECT * FROM `uf_user` WHERE `user_type` = '5' limit 0,1 ";
		$query = $this->db->query($sql);
		$res = $query->row();
		$adminid = $res->id;

		$data = array(
			"message_to" => $this->input->post("id"),
			"message_by" => $id,
			"sender_name" => 'Admin',
			"message" => $this->input->post("message"),
			"message_date" => date("Y-m-d H:m:s"),
		);
		$this->db->insert('admin_chat', $data);
		$lastid = $this->db->insert_id();
		
		$this->db->where('message_by', $this->input->post("id"));
		$this->db->where('message_to', $id);
		$this->db->update('admin_chat', array('read_status' => '1'));
		return $lastid;
	}

	public function drivers() {

		$sql = "SELECT * FROM `uf_user` WHERE `title` = 'Driver' ";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}

	public function products($user_id) {

		// $sql = "SELECT (SELECT name FROM uf_categories WHERE cp_products.product_category=uf_categories.id Limit 1) as main,"
		// 		. " (SELECT sub_category FROM uf_categories_sub WHERE cp_products.product_sub_category =uf_categories_sub.id Limit 1) as sub ,cp_products.* FROM `cp_products` WHERE cp_products.user_id='$user_id' order by cp_products.id  desc ";

		
		//$sql = "SELECT uf_user.email as provideremail, uf_user.mob_number as providernumber,uf_categories.name as main, uf_categories_sub.sub_category as sub ,cp_products.* FROM `cp_products`join uf_categories on cp_products.product_category=uf_categories.id join uf_categories_sub on cp_products.product_sub_category =uf_categories_sub.id join uf_user  on cp_products.user_id=uf_user.id WHERE cp_products.user_id='$user_id' order by cp_products.id desc ";
		$sql = "SELECT uf_user.email as provideremail, uf_user.mob_number as providernumber,uf_categories.name as main ,cp_products.* FROM `cp_products`join uf_categories on cp_products.product_category=uf_categories.id join uf_user  on cp_products.user_id=uf_user.id WHERE cp_products.user_id='$user_id' order by cp_products.id desc";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}


	public function giftedProducts($random_code) {

	
		$sql = "select p.product_name,p.amt_d_price,p.image,g.* from cp_products as p inner join send_gift as g on p.id=g.product_id where random_code = '$random_code'";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}


	public function giftedAllProducts($userid,$type) {




	if($type == 'daily' ){
		$date = date('Y-m-d');
			$sql = "select p.product_name,p.amt_d_price,p.image,g.* from cp_products as p inner join send_gift as g on p.id=g.product_id where g.status = '1' AND claimeddate = '$date'";
	} else if ($type == 'weekly' ){
				
		$sql = "select p.product_name,p.amt_d_price,p.image,g.* from cp_products as p inner join send_gift as g on p.id=g.product_id where g.status = '1' AND claimeddate > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
	}
	else{
		$sql = "select p.product_name,p.amt_d_price,p.image,g.* from cp_products as p inner join send_gift as g on p.id=g.product_id where g.status = '1' ";
	}
		
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}


	function complete_product($id) {
		//$this->db->set('status', '1');
		$data = array('status'=> '1','claimeddate' => date('Y-m-d'));
		$this->db->where('id', $id);
		$this->db->update("send_gift",$data);
	}
	function userdetilUpdate($table,$userdata,$where) {
		$this->db->set($userdata);
		$this->db->where($where);
		$this->db->update($table);
	}
		function Deny_product($id) {
		$this->db->set('status', '2');
		$this->db->where('id', $id);
		$this->db->update("send_gift");
	}

	public function live_order($user_id) {
		

		$sql = "SELECT p.* ,a.order_id,a.price,a.order_date,a.delivery_info,a.quantity,"
				. " (SELECT name FROM uf_categories WHERE p.product_category = uf_categories.id Limit 1) as main,"
				. " (SELECT sub_category FROM uf_categories_sub WHERE p.product_sub_category = uf_categories_sub.id Limit 1) as sub,"
				. " a.user_id as orderUser,a.delivery_mode  FROM `cp_products` p "
				. "JOIN app_orders a on p.id = a.product_id WHERE a.provider_id=" . $user_id;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}

	public function All_products($user_id) {
		$sql = "SELECT * FROM `cp_products` WHERE `product_type` = 'Driver'  AND `location_id` = '$user_id' ";
		$query = $this->db->query($sql);
		$res = $query->result();
		return $res;
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





	public function add_product($data) {
		$this->db->insert('cp_products', $data);
		$productid = $this->db->insert_id();
		if (!empty($productid)) {
			$data = array(
				'product_id' => $productid,
				'k1' => $this->input->post('k1'),
				'k2' => $this->input->post('k2'),
				'k3' => $this->input->post('k3'),
             'k4' => $this->input->post('k4'),
				'k5' => $this->input->post('k5'),
              'k6' => $this->input->post('k6')
			);
			$this->db->insert('cp_product_size', $data);
			$productid = $this->db->insert_id();

			return $productid;
		} else {
			return false;
		}
	}

	public function update_product($data, $id) {
		
		$this->db->where('id', $id);
		$this->db->update('cp_products', $data);

		if (!empty($id)) {
			$data = array(
				'k1' => $this->input->post('k1'),
             'k2' => $this->input->post('k2'),
				'k3' => $this->input->post('k3'),
              'k4' => $this->input->post('k4'),
				'k5' => $this->input->post('k5'),
              'k6' => $this->input->post('k6')
			);
			$this->db->where('product_id', $id);
			$this->db->update('cp_product_size', $data);

			return true;
		} else {
			return false;
		}
	}

	public function getsubCategoryData($id) {
		$this->db->select('*');
		$this->db->from('uf_categories_sub');
		$this->db->where('status', '1');
		$this->db->where('uf_categories_id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function main_categories($category_name = "") {
		$sql = "1 = 1";
		if (!empty($category_name)) {
			$sql = " name = '$category_name'";
		}

		$categories_result = $this->db->query("SELECT * FROM `uf_categories` WHERE $sql");
		$result = $categories_result->result_array();
		return $result;
	}

	public function sub_categories($subcategory_name = "") {
		$sql = "1 = 1";
		if (!empty($subcategory_name)) {
			$sql = " sub_category = '$subcategory_name'";
		}

		$subcategories_result = $this->db->query("SELECT * FROM `uf_categories_sub` WHERE $sql LIMIT 1");
		$result = $subcategories_result->result_array();
		return $result;
	}

	// For bulk Product upload
	public function insert_category($data) {
		$this->db->insert('uf_categories', $data);
		return $id = $this->db->insert_id();
	}

	public function insert_sub_category($data) {
		$this->db->insert('uf_categories_sub', $data);
		return $id = $this->db->insert_id();
	}

	public function product_detail() {
		$id = $this->input->post('id');

		$this->db->select('cp_products.id as pid ,cp_products.*,cp_product_size.*');
		$this->db->from('cp_products');
		$this->db->join('cp_product_size', 'cp_products.id = cp_product_size.product_id');
		$this->db->where('cp_products.id', $id);

		$query = $this->db->get();
		$resultarray = $query->result_array();

		return $resultarray;
	}

	public function orders($driver_id) {
		$sql = "SELECT *,`id` as `order_id`, (SELECT count(*) FROM `app_orders` WHERE `order_id` = `order_id`) as `total_products` FROM `app_order_detail` WHERE `driver_id` = $driver_id ";

		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}

			public function auth_user() {
		$id = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where('created_by_id', $id);
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
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
			'bank_name' => $this->input->post('bank_name'),
			'info_form' => $this->input->post('info_form'),
			'info_banking' => $this->input->post('info_banking'),
			'paypal_name' => $this->input->post('paypal_name'),
			'paypal_email' => $this->input->post('paypal_email'),
			'user_id' => $this->session->userdata('id')
		);
		$query = $this->db->insert('payout_details', $data);
		return $query;
	}

			public function update_payout() {
		$data = array(
			'bank_name' => $this->input->post('bank_name'),
			'info_form' => $this->input->post('info_form'),
			'info_banking' => $this->input->post('info_banking'),
			'paypal_name' => $this->input->post('paypal_name'),
			'paypal_email' => $this->input->post('paypal_email'),
		);
		$this->db->where('payout_id', $this->input->post('payout_id'));
		$query = $this->db->update('payout_details', $data);
		return $query;
	}

			public function payments($id) {
		$this->db->select('SUM(amount) as total_amount');
		$this->db->from('payment_details');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->row();
	}

			public function add_user() {
		$data = array(
			'profile_type' => 'Ondemand',
			'name' => $this->input->post('name'),
			'display_name' => $this->input->post('display_name'),
			'user_type' => $this->input->post('user_type'),
			'email' => $this->input->post('email'),
			'contact' => $this->input->post('contact'),
			'flag_enabled' => '0'
		);

		$this->db->insert('authenticated_users', $data);
		return sha1($this->input->post('email'));
	}

			public function update_aut_user($id) {
		$data = array(
			'user_name' => $this->input->post('name'),
			'display_name' => $this->input->post('display_name'),
			'user_type' => $this->input->post('user_type'),
			'mob_number' => $this->input->post('contact')
		);
		$data = array_filter($data);
		$this->db->where("id", $id);
		$this->db->update("uf_user", $data);
		return true;
	}

			public function aut_users_detail() {
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where("id", $id);
		$query = $this->db->get();
		$resultarray = $query->row();

		return $resultarray;
	}

			public function getUserData($data) {
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where($data);
		$query = $this->db->get();
		return $query->row();
	}
			public function getUserDataForVerifacation() {
									$userId = $this->session->userdata('id');
		$query = $this->db->query("SELECT s.*, s.id as ind,u.* from `uf_user_doc_store` as s LEFT JOIN `uf_user` as u ON s.user_id= u.id where status = '0'  AND store_id = '$userId' "); 
		// $query = $this->db->query("SELECT s.*, s.id as ind,u.* from `uf_user_doc_store` as s LEFT JOIN `uf_user` as u ON s.user_id= u.id where status = '0'"); 
		return	$result=$query->result_array();
	
	}

          public function getVerificationDataStore($table,$where){
        $response = array();
        $this->db->select('store_id,prescription,stateId');
        $this->db->from($table);
      $this->db->order_by("id", "desc");
        $this->db->where($where);
        $query = $this->db->get();
          if ($query->num_rows()) {
          $response = $query->result();
        } 
        return $response;
}
	public function getUpdate($table, $data, $where) {
		$this->db->where($where);
		$query = $this->db->update($table, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function allpromo($user_id) {
		$this->db->select('*, (select display_name FROM uf_user WHERE uf_user.id = uf_promo_codes.created_by) as created_by');
		$this->db->from('uf_promo_codes');
		$this->db->where("created_by", $this->session->userdata('id'));
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function allpromo_list() {
		$this->db->select('cp_products.product_name,uf_promo_codes.*');
		$this->db->from('uf_promo_codes');
		$this->db->join('cp_products', 'uf_promo_codes.product_id = cp_products.id  ');
		$this->db->where('uf_promo_codes.created_by', 'Driver');
		$this->db->or_where('uf_promo_codes.product_id', 'ALL');
		$this->db->order_by("uf_promo_codes.id", "desc");
		$query = $this->db->get();
		echo $this->db->last_query();
		exit();
		$resultarray = $query->result_array();
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
			'product_id' => $this->input->post('product_id')
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
			'start' => $this->input->post('starts'),
			'end' => $this->input->post('ends'),
			'product_id' => $this->input->post('product_id')
		);
		$data = array_filter($data);
		$this->db->where("id", $id);
		$this->db->update("uf_promo_codes", $data);
		return true;
	}

	public function edit_promo($id) {
		$this->db->select('*');
		$this->db->from('uf_promo_codes');
		$this->db->where("id", $id);
		$query = $this->db->get();
		return $query->row();
	}



	public function delete_promo($id) {

		$this->db->where("id", $id);
		$this->db->delete("uf_promo_codes");
		return true;
	}




	public function update_comp($img) {
		$data = array(
			'title' => $this->input->post('title'),
			'ad_size' => $this->input->post('ad_size'),
			'description' => $this->input->post('description'),
			'created' => $this->input->post('created'),
			'image' => $img
		);
		$data = array_filter($data);

		$this->db->where("id", $this->input->post('id'));
		$this->db->update("cp_complimentary_ad", $data);
		return true;
	}

	public function add_new_comp($img) {
		$data = array(
			'title' => $this->input->post('title'),
			'ad_size' => $this->input->post('ad_size'),
			'description' => $this->input->post('description'),
			'created' => $this->input->post('created'),
			'user_id' => $this->session->userdata('id'),
			'image' => $img
		);
		$data = array_filter($data);

		$this->db->where("id", $this->input->post('id'));
		$this->db->insert("cp_complimentary_ad", $data);
		return true;
	}

	public function readMessages($id, $name) {

		if ($name == 'notification') {
			$data = array('read_status' => '1');
			$this->db->where("user_id", $id);
			$this->db->update("notification_history", $data);
			return true;
		} elseif ($name == 'task') {

			$data = array('read_status' => '1');
			$this->db->where("staff_id", $id);
			$this->db->update("sal_task", $data);
			$query = $this->db->last_query();
			return true;
		} elseif ($name == 'message') {
			$data = array('read_status' => '1');
			$this->db->where("message_by", $id);
			$this->db->update("admin_chat", $data);
			$query = $this->db->last_query();
			return $query;
		}
	}

	public function edit_category($id) {
		$this->db->select('*');
		$this->db->from('uf_categories');
		$this->db->where("id", $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_all_product() {
		$id = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('uf_categories');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_category($id) {
		$data = array('name' => $_POST['category_name'], 'status' => $_POST['status']);
		$this->db->where("id", $id);
		$this->db->update("uf_categories", $data);
		$query = $this->db->last_query();
		return true;
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
		$id = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('ost_ticket__cdata');
		$this->db->where('user_id', $id);
		$this->db->order_by("ticket_id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();
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

	public function list_ticket_comment($id) {
		$this->db->select('*');
		$this->db->from(' ticket_comment');
		$this->db->join('uf_user', 'uf_user.id =  ticket_comment.commentator_id', 'left');
		$this->db->where("ticket_comment.ticket_id", $id);
		$this->db->order_by("ticket_comment.created_date", 'desc');
		$querys = $this->db->get();
		$resultarray = $querys->result_array();
		return $resultarray;
	}

	public function notification_historyAll() {
		$id = $this->session->userdata('id');
		$this->db->select('*,notification_history.id as notification_id');
		$this->db->from('notification_history');
		$this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		$this->db->order_by("notification_history.id", "desc");
		$this->db->where("uf_user.id", $id);
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function add_auth_user() {
		$id = $this->session->userdata('id');
		$email = $this->input->post('email');

		$data = array(
			'user_name' => $this->input->post('name'),
			'display_name' => $this->input->post('display_name'),
			'mob_number' => $this->input->post('contact'),
			'title' => $this->input->post('title'),
			'email' => $this->input->post('email'),
			'secret_token' => md5($this->input->post('email')),
			'password' => md5($this->input->post('email')),
			'flag_enabled' => "1",
			'flag_verified' => "1",
			'is_verify' => "1",
			'user_type' => "4",
			'created_by_id' => $id,
		);
		$data = array_filter($data);
		$this->db->insert("uf_user", $data);
		return md5($this->input->post('email'));
	}

	public function auth_user_check($value = '') {
		$id = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where('created_by_id', $id);
		$query = $this->db->get();
		$rowsCount = $query->num_rows();
		if ($rowsCount <= '10') {
			return true;
		} else {
			return false;
		}
	}

	public function check_email($email) {
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where('email', $email);
		$query = $this->db->get();
		if ($query) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function auth_token_check($auth_chek) {
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where('secret_token', $auth_chek);
		$query = $this->db->get();
		if ($query) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function notification_add($message) {
		$id = $this->session->userdata('id');
		$name = $this->session->userdata('name');
		$sql = "SELECT * FROM `uf_user` WHERE `user_type` = '5' limit 0,1 ";
		$query = $this->db->query($sql);
		$res = $query->row();
		$adminid = $res->id;
		$data = array(
			'user_id' => $adminid,
			'message' => $message . '' . $name,
		);
		$this->db->insert('notification_history', $data);
		return true;
	}

	public function check_promo() {
		$code = $this->input->post('code');
		$id = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('uf_promo_codes');
		$this->db->where('code', $code);
		$this->db->where('created_by', $id);
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function recentActivity($message) {
		$data = array(
			'message' => $message,
			'user_id' => $this->session->userdata('id'),
			'created_at' => date("Y-m-d h:i:sa"),
		);
		$this->db->insert('history', $data);
		return true;
	}

	public function recordsCount($id, $table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function store_fronts() {
		$sql = "SELECT * FROM `uf_user` WHERE `user_type` = '3' ";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}
	          public function getOptData($table,$where){
        $response = array();
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
          if ($query->num_rows()) {
          $response = $query->row();
        } 
        return $response;
}

	public function document_store_signup() {
		$this->db->select('uf_user_documents.*,uf_user_documents.id as user_document_id');
		$this->db->from('uf_user_documents');
		$this->db->join('uf_user', 'uf_user.id = uf_user_documents.user_id', 'left');
		$this->db->where("uf_user_documents.user_id", $this->session->userdata('id'));
		$query = $this->db->get();
		//echo $this->db->last_query();
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

	public function get_Pendding_interviews($id) {
		$query = $this->db->query('SELECT u.* FROM `uf_user` u Left join uf_user_documents d on d.user_id=u.id WHERE  u.is_verify ="0" and d.provider_id="' . $id . '" group by u.id');
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

	public function get_visibility_data($user_id) {
		$this->db->select('cp_locations.*,uf_user.on_off_status,uf_user.opt_in_out');
		$this->db->from('cp_locations');
		$this->db->join('uf_user', 'uf_user.id = cp_locations.user_id', 'left');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function user_count() {

		$querys_where = 'AND created_at BETWEEN NOW() - INTERVAL 10 DAY AND NOW()';
		if (!empty($_POST)) {
			$startdate = $this->input->post('startdate');
			$enddate = $this->input->post('enddate');
			$querys_where = 'AND created_at >="' . $startdate . '" AND created_at <="' . $enddate . '"';
		}
		$sql = "SELECT  CAST(`created_at` AS DATE) as dates,device_type,count(case when device_type='1' then 1 end) as ios,count(case when device_type='0' then 1 end) as android  FROM `uf_user` WHERE `is_verify` = '1' " . $querys_where . " GROUP BY `dates` ";
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function usertype_count() {

		$querys_where = 'AND created_at BETWEEN NOW() - INTERVAL 10 DAY AND NOW()';
		if (!empty($_POST)) {
			$startdate = $this->input->post('startdate');
			$enddate = $this->input->post('enddate');
			$querys_where = 'AND created_at >="' . $startdate . '" AND created_at <="' . $enddate . '"';
		}
		$sql = "SELECT  CAST(`created_at` AS DATE) as dates,user_type,count(case when user_type='3' then 1 end) as store_count,count(case when user_type='2' then 1 end) as docotor_count,count(case when user_type='1' then 1 end) as driver_count FROM `uf_user` WHERE `is_verify` = '1' " . $querys_where . " GROUP BY `dates` ";

		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function Provider_usertype_count() {
		$querys_where = 'AND created_at BETWEEN NOW() - INTERVAL 10 DAY AND NOW()';
		if (!empty($_POST)) {
			$startdate = $this->input->post('startdate');
			$enddate = $this->input->post('enddate');
			$querys_where = 'AND created_at >="' . $startdate . '" AND created_at <="' . $enddate . '"';
		}
		$sql = "SELECT CAST(`created_at` AS DATE) as dates,count(case when user_type in ('1','2','3') then 1 end) as provider,count(*) as users FROM `uf_user` where `is_verify` = '1' " . $querys_where . " GROUP BY `dates` order by id asc";
		$query = $this->db->query($sql);
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function getAdminIds($where) {
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where($where);
		$query = $this->db->get();
		$data = $query->result();
		return $data;
	}

	public function saveSubcat() {
		$data = array(
			'sub_category' => $this->input->post('sub_category'),
			'uf_categories_id' => $this->input->post('main_category'),
			'user_id' => $this->session->userdata('id'),
			'date' => date('Y-m-d H:i:s'),
			'status' => '1',
		);
		$data = array_filter($data);
		$this->db->insert("uf_categories_sub", $data);
		return true;
	}

	public function order_process($id, $order_status) {

		$data = array('delivery_mode' => $order_status);
		$this->db->where('product_id', $id);
		$this->db->update('app_orders', $data);
		return true;
	}

	public function savetosdata($type) {
		$this->db->select('*');
		$this->db->from('uf_tos');
		$this->db->where('uf_tos.section', $type);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}

	public function insert_bulk($result) {
		$count = $this->db->insert('bulk_product', $result);
		if ($count) {
			return ('data inserted successfully');
		} else {
			return ('data not inserted');
		}
	}

	public function product_get() {

		$this->db->select('*');
		$this->db->from('bulk_product');
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}

	public function insert_user_data($data_bl_user, $data_bulk_location)
	{
		$count = $this->db->insert('uf_user', $data_bl_user);
		$insert_id = $this->db->insert_id();
		
		$data_bulk_location['user_id'] = $insert_id;
		$query = $this->db->insert('cp_locations', $data_bulk_location);
	}
	public function all_auth_user() {
		$this->db->select('uf_user.*,count(sal_task.id) as totals,count(case when sal_task.status="1" then 1 end) as completed');
		$this->db->from('uf_user');
		$this->db->join('sal_task', 'sal_task.staff_id = uf_user.id', 'left');
//		$this->db->where("uf_user.user_type", "4");
		$this->db->where_in("uf_user.user_type", array(4,6,7,8,9));
		$this->db->order_by("uf_user.id", "desc");
		$this->db->group_by("uf_user.id");
		$this->db->where("created_by_id", $this->session->userdata('id'));
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}
	public function totalContractors() {
		$this->db->select('count(id) as totalcontractor');
		$this->db->from('uf_user');
		$this->db->where_in("user_type", array(4,6,7,8,9));
		$this->db->where("created_by_id", $this->session->userdata('id'));
		$query = $this->db->get();
		$resultarray = $query->row();
		return $resultarray;
	}
	public function add_auth_user_contract() {
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
		
		$email=$this->input->post('email');
		$result=$this->db->select('*')->from('uf_user')->where('email',$email)->get()->num_rows();
		if($result > 0){
			 $this->session->set_flashdata('success_msg', 'Sorry this email is already existed');
			redirect("panels/supermacdaddy/storefronts/sales");
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
			'created_by_id' =>$this->session->userdata('id'),
			'addDate' => date('Y-m-d')
		);
		$data = array_filter($data);
		$this->db->insert("uf_user", $data);
		return sha1($this->input->post('email'));
	}
         
	public function historyData($table = '', $where) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

}