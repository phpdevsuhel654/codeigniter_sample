<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class post_model extends MY_Model {

    protected $table = 'posts';

    public function __construct() {
        parent::__construct();
    }

}