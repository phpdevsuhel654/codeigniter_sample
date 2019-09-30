<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class comments extends CI_Controller {

    /**
     * constructor function
     */
    function __construct() {
        parent::__construct();
        if(! $this->session->userdata('sess_id')) {
            redirect('admin/login');
        }
        $this->load->helper("url");
        $this->load->model("comment_model");
        $this->load->library("pagination");
    }

    /**
     * comment index function
     */
    public function index() {
        $config = array();
        $config["base_url"] = base_url() . "admin/comments/index";
        $config["total_rows"] = $this->comment_model->record_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 4;
        //echo '<pre>'; print_r($config); echo '</pre>';
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; //echo $page;
        $data["results"] = $this->comment_model->get_where_pagination($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        //echo '<pre>'; print_r($data); exit();

        $this->template->set('title', 'Admin - Manage comments');
		$this->template->load('admin/default', 'contents' , 'admin/comment_manage', $data);
        //$this->load->view("admin/comment_manage", $data);
    }

    /**
     * comment view function
     */
    public function view($id=0) {
        $data['comment_data'] = $this->comment_model->get_by_id($id);
        $data['page_title'] = 'View comment';
        $this->template->set('title', 'Admin - View comment');
		$this->template->load('admin/default', 'contents' , 'admin/comment_view', $data);
    }

    /**
     * comment change status function
     */
    public function change_status($id=0,$status="") {
        $change_status = $this->comment_model->change_status($id, $status);
        if(!empty($change_status)) {
            $this->session->set_flashdata('success', 'You have been successfully changed comment status.');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong while saving data.');
        }
        redirect('admin/comments/index', 'refresh');
    }

    /**
     * comment delete function
     */
    public function delete($id=0) {
        $delete = $this->comment_model->delete($id);
        //$delete = 0;
        if($delete) {
            $this->session->set_flashdata('success', 'You have been successfully deleted comment.');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong while deleting comment.');
        }
        redirect('admin/comments/index', 'refresh');
    }


}