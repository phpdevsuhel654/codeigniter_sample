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

    

}