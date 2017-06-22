<?php
class Stock_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	
	
	
	
	function stock_list(){	
				
		$this->db->select('product.gender as gender,product.product_id as product_id , product.product_name as product_name ,product.category_id as category_id ,product.description as description,product.updated_on as updated_on, product_category.category_name as category_name ');
		$this->db->from('product');
		$this->db->where('product.is_active',1);
		$this->db->join('product_category','product_category.category_id=product.category_id','left');
		//$this->db->join('product_subcategory','product_subcategory.subcategory_id=product.subcategory_id','left');
		$this->db->order_by('product.product_id','asc');
		$query = $this->db->get();		
		return $query->result() ;		
	}
	
	function gender_list(){	
				
		$this->db->select('gender');
		$this->db->from('product');
		$this->db->where('product.is_active',1);
		$this->db->group_by('gender');
		$query = $this->db->get();		
		return $query->result() ;		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function category_deleted($id= false){
		$this->db->where('category_id', $id);
		$this->db->delete('product_category');		
	}
	
}
?>