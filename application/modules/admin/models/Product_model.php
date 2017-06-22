<?php
class Product_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	
	function get_attribute_field(){
		$this->db->select('attribute_id, attribute_name,attribute_type,attribute_header,sort_order');		
		$this->db->order_by('sort_order','asc');
		$query = $this->db->get('attribute');		
		return $query->result() ;
	}
	
	function product_images($product_id=false){
		if(is_numeric($product_id)){
			$this->db->where('product_id',$product_id);	
		}
		$this->db->select('image_id, image_url,image_thumbnail_url,product_id');	
		
		$query = $this->db->get('product_images');		
		return $query->result() ;
	}
	
	function product_attribute_value($product_id=false){
		if(is_numeric($product_id)){
			$this->db->where('product_id',$product_id);	
		}
		$this->db->select('attribute_value_id, attribute_id,product_id,attribute_value');	
		
		$query = $this->db->get('attribute_value');		
		return $query->result() ;
	}
	
	function get_product_details($product_id=false){
		if(is_numeric($product_id)){
			$this->db->where('product_id',$product_id);	
		}
		$this->db->where('is_active','1');	
		$this->db->select('product_name, category_id,gender,description,is_hot,is_new');	
		
		$query = $this->db->get('product');		
		return $query->result() ;
	}
	function get_product_by_sub_category($sub_category_id=false,$category_id=false){
		
		if(is_numeric($sub_category_id)){
			$this->db->where('subcategory_id',$sub_category_id);
		}
		if(is_numeric($category_id)){
			$this->db->where('category_id',$category_id);
		}
		$this->db->where('is_active','1');
		$this->db->select('product_id, product_name');		
					
		$query = $this->db->get('product');		
		return $query->result() ;
	}
	
	
	
	
	
	
	
	
	function category_name_validation($category_id= false ,$category_name= false,$id=false){
		
		if($id=="1"){
			$this->db->where('category_id',$category_id);
		} else {
			$this->db->where('category_id !=',$category_id);
		}
		$this->db->where('category_name',$category_name);
		$query = $this->db->get('product_category');
		return $rowcount = $query->num_rows();
	}
	function product_category($category_id=false,$category_name=false){	
		if(is_numeric($category_id)){
			$this->db->where('category_id',$category_id);
		}
		if(is_numeric($category_name)){
			$this->db->where('category_name',$category_name);
		}
		$this->db->where('is_active','1');
		$this->db->select('category_id, category_name,description,image_url,image_thumbnail_url');		
		$query = $this->db->get('product_category');		
		return $query->result() ;
	}
	
	
	
}
?>