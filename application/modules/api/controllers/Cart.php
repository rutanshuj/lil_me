<?php
require(APPPATH.'libraries/REST_Controller.php');
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
class Cart extends REST_controller {

	 function __construct()
    {
        parent::__construct();
      	$this->load->Model('Usermodel');
    }
	function test_ss_post(){
		
		
		$this->Usermodel->sendMail1234('pankaj.g@lastlocal.in','pankaj','sss','1');
		
		
	}
	function order_placed_post(){
		$status_code="200";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$cart_id=$this->input->post('cart_id');
		
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
		//$this->response($data,$status_code);
		echo json_encode($data);
	}
	function delivered_post(){
		$status_code="200";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$cart_id=$this->input->post('cart_id');
		
		$data['statusCode']=0;
		if(is_numeric($user_id)&&is_array($cart_id)){
			
			foreach($cart_id as $c_id){
				$update_data[]= array(				
				'id'=>$c_id,
				'user_id'=>$user_id,
				'cart_status'=>'delivered'				
				);
			}
			$this->db->update_batch('cart',$update_data, 'id','user_id'); 
			
			
			$afftected_rows = $this->db->affected_rows();
			if($afftected_rows!=0){
				$data['statusCode']=1;
				$data['message']='Order successfully delivered';
			} else{
				$data['message']='Invalid cart_id';
			}
			
		} else {
			$data['message']='Some data is missing';
		}
		//$this->response($data,$status_code);
		echo json_encode($data);
	}
	function edit_post(){
		$status_code="200";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$cart_id=$this->input->post('cart_id');
		$data['statusCode']=0;
		if(is_numeric($user_id)&&is_numeric($cart_id)){
		
			$this->db->select('user_id');
			$this->db->from('cart');
			$this->db->where('id',$cart_id);
			$this->db->where('user_id',$user_id);
			$query1 = $this->db->get(); 
			$query1->num_rows();
			
			///////////
			$this->db->select('user_id');
			$this->db->from('user_details');
			$this->db->where('user_id',$user_id);
			$this->db->where('api_key',$api_key);
			$query = $this->db->get(); 
			
			if($query->num_rows()=="0"){
				$data['message']='Unauthorised Access';
			} else 	if($query1->num_rows()=="0"){
				$data['message']='Invalid cart id';
			} else {	
				
									
				
				$update_data=array(
					'size_id'=>$this->input->post('size'),
					'quantity'=>$this->input->post('quantity')				
				);
				
				
				$this->db->where('id', $cart_id);
				$this->db->update('cart', $update_data); 
				$data['statusCode']=1;
				$data['message']='Successfully updated';
				
				
				
				
				
				$this->db->select('product.product_name as product_name');
				
				$this->db->from('cart');
				
				$this->db->join('product', 'product.product_id = cart.product_id','left');
				
					$this->db->where('cart.id', $cart_id);
					
					
					$query123 = $this->db->get('');
					$row_0987 = $query123->row();
					
					$data_save12=array(						
						 'user_id'=>$user_id,
						 'product_name'=>$row_0987->product_name,
						 'event_type'=>'Updated in cart'						
					 );
					
					$this->db->insert('user_activity_log', $data_save12);
				
				
				
			}
			
		} else {
			
			$data['message']='Some data is missing';
		}
		
		//$this->response($data,$status_code);
		echo json_encode($data);
	}
	function delete_post(){
		$status_code="200";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$data['statusCode']=0;
		$id=$this->input->post('cart_id');
		
		if(is_numeric($user_id)&&is_numeric($id)){		
			$this->db->select('user_id');
			$this->db->from('user_details');
			$this->db->where('user_id',$user_id);
			$this->db->where('api_key',$api_key);
			$query = $this->db->get(); 
			
			
			$this->db->select('id');
			$this->db->from('cart');
			$this->db->where('id',$id);
			$this->db->where('user_id',$user_id);
			$this->db->where('is_active','1');
			
			$query12 = $this->db->get(); 
			if($query12->num_rows()=="0"){
				$data['message']='Unable to delete';
			} else			
			if($query->num_rows()=="0"){
				$data['message']='Unauthorised Access';
			} else {				
				$update_data=array('is_active'=>'0');
				$this->db->where('id', $id);
				$this->db->update('cart', $update_data); 
				$data['statusCode']=1;
				$data['message']='Successfully deleted';
				
			
					
				$data_save12=array(						
					'user_id'=>$user_id,
					
					'event_type'=>'Cart Deleted'						
				);
					
				$this->db->insert('user_activity_log', $data_save12);
			}
			
		} else {
			
			$data['message']='Some data is missing';
		}
		
		//$this->response($data,$status_code);
		echo json_encode($data);
	}
	function add_post(){
		
		
		$status_code="200";
		
	
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$product_id=$this->input->post('product_id');
		
		$this->db->select('Price');
		$this->db->from('pricing_table');
		$this->db->where('product_id',$product_id);
		$query1 = $this->db->get(); 
		$results=$query1->row();
		$price=$results->Price;
		
		$data['statusCode']=0;
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
		if($validUser){
		if(is_numeric($user_id)&&is_numeric($product_id)){
			$this->db->select('user_id');
			$this->db->from('user_details');
			$this->db->where('user_id',$user_id);
			$this->db->where('api_key',$api_key);
			$query = $this->db->get(); 
						
			$this->db->select('id,quantity');
			$this->db->from('cart');
			$this->db->where('user_id',$user_id);  
			$this->db->where('product_id',$product_id);
			$this->db->where('size_id',$this->input->post('size'));
			$this->db->where('cart_status','cart');
			$this->db->where('is_active','1');
			
			$query12 = $this->db->get(); 
			if($query12->num_rows()!="0"){
				//// update query 
				$ret = $query12->row();
				$ret->id;
				$quantity_t=$ret->quantity+$this->input->post('quantity');
				
				
				
				//////////
				$update_data=array(
					'quantity'=>$quantity_t
								
				);
				
				
				$this->db->where('id', $ret->id);
				$this->db->update('cart', $update_data); 
				$data['statusCode']=1;
				$data['message']='Successfully updated';
				
					$this->db->select('product_name');
					$this->db->where('product_id', $this->input->post('product_id'));
					$this->db->limit(1);// only apply if you have more than same id in your table othre wise comment this line
					$query123 = $this->db->get('product');
					$row_0987 = $query123->row();
					
					$data_save12=array(						
						 'user_id'=>$user_id,
						 'product_name'=>$row_0987->product_name,
						 'event_type'=>'Updated in cart'						
					 );
					
					$this->db->insert('user_activity_log', $data_save12);
				
				////////
				//$data['message']='Product already added in cart';
			} else 				
			if($query->num_rows()=="0"){
				$data['message']='Unauthorised Access';
			} else {
										 
					 $data_save=array(
						 'user_id'=>$user_id,
						 'product_id'=>$this->input->post('product_id'),
						 'size_id'=>$this->input->post('size'),
						 'cart_status'=>'cart',
						 'quantity'=>$this->input->post('quantity'),
						 'price'=>$price
					 );
					 
					$this->db->insert('cart', $data_save); 			
					
					$status_code="200";	
					$data['statusCode']=1;
					$data['message']="Product added to cart";
					
					
									
					$this->db->select('product_name');
					$this->db->where('product_id', $this->input->post('product_id'));
					$this->db->limit(1);// only apply if you have more than same id in your table othre wise comment this line
					$query123 = $this->db->get('product');
					$row_0987 = $query123->row();
					
					$data_save12=array(						
						 'user_id'=>$user_id,
						 'product_name'=>$row_0987->product_name,
						 'event_type'=>'Added to cart'						
					 );
					
					$this->db->insert('user_activity_log', $data_save12);
					
					
				
					
					
					
				}						
		
			
		} else {
			
			$data['message']='Some data is missing';
		}}
		else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}
		
	
		//$this->response($data,$status_code);
		echo json_encode($data);
	}
	
	function list1_post()
	{
		$status_code="200"; 
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$data['statusCode']=0;
		
		if(is_numeric($user_id)){
			$this->db->select('user_id');
			$this->db->from('user_details');
			$this->db->where('user_id',$user_id);
			$this->db->where('api_key',$api_key);
			$query = $this->db->get(); 
			
			if($query->num_rows()=="0"){
				$data['message']='Unauthorised Access';
			} else {
				
				
				
				$this->db->select('cart.id as id,cart.user_id as user_id,cart.product_id as product_id,cart.cart_status as cart_status,cart.quantity as quantity,attribute_value.attribute_value as price, cart.size_id as size');
				$this->db->from('cart');
				
				$this->db->join('attribute_value', 'attribute_value.attribute_id = cart.price and attribute_value.product_id=cart.product_id','left');
				
				$this->db->where('cart.user_id',$user_id);
				
				$this->db->where('cart.is_active',1);
				$this->db->where('cart.cart_status','cart');
				$query = $this->db->get(); 
				$results=$query->result();
				$result_data= array();
				foreach($results as $rows){
					$result_data[]=array(
					'id'=>$rows->id,
					'user_id'=>$rows->user_id,
					'product_id'=>$rows->product_id,
					'size'=>$rows->size,
					'cart_status'=>$rows->cart_status,
					'quantity'=>$rows->quantity,
					'price'=>$rows->price
					);
					
				}
				$data['statusCode']=1;
				$data['data']=$result_data;
							
			
			}
			
		} else {
			
			$data['message']='Some data is missing';
		}
		
	
		//$this->response($data,$status_code);
		echo json_encode($data);
	}
	
	function list2_post()
	{
		$status_code="200";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$data['statusCode']=0;
		
		if(is_numeric($user_id)){
			$this->db->select('user_id');
			$this->db->from('user_details');
			$this->db->where('user_id',$user_id);
			$this->db->where('api_key',$api_key);
			$query = $this->db->get(); 
			
			if($query->num_rows()=="0"){
				$data['message']='Unauthorised Access';
			} else {
				
				
				
				
				 $this->db->select('product_images.image_id as image_id,product_images.image_url as image_url,product_images.image_thumbnail_url as image_thumbnail_url,product_images.product_id as product_images_product_id,cart.id as id,cart.user_id as user_id,cart.product_id as product_id,cart.cart_status as cart_status,cart.quantity as quantity,cart.price as price,cart.size_id as size,product.product_name as product_name');
				$this->db->from('cart');
				$this->db->where('cart.user_id',$user_id);
				$this->db->join('product_images', 'product_images.product_id = cart.product_id','left');
				$this->db->join('product', 'product.product_id = cart.product_id','left');
				
				//$this->db->join('attribute_value', 'attribute_value.attribute_id = cart.price and attribute_value.product_id=cart.product_id','left');
				
				$this->db->where('cart.is_active',1);
				$this->db->where('cart.cart_status','cart');
				$query = $this->db->get(); 
				$results=$query->result_array();
				$total_quantity=$total_price="0";
				$product_image=$product_details= $result_data=array();
				$ids = array();
				foreach($results as $result_row){					
					$image_url[$result_row['product_id']]=base_url().$result_row['image_url'];
					$image_thumbnail_url[$result_row['product_id']]=base_url().$result_row['image_thumbnail_url'];
					
					array_push($ids, $result_row['product_id']);
					
					
					$product_details[$result_row['product_id']]=array(
						'id'=>$result_row['id'],
						'user_id'=>$result_row['user_id'],
						'product_id'=>$result_row['product_id'],
						'size'=>$result_row['size'],
						'cart_status'=>$result_row['cart_status'],
						'quantity'=>$result_row['quantity'],
						'price'=>$result_row['quantity']*$result_row['price'],
						'original_price'=>$result_row['price'],
						'product_name'=>$result_row['product_name']
					);					
				}
				//print_r($ids);
				
				
				/* $this->db->select('id, email, first_name, last_name, current_location_state, current_location, avatar, avatar_fb');
				$this->db->from('users');
        
				$this->db->where_in('id', $ids);
				$query = $this->db->get(); */
          
				
				
				
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
					
					$total_price=$total_price+$rows['price'];
					
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
									
				$data['total_quantity']=$total_quantity;
				$data['total_price']=$total_price;
				
				if(count($result_data)=="0"){
					$data['statusCode']=0;
					$data['message']="No product available in your cart";
				} else {
					$data['statusCode']=1;
					$data['data']=$result_data;
				}
				
				
							
			
			}
			
		} else {
			
			$data['message']='Some data is missing';
		}
		
	
		//$this->response($data,$status_code);
		echo json_encode($data);
	}
	
	function product_size_quantity_post(){
		$status_code="200";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$product_id=$this->input->post('product_id');
		$data['statusCode']=1;
		
		if(is_numeric($product_id)){
		
			$this->db->select('quantity,size_title')
				->from('product_option_mapper pom')
				->join('master_size ms','ms.size_id=pom.size_id')
				->where('product_id',$product_id);
			$getsize=$this->db->get();
			
			if(count($getsize->result()!="0")){
			
				foreach ($getsize->result() as $size_row) {
					//$data['data'][]=array('size'=>$size_row->size_title);	
					$data['data'][]=$size_row->size_title;	
					 
				}
			} else {
				$data['message']='Zero record found';
			}
		} else {
			$data['message']='Some data is missing';
		}
		
		echo json_encode($data);
		
	}
	
	function list_post(){
			$status_code="200";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$data['statusCode']=0;
		
		$data_message= $this->Usermodel->isValidUser_veryfy($user_id,$api_key);
			
			if($data_message=="Your Account Is Disable By Admin"){
				$data['message']=$data_message;
				$data['statusCode']=0;
			
			} else if(is_numeric($user_id)){
				
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
				
				$this->db->select('				cart.id as id,cart.user_id as user_id,
				cart.product_id as product_id,cart.cart_status as cart_status,cart.quantity as quantity,
				cart.price as price,
				master_size.size_title as size,product.product_name as product_name');
				$this->db->from('cart');
				$this->db->where('cart.user_id',$user_id);
				//$this->db->join('product_images', 'product_images.product_id = cart.product_id','left');
				$this->db->join('product', 'product.product_id = cart.product_id','left');
				$this->db->join('master_size', 'master_size.size_title = cart.size_id','left');
				
				
				$this->db->where('cart.is_active',1);
				$this->db->where('cart.cart_status','cart');
				$query = $this->db->get(); 
				$results=$query->result_array();
				//echo "<pre>";print_r($results);exit;
				
				$total_quantity=$total_price="0";
				$product_image=$product_details= $result_data=array();
				$ids = array();
				$product_image_url="";
				$product_image_thumbnail_url="";
				
				
				
				foreach($results as $result_row){					
					//$image_url[$result_row['product_id']]=base_url().$result_row['image_url'];
					//$image_thumbnail_url[$result_row['product_id']]=base_url().$result_row['image_thumbnail_url'];
					if(!in_array($result_row['product_id'], $ids)) {
						array_push($ids, $result_row['product_id']);
					}
					$total_quantity=$total_quantity+$result_row['quantity'];
					$total_price=$total_price+$result_row['price'];
					////////////////////////////////
					//if(!isset($size_pro_id[$result_row['product_id']])){
						$size=array();
						$this->db->select('quantity,size_title')
						->from('product_option_mapper pom')
						->join('master_size ms','ms.size_id=pom.size_id','left')
						->where('product_id',$result_row['product_id']);
						$getsize=$this->db->get();
						//echo $this->db->last_query();
						 foreach ($getsize->result() as $size_row)
						 {
							 $size_pro_id[$result_row['product_id']]=$result_row['product_id'];
							 $size[]=$size_row->size_title;
						 }
						 ////////////////////////////
						 $product_image_url=$product_image_thumbnail_url="";
						 $this->db->select('image_id,image_url,image_thumbnail_url')
						->from('product_images')
						
						->where('product_id',$result_row['product_id']);
						$getimage=$this->db->get();
						//echo $this->db->last_query();
						 foreach ($getimage->result() as $getimage_row)
						 {
							
							 $product_image_url=base_url().$getimage_row->image_url;
							 $product_image_thumbnail_url =base_url().$getimage_row->image_thumbnail_url;
						 }						 
						 /////////////////////////////							 
					//}
					/////////////////////////////////
					
					
					
					
					
					$product_details[]=array(
						'id'=>$result_row['id'],
						'user_id'=>$result_row['user_id'],
						'product_id'=>$result_row['product_id'],
						'size'=>$result_row['size'],
						'size_available'=>$size,
						'cart_status'=>$result_row['cart_status'],
						'quantity'=>$result_row['quantity'],
						'price'=>($result_row['quantity']*$result_row['price'])."&#8377",
						'original_price'=>$result_row['price'],
						'product_name'=>$result_row['product_name'],
						'image_url'=>$product_image_url,
						'image_thumbnail_url'=>$product_image_thumbnail_url
					);					
				}
				//echo "<pre>";print_r($product_details);exit;
				/* if(count($ids)!="0"){						
					foreach($product_details as $rows){
						$size=array();	
						$product_image_url="";
						$product_image_thumbnail_url="";
						if(isset($image_url[$rows['product_id']])){
							$product_image_url =$image_url[$rows['product_id']];
						}
						if(isset($image_thumbnail_url[$rows['product_id']])){
							$product_image_thumbnail_url =$image_thumbnail_url[$rows['product_id']];
						}						
						$total_quantity=$total_quantity+$rows['quantity'];						
						$total_price=$total_price+$rows['price'];						
						if(isset($proj_name[$rows['product_id']])){
							$product_name=$proj_name[$rows['product_id']];
						} else {
							$product_name=$rows['product_name'];
						}
						$this->db->select('quantity,size_title')
						->from('product_option_mapper pom')
						->join('master_size ms','ms.size_id=pom.size_id','left')
						->where('product_id',$rows['product_id']);
						$getsize=$this->db->get();
						//echo $this->db->last_query();
						 foreach ($getsize->result() as $size_row)
						 {
							 $size[]=$size_row->size_title;
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
							'image_thumbnail_url'=>$product_image_thumbnail_url
						);	
						
							
						unset($size);
						
					}
					
				} */					
				$data['total_quantity']=$total_quantity;
				$data['total_price']=$total_price;
				$data['total_item']=count($product_details);	
				if(count($product_details)=="0"){
					$data['statusCode']=0;
					$data['message']="No product available in your cart";
				} else {
					$data['statusCode']=1;
					$data['data']=$product_details;
				}
				
				
							
			
			}
			
		} else {
			
			$data['message']='Some data is missing';
		}
		
	
		//$this->response($data,$status_code);
		echo json_encode($data);
	}
	
	function list_old_post(){
	
		$status_code="200";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$data['statusCode']=0;
		
		if(is_numeric($user_id)){
			$this->db->select('user_id');
			$this->db->from('user_details');
			$this->db->where('user_id',$user_id);
			$this->db->where('api_key',$api_key);
			$query = $this->db->get(); 
			
			if($query->num_rows()=="0"){
				$data['message']='Unauthorised Access';
			} else {
				
				
				
				
				$this->db->select('product_images.image_id as image_id,product_images.image_url as image_url,
				product_images.image_thumbnail_url as image_thumbnail_url,product_images.product_id as product_images_product_id,
				cart.id as id,cart.user_id as user_id,
				cart.product_id as product_id,cart.cart_status as cart_status,cart.quantity as quantity,
				cart.price as price,
				master_size.size_title as size,product.product_name as product_name');
				$this->db->from('cart');
				$this->db->where('cart.user_id',$user_id);
				$this->db->join('product_images', 'product_images.product_id = cart.product_id','left');
				$this->db->join('product', 'product.product_id = cart.product_id','left');
				$this->db->join('master_size', 'master_size.size_title = cart.size_id','left');
				
				
				$this->db->where('cart.is_active',1);
				$this->db->where('cart.cart_status','cart');
				$query = $this->db->get(); 
				$results=$query->result_array();
				//echo "<pre>";print_r($results);exit;
				
				$total_quantity=$total_price="0";
				$product_image=$product_details= $result_data=array();
				$ids = array();
				foreach($results as $result_row){					
					$image_url[$result_row['product_id']]=base_url().$result_row['image_url'];
					$image_thumbnail_url[$result_row['product_id']]=base_url().$result_row['image_thumbnail_url'];
					if(!in_array($result_row['product_id'], $ids)) {
						array_push($ids, $result_row['product_id']);
					}
					
					$product_details[$result_row['product_id']]=array(
						'id'=>$result_row['id'],
						'user_id'=>$result_row['user_id'],
						'product_id'=>$result_row['product_id'],
						'size'=>$result_row['size'],
						'cart_status'=>$result_row['cart_status'],
						'quantity'=>$result_row['quantity'],
						'price'=>($result_row['quantity']*$result_row['price'])."&#8377",
						'original_price'=>$result_row['price'],
						'product_name'=>$result_row['product_name']
					);					
				}
				//echo "<pre>";print_r($ids);exit;
				if(count($ids)!="0"){
				
						
					foreach($product_details as $rows){
						$size=array();	
						$product_image_url="";
						$product_image_thumbnail_url="";
						if(isset($image_url[$rows['product_id']])){
							$product_image_url =$image_url[$rows['product_id']];
						}
						if(isset($image_thumbnail_url[$rows['product_id']])){
							$product_image_thumbnail_url =$image_thumbnail_url[$rows['product_id']];
						}
						
						$total_quantity=$total_quantity+$rows['quantity'];
						
						$total_price=$total_price+$rows['price'];
						
						if(isset($proj_name[$rows['product_id']])){
							$product_name=$proj_name[$rows['product_id']];
						} else {
							$product_name=$rows['product_name'];
						}
						$this->db->select('quantity,size_title')
						->from('product_option_mapper pom')
						->join('master_size ms','ms.size_id=pom.size_id','left')
						->where('product_id',$rows['product_id']);
						$getsize=$this->db->get();
						//echo $this->db->last_query();
						 foreach ($getsize->result() as $size_row)
						 {
							 $size[]=$size_row->size_title;
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
							'image_thumbnail_url'=>$product_image_thumbnail_url
						);	
						
							
						unset($size);
						
					}
					
				}					
				$data['total_quantity']=$total_quantity;
				$data['total_price']=$total_price;
				$data['total_item']=count($result_data);	
				if(count($result_data)=="0"){
					$data['statusCode']=0;
					$data['message']="No product available in your cart";
				} else {
					$data['statusCode']=1;
					$data['data']=$result_data;
				}
				
				
							
			
			}
			
		} else {
			
			$data['message']='Some data is missing';
		}
		
	
		//$this->response($data,$status_code);
		echo json_encode($data);
		  
	}
	
	}
?>      