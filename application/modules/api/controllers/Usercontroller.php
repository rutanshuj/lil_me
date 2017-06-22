<?php
require(APPPATH.'libraries/REST_Controller.php');
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
class UserController extends REST_controller {

	 function __construct()
    {
        parent::__construct();
      	$this->load->model('Usermodel');
		$this->load->Model('Rfqmodel');
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
    }
	function aaaaaa_get(){
		
		
		$this->load->library('email');
		$this->load->helper('string');
		$email_id ="pankaj.g@lastlocal.in";
		$firstname="dd";
		$otp="cc";
		  $config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.zoho.com',
  'smtp_port' => 465,
  'smtp_timeout' => 7,
  'smtp_user' => 'Orders@lilme.in ', // change it to yours
  'smtp_pass' => 'orders@ll123', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
	);

	$this->email->set_newline("\r\n");
	    $this->email->initialize($config);

      $message = "<p>Hello ".$firstname.",</p> <p> You are successfully registered with lil me.
					Kindly enter the OTP to verify your Email ID </p><p>Your OTP is: <b>".$otp."</b></p>
					<p>In case of any difficulties, contact us at email id : info@lilme.com</p><p>
					Thanks,</p>Best,<br>LIL-ME Team ";
	  $this->email->subject('Confirmation of LIL ME Sign Up');
	  
	 	//$this->email->from('infowhitecarbon@gmail.com', 'LIL ME');
     $this->email->from('Orders@lilme.in','lilme');
     // $this->email->from('LIL ME'); // change it to yours
      $this->email->to($email_id);// change it to yours
    
