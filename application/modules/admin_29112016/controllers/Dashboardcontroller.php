<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
class Dashboardcontroller extends CI_controller {

	function __construct()
    {
        parent::__construct();
      	$this->load->model('Usermodel');
		$this->load->Model('Adminmodel');
		$this->load->model('Jewellerymodel');
		$this->load->Model('Diamondmodel');
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
    }
    function datafordashboardview()
    {
    	$data['admin']=$this->Adminmodel->dataForDashBoard();
    	$data['user']=$this->Usermodel->dataForDashBoard();
    	$data['jewellery']=$this->Jewellerymodel->dataForDashBoard();
    	$data['diamond']=$this->Diamondmodel->dataForDashBoard();
    	$data['activity']=$this->Usermodel->getUserActivity();
    	$data['favorites']=$this->Jewellerymodel->getjewelleryFavorites();
    	print_r($data);
    }

}
?>