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
	function loginSuccess($user_name,$password,$device_type,$device_id)    
	{
		//echo;
		$device_type=trim($device_type);
		$cur_time=date('Y-m-d H:i:s');
		$where_arr= array('username'=>$user_name,'password'=>$password);
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
			   'password' =>  $password,
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
			   'password' =>  $password,
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
			$where_arr= array('password'=>$old_password,'user_id'=>$user_id);
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
				$updateData['password'] =$new_password;
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
					$row->primary_phone_number);
					if($adminMailFlag)
					{
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
	

function sendMail($email_id,$firstname,$otp,$mailType)
	{

	
    $config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_timeout' => 7,
  'smtp_user' => 'pranita.sable91@gmail.com', // change it to yours
  'smtp_pass' => 'pr@nitasable13', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
	);
	
	   $this->email->set_newline("\r\n");
	    $this->email->initialize($config);
	 if($mailType===1)
    {
      $message = "<p>Hello ".$firstname.",</p> <p> You are successfully registered with VBCL.
					Kindly enter the OTP to verify your Email ID </p><p>Your OTP is: <b>".$otp."</b></p>
					<p>In case of any difficulties, contact us at email id : info@vbcl.com</p><p>
					Thanks,</p>Best,<br>VBCL Team ";
	  $this->email->subject('Confirmation of VBCL Sign Up');
	  }
	  elseif($mailType==0)
	  {
	  	$message = "<p>Hello ".$firstname.",</p> <p> Kindly Enter Following OTP To Reset The Password 
	  	</p><p>In case of any difficulties, contact us at email id : info@vbcl.com</p><p>
					Thanks,</p><p>Team VBCL </p><p>Your OTP is: <b>".$otp."</b></p><br>";
	  $this->email->subject('Password Recovery');
	  }
    
      $this->email->from('VBCL'); // change it to yours
      $this->email->to($email_id);// change it to yours
    
      $this->email->message($message);
	 // echo $this->email->print_debugger();
      if($this->email->send())
     {  
 
      return 1;
     }  
     else
    {
       show_error($this->email->print_debugger());
      return 0;
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
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_user' => 'pranita.sable91@gmail.com', // change it to yours
  'smtp_pass' => 'pr@nitasable13', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1'

  
	);

      $message = "<p>Dear Admin,</p> <h3>Congratulations Admin New User Signed Up!</h3>
     		<p> Following are the User Details </p>     
         
			User Name :".$firstname." ".$lastname."<br>
			Email_id :".$email."<br>";
			if($isset($company_name))
			{
				$message.="Company Name :".$company_name."<br>";
			}
            if($isset($primary_phone_number))
			{
				$message.="Phone Number :".$primary_phone_number."<br>";
			}
          
      $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
	  $this->email->initialize($config);
      $this->email->from('Noorsons International'); // change it to yours
      $this->email->to($email_id);// change it to yours
      $this->email->subject('New Sign Up');
      $this->email->message($message);
      if($this->email->send())
     {  
      return 1;
     }
     else  
    {
       show_error($this->email->print_debugger());
      return 0;
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
					$updateData = array('OTP_confirmed' => 1,'password'=>$password);
				   
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
					$data=$this->loginSuccess($user_name,$password,$device_type,$device_id);
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
	
	}
?>  