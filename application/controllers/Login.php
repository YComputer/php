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
        // CREATE A RANDOM SESSION TOKEN
        session_start();
        $length = 32;
        $_SESSION['nonces'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
        $_SESSION['captcha'] = rand(1000,9999);

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
        
        if ($_SESSION['captcha']==$post['captcha'] && $_SESSION['nonces']==$post['nonces'] && $this->input->get_request_header('login-custom-header', TRUE)=='login-csrf') {
            $user = $this->Login_model->login($post['email'], $post['pwd']);
            // $url = current_url();
            $response = array('status'=>'0','msg'=>'failed','data'=>'');
            if($user['status'] == 2){
                // 登录成功构造JWT, 加上当前时间戳。
                $token['userid'] = $user['data']->userid;
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
                // VALID TOKEN PROVIDED - PROCEED WITH PROCESS
                $response = array('status'=>'2','msg'=>'success','data'=>$user['data']);
                echo json_encode($response);
            }else {
                $response = array('status'=>'0','msg'=>'failed','data'=>'pwd or email error');
                echo json_encode($response);
            }
        }else{
            $response = array('status'=>'0','msg'=>'failed','data'=>'captcha error or nonces error or login-custom-header error');
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