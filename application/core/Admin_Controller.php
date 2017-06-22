<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends Base_Controller{
	public $rest_server_base_url;
	public function __construct(){
		$this->load->library('rest');
		
		$base_url=$this->config->item('api_base_url');
		$this->rest_server_base_url=$base_url[ENVIRONMENT];
		//parent::__construct('user_type', 1);
		
		//set access token and user id & initialize rest object 
		
		$access_token = $this->session->userdata('access_token');
		$user_id = $this->session->userdata('id');

		if($user_id && $access_token){	
		$config = array('server'            => $this->rest_server_base_url,
						'ACCESS_TOKEN'         => $access_token,
						'USER_ID'        => $user_id
					);		
		$this->rest->initialize($config);		
		}else{
			redirect('admin/login');
		}
	}

}

?>