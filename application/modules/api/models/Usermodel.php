<?php
//date_default_timezone_set('Asia/Kolkata');
class Usermodel extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
		$this->load->library('email');
		$this->load->helper('string');
    }
	function isValidUser_veryfy($user_id,$api_key)
	{
			$where_arr= array('user_id'=>$user_id,'api_key'=>$api_key);  
			$this->db->select('*')
			->from('user_details')
           	->where($where_arr);
           	$query = $this->db->get();
			//echo $query->num_rows();
			
			if($query->num_rows()!="0"){
				foreach ($query->result() as $row) {
					if($row->is_enable==0 and ($row->user_type)=='pending'){						
						
						return 'Your account is yet to be Verified';
					}	elseif($row->is_enable==0 and($row->user_type)=='disabled') {
						
						
						return 'Your Account Is Disable By Admin'; 
					} else {
						return 1;
					}
				}
			} else {
				return 2;
			}
			 
			
			
	}
	function loginSuccess($user_name,$password,$device_type,$device_id,$check=false)    
	{
		//echo;
		$device_type=trim($device_type);
		$cur_time=date('Y-m-d H:i:s');
		if($check=="0"){
			$where_arr= array('username'=>$user_name,'password'=>md5($password));
		}  else {
			$where_arr= array('username'=>$user_name,'password'=>$password);
		}
			$this->db->select('*')   
			->from('user_details')
           	->where($where_arr);
           	$user_id=0;
           	$user_name='';
           	$api_key=0;
           	$query = $this->db->get();
			//$data=$query->result();
			if($query->num_rows()==0)
			{
				$data['statusCode']=0;
				$data['message']='Login Failed';

			}
			else{
			foreach ($query->result() as $row) {
					$user_id=$row->user_id;
           			$api_key=$row->api_key;   
				if($row->is_enable==0 and ($row->user_type)=='pending')
				{
				$data['user_id']=$user_id;
				$data['api_key']=$api_key;
				$data['statusCode']=0;
				$data['message']='Your account is yet to be Verified';
				}
				elseif($row->is_enable==0 and($row->user_type)=='disabled')
				{
					$data['statusCode']=0;
					$data['message']='Your Account Is Disable By Admin'; 
				}
				else if(strtotime($cur_time) >= strtotime($row->valid_through))
					{
					$data['statusCode']=0;
					$data['message']='Your Account Is Expired';
					}	
				else if(($row->OTP_confirmed)==0)
					{
					$output=$this->resendOTP($row->email_id);
					if($output['statusCode']==1)
					{
					$data['statusCode']=2;
					$data['message']='OTP has been emailed to you. Kindly verify your Email ID';
					$data['user_id']=$row->user_id;
					$data['api_key']=$row->api_key;
					$data['name']=$row->firstname." ".$row->lastname;
					}
					}		
				else{
				$updateArr = array(
	               'device_type'=>$device_type
	            );
					if($device_type!='android')
					{
						$updateArr['device_id']=$device_id;
					}
					else{ 
						$updateArr['gcm_id']=$device_id;
					}
					
				//print_r($updateArr);
				//echo $row->user_id;
				$this->db->trans_start();
				$this->db->where('user_id', $row->user_id);
				$this->db->update('user_details', $updateArr);
				$this->db->trans_complete();
						if($this->db->trans_status() === FALSE)
						{
						$data['statusCode']=0;
						$data['message']='Error Occured';	
								
						}
						else{
						$eventCode=1;
						$updateFlag=$this->updateActivity($user_id,NULL,$eventCode);
						if($updateFlag['statusCode']){
						$data['statusCode']=1;
						$data['message']='Login Successful';
						$data['user_id']=$user_id;
						$data['api_key']=$api_key;
						$data['name']=$row->firstname." ".$row->lastname;
						}
				}
			}
			}
		 
			}
			return $data;
	
	}
	function logoutSuccess($user_id)
	{  
		
		$eventCode=7;
		$updateFlag=$this->updateActivity($user_id,NULL,$eventCode);
		if($updateFlag['statusCode']){
			$data['statusCode']=1;
			$data['message']='You have logged out successfully ';
		}
		else{
			$data['statusCode']=0;
			$data['message']='Error Occured ';
		}
		
		return $data;
	}
	function signupSuccess($user_name,$password,$firstname,$lastname,$email_id,
					$primary_phone_number,$device_id,$device_type,$fb_id,$gmail_id){
		$where_arr= array('username'=>$user_name);  

		$this->db->select('*')
			->from('user_details')
           	->where($where_arr);
           	$get_username = $this->db->get();
        if($get_username->num_rows()==0)
       	{
           	$this->load->helper('string');
			$api_key=md5(uniqid($user_name, true));
			$otp=substr(rand(),0,4);
			$insertData = array(
			   'username' => $user_name ,
			   'password' =>  md5($password),
			   'firstname' => $firstname ,
			   'lastname' => $lastname ,
			   'email_id' => $email_id ,
			   'primary_phone_number' => $primary_phone_number,  
			   'user_type'=>'pending',
			   'is_enable'=>1,
			   'created_on'=>date('Y-m-d H:i:s'),
			   'created_by'=>'user',
			   'updated_on'=>date('Y-m-d H:i:s'),       
			   'device_type'=>$device_type,
			   'approved_on'=>date('Y-m-d H:i:s'),
			   'valid_through'=>date('Y-m-d H:i:s',strtotime('+10 years')),   
			   'updated_by'=>'user',
			   'api_key'=>$api_key,  
			   'OTP'=>$otp,
			   'OTP_timestamp'=>date('Y-m-d H:i:s'),
			   'OTP_confirmed'=>0
			);
			if($device_type!='android')
					{
						$insertData['device_id']=$device_id;
					}
					else{ 
						$insertData['gcm_id']=$device_id;
					}
					if($fb_id!='')
					{
						$insertData['fb_id']=$fb_id;
						$insertData['OTP_confirmed']=1;
					}
					elseif($gmail_id!='')
					{
						$insertData['gmail_id']=$gmail_id;
						$insertData['OTP_confirmed']=1;
					}
				
				if($this->db->insert('user_details', $insertData))
				{
					$user_id=$this->db->insert_id();
					$eventCode=2;
					$mailType=1;
					if($fb_id ==''and $gmail_id=='')  
					{
						$mailFlag=$this->sendMail($email_id,$firstname,$otp,$mailType);
						$data['statusCode']=1;
						$data['message']='User created successfully and OTP send on a mail';
					}
					else{
						
						$data=$this->loginSuccess($user_name,$password,$device_type,$device_id);
					}
					
						$eventCode=2;
						$updateFlag=$this->updateActivity($user_id,"",$eventCode);
						//$data['user_id']=$user_id;
				
				}
				else{
					$data['statusCode']=0;
					$data['message']='Data not inserted ';
				}
			}
		else{
				foreach ($get_username->result() as $row) {
				if($row->OTP_confirmed==0)
				{
				$user_id=$row->user_id;
				$api_key=md5(uniqid($user_name, true));
				$otp=substr(rand(),0,4);
				$updateData = array(
			   'username' => $user_name ,
			   'password' =>   md5($password),
			   'firstname' => $firstname ,
			   'lastname' => $lastname ,
			   'email_id' => $email_id ,
			   'primary_phone_number' => $primary_phone_number,
			   'user_type'=>'pending',
			   'is_enable'=>1,
			   'valid_through'=>date('Y-m-d H:i:s',strtotime('+10 years')), 
			   'created_on'=>date('Y-m-d H:i:s'),
			   'created_by'=>'user',
			   'updated_on'=>date('Y-m-d H:i:s'),
			   'device_type'=>$device_type,
			   'updated_by'=>'user',
			   'api_key'=>$api_key,
			   'OTP'=>$otp,
			   'OTP_timestamp'=>date('Y-m-d H:i:s'),
			  
				);
				if($device_type!='android')
					{
						$updateData['device_id']=$device_id;
					}
					else{ 
						$updateData['gcm_id']=$device_id;
					}
					$this->db->where('user_id', $user_id);
					$this->db->update('user_details', $updateData);
					if($this->db->affected_rows()==1)
					{
					$mailType=1;
					if($fb_id ==''and $gmail_id=='')  
					{
						$mailFlag=$this->sendMail($email_id,$firstname,$otp,$mailType);
						$data['statusCode']=1;
						$data['message']='User created successfully and OTP send on a mail';
					}
					else{
						
						$data=$this->loginSuccess($user_name,$password,$device_type,$device_id);
					 }
					
					}
				}
				else if($row->OTP_confirmed==1)
				{
				$data['statusCode']=0;    
				$data['message']='Username Already Exists ';
				}
				}
			}
			
				return $data;
	}

	function updateActivity($user_id,$product_id='',$eventCode)
	{
			$prod_name='';
			$this->db->select('product_name')
			->from('product')
            ->where('product_id',$product_id);		
			$query = $this->db->get();
			foreach ($query->result() as $row) {
			$prod_name=$row->product_name;
			}
			
			switch ($eventCode) {
		    case 1:
		        $eventType='Login';
		        $comment=' user logged in';
		        break;
		    case 2:
		    	$eventType='Signup';
		        $comment='New User Signed Up';
		        break;
		    case 3:
		    	$eventType='order';
		        $comment='placed order for product'.$prod_name;
		        break;
		    case 4:
		    	$eventType='Add to Memo';
				
		       	$comment='user  Added product :['.$prod_name.'] To Memo';
		        break;
		    case 5:
		    	$eventType='favourites';
		       	$comment='Product ['.$prod_name.']Added to Favourites';
		        break;
		    case 6:
		    	$eventType='favourites';
		        $comment='Product ['.$prod_name.']Removed From Favourites';
		        break;
			case 7:
		    	$eventType='logout';
		        $comment=' User Logged Out';
		        break;
		    default:
		        
		        break;
			}
		$data = array('activity_time' => date('Y-m-d H:i:s'),  
						'user_id'=> $user_id,
						'product_name'=>$prod_name,
						'event_type'=>$eventType,
						'activity_comment'=>$comment);
		
		if($this->db->insert('user_activity_log', $data))
			{
				$data['statusCode']=1;
				$data['message']='Data inserted successfully';
			}
			else{
				$data['statusCode']=0;
				$data['message']='Data Not inserted ';
			}
			return $data;
	}
	function updateSettings($user_id,$firstname,$lastname,$new_password,$old_password)
	{
		//echo $old_password;
		$data=array();
		
		if(($new_password!="")&&($old_password!="")){
			$where_arr= array('password'=>md5($old_password),'user_id'=>$user_id);
			$this->db->select('*')
			->from('user_details')
           	->where($where_arr);
           
			$get_password = $this->db->get();
			$number =$get_password->num_rows();
		} else {
			$number ="1";
		}
		
		
        if($number>0)
       	{
			
			$updateData['updated_by'] ='user';
			$updateData['updated_on'] =date('Y-m-d H:i:s');
			if($lastname!=""){
				$updateData['lastname'] =$lastname;
			}
			if($firstname!=""){
				$updateData['firstname'] =$firstname;
			}
			
			if(($new_password!="")&&($old_password!="")){
				$updateData['password'] =md5($new_password);
			} 
       	$this->db->where('user_id', $user_id);
		$this->db->update('user_details', $updateData);
		if($this->db->affected_rows()==1)
			{
				$data['statusCode']=1;
				$data['message']='User updated successfully';
			}
       	}
       	else{
       		$data['statusCode']=0;
			$data['message']='Wrong Password';
       	}
       	return $data;
	}

