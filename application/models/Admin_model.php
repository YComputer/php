<?php

// 命名规则：和controller同名加 _model 
class Admin_model extends CI_Model {

  // config/autoload.php 配置了自动加载链接数据库实例
  // public function __construct(){
  //     $this->load->database();
  // }

  // 从数据库中查询数据 数据库查询构造 https://codeigniter.org.cn/user_guide/database/query_builder.html
  public function getProductData(){
    // return  array("Volvo","BMW","SAAB");
    $query = $this->db->query('select * from products;');
    return $query->result();

  }

  public function getCatgoryData(){
    // return  array("Volvo","BMW","SAAB");
    $query = $this->db->query('select * from categories;');
    return $query->result();

  }

  public function getUserData(){
    // return  array("Volvo","BMW","SAAB");
    $query = $this->db->query('select * from users;');
    return $query->result();

  }

  public function getOrdersData(){
    // return  array("Volvo","BMW","SAAB");
    $query = $this->db->query('select * from orders;');
    return $query->result();

  }
}
