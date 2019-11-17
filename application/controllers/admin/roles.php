<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class roles extends CI_Controller {

    /**
     * constructor function
     */
    function __construct() {
        parent::__construct();
        if(! $this->session->userdata('sess_id')) {
            redirect('admin/login');
        }
        $this->load->helper("url");
        $this->load->model("role_model");
        $this->load->library("pagination");
    }

    /**
     * role index function
     */
    public function index() {
        $config = array();
        $config["base_url"] = base_url() . "admin/roles/index";
        $config["per_page"] = ADMIN_RCORDS_PER_PAGE;
        
        $data['sort_cols'] = array(
            'id' => '#',
            'role_name' => 'Role Name',
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
        $config["base_url"] = base_url().'admin/roles/index/'.$data['sort_by'].'/'.$order_by.'/'.$data['search_string'];;
        $data['form_url'] = base_url().'admin/roles/index/'.$data['sort_by'].'/'.$order_by;

        $filter_data = array('search_string' => $data['search_string']);
        //echo '<pre>'; print_r($filter_data); echo '</pre>';

        //$config["total_rows"] = $this->role_model->record_count();
        $config["total_rows"] = $this->role_model->record_count_full($filter_data);

        //echo '<pre>'; print_r($config); echo '</pre>';
        $this->pagination->initialize($config);        

        //$data["results"] = $this->role_model->get_where_pagination($config["per_page"], $page);
        $data["results"] = $this->role_model->get_where_pagination_full($config["per_page"], $page, $data['sort_by'], $data['sort_order'], $filter_data);

        $data["links"] = $this->pagination->create_links();
        //echo '<pre>'; print_r($data); exit();

        $this->template->set('title', 'Admin - Manage Roles');
		$this->template->load('admin/default', 'contents' , 'admin/role_manage', $data);
        //$this->load->view("admin/role_manage", $data);
    }

    /**
     * role insert function
     */
    public function insert() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data['page_title'] = 'Add Role';
        if(!empty($_POST)) {
            //echo '<pre>'; print_r($_POST); exit();
            $this->form_validation->set_rules('role_name', 'Role Name', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $sb_data = array();
                $sb_data['role_name'] = $this->input->post('role_name');
                //echo '<pre>'; print_r($role_data); exit();
                $save_data = $this->role_model->insert($sb_data);
                if(!empty($save_data)) {
                    $this->session->set_flashdata('success', 'You have been successfully saved role data.');
                    redirect('admin/roles/index', 'refresh');
                } else {
                    $this->session->set_flashdata('failure', 'Something went wrong while saving data.');
                }
            }
        }
        $this->template->set('title', 'Admin - Add Role');
		$this->template->load('admin/default', 'contents' , 'admin/role_insert_update', $data);
    }

    /**
     * role update function
     */
    public function update($id=0) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data['page_title'] = 'Update Role';
        $data['role_data'] = $this->role_model->get_by_id($id);
        $data['role_id'] = $id;
        if(!empty($_POST)) {
            //echo '<pre>'; print_r($_POST); exit();
            $this->form_validation->set_rules('role_name', 'Role Name', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $sb_data = array();
                $sb_data['role_name'] = $this->input->post('role_name');
                //echo '<pre>'; print_r($role_data); exit();
                $save_data = $this->role_model->update($id, $sb_data);
                if(!empty($save_data)) {
                    $this->session->set_flashdata('success', 'You have been successfully updated role data.');
                    redirect('admin/roles/index', 'refresh');
                } else {
                    $this->session->set_flashdata('failure', 'Something went wrong while saving data.');
                }
            }
        }
        $this->template->set('title', 'Admin - Update Role');
		$this->template->load('admin/default', 'contents' , 'admin/role_insert_update', $data);
    }

    /**
     * role view function
     */
    public function view($id=0) {
        $data['role_data'] = $this->role_model->get_by_id($id);
        $data['page_title'] = 'View Role';
        $this->template->set('title', 'Admin - View Role');
		$this->template->load('admin/default', 'contents' , 'admin/role_view', $data);
    }

    /**
     * role change status function
     */
    public function change_status($id=0,$status="") {
        $change_status = $this->role_model->change_status($id, $status);
        if(!empty($change_status)) {
            $this->session->set_flashdata('success', 'You have been successfully changed role status.');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong while saving data.');
        }
        redirect('admin/roles/index', 'refresh');
    }

    /**
     * role delete function
     */
    public function delete($id=0) {
        $delete = $this->role_model->delete($id);
        //$delete = 0;
        if($delete) {
            $this->session->set_flashdata('success', 'You have been successfully deleted role.');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong while deleting role.');
        }
        redirect('admin/roles/index', 'refresh');
    }


}