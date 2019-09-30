<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class role_model extends MY_Model {

    protected $table = 'roles';

    public function __construct() {
        parent::__construct();
    }

}