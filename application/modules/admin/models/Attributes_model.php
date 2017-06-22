<?php
class Attributes_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	
	
	function get_attributes($attributes_id = false)  {

		$this->db->select('attribute.attribute_id as attribute_id, attribute.attribute_name as attribute_name , attribute.attribute_type as attribute_type, attribute.sort_order as sort_order, attribute.created_on as created_on, attribute.created_by as created_by, attribute.updated_on as updated_on, attribute.updated_by as updated_by,attribute.attribute_header as attribute_header, master_attribute_type.attribute_type_title as attribute_type_title, master_attribute_header.attribute_header_title as attribute_header_title')
		->from('attribute');
		
		
		
		
		$this->db->join('master_attribute_type','master_attribute_type.attribute_type_id=attribute.attribute_type', 'left');
		$this->db->join('master_attribute_header','master_attribute_header.attribute_header_id=attribute.attribute_header', 'left');
		
		$this->db->order_by('attribute.attribute_id','asc');
		if(isset($attributes_id)&&(is_numeric($attributes_id))){
			$this->db->where('attribute.attribute_id',$attributes_id);
		}
		$query_get_attributes= $this->db->get();
		
		return $query_get_attributes->result();
		
   }
	
	
	function attributes_deleted($id= false){
		$this->db->where('attribute_id', $id);
		$this->db->delete('attribute');
		
	}
	
	
	function attributes_validate($id = false,$name= false){
		
		$where_array=array('attribute_id !='=>$id,'attribute_name'=>$name);
		$this->db->select('attribute_id');
		$this->db->where($where_array);
		$this->db->from('attribute');	
		$query = $this->db->get();
		//return $this->db->last_query();
		return $query->num_rows();
		
	}
	function password_change($id=false,$oldpassword= false,$password= false, $username=false){
		$where_array=array('admin_id'=>$id,'password'=>md5($oldpassword));
		$this->db->select('admin_id');
		$this->db->where($where_array);		
		$this->db->from('admin_details');	
		$query = $this->db->get();		
		
		if ($query->num_rows() > 0) {			
			$data_array=array(
				'password'=>md5($password),
				'updated_by'=>$username
			);
			$this->db->where('admin_id', $id);
			$this->db->update('admin_details', $data_array);
			return 1;
		} else {
			return 0;
			
		}
	}

	
	
}
?>