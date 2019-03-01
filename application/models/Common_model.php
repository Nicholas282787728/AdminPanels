<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_model extends CI_Model{

	// Insert record in database table
    public function insert_record($data, $table_name)
    {
        $this->db->insert($table_name, $data);
        // echo $this->db->last_query();
        return $this->db->insert_id();
    }
    // Insert record in database table
    public function sum_of_record($field, $table_name)
    {
        $this->db->select_sum($field);
        $this->db->from($table_name);
         //$this->db->where('(status = 0)');
        $query = $this->db->get();
        //$this->db->last_query();
        return $query->row();
    }
    public function insertBatchOfImgs($data = array()){
        $insert = $this->db->insert_batch('photographers_images',$data);
        return $insert?true:false;
    }
    public function update_record($data, $table_name, $col_name, $id, $col_name2 ='', $id2 ='')
    { 
        $this->db->where($col_name, $id);
        if($col_name2 !=''){
            $this->db->where($col_name2, $id2);
        }
        $this->db->update($table_name, $data);
        //echo $this->db->last_query();
        return true;
    }
    public function get_data($table_name, $order_by = '', $col_for_order = '', $limit = '')
    { 
        $this->db->select('*');
        if($col_for_order != ''){ $this->db->order_by($col_for_order,$order_by); }
        if($limit != ''){ $this->db->limit($limit); }

        $this->db->from($table_name);
         $query=$this->db->get();
		$result = $query->result();
		return($result);
    }
    public function get_dataByGroup($table_name, $id, $val)
    { 
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->group_by('packege_title'); 
        $this->db->order_by($id, 'desc');
        $this->db->where($id,$val);
        $query=$this->db->get();
        $result = $query->result();
        return($result);
    }
    public function get_data_login_user($table_name, $id, $userId)
    {
        $query = $this->db->select('*')->from($table_name)->where('ID', $id)->where('CreatedBy', $userId)->get();
        $result = $query->row();  
        return($result);
    }

    public function get_data_tbl($table_name, $col_name, $id)
	{		
        $query = $this->db->select('*')->from($table_name)->where($col_name, $id)->get();
     
	    if($query){
            return $query->row();
        }
    }

    public function get_data_tbl_all($table_name, $col_name, $id, $order_by = '', $col_for_order = '', $paginationLimit = '', $start_index = '')
    { 
        $this->db->select('*');
        if($col_for_order != '')
        {
            $this->db->order_by($col_for_order,$order_by);
        }
        if($paginationLimit != ''){ $this->db->limit($paginationLimit,$start_index); }
        $this->db->from($table_name);
        $this->db->where($col_name,$id);
         $query=$this->db->get();
         
        $result = $query->result();
        return($result); 
    }

    public function get_data_exist($table_name, $col_name, $data)
    {
        $q = $this->db->where($col_name, $data)->get($table_name);

        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return false;
        }

    }

    public function get_row_on_two_condition($table, $col_1, $val_1, $col_2, $val_2, $row_res ='',$orderId ='', $orderStatus='')
    {
        $Where = array($col_1 => $val_1, $col_2 => $val_2);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($Where);
        if($orderId !='' && $orderStatus !=''){
            $this->db->order_by($orderId, $orderStatus);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            if($row_res !=''){
                return $query->row();
            }else{
                return $query->result();
            }
        }else{
            return false;
        }
    }
    public function get_notifications($table, $col_1, $val_1, $col_2 ='', $val_2 ='', $limit ='')
    { 
        $this->db->select('*');
        if($limit !=''){
            $this->db->order_by('noti_id', 'desc');
            $this->db->limit('5');
        }
        $this->db->from($table);
        $this->db->where($col_1 , $val_1);
        if($col_2!=''){
            $this->db->where($col_2 , $val_2);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        if($row_res !=''){
            return $query->row();
        }else{
            return $query->result();
        } 
    }
    public function get_notifications_count($table, $col_1, $val_1, $col_2 ='', $val_2 ='')
    { 
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($col_1 , $val_1);
        $this->db->where($col_2 , $val_2);
        $this->db->where('readStatus' , '0');
        $query = $this->db->get();
        return $query->result();
        
    }
    public function delete_record($table, $col_id, $value)
    {
        $this->db->where($col_id, $value);
        $this->db->delete($table);
        return true;
    }



    public function getOneValeFromTable($table, $colName, $id, $colRequired)
    {
        $query = $this->db->select($colRequired)->from($table)->where($colName, $id)->get();
        $result = $query->row();
        if(isset($result->$colRequired)){
            return($result->$colRequired);
        }else{
            return false;
        }
    }

    public function get_data_ByJoin($tbl1,$tbl2,$tbl1id,$tbl2id,$joinTyp ='inner',$limit='')
    {
        $this->db->select("*");
        $this->db->from($tbl1);
        $this->db->join($tbl2, ''.$tbl2.'.'.$tbl2id.' ='.$tbl1.'.'.$tbl1id.'', $joinTyp);
        //$this->db->where('$tbl2.status', '0');
       // $this->db->where('$tbl2.c_id', $p_id);
        if($limit !=''){
            $this->db->limit('15');
        }
        $this->db->order_by($tbl1id, 'desc');
        $query = $this->db->get();
       // echo $this->db->last_query();
        return $query->result();
        //return $this->db->count_all_results();
    }

}