function isValidUser($user_id,$api_key)
	{
			$where_arr= array('user_id'=>$user_id,'api_key'=>$api_key,'is_enable'=>1);  
			$this->db->select('*')
			->from('user_details')
           	->where($where_arr);
           	$query = $this->db->get();
			//echo $query->num_rows();
           	if($query->num_rows()==0)
			{
				return 0;
			}  
			else{
			//echo "jkasdhjks";
				return 1;

			}
	}
	
	function get_addresses($user_id)
	{
		$this->db->select('*'); 
		$this->db->where('user_address.user_id',$user_id);
		$this->db->from('user_address');
		$query = $this->db->get();
		 if($query->num_rows()==0)
		{
			$json =array('message' => 'No Address available', 'statusCode'=>0);
		}
		else{
		$data=$query->result() ;
		$json = array('message' => 'success', 'statusCode'=>1,'data' => $data);	
		}
		return $json;
	}
function resendOTP($email_id)
	{ 
		$otp=substr(rand(),0,4);
		$this->db->select('*')
			->from('user_details')
           	->where('username',$email_id);
           	//array_shift($data);
        $query = $this->db->get();
        if($query->num_rows()==0)
			{
				$data['statusCode']=0;
				$data['message']='Wrong Email ID ';
			}
			else{
			foreach ($query->result() as $row) {  
			//print_r($row);
			if($row->OTP_confirmed !=1)
				{
					$dataArr = array(
	               'OTP' => $otp,
	               'OTP_timestamp' =>date('Y-m-d H:i:s'),
	               'OTP_confirmed'=>0
	            );
	            $this->db->where('user_id', $row->user_id);
				$this->db->update('user_details', $dataArr);
				if($this->db->affected_rows()==1)
						{
						$mailType=1;
						$mailFlag=$this-> sendMail($email_id,'',$otp,$mailType);
						if($mailFlag)
						{
						//$data['user_id']=$user_id;
						$data['statusCode']=1;
						$data['message']='OTP is sent to your email';	
						}
				
					}
				}
				else{
					$data['statusCode']=0;
					$data['message']='You are verified already';
				}
			}  
			
		 }
		 return $data; 
	}
