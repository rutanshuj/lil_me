<?php
class Sub_category_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	
	function sub_category_name_validation($sub_category_id= false ,$subcategory_name= false,$id=false,$category_id=false){
		
		if($id=="1"){		
/// not equal to 
/// 		
			$this->db->where('subcategory_id',$sub_category_id);
		} else
		if($id=="2"){
			$this->db->where('category_id',$sub_category_id);
			
		} else 
		if($id=="3"){
			$this->db->where('category_id',$category_id);
			$this->db->where('subcategory_id !=',$sub_category_id);
		}
		else {
			$this->db->where('subcategory_id !=',$sub_category_id);
		}
		
		
		$this->db->where('product_subcategory.is_active','1');
		$this->db->where('subcategory_name',$subcategory_name);
		
		$query = $this->db->get('product_subcategory');
		
		return $rowcount = $query->num_rows();
	}
	
	
	function sub_category($sub_category_id= false){
		
		if(is_numeric($sub_category_id)){
			$this->db->where('product_subcategory.subcategory_id',$sub_category_id);
		}
		$this->db->where('product_subcategory.is_active','1');
		$this->db->select('product_subcategory.subcategory_id as subcategory_id, product_subcategory.subcategory_name as subcategory_name,product_subcategory.category_id as category_id,product_subcategory.description as description,product_category.category_name  as category_name,product_subcategory.sort_order as sort_order ');
		$this->db->from('product_subcategory');			
		$this->db->join('product_category','product_category.category_id=product_subcategory.category_id','left');
		$this->db->order_by('product_category.category_name','desc');
		$query = $this->db->get();		
		return $query->result() ;
	}
	
	function sub_category_deleted($id= false){
		$this->db->where('subcategory_id', $id);
		$this->db->delete('product_subcategory');	
		////
		//$this->db->where('category_id', $id);
		//$this->db->delete('product');	
	}
	
	
	function get_sub_cate_by_cate_id($id= false){
		
		$this->db->select('subcategory_id,subcategory_name');
		$this->db->where('category_id', $id);
		$this->db->where('is_active','1');
		$this->db->from('product_subcategory');	
		$query = $this->db->get();		
		return $query->result() ;		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/////////////// delete
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
		$this->db->where('product_category.is_active','1');
		$this->db->select('category_id, category_name,description,image_url,image_thumbnail_url');		
		$query = $this->db->get('product_category');		
		return $query->result() ;
	}
	
	function category_deleted($id= false){
		$this->db->where('category_id', $id);
		$this->db->delete('product_category');		
	}
	
}
?>