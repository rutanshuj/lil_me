
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {
	
	public function __construct() {		
		parent::__construct();
		include APPPATH . 'third_party/openpayu_php-master/lib/openpayu.php';
		include APPPATH . 'third_party/openpayu_php-master/examples/config.php';
		$this->load->Model('Cart_model');
		$this->load->Model('User_model');
		$this->load->Model('Usermodel');
		$this->load->Model('Category_model');
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		}
	} 
	function add_address()
		{
		$address_id=$this->input->get('address_id');
		$user_id=$this->session->userdata('user_id');
		$api_key =$this->session->userdata('api_key');
		$data['page_name']= "";
		if($address_id!='' && isset($address_id))
		{
		$this->db->select('*');
		$this->db->from('user_address');
		$this->db->where('address_id',$address_id);	
		$get_addr = $this->db->get();
		$data['addresses']=$get_addr->result();		
		}
		
		$data['category_list'] = $this->Category_model->product_category();
	
		$this->load->view('header',$data);	
		$this->load->view('new_address',$data);
		$this->load->view('footer');
			}
		function update_address()
		{
			$data['page_name']= "";
			$names=array();
			$address_type=$this->input->post('address_type');
			$address_id=$this->input->post('address_id');
			
			$name=$this->input->post('name');
			$names=explode(" ",$name);
			if($address_type=='billing_address')
			{
				$is_billing_address=1;
				$is_shipping_address=0;
			}
			else{
				$is_billing_address=0;
				$is_shipping_address=1;
			}
		if ($address_id!= '' || !empty($address_id))
			{		
			$update_data = array(
			'firstname'=>$names[0],
			'lastName'=>$names[1],
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
			$insert_data = array(
			'user_id'=>$user_id=$this->session->userdata('user_id'),
			'firstname'=>$names[0],
			//'lastName'=>$names[1],
		    'phone_number'=>$this->input->post('phone_number'),
		    'city' => $this->input->post('city') ,
		    'state '=>$this->input->post('state'),
		    'address_value'=>$this->input->post('address_value'),
			'pincode'=>$this->input->post('pincode'),
			'is_billing_address'=>$is_billing_address,
			'is_shipping_address'=>$is_shipping_address);
			if(isset($names[1])){
				$insert_data+=array ('lastName'=>$names[1]);
			}
			if($this->db->insert('user_address', $insert_data))
				{
				$this->session->set_userdata($address_type,$this->db->insert_id());
				$data['statusCode']=1;
				$data['message']='Address Added';
				}
			}
		
		$this->order_review();
		
		}
	
	public function order_review()
	{
		
		$user_id=$this->session->userdata('user_id');
		$api_key =$this->session->userdata('api_key');
		$data['page_name']= "";
		$data['address_list']=$this->Usermodel->get_order_data($user_id,$api_key);
		$data['category_list'] = $this->Category_model->product_category();
		$data['cart_list']=$this->Cart_model->get_cartList($user_id,$api_key);	
		/* echo"<pre>";
		print_r($data);
		echo"</pre>";
		die();*/
		$this->load->view('header',$data);	
		$this->load->view('order_review',$data);
		$this->load->view('footer',$data);
	}
	public function change_address()
	{
		$data['address_type']=$this->input->get('address_type');
		$data['page_name']= "";
		$user_id=$this->session->userdata('user_id');
		$api_key =$this->session->userdata('api_key');
		$data['address_list']=$this->User_model->get_addresses($user_id,'billing');
		$data['cart_list']=$this->Cart_model->get_cartList($user_id,$api_key);	
		$data['category_list'] = $this->Category_model->product_category();
		/* echo"<pre>";
		print_r($data);
		echo"</pre>";
		die(); */
		$this->load->view('header',$data);	
		$this->load->view('change_address',$data);
		$this->load->view('footer',$data);
	}
	function set_billing_address()
	{
		$user_id=$this->session->userdata('user_id');
		$api_key =$this->session->userdata('api_key');
		$address_id=$this->input->post('address_id');
		$data['page_name']= "";
		
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
					$this->order_review();
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
	function set_shipping_address()
	{
		$user_id=$this->session->userdata('user_id');
		$api_key =$this->session->userdata('api_key');
		$address_id=$this->input->post('address_id');
		$update_data=array();
		$data['page_name']= "";
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
				/* echo"<pre>";
				print_r($updateData);
				echo $row->address_id;
				echo"</pre>";
				die(); */
					$this->db->where('address_id', $row->address_id);
					$this->db->update('user_address', $updateData);
					if($this->db->affected_rows()==1)
					{
					
					$this->order_review();
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
	public function payu_post_transaction($payment)
	{
		$additionalCharges=0;
		$amount=$this->input->post('amount');
		$data['page_name']= "";
		if($payment=='cod')
		{
			$txnid=substr(rand(),0,10);
			$status='success';
			$user['carts']=$this->session->userdata('carts');
			$row=array(
					'user_id'=>$this->session->userdata('user_id'),
					'payu_txn_id'=>$txnid,
					'payu_transaction_status'=>$status,
					'additional_charges'=>$additionalCharges,
					'payu_txn_amount'=>$amount,
					'is_active'=>1,
					'created_on'=>date('Y-m-d H:i:s'),
					'shipping_address_id'=>$this->session->userdata('shipping_address'),
					'billing_address_id'=>$this->session->userdata('billing_address'));
				$this->db->set($row);
				$this->db->insert('user_transactions', $row); 
				$transaction_id=$this->db->insert_id();		
			if($status=='success')
			{
			  foreach($user['carts'] as $c_id){
					//$updateData=array('transaction_id'=>$transaction_id);
				$this->db->select('quantity');
				$this->db->from('cart');
				$this->db->where('id',$c_id);
				$query = $this->db->get();
				$row=$query->row();
				
				//die(); 
				for($i=0;$i<$row->quantity;$i++)
					{
						 $order_tracker_save[]=array(
						 'cart_id'=>$c_id,
						 'order_status'=>'In Progress',
						 'cancelled_by_user'=>0,
						 'cancelled_by_admin'=>0
						
					 );
				}
				$this->db->insert_batch('order_tracker', $order_tracker_save); 
				
				$update_data[]= array(				
				'id'=>$c_id,
				'user_id'=>$this->session->userdata('user_id'),
				'cart_status'=>'order_placed',
				'transaction_id'=>$transaction_id
				);
					$this->db->where('id', $c_id);
		//$this->db->update('cart', $update_data);
					
				}
				$this->db->update_batch('cart',$update_data, 'id','user_id'); 
				//print_r($update_data);
			}
		   
			$data['message']= "<h3>Thank You. Your order status is ". $status .".</h3>";
			$this->session->set_userdata('trans_message',$data['message']);
			//$this->order_history();
			redirect('/web/home/thankyou_page');
          //echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
		}
		else{
		$rows=array();
		$status=$this->input->post("status");
		$firstname=$this->input->post("firstname");
		$amount=$this->input->post("amount");
		$txnid=$this->input->post("txnid");
		$posted_hash=$this->input->post("hash");
		$key=$this->input->post("key");
		$productinfo=$this->input->post("productinfo");
		$email=$this->input->post("email");
		$salt=$this->config->item('SALT');
		$data['page_name']= "";
		$user['shipping_address']=$this->session->userdata('shipping_address');
		$user['billing_address']=$this->session->userdata('billing_address');
		$additionalCharges='';

		If (isset($_POST["additionalCharges"])) {
		$additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
             }
		else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	}
	}
	public function get_order()
	{
		
		$order = array();
		$user_id =$this->session->userdata('user_id');//1;
		$api_key =$this->session->userdata('api_key');//'fb0aa13efb9ac71e1c09094d7102d798'; 
		$products=$this->Cart_model->get_cartList($user_id,$api_key);
		$userData=$this->User_model->app_users_details($user_id);
		$data['page_name']= "";
		foreach($products['data'] as $key=>$value)
		{
			$order['products'][]=array(
							
							'quantity'=>$value['quantity'],
							
							'unitPrice'=>$value['original_price'],
							'name'=>$value['product_name'],
							
						);
			
		}
	
$order['totalAmount'] = $products['total_price'];	
$order['notifyUrl'] = 'http://localhost'.dirname($_SERVER['REQUEST_URI']).'/OrderNotify.php';
$order['continueUrl'] = 'http://localhost'.dirname($_SERVER['REQUEST_URI']).'/../../layout/success.php';

$order['customerIp'] =$ip= $this->input->ip_address();//'127.0.0.1';

//echo $ip;
$order['merchantPosId'] = OpenPayU_Configuration::getOauthClientId() ? OpenPayU_Configuration::getOauthClientId() : OpenPayU_Configuration::getMerchantPosId();
$order['description'] = 'New order';
$order['currencyCode'] = 'PLN';

$order['extOrderId'] = uniqid('', true);



$order['buyer']['email'] = $userData->email;
$order['buyer']['phone'] =  $userData->primary_phone_number;
$order['buyer']['firstName'] = $userData->firstname;
$order['buyer']['lastName'] = $userData->lastname;


/*~~~~~~~~ optional part INVOICE data ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

$order['buyer']['invoice']['recipientName'] = 'Anna Nowak';
$order['buyer']['invoice']['recipientEmail'] = 'test_buyer_email@payu.com';
$order['buyer']['invoice']['recipientPhone'] = '+48 456 456 789';
$order['buyer']['invoice']['name'] = 'The very first invoice';
$order['buyer']['invoice']['street'] = 'Foo St. 155';
$order['buyer']['invoice']['postalBox'] = 'Warsaw';
$order['buyer']['invoice']['postalCode'] = '22-222';
$order['buyer']['invoice']['city'] = 'Warsaw';
$order['buyer']['invoice']['countryCode'] = 'PL';
$order['buyer']['invoice']['tin'] = '8252212616';

/*~~~~~~~~ optional part DELIVERY data ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

//Please add at least one shipping method in "shippingMethods" part
$order['shippingMethods'][0]['name'] = 'Shipping 1';
$order['shippingMethods'][0]['country'] = 'PL';
$order['shippingMethods'][0]['price'] = '800';

//Add delivery informations
$order['buyer']['delivery']['recipientName'] = 'Robert Nowak';
$order['buyer']['delivery']['recipientEmail'] = 'test_buyer_email@payu.com';
$order['buyer']['delivery']['recipientPhone'] = '+48 456 123 789';
$order['buyer']['delivery']['street'] = 'Bar St. 155';
$order['buyer']['delivery']['postalBox'] = 'Warsaw';
$order['buyer']['delivery']['postalCode'] = '22-222';
$order['buyer']['delivery']['city'] = 'Warsaw';
$order['buyer']['delivery']['state'] = 'Masovian district';
$order['buyer']['delivery']['countryCode'] = 'PL';
try {
        $response = OpenPayU_Order::create($order);
		 echo '<pre>';
      // $data= json_encode($response->getResponse());
	   print_r($response);
        echo '</pre>';
        $status_desc = OpenPayU_Util::statusDesc($response->getStatus());
        if ($response->getStatus() == 'SUCCESS') {
            echo '<div class="alert alert-success">SUCCESS: ' . $status_desc;
            echo '</div>';
        } else {
            echo '<div class="alert alert-warning">' . $response->getStatus() . ': ' . $status_desc;
            echo '</div>';
        }
    } catch (OpenPayU_Exception $e) {
        echo '<pre>';
        var_dump((string)$e);
        echo '</pre>';
    }
	}
		public function place_order()
	{
		$data['page_name']= "";
		$user_id =$this->session->userdata('user_id');//1;
		$api_key =$this->session->userdata('api_key');//'fb0aa13efb9ac71e1c09094d7102d798'; 
		$payment_method=$this->input->post('payment');
		//echo $payment_method; exit;
		if($payment_method=='cod')
		{
			$this->payu_post_transaction($payment_method);
		}
		else{
		$user['txnid'] = $this->input->post('txnid');
		$userData=$this->User_model->app_users_details($user_id);
	
		$user['amount']=$this->input->post('amount');
		$user['hash']=$this->input->post('hash');
		$user['firstname']=$userData->firstname;
		$user['email']=$userData->email;
		$user['phone']=$userData->primary_phone_number;
		//$user['phone']="9702558122";
		$user['service_provider']=$this->input->post('service_provider');
		$user['productinfo']="hndsjdh akjdklaj";
	
		//$user['surl']="http://www.prvy.in/sme/lil_me/web/Payment/place_order";
		$user['surl']=$this->config->item('SUCCESS_URL');
		//$user['furl']="http://www.prvy.in/sme/lil_me/web/Payment/place_order";
		$user['furl']=$this->config->item('FAILURE_URL');
		
		//$user['key']="1BA7Z9eM";
		$user['key']=$this->config->item('MERCHANT_KEY');
		$PAYU_BASE_URL=$this->config->item('PAYU_BASE_URL');
		//$PAYU_BASE_URL = "https://secure.payu.in";
		//$SALT="jOfvdGdwql";
		$SALT=$this->config->item('SALT');
		
		
		$user['products']=$this->session->userdata('udf');
		
		
		 $user['txnid'] = "c5a0ce6acc61ce0f282a";
		//die();
		if(empty($user['txnid'])||$user['txnid']=='') {
		  // Generate random transaction id
		  $user['txnid'] = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		} 
		
		
		$hash = '';
	/* 
		print_r($user);
		die(); */
		
		
		$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
		if(empty($user['hash']) && sizeof($user) > 0) {
			
		  if(
				  empty($user['key'])
				  || empty($user['txnid'])
				  || empty($user['amount'])
				  || empty($user['firstname'])
				  || empty($user['email'])
				  || empty($user['phone'])
				  || empty($user['productinfo'])
				  || empty($user['surl'])
				  || empty($user['furl'])
				  || empty($user['service_provider'])
				
		  ) {
			 
			$formError = 1;
		  } else {
			
			//$user['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
			$hashVarsSeq = explode('|', $hashSequence);
			$hash_string = '';	
			
			foreach($hashVarsSeq as $hash_var) {
			  $hash_string .= isset($user[$hash_var]) ? $user[$hash_var] : '';
			  $hash_string .= '|';
			}
			
			$hash_string .= $SALT;

			$hash = strtolower(hash('sha512', $hash_string));
			
			$action = $PAYU_BASE_URL . '/_payment';
				//header('Location: '.$action);
		  }
		}
		 elseif(!empty($user['hash'])) {
		  $hash = $user['hash'];
		  
		  $action = $PAYU_BASE_URL . '/_payment';
		  
		  
		  
  	//header('Location: '.$action);
		}

	$user['hash']=$hash;
	$user['action']=$action;
	
	
	$this->load->view('payu_redirect',$user);
	}
	}
	public function cancel_order()
	{
		$order_id=$this->input->post('orderId');
		if (isset($order_id)) {
            try {
                $response = OpenPayU_Order::cancel(stripslashes($_POST['orderId']));
                $status_desc = OpenPayU_Util::statusDesc($response->getStatus());
                if($response->getStatus() == 'SUCCESS'){
                    echo '<div class="alert alert-success">SUCCESS: '.$status_desc;
                    echo '</div>';
                }else{
                    echo '<div class="alert alert-warning">'.$response->getStatus().': '.$status_desc;
                    echo '</div>';
                }
                echo '<pre>';
                echo '<br>';
                print_r($response->getResponse());
                echo '</pre>';
            }catch (OpenPayU_Exception $e) {
                echo '<pre>';
                echo 'Error code: '.$e->getCode();
                echo '<br>';
                echo 'Error message: '.$e->getMessage();
                echo '<br>';
                echo '</pre>';
            }
        } else {
			
			$this->load->view('header');	
			$this->load->view('cancel_order');
			$this->load->view('footer');
		}
	}
	function order_history()
	{
	$user_id =$this->session->userdata('user_id');//1;
	$api_key =$this->session->userdata('api_key');//'fb0aa13efb9ac71e1c09094d7102d798'; 
	$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
	$data['category_list'] = $this->Category_model->product_category();
	$data['orders']=$this->Usermodel->get_order_history($user_id,$api_key);	
	$data['page_name']= "";
	/*  echo '<pre>';
     print_r($data);
     echo '</pre>';
	 die(); */
	$this->load->view('header',$data);	
	$this->load->view('order_history',$data);
	$this->load->view('footer');

	
	}	
	
	function order_details()
	{
	$user_id =$this->session->userdata('user_id');//1;
	$api_key =$this->session->userdata('api_key');//'fb0aa13efb9ac71e1c09094d7102d798'; 
	$data['order_id']=$order_id=$this->input->get('ord_id');
	$data['category_list'] = $this->Category_model->product_category();
	$data['orders']=$this->Usermodel->get_order_details($order_id,$user_id);
	$data['cart_list']=$this->Cart_model->get_cartList($user_id,$api_key,$order_id);
	$data['page_name']= "";
	/*  echo '<pre>';
     print_r($data);
     echo '</pre>';*/
	 //die();  
	$this->load->view('header',$data);	
	$this->load->view('order_details',$data);
	$this->load->view('footer');
	}
	function payment_method(){
		$user_id =$this->session->userdata('user_id');//1;
		$api_key =$this->session->userdata('api_key');//'fb0aa13efb9ac71e1c09094d7102d798'; 
		$data['category_list'] = $this->Category_model->product_category();
		$data['cart_list']=$this->Cart_model->get_cartList($user_id,$api_key);
		$data['page_name']= "";
		 /*echo '<pre>';
		 print_r($this->session->userdata);
		 echo '</pre>';
		die();*/
		$this->load->view('header',$data);	
		$this->load->view('payment_method',$data);
		$this->load->view('footer');
	}
}
?>