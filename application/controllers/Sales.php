<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->library('email');
		$this->load->model('Sales_model');
		$this->load->model('common_model');
		$this->load->library('paypal_lib');
				require_once APPPATH . 'third_party/PHPExcel.php';
		if ($this->session->userdata('adminlogin') == "") {
			redirect('/');
		} elseif ($this->session->userdata('adminlogin') == '1') {
			redirect('/panels/supermacdaddy/Ondemand');
		} elseif ($this->session->userdata('adminlogin') == '2') {
			redirect('/panels/supermacdaddy/doctor');
		} elseif ($this->session->userdata('adminlogin') == '3') {
			redirect('/panels/supermacdaddy/Storefronts');
	 	}
	}

	public function index() {
		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'Dashboard :: Home';
			$data['file'] = 'sales/index';
			//$data['notification'] = $this->Sales_model->notification_history(10);
			//$data['salcount']= $this->Sales_model->sal_login();


			$data_arr = array(
				Array
					(
					"dates" => "2018-03-19",
					"daliy" => "1",
					"weekly" => "10",
					"monthly" => "20"
				),
				Array
					(
					"dates" => "2018-03-25",
					"daliy" => "1",
					"weekly" => "5",
					"monthly" => "10"
				),
				Array
					(
					"dates" => "2018-03-30",
					"daliy" => "10",
					"weekly" => "20",
					"monthly" => "30"
				)
			);

		 	$data['visit_graph_count'] = $data_arr;
			$data['general_chart'] = $this->Sales_model->general_chart();
			$data['getCompActive'] = $this->Sales_model->getCompActive();
			
			$data['advertisement_chart'] = $this->Sales_model->advertisement_chart();
			$data['allsalesContractors'] = $this->Sales_model->getAdminIds(array('user_type' => '5', 'is_verify' => '1', 'flag_enabled' => '1'));
			$data['allsales'] = $this->Sales_model->getAdminIds(array('user_type' => '5'));
			$this->load->view('sales_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function sendmassage() {
		if ($this->session->userdata('adminlogin')) {
			$data = $this->Sales_model->sendmassage();
		} else {
			redirect("/login");
		}
	}

	public function chat_history() {
		$result = "";
		$id = $this->session->userdata('id');
		$this->load->model('Ondemand_model');
		$adminIds = $this->Sales_model->getAdminIds(array('user_type' => '5'));

		foreach ($adminIds as $a) {

			$baseAdminId = $a->id;
			$history = $this->Sales_model->chat_history($baseAdminId);
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
                                        <p>' . $val['message'] . '</p>
                                    </div>
                                </li>';
					} else {
						$data .= '<li class="right clearfix"><span class="chat-img  pull-right"><img src="' . base_url() . '/public/images/logo.png" alt="' . $val['sender_name'] . '" class="img-circle" height="50px" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">' . $val['sender_name'] . '</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> ' . $val['message_date'] . '</small>
                                        </div>
                                        <p>' . $val['message'] . '</p>
                                    </div>
                                </li>';
					}
				}
				$result[$baseAdminId] = $data;
			}
		}
		echo json_encode($result);
	}

	public function getId() {
		$result = $this->Sales_model->getId();
		echo $result->message_by;
		exit;
	}

	public function getuserdetails() {

		$userid = $this->input->post('id');
		$geteuser = $this->db->get_where('uf_user', array('id' => $userid))->row();
		$html = '';
		$html .= '
			<div class="col-sm-6">
				<div class="form-group">
					<label>User Name</label>
					<div class="input-group">
					  ' . $geteuser->user_name . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Display Name</label>
					<div class="input-group">
					  ' . $geteuser->display_name . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Email</label>
					<div class="input-group">
					  ' . $geteuser->email . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Phoneno</label>
					<div class="input-group">
					  ' . $geteuser->mob_number . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Title</label>
					<div class="input-group">
					  ' . $geteuser->title . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Scoial id</label>
					<div class="input-group">
					  ' . $geteuser->socialid . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>State</label>
					<div class="input-group">
					  ' . $geteuser->state . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Latitude </label>
					<div class="input-group">
					  ' . $geteuser->user_lat . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Longitude</label>
					<div class="input-group">
					  ' . $geteuser->user_long . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Address</label>
					<div class="input-group">
					  ' . $geteuser->address . '
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Zip code</label>
					<div class="input-group">
					  ' . $geteuser->zip . '
					</div>
				</div>
			</div>
       ';

		$data['result'] = $html;
		$data['username'] = $geteuser->user_name;
		echo json_encode($data);
	}

	/*	 * ************** LOGIN ********************* */

	public function login() {
		if ($this->session->userdata('adminlogin')) {
			redirect('sales-admin');
		} else {
			$data['title'] = 'Login';
			$data['file'] = 'sales/login';

			$username = $this->input->post('email');
			$password = $this->input->post('password');

			/*			 * ******************************************************* */
			if ($this->input->post('login_btn') == 'Login') { //die('got it');
				//$this->input->cookie('remember_me',true);
				$result['data'] = $this->Sales_model->sales_login($username, $password);
				//echo "<pre/>"; print_r($result['data']); die('m here');
				if (!empty($result)) {
					$data = array(
						'id' => $result['uid'],
						'firstname' => $result['firstname'],
						'lastname' => $result['lastname'],
						'username' => $result['username'],
						'email' => $result['email'],
						'password' => $result['pass_encrpt'],
						'contact' => $result['contact'],
						'adminlogin' => '1'
					);
					$this->session->set_userdata($data);
					//$dataDetail = $this->session->userdata(); //echo "<pre/>"; print_r($dataDetail); die('m here');

					$this->session->set_flashdata('successmessage', 'Admin Login Successfully.');
					redirect('sales-admin');
				} else {
					$this->session->set_flashdata('errormessage', 'Invalid credentials..!!');
					redirect('sales-admin/login');
				}
			}
			$this->load->view('sales/login');
		}
	}

	public function general_sales() {
		if ($this->session->userdata('adminlogin')) {
			//$data['all_staff'] = $this->Sales_model->general_sales();
			if(!empty($_REQUEST['limit'])){
				$limit = 25;
				$limit1 = $_REQUEST['limit'] * 25;

			}
			else{
				$limit = 25;
				$limit1 = 0;
			}
			


			$query1=$this->db->query("select *  from uf_general_sale  where stateCityStatus = '1' AND provider_type = '3' limit $limit1,$limit ");
    		 $data['storefronts'] =$query1->result_array();


    		 $query1=$this->db->query("select *  from uf_general_sale  where stateCityStatus = '1' AND provider_type = '1' limit $limit1,$limit ");
    		 $data['ondemands'] =$query1->result_array();

    		 $query1=$this->db->query("select *  from uf_general_sale  where stateCityStatus = '1' AND provider_type = '2' limit $limit1,$limit ");
    		 $data['doctors'] =$query1->result_array();

				$query=$this->db->query("select count(id) as count from uf_general_sale where stateCityStatus = '1' ");
    		 $countData=$query->row();
    		 	$countDataDevied = $countData->count / 25;
    		 	$finalData = explode('.', $countDataDevied);

    	$data['countData'] = $finalData[0];

			$data['title'] = 'General Sales';
			$data['file'] = 'sales/general-sales';
			if (isset($_POST['update'])) {
			// 	$data1 = array(
			// 'email' => $_REQUEST['email'],
			// 'contact_no' => $_REQUEST['contactno'],
			// 'zip_code' => $_REQUEST['zip'],
			// 'location_name' => $_REQUEST['location_name']
				if($this->input->post('comp') == 1){

		$compStartDate = date("Y-m-d");
				$comstartendtime = date("H:i:s");
    			$compEndDate = date('Y-m-d', strtotime($date. ' + 13 days'));
    				$data1 = array(
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
		$data1 = array(
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
		
			
		
		$this->db->where("id", $_REQUEST['id']);
		$this->db->update("uf_general_sale", $data1);

				//$result = $this->Sales_model->update_user();
				$this->session->set_flashdata('success_msg', "General Sales updated successfully");
				redirect("sales-general-sales");
			}
			if (isset($_POST['enable'])) {

				$user_id = $this->input->post('enable');
				$dataarr = array('is_verify' => 1);
				$this->db->where('id', $user_id);
			    $this->db->update('uf_general_sale', $dataarr);

			    $email = $this->input->post('email');
				$dataarr1 = array('approve' => 1);
				$this->db->where('email', $email);
			    $this->db->update('uf_user', $dataarr1);
			    
				$this->session->set_flashdata('success_msg', "Enable Successfully");
				redirect("sales-general-sales");
			}
			if (isset($_POST['disable'])) {

				$user_id = $this->input->post('disable');
				$dataarr = array('is_verify' => 0);
		        $this->db->where('id', $user_id);
			    $this->db->update('uf_general_sale', $dataarr);

			        $email = $this->input->post('email');
				$dataarr1 = array('approve' => 0);
				$this->db->where('email', $email);
					    $this->db->update('uf_user', $dataarr1);
				$this->session->set_flashdata('success_msg', "Disable Successfully");
				redirect("sales-general-sales");
			}
			if (isset($_POST['updatenote'])) {

				$notes = $this->input->post('notes');
				$id = $this->input->post('id');
				$dataarr = array('notes' => $notes);
		        $this->db->where('id', $id);
			    $this->db->update('uf_general_sale', $dataarr);
				$this->session->set_flashdata('success_msg', "Update Note Successfully");
				redirect("sales-general-sales");
			}
			if (isset($_POST['contact'])) {

				$statusContact = $this->input->post('statusContact');
				$id = $this->input->post('id');
				$data = array('statusContact' => $statusContact);
		        $this->db->where('id', $id);
			    $this->db->update('uf_general_sale', $data);
			 	if($statusContact == 1){
			    	$this->session->set_flashdata('success_msg', "1st Contact Successfully");
			    }
			    else{
			    		$this->session->set_flashdata('success_msg', "2nd Contact Successfully");
			    }
				redirect("sales-general-sales");
 			}

			if (isset($_POST['compStatus'])) {
  $email=$this->input->post('useremail');
				$compStatus = $_REQUEST['compStatus'];
				$id = $_REQUEST['id'];
				//$compStartDate = date("d-m-Y");
				//$compStartDate =date('Y-m-d', strtotime($date. ' + 5 days'));
				$compStartDate = date("Y-m-d");
				$comstartendtime = date("H:i:s");
    			$compEndDate = date('Y-m-d', strtotime($compStartDate. ' + 13 days'));

    				$query=$this->db->query("SELECT randomId from uf_user where email = '".$email."' ");
    		 $existdata =$query->row();
    	

    		 if($existdata->randomId !=''){
    		 	$randomId  = $existdata->randomId;
    		 }
    		 else{
    		 	// $randomId = uniqid();

    $name = explode('@', $email);

  
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
	    $randomId1 =  substr(str_shuffle($str_result),  
                       0, 7);
	    $randomId = $randomId1.'-'.$name[0];


	    $dataarr = array('randomId' => $randomId);
		        $this->db->where('email', $email);
			    $this->db->update('uf_user', $dataarr);
    		 }
    		

				$dataarr = array('comp' => $compStatus,'compStartDate' => $compStartDate,'comstartendtime'=>$comstartendtime,'compEndDate' => $compEndDate,'randomId' => $randomId);
		        $this->db->where('id', $id);
			    $this->db->update('uf_general_sale', $dataarr);


				$this->session->set_flashdata('success_msg', "Update Comp Successfully");



  $email=$this->input->post('useremail');

        //$cc=$this->input->post('cc');

        $subject='Provider Email Notice:';
        $send_message='Thank You for trying out our 2 Week  Complimentary Trial , web are sure you will stay after experiencing our great service. After your 2 Week Trial your back panel will FREEZE and you will need to contact our Sales Department to activate your account again and your id "'.$randomId.'"';
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnex');
		$this->email->to($email);
		//$this->email->cc($cc);
		$this->email->subject('MedConnex:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'<br>
			
			MedConnex');

		 	$mailsend = $this->email->send();

			redirect("sales-general-sales");
			}
			if (isset($_POST['delete'])) {
				$user_id = $this->input->post('id');
				$this->db->delete('uf_general_sale', array('id' =>$user_id));
				$this->session->set_flashdata('success_msg', "General sale is deleted Successfully");
				redirect("sales-general-sales");
			}
			
			$this->load->view('sales_templates', $data);
		} else {
			redirect('sales-admin/login');
		}
	}

	public function getGeneralSale() {
		//$query=$this->db->query("select compEndDate from uf_general_sale where compEndDate <>'' ");
		$query=$this->db->query("SELECT compStartDate,compEndDate,count(DATE_ADD(`compStartDate`, INTERVAL 14 DAY)) as completion
FROM `uf_general_sale` where compEndDate <>'' AND comp = 1 group by compEndDate ");
    		 $result =$query->result_array();
    		 	echo json_encode($result);

    		 //$this->load->view('sales_templates', $data);

	}


	public function getSaleDate() {
		$enddate = $_REQUEST['enddate'];
		//$query=$this->db->query("select compEndDate from uf_general_sale where compEndDate <>'' ");
		$query=$this->db->query("select u.user_name,g.email,g.compEndDate,g.contact_no from uf_user as u inner join uf_general_sale as g on u.email=g.email where g.compEndDate <>'' AND comp = 1 AND compEndDate = '$enddate' ");
    		 $result =$query->result_array();
    		 	echo json_encode($result);

    		 //$this->load->view('sales_templates', $data);

	}



	public function getUsersCount() {
		//$query=$this->db->query("select compEndDate from uf_general_sale where compEndDate <>'' ");
			//$query=$this->db->query("SELECT distinct (DATE_FORMAT((created_at),'%Y-%m-%d')) as created_at,   count(created_at) as completion FROM `uf_user` group by created_at ");
					$query=$this->db->query("SELECT addDate as created_at, count(addDate) as completion FROM `uf_user` where addDate<>'' group by addDate ");
    		 $result =$query->result_array();
    		 	echo json_encode($result);

    		 //$this->load->view('sales_templates', $data);

	}

	public function getUsersDate() {
		$created_at = $_REQUEST['created_at'];
		//$query=$this->db->query("select compEndDate from uf_general_sale where compEndDate <>'' ");
		//$query=$this->db->query("select user_name,email,created_at from uf_user where (DATE_FORMAT((created_at),'%Y-%m-%d')) = '$created_at' ");
		$query=$this->db->query("select user_name,email,created_at,device_type from uf_user where addDate = '$created_at' ");
    		 $result =$query->result_array();
    		 	echo json_encode($result);

    		 //$this->load->view('sales_templates', $data);

	}

		public function getadvertismentCount() {
			$userid = $this->session->userdata('id');
	
					$query=$this->db->query("SELECT (DATE_FORMAT((insert_date),'%Y-%m-%d')) as created_at, count(insert_date) as completion FROM `sal_advertisement` where created_by ='$userid' AND status = '1'  group by insert_date ");
    		 $result =$query->result_array();
    		 	echo json_encode($result);
	}
		public function getadvertismentDate() {
		$created_at = $_REQUEST['created_at'];
		//$query=$this->db->query("select compEndDate from uf_general_sale where compEndDate <>'' ");
		//$query=$this->db->query("select user_name,email,created_at from uf_user where (DATE_FORMAT((created_at),'%Y-%m-%d')) = '$created_at' ");
		///$query=$this->db->query("select providername,email,ad_type from sal_advertisement where (DATE_FORMAT((insert_date),'%Y-%m-%d')) = '$created_at' ");
		$query=$this->db->query("select ad.providername,ad.email,ad.ad_type,u.mob_number from sal_advertisement as ad inner join uf_user as u on ad.store_id=u.id where (DATE_FORMAT((ad.insert_date),'%Y-%m-%d')) = '$created_at' ");
		
    		 $result =$query->result_array();
    		 	echo json_encode($result);

    		 //$this->load->view('sales_templates', $data);

	}


	public function promo_list() {
		$data['title'] = 'Promo codes';
		$data['file'] = 'sales/promo_list';
		$created_id = $this->session->userdata('id');
		$date = date('Y-m-d H:i:s');
		if (isset($_POST['save'])) {
			$task = $this->Sales_model->save_promo();

			$historydata_arr = array("user_id" => $created_id, "message" => "Promo Codes ! Created Successfully. ", "created_at" => $date);
			$this->common_model->insert_record($historydata_arr, 'history');

			$this->session->set_flashdata('success_msg', 'Promo code created Successfully');
			redirect("sales-admin/promo_list");
		}
		if (isset($_POST['enable'])) {
			$id = $_POST['enable'];
			$data = array("status" => '1');
			$this->db->where('id', $id);
			$this->db->update('uf_promo_codes', $data);
//			$this->db->last_query();
			$historydata_arr = array("user_id" => $created_id, "message" => "Promo Codes ! Enable Successfully. ", "created_at" => $date);
			$this->common_model->insert_record($historydata_arr, 'history');
			$this->session->set_flashdata('success_msg', 'Promo code Enable successfully');
			redirect("sales-admin/promo_list");
		}
		if (isset($_POST['disable'])) { //die('d here');
			$id = $_POST['disable'];
			$data = array("status" => '0');
			$this->db->where('id', $id);
			$this->db->update('uf_promo_codes', $data);
			$historydata_arr = array("user_id" => $created_id, "message" => "Promo Codes ! Disable Successfully. ", "created_at" => $date);
			$this->common_model->insert_record($historydata_arr, 'history');
			$this->session->set_flashdata('success_msg', 'Promo code Disable successfully');
			redirect("sales-admin/promo_list");
		}
		if (isset($_POST['update'])) {
			$updateid = $_POST['update'];
			$promo = $this->Sales_model->update_promo($updateid);
			$historydata_arr = array("user_id" => $created_id, "message" => "Promo Codes ! Updated Successfully. ", "created_at" => $date);
			$this->common_model->insert_record($historydata_arr, 'history');
			$this->session->set_flashdata('success_msg', 'Promo code Updated Successfully');
			redirect("sales-admin/promo_list");
		}
		if (isset($_POST['delete'])) {
			$promoid = $_POST['delete'];
			$this->db->where('id', $promoid);
			$this->db->delete('uf_promo_codes');
			$historydata_arr = array("user_id" => $created_id, "message" => "Promo Codes ! Deleted Successfully. ", "created_at" => $date);
			$this->common_model->insert_record($historydata_arr, 'history');
			$this->session->set_flashdata('success_msg', 'Promo code Deleted Successfully');
			redirect("sales-admin/promo_list");
		}

		$data['allpromo'] = $this->Sales_model->allpromo();
		$this->load->view('sales_templates', $data);
	}

	public function edit_promo() {
		$result = $this->Sales_model->promodetail();
		$selected1 = $selected2 = $selected3 = '';
		$selected1 = ($result['service_type'] == 1) ? "selected" : '';
		$selected2 = ($result['service_type'] == 2) ? "selected" : '';
		$selected3 = ($result['service_type'] == 3) ? "selected" : '';
		$selectedtype1 = $selectedtype2 = '';
		$selectedtype1 = ($result['type'] == 1) ? "selected" : '';
		$selectedtype2 = ($result['type'] == 2) ? "selected" : '';

		echo '<div class="col-sm-4">
            <div class="form-group">
                <label>Promo Code</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-cut"></i></span-->
                    <input class="form-control" name="code" autocomplete="off" value="' . $result['code'] . '" placeholder="" type="text" required>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="input_locale">Promo Type</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-language"></i></span-->
                   	<select id="input_locale" class="form-control select2 select2-offscreen" name="type" tabindex="-1" title="Promo Type" required>
                        <option value="1" ' . $selectedtype1 . '>Dollar $ Off</option>
                        <option value="2" ' . $selectedtype2 . '>Percentage % Off</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label>Promo Offer</label>
                <div class="input-group">
                    <!--span class="input-group-addon"><i class="fa fa-cut"></i></span-->
                    <input class="form-control" name="offer" autocomplete="off" value="' . $result['offer'] . '" placeholder="" type="text" required>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group ">
                <label>Promo Description</label>
                <div class="input-group"  style="width: 100%;">
                    <textarea name="description" style="width: 100%;" rows="5">' . $result['description'] . '</textarea>
                </div>
            </div>
        </div>

		<div class="col-sm-4">
            <div class="form-group ">
                <label>Service Type</label>
                <div class="input-group">
                   	<select id="input_locale" class="form-control select2 select2-offscreen" name="service_type" tabindex="-1" title="Service Type" required>
                        <option value="1" ' . $selected1 . '>Standard</option>
                        <option value="2" ' . $selected2 . '>Premium</option>
						<option value="3" ' . $selected3 . '>Affiliate</option>
							<option value="">New Patients</option>
							<option value="">New Customer</option>
							<option value="">OTHER</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label>Promo Start Date</label>
                <div class="input-group">
                    <input name="starts"  type="text" value="' . date('Y-m-d', strtotime($result['start'])) . '" class="form-control testing datetimepicker4" required>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group ">
                <label>Promo End Date</label>
                <div class="input-group">
                    <input name="ends" type="text" value="' . date('Y-m-d', strtotime($result['end'])) . '" class="form-control testing datetimepicker4" required>
                </div>
            </div>
        </div>

        <div class="" style="clear:both">
                <div class="creatUserBottom">
                    <button type="submit" name="update" value="' . $result['id'] . '" class="btn-green udate_promocode">Update Promo</button>
                    <button type="button" class="btn-grey" data-dismiss="modal">Cancel</button>
                </div>
            </div>';
	}

	public function CheckCode() {
		$requestedcode = $this->input->post('code');
		$getecode = $this->db->get_where('uf_promo_codes', array('code' => $requestedcode))->num_rows();
		if ($getecode == 0) {
			echo 'true';
		} else {
			echo 'false';
		}
	}

	public function sales_task_list() {
		if ($this->session->userdata('adminlogin')) {
			$sales_id = $this->session->userdata('id');
			$data['all_task_sales'] = $this->Sales_model->all_task_sales($sales_id);
			$data['count_task_sales'] = $this->Sales_model->count_task_sales($sales_id);

			$getuserdetaslis = $this->Sales_model->sales_details($sales_id);
			$user_name = !empty($getuserdetaslis['user_name']) ? $getuserdetaslis['user_name'] : $getuserdetaslis['display_name'];
			$data['title'] = 'Sales Task';
			$data['file'] = 'sales/sales_task_list';
			if (isset($_POST['completed'])) {
				$task_id = $_POST['completed'];
				$data = array("status" => '1');
				$this->db->where('id', $task_id);
				$this->db->update('sal_task', $data);

				$notify_ins = array("user_id" => $sales_id, "read_status" => 0, "type_read" => "00", "created_by" => $sales_id, "message" => 'Sales Task Completed By ' . $user_name, "created_at" => date('Y-m-d H:i:s'));
				$this->db->insert('notification_history', $notify_ins);

				$this->session->set_flashdata('success_msg', 'Task completed successfully');
				redirect("sales-admin/sales_task_list");
			}
			$this->load->view('sales_templates', $data);
		} else {
			redirect('sales-admin/login');
		}
	}

	public function signupdocuments() {
		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'sign up documents';
			$data['file'] = 'sales/signupdocuments';
			$created_id = $this->session->userdata('id');
			$date = date('Y-m-d H:i:s');

			if (isset($_POST['updatedocument'])) {
				$document_id = $this->input->post('document_id');
				$document_name = $this->input->post('document_name');
				$old_image = $this->input->post('old_image');
				$image = $old_image;
				if ($_FILES["image"]["name"] != '') {
					$filename = $_FILES["image"]["name"];
					$extension = end(explode(".", $filename));
					$image = $document_name . "." . $extension;
					$path = 'uploads';
					$this->upload_image_overwrite($image, $path);
				}
				$data_arr = array(
					"document" => $image,
				);

				$this->db->where('id', $document_id);
				$resultarray = $this->db->update('uf_user_documents', $data_arr);

				$historydata_arr = array("user_id" => $created_id, "message" => "Sign Up Documents !  Update Successfully. ", "created_at" => $date);
				$this->common_model->insert_record($historydata_arr, 'history');

				$this->session->set_flashdata('success_msg', 'update document successfully');
				redirect("sales-admin/signupdocuments");
			}

			$data['document_list'] = $this->Sales_model->document_doctor_signup();
			$this->load->view('sales_templates', $data);
		} else {
			redirect('/');
		}
	}

	public function edit_signupdocuments() {
		$id = $this->input->post('document_id');
		$edit_data = $this->Sales_model->edit_document_data($id);
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
					</div>
			</div>';
	}

	public function delete_document($document_id) {
		$this->db->where('id', $document_id);
		$this->db->delete('uf_user_documents');

		$created_id = $this->session->userdata('id');
		$date = date('Y-m-d H:i:s');
		$historydata_arr = array("user_id" => $created_id, "message" => "Sign Up Documents !  Deleted Successfully. ", "created_at" => $date);
		$this->common_model->insert_record($historydata_arr, 'history');

		$this->session->set_flashdata('success_msg', 'Deleted successfully');
		redirect("sales-admin/signupdocuments");
	}

	public function attachment_zip() {
		if ($this->session->userdata('adminlogin')) {
			$data['all_advrZip'] = $this->Sales_model->all_zip_files();
			$data['all_staff'] = $this->Sales_model->all_staff();
			$data['title'] = 'General Sales';
			$data['file'] = 'sales/attachment-zip';
			$data['zip_id'] = $this->input->get('id');
			if (!empty($data['zip_id'])) {
				$data['edit_zip'] = $this->Sales_model->edit_zip_files($data['zip_id']);
			}
			$this->load->view('sales_templates', $data);
		} else {
			redirect('sales-admin/login');
		}
	}

	public function ticket_managment() {
		$data['title'] = 'General Sales';
		$data['file'] = 'sales/ticket-management';
		$user_id = $this->session->userdata('id');
		$created_mail = $this->session->userdata('username');
		if (isset($_POST['check_status'])) {
			$chk_Email = $this->input->post('chk_Email');
			$chk_ticketno = $this->input->post('chk_ticketno');
			$getval = $this->Sales_model->check_ticket($chk_Email, $chk_ticketno);
			if (!empty($getval)) {
				$status = $getval['status'];
				$val_status = "pendding";
				$color = "#ec961c";
				if ($status == 1) {
					$color = "#0098c5";
					$val_status = "Process";
				} else if ($status == 2) {
					$color = "#298929";
					$val_status = "Completed";
				}
				$this->session->set_flashdata('success_msg', "Email : $chk_Email<br>Ticket No : $chk_ticketno<br>Status: <span style='color:$color'>$val_status</span>");
				redirect("sales-admin/ticket_managment");
			} else {
				$this->session->set_flashdata('error_msg', "no ticket created..!");
				redirect("sales-admin/ticket_managment");
			}
		}

		if (isset($_POST['btn_save_ticket'])) {
			$ticket_email = $this->input->post('ticket_email');
			$ticket_sub = $this->input->post('ticket_sub');
			$message_ticket = $this->input->post('message_ticket');
			$date = date('Y-m-d H:i:s');
			$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
			$path = 'uploads';
			$this->upload_image($image, $path);
			$data_arr = array(
				"email" => $ticket_email,
				"subject" => $ticket_sub,
				"message" => $message_ticket,
				"attach" => $image,
				"created_date" => $date,
			);
			$this->db->insert("ost_ticket__cdata", $data_arr);

			$notify_ins = array("user_id" => $user_id, "read_status" => 0, "type_read" => "00", "created_by" => $user_id, "message" => 'Open New Ticket By ' . $ticket_email, "created_at" => date('Y-m-d H:i:s'));
			$this->db->insert('notification_history', $notify_ins);

			$this->email->set_mailtype("html");
			$this->email->from('info@medconnex.net', 'MedConnex');
			$this->email->to($ticket_email.',internaltechsupport@medconnex.net');
			$this->email->subject('MedConnex::Open New Ticket Created');
			$this->email->message('Hello ' . $ticket_email . ',
					<br>Your New Ticket has been created on <b>MedConnex</b> team.<br><br>
					' . $ticket_sub . '<br>
					' . $message_ticket . '
					<br> contact our staff at info@medconnex.net
					<br>
					Thank you,<br>
					MedConnex');
			$mailsend = $this->email->send();

			if (!empty($created_mail)) {
				$this->email->set_mailtype("html");
				$this->email->from('info@medconnex.net', 'MedConnex');
				$this->email->to($created_mail);
				$this->email->subject('MedConnex::Open New Ticket Created');
				$this->email->message('Hello ' . $created_mail . ',
						<br>Your New Ticket has been created.<br><br>
						' . $ticket_sub . '<br>
						' . $message_ticket . '
						<br> contact our staff at info@medconnex.net
						<br>
						Thank you,<br>
						MedConnex');
				$mailsend = $this->email->send();
			}

			$this->session->set_flashdata('success_msg', 'New Ticket completed successfully');
			redirect("sales-admin/ticket_managment");
		}

		$data['last_ticket_no'] = $this->Sales_model->last_ticket_no();
		$this->load->view('sales/ticket-management', $data);
	}

	public function deleteSale($uid) {
		$this->db->where('id', $uid);
		$this->db->delete('uf_user');
		$this->session->set_flashdata('success_msg', 'Deleted successfully');
		redirect("sales-general-sales");
	}

	public function deleteAdver() {
		
			$userid = $this->session->userdata('id');
		$date = date('Y-m-d H:i:s');
				$ad_type= $_REQUEST['ad_type'];
		$historydata_arr = array("user_id" => $userid, "message" => "Advertisement Deleted Successfully. ".$ad_type.'', "created_at" => $date);
			$this->common_model->insert_record($historydata_arr, 'history');
           $ad_id= $_REQUEST['ad_id'];

	 $this->db->where('ad_id', $ad_id);
		 $this->db->delete('sal_advertisement');
		$this->session->set_flashdata('success_msg', 'Deleted successfully');
		redirect("sales-advertisement-sales");
	}

	public function deleteAttach($zip_id) {
		$this->db->where('zip_id', $zip_id);
		$this->db->delete('sal_zip');
		$this->session->set_flashdata('success_msg', 'Deleted successfully');
		redirect("sales-attachment-zip");
	}

	public function updateSales() {
		if (isset($_POST['update'])) {
			if (!empty($this->input->post('username'))) {
				$result = $this->Sales_model->update_user();
				if ($result) {
					$this->session->set_flashdata('success_msg', "General Sales updated successfully");
					redirect("sales-general-sales");
				} else {
					$this->session->set_flashdata('success_msg', "Sales data not updated");
					redirect("sales-general-sales");
				}
			} else {
				$error = '<div style="padding: 5px;" class="alert alert-danger"> User Name </div>';
			}
		}
	}

	public function updateAvr() {
		if (isset($_POST['update'])) {
			if (!empty($this->input->post('ad_type'))) {
				$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				if ($_FILES["image"]["name"] == '') {
					$image = $this->input->post('image_old');
				}
				$path = 'uploads';
				if ($_FILES["image"]["name"] != '') {
					if (file_exists(FCPATH . 'uploads/' . $this->input->post('image_old'))) {
						unlink(FCPATH . 'uploads/' . $this->input->post('image_old'));
					}
					$this->upload_image($image, $path);

					$ad_size = explode("x", $this->input->post('ad_size'));
					$width = $ad_size[0];
					$height = $ad_size[1];
					$this->uploadimageResize50X50($width, $height);
				}

				$result = $this->Sales_model->update_advr($image);
				if ($result) {
					$this->session->set_flashdata('success_msg', "Advertisement Sales updated successfully");
					redirect("sales-admin/advertisement_sales");
				} else {
					$this->session->set_flashdata('success_msg', "Advertisement Sales data not updated");
					redirect("sales-admin/advertisement_sales");
				}
			} else {
				$error = '<div   style="padding: 5px;" class="alert alert-danger" > Ad Type </div>';
			}
		}
	}

	public function updateAttach() {
		if (isset($_POST['update'])) {
			if (!empty($this->input->post('title'))) {
				$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				if ($_FILES["image"]["name"] == '') {
					$image = $this->input->post('image_old');
				}
				$path = 'uploads';
				if ($_FILES["image"]["name"] != '') {
					if (file_exists(FCPATH . 'uploads/' . $this->input->post('image_old'))) {
						unlink(FCPATH . 'uploads/' . $this->input->post('image_old'));
					}
					$this->upload_image($image, $path);
				}

				$result = $this->Sales_model->update_attach($image);
				if ($result) {

					$mail_send = $this->input->post('mail_send');
					if (!empty($mail_send)) {
						$this->email->set_mailtype("html");
						$this->email->from('info@medconnex.net', 'MedConnex');
						$this->email->to($mail_send);
						$this->email->subject('MedConnex::Document');
						$this->email->message('Hello ' . $user_mail . ',
								<br>Your task has been created on <b>MedConnex</b> team.<br><br>
								Check Attachment Document...
								<br> contact our staff at info@medconnex.net
								<br>
								Thank you,<br>
								MedConnex');
						if (!empty($image)) {
							$this->email->attach(base_url() . 'uploads' . $image . '');
						}
						$this->email->send();
					}

					$this->session->set_flashdata('success_msg', "Attachment updated successfully");
					redirect("sales-attachment-zip");
				} else {
					$this->session->set_flashdata('success_msg', "Attachment data not updated");
					redirect("sales-attachment-zip");
				}
			} else {
				$error = '<div   style="padding: 5px;" class="alert alert-danger" > Something wrong..! </div>';
			}
		}
	}

	public function advertisement_sales() {
		if ($this->session->userdata('adminlogin')) {
// $datas = $this->session->get_userdata('adminlogin');
// echo "<pre>"; print_r($datas);
// die();
		
			$data['all_advr'] = $this->Sales_model->getsal_advertisement();
			$data['title'] = 'General Sales';
			$data['file'] = 'sales/advertisement-sales';
			
			$data['all_state'] = $this->common_model->get_data("all_states");

			if (isset($_POST['enable'])) {

				$ad_id = $this->input->post('enable');
				$dataarr = array('status' => "1");
				$result = $this->Sales_model->update_status_sal_advertisement($dataarr, $ad_id);
				$this->session->set_flashdata('success_msg', "Enable Successfully");
				redirect("sales/advertisement_sales");
			}
			if (isset($_POST['disable'])) {

				$ad_id = $this->input->post('disable');
				$dataarr = array('status' => "0");
				$result = $this->Sales_model->update_status_sal_advertisement($dataarr, $ad_id);
				$this->session->set_flashdata('success_msg', "Disable Successfully");
				redirect("sales/advertisement_sales");
			}
			$this->load->view('sales_templates', $data);
		} else {
			redirect('sales-admin/login');
		}
	}

	public function auto_mailsend_ads_sales() {
		$todaydate = date('Y-m-d H:i:s');
		$result = $this->Sales_model->getsal_advertisement();
		$i = 0;
		foreach ($result as $view) {

			$enddate = date('Y-m-d', strtotime('-7 day', strtotime($view['end_date'])));
			if ($todaydate >= $enddate) {
				$i++;
				$mail_send = $view['email'];
				$this->email->set_mailtype("html");
				$this->email->from('info@medconnex.net', 'MedConnex');
				$this->email->to($mail_send);
				$this->email->subject('MedConnex::Advertisement');
				$this->email->message('Hello ' . $mail_send . ',
						<br>Your task has been created on <b>MedConnex</b> team.<br><br>
						 account is almost due for billing
						<br> contact our staff at info@medconnex.net
						<br>
						Thank you,<br>
						MedConnex');
				if (!empty($image)) {
					$this->email->attach(base_url() . 'uploads' . $view['ad_image'] . '');
				}
				$this->email->send();
			}
		}

		$data['sendmailcount'] = $i;
		echo json_encode($data);
	}
	
	public function saveAdver() {
		if (isset($_POST)) {


				$zipcode = $this->input->post('zip');
			if(!empty($zipcode)){
				   $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&sensor=false&key=AIzaSyBT4Ll-DEXGLSemUGlDPgqH9UADeIzQq3Y";
    $details=file_get_contents($url);
    $result = json_decode($details,true);
    if(!empty($result['results'][0]['geometry']['location']['lat'])){
    	 $lat=$result['results'][0]['geometry']['location']['lat'];
    $lng=$result['results'][0]['geometry']['location']['lng'];
    }
    else{
    	$this->session->set_flashdata('error_msg', "'".$zipcode."' Zip code is not exist");
    	redirect('sales-advertisement-sales');

			}
		}

			$query="SELECT  id FROM  uf_user WHERE   email = '".$this->input->post('email')."'";
        $result=$this->db->query($query);
       // echo $this->db->last_query();

		$storeId = $result->row();
		if($storeId->id == ''){
			   	$this->session->set_flashdata('error_msg', "'".$this->input->post('email')."' Email is dose not exist for any store");
    	redirect('sales-advertisement-sales');

		}
		else{
		 $storeId1 =	$storeId->id;
		}


			if (!empty($this->input->post('ad_type'))) {
				$email = $this->input->post('email');
				$userid = $this->session->userdata('id');
				$query="SELECT  count(ad_id) as count  FROM    sal_advertisement WHERE   email  ='$email' AND created_by = '$userid' ";
        $result1=$this->db->query($query);
       $resultData1 = $result1->row();
       //echo "<pre>"; print_r($resultData);
         $getCount1 = $resultData1->count;
	if($getCount1 >=1){
				$this->session->set_flashdata('error_msg', "Already advertisement added for this store");
					redirect("sales/advertisement_sales");
			}




if ($this->input->post('ad_type') == '1stclass') {
				$query="SELECT  count(ad_id) as count  FROM    sal_advertisement WHERE   zip  ='$zipcode' ";
				$result=$this->db->query($query);
				$resultData = $result->row();
				$getCount = $resultData->count;

				if($getCount >=5){
				$this->session->set_flashdata('error_msg', "limit only 5 records");
				redirect("sales/advertisement_sales");
				}
}



if ($this->input->post('ad_type') == '2ndclass') {
				$query="SELECT  count(ad_id) as count  FROM    sal_advertisement WHERE   zip  ='$zipcode' ";
				$result=$this->db->query($query);
				$resultData = $result->row();
				$getCount = $resultData->count;

				if($getCount >=15){
				$this->session->set_flashdata('error_msg', "limit only 15 records");
				redirect("sales/advertisement_sales");
				}
}







			$zip = $this->input->post('zip');

		$query1="SELECT  count(ad_id) as count  FROM    sal_advertisement WHERE   email  ='$email' AND created_by = '$userid' AND zip = '$zip' ";
        $result11=$this->db->query($query1);
       $resultData11 = $result11->row();
       //echo "<pre>"; print_r($resultData);
         $getCount11 = $resultData11->count;
	if($getCount11 >=1){
				$this->session->set_flashdata('error_msg', "Listings are placed according to teritorial zip codes, please consider selecting another zip to place icon in");
					redirect("sales/advertisement_sales");
			}

$providerid = $this->input->post('providerid');
				$query2="SELECT  id FROM  uf_user  WHERE   email  ='$email' AND  randomId = '$providerid' ";
        $result2=$this->db->query($query2);
       $resultData2 = $result2->row();
         $getCount2 = $resultData2->id;

	if(!empty($getCount2)){
				
			}
			else{
				$this->session->set_flashdata('error_msg', "Wrong Provider Id  Or Email");
					redirect("sales/advertisement_sales");
			}




					$zipcode = $this->input->post('zip');
				$query="SELECT  count(ad_id) as count  FROM    sal_advertisement WHERE   zip  ='$zipcode' ";
        $result=$this->db->query($query);
       $resultData = $result->row();
       //echo "<pre>"; print_r($resultData);
         $getCount = $resultData->count;


       

		
			//$getCount=$this->db->select('*')->from('sal_advertisement')->get()->num_rows();
			$counts = $this->Sales_model->get_availiblity_sal_advertisement();
			if($getCount >=10){
				$this->session->set_flashdata('error_msg', "limit only 10 records");
					redirect("sales/advertisement_sales");
			}
				$count = $counts;
				// if($count == 0)
				// {
					$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
					$path = 'uploads';
					if ($_FILES["image"]["name"] != '') {
						if (file_exists(FCPATH . 'uploads/tmp_file/' . $this->input->post('remove_image_task'))) {
							unlink(FCPATH . 'uploads/tmp_file/' . $this->input->post('remove_image_task'));
						}
						$ad_size = explode("x", $this->input->post('ad_size'));
						$width = $ad_size[0];
						$height = $ad_size[1];


						$this->upload_image($image, $path);
						$this->uploadimageResize50X50($width, $height);

					}


					$result = $this->Sales_model->insert_advr($image,$lat,$lng,$storeId1);

					 $messageValue='The Advertisement is added  by';
		 	 	$this->Sales_model->notification_add($messageValue);
					
					if ($result) {
						$this->session->set_flashdata('success_msg', "Advertisement Sales added successfully");
						redirect("sales/advertisement_sales");
					} else {
						$this->session->set_flashdata('success_msg', "Advertisement Sales data not added");
						redirect("sales/advertisement_sales");
					}
				// }
				// else
				// {
				// 	$this->session->set_flashdata('error_msg', "Advertisement Already added on same date and same state.");
				// 	redirect("sales/advertisement_sales");
				// }
			} else {
				$this->session->set_flashdata('error_msg', "Ad Type");
				redirect("sales/advertisement_sales");
			}
		}
	}

	public function saveZipFile() {
		if (isset($_POST)) {

			if (!empty($this->input->post('title'))) {
				$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
				$path = 'uploads';
				if ($_FILES["image"]["name"] != '') {
					$this->upload_image($image, $path);
				}
				$result = $this->Sales_model->insert_attachment($image);
				if ($result) {
					$this->session->set_flashdata('success_msg', "Attachments added successfully");
					redirect("sales-attachment-zip");
				} else {
					$this->session->set_flashdata('success_msg', "Attachments data not added");
					redirect("sales-attachment-zip");
				}
			} else {
				$error = '<div   style="padding: 5px;" class="alert alert-danger" > Attachments </div>';
			}
		}
	}
		public function history(){
		if($this->session->userdata('adminlogin')){
			$id=$this->session->userdata('id');
			$data['title']='History';
			$data['file']='sales/history';
			$where=array('status' =>1, 'user_id'=>$id);
			if(isset($_POST['delete_history'])){
				 $uid= $_POST['delete_history'];
				 $dwhere= array('id' =>$uid);
				 $this->db->where($dwhere);
				 $this->db->delete('history');
			   //  $this->Ondemand_model->deletRecord('history',$dwhere );
			     $this->session->set_flashdata('success_msg', 'history is deleted Successfully..!');
			}
			$data['historyData']=$this->Sales_model->historyData('history',$where );
			
			$this->load->view('sales_templates',$data);
		}else{
			redirect('/');
		}
	}

	public function edit_attachemnt_sale() {
		$result = $this->Sales_model->editAttachSale();
		echo '

		<div class="col-sm-6">
            <div class="form-group">
                <label>First Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input type="hidden" name="image_old" value="' . $result['upload_file'] . '">

                    <input  name="zip_id"  value="' . $result['zip_id'] . '"  type="hidden">

                    <input class="form-control" name="title" autocomplete="off" value="' . $result['title'] . '" placeholder="Please enter the Title" type="text">
                </div>
            </div>
        </div>

          <div class="col-sm-6">
            <div class="form-group ">
                <label for="extra">Choose File</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="ext" name="image">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group ">
                <label>Description </label>
                <div class="input-group">

                    <textarea class="form-control" name="description" rows="8" cols="80">' . $result['description'] . '</textarea>
                </div>
            </div>
        </div>
		';
		//echo  json_encode($result);
	}

	public function edit_general_sale() {
		 $result = $this->Sales_model->editSalesPanel();
// echo "<pre>"; print_r($result);
// die();
		echo '
			<div class="col-sm-6">
            <div class="form-group ">
                <label>Email</label>
                <div class="input-group">
                    <span class="input-group-addon"><a href="mailto: "><i class="fa fa-envelope"></i></a></span>
                    <input class="form-control" name="email" autocomplete="off" value="' . $result['email'] . '" placeholder="Email address" type="text" readonly>
                </div>
            </div>
        </div>
		
		<div class="col-sm-6">
            <div class="form-group">
                <label>Contact No.</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input  name="id"  value="' . $result['id'] . '"  type="hidden">
                    <input class="form-control" name="contactno" autocomplete="off" value="' . $result['contact_no'] . '" placeholder="Please enter the contact no." type="text" required>
                </div>
            </div>
        </div>
		 <div class="col-sm-6">
            <div class="form-group ">
                <label>Zip </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="zip" value="' . $result['zip_code'] . '" autocomplete="off" placeholder="" type="text" required>
                </div>
            </div>
        </div>


        <div class="col-sm-6">
            <div class="form-group">
                <label>Location</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="location_name" autocomplete="off" value="' . $result['location_name'] . '" placeholder="Please enter the location" type="text" required>
                </div>
            </div>
        </div>';
		//echo  json_encode($result);
	}

	public function edit_adrv_sale() {
		$result = $this->Sales_model->editAdverSale();
		$imgUrl = base_url('uploads/' . $result['ad_image']);
		echo '

		<div class="col-sm-6">
            <div class="form-group">
                <label>Ad Type</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input type="hidden" name="image_old" value="' . $result['ad_image'] . '">

                    <input  name="ad_id"  value="' . $result['ad_id'] . '"  type="hidden">

                    <input class="form-control" name="ad_type" autocomplete="off" value="' . $result['ad_type'] . '" placeholder="Please enter the Ad Type" type="text">
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label>Ad Title</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <input class="form-control" name="ad_title" autocomplete="off" value="' . $result['ad_title'] . '" placeholder="Please enter the Last Name" type="text">
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>Ad Size</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                  	<select class="form-control" name="ad_size">';


		$selected2 = $selected1 = "";
		if ($result['size'] == "200x100") {
			$selected1 = "selected";
		} else if ($result['size'] == "1080x1920") {
			$selected2 = "selected";
		}

		echo'	<option value="200x100" ' . $selected1 . '>200 x 100</option>
				<option value="1080x1920" ' . $selected2 . '>1080 x 1920</option>
					</select>
                </div>
            </div>
        </div>

          <div class="col-sm-6">
            <div class="form-group ">
                <label for="extra">Choose File</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="ext" name="image">
                    <img src=' . $imgUrl . ' width="100px" height="100px">
                </div>
            </div>
        </div>
          <div class="col-sm-6">
            <div class="form-group ">
                <label for="extra">Start Date</label>
                    <input type="text" class="form-control datetimepicker4" value="' . date('Y-m-d', strtotime($result['insert_date'])) . '" name="insert_date">
            </div>
        </div>
          <div class="col-sm-6">
            <div class="form-group ">
                <label for="extra">End Date</label>
                    <input type="text" class="form-control datetimepicker4" value="' . date('Y-m-d', strtotime($result['end_date'])) . '" name="end_date">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group ">
                <label>Description </label>
                <div class="input-group">

                    <textarea class="form-control" name="description"  placeholder="" rows="5" cols="80">' . $result['description'] . '</textarea>
                </div>
            </div>
        </div>
		';
		//echo  json_encode($result);
	}

	



	public function payment() {
		if ($this->session->userdata('adminlogin')) {
			$data['title'] = 'Payment';
			$data['file'] = 'sales/payment';
			$this->load->view('sales_templates', $data);
		} else {
			redirect('panels/supermacdaddy/dashboard/login');
		}
	}

	public function notification() {
		if ($this->session->userdata('adminlogin')) {
			$data = array();
			$chat = $inpdex_notiy = '';
			$type_read = "0";
			$notification = $this->Sales_model->notification_history(0, $type_read);
			$i = 0;

			foreach ($notification as $val) {
				if ($i > 2)
					break;

				$inpdex_notiy .= '<li class="update_status_read" id="' . $val['notification_id'] . '" data-typeread="00" >
									<a style="cursor:pointer;">
										<div>
											<i style="color:#fe8860 !important;" class="fa fa-envelope fa-fw"></i> <b>' . $val['user_name'] . '</b><br>' . $val['message'] . '
											<span class="pull-right text-muted small">' . $val['created_at'] . '</span>
										</div>
									</a>
								</li>';
				$i++;
			}
			$inpdex_notiy .= '<li>
								<a class="text-center brdr-0" href="' . base_url() . 'sales-notifications">
								   <strong>See All Alerts</strong>
								   <i class="fa fa-angle-right"></i>
							   </a>
							</li>';

			$data['inpdex_notiy'] = $inpdex_notiy;
			$data['count'] = count($notification);
			echo json_encode($data);
		}else {
			redirect('panels/supermacdaddy/dashboard/login');
		}
	}

	public function tasknotification() {
		$data = array();
		$chat = $inpdex_notiy = '';
		$type_read = "2";
		$notification = $this->Sales_model->notification_history(0, $type_read);
		$i = 0;
		foreach ($notification as $val) {
			if ($i > 2)
				break;
			$inpdex_notiy .= '<li class="update_status_read" id="' . $val['notification_id'] . '" data-typeread="22" >
							<a style="cursor:pointer;">
								<div>
									<i style="color:#56bddc;" class="fa fa-envelope fa-fw"></i> <b>' . $val['user_name'] . '</b><br>' . $val['message'] . '
									<span class="pull-right text-muted small">' . $val['created_at'] . '</span>
								</div>
							</a>
						</li>';
			$i++;
		}
		$inpdex_notiy .= '<li>
				<a class="text-center brdr-0" href="' . base_url() . 'sales-notifications">
				   <strong>See All Alerts</strong>
				   <i class="fa fa-angle-right"></i>
			   </a>
			</li>';
		$data['inpdex_notiy'] = $inpdex_notiy;
		$data['count'] = count($notification);
		echo json_encode($data);
	}

	public function notifications() {

		if ($this->session->userdata('adminlogin')) {
			$data['notifiy_list'] = $this->Sales_model->all_notification_history(0);
			$data['title'] = 'Notifications';
			$data['file'] = 'sales/notifications';
			if (isset($_POST['update_read_notifiy'])) {
				$updateid = $_POST['update_read_notifiy'];
				$type_read = $_POST['type_read'];
				$dataa = array("type_read" => $type_read);
				$this->db->where('id', $updateid);
				$this->db->update('notification_history', $dataa);

				$this->session->set_flashdata('success_msg', 'Read Successfully');
				redirect("sales-admin/notifications");
			}
			$this->load->view('sales_templates', $data);
		} else {
			redirect('sales-admin/login');
		}
	}

	public function msg_notification() {
		$data = array();
		$chat = $inpdex_notiy = '';
		$type_read = "3";
		$notification = $this->Sales_model->notification_history(0, $type_read);
		$i = 0;
			$inpdex_notiy .=' <li><a href="javascript:void(0);"  data-toggle="modal" data-target="#composemail" ><i class="fa fa-envelope" aria-hidden="true"></i> Compose</a>
                        </li>';
		foreach ($notification as $val) {
			if ($i > 2)
				break;
			$parth = '';
			$filename = 'uploads/' . $val['attachment'];
			if (file_exists($filename)) {
				$parth = "<a href=" . base_url() . $filename . " download><i class='fa fa-download' style='font-size:20px'></i></a>";
			}
			$inpdex_notiy .= '<li class="update_status_read" id="' . $val['notification_id'] . '" data-typeread="33" style="cursor:pointer;">

								<div>
									<strong>' . $val['user_name'] . '</strong>
									<span class="pull-right text-muted">
										<em>' . $val['created_at'] . '</em>
									</span>
								</div>
								<div> ' . $val['message'] . $parth . '</div>

						</li>';
			$i++;
		}
		$inpdex_notiy .= '<li>
				<a class="text-center brdr-0" href="' . base_url() . 'sales-notifications">
				   <strong>Read All Messages</strong>
				   <i class="fa fa-angle-right"></i>
			   </a>
			</li>';
		$data['inpdex_notiy'] = $inpdex_notiy;
		$data['count'] = count($notification);
		echo json_encode($data);
	}

	public function update_notification() {
		$uid = $this->input->post('notify_id');
		$typeread = $this->input->post('typeread');
		$dataa = array("type_read" => $typeread);
		$this->db->where('id', $uid);
		$this->db->update('notification_history', $dataa);
		$json['success'] = true;
		echo json_encode($json);
	}

//	public function tasknotification_extra()
//	{
//		if($this->session->userdata('adminlogin')){
//
//			$tasknotification = $this->Sales_model->tasknotification(5);
//			foreach($tasknotification as $val){
//            echo '<li>
//                            <a href="#">
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
//			}
//			//echo '<li> <a class="text-center brdr-0" href="#"> <strong>See All Tasks</strong> <i class="fa fa-angle-right"></i> </a> </li>';
//		}else{
//			redirect('panels/supermacdaddy/dashboard/login');
//		}
//	}
//	public function msgnotification(){
//		if($this->session->userdata('adminlogin')){
//			 $data = $chat = $inpdex_notiy ='';
////			$notification = $this->Sales_model->msgnotification(0);
//			$type_read="3";
//			$notification = $this->Sales_model->notification_history(0,$type_read);
//			$i =0;
//			foreach($notification as $val){
//				if($i > 2)
//				break;
//               $inpdex_notiy.= '<li>
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
//					$i++;
//			}
//
//
//			$data['inpdex_notiy'] = $inpdex_notiy;
//			$data['count'] = count($notification);
//			echo json_encode($data);
//
//
//		}else{
//			redirect('panels/supermacdaddy/dashboard/login');
//		}
//	}
	//common function for upload image of user


	public function setting() {
		if ($this->session->userdata('adminlogin')) {
			$data['title'] = "Site Settings";
			$data['file'] = 'sales/setting';
			$data['profile'] = $this->common_model->get_data_tbl('uf_user', 'id', $this->session->userdata('id'));
			$this->load->view('sales_templates', $data);
		} else {
			redirect('sales-admin/login');
		}
	}

	public function updatePassword() {
		if (isset($_POST) && $this->input->post('password') != '') {
			if ($this->input->post('password') == $this->input->post('confirmPass')) {
				$data = array(
					'password' => md5($this->input->post('password')),
					'email' => $this->input->post('email'),
					'user_name' => $this->input->post('user_name'),
					'display_name' => $this->input->post('display_name'),
					'mob_number' => $this->input->post('mob_number'),
					'socialid' => $this->input->post('socialid')
				);

				$this->common_model->update_record($data, 'uf_user', 'id', $this->session->userdata('id'));

				$this->session->set_flashdata('success_msg', 'Profile and Password Updated Successfully');
				redirect('sales-setting');
			} else {
				$this->session->set_flashdata('error_msg', 'Password not match.');
				redirect('sales-setting');
			}
		} else {
			$data = array(
				'email' => $this->input->post('email'),
				'user_name' => $this->input->post('user_name'),
				'display_name' => $this->input->post('display_name'),
				'mob_number' => $this->input->post('mob_number'),
				'socialid' => $this->input->post('socialid'));

			$this->common_model->update_record($data, 'uf_user', 'id', $this->session->userdata('id'));

			$this->session->set_flashdata('success_msg', 'Profile Updated Successfully');
			redirect('sales-setting');
		}
	}

	public function logout() {
//        $this->session->unset_userdata('login');
//        $this->session->sess_destroy();
//        redirect('/');
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

	public function temp_view() {
		$image = '';
		if (!empty($_FILES["image"]["name"])) {

			$ad_size = explode("x", $this->input->post('ad_size'));
			$width = $ad_size[0];
			$height = $ad_size[1];
			$image = trim(str_replace(" ", "_", time() . $_FILES["image"]["name"]));
			$path = 'uploads/tmp_file';
			$this->upload_image($image, $path);
			$this->uploadimageResize50X50($width, $height);
		}
		$data['success'] = $image;
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

	public function mailSendGeneralSales() {
		$email = $this->input->post('email');
		$email_subject = $this->input->post('email_subject');
		$email_description = $this->input->post('email_description');

		if (!empty($email_description) && !empty($email)) {
			$this->email->set_mailtype("html");
			$this->email->from('info@medconnex.net', 'MedConnex General Sales');
			$this->email->to($email);
			$this->email->subject('MedConnex::' . $email_subject);
			$this->email->message($email_description);
			$mailsend = $this->email->send();
			$this->session->set_flashdata('success_msg', 'Mail has been sent successfully');
			redirect('sales-general-sales');
		} else {
			$this->session->set_flashdata('error_msg', 'Mail is not sent..!!, May be Email description is empty');
			redirect('sales-general-sales');
		}
	}
	 public function composemail()
  {

        $email=$this->input->post('send_to');

        $cc=$this->input->post('cc');

        $subject=$this->input->post('send_subject');
        $send_message=$this->input->post('send_message');
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnex');
		$this->email->to($email);
		$this->email->cc($cc);
		$this->email->subject('MedConnex:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnex');

		 	$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('successmessage', 'Mail has sent successfully');
			redirect("sales-admin");
		} else {
			$this->session->set_flashdata('successmessage', 'Sorry  Mail is not sent');
			redirect("sales-admin");
		}
  }

  	 public function twoweekCompEmail()
  {

        $email=$this->input->post('send_to');

        $cc=$this->input->post('cc');

        $subject=$this->input->post('send_subject');
        $send_message=$this->input->post('send_message');
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnex');
		$this->email->to($email);
		$this->email->cc($cc);
		$this->email->subject('MedConnex:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'<br>
			Thank You for trying out our 2 Week  Complimentary Trial , web are sure you will stay after experiencing our great service. After your 2 Week Trial your back panel will FREEZE and you will need to contact our Sales Department to activate your account again.<br>
			MedConnex');

		 	$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('successmessage', 'Mail has sent successfully');
			redirect("sales-admin");
		} else {
			$this->session->set_flashdata('successmessage', 'Sorry  Mail is not sent');
			redirect("sales-admin");
		}
  }
  public function shareEmailOrMobile()
  {
      $id=$this->input->post('id');
      $where = array('zip_id' =>$id);
	  $result=$this->Sales_model->getDataWhere('sal_zip',$where);
	  echo json_encode($result);
  }
   public function shareEmail()
  {

        $email=$this->input->post('send_to');
        $subject=$this->input->post('send_subject');
        $id=$this->input->post('id');
         $where = array('zip_id' =>$id);
	    $result=$this->Sales_model->getDataWhere('sal_zip',$where);
        $send_message=$result['description'];
        $upload_file=$result['upload_file'];
        $this->email->set_mailtype("html");
		$this->email->from('info@medconnex.net', 'MedConnex');
		$this->email->to($email);
		$this->email->subject('MedConnex:: '.$subject);
		$this->email->message('Hello ' . $email . ',<br/>
			'.$send_message.'
			Thank you,<br>
			MedConnex');
			if (!empty($upload_file)) {
			$this->email->attach(base_url('uploads/'.$upload_file));
			}

		 	$mailsend = $this->email->send();

		if ($mailsend) {
			$this->session->set_flashdata('success_msg', 'Mail has sent successfully');
			redirect("sales-attachment-zip");
		} else {
			$this->session->set_flashdata('error_msg', 'Sorry  Mail is not sent');
			redirect("sales-attachment-zip");
		}
  }
   public function generalTrashAll(){
		 $book =$this->input->post('book');
	     foreach($book as $where){
	      $this->db->delete('uf_general_sale', array('id' =>$where));
	     }


	   if($book){
	        $this->session->set_flashdata('success_msg', 'Records are deleted successfully');
			    redirect('sales-general-sales');
	     }else{
	       $this->session->set_flashdata('error_msg', 'Please checked atleast one or more');
			   redirect('sales-general-sales');
	     }


	}
	   public function generalTrash(){
	 $id = $_REQUEST['id'];

	$this->db->where('id', $id);
   $this->db->delete('uf_general_sale');

	      // $this->db->delete('uf_general_sale', array('id' =>$id));
	     
	     

	   if($id){
	        //$this->session->set_flashdata('success_msg', 'Records are deleted successfully');
	   	echo 'Records are deleted successfully';
			  
	     }else{
	       //$this->session->set_flashdata('error_msg', 'Please checked atleast one or more');
			  echo 'Please checked atleast one or more';
	     }


	}


	function buy(){
        // Set variables for paypal form
        $returnURL = base_url().'front/success'; //payment success url
        $cancelURL = base_url().'front/cancel'; //payment cancel url
        $notifyURL = base_url().'front/ipn'; //ipn url
         
//$products = $this->cart->contents();


        // Get product data
       // $product = $this->product->getRows($id);
        
        // Get current user ID from session
        $userdata = $this->session->all_userdata('logged_in');
// $userID = $userdata['userid'];
       $total = '200';
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
		//foreach ($products as $product){
        //$this->paypal_lib->add_field('item_name', $product['name']);
        // $this->paypal_lib->add_field('custom', $userID);
        // //$this->paypal_lib->add_field('item_number',  $product['id']);
        // $this->paypal_lib->add_field('amount',  $total);
		
        
        // Load paypal form
        $this->paypal_lib->paypal_auto_form();

    }

function success(){
    // $this->load->view('header');
    // $this->cart->destroy();
	  $paypalInfo = $this->input->post();
//echo "<pre>"; print_r($paypalInfo);  
        //$data['user_id']     = $paypalInfo['custom'];
        //$data['product_id']    = $paypalInfo["item_number"];
         $data['payer_name']    = 'Amarjeet';
        $data['txn_id']    = 'dfgdgh76tf5dsfdd';
        //$data['payment_gross'] = $paypalInfo["mc_gross"];
        $data['paid_amount'] = '350';
       // $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['paid_amount_currency'] = 'usd';
        //$data['payer_email'] = $paypalInfo["payer_email"];
         $data['payer_email'] = 'amarjeet@gmail.com';
        $data['payment_status']    = "succeeded";
        $data['created']    = '2019-01-01';
        
   //      $userdata = $this->session->all_userdata();
	  //    $user_name = $userdata['name'];
	  //    $user_email = $userdata['email'];
   // $data['user_name']    = $user_name;
   //  $data['user_email']    = $user_email;
   
		

        $paypalURL = $this->paypal_lib->paypal_url;
        $result     = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        
        // Check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            // Insert the transaction data into the database
           /// $this->front_model->insertTransaction($data);
        }
        // Get the transaction data
		
        //$paypalInfo = $this->input->get();
        echo "<pre>"; print_r($paypalInfo);
      
        //$data['item_number'] = $paypalInfo['item_number']; 
        // $data['txn_id'] = $data['txn_id'];
        // $data['payment_amt'] = $data['paid_amount'];
        // $data['currency_code'] = $data['paid_amount_currency'];
        // $data['status'] = $data['payment_status'];
     
        // // Pass the transaction data to view
        // $this->load->view('paypal/success', $data);


// $this->load->view('footer');
        
    }


     
     function cancel(){
         	
        // $this->load->view('header');
        // $this->load->view('paypal/cancel');
        // $this->load->view('footer');
     }
     
     function ipn(){
        // Paypal return transaction details array
        $paypalInfo = $this->input->post();

        $data['user_id']     = '1260';
       // $data['product_id']    = $paypalInfo["item_number"];
        $data['txn_id']    = 'dfsgdgdg7dfg7dfgbdfgbdfg';
        $data['payment_gross'] = '450';
        $data['currency_code'] = 'usd';
        $data['payer_email'] = 'lalit@gmail.com';
        $data['payment_status']    = 'success';

        $paypalURL = $this->paypal_lib->paypal_url;
        $result     = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        
        // Check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            // Insert the transaction data into the database
            $this->product->insertTransaction($data);
        }
    }
        public function exportSignupUsers() {
    
        $fileName = 'users-'.time().'.xlsx';  
		// load excel library
        ///$this->load->library('excel');
        // $empInfo = $this->Sales_model->getsal_advertisement();
        // echo "<pre>"; print_r($empInfo);
        // die();
 
$object = new PHPExcel();

  $object->setActiveSheetIndex(0);

  $table_columns = array("User Name", "Logo","Display Name", "Email", "Title", "Verified","State","City","Street","Mobile","Address","Zip","Profile Pic","Created At");

  $column = 0;

  foreach($table_columns as $field)
  {
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $employee_data = $this->Sales_model->getUsers();

  $excel_row = 2;

  foreach($employee_data as $row)
  {

if(!empty($row['logo'])){
	$imageurl = base_url().'uploads/';
}
else{
	$imageurl = '';
}


   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['user_name']);
   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $imageurl.''.$row['logo']);
   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['display_name']);
   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['email']);
	$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['title']);
	$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['is_verify']);
	$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['state']);
	$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['city']);
	$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['street']);
	$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['mob_number']);
	$object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['address']);
	$object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row['zip']);
	$object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row['profile_pic']);
	$object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row['created_at']);
   $excel_row++;
  }

  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Employee Data.xls"');
  $object_writer->save('php://output');
 }
    public function exportAdvertisement() {
    
        $fileName = 'advertisement-'.time().'.xlsx';  
		// load excel library
        ///$this->load->library('excel');
        // $empInfo = $this->Sales_model->getsal_advertisement();
        // echo "<pre>"; print_r($empInfo);
        // die();
 
$object = new PHPExcel();

  $object->setActiveSheetIndex(0);

  $table_columns = array("Provider Name", "Contact", "Email", "Ad Type", "Description","Start Date","End Date");

  $column = 0;

  foreach($table_columns as $field)
  {
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $employee_data = $this->Sales_model->getsal_advertisement();

  $excel_row = 2;

  foreach($employee_data as $row)
  {
   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['providername']);
   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['contact']);
   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['email']);
   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['ad_type']);
   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['description']);
      $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['insert_date']);
   $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['end_date']);
   $excel_row++;
  }

  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Employee Data.xls"');
  $object_writer->save('php://output');
 }



	public  function acceptTerms()
	{
		
			$id = $this->session->userdata('id');
				$acceptTerms = $_POST['acceptTerms'];
			
			$dataarr=array("acceptTerms"=>$acceptTerms);
			$this->db->where('id',$id);
			$this->db->update(' uf_user',$dataarr);
			$this->session->set_flashdata('successmessage', 'Terms & Conditions Successfully.');
			redirect("sales-admin");
		
	}





      
    

}
