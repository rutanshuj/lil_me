<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verify_user extends Admin_Controller {
	public $page='verify_user';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('User_model');
		$this->load->Model('Master_model');
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		
	}
	public function user_updated(){
		
		
		$date = trim($this->input->post('date',true));
		$user_type = trim($this->input->post('user_type',true));
		$user_id = trim($this->input->post('user_id',true));
		$updated_username = trim($this->input->post('username',true));
		$fullname = trim($this->input->post('fullname',true));
		
		
		$data['username'] = $this->session->userdata('username');
		
		$this->load->helper('email');
	
		$update_user = $this->config->item('update_user');		
		
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From: ".$update_user['email']."" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		$email=trim($this->input->post('email',true));
		
		
		
		
		
		if(isset($date) && isset($user_id) && isset($user_type)){
			$data_update = array(
               'valid_through' => $date,               
               'user_type' => $user_type,               
               'updated_on' => date("Y-m-d H:i:s"),
               'updated_by' => $data['username']
            );
			$this->db->where('user_id', $user_id);
			$this->db->update('user_details', $data_update); 
			
			 
			
			
			$this->session->set_userdata('success', $updated_username.' has been successfully updated');
			if(valid_email($email)){
				$update_user['body']= str_replace("FULLNAME",$fullname,$update_user['body']);
				
				mail($email,$update_user['subject'],$update_user['body'],$headers);	
			}
		}
		
		$result['result']="successfully updated";		
		echo json_encode($result);	
		
		
	}
	public function index() {	


	
		//$this->User_model->user_status_update();
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		
		$success_m =$this->session->userdata('success');
		$error_m =$this->session->userdata('error');
		
		
		if(isset($success_m)&&($success_m !="")){
			$data['success']=$success_m;			
			$this->session->unset_userdata('success');
		}		
        if(isset($error_m)&&($error_m !="")){
			$data['error']=$error_m;			
			$this->session->unset_userdata('error');
		}
		$data['master_user_type']=$this->Master_model->user_type();
	
		
    	$data['active_user']=$this->User_model->user_details( '','1' ,'rejected');
		$data['total_active_user']=count($data['active_user']); ///a_u_datepicker_
		/* print_r($data['active_user']);exit;
		exit; */
		
    	//$data['pending_user']=$this->User_model->user_details( '','0' ,'pending');
		//$data['total_pending_user']=count($data['pending_user']); //// pen_datepicker_
		
		
		
    	//$data['disabled_user']=$this->User_model->user_details( '','' ,'rejected');
		$data['disabled_user']=$this->User_model->user_details( '','0' ,'pending');
		$data['total_disabled_user']=count($data['disabled_user']); //// dis_datepicker_
		
		
    	/*  echo "<pre>";
		print_r($data);	
		exit; 
		 */$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('verify_user_view', $data);
		$this->load->view('footer', $data);
		
					
	}

	public function user_disable(){
		$id=trim($this->input->get('id',true));
		$name=trim($this->input->get('name',true));
		$status=trim($this->input->get('status',true));
		$fullname=trim($this->input->get('fullname',true));
		$this->load->helper('email');
	
	
		if($status=="rejected"){
			$disble_user = $this->config->item('reject_app_user');
			$data['user_type']="rejected";
		} else {		
			$disble_user = $this->config->item('disble_user');	
			$data['user_type']="disabled";
			
		}
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From: ".$disble_user['email']."" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		
		
		
		
		
		$email=trim($this->input->get('email',true));
		
		$i="0";
		
		$message = "Error:: ".$name." is not ".$status.", please try again";
		if(is_numeric($id)){
			$data['is_enable']='0';
			$data['updated_on']=DATE("Y-m-d H:i:s");
			$data['updated_by']=$this->session->userdata('username');
			
			/* $data = array(			   
			   'is_enable' => '0',
			   'updated_on' => DATE("Y-m-d H:i:s"),
			   'updated_by' => $this->session->userdata('username')

			); */
			$result =$this->User_model->user_reject_approve($id,$data);
			if($result =="1") {
				$i++;
				$message = "Successful:: ".$name." has been ".$status;
				if(valid_email($email)){
					$disble_user['body']= str_replace("FULLNAME",$fullname,$disble_user['body']);
					
					mail($email,$disble_user['subject'],$disble_user['body'],$headers);	
				}
			} 
			
		} 
		if($i=="0"){
			$this->session->set_flashdata('error', $message);
		} else {
			$this->session->set_flashdata('success', $message);
		}
		redirect('admin/verify_user');	
	}
	
	public function user_enable(){
		$this->load->helper('email');
		//$id=trim($this->input->get('id',true));
		//$name=trim($this->input->get('name',true)); enable_user
		
		//$date=trim($this->input->post('date',true));
		//$user_type=trim($this->input->post('user_type',true));
		$id=trim($this->input->post('user_id',true));
		$name=trim($this->input->post('name',true));
		$fullname=trim($this->input->post('fullname',true));
		
		$enable_user = $this->config->item('enable_user');		
		
		
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From: ".$enable_user['email']."" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		
		
		$email=trim($this->input->post('email',true));
		
		
		
		
		$result_data=array();
		
		
		
		//if(DATE("Y-m-d H:i:s")>$date){
			
		//	$this->session->set_flashdata('error', "error:: Please select future date for ".$name." enable");
		//	$result_data['result']="error";	
		//} else {
		
		
		
		$message = "Error:: ".$name." is not enabled, please try again";
		if(is_numeric($id)){
			$data = array(			   
			   'is_enable' => '1',
			   'updated_on' => DATE("Y-m-d H:i:s"),
			   'updated_by' => $this->session->userdata('username')

			);
			
			$result =$this->User_model->user_reject_approve($id,$data);
			
			if($result =="1") {
				$message = "Successful:: ".$name." is enabled now";
				$this->session->set_userdata('success', $message);
				if(valid_email($email)){
					$enable_user['body']= str_replace("FULLNAME",$fullname,$enable_user['body']);
					
					//mail($email,$enable_user['subject'],$enable_user['body'],$headers);	
				}
			} 
			
		//} 
		$result_data['result']="successfully updated";		
			
		$this->session->set_flashdata('message', $message);
		}
		echo json_encode($result_data);
		
		//redirect('admin/verify_user');	
	}
	
	public function user_approve(){
				
		$date=trim($this->input->post('date',true));
		$user_type=trim($this->input->post('user_type',true));
		$name=trim($this->input->post('name',true));
		$user_id=trim($this->input->post('user_id',true));
		$fullname=trim($this->input->post('fullname',true));
		$email=trim($this->input->post('email',true));

		$username=$this->session->userdata('username');
	
		$otp_confirm =$this->User_model->otp_varification_check($user_id);
		if($otp_confirm=="0"){
			$this->session->set_userdata('error', 'Error:: '.$name.' OTP is not verified');
		}
		$result_data=array();
		$result_data['message']=$message = "Error:: ".$name." OTP is not verified";
		
		if(is_numeric($user_id)&& ($otp_confirm>'0')){
			$data = array(
			   'user_type' => $user_type,
			   'valid_through' => $date,
			   'is_enable' => '1',
			   'updated_on' => DATE("Y-m-d H:i:s"),
			   'updated_by' => $username,
				'approved_on' => DATE("Y-m-d H:i:s"),
			   'approved_by' => $username

			);
			$result =$this->User_model->user_reject_approve($user_id,$data);
			if($result =="1") {
				$message = "Successful: ".$name." has been successfully approve";
				$result_data['result']="successfully updated";
				$this->session->set_userdata('success', $message);
				$this->load->helper('email');
	
				$verify_user = $this->config->item('verify_user');
								
				
				
				
				$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From: ".$verify_user['email']."" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
				
				$this->session->set_userdata('success', $message);
				if(valid_email($email)){
					$verify_user['body']= str_replace("FULLNAME",$fullname,$verify_user['body']);
					mail($email,$verify_user['subject'],$verify_user['body'],$headers);	
				}
				
			} 
			
		} 
		$this->session->set_flashdata('message', $message);
		//redirect('admin/verify_user');	
		echo json_encode($result_data);
	}
	
	/////// need modification
	public function admin_reject(){		
		$id=trim($this->input->get('id',true));
		$name=trim($this->input->get('name',true));
		$i="0";
		$message = "Error:: ".$name." is not rejected, please try again";
		if(is_numeric($id)){
			$data = array(
			   'role' => 'rejected',
			   'is_enable' => '0',
			   'updated_by' => DATE("Y-m-d H:i:s")
			);
			$result =$this->Adminmodel->admin_reject_approve($id,$data);
			if($result =="1") {
				$i++;
				$message = "Successful: ".$name." is rejected";
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

		$id=trim($this->input->get('id',true));
		$name=trim($this->input->get('name',true));
		$message = "Error: ".$name." is not verified, please try again";
		$i++;
		if(is_numeric($id)){
			$data = array(
			   'role' => 'admin',
			   'is_enable' => '1',
			   'updated_by' => DATE("Y-m-d H:i:s")
			);
			$result =$this->Adminmodel->admin_reject_approve($id,$data);
			if($result =="1") {
				$i++;
				$message = "Successful: ".$name." is verified by you...";
			} 
			
		} 
		if($i=="0"){			
			$this->session->set_flashdata('error', $message);
		} else {
			$this->session->set_flashdata('success', $message);
		}
		redirect('admin/verify_admin');		
	}
	
}
