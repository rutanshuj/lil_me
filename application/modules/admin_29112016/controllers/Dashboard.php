<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
	public $page='home_page';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->load->model('Usermodel');
		$this->load->Model('Adminmodel');
		$this->load->model('Jewellerymodel');
		//$this->load->Model('Diamondmodel');
		$this->load->Model('Product_catalog');
		
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		
	}
	
	public function index() {		
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		
		
		$data['admin']=$this->Adminmodel->dataForDashBoard();
    	$data['user']=$this->Usermodel->dataForDashBoard();
		$data['jewellery']=$this->Jewellerymodel->dataForDashBoard();
    	$data['favorites']=$this->Jewellerymodel->dashBoard_jewelleryFavorites();
	
		$data['diamond']=$this->Product_catalog->dashBoard_data();
		
    	
    	$data['activity']=$this->Usermodel->getUserActivity();
    		
    	
		
		
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('dashboard_view', $data);
		$this->load->view('footer', $data);
					
	}
	
}
