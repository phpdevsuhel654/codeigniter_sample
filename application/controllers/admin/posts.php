<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class posts extends CI_Controller {

    /**
     * constructor function
     */
    function __construct() {
        parent::__construct();
        if(! $this->session->userdata('sess_id')) {
            redirect('admin/login');
        }
        $this->load->helper("url");
        $this->load->model("post_model");
        $this->load->model("general_model");
        $this->load->library("pagination");
    }

    /**
     * post index function
     */
    public function index() {
        $config = array();
        $config["base_url"] = base_url() . "admin/posts/index";
        $config["total_rows"] = $this->post_model->record_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 4;
        //echo '<pre>'; print_r($config); echo '</pre>';
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; //echo $page;
        $data["results"] = $this->post_model->get_where_pagination($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        //echo '<pre>'; print_r($data); exit();

        $this->template->set('title', 'Admin - Manage Posts');
		$this->template->load('admin/default', 'contents' , 'admin/post_manage', $data);
        //$this->load->view("admin/post_manage", $data);
    }

    /**
     * post insert function
     */
    public function insert() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data['page_title'] = 'Add Post';
        if(!empty($_POST)) {
            //echo '<pre>'; print_r($_POST); exit();
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $sb_data = array();
                $sb_data['title'] = $this->input->post('title');
                $sb_data['slug'] = $this->general_model->slugify($this->input->post('title'));
                $sb_data['description'] = $this->input->post('description');
                //echo '<pre>'; print_r($post_data); exit();
                $save_data = $this->post_model->insert($sb_data);
                if(!empty($save_data)) {
                    $this->session->set_flashdata('success', 'You have been successfully saved post data.');
                    redirect('admin/posts/index', 'refresh');
                } else {
                    $this->session->set_flashdata('failure', 'Something went wrong while saving data.');
                }
            }
        }
        $this->template->set('title', 'Admin - Add Post');
		$this->template->load('admin/default', 'contents' , 'admin/post_insert_update', $data);
    }

    /**
     * post update function
     */
    public function update($id=0) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data['page_title'] = 'Update Post';
        $data['post_data'] = $this->post_model->get_by_id($id);
        $data['post_id'] = $id;
        if(!empty($_POST)) {
            //echo '<pre>'; print_r($_POST); exit();
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $sb_data = array();
                $sb_data['title'] = $this->input->post('title');
                $sb_data['slug'] = $this->general_model->slugify($this->input->post('title'));
                $sb_data['description'] = $this->input->post('description');
                //echo '<pre>'; print_r($post_data); exit();
                $save_data = $this->post_model->update($id, $sb_data);
                if(!empty($save_data)) {
                    $this->session->set_flashdata('success', 'You have been successfully updated post data.');
                    redirect('admin/posts/index', 'refresh');
                } else {
                    $this->session->set_flashdata('failure', 'Something went wrong while saving data.');
                }
            }
        }
        $this->template->set('title', 'Admin - Update Post');
		$this->template->load('admin/default', 'contents' , 'admin/post_insert_update', $data);
    }

    /**
     * post view function
     */
    public function view($id=0) {
        $data['post_data'] = $this->post_model->get_by_id($id);
        $data['page_title'] = 'View Post';
        $this->template->set('title', 'Admin - View Post');
		$this->template->load('admin/default', 'contents' , 'admin/post_view', $data);
    }

    /**
     * post change status function
     */
    public function change_status($id=0,$status="") {
        $change_status = $this->post_model->change_status($id, $status);
        if(!empty($change_status)) {
            $this->session->set_flashdata('success', 'You have been successfully changed post status.');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong while saving data.');
        }
        redirect('admin/posts/index', 'refresh');
    }

    /**
     * post delete function
     */
    public function delete($id=0) {
        $delete = $this->post_model->delete($id);
        //$delete = 0;
        if($delete) {
            $this->session->set_flashdata('success', 'You have been successfully deleted post.');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong while deleting post.');
        }
        redirect('admin/posts/index', 'refresh');
    }


}