<?php
class Cart_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		setlocale(LC_MONETARY, 'en_IN');
		
    }
function get_cartList($user_id,$api_key)
{
	$data=array();
	//echo $user_id."  ".$api_key;
					
				$this->db->select('product_images.image_id as image_id,product_images.image_url as image_url,product.category_id,
				product_images.image_thumbnail_url as image_thumbnail_url,product_images.product_id as product_images_product_id,
				cart.id as id,cart.user_id as user_id,
				cart.product_id as product_id,cart.cart_status as cart_status,cart.quantity as quantity,
				cart.price as price,product_category.category_slug,
				master_size.size_title as size,product.product_name as product_name');
				$this->db->from('cart');
				$this->db->where('cart.user_id',$user_id);
				
				$this->db->join('product_images', 'product_images.product_id = cart.product_id','left');
				$this->db->join('product', 'product.product_id = cart.product_id','left');
				//---prani's code
				$this->db->join('product_category', 'product_category.category_id = product.category_id','left');
				$this->db->join('master_size', 'master_size.size_id = cart.size_id','left');
				$this->db->order_by('image_id','desc');
				
				$this->db->where('cart.is_active',1);
				
				$this->db->where('cart.cart_status','cart');
				$query = $this->db->get(); 
				
				
				$results=$query->result_array();
				
				
				$total_quantity=$total_price="0";
				$total_discount=$total_tax="0";
				$product_image=$product_details= $result_data=array();
				$ids =$category_id= array();
				//echo $this->db->last_query();
				foreach($results as $result_row){					
					$image_url[$result_row['product_id']]=base_url().$result_row['image_url'];
					$image_thumbnail_url[$result_row['product_id']]=base_url().$result_row['image_thumbnail_url'];
					if(!in_array($result_row['product_id'], $ids)) {
						array_push($ids, $result_row['product_id']);
						array_push($category_id,$result_row['category_id'] );
					}
					
					$product_details[$result_row['product_id']]=array(
						'id'=>$result_row['id'],
						'user_id'=>$result_row['user_id'],
						'product_id'=>$result_row['product_id'],
						'size'=>$result_row['size'],
						'cart_status'=>$result_row['cart_status'],
						'quantity'=>$result_row['quantity'],
						'price'=>$result_row['quantity']*$result_row['price'],
						'original_price'=>$result_row['price'],
						'product_name'=>$result_row['product_name'],
						'category_slug'=>$result_row['category_slug']
						
					);					
				}
				/* echo"<pre>";
				print_r($product_details);
				echo"</pre>";
				die(); */
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
						
						$total_price=$total_price=$total_price+$rows['price'];
						
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
							'category_slug'=>$rows['category_slug'],
							
							'price'=>$rows['price'], //money_format('%!i', $rows['price']),
							'original_price'=>sprintf("%0.2f",$rows['original_price']),
							//'original_price'=>money_format('%!i', $rows['original_price']),
							'product_name'=>$product_name,
							//---prani's code
							'product_slug'=>url_title($product_name, 'dash', true),
							'image_url'=>$product_image_url,
							'image_thumbnail_url'=>$product_image_thumbnail_url,
							
						);		
					unset($size);
					}
					
						
				$data['related_products']=$this->related_products($category_id);
				$data['total_quantity']=$total_quantity;
				$data['total_price']=$total_price;//money_format('%!i',$total_price);
				$data['total_item']=count($result_data);	
				$data['data']=$result_data;
				$data['total_discount']=$total_discount;
				$data['total_tax']=$total_tax;
				$data['final_price']=$final_price;//money_format('%!i',$final_price);
				
		// echo"<pre>";
		// print_r($data);
		// echo"</pre>"; 
		// exit;
	
	}
	return $data;
}
function related_products($category_arr){
		
		$products=array();
		$this->db->limit(4);
		$this->db->select('product_id,product_name,pc.category_slug')
				->from('product p')
				->where('p.is_active',1)
				->join('product_category pc','p.category_id=pc.category_id')
				->where_in('pc.category_id',$category_arr);
				$query = $this->db->get();
		foreach ($query->result() as $row) {
					
					$getname ="SELECT attribute_value
						FROM attribute_value av
						WHERE av.product_id=".$row->product_id." and av.attribute_id =
						(select attribute_id
						from attribute 
						where attribute_name LIKE 'product name')";
						$getname_query = $this->db->query($getname);
						foreach ($getname_query->result() as $name) {
							 $row->product_name=$name->attribute_value;
							 $row->product_slug=url_title($name->attribute_value, 'dash', true);
						}
					
					$this->db->limit(1)
					->from('product_images')
           			->where('product_id',$row->product_id)
					->order_by('image_id','asc');
					$getImg = $this->db->get();
				
					//print_r($getImg->result());
					//$default_img=URL_CONST. str_replace('\\', '/',$imgRow->image_url);
					//$default_thumb=URL_CONST. str_replace('\\', '/',$imgRow->image_thumbnail_url);
					if($getImg->num_rows()==0)
					{	
						$row->image_url=' ';
						$row->thumbnail_url=' ';
					}
					else{
					$imgRow=$getImg->row();
					$row->image_url=$imgRow->image_url;
					$row->thumbnail_url=$imgRow->image_thumbnail_url;	
					}
					
					$products[]=$row;
		}
		
		return $products;	
		//return 
		
}
function delete_cart($cart_id,$user_id,$api_key){
		
		$id=$cart_id;
		//echo $user_id." ".$api_key;
		$data['statusCode']=0;
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
			}
			
		} else {
			
			$data['message']='Some data is missing';
		}
		return $data;
		//$this->response($data,$status_code);
	}
	function edit_cart($cart_id,$user_id,$api_key,$size,$quantity){
		
		$data['statusCode']=0;
		$update_data=array();
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
				
									
				if(isset($size) && $size!='')
				{
				$update_data['size_id']=$size;
				}
				if(isset($quantity) && $quantity!='')
				{
				$update_data['quantity']=$quantity;
				}
				
				
				
				$this->db->where('id', $cart_id);
				$this->db->update('cart', $update_data); 
				
				$data['statusCode']=1;
				$data['message']='Successfully updated';
			}
			
		} else {
			
			$data['message']='Some data is missing';
		}
		return $data;
		//$this->response($data,$status_code);
	}
	
	function add($user_id,$api_key,$product_id,$size,$quantity){
		
		
		$status_code="200";
		$this->db->select('Price');
		$this->db->from('pricing_table');
		$this->db->where('product_id',$product_id);
		$query1 = $this->db->get(); 
		$results=$query1->row();
		$price=$results->Price;
	
		$data['statusCode']=0;
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
		//echo $validUser;
		if($validUser){
		if(is_numeric($user_id)&&is_numeric($product_id)){
			$this->db->select('user_id');
			$this->db->from('user_details');
			$this->db->where('user_id',$user_id);
			$this->db->where('api_key',$api_key);
			$query = $this->db->get(); 
						
			$this->db->select('id');
			$this->db->from('cart');
			$this->db->where('user_id',$user_id);  
			$this->db->where('product_id',$product_id);
			$this->db->where('size_id',$size);
			$this->db->where('cart_status','cart');
			$this->db->where('is_active','1');
			
			$query12 = $this->db->get(); 
			if($query12->num_rows()!="0"){
				$data['message']='Product already added in cart';
			} else 				
			if($query->num_rows()=="0"){
				$data['message']='Unauthorised Access';
			} else {
										 
					 $data_save=array(
						 'user_id'=>$user_id,
						 'product_id'=>$product_id,
						 'size_id'=>$size,
						 'cart_status'=>'cart',
						 'quantity'=>$quantity,
						 'price'=>$price
					 );
					
					$this->db->insert('cart', $data_save); 			
					
					$status_code="200";	
					$data['statusCode']=1;
					$data['message']="Product added to cart";
				}						
		
			
		} else {
			
			$data['message']='Some data is missing';
		}}
		else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}
		
		return $data;
		//$this->response($data,$status_code);
	}
	
	function get_cartdata_for_session($session_data)
		{
        $total_quantity=$total_price="0";
		$product_image=$product_details= $result_data=array();
		foreach($session_data as $result_row){					
				
					
					$product_details[]=array(
						//'id'=>$result_row['id'],
						//'user_id'=>$result_row['user_id'],
						'product_id'=>$result_row['product_id'],
						'size'=>$result_row['size'],
						//'cart_status'=>$result_row['cart_status'],
						'quantity'=>$result_row['quantity'],
						'price'=>$result_row['quantity']*$result_row['price'],
						'original_price'=>$result_row['price'],
						'product_name'=>$result_row['product_name']
					);					
				}
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
							//'id'=>$rows['id'],
							//'user_id'=>$rows['user_id'],
							'product_id'=>$rows['product_id'],
							'size'=>$rows['size'],
							'size_available'=>$size,
							//'cart_status'=>$rows['cart_status'],
							'quantity'=>$rows['quantity'],
							//'price'=>$rows['price'],
							'original_price'=>$rows['original_price'],
							'product_name'=>$product_name,
							'image_url'=>$product_image_url,
							'image_thumbnail_url'=>$product_image_thumbnail_url
						);		
					unset($size);
					}
				$data['total_quantity']=$total_quantity;
				$data['total_price']=$total_price;
				$data['total_item']=count($result_data);	
				$data['data']=$result_data;
		
		/* 
		echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die();	 */		
		return $data;
   }
}
?>