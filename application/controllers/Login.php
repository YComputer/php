<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/ImplementJwt.php';

class Login extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->objOfJwt = new ImplementJwt();
        $this->load->helper('cookie');
    }
    
	public function index(){
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->library('layout');
        $this->layout->view('login');

    }
    
    public function Login() {
        $this->load->helper('url');
        $this->load->library('layout');
        session_start();
        // $this->output->set_header('Access-Control-Allow-Credentials:true');
		// https://codeigniter.com/user_guide/libraries/input.html
		// To return all POST items and pass them through the XSS filter set the first parameter NULL while setting the second parameter to boolean TRUE.
		$post = $this->input->post(NULL, TRUE);
		$this->load->model('Login_model');
        $user = $this->Login_model->login($post['email'], $post['pwd']);
        // $url = current_url();
        $response = array('status'=>'0','msg'=>'failed','data'=>'');

            if($user['status'] == 2){
                // 登录成功构造JWT, 加上当前时间戳。
                $token['email'] = $user['data']->email;
                $token['role'] = $user['data']->role;
                $token['time'] = time();
                $jwtToken = $this->objOfJwt->GenerateToken($token);
                $cookie = array(
                    'name'  => 'auth',
                    'value' => $jwtToken,
                    'expire' => 60*60*24*3,
                    'path' => NULL,
                    'domain' => NULL,
                    'secure' => FALSE,
                    'prefix' => NULL,
                    'httponly' => TRUE
                );
                // set cookie + set session
                $this->input->set_cookie($cookie);
                $_SESSION['nonces'] = md5(rand(1,10000)); 
                // $decodeToken = $this->objOfJwt->DecodeToken($jwtToken);
                // echo $decodeToken;
                // var_dump($_COOKIE);
    
                $response = array('status'=>'2','msg'=>'success','data'=>$user['data']);
                echo json_encode($response);
            }else {
                $response = array('status'=>'0','msg'=>'failed','data'=>'pwd or email error');
                echo json_encode($response);
            }	
        
    }

    public function SignUp() {
        $response = array('status'=>'0','msg'=>'failed');
        $post = $this->input->post(NULL, TRUE);
        $this->load->model('Login_model');

        $pwd = password_hash($post['pwd'], PASSWORD_DEFAULT);
        $user = $this->Login_model->signUp($post['email'], $pwd);
        if($user['status'] == 2){
            $response = array('status'=>'2','msg'=>'success','data'=>$user['data']);
        }else {
            $response = array('status'=>'0','msg'=>'failed','data'=>$user['data']);
        }
        // $user = password_verify('123123', $pwd); 验证 返回true || false
        echo json_encode($response);
    }
    
    public function LogOut() {
        session_start();
        $response = array('status'=>'0','msg'=>'failed');
        try {
            $response = array('status'=>'2','msg'=>'success');
            unset($_SESSION['nonces']);
            delete_cookie('auth');
            echo json_encode($response);
        }catch(PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
}