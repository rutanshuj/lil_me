
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email 
class Home extends CI_Controller {
	public function __construct() {		
		parent::__construct();
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); 
		$this->load->Model('Category_model');
		$this->load->Model('Product_model');
		$this->load->Model('Cart_model');
		$this->load->database();
		$this->load->model('Jewellerymodel');
		$this->load->model('User_model');
		$this->load->model('Jewelleryattributemodel');
		include_once APPPATH."libraries/facebook-api-php-codexworld/facebook.php";
	}
	function index()
	{
		$data_fb= array();
		//$data['page'] = $this->page;
		$data_fb =$this->session->userdata('userData');
		$facebook = new Facebook(array(
		  'appId'  => appId,
		  'secret' => appSecret
		
		));
		$fbuser = $facebook->getUser();
		if(count($data_fb)==0)
		{
		$fbuser = '';
        $data['authUrl'] = $facebook->getLoginUrl(array('redirect_uri'=>redirectUrl,'scope'=>fbPermissions));	
		}
		
		$data['username'] = $this->session->userdata('username');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');
		$data['category_list'] = $this->Category_model->product_category();
		//$data['fb_data']=$this->fb_login(0);
	/* 	echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die(); */
		
		$this->load->view('header',$data);	
		$this->load->view('home',$data);
		$this->load->view('footer');		
		
		
		}
	function favorites()
	{
		//$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');
		$id=17;
		$data['category_list'] = $this->Category_model->product_category();
		$data['favorites']=$this->User_model->user_favorites($id);
		//$data['fb_data']=$this->fb_login();
	/* 	echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die(); */
		$this->load->view('header',$data);	
		$this->load->view('favorite_view',$data);
		$this->load->view('footer');	
	}
	function products_list()
	{
		$data['category_id']=$category_id=trim($this->input->get('category_id',true));
		$size_id=trim($this->input->get('size',true));
		$data['size_array']=$this->Jewelleryattributemodel->get_size();
		$data['product_list'] = $this->Category_model->get_category_products($category_id);
		
		/* echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die(); */ 
		$this->load->view('header');	
		$this->load->view('product_list',$data);
		$this->load->view('footer');	
	}
	function product_details()
	{
		$api_key='fb0aa13efb9ac71e1c09094d7102d798';
		$user_id=17;
		$data['product_id']=$product_id=trim($this->input->get('product_id',true));
		$data['cart_list']=$this->Cart_model->get_cartList($user_id,$api_key);
		$data['product_images']=$this->Product_model->product_images($data['product_id']);
		$data['product_data']=$this->Product_model->get_product_details($data['product_id']);
		$data['size_available']=$this->Jewelleryattributemodel->get_size($product_id);
		
		/* echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die(); */
		$this->load->view('header',$data);	
		$this->load->view('product_detail',$data);
		$this->load->view('footer');	
	}
	function search()
	{
		$user_id=17;
		$data['product_data']=$this->Product_model->getproducts();
	}
		function demo()
		{
		$api_key='fb0aa13efb9ac71e1c09094d7102d798';
		$user_id=17;
		$data['product_id']=$product_id=trim($this->input->get('product_id',true));
		$data['product_id']=3055;
		$data['cart_list']=$this->Cart_model->get_cartList($user_id,$api_key);
		$data['product_images']=$this->Product_model->product_images($data['product_id']);
		$data['product_data']=$this->Product_model->get_product_details($data['product_id']);
		$data['size_available']=$this->Jewelleryattributemodel->get_size($product_id);
		
		/* echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die(); */
		$this->load->view('header',$data);	
		$this->load->view('product_detail',$data);
		$this->load->view('footer1');	
		}
	function products_by_param()
	{
		$api_key='fb0aa13efb9ac71e1c09094d7102d798';
		$user_id=17;
		$data['category_id']=$category_id=trim($this->input->get('category_id',true));
		$data['size']=$size_id=trim($this->input->get('size',true));
		$data['sortflag']=$sortflag=trim($this->input->get('sortflag',true));
		$data['sortparam']=$sortparam=trim($this->input->get('sortparam',true));
		$data['gender']=$gender=trim($this->input->get('gender',true));
		$data['size_array']=$this->Jewelleryattributemodel->get_size();
		$data['cart_list']=$this->Cart_model->get_cartList($user_id,$api_key);
		//$data['fb_data']=$this->fb_login();
		if(isset($size_id) || isset($gender)|| $gender!='' || $size!='' )
		{
			$data['product_list'] = $this->Category_model->get_products_criteriaWise($category_id,$size_id,$gender,$sortflag,$sortparam);
			if($sortflag==0)
			{
				$data['sortflag']=1;
			}
			else{
				$data['sortflag']=0;
			}
		}
		
		else{
			$data['product_list'] = $this->Category_model->get_category_products($category_id);	
		}

	/* echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die(); */
		$this->load->view('header',$data);	
		$this->load->view('product_list',$data);
		$this->load->view('footer');
	}
	function about_us()
	{
		//$data['fb_data']=$this->fb_login();
		$this->load->view('header');	
		$this->load->view('about_us');
		$this->load->view('footer');
	}
	function faqs()
	{
		//$data['fb_data']=$this->fb_login();
		$this->load->view('header');	
		$this->load->view('faqs');
		$this->load->view('footer');
	}
	function crop()
	{
			
		$this->load->view('crop');
		
	}
	function profile()
	{
		$data['userData']=$this->session->userdata('userData');
//print_r($data);
		$this->load->view('header',$data);	
		$this->load->view('profile',$data);
		$this->load->view('footer');		
			
		
		
	}
	function contact_us()
	{
		//$data['fb_data']=$this->fb_login();
		$this->load->view('header');	
		$this->load->view('contact');
		$this->load->view('footer');
	}
	 public function fb_login($page=1){
		
		// Facebook API Configuration
		
		
		
		//Call Facebook API
		$facebook = new Facebook(array(
		  'appId'  => appId,
		  'secret' => appSecret
		
		));
		$fbuser = $facebook->getUser();
		/* print_r($fbuser);
		die(); */
        if ($fbuser) {
			$this->load->Model('User');
			$userProfile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
            // Preparing data for database insertion
			$userData['oauth_provider'] = 'facebook';
			$userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
			$userData['gender'] = $userProfile['gender'];
			$userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
            $userData['picture_url'] = $userProfile['picture']['data']['url'];
			// Insert or update user data
			
            $userID = $this->User->checkUser($userData);
			/* echo $userID;
			die() ; */
            if(!empty($userID)){
				$data['userData']= $userData;
				$this->session->set_userdata('userData',$userData);
				$this->session->set_userdata('id',$userID);
				$data['logout_url']=base_url() . 'web/home/fb_logout';
				if($page==0)
				{
					
				}else{
				redirect('web/home/profile');
				}
				
            } else {
               $data['userData'] = array();
            }
        } else {
			$fbuser = '';
            $data['authUrl'] = $facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl,'scope'=>$fbPermissions));
        }
		//print_r($data);
		return $data;
		//$this->load->view('user_authentication/index',$data);
    }
	public function fb_logout() {
		$this->session->unset_userdata('userData');
        $this->session->sess_destroy();
		redirect('/web/home/fb_login');
    }
}
?>