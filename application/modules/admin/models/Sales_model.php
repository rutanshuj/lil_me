<?php
class Sales_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
	
    }
 
	function card_product(){
		$this->db->select('product.product_id as product_id,product.product_name as product_name ');
		$this->db->from('cart');
		$this->db->join('product','product.product_id=cart.product_id');
		$this->db->group_by('product.product_id');
		return $this->db->get()->result_array();
	}
	function user_address_details($user_id=false){
		
		//if(is_numeric($user_id)){	
					
			$this->db->select('user_address.address_id as  address_id, user_address.user_id as  user_id,user_address.firstname as  firstname, user_address.lastname as  lastname,user_address.phone_number as phone_number, user_address.address_type as  address_type,user_address.pincode as  pincode ,user_address.city as  city,user_address.state as  state,user_address.address_value as address_value ');
			if(is_numeric($user_id)){
				$this->db->where('user_id',$user_id);
			}
			$this->db->from('user_address');	
			return $this->db->get()->result_array();
		//} 
		
	} 
	
	function cart_details($user_id=false,$status=false,$limit=false,$product_id=false,$start_date=false,$end_date=false,$not_select=false){
		
		
		if(is_numeric($product_id)){
			$this->db->where('cart.product_id',$product_id);
			
		}
		if($not_select=="1"){
			$this->db->where('cart.cart_status!=','cart');
			$this->db->where('order_tracker.order_status!=','cancelled');
			$this->db->where('order_tracker.order_status!=','delivered');
			//$this->db->where('order_tracker.order_status',$status);
		}		
		if(isset($start_date)&&($start_date!="")){
			
			$start_date_a=explode('-',$start_date);
			$start_date=$start_date_a['2']."-".$start_date_a['1']."-".$start_date_a['0'];
			
			$this->db->where('cart.created_on >=',$start_date);
		}
		if(isset($end_date)&&($end_date!="")){
			$end_date_a=explode('-',$end_date);
			$end_date=$end_date_a['2']."-".$end_date_a['1']."-".$end_date_a['0'];
			$this->db->where('cart.created_on <=',$end_date);
		}
		if(is_numeric($user_id)){
			$this->db->where('cart.user_id',$user_id);
		}
		if(isset($status)&&($limit=="1")){
			$this->db->where('cart.cart_status!=','cart');
			$this->db->where('order_tracker.order_status',$status);
		}
		if(isset($status)&&($limit!="0")&&($limit!="1")){
			$this->db->where('cart.cart_status',$status);
		}
		 if($limit=="0"){
			 $this->db->where('cart.cart_status!=','cart');
			 
		 }
		
	if($not_select=="2"){
			$this->db->where('cart.cart_status!=','cart');
			
			 $where = '(order_tracker.order_status="cancelled" or order_tracker.order_status = "delivered")';
			$this->db->where($where);
			
			
			//$this->db->where('order_tracker.order_status',$status);
		}
		
		
		$this->db->select('cart.individual_discount as cart_individual_discount, cart.tax as cart_tax,order_tracker.order_status as order_tracker_order_status, order_tracker.tracker_id as order_tracker_id,cart.id as card_id,user_details.user_id as user_id,user_details.username as username,user_details.firstname as firstname, user_details.lastname as lastname,user_details.email_id as email_id,cart.size_id as size_id,cart.cart_status as cart_status,cart.transaction_id as transaction_id, cart.quantity as quantity,cart.price as price ,cart.is_sales as is_sales, master_size.size_title as size_title,product.product_name as product_name, product.gender as gender,product.description as description, user_address.address_id as address_id ,user_address.firstname as user_address_firstname, user_address.lastname as user_address_lastname ,user_address.phone_number as user_address_phone_number ,user_address.address_type as user_address_address_type ,user_address.pincode as user_address_pincode ,user_address.city as user_address_city ,
		user_address.state as user_address_state,user_address.address_value as address_value ,user_address.is_billing_address as is_billing_address ,user_address.is_shipping_address as is_shipping_address,cart.product_id as c_product_id, product.individual_discount as product_individual_discount, user_transactions.payu_txn_id as trans_payu_txn_id ,user_transactions.payu_transaction_status as trans_payu_transaction_status ,user_transactions.additional_charges as  trans_additional_charges ,user_transactions.payu_txn_amount as trans_payu_txn_amount ,user_transactions.offer_discount as  trans_offer_discount ,user_transactions.taxes as trans_taxes ,user_transactions.billing_address_id as trans_billing_address_id ,user_transactions.shipping_address_id as trans_shipping_address_id,user_transactions.created_on as  transaction_created_on, user_transactions.user_transactions_mode as user_transactions_mode, user_transactions.total_product as total_product');
		$this->db->from('cart');		
		$this->db->join('user_details','user_details.user_id=cart.user_id','left');
		$this->db->join('master_size','master_size.size_id=cart.size_id','left');
		$this->db->join('order_tracker','order_tracker.cart_id=cart.id','left');
		$this->db->join('product','product.product_id=cart.product_id','left');
		$this->db->join('user_transactions','user_transactions.transaction_id=cart.transaction_id','left');
		
		
			
			
		
		
		//$this->db->join('product_images','product_images.product_id=cart.product_id','left');
		$this->db->join('user_address','user_address.address_id=cart.user_address and user_address.user_id=cart.user_id','left');
		return $this->db->get()->result_array();
		
	}
	
	
	/////////////
	function card_all_status_modified($card_id,$status,$user_session_id){
		$data = array(
		   'cart_id' => $card_id ,
		   'status_modified' => $status ,
		   'modified_by' => $user_session_id
		);

		$this->db->insert('cart_status_modified', $data); 
	}
		
	
	function sales_status(){
		$this->db->select('id, sales_status');
		$this->db->from('sales_status');
		return $this->db->get()->result_array();
	}
	
	function card_select($card_id){
		if(is_numeric($card_id)){
			$this->db->where('cart.id',$card_id);
		} else {
			$this->db->group_by('cart.user_id');
		}
		$this->db->select('cart.id as order_id,user_details.user_id as user_id,user_details.username as username,user_details.firstname as firstname, user_details.lastname as lastname,user_details.email_id as email_id,cart.size_id as size_id,cart.cart_status as cart_status,cart.transaction_id as transaction_id, cart.quantity as quantity,cart.price as price ,cart.is_sales as is_sales, master_size.size_title as size_title,product.product_name as product_name, product.gender as gender,product.description as description, product_images.image_url as image_url, product_images.image_thumbnail_url as image_thumbnail_url ');
		$this->db->from('cart');
		$this->db->join('user_details','user_details.user_id=cart.user_id','left');
		$this->db->join('master_size','master_size.size_id=cart.size_id','left');
		$this->db->join('product','product.product_id=cart.product_id','left');
		$this->db->join('product_images','product_images.product_id=cart.product_id','left');
		
		
		
		return $this->db->get()->result_array();
		
	}
	
	function cart_status_update($card_id=false,$status=false){
		$data = array(            
            'order_status' => $status
        );

		$this->db->where('tracker_id', $card_id);
		$this->db->update('order_tracker', $data); 
		
	}
	
	
	function sale_users($user_id=false,$card_status=false,$only_user=false){
		
		if($only_user=="1"){
			$this->db->group_by('cart.user_id');
		}else{
			
			if(is_numeric($user_id)){
				$this->db->where('cart.user_id',$user_id);
				if($card_status!=""){
					$this->db->where('cart.cart_status',$card_status);
				}
				
			} else {
				//$this->db->group_by('cart.user_id,cart.id');
			}
			//$this->db->group_by('cart.user_id,cart.id');
		}
		
		//product_images.image_url as image_url, product_images.image_thumbnail_url as image_thumbnail_url,
		
		$this->db->select('cart.id as card_id,user_details.user_id as user_id,user_details.username as username,user_details.firstname as firstname, user_details.lastname as lastname,user_details.email_id as email_id,cart.size_id as size_id,cart.cart_status as cart_status,cart.transaction_id as transaction_id, cart.quantity as quantity,cart.price as price ,cart.is_sales as is_sales, master_size.size_title as size_title,product.product_name as product_name, product.gender as gender,product.description as description, user_address.address_id as address_id ,user_address.firstname as user_address_firstname, user_address.lastname as user_address_lastname ,user_address.phone_number as user_address_phone_number ,user_address.address_type as user_address_address_type ,user_address.pincode as user_address_pincode ,user_address.city as user_address_city ,
		user_address.state as user_address_state,user_address.address_value as address_value ,user_address.is_billing_address as is_billing_address ,user_address.is_shipping_address as is_shipping_address,cart.product_id as c_product_id, product.individual_discount as product_individual_discount');
		$this->db->from('cart');		
		$this->db->join('user_details','user_details.user_id=cart.user_id','left');
		$this->db->join('master_size','master_size.size_id=cart.size_id','left');
		$this->db->join('order_tracker','order_tracker.cart_id=cart.id','left');
		$this->db->join('product','product.product_id=cart.product_id','left');
		//$this->db->join('product_images','product_images.product_id=cart.product_id','left');
		$this->db->join('user_address','user_address.address_id=cart.user_address and user_address.user_id=cart.user_id','left');
				
				
		return $this->db->get()->result_array();
		
		
		
	}
	
	function sale_according_user($user_id){
		
		
		
	}
	
    

	


}
?>