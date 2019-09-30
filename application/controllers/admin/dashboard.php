<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(! $this->session->userdata('sess_id')) {
            redirect('admin/login');
        }
        $this->load->model('admin_dashboard_model');
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

}