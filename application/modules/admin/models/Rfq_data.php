<?php
class Rfq_data extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	
	

	
	function due_today($current_date=false,$expired_date=false,$rfq_status=false){
		if($current_date){
			$this->db->like('rfq_data.requested_on', $current_date, 'after'); 	
		}
		if($expired_date){
			
			$this->db->where('valid_till >',$expired_date);
			$this->db->where('valid_till <=',date("Y-m-d G:i:s"));
		}
		$this->db->select('rfq_data.data_id as data_id, rfq_data.rfq_id as rfq_id,rfq_data.user_id as user_id,rfq_data.product_id as product_id,rfq_data.requested_on as requested_on,rfq_data.response_on as response_on,rfq_data.valid_till as valid_till,rfq_data.rfq_status as rfq_status,rfq_data.updated_on as updated_on,rfq_data.updated_by as updated_by , product.product_name as product_name,user_details.username as username ,user_details.firstname as firstname,user_details.lastname as lastname');	
		$this->db->from('rfq_data');
		
		
		$this->db->join('user_details','user_details.user_id=rfq_data.user_id','left');
		$this->db->join('product','product.product_id=rfq_data.product_id','left');
		
		$query = $this->db->get('');
				
		return $query->result() ;
	}
	
		
	
	
}
?>