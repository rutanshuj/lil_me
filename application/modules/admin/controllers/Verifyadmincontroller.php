<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
class Verifyadmincontroller extends CI_controller {

	function __construct()
    {
        parent::__construct();
      	$this->load->model('Usermodel');
		$this->load->Model('Adminmodel');
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
    }
    function datafordashboardview()
    {
    	$data=$this->Adminmodel->getdataforadmindashBoard();
    	
    	print_r($data);
    }

}
?>