<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {
	public $page='verify_user';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('User_model');
		$this->load->Model('Master_model');
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		
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
			//echo "<pre>";
			//print_r($data['jewellery_favorites']);
		//	$data['diamond_favorites']=$this->User_model->user_diamond_favorites($id);
			
			//$data['user_out_on_memo']=$this->User_model->user_out_on_memo($id);
			
		
			/* $j_limit="0";
			if(is_array($data['user_out_on_memo'])&&(!empty($data['user_out_on_memo']))){
				
				
				foreach($data['user_out_on_memo'] as $user_memo_row){
					$j_limit++;
					if($j_limit=="1"){
					$data['j_out_on_memo_id']=$user_memo_row->out_on_memo_id;
					$data['j_product_id']=$user_memo_row->product_id;
					$data['j_memo_request_date']=$user_memo_row->memo_request_date;
					$data['j_status']=$user_memo_row->status;
					$data['j_created_on']=$user_memo_row->created_on;
					$data['j_product_name']=$user_memo_row->product_name;
					$data['j_image_url']=$user_memo_row->image_url;
					$data['j_image_thumbnail_url']=$user_memo_row->image_thumbnail_url;
				}
				}
			} */
		/* 	
			$data['user_out_on_memo_diamond']=$this->User_model->user_out_on_memo_diamond($id);
			 $d_limit="0";
			if(is_array($data['user_out_on_memo_diamond'])&&(!empty($data['user_out_on_memo_diamond']))){
				foreach($data['user_out_on_memo_diamond'] as $diamond_user_memo_row){
					$d_limit++;
					if($d_limit=="1"){
					$data['d_out_on_memo_id']=$diamond_user_memo_row->out_on_memo_id;
					$data['d_product_id']=$diamond_user_memo_row->product_id;
					$data['d_memo_request_date']=$diamond_user_memo_row->memo_request_date;
					$data['d_status']=$diamond_user_memo_row->status;
					$data['d_created_on']=$diamond_user_memo_row->created_on;
					$data['d_product_name']=$diamond_user_memo_row->product_name;
					$data['d_image_url']=$diamond_user_memo_row->image_url;
					$data['d_image_thumbnail_url']=$diamond_user_memo_row->image_thumbnail_url;
				}
				}
			} */
			
			
			
			
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
			
		/* 	foreach($data['diamond_favorites'] as $d_favorites_rows){
				$d_favorites_rows->favourite_id;
				$d_favorites_rows->product_id;
				$d_favorites_rows->product_name;
				$d_favorites_rows->image_thumbnail_url;				
				$d_favorites_rows->image_url;
				$d_favorites_rows->image_thumbnail_url;
			} */
			
			
		} else {
			/// close pop-up due to invalid username
		}
				
        
		
	
    
    	/*  echo "<pre>";
		print_r($data['jewellery_favorites']);	
		print_r($data['diamond_favorites']);	
		exit;  */
		$this->load->view('header', $data);	
		
		$this->load->view('user_view', $data);			
					
	}
	public function favorites(){
		$data['page'] = $this->page;
		$data['total_favorites']="0";
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$data['id']=$id =trim($this->input->get('id',true));
		$jewellery_favorites= $diamond_favorites=array();
		if(is_numeric($id)){
			$data['back_url']= base_url('admin/user?id=').$id;
			$jewellery_favorites=$this->User_model->user_favorites($id);
			//$diamond_favorites=$this->User_model->user_diamond_favorites($id);
			
			$data['total_favorites']=count($jewellery_favorites);
		} else {
			$data['error'] ="User id is not valid";
		}
		$data['jewellery_favorites']=$jewellery_favorites;
		//$data['diamond_favorites']=$diamond_favorites;
		$this->load->view('header', $data);	
		
		$this->load->view('user_favorites_view', $data);
		
	}
	public function jewellery_memo(){
		$data['page'] = $this->page;
		$user_out_on_memo= array();
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$data['id']=$id =trim($this->input->get('id',true));
		$data['total_memo']="0";
		if(is_numeric($id)){
			$data['back_url']= base_url('admin/user?id=').$id;
			$user_out_on_memo=$this->User_model->user_out_on_memo($id);	
			$data['total_memo']=count($user_out_on_memo);			
		} else {
			$data['error'] ="User id is not valid";
		}
		$data['user_out_on_memo']=$user_out_on_memo;
		$this->load->view('header', $data);	
		
		$this->load->view('user_jewellery_memo_view', $data);
	}
	
	public function diamond_memo(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$data['id']=$id =trim($this->input->get('id',true));
		$user_out_on_memo_diamond= array();
		$data['total_memo']="0";
		if(is_numeric($id)){
			$data['back_url']= base_url('admin/user?id=').$id;
			$user_out_on_memo_diamond=$this->User_model->user_out_on_memo_diamond($id);
			$data['total_memo']=count($user_out_on_memo_diamond);
		} else {
			$data['error'] ="User id is not valid";
		}
		$data['user_out_on_memo_diamond']=$user_out_on_memo_diamond;
		$this->load->view('header', $data);	
		
		$this->load->view('user_diamond_memo_view', $data);
	}
	
	
	
}
