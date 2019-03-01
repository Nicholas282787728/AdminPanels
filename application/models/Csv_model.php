<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csv_model extends CI_Model {

    function insertRecord($record){

        // echo "<pre>"; print_r($record);
        // die();
        
        if(count($record) > 0){
            
            // Check user
            $this->db->select('*');
            $this->db->where('email', $record[5]);
            $q = $this->db->get('uf_user');
            $response = $q->result_array();
            
         

               if(count($response) == 0){
                $newuser = array(
                               // "id" => trim($record[0]),
                                "user_name" => trim($record[0]),
                                "street" => trim($record[1]),
                                "city" => trim($record[2]),
                                "state" => trim($record[3]),
                                "zip" => trim($record[4]),  

                                "email" => trim($record[5]),
                                "mob_number" => trim($record[6]),
                                "member_since" => trim($record[7]),
                                "logo" => trim($record[8]),
                                "profile_pic " => trim($record[9]),

                                "user_lat" => trim($record[10]),
                                "user_long" => trim($record[11]),
                                "facebook" => trim($record[12]),
                                "twitter" => trim($record[13]),
                                "instagram" => trim($record[14]),

                                "complimentary_ad_space" => trim($record[15]),
                                "page_url" => trim($record[16]),
                                "display_name" => trim($record[0]),
                                "address" => trim($record[1]),
                                "is_verify" => '1',
                                "title" => 'Store',
                                 "user_type" => '3',
                                "created_by_id" => '1'
                );

                $this->db->insert('uf_user_old1', $newuser);

             //     $insertid=$this->db->insert_id();
             // $location = array(
             //                        "user_id"=>$insertid,
             //                        "paypal_business_name"=>$record[0],
             //                        "city"=>$record[2],
             //                        "email"=>$record[5],
             //                        "phone_number"=>$record[6],
             //                        "longitude"=>$record[11],
             //                        "latitude"=>$record[10]
             //                    );

             //  $this->db->insert('cp_locations',$location);
            }
        }
        
    }

}