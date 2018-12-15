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
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/public/imgs/" . $name . ".jpeg")){// TODO 动态获取文件类型
                        try {
                            $srcImage = "/var/www/html/public/imgs/" . $name . ".jpeg";
                            $toFile = "/var/www/html/public/imgs/" . $name . "-thumb.jpeg";
                            $this->resize($srcImage, $toFile, 64, 64, 100);
                        }catch (Exception $e){
                            echo $e->getMessage();
                        }
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

    /**
     * @resize 图片等比缩放
     * @param string $srcImage   源图片路径
     * @param string $toFile     目标图片路径
     * @param integer $maxWidth   最大宽
     * @param integer $maxHeight  最大高
     * @param integer $imgQuality 图片质量
     * @return 
     */    
    function resize($srcImage,$toFile,$maxWidth = 64,$maxHeight = 64, $imgQuality=100){
    
        list($width, $height, $type, $attr) = getimagesize($srcImage);
        if($width < $maxWidth  || $height < $maxHeight) return ;
        switch ($type) {
            case 1: $img = imagecreatefromgif($srcImage); break;
            case 2: $img = imagecreatefromjpeg($srcImage); break;
            case 3: $img = imagecreatefrompng($srcImage); break;
        }
        $scale = min($maxWidth/$width, $maxHeight/$height); //求出绽放比例
        
        if($scale < 1) {
            $newWidth = floor($scale*$width);
            $newHeight = floor($scale*$height);
            
            $newImg = imagecreatetruecolor($newWidth, $newHeight);    

            //以下三行代码是解决图片缩放后背景变成黑色的。
            $color=imagecolorallocate($newImg,255,255,255);  //颜色
            imagecolortransparent($newImg,$color);
            imagefill($newImg,0,0,$color);
            
            imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            $newName = "";
            $toFile = preg_replace("/(.gif|.jpg|.jpeg|.png)/i","",$toFile);
    
            switch($type) {
                case 1: if(imagegif($newImg, "$toFile$newName.gif", $imgQuality))
                    return "$newName.gif"; break;
                case 2: if(imagejpeg($newImg, "$toFile$newName.jpg", $imgQuality))
                    return "$newName.jpg"; break;
                case 3: if(imagepng($newImg, "$toFile$newName.png", $imgQuality))
                    return "$newName.png"; break;
                default: if(imagejpeg($newImg, "$toFile$newName.jpg", $imgQuality))
                    return "$newName.jpg"; break;
            }    
            //imagedestroy() 释放与 image 关联的内存。image 是由图像创建函数返回的图像标识符，例如 imagecreatetruecolor()。
            imagedestroy($newImg);
        }
        else {
            $bgimg = imagecreatetruecolor($maxWidth, $maxHeight);

            //以下三行代码是解决图片缩放后背景变成黑色的。
            $color=imagecolorallocate($bgimg,255,255,255);  //颜色
            imagecolortransparent($bgimg,$color);
            imagefill($bgimg,0,0,$color);    
                    
            imagedestroy($img);
        }
        return false;
    }


}
