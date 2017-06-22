<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email  stock
class Diamond_manage_stock extends Admin_Controller {
	public $page='diamond_manage_stock';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('Stock_model');
		$this->load->Model('Diamond_stock_model');
	
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		 
		
	}
	
	public function manage_stock(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');
		$data['stock_list'] = $this->Stock_model->stock_list();
		
		$submit = $this->input->post("submit",true);
		$product_id = $this->input->post("product_id",true);
		if(($submit)&&(is_array($product_id))){	
			if(!empty($product_id)){
				$this->db->where_in('product_id',$product_id );
				$this->db->delete('product');
				$this->session->set_flashdata('success', 'Success: stock has been deleted');			
			} else {
				$this->session->set_flashdata('error', 'Error: Please select at last one stock');
			}
			redirect('admin/stock/manage_stock');
		}
		
			
		
		

		
		///////////
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('manage_stock_view', $data);
		$this->load->view('footer', $data);
	}
	public function stock_delete(){
		$data['page'] = $this->page;
		$ddata = $this->input->post();
		$data['username'] = $this->session->userdata('username');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$this->session->unset_userdata('success');
		$this->session->unset_userdata('error');
		
		$id = $this->session->userdata('id');
		
		$submit=trim($this->input->post('submit',true));
		$product_id=$this->input->post('product_id',true);
		if(isset($ddata['example_length'])&&($ddata['example_length']!="")){
			
			if(!empty($ddata['product_id'])){
							
				$this->db->where_in('product_id',$ddata['product_id'] );			
				$this->db->delete('product_diamond'); 
				$data['success']='Success: stock has been deleted';
				 $this->session->set_flashdata('success', 'Success: stock has been deleted');
				 redirect('admin/diamond_manage_stock/stock_delete');
			} else {
				$data['error']='Error: Please select at last one stock';
				$this->session->set_flashdata('error', 'Error: Please select at last one stock');
				redirect('admin/diamond_manage_stock/stock_delete');
			}
			
			
		}
		
		
		$data['diamond_stock_list'] = $this->Diamond_stock_model->diamond_stock_list(); 
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('diamond_stock_delete_view', $data);
		$this->load->view('footer', $data);
	}
	
	public function edit(){
		$data['page'] = $this->page;
		$data['username'] = $this->session->userdata('username');
		$data['successful'] = $this->session->flashdata('successful');
		
		$id = $this->session->userdata('id');
		$diamond_stock_id  = $data['diamond_stock_id']= trim($this->input->get('id',true));
		
		
		
		
		
		if(!is_numeric($diamond_stock_id)){
			redirect('admin/diamond_manage_stock');
		}
		$submit=$this->input->post('submit',true);
		$product_name=$this->input->post('product_name',true);
		$availability=$this->input->post('availability',true);
		if($submit){
			$update_data=array(				
				'product_name'=>$product_name,				
				'status'=>$availability,
				'updated_on'=>date("Y-m-d H:i:s"),				
				'updated_by'=>$data['username']
			);
			$this->db->where('product_id', $diamond_stock_id);
			$this->db->update('product_diamond', $update_data); 
			$data['successful'] ="success: Product successfully updated";
			
			$this->session->set_flashdata('successful',"success: Product successfully updated");
			
			redirect('admin/diamond_manage_stock/edit?id='.$diamond_stock_id);
			
		}
		
		$data['diamond_stock'] = $this->Diamond_stock_model->diamond_stock_list($diamond_stock_id);
		
		foreach($data['diamond_stock'] as $diamond_stock_row){
			$data['product_name']=$diamond_stock_row->product_name;
			$data['status']=$diamond_stock_row->status;
		}
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);		
		$this->load->view('diamond_stock_edit_view', $data);
		$this->load->view('footer', $data);
		
	}
	public function index(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		
		$data['diamond_stock_list'] = $this->Diamond_stock_model->diamond_stock_list();
		/* echo "<pre>";
		print_r($data); exit; */
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		//$this->load->view('stock_view', $data);
		$this->load->view('diamond_stock_list_view', $data);
		$this->load->view('footer', $data);
		
		
	}
	
	

	
	
	
	
	 
 
	
		
	
}
