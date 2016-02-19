<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{
	function __construct(){
		// Call the model constructor
		parent::__construct();
		
		
	}
	
	public function get_user($username, $password){
		/* $sql= "select * from user where username='$username' and password = '".md5($password)."'";
		$sql= "select * from user where username='$username' and password = '$password'";
		$query= $this->db->query($sql);
 		return $query->num_rows();
 		 */
   		//$this->db->select(array('username','password'));
 		$this->db->from ('user');
 		$this->db->where(array('username'=>$username,"password"=>$password));
		$this->db->order_by('fname','ASC');
 		return $this->db->get()->num_rows();
//  		print_r($result);die();

	}
	

}
	
	//$this->find("first",array('conditions'=>array("username"=>$username),'fields'=>array("fname","email")))
?>