function resendPassOTP($email_id)
	{ 
		//echo $email_id;
		//$data[]='';
		$otp=substr(rand(),0,4);
		$this->db->select('*')
			->from('user_details')
           	->where('username',$email_id);  
           //	array_shift($data);
        $query = $this->db->get();
        if($query->num_rows()==0)
			{
				$data['statusCode']=0;
				$data['message']='Wrong Email ID ';
			}
			else{
			foreach ($query->result() as $row) {
			//print_r($row);
			
					$dataArr = array(
	               'OTP' => $otp,
	               'OTP_timestamp' => date('Y-m-d H:i:s'),
	               'OTP_confirmed'=>0
	            );
	            $this->db->where('user_id', $row->user_id);
				$this->db->update('user_details', $dataArr);
				if($this->db->affected_rows()==1)
						{
						$mailType=0;
						$mailFlag=$this-> sendMail($email_id,'',$otp,$mailType);
						if($mailFlag)
						{
						//$data['user_id']=$user_id;
						$data['statusCode']=1;
						$data['message']='OTP is sent to your email';	
						}
						}
				
					
				}
			}  
			return $data; 
		 }	 
		
	function verifyOTP($email_id,$otp)
{			$where_arr= array('username'=>$email_id);
			$this->db->select('*,DATE_ADD(OTP_timestamp,INTERVAL 10 minute) as OTP_timestamp')
			->from('user_details')
           	->where($where_arr);

           	$query = $this->db->get();
			//$data=$query->result();
			if($query->num_rows()==0)
			{
			$data['statusCode']=0;
			$data['message']='Wrong Email';

			}
			else{
				foreach ($query->result() as $row) {
				$cur_time=date("Y-m-d H:i:s");
				if($row->OTP_confirmed==1)
				{
					$data['statusCode']=0;
					$data['message']='Your email has been verified already';
				}
				else{  
				
				if($otp==$row->OTP)
				{
				
					if(strtotime($cur_time) >=strtotime($row->OTP_timestamp))
					{
					$data['statusCode']=0;
					$data['message']='OTP Expired !! Request New OTP';
					}
					else{
					$updateData = array('OTP_confirmed' => 1 );
				   
					$this->db->where('user_id', $row->user_id);
					$this->db->update('user_details', $updateData);					
					if($this->db->affected_rows()==1)
					{
					$adminMailFlag=$this->sendMailTOAdmin($row->username,$row->firstname,$row->lastname,$row->email_id,
					NULL,$row->primary_phone_number);
					if($adminMailFlag)
					{
						$data['name']=$row->firstname." ".$row->lastname;
					$data['statusCode']=1;
					$data['message']='Your email has been verified';	
					$data['user_id']=$row->user_id;
					$data['api_key']=$row->api_key;
					}
					}
				}
				}
				else{
					$data['statusCode']=0;
					$data['message']='Wrong OTP';
					}
				}
			}
		}
	return $data;
	}

