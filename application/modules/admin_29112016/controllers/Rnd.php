<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rnd extends CI_Controller {
	public $page='verify_user';
	public function __construct() {
		
		parent::__construct();
			//$this->load->helper(array('form', 'url')); 
			//$this->load->library('form_validation'); 
			//$this->load->model('user_model');
			
			
			//echo $user_session = $this->session->userdata('username');
			//if((isset($user_session))&&(!empty($user_session))) {			
			//	redirect("admin/dashboard");
			//	exit;				
			//}
		
	}
	
	public function pdf(){
		
		
		if (!extension_loaded('imagick'))
    echo 'imagick not installed';exit;
		
		$this->load->view('catalogue_pdf');
		/* $file = base_url().'assets/product_catalog/jb-2016-workwear-3.pdf';
		  $filename = 'jb-2016-workwear-3.pdf';
		  header('Content-type: application/pdf');
		  header('Content-Disposition: inline; filename="' . $filename . '"');
		  header('Content-Transfer-Encoding: binary');
		  header('Accept-Ranges: bytes');
		  @readfile($file); */
	}
	public function index() {

	
		$data['update_user']=$this->config->item('update_user');///done
		
		
		
		
		
		$to = "pankaj.g@lastlocal.in";
		$subject = "My subject1234";
		$txt = $data['update_user']['body'];
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From: ".$data['update_user']['email']."" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();


		$sentmail=mail($to,$subject,$txt,$headers);
		echo $sentmail ? "email send" : "email send fail";
		exit;
		
		
		
		$data['decline_admin']=$this->config->item('decline_admin');
		$data['diamond_memo_accept']=$this->config->item('diamond_memo_accept'); /// done
		$data['disble_user']=$this->config->item('disble_user'); ///done
		$data['enable_user']=$this->config->item('enable_user'); /// done
		
		$data['memo_accept']=$this->config->item('memo_accept'); ///done
		$data['memo_reject']=$this->config->item('memo_reject'); /// done
		
		$data['reject_rfq_diamond']=$this->config->item('reject_rfq_diamond');
		$data['reject_user']=$this->config->item('reject_user'); //done
		$data['rfq_accept']=$this->config->item('rfq_accept');
		$data['verify_admin']=$this->config->item('verify_admin	'); /// done
		$data['verify_user']=$this->config->item('verify_user'); //// done
		echo "<pre>";
		print_r($data);			
	}

	
	
	
}
