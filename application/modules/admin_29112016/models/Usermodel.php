<?php
class Usermodel extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
		$this->load->library('email');
    }
    function dataForDashBoard()
    {
		 
		//$current_datetime = date("Y-m-d H:i:s");
    	$where_arr= array('is_enable'=>1);
    	$this->db->select('count(*) as active_user')
		->from('user_details')
       // ->where_not_in('user_type','rejected')
        ->where($where_arr);
        $query_active_user = $this->db->get();
        $active_user=$query_active_user->row();
        $returnArr['active_user']=$active_user->active_user;
		
		
		
        $where_arr= array('is_enable'=>0);
        $this->db->select('count(*) as pending_user')
		->from('user_details')
        ->where($where_arr);
        $query_pending_users = $this->db->get();
        $pending_users=$query_pending_users->row();
        $returnArr['pending_user']=$pending_users->pending_user;
		
        return $returnArr;
    }

    function getUserActivity()  
    {
        $this->db->select('user_activity_log.activity_id as activity_id,user_activity_log.activity_time as activity_time, user_activity_log.user_id as activity_user_id,user_activity_log.event_type as activity, user_activity_log.activity_comment as activity_detail ,user_details.username as user_username, user_details.email_id as user_email')
        ->from('user_activity_log');
		$this->db->join('user_details', 'user_details.user_id = user_activity_log.user_id');
        $query_userActivity = $this->db->get();
        $result=$query_userActivity->result();
        return $result;
    }
}  
?>