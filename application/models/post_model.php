<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class post_model extends MY_Model {

    protected $table = 'posts';

    public function __construct() {
        parent::__construct();
    }

    /**
     * records count
     */
    public function record_count_full($filter_data='') {
        if(!empty($filter_data['search_string'])) {
            $this->db->like('title', $filter_data['search_string']);
            $this->db->or_like('slug', $filter_data['search_string']);
            $this->db->or_like('description', $filter_data['search_string']);
        }
        $count_all = $this->db->count_all_results($this->table);
        //echo '<pre>'; print_r($this->db->last_query()); echo '</pre>'; //exit();
        return $count_all;
    }

    /**
     * get records with pagination
     */
    public function get_where_pagination_full($limit, $start, $sort_field, $order_by, $filter_data=array()) {
        if(!empty($filter_data['search_string'])) {
            $this->db->like('title', $filter_data['search_string']);
            $this->db->or_like('slug', $filter_data['search_string']);
            $this->db->or_like('description', $filter_data['search_string']);
        }
        $this->db->order_by("$sort_field", "$order_by");
        //echo $this->uri->segment(4) . " --- ". $this->uri->segment(5);
        //if(!empty($this->input->post())) {
        //echo "$limit && $start";
        if(!empty($this->input->post()) || (empty($this->uri->segment(4)) && empty($this->uri->segment(5))) || $start == '1') {
            $this->db->limit($limit);
        } else {
            $this->db->limit($limit, $start);
        }
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