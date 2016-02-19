<?php 
if (! defined ('BASEPATH'))
	exit('No direct script access allowed');
	
	class Mytest extends CI_COntroller{
		function __construct(){
			parent::__construct();
			$this->load->model("Mytest_model");	
		}
		
		public function index()
		{
			$data['data'] = $this->Mytest_model->insertValue();
// 			print_r($data);
			$this->load->view("mytestview",$data);
		}
	
}


?>