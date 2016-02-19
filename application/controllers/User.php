<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User class
 * 
 * @extend CI_controller
 * 
 * @author saku
 *
 */
class User extends CI_Controller{
	/**
	 * __construct function
	 * 
	 * @access public
	 * @return void 
	 */
    public function __construct(){
    	
        parent::__construct();
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->helper(array('form','url','html'));
        $this->load->library(array('session', 'form_validation'));
       // $this->load->database();
        $this->load->model('user_model');
        $this->load->model('login_model');
    }
    
    function index(){
    	$data = new stdClass();
    	
		// Load the login view 	
    	$this->load->view('login_view',$data);

   }
   
   /**
    * register function
    * @access public
    * @return void
    */
    public function register(){
    	
    	$data = new stdClass();
    	
    	//form validations
    	$this->form_validation->set_rules('fname', 'First Name', 'trim|required|alpha|min_length[3]|max_length[30]');
    	$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|alpha|min_length[3]|max_length[30]');
    	$this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|is_unique[user.email]');
    	$this->form_validation->set_rules('password', 'Password', 'trim|required');
    	$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
    	$this->form_validation->set_rules('address','Address', 'trim|required|alpha');
    	$this->form_validation->set_rules('username','Username','trim|required|is_unique[user.username]|min_length[5]|max_length[30]');
    	$this->form_validation->set_rules('country', 'Country','trim|required');
    	 
    	//validate form input
    	if ($this->form_validation->run() == FALSE)
    	{
    		// Validation fails
    		$this->load->view('user_registration_view',$data);    	}
    	else
    	{
    		// Validation success
    		$this->user_model->register();
    	}
    }

	/**
	 * @access public
	 * @return void
	 */
    //getUser
    public function login(){
    	$data = new stdClass();
    	
     	// get posted username and password
    	$username= $this->input->post('username');
    	$password= $this->input->post('password');

    	// set validation
    	$this->form_validation->set_rules("username","Username","trim|required");
    	$this->form_validation->set_rules("password","Password","trim|required"); 

    	if ($this->form_validation->run() == FALSE){
    		
    		// Validation fails
    		//echo "validation failed";
    		$this->load->view('login_view',$data);
    	} else {
    		
    		// Validation successed
    		if ($this->input->post('login_btn') == "Login"){
    			
    			$user_result= $this->login_model->get_user($username,$password);
    			if ($user_result > 0){
    				
    				// Set the session variables for suceesful login
    				$sessiondata = array('username'=> $username, 'loginuser'=> TRUE);
    				$this->session->set_userdata($sessiondata);
    				
    				// If login is successful redirect to dashboard
    				$this->dashboard();
    			} else {
    				
    				// Error during login
    				// Redirect the user to site root
    				$this->session->set_flashdata('msg', 'Invalid Username or Password');
    				$this->index();
    			}
    	
    		} else{
    			redirect('/');
    		}
    	}
    	
    }
    
    /**
     * @access public
     */
    public function dashboard(){
    	$data = new stdClass();
    	$sessiondata = $this->session->all_userdata();
// //     	echo "this is dashboard";
//     	print_r($sessiondata);
//     	die();
		if(isset($sessiondata['username'])){
			
			echo "welcome to dashboard <br>";
			$this->load->view('dashboard_view',$data);
		} else {
			redirect('/');
		}
    	
    }
    
    /**
     * logout function
     * @access public
     */
    public function logout(){
    	
    	// destroy session variable during logout
//     	$sessiondata = array('username'=>'','loginuser'=> FALSE);
     	//$this->session->unset_userdata($this->session->userdata);
//     	print_r($sessiondata); die();

    	$sessiondata = $this->session->all_userdata();
    	print_r($sessiondata);
     	$this->session->sess_destroy();
     	
		print_r($this->session->userdata);
		die();
    	redirect('/');
    }
}
?>