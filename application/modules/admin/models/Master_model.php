<?php
class Master_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	
	function city(){		
		$this->db->select('id, city_name');
		$this->db->where('is_active',1);
		$query = $this->db->get('master_city');
		return $query->result() ;
	}
	function user_type(){		
		$this->db->select('user_type_id, user_type');
		$this->db->where('is_active',1);
		$query = $this->db->get('master_user_type');
		return $query->result() ;
	}
	
	function news_category(){		
		$this->db->select('news_category_id, news_category');
		$this->db->where('is_active','1');
		$query = $this->db->get('master_market_news_category');
		
		return $query->result() ;
	}
	function news_priority(){		
		$this->db->select('news_priority, news_priority_title,news_priority_position');
		$this->db->where('is_active','1');
		$query = $this->db->get('master_news_priority');
		
		return $query->result() ;
	}
	
	function master_attribute_header(){		
		$this->db->select('attribute_header_id, attribute_header_title');
		$this->db->where('is_active','1');
		$query = $this->db->get('master_attribute_header');
		
		return $query->result() ;
	}
	function  master_attribute_type(){		
		$this->db->select('attribute_type_id, attribute_type_title');
		$this->db->where('is_active','1');
		$query = $this->db->get('master_attribute_type');
		
		return $query->result() ;
	}
	function master_diamond_attribute_header(){		
		$this->db->select('attribute_header_id, attribute_header_title');
		$this->db->where('is_active','1');
		$query = $this->db->get('master_diamond_attribute_header');
		
		return $query->result() ;
	}
	
	function  master_diamond_attribute_type(){		
		$this->db->select('attribute_type_id, attribute_type_title');
		$this->db->where('is_active','1');
		$query = $this->db->get('master_attribute_type');
		
		return $query->result() ;
	}
	
}
?>