<?php
class Diamond_stock_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	
	
	
	
	function diamond_stock_list($diamond_stock_id=false){	
		if(is_numeric($diamond_stock_id)){
			$this->db->where('product_id',$diamond_stock_id);
		}		
		$this->db->select('product_id, product_name, certificate, status, updated_on, updated_by');
		$this->db->from('product_diamond');		
		$query = $this->db->get();		
		return $query->result() ;		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function category_deleted($id= false){
		$this->db->where('category_id', $id);
		$this->db->delete('product_category');		
	}
	
}
?>