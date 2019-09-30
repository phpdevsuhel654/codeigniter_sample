<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Admin_Dashboard_Model extends MY_Model {

    protected $table = 'users';

    function __construct(){
        parent::__construct();
        if(! $this->session->userdata('sess_id')) {
            redirect('admin/login');
        }
    }

    public function totalcount() {
        $query=$this->db->select('id')->get($this->table);
        return  $query->num_rows();
    }

    public function countlastsevendays() {
        $query2=$this->db->select('id')->where('created_at >=  DATE(NOW()) - INTERVAL 10 DAY')->get($this->table);
        return  $query2->num_rows();
    }

    public function countthirtydays() {
        $query3=$this->db->select('id')->where('created_at >=  DATE(NOW()) - INTERVAL 30 DAY')->get($this->table);
        return  $query3->num_rows();
    }
}
