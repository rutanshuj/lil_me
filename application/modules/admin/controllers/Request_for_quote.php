<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request_for_quote extends Admin_Controller {
	public $page='request_for_quote';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('Adminmodel');
		$this->load->Model('Rfq_data');
		
		
		
	}
	
	public function index() {		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		
		
		$current_date=date("Y-m-d");
		
		$expired_date=date('Y-m-d', strtotime('-7 day', strtotime($current_date)));
		
		
		$data['due_today']=$this->Rfq_data->due_today($current_date,null,null);
		//echo"<pre>";
		//print_r($data['due_today']);
		
		$data['expired']=$this->Rfq_data->due_today(null,$expired_date,null);
		//print_r($data['expired']); exit;
    	//RFQ due_today
		//RFQ expired in last 7 days
    		
		// rfq_dashboard
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('rfq_dashboard_view', $data);
		$this->load->view('footer', $data);
		
					
	}
	
	public function request(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		
		$data['rfq_request']=$this->Rfq_data->due_today(null,null,'request');
		
		$this->load->view('header', $data); 
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('rfq_request_view', $data);
		$this->load->view('footer', $data);
		
	}
	public function history(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		
		$data['rfq_history']=$this->Rfq_data->due_today(null,null,null);
		
		$this->load->view('header', $data); 
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('rfq_history_view', $data);
		$this->load->view('footer', $data);
	}
}