<?php
class Onadmin_model extends CI_Model {

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
	public function tasknotification($limit){
		$this->db->select('*');
		$this->db->from('sal_task');
		$this->db->order_by("sal_task.id", "desc");	
		if($limit!=0){
			$this->db->limit(5);
		}
		$this->db->join('sal_login', 'sal_login.uid = sal_task.staff_id', 'left');
		$query = $this->db->get();
		$resultarray = $query->result_array();  
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
          $res = $query->result_array(); //echo "<pre>"; print_r($res); die('got');
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
        
        $config['upload_path']   = '/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        
        $this->load->library('upload' , $config);
        $this->upload->do_upload('image');
        $files = $_FILES;
        $imgpath = "http://meddev.imvisile.com/uploads/".$files['image']['name'];
		
			
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
		
		$this->db->select('*');
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
				'flag_enabled'  => 0,
				'pass_encrpt'   =>sha1($this->input->post('email')),

			);  echo "<pre>"; print_r($data);
		
		$this->db->insert('authenticated_users',$data);
		$id = $this->db->insert_id(); 
		return $id;
	}
       
}