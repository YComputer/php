<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/ImplementJwt.php';
class MyOrder extends CI_Controller {

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

			$this->load->library('layout');
			$this->load->model('Orders_model');// 都是获取所有数据接口，可复用
			$orders = $this->Orders_model->getOrdersData($user['userid']);
			$data['orders'] = $orders;
			
			$this->layout->view('myOrders',['data' => $data]);
		} else {
			echo '请<a href="login">登录</a> <a href="home">Home</a>';
		}
		
	}
}
