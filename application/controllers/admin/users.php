<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class users extends CI_Controller {

    /**
     * constructor function
     */
    function __construct() {
        parent::__construct();
        if(! $this->session->userdata('sess_id')) {
            redirect('admin/login');
        }
        $this->load->helper("url");
        $this->load->model("user_model");
        $this->load->library("pagination");
    }

    /**
     * user index function
     */
    public function index() {
        $config = array();
        $config["base_url"] = base_url() . "admin/users/index";
        $config["total_rows"] = $this->user_model->record_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 4;
        //echo '<pre>'; print_r($config); echo '</pre>';
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; //echo $page;
        $data["results"] = $this->user_model->get_where_pagination($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        //echo '<pre>'; print_r($data); exit();

        $this->template->set('title', 'Admin - Manage Users');
		$this->template->load('admin/default', 'contents' , 'admin/user_manage', $data);
    }

    /**
     * user insert function
     */
    public function insert() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data['page_title'] = 'Add User';
        if(!empty($_POST)) {
            //echo '<pre>'; print_r($_POST); exit();
            /* Validation rule */
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            //$this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[15]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            if ($this->form_validation->run() !== FALSE) {
                $get_exists_user_count = $this->user_model->get_user_count_by_username($this->input->post('username'));
                if($get_exists_user_count > 0) {
                    $this->session->set_flashdata('failure', 'Email address already exists.');
                } else {
                    $sb_data = array();
                    $sb_data['first_name'] = $this->input->post('first_name');
                    $sb_data['last_name'] = $this->input->post('last_name');
                    $sb_data['username'] = $this->input->post('username');
                    $sb_data['email'] = $this->input->post('email');
                    $sb_data['password'] = md5($this->input->post('password'));
                    //echo '<pre>'; print_r($sb_data); exit();
                    $save_data = $this->user_model->insert($sb_data);
                    if(!empty($save_data)) {
                        $this->session->set_flashdata('success', 'You have been successfully saved user data.');
                        redirect('admin/users/index', 'refresh');
                    } else {
                        $this->session->set_flashdata('failure', 'Something went wrong while saving data.');
                    }
                }
                    
            }
        }
        $this->template->set('title', 'Admin - Add User');
		$this->template->load('admin/default', 'contents' , 'admin/user_insert_update', $data);
    }

    /**
     * user update function
     */
    public function update($id=0) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data['page_title'] = 'Update User';
        $data['user_data'] = $this->user_model->get_by_id($id);
        $data['user_id'] = $id;
        if(!empty($_POST)) {
            //echo '<pre>'; print_r($_POST); exit();
            $get_exists_user_count = $this->user_model->get_user_count_by_username($this->input->post('username'), $id);
            if($get_exists_user_count > 0) {
                $this->session->set_flashdata('failure', 'Email address already exists.');
            } else {
                /* Validation rule */
                $this->form_validation->set_rules('first_name', 'First Name', 'required');
                //$this->form_validation->set_rules('last_name', 'Last Name', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'min_length[6]|max_length[15]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]');
                if ($this->form_validation->run() !== FALSE) {
                    $sb_data = array();
                    $sb_data['first_name'] = $this->input->post('first_name');
                    $sb_data['last_name'] = $this->input->post('last_name');
                    $sb_data['username'] = $this->input->post('username');
                    $sb_data['email'] = $this->input->post('email');
                    if(!empty($this->input->post('password'))) {
                        $sb_data['password'] = md5($this->input->post('password'));
                    }
                    //echo '<pre>'; print_r($sb_data); exit();
                    $save_data = $this->user_model->update($id, $sb_data);
                    if(!empty($save_data)) {
                        $this->session->set_flashdata('success', 'You have been successfully updated user data.');
                        redirect('admin/users/index', 'refresh');
                    } else {
                        $this->session->set_flashdata('failure', 'Something went wrong while saving data.');
                    }
                }
            }
        }
        $this->template->set('title', 'Admin - Update User');
		$this->template->load('admin/default', 'contents' , 'admin/user_insert_update', $data);
    }

    /**
     * user view function
     */
    public function view($id=0) {
        $data['user_data'] = $this->user_model->get_by_id($id);
        $data['page_title'] = 'View User';
        $this->template->set('title', 'Admin - View User');
		$this->template->load('admin/default', 'contents' , 'admin/user_view', $data);
    }

    /**
     * user change status function
     */
    public function change_status($id=0,$status="") {
        $change_status = $this->user_model->change_status($id, $status);
        if(!empty($change_status)) {
            $this->session->set_flashdata('success', 'You have been successfully changed user status.');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong while saving data.');
        }
        redirect('admin/users/index', 'refresh');
    }

    /**
     * user delete function
     */
    public function delete($id=0) {
        $delete = $this->user_model->delete($id);
        //$delete = 0;
        if($delete) {
            $this->session->set_flashdata('success', 'You have been successfully deleted user.');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong while deleting user.');
        }
        redirect('admin/users/index', 'refresh');
    }


}