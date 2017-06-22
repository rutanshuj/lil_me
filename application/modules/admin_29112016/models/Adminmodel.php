<?php
class Adminmodel extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
		$this->load->library('email');
    }
    function dataForDashBoard() {
    
    	$where_arr= array('role'=>'admin','is_enable'=>1);
    	$this->db->select('count(*) as num_active_admin')
		->from('admin_details')
		->where($where_arr);
        $query_active_admins = $this->db->get();
        $active_admins=$query_active_admins->row();		
        $returnArr['active_admins']=$active_admins->num_active_admin;
		
		
		
        $where_arr= array('role'=>'pending','is_enable'=>0);
        $this->db->select('count(*) as num_pending_admins')
		->from('admin_details')
        ->where($where_arr);
        $query_pending_admins = $this->db->get();
        $pending_admins=$query_pending_admins->row();		
		$returnArr['pending_admins']=$pending_admins->num_pending_admins;
        return $returnArr;	
		
    }
	function get_admin_details($role="admin",$is_enable=1){

		$admin_details  = array();			
    	$where_arr= array('role'=>$role,'is_enable'=>$is_enable);
    	$this->db->select('a.admin_id as admin_id,a.username as username,a.firstname as firstname,a.lastname as lastname,a.email_id as email_id,a.primary_phone_number as primary_phone_number, a.secondary_phone_number as secondary_phone_number, a.is_enable as is_enable, mc.city_name as city_name, a.valid_through as valid_through ,	a.updated_on as updated_on, a.created_on as created_on')
		->from('admin_details a')
		->join('master_city mc','mc.id=a.city','left')
		->where($where_arr);
        $query_activeAdmins = $this->db->get();
		
        foreach ($query_activeAdmins->result() as $row) {
			$admin_details[]=$row;
       	}		
		return $admin_details;
       
	}
	
	function admin_reject_approve($id= false,$data= false){
		if(is_numeric($id)&& is_array($data)){
			$this->db->where('admin_id', $id);
			$this->db->update('admin_details', $data);
			return 1;
		} else {
			return 0;
		}
		
	}
	/////////// no need below function
	  function getdataforadmindashBoard() {
		$active_admins =$pending_admins = array();
		
    	$where_arr= array('role'=>'admin','is_enable'=>1);
    	$this->db->select('*')
		->from('admin_details a')
		->join('master_city mc','mc.id=a.city')
		->where($where_arr);
        $query_activeAdmins = $this->db->get();
		
        foreach ($query_activeAdmins->result() as $row) {
			$active_admins[]=$row;
       	}
       
        $where_arr= array('role'=>'pending','is_enable'=>0);
        $this->db->select('*')
		->from('admin_details a')
		->join('master_city mc','mc.id=a.city')
        ->where($where_arr);
        $query_pendingAdmins = $this->db->get();
       	foreach ($query_pendingAdmins->result() as $key => $row) {
			$pending_admins[]=$row;
       	}
       $result['active_admins']= $active_admins;
       $result['pending_admins']= $pending_admins;
	   
        return $result;
    }
}
?>