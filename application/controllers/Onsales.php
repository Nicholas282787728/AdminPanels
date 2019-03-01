<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onsales extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	  public function __construct()
     {
          parent::__construct();
		  $this->load->database();
          $this->load->model('Onsale_model');
		  
     }
     
	public function index()
	{	//$this->load->view('ondemand/index');  
		
		if($this->session->userdata('adminlogin')){
			$data['title']='Dashboard :: Home';
			$data['file']='onsales/sales_dashboard';			
			
			$this->load->view('onsales_template',$data);
					
		}else{
			redirect('panels/supermacdaddy/onsales/login');
		}
	}
	/*------------- LOGIN ----------------*/

	public function login(){ //die('got it');
		if($this->session->userdata('adminlogin')){
			redirect('panels/supermacdaddy/onsales');
		}else{
			$data['title']  = 'Login';
			$data['file']	= 'onsales/login';			
			
			$this->load->view('onsales/login');
			
			$username = $this->input->post('ondemand_email');
			$password = $this->input->post('ondemand_password');
			//echo $username .''.$password ; 
			
		
			/**********************************************************/
			if($this->input->post('ondemand_btn') == 'Login'){ 			
				
				$result = $this->Onsale_model->admin_login($username,$password); //print_r($result); die('yes');
				if(!empty($result)){
					$data = array(
							'id' 			=>	$result['id'],
							'display_name' 			=>	$result['display_name'],
							'user_name' 		=>	$result['user_name'],
							'password' 		=>	$result['password'],
							//'profile' 		=>	$result['profile'],
							'adminlogin' 	=> '1'
					);
					$this->session->set_userdata($data);
					$dataDetail = $this->session->userdata(); 
					$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
						redirect('panels/supermacdaddy/onsales/');
				}else{
					$this->session->set_flashdata('errormessage','Invalid credentials..!!');
					redirect('panels/supermacdaddy/onsales/login');
				}
			}
			
		}	 
	}
	
	public function orders(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Orders';
			$data['file']='onsales/orders';	
			$driver_id = $this->session->userdata('id');		
			$data['orders']= $this->Onsale_model->orders($driver_id);
			$this->load->view('onsales_template',$data);
					
		}else{
			redirect('panels/supermacdaddy/onsales/login');
		}
	}
	public function products(){
		if($this->session->userdata('adminlogin')){
			$data['title']='Products';
			$data['file']='onsales/products';	
			$user_id = $this->session->userdata('id');		
			$data['products']= $this->Onsale_model->products($user_id);
			$data['main_categories']= $this->Onsale_model->main_categories();
			
			if(isset($_POST['deactive'])){ 
				$id = $_POST['deactive']; 
				$product = $this->Onsale_model->active_product($id); 
				$this->session->set_flashdata('success_msg', 'Product Activated Successfully');
				redirect("panels/supermacdaddy/onsales/products");
			}
			if(isset($_POST['active'])){ 
			$id = $_POST['active']; 
			$product = $this->Onsale_model->deactive_product($id); 
			$this->session->set_flashdata('success_msg', 'Product Deactivated Successfully');
            redirect("panels/supermacdaddy/onsales/products");
		}
		
		if(isset($_POST['delete_product'])){ 
			 $productid = $_POST['delete_product']; 
			 $product = $this->Onsale_model->delete_product($productid); 
			 $this->session->set_flashdata('success_msg', 'Product Deleted Successfully');
			 redirect("panels/supermacdaddy/onsales/products");
		}
		if(isset($_POST['save_product'])){ 
			$result = $this->Onsale_model->add_product();
     		if($result==true){
     			$this->session->set_flashdata('successmessage', 'Product added successfully.');
     			redirect('panels/supermacdaddy/onsales/products');
     		}
		}
		
			$this->load->view('onsales_template',$data);
					
		}else{
			redirect('panels/supermacdaddy/onsales/login');
		}
	}
	
	public function edit_product(){
		$result = $this->Onsale_model->product_detail();
		//echo "<pre/>"; print_r($result); die('m here');
		echo '
		
		 <div class="col-sm-6">
            <div class="form-group">
                <label>Product Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input  name="product_id"  value="'.$result[0]['id'].'"  type="hidden">
                    <input class="form-control" name="product_name" value="'.$result[0]['product_name'].'" placeholder="Please enter the Product Name" type="text" required="required">
                </div>
            </div>  
        </div>
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Product Category </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                     <select id="input_locale" class="form-control" value="'.$result[0]['product_category'].'" name="product_category" title="Locale" required="required"
                     	<option>--Choose One--</option>
               			<option value="Sativa" if($result[0]["product_category"] == "Sativa") selected>Sativa</option>
            			<option value="Indica" if($result[0]["product_category"] == "Indica") selected>Indica</option>
            			<option value="Hybrid" if($result[0]["product_category"] == "Hybrid") selected>Hybrid</option>	
                     </select>
                </div>
            </div> 
        </div>
         
         <div class="col-sm-6">
            <div class="form-group">
                <label>Product Sub-Category</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <select id="input_locale" class="form-control" name="product_sub_category" title="Locale" required="required"  value="'.$result[0]['product_sub_category'].'">
                    	<option>--Choose One--</option>
                    	<option value="Cookies" if($result[0]["product_sub_category"] == "Cookies") selected>Cookies</option>
            			<option value="Cookies" if($result[0]["product_sub_category"] == "Cookies") selected>Cookies</option>
            			<option value="Flowers" if($result[0]["product_sub_category"] == "Flowers") selected>Flowers</option>
            			<option value="Candy" if($result[0]["product_sub_category"] == "Candy") selected>Candy</option>
            			<option value="Edibles" if($result[0]["product_sub_category"] == "Edibles") selected>Edibles</option>
            			<option value="Beverages" if($result[0]["product_sub_category"] == "Beverages") selected>Beverages</option>
						<option value="Chips" if($result[0]["product_sub_category"] == "Chips") selected>Chips</option>
						<option value="Flowers" if($result[0]["product_sub_category"] == "Flowers") selected>Flowers</option>
						<option value="Cookies" if($result[0]["product_sub_category"] == "Cookies") selected>Cookies</option>
						<option value="Vape Pens" if($result[0]["product_sub_category"] == "Vape Pens") selected>Vape Pens</option>
						<option value="Beverages" if($result[0]["product_sub_category"] == "Beverages") selected>Beverages</option>
					</select>
                </div>
            </div>
        </div>               
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Preparation Time in Hours </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="preparation_time" value="'.$result[0]['preparation_time'].'" placeholder="Enter Preparation Time" type="text" required="required">
                </div>
            </div>
        </div>
                              
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Tax/Patients</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="tax_patients" value="'.$result[0]['tax_patients'].'" placeholder="Enter Tax/Patients" type="text" required="required">
                </div>
            </div>
        </div>
                             
        <div class="col-sm-6">
            <div class="form-group ">
                <label>Happy Hour</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="happy_hour" value="'.$result[0]['happy_hour'].'" placeholder="Enter happy_hour" type="text" required="required">
                </div>  
            </div>
        </div>
         </div>     
      
      
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1G</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k1" value="'.$result[0]['k1'].'" placeholder="Enter k1" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">2G</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k2" value="'.$result[0]['k2'].'" placeholder="Enter k2" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/8</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k3" value="'.$result[0]['k3'].'" placeholder="Enter k3" type="text" required="required">
                </div>
            </div>
        </div>
		<div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/4</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k4" value="'.$result[0]['k4'].'" placeholder="Enter k4" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">1/2</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k5" value="'.$result[0]['k5'].'" placeholder="Enter k5" type="text" required="required">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">OG</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="k6" value="'.$result[0]['k6'].'" placeholder="Enter k6" type="text" required="required">
                </div>
            </div>
        </div> 
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Description</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="product_notes" value="'.$result[0]['product_notes'].'" placeholder="Enter description" type="text" required="required">
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label for="input_locale">Upload Image</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-language"></i></span>
                    <input class="form-control" name="image" value="'.$result[0]['image'].'" type="file" required="required">
                </div>
            </div>  
        </div>
		';
		//echo  json_encode($result);
		
	}

	public function notification(){
		if($this->session->userdata('adminlogin')){
			
			$notification = $this->Onsale_model->notification_history(5); 
			foreach($notification as $val){
			echo '<li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> <b>'.$val['user_name'].'</b><br>'.$val['message'].'
                                    <span class="pull-right text-muted small">'.$val['created_at'].'</span>
                                </div>
                            </a>
                        </li>';	
			}
			echo '<li>
                            <a class="text-center brdr-0" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
		}else{
			redirect('panels/supermacdaddy/onsales/login');
		}
	}
	public function notificationcount(){
			$notification = $this->Onsale_model->notification_history(0); 
			echo count($notification);
	}
	public function tasknotification(){
		if($this->session->userdata('adminlogin')){
			
			$tasknotification = $this->Onsale_model->tasknotification(5); 
			foreach($tasknotification as $val){
            echo '<li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>'.$val['task_name'].'</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>';            	
			}
			echo '<li>
                            <a class="text-center brdr-0" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
		}else{
			redirect('panels/supermacdaddy/onsales/login');
		}
	}
	public function tasknotificationcount(){
			$notification = $this->Onsale_model->tasknotification(0); 
			echo count($notification);
	}
	public function msgnotification(){
		if($this->session->userdata('adminlogin')){
			 
			$notification = $this->Onsale_model->msgnotification(5); 
			foreach($notification as $val){
				
                echo '<li>
                            <a href="#">
                                <div>
                                    <strong>'.$val['display_name'].'</strong>
                                    <span class="pull-right text-muted">
                                        <em>'.$val['message_date'].'</em>
                                    </span>
                                </div>
                                <div> '.$val['message'].'</div>
                            </a>
                        </li>';        
			}
			echo '<li>
                            <a class="text-center brdr-0" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
		}else{
			redirect('panels/supermacdaddy/onsales/login');
		}
	}
	public function msgnotificationcount(){
			$notification = $this->Onsale_model->msgnotification(0); 
			echo count($notification);
	}
	public function chat_history(){
		$id = $this->session->userdata('id');
		$history =$this->Onsale_model->chat_history();
			foreach($history as $val){
				if($val['message_by']==$id){
				
				
				echo '<li class="left clearfix"><span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/Me" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Me</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> '.$val['message_date'].'</small>
                                        </div>
                                        <p>
                                            '.$val['message'].'
                                        </p>
                                    </div>
                                </li>';
				
				}	
				if($val['message_by']!=$id){
						echo '<li class="right clearfix"><span class="chat-img  pull-right"><img src="http://placehold.it/50/55C1E7/'.$val['sender_name'].'" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">'.$val['sender_name'].'</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> '.$val['message_date'].'</small>
                                        </div>
                                        <p>
                                            '.$val['message'].'
                                        </p>
                                    </div>
                                </li>';
				}
				
			}
	 
	}
	public function sendmassage(){
		if($this->session->userdata('adminlogin')){
			$data =$this->Onsale_model->sendmassage();
		 }else{
			redirect("/login");	
		 }
		
	}
	public function drivers()
	{
		$data['title']='Drivers';
		$data['file'] = 'onsales/drivers';
		$data['drivers']= $this->Onsale_model->drivers();
		$this->load->view('onsales_template', $data);
	}
	public function logout(){            
        $this->session->unset_userdata('login');
        $this->session->sess_destroy();
        redirect('panels/supermacdaddy/onsales');         
    }
}
 