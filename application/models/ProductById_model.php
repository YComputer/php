<?php
class ProductById_model extends CI_Model {
	
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
}