function updateUser($user_id,$device_type,$device_id)
	{
		$dataArr = array(
             
               'device_type' => $device_type,
               'device_id' => $device_id
            ); 

		$this->db->where('user_id', $user_id);
		$this->db->update('user_details', $dataArr);
		$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE)
			{
				$data['statusCode']=0;
				$data['message']='Update failed ';
			   
			}
			else{


				 $data['statusCode']=1;
				$data['message']='Device Updated successfully ';
			}
		return $data;
	}
	
//////////
function sendMail1234($email_id,$firstname,$otp,$mailType)
	{

	
    $config = Array(
  //'protocol' => 'smtp',
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
	 if($mailType==1)
    {
      $message = "<p>Hello ".$firstname.",</p> <p> You are successfully registered with lil me.
					Kindly enter the OTP to verify your Email ID </p><p>Your OTP is: <b>".$otp."</b></p>
					<p>In case of any difficulties, contact us at info@lilme.com</p><p>
					Thanks,</p>Best Regards,<br><br>Li'l Me Team ";
	  $this->email->subject('Confirmation of LIL ME Sign Up');
	  }
	  elseif($mailType==0)
	  {
	  	$message = "<p>Hello ".$firstname.",</p> <p> Kindly Enter Following OTP To Reset The Password 
	  	</p><p>In case of any difficulties, contact us at info@lilme.com</p><p>
					Thanks,</p><p>Li'l Me Team </p><p>Your OTP is: <b>".$otp."</b></p><br>";
	  $this->email->subject('Password Recovery');
	  }
    
      $this->email->from('Orders@lilme.in','lilme'); // change it to yours
      $this->email->to($email_id);// change it to yours
    
      $this->email->message($message);
	 // echo $this->email->print_debugger();
      if($this->email->send())
     {  
 
      return 1;
     }  
     else
    {
        return 1;
	   //show_error($this->email->print_debugger());
      //return 0;
    }

	}
///////////
function sendMail($email_id,$firstname,$otp,$mailType)
	{

	
    $config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.zoho.com',
  'smtp_port' => 465,
  'smtp_timeout' => 7,
  'smtp_user' => 'Orders@lilme.in', // change it to yours
  'smtp_pass' => 'orders@ll123', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
	);
	
	   $this->email->set_newline("\r\n");
	    $this->email->initialize($config);
	 if($mailType===1)
    {
      $message = "<p>Hello ".$firstname.",</p> <p> You are successfully registered with lil me.
					Kindly enter the OTP to verify your Email ID </p><p>Your OTP is: <b>".$otp."</b></p>
					<p>In case of any difficulties, contact us at info@lilme.com</p><p>
					Thanks,</p>Best Regards,<br><br>Li'l Me Team ";
	  $this->email->subject('Confirmation of LIL ME Sign Up');
	  }
	  elseif($mailType==0)
	  {
	  	$message = "<p>Hello ".$firstname.",</p> <p> Kindly Enter Following OTP To Reset The Password 
	  	</p><p>In case of any difficulties, contact us at info@lilme.com</p><p>
					Thanks,</p><p>Team LIL ME </p><p>Your OTP is: <b>".$otp."</b></p><br>";
	  $this->email->subject('Password Recovery');
	  }
    
      //$this->email->from('LIL ME'); // change it to yours
      $this->email->from('Orders@lilme.in', 'LIL ME'); // change it to yours
      $this->email->to($email_id);// change it to yours
    
      $this->email->message($message);
	 // echo $this->email->print_debugger();
      if($this->email->send())
     {  
 
      return 1;
     }  
     else
    {
        return 1;
	   //show_error($this->email->print_debugger());
      //return 0;
    }

	}
	

function sendMailTOAdmin($user_name,$firstname,$lastname,$email,$company_name,
						  $primary_phone_number)
	{
		//echo $user_name;
		$email_id='';
		$this->db->select('*')
			->from('admin_details')
           	->where('username','admin');
           	$query = $this->db->get();
           	if($query->num_rows()!=0)
           	{
           		foreach ($query->result() as $row) {
           			$email_id=$row->email_id;   
           		}
           	}
       //	echo $email_id."jkhdsk";
	//$email=$this->input->post('email');
    $config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.zoho.com',
  'smtp_port' => 465,
  'smtp_user' => 'Orders@lilme.in', // change it to yours
  'smtp_pass' => 'orders@ll123', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE

  
	);

      $message = "<p>Dear Admin,</p> <h3>Congratulations Admin New User Signed Up!</h3>
     		<p> Following are the User Details </p>     
         
			User Name :".$firstname." ".$lastname."<br>
			Email_id :".$email."<br>";
			if(isset($company_name))
			{
				$message.="Company Name :".$company_name."<br>";
			}
            if(isset($primary_phone_number))
			{
				$message.="Phone Number :".$primary_phone_number."<br>";
			}
          
      $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
	  $this->email->initialize($config);
	   $this->email->from('Orders@lilme.in', 'LIL ME'); // change it to yours
     
      $this->email->to($email_id);// change it to yours
      $this->email->subject('New Sign Up');
      $this->email->message($message);
      if($this->email->send())
     {  
      return 1;
     }
     else  
    {return 1;
      // show_error($this->email->print_debugger());
      //return 0;
    }

}

