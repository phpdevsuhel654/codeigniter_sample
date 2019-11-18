<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(! $this->session->userdata('sess_id')) {
            redirect('admin/login');
        }
        $this->load->model('admin_dashboard_model');
        $this->load->model("user_model");
        //$this->load->model("general_model");
    }
	
    public function index() {
        $totalcount=$this->admin_dashboard_model->totalcount();
        $sevendayscount=$this->admin_dashboard_model->countlastsevendays();
        $thirtydayscount=$this->admin_dashboard_model->countthirtydays();
        $data = ['tcount'=>$totalcount,'tsevencount'=>$sevendayscount,'tthirycount'=>$thirtydayscount];
        $this->template->set('title', 'Admin - Dashboard');
		$this->template->load('admin/default', 'contents' , 'admin/dashboard', $data);
        //$this->load->view('admin/dashboard',['tcount'=>$totalcount,'tsevencount'=>$sevendayscount,'tthirycount'=>$thirtydayscount]);
    }

    /**
     * Update user profile
     */
    public function update_profile() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data['page_title'] = 'Update User Profile';
        $sesssion_data = $this->session->userdata('sess_id');
        //echo '<pre>'; print_r($ses_data); exit();
        $data['user_data'] = $this->user_model->get_by_id($sesssion_data['id']);
        //echo '<pre>'; print_r($data['user_data']); exit();
        if(!empty($_POST)) {
            //echo '<pre>'; print_r($_POST); exit();
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $id = $sesssion_data['id'];
                $sb_data = array();
                $sb_data['first_name'] = $this->input->post('first_name');
                $sb_data['last_name'] = $this->input->post('last_name');
                //echo '<pre>'; print_r($user_data); exit();
                $save_data = $this->user_model->update($id, $sb_data);
                if(!empty($save_data)) {
                    $this->session->set_flashdata('success', 'You have been successfully updated user profile data.');
                    redirect('admin/dashboard/update_profile', 'refresh');
                } else {
                    $this->session->set_flashdata('failure', 'Something went wrong while saving data.');
                }
            }
        }
        $this->template->set('title', 'Admin - Update User Profile');
		$this->template->load('admin/default', 'contents' , 'admin/update_user_profile', $data);
    }

}