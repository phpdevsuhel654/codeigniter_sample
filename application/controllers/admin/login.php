<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class login extends CI_Controller {

    /**
     * constructor function
     */
    function __construct() {
        parent::__construct();
        $this->load->model("admin_login_model");
    }

    /**
     * Login action
     */
    public function index() {
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');	
            $validate = $this->admin_login_model->validate_login($username,$password);
            if($validate) {
                $sess_id = array();
                $sess_id['id'] = $validate->id;
                $sess_id['role_id'] = $validate->role_id;
                $sess_id['first_name'] = $validate->first_name;
                $sess_id['last_name'] = $validate->last_name;
                $sess_id['username'] = $validate->username;
                $sess_id['email'] = $validate->email;
                $sess_id['enable'] = $validate->enable;
                $this->session->set_userdata('sess_id',$sess_id);
                return redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid details. Please try again with valid details');
                redirect('admin/login');
            }
        } else {
            $this->load->view('admin/login');
        }	
    }

    //function for logout
    public function logout() {
        $this->session->unset_userdata('sess_id');
        $this->session->sess_destroy();
        return redirect('admin/login');
    }

}