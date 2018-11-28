<?php
class Login_model extends CI_Model {
	
	public function __construct(){
        // $this->load->database(); // 配置文件中已经自动加载
    }
  
  
  public function login($email, $pwd){
    try{
        $sql = "SELECT * FROM users WHERE email = ? AND pwd = ?";
        // use query bindings to prevent against injection.
        $query = $this->db->query($sql, array($email, $pwd));
        return $query->result();
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

}
