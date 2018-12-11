<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function index(){
    }
    
    public function do_upload(){
        if( ($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/jpg') || ($_FILES['file']['type'] == 'image/png') ){
            if($this->checkFileContent($_FILES["file"]["tmp_name"]) == 'error'){
                echo json_encode(array('error'=>'-1','msg'=>'file content error'));
            }else{
                $var = $_FILES['file'];
                $name = $this->input->get_post('name');
                if(!$var['error']){
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/public/imgs/" . $name . ".jpeg")){
                        echo json_encode($var);
                    }else {
                        echo json_encode('none');
                    } 
                }
            }
        }else{
            echo json_encode(array('error'=>'-1','msg'=>'file type error'));
        }
    }

    function checkFileContent($fileName){
        $file = @fopen($fileName, "rb");
        $bin = fread($file, 5);// 只读5个字节
        fclose($file);
        $typelist = $this->getTypeList();
        foreach ($typelist as $v){
            $blen=strlen(pack("H*", $v[0]));// 得到文件头标记字节数
            $tbin=substr($bin, 0, intval($blen)); // 需要比较文件头长度
            $ttt = unpack("H*", $tbin);
            $tag_sel = array_shift($ttt);
            if( strtolower($v[0])==strtolower($tag_sel) ){
                return $v[1];
            }
        }
        return 'error';
    }


    function getTypeList(){
        return array(array("FFD8FFE0", "jpg"), array("FFD8FFE0", "jpeg"), array("89504E47","png"));
    }
}
