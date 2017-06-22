<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email 
class Sales extends Admin_Controller {
	public $page='sales';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('Sales_model');		
	}
	
	public function cart(){ 
		//individual_discount
		$data['sess_user_id']=$this->session->userdata('id');
		$total_product=$total_discount=$total_price=$total_price_after_diss="0";
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');		
		
		$data['sales_status']=$this->Sales_model->sales_status();
		
		$projec_ids=$proj_ids=array();
		$user_id=$data['user_select_id']=$this->input->get('user_select_id',true);
		$result_count="0";
		//echo "<pre>";
		if(is_numeric($user_id)){
			$sales_details=$this->Sales_model->cart_details($user_id,'cart');
			//// take product id
			
			foreach($sales_details as $sales_details_rows){			
				$result_count++;
				$proj_ids[]=$sales_details_rows['c_product_id']; 			
				$projec_ids[$sales_details_rows['c_product_id']]=$sales_details_rows['c_product_id']; 			
				
			}
			/// code end
			
			
			////// take product image
			$p_array_ids = array();
			if(!empty($proj_ids)){
			$this->db->select("*");
			$this->db->where_in('product_id',$proj_ids);			
			$image_result=$this->db->get('product_images')->result_array();
			foreach($image_result as $image_result_row){
				$p_array_ids[$image_result_row['product_id']]=array('image_url'=>$image_result_row['image_url'],'image_thumbnail_url'=>$image_result_row['image_thumbnail_url']);							
			}
			}
			///// code end					
			foreach($sales_details as $sales_details_rows){			
				
				$data_image_url="";
				$data_image_thumbnail_url="";				
				if(isset($p_array_ids[$sales_details_rows['c_product_id']])){				
					$data_image_url=$p_array_ids[$sales_details_rows['c_product_id']]['image_url']; 
					$data_image_thumbnail_url=$p_array_ids[$sales_details_rows['c_product_id']]['image_thumbnail_url'];					
				}				
				
				//$data['shipping_address']['user_address_firstname']=$sales_details_rows['user_address_firstname'];
				//$data['shipping_address']['user_address_lastname']=$sales_details_rows['user_address_lastname'];
				//$data['shipping_address']['user_address_phone_number']=$sales_details_rows['user_address_phone_number'];
				//$data['shipping_address']['user_address_address_type']=$sales_details_rows['user_address_address_type'];
				//$data['shipping_address']['user_address_pincode']=$sales_details_rows['user_address_pincode'];
				//$data['shipping_address']['user_address_city']=$sales_details_rows['user_address_city'];
				//$data['shipping_address']['user_address_state']=$sales_details_rows['user_address_state'];
				//$data['shipping_address']['address_value']=$sales_details_rows['address_value'];
				//$data['shipping_address']['is_billing_address']=$sales_details_rows['is_billing_address'];
				//$data['shipping_address']['is_shipping_address']=$sales_details_rows['is_shipping_address'];
									
				$total_product++;
				$total_discount=$total_discount+$sales_details_rows['product_individual_discount'];
				$total_price=$total_price+$sales_details_rows['price'];
				$total_price_after_diss=$total_price_after_diss+($sales_details_rows['price']-$sales_details_rows['product_individual_discount']);
												
				$data['sales_details'][$sales_details_rows['c_product_id']][]=array(
					'order_tracker_order_status'=>$sales_details_rows['order_tracker_order_status'],
					'order_tracker_id'=>$sales_details_rows['order_tracker_id'],
					'c_product_id'=>$sales_details_rows['c_product_id'],
					
					'card_id'=>$sales_details_rows['card_id'],
					'user_id'=>$sales_details_rows['user_id'],
					'username'=>$sales_details_rows['username'],
					'firstname'=>$sales_details_rows['firstname'],
					'lastname'=>$sales_details_rows['lastname'],
					'email_id'=>$sales_details_rows['email_id'],
					'size_id'=>$sales_details_rows['size_id'],
					'cart_status'=>$sales_details_rows['cart_status'],
					'transaction_id'=>$sales_details_rows['transaction_id'],
					//'transaction_created_on'=>$sales_details_rows['transaction_created_on'],
					
					'quantity'=>$sales_details_rows['quantity'],
					'price'=>$sales_details_rows['price'],
					'product_indi_discount'=>$sales_details_rows['product_individual_discount'],
					'price_wo_discount'=>$sales_details_rows['quantity']*$sales_details_rows['price'],
					
					'price_with_discount'=>$sales_details_rows['quantity']*($sales_details_rows['price']-$sales_details_rows['product_individual_discount']),
					
					'price_with_discount_in'=>$sales_details_rows['price']-$sales_details_rows['product_individual_discount'],
					
					
					'is_sales'=>$sales_details_rows['is_sales'],
					'size_title'=>$sales_details_rows['size_title'],
					'product_name'=>$sales_details_rows['product_name'],
					'gender'=>$sales_details_rows['gender'],
					'description'=>$sales_details_rows['description'],					
					'image_url'=>$data_image_url,					
					'image_thumbnail_url'=>$data_image_thumbnail_url,
					//'address_id'=>$sales_details_rows['address_id'],
					//'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					//'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					//'user_address_lastname'=>$sales_details_rows['user_address_lastname'],
					//'user_address_phone_number'=>$sales_details_rows['user_address_phone_number'],
					//'user_address_address_type'=>$sales_details_rows['user_address_address_type'],
					//'user_address_pincode'=>$sales_details_rows['user_address_pincode'],
					//'user_address_city'=>$sales_details_rows['user_address_city'],
					//'user_address_state'=>$sales_details_rows['user_address_state'],
					//'address_value'=>$sales_details_rows['address_value'],
					//'is_billing_address'=>$sales_details_rows['is_billing_address'],
					//'is_shipping_address'=>$sales_details_rows['is_shipping_address']
				);				
			}					
		}
		
		$data['total_product']=$total_product; 
		$data['total_discount']=$total_discount;
		$data['total_price']=$total_price;
		$data['total_price_after_diss']=$total_price_after_diss;
	
		
		$data['proje_ids']=$projec_ids;
		$data['result_count']=$result_count;
		$data['sales_user']=$this->Sales_model->sale_users(false,false,'1');
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('carts_view', $data);
		$this->load->view('footer', $data);
	}
	
	
	
	
	public function complete_cancel(){
	
		$data['product_details']=$this->Sales_model->card_product();
			
		$data['sess_user_id']=$this->session->userdata('id');
		$total_product=$total_discount=$total_price=$total_price_after_diss="0";
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');		
		
		$data['sales_status']=$this->Sales_model->sales_status();
		
		$projec_ids=$proj_ids=$useradd=$user_ids=$tran_id=array();
		
		$user_id=$data['user_select_id']=trim($this->input->get('id',true));
		
		$u_p_id=$data['u_p_id']=trim($this->input->get('u_p_id',true));
		$data['div_plus_minus']=trim($this->input->get('div_plus_minus',true));
		
		
		
		$u_s_id=$data['u_s_id']=trim($this->input->get('u_s_id',true));
		$start_date=$data['start_date']=trim($this->input->get('start_date',true));
		$end_date=$data['end_date']=trim($this->input->get('end_date',true));
		$status_num="1";
		
		if($u_s_id==""){			
			$u_s_id=="in process";
			$status_num="0";
		}	
	
		$result_count="0";
	
			
			
			$user_add_array=$this->Sales_model->user_address_details($user_id);
			//$user_add_array=$this->Sales_model->user_address_details();
			
			
			
			
			foreach($user_add_array as $user_add_rows){			
								
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['address_id']=$user_add_rows['address_id']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['user_id']=$user_add_rows['user_id']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['firstname']=$user_add_rows['firstname']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['lastname']=$user_add_rows['lastname']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['phone_number']=$user_add_rows['phone_number']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['address_type']=$user_add_rows['address_type']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['pincode']=$user_add_rows['pincode']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['city']=$user_add_rows['city']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['state']=$user_add_rows['state']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['address_value']=$user_add_rows['address_value']; 			
				
			}
			
			////cart_tax in process
			//$sales_details=$this->Sales_model->cart_details($user_id,'in progress','0');
			
			
			$sales_details=$this->Sales_model->cart_details($user_id,$u_s_id,$status_num,$u_p_id,$start_date,$end_date,'2');
			//// take product id
			
			
			foreach($sales_details as $sales_details_rows){			
				$result_count++;
				$proj_ids[]=$sales_details_rows['c_product_id']; 			
				$projec_ids[$sales_details_rows['c_product_id']]=$sales_details_rows['c_product_id']; 
				$user_ids[$sales_details_rows['user_id']]=$sales_details_rows['user_id']; 
						
				
			}
			// transaction_created_on
				
			
			////// take product image
			$p_array_ids = array();
			if(!empty($proj_ids)){
			$this->db->select("*");
			$this->db->where_in('product_id',$proj_ids);			
			$image_result=$this->db->get('product_images')->result_array();
			foreach($image_result as $image_result_row){
				$p_array_ids[$image_result_row['product_id']]=array('image_url'=>$image_result_row['image_url'],'image_thumbnail_url'=>$image_result_row['image_thumbnail_url']);							
			}
			}
			///// code end	shipping_address				
			foreach($sales_details as $sales_details_rows){			
				
				$data_image_url="";
				$data_image_thumbnail_url="";				
				if(isset($p_array_ids[$sales_details_rows['c_product_id']])){				
					$data_image_url=$p_array_ids[$sales_details_rows['c_product_id']]['image_url']; 
					$data_image_thumbnail_url=$p_array_ids[$sales_details_rows['c_product_id']]['image_thumbnail_url'];					
				}				
				
			



			if(isset($useradd[$sales_details_rows['user_id']][$sales_details_rows['trans_billing_address_id']])){
				
				$data['users_id'][$sales_details_rows['user_id']]['billing_address'][$sales_details_rows['transaction_id']]=$useradd[$sales_details_rows['user_id']][$sales_details_rows['trans_billing_address_id']];
				
			}
			if(isset($useradd[$sales_details_rows['user_id']][$sales_details_rows['trans_shipping_address_id']])){
				
				$data['users_id'][$sales_details_rows['user_id']]['shipping_address'][$sales_details_rows['transaction_id']]=$useradd[$sales_details_rows['user_id']][$sales_details_rows['trans_shipping_address_id']];
			}

			
				$tran_id[$sales_details_rows['transaction_id']]=$sales_details_rows['transaction_id'];
				
				
				
				$total_product++;
				$total_discount=$total_discount+$sales_details_rows['product_individual_discount'];
				$total_price=$total_price+$sales_details_rows['price'];
				$total_price_after_diss=$total_price_after_diss+($sales_details_rows['price']-$sales_details_rows['product_individual_discount']);
				
				$data['users_id'][$sales_details_rows['user_id']]['trans_ids'][$sales_details_rows['transaction_id']]=$sales_details_rows['transaction_id'];
				$data['users_id'][$sales_details_rows['user_id']]['payu_trans_ids'][$sales_details_rows['transaction_id']]=$sales_details_rows['trans_payu_txn_id'];
				
				$data['users_id'][$sales_details_rows['user_id']]['transaction_created_on'][$sales_details_rows['transaction_id']]=$sales_details_rows['transaction_created_on'];
				
				$data['users_id'][$sales_details_rows['user_id']]['card_id'][$sales_details_rows['transaction_id']]=$sales_details_rows['transaction_id'];
				
				
				$data['users_id'][$sales_details_rows['user_id']]['trans_payu_txn_amount'][$sales_details_rows['transaction_id']]=$sales_details_rows['trans_payu_txn_amount'];
				
				$data['users_id'][$sales_details_rows['user_id']]['total_product'][$sales_details_rows['transaction_id']]=$sales_details_rows['total_product'];
				
				
				
				$data['users_id'][$sales_details_rows['user_id']]['sales_details'][$sales_details_rows['transaction_id']]['details'][]=array(
					'cart_individual_discount'=>$sales_details_rows['cart_individual_discount'],
					'product_individual_discount'=>$sales_details_rows['product_individual_discount'],
					'cart_tax'=>$sales_details_rows['cart_tax'],
					'order_tracker_order_status'=>$sales_details_rows['order_tracker_order_status'],
					'order_tracker_id'=>$sales_details_rows['order_tracker_id'],
					'c_product_id'=>$sales_details_rows['c_product_id'],
					
					'card_id'=>$sales_details_rows['card_id'],
					'user_transactions_mode'=>$sales_details_rows['user_transactions_mode'],
					'user_id'=>$sales_details_rows['user_id'],
					'username'=>$sales_details_rows['username'],
					'firstname'=>$sales_details_rows['firstname'],
					'lastname'=>$sales_details_rows['lastname'],
					'email_id'=>$sales_details_rows['email_id'],
					'size_id'=>$sales_details_rows['size_id'],
					'cart_status'=>$sales_details_rows['cart_status'],
					'transaction_id'=>$sales_details_rows['transaction_id'],
					
					'quantity'=>$sales_details_rows['quantity'],
					'price'=>$sales_details_rows['price'],
					'product_indi_discount'=>$sales_details_rows['product_individual_discount'],
					'price_wo_discount'=>$sales_details_rows['quantity']*$sales_details_rows['price'],
					
					'price_with_discount'=>$sales_details_rows['quantity']*($sales_details_rows['price']-$sales_details_rows['product_individual_discount']),
					
					'price_with_discount_in'=>$sales_details_rows['price']-$sales_details_rows['product_individual_discount'],
					
					
					'is_sales'=>$sales_details_rows['is_sales'],
					'size_title'=>$sales_details_rows['size_title'],
					'product_name'=>$sales_details_rows['product_name'],
					'gender'=>$sales_details_rows['gender'],
					'description'=>$sales_details_rows['description'],					
					'image_url'=>$data_image_url,					
					'image_thumbnail_url'=>$data_image_thumbnail_url,
				
					'is_billing_address'=>$sales_details_rows['is_billing_address'],
					'is_shipping_address'=>$sales_details_rows['is_shipping_address']
					
				);				
			}					
		
			
		$data['user_ids']=$user_ids; 
		
		$data['total_product']=$total_product; 
		$data['total_discount']=$total_discount;
		$data['total_price']=$total_price;
		$data['total_price_after_diss']=$total_price_after_diss;
	
		
		$data['proje_ids']=$projec_ids;
		$data['result_count']=$result_count;
		$data['sales_user']=$this->Sales_model->sale_users(false,false,'1');
		
		$data['trans_id_count']=count($tran_id);
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('complete_cancel_view', $data);
		$this->load->view('footer', $data);
	}
	
	public function order_placed(){
		//individual_discount
		
		$data['product_details']=$this->Sales_model->card_product();
	
		
		
		$data['sess_user_id']=$this->session->userdata('id');
		$total_product=$total_discount=$total_price=$total_price_after_diss="0";
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');		
		
		$data['sales_status']=$this->Sales_model->sales_status();
		
		$projec_ids=$proj_ids=$useradd=$user_ids=$tran_id=array();
		
		$user_id=$data['user_select_id']=trim($this->input->get('id',true));
		
		$u_p_id=$data['u_p_id']=trim($this->input->get('u_p_id',true));
		$data['div_plus_minus']=trim($this->input->get('div_plus_minus',true));
		
		
		
		$u_s_id=$data['u_s_id']=trim($this->input->get('u_s_id',true));
		$start_date=$data['start_date']=trim($this->input->get('start_date',true));
		$end_date=$data['end_date']=trim($this->input->get('end_date',true));
		$status_num="1";
		
		if($u_s_id==""){			
			$u_s_id=="in process";
			$status_num="0";
		}	
		
		$result_count="0";
		//echo "<pre>";
		//if(is_numeric($user_id)){
			
			
			$user_add_array=$this->Sales_model->user_address_details($user_id);
			//$user_add_array=$this->Sales_model->user_address_details();
			
			//echo "<pre>";print_r($user_add_array);exit;
			
			
			foreach($user_add_array as $user_add_rows){			
								
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['address_id']=$user_add_rows['address_id']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['user_id']=$user_add_rows['user_id']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['firstname']=$user_add_rows['firstname']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['lastname']=$user_add_rows['lastname']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['phone_number']=$user_add_rows['phone_number']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['address_type']=$user_add_rows['address_type']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['pincode']=$user_add_rows['pincode']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['city']=$user_add_rows['city']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['state']=$user_add_rows['state']; 			
				$useradd[$user_add_rows['user_id']][$user_add_rows['address_id']]['address_value']=$user_add_rows['address_value']; 			
				
			}
			
			//echo "<pre>";print_r($useradd);exit;//cart_tax in process
			//$sales_details=$this->Sales_model->cart_details($user_id,'in progress','0');
			$sales_details=$this->Sales_model->cart_details($user_id,$u_s_id,$status_num,$u_p_id,$start_date,$end_date,'1');
			//// take product id
			//echo "<pre>";print_r($sales_details);exit;
			foreach($sales_details as $sales_details_rows){			
				$result_count++;
				$proj_ids[]=$sales_details_rows['c_product_id']; 			
				$projec_ids[$sales_details_rows['c_product_id']]=$sales_details_rows['c_product_id']; 
				$user_ids[$sales_details_rows['user_id']]=$sales_details_rows['user_id']; 
						
				
			}
			//$sales_details_rows['transaction_created_on'] ///////////payu_trans_ids//////////////// transaction_created_on
				
			
			////// take product image
			$p_array_ids = array();
			if(!empty($proj_ids)){
			$this->db->select("*");
			$this->db->where_in('product_id',$proj_ids);			
			$image_result=$this->db->get('product_images')->result_array();
			foreach($image_result as $image_result_row){
				$p_array_ids[$image_result_row['product_id']]=array('image_url'=>$image_result_row['image_url'],'image_thumbnail_url'=>$image_result_row['image_thumbnail_url']);							
			}
			}
			///// code end	shipping_address				
			foreach($sales_details as $sales_details_rows){			
				
				$data_image_url="";
				$data_image_thumbnail_url="";				
				if(isset($p_array_ids[$sales_details_rows['c_product_id']])){				
					$data_image_url=$p_array_ids[$sales_details_rows['c_product_id']]['image_url']; 
					$data_image_thumbnail_url=$p_array_ids[$sales_details_rows['c_product_id']]['image_thumbnail_url'];					
				}				
				
			



			if(isset($useradd[$sales_details_rows['user_id']][$sales_details_rows['trans_billing_address_id']])){
				
				$data['users_id'][$sales_details_rows['user_id']]['billing_address'][$sales_details_rows['transaction_id']]=$useradd[$sales_details_rows['user_id']][$sales_details_rows['trans_billing_address_id']];
				
			}
			if(isset($useradd[$sales_details_rows['user_id']][$sales_details_rows['trans_shipping_address_id']])){
				
				$data['users_id'][$sales_details_rows['user_id']]['shipping_address'][$sales_details_rows['transaction_id']]=$useradd[$sales_details_rows['user_id']][$sales_details_rows['trans_shipping_address_id']];
			}

			
				//echo "<pre>";print_r($data);exit; payu_trans_ids
				
				
				
				$total_product++;
				$total_discount=$total_discount+$sales_details_rows['product_individual_discount'];
				$total_price=$total_price+$sales_details_rows['price'];
				$total_price_after_diss=$total_price_after_diss+($sales_details_rows['price']-$sales_details_rows['product_individual_discount']);
				
				$data['users_id'][$sales_details_rows['user_id']]['trans_ids'][$sales_details_rows['transaction_id']]=$sales_details_rows['transaction_id'];
				
				$tran_id[$sales_details_rows['transaction_id']]=$sales_details_rows['transaction_id'];
				$data['users_id'][$sales_details_rows['user_id']]['payu_trans_ids'][$sales_details_rows['transaction_id']]=$sales_details_rows['trans_payu_txn_id'];
				
				$data['users_id'][$sales_details_rows['user_id']]['card_id'][$sales_details_rows['transaction_id']]=$sales_details_rows['transaction_id'];
				
				/////
				$data['users_id'][$sales_details_rows['user_id']]['transaction_created_on'][$sales_details_rows['transaction_id']]=$sales_details_rows['transaction_created_on'];
				///////
				//$sales_details_rows['transaction_created_on'] ///////////payu_trans_ids//////////////// transaction_created_on
				
				/// $sales_details_rows['order_tracker_order_status']
				
				/* if(($u_s_id!="")&&($sales_details_rows['order_tracker_order_status']==$u_s_id)){
					echo $u_s_id;
				} else {
					echo "no"; $sales_details_rows['card_id']
				}sales_user
				echo "<br>"; */
				
		
				$data['users_id'][$sales_details_rows['user_id']]['trans_payu_txn_amount'][$sales_details_rows['transaction_id']]=$sales_details_rows['trans_payu_txn_amount'];
				
				$data['users_id'][$sales_details_rows['user_id']]['total_product'][$sales_details_rows['transaction_id']]=$sales_details_rows['total_product'];
				
				$data['users_id'][$sales_details_rows['user_id']]['sales_details'][$sales_details_rows['transaction_id']]['details'][]=array(
					'cart_individual_discount'=>$sales_details_rows['cart_individual_discount'],
					'product_individual_discount'=>$sales_details_rows['product_individual_discount'],
					'cart_tax'=>$sales_details_rows['cart_tax'],
					'order_tracker_order_status'=>$sales_details_rows['order_tracker_order_status'],
					'order_tracker_id'=>$sales_details_rows['order_tracker_id'],
					'c_product_id'=>$sales_details_rows['c_product_id'],
					
					'card_id'=>$sales_details_rows['card_id'],
					'user_id'=>$sales_details_rows['user_id'],
					'username'=>$sales_details_rows['username'],
					'firstname'=>$sales_details_rows['firstname'],
					'lastname'=>$sales_details_rows['lastname'],
					'email_id'=>$sales_details_rows['email_id'],
					'size_id'=>$sales_details_rows['size_id'],
					'cart_status'=>$sales_details_rows['cart_status'],
					'transaction_id'=>$sales_details_rows['transaction_id'],
					'user_transactions_mode'=>$sales_details_rows['user_transactions_mode'],
					'quantity'=>$sales_details_rows['quantity'],
					'price'=>$sales_details_rows['price'],
					'product_indi_discount'=>$sales_details_rows['product_individual_discount'],
					'price_wo_discount'=>$sales_details_rows['quantity']*$sales_details_rows['price'],
					
					'price_with_discount'=>$sales_details_rows['quantity']*($sales_details_rows['price']-$sales_details_rows['product_individual_discount']),
					
					'price_with_discount_in'=>$sales_details_rows['price']-$sales_details_rows['product_individual_discount'],
					
					
					'is_sales'=>$sales_details_rows['is_sales'],
					'size_title'=>$sales_details_rows['size_title'],
					'product_name'=>$sales_details_rows['product_name'],
					'gender'=>$sales_details_rows['gender'],
					'description'=>$sales_details_rows['description'],					
					'image_url'=>$data_image_url,					
					'image_thumbnail_url'=>$data_image_thumbnail_url,
					//'address_id'=>$sales_details_rows['address_id'],
					//'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					//'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					//'user_address_lastname'=>$sales_details_rows['user_address_lastname'],
					//'user_address_phone_number'=>$sales_details_rows['user_address_phone_number'],
					//'user_address_address_type'=>$sales_details_rows['user_address_address_type'],
					//'user_address_pincode'=>$sales_details_rows['user_address_pincode'],
					//'user_address_city'=>$sales_details_rows['user_address_city'],
					//'user_address_state'=>$sales_details_rows['user_address_state'],
					//'address_value'=>$sales_details_rows['address_value'],
					'is_billing_address'=>$sales_details_rows['is_billing_address'],
					'is_shipping_address'=>$sales_details_rows['is_shipping_address']
					
				);				
			}					
		//}
		/// code end
			//exit;
			
		$data['user_ids']=$user_ids; 
		
		$data['total_product']=$total_product; 
		$data['total_discount']=$total_discount;
		$data['total_price']=$total_price;
		$data['total_price_after_diss']=$total_price_after_diss;
	
		
		$data['proje_ids']=$projec_ids;
		$data['result_count']=$result_count;
		$data['sales_user']=$this->Sales_model->sale_users(false,false,'1');
		$data['trans_id_count']=count($tran_id);
		
		
		/* echo "<pre>"; div_plus_minus
		print_r($data);exit; */
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('card_all_sales_view', $data);
		$this->load->view('footer', $data);
		
	}
	
	
	
	
	
	
	
	
	
	
	
	public function order_placed_old(){
		$data['sess_user_id']=$this->session->userdata('id');
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');		
		
		$data['sales_status']=$this->Sales_model->sales_status();
		
		
		$user_id=$data['user_select_id']=$this->input->get('user_select_id',true);
		$result_count="0";
		if(is_numeric($user_id)){
			$sales_details=$this->Sales_model->sale_users($user_id,'order placed');
			
			foreach($sales_details as $sales_details_rows){			
				$result_count++;
				
				
				
				
				$data['c_product_id'][]=$sales_details_rows['c_product_id'];
				$data['p_name'][$sales_details_rows['c_product_id']]=$sales_details_rows['product_name'];
				$data['sales_details'][$sales_details_rows['c_product_id']]=array(
					'card_id'=>$sales_details_rows['card_id'],
					'user_id'=>$sales_details_rows['user_id'],
					'username'=>$sales_details_rows['username'],
					'firstname'=>$sales_details_rows['firstname'],
					'lastname'=>$sales_details_rows['lastname'],
					'email_id'=>$sales_details_rows['email_id'],
					'size_id'=>$sales_details_rows['size_id'],
					'cart_status'=>$sales_details_rows['cart_status'],
					'transaction_id'=>$sales_details_rows['transaction_id'],
					'c_product_id'=>$sales_details_rows['c_product_id'],
					'quantity'=>$sales_details_rows['quantity'],
					'price'=>$sales_details_rows['price'],
					'is_sales'=>$sales_details_rows['is_sales'],
					'size_title'=>$sales_details_rows['size_title'],
					'product_name'=>$sales_details_rows['product_name'],
					'gender'=>$sales_details_rows['gender'],
					'description'=>$sales_details_rows['description'],
					'image_url'=>$sales_details_rows['image_url'],
					'image_thumbnail_url'=>$sales_details_rows['image_thumbnail_url'],
					'address_id'=>$sales_details_rows['address_id'],
					'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					'user_address_lastname'=>$sales_details_rows['user_address_lastname'],
					'user_address_phone_number'=>$sales_details_rows['user_address_phone_number'],
					'user_address_address_type'=>$sales_details_rows['user_address_address_type'],
					'user_address_pincode'=>$sales_details_rows['user_address_pincode'],
					'user_address_city'=>$sales_details_rows['user_address_city'],
					'user_address_state'=>$sales_details_rows['user_address_state'],
					'address_value'=>$sales_details_rows['address_value'],
					'is_billing_address'=>$sales_details_rows['is_billing_address'],
					'is_shipping_address'=>$sales_details_rows['is_shipping_address']
				);
				
			}
						
			//$data['transaction_id']=array_unique($data['transaction_id']);
			if(!empty($data['transaction_id'])){	
			$data['transaction_id']= array_keys(array_flip($data['transaction_id'])); 
			}
					
		}
		
		$data['result_count']=$result_count;
		$data['sales_user']=$this->Sales_model->sale_users(false,false,'1');
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('order_placed_view', $data);
		$this->load->view('footer', $data);
	}
	
	public function cart_old(){
		$data['sess_user_id']=$this->session->userdata('id');
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');		
		
		$data['sales_status']=$this->Sales_model->sales_status();
		
		
		$user_id=$data['user_select_id']=$this->input->get('user_select_id',true);
		$result_count="0";
		if(is_numeric($user_id)){
			$sales_details=$this->Sales_model->sale_users($user_id,'cart');
			
			foreach($sales_details as $sales_details_rows){			
				$result_count++;
				$data['c_product_id'][]=$sales_details_rows['c_product_id'];
				$data['p_name'][$sales_details_rows['c_product_id']]=$sales_details_rows['product_name'];
				
				$data['sales_details'][$sales_details_rows['c_product_id']]=array(
					'card_id'=>$sales_details_rows['card_id'],
					'user_id'=>$sales_details_rows['user_id'],
					'username'=>$sales_details_rows['username'],
					'firstname'=>$sales_details_rows['firstname'],
					'lastname'=>$sales_details_rows['lastname'],
					'email_id'=>$sales_details_rows['email_id'],
					'size_id'=>$sales_details_rows['size_id'],
					'cart_status'=>$sales_details_rows['cart_status'],
					'transaction_id'=>$sales_details_rows['transaction_id'],
					'c_product_id'=>$sales_details_rows['c_product_id'],
					'quantity'=>$sales_details_rows['quantity'],
					'price'=>$sales_details_rows['price'],
					'is_sales'=>$sales_details_rows['is_sales'],
					'size_title'=>$sales_details_rows['size_title'],
					'product_name'=>$sales_details_rows['product_name'],
					'gender'=>$sales_details_rows['gender'],
					'description'=>$sales_details_rows['description'],
					'image_url'=>$sales_details_rows['image_url'],
					'image_thumbnail_url'=>$sales_details_rows['image_thumbnail_url'],
					'address_id'=>$sales_details_rows['address_id'],
					'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					'user_address_lastname'=>$sales_details_rows['user_address_lastname'],
					'user_address_phone_number'=>$sales_details_rows['user_address_phone_number'],
					'user_address_address_type'=>$sales_details_rows['user_address_address_type'],
					'user_address_pincode'=>$sales_details_rows['user_address_pincode'],
					'user_address_city'=>$sales_details_rows['user_address_city'],
					'user_address_state'=>$sales_details_rows['user_address_state'],
					'address_value'=>$sales_details_rows['address_value'],
					'is_billing_address'=>$sales_details_rows['is_billing_address'],
					'is_shipping_address'=>$sales_details_rows['is_shipping_address']
				);
				
			}
						
			//$data['transaction_id']=array_unique($data['transaction_id']);
			if(!empty($data['transaction_id'])){	
			$data['transaction_id']= array_keys(array_flip($data['transaction_id'])); 
			}
					
		}
		
		$data['result_count']=$result_count;
		$data['sales_user']=$this->Sales_model->sale_users(false,false,'1');
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('carts_view', $data);
		$this->load->view('footer', $data);
	}
	
	public function index(){
		
		/* cart ---- 
		order_tracker */
		
		$pre_transaction_id="";
		
		
		
		$data['sess_user_id']=$this->session->userdata('id');
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');		
		
		$data['sales_status']=$this->Sales_model->sales_status();
		
		
		$user_id=$data['user_select_id']=$this->input->get('user_select_id',true);
		$result_count=$limit="0";
		if(is_numeric($user_id)){
			$sales_details=$this->Sales_model->sale_users($user_id,'cart');
			
			foreach($sales_details as $sales_details_rows){			
				$result_count++;
				$proj_ids[]=$sales_details_rows['c_product_id']; 			
				
			}
			
			
			
			$p_array_ids = array();
			$this->db->select("*");
			$this->db->where_in('product_id',$proj_ids);			
			$image_result=$this->db->get('product_images')->result_array();
			foreach($image_result as $image_result_row){
				$p_array_ids[$image_result_row['product_id']]=array('image_url'=>$image_result_row['image_url'],'image_thumbnail_url'=>$image_result_row['image_thumbnail_url']);
				
				
			}
			////////////////
			foreach($sales_details as $sales_details_rows){			
				
				
				$data['transaction_id'][]=$sales_details_rows['transaction_id'];
				
				$data_image_url="";
				$data_image_thumbnail_url="";
				
				if(isset($p_array_ids[$sales_details_rows['c_product_id']])){
				
					$data_image_url=$p_array_ids[$sales_details_rows['c_product_id']]['image_url']; 
					$data_image_thumbnail_url=$p_array_ids[$sales_details_rows['c_product_id']]['image_thumbnail_url'];
					
				}
				
				
				if($pre_transaction_id!=$sales_details_rows['transaction_id']){					
					$limit="0";
				}
				$pre_transaction_id=$sales_details_rows['transaction_id'];
				
				$data['sales_details'][$sales_details_rows['transaction_id']][$limit]=array(
				
					
					'card_id'=>$sales_details_rows['card_id'],
					'user_id'=>$sales_details_rows['user_id'],
					'username'=>$sales_details_rows['username'],
					'firstname'=>$sales_details_rows['firstname'],
					'lastname'=>$sales_details_rows['lastname'],
					'email_id'=>$sales_details_rows['email_id'],
					'size_id'=>$sales_details_rows['size_id'],
					'cart_status'=>$sales_details_rows['cart_status'],
					'transaction_id'=>$sales_details_rows['transaction_id'],
					'quantity'=>$sales_details_rows['quantity'],
					'price'=>$sales_details_rows['price'],
					'is_sales'=>$sales_details_rows['is_sales'],
					'size_title'=>$sales_details_rows['size_title'],
					'product_name'=>$sales_details_rows['product_name'],
					'gender'=>$sales_details_rows['gender'],
					'description'=>$sales_details_rows['description'],					
					'image_url'=>$data_image_url,					
					'image_thumbnail_url'=>$data_image_thumbnail_url,
					'address_id'=>$sales_details_rows['address_id'],
					'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					'user_address_lastname'=>$sales_details_rows['user_address_lastname'],
					'user_address_phone_number'=>$sales_details_rows['user_address_phone_number'],
					'user_address_address_type'=>$sales_details_rows['user_address_address_type'],
					'user_address_pincode'=>$sales_details_rows['user_address_pincode'],
					'user_address_city'=>$sales_details_rows['user_address_city'],
					'user_address_state'=>$sales_details_rows['user_address_state'],
					'address_value'=>$sales_details_rows['address_value'],
					'is_billing_address'=>$sales_details_rows['is_billing_address'],
					'is_shipping_address'=>$sales_details_rows['is_shipping_address']
				);
				$limit++;
			}
			/////////////////
			
			
			echo "<pre>";
			
			
			//print_r($proj_ids);
			print_r($data);
			
			//print_r($image_result);
			//print_r($p_array_ids);
			exit;
		
		
		
		
			
			
			//$data['transaction_id']=array_unique($data['transaction_id']);
			if(!empty($data['transaction_id'])){	
			$data['transaction_id']= array_keys(array_flip($data['transaction_id'])); 
			}
			//echo "<pre>";
			//print_r($data);
			
			
			
			//exit;
			
			
		}
		
		$data['result_count']=$result_count;
		$data['sales_user']=$this->Sales_model->sale_users(false,false,'1');
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('sales_view', $data);
		$this->load->view('footer', $data);
	}
	public function	dispatched(){
		$data['sess_user_id']=$this->session->userdata('id');
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');		
		
		$data['sales_status']=$this->Sales_model->sales_status();
		
		
		$user_id=$data['user_select_id']=$this->input->get('user_select_id',true);
		$result_count="0";
		if(is_numeric($user_id)){
			 $sales_details=$this->Sales_model->sale_users($user_id,'dispatched');
			
			
			
			foreach($sales_details as $sales_details_rows){			
				$result_count++;
				$data['transaction_id'][]=$sales_details_rows['transaction_id'];
				$data['sales_details'][$sales_details_rows['transaction_id']][]=array(
					'card_id'=>$sales_details_rows['card_id'],
					'user_id'=>$sales_details_rows['user_id'],
					'username'=>$sales_details_rows['username'],
					'firstname'=>$sales_details_rows['firstname'],
					'lastname'=>$sales_details_rows['lastname'],
					'email_id'=>$sales_details_rows['email_id'],
					'size_id'=>$sales_details_rows['size_id'],
					'cart_status'=>$sales_details_rows['cart_status'],
					'transaction_id'=>$sales_details_rows['transaction_id'],
					'quantity'=>$sales_details_rows['quantity'],
					'price'=>$sales_details_rows['price'],
					'is_sales'=>$sales_details_rows['is_sales'],
					'size_title'=>$sales_details_rows['size_title'],
					'product_name'=>$sales_details_rows['product_name'],
					'gender'=>$sales_details_rows['gender'],
					'description'=>$sales_details_rows['description'],
					'image_url'=>$sales_details_rows['image_url'],
					'image_thumbnail_url'=>$sales_details_rows['image_thumbnail_url'],
					'address_id'=>$sales_details_rows['address_id'],
					'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					'user_address_lastname'=>$sales_details_rows['user_address_lastname'],
					'user_address_phone_number'=>$sales_details_rows['user_address_phone_number'],
					'user_address_address_type'=>$sales_details_rows['user_address_address_type'],
					'user_address_pincode'=>$sales_details_rows['user_address_pincode'],
					'user_address_city'=>$sales_details_rows['user_address_city'],
					'user_address_state'=>$sales_details_rows['user_address_state'],
					'address_value'=>$sales_details_rows['address_value'],
					'is_billing_address'=>$sales_details_rows['is_billing_address'],
					'is_shipping_address'=>$sales_details_rows['is_shipping_address']
				);
				
			}	
if(!empty($data['transaction_id'])){			
			$data['transaction_id']= array_keys(array_flip($data['transaction_id'])); 
} 
			
			
		}
		
		$data['result_count']=$result_count;
		$data['sales_user']=$this->Sales_model->sale_users(false,false,'1');
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('dispatched_sales_view', $data);
		$this->load->view('footer', $data);	
		}		
	public function cancel(){
		$data['sess_user_id']=$this->session->userdata('id');
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');		
		
		$data['sales_status']=$this->Sales_model->sales_status();
		
		
		$user_id=$data['user_select_id']=$this->input->get('user_select_id',true);
		$result_count="0";
		if(is_numeric($user_id)){
			 $sales_details=$this->Sales_model->sale_users($user_id,'cancel');
			
			
			
			foreach($sales_details as $sales_details_rows){			
				$result_count++;
				$data['transaction_id'][]=$sales_details_rows['transaction_id'];
				$data['sales_details'][$sales_details_rows['transaction_id']][]=array(
					'card_id'=>$sales_details_rows['card_id'],
					'user_id'=>$sales_details_rows['user_id'],
					'username'=>$sales_details_rows['username'],
					'firstname'=>$sales_details_rows['firstname'],
					'lastname'=>$sales_details_rows['lastname'],
					'email_id'=>$sales_details_rows['email_id'],
					'size_id'=>$sales_details_rows['size_id'],
					'cart_status'=>$sales_details_rows['cart_status'],
					'transaction_id'=>$sales_details_rows['transaction_id'],
					'quantity'=>$sales_details_rows['quantity'],
					'price'=>$sales_details_rows['price'],
					'is_sales'=>$sales_details_rows['is_sales'],
					'size_title'=>$sales_details_rows['size_title'],
					'product_name'=>$sales_details_rows['product_name'],
					'gender'=>$sales_details_rows['gender'],
					'description'=>$sales_details_rows['description'],
					'image_url'=>$sales_details_rows['image_url'],
					'image_thumbnail_url'=>$sales_details_rows['image_thumbnail_url'],
					'address_id'=>$sales_details_rows['address_id'],
					'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					'user_address_lastname'=>$sales_details_rows['user_address_lastname'],
					'user_address_phone_number'=>$sales_details_rows['user_address_phone_number'],
					'user_address_address_type'=>$sales_details_rows['user_address_address_type'],
					'user_address_pincode'=>$sales_details_rows['user_address_pincode'],
					'user_address_city'=>$sales_details_rows['user_address_city'],
					'user_address_state'=>$sales_details_rows['user_address_state'],
					'address_value'=>$sales_details_rows['address_value'],
					'is_billing_address'=>$sales_details_rows['is_billing_address'],
					'is_shipping_address'=>$sales_details_rows['is_shipping_address']
				);
				
			}	
if(!empty($data['transaction_id'])){			
			$data['transaction_id']= array_keys(array_flip($data['transaction_id'])); 
} 
			
			
		}
		
		$data['result_count']=$result_count;
		$data['sales_user']=$this->Sales_model->sale_users(false,false,'1');
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('cancel_sales_view', $data);
		$this->load->view('footer', $data);
	}
	public function complete(){
		$data['sess_user_id']=$this->session->userdata('id');
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');		
		
		$data['sales_status']=$this->Sales_model->sales_status();
		
		
		$user_id=$data['user_select_id']=$this->input->get('user_select_id',true);
		$result_count="0";
		if(is_numeric($user_id)){
			 $sales_details=$this->Sales_model->sale_users($user_id,'Delivery');
			
			
			
			foreach($sales_details as $sales_details_rows){			
				$result_count++;
				$data['transaction_id'][]=$sales_details_rows['transaction_id'];
				$data['sales_details'][$sales_details_rows['transaction_id']][]=array(
					'card_id'=>$sales_details_rows['card_id'],
					'user_id'=>$sales_details_rows['user_id'],
					'username'=>$sales_details_rows['username'],
					'firstname'=>$sales_details_rows['firstname'],
					'lastname'=>$sales_details_rows['lastname'],
					'email_id'=>$sales_details_rows['email_id'],
					'size_id'=>$sales_details_rows['size_id'],
					'cart_status'=>$sales_details_rows['cart_status'],
					'transaction_id'=>$sales_details_rows['transaction_id'],
					'quantity'=>$sales_details_rows['quantity'],
					'price'=>$sales_details_rows['price'],
					'is_sales'=>$sales_details_rows['is_sales'],
					'size_title'=>$sales_details_rows['size_title'],
					'product_name'=>$sales_details_rows['product_name'],
					'gender'=>$sales_details_rows['gender'],
					'description'=>$sales_details_rows['description'],
					'image_url'=>$sales_details_rows['image_url'],
					'image_thumbnail_url'=>$sales_details_rows['image_thumbnail_url'],
					'address_id'=>$sales_details_rows['address_id'],
					'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					'user_address_firstname'=>$sales_details_rows['user_address_firstname'],
					'user_address_lastname'=>$sales_details_rows['user_address_lastname'],
					'user_address_phone_number'=>$sales_details_rows['user_address_phone_number'],
					'user_address_address_type'=>$sales_details_rows['user_address_address_type'],
					'user_address_pincode'=>$sales_details_rows['user_address_pincode'],
					'user_address_city'=>$sales_details_rows['user_address_city'],
					'user_address_state'=>$sales_details_rows['user_address_state'],
					'address_value'=>$sales_details_rows['address_value'],
					'is_billing_address'=>$sales_details_rows['is_billing_address'],
					'is_shipping_address'=>$sales_details_rows['is_shipping_address']
				);
				
			}if(!empty($data['transaction_id'])){			
			$data['transaction_id']= array_keys(array_flip($data['transaction_id'])); 
			}
			
		}
		
		$data['result_count']=$result_count;
		$data['sales_user']=$this->Sales_model->sale_users(false,false,'1');
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('complete_sales_view', $data);
		$this->load->view('footer', $data);
	}
	
	public function card_up_date_status(){
		
		
		
		$user_session_id = $this->session->userdata('id');				
		$this->input->post('user_id',true);
		$status=trim($this->input->post('status',true));		
		$card_id=trim($this->input->post('card_id',true));		
		$user_select_id=trim($this->input->post('user_select_id',true));
		$email=trim($this->input->post('email',true));
		$product_name=trim($this->input->post('product_name',true));
		
		$page=$this->input->post('page',true);
		
		if(($status!="")&&(is_numeric($card_id))){
			
			$message="Hi, <br>Your Product (".$product_name.") has been ".$status.".";
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$subject="LILME:Your order status";
			// More headers
			$headers .= 'From: <no-reply@lilme.com>' . "\r\n";
			$headers .= 'Bcc: pankajcse1983@gmail.com' . "\r\n";
			//$email="pankaj.g@lastlocal.in";
			mail($email,$subject,$message,$headers);

			$this->Sales_model->card_all_status_modified($card_id,$status,$user_session_id);		
			$data['sales_status']=$this->Sales_model->cart_status_update($card_id,$status);
			echo 1;
		} else {
			echo 0;
			
		}
		/* $f_name="";
		if($page){
			$f_name="/".$page;
		}
		 */
		
		 
		
		
		//$data['sales__status']=$this->Sales_model->card_select($card_id);
		
		
		//redirect('admin/sales'.$f_name.'?user_select_id='.$user_select_id);	
		
		
	}
}
