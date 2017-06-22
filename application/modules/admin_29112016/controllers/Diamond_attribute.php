<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email 
class Diamond_attribute extends Admin_Controller {
	public $page='diamond_attribute';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('Diamond_attributes_model');
		$this->load->Model('Master_model');
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		 
		
	}
	
	public function index(){
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');		
		
		$data['attributes']=$this->Diamond_attributes_model->get_diamond_attributes();
		
		
		
		$data['master_attribute_header']=$this->Master_model->master_diamond_attribute_header();
		
		$m_attribute_header =$m_attribute_type= array();
		foreach($data['master_attribute_header'] as $attribute_header_row){
			$m_attribute_header[$attribute_header_row->attribute_header_id]=$attribute_header_row->attribute_header_title;
		}
		
		$data['master_attribute_type']=$this->Master_model->master_diamond_attribute_type();
		
		foreach($data['master_attribute_type'] as $master_attribute_row){
			$m_attribute_type[$master_attribute_row->attribute_type_id]=$master_attribute_row->attribute_type_title;
		}
		
		$data['m_attribute_header'] =$m_attribute_header;
		$data['m_attribute_type'] =$m_attribute_type;
		
		
		
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		
		$this->load->view('diamond_attribute_view', $data);
		
		$this->load->view('footer', $data);
		
	}
	
	
	 public function diamond_attribute_delete(){
		$id=trim($this->input->get('id',true));
		$headline=trim($this->input->get('headline',true));
		$message = "Error:: ".$headline." is not deleted, please try again";
		if(is_numeric($id)){			
			$this->Diamond_attributes_model->diamond_attributes_deleted($id);			
			$message = "Attribute has been deleted";		
			$this->session->set_flashdata('success', $message);
		} else {
			$this->session->set_flashdata('error', $message);
		}
		
		redirect('admin/diamond_attribute');
	} 
 
	public function edit(){
		$data['page'] = $this->page;
		
		$data['attribute_id']=$attribute_id=$this->input->get('id',true);
		if(!is_numeric($attribute_id)){
			redirect('admin/diamond_attribute');
		}
		
		
		
		
		
		$data['username'] = $this->session->userdata('username');
		
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');
		
		
		$data['master_attribute_header']=$this->Master_model->master_diamond_attribute_header();
			
		$data['master_attribute_type']=$this->Master_model->master_diamond_attribute_type();
		
		 $attribute_detail =$this->Diamond_attributes_model->get_diamond_attributes($attribute_id);
		
		
		foreach($attribute_detail as $attribute_row){
			
			$data['sort_order'] = $attribute_row->sort_order;
			$data['attribute_header_id'] = $attribute_row->attribute_header;
			$data['attribute_name']= $attribute_row->attribute_name;
			$data['attribute_type_id'] = $attribute_row->attribute_type;			
			
		}
		
		
		
		
		$submit = $this->input->post("submit",true);
		if($submit){
			$data['sort_order'] =$sort_order = trim($this->input->post('sort_order',true));
			$data['attribute_header_id'] =$attribute_header_id = trim($this->input->post('attribute_header_id',true));
			$data['attribute_name'] =$attribute_name = trim($this->input->post('attribute_name',true));
			$data['attribute_type_id'] =$attribute_type_id = trim($this->input->post('attribute_type_id',true));
			
			$this->form_validation->set_rules('sort_order', 'Sort Order', 'required');
			$this->form_validation->set_rules('attribute_header_id', 'Atrribute Header', 'required');
			$this->form_validation->set_rules('attribute_name', 'Attribute Name', 'required');
			
			$this->form_validation->set_rules('attribute_type_id', 'Attribute Type', 'required');
			
			$total_num = $this->Diamond_attributes_model->attributes_validate($data['attribute_id'],$data['attribute_name']);
			
			if($total_num!="0"){
				$data['error']="Attribute Name already exists";
			} else 	
			if ($this->form_validation->run() == True){
				$data_update = array(
				   'attribute_name' => $attribute_name ,
				   'attribute_type' => $attribute_type_id ,
				   'sort_order' => $sort_order,				   
				   'attribute_header' => $attribute_header_id,
				   'updated_by' => $data['username'],
				   'updated_on' => date("Y-m-d H:i:s")
				   
				);
				
				$this->db->where('attribute_id', $attribute_id);
				$this->db->update('attribute_diamond', $data_update);
				
				//$this->db->insert('attribute', $data_update); 
				
				$this->session->set_flashdata('success', 'Attribute has been successfully updated');
				redirect('admin/diamond_attribute/edit?id='.$attribute_id);	
			}
			
			
		}
		
		
		/* echo "<pre>";
		print_r($data['master_attribute_type']);
		exit; //  */
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('diamond_attribute_edit_view', $data);
		$this->load->view('footer', $data);
		///////////
		 
		//echo "</pre>";
		//print_r($data);
		
	}
	public function add(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');
		
			
		$data['master_attribute_header']=$this->Master_model->master_diamond_attribute_header();
			
		$data['master_attribute_type']=$this->Master_model->master_diamond_attribute_type();
		$submit = $this->input->post("submit",true);
		if($submit){
			$data['sort_order'] =$sort_order = trim($this->input->post('sort_order',true));
			$data['attribute_header_id'] =$attribute_header_id = trim($this->input->post('attribute_header_id',true));
			$data['attribute_name'] =$attribute_name = trim($this->input->post('attribute_name',true));
			$data['attribute_type_id'] =$attribute_type_id = trim($this->input->post('attribute_type_id',true));
			
			$this->form_validation->set_rules('sort_order', 'Sort Order', 'required');
			$this->form_validation->set_rules('attribute_header_id', 'Atrribute Header', 'required');
			$this->form_validation->set_rules('attribute_name', 'Attribute Name', 'required|is_unique[attribute.attribute_name]');
			$this->form_validation->set_rules('attribute_type_id', 'Attribute Type', 'required');
			if ($this->form_validation->run() == True){
				$data_save = array(
				   'attribute_name' => $attribute_name ,
				   'attribute_type' => $attribute_type_id ,
				   'sort_order' => $sort_order,				   
				   'attribute_header' => $attribute_header_id,
				   'created_by' => $data['username'],
				   'created_on' => date("Y-m-d H:i:s")
				   
				);
				$this->db->insert('attribute_diamond', $data_save); 
				
				$this->session->set_flashdata('success', 'Success: Attribute has been added');
				redirect('admin/diamond_attribute/add');	
			}
			
			
		}
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('diamond_attribute_add_view', $data);
		$this->load->view('footer', $data);
	}
		
	
}
