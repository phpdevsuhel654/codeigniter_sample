<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class MY_Model extends CI_Model {

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
     * ger single record with where conditions
     */
    public function get_where_single($where, $order_by="id DESC") {
        return $this->db->where($where)
						->order_by($order_by)
                        ->get($this->table)
                        ->row();
    }

    /**
     * ger records with where conditions
     */
    public function get_where($where, $order_by="id DESC") {
        return $this->db->where($where)
						->order_by($order_by)
                        ->get($this->table)
                        ->result();
    }

    /**
     * records count
     */
    public function record_count($where='') {
        if(!empty($where)) {
            $this->db->where($where);
        }
        return $this->db->count_all($this->table);
    }

    /**
     * get records with pagination
     */
    public function get_where_pagination($limit, $start, $where='', $order_by='') {
        if(!empty($where)) {
            $this->db->where($where);
        }
        if(!empty($order_by)) {
            $this->db->order_by($order_by);
        } else {
            $this->db->order_by('id DESC');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);
        //echo '<pre>'; print_r($this->db->last_query()); exit();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
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
    public function change_status($id, $current_status="0") {
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