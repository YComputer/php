<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/ImplementJwt.php';
class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
        $this->objOfJwt = new ImplementJwt();
	}
	
	public function index()
	{

		if(isset($_COOKIE['auth'])){
			$decodeToken = $this->objOfJwt->DecodeToken($_COOKIE['auth']);
			$user = $decodeToken;
		} else {
			$user = NULL;
		}

		$this->load->library('layout');
		$this->load->model('admin_model');// 都是获取所有数据接口，可复用
		$product = $this->admin_model->getProductData();
		$catgory = $this->admin_model->getCatgoryData();
		$data['products'] = $product;
		$data['catgories'] = $catgory;
		$data['user'] = $user;
		// var_dump($user);
		
		$this->layout->view('home',['data' => $data]);
	}
}