function setNewPassOTP($email_id,$otp,$password)
{			$where_arr= array('username'=>$email_id);
			$this->db->select('user_id,OTP,OTP_confirmed,DATE_ADD(OTP_timestamp,INTERVAL 10 minute) as OTP_timestamp')
			->from('user_details')
           	->where($where_arr);

           	$query = $this->db->get();
			//$data=$query->result();
			if($query->num_rows()==0)
			{
			$data['statusCode']=0;  
			$data['message']='Wrong Email';

			}
			else{
				foreach ($query->result() as $row) {
				$cur_time=date("Y-m-d H:i:s");
				if($otp==$row->OTP)
				{
				
					if(strtotime($cur_time) >=strtotime($row->OTP_timestamp))
					{
					$data['statusCode']=0;
					$data['message']='OTP Expired !! Request New OTP';
					}
					else{
					$updateData = array('OTP_confirmed' => 1,'password'=>md5($password));
				   
					$this->db->where('user_id', $row->user_id);
					$this->db->update('user_details', $updateData);					
					if($this->db->affected_rows()==1)
					{
					$data['statusCode']=1;
					$data['message']='New password has been set';	
					}
					}
				}
				else{
					$data['statusCode']=0;
					$data['message']='Wrong OTP';
					}
				
			}
		}
	return $data;
	}

function isreturningUser($fb_id=false,$gmail_id=false)
{
	if(isset($fb_id))
	{
		//echo "fb";
		$this->db->select('*')
		->from('user_details')
        ->where('fb_id',$fb_id);
        $getuser=$this->db->get();
	}
	elseif(isset($gmail_id))
	{
		//echo "gmil";
		$this->db->select('*')
		->from('user_details')
        ->where('gmail_id',$gmail_id);
        $getuser=$this->db->get();
	}
	$row=$getuser->row();
	//print_r($row)
	
		if($getuser->num_rows()==0)
		{
			return 0;
		}
		else
		{
			return 1;
		}
}
function getMarketnews()
	{
		$output=array();
		
		
		$this->db->select('headline,details')
		->from('market_news')
		->order_by("updated_on", "desc");
		
		$query = $this->db->get();
		$data=$query->result();
		
		foreach ($query->result() as $row) {
		$output[]=$row;
		}
		if(count($data)>0)
		{
		$json=array('message' => 'success', 'statusCode'=>1,'data'=>$output);
		}else
		{
		$json=array('message' => 'No data available', 'statusCode'=>0);
		}
		return $json;
	}
