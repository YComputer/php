<?php

// 命名规则：和controller同名加 _model 
class Home_model extends CI_Model {

  // config/autoload.php 配置了自动加载链接数据库实例
  // public function __construct(){
  //     $this->load->database();
  // }

  // 从数据库中查询数据 数据库查询构造 https://codeigniter.org.cn/user_guide/database/query_builder.html
  public function getHomeData(){
    // return  array("Volvo","BMW","SAAB");
    $query = $this->db->query('select * from products;');
    return $query->result();

  }
}
