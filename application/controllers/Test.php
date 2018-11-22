
<?php
class Test extends CI_Controller {

        public function index()
        {
		#echo 'hello';
                $this->load->model('test_model');
	      	$dataSet = $this->test_model->getTestData();
		$this->load->view('test_view', ['dataSet' => $dataSet]);
        }
}
