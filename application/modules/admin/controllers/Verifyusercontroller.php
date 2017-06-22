<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
class Verifyusercontroller extends CI_controller {

    function __construct()  
    {
        parent::__construct();
      	$this->load->model('User_model');
		$this->load->Model('Adminmodel');
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
    }
    function datafordashboardview()
    {
    	$data=$this->User_model->getdataforuserdashBoard();
    	
    	print_r($data);
    }

}
?>