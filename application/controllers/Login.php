<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_controller
{
	function __construct()
	{
		parent::__construct();
// 		include '../system/libraries/Session/session.php';
		$this->load->library('session');
// 		$this->load->drivers('Session/session');
		$this->load->helper('form','url','html');
		$this->load->library('form_validation');
// 		$this->load->library(array('session', 'form_validation'));
		// Load model login_model
		$this->load->model('login_model');
		
	}
	
	public function index(){
		// get posted username and password
		$username= $this->input->post('username');
		$password= $this->input->post('password');
		
		// set validation
		$this->form_validation->set_rules("username","Username","trim|required");
		$this->form_validation->set_rules("password","Password","trim|required");
		
		if ($this->form_validation->run() == FALSE){
			// Validation fails
			echo "validation failed";
			$this->load->view('login_view');
		} else {
			// Validation successed
			if ($this->input->post('login_btn') == "Login"){
				$user_result= $this->login_model->get_user($username,$password);
				
				if ($user_result > 0){
					// Set the session variables
					$sessiondata = array('username'=> $username, 'loginuser'=> TRUE);
					$this->session->set_userdata($sessiondata);
					redirect ('index');
				} else {
					$this->session->set_flashdata('msg', 'Invalid Username or Password');
					redirect('login/index');
				}
				
			} else{
				redirect('login/index');
			}
		}
	}
	
	
	
}
?>