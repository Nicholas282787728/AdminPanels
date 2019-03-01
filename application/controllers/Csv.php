<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csv extends CI_Controller {

	public function __construct(){

		parent::__construct();

		// load base_url
		$this->load->helper('url');

		// Load Model
		$this->load->model('Csv_model');
	}
	
	public function index(){

// $inf_field_FirstName = 'Amarjeet';
//   $inf_custom_BusinessName = 'Singh';
//   $inf_field_Email = 'possibilityteams@gmail.com';
//   $inf_field_Phone1 = '4355646546';
//     $inf_custom_Comments = 'hello testing';


// $from = 'jps.sahota@gmail.com';

//   $to      = $inf_field_Email;
// $subject = 'the subject';
// $message = 'Name: '.$inf_field_FirstName.'' . "\r\n" .
//           'Email: '.$inf_field_Email.'' . "\r\n" .
//               'Phone: '.$inf_field_Phone1 .''. "";

// $headers = 'From: '.$from.'' . "\r\n" .
//     'Reply-To: '.$from.'' . "\r\n" .
//     'X-Mailer: PHP/' . phpversion();

// $mail =  mail($to, $subject, $message, $headers);


// if($mail == 1){
//   echo 'send mail successfuly';
// }
// else{
//    echo 'No send mail successfuly';

// }

	}

	
}
