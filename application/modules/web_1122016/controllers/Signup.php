
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
		$data['message']="1close";
		$this->load->view('login_view',$data);
		
		
		
	}

}
?>