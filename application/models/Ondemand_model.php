<?php
class Ondemand_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
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
	public function notification_history($limit,$id=''){
		$this->db->select('*');
		$this->db->from('notification_history');
		$this->db->order_by("notification_history.id", "desc");	
		if($limit!=0){
		$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		$this->db->where('uf_user.id', $id);
		$this->db->where('notification_history.read_status', '0');
		$query = $this->db->get();
		$resultarray = $query->result_array();   
		return $resultarray;
	}
		public function notification_history_user($limit,$id){
		$this->db->select('*');
		$this->db->from('notification_history');
		$this->db->order_by("notification_history.id", "desc");	
		if($limit!=0){
		$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		$this->db->where('uf_user.id', $id);
		$this->db->where('notification_history.read_status', '0');
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
 
	
	public function document_ondemand_signup() {
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
	public function update_data($table, $data_arr, $where_arr) {
		$this->db->where($where_arr);
		$query = $this->db->update($table, $data_arr);
		return $query;
	}
	public function tasknotification($limit,$id){
		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->order_by("sal_task.id", "desc");	
		if($limit!=0){
			$this->db->limit(5);
		}
		$this->db->join('sal_login', 'sal_login.uid = sal_task.staff_id', 'left');
		$this->db->where('sal_task.staff_id', $id);
		$this->db->where('sal_task.read_status', '0');
		$query = $this->db->get();
		$resultarray = $query->result_array();  
		return $resultarray;
	}
		public function tasknotification_message($limit,$id){
		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->order_by("sal_task.id", "desc");	
		if($limit!=0){
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = sal_task.staff_id', 'left');
		$this->db->where('sal_task.staff_id', $id);
		$this->db->where('sal_task.read_status', '0');
		$query = $this->db->get();
		$resultarray = $query->result_array();  
		return $resultarray;
	}

	public function task_list(){
		$id=$this->session->userdata('id');
		$this->db->select('sal_task.*');
		$this->db->from('sal_task');
		$this->db->order_by("sal_task.id", "desc");	
		$this->db->join('uf_user', 'uf_user.id = sal_task.staff_id', 'left');
		$this->db->where('sal_task.staff_id', $id);
		$query = $this->db->get();
		$resultarray = $query->result_array();  
		return $resultarray;
	}
	 public function msgnotification($limit,$id){
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("admin_chat.msg_id", "desc");
		$this->db->where("admin_chat.sender_name!=", "Admin");	
	
		if($limit!=0){
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = admin_chat.message_by', 'left');
	    $this->db->where("uf_user.id",$id);	
		$query = $this->db->get();
		$resultarray = $query->result_array();   
		return $resultarray;
	
	}

	 public function msgnotification_message($limit,$id){
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("admin_chat.msg_id", "desc");
		$this->db->where("admin_chat.sender_name !=", "Admin");	
	
		if($limit!=0){
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = admin_chat.message_by', 'left');
	    $this->db->where("uf_user.id",$id);	
	    $this->db->where("admin_chat.read_status",'0');	
		$query = $this->db->get();
		$resultarray = $query->result_array();   
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
	public function drivers(){
     
     	  $sql = "SELECT * FROM `uf_user` WHERE `user_type` = '1' ";
          $query = $this->db->query($sql);
          $res = $query->result_array();
			return $res;
     }
     public function products($user_id){
     
     	  $sql = "SELECT * FROM `cp_products` WHERE  `user_id` = '$user_id' limit 0,100 ";
     	 //$sql = "SELECT uf_user.email as provideremail, uf_user.mob_number as providernumber,uf_categories.name as main, uf_categories_sub.sub_category as sub ,cp_products.* FROM `cp_products`join uf_categories on cp_products.product_category=uf_categories.id join uf_categories_sub on cp_products.product_sub_category =uf_categories_sub.id join uf_user  on cp_products.user_id=uf_user.id WHERE cp_products.user_id='$user_id' order by cp_products.id desc ";

          $query = $this->db->query($sql);
          $res = $query->result_array(); 
         //echo "<pre>"; print_r($res); die('got')ho;
		  return $res;
     }  
        public function All_products($user_id){
     
     	  $sql = "SELECT * FROM `cp_products` WHERE `product_type` = 'Driver'  AND `location_id` = '$user_id' limit 0,6000  ";
     	  
          $query = $this->db->query($sql);
          $res = $query->result(); 
         //echo "<pre>"; print_r($res); die('got');
		  return $res;
     }  
     
     function active_product($id){		
		$this->db->set('status','1');
		$this->db->where('id', $id);
		$this->db->update("cp_products");		
	}
	 function deactive_product($id){		
		$this->db->set('status','0');
		$this->db->where('id', $id);
		$this->db->update("cp_products");		
	}
	public function delete_product($productid){
		$this->db->where('id', $productid);
		$this->db->delete('cp_products');

    }
    public function add_product()
	{
		
		 $imgpath = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
		 $path = 'uploads';
	     $result=$this->upload_image($imgpath, $path);
	     if(!$result){
	    	return false;
	     }
		
			
		$data = array(
						'user_id'                   => $this->session->userdata('id'),
                        'product_type'              => 'Driver',
                        'location_id'				=> $this->session->userdata('id'),
                        'product_name'              => $this->input->post('product_name'),
                        'product_category'          => $this->input->post('product_category'),
                        // 'product_sub_category'      => $this->input->post('product_sub_category'),
                        'preparation_time'          => $this->input->post('preparation_time'),    
//                        'tax_patients'              => $this->input->post('tax_patients'),
                        'happy_hour'                => !empty($this->input->post('happy_hour'))?$this->input->post('happy_hour'):'',  
						'happy_day'					=>  !empty($this->input->post('happy_day'))?$this->input->post('happy_day'):'',  
						'happy_time_to'				=> !empty($this->input->post('happy_time_to'))?$this->input->post('happy_time_to'):'',  
						'happy_time_from'			=>  !empty($this->input->post('happy_time_from'))?$this->input->post('happy_time_from'):'',
                        'image'             		=> $imgpath,  
                        'product_notes'             => $this->input->post('product_notes'),
                        'amt_d_price'             => !empty($this->input->post('amt_d_price')) ? $this->input->post('amt_d_price') : ''
		);  
		$this->db->insert('cp_products' , $data);

	 
        $productid = $this->db->insert_id();  
        
        if(!empty($productid)){
        	$data = array(
        				'product_id'=> $productid,
						'k1' => $this->input->post('k1'),
                      'k2' => $this->input->post('k2'),
                        'k3' => $this->input->post('k3') ,
                        'k4' => $this->input->post('k4'),
                        'k5' => $this->input->post('k5'),
                        'k6' => $this->input->post('k6')
                                   
         	);
			$this->db->insert('cp_product_size' , $data);
        	 $productid = $this->db->insert_id();  
        
			return $productid;
        }else{
            	return false; 
        }
	}         


	 public function update_product()
	{
		$image = $this->input->post('image');
		 $files = $_FILES;
		
        if(!empty($_FILES['image']['name'])){
                $imgpath = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				 $path = 'uploads';
			     $result=$this->upload_image($imgpath, $path);
			     if(!$result){
			    	return false;
			     }
		 }else{
         $imgpath= $this->input->post('hiddenimage');
		 }
		
		$id=$this->input->post('product_id');
		$data = array(
						
                        'product_type'              => 'Driver',
                        'product_name'              => $this->input->post('product_name'),
                        'product_category'          => $this->input->post('product_category'),
                        // 'product_sub_category'      => $this->input->post('product_sub_category'),
                        'preparation_time'          => $this->input->post('preparation_time'),    
//                        'tax_patients'              => $this->input->post('tax_patients'),
                        'happy_hour'                => $this->input->post('happy_hour'),  
						'happy_day'					=> $this->input->post('happy_day'),  
						'happy_time_to'				=> $this->input->post('happy_time_to'),  
						'happy_time_from'			=> $this->input->post('happy_time_from'),
                        'image'             		=> $imgpath,  
                        'product_notes'             => $this->input->post('product_notes'),
						'amt_d_price'				=> !empty($this->input->post('amt_d_price')) ? $this->input->post('amt_d_price') : ''
		);  
		$where = array('id' =>$id);
		 $this->db->where($where);
         $this->db->update('cp_products',$data);
       //$query=$this->db->last_query();
     // echo $query;
      // exit();
        if(!empty($id)){
        	$data = array(
						'k1' => $this->input->post('k1'),
//                        'k2' => $this->input->post('k2'),
                        'k3' => $this->input->post('k3') ,
//                        'k4' => $this->input->post('k4'),
                        'k5' => $this->input->post('k5'),
//                        'k6' => $this->input->post('k6')
                                   
         	);
         	 $this->db->where('product_id' , $id);
			$this->db->update('cp_product_size' , $data);
			
            return true;		
        }else{
            	return false; 
        }
	}         
	 
	 
	public function main_categories()
	 {
	 	$categories = "SELECT * FROM `uf_categories` ";
	 	$categories_result = $this->db->query($categories);
        $result = $categories_result->result_array();
		return $result;
	 }
	 public function product_detail()
	 {
		$id =  $this->input->post('id');
		$this->db->select('cp_products.id as pid ,cp_products.*,cp_product_size.*');
		$this->db->from('cp_products');
		$this->db->join('cp_product_size', 'cp_products.id = cp_product_size.product_id');
		$this->db->where('cp_products.id', $id);
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		
		return $resultarray;	
	
	}
	
	public function orders($driver_id)
	{
		  $sql = "SELECT *,`id` as `orde+r_id`, (SELECT count(*) FROM `app_orders` WHERE `order_id` = `order_id`) as `total_products` FROM `app_order_detail` WHERE `driver_id` = $driver_id ";
	
		$query = $this->db->query($sql);
		// echo $this->db->last_query();
		// exit;
		$res = $query->result_array();
		return $res;
	}  
    
    public function auth_user()
    {	
    	$id=$this->session->userdata('id');
    	$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where('created_by_id',$id);
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;	
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
			"created_by_id"=>$this->session->userdata('id'),
		);
		$data = array_filter($data);
		$this->db->insert("uf_user", $data);
		return sha1($this->input->post('email'));
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
			"created_by_id"=>$this->session->userdata('id'),
		);
		$data = array_filter($data);
		$this->db->where("id", $this->input->post('user_id'));
		$this->db->update("uf_user", $data);
		return true;
	}
	public function aut_users_detail(){
		$id =  $this->input->post('id');
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where("id", $id);	
		$query = $this->db->get();
		$resultarray = $query->row();   //echo "<pre/>"; print_r($resultarray); die('m here');
		
		return $resultarray;	
	
	}
	
	public function getUserData($data)
	{


		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where($data);
		$query = $this->db->get();
		return $query->row();	
	}
       
         public function getUpdate($table, $data, $where)
    {
        $this->db->where($where);
        $query=$this->db->update($table,$data);
         if($query){
        return true;
       }else{
        return false;
      }
    }
    public function allpromo($user_id){
		$this->db->select('*, (select display_name FROM uf_user WHERE uf_user.id = uf_promo_codes.created_by) as created_by');
		$this->db->from('uf_promo_codes');
		$this->db->where("created_by", $this->session->userdata('id'));
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;
	
	}
	   public function allpromo_list(){
		$this->db->select('cp_products.product_name,uf_promo_codes.*');
		$this->db->from('uf_promo_codes');
		$this->db->join('cp_products','uf_promo_codes.product_id = cp_products.id  ');
		$this->db->where('uf_promo_codes.created_by' ,'Driver');
		$this->db->or_where('uf_promo_codes.product_id' ,'ALL');
		$this->db->order_by("uf_promo_codes.id", "desc");	
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;	
	
	}
	public function check_promo()
	{
		$code=$this->input->post('code');
		$id=$this->session->userdata('id');
        $this->db->select('*');
        $this->db->from('uf_promo_codes');
        $this->db->where('code',$code);
        $this->db->where('created_by',$id);
		$query = $this->db->get();

		return $query->num_rows();

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
				'created_by'=>$this->session->userdata('id'),
				'product_id'=>$this->input->post('product_id')
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
				'product_id'=>$this->input->post('product_id')
				

			);
		$data = array_filter($data);
		$this->db->where("id",$id);
		$this->db->update("uf_promo_codes",$data);
		return true;	
	}

	public function edit_promo($id){
		$this->db->select('*');
		$this->db->from('uf_promo_codes');
		$this->db->where("id",$id);
		$query=$this->db->get();
	   return $query->row();	
	

	}
	public function update_comp($img){
		$data= array(
			'title'=> $this->input->post('title'),
			'ad_size'=> $this->input->post('ad_size'),
			'description'=> $this->input->post('description'),
			'created'=> $this->input->post('created'),
 			'image'=> $img
		);
		$data = array_filter($data);
		
		$this->db->where("id",$this->input->post('id'));
		$this->db->update("cp_complimentary_ad",$data); 
		return true;	
	}
	public function add_new_comp($img){
		$data= array(
			'title'=> $this->input->post('title'),
			'ad_size'=> $this->input->post('ad_size'),
			'description'=> $this->input->post('description'),
			'created'=> $this->input->post('created'),
			'user_id'=> $this->session->userdata('id'),
 			'image'=> $img
		);
		$data = array_filter($data);
		
		$this->db->where("id",$this->input->post('id'));
		$this->db->insert("cp_complimentary_ad",$data); 
		return true;	
	}
	public function readMessages($id,$name)
	{

		if($name == 'notification'){
		$data = array('read_status' =>'1');
		$this->db->where("user_id",$id);
		$this->db->update("notification_history",$data);
		return true;	
	    }elseif($name =='task'){

		$data = array('read_status' =>'1');
		$this->db->where("staff_id",$id);
		$this->db->update("sal_task",$data);
		$query=$this->db->last_query();
		return true;	
	   }elseif($name =='message'){
		$data = array('read_status' =>'1');
		$this->db->where("message_by",$id);
		$this->db->update("admin_chat",$data);
		$query=$this->db->last_query();
		return $query;	
	   }


}

	public function edit_category($id)
	{
		$this->db->select('*');
		$this->db->from('uf_categories');
		$this->db->where("id",$id);
		$query=$this->db->get();
	    return $query->row();	
		
	}

	public function get_all_product()
	{  
		$id=$this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('uf_categories');
		$this->db->where('user_id',$id);
		$query=$this->db->get();
	   return $query->result_array();	
		
	}
	public function update_category($id)
	{
		$data = array('name' =>$_POST['category_name'],'status'=>$_POST['status']);
		$this->db->where("id",$id);
		$this->db->update("uf_categories",$data);
		$query=$this->db->last_query();
		return true;
		
	}
	public function last_ticket_no()
	{
		$this->db->select('*');
		$this->db->from('ost_ticket__cdata');
		$this->db->order_by("ticket_id", "desc");
		$this->db->limit(1);
		$query = $this->db->get();
		$resultarray = $query->row_array();  
		return $resultarray['ticket_id']+1;	
	}
	public function list_ticket_data()
	{
		$id=$this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('ost_ticket__cdata');
		$this->db->where('user_id',$id);
		$this->db->order_by("ticket_id", "desc");
		$query = $this->db->get();
		$resultarray = $query->result_array();  
		return $resultarray;
	}
	public function edit_tickit_data($id)
	{
		$this->db->select('*');
		$this->db->from('ost_ticket__cdata');
		$this->db->where("ticket_id", $id);
		$query = $this->db->get();
		$resultarray = $query->row_array();  
		return $resultarray;
	}
	public function list_ticket_comment($id)
	{
		$this->db->select('*');
		$this->db->from(' ticket_comment');
		$this->db->join('uf_user', 'uf_user.id =  ticket_comment.commentator_id','left');
		$this->db->where("ticket_comment.ticket_id", $id);
		$this->db->order_by("ticket_comment.created_date", 'desc');
		$querys = $this->db->get();
		$resultarray = $querys->result_array();   
		return $resultarray;	
	}
	public function notification_historyAll(){
		$id=$this->session->userdata('id');		
		$this->db->select('*,notification_history.id as notification_id');
		$this->db->from('notification_history');
		$this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		$this->db->order_by("notification_history.id", "desc");	
		$this->db->where("uf_user.id", $id);	
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;
	}


	public function add_auth_user(){	
			$id=$this->session->userdata('id');	
			$email=$this->input->post('email');	
			
		$data= array(
				'user_name'		=> $this->input->post('name'),
				'display_name'	=> $this->input->post('display_name'),
				'mob_number'	=> $this->input->post('contact'),
				'title'			=> $this->input->post('title'),
				'email'			=> $this->input->post('email'),
				'secret_token'	=> md5($this->input->post('email')),
				'password'		=> md5($this->input->post('email')),
				'flag_enabled'	=> "1",
				'flag_verified'	=> "1",
				'is_verify'		=> "1",
				'user_type'		=> "4",
				'created_by_id'		=> $id,
			);
		$data = array_filter($data);
		$this->db->insert("uf_user",$data);
		return md5($this->input->post('email'));	
	}
	public function check_email($email)
	{
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where('email',$email);
		$query=$this->db->get();
		if($query){
             return $query->row();
		}else{
              return false;
		}

	}
	public function auth_token_check($auth_chek)
	{
		$this->db->select('*');
		$this->db->from('uf_user');
		$this->db->where('secret_token',$auth_chek);
		$query=$this->db->get();
		if($query){
             return $query->row();
		}else{
              return false;
		}
	}
	public function notification_add($message)
	{
		  $id = $this->session->userdata('id');
		  $name = $this->session->userdata('name');
		  $sql = "SELECT * FROM `uf_user` WHERE `user_type` = '5' limit 0,1 ";
          $query = $this->db->query($sql);
          $res = $query->row();
		  $adminid= $res->id;
		  $data = array(
			   'user_id' =>$adminid , 
			   'message' =>$message.''.$name, 
		       );
		$this->db->insert('notification_history',$data);
		return true;
	}
	public function recordsCount($id,$table)
	{
		$this->db->select('*');
		$this->db->from($table);
	    $this->db->where('user_id',$id);
	    $query=$this->db->get();
	    return $query->num_rows();
	  
	}
	public function ratingArray($id,$table)
	{
		 $first_date=$this->input->get('date');
		 $second_date=$this->input->get('end');

		for ($i=1; $i <=5 ; $i++) { 
			$this->db->select('*');
			$this->db->from($table);
		    $this->db->where('store_id',$id);
		    $this->db->where('rating <=',$i);
		    $this->db->where('rating >=',$i);
		    if($first_date &&  $second_date){
		    	// $this->db->where('DATE(created_at) <=', $date);
		    	// $this->db->where('DATE(created_at) >=', $first_date);
       //          $this->db->where('DATE(created_at) <=', $second_date);
                 $this->db->where('DATE(created_at) BETWEEN "'.$first_date.'" AND "'.$second_date.'"', '',false);
		    }
		   
		    $query=$this->db->get();
		   // echo $this->db->last_query();
		   $countRows=$query->num_rows();
		//  $data = array();
		  $data[]  = array('y' =>$countRows,"label" => $i." Stars" );
		 
	    }
	   return $data;
	   
	  
	}
	public function getSalesGraph($id='')
	{
		$this->db->select('*');
		$this->db->from('cp_products');
		$this->db->where('user_id',$id);
		$query=$this->db->get();
		$result=$query->result();
	$data = array();
		if(count($result) > 0){
			foreach ($result as $r) {
				   $pid=$r->id;
				   $pname=$r->product_name;
					$this->db->select('*');
					$this->db->from('app_orders');
					$this->db->where('product_id',$pid);
					$query=$this->db->get();
					$count=$query->num_rows();

				$data[]  = array('y' =>$count,"label" => $pname );
			}

		}

		  return $data;
	}
	public function getSingleRecord($table='',$id='')
	{
			$this->db->select('*');
			$this->db->from($table);
		    $this->db->where('user_id',$id);
		    $query=$this->db->get();
		    return $query->row();
	}
	public function save_payout()
	{
		$data = array(
			 'bank_name' =>$this->input->post('bank_name') ,
			 'info_form' =>$this->input->post('info_form') ,
			 'info_banking' =>$this->input->post('info_banking') ,
			 'paypal_name' =>$this->input->post('paypal_name') ,
			 'paypal_email' =>$this->input->post('paypal_email') ,
			 'user_id' =>$this->session->userdata('id')
			  );
		$query=$this->db->insert('payout_details',$data);
		return $query;

	}
	public function update_payout()
	{
		$data = array(
			 'bank_name' =>$this->input->post('bank_name') ,
			 'info_form' =>$this->input->post('info_form') ,
			 'info_banking' =>$this->input->post('info_banking') ,
			 'paypal_name' =>$this->input->post('paypal_name') ,
			 'paypal_email' =>$this->input->post('paypal_email') ,
			  );
		      $this->db->where('payout_id',$this->input->post('payout_id'));
		    $query=$this->db->update('payout_details',$data);
		  return $query;

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
	public function visibilityData($table='',$where)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by('loc_id','desc');
		$query=$this->db->get();
		// echo $this->db->last_query();
		// exit();
		return $query->result();
	}
	public function deletRecord($table='',$where)
	{
		$this->db->where($where);
		$this->db->delete($table);
		
		return true;
	}
	public function recentActivity($message){
		$data = array(
			  'message' =>$message,
			  'user_id' =>$this->session->userdata('id'),
			  'created_at' =>date("Y-m-d h:i:sa"),
			   );
		$this->db->insert('history',$data);
		return true;
   
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

	public function all_sub_categories(){
		$this->db->select('uf_categories_sub.*,uf_categories.name as maincategory_nm ,uf_user.user_type');
		$this->db->from('uf_categories_sub');
		$this->db->join('uf_categories', 'uf_categories.id = uf_categories_sub.uf_categories_id');
		$this->db->join('uf_user','uf_user.id = uf_categories_sub.user_id', 'left');
		$this->db->order_by("uf_categories_sub.id", "desc");	
		$query = $this->db->get();
		$resultarray = $query->result_array();
		return $resultarray;	
	}
	public function saveSubcat()
	{
		$data= array(
				'sub_category'=> $this->input->post('sub_category'),
				'uf_categories_id'=> $this->input->post('main_category'),
				'user_id'=> $this->session->userdata('id'),
				'date'=> date('Y-m-d H:i:s'),
			);
		$data = array_filter($data);
		$this->db->insert("uf_categories_sub",$data);
		return true;
	}
	public function update_Subcategory($id){
		$data= array(
				'sub_category'=> $this->input->post('sub_category'),
				'uf_categories_id'=> $this->input->post('main_category'),
				'user_id'=> $this->session->userdata('id'),
				'date'=> date('Y-m-d H:i:s'),
			);
		
		$data = array_filter($data);
		$this->db->where("id",$id);
		$this->db->update(" uf_categories_sub",$data);
		return true;	
	}
   public function payments($id)
   {
      $this->db->select('SUM(amount) as total_amount');
      $this->db->from('payment_details');
      $this->db->where('user_id',$id);
     $query= $this->db->get();
   return $query->row();
   }
   public function subcategoriesCheck($id)
   {
     $this->db->select('*');
     $this->db->from('uf_categories_sub');
     $this->db->where('uf_categories_id',$id);
     $query= $this->db->get();
     $data =$query->num_rows();
     return $data;

   }
    public function productCheck($id)
   {
     $this->db->select('*');
     $this->db->from('cp_products');
     $this->db->where('product_category',$id);
     $query= $this->db->get();
     $data =$query->num_rows();
     return $data;

   }
   public function uploadDocuments($table,$id)
   {
   	  $this->db->select('*');
      $this->db->from($table);
      $this->db->where('user_id',$id);
      $query= $this->db->get();
      $data =$query->result();
      return $data;
   }
    public function updateDriverDocuments($table,$id)
   {
   	  $this->db->select('*');
      $this->db->from($table);
      $this->db->where('id',$id);
      $query= $this->db->get();
      $data =$query->row();
      return $data;
   }
   public function updateSingleRecord($table,$id,$documents)
   {
     $this->db->where('id',$id);
     $this->db->update($table, array('documents' =>$documents));
     return true;
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
   public function getsubCategoryData($id)
   {
       $this->db->select('*');
       $this->db->from('uf_categories_sub');
       $this->db->where('status','1');
       $this->db->where('uf_categories_id',$id);
       $query=$this->db->get();
       return $query->result();
   }
   public function checkProduct($id)
   {
     $this->db->select('*');
     $this->db->from('uf_promo_codes');
     $this->db->where('product_id', $id);
      $query=$this->db->get();
     
       return $query->num_rows();
   }
 //   public function get_Pendding_interviews($id) {
 //   	  $getQuery= 'SELECT u.* FROM `uf_user` u Left join uf_user_documents d on d.user_id=u.id WHERE  u.is_verify ="0" and d.provider_id="'.$id.'" group by u.id';
 //   	 //die();
	// 	$query=$this->db->query($getQuery);
	// 	$resultarray = $query->result_array();
	// 	return $resultarray;
	// }

   public function get_Pendding_interviews($id) {
   	  $getQuery= 'SELECT * FROM  uf_user_doc_store where  status = 0 and user_id="'.$id.'" ';
   	 //die();
		$query=$this->db->query($getQuery);
		$resultarray = $query->result_array();
		// echo "<pre>"; print_r($resultarray);
		// die();
		return $resultarray;
	}
				public function getUserDataForVerifacation() {
					$userId = $this->session->userdata('id');
		$query = $this->db->query("SELECT s.*, s.id as ind,u.* from `uf_user_doc_store` as s LEFT JOIN `uf_user` as u ON s.user_id= u.id where status = '0'  AND store_id = '$userId' "); 
		return	$result=$query->result_array();
	
	}

	public function savetosdata($type) {
		$this->db->select('*');
		$this->db->from('uf_tos');
		$this->db->where('uf_tos.section', $type);
		$query = $this->db->get();
		$resultarray = $query->row_array();
		return $resultarray;
	}
	function upload_image($image, $path) {
		$config['upload_path'] = $path;
		$config['allowed_types'] = '*';
		$config['overwrite'] = FALSE;
		$config['file_name'] = $image;
		$config['max_size'] = '1000000';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('image')) {
			return false;
		} else{
			return true;
		}
	}
	public function main_categories_bulk($category_name = "") {
		$sql = "1 = 1";
		if (!empty($category_name)) {
			$sql = " name = '$category_name'";
		}

		$categories_result = $this->db->query("SELECT * FROM `uf_categories` WHERE $sql");
		$result = $categories_result->result_array();
		return $result;
	}

	public function sub_categories_bulk($subcategory_name = "") {
		$sql = "1 = 1";
		if (!empty($subcategory_name)) {
			$sql = " sub_category = '$subcategory_name'";
		}

		$subcategories_result = $this->db->query("SELECT * FROM `uf_categories_sub` WHERE $sql LIMIT 1");
		$result = $subcategories_result->result_array();
		return $result;
	}

	// For bulk Product upload
	public function insert_category_bulk($data) {
		$this->db->insert('uf_categories', $data);
		return $id = $this->db->insert_id();
	}

	public function insert_sub_category_bulk($data) {
		$this->db->insert('uf_categories_sub', $data);
		return $id = $this->db->insert_id();
	}

		public function add_product_bulk($data, $prodcut_size) {
		$this->db->insert('cp_products', $data);
		//echo $this->db->last_query();
		$productid = $this->db->insert_id();
		if (!empty($productid)) {
			$dataid = array(
				'product_id' => $productid
			);
			$datain=array_merge($dataid,$prodcut_size);
			$this->db->insert('cp_product_size', $datain);
			return true;
		} else {
			return false;
		}
	}

  }