      $this->email->message($message);
	  $this->email->send();
	  print_r($this->email->print_debugger());
     echo "11111111";
   // exit;
       show_error($this->email->print_debugger());
	   
  
		
	}
	function userlogin_post()
	{

		$user_name=trim($this->input->post('user_name',true));
		$password=trim($this->input->post('password',true));
		$device_type=trim($this->input->post('device_type',true));
		$device_id=trim($this->input->post('device_id',true));
		
		
		$this->form_validation->set_rules('user_name', 'user_name', 'required');
		//$this->form_validation->set_rules('password', 'password', 'required');
		
		
			//echo $user_name."  ".$password;
		$status_code="500";
		if ($this->form_validation->run() == FALSE){		
			//// set error 
			
			$data['statusCode']=0;
			$data['message']='Some data is missing';	
			
		} else {
			$status_code="200";
			$data['statusCode']=1;
			$data=$this->Usermodel->loginSuccess($user_name,$password,$device_type,$device_id);
		}
		//print_r($data);
		$this->response($data,$status_code);
	}
	function update_address_post()
		{
			$names=array();
			$data['statusCode']=1;
			$data['message']='Please try again';
			$address_id=$this->input->post('address_id');
			$is_billing_address=0;
			$is_shipping_address=$this->input->post('is_shipping_address');
			if($is_shipping_address==0)
			{
				$is_billing_address=1;
			}
			
			if ($address_id!= '' || !empty($address_id))
			{		
			$update_data = array(
			'firstname'=>$this->input->post('firstname'),
			'lastname'=>$this->input->post('lastName'),
		    'phone_number'=>$this->input->post('phone_number'),
		    'city' => $this->input->post('city') ,
		    'state '=>$this->input->post('state'),
		    'address_value'=>$this->input->post('address_value'),
			'pincode'=>$this->input->post('pincode')
			);
			
				$this->db->where('address_id', $address_id);
				$this->db->update('user_address', $update_data);
				if($this->db->affected_rows()==1)
					{
				$data['statusCode']=1;
				$data['message']='Address Updated';
			}
			}
			else{
				
				
				
				/////////////
					if($is_shipping_address==0){
						$data_updatedd=array('is_billing_address'=>'0');
						
					} else {
						$data_updatedd=array('is_shipping_address'=>'0');
					}
					
					
					
					$this->db->where('user_id',$this->input->post('user_id'));
					
					$this->db->update('user_address',$data_updatedd);
					/////////////
				
				
				
			$insert_data = array(
			'user_id'=>$this->input->post('user_id'),
			'firstname'=>$this->input->post('firstname'),
			'lastname'=>$this->input->post('lastname'),
		    'phone_number'=>$this->input->post('phone_number'),
		    'city' => $this->input->post('city') ,
		    'state '=>$this->input->post('state'),
		    'address_value'=>$this->input->post('address_value'),
			'pincode'=>$this->input->post('pincode'),
			'is_billing_address'=>$is_billing_address,
			'is_shipping_address'=>$is_shipping_address);
			if($this->db->insert('user_address', $insert_data))
				{
					
				//$this->input->post('user_id')	
					
					
				$data['statusCode']=1;
				$data['message']='Address Added';
				}
			}
		echo json_encode($data);
		}
	function get_addresses_post()
	{
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$data=$this->Usermodel->get_addresses($user_id);
		
		echo json_encode($data);
	}
	function userLogout_post()
	{
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		//echo $user_id  ;
		
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		//$this->form_validation->set_rules('api_key', 'api_key', 'required');
		
			//echo $user_name."  ".$password;
		$status_code="500";
		if ($this->form_validation->run() == FALSE){		
			//// set error 
			
			$data['statusCode']=0;
			$data['message']='Some data is missing';	
			
		} else {
		
		
			$validUser=1;//$this->Usermodel->isValidUser($user_id,$api_key);
			
			if($validUser){
				$status_code="200";
				$data=$this->Usermodel->logoutSuccess($user_id);
			}
			else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}
		}
		//print_r($data);
		$this->response($data,$status_code);
	}

	function usersignup_post()
	{
		$password=trim($this->input->post('password',true));
		$user_name=trim($this->input->post('email',true));
		$primary_phone_number=$this->input->post('contact');
		$firstname=trim($this->input->post('firstname',true));
		$lastname=trim($this->input->post('lastname',true));
		$fb_id=trim($this->input->post('fb_id',true));
		$gmail_id=trim($this->input->post('gmail_id',true));
		$primary_phone_number=$this->input->post('contact',true);
		$device_type=trim($this->input->post('device_type',true));
		$device_id=trim($this->input->post('device_id',true));
		$email_id=trim($this->input->post('email',true));

		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('user_name', 'user_name', 'required');

		//$this->form_validation->set_rules('lastname', 'lastname', 'required');
		//$this->form_validation->set_rules('firstname', 'firstname', 'required');
		
		$this->form_validation->set_rules('device_type', 'device_type', 'required');
		$this->form_validation->set_rules('device_id', 'device_id', 'required');
	
		$this->load->Model('Usermodel');
		if($fb_id!='')
		{
			
			$this->db->select('*')->from('user_details')->where('email_id',$email_id);
			$getuser=$this->db->get();
			$rows =$getuser->num_rows();
			
			$fb_id_rows =$this->Usermodel->isreturningUser($fb_id,NULL);
			
			if($rows>0)
			{
				
				if($email_id!=""){
				
					$this->db->select('*')
					->from('user_details')
					->where('email_id',$email_id);
					$getuser1=$this->db->get();
					$result =$getuser1->row();
					
				}	else {
					$this->db->select('*')
					->from('user_details')
					->where('fb_id',$fb_id);
					$getuser1=$this->db->get();
					$result =$getuser1->row();
				}
				if($firstname==""){
					$firstname=$result->firstname;
				}
				if($lastname==""){
					$lastname=$result->lastname;
				}
				
				if($device_type==""){
					$device_type=$result->device_type;
				}
				if($device_id==""){
					$device_id=$result->device_id;
				}
				if($user_name==""){
					$user_name=$result->username;
				}
				if($password==""){
					$password=$result->password;
				}
	
		
	
		
				$data=$this->Usermodel->updateSignUpData($fb_id,NULL,$firstname,$lastname,$email_id,$device_type,
					$device_id,$user_name,$password);
				
					
			
			}
			else{
				
				
			$data=$this->Usermodel->signupSuccess($user_name,$password,$firstname,$lastname,$email_id,
			$primary_phone_number,$device_id,$device_type,$fb_id,$gmail_id);
			}

		}
		else if($gmail_id!='')
		{  
	
	
	
	$this->db->select('*')->from('user_details')->where('email_id',$email_id);
			$getuser=$this->db->get();
			$rows =$getuser->num_rows();
			
			$fb_id_rows =$this->Usermodel->isreturningUser($gmail_id,NULL);
			
			if($rows>0){
	
	
	
	
	
	
	
	
	
			//if($this->Usermodel->isreturningUser(NULL,$gmail_id)==1)
			//{
				
				if($email_id!=""){
				
					$this->db->select('*')
					->from('user_details')
					->where('email_id',$email_id);
					$getuser1=$this->db->get();
					$result =$getuser1->row();
				}	else {
					$this->db->select('*')
					->from('user_details')
					->where('gmail_id',$gmail_id);
					$getuser1=$this->db->get();
					$result =$getuser1->row();
				}
		
		if($firstname==""){
			$firstname=$result->firstname;
		}
		if($lastname==""){
			$lastname=$result->lastname;
		}

		if($device_type==""){
			$device_type=$result->device_type;
		}
		if($device_id==""){
			$device_id=$result->device_id;
		}
		if($user_name==""){
			$user_name=$result->username;
		}
		if($password==""){
			$password=$result->password;
		}
				
				
				
				$data=$this->Usermodel->updateSignUpData(NUll,$gmail_id,$firstname,
				$lastname,$email_id,$device_type,$device_id,$user_name,$password);
			}
			else{
			
			$data=$this->Usermodel->signupSuccess($user_name,$password,$firstname,$lastname,$email_id,
			$primary_phone_number,$device_id,$device_type,$fb_id,$gmail_id);
			}
		}
		else
		{
			$data=$this->Usermodel->signupSuccess($user_name,$password,$firstname,$lastname,$email_id,
			$primary_phone_number,$device_id,$device_type,$fb_id,$gmail_id);
		}
		//print_r($data);
		$this->response($data);
	}
	function verifyOTP_post()
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
	$this->response($data,$status_code);
} 

	function resendOTP_post()   
	{
		//echo date("Y-m-d H:i:s",strtotime("-5 minutes"));

		$email_id=trim($this->input->post('email',true));
		//$otp=$this->input->post('otp');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$status_code="500";
		if ($this->form_validation->run() == FALSE){	
		//// set error 
			
			$data['statusCode']=0;
			$data['message']='Empty Values';	
			
		} else {
			$status_code="200";
			$data=$this->Usermodel->resendOTP($email_id);
		}
		$this->response($data,$status_code);
	}
	function updateuser_post()
	{
		$user_id=trim($this->input->post('user_id',true));
		$firstname=trim($this->input->post('firstname',true));
		$lastname=trim($this->input->post('lastname',true));
		$api_key=trim($this->input->post('api_key',true));
		$old_password=trim($this->input->post('old_password',true));
		$new_password=trim($this->input->post('new_password',true));
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
		//echo $validUser;
	        if($validUser){
	        $data=$this->Usermodel->updateSettings($user_id,$firstname,$lastname,
	        				$new_password,$old_password);
	        }
	        else{
					$data['statusCode']=0; 
					$data['message']='Unauthorised Access';
				}
			$this->response($data);
	}
	function get_order_details_post()
	{
		$user_id=trim($this->input->post('user_id',true));
		$api_key=trim($this->input->post('api_key',true));
		$order_id=trim($this->input->post('order_id',true));
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
		
		//echo $validUser;
	        if($validUser){
				$acg= $this->Usermodel->get_order_details($order_id,$user_id);
				$this->response($acg);
	        }
	        else{
					$data['statusCode']=0; 
					$data['message']='Unauthorised Access';
					$this->response($data);
				}
			
	}

