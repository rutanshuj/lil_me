<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email 
class Admin_account_settings extends Admin_Controller {
	public $page='admin_account_settings';
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
		// $this->load->library('form_validation', array('CI' => $this)); 
		
	}
	
	
	
	public function password_modify(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		
		
		
		
		
		
		$data['user_details']=$this->User_model->userdetails($id);
	
		if($this->input->post('submit',true)){
			
			$data['oldpassword'] = trim($this->input->post('oldpassword',true));
			$data['password'] = trim($this->input->post('password',true));
			$data['repassword'] = trim($this->input->post('repassword',true));
			
			
			$this->form_validation->set_rules('oldpassword', 'Current Password', 'required');
			$this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
			$this->form_validation->set_rules('repassword', 'Retype Password', 'required|matches[password]');
			
			if ($this->form_validation->run() == True){
				$result = $this->User_model->password_change($id,$data['oldpassword'],$data['password'],$data['username']);				
				if($result=="0"){
					$data['error']="Error: Current password does not matched.";
				} else {
					$data['success'] ="Success: Password successfully changed";
				}
			} 
			
			
			
		}
    	
  /*   echo "<pre>";	
       print_r($data);exit; */
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('admin_password_modify_view', $data);
		$this->load->view('footer', $data);
	}
	
	public function email_id_check($email)
	{
		if ($email) {
			$id = $this->session->userdata('id');
			$total_num =$this->User_model->email_validate($id,$email);
			if($total_num!="0"){
				$this->form_validation->set_message('email_id_check', 'Email Id already exit');
				return FALSE;
			} else {
				return TRUE;
			}	
			
		}else{
			return TRUE;
		}
	}
	
	public function email_validate($email){
		$id = $this->session->userdata('id');
		$total_num =$this->User_model->email_validate($id,$email);
		 if($total_num!="0"){
			$this->form_validation->set_message('email_id_check', 'email id already exists');
			return false;
		} else {
			return true;
		} 
		
	}
	
	public function edit(){
		
		
		
		$data['page'] = $this->page;
		$data['master_city'] = $this->Master_model->city();
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$user_details=$this->User_model->userdetails($id);
		
		$data['firstname']=$user_details->firstname;
		$data['lastname']=$user_details->lastname;
		$data['email_id']=$user_details->email_id;
		$data['primary_phone_number']=$user_details->primary_phone_number;
		$data['secondary_phone_number']=$user_details->secondary_phone_number;
		$data['city_id']=$user_details->city_id;
		$data['city_name']=$user_details->city_name;
		$data['username']=$user_details->username; 
		
		
		//$user_details->username = trim($this->input->post('username',true));
		
		
	
		if($this->input->post('submit',true)){
			$data['firstname'] = trim($this->input->post('firstname',true));
			$data['lastname'] = trim($this->input->post('lastname',true));
			$data['email_id'] = trim($this->input->post('email_id',true));
			$data['primary_phone_number'] = trim($this->input->post('primary_phone_number',true));
			$data['secondary_phone_number'] = trim($this->input->post('secondary_phone_number',true));
			$data['city_id'] = trim($this->input->post('city_id',true));
			/* foreach($data['master_city'] as $master_row){			
				if($master_row->id==$data['city_id']){
					$data['city_name'] =$data['city_name'];
				}
			} */// pare_email[' . $this->input->post('email') . ']')
			 
			
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			//$this->form_validation->set_rules('lastname', 'lastname', 'required');
			$this->form_validation->set_rules('email_id', 'Email Id', 'required|valid_email');
			$this->form_validation->set_rules('primary_phone_number', 'Primary Phone Number', 'required|numeric');
			$this->form_validation->set_rules('city_id', 'Your City', 'required');
			$total_num ="0";
			if(isset($data['email_id']) &&($data['email_id'] !="")) {	
//echo "12";			
			//echo	$total_num = $this->email_validate($data['email_id']);
				$total_num =$this->User_model->email_validate($id,$data['email_id']);
				//if($total_num!="0"){
				//	$this->form_validation->set_message('email_id', 'Email Id already exists');
					//return FALSE;
				//} 				
			}  
			//exit;
			//$total_num ="0";
			if($total_num!="0"){
				$data['message']="Email Id already exists";
			} else 
			if ($this->form_validation->run() == True){
				 	$data_array = array(				   			   
				   'firstname' => $data['firstname'],
				   'lastname' => $data['lastname'],
				   'email_id' => $data['email_id'],
				   'primary_phone_number' => $data['primary_phone_number'],
				   'secondary_phone_number' => $data['secondary_phone_number'],				  
				   'city' => $data['city_id'],			   
				   'updated_by' => $data['username']			   
				);
				/* echo $id;
				echo "<pre>";
				print_r($data_array); */
				
				$this->db->where('admin_id', $id);
				$this->db->update('admin_details', $data_array);
			
				
				
				$this->session->set_flashdata('message', 'Success: Your account details has been updated');
				$this->session->set_flashdata('success', 'Success: Your account details has been updated');
				$this->User_model->admin_details_update($data_array,$id); 
				$data['message'] = $this->session->flashdata('message');
				redirect('admin/admin_account_settings/edit');
			} 
			
			
			
		}
		
		
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
    	
    
		$data['city']="";
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('admin_account_edit_view', $data);
		$this->load->view('footer', $data);
		
	}
	public function index() {		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		
		
		
		
		$data['user_details']=$this->User_model->userdetails($id);
	
		
    	
  
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('admin_account_view', $data);
		$this->load->view('footer', $data);
		
					
	}

	public function user_disable(){
		$id=trim($this->input->get('id',true));
		$name=trim($this->input->get('name',true));
		$message = "Error:: ".$name." is not rejected, please try again";
		if(is_numeric($id)){
			$data = array(
			   'user_type' => 'rejected',
			   'is_enable' => '0',
			   'updated_on' => DATE("Y-m-d H:i:s"),
			   'updated_by' => $user_session

			);
			$result =$this->User_model->user_reject_approve($id,$data);
			if($result =="1") {
				$message = "Success: ".$name." is rejected";
			} 
			
		} 
		$this->session->set_flashdata('message', $message);
		redirect('admin/verify_user');	
	}
	
	
	
	
	

	
	
}
