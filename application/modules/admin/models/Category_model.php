<?php
class Category_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	function category_name_validation($category_id= false ,$category_name= false,$id=false){
		
		if($id=="1"){
			$this->db->where('category_id',$category_id);
		} else {
			$this->db->where('category_id !=',$category_id);
		}
		$this->db->where('category_name',$category_name);
		$this->db->where('is_active',1);
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
		$this->db->where('product_category.is_active','1');
		$this->db->select('category_id, category_name,description,image_url,image_thumbnail_url,sort_order');		
		$query = $this->db->get('product_category');		
		return $query->result() ;
	}
	
	function category_deleted($id= false){
		$this->db->where('category_id', $id);
		$this->db->delete('product_category');	
		///////
		//$this->db->where('category_id', $id);
		//$this->db->delete('product_subcategory');	
		////
		//$this->db->where('category_id', $id);
		//$this->db->delete('product');	
	}
	
}
?>