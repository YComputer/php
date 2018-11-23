<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function index()
	{
		$this->load->view('item');
	}
}
