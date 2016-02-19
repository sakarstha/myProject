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
    
//     //send verification email to user's email id
//     function sendEmail($to_email)
//     {
//         $from_email = 'team@mydomain.com'; //change this to yours
//         $subject = 'Verify Your Email Address';
//         $message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://www.mydomain.com/user/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';
        
//         //configure email settings
//         $config['protocol'] = 'smtp';
//         $config['smtp_host'] = 'ssl://smtp.mydomain.com'; //smtp host name
//         $config['smtp_port'] = '465'; //smtp port number
//         $config['smtp_user'] = $from_email;
//         $config['smtp_pass'] = '********'; //$from_email password
//         $config['mailtype'] = 'html';
//         $config['charset'] = 'iso-8859-1';
//         $config['wordwrap'] = TRUE;
//         $config['newline'] = "\r\n"; //use double quotes
//         $this->email->initialize($config);
        
//         //send mail
//         $this->email->from($from_email, 'Mydomain');
//         $this->email->to($to_email);
//         $this->email->subject($subject);
//         $this->email->message($message);
//         return $this->email->send();
//     }
    
//     //activate user account
//     function verifyEmailID($key)
//     {
//         $data = array('status' => 1);
//         $this->db->where('md5(email)', $key);
//         return $this->db->update('user', $data);
//     }
}
?>