<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verify_admin extends Admin_Controller {
	public $page='verify_admin';
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
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		
	}
	
	public function index() {		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		
		
		$data['active_admins']=$this->Adminmodel->get_admin_details('admin','1');
		$data['pending_admins']=$this->Adminmodel->get_admin_details('pending','0');
    		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('verify_admin_view', $data);
		$this->load->view('footer', $data);
		
					
	}
	public function admin_reject(){	
		$this->load->helper('email');
		$status=trim($this->input->get('status',true));
		if($status=="deleted"){
			
		} else if($status=="rejected"){
			
		}
		
		$reject_user = $this->config->item('reject_user');		
		
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From: ".$reject_user['email']."" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		
		
		
		
		
		$email=trim($this->input->get('email',true));
		
		$i="0";
		$id=trim($this->input->get('id',true));
		$name=trim($this->input->get('name',true));
		
		$fullname=trim($this->input->get('fullname',true));
		$message = "Error:: ".$name." is not ".$status.", please try again";
		if(is_numeric($id)){
			$data = array(
			   'role' => 'rejected',
			   'is_enable' => '0',
			   'updated_by' => DATE("Y-m-d H:i:s")
			);
			$result =$this->Adminmodel->admin_reject_approve($id,$data);
			if($result =="1") {
				$i++;
				$message = "Successful:: ".$name." is ".$status;
				if(valid_email($email)){
					
					
					
					
					$reject_user['body']= str_replace("FULLNAME",$fullname,$reject_user['body']);
					
					
					
					
					mail($email,$reject_user['subject'],$reject_user['body'],$headers);	
				}
			} 
			
		} 
		
		if($i=="0"){
			$this->session->set_flashdata('error', $message);
		} else {
			$this->session->set_flashdata('success', $message);
		}
		
		
		
		redirect('admin/verify_admin');		
	}
	public function admin_approve(){
		$this->load->helper('email');
	
		$veri_admin = $this->config->item('veri_admin');
		
		//mail()
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From: ".$veri_admin['email']."" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		
		$id=trim($this->input->get('id',true));
		$name=trim($this->input->get('name',true));
		$email=trim($this->input->get('email',true));
		$user_status=trim($this->input->get('status',true));
		$fullname=trim($this->input->get('fullname',true));
		
		if(valid_email($email)){
			
			$veri_admin['body']= str_replace("FULLNAME",$fullname,$veri_admin['body']);
			
			mail($email,$veri_admin['subject'],$veri_admin['body'],$headers);	
		}
		$i="0";
		$message = "Error:: ".$name." is not ".$user_status.", please try again";
		if(is_numeric($id)){
			$data = array(
			   'role' => 'admin',
			   'is_enable' => '1',
			   'updated_by' => DATE("Y-m-d H:i:s")
			);
			$result =$this->Adminmodel->admin_reject_approve($id,$data);
			if($result =="1") {
				$i++;
				$message = "Successful:: ".$name." is ".$user_status." by you...";
				
				//// mail will go to admin 
				
			} 
			
		} 
		if($i=="0"){
			$this->session->set_flashdata('error', $message);
		}else {
			$this->session->set_flashdata('success', $message);
		}
		
		redirect('admin/verify_admin');	
					
	}
	
}
