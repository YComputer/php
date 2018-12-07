<?php
class Orders_model extends CI_Model {
	
	public function __construct()
  {
    // $this->load->database(); // 配置文件中已经自动加载
  }
  
  
  public function get_orders_detail($orderid){
    try{
        $sql = "SELECT * FROM orders WHERE orderid = ?";
        // use query bindings to prevent against injection.
        $query = $this->db->query($sql, array($orderid));
        return $query->result();
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

  public function create_orders($data){
    // session_start();
    try{
        $query = $this->db->insert( 'orders' , $data );
        if($query){
            $orderid = $this->db->insert_id();
            try{
                $sql = "SELECT * FROM orders WHERE orderid = ?";
                // use query bindings to prevent against injection.
                $res= $this->db->query($sql, array($orderid));
                return $res->result();

            }catch(PDOEXCEPTION $e){
                echo $e->getMessage();
            }
        }
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

  public function getOrdersData($userId){
    try{
        $sql = "SELECT * FROM orders WHERE userid = ?";
        // use query bindings to prevent against injection.
        $query = $this->db->query($sql, array($userId));
        return $query->result();
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

  
}
