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

}