function updateSignUpData($fb_id=false,$gmail_id=false,$firstname,$lastname,
						$email_id=false,$device_type,$device_id,$user_name,$password)
{	//echo $user_name."djksk";
	$otp=substr(rand(),0,4);
	$check="0";
	
	if(isset($fb_id)&&isset($email_id)){
	
		
		$check++;
		$this->db->where('email_id', $email_id);
		$updateData['fb_id']=$fb_id;
	} 
	else  
	if(isset($email_id)&&isset($gmail_id)){
		$check++;
		$this->db->where('email_id', $email_id);
			$updateData['gmail_id']=$gmail_id;
	} else
	if(isset($fb_id))
	{
		 $this->db->where('fb_id', $fb_id);
	} else
	if(isset($gmail_id))
	{
		 $this->db->where('gmail_id', $gmail_id);
	}
	
	if($check=="1"){
		$updateData['firstname']=$firstname;
		$updateData['lastname']=$lastname;
		$updateData['is_enable']=1;
		$updateData['updated_on']=date('Y-m-d H:i:s');
		$updateData['device_type']=$device_type;
		$updateData['updated_by']='user';
		
	/* 	$updateData = array(
			   
			   'firstname' => $firstname ,
			   'lastname' => $lastname ,			   
			   'is_enable'=>1,
			   'updated_on'=>date('Y-m-d H:i:s'),
			   'device_type'=>$device_type,
			   'updated_by'=>'user',
			   
			   ); */
	} else {
		$updateData = array(
			   'email_id '=>$email_id,
			   'username' => $email_id ,
			   'firstname' => $firstname ,
			   'lastname' => $lastname ,			   
			   'is_enable'=>1,
			   'updated_on'=>date('Y-m-d H:i:s'),
			   'device_type'=>$device_type,
			   'updated_by'=>'user',
			   
			   );
	}
				
			   if($device_type!='android')
					{
						$updateData['device_id']=$device_id;
					}
					else{ 
						$updateData['gcm_id']=$device_id;
					}
				$this->db->update('user_details', $updateData);
				
				if($this->db->affected_rows()==1)
				{
					$data=$this->loginSuccess($user_name,$password,$device_type,$device_id,$check);
					/*$mailType=1;
					$mailFlag=$this-> sendMail($email_id,$firstname,$otp,$mailType);
					if($mailFlag)
					{
						//$data['user_id']=$user_id;
						$data['statusCode']=1;
						$data['message']='User created successfully and OTP has been emailed to you ';
					}*/
				}
				else{
					$data['statusCode']=0;
					$data['message']='Update failed ';
				}
				return $data;

}
function get_order_data($user_id,$api_key)
{
	$pricing_details=array();
	$bill_obj=array();
	$ship_obj=array();
	$total_discount=$total_tax=$final_price="0";
	$this->db->select('*')
			 ->from('user_address')
			 ->where('is_shipping_address',1)
			 ->where('user_id',$user_id);
	$query_get_ship_addr = $this->db->get();
	if($query_get_ship_addr->num_rows()!=0)
	{
	$ship_addr=$query_get_ship_addr->row();	
	$ship_addr_arr['name']=$ship_addr->firstname." ".$ship_addr->lastname;
	$ship_addr_arr['address_firstline']=$ship_addr->address_value;
	$ship_addr_arr['address_secondline']=$ship_addr->city."-".$ship_addr->pincode;
	$ship_addr_arr['phone_number']=$ship_addr->phone_number;
	$ship_obj[]=(object)$ship_addr_arr;
	}
	
	
	$this->db->select('*')
			 ->from('user_address')
			 ->where('is_billing_address',1)
			 ->where('user_id',$user_id);
	$query_get_bill_addr = $this->db->get();
	if($query_get_bill_addr->num_rows()!=0)
	{
	$bill_addr=$query_get_bill_addr->row();
	//$bill_addr_arr[]=$bill_addr;
	$bill_addr_arr['name']=$bill_addr->firstname." ".$bill_addr->lastname;
	$bill_addr_arr['address_firstline']=$bill_addr->address_value;
	$bill_addr_arr['address_secondline']=$bill_addr->city."-".$bill_addr->pincode;
	$bill_addr_arr['phone_number']=$bill_addr->phone_number;
	$bill_obj[]=(object)$bill_addr_arr;
	
	}
	if(is_numeric($user_id)){
			$this->db->select('user_id');
			$this->db->from('user_details');
			$this->db->where('user_id',$user_id);
			$this->db->where('api_key',$api_key);
			$query = $this->db->get(); 
			
			if($query->num_rows()=="0"){
				$data['message']='Unauthorised Access';
			} else {
				//product_images.image_id as image_id,product_images.image_url as image_url,
				 //product_images.image_thumbnail_url as image_thumbnail_url,product_images.product_id as //product_images_product_id,
				
				
				
				 $this->db->select('
				 cart.id as id,cart.user_id as user_id,cart.product_id as product_id,cart.cart_status as cart_status,
				 cart.quantity as quantity,cart.price as price,cart.discount as discount,cart.tax as tax,
				 cart.size_id as size,product.product_name as product_name');
				$this->db->from('cart');
				$this->db->where('cart.user_id',$user_id); 
				//$this->db->join('product_images', 'product_images.product_id = cart.product_id','left');
				$this->db->join('product', 'product.product_id = cart.product_id','left');
				
							
				$this->db->where('cart.is_active',1);
				$this->db->where('cart.cart_status','cart');
				$query = $this->db->get(); 
				$results=$query->result_array();
				$total_quantity=$total_price="0";
				$product_image=$product_details= $result_data=array();
				$ids = array();
				foreach($results as $result_row){



				
					//$image_url[$result_row['product_id']]=base_url().$result_row['image_url'];
					//$image_thumbnail_url[$result_row['product_id']]=base_url().$result_row['image_thumbnail_url'];
					if(!in_array($result_row['product_id'], $ids)) {
						array_push($ids, $result_row['product_id']);
					}
					
					$product_details[]=array(
						'id'=>$result_row['id'],
						'user_id'=>$result_row['user_id'],
						'product_id'=>$result_row['product_id'],
						'size'=>$result_row['size'],
						'cart_status'=>$result_row['cart_status'],
						'quantity'=>$result_row['quantity'],
						//'price'=>$result_row['quantity']*$result_row['price'],
						'price'=>$result_row['price'],
						'original_price'=>$result_row['price'],
						'product_name'=>$result_row['product_name'],
						'discount'=>$result_row['discount'],
						'tax'=>$result_row['tax']
					);					
				}
				
				
				
				if(count($ids)!="0"){
				
					$this->db->select('attribute_name,attribute_id');
					$this->db->from('attribute');
					$this->db->where('attribute_name','Product name');				
					
					$query12s=$this->db->get()->row();
					
					$this->db->select('attribute_value_id ,attribute_id ,product_id ,attribute_value  ');
					$this->db->from('attribute_value');
					//$this->db->where('attribute.attribute_name','Product name');
					//$this->db->where('attribute.attribute_id','attribute_value.attribute_id');
					$this->db->where('attribute_id',$query12s->attribute_id);
					$this->db->where_in('product_id', $ids);
					$query_res = $this->db->get()->result_array();  
			  
				
				
					$proj_name=array();
					foreach($query_res as $query_res_rows){
						$proj_name[$query_res_rows['product_id']]=$query_res_rows['attribute_value'];
					}
			
				
					foreach($product_details as $rows){
						$product_image_url="";
						$product_image_thumbnail_url="";
						
						//////////
						 $this->db->select('image_id,image_url,image_thumbnail_url')
						->from('product_images')
						
						->where('product_id',$rows['product_id']);
						$getimage=$this->db->get();
						//echo $this->db->last_query();
						 foreach ($getimage->result() as $getimage_row)
						 {
							
							 $product_image_url=base_url().$getimage_row->image_url;
							 $product_image_thumbnail_url =base_url().$getimage_row->image_thumbnail_url;
						 }
						///////////
						/* if(isset($image_url[$rows['product_id']])){
							$product_image_url =$image_url[$rows['product_id']];
						}
						if(isset($image_thumbnail_url[$rows['product_id']])){
							$product_image_thumbnail_url =$image_thumbnail_url[$rows['product_id']];
						} */
						
						$total_quantity=$total_quantity+$rows['quantity'];
						
						$final_price=$total_price=$total_price+$rows['price'];
						$total_discount=$total_discount+$rows['discount'];
						$total_tax=$total_tax+$rows['tax'];
						$total_price=($total_price-($total_price*$total_discount/100))-$total_tax;
						if(isset($proj_name[$rows['product_id']])){
							$product_name=$proj_name[$rows['product_id']];
						} else {
							$product_name=$rows['product_name'];
						}
						
						
						$result_data[]=array(
							'id'=>$rows['id'],
							'user_id'=>$rows['user_id'],
							'product_id'=>$rows['product_id'],
							'size'=>$rows['size'],
							'cart_status'=>$rows['cart_status'],
							'quantity'=>$rows['quantity'],
							'price'=>$rows['price'],
							'original_price'=>$rows['original_price'],
							'product_name'=>$rows['product_name'],
							'image_url'=>$product_image_url,
							'image_thumbnail_url'=>$product_image_thumbnail_url
						);					
					}
				}	
				//$detail_arr=array('title'=>'Price','value'=>$final_price);
				$detail_arr2=array('title'=>'Price('.$total_quantity.')Items','value'=>$final_price);
				//$detail_arr3=array('title'=>'Total Item','value'=>count($result_data));
				$detail_arr3=array('title'=>'Total Item','value'=>$total_quantity);
				$detail_arr4=array('title'=>'Total Tax','value'=>$total_tax);
				$detail_arr5=array('title'=>'Total Discount','value'=>$total_discount);
				$detail_arr=array('title'=>'Total Amount','value'=>$total_price);
				$data['total_price']=$total_price;
				$data['total_quantity']=$total_quantity;
				
				if(count($result_data)=="0"){
					$data['statusCode']=0;
					$data['message']="No product available in your cart";
				} else {
					$data['statusCode']=1;
					$data['cart_data']=$result_data;
				} 
				
				
				$data['PRICING DETAILS'][]=$detail_arr2;
				$data['PRICING DETAILS'][]=$detail_arr3;
				$data['PRICING DETAILS'][]=$detail_arr4;
				$data['PRICING DETAILS'][]=$detail_arr5;
				$data['PRICING DETAILS'][]=$detail_arr;
			
			}
			
		} else {
			
			$data['message']='Some data is missing';
		}
	$response=array('billing_address' => $bill_obj,'shipping_address'=>$ship_obj,'cart'=>$data);
	$json = array('message' => 'success', 'statusCode'=>1,'data'=>$response);
	return $json;
}
function get_order_history($user_id,$api_key)
{
	$data=array();
	$result_data=array();
	$cart_id=array();
	$total_discount=$total_price=$total_tax="0";
	
	$this->db->select('*,sum(cart.quantity) as total_quantity');
	$this->db->from('cart');
	$this->db->where('user_transactions.user_id',$user_id);
	$this->db->where('payu_transaction_status','success');
	$this->db->join('user_transactions','cart.transaction_id=user_transactions.transaction_id','left');
	$this->db->group_by('cart.transaction_id');
	$query = $this->db->get();
	/* 	echo"<pre>";
	print_r($query->result());
	echo"</pre>";
	die(); */
	foreach($query->result() as $row){
		
	//echo $row->transaction_id;
		
	$this->db->select('CONCAT(count(order_status)," ",order_status) as status,sales_status.id as status_flag');
	$this->db->from('order_tracker');

	//$this->db->where('order_tracker.cart_id',$row->id);
	$this->db->where_in('cart.transaction_id',$row->transaction_id);
	$this->db->join('cart','cart.id=order_tracker.cart_id','left');
	$this->db->join('sales_status','sales_status.sales_status=order_tracker.order_status','left');
	$this->db->group_by('order_status');
	$order_status_query = $this->db->get();
	
	$result_data[]=array(
		'order_id'=>$row->transaction_id,
		'order_date'=> date('H:i:s',strtotime($row->created_on)),
		'total_price'=>$row->payu_txn_amount,
		'order_status'=>$order_status_query->result(),
		'total_quantity'=>$row->total_quantity
		);
	}
	
	
	$data=$json = array('message' => 'success', 'statusCode'=>1,'data'=>$result_data);
	
	return $data;
	
			
}

	function get_order_details($order_id,$user_id)
	{
				$total_quantity=$total_price="0";
				$total_discount=$total_tax="0";
				$product_image=$product_details= $result_data=array();
				$ids =$category_id=$ship_addr= array();
				$bill_addr_arr=array();
				$ship_addr_arr=array();
				$bill_obj=array();
				$this->db->select('*');
				$this->db->from('cart');
				$this->db->join('user_transactions', 'user_transactions.transaction_id = cart.transaction_id','left');
				$this->db->where_in('cart.transaction_id',$order_id);
				$query = $this->db->get();
				$order_row=$query->row();
				//==============================================================addresses
				$this->db->select('*')
				->from('user_address')
				->where('address_id',$order_row->shipping_address_id);
				$query_get_ship_addr = $this->db->get();
				
				if($query_get_ship_addr->num_rows()!=0)
				{
				$ship_addr=$query_get_ship_addr->row();	
				$ship_addr_arr['address_id']=$ship_addr->address_id;
				$ship_addr_arr['name']=$ship_addr->firstname." ".$ship_addr->lastname;
				$ship_addr_arr['address_firstline']=$ship_addr->address_value;
				$ship_addr_arr['address_secondline']=$ship_addr->city."-".$ship_addr->pincode;
				$ship_addr_arr['phone_number']=$ship_addr->phone_number;
				$ship_obj[]=(object)$ship_addr_arr;
				}
				
				$this->db->select('*')
						 ->from('user_address')
						 ->where('address_id',$order_row->billing_address_id);
						
				$query_get_bill_addr = $this->db->get();
				if($query_get_bill_addr->num_rows()!=0)
				{
				$bill_addr=$query_get_bill_addr->row();
				$bill_addr_arr['address_id']=$bill_addr->address_id;
				$bill_addr_arr['name']=$bill_addr->firstname." ".$bill_addr->lastname;
				$bill_addr_arr['address_firstline']=$bill_addr->address_value;
				$bill_addr_arr['address_secondline']=$bill_addr->city."-".$bill_addr->pincode;
				$bill_addr_arr['phone_number']=$bill_addr->phone_number;
				$bill_obj[]=(object)$bill_addr_arr;
				}
						
				
				
				//=================================================================================================
				/* echo"<pre>";
				print_r($bill_addr_arr);
				echo"</pre>";
				die();  */
				foreach($query->result() as $cart_row){	
				
				
				
				$this->db->select('product_images.image_id as image_id,product_images.image_url as image_url,product.category_id,
				product_images.image_thumbnail_url as image_thumbnail_url,product_images.product_id as product_images_product_id,
				cart.id as id,cart.user_id as user_id,
				cart.product_id as product_id,cart.cart_status as cart_status,cart.quantity as quantity,
				attribute_value.attribute_value as price,
				cart.size_id as size,product.product_name as product_name,order_status');
				$this->db->from('cart');
				$this->db->where('cart.id',$cart_row->id);
				//$this->db->where('order_tracker.cart_id',$cart_row->id);
				$this->db->join('product_images', 'product_images.product_id = cart.product_id','left');
				$this->db->join('product', 'product.product_id = cart.product_id','left');
				$this->db->join('order_tracker', 'cart.id=order_tracker.cart_id');
				$this->db->join('attribute_value', 'attribute_value.attribute_id = cart.price and attribute_value.product_id=cart.product_id','left');
				
				$this->db->where('cart.is_active',1);
				
				
				$product_query = $this->db->get();
				$results=$product_query->result_array();
				
				
				
				
				foreach($results as $result_row){					
					$image_url[$result_row['product_id']]=base_url().$result_row['image_url'];
					$image_thumbnail_url[$result_row['product_id']]=base_url().$result_row['image_thumbnail_url'];
					
						array_push($ids, $result_row['product_id']);
					
					$product_details[]=array(
						'id'=>$result_row['id'],
						'user_id'=>$result_row['user_id'],
						'product_id'=>$result_row['product_id'],
						'size'=>$result_row['size'],
						'cart_status'=>$result_row['cart_status'],
						'quantity'=>1,
						'price'=>1*$result_row['price'],
						'original_price'=>$result_row['price'],
						'product_name'=>$result_row['product_name'],
						'order_status'=>$result_row['order_status']
					);					
					
	
					}
				}
				if(count($ids)!="0"){
					$this->db->select('attribute_name,attribute_id');
					$this->db->from('attribute');
					$this->db->where('attribute_name','Product name');				
					
					$query12s=$this->db->get()->row();
					
					$this->db->select('attribute_value_id ,attribute_id ,product_id ,attribute_value  ');
					$this->db->from('attribute_value');
				
					$this->db->where('attribute_id',$query12s->attribute_id);
					$this->db->where_in('product_id', $ids);
					$query_res = $this->db->get()->result_array();  
			  
				
				
					$proj_name=array();
					foreach($query_res as $query_res_rows){
						$proj_name[$query_res_rows['product_id']]=$query_res_rows['attribute_value'];
					}
					$size=array();		
					foreach($product_details as $rows){
						$product_image_url="";
						$product_image_thumbnail_url="";
						if(isset($image_url[$rows['product_id']])){
							$product_image_url =$image_url[$rows['product_id']];
						}
						if(isset($image_thumbnail_url[$rows['product_id']])){
							$product_image_thumbnail_url =$image_thumbnail_url[$rows['product_id']];
						}
						
						$total_quantity=$total_quantity+$rows['quantity'];
						
						$total_price=$total_price=$total_price+$rows['original_price'];
						
						$final_price=($total_price-($total_price*$total_discount/100))+$total_tax;
						
						if(isset($proj_name[$rows['product_id']])){
							$product_name=$proj_name[$rows['product_id']];
						} else {
							$product_name=$rows['product_name'];
						}
						$this->db->select('quantity,size_title,ms.size_id')
						->from('product_option_mapper pom')
						->join('master_size ms','ms.size_id=pom.size_id')
						->where('product_id',$rows['product_id']);
						$getsize=$this->db->get();
						 foreach ($getsize->result() as $size_row)
						 {
							 $size[$size_row->size_id]=$size_row->size_title;
						 }	
						
						$result_data[]=array(
							'id'=>$rows['id'],
							'user_id'=>$rows['user_id'],
							'product_id'=>$rows['product_id'],
							'size'=>$rows['size'],
							'size_available'=>$size,
							'cart_status'=>$rows['cart_status'],
							'quantity'=>$rows['quantity'],
							'price'=>$rows['price'],
							'original_price'=>$rows['original_price'],
							'product_name'=>$product_name,
							'image_url'=>$product_image_url,
							'image_thumbnail_url'=>$product_image_thumbnail_url,
							'order_status'=>$rows['order_status']
						);		
					unset($size);
					}
					
						
				
				$data['total_quantity']=$total_quantity;
				$data['total_price']=$total_price;
				$data['total_item']=count($result_data);	
				$data['data']=$result_data;
				$data['total_discount']=$total_discount;
				$data['total_tax']=$total_tax;
				$data['final_price']=$final_price;
					
				}
				$data['shipping_address']=$ship_addr_arr;
				$data['billing_address']=$bill_addr_arr;
				
			$response=array('shipping_address'=>$ship_addr,'billing_address' => $bill_obj,'cart'=>$data);	
			$json = array('message' => 'success', 'statusCode'=>1,'data'=>$response);
			return $json;
	
	}
	
	}
?>  