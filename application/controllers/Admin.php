<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->load->library('layout');
		$this->load->model('admin_model');
		$product = $this->admin_model->getProductData();
		$catgory = $this->admin_model->getCatgoryData();
		$data['products'] = $product;
		$data['catgory'] = $catgory;
		// var_dump($product,$catgory)
		// $this->load->view('home',['products' => $products]);
		$this->layout->view('admin',['data' => $data]);
		
	}
}