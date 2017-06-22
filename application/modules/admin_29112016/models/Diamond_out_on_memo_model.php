<?php
class Diamond_out_on_memo_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	function step_two_product(){
		$this->db->where('status','AVAILABLE');
		$this->db->select('product_diamond.product_id as product_id, product_diamond.product_name as product_name, product_diamond.updated_on as updated_on');
		$this->db->from('product_diamond');		
		$query = $this->db->get('');		
		
			
		return $query->result() ;
	}
	function user_details_get($id=false){
		$current_date=date("Y-m-d");
		if(is_numeric($id)){
			$this->db->where('user_id',$id);
		} else{
			$this->db->where('valid_through>=',$current_date);
			$this->db->where('OTP_confirmed','1');
			$this->db->where('is_enable','1');
		}
		$this->db->select('user_id, username,firstname,lastname,email_id,user_type,valid_through');		
					
		$query = $this->db->get('user_details');		
		
		return $query->result() ;
	}
	
	function memo_reject($id=false,$data=false){
		if(is_numeric($id)&&($data!="")){
			$this->db->where('out_on_memo_id', $id);
			$this->db->update('out_on_memo_diamond', $data);
		}
	}

	function get_diamond_Due_memo($date=false,$status = false,$request=false){
		if(isset($date)){
			$this->db->like('out_on_memo_diamond.memo_request_date',$date);
		}
		if(isset($status)){
			$this->db->where('out_on_memo_diamond.status',$status);
		}
		
		if(isset($request)&&(is_numeric($request))){
			$this->db->where('out_on_memo_diamond.request',$request);
		}
		
		
		$this->db->select('out_on_memo_diamond.expiry_date as expiry_date,out_on_memo_diamond.created_on as created_on,out_on_memo_diamond.out_on_memo_id as out_on_memo_id, out_on_memo_diamond.user_id as user_id, out_on_memo_diamond.product_id as product_id, out_on_memo_diamond.status as status, out_on_memo_diamond.quantity as quantity, out_on_memo_diamond.memo_request_date as memo_request_date, out_on_memo_diamond.request_approve_date as request_approve_date, out_on_memo_diamond.expiry_date as expiry_date, out_on_memo_diamond.request as request,user_details.username as username,user_details.email_id as email_id, product_diamond.status as product_status, product_diamond.product_name as product_name, product_images.image_url as image_url, product_images.image_thumbnail_url as image_thumbnail_url,user_details.firstname as firstname,user_details.lastname as lastname');		
		
		
		
		$this->db->from('out_on_memo_diamond');
		
		$this->db->join('user_details','user_details.user_id=out_on_memo_diamond.user_id','left');
		$this->db->join('product_diamond','product_diamond.product_id=out_on_memo_diamond.product_id','left');
		$this->db->join('product_images','product_images.product_id=out_on_memo_diamond.product_id','left');
		
		
		//$this->db->join('product_category','product_category.category_id=product.category_id','left');
		
		//$this->db->join('product_subcategory','product_subcategory.subcategory_id=product.subcategory_id','left');
		
		
		
		$this->db->group_by('out_on_memo_diamond.out_on_memo_id');
		
		$query = $this->db->get('');
		
		return $query->result() ;
	}
	
	function get_memo_requests($status = false){
		if(isset($status)){
			$this->db->where('out_on_memo_diamond.status',$status);
		}
			$this->db->select('out_on_memo_diamond.expiry_date as expiry_date,out_on_memo_diamond.created_on as created_on,out_on_memo_diamond.out_on_memo_id as out_on_memo_id, out_on_memo_diamond.user_id as user_id, out_on_memo_diamond.product_id as product_id, out_on_memo_diamond.status as status, out_on_memo_diamond.quantity as quantity, out_on_memo_diamond.memo_request_date as memo_request_date, out_on_memo_diamond.request_approve_date as request_approve_date, out_on_memo_diamond.expiry_date as expiry_date, out_on_memo_diamond.request as request,user_details.username as username, product_diamond.product_name as product_name, product_images.image_url as image_url, product_images.image_thumbnail_url as image_thumbnail_url');		
		$this->db->from('out_on_memo_diamond');
		
		$this->db->join('user_details','user_details.user_id=out_on_memo_diamond.user_id','left');
		$this->db->join('product_diamond','product_diamond.product_id=out_on_memo_diamond.product_id','left');
		$this->db->join('product_images','product_images.product_id=out_on_memo_diamond.product_id','left');
		$this->db->group_by('out_on_memo_diamond.out_on_memo_id');
		
		$query = $this->db->get('');
		
		return $query->result() ;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function get_out_on_memo($approve=false,$request=false){
		
	}
	
	
	
	
	
	function get_product_by_sub_category($sub_category_id=false,$category_id=false){
		
		if(is_numeric($sub_category_id)){
			$this->db->where('subcategory_id',$sub_category_id);
		}
		if(is_numeric($category_id)){
			$this->db->where('category_id',$category_id);
		}
		
		$this->db->select('product_id, product_name');		
					
		$query = $this->db->get('product_diamond');		
		return $query->result() ;
	}
	
	
	
	
	
	
	
	
	
	
	
	
}
?>