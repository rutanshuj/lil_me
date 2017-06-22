<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email 
class Sub_category extends Admin_Controller {
	public $page='sub_category';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('Category_model');
		$this->load->Model('Sub_category_model');
		$this->load->Model('Master_model');
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		 
		
	}
	
	public function index(){
		$data['page'] = $this->page;
		$data['username'] = $this->session->userdata('username');
		
		
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		
		$id = $this->session->userdata('id');
		$data['sub_category'] = $this->Sub_category_model->sub_category();
		/* echo "<pre>";
		print_r($data);
		exit; */
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('sub_category_view', $data);
		$this->load->view('footer', $data);
	}
	
	public function add(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');	
		$data['category_list'] = $this->Category_model->product_category();
		
		 
		$data['sub_category_name'] =$data_save['subcategory_name']= trim($this->input->post('sub_category_name',true));
		$data['sort_order'] =$data_save['sort_order']= trim($this->input->post('sort_order',true));
		
		
		
		$data['category_id'] =$data_save['category_id']= trim($this->input->post('category_id',true));
		$submit =$this->input->post('submit',true);
		
		$this->form_validation->set_rules('sub_category_name', 'Sub-Category Name', 'required');
		$this->form_validation->set_rules('category_id', 'Category Name', 'required');
		
		
		
		$this->form_validation->set_rules('sort_order', 'Sort Order', 'required');
		if($submit){
			
			$total_num1 =$this->Sub_category_model->sub_category_name_validation($data['category_id'],$data['sub_category_name'],'2',NULL);
			
			
			if (($this->form_validation->run() == True)&&($total_num1=="0")){
				$data_save['description']="Added by admin ";
				$data_save['created_on']=date("Y-m-d H:i:s");
				$data_save['created_by']=$data['username'];
				$this->db->insert('product_subcategory', $data_save); 				
				$this->session->set_flashdata('success', 'Success: sub-Category has been successfully added');
				redirect('admin/sub_category/add');	
			} else {
				$data['error']="error: Sub-Category name already exists";
			}
		}			 
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('sub_category_add_view', $data);
		$this->load->view('footer', $data);
		
	}
	
	
	
	 public function sub_category_delete(){
		$id=trim($this->input->get('id',true));
		$error="";
		$message = "Error:: sub-Category is not deleted, please try again";
		if(is_numeric($id)){			
			//$this->Sub_category_model->sub_category_deleted($id);			
			

/// product
			$this->db->where('subcategory_id',$id);
			$this->db->from('product');
			$this->db->where('is_active',1);
			$count1 = $this->db->count_all_results();
			
			if($count1!="0"){
				$error ="Sub Category can not be deleted since  ".$count1." products are linked to it.  ";
			}
			if($error==""){
			$data_update['is_active']="0";
			$this->db->where('subcategory_id',$id);
			$this->db->update('product_subcategory', $data_update);
			$message = "Sub-category has been successfully deleted";
			$this->session->set_flashdata('success', $message);	
			} else {
				$this->session->set_flashdata('error', $error);
			}
			
		} else {
			$this->session->set_flashdata('error', $message);
		}
		
		redirect('admin/sub_category');
	} 
	
	
	public function edit(){
		$data['page'] = $this->page;
		
		$data['sub_category_id']=$sub_category_id=$this->input->get('id',true);
		$data['category_list'] = $this->Category_model->product_category();
		if(!is_numeric($sub_category_id)){
			redirect('admin/sub_category');
		}
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');
		
		$subcategory_detail =$this->Sub_category_model->sub_category($sub_category_id);
	
		$previous_category_id="";
		foreach($subcategory_detail as $subcategory_row){			
			$data['subcategory_id'] = $subcategory_row->subcategory_id;
			$data['subcategory_name'] = $subcategory_row->subcategory_name;
			$data['category_id']= $subcategory_row->category_id;
			$data['description'] = $subcategory_row->description;			
			$data['category_name'] = $subcategory_row->category_name;
			$data['sort_order'] =	$subcategory_row->sort_order;
		}
		
		$submit = $this->input->post("submit",true);
		if($submit){
			$data['subcategory_name'] = trim($this->input->post('subcategory_name',true));
			
			
			
			$total_num1 =$this->Sub_category_model->sub_category_name_validation($sub_category_id,$data['subcategory_name'],'1',NULL);
			
			if($total_num1=="0"){
				$data_update['subcategory_name'] =$data['subcategory_name'];
			}
			$category_id=$data['category_id']=$data_update['category_id'] =$product_update['category_id']= trim($this->input->post('category_id',true));	
			$data['sort_order'] =$data_update['sort_order'] = trim($this->input->post('sort_order',true));	
			
			$this->form_validation->set_rules('subcategory_name', 'Category Name', 'required');
		
						
						 				
			$total_num =$this->Sub_category_model->sub_category_name_validation($sub_category_id,$data['subcategory_name'],'3',$data['category_id']);
			
			
			if($total_num!="0"){
				$data['error']="Sub Category Name already exists";
			} else {
				$this->form_validation->set_rules('subcategory_name', 'Sub-Category Name', 'required');
				$this->form_validation->set_rules('category_id', 'Category Name', 'required');
				if ($this->form_validation->run() == True){
					$data_update['description']="updated by admin ";
					$product_update['updated_on']=$data_update['updated_on']=date("Y-m-d H:i:s");
					$product_update['updated_by']=$data_update['updated_by']=$data['username'];
					
					
					
					//////
					$this->db->where('subcategory_id',$sub_category_id);
					$this->db->update('product', $product_update);
					
					///////////////////////
					//////
					$this->db->where('subcategory_id',$sub_category_id);
					$this->db->update('product_subcategory', $data_update);
					
				
					$this->session->set_flashdata('success', 'Success: Sub Category has been successfully updated');
					redirect('admin/sub_category/edit?id='.$sub_category_id);
				}
			}
				
		}
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('sub_category_edit_view', $data);
		$this->load->view('footer', $data);
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
	
}
