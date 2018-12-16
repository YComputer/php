<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require APPPATH . '/libraries/ImplementJwt.php';
class Orders extends CI_Controller {
 
 
    public function __construct(){
        parent::__construct();
        $this->objOfJwt = new ImplementJwt();
    }
 
	public function index()
	{	
	}
 
	public function CreateOrder() {
        $response = array('status'=>'0','msg'=>'failed','data'=>'');
        $this->load->model('Orders_model');
        $this->load->model('Product_model');
        if(isset($_COOKIE['auth'])){
			$decodeToken = $this->objOfJwt->DecodeToken($_COOKIE['auth']);
            $user = $decodeToken;
            $userid = $user['userid'];
        }
        else {
            $userid = 'guest-internal';
        }
        
        $post = $this->input->post(NULL, TRUE);
        // Consult the database in order to get the instant price of the product
        // and insert to order.
        
        $pids = explode('-', $post['pid']);
        $prices = [];
        foreach ($pids as $prod_id) {
            $product = $this->Product_model->get_product_detail($prod_id);
            //echo $prod_id;
            //echo var_dump($product);
            $product_price = $product[0]->price;
            array_push($prices, $product_price); 
        }
        $order_price = join('-', $prices);
        //echo "======price_get: " . $order_price;
        $data = array(
            'pid' => $post['pid'],
            'qty' => $post['qty'],
            'price' => $order_price,
            'userid' => $userid,
            'hash' => md5($post['pid'] . ':' . $post['qty'] . ':' . time()),// 
            'status' => 0
        );
        $res = $this->Orders_model->create_orders($data);
        //echo "----------1------------";
        
        $response = array('status'=>'2','msg'=>'success','data'=>$res[0]);

        echo json_encode($response);

	}
}
