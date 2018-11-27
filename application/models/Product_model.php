<?php
class Product_model extends CI_Model {
	
	public function __construct()
  {
    // $this->load->database(); // 配置文件中已经自动加载
  }
  
  
  public function get_product_detail($productid){
    try{
        $sql = "SELECT * FROM products WHERE pid = ?";
        $query = $this->db->query($sql, array($productid));
        return $query->result();
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

  public function add_product($data){
    $response = array('status'=>'0','msg'=>'failed','data'=>'');
    try{
        $query = $this->db->insert( 'products' , $data );
        // $response['data'] = $query;
        $response['status'] = '2';
        $response['msg'] = 'success';
        return $response;
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

  public function delete_product($productid){
    $response = array('status'=>'0','msg'=>'failed','data'=>'');
    try{
        $query = $this->db->delete('products' , array('pid' => $productid) );
        // $response['data'] = $query;
        $response['status'] = '2';
        $response['msg'] = 'success';
        return $response;
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

  
}
