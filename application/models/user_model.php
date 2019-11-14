<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class user_model extends MY_Model {

    protected $table = 'users';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get data by username
     */
    public function get_user_count_by_username($username='', $id=0) {
        $user_count = 0;
        if(!empty($username)) {
            $where="enable='1' AND username='{$username}'";
            if(!empty($id)) {
                $where .= " AND id!='{$id}'";
            }
            $result = $this->db->select('id')->where($where)
                        ->get($this->table)
                        ->result();
            $user_count = count($result);
        }
        return $user_count;
    }

    /**
     * get records with pagination
     */
    public function get_where_pagination_full($limit, $start, $sort_field, $order_by, $where='') {
        if(!empty($where)) {
            $this->db->where($where);
        }
        $this->db->order_by("$sort_field", "$order_by");
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);
        //echo '<pre>'; print_r($this->db->last_query()); echo '</pre>'; //exit();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

}