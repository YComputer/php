<?php
class Product_model extends CI_Model {
	
	public function __construct()
  {
    // $this->load->database(); // 配置文件中已经自动加载
  }
  
  
  public function get_product_detail($productid){
    try{
        $sql = "SELECT * FROM products WHERE pid = ?";
        // use query bindings to prevent against injection.
        $query = $this->db->query($sql, array($productid));
        return $query->result();
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

  public function add_product($data){
    $response = array('status'=>'0','msg'=>'failed','id'=>'');
    try{
        // 防止 sql 注入。 需要每个字段单独拿出来判断。
        // $dataEscape = $this->db->escape($data);
        $query = $this->db->insert( 'products' , $data );
        $response['id'] = $this->db->insert_id();
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
        // CodeIgniter's Active Record methods automatically escape queries for you, to prevent sql injection.
        $query = $this->db->delete('products' , array('pid' => $productid) );
        // $response['data'] = $query;
        $response['status'] = '2';
        $response['msg'] = 'success';
        return $response;
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

  public function update_product($data){
    $response = array('status'=>'0','msg'=>'failed','data'=>'');
    $value = array(
      'name' => $data['name'],
      'price' => $data['price'],
      'catid' => $data['catid'],
      'description' => $data['description']
    );
    try{
        // $query = $this->db->delete('products' , array('pid' => $productid) );
        // CodeIgniter's Active Record methods automatically escape queries for you, to prevent sql injection.
        $query = $this->db->update('products', $value, array('pid'=> $data['pid']));
        // $response['data'] = $query;
        $response['status'] = '2';
        $response['msg'] = 'success';
        return $response;
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

  public function change_catgory($catid){
    $response = array('status'=>'0','msg'=>'failed','data'=>'');
    try{
        if($catid >= 0){
          $query = $this->db->get_where('products',array('catid'=>$catid));
        }else {
          $query = $this->db->get('products');
        }
        
        $response['data'] = $query->result();
        $response['status'] = '2';
        $response['msg'] = 'success';
        return $response;
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }
  
  

  
}
