<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email 
class Cart extends Admin_Controller {
	public $page='cart';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('Cart_model');
		
		
	
		 
		
	}
	

	
	public function index(){ ///add
	 show_404();
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		
		
		$id = $this->session->userdata('id');	
		 
		$data['user_details']=$this->Cart_model->cart_user_details();
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('cart_view', $data);
		$this->load->view('footer', $data);
		
	}
				
	
}
