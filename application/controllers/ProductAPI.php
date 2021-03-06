<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class ProductAPI extends CI_Controller {
 
 
  public function __construct()
	{
		parent::__construct();
		
	}
 
	public function index()
	{	
	}
 
	public function ProductDetail() {
		$productid = $this->input->get_post('productid');
		//读取model
    	$this->load->model('Product_model');
    	
		$product_detail = $this->Product_model->get_product_detail($productid);
		// return json_encode($product_detail);
    	echo json_encode($product_detail[0]); 
   		// if($product_detail){
   		// 	// $arr = array('username'=>$username);
			
   		// 	// session_id();
   		// 	// session_start();
 
   		// 	// $_SESSION ['username'] = $username;
   		// 	// //$_SESSION['userid']=
   			
   		// 	// echo $_SESSION['username'];
   			
   		// 	// //结果封装成json字符串
   		// 	// $res=json_encode($arr);
 
   		// }else{
   		// 	echo 'product_detail 查询失败';
   		// }	 	
    	
	}

	public function AddProduct() {
		session_start();
		// https://codeigniter.com/user_guide/libraries/input.html
		// To return all POST items and pass them through the XSS filter set the first parameter NULL while setting the second parameter to boolean TRUE.
		$post = $this->input->post(NULL, TRUE);

		$data = array(
			'name' => $post['name'],
			'price' => $post['price'],
			'catid' => $post['catid'],
			'description' => $post['description']
		);
		if ($_SESSION['nonces']==$post['nonces']) {
			$this->load->model('Product_model');
			$product_list = $this->Product_model->add_product($data);
			echo json_encode($product_list);
		}

	}

	public function DeleteProduct() {
		$productid = $this->input->get_post('productid');
		//读取model
    	$this->load->model('Product_model');
    	
		$product_detail = $this->Product_model->delete_product($productid);
		echo json_encode($product_detail);
		// var_dump($post);
		// echo $post->;
	}

	public function UpdateProduct() {
		$data = $this->input->post(NULL, TRUE);
		//读取model
    	$this->load->model('Product_model');
    	
		$product_detail = $this->Product_model->update_product($data);
		echo json_encode($product_detail);
		// var_dump($post);
		// echo $post->;
	}

	public function ChangeCatgory() {
		$catid = $this->input->get_post('catid');
		//读取model
    	$this->load->model('Product_model');
    	
		$product_list = $this->Product_model->change_catgory($catid);
		echo json_encode($product_list);
		// var_dump($post);
		// echo $post->;
	}
	

	public function GetProducts() {
		$productid = $this->input->get_post('list');
		//读取model
		$pids = array();
		$pnum = array();
		$this->load->model('Product_model');
		if(!empty($productid)){
		 foreach ($productid as $value){
		  array_push($pids, $value['pid']);
		  array_push($pnum, $value['num']);
		 }
		 $product_detail = $this->Product_model->get_products($pids, $pnum);
		} else {
		 $product_detail = $this->Product_model->get_products($pids, $pnum);
		};
		   echo json_encode($product_detail);    
		   
	   }
	
}

