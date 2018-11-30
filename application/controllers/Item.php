<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/ImplementJwt.php';
class Item extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->objOfJwt = new ImplementJwt();
	}

	public function index()
	{
		if(isset($_COOKIE['auth'])){
			$decodeToken = $this->objOfJwt->DecodeToken($_COOKIE['auth']);
			$user = $decodeToken;
		} else {
			$user = NULL;
		}

		$data['user'] = $user;

		$this->load->library('layout');
		// $this->load->view('item');
		$this->layout->view('item',['data' => $data]);
	}
}
