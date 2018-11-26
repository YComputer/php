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
    	$this->load->model('ProductById_model');
    	
		$product_detail = $this->ProductById_model->get_product_detail($productid);
		// return json_encode($product_detail);
    	echo json_encode($product_detail);
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
	
}

