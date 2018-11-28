<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function index()
	{
    }
    
    public function do_upload(){
        $var = $_FILES['file'];
        $name = $this->input->get_post('name');
        $file = $this->input->get_post('file');
        if(!$var['error']){
            if(move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/php/public/imgs/" . $name . ".jpeg")){
                echo json_encode($var);
            }else {
                echo json_encode('none');
            } 
        }
        
    }
}
