<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public $page='verify_user';
	public function __construct() {	
	parent::__construct();
	$this->load->Model('User_model');	
	$this->load->library('Googleplus');
		$this->load->library('social_media_lib');	
		
	}
	
	public function index() {		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$data['id']=$id =trim($this->input->get('id',true));
		$data['total_favorites']="0";
		if(is_numeric($id)){			
			$data['users_details']=$this->User_model->app_users_details($id);
			
			$data['user_activity']=$this->User_model->user_activity($id);
			
			$data['jewellery_favorites']=$this->User_model->user_favorites($id);
			
			
			$data['total_favorites']=count($data['jewellery_favorites']);
			foreach($data['jewellery_favorites'] as $j_favorites_rows){
				
				$j_favorites_rows->favourite_id;
				$j_favorites_rows->product_id;
				$j_favorites_rows->product_name;
				$j_favorites_rows->category_name;
				$j_favorites_rows->subcategory_name;
				$j_favorites_rows->image_url;
				$j_favorites_rows->image_thumbnail_url;
			}
			
	
			
			
		} else {
			/// close pop-up due to invalid username
		}
				
        
		
	
    
		$this->load->view('header', $data);	
		
		$this->load->view('user_view', $data);			
					
	}
	function favorites()
	{
		//$data['page'] = $this->page;
		$user_id = 1;//$this->session->userdata('user_id');
		$data['username'] = $this->session->userdata('username');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		
		$api_key = $this->session->userdata('api_key');
		$data['category_list'] = $this->Category_model->product_category();
		$data['favorites']=$this->User_model->user_favorites($user_id);
		//$data['fb_data']=$this->fb_login();
	/* 	echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die(); */
		$this->load->view('header',$data);	
		$this->load->view('favorite_view',$data);
		$this->load->view('footer');

	}
	function addtofavourites()
	{
		$user_id = trim($this->input->post('user_id',true));
		$api_key=trim($this->input->post('api_key',true));
		$product_id=trim($this->input->post('product_id',true));
		$like_flag=trim($this->input->post('like_flag',true));
		
		
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('api_key', 'api_key', 'required');
		$validUser=1;//$this->Usermodel->isValidUser($user_id,$api_key);
		$status_code="500";
		if ($this->form_validation->run() == FALSE){		
			//// set error 
			
			$data['statusCode']=0;
			$data['message']='Some data is missing';	
			
		} else {
			if($validUser){
			$status_code="200";
			switch ($like_flag) {
				case 0:
							$flag =$this->User_model->removeFavorites($user_id,$product_id);
							//echo $flag;
							if($flag==1)
							{
								$data['statusCode']=1;
								$data['message']='Favorite Removed';
								$data['event']=0;
							}
							else{
								$data['statusCode']=0;
								$data['message']="Couldn't Be Removed From Favorites" ;
								$data['event']=0;
							}
					break;
				case 1:
							//echo $product_id;

							$flag =$this->User_model->addNewfavorites($user_id,$product_id);
							if($flag==1)
							{
								$data['statusCode']=1;
								$data['message']='Favorite Added';
								$data['event']=1;
								
							}
							else if($flag == 0){
								$data['statusCode']=0;
								$data['message']="Couldn't be Added To Favorites" ;
								$data['event']=0;
								
							}
							else{
								$data['statusCode']=2;
								$data['message']="Already exists" ;
								$data['event']=2;
							}
				break;
				default:
					
					break;
			}
			}
			else{
				$data['statusCode']=0;
				$data['mesaage']='Unauthorised Access';

			}
		}
	//print_r		
		echo json_encode($data);
	}
	
	public function fb_login(){
		
		$appId='1811597855784256';
		$appSecret='cab4d0ab90e43d585a4d6afaa885d02e';
		$facebook=$this->session->userdata('facebook');
		$facebook = new Facebook(array(
          'appId'  => $appId,
          'secret' => $appSecret
        
        ));
		$fb_user = $facebook->getUser();
		
		 if ($fb_user) {
		 $userProfile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
		 $fb_id= $userProfile['id'];
		 $firstname=$userProfile['first_name'];
         $lastname = $userProfile['last_name'];
         $email_id = $userProfile['email'];
		 $password='';
		 
		$this->db->select('*')->from('user_details')->where('email_id',$email_id);
		$getuser=$this->db->get();
		$rows =$getuser->num_rows();
		if($rows>0)
			{
				
				if($email_id!=""){
					$this->db->select('*')
					->from('user_details')
					->where('email_id',$email_id);
					$getuser1=$this->db->get();
					$result =$getuser1->row();
				}	else {
					$this->db->select('*')
					->from('user_details')
					->where('fb_id',$fb_id);
					$getuser1=$this->db->get();
					$result =$getuser1->row();
				}
				if($firstname==""){
					$firstname=$result->firstname;
				}
				if($lastname==""){
					$lastname=$result->lastname;
				}
				if($password==""){
					$password=$result->password;
				}
			$data=$this->Usermodel->updateSignUpData($fb_id,NULL,$firstname,$lastname,$email_id,$password);
			}
			else{
			$data=$this->Usermodel->signupSuccess($email_id,$firstname,$lastname,NULL,$fb_id,NULL,$password);
			}
			
			if($data['statusCode']==1)
			{
			redirect('web/home');
			}
			else{
				echo 'error';
			}
		
		 }
		 else{
				echo 'no fb_user';
				echo"<pre>";
			print_r($fb_user);
			echo"</pre>";
			}
	}
	
	public function gplus_login($page=1){
		
		if (isset($_GET['code'])) {
			
			$this->googleplus->getAuthenticate();
			$this->session->set_userdata('login',true);
			$userProfile=$this->googleplus->getUserInfo();
			//$this->session->set_userdata('user_profile',$this->googleplus->getUserInfo());
			 $gplus_id= $userProfile['id'];
			 $firstname=$userProfile['given_name'];
			 $lastname = $userProfile['family_name'];
			 $email_id = $userProfile['email'];
			 $password='';
			 $this->db->select('*')->from('user_details')->where('email_id',$email_id);
			$getuser=$this->db->get();
			$rows =$getuser->num_rows();
			if($rows>0)
			{
				
				if($email_id!=""){
					$this->db->select('*')
					->from('user_details')
					->where('email_id',$email_id);
					$getuser1=$this->db->get();
					$result =$getuser1->row();
				}	else {
					$this->db->select('*')
					->from('user_details')
					->where('fb_id',$fb_id);
					$getuser1=$this->db->get();
					$result =$getuser1->row();
				}
				if($firstname==""){
					$firstname=$result->firstname;
				}
				if($lastname==""){
					$lastname=$result->lastname;
				}
				if($password==""){
					$password=$result->password;
				}
			$data=$this->Usermodel->updateSignUpData(NULL,$gplus_id,$firstname,$lastname,$email_id,$password);
			}
			else{
			$data=$this->Usermodel->signupSuccess($email_id,$firstname,$lastname,NULL,NULL,$gplus_id,$password);
			}
			
			if($data['statusCode']==1)
			{
			redirect('web/home');
			}
			
		} 
	}
}
