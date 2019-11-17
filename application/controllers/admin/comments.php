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
        $config["per_page"] = ADMIN_RCORDS_PER_PAGE;
        
        $data['sort_cols'] = array(
            'id' => '#',
            'title' => 'Post Title',
            'name' => 'Comment By Name',
            'email' => 'Comment By Email',
            'created_at' => 'Created At',
        );

        //$config["uri_segment"] = 6;
        $data['sort_by'] = $this->uri->segment(4, 'id');
        $order_by = $this->uri->segment(5, "desc");
        if($order_by == "asc") $data['sort_order'] = "desc"; else $data['sort_order'] = "asc";

        //echo $this->uri->segment(4); echo '--test---';
        //echo $this->uri->segment(5);

        $search_string = $this->input->post('search');
        $data['search_string'] = '';
        if(!empty($search_string)) {
            $this->uri->segment(7, $this->uri->segment(6, 2));
            $data['search_string'] = $this->uri->segment(6, $search_string);
        //} elseif($this->uri->segment(6) != null && !empty($this->uri->segment(6)) && $this->uri->segment(7) != null) {
        } elseif($this->uri->segment(6) != null && !empty($this->uri->segment(6)) && $this->uri->segment(7) != null) {
            $data['search_string'] = urldecode($this->uri->segment(6));
        } elseif($this->uri->segment(6) != null && !empty($this->uri->segment(6)) && !intval($this->uri->segment(6))) {
            $data['search_string'] = urldecode($this->uri->segment(6));
        }
        //echo $data['search_string'].'--';
        //set default page uri 
        $page_uri = 6;
        if(!empty($data['search_string'])) {
            $page_uri = 7;
        }
        $config["uri_segment"] = $page_uri;

        //$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0; //echo $page;
        $page = ($this->uri->segment($page_uri, 1)) ? $this->uri->segment($page_uri, 1) : 0; 
        //echo $page;
        $data["page"] = $page;
        //exit();
        $config["base_url"] = base_url().'admin/comments/index/'.$data['sort_by'].'/'.$order_by.'/'.$data['search_string'];;
        $data['form_url'] = base_url().'admin/comments/index/'.$data['sort_by'].'/'.$order_by;

        $filter_data = array('search_string' => $data['search_string']);
        //echo '<pre>'; print_r($filter_data); echo '</pre>';

        //$config["total_rows"] = $this->comment_model->record_count();
        $config["total_rows"] = $this->comment_model->record_count_full($filter_data);

        //echo '<pre>'; print_r($config); echo '</pre>';
        $this->pagination->initialize($config);        

        //$data["results"] = $this->comment_model->get_where_pagination($config["per_page"], $page);
        $data["results"] = $this->comment_model->get_where_pagination_full($config["per_page"], $page, $data['sort_by'], $data['sort_order'], $filter_data);

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