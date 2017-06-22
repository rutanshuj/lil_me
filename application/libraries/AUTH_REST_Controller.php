<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter Rest Controller
 *
 * A fully RESTful server implementation for CodeIgniter using one library, one config file and one controller.
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link			https://github.com/chriskacerguis/codeigniter-restserver
 * @version         3.0.0-pre
 */
abstract class AUTH_REST_Controller extends REST_Controller
{
    public function __construct(){
        parent::__construct();
		$access_token=$this->input->server('HTTP_ACCESS_TOKEN');
		$user_id=$this->input->server('HTTP_USER_ID');		
		if(!$this->check_access_token($user_id,$access_token)){
			$response=array('success'=>0,'status'=>'Invalid Access token!');
			$this->response($response , 401);			
		}

	}
		
}