function updateDeviceToken_post()
{	$token_type='';
	
	$user_id=trim($this->input->post('user_id',true));
	
	$device_type=trim($this->input->post('device_type',true));
	$device_id=trim($this->input->post('device_id',true));
	
	$data=$this->Usermodel->updateUser($user_id,$device_type,$device_id);
	$this->response($data);
}



function forgetpassOTP_post()   
{
	//echo date("Y-m-d H:i:s",strtotime("-5 minutes"));

	$email=trim($this->input->post('email',true));
	//$otp=$this->input->post('otp');
	$this->form_validation->set_rules('email', 'email', 'required|valid_email');
	$status_code="500";
	if ($this->form_validation->run() == FALSE){	
	//// set error 
		
		$data['statusCode']=0;
		$data['message']='empty values';	
		
	} else {
		$status_code="200";
		$data=$this->Usermodel->resendPassOTP($email);
	}
	$this->response($data,$status_code);
}

function setnewpass_post()
{
	//echo date("Y-m-d H:i:s",strtotime("-5 minutes"));
	$password=trim($this->input->post('password',true));
	$email=trim($this->input->post('email',true));
	$otp=trim($this->input->post('otp',true));
	//echo $email."".$otp."".$password;
	
	
	
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
	}
	
	
	$this->response($data,$status_code);
}

