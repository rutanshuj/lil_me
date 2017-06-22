<?php
class Market_news_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	
	function get_news($id = false){
		
		if(is_numeric($id)){
			$this->db->where('news_id',$id);
		}
		$this->db->select('market_news.news_id as news_id, market_news.news_category as news_category_id, market_news.priority as priority, market_news.image_url as image_url, market_news.headline as headline, market_news.details as details, market_news.created_on as created_on, market_news.created_by as created_by,market_news.updated_on as updated_on ,market_news.updated_by as updated_by,master_market_news_category.news_category as news_category_name');			
		$this->db->from('market_news');			
		$this->db->join('master_market_news_category', 'master_market_news_category.news_category_id = market_news.news_category');
		$query = $this->db->get();	
		return $query->result();
		
	}
	
	function Market_news_deleted($id= false){
		$this->db->where('news_id', $id);
		$this->db->delete('market_news');		
	}
	
	function notification_user_type($user_type_id=false){
		if($user_type_id=="1"){			
			$this->db->where('user_type','Wholesale');
		} else if($user_type_id=="2"){
			$this->db->where('user_type','Retail');
			
		} else {			
			$wholesale="'Wholesale'";
			$this->db->where('(user_type',$wholesale, FALSE);
			$this->db->or_where("user_type='Retail')", NULL, FALSE);			
		}
		$this->db->select('user_id,username,gcm_id,device_id,device_type');			
		$this->db->from('user_details');		
		
		$query = $this->db->get();	
		return $query->result();
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
	function user_register($data=false){
		if(isset($data)){
			$this->db->insert('admin_details', $data); 
		}
	}
	
	function admin_details_update($data = false,$id = false){
		if(isset($data)){
			$this->db->where('admin_id', $id);
			$this->db->update('admin_details', $data); 
		}
	}
	function email_validate($id = false,$email= false){
		
		$where_array=array('admin_id !='=>$id,'email_id'=>$email);
		$this->db->select('username');
		$this->db->where($where_array);
		$this->db->from('admin_details');	
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->num_rows();
		
	}
	function userdetails($id = false){
		
		$this->db->select('admin_details.username as username, admin_details.firstname as firstname, admin_details.lastname as lastname ,admin_details.email_id as email_id ,admin_details.primary_phone_number as primary_phone_number, admin_details.secondary_phone_number as secondary_phone_number,admin_details.city as city_id, master_city.city_name as city_name');
		$this->db->where('admin_id',$id);
		$this->db->from('admin_details');
		$this->db->join('master_city', 'master_city.id = admin_details.city');
		$query = $this->db->get();
		return $query->row();
		
		
	}
	function login($username = false, $password = false){
		$where_array=array("username"=>$username,"password"=>md5($password));
		$this->db->select('admin_id,is_enable,role');
		$this->db->where($where_array);
		$query = $this->db->get('admin_details');		
		$result = $query->row();
		
	    if(isset($result->admin_id)) {
			if($result->is_enable=="1") {
			
				$api_key=md5(uniqid().$username);
				$result_data['user_id']= $result->admin_id;
				$data = array(
				   'api_key' => $api_key
				);

				$this->db->where('admin_id', $result->admin_id);
				$this->db->update('admin_details', $data);
				$result_data['api_key']=$api_key;
				$result_data['status']='1';
				
			} else {
				$result_data['status']='2';
				$result_data['message']='Your account is not active';
			}
		} else {
			$result_data['status']='0';
			$result_data['message']='Username or password invalid';
		}
		return $result_data; 
	}
	
	
	
	function user_details($search = false ,$is_enable= false ,$user_type = false) {
		$result = array();
		if(isset($search) &&($search!="")){
			
		}
		if(isset($is_enable) &&($is_enable!="") && (is_numeric($is_enable))){
			$this->db->where('is_enable',$is_enable);
		}
		if(isset($user_type) && ($user_type!="")){
			if(($user_type=="rejected") && ($is_enable=="1")){			
				$this->db->where_not_in('user_type','rejected');
			} else 
			if($user_type=="rejected"){			
				$this->db->where('user_type','rejected');
			} else 			
			if($user_type=="pending"){
				$this->db->where('user_type',$user_type);
			}			
		}		
		
		
        $this->db->select('user_id,username, firstname,lastname, email_id, primary_phone_number ,city,user_type, is_enable, created_on, updated_on, approved_on, valid_through')
        ->from('user_details');       
        
        $query_activeUser = $this->db->get();
		
       
		
		foreach ($query_activeUser->result() as $row) {
			$result[]=$row;
       	}
		
		
        return $result;
		
		
		
	}

	function user_reject_approve($id= false,$data= false){
		if(is_numeric($id)&& is_array($data)){
			$this->db->where('user_id', $id);
			$this->db->update('user_details', $data);
			return 1;
		} else {
			return 0;
		}
		
	}
	

	 function getdataforuserdashBoard()
   {
        $where_arr= array('is_enable'=>1);
        $this->db->select('*')
        ->from('user_details')
        ->where_not_in('user_type','rejected')
        ->where($where_arr);
        $query_activeUser = $this->db->get();
         if($query_activeUser->num_rows()!=0)
         {
            $returnArr['activeUser'][]=$query_activeUser->row();
         }
         else{
            $returnArr['activeUser']='';
         }
		 
		 
		 
		 
		 
        $where_arr= array('user_type'=>'pending','is_enable'=>0);
        $this->db->select('*')
        ->from('user_details')
        ->where($where_arr);
        $query_pendingUsers = $this->db->get();
        if($query_pendingUsers->num_rows()!=0)
         {
             $returnArr['pendingUser'][]=$query_pendingUsers->row();
         }
         else{
            $returnArr['pendingUser']='';
         }
     
		
		
         $this->db->select('*')
        ->from('user_details')
        ->where('user_type','rejected');
        $query_disabledUsers = $this->db->get();
         if($query_disabledUsers->num_rows()!=0)
         {
           $returnArr['disabledUser'][]=$query_disabledUsers->row();
         }
         else{
            $returnArr['disabledUser']='';
         }
       

        return $returnArr;
   }
	
	
}
?>