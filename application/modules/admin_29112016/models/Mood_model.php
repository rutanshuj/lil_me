<?php
class Mood_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	
	function mood_images($mood_image_id = false){
		if(is_numeric($mood_image_id)){
			$this->db->where('image_id',$mood_image_id);
		}
		$this->db->select('image_id, image_url,image_thumbnail_url,created_on,created_by,updated_on,updated_by');		
		$query = $this->db->get('mood_images');		
		return $query->result_array() ;
	}

	
	
	
}
?>