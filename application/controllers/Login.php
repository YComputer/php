<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct(){
    	parent::__construct();
    }
    
	public function index(){
        $this->load->helper('url');
        $this->load->library('layout');
        $this->layout->view('login');
    }
    
    public function Login() {
        $this->load->helper('url');
		// https://codeigniter.com/user_guide/libraries/input.html
		// To return all POST items and pass them through the XSS filter set the first parameter NULL while setting the second parameter to boolean TRUE.
		$post = $this->input->post(NULL, TRUE);
		$this->load->model('Login_model');
        $user = $this->Login_model->login($post['email'], $post['pwd']);
        if(sizeof($user)>0){
            if($user[0]->role == 0){
                // 跳转到 admin
                // redirect('/admin');
                redirect('http://47.104.15.106/admin');
            }else{
                // 跳转到首页
                redirect('http://47.104.15.106/home');
            }
        }else{
            $this->load->view('login', ['err' => '用户名或密码错误']);
        }
        
		
	}
}