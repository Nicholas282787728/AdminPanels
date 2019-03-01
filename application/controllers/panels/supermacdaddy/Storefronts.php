<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storefronts extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('Store_model');
		$this->load->model('common_model');
		$this->load->model('Store_model');
		$this->load->model('Dashboard_model');
		$this->load->library('encrypt');
       $this->load->library('form_validation');
		require_once APPPATH . 'third_party/PHPExcel.php';
		  $this->excel = new PHPExcel();
		// require_once APPPATH . 'third_party/PHPExcel.php';
		// $this->excel = new PHPExcel();
		$user_type = $this->session->userdata('adminlogin');


		if ($this->session->userdata('adminlogin')) {
			if (!empty($user_type) && ($user_type == '0' || $user_type == '2' || $user_type == '1' || $user_type == '4')){
				redirect('panels/supermacdaddy/dashboard/admin');
			}
		}
		else
		{
			redirect('/');
		}
	}

	public function index() {
		$user_type = $this->session->userdata('adminlogin');

		if ($user_type == '3' || $user_type == '5') {
			$id = $this->session->userdata('id');
			$data['title'] = 'Dashboard :: Home';
			$data['file'] = 'storefronts/index';
			// $data['notification'] = $this->Store_model->notification_history(5,$id); 
			//$data['supportCount'] = $this->Store_model->recordsCount($id,'ost_ticket__cdata');
			$data['usercount'] = $this->Store_model->user_count();
			$data['usertype_count'] = $this->Store_model->usertype_count();
			$data['provider_usertype_count'] = $this->Store_model->Provider_usertype_count();
			$data['notification'] = $this->Store_model->notification_history(10);
			$data['allAdmins'] = $this->Store_model->getAdminIds(array('user_type' => '5'));

			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function service_update() {
		if (isset($_REQUEST['services_type'])) {
			$id = $this->session->userdata('id');
			$dataarr = array("service_type" => $this->input->post('services_name'), "service_date" => date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$this->db->update(' uf_user', $dataarr);
			$this->session->set_flashdata('successmessage', 'Services update Successfully.');
		}
		redirect('panels/supermacdaddy/storefronts');
	}

	public function visibility() {
		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'Visibility';
			$data['file'] = 'storefronts/visibility';
			
			
			// Why this doctor modal Load hear
			$this->load->model('Doctor_model');
			
			 $user_id = $this->session->userdata('id');
			$where = array('id' => $user_id);
			$data['getOpt'] = $this->Store_model->getOptData('uf_user',$where);
			
			$data['getvisibility'] = $this->Store_model->get_visibility_data($user_id);
			$data['optin'] = $this->Store_model->savetosdata('optin');
			$data['optout'] = $this->Store_model->savetosdata('optout');

			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('/');
		}
	}
	
		public function opt_in_out_status() {
			$userid = $this->session->userdata('id');
			$opt_in_out = $_REQUEST['opt_in_out'];
			$data_user = array('opt_in_out' => $opt_in_out);
			$this->db->where('user_id', $userid);
			$this->db->update('cp_locations', $data_user);

			$this->db->where('id', $userid);
			$this->db->update('uf_user', $data_user);
			redirect('storefronts-visibility');
		}

	public function visibility_action() {

		$created_id = $this->session->userdata('id');
		$date = date('Y-m-d H:i:s');

		if (isset($_POST['save_change'])) {
			$image = "";
			if ($_FILES["image"]["name"] != "") {
				$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				$path = 'uploads';
				$this->upload_image($image, $path);
			}
			$data_arr = array(
				'location_name' => $this->input->post('location_name'),
				'opening_hour' => $this->input->post('opening_hrs'),
				'closing_hour' => $this->input->post('closing_hours'),
				'postal_code' => $this->input->post('postal_code'),
				'city' => $this->input->post('city'),
				'country_code' => $this->input->post('country_code'),
				'paypal_business_name' => $this->input->post('paypal_business'),
				'paypal_client_id' => $this->input->post('paypal_id'),
				'email' => $this->input->post('email'),
				'time_zone' => $this->input->post('time_zone'),
				'phone_number' => $this->input->post('phone_no'),
				'patient_tax' => $this->input->post('patient_tax'),
				'adult_use_tax' => $this->input->post('adult_use_tax'),
				'logo' => $image,
				'address' => $this->input->post('address'),
				'latitude' => $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),
				'longitude' => $this->input->post('longitude'),
				'user_id' => $created_id,
				'update_by' => $created_id,
				'created_date' => $date,
				'update_date' => $date,
			);
		
			$userdata = array('state' => $this->input->post('location_name'),
				'address' => $this->input->post('address'),
				'user_lat' => $this->input->post('latitude'),
				'user_long' => $this->input->post('longitude'),
				'zip' => $this->input->post('postal_code'),
				'city' => $this->input->post('city'),
				'mob_number' => $this->input->post('phone_no'));

				$created_id = $this->session->userdata('id');
			$where = array('id' => $created_id);
		
			
			 $this->Store_model->userdetilUpdate('uf_user',$userdata,$where);

			$insert = $this->common_model->insert_record($data_arr, 'cp_locations');
			$userid = $this->session->userdata('id');

		$data_user = array('opening_hour' => $this->input->post('opening_hrs'),
			'logo' => $image,
				'closing_hour' => $this->input->post('closing_hours'));

		
			$this->db->where('id', $userid);
			$this->db->update('uf_user', $data_user);

			$this->Store_model->recentActivity('visibility is  added Successfully.');
			$this->session->set_flashdata('successmessage', 'Save Successfully..!');
		}
		if (isset($_POST['update_change'])) {
			$image = $this->input->post('old_image');
			if ($_FILES["image"]["name"] != "") {
				$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				$path = 'uploads';
				$this->upload_image($image, $path);
			}
			$data_uparr = array(
				'location_name' => $this->input->post('location_name'),
				'opening_hour' => $this->input->post('opening_hrs'),
				'closing_hour' => $this->input->post('closing_hours'),
				'postal_code' => $this->input->post('postal_code'),
				'city' => $this->input->post('city'),
				'paypal_business_name' => $this->input->post('paypal_business'),
				'country_code' => $this->input->post('country_code'),
				'paypal_client_id' => $this->input->post('paypal_id'),
				'email' => $this->input->post('email'),
				'time_zone' => $this->input->post('time_zone'),
				'phone_number' => $this->input->post('phone_no'),
				'patient_tax' => $this->input->post('patient_tax'),
				'adult_use_tax' => $this->input->post('adult_use_tax'),
				'logo' => $image,
				'address' => $this->input->post('address'),
				'latitude' => $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),
				'update_by' => $created_id,
				'update_date' => $date,
			);
			$userdata = array('state' => $this->input->post('location_name'),
				'address' => $this->input->post('address'),
				'user_lat' => $this->input->post('latitude'),
				'user_long' => $this->input->post('longitude'),
				'zip' => $this->input->post('postal_code'),
				'city' => $this->input->post('city'),
				'mob_number' => $this->input->post('phone_no'));

				$created_id = $this->session->userdata('id');
			$where = array('id' => $created_id);
		
			
			 $this->Store_model->userdetilUpdate('uf_user',$userdata,$where);

			$this->db->where('loc_id', $this->input->post('loc_id'));
			$this->db->update('cp_locations', $data_uparr);

		$data_user = array('opening_hour' => $this->input->post('opening_hrs'),
			'logo' => $image,
				'closing_hour' => $this->input->post('closing_hours'));
$userid = $this->session->userdata('id');
		
			$this->db->where('id', $userid);
			$this->db->update('uf_user', $data_user);

			$historydata_arr = array("user_id" => $created_id, "message" => "Visibility !  Update Company Details Successfully.", "created_at" => $date);
			$this->common_model->insert_record($historydata_arr, 'history');

			$this->session->set_flashdata('successmessage', 'Update Successfully..!');
		}
		redirect('storefronts-visibility');
	}

	public function orders() {
		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'Orders';
			$data['file'] = 'storefronts/orders';
			$driver_id = $this->session->userdata('id');
			$data['orders'] = $this->Store_model->orders($driver_id);
			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('/');
		}
	}



	public function products() {
		
		$data['title'] = 'Products';
		$data['file'] = 'storefronts/products';
		
		$user_id = $this->session->userdata('id');
		$data['products'] = $this->Store_model->products($user_id);
		// $products = $this->Store_model->products($user_id);
		// echo "<pre>"; print_r($products);
		// die();
		$data['main_categories'] = $this->Store_model->main_categories();

		if (isset($_POST['deactive'])) {
			$id = $_POST['deactive'];
			$product = $this->Store_model->active_product($id);
			$this->session->set_flashdata('successmessage', 'Product Activated Successfully');
			redirect("panels/supermacdaddy/storefronts/products");
		}
		if (isset($_POST['active'])) {
			$id = $_POST['active'];
			$product = $this->Store_model->deactive_product($id);
			$this->session->set_flashdata('successmessage', 'Product Deactivated Successfully');
			redirect("panels/supermacdaddy/storefronts/products");
		}

		if (isset($_POST['delete_product'])) {
			$productid = $_POST['delete_product'];
			$product = $this->Store_model->delete_product($productid);
			$this->session->set_flashdata('successmessage', 'Product Deleted Successfully');
			redirect("panels/supermacdaddy/storefronts/products");
		}
		if (isset($_POST['save_product'])) {



			$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
			$path = 'uploads';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$config['overwrite'] = FALSE;
			$config['file_name'] = $image;
			$config['max_size'] = '1000000';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('image')) {
				$data = array(
					'user_id' => $this->session->userdata('id'),
					'product_type' => 'Driver',
					'location_id' => $this->session->userdata('id'),
					'product_name' => $this->input->post('product_name'),
					'product_category' => $this->input->post('product_category'),
					//'product_sub_category' => $this->input->post('product_sub_category'),
					'preparation_time' => $this->input->post('preparation_time'),
					//                        'tax_patients'              => $this->input->post('tax_patients'),
					'happy_hour' => !empty($this->input->post('happy_hour')) ? $this->input->post('happy_hour') : '',
					'happy_day' => !empty($this->input->post('happy_day')) ? $this->input->post('happy_day') : '',
					'happy_time_to' => !empty($this->input->post('happy_time_to')) ? $this->input->post('happy_time_to') : '',
					'happy_time_from' => !empty($this->input->post('happy_time_from')) ? $this->input->post('happy_time_from') : '',
					'image' => $image,
					'product_notes' => $this->input->post('product_notes'),
					'amt_d_price' => !empty($this->input->post('amt_d_price')) ? $this->input->post('amt_d_price') : ''
				);
				$result = $this->Store_model->add_product($data);
				if ($result) {
					$product_name = $this->input->post('product_name');
					// $messageValue = 'The Product ' . $product_name . ' is added  is added by ';
					// $this->Store_model->notification_add($messageValue);
					$this->session->set_flashdata('successmessage', 'Product added successfully.');
					redirect('storefronts-products');
				} else {
					$this->session->set_flashdata('errormessage', 'Product not inserted.');
					redirect('storefronts-products');
				}
			} else {
				$this->session->set_flashdata('errormessage', 'Product image is not upload something went wrong.'.$this->upload->display_errors());
				redirect('storefronts-products');
			}
			redirect('storefronts-products');
		}

		if (isset($_POST['update'])) {
			
			$image = $this->input->post('image');
			if (!empty($_FILES['image']['name'])) {

				$imgpath = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				$path = 'uploads';
				
				$config['upload_path'] = $path;
				$config['allowed_types'] = '*';
				$config['overwrite'] = FALSE;
				$config['file_name'] = $imgpath;
				$config['max_size'] = '1000000';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('image')) {
					
				} else {
					$this->session->set_flashdata('errormessage', 'Product image is not upload something went wrong.'.$this->upload->display_errors());
					redirect('panels/supermacdaddy/storefronts/products');
				}
			} else {
				$imgpath = $this->input->post('hiddenimage');
			}
			
			$id = $this->input->post('product_id');

			$imgpath1 = base_url().'uploads/'.$imgpath;

			$data_product = array(
				'product_type' => 'Driver',
				'product_name' => $this->input->post('product_name'),
				'product_category' => $this->input->post('product_category'),
				// 'product_sub_category' => $this->input->post('product_sub_category'),
				'preparation_time' => $this->input->post('preparation_time'),
				//'tax_patients'              => $this->input->post('tax_patients'),
				'happy_hour' => $this->input->post('happy_hour'),
				'happy_day' => $this->input->post('happy_day'),
				'happy_time_to' => $this->input->post('happy_time_to'),
				'happy_time_from' => $this->input->post('happy_time_from'),
				'image' => $imgpath,
				'image_url' => $imgpath1,
				'product_notes' => $this->input->post('product_notes'),
				'amt_d_price' => !empty($this->input->post('amt_d_price')) ? $this->input->post('amt_d_price') : ''

			);
			$result = $this->Store_model->update_product($data_product, $id);
			if ($result == true) {
				$this->session->set_flashdata('successmessage', 'Product added successfully.');
				redirect('panels/supermacdaddy/storefronts/products');
			} else {
				$this->session->set_flashdata('errormessage', 'Product not inserted.');
				redirect('panels/supermacdaddy/storefronts/products');
			}

		}
		$this->load->view('storefronts_templates', $data);
	}

	public function getsubCategory() {
		$id = $this->input->post('id');
		$result = $this->Store_model->getsubCategoryData($id);
		$data = '<option>--Choose One--</option>';
		if (count($result)) {
			foreach ($result as $r) {
				$data .= " <option value=" . $r->id . ">" . $r->sub_category . "</option>";
			}
		}
		echo $data;
	}

	public function edit_product() {
		$result = $this->Store_model->product_detail();

		$productId = $result[0]['product_category'];
		
		$main_categories = $this->Store_model->main_categories();
		$main = '<option>--Choose One--</option>';
		foreach ($main_categories as $single) {
			$selected = ($single['id'] == $result[0]['product_category']) ? "selected" : "";
			$main .= ' <option value="' . $single['id'] . '" ' . $selected . '>' . $single['name'] . '</option>';
		}
		
		$getsubCategory = $this->Store_model->getsubCategoryData($productId);
		$subCata = '<option>--Choose One--</option>';
		if (count($getsubCategory)) {

			foreach ($getsubCategory as $g) {
				$selected = ($g->id == $result[0]['product_sub_category']) ? "selected" : "";
				$subCata .= " <option value='" . $g->id . "' " . $selected . ">" . $g->sub_category . "</option>";
			}
		}

		$image = $result[0]['image'];
		$checked = ($result[0]['happy_hour'] == "1") ? 'checked' : '';
		echo '<div class="col-sm-6">
					<div class="form-group">
						<label>Product Name</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input  name="product_id"  value="' . $result[0]['pid'] . '"  type="hidden">
							<input class="form-control" name="product_name" value="' . $result[0]['product_name'] . '" placeholder="Please enter the Product Name" type="text" required="required">
						</div>
					</div>  
				</div>
				<div class="col-sm-6">
					<div class="form-group ">
						<label>Product Category </label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
								<select id="input_locale" class="form-control mainCategoryChanges" value="' . $result[0]['product_category'] . '" name="product_category" title="Locale" required="required">
									' . $main . '
								</select>
						</div>
					</div> 
				</div>

			             
				<div class="col-sm-6">
					<div class="form-group ">
						<label>Preparation Time in Hours </label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
						   <select name="preparation_time" class="form-control " required="required">
								<option value="10" ' . (($result[0]["preparation_time"] == '10') ? 'selected=""' : "") . '>10 mins</option>
								<option value="20" ' . (($result[0]["preparation_time"] == '20') ? 'selected=""' : "") . '>20 mins</option>
								<option value="30" ' . (($result[0]["preparation_time"] == '30') ? 'selected=""' : "") . '>30 mins</option>
								<option value="60" ' . (($result[0]["preparation_time"] == '60') ? 'selected=""' : "") . '>60 mins</option>
							</select> 
						</div>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group ">
						<label>Amount & Price</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<input class="form-control" name="amt_d_price" value="' . $result[0]['amt_d_price'] . '" placeholder="Enter Amont" type="text" required="required">
						</div>
					</div>
				</div>
				

			   <div class="col-sm-6">
					 <label>Happy Hour</label>
					 <div class="form-check">
						<label class="form-check-label">
							<input  name="happy_hour" id="" class="happu_hour" type="checkbox" value="' . $result[0]['happy_hour'] . '" ' . $checked . '>
							Happy Hour specials
						</label>
					  </div>
				</div>
			</div>     
			<div class="col-sm-12 display_hidden" style="padding: 0px;' . (($result[0]["happy_hour"] == '0') ? 'display:none;' : "") . '">
				<div class="col-sm-6">
					 <label>Day </label>
					<div class="form-group ">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<select name="happy_day" class="form-control display_disabled" style="width:100%" ' . (($result[0]["happy_hour"] == '0') ? 'disabled=""' : "") . '>
							   <option value="Monday" ' . (($result[0]["happy_day"] == 'Monday') ? 'selected="selected"' : "") . '>Monday</option>
							   <option value="Tuesday" ' . (($result[0]["happy_day"] == 'Tuesday') ? 'selected="selected"' : "") . '>Tuesday</option>
							   <option value="Wednesday" ' . (($result[0]["happy_day"] == 'Wednesday') ? 'selected="selected"' : "") . '>Wednesday</option>
							   <option value="Thursday" ' . (($result[0]["happy_day"] == 'Thursday') ? 'selected="selected"' : "") . '>Thursday</option>
							   <option value="Friday" ' . (($result[0]["happy_day"] == 'Friday') ? 'selected="selected"' : "") . '>Friday</option>
							   <option value="Saturday" ' . (($result[0]["happy_day"] == 'Saturday') ? 'selected="selected"' : "") . '>Saturday</option>
							   <option value="Sunday" ' . (($result[0]["happy_day"] == 'Sunday') ? 'selected="selected"' : "") . '>Sunday</option>
						   </select>
					   </div>
				   </div>
				</div>
				<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-6" >
						<label>To</label>
						<input class="form-control display_disabled" name="happy_time_to"  value="' . $result[0]['happy_time_to'] . '" type="time" required="" ' . (($result[0]["happy_hour"] == '0') ? 'disabled=""' : "") . '>
					</div>
					<div class="col-sm-6">
						<label>From</label>
						<input class="form-control display_disabled" name="happy_time_from"  value="' . $result[0]['happy_time_from'] . '" type="time" required="" ' . (($result[0]["happy_hour"] == '0') ? 'disabled=""' : "") . '>
					</div>
					</div>
			   </div>
			</div>
			<div class="col-sm-12 " >
			<div class="row">
				<div class="col-sm-6">
				
					<div class="form-group">
						<label for="input_locale">1G</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-language"></i></span>
							<input class="form-control" name="k1" value="' . $result[0]['k1'] . '" placeholder="10$" type="text" >
						</div>
					</div>
					
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label for="input_locale">2g s</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-language"></i></span>
							<input class="form-control" name="k2" value="' . $result[0]['k2'] . '" placeholder="30$" type="text" >
						</div>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label for="input_locale">3.5g s</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-language"></i></span>
							<input class="form-control" name="k3" value="' . $result[0]['k3'] . '" placeholder="45$" type="text" >
						</div>
					</div>
				</div>

					<div class="col-sm-6">
					<div class="form-group">
						<label for="input_locale">7g s</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-language"></i></span>
							<input class="form-control" name="k4" value="' . $result[0]['k4'] . '" placeholder="60$" type="text" >
						</div>
					</div>
				</div>

					<div class="col-sm-6">
					<div class="form-group">
						<label for="input_locale">14g s</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-language"></i></span>
							<input class="form-control" name="k5" value="' . $result[0]['k5'] . '" placeholder="100$" type="text" >
						</div>
					</div>
				</div>

					<div class="col-sm-6">
					<div class="form-group">
						<label for="input_locale">1oz</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-language"></i></span>
							<input class="form-control" name="k6" value="' . $result[0]['k6'] . '" placeholder="180$" type="text" >
						</div>
					</div>
				</div>

				 <div class="col-sm-6">
					<div class="form-group">
						<label for="input_locale">Description</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-language"></i></span>
							<input class="form-control" name="product_notes" value="' . $result[0]['product_notes'] . '" placeholder="Enter description" type="text" required="required">
						</div>
					</div>
				 </div>
				 <div class="col-sm-6">
					<div class="form-group">
						<label for="input_locale">Upload Image</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-language"></i></span>
							<input class="form-control" name="image" type="file" >

						</div>
					</div>  
					   <div class="form-group">

					   <input type="hidden" name="hiddenimage" value="' . $result[0]['image'] . '">
					   <img src="' . $result[0]['image_url'] . '" width="100px" height="100px">
					</div> 
					</div>
				</div>
			</div>';
		//echo  json_encode($result);
	}

	public function support_tickets() {

		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'Support Ticket';
			$data['file'] = 'storefronts/support_tickets';
			$data['ticket_id'] = $this->input->get('id');
			if (isset($_POST['createdticket'])) {
				$id = $this->session->userdata('id');
				$ticket_email = $this->input->post('ticket_email');
				$ticket_sub = $this->input->post('ticket_sub');
				$message_ticket = $this->input->post('message_ticket');
				$date = date('Y-m-d H:i:s');
				if (!empty($message_ticket) && $message_ticket != "<br>" && $_FILES["image"]["name"] != '') {
					$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
					$path = './uploads/';
					$this->upload_image($image, $path);

					$data_arr = array(
						"user_id" => $id,
						"email" => $ticket_email,
						"subject" => $ticket_sub,
						"message" => $message_ticket,
						"attach" => $image,
						"created_date" => $date,
					);
					$this->db->insert("ost_ticket__cdata", $data_arr);
					$messageValue = 'The Support Ticket is Raised by ';
					$this->Store_model->notification_add($messageValue);
					$this->session->set_flashdata('successmessage', 'created ticket successfully');
					redirect("panels/supermacdaddy/storefronts/support_tickets");
				} else {
					$this->session->set_flashdata('errormessage', 'Empty Details..!');
					redirect("panels/supermacdaddy/storefronts/support_tickets");
				}
			} else if (isset($_POST['updateticket'])) {
				$ticket_no = $this->input->post('ticket_no');
				$ticket_sub = $this->input->post('ticket_sub');
				$message_ticket = $this->input->post('message_ticket');

				$old_image = $this->input->post('old_image');
				if (!empty($message_ticket) && $message_ticket != "<br>") {
					$image = $old_image;
					if ($_FILES["image"]["name"] != '') {
						$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
						$path = './uploads/';
						$this->upload_image($image, $path);
					}
					$data_arr = array(
						"subject" => $ticket_sub,
						"message" => $message_ticket,
						"attach" => $image,
					);

					$this->db->where('ticket_id', $ticket_no);
					$resultarray = $this->db->update('ost_ticket__cdata', $data_arr);

					$this->session->set_flashdata('successmessage', 'update ticket successfully');
					redirect("panels/supermacdaddy/storefronts/support_tickets");
				} else {
					$this->session->set_flashdata('errormessage', 'Empty Details..!');
					redirect("panels/supermacdaddy/storefronts/support_tickets");
				}
			} else if (isset($_POST['process'])) {
				$uid = $_POST['process'];
				$data = array("status" => '1');
				$this->db->where('ticket_id', $uid);
				$this->db->update('ost_ticket__cdata', $data);
				$this->db->last_query();
				$this->session->set_flashdata('successmessage', 'Proccess successfully');
				redirect("panels/supermacdaddy/storefronts/support_tickets");
			} elseif (isset($_POST['completed'])) {
				$uid = $_POST['completed'];
				$data = array("status" => '2');
				$this->db->where('ticket_id', $uid);
				$this->db->update('ost_ticket__cdata', $data);
				$this->session->set_flashdata('successmessage', 'Completed successfully');
				redirect("panels/supermacdaddy/storefronts/support_tickets");
			}
			$data['last_ticket_no'] = $this->Store_model->last_ticket_no();
			$data['list_ticket_data'] = $this->Store_model->list_ticket_data();
			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function edit_ticket() {
		$id = $this->input->post('ticket_id');
		$edit_data = $this->Store_model->edit_tickit_data($id);
		echo '<div class="col-sm-12">
					<div class="form-group">
						<label>Ticket No </label>
						<div class="input-group">
							<input class="form-control " type="text" name="ticket_no" readonly="" value="' . $id . '" required="" >
						</div>
					</div>

					<div class="form-group">
						<label>Subject </label>
						<div class="input-group">
							<input class="form-control" type="text" name="ticket_sub" style="width:100% !important;min-width:530px" value="' . $edit_data['subject'] . '" required="">
						</div>
					</div>
					<div class="form-group">
						<label>Message</label>
						<div class="input-group">
							<textarea class="form-control" id="edit_message_ticket" name="message_ticket" rows="4" cols="20" style="width:530% !important; height:100%;">' . $edit_data['message'] . '</textarea>
						</div>
					</div>
					<div class="form-group">
						<label>Attach File </label>
						<div class="input-group">
							<input type="file" name="image" >
							<input type="hidden" name="old_image" value="' . $edit_data['attach'] . '" >
						</div>
					</div>
				</div>';
	}

	public function delete_ticket($ticket_id) {
		$this->db->where('ticket_id', $ticket_id);
		$this->db->delete('ost_ticket__cdata');
		$this->session->set_flashdata('successmessage', 'Deleted successfully');
		redirect("panels/supermacdaddy/storefronts/support_tickets");
	}

	public function ticket_replay($ticket_no) {
		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'Ticket Comment';
			$data['file'] = 'storefronts/ticket_replay';
			$data['ticket_no'] = $ticket_no;
			if (isset($_POST['replay_btn'])) {
				$comment_ticket = $this->input->post('comment_ticket');
				$date = date('Y-m-d H:i:s');
				$data_arr = array(
					"ticket_id" => $ticket_no,
					"comment" => $comment_ticket,
					"commentator_id" => $this->session->userdata('id'),
					"created_date" => $date,
				);
				$this->db->insert("ticket_comment", $data_arr);
				$this->session->set_flashdata('successmessage', 'send successfully');
				redirect("panels/supermacdaddy/storefronts/ticket_replay/$ticket_no");
			}
			$data['list_ticket_comment'] = $this->Store_model->list_ticket_comment($ticket_no);
			$data['ticket_file'] = $this->Dashboard_model->ticket_file($ticket_no);
			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('/');
		}
	}

	// public function notification(){
	// 	if($this->session->userdata('adminlogin')){
	// 		$id=$this->input->post('id');
	// 		$notification = $this->Store_model->notification_history(5,$id); 
	// 		foreach($notification as $val){
	// 		echo '<li>
	//                            <a href="#">
	//                                <div>
	//                                    <i class="fa fa-envelope fa-fw"></i> <b>'.$val['user_name'].'</b><br>'.$val['message'].'
	//                                    <span class="pull-right text-muted small">'.$val['created_at'].'</span>
	//                                </div>
	//                            </a>
	//                        </li>';	
	// 		}
	// 		echo '<li>
	//                            <a class="text-center brdr-0" href="'.base_url('panels/supermacdaddy/storefronts/notifications').'">
	//                                <strong>View All</strong>
	//                                <i class="fa fa-angle-right"></i>
	//                            </a>
	//                        </li>';
	// 	}else{
	// 		redirect('/');
	// 	}
	// }
	// public function notificationcount(){
	// 				$id=$this->session->userdata('id');
	// 		$notification = $this->Store_model->notification_history_user(0,$id); 
	// 		echo count($notification);
	// }
	// public function tasknotification(){
	// 	if($this->session->userdata('adminlogin')){
	// 		$id=$this->session->userdata('id');
	// 		$tasknotification = $this->Store_model->tasknotification(5, $id); 
	// 		foreach($tasknotification as $val){
	//            echo '<li>
	//                            <a href="javascript:void(0)">
	//                                <div>
	//                                    <p>
	//                                        <strong>'.$val['task_name'].'</strong>
	//                                        <span class="pull-right text-muted">40% Complete</span>
	//                                    </p>
	//                                    <div class="progress progress-striped active">
	//                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
	//                                            <span class="sr-only">40% Complete (success)</span>
	//                                        </div>
	//                                    </div>
	//                                </div>
	//                            </a>
	//                        </li>';            	
	// 		}
	// 		echo '<li>
	//                            <a class="text-center brdr-0" href="'.base_url('panels/supermacdaddy/storefronts/tasks').'">
	//                                <strong>See All Tasks</strong>
	//                                <i class="fa fa-angle-right"></i>
	//                            </a>
	//                        </li>';
	// 	}else{
	// 		redirect('/');
	// 	}
	// }
	// public function tasknotificationcount(){
	// 	   $id=$this->session->userdata('id');
	// 		$notification = $this->Store_model->tasknotification_message(0,$id); 
	// 		echo count($notification);
	// }
	// public function tasks(){
	// 	    $data['title'] = 'Dashboard :: Tasks';
	// 	$data['file'] = 'storefronts/tasks';
	// 	$data['tasks'] = $this->Store_model->task_list();
	// 	$tasks = $this->Store_model->task_list();
	// 	if (isset($_POST['update_read_status'])) {
	// 		$uid = $_POST['update_read_status'];
	// 		$dataa = array("read_status" => '1');
	// 		$this->db->where('id', $uid);
	// 		$this->db->update('sal_task', $dataa);
	// 		$this->session->set_flashdata('successmessage', 'Task is Read successfully');
	// 		redirect("panels/supermacdaddy/storefronts/tasks");
	// 	}
	// 	$this->load->view('storefronts_templates', $data);
	// }
	// public function msgnotification(){
	// 	if($this->session->userdata('adminlogin')){
	// 		 $id=$this->session->userdata('id');
	// 		$notification = $this->Store_model->msgnotification(5,$id); 
	// 		foreach($notification as $val){
	//                echo '<li>
	//                            <a href="#">
	//                                <div>
	//                                    <strong>'.$val['display_name'].'</strong>
	//                                    <span class="pull-right text-muted">
	//                                        <em>'.$val['message_date'].'</em>
	//                                    </span>
	//                                </div>
	//                                <div> '.$val['message'].'</div>
	//                            </a>
	//                        </li>';        
	// 		}
	// 		echo '<li>
	//                            <a class="text-center brdr-0" href="'.base_url('panels/supermacdaddy/storefronts').'">
	//                                <strong>Read All Messages</strong>
	//                                <i class="fa fa-angle-right"></i>
	//                            </a>
	//                        </li>';
	// 	}else{
	// 		redirect('/');
	// 	}
	// }
	// public function msgnotificationcount(){
	// 	    $id=$this->session->userdata('id');
	// 		$notification = $this->Store_model->msgnotification_message(0,$id); 
	// 		echo count($notification);
	// }


	public function notification() {
		if ($this->session->userdata('adminlogin')) {
			$id = $this->input->post('id');

			$notification = $this->Store_model->notification_history(5, $id);
			foreach ($notification as $val) {
				echo '<li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> <b>' . $val['user_name'] . '</b><br>' . $val['message'] . '
                                    <span class="pull-right text-muted small">' . $val['created_at'] . '</span>
                                </div>
                            </a>
                        </li>';
			}
			echo '<li>
                            <a class="text-center brdr-0" href="' . base_url('panels/supermacdaddy/storefronts/notifications') . '">
                                <strong>View All</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
		} else {
			redirect('/');
		}
	}

	public function notificationcount() {
		$id = $this->session->userdata('id');
		$notification = $this->Store_model->notification_history_user(0, $id);
		echo count($notification);
	}

	public function tasknotification() {
		if ($this->session->userdata('adminlogin')) {
			$id = $this->session->userdata('id');
			$tasknotification = $this->Store_model->tasknotification(5, $id);
			foreach ($tasknotification as $val) {
				echo '<li>
                            <a href="javascript:void(0)">
                                <div>
                                    <p>
                                        <strong>' . $val['task_name'] . '</strong>
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
                            <a class="text-center brdr-0" href="' . base_url('panels/supermacdaddy/storefronts/tasks') . '">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
		} else {
			redirect('/');
		}
	}

	public function tasknotificationcount() {
		$id = $this->session->userdata('id');
		$notification = $this->Store_model->tasknotification_message(0, $id);
		echo count($notification);
	}

	public function tasks() {
		$data['title'] = 'Dashboard :: Tasks';
		$data['file'] = 'storefronts/tasks';
		$data['tasks'] = $this->Store_model->task_list();
		$tasks = $this->Store_model->task_list();

		if (isset($_POST['update_read_status'])) {
			$uid = $_POST['update_read_status'];
			$dataa = array("read_status" => '1');
			$this->db->where('id', $uid);
			$this->db->update('sal_task', $dataa);
			$this->Store_model->recentActivity(' Task is Read successfully.');

			$this->session->set_flashdata('successmessage', 'Task is Read successfully');
			redirect("panels/supermacdaddy/storefronts/tasks");
		}
		$this->load->view('storefronts_templates', $data);
	}

	public function msgnotification() {
		if ($this->session->userdata('adminlogin')) {
			$id = $this->session->userdata('id');
			$notification = $this->Store_model->msgnotification(5, $id);
			echo ' <li><a href="javascript:void(0);"  data-toggle="modal" data-target="#composemail" ><i class="fa fa-envelope" aria-hidden="true"></i> Compose</a>
                        </li>';
			foreach ($notification as $val) {

				echo '<li>
                            <a href="#">
                                <div>
                                    <strong>' . $val['display_name'] . '</strong>
                                    <span class="pull-right text-muted">
                                        <em>' . $val['message_date'] . '</em>
                                    </span>
                                </div>
                                <div> ' . $val['message'] . '</div>
                            </a>
                        </li>';
			}
			echo '<li>
                            <a class="text-center brdr-0" href="' . base_url('panels/supermacdaddy/storefronts') . '">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
		} else {
			redirect('/');
		}
	}

	public function msgnotificationcount() {
		$id = $this->session->userdata('id');
		$notification = $this->Store_model->msgnotification_message(0, $id);
		echo count($notification);
	}

	public function chat_history() {
		$result = "";
		$id = $this->session->userdata('id');
		$adminIds = $this->Store_model->getAdminIds(array('user_type' => '5'));
		foreach ($adminIds as $a) {
			$baseAdminId = $a->id;
			$history = $this->Store_model->chat_history($baseAdminId);
			if (count($history) > 0) {
				$data = '';
				foreach ($history as $val) {
					if ($val['message_by'] == $id) {
						$data .= '<li class="left clearfix"><span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/Me" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Me</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> ' . $val['message_date'] . '</small>
                                        </div>
                                        <p>
                                            ' . $val['message'] . '
                                        </p>
                                    </div>
                                </li>';
					} else {
						$data .= '<li class="right clearfix"><span class="chat-img  pull-right"><img src="http://placehold.it/50/55C1E7/' . $val['sender_name'] . '" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">' . $val['sender_name'] . '</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> ' . $val['message_date'] . '</small>
                                        </div>
                                        <p>
                                            ' . $val['message'] . '
                                        </p>
                                    </div>
                                </li>';
					}
				}
				$result[$baseAdminId] = $data;
			}
		}
		echo json_encode($result);
	}

	public function sendmassage() {
		if ($this->session->userdata('adminlogin')) {
			$data = $this->Store_model->sendmassage();
		} else {
			redirect("/login");
		}
	}

	public function drivers() {
		$data['title'] = 'Drivers';
		$data['file'] = 'storefronts/drivers';
		$data['drivers'] = $this->Store_model->drivers();
		$this->load->view('storefronts_templates', $data);
	}

	public function logout() {
//        $this->session->unset_userdata('login');
//        $this->session->sess_destroy();
//        redirect('panels/supermacdaddy/storefronts');   
		$data = array(
			'id' => "",
			'name' => "",
			'username' => "",
			'password' => "",
			'title' => "",
			'adminlogin' => "",
		);
		$this->session->set_userdata($data);
		$this->session->unset_userdata('login');
		$this->session->sess_destroy();
		redirect('/');
	}

	public function aut_users() {
		$result = $this->Store_model->aut_users_detail();
		echo '<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>User Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control" name="name" autocomplete="off" value="' . $result->user_name . '"  placeholder="" type="text">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Display Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control"  name="display_name" autocomplete="off" value="' . $result->display_name . '" placeholder="Please enter the Display Name" type="text">
								</div>
							</div>
						</div>
										 
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Email</label>
								<div class="input-group">
									<span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
									<input class="form-control" name="email" autocomplete="off" value="' . $result->email . '" placeholder="" type="text">
								</div>
							</div>
						</div>
										 
						<div class="col-sm-6">
							<div class="form-group ">
								<label>Contact </label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control"  name="contact" autocomplete="off" value="' . $result->mob_number . '" placeholder="" type="text">
								</div>
							</div>
						</div>
						  <div class="col-sm-6">
							<div class="form-group ">
								<label>User Type</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<input class="form-control"  name="user_type" value="Sales" placeholder="" type="text">
									
								</div>
							</div>
						</div>	 					
					</div><br>
					<div class="row modal-footer">
						<div class="creatUserBottom ">
							<div class="">
								<div class="vert-pad">
									<button type="submit" name="updatesale" value="' . $result->id . '" class="btn-green">Update User</button>
								</div>          
							</div>
							<div class="">
								<div class="vert-pad">
									<button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>
		';
	}

	public function auth_user() {
		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'Users';
			$data['file'] = 'storefronts/auth_users';

			if (isset($_POST['enable'])) {
				$uid = $_POST['enable'];
				$data = array("flag_enabled" => '1');
				$this->db->where('id', $uid);
				$this->db->update('uf_user', $data);
				$this->db->last_query();
				$this->session->set_flashdata('successmessage', 'Enabled successfully');
				redirect("panels/supermacdaddy/storefronts/auth_user");
			}
			if (isset($_POST['disable'])) {
				$uid = $_POST['disable'];
				$data = array("flag_enabled" => '0');
				$this->db->where('id', $uid);
				$this->db->update('uf_user', $data);
				$this->session->set_flashdata('successmessage', 'Disabled successfully');
				redirect("panels/supermacdaddy/storefronts/auth_user");
			}
			if (isset($_POST['delete'])) {
				$uid = $_POST['delete'];
				$this->db->where('id', $uid);
				$this->db->delete('uf_user');
				$this->session->set_flashdata('successmessage', 'Deleted successfully');
				redirect("panels/supermacdaddy/storefronts/auth_user");
			}

			if (isset($_POST['save'])) {
				//$result = $this->Store_model->add_user();
				$email = $this->input->post('email');
				$emailResult = $this->Store_model->check_email($email);
				if ($emailResult) {
					$this->session->set_flashdata('errormessage', 'User Email is already Existed');
					redirect("panels/supermacdaddy/storefronts/auth_user");
				}
				$auth_user_check = $this->Store_model->auth_user_check();
				if (!$auth_user_check) {
					$this->session->set_flashdata('errormessage', 'you need add only 10 staff memebers');
					redirect("panels/supermacdaddy/storefronts/auth_user");
				}
				$result = $this->Store_model->add_auth_user();
				if ($result) {
					$messageValue = $email . ' This authorized User  is added by ';
					$this->Store_model->notification_add($messageValue);
					$en_id = $result;
					$url = base_url('panels/supermacdaddy/storefronts/setpassword?auth_token=' . $en_id);
					// die();
					// $time.$this->security->get_csrf_hash();//$this->encrypt->encode($id);
					$this->load->library('email');
					$this->email->set_mailtype("html");
					$this->email->from('info@meddev.imvisile.com', 'MedConnx');
					$this->email->to($email);
					$this->email->subject('MedConnx::Set Password');
					$this->email->message('Hello ' . $email . ',
							<br>Your account has been created on <b>MedConnx</b> team.<br><br>Please set password for your account
							<a href="' . $url . '">Click Here</a>
							<br> contact our staff at info@meddev.imvisile.comk
							<br>
							Thank you,<br>
							MedConnx');
					$mailsend = $this->email->send();

					if ($mailsend) {
						$this->session->set_flashdata('errormessage', 'Check Your <strong>' . $email . ' </strong> to recover you password');
						redirect("panels/supermacdaddy/storefronts/auth_user");
						//$error='1';
					} else {
						//echo "hii";
						$this->session->set_flashdata('successmessage', 'Sorry ' . $url . ' mail not sent');
						redirect("panels/supermacdaddy/storefronts/auth_user");
						//$error='<div style="padding: 5px;"  class="alert alert-danger" >Sorry '.base_url().'opening?token='.$en_id.' mail not sent</div>';
					}
				} else {
					$this->session->set_flashdata('successmessage', $user_result);
					redirect("panels/supermacdaddy/storefronts/auth_user");
					//$error='<div style="padding: 5px;"  class="alert alert-danger" >'.$user_result.'</div>';
				}
				// if($result==true){
//      				$this->session->set_flashdata('successmessage', 'User added successfully.');
//      				redirect('panels/supermacdaddy/storefronts/auth_user');
//      			}
			}
			if (isset($_POST['updatesale'])) {
				$id = $_POST['updatesale'];
				$result = $this->Store_model->update_aut_user($id);
				if ($result == true) {
					$this->session->set_flashdata('successmessage', 'Authorized User added successfully.');
					redirect('panels/supermacdaddy/storefronts/auth_user');
				}
			}

			$data['all_staff'] = $this->Store_model->auth_user();
			$all_staff = $this->Store_model->auth_user();

			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('panels/supermacdaddy/storefronts');
		}
	}

	public function categories() {
		if ($this->session->userdata('adminlogin')) {

			if (isset($_POST['updatecategory'])) {
				$id = $_POST['id'];
				$result = $this->Store_model->update_category($id);
				if ($result) {
					$this->session->set_flashdata('successmessage', 'Category updated successfully.');
					redirect('panels/supermacdaddy/storefronts/categories');
				}
			}
			if (isset($_POST['save'])) {
				$data = array(
					'name' => $this->input->post('category_name'),
					'status' => $this->input->post('status'),
					'user_id' => $this->session->userdata('id')
				);
				$category_name = $this->input->post('category_name');
				$result = $this->db->insert('uf_categories', $data);
				$messageValue = $category_name . ' This Category User  is added by ';
				$this->Store_model->notification_add($messageValue);
				$this->session->set_flashdata('successmessage', 'Category is added successfully.');
				redirect("panels/supermacdaddy/storefronts/categories");
			}
			if (isset($_POST['delete'])) {
				$uid = $_POST['delete'];
				$this->db->where('id', $uid);
				$this->db->delete('uf_categories');
				$this->session->set_flashdata('successmessage', 'Category is Deleted successfully');
				redirect("panels/supermacdaddy/storefronts/categories");
			}
			if (isset($_POST['disable'])) {
				$uid = $_POST['disable'];
				$data = array("status" => '0');
				$this->db->where('id', $uid);
				$this->db->update('uf_categories', $data);
				$this->session->set_flashdata('successmessage', 'Category is  Disabled successfully');
				redirect("panels/supermacdaddy/storefronts/categories");
			}
			if (isset($_POST['enable'])) {
				$uid = $_POST['enable'];
				$data = array("status" => '1');
				$this->db->where('id', $uid);
				$this->db->update('uf_categories', $data);
				$this->session->set_flashdata('successmessage', 'Category is Enabled successfully');
				redirect("panels/supermacdaddy/storefronts/categories");
			}
			$data['title'] = 'Category';
			$data['file'] = 'storefronts/category';
			$data['all_staff'] = $this->Store_model->get_all_product();
			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('panels/supermacdaddy/storefronts');
		}
	}

	public function edit_category() {
		if ($this->session->userdata('adminlogin')) {

			$id = $this->input->post('id');
			$result = $this->Store_model->edit_category($id);
			echo json_encode($result);
		} else {
			redirect('panels/supermacdaddy/storefronts');
		}
	}

	public function promo_codes() {
		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'Users';
			$data['file'] = 'storefronts/promo_code';

			if (isset($_POST['enable'])) {
				$uid = $_POST['enable'];
				$data = array("flag_enabled" => '1');
				$this->db->where('id', $uid);
				$this->db->update('authenticated_users', $data);
				$this->db->last_query();
				$this->session->set_flashdata('successmessage', 'Enabled successfully');
				redirect("panels/supermacdaddy/storefronts/promo_code");
			}
			if (isset($_POST['disable'])) {
				$uid = $_POST['disable'];
				$data = array("flag_enabled" => '0');
				$this->db->where('id', $uid);
				$this->db->update('authenticated_users', $data);
				$this->session->set_flashdata('successmessage', 'Disabled successfully');
				redirect("panels/supermacdaddy/storefronts/promo_code");
			}
			if (isset($_POST['delete'])) {
				$uid = $_POST['delete'];
				$this->db->where('id', $uid);
				$this->db->delete('authenticated_users');
				$this->session->set_flashdata('successmessage', 'Deleted successfully');
				redirect("panels/supermacdaddy/storefronts/promo_code");
			}

			if (isset($_POST['save'])) {
				$result = $this->Store_model->add_user();
				if ($result) {

					$email = $this->input->post('email');
					$en_id = $result; // $time.$this->security->get_csrf_hash();//$this->encrypt->encode($id);
					$this->load->library('email');
					$this->email->set_mailtype("html");
					$this->email->from('info@meddev.imvisile.com', 'MedConnx');
					$this->email->to($email);
					$this->email->subject('MedConnx::Set Password');
					$this->email->message('Hello ' . $email . ',
							<br>Your account has been created on <b>MedConnx</b> team.<br><br>Please set password for your account
							<a href="' . base_url() . 'setpassword?auth_token=' . $en_id . '">' . base_url() . 'setpassword?auth_token=' . $en_id . '</a>
							<br> contact our staff at info@meddev.imvisile.comk
							<br>
							Thank you,<br>
							MedConnx');
					$mailsend = $this->email->send();

					if ($mailsend) {
						$this->session->set_flashdata('successmessage', 'Check Your <strong>' . $email . ' </strong> to recover you password');
						redirect("panels/supermacdaddy/storefronts/promo_code");
						//$error='1';
					} else {
						//echo "hii";
						$this->session->set_flashdata('successmessage', 'Sorry ' . base_url() . 'opening?token=' . $en_id . ' mail not sent');
						redirect("panels/supermacdaddy/storefronts/promo_code");
						//$error='<div style="padding: 5px;"  class="alert alert-danger" >Sorry '.base_url().'opening?token='.$en_id.' mail not sent</div>';
					}
				} else {
					$this->session->set_flashdata('successmessage', $user_result);
					redirect("panels/supermacdaddy/storefronts/promo_code");
					//$error='<div style="padding: 5px;"  class="alert alert-danger" >'.$user_result.'</div>';
				}
				// if($result==true){
//      				$this->session->set_flashdata('successmessage', 'User added successfully.');
//      				redirect('panels/supermacdaddy/storefronts/auth_user');
//      			}
			}
			if (isset($_POST['updatesale'])) {
				$id = $_POST['updatesale'];
				$result = $this->Store_model->update_aut_user($id);
				if ($result == true) {
					$this->session->set_flashdata('successmessage', 'User added successfully.');
					redirect('panels/supermacdaddy/storefronts/promo_code');
				}
			}

			$data['all_staff'] = $this->Store_model->auth_user();
			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('panels/supermacdaddy/storefronts');
		}
	}

	public function promo_list() {

		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'Promo codes';
			$data['file'] = 'storefronts/promo_list';
			$user_id = $this->session->userdata('id');
			$data['products'] = $this->Store_model->products($user_id);
			$data['allproducts'] = $this->Store_model->All_products($user_id);

			//$_SESSION['id']		= 	$this->session->userdata('id');	
			//echo $_SESSION['id']	;die('got it');
			if (isset($_POST['save'])) {
				$code = $this->input->post('code');
				$messageValue = 'This promo Code ' . $code . ' is added by ';
				$this->Store_model->notification_add($messageValue);

				$check_promo = $this->Store_model->check_promo();

				if ($check_promo > 0) {
					$this->Store_model->recentActivity(' promo codes is already successfully.');
					$this->session->set_flashdata('errormessage', 'Promo code is already existed');
					redirect("panels/supermacdaddy/storefronts/promo_list");
				} else {

					$task = $this->Store_model->save_promo();
					$this->Store_model->recentActivity(' promo codes is added successfully.');
					$this->session->set_flashdata('successmessage', 'Promo Save Successfully');
					redirect("panels/supermacdaddy/storefronts/promo_list");
				}
			}

			if (isset($_POST['enable'])) { //die('e here');
				$id = $_POST['enable'];
				$data = array("status" => '1');
				$this->db->where('id', $id);
				$this->db->update('uf_promo_codes', $data);
				$this->db->last_query();
				$this->Store_model->recentActivity(' promo codes is Enable successfully.');
				$this->session->set_flashdata('successmessage', 'Promo code Enable successfully');
				redirect("storefronts-promo-list");
			}
			if (isset($_POST['disable'])) { //die('d here');
				$id = $_POST['disable'];
				$data = array("status" => '0');
				$this->db->where('id', $id);
				$this->db->update('uf_promo_codes', $data);
				$this->Store_model->recentActivity(' promo codes is Disable successfully.');
				$this->session->set_flashdata('successmessage', 'Promo code Disable successfully');
				redirect("storefronts-promo-list");
			}
			if (isset($_POST['update'])) {
				$updateid = $_POST['id'];
				//$created_by =  $records['created_by'];
				$promo = $this->Store_model->update_promo($updateid);
				$this->Store_model->recentActivity(' promo codes is Updated successfully.');
				$this->session->set_flashdata('successmessage', 'Promo code Updated Successfully');
				redirect("storefronts-promo-list");
			}
			if (isset($_POST['delete'])) {
				$promoid = $_POST['delete'];
				$category = $this->Store_model->delete_promo($promoid);
				$this->Store_model->recentActivity(' promo codes is Deleted successfully.');
				$this->session->set_flashdata('successmessage', 'Promo Deleted Successfully');
				redirect("storefronts-promo-list");
			}

			$data['allpromo'] = $this->Store_model->allpromo($user_id);

			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function edit_promo() {
		$pid = $this->input->post('id');
		$result = $this->Store_model->edit_promo($pid);
		echo json_encode($result);
	}

	public function setting($value = '') {
		if ($this->session->userdata('adminlogin')) {
			$driverid = $this->session->userdata('id');
			$whereData = array('id' => $driverid, 'user_type' => '3');
			$data['title'] = "Site Settings";
			$data['file'] = 'storefronts/setting';
			$data['profile'] = $this->Store_model->getUserData($whereData);
			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('panels/supermacdaddy/sales/login');
		}
	}

	public function updatePassword() {
		if ($this->session->userdata('adminlogin')) {
			extract($_POST);
			$driverid = $this->session->userdata('id');
			if (!empty($password)) {
				$data = array('user_name' => $user_name, 'password' => md5($password));
			} else {
				$data = array('user_name' => $user_name);
			}


			$whereData = array('id' => $driverid);
			$table = 'uf_user';
			$result = $this->Store_model->getUpdate($table, $data, $whereData);
			if ($result) {
				$this->session->set_flashdata('success', 'settings are updated Successfully.');
				redirect('panels/supermacdaddy/storefronts/setting');
			} else {
				$this->session->set_flashdata('error', 'settings are not updated Successfully.');
				redirect('panels/supermacdaddy/storefronts/setting');
			}
		} else {
			redirect('panels/supermacdaddy/sales/login');
		}
	}

	public function signupdocuments_backup() {

		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'sign up documents';
			$data['file'] = 'storefronts/signupdocuments';
			$data['documents'] = $this->common_model->get_data('cp_doctor_documents', 'desc', 'id');
			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function signupdocuments() {

		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'sign up documents';
			$user_id = $this->session->userdata('id');
			$data['file'] = 'storefronts/signupdocuments';
			$data['uploadDocuments'] = $this->Store_model->document_store_signup();
			$created_id = $this->session->userdata('id');
			$date = date('Y-m-d H:i:s');
			if (isset($_POST['updatedocument'])) {
				$document_id = $this->input->post('document_id');
				$document_name = $this->input->post('document_name');
				$old_image = $this->input->post('old_image');
				$notes = $this->input->post('notes');
				$image = $old_image;

				$filename = $_FILES['image']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$allowed = array('jpg', 'jpeg', 'png', 'gif');

				if (!empty($_FILES["image"]["name"]) && in_array($ext, $allowed)) {
					$filename = $_FILES["image"]["name"];
					//$extension = end(explode(".", $filename));

					$tmp = explode('.', $filename);
					$extension = end($tmp);
					$image = $document_name . "." . $extension;
					$path = 'uploads';
					$this->upload_image_overwrite($image, $path);

					$data_arr = array(
						"document" => $image,
						'notes' => $notes
					);

					$this->db->where('id', $document_id);
					$resultarray = $this->db->update('uf_user_documents', $data_arr);
				} 
				else if(!empty($old_image)){
								$image = $old_image;
					$data_arr = array(
						"document" => $image,
						'notes' => $notes
					);
					$this->db->where('id', $document_id);
					$resultarray = $this->db->update('uf_user_documents', $data_arr);
				}

				else {
					$this->session->set_flashdata('errormessage', 'Please upload correct document format. we allow only scan document');
					redirect("panels/supermacdaddy/storefronts/signupdocuments");
				}

				$historydata_arr = array("user_id" => $created_id, "message" => "Sign Up Documents !  Update Successfully. ", "created_at" => $date);
				$this->common_model->insert_record($historydata_arr, 'history');

				$this->session->set_flashdata('successmessage', 'update document successfully');
				redirect("panels/supermacdaddy/storefronts/signupdocuments");
			}
			if(isset($_POST['delete_product'])){
				$this->db->where('id', $_POST['delete_product']);
				$this->db->delete('uf_user_documents');
			    $this->session->set_flashdata('successmessage', ' document is deleted successfully');
				redirect("panels/supermacdaddy/storefronts/signupdocuments");

			}

			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function edit_signupdocuments() {
		$id = $this->input->post('document_id');
		$edit_data = $this->Store_model->edit_document_data($id);
		$link_name = explode('.', $edit_data['document']);
		echo '<div class="col-sm-12">
					<input class="form-control " type="hidden" name="document_id" readonly="" value="' . $id . '" required="" >
					<input class="form-control " type="hidden" name="document_name" readonly="" value="' . $link_name[0] . '" required="" >
					<div class="form-group">
						<label>Attach File </label>
						<div class="input-group">
							<input type="file" name="image" >
							<input type="hidden" name="old_image" value="' . $edit_data['document'] . '" >
						</div>
						<textarea class="form-control" name="notes" row="10" style="resize: none; visibility: hidden; display: none;" cols="50">' . $edit_data['notes'] . '</textarea>
					</div>
				</div>
				<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <script>
      CKEDITOR.replace("notes");

    </script>';
	}

	function upload_image_overwrite($image, $path) {
		$config['upload_path'] = $path;
		$config['allowed_types'] = '*';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $image;
		$config['max_size'] = '1000000';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('image')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}
	}

	public function payouts() {

		if ($this->session->userdata('adminlogin')) {
			$id = $this->session->userdata('id');
			$data['title'] = 'sign up documents';
			$data['file'] = 'storefronts/payout';
			//$data['documents'] =$this->common_model->get_data('cp_doctor_documents','desc','id');	
			$result = $this->Store_model->getSingleRecord('payout_details', $id);
			$data['orders'] = $this->Store_model->orders($id);
			$data['payments'] = $this->Store_model->payments($id);
			$data['payout'] = $result;
			if (isset($_POST['save'])) {
				$this->Store_model->save_payout();
				$this->Store_model->recentActivity('Payout details  are added Successfully.');

				$this->session->set_flashdata('successmessage', 'Payout details  are added Successfully.');
				redirect('storefronts-payouts');
			}
			if (isset($_POST['update'])) {
				$this->Store_model->update_payout();
				$this->Store_model->recentActivity('Payout details  are updated Successfully.');
				$this->session->set_flashdata('successmessage', 'Payout details  are updated Successfully.');
				redirect('storefronts-payouts');
			}

			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function complimentaryAd() {

		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'sign up documents';
			$data['file'] = 'storefronts/complemn-ad';
			$data['comp'] = $this->common_model->get_data_tbl('cp_complimentary_ad', 'user_id', $this->session->userdata('id'));
			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function updateComp($value = '') {
		if (isset($_POST)) {
			$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
			if ($_FILES["image"]["name"] == '') {
				$image = $this->input->post('image_old');
			}
			$path = 'uploads';
			if ($_FILES["image"]["name"] != '') {
				if (file_exists(FCPATH . 'uploads/' . $this->input->post('image_old'))) {
					unlink(FCPATH . 'uploads/' . $this->input->post('image_old'));
				}
				if (file_exists(FCPATH . 'uploads/tmp_file/' . $this->input->post('remove_image_task'))) {
					unlink(FCPATH . 'uploads/tmp_file/' . $this->input->post('remove_image_task'));
				}

				$ad_size = explode("x", $this->input->post('ad_size'));
				$width = $ad_size[0];
				$height = $ad_size[1];

				$this->upload_image($image, $path);
				$this->uploadimageResize50X50($width, $height);
			}

			$result = $this->Store_model->update_comp($image);
			if ($result) {
				$this->session->set_flashdata('successmessage', "complimentary Sales updated successfully");
				redirect("panels/supermacdaddy/storefronts/complimentaryAd");
			} else {
				$this->session->set_flashdata('successmessage', "complimentary Sales data not updated");
				redirect("panels/supermacdaddy/storefronts/complimentaryAd");
			}
		} else {
			$error = '<div   style="padding: 5px;" class="alert alert-danger" > Ad Type </div>';
		}
	}

	public function add_insertComp($value = '') {
		if (isset($_POST)) {
			$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
			$path = 'uploads';
			if ($_FILES["image"]["name"] != '') {
				if(!empty($this->input->post('image_old'))){
					if (file_exists(FCPATH . 'uploads/' . $this->input->post('image_old'))) {
					unlink(FCPATH . 'uploads/' . $this->input->post('image_old'));
				}
				}
				
				if (file_exists(FCPATH . 'uploads/tmp_file/' . $this->input->post('remove_image_task'))) {
					unlink(FCPATH . 'uploads/tmp_file/' . $this->input->post('remove_image_task'));
				}
				$ad_size = explode("x", $this->input->post('ad_size'));
				$width = $ad_size[0];
				$height = $ad_size[1];
				$this->upload_image($image, $path);
				$this->uploadimageResize50X50($width, $height);
			}

			$result = $this->Store_model->add_new_comp($image);
			if ($result) {
				$this->session->set_flashdata('successmessage', "complimentary Sales add successfully");
				redirect("panels/supermacdaddy/storefronts/complimentaryAd");
			} else {
				$this->session->set_flashdata('successmessage', "complimentary Sales data not updated");
				redirect("panels/supermacdaddy/storefronts/complimentaryAd");
			}
		} else {
			$error = '<div   style="padding: 5px;" class="alert alert-danger" > Ad Type </div>';
		}
	}

		public function temp_view()
	{
		$image = '';
		if (!empty($_FILES["image"]["name"])) {
			
			$ad_size = explode("x",$this->input->post('ad_size'));
			$width	= $ad_size[0];
			$height = $ad_size[1];
			$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
			$path = 'uploads/tmp_file';
			$this->upload_image($image, $path);
			$this->uploadimageResize50X50($width,$height);
		}
		$data['success']=$image;
		echo json_encode($data);
	}
	

	function uploadimageResize50X50($width, $height) {
		$this->load->library('image_lib');
		$image_data = $this->upload->data();
		$configer = array(
			'image_library' => 'gd2',
			'source_image' => $image_data['full_path'],
			'maintain_ratio' => FALSE,
			'width' => $width,
			'height' => $height,
		);
		$this->image_lib->clear();
		$this->image_lib->initialize($configer);
		$this->image_lib->resize();
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
		//incase file uploading fails give name of field in arguments
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}
	}

	public function readMessages() {
		$name = $this->input->post('name');

		if ($name == 'notification') {
			$id = $this->session->userdata('id');
			$result = $this->Store_model->readMessages($id, $name);
			echo '0';
		} else if ($name == 'task') {

			$id = $this->session->userdata('id');
			$result = $this->Store_model->readMessages($id, $name);
			echo '0';
		} else if ($name == 'message') {

			$id = $this->session->userdata('id');
			$result = $this->Store_model->readMessages($id, $name);
			echo '0';
		}
	}

	public function affiliate() {
		if ($this->session->userdata('adminlogin')) {
			$id = $this->session->userdata('id');
			$data['title'] = 'sign up documents';
			$data['file'] = 'storefronts/affiliate';
			//$data['comp'] =$this->common_model->get_data_tbl('cp_complimentary_ad','id','01');
			$data['supportCount'] = $this->Store_model->recordsCount($id, 'ost_ticket__cdata');

			$this->load->view('storefronts_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function notifications() {
		$data['title'] = 'Dashboard :: Notifications';
		$data['file'] = 'storefronts/notifications';
		$data['notification'] = $this->Store_model->notification_historyAll();
		if (isset($_POST['update_read_status'])) {
			$uid = $_POST['update_read_status'];
			$dataa = array("read_status" => '1');
			$this->db->where('id', $uid);
			$this->db->update('notification_history', $dataa);
			$this->session->set_flashdata('successmessage', 'Notification is Read successfully');
			redirect("panels/supermacdaddy/storefronts/notifications");
		}
		$this->load->view('storefronts_templates', $data);
	}
	public function setpassword() {
		$auth_token = $this->input->get('auth_token');
		$result = $this->Store_model->auth_token_check($auth_token);
		if ($result) {
			$data['id'] = $result->id;
			$data['emailtoken'] = $result->email;
			$data['passwordtoken'] = $result->password;
			$data['secret_token'] = $result->secret_token;
			$this->load->view('storefronts/login', $data);
		} else {
			$this->session->set_flashdata('errormessage', 'Invalid User!!');
			redirect('/');
		}
	}

	public function truncateData() {
		$data = $this->input->get('tblname');
		$this->db->query("TRUNCATE TABLE " . $data);
		$query = $this->db->get();
		echo $query;
	}

	public function restPassword() {
		$email = trim($this->input->post('email'));
		$auth_check = trim($this->input->post('auth_check'));
		$password = trim($this->input->post('password'));
		$dataa = array('secret_token' => '', 'password' => md5($password));
		$this->db->where('email', $email);
		$result = $this->db->update('uf_user', $dataa);
		if ($result) {
			$this->session->set_flashdata('successmessage', 'Password Update Successfully.');
			redirect('/');
		} else {
			$this->session->set_flashdata('errormessage', 'Password is not Update Successfully.');
			$url = base_url('panels/supermacdaddy/storefronts/setpassword?auth_token=' . $auth_check);
			redirect($url);
		}
	}

	public function storefront_list() {
		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'Store Fronts';
			$data['Stores'] = $this->Store_model->store_fronts();
			//echo '<pre/>';print_r($data['Sales']);die('got data');
			$data['file'] = 'storefronts/storefront_list';
			$this->load->view('storefronts_templates', $data);
		}
	}

	public function verification() {
		$data['title'] = 'pending_interviews';
		$data['file'] = 'storefronts/verification';
		if (isset($_POST['deactive'])) {
			$uid = $_POST['deactive'];
			$dataa = array("is_verify" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $dataa);
			$this->db->last_query();
			$this->session->set_flashdata('successmessage', 'Disable successfully');
			redirect("storefronts-verification");
		}


		if (isset($_POST['activeUserId'])) {
			 $uid = $_POST['activeUserId'];

			// $get_query = $this->db->query("SELECT * FROM `uf_user` WHERE `id` = '" . $uid . "' ")->row_array();
			// $en_id = md5($get_query['email']);
			// $pro_img = base_url() . 'public/images/logo.png';
			// $dataa = array("is_verify" => '1', 'secret_token' => $en_id, 'password' => $en_id, "profile_pic" => $pro_img);
			// $this->db->where('id', $uid);
			// $this->db->update('uf_user', $dataa);

			$data1 = array("status" => '1');
			$this->db->where('id', $uid);
			$this->db->update('uf_user_doc_store', $data1);

			if (!empty($get_query['email'])) {
				$email = $get_query['email'];

				$this->email->set_mailtype("html");
				$this->email->from('info@medconnex.net', 'MedConnx');
				$this->email->to($email);
				$this->email->subject('MedConnex::Set Password');
				$this->email->message('Hello ' . $get_query['email'] . ',
						<br>Your account has been created on <b>MedConnx</b> team.<br><br>Please set password for your account
						<a href="' . base_url() . 'home/setpassword?auth_token=' . $en_id . '">' . base_url() . 'home/setpassword?auth_token=' . $en_id . '</a>
						<br> contact our staff at info@medconnex.net
						<br>
						Thank you,<br>
						MedConnx');
				$mailsend = $this->email->send();

				$this->email->set_mailtype("html");
				$this->email->from('info@medconnex.net', 'MedConnx');
				$this->email->to($email);
				$this->email->subject('MedConnex:Verification Approved');
				$this->email->message('Thank you for the Verification, please proceed to the following location');
				$mailsend1 = $this->email->send();
			}

			$notify_ins = array("user_id" => $uid, "message" => 'Thank you for the Verification, please proceed to the following location', "created_at" => date('Y-m-d H:i:s'), "type_read" => 4);
			$this->db->insert('notification_history', $notify_ins);
			$this->session->set_flashdata('successmessage', 'Approved successfully');
			redirect("storefronts-verification");
		}

		if (isset($_POST['reject'])) {
			  $rejectid = $_POST['rejectUserId'];

			$data1 = array("status" => '2');
			$this->db->where('id', $rejectid);
			$this->db->update('uf_user_doc_store', $data1);
			

			$email = $_POST['email'];
			$this->email->set_mailtype("html");
			$this->email->from('info@medconnex.net', 'MedConnex');
			$this->email->to($email);
			$this->email->subject('MedConnex:Verification Denied');
			$this->email->message('Your Verification has been denied at the moment, please submitted an updated version to proceed. Thank You');
			$mailsend1 = $this->email->send();


			$notify_ins = array("user_id" => $rejectid, "message" => 'Your Verification has been denied at the moment, please submitted an updated version to proceed. Thank You!', "created_at" => date('Y-m-d H:i:s'), "type_read" => 4);
			$this->db->insert('notification_history', $notify_ins);
			$this->session->set_flashdata('successmessage', 'Denied  successfully');

			redirect("storefronts-verification");
		}
		if(isset($_POST['document_verify'])){
			 $user_id=$_POST['document_verify'];
			$where = array('document_status' =>'1');
			$this->db->where('id',$user_id);
			$this->db->update('uf_user_documents',$where);
			$this->session->set_flashdata('successmessage', 'Document verify is done successfully');
			redirect("storefronts-verification");

		}
		if(isset($_POST['need_premission'])){
			$user_id=$_POST['document_id'];
			$where = array('admin_permission' =>'1');
			$this->db->where('id',$user_id);
			$this->db->update('uf_user_documents',$where);
			$admin=$this->db->query('select * from uf_user where user_type ="5"');
			$result=$admin->row();
			$notify_ins=array("user_id"=>$result->id,"message"=>'admin premission is needed for document verificaion',"created_at"=>date('Y-m-d H:i:s'),"read_status"=>0);
			$this->db->insert('notification_history',$notify_ins);
			$this->session->set_flashdata('success_msg', 'Permission has sent successfully to admin');
			redirect("storefronts-verification");
		}
		

				if(isset($_POST['seeStatusId'])){
			 $id=$_POST['seeStatusId'];
			//$where = array('id' =>$id);
		$where = array('seeStatus' =>'1');
			$this->db->where('id',$id);
			$this->db->update('uf_user_doc_store',$where);
			//$this->session->set_flashdata('successmessage', 'Document verify is done successfully');
			

		}

		$uid = $this->session->userdata('id');
		// $where = array('store_id' => $uid);
		// $getVerificationDataStore  = $this->Store_model->getVerificationDataStore('uf_user_doc_store',$where);
		// $getVerificationDataStore1 = array('VerificationDataStore' => $getVerificationDataStore);

		// 	$where = array('id' => $uid);
		// $getUserDataForVerifacation = $this->Store_model->getUserDataForVerifacation('uf_user',$where);
		// // echo "<pre>"; print_r($getUserDataForVerifacation);
		// // die();

		// $getUserDataForVerifacation1 = array('user_name' => $getUserDataForVerifacation->user_name,
		// 	'mob_number' => $getUserDataForVerifacation->mob_number,
		// 	'user_type' => $getUserDataForVerifacation->user_type,
		// 	'created_at' => $getUserDataForVerifacation->created_at,
		// 'email' => $getUserDataForVerifacation->email);



$data['alluser'] = $this->Store_model->getUserDataForVerifacation();
// echo "<pre>"; print_r($alluser);
// 		die();
		$this->load->view('storefronts_templates', $data);
	}

	public function subcategories() {
		redirect('/');
		$data['title'] = 'Sub Categories';
		$data['file'] = 'storefronts/sub_categories';

		if (isset($_POST['save'])) {
			$task = $this->Store_model->saveSubcat();
			$this->Store_model->recentActivity('Sub Category is Saved Successfully.');
			$this->session->set_flashdata('successmessage', 'Sub Categories Save Successfully');
			redirect("panels/supermacdaddy/storefronts/subcategories");
		}
		if (isset($_POST['enable'])) { //die('e here');
			$id = $_POST['enable'];
			$data = array("status" => '1');
			$this->db->where('id', $id);
			$this->db->update('uf_categories_sub', $data);
			$this->db->last_query();
			$this->Store_model->recentActivity('Sub Category is  Enabled Successfully.');
			$this->session->set_flashdata('successmessage', 'Enable successfully');
			redirect("panels/supermacdaddy/storefronts/subcategories");
		}
		if (isset($_POST['disable'])) { //die('d here');
			$id = $_POST['disable'];
			$data = array("status" => '0');
			$this->db->where('id', $id);
			$this->db->update('uf_categories_sub', $data);
			$this->Store_model->recentActivity('Sub Category is Disabled Successfully.');
			$this->session->set_flashdata('successmessage', 'Disable successfully');
			redirect("panels/supermacdaddy/storefronts/subcategories");
		}
		if (isset($_POST['delete'])) {
			$categoryid = $_POST['delete'];
			$this->db->where('id', $categoryid);
			$this->db->delete('uf_categories_sub');
			$this->Store_model->recentActivity('Sub Category is Deleted Successfully.');
			$this->session->set_flashdata('successmessage', 'Sub Category Deleted Successfully');
			redirect("panels/supermacdaddy/storefronts/subcategories");
		}
		if (isset($_POST['updatesubcategory'])) {
			$updateid = $_POST['updatesubcategory'];
			$category = $this->Store_model->update_Subcategory($updateid);
			$this->Store_model->recentActivity('Sub Category is Updated Successfully.');
			$this->session->set_flashdata('successmessage', 'Sub Category Updated Successfully');
			redirect("panels/supermacdaddy/storefronts/subcategories");
		}
		$data['all_cat'] = $this->Store_model->all_categories_enable();
		$data['allsub_cat'] = $this->Store_model->all_sub_categories();
		$this->load->view('storefronts_templates', $data);
	}

	public function liveOrders() {

		$data['title'] = 'Products';
		$data['file'] = 'storefronts/live_order';
		
		$user_id = $this->session->userdata('id');
		$data['products'] = $this->Store_model->live_order($user_id);
		$data['main_categories'] = $this->Store_model->main_categories();
		
		if (isset($_POST['Order'])) {
			$user_id = $_POST['user_id'];
			$id = $_POST['Order'];
			$notify_ins = array("user_id" => $user_id, "message" => 'Your order is ready. Thank you for Using Med Connex Mobile App', "created_at" => date('Y-m-d H:i:s'), "type_read" => 4);
			$this->db->insert('notification_history', $notify_ins);
			$product = $this->Store_model->order_process($id, '1');
			$this->session->set_flashdata('successmessage', ' Order is ready');
			redirect("panels/supermacdaddy/storefronts/liveOrders");
		}
		if (isset($_POST['Delay'])) {
			$id = $_POST['Delay'];
			$user_id = $_POST['user_id'];
			$product = $this->Store_model->order_process($id, '2');
			$this->session->set_flashdata('successmessage', ' Order is Delay  ');
			$notify_ins = array("user_id" => $user_id, "message" => 'Your order is being reviewed and will be processed shortly. Thank you for Using Med Connex Mobile App', "created_at" => date('Y-m-d H:i:s'), "type_read" => 4);

			$this->db->insert('notification_history', $notify_ins);
			redirect("panels/supermacdaddy/storefronts/liveOrders");
		}
		if (isset($_POST['Cancel'])) {
			$id = $_POST['Cancel'];
			$user_id = $_POST['user_id'];
			$product = $this->Store_model->order_process($id, '3');
			$this->session->set_flashdata('successmessage', ' Order is Canceled ');
			$notify_ins = array("user_id" => $user_id, "message" => 'This order was Cancelled. you were not charged at all.Thank you for Using Med Connex Mobile App', "created_at" => date('Y-m-d H:i:s'), "type_read" => 4);

			$this->db->insert('notification_history', $notify_ins);
			redirect("panels/supermacdaddy/storefronts/liveOrders");
		}

		$this->load->view('storefronts_templates', $data);
	}

	public function bulk() {
		$data['title'] = 'Products';
		$data['file'] = 'storefronts/products';

		if ($_POST['upload_product']) {
			$user_id = $this->session->userdata('id');
			ini_set('max_execution_time', -1);
			//$json = array();
			$file_info = pathinfo($_FILES["image"]["name"]);
			$file_directory = "uploads/";
			$new_file_name = date("d-m-Y ") . rand(000000, 999999) . "." . $file_info["extension"];

			if (move_uploaded_file($_FILES["image"]["tmp_name"], $file_directory . $new_file_name)) {
				$file_type = PHPExcel_IOFactory::identify($file_directory . $new_file_name);
				$objReader = PHPExcel_IOFactory::createReader($file_type);
				$objPHPExcel = $objReader->load($file_directory . $new_file_name);

				$sheet_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				$i = 0;
				foreach ($sheet_data as $row) {
					if ($i == 0) {
						
					} else {
						if (!empty($row['F']) && !empty($row['G'])) {
							$qu = $this->Store_model->main_categories($row['F']);
							$category_id = @$qu[0]['id'];
							if (empty($category_id)) {
								$data_array = array("name" => trim($row['F']));
								$category_id = $this->Store_model->insert_category($data_array);
							}

							$subquery = $this->Store_model->sub_categories($row['G']);
							$subcategory_id = @$subquery[0]['id'];
							if (empty($subcategory_id)) {
								$data_array = array("sub_category" => trim($row['F']));
								$subcategory_id = $this->Store_model->insert_sub_category($data_array);
							}

							$content = file_get_contents($row['O']);
							$file_name = rand(000000, 999999);
							$ready = $file_name . '.jpg';
							$new_image = file_put_contents('uploads/' . $ready, $content);

							if (!empty($ready)) {
								$data_value = array('user_id' => $user_id, 'location_name' => $row['B'], 'location_id' => $row['C'], 'product_type' => $row['D'], 'product_name' => $row['E'], 'product_category' => $category_id, 'product_sub_category' => $subcategory_id, 'preparation_time' => $row['H'], 'tax_patients' => $row['I'], 'mrp' => $row['J'], 'happy_hour' => $row['K'], 'happy_day' => $row['L'], 'happy_time_to' => $row['M'], 'happy_time_from' => $row['N'], 'image' => $ready, 'product_notes' => $row['P'], 'status' => "0", 'identifier' => $row['R'], 'amt_d_price' => $row['S']);
								$task = $this->Store_model->add_product($data_value);
								$this->session->set_flashdata('success_msg', 'Upload successfully');
							}
						}
					}
					$i++;
				}
			}
		}
		redirect('panels/supermacdaddy/storefronts/products');
	}


	     public function composemail()
  {

        $email=$this->input->post('send_to');
        $subject=$this->input->post('send_subject');
        $send_message=$this->input->post('send_message');
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnx');
		$this->email->to($email);
		$this->email->subject('MedConnx:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnx');

		$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('successmessage', 'Mail has sent successfully');
			redirect("panels/supermacdaddy/storefronts");
		} else {
			$this->session->set_flashdata('successmessage', 'Sorry  Mail is not sent');
			redirect("panels/supermacdaddy/storefronts");
		}
  }
	public function sales() {
		$data['title'] = 'Users';
		$data['file'] = 'storefronts/sales_list';
		$data['all_staff'] = $this->Store_model->all_auth_user();
		$data['totalContractors'] = $this->Store_model->totalContractors();

		$session_uid = $this->session->userdata('id');
		if (isset($_POST['enable'])) {
			$uid = $_POST['enable'];
			$data = array("flag_enabled" => '1', "is_verify" => '1');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $data);
			$this->db->last_query();
			$this->session->set_flashdata('success_msg', 'Enabled successfully');
			redirect("storefronts-sales");
		} elseif (isset($_POST['disable'])) {
			$uid = $_POST['disable'];
			$data = array("flag_enabled" => '0');
			$this->db->where('id', $uid);
			$this->db->update('uf_user', $data);
			$this->session->set_flashdata('success_msg', 'Disabled successfully');
			redirect("storefronts-sales");
		} elseif (isset($_POST['delete'])) {
			$uid = $_POST['delete'];
			$this->db->where('id', $uid);
			$this->db->delete('uf_user');
			$this->session->set_flashdata('success_msg', 'Deleted successfully');
			redirect("storefronts-sales");
		}
			elseif (isset($_POST['updateTask'])) {
			$task_description = $_POST['task_description'];
			 $id = $_POST['id'];
			
				
			if ($_FILES["image"]["name"] != "") {
				$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				$path = 'uploads';
				$this->upload_image($image, $path);
			}
			else{
				$image = $_POST['myImg'];

			}
			

			$data = array("task_description" => $task_description,
							"attachment" => $image
							);
			
			$this->db->where('id', $id);
			$this->db->update('sal_task', $data);
			$this->session->set_flashdata('success_msg', 'Task Update successfully');
			redirect("storefronts-sales");
		}
		 elseif (isset($_POST['save'])) {
			$this->form_validation->set_rules('contact', 'contact', 'trim|required');
			$this->form_validation->set_rules('user_name', 'user name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin_templates', $data);
			} else {
				//$limit=$this->db->select('*')->from('uf_user')->where('created_by_id',$session_uid)->get()->num_rows();

				$sql = "SELECT count(id) as count from uf_user where created_by_id= '$session_uid' ";
		$query = $this->db->query($sql);
		$limit = $query->result();


				if($limit[0]->count >= 10){
                $this->session->set_flashdata('success_msg', 'Storefront Providers are limited to 10 staff only.If you need additional access please contact our sales Department at <a href="mailto:sales@medconnex.net">sales@medconnex.net</a>');
				redirect("storefronts-sales");
				}
				$result = $this->Store_model->add_auth_user_contract();
				if ($result) {
					$email = $this->input->post('email');
					$en_id = md5($email);
					$this->email->set_mailtype("html");
					$this->email->from('info@medconnex.net', 'MedConnx');
					$this->email->to($email);
					$this->email->subject('MedConnx::Set Password');
					$msg = $this->email->message('Hello ' . $email . ',
						<br>Your account has been created on <b>MedConnx</b> team<br><br>
						Please set password for your account
						<a href="' . base_url() . 'home/setpassword?auth_token=' . $en_id . '">' . base_url() . 'setpassword?auth_token=' . $en_id . '</a>
						<br> contact our staff at info@medconnex.net
						<br>
						Thank you,<br>
						MedConnx');
					$mailsend = $this->email->send();
					if ($mailsend) {
						$this->session->set_flashdata('success_msg', 'Email send to <strong>' . $email . ' </strong>');
						redirect("storefronts-sales");
					} else {
						$this->session->set_flashdata('success_msg', 'Sorry mail not sent');
						redirect("storefronts-sales");
					}
				} else {
					$this->session->set_flashdata('success_msg', "something went wrong.");
					redirect("storefronts-sales");
				}
			}
		} elseif (isset($_POST['updatesale'])) {
			$id = $this->input->post('updatesale');
			$email = $this->input->post('email');
			
		
			$this->form_validation->set_rules('contact', 'contact', 'trim|required');
			$this->form_validation->set_rules('user_name', 'user name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin_templates', $data);
			} else {
				$result = $this->Store_model->update_aut_user($id);
				$this->session->set_flashdata('success_msg', 'Data Updated successfully');
				redirect("storefronts-sales");
			}
		}  else {
			$this->load->view('storefronts_templates', $data);
		}
	}
	public function history(){
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');
			$data['title']='History';
			$data['file']='storefronts/history';
			$where=array('status' =>1, 'user_id'=>$id);
			if(isset($_POST['delete_history'])){
				 $uid= $_POST['delete_history'];
				 $dwhere= array('id' =>$uid);
				 $this->db->where($dwhere);
				 $this->db->delete('history');
			   //  $this->Ondemand_model->deletRecord('history',$dwhere );
			     $this->session->set_flashdata('success_msg', 'history is deleted Successfully..!');
			}
			$data['historyData']=$this->Store_model->historyData('history',$where );
			$this->load->view('storefronts_templates',$data);
		}else{
			redirect('/');
		}
	}


public function createXLS() {
		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library

		require_once APPPATH . 'third_party/PHPExcel.php';
	
		$user_id = $this->session->userdata('id');
	
        $empInfo = $this->Store_model->live_order($user_id);
   
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'DOB');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Contact_No');       
        // set Row
        $rowCount = 2;
       
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['location_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['product_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['product_category']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['product_sub_category']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['product_type']);
            $rowCount++;
        }


  $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
		// download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName); 
   
    }

}