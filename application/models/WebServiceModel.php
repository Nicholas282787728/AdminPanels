<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebServiceModel extends CI_Model {

    var $client_service = "123";
    var $auth_key       = "123";

   
   
        function mail_exists($email)
        {
            $this->db->where('email',$email);
            $query = $this->db->get('tbl_users');

            if ($query->num_rows() > 0){
                return true;
            }
            else{
                return false;
            }
        }
        public function login($data){

            $this->db->where($data);
            $this->db->limit(1);
            $query = $this->db->get('uf_user');
            if ($query->num_rows() > 0){
                 return $query->row();
            }
            else{
                return false;
            }

        }


        public function insertData($table, $data){

        $query=$this->db->insert($table,$data);
        if($query){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function getData($table){
      $this->db->select('*');
      $this->db->from($table);
      //$this->db->order_by('id','desc');
     $query = $this->db->get();
     if($query){
        return $query->result();
     }else{
        return false;
     }
    }
      public function getDataWhereMore($table, $where){
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where($where);
     $query = $this->db->get();
     if($query){
        return $query->result();
     }else{
        return false;
     }
    }
     public function getDataWhereMoreLimit($table, $where,$limit, $start){
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where($where);
       $this->db->limit($limit, $start);
     $query = $this->db->get();
     if($query){
        return $query->result();
     }else{
        return false;
     }
    }
      public function getDataWhereMoreBySelected($table, $where){
      $this->db->select('description');
      $this->db->from($table);
      $this->db->where($where);
     $query = $this->db->get();
     if($query){
        return $query->result();
     }else{
        return false;
     }
    }
    
    public function getDataASC($table){
      $this->db->select('*');
      $this->db->from($table);
      $this->db->order_by('status','DESC');
     $query = $this->db->get();

     //echo $this->db->last_query();exit;
     if($query){
        return $query->result();
     }else{
        return false;
     }
    } 

    public function getDataWhere($table, $where){
      

      $this->db->select('*');
      $this->db->from($table);
      $this->db->where($where);
      $query = $this->db->get();
     if($query){
        //print_r($query->row());exit;
        return $query->row();
     }else{
        return false;
     }
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

    public function getDelete($table, $where){

         $this->db->where($where);
        $query=$this->db->delete($table);
        if($query){
        return true;
       }else{
        return false;
      }

    }
      public function getUpdateMultipule($table, $data, $where)
    {
        $this->db->where('id',$where);
        $query=$this->db->update($table,$data);
         if($query){
        return true;
       }else{
        return false;
      }
    }

    public function getRecordCount($table){
       $this->db->select('*');
      $this->db->from($table);
      $query = $this->db->get();
     if($query){
        return $query->num_rows();
     }else{
        return false;
     }

    }

    public function getRecordCountWhere($table,$where)
    {
      # code...
     $this->db->select('*');
     $this->db->from($table);
     $this->db->where($where);
     $query = $this->db->get();
     if($query){
        return $query->num_rows();
     }else{
        return false;
     }

    }
      public function getGenres($table){
      $this->db->select('*');
      $this->db->from($table);
     $query = $this->db->get();
     if($query){
        return $query->result();
     }else{
        return false;
     }
    }

    public function getDataPayment($table)
    {
        $this->db->select('*,(select u.user_name from tbl_users u where u.id=tbl_payments.user_id) as username');
      $this->db->from($table);
     $query = $this->db->get();
     if($query){
        return $query->result();
     }else{
        return false;
     }
    }
    public function getDataWhereJoin($table,$jointable,$id)
    {
      $result= $this->db->select('*')->from($table)->join($jointable, 'tbl_payments.user_id = tbl_users.id' )->where('tbl_users.id' ,$id)->get()->row();
      return $result;
    }
    public function getDataWhereJoinTwo($table,$user_id)
    {
      $result= $this->db->select('uf_cart.id as cartid,cp_products.*')->from($table)->join('cp_products', 'cp_products.id = uf_cart.product_id' )->where('uf_cart.user_id' ,$user_id)->get()->result();
      return $result;
    }
        
        
   
    public function getSongsDownload()
    {
       $this->db->select('*,(select count(id) from tbl_downloads where song_id=tbl_songs.id) as downloadCount');
       $this->db->from('tbl_songs');
       $this->db->order_by('downloadCount','desc');
     //  $this->db->join('tbl_downloads','tbl_songs.id = tbl_downloads.song_id');

      $query= $this->db->get();

      if($query){
        return $query->result();

       }else{
        return false;
      }
    }

    // Edited by Chaitanya on 18th May, 2018

    public function record_count() {
        return $this->db->count_all("tbl_songs");
    }

    public function fetch_songs($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by('id','desc');
        $query = $this->db->get("tbl_songs");


        if ($query) {
            return $query->result();
            }
            
        
        return false;
   }

   public function search_fetch_songs($limit, $start, $search) {
        $this->db->limit($limit, $start);
        $this->db->order_by('id','desc');
        $this->db->like('song_genre',$search);
        $this->db->or_like('song_title',$search);
        $this->db->or_like('song_artist',$search);
        $this->db->or_like('song_album',$search);
        $query = $this->db->get("tbl_songs");


        if ($query) {
            return $query->result();
            }
            
        
        return false;
   }

 
    public function getDataLimit($table,$start='0',$end){
      $this->db->select('*');
      $this->db->from($table);
      $this->db->limit($end, $start);
     $query = $this->db->get();
     if($query){
        return $query->result();
     }else{
        return false;
     }
    }
    public function getDescRecords($table)
    {
     $this->db->order_by('id','desc');
     $this->db->limit(3,0);
     $query = $this->db->get($table);
      if($query){
        return $query->result();
      }else{
        return false;
      }

    }

    public function getDataWhereIn($table,$array)
    {
      # code...
       $this->db->select('*');
       $this->db->from($table);
       $this->db->where_in('country_id',$array);
      $query = $this->db->get();
      if($query){
         return $query->result();
      }else{
         return false;
      }

    }
     public function payments($id)
   {
      $this->db->select('SUM(amount) as total_amount');
      $this->db->from('payment_details');
      $this->db->where('user_id',$id);
      $query= $this->db->get();
      if($query){
        $result= $query->row();
        return $result->total_amount==""?'0':$result->total_amount;
      }else{
        return ;
      }
   }
   public function get_visibility_data($user_id='') {
    $this->db->select('cp_locations.*,uf_user.on_off_status,uf_user.opt_in_out');
    $this->db->from('cp_locations');
    $this->db->join('uf_user', 'uf_user.id = cp_locations.user_id', 'left');
    if($user_id){
       $this->db->where('user_id', $user_id);
    }
    $query = $this->db->get();
     if($query){
         return $query->result();
      }else{
         return false;
      }
  }
 


  



}
