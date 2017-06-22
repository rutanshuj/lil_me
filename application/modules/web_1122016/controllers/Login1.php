<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login1 extends CI_Controller {

	public function __construct() {
			
		 parent::__construct();
			$this->load->helper(array('form', 'url')); 
			$this->load->library('form_validation'); 
			$this->load->model('user_model');
			/*echo '<pre>';
			var_dump($_SESSION);
			echo '</pre>';
			
			$user_session = $this->session->userdata('username');
			if((isset($user_session))&&(!empty($user_session))) {			
				//redirect("web/home");
				
				exit;				
			} */
		
	}

	public function index()
	{
		
		$data['error'] = $this->session->flashdata('error');		
		//$this->load->view('header', $data);
		$this->load->view('login_view', $data);
		//$this->load->view('footer', $data);

	}
	public function signup()
	{
		
		$data['error'] = $this->session->flashdata('error');		
		//$this->load->view('header', $data);
		$this->load->view('signup_view', $data);
		//$this->load->view('footer', $data);

	}
	
	public function login() {
		/* echo '<pre>';
			print_r($_POST);
			echo '</pre>';
			die(); */
		$username = trim($this->input->post("username",true));
		$password = trim($this->input->post("password",true));
		/* echo $username." ".$password;
		die(); */
		/* Validation
		 =============================================== */
		 
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		
		
		
		if ($this->form_validation->run() == FALSE){			
			$this->session->set_flashdata('error', 'Username or password invalid');
			//redirect();
			exit;			
		} else {		
			$where_array=array("username"=>$username,"password"=>md5($password));
			$this->db->select('user_id,is_enable,api_key');
			$this->db->where($where_array);
			$query = $this->db->get('user_details');		
			$result = $query->row();
			
			   if(isset($result->user_id)) {
			if($result->is_enable=="1") {
			
				$this->db->where('user_id', $result->user_id);
				$result_data['api_key']=$result->api_key;
				$result_data['status']='1';
				$this->session->set_userdata('access_token', $result->api_key);			
				$this->session->set_userdata('id', $result->user_id);
				$this->session->set_userdata('username', $username);			
				redirect("web/home");
			
				exit;
				
			} else {
				$result_data['status']='2';
				$result_data['message']='Your account is yet to be verified';
				$this->session->set_flashdata('error',$result_data['message']) ;
			}
			} else {
				$result_data['status']='0';
				$result_data['message']='Username or password invalid';
				$this->session->set_flashdata('error',$result_data['message']) ;
			}
			 
			//return $result_data; 
			 			 
			
		}		
	}	
}
