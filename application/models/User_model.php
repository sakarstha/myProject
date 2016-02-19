<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //insert into user table
    function insertUser($data){
    	
        return $this->db->insert('user', $data);
    }
    
    //fucnction for user registration.
    function register(){
    		
    		//insert the user registration details into database
    		$data = array(
    				'fname' => 		$this->input->post('fname'),
    				'lname' => 		$this->input->post('lname'),
    				'email' => 		$this->input->post('email'),
    				'password'=> 	$this->input->post('password'),
    				'address' => 	$this->input->post('address'),
    				'username' =>	$this->input->post('username'),
    				'gender' =>		$this->input->post('gender'),
    				'country' =>	$this->input->post('country')
    		);
    	
    		
    		// insert form data into database
    		if ($this->user_model->insertUser($data)){
    			echo "Data inserted Successfully </br>";
    			$sessiondata = array('username'=>$data['username'], 'loginuser'=> TRUE	);
    			$this->session->set_userdata($sessiondata);
    			//print_r($sessiondata);die();
    			if (isset($sessiondata['username'])){
    			
    				redirect('user/dashboard');
//     				$this->load->view('dashboard_view.php');
    			
    			}else {
    				redirect('/');
    			}
    			
    		}else {
    			
    			// error in databse
    			$this->session->set_flashdata('msg','Unable to insert the data');
    			redirect('user/register');
    		}
    }
    
}
?>