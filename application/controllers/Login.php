<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct(){
    	parent::__construct();
    }
    
	public function index(){
        $this->load->library('layout');
        $this->layout->view('login');
    }
    
    public function Login() {
		// https://codeigniter.com/user_guide/libraries/input.html
		// To return all POST items and pass them through the XSS filter set the first parameter NULL while setting the second parameter to boolean TRUE.
		$post = $this->input->post(NULL, TRUE);
		$this->load->model('Login_model');
		$user = $this->Login_model->login($post['email'], $post['pwd']);
		echo json_encode($user[0]);
	}
}