<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function index()
	{
    }
    
    public function AddCategory() {
		$post = $this->input->post(NULL, TRUE);
		$data = array(
			'name' => $post['cat_name'],
		);
		$this->load->model('Category_model');
		$category_list = $this->Category_model->add_category($data);
		echo json_encode($category_list);
		// var_dump($post);
		// echo $post->;
    }

    public function DeleteCategory() {
		$catid = $this->input->get_post('catid');
		//读取model
    	$this->load->model('Category_model');
    	
		$category_list = $this->Category_model->delete_category($catid);
		echo json_encode($category_list);
		// var_dump($post);
		// echo $post->;
    }

    public function SelectCategory() {
		$catid = $this->input->get_post('catid');
		//读取model
    	$this->load->model('Category_model');
    	
		$category_list = $this->Category_model->select_category($catid);
		echo json_encode($category_list[0]);
		// var_dump($post);
		// echo $post->;
    }

    public function UpdateCategory() {
		$data = $this->input->post(NULL, TRUE);
		//读取model
    	$this->load->model('Category_model');
    	
		$category_list = $this->Category_model->update_category($data);
		echo json_encode($category_list);
		// var_dump($post);
		// echo $post->;
    }
    
    
    
    
}