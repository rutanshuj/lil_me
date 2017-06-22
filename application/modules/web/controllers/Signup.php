
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {
	public function __construct() {		
		parent::__construct();
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); 
		
	}
	function index()
	{
		
		$this->load->view('signup_view');
		
	}
	
	function login(){
		//print_r($this->session->userdata());
		$this->load->view('login_view');
		
		
		
	}
	function forget_password()
	{
		
		$this->load->view('forget_password');
		
	}
}
?>