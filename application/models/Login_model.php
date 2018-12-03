<?php
class Login_model extends CI_Model {
	
	public function __construct(){
        // $this->load->database(); // 配置文件中已经自动加载
    }
  
    public function signUp($email, $pwd){
        $data = array(
            'email'=> $email,
            'pwd'=> $pwd,
            'name'=>'example',
            'role'=>1
        );
        $res = array('status'=>'0','msg'=>'failed','data'=>null);
        try{
            $sql = "SELECT * FROM users WHERE email = ? ";
            $query = $this->db->query($sql, array($email));
            $user = $query->result();
            if(sizeof($user)>0){
                $res = array('status'=>'0','msg'=>'failed','data'=>'Email has been registered');
                return $res;
            }else {
                $insert = $this->db->insert( 'users' , $data );
                $res = array('status'=>'2','msg'=>'success','data'=>$this->db->insert_id());
                return $res;
            }
        }catch(PDOEXCEPTION $e){
            echo $e->getMessage();
        }
      }
  
  public function login($email, $pwd){
    try{
        $sql = "SELECT * FROM users WHERE email = ? ";
        // use query bindings to prevent against injection.
        $query = $this->db->query($sql, array($email));
        $res = array('status'=>'0','msg'=>'failed','data'=>null);
        $user = $query->result();
        if(sizeof($user)>0 && password_verify($pwd, $user[0]->pwd)){
            $res = array('status'=>'2','msg'=>'success','data'=>$user[0]);
            return  $res;
        } else {
            $res = array('status'=>'0','msg'=>'failed','data'=>null);
            return $res;
        };
        
    }catch(PDOEXCEPTION $e){
        echo $e->getMessage();
    }
  }
}
