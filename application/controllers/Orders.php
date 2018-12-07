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

        if(isset($_COOKIE['auth'])){
			$decodeToken = $this->objOfJwt->DecodeToken($_COOKIE['auth']);
            $user = $decodeToken;
            $userid = $user['userid'];

            $post = $this->input->post(NULL, TRUE);
            $data = array(
                'pid' => $post['pid'],
                'qty' => $post['qty'],
                'userid' => $userid,
                'hash' => md5($post['pid'] . ':' . $post['qty'] . ':' . time()),// 
                'status' => 0
            );
            $res = $this->Orders_model->create_orders($data);

            $response = array('status'=>'2','msg'=>'success','data'=>$res[0]);
            echo json_encode($response);
        }else {
            $response = array('status'=>'0','msg'=>'failed','data'=>'登录过期了，请重新登录');
			echo json_encode($response);
		}
	}
}

