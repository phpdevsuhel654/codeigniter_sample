<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class login extends CI_Controller {

    /**
     * constructor function
     */
    function __construct() {
        parent::__construct();
        $this->load->model("admin_login_model");
        $this->load->model("user_model");
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

    /**
     * Forgot Password action
     */
    public function forgot_password() {
        $this->form_validation->set_rules('username','Username','required');
        if($this->form_validation->run()) {
            $username = $this->input->post('username');
            $validate = $this->admin_login_model->validate_login_with_username($username);
            //echo '<pre>'; print_r($validate); exit();
            if($validate) {
                $this->load->config('email');
                $this->load->library('email');
                $from = $this->config->item('smtp_user');
                $to = $username;
                $password = rand(10000000, 99999999);
                $subject = 'Forgot Password';
                $message = "Hello,<br/><br/>Following is your account details.<br/>Username: {$username}<br/>Password: {$password}<br/><br/>Thanks";

                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                $this->email->from($from);
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message($message);
                if ($this->email->send()) {
                    //Update user data
                    $user_data = array();
                    $user_data['password'] = md5($password);
                    $this->user_model->update($validate->id, $user_data);
                    $this->session->set_flashdata('success', 'Your details successfully send to your email address.');
                    return redirect('admin/login');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong while sending email.');
                    //echo $this->email->print_debugger();
                    redirect('admin/login/forgot_password');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid username details. Please try again with valid details');
                redirect('admin/login/forgot_password');
            }
        } else {
            $this->load->view('admin/forgot_password');
        }	
    }

}