function sendRFQ_post()
	{
		$user_id=trim($this->input->post('user_id',true));
		$api_key=trim($this->input->post('api_key',true));
		$request_date=trim($this->input->post('request_date',true));		
		$products=$this->input->post('products');
		
		
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('api_key', 'api_key', 'required');
		
		$status_code="500";
		if ($this->form_validation->run() == FALSE){	
		//// set error 
			
			$data['statusCode']=0;
			$data['message']='Unauthorised Access';	
			
		} else {			
			//$products=json_decode($products);
			$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
			if($validUser){
				$status_code="200";
				$data=$this->Rfqmodel->RFQRequest($user_id,$products,$request_date); 
			}
			else{
				
				$data_message= $this->Usermodel->isValidUser_veryfy($user_id,$api_key);
				if($data_message=="2"){
				
					$data['statusCode']=0;
					$data['message']='Unauthorised Access';
				} else
				if($data_message!="1"){
					$data['message']=$data_message;
					$data['statusCode']=0;
				
				} else {
				
					$data['statusCode']=0;
					$data['message']='Unauthorised Access';
				}
			
				//$data['statusCode']=0;
				//$data['message']='Unauthorised Access';
			}
		}
		$this->response($data,$status_code);
	}
function requestOutOnMemo_post()
	{
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$request_date=$this->input->post('request_date');
		$this->load->Model('Usermodel');
		$this->load->Model('Rfqmodel');
		$products=$this->input->post('products');
		$products=json_decode($products);
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
        if($validUser){
		$data=$this->Rfqmodel->outOnMemoRequest($user_id,$products,$request_date); 
		}
		else{
			$data['statusCode']=0;
			$data['message']='Unauthorised Access';
		}
	
	$this->response($data);
	}   
	
	function getnews_get()   
	{  
		$this->load->Model('Usermodel');
		$data=$this->Usermodel->getMarketnews();
		$this->response($data);
	}	
