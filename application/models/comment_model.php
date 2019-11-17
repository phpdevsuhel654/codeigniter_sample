<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class comment_model extends MY_Model {

    protected $table = 'comments';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get blog comment data
     */
    public function get_blog_comments($blog_id=0) {
        $sql= "SELECT * FROM {$this->table} c WHERE c.enable='1' AND c.post_id='{$blog_id}' ORDER BY c.id DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /**
     * get records with primary key
     */
    public function get_by_id($id) {
        $this->db->select('comments.*, posts.title as post_title');
        $this->db->where("comments.id = '{$id}'");
        $this->db->join('posts', 'comments.post_id = posts.id', 'left');
        $query = $this->db->get($this->table);
        return $query->row();
        //return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    /**
     * get records with pagination
     */
    public function get_where_pagination($limit, $start, $where='', $order_by='') {
        $this->db->select('comments.*, posts.title as post_title');
        if(!empty($where)) {
            $this->db->where($where);
        }
        $this->db->join('posts', 'comments.post_id = posts.id', 'left');
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
     * records count
     */
    public function record_count_full($filter_data='') {
        if(!empty($filter_data['search_string'])) {
            $this->db->like('title', $filter_data['search_string']);
            $this->db->or_like('slug', $filter_data['search_string']);
            $this->db->or_like('description', $filter_data['search_string']);
        }
        $this->db->join('posts', 'comments.post_id = posts.id', 'left');
        $count_all = $this->db->count_all_results($this->table);
        //echo '<pre>'; print_r($this->db->last_query()); echo '</pre>'; //exit();
        return $count_all;
    }

    /**
     * get records with pagination
     */
    public function get_where_pagination_full($limit, $start, $sort_field, $order_by, $filter_data=array()) {
        $this->db->select('comments.*, posts.title as post_title');
        if(!empty($filter_data['search_string'])) {
            $this->db->like('posts.title', $filter_data['search_string']);
            $this->db->or_like('comments.name', $filter_data['search_string']);
            $this->db->or_like('comments.email', $filter_data['search_string']);
            $this->db->or_like('comments.comment', $filter_data['search_string']);
        }
        if($sort_field == 'title') {
            $sort_field = "posts.{$sort_field}";
        } else {
            $sort_field = "comments.{$sort_field}";
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
        $this->db->join('posts', 'comments.post_id = posts.id', 'left');
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