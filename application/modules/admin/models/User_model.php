<?php
class User_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	
	
	
	function app_users_details($id=false){
		$this->db->select('user_details.user_id as user_id, user_details.username as username, user_details.firstname as firstname ,user_details.lastname as lastname ,user_details.email_id as email_id, user_details.primary_phone_number as primary_phone_number,user_details.user_type as user_type, user_details.valid_through as valid_through, user_details.device_type as device_type, user_details.company_name as company_name'); 
		
		
		$this->db->where('user_details.user_id',$id);
		$this->db->from('user_details');		
		$query = $this->db->get();
		return $query->row();
	}
	
	function user_activity($id=false){
		$this->db->select('user_activity_log.activity_id as activity_id, user_activity_log.activity_time as activity_time, user_activity_log.event_type as event_type ,user_activity_log.activity_comment as activity_comment'); 
		$this->db->where('user_activity_log.user_id',$id);
		$this->db->from('user_activity_log');		
		$query = $this->db->get();
		return $query->result() ;	
	}
	
	


	 
	/* function user_diamond_favorites($id=false){
		$this->db->select('diamond_favorites.favourite_id as favourite_id, diamond_favorites.product_id as product_id, diamond_favorites.updated_on as updated_on ,product_diamond.product_name as product_name ,product_images_diamond.image_thumbnail_url as image_thumbnail_url ,product_images_diamond.image_id as image_id ,product_images_diamond.image_url as image_url'); 
		
		$this->db->where('diamond_favorites.user_id',$id);
		$this->db->where('diamond_favorites.favorite_flag','1');
		$this->db->from('diamond_favorites');		
		$this->db->join('product_diamond', 'product_diamond.product_id = diamond_favorites.product_id', 'left');
		$this->db->join('product_images_diamond', 'product_images_diamond.product_id = diamond_favorites.product_id', 'left');
		$this->db->group_by('diamond_favorites.product_id');
		
		
		
		$query = $this->db->get();
		
		return $query->result() ;	
	} */
	
	
	
	function user_favorites($id=false){
		$this->db->select('favorites.favourite_id as favourite_id, favorites.product_id as product_id, favorites.updated_on as updated_on ,product.product_name as product_name ,product.category_id as category_id ,product.subcategory_id as subcategory_id,product_category.category_name as category_name,product_subcategory.subcategory_name as subcategory_name,product_images.image_id as image_id,product_images.image_url as image_url,product_images.image_thumbnail_url as image_thumbnail_url'); 
		
	//	favorites
	//	jewellery_favorites
		
		$this->db->where('favorites.user_id',$id);
	//	$this->db->where('jewellery_favorites.favorite_flag','1');
		$this->db->from('favorites');		
		$this->db->join('product', 'product.product_id = favorites.product_id', 'left');
		
		$this->db->join('product_category', 'product_category.category_id = product.category_id', 'left');
		
		$this->db->join('product_subcategory', 'product_subcategory.subcategory_id = product.subcategory_id', 'left');
		
		$this->db->join('product_images', 'product_images.product_id = favorites.product_id', 'left');
		
		$query = $this->db->get();
	
		return $query->result() ;	
	}
	
	
	
	function user_out_on_memo_diamond($id=false){
		$this->db->select('out_on_memo_diamond.out_on_memo_id as  out_on_memo_id, out_on_memo_diamond.product_id as  product_id,out_on_memo_diamond.memo_request_date as  memo_request_date,out_on_memo_diamond.status as  status,out_on_memo_diamond.created_on as  created_on,	product_diamond.product_name as product_name,	product_images_diamond.image_url as image_url,	product_images_diamond.image_thumbnail_url as image_thumbnail_url'); 
		$this->db->where('out_on_memo_diamond.user_id',$id);		
		$this->db->where('out_on_memo_diamond.status!=','sole');		
		$this->db->from('out_on_memo_diamond');	


		
		$this->db->join('product_diamond', 'product_diamond.product_id = out_on_memo_diamond.product_id', 'left');
		$this->db->join('product_images_diamond', 'product_images_diamond.product_id = out_on_memo_diamond.product_id', 'left');
		$this->db->group_by('out_on_memo_diamond.out_on_memo_id');			
		$query = $this->db->get();
		
		return $query->result() ;	
		
	}
	
	function user_out_on_memo($id=false){
		$this->db->select('out_on_memo.out_on_memo_id as  out_on_memo_id, out_on_memo.product_id as  product_id,out_on_memo.memo_request_date as  memo_request_date,out_on_memo.status as  status,out_on_memo.created_on as  created_on,	product.product_name as product_name,	product_images.image_url as image_url,	product_images.image_thumbnail_url as image_thumbnail_url'); 
		$this->db->where('out_on_memo.user_id',$id);		
		$this->db->where('out_on_memo.status!=','sole');		
		$this->db->from('out_on_memo');		
		$this->db->join('product', 'product.product_id = out_on_memo.product_id', 'left');
		$this->db->join('product_images', 'product_images.product_id = out_on_memo.product_id', 'left');
		$this->db->group_by('out_on_memo.out_on_memo_id');	
		
		$query = $this->db->get();
		
		return $query->result() ;	
		
	}
	function otp_varification_check($user_id=false){
		
		$array = array('user_id' => $user_id, 'OTP_confirmed' => '1');

		$this->db->where($array); 
		$this->db->from('user_details');
		$query = $this->db->get();
		return $query->num_rows() ;
		
		
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
		$this->db->join('master_city', 'master_city.id = admin_details.city','left');
		$query = $this->db->get();
		return $query->row();
		
		
	}
	function user_status_update(){
		$current_datetime = date("Y-m-d H:i:s");
		$data = array(
               'is_enable' => '0'
            );

		$this->db->where('valid_through <',$current_datetime); /// date
		$this->db->update('user_details', $data);
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
				$result_data['message']='Your account is yet to be verified';
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
		
		
		$current_datetime = date("Y-m-d H:i:s");
		//if(isset($is_enable) &&($is_enable!="") && (is_numeric($is_enable))){
		//	$this->db->where('is_enable',$is_enable);
		//}
		if($is_enable=="1"){
			//$this->db->where('valid_through >',$current_datetime); /// date
			 
			$this->db->where('is_enable',$is_enable);
		}
		if($is_enable=="2"){
			//$this->db->where('user_type !=',$user_type);
			//$this->db->where('valid_through <',$current_datetime); /// date
			$this->db->where('is_enable','0');
		}
		if($is_enable=="0"){
			
		//	$this->db->where('user_type',$user_type);
			$this->db->where('is_enable',$is_enable);
		}
		
				
		
		
		
			
		
		
        $this->db->select('user_id,username, firstname,lastname, email_id, primary_phone_number ,user_type, is_enable, created_on, updated_on, approved_on, valid_through')
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