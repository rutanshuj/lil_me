<?php
require(APPPATH.'libraries/REST_Controller.php');
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
class Mood_images extends REST_controller {

	 function __construct()
    {
        parent::__construct();
      	
    }
	
	function index_post()
	{
		
		$status_code="500";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$data['statusCode']=0;
		
		if(is_numeric($user_id)){
			
			$this->db->select('user_id');
			$this->db->from('user_details');
			$this->db->where('user_id',$user_id);
			$this->db->where('api_key',$api_key);
			$query = $this->db->get(); 
			
			if($query->num_rows()=="0"){
				$data['message']='Unauthorised Access';
			} else {
				$this->db->select('counter');
				$this->db->from('mood_image_counter');
				$query = $this->db->get(); 
				$count=$query->row();
				$data['message']['image_verson']=$count->counter;
			
				$this->db->select('image_id,image_url,image_thumbnail_url,');
				$this->db->from('mood_images');
				$query = $this->db->get(); 
				$results=$query->result();
				$result_data= array();
				foreach($results as $rows){
					$result_data[]=array(
					'image_id'=>$rows->image_id,
					'image_url'=>base_url().$rows->image_url,
					'image_thumbnail_url'=>base_url().$rows->image_thumbnail_url
					);
					
				}
				$data['statusCode']=1;
				$data['message']['data']=$result_data;
				$data['message']['image_verson']=$count->counter;
			
			
			
			}
			
		} else {
			
			$data['message']='Some data is missing';
		}
		
	
		$this->response($data,$status_code);
	}
	
	
	}
?>      