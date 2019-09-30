<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class home extends CI_Controller {
	
	/**
     * constructor function
     */
    function __construct() {
        parent::__construct();
		$this->load->model("post_model");
		$this->load->model("comment_model");
	}
	
	/**
	 * Index page
	 */
	public function index() {
		$data = array();
		$this->template->set('title', 'My Blog - Home');
		$this->template->load('default', 'contents' , 'home', $data);
		//$this->load->view('home');
	}
	
	/**
	 * List Blogs
	 */
	public function blogs() {
		$data = array();
		$data['blogs'] = $this->post_model->get_where("enable='1'");
		//echo '<pre>'; print_r($data); exit();
		$this->template->set('title', 'My Blog - Blogs');
		$this->template->load('default', 'contents' , 'blogs', $data);
	}
	
	/**
	 * Blog Detail
	 */
	public function blogdetail($slug='') {
		$data = array();
		$data['slug'] = $slug;
		$blog = $this->post_model->get_where_single("enable='1' AND slug='{$slug}'");
		$data['blog'] = $blog;
		$comments = $this->comment_model->get_blog_comments($blog->id);
		$data['comments'] = $comments;
		//echo '<pre>'; print_r($data); exit();
		if(!empty($_POST)) {
			//echo '<pre>'; print_r($_POST); exit();
            $this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('comment', 'Comment', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $sb_data = array();
				$sb_data['post_id'] = $this->input->post('post_id');
				$sb_data['name'] = $this->input->post('name');
				$sb_data['email'] = $this->input->post('email');
				$sb_data['comment'] = $this->input->post('comment');
                //echo '<pre>'; print_r($sb_data); exit();
                $save_data = $this->comment_model->insert($sb_data);
                if(!empty($save_data)) {
                    $this->session->set_flashdata('success', 'You have been successfully added comment to the blog.');
                    redirect('home/blogdetail/' . $slug, 'location');
                } else {
                    $this->session->set_flashdata('failure', 'Something went wrong while adding comment to the blog comment.');
                }
            }
		}
		$this->template->set('title', 'My Blog - Blog Detail');
		$this->template->load('default', 'contents' , 'blogdetail', $data);
	}
	
	/**
	 * About Us page
	 */
	public function about() {
		$data = array();
		$this->template->set('title', 'My Blog - About Us');
		$this->template->load('default', 'contents' , 'about', $data);
	}
	
	/**
	 * Contact Us page
	 */
	public function contact() {
		$data = array();
		$this->template->set('title', 'My Blog - Contact Us');
		$this->template->load('default', 'contents' , 'contact', $data);
	}

}	