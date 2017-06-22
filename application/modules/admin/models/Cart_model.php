<?php
class Cart_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	
	function cart_user_details(){
		$this->db->select('cart.user_id as cart_user_id,user_details.user_id as user_details_user_id, user_details.username as user_name, user_details.firstname as firstname, user_details.lastname as lastname');
		$this->db->from('cart');
		$this->db->join('user_details','user_details.user_id=cart.user_id');
		$this->db->group_by("cart.user_id");
		$query = $this->db->get('');		
		return $query->result() ;
	}
	
	function product_category($category_id=false,$category_name=false){	
		if(is_numeric($category_id)){
			$this->db->where('category_id',$category_id);
		}
		if(is_numeric($category_name)){
			$this->db->where('category_name',$category_name);
		}
		$this->db->where('product_category.is_active','1');
		$this->db->select('category_id, category_name,description,image_url,image_thumbnail_url,sort_order');		
		$query = $this->db->get('product_category');		
		return $query->result() ;
	}
	
	
	
}
?>