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
        $this->load->library('layout');
		// https://codeigniter.com/user_guide/libraries/input.html
		// To return all POST items and pass them through the XSS filter set the first parameter NULL while setting the second parameter to boolean TRUE.
		$post = $this->input->post(NULL, TRUE);
		$this->load->model('Login_model');
        $user = $this->Login_model->login($post['email'], $post['pwd']);
        // $url = current_url();
        $response = array('status'=>'0','msg'=>'failed','data'=>'');
        
        if(sizeof($user)>0){
            $response = array('status'=>'2','msg'=>'success','data'=>$user[0]);
            echo json_encode($response);
            // if($user[0]->role == 0){
            //     // 跳转到 admin
            //     // redirect('http://47.98.195.42/php/admin', 'location');

            // }else{
            //     // 跳转到首页
            //     // redirect('http://47.104.15.106/home');
            //     // redirect('http://47.98.195.42/php/home', 'location');
            // }
        }else{
            $response = array('status'=>'0','msg'=>'failed','data'=>$user);
            // echo json_encode($user);
            // $this->layout->view('item');
            echo json_encode($response);
        }
        
		
	}
}