<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->library('layout');
		$this->load->model('home_model');
		$products = $this->home_model->getHomeData();
		// 打印对象方法 var_dump()
		// $this->load->view('home',['products' => $products]);
		$this->layout->view('home',['products' => $products]);
	}
}
