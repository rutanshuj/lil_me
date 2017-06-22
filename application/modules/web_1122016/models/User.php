<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model{
	function __construct() {
		$this->tableName = 'users';
		$this->primaryKey = 'id';
		$this->load->database();
	}
	public function checkUser($data){
		/* print_r($data);
		die(); */
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows();
		
		if($prevCheck > 0){
			$prevResult = $prevQuery->row_array();
			$data['modified'] = date("Y-m-d H:i:s");
			$update = $this->db->update($this->tableName,$data,array('id'=>$prevResult['id']));
			$userID = $prevResult['id'];
		}else{
			$data['created'] = date("Y-m-d H:i:s");
			$data['modified'] = date("Y-m-d H:i:s");
			$insert = $this->db->insert($this->tableName,$data);
			$userID = $this->db->insert_id();
		}

		return $userID?$userID:FALSE;
    }
	public function check_google_User($data = array()){
		$this->db->select($this->primaryKey);
		$this->db->from($this->tableName);
		$this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows();
		
		if($prevCheck > 0){
			$prevResult = $prevQuery->row_array();
			$data['modified'] = date("Y-m-d H:i:s");
			$update = $this->db->update($this->tableName,$data,array('id'=>$prevResult['id']));
			$userID = $prevResult['id'];
		}else{
			$data['created'] = date("Y-m-d H:i:s");
			$data['modified'] = date("Y-m-d H:i:s");
			$insert = $this->db->insert($this->tableName,$data);
			$userID = $this->db->insert_id();
		}

		return $userID?$userID:FALSE;
    }
}
