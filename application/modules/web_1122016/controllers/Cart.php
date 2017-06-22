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
		function add()
	{
		$user_id=trim($this->input->post('user_id',true));
		$product_id=trim($this->input->post('product_id',true));
		$api_key=trim($this->input->post('api_key',true));
		$size=trim($this->input->post('size',true));
		$quantity=trim($this->input->post('quantity',true));
		$data=$this->Cart_model->add($user_id,$api_key,$product_id,$size,$quantity);
		
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