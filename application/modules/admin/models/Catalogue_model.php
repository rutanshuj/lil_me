<?php
class Catalogue_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	
	function product_catalogue($catalog_id = false){
		if(is_numeric($catalog_id)){
			$this->db->where('catalog_id',$catalog_id);
		}
		$this->db->select('catalog_id, catalog_title,catalog_url,catalog_size,created_on,created_by,updated_on,updated_by');		
		$query = $this->db->get('product_catalog');		
		return $query->result_array() ;
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
	
	function category_deleted($id= false){
		$this->db->where('category_id', $id);
		$this->db->delete('product_category');	
	
	}
	
}
?>