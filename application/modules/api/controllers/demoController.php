<?php
require(APPPATH.'libraries/REST_Controller.php');
class demoController extends REST_Controller
{
	
	 function __construct()
    {
        parent::__construct();
      	$this->load->Model('UserModel');
		$this->load->Model('serviceModel');
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
    }
	
	function getProductDetails_post()   
	{
		//shortcut to this filtering is set $config['global_xss_filtering'] = TRUE; in application/config/config.php
		$product_id=trim($this->input->post('product_id',true));
		$user_id=trim($this->input->post('user_id',true));
		$api_key=trim($this->input->post('api_key',true));
		
		$this->form_validation->set_rules('product_id', 'product_id', 'required');
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('api_key', 'api_key', 'required');
		
		$status_code="500";
		if ($this->form_validation->run() == FALSE){		
			//// set error 
			
			$data['statusCode']=0;
			$data['message']='Some data is missing';	
			
		} else {		
			$validUser=$this->UserModel->isValidUser($user_id,$api_key);
			if($validUser){
				$status_code="200";
				$data=$this->serviceModel->getProductDetailsByID($product_id,$user_id); 
			}else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}
		}
		$this->response($data,$status_code);

	}

	
  function createOTP_get()    
  {
    echo substr(rand(),0,4);
     
  }
}
?>