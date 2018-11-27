<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function index()
	{
		$this->load->library('layout');
		// $this->load->view('item');
		$this->layout->view('item');
	}
}
