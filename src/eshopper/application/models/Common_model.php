<?php
class Common_model extends CI_Model{
    public function get($where=array()){
        return $this->db->where($where)->get($table)->row();
    }
    public function addata($table,$where){
        return $this->db->insert($table,$where);
    }
    public function update($where,$data,$table){
        return $this->db->where($where)->update($table,$data);
    }
}