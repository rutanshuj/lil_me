<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
			$this->load->helper(array('form', 'url')); 
			$this->load->library('form_validation'); 
			$this->load->model('user_model');
			
			
			$user_session = $this->session->userdata('username');
			if((isset($user_session))&&(!empty($user_session))) {			
				redirect("admin/dashboard");
				exit;				
			}
		
	}
	public function test1(){
		echo "TEST";
	}
	public function index()
	{
		
		$data['error'] = $this->session->flashdata('error');		
		$this->load->view('login_view', $data);

	}
	
	public function login() {
		
		$username = trim($this->input->post("username",true));
		$password = trim($this->input->post("password",true));
		
		/* Validation
		 =============================================== */
		 
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		
		
		
		if ($this->form_validation->run() == FALSE){			
			$this->session->set_flashdata('error', 'Username or password invalid');
			redirect();
			exit;			
		} else {		
					
			$login_status = $this->user_model->login($username, $password);		
			if($login_status['status'] != "1") {			
				$this->session->set_flashdata('error',$login_status['message']) ;
				redirect('admin/login');
				exit;					
			} else {		
				$this->session->set_userdata('access_token', $login_status['api_key']);			
				$this->session->set_userdata('id', $login_status['user_id']);
				$this->session->set_userdata('username', $username);			
				redirect("admin/dashboard");
				exit;				
			}	
		}		
	}	
}
