<?php
class Mypanel_model extends CI_Model {

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
		public function notification_history_user($limit,$id){
		$this->db->select('*');
		$this->db->from('notification_history');
		$this->db->order_by("notification_history.id", "desc");	
		if($limit!=0){
		$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		$this->db->where('uf_user.id', $id);
		$this->db->where('notification_history.read_message', '1');
		$query = $this->db->get();
		$resultarray = $query->result_array();   

		//echo $this->db->last_query();
		return $resultarray;
	}
	public function notification_history_user_message($limit,$id){
		$this->db->select('*');
		$this->db->from('notification_history');
		$this->db->order_by("notification_history.id", "desc");	
		if($limit!=0){
		$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = notification_history.user_id', 'left');
		$this->db->where('uf_user.id', $id);
		$query = $this->db->get();
		$resultarray = $query->result_array();   

		//echo $this->db->last_query();
		return $resultarray;
	}
	public function tasknotification($limit,$id){
		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->order_by("sal_task.id", "desc");	
		if($limit!=0){
			$this->db->limit(5);
		}
		$this->db->join('uf_user', 'uf_user.id = sal_task.staff_id', 'left');
		$this->db->where('sal_task.staff_id', $id);
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
		$this->db->where('sal_task.read_message', '1');
		$query = $this->db->get();
		$resultarray = $query->result_array();  
		return $resultarray;
	}
	 public function msgnotification($limit,$id){
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("admin_chat.msg_id", "desc");
		$this->db->where("admin_chat.sender_name !=", "Admin");	
	
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
	    $this->db->where("admin_chat.read_message",'1');	
		$query = $this->db->get();
		$resultarray = $query->result_array();   
		return $resultarray;
	
	}
	public function chat_history(){
		$this->db->select('*');
		$this->db->from('admin_chat');
		$this->db->order_by("msg_id", "asc");	
		$query = $this->db->get();
		$resultarray = $query->result_array();   
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
	public function drivers(){
     
     	  $sql = "SELECT * FROM `uf_user` WHERE `title` = 'Driver' ";
          $query = $this->db->query($sql);
          $res = $query->result_array();
			return $res;
     }
     public function products($user_id){
     
     	  $sql = "SELECT * FROM `cp_products` WHERE `product_type` = 'Driver' AND `location_id` = '$user_id' ";
     	  
          $query = $this->db->query($sql);
          $res = $query->result_array(); 
         //echo "<pre>"; print_r($res); die('got');
		  return $res;
     }  
        public function All_products($user_id){
     
     	  $sql = "SELECT * FROM `cp_products` WHERE `product_type` = 'Driver' AND `location_id` = '$user_id' ";
     	  
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
		$image = $this->input->post('image');
        
        $config['upload_path']   = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        
        $this->load->library('upload' , $config);
        $this->upload->do_upload('image');
        $files = $_FILES;
        $imgpath = base_url()."uploads/".$files['image']['name'];
		
			
		$data = array(
						'user_id'                   => $this->session->userdata('id'),
                        'product_type'              => 'Driver',
                        'location_id'				=> $this->session->userdata('id'),
                        'product_name'              => $this->input->post('product_name'),
                        'product_category'          => $this->input->post('product_category'),
                        'product_sub_category'      => $this->input->post('product_sub_category'),
                        'preparation_time'          => $this->input->post('preparation_time'),    
                        'tax_patients'              => $this->input->post('tax_patients'),
                        'happy_hour'                => $this->input->post('happy_hour'),  
                        'image'             		=> $imgpath,  
                        'product_notes'             => $this->input->post('product_notes')
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
        
        $config['upload_path']   = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        
        $this->load->library('upload' , $config);
        $this->upload->do_upload('image');
         $imgpath = base_url()."uploads/".$files['image']['name'];
		 }else{
         $imgpath= $this->input->post('hiddenimage');
		 }
		
		$id=$this->input->post('product_id');
		$data = array(
						
                        'product_type'              => 'Driver',
                        'product_name'              => $this->input->post('product_name'),
                        'product_category'          => $this->input->post('product_category'),
                        'product_sub_category'      => $this->input->post('product_sub_category'),
                        'preparation_time'          => $this->input->post('preparation_time'),    
                        'tax_patients'              => $this->input->post('tax_patients'),
                        'happy_hour'                => $this->input->post('happy_hour'),  
                        'image'             		=> $imgpath,  
                        'product_notes'             => $this->input->post('product_notes')
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
                        'k2' => $this->input->post('k2'),
                        'k3' => $this->input->post('k3') ,
                        'k4' => $this->input->post('k4'),
                        'k5' => $this->input->post('k5'),
                        'k6' => $this->input->post('k6')
                                   
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
		 $sql = "SELECT *,`id` as `order_id`, (SELECT count(*) FROM `app_orders` WHERE `order_id` = `order_id`) as `total_products` FROM `app_order_detail` WHERE `driver_id` = $driver_id ";
		
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}  
    
    public function auth_user()
    {
    	$this->db->select('*');
		$this->db->from('authenticated_users');
		$query = $this->db->get();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		return $resultarray;	
    }
    
    public function add_user(){
		
		$data= array( 
				'profile_type'  => 'Ondemand',
				'name'          => $this->input->post('name'),
				'display_name'  => $this->input->post('display_name'),
				'user_type'     => $this->input->post('user_type'),
				'email'         => $this->input->post('email'),
				'contact'       => $this->input->post('contact'),
				'flag_enabled'  => '0'

			);  //echo "<pre>"; print_r($data);
		
	 	$this->db->insert('authenticated_users' , $data);
	 	return sha1($this->input->post('email'));
	 	//echo $this->db->last_query(); die;
        
	}
	public function update_aut_user($id)
	{
		$data= array(
				'name'=> $this->input->post('name'),
				'display_name'=> $this->input->post('display_name'),
				'user_type'=> $this->input->post('user_type'),
				'email'=> $this->input->post('email'),
				'contact'=> $this->input->post('contact')
				

			);
		$data = array_filter($data);		
		$this->db->where("id",$id);
		$this->db->update("authenticated_users",$data);		
		return true;	
	}
	public function aut_users_detail(){
		$id =  $this->input->post('id');
		$this->db->select('*');
		$this->db->from('authenticated_users');
		$this->db->where("id", $id);	
		$this->db->order_by("id", "desc");	
		$query = $this->db->get();
		$resultarray = $query->row_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
		
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
    public function allpromo(){
		$this->db->select('*');
		$this->db->from('uf_promo_codes');
		$this->db->where('created_by' ,'Driver');
		$this->db->order_by("id", "desc");	
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
		echo $this->db->last_query();
		exit();
		$resultarray = $query->result_array();   //echo "<pre/>"; print_r($resultarray); die('m here');
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
				'created_by'=>'Driver',
				'user_id'=>$this->session->userdata('id'),
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
	public function readMessages($id,$name)
	{

		if($name == 'notification'){
		$data = array('read_message' =>'0');
		$this->db->where("user_id",$id);
		$this->db->update("notification_history",$data);
		return true;	
	    }elseif($name =='task'){

		$data = array('read_message' =>'0');
		$this->db->where("staff_id",$id);
		$this->db->update("sal_task",$data);
		$query=$this->db->last_query();
		return true;	
	   }elseif($name =='message'){
		$data = array('read_message' =>'0');
		$this->db->where("message_by",$id);
		$this->db->update("admin_chat",$data);
		$query=$this->db->last_query();
		return $query;	
	   }

	}


public function delete_promo($promoid){
		$this->db->where('id',$promoid);
		$this->db->delete('uf_promo_codes');
	}
       
}