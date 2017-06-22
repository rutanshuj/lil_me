<?php

class Jquery extends CI_Controller
{
	
	function __construct()
	{
		parent::Controller();
	}
	
	public function index()
	{		
		$data['title'] = 'Jquery Examples';
		$this->load->view('jquery/home', $data);
	}


	public function ajax_example()
	{
		$data['title'] = 'Jquery Post Example';
		$this->load->view('jquery/ajax', $data);
	}


	public function ajaxprocess()
	{		
		
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
			
		if ($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			// Add fom data to Database etc
			echo 1;
		}
	}



	

	public function post_example()
	{
		$data['title'] = 'Jquery Post Example';
		$this->load->view('jquery/post', $data);
	}


	public function processform()
	{		
		
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
			
		if ($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			// Add fom data to Database etc
			echo 1;
		}
	}



	public function get_example()
	{
		$data['title'] = 'Jquery Get Example';
		$this->load->view('jquery/get', $data);
	}


	public function task()
	{
		if(IS_AJAX){
			echo "This is my loaded content";
		}else{
			echo "Direct access not allowed";
		}
	}


}