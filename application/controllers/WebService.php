<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Name : Rsapi Controller
 * Description : Used to handle all APIs
 * @author Ajit
 * @createddate : Jun 10, 2016
 * @modificationlog : Adding comments and cleaning the code
 * @change on Mar 16, 2017
 */
class WebService extends CI_Controller {
    
    /**
     * Initializing variable
     */
    protected $token;
    
    /**
     * Responsable for auto load the the models
     * Responsable for auto load helpers
     * Responsable for auto load libraries
     * Defining the timezone
     * @return void
     */
   public function __construct() {
        parent::__construct();
      
    } 

    /**
     * Description : Mapping all the APIs
     * Author : Ajit
     * @param json data
     * @return json data
*/

  
    public function getAllProfiles()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
              
                 $data=array('user_type' =>'0');
                 $result = $this->WebServiceModel->getDataWhereMore('uf_user',$data);
                 if($result){
                   $response=  array('status' =>'success','message' => 'my profile  records','data' =>  $result);
                  }else{
                     $response=array('status' =>'fail','message' => 'There is no user profiles');
                 }
                json_output_andriod($response['status'],$response);
            }
        }
    }

    public function onlineusers()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
              
                 $data=array('user_type' =>'0','on_off_status' =>'1');
                 $result = $this->WebServiceModel->getDataWhereMore('uf_user',$data);
                 if($result){
                   $response=  array('status' =>'success','message' => 'online users','data' =>  $result);
                  }else{
                     $response=array('status' =>'fail','message' => 'There is no online users ');
                 }
                json_output_andriod($response['status'],$response);
            }
        }
    }
     public function ondemandPayments()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
           $id=$_POST['id'];

            if(empty(is_numeric($id))){
           $response=array('status' => 'fail' ,'message' => 'user id can not empty and must be numeric.');
           }else{
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                 $data=array('user_id' => $id);
                 $result = $this->WebServiceModel->getDataWhereMore('payment_details',$data);
                 $totalAmount = $this->WebServiceModel->payments($id);
                   $response=  array('status' =>'success','message' => 'ondemand payment Details','data' =>  $result,'totalAmount' =>$totalAmount -$totalAmount*10/100);
            }
          }
          json_output_andriod($response['status'],$response);
        }
    }

    public function storeCoins(){    
      $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){  
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                 $user_id=$params['user_id'];
                 $coins=$params['coins'];
                 $data = array(
                          'user_id' =>$user_id , 
                          'coins' =>$coins , 
                        );
                 $result = $this->WebServiceModel->insertData('app_coins', $data);
                 if($result){
                   $response=  array('status' =>'success','message' => 'Coins are stored Successfully');
                  }else{
                     $response=array('status' =>'fail','message' => 'coins are not stored');
                 }
                json_output_andriod($response['status'],$response);
            }
        }

    }
     public function friendRequest(){
      $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $params =$_POST;
                 $sender_id=$params['sender_id'];
                 $recipient_id=$params['recipient_id'];
                 $data = array(
                          'sender_id' =>$sender_id , 
                          'recipient_id' =>$recipient_id ,             
                          'confirmed' =>'0'  
                        );
                 $result = $this->WebServiceModel->insertData('app_friends', $data);
                 
                 if($result){
                   $response=  array('status' =>'success','message' => 'friend request has sent successfully');
                  }else{
                     $response=array('status' =>'fail','message' => 'friend request has not sent successfully');
                 }
                json_output_andriod($response['status'],$response);
            }
        }

    }

     public function getCoins()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
           $user_id=$_POST['user_id'];

            if(empty(is_numeric($user_id))){
           $response=array('status' => 'fail' ,'message' => 'user id can not empty and must be numeric.');
           }else{
             $check_auth_client = true;
             if($check_auth_client == true){
                 $params = json_decode(file_get_contents('php://input'), TRUE);
                 $data=array('user_id' => $user_id);
                 $result = $this->WebServiceModel->getDataWhereMore('app_coins',$data);
                 $response=  array('status' =>'success','message' => 'Coins are getting individual user','data' =>  $result);


            }
          }
          json_output_andriod($response['status'],$response);
        }
    }

    public function payoutDetails()
    {
       $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
           $id=$_POST['id'];

            if(empty(is_numeric($id))){
           $response=array('status' => 'fail' ,'message' => 'user id can not empty and must be numeric.');
           }else{
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                 $data=array('user_id' => $id);
                 $result = $this->WebServiceModel->getDataWhere('payout_details',$data);
                 if($result){
                    $response=  array('status' =>'success','message' => 'Coins are getting individual user','data' =>  $result);
                  }else{
                     $userData=  $this->WebServiceModel->login(array('id' =>$id));
                     if($userData){
                      $user_email=$userData->email;
                        $this->email->set_mailtype("html");
                        $this->email->from('info@medconnex.net', 'MedConnx');
                        $this->email->to($email);
                        $this->email->cc('techsupport@medconnex.net');
                        $this->email->subject('MedConnx::Please Update payout details');
                        $this->email->message('Hello ' . $user_email . ',
                             Please update payout details. user is making payment to your medconnex account
                            Thank you,<br>
                            MedConnx');
                        $this->email->send();
                        $admin= $this->WebServiceModel->login(array('user_type' =>'5'));
                        $adminid=$admin->id;
                        $admindata = array(
                            'user_id' =>$adminid , 
                            'message' =>' Please update payout details. user is making payment to your medconnex account '.$user_email , 
                            'read_status'=>'0'
                           );
                        $this->WebServiceModel->insertData('notification_history',$admindata);
                        $response=  array('status' =>'success','message' => 'Provider has been notified will be Contact soon. Thank you' ,'provider' =>'mail has sent '.$user_email);
                     }else{
                       $response=  array('status' =>'success','message' => 'Provider has been notified will be Contact soon. Thank you');
                     }
                     
                   
                  }   
            }
          }
          json_output_andriod($response['status'],$response);
        }
    }


      public function getAdvertisement()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $result =$this->WebServiceModel->getData('sal_advertisement');
                 $imageurl=base_url('uploads');
                   $response=  array('status' =>'success','message' => 'Get Advertisement','data' =>  $result,'imageurl'=> $imageurl);
                  
                json_output_andriod($response['status'],$response);
            }
        }
    }
     public function complimentryAd()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $result =$this->WebServiceModel->getData('cp_complimentary_ad');
                 $imageurl=base_url('uploads');
               
                   $response=  array('status' =>'success','message' => 'Complimentary Advertisement','data' =>  $result,'imageurl'=> $imageurl);
                  
                json_output_andriod($response['status'],$response);
            }
        }
    }


     public function platinumad()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
              
                 $data=array('ad_type' =>'Platinum');
                 $result = $this->WebServiceModel->getDataWhereMore('sal_advertisement',$data);
            
                   $response=  array('status' =>'success','message' => 'Platinum advertisement','data' =>  $result);
                 
                json_output_andriod($response['status'],$response);
            }
        }
    }
    public function complimentary()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
        
                 $data=array('ad_type' =>'complimentary');
                 $result = $this->WebServiceModel->getDataWhereMoreBySelected('sal_advertisement',$data);
                
                   $response=  array('status' =>'success','message' => 'complimentary ','data' =>  $result);
                 
                json_output_andriod($response['status'],$response);
            }
        }
    }

     public function weeklySpecials()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
              
                 $data=array('ad_type' =>'Weekly Specials');
                 $result = $this->WebServiceModel->getDataWhereMore('sal_advertisement',$data);
               
                   $response=  array('status' =>'success','message' => 'Weekly Specials  ','data' =>  $result);
                  
                json_output_andriod($response['status'],$response);
            }
        }
    }


     public function reservations()
     {
         $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
              
                 $data=array('accepted' =>'0');
                 $result = $this->WebServiceModel->getDataWhereMore('app_reservations',$data);
                 if($result){
                   $response=  array('status' =>'success','message' => 'Reservations','data' =>  $result);
                  }else{
                 $response=array('status' =>'fail','message' => 'There is no  Reservations');
                 }
                json_output_andriod($response['status'],$response);
            }
        }
     }
          public function appointments()
     {
         $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            json_output_andriod('fail',array('status' => 'success','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
              
                 $data=array('accepted' =>'1');
                 $result = $this->WebServiceModel->getDataWhereMore('app_reservations',$data);
               
                   $response=  array('status' =>'success','message' => 'appointments','data' =>  $result);
                  
                json_output_andriod($response['status'],$response);
            }
        }
     }
      public function notificationHistory()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            $user_id=$_POST['id'];
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                  $data=array('user_id' =>$user_id);
                 $result = $this->WebServiceModel->getDataWhereMore('notification_history',$data);
                   $response=  array('status' =>'success','message' => 'notification history','data' =>  $result);
                  
                json_output_andriod($response['status'],$response);
            }
        }
    }
   
    public function individualusers()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            $user_id=$_POST['id'];
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                 
                 $query =$this->db->query("SELECT uf_user.id as usertableid,uf_user_documents.* FROM `uf_user` JOIN uf_user_documents on uf_user.id= uf_user_documents.user_id WHERE uf_user.id='".$user_id."'");
                 $result=$query->result();
                   $response=  array('status' =>'success','message' => 'notification history','data' =>  $result);
                  
                json_output_andriod($response['status'],$response);
            }
        }
    }
    public function onlineDrivers()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
             $check_auth_client = true;
            if($check_auth_client == true){
                $user_lat=$_POST['user_lat'];
                $user_long=$_POST['user_long'];
                $lat=  explode('.',  $user_lat);
                $long=  explode('.',  $user_long);
  
                  $query='SELECT *, ( 3959 * acos( cos( radians('.$lat[0].') ) * cos( radians( user_lat ) ) * cos( radians( user_long ) - radians('.$long[0].') ) + sin( radians('.$lat[0].') ) * sin( radians( user_lat ) ) ) ) AS distance FROM uf_user WHERE user_type ="1" and on_off_status ="1" HAVING distance < 50 ORDER BY distance';
                  $result = $this->db->query($query)->result();
                   $response=  array('status' =>'success','message' => 'online Drivers','data' =>  $result);
                  
                json_output_andriod($response['status'],$response);
            }
        }
        
    }

    public function gpslocation()
    {
         $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$user_id=$this->uri->segment(2);
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                //  $data=array('user_type' =>'1','on_off_status' =>'1');
                 $result = $this->WebServiceModel->get_visibility_data();
                   $response=  array('status' =>'success','message' => 'get all GPS locaton','data' =>  $result);
                  
                json_output_andriod($response['status'],$response);
            }
        }
       
    }
    public function usergpslocation($value='')
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            $user_id=$_POST['id'];
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                //  $data=array('user_type' =>'1','on_off_status' =>'1');
                 $result = $this->WebServiceModel->get_visibility_data($user_id);
                   $response=  array('status' =>'success','message' => 'individual user GPS locations','data' =>  $result);
                  
                json_output_andriod($response['status'],$response);
            }
        }

       
    }
     public function documentVerfication()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            $user_id=$_POST['id'];
             $check_auth_client = true;
            if($check_auth_client == true){
                $where = array('id' =>$user_id);
                $data = array('document_status' =>'1','admin_permission' =>'1');
                $result = $this->WebServiceModel->getUpdate('uf_user_documents', $data, $where);
                $response=  array('status' =>'success','message' => 'document is verified');
                  
                 json_output_andriod($response['status'],$response);
            }
        }

       
       
    }


      public function adminpermision()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            $user_id=$_POST['id'];
             $check_auth_client = true;
            if($check_auth_client == true){
                $where = array('id' =>$user_id);
                $data = array('document_status' =>'0','admin_permission' =>'0');
                $result = $this->WebServiceModel->getUpdate('uf_user_documents', $data, $where);
                $response=  array('status' =>'success','message' => 'premission is approved');
                  
                 json_output_andriod($response['status'],$response);
            }
        }
        
       
       
    }

       public function gpsIconActivated()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            $user_id=$_POST['id'];
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                 
                 $query =$this->db->query("SELECT uf_user.id as usertableid,uf_user_documents.* FROM `uf_user` JOIN uf_user_documents on uf_user.id= uf_user_documents.user_id WHERE uf_user.id='".$user_id."'");
                 $result=$query->result();
                 $datas=$query->result_array();
                  $providerid=$datas[0]['provider_id'];
                   $data=[];
                   
                 foreach ($result as $r) {
                    $data[]=$r->document_status;
                   //  $providerid=$r->provider_id;
                 }
                 if (in_array("0", $data))
                      {
                      $pending='0';
                      $message='document verification is pending';
                      }
                    else
                      {
                       $pending='1';
                        $message='document verification is done';
                      }
                       $admindata = array(
                            'user_id' =>$providerid , 
                            'message' =>$message , 
                            'read_status'=>'0'
                           );
                   $this->WebServiceModel->insertData('notification_history',$admindata);
                   $response=  array('status' =>'success','message' => $message,'data' =>  $pending);
                  
                json_output_andriod($response['status'],$response);
            }
        }
    }
    public function products($value='')
   {
       $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output_andriod('fail', array('status' => 'fail','message' => 'Bad request.'));
         } else {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        
            $result=$this->WebServiceModel->getData('cp_products');
            if($result){
           $response=  array('status' =>'success','message' => 'get all records','result' =>  $result);
           }else{
           $response=array('status' =>'fail','message' => 'No records found.');
           }
         json_output_andriod($response['status'],$response);
        }
   }

   public function onlineStores()
    {
       
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
              
                $user_lat=$_POST['user_lat'];
                $user_long=$_POST['user_long'];
                $lat=  explode('.',  $user_lat);
                $long=  explode('.',  $user_long);
  
                  $query='SELECT *, ( 3959 * acos( cos( radians('.$lat[0].') ) * cos( radians( user_lat ) ) * cos( radians( user_long ) - radians('.$long[0].') ) + sin( radians('.$lat[0].') ) * sin( radians( user_lat ) ) ) ) AS distance FROM uf_user WHERE user_type ="3" and on_off_status ="1"  HAVING distance < 200 ORDER BY distance';
                  $result = $this->db->query($query)->result();
                
                   $response=  array('status' =>'success','message' => 'online stores','data' =>  $result);
                 
                json_output_andriod($response['status'],$response);
            } 
        }
        
    }
     public function onlineDoctors()
    {
         $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
              
                $user_lat=$_POST['user_lat'];
                $user_long=$_POST['user_long'];
                $lat=  explode('.',  $user_lat);
                $long=  explode('.',  $user_long);
  
                  $query='SELECT *, ( 3959 * acos( cos( radians('.$lat[0].') ) * cos( radians( user_lat ) ) * cos( radians( user_long ) - radians('.$long[0].') ) + sin( radians('.$lat[0].') ) * sin( radians( user_lat ) ) ) ) AS distance FROM uf_user WHERE user_type ="2" and on_off_status ="1"  ORDER BY distance';
                  $result = $this->db->query($query)->result();
                 if($result){
                   $response=  array('status' =>'success','message' => 'online doctors','data' =>  $result);
                  }else{
                     $response=array('status' =>'fail','message' => 'There is no online users ');
                 }
                json_output_andriod($response['status'],$response);
            } 
        }
        
    }
    public function getProducts()
    {
       
            //$check_auth_client = $this->WebServiceModel->check_auth_client();
             $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
              
                 $data=array('user_id' =>'24');
                 $result = $this->WebServiceModel->getDataWhereMoreLimit('cp_products',$data,100,0);
                 if($result){
                   $response=  array('status' =>'success','message' => 'get all products','data' =>  $result);
                  }else{
                     $response=array('status' =>'fail','message' => 'There is no online users ');
                 }
                json_output_andriod($response['status'],$response);
            }
        
    }
      public function addCart()
      {
         $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
            $user_id=$_POST['user_id'];
            $product_id=$_POST['product_id'];
             $check_auth_client = true;
            if($check_auth_client == true){
                $data = array('user_id' =>$user_id,'product_id' =>$product_id);
                $result = $this->WebServiceModel->insertData('uf_cart', $data);
                if($result){
                  $response=  array('status' =>'success','message' => 'cart  is added successfully');
                 }else{
                     $response=array('status' =>'fail','message' => 'cart  is  not added');
                 }
               
                  
                 json_output_andriod($response['status'],$response);
            }
        }
      }

    public function getCartProduct($value='')
    {
   
           $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                $user_id=$this->uri->segment(2);
                 $data=array('user_id' =>$user_id);
                 $result = $this->WebServiceModel->getDataWhereJoinTwo('uf_cart',$user_id);
                 
                   $response=  array('status' =>'success','message' => 'get cart products','data' =>  $result);
                 
                json_output_andriod($response['status'],$response);
            }
       
    }
    public function removeCart()
    {
        $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                $id=$this->uri->segment(2);
                 $data=array('id' =>$id);
                 $getUserId=$this->WebServiceModel->getDataWhere('uf_cart',$data);
                 if($getUserId){
                    $user_id=$getUserId->user_id;
                     $this->WebServiceModel->getDelete('uf_cart',$data);
                     $result = $this->WebServiceModel->getDataWhereJoinTwo('uf_cart',$user_id);
                     $response=  array('status' =>'success','message' => 'cart is deleted Successfully','data' =>  $result);
                 }else{
                      $response=array('status' =>'fail','message' => 'Record is already deleted');
                 }

                json_output_andriod($response['status'],$response);
            }
    }
    public function userReservations()
    {    $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
          $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                 $user_id=$_POST['user_id'];
                 $data=array('user_id' =>$user_id);
                 $result = $this->WebServiceModel->getDataWhereMore('app_reservations',$data);
                 
                   $response=  array('status' =>'success','message' => 'User Reservations list','data' =>  $result);
                 
                json_output_andriod($response['status'],$response);
            }
        }
    }
    public function getFriendRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
         $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                 $recipient_id=$_POST['recipient_id'];
                 $data=array('recipient_id' =>$recipient_id,'confirmed'=>'0');
                 $result = $this->WebServiceModel->getDataWhereMore('app_friends',$data);
                 $response=  array('status' =>'success','message' => 'Friend Request list','data' =>  $result);
                 
                json_output_andriod($response['status'],$response);
            }
        }
    }
    public function confrimRequest()
    {
      
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
         $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                 $id=$_POST['id'];
                 $data=array('confirmed' =>'1');
                 $result = $this->WebServiceModel->getUpdate('app_friends',$data,  array('id' =>$id));
                 $response=  array('status' =>'success','message' => 'Friend request is accepted successfully');
                 
                json_output_andriod($response['status'],$response);
            }
        }  
    }
    public function userFriendOrNOt()
    {
       $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
         $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                 $id=$_POST['user_id'];
                 $data=array('confirmed' =>'1');

                $result = $this->db->select('*')->from('app_friends')->where('sender_id',$id)->or_where('recipient_id',$id)->where($data)->get()->row();
                if($result){
                 $response=  array('status' =>'success','message' => 'He is friend','data'=>'1');
                }else{
                    $response=array('status' =>'fail','message' => 'He is not friend' ,'data'=>'0');
                 }
                json_output_andriod($response['status'],$response);
                
            }
        }  
    }
    public function productInfo($value='')
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST' ){
            json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
        } else {
         $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                 $id=$_POST['product_id'];
                 $query="SELECT * FROM `cp_products` p join cp_product_size s on p.id = s.product_id WHERE p.id='".$id."'";
                 $result = $this->db->query($query)->row();
                 $response=  array('status' =>'success','message' => 'Product info','data'=> $result);
             
                json_output_andriod($response['status'],$response);
                
            }
        }  
    }
    public function tremConditions($value='')
    {
        # code...
          $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
               ///  $recipient_id=$_POST['recipient_id'];
                 $data = array('section'=>'app');
                 $result = $this->WebServiceModel->getDataWhereMore('uf_tos',$data);
                 $response=  array('status' =>'success','message' => 'terms conditions','data' =>  $result);
                 
                json_output_andriod($response['status'],$response);
            }
    }

	public function getDrive()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET' ){
			json_output_andriod('fail',array('status' => 'fail','message' => 'Bad request.'));
		} else {
			$id = $this->uri->segment(2);
			if (!empty($id)) {
				$data = array('id' => $id, 'user_type' => 1);
			} else {
				$data = array('user_type' => 1);
			}

			$result = $this->WebServiceModel->getDataWhereMore('uf_user', $data);
			$response=  array('status' =>'success','message' => 'Info drive','data' =>  $result);

			json_output_andriod($response['status'],$response);
		}
	}
 
}
