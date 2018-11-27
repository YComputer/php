<?php
class Category_model extends CI_Model {
	
	public function __construct()
  {
    // $this->load->database(); // 配置文件中已经自动加载
  }
  

  public function add_category($data){
    $response = array('status'=>'0','msg'=>'failed','data'=>'');
    try{
        $query = $this->db->insert( 'categories' , $data );
        // $response['data'] = $query;
        $response['status'] = '2';
        $response['msg'] = 'success';
        return $response;
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

  public function delete_category($catid){
    $response = array('status'=>'0','msg'=>'failed','data'=>'');
    try{
        $query = $this->db->delete('categories' , array('catid' => $catid) );
        // $response['data'] = $query;
        $response['status'] = '2';
        $response['msg'] = 'success';
        return $response;
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }


  public function select_category($catid){
    $response = array('status'=>'0','msg'=>'failed','data'=>'');
    try{
        $query = $this->db->get_where('categories',array('catid'=>$catid));
        // $response['data'] = $query;
        // $response['status'] = '2';
        // $response['msg'] = 'success';
        return $query->result();
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

  public function update_category($data){
    $response = array('status'=>'0','msg'=>'failed','data'=>'');
    $value = array(
        'name' => $data['cat_name']
    );
    try{
        $query = $this->db->update('categories', $value, array('catid'=> $data['catid']));
        // $response['data'] = $query;
        $response['status'] = '2';
        $response['msg'] = 'success';
        return $response;
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }

  

  
}
