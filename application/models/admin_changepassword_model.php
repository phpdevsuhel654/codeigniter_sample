<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class admin_changepassword_model extends MY_Model {

    protected $table = 'users';

    public function getcurrentpassword($adminid) {
        $query=$this->db->where(['id'=>$adminid])
                        ->get($this->table);
        if($query->num_rows() > 0) {
            return $query->row();
        }
    }

    public function updatepassword($adminid ,$newpassword) {
        $data=array('password' =>$newpassword );
        return $this->db->where(['id'=>$adminid])
                        ->update($this->table, $data);

	}

}