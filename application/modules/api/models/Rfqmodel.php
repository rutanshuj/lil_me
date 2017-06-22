<?php
class Rfqmodel extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('email');
    }
    function RFQRequest($user_id,$products,$request_date)
    {
    	$count=0;
    	$product_name=array();
    	$firstname='';
    	$email_id='';
		$request_date=strtotime($request_date);
    	$request_date=date('Y-m-d H:i:s',$request_date);
    	//$prd_arr=implode(',',$products);
    	//echo $prd_arr;
		//print_r($products);
					for ($i=0; $i < count($products) ; $i++) 
					{ 
						$insertDataLead= array
						(
						'rfq_id'=>date('Y-m-d-').$user_id,
						'product_id' => $products[$i],
						'user_id' => $user_id, 
						'requested_on'=>date('Y-m-d H:i:s'),
						'rfq_status'=>'request',
						'updated_on'=>date('Y-m-d H:i:s')
						
						);
						$rfq_data=$this->db->insert('rfq_data', $insertDataLead);
						
						if($rfq_data)
							$count++;
					}
				

					if($count==count($products))
					{
					array_shift($product_name);
					$this->db->select('product_name')
					->from('product')
					->where_in('product_id',$products);
					$getProduct_name = $this->db->get();
					foreach ($getProduct_name->result() as $row) {
					$product_name[]=$row->product_name;

					}
					$this->db->select('firstname,email_id')
					->from('user_details')
					->where_in('user_id',$user_id);
					$getuser = $this->db->get();
					//print_r($getuser->result());
					foreach ($getuser->result() as $user_row) {
					$firstname=$user_row->firstname;
					$email_id=$user_row->email_id;
					}
					//echo $firstname;
					//print_r($product_name);
					$requestType=1;
					$mailflag=$this->sendMail($email_id,$firstname,$product_name,$requestType);
					$adminMailflag=$this->sendMailTOAdmin($email_id,$firstname,$product_name,$requestType);
					if($mailflag && $adminMailflag)
					{
					$data['statusCode']=1;
					$data['message']='Your request has been sent';
					}
					
				}
				else{
					$data['statusCode']=0;
					$data['message']='Failed';
					}
				return $data;
    }
	function outOnMemoRequest($user_id,$products,$request_date)
    {
    	$count=0;
		$request_date=strtotime($request_date);
    	$request_date=date('Y-m-d H:i:s',$request_date);
					for ($i=0; $i < count($products) ; $i++) 
					{ 
						$insertDataLead= array
						(
						'product_id' => $products[$i],
						'user_id' => $user_id, 
						'memo_request_date'=>$request_date,
						'request_approve_date'=>$request_date,
						'created_on'=>date('Y-m-d H:i:s'),
						'status'=>'request',
						'updated_on'=>date('Y-m-d H:i:s'),
						'quantity'=>1,
						'request'=>1
						);
						$out_on_memo=$this->db->insert('out_on_memo', $insertDataLead);
						
						if($out_on_memo)
							$count++;
					}
				
					if($count==count($products))
					{
					$data['statusCode']=1;
					$data['message']='Your request has been sent';
					}
					else{
					$data['statusCode']=0;
					$data['message']='Failed';
					}
				return $data;
    }
	
	 function sendMail($email_id,$firstname,$products,$requestType)
	{

	//echo $firstname."djsh";
    $config = Array(
  /*  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_timeout' => 7,
	'smtp_user' => 'pranita.sable91@gmail.com', // change it to yours
  'smtp_pass' => 'pr@nitasable13',  // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE  */
  
  
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
	   if($requestType==1)
	   {
	  $message = "<p>Hello ".$firstname.",</p> <p> Your request for quote is successfully sent to admin for the following products</p>";
				  $this->email->subject('Request For Quote');
	  }elseif($requestType==2)
	  {
	  	 $message = "<p>Hello ".$firstname.",</p> <p> Your request for Memo is successfully sent to admin for the following products</p>";
				  $this->email->subject('Request For Memo');
	  }
	  			  //print_r($products);
	  			  //die();
	  			for ($i=0,$k=1; $i < count($products); $i++,$k++) 
					{
						 $message .="<p>".$products[$i]."</p>";
					}
	 $message .= "<p>In case of any difficulties, contact us at orders@lilme.in</p><br><br><p>
					Best Regards,</p><p>Li'l Me Team </p>";
	  
	  
	  
	  
	  /////////////
	  $headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= "From: Li'l Me<Orders@lilme.in>" . "\r\n";
$headers .= 'Bcc: pankajcse1983@gmail.com' . "\r\n";

mail($email_id,'Request For Quote',$message,$headers);
	  /////////////
	  
	   return 1;
	  
	  
	    $this->email->from('Orders@lilme.in','lilme'); 
      //$this->email->from('Li’l Me'); // change it to yours
      $this->email->to($email_id);// change it to yours
    
      $this->email->message($message);
	 //print_r($this->email);
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
	
	function sendMailTOAdmin($email_id,$firstname,$products,$requestType)
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
  
/* 'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.zoho.com',
  'smtp_port' => 465,
  'smtp_timeout' => 7,
  'smtp_user' => 'Orders@lilme.in', // change it to yours
  'smtp_pass' => 'orders@ll123', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1' */
  
	);
	//print_r($products);
     if($requestType==1)
	   {
	$message = "<p>Dear Admin,</p> <h3>New Request for Quote Came In</h3>
     		<p> Following are the Products .kindly Approve the request from admin Dashboard</p>"; 
	  }elseif($requestType==2)
	  {
	  	 $message = "<p>Dear Admin,</p> <h3>New Request for Memo Came In</h3>
     		<p> Following are the Products .kindly Approve the request from admin Dashboard</p>"; 
	  }
       
      	for ($i=0,$k=1; $i < count($products); $i++,$k++) 
					{
						 $message .="<p>".$products[$i]."</p>";
					}
	 $message .= "<p>In case of any difficulties, contact us at email id : orders@lilme.in</p><br><br><p>
					Best Regards,</p><p>Li'l Me Team  </p>";

			
      $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
	  $this->email->initialize($config);
      //$this->email->from('Li’l Me'); // change it to yours
	  
	  /////////////
	  $headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= "From: Li'l Me<Orders@lilme.in>" . "\r\n";
	$headers .= 'Bcc: pankajcse1983@gmail.com' . "\r\n";

	mail($email_id,'Request For Quote',$message,$headers);
	  /////////////
	  
	   return 1;
	  
	  
	  $this->email->from('Orders@lilme.in','lilme'); 
      $this->email->to($email_id);// change it to yours
      $this->email->subject('Request For Quote');   
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
}
?>