function set_billing_address_post()
	{
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$address_id=$this->input->post('address_id');
		
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('address_id', 'address_id', 'required');
		

		if ($this->form_validation->run() == FALSE){	
				
			$data['statusCode']=0;
			$data['message']='empty values';	
			
		}
		else{
		
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
			if($validUser){
					
				$whereArr=array('user_id'=>$user_id,'address_id'=>$address_id);
				$this->db->select('address_id')
					->from('user_address')
					->where('user_id',$user_id);
				$query = $this->db->get();
				if($query->num_rows()!=0)
				{
				foreach($query->result() as $addr_row){
				$update_data[]= array(	
				'address_id'=>$addr_row->address_id,
				'is_billing_address'=>0,
				);
				}
				
				$this->db->update_batch('user_address',$update_data, 'address_id','user_id');   
				$this->db->select('address_id')
					->from('user_address')
					->where($whereArr);
				$query_getid = $this->db->get();
				$row=$query_getid->row();
				
				$updateData=array(
				'is_billing_address'=>1
				);
					$this->db->where('address_id', $row->address_id);
					$this->db->update('user_address', $updateData);
					if($this->db->affected_rows()==1)
					{
					$data['statusCode']=1;
					$data['message']='Success';	
					}
					else{
					$data['statusCode']=0;
					$data['message']='Error Occured';		
					}
				}
				else{
				$data['statusCode']=0;
				$data['message']='No record found';	
				}		
					
			}
			else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}	
		}
		echo json_encode($data);
	}
	function set_shipping_address_post()
	{
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$address_id=$this->input->post('address_id');
		$update_data=array();
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('address_id', 'address_id', 'required');
		
		
		$status_code="500";
		if ($this->form_validation->run() == FALSE){	
				
			$data['statusCode']=0;
			$data['message']='empty values';	
			
		}
		else{
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
			if($validUser){
				$whereArr=array('user_id'=>$user_id,'address_id'=>$address_id);
				$this->db->select('address_id')
					->from('user_address')
					->where('user_id',$user_id);
				$query = $this->db->get();
				if($query->num_rows()!=0)
				{
				foreach($query->result() as $addr_row){
				$update_data[]= array(	
				'address_id'=>$addr_row->address_id,
				'is_shipping_address'=>0,
				);
				}
				
				$this->db->update_batch('user_address',$update_data, 'address_id','user_id');   
				$this->db->select('address_id')
					->from('user_address')
					->where($whereArr);
				$query_getid = $this->db->get();
				$row=$query_getid->row();
				$updateData=array(
				'is_shipping_address'=>1
				);
					$this->db->where('address_id', $row->address_id);
					$this->db->update('user_address', $updateData);
					if($this->db->affected_rows()==1)
					{
					$data['statusCode']=1;
					$data['message']='Success';	
					}
					else{
					$data['statusCode']=0;
					$data['message']='Error Occured';		
					}
				}
				else{
				$data['statusCode']=0;
				$data['message']='No record found';	
				}
			}
			else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}	
		}
		echo json_encode($data);
	}
	function get_order_review_post()
	{
		
	$user_id=$this->input->post('user_id');
	$api_key=$this->input->post('api_key');	 
	
	$data=$this->Usermodel->get_order_data($user_id,$api_key);
	echo json_encode($data);
	}
	function get_order_review_get()
	{
		
	$user_id=$this->input->post('user_id');
	$api_key=$this->input->post('api_key');	
	$data=$this->Usermodel->get_order_data($user_id,$api_key);
	}
	function order_history_post()
	{
	$user_id=$this->input->post('user_id');
	$api_key=$this->input->post('api_key');	
	$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
	if($validUser){
	$data=$this->Usermodel->get_order_history($user_id,$api_key);	
	}else{
		
		$data_message= $this->Usermodel->isValidUser_veryfy($user_id,$api_key);
			if($data_message=="2"){
			
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			} else
			if($data_message!="1"){
				$data['message']=$data_message;
				$data['statusCode']=0;
			
			} else {
			
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}
			
		
		//$data['statusCode']=0;
		//$data['message']='Unauthorised Access';
	}
	echo json_encode($data);
	
	}	
}
?>      