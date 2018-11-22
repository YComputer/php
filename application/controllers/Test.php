<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 框架会自动匹配为 /test 路由。并且默认调用 index 方法。/test == /test/index 
class Test extends CI_Controller {
        // public function __construct(){
        //     parent::__construct();
        //     $this->load->model('test_model'); // 引用model时全部小写
        //     $this->load->helper('url_helper');
        // }

        public function index()
        {
                // 加载model
                $this->load->model('test_model');
                // 调用model的查询数据库方法
                $dataSet = $this->test_model->getTestData();
                // 将返回的数据传递到view
                $this->load->view('test_view', ['dataSet' => $dataSet]);
                
                // 一下的例子是使用多个模版组装页面
                // $this->load->view('templates/header', $data);
                // $this->load->view('news/index', $data);
                // $this->load->view('templates/footer');
        }
}
