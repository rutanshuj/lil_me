<?php
//require(APPPATH.'libraries/REST_Controller.php');
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
class Cart extends CI_controller {

	 function __construct()
    {
        parent::__construct();
      	$this->load->Model('Usermodel');
		$this->load->Model('Cart_model');
		$this->load->library('cart');
    }
	
	function delete_cartItem()
	{
		$user_id=trim($this->input->post('user_id',true));
		$cart_id=trim($this->input->post('cart_id',true));
		$api_key=trim($this->input->post('api_key',true));
		$this->Cart_model->delete_cart($cart_id,$user_id,$api_key);
		$data=$this->Cart_model->get_cartList($user_id,$api_key);
		echo json_encode($data);
	}
	function order_placed(){
		$status_code="200";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$cart_id=array();
		$this->db->select('id');
		$this->db->from('cart');
		$this->db->where('user_id',$user_id);
		$this->db->where('is_active',1);
		$query = $this->db->get(); 
		
			 foreach ($query->result() as $row)
			   {
				   $cart_id[]=$row->id;
			   }
		$data['statusCode']=0;
		if(is_numeric($user_id)&&is_array($cart_id)){
			
			foreach($cart_id as $c_id){
				$update_data[]= array(				
				'id'=>$c_id,
				'user_id'=>$user_id,
				'cart_status'=>'order_placed'				
				);
			}
			$this->db->update_batch('cart',$update_data, 'id','user_id');   
			
			
			$afftected_rows = $this->db->affected_rows();
			if($afftected_rows!=0){
				$data['statusCode']=1;
				$data['message']='Order placed successfully';
			} else{
				$data['message']='Invalid cart_id';
			}
			
		} else {
			$data['message']='Some data is missing';
		}
		
		echo json_encode($data);
	}
		function add()
	{
		$cart_row=array();
		$cart_data=array();
		$user_id=trim($this->input->post('user_id',true));
		$product_id=trim($this->input->post('product_id',true));
		$api_key=trim($this->input->post('api_key',true));
		$size=trim($this->input->post('size',true));
		$quantity=trim($this->input->post('quantity',true));
		$price=trim($this->input->post('price',true));
		$product_name=trim($this->input->post('product_name',true));
		
		if(!isset($user_id)||!is_numeric($user_id))
		{
		$product=array('product_id'=>$product_id,
		'size'=>$size,
		'quantity'=>$quantity,
		'price'=>$price,
		'product_name'=>$product_name
		);
		
		$this->session->set_userdata("cart[".$product_id."]", $product);		
		$data['statusCode']=1; 
		$data['message']='Product Added to Cart';
		//$this->cart->insert($data);
		}else{
		$data=$this->Cart_model->add($user_id,$api_key,$product_id,$size,$quantity);	
		}
		echo json_encode($data);
	}
	function edit_cartItem()
	{
		$user_id=trim($this->input->post('user_id',true));
		$cart_id=trim($this->input->post('cart_id',true));
		$api_key=trim($this->input->post('api_key',true));
		$size=trim($this->input->post('size',true));
		$quantity=trim($this->input->post('quantity',true));
		$this->Cart_model->edit_cart($cart_id,$user_id,$api_key,$size,$quantity);
	
		$data=$this->Cart_model->get_cartList($user_id,$api_key);
		
		echo json_encode($data);
		
	}
	function get_cartdata()
	{
		$user_id=trim($this->input->post('user_id',true));
		
		$api_key=trim($this->input->post('api_key',true));
		
		$data=$this->Cart_model->get_cartList($user_id,$api_key);
	
		echo json_encode($data);
		
	}
	}
?>      