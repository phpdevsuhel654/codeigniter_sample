<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class change_password extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(! $this->session->userdata('sess_id')) {
			redirect('admin/login');
		}
		$this->load->model('admin_changepassword_model');
	}
	
	public function index() {
		$this->form_validation->set_rules('currentpassword','Current Password','required|min_length[6]');	
		$this->form_validation->set_rules('password','Password','required|min_length[6]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','required|min_length[6]|matches[password]');
		if($this->form_validation->run()) {
			$cpassword=md5($this->input->post('currentpassword'));
			$newpassword=md5($this->input->post('password'));
			$adminid = $this->session->userdata('sess_id');			
			$cpass=$this->admin_changepassword_model->getcurrentpassword($adminid);
			$dbpass=$cpass->password;
			if($dbpass==$cpassword) {
				if($this->admin_changepassword_model->updatepassword($adminid,$newpassword)) {
				$this->session->set_flashdata('success', 'Password Changed successfully');
					redirect('admin/change_password');
				}
			} else {
				$this->session->set_flashdata('error', 'Current password is wrong. Error!!');
				redirect('admin/change_password');	
			} 
		} else {
			$data = [];
			$this->template->set('title', 'Admin - Change Password');
			$this->template->load('admin/default', 'contents' , 'admin/change_password', $data);
			//$this->load->view('admin/change_password');
		}
	}

}