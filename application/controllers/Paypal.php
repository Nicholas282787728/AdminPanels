<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // $this->load->library('email');
         $this->load->model('Sales_model');
        // $this->load->model('common_model');
        $this->load->library('paypal_lib');

    }


// function updateProducts(){
    

//     $sql = "select id,email  from uf_user  ";
//         $query = $this->db->query($sql);
//         $res = $query->result_array();
//          $count = count($res);


     
        

           
//   foreach ($res as $row) {



//  $name = explode('@', $row['email']);

  
//     $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
//       $randomId1 =  substr(str_shuffle($str_result),  
//                        0, 7);
//       $randomId = $randomId1.'-'.$name[0];
//   $dataarr = array('randomId' => $randomId);



//             $this->db->where('id', $row['id']);
//           $this->db->update('uf_user', $dataarr);



//              // $data = array('user_id' => $row['id'],
//              //                );
//              //  $this->db->insert('cp_complimentary_ad', $data);
                           
//          }


     
        
    
        
// }
          public function productsBulkUpload()
    {
        
        $image = $_FILES["image"]["name"];
        $path = 'uploads';
        $ext = end((explode(".", $image)));
        $extension=strtolower($ext);
        if($extension !='csv'){
          $this->session->set_flashdata('error_msg', "Please upload csv file ");
          redirect("authorized-users");
        }

        $result=$this->upload_image($image, $path);
        
        $file = fopen("uploads/".$result['file_name'],"r");
        $i=0;
      
        while(($row = fgetcsv($file)) !== FALSE){
            $i++;
            if($i == '1'){
                continue;
            } 
              if(!empty($row[0])){
                $result=$this->db->select('*')->from('productsss')->where('email',$row[0])->get()->num_rows();
                if($result > 0){
                    continue;
                 }
          
                             $data = array(
                            
                                "user_name" => trim($row[0]),
                                "street" => trim($row[1]),
                                "city" => trim($row[2]),
                                "state" => trim($row[3]),
                                "zip" => trim($row[4]),  

                                "email" => trim($row[5]),
                                "mob_number" => trim($row[6]),
                                "member_since" => trim($row[7]),
                                "logo" => trim($row[8]),
                                "profile_pic " => trim($row[9]),

                                "user_lat" => trim($row[10]),
                                "user_long" => trim($row[11]),
                                "facebook" => trim($row[12]),
                                "twitter" => trim($row[13]),
                                "instagram" => trim($row[14]),

                                "complimentary_ad_space" => trim($row[15]),
                                "page_url" => trim($row[16]),
                                "display_name" => trim($row[0]),
                                "address" => trim($row[1]),
                                "is_verify" => '1',
                                "title" => 'Store',
                                 "user_type" => '3',
                                 "addDate" => date('Y-m-d'),
                                "created_by_id" => '1'
                );
            
              $this->db->insert('productsss',$data);
             // $insertid=$this->db->insert_id();
   
             // $location = array(
             //                        "user_id"=>$insertid,
             //                        "paypal_business_name"=>$row[0],
             //                        "city"=>$row[2],
             //                        "email"=>$row[5],
             //                        "phone_number"=>$row[6],
             //                        "longitude"=>$row[11],
             //                        "latitude"=>$row[10]
             //                    );

             //  $this->db->insert('cp_product_size',$location);
             
           }
         }
         fclose($file);
          $this->session->set_flashdata('success_msg', "Products bulk upload is done successfully ");
          redirect("authorized-users");

    }


function buy(){
        // Set variables for paypal form
        $returnURL = base_url().'paypal/success'; //payment success url
        $cancelURL = base_url().'paypal/cancel'; //payment cancel url
        $notifyURL = base_url().'paypal/ipn'; //ipn url
         
//$products = $this->cart->contents();


        // Get product data
       // $product = $this->product->getRows($id);
        
        // Get current user ID from session
        $userdata = $this->session->all_userdata('logged_in');
 $userID =  $this->session->userdata('id');
   
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
		//foreach ($products as $product){
        //$this->paypal_lib->add_field('item_name', $product['name']);
        $add_id = $_REQUEST['ad_id'];
       /// $this->paypal_lib->add_field('ad_id', $add_id);
         $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  $add_id);
        // $this->paypal_lib->add_field('amount',  $total);
		
        
        // Load paypal form
        $this->paypal_lib->paypal_auto_form();

    }

function success(){
 $paypalInfo = $this->input->post();


        $data = array('user_id' => $paypalInfo['custom'],
                        'txn_id' => $paypalInfo['txn_id'],
                        'amount' => $paypalInfo['mc_gross'],
                        'amount_currency' => $paypalInfo['mc_currency'],
                        'payer_email' => $paypalInfo['payer_email'],
                        'payment_status' => $paypalInfo['payment_status'],
                        'created' => $paypalInfo['payment_date'],
                         'ad_id' => $paypalInfo['item_number'],
                        'paymentMethod' => 'paypal');

        

        $paypalURL = $this->paypal_lib->paypal_url;
        $result     = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        
        // Check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            // Insert the transaction data into the database

              $this->Sales_model->insertTransaction($data);
        }
        redirect('/');
    
      
        
    }


     
     function cancel(){
         	
        // $this->load->view('header');
        // $this->load->view('paypal/cancel');
        // $this->load->view('footer');
     }
     
     function ipn(){
        // Paypal return transaction details array
        $paypalInfo = $this->input->post();


          $data = array('user_id' => $paypalInfo['custom'],
                        'txn_id' => $paypalInfo['txn_id'],
                        'amount' => $paypalInfo['mc_gross'],
                        'amount_currency' => $paypalInfo['mc_currency'],
                        'payer_email' => $paypalInfo['payer_email'],
                        'payment_status' => $paypalInfo['payment_status'],
                        'created' => $paypalInfo['payment_date'],
                        'paymentMethod' => 'paypal');

        $paypalURL = $this->paypal_lib->paypal_url;
        $result     = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        
        // Check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            // Insert the transaction data into the database
            $this->product->insertTransaction($data);
        }
    }
}
