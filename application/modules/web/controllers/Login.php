<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
			
		 parent::__construct();
			$this->load->helper(array('form', 'url')); 
			$this->load->library('form_validation'); 
			$this->load->model('user_model');
			$this->load->model('Usermodel');
			/*
			echo '<pre>';
			var_dump($_SESSION);
			echo '</pre>';
			
			$user_session = $this->session->userdata('username');
			if((isset($user_session))&&(!empty($user_session))) {			
				//redirect("web/home");
				
				exit;				
			} */
		
	}

	public function index()
	{
		
		$data['error'] = $this->session->flashdata('error');
		//$this->load->view('header', $data);
		$this->load->view('login_view', $data);
		//$this->load->view('footer', $data);

	}
	function verifyOTP()
	{
		//echo date("Y-m-d H:i:s",strtotime("-5 minutes"));
	
		$email_id=trim($this->input->post('email',true));
		$otp=trim($this->input->post('otp',true));
	
	
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('otp', 'otp', 'required');
		
		
		$status_code="500";
		if ($this->form_validation->run() == FALSE){	
		//// set error 
			
			$data['statusCode']=0;
			$data['message']='empty values';	
			
		} else {	
			$status_code="200";			
			$data=$this->Usermodel->verifyOTP($email_id,$otp);
			
		}	
	$this->load->view('login_view',$data);
	} 
	
	public function login() {
		
		$username = trim($this->input->post("username",true));
		$password = trim($this->input->post("password",true));
				 
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		
		
		
		if ($this->form_validation->run() == FALSE){			
			$this->session->set_flashdata('error', 'Username or password invalid');
			//redirect();
			exit;			
		} else {		
			$where_array=array("username"=>$username,"password"=>md5($password));
			$this->db->select('user_id,is_enable,api_key');
			$this->db->where($where_array);
			$query = $this->db->get('user_details');		
			$result = $query->row();
			
			   if(isset($result->user_id)) {
			if($result->is_enable=="1") {
			
				$this->db->where('user_id', $result->user_id);
				$data['api_key']=$result->api_key;
				$data['statusCode']='1';
				$this->session->set_userdata('api_key', $result->api_key);			
				$this->session->set_userdata('user_id', $result->user_id);
					
				 $this->load->view('login_view',$data);
			
				
				
			} else {
				$data['statusCode']='2';
				$data['message']='Your account is yet to be verified';
				$this->load->view('login_view',$data);
			}
			} else {
				$data['statusCode']='0';
				$data['message']='Username or password invalid';
				//$this->session->set_flashdata('error',$result_data['message']) ;
			}
			
			 $this->load->view('login_view',$data);
			
			 			 
			
		}		
	}

	public function signup()
	{
		$password=trim($this->input->post('password',true));
		$email_id=trim($this->input->post('email',true));
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');	
		
		$primary_phone_number=$this->input->post('contact',true);
		$where_arr= array('username'=>$email_id);  

		$this->db->select('*')
			->from('user_details')
           	->where($where_arr);
           	$get_username = $this->db->get();
        if($get_username->num_rows()==0)
       	{
           	$this->load->helper('string');
			$api_key=md5(uniqid($email_id, true));
			$otp=substr(rand(),0,4);
			$insertData = array(
			   'username' => $email_id ,
			   'email_id' => $email_id ,
			   'primary_phone_number' => $primary_phone_number,  
			   'user_type'=>'pending',
			   'is_enable'=>1,
			   'created_on'=>date('Y-m-d H:i:s'),
			   'created_by'=>'user',
			   'updated_on'=>date('Y-m-d H:i:s'),       
			   'password'=>md5($password),
			   'approved_on'=>date('Y-m-d H:i:s'),
			   'valid_through'=>date('Y-m-d H:i:s',strtotime('+10 years')),   
			   'updated_by'=>'user',
			   'api_key'=>$api_key,  
			   'OTP'=>$otp,
			   'OTP_timestamp'=>date('Y-m-d H:i:s'),
			   'OTP_confirmed'=>0
			);
			
				if($this->db->insert('user_details', $insertData))
				{
					$user_id=$this->db->insert_id();
					$eventCode=2;
					$mailType=1;
					
						$mailFlag=$this->Usermodel->sendMail($email_id,'User',$otp,$mailType);
						$data['statusCode']=3;
						$data['message']='User created successfully and OTP send on a mail';
						$data['email']=$email_id;			
						$eventCode=2;
						$updateFlag=$this->Usermodel->updateActivity($user_id,"",$eventCode);
						//$data['user_id']=$user_id;
				
				}
				else{
					$data['statusCode']=0;
					$data['message']='Data not inserted ';
				}
			}
		else{
				foreach ($get_username->result() as $row) {
				
				if($row->OTP_confirmed==1)
				{
				$data['statusCode']=0;    
				$data['message']='Username Already Exists ';
				}
				}
			}
			
			
		 $this->load->view('confirm_otp',$data);
	}
	function resendOTP()   
	{
	
		$email_id=trim($this->input->post('email',true));
		
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$status_code="500";
		if ($this->form_validation->run() == FALSE){	
		//// set error 
			
			$data['statusCode']=0;
			$data['message']='Check Email';	
		$this->load->view('forget_password',$data);	
		} else {
			$status_code="200";
			$data=$this->Usermodel->resendPassOTP($email_id);
		if($data['statusCode']==1)
		{
		$data['email']=$email_id;
		$this->load->view('set_password',$data);		
		}
		else{
		$this->load->view('forget_password',$data);		
		}
		}
	
	
	}
public function setnewpass()
{
	echo "123456";
	//echo date("Y-m-d H:i:s",strtotime("-5 minutes"));
	$password=trim($this->input->post('password',true));
	$email=trim($this->input->post('email',true));
	$otp=trim($this->input->post('otp',true));
		
	$this->form_validation->set_rules('password', 'password', 'required');
	$this->form_validation->set_rules('email', 'email', 'required|valid_email');
	$this->form_validation->set_rules('otp', 'otp', 'required');
	
	$status_code="500";
	if ($this->form_validation->run() == FALSE){	
	//// set error 
		
		$data['statusCode']=0;
		$data['message']='empty values';
		
	} else {
		$status_code="200";
		$data=$this->Usermodel->setNewPassOTP($email,$otp,$password); 
		if($data['statusCode']==1)
		{
		$data['email']=$email_id;
		$this->load->view('login_view',$data);		
		}
		else{
		$this->load->view('set_password',$data);		
		}
		}
		
	}
	
	
	


}
