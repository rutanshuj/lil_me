<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Social_media_lib {
    var $CI;
    public function __construct($params = array())
    {
        $this->CI =& get_instance();
		$this->CI->load->library('session');
		$this->CI->load->library('Googleplus');
        $this->CI->load->helper('url');
        $this->CI->load->database();
		include_once APPPATH."libraries/facebook-api-php-codexworld/facebook.php";
		//echo"prani";
		
        
    }
	public function get_social_login_links()
	{
		//$redirectUrl = base_url() . 'web/home/fb_login';
		//$fbPermissions = 'email';
		$facebook = new Facebook(array(
		  'appId'  => appId,
		  'secret' => appSecret
		
		));
		$fbuser = $facebook->getUser();
		$this->CI->session->set_userdata('facebook',$facebook);
		$this->CI->session->set_userdata('fbuser',$fbuser);
		$data['facebook_loginUrl'] = $facebook->getLoginUrl(array('redirect_uri'=>redirectUrl,'scope'=>fbPermissions));	
		$this->CI->session->set_userdata('facebook_loginUrl',$data['facebook_loginUrl']);	
		$this->CI->session->set_userdata('googleplus_loginUrl', $this->CI->googleplus->loginURL());	
	
		
		//$contents['googleplus_loginUrl'] = $this->googleplus->loginURL();
		//$this->CI->load->view('welcome_message',$contents);
	}
}
?>