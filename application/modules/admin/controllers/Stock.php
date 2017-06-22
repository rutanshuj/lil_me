<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email  stock
class Stock extends Admin_Controller {
	public $page='stock';
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
		$this->load->Model('Category_model');
		$this->load->Model('Sub_category_model');
		
	
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		 
		
	}
	public function test(){
		$str = "An example of a long word is: Supercalifragulistic";
echo wordwrap($str,10,"<br>\n");
	}
	public function manage_stock(){
		$ddata = $this->input->post();
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');
		$data['stock_list'] = $this->Stock_model->stock_list();
		$this->session->unset_userdata('success');
		$this->session->unset_userdata('error');
		$submit = $this->input->post("submit",true);
		$product_id = $this->input->post("product_id",true);
		
		if(isset($ddata['example_length'])&&($ddata['example_length']!="")){
		//if(($submit)&&(is_array($product_id))){	

			if(!empty($ddata['product_id'])){
			$data_update = array(
               'is_active' =>0,
               'updated_on' => date("Y-m-d H:i:s"),
               'updated_by' => $data['username']
            );	
			$this->db->where_in('product_id',$ddata['product_id'] );
			//$this->db->delete('product');			
			$this->db->update('product',$data_update); 			
			
			$data['success']='Success: stock has been deleted';
				 $this->session->set_flashdata('success', 'Success: stock has been deleted');
				redirect('admin/stock/manage_stock');
			
			
			} else {
				$data['error']='Error: Please select at last one stock';
				$this->session->set_flashdata('error', 'Error: Please select at last one stock');
				redirect('admin/stock/manage_stock');
			}
			
		}
		
		$category_list = $this->Category_model->product_category();
		$cate_select="";
		foreach($category_list as $category_list_row){			
			$cate_select .= "<option value=\"".$category_list_row->category_name."\">".$category_list_row->category_name."</option>";		
		}
		
		$gender_list = $this->Stock_model->gender_list();
		$sub_category_select="";
		foreach($gender_list as $gender_row){			
			$sub_category_select .= "<option value=\"".$gender_row->gender."\">".$gender_row->gender."</option>";		
		}
		
		
		
		
		$data['cate_select']=$cate_select;
		$data['sub_category_select']=$sub_category_select;

		
		///////////
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('manage_stock_view', $data);
		$this->load->view('footer', $data);
	}
	public function index(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$data['stock_list'] = $this->Stock_model->stock_list();
		
		$category_list = $this->Category_model->product_category();
		$cate_select="";
		foreach($category_list as $category_list_row){			
			$cate_select .= "<option value=\"".$category_list_row->category_name."\">".$category_list_row->category_name."</option>";		
		}
		
		
		$gender_list = $this->Stock_model->gender_list();
		$sub_category_select="";
		foreach($gender_list as $gender_row){			
			$sub_category_select .= "<option value=\"".$gender_row->gender."\">".$gender_row->gender."</option>";		
		}
		
		
		
		$data['cate_select']=$cate_select;
		$data['sub_category_select']=$sub_category_select;
		/*  echo "<pre>";
		print_r($sub_category_list); exit;  */
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		//$this->load->view('stock_view', $data);
		$this->load->view('stock_view_rnd', $data);
		$this->load->view('footer', $data);
		
		
	}
	
	

	
	
	
	
	 
 
	
		
	
}
