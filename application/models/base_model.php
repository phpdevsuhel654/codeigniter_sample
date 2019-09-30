<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class base_model extends CI_Model {

    /**
     * set table name
     */
    protected $table = '';

    /**
     * constructore function
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * get all records
     */
    public function get_all() {
        return $this->db->get($this->table)
                        ->result();
    }

    /**
     * get records with primary key
     */
    public function get_by_id($id) {
        return $this->db->get_where($this->table, array('id' => $id))
                        ->row();
    }

    /**
     * ger records with where conditions
     */
    public function get_where($where, $order_by="id DESC") {
        return $this->db->where($where)
                        ->get($this->table)
                        ->order_by($order_by)
                        ->result();
    }

    /**
     * insert data to database
     */
    public function insert($data) {
        $query = $this->db->insert($this->table, $data);
        if($query) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    /**
     * update data to databse
     */
    public function update($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update($this->table, $data);
        if($query) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * delete data from database
     */
    public function statuch_change($id, $current_status="0") {
        if($current_status == "0") {
            $data = array('enable' => 1);
        } else {
            $data = array('enable' => 0);
        }
        $this->db->where('id', $id);
        $query = $this->db->update($this->table, $data);
        if($query) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * delete data from database
     */
    public function delete($id) {
        $this->db->where('id', $id);
        $query = $this->db->delete($this->table);
        if($query) {
            return true;
        } else {
            return false;
        }
    }

}