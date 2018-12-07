<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/ImplementJwt.php';

class Admin extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->objOfJwt = new ImplementJwt();
    }

	public function index()
	{
		if(isset($_COOKIE['auth'])){
			$decodeToken = $this->objOfJwt->DecodeToken($_COOKIE['auth']);
			$user = $decodeToken;
			if( $user['role'] == 0){
				$this->load->library('layout');
				$this->load->model('admin_model');
				$product = $this->admin_model->getProductData();
				$catgory = $this->admin_model->getCatgoryData();
				$user = $this->admin_model->getUserData();
				$orders = $this->admin_model->getOrdersData();
				$data['products'] = $product;
				$data['catgory'] = $catgory;
				$data['user'] = $user;
				$data['orders'] = $orders;
				// var_dump($user);
				// $this->load->view('home',['products' => $products]);
				
				$this->layout->view('admin',['data' => $data]);
			}else {
				echo '你不是管理员';
			}
		}else {
			echo '请<a href="login">登录</a> <a href="home">Home</a>';
		}
		// var_dump($user);
		
		
		
	}
}