<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->library('layout');
		$this->load->model('admin_model');// 都是获取所有数据接口，可复用
		$product = $this->admin_model->getProductData();
		$catgory = $this->admin_model->getCatgoryData();
		$data['products'] = $product;
		$data['catgories'] = $catgory;
		$this->layout->view('home',['data' => $data]);
	}
}
