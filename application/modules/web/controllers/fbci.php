<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require_once APPPATH.'libraries/facebook/facebook.php';
class Fbci extends CI_Controller {
  	
	function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        $fb_config = array(
            'appId'  => '1811597855784256',
            'secret' => 'cab4d0ab90e43d585a4d6afaa885d02e'
        );

        $this->load->library('facebook', $fb_config);

        $user = $this->facebook->getUser();
		//print_r($user);
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook
                    ->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }

        if ($user) {
            $data['logout_url'] = $this->facebook
                ->getLogoutUrl();
        } else {
            $data['login_url'] = $this->facebook
                ->getLoginUrl();
        }

        $this->load->view('view',$data);
    }
	
}