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
    	
    	// default dynamic object created
    	$data = new stdClass();
    	
    	//form validations rules
    	$this->form_validation->set_rules('fname', 'First Name', 'trim|required|alpha|min_length[3]|max_length[30]');
    	$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|alpha|min_length[3]|max_length[30]');
    	$this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|is_unique[user.email]');
    	$this->form_validation->set_rules('password', 'Password', 'trim|required');
    	$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
    	$this->form_validation->set_rules('address','Address', 'trim|required|alpha');
    	$this->form_validation->set_rules('username','Username','trim|required|is_unique[user.username]|min_length[5]|max_length[30]');
    	$this->form_validation->set_rules('country', 'Country','trim|required');
    	 
    	//validate form for registration
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
    	
    	// create dynamic object
    	$data = new stdClass();
    	
     	// get posted username and password
    	$username= $this->input->post('username');
    	$password= $this->input->post('password');

    	// set validation to user login form
    	$this->form_validation->set_rules("username","Username","trim|required");
    	$this->form_validation->set_rules("password","Password","trim|required"); 

    	if ($this->form_validation->run() == FALSE){
    		
    		// Validation fails
    		$this->load->view('login_view',$data);
    	} else {
    		
    		// Validation successed
    		if ($this->input->post('login_btn') == "Login"){
    			
    			$user_result= $this->login_model->get_user($username,$password);
    			if ($user_result > 0){
    				
    				// Set the session variables for suceessful login
    				$sessiondata = array('username'=> $username, 'loginuser'=> TRUE);
    				$this->session->set_userdata($sessiondata);
    				
    				// If login is successful redirect to dashboard
    				redirect('user/dashboard');
    			} else {
    				
    				// Error during login, redirect the user to web root
    				$this->session->set_flashdata('msg', 'Invalid Username or Password');
    				redirect('/');
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
			
			// Login with session
			echo "welcome to dashboard <br>";
			$this->load->view('dashboard_view',$data);
		} else {
			
			// redirect the user to the web root
			redirect('/');	
		}
    	
    }
    
    /**
     * logout function
     * @access public
     */
    public function logout(){
    	
    	// destroy session variable during logout and redirect to web root
     	$this->session->sess_destroy();
    	redirect('/');
    }
}
?>