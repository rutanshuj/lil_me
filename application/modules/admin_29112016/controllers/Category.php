<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email 
class Category extends Admin_Controller {
	public $page='category';
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
		$this->load->Model('Master_model');
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		 
		
	}
	
	function makeThumbnails($filepath,$thumbpath,$thumbnail_width,$thumbnail_height) {
		
		
		
		
    list($original_width, $original_height, $original_type) = getimagesize($filepath);
    if ($original_width > $original_height) {
        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }
    $dest_x = intval(($thumbnail_width - $new_width) / 2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);

    if ($original_type === 1) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    } else if ($original_type === 2) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    } else if ($original_type === 3) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    } else {
        return false;
    }

    $old_image = $imgcreatefrom($filepath);
    $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
    imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
    $imgt($new_image, $thumbpath);

    return file_exists($thumbpath);
}
	
	
	public function index(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');	
		
		$data['category_list'] = $this->Category_model->product_category();
		/* echo count($data['category_list']);
		 echo "<pre>";
		print_r($data['category_list']);  */
		
		
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('category_view', $data);
		$this->load->view('footer', $data);
		
	}
	
	public function add(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		
		$id = $this->session->userdata('id');		
		
		$data['category_name'] =$data_save['category_name']= trim($this->input->post('category_name',true));
		$data['sort_order'] =$data_save['sort_order']= trim($this->input->post('sort_order',true));
		
		
		
		$this->form_validation->set_rules('category_name', 'Category Name', 'required|is_unique[product_category.category_name]');
		$this->form_validation->set_rules('sort_order', 'Sort Order', 'required');
		
		if ($this->form_validation->run() == True){
			
			if (!empty($_FILES['userfile']['name'])) {
				///////////////// 
				$config['upload_path'] = CATEGORY_IMAGE_UPLOAD;
				$config['allowed_types'] = MARKET_NEWS_IMAGE_TYPE;
				$config['max_size']	= CATEGORY_IMAGE_MAX_SIZE;
				$config['max_width']  = CATEGORY_IMAGE_MAX_WIDTH;				
				$config['max_height']  = CATEGORY_IMAGE_MAX_HEIGHT;
				$config['file_name'] = $data_save['category_name'];
				$this->load->library('upload', $config);
				
				
				if ( ! $this->upload->do_upload()) {				
					$data['error'] = array('error' => $this->upload->display_errors());	
				}  else {					
					$image_data = $this->upload->data();
					$data_save['image_url']=$image_location=CATEGORY_IMAGE_UPLOAD.$image_data['orig_name'];
					
					
					$thumbpath=CATEGORY_IMAGE_UPLOAD.$image_data['raw_name'].'_thumbnail'.$image_data['file_ext'];
					$data_save['image_thumbnail_url']=$thumbpath;
					
					$this->makeThumbnails($data_save['image_url'],$thumbpath,THUMBNAIL_IMAGE_MAX_WIDTH,THUMBNAIL_IMAGE_MAX_HEIGHT);
									
					
				}				
			} //else {
				//$data['error']="Please select category image";
			//}
			
			$data_save['description']="Added by admin ";
			$data_save['created_on']=date("Y-m-d H:i:s");
			$data_save['created_by']=$data['username'];
			
			
			$this->db->insert('product_category', $data_save); 
			$this->session->set_flashdata('success', 'Success: Category has been successfully added');
			redirect('admin/category/add');
			
			
			
			
		}		
				
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('category_add_view', $data);
		$this->load->view('footer', $data);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 public function category_delete(){
		$id=trim($this->input->get('id',true));
		$error="";
		$message = "Error:: Category is not deleted, please try again";
		if(is_numeric($id)){			
			//$this->Category_model->category_deleted($id);	
			//// count product , sub-cat 
				/// count product$this->db->where('username',$username);
			$this->db->where('category_id',$id);
			$this->db->where('is_active',1);
			$this->db->from('product_subcategory');
			$count = $this->db->count_all_results();
			
				////
			/// product
			$this->db->where('category_id',$id);
			$this->db->where('is_active',1);
			$this->db->from('product');

			$count1 = $this->db->count_all_results();
			if(($count!="0")&&($count1!="0")){
				$error ="Category has can not be deleted since ".$count." subcategories and ".$count1." products are linked to it ";
			} else 
			if($count!="0"){
				$error ="Category has can not be deleted since  ".$count." subcategories are linked to it  ";
			} else 
			if($count1!="0"){
				$error ="Category has can not be deleted since  ".$count1." products are linked to it  ";
			}	
			////
			if($error==""){
				$data_update['is_active']="0";
				//$this->db->where('category_id',$id);
				//$this->db->update('product_category', $data_update);	
				
				 $this->db->where('category_id', $id);
				$this->db->delete('product_category'); 
				
				$message = "Category has been successfully deleted";	
				$this->session->set_flashdata('success', $message);	
			} else {
				$this->session->set_flashdata('error', $error);
			}
			
		} else {
			$this->session->set_flashdata('error', $message);
		}
		
		redirect('admin/category');
	}  
 
 public function category_name_check($category_id,$category_name){
		
		
		$total_num =$this->Category_model->category_name_validation($category_id,$category_name);
		if($total_num!="0"){
			$this->form_validation->set_message('category_name', 'Category Name already exists');
			return FALSE;
		}
		
	}
 
	public function edit(){
		$data['page'] = $this->page;
		
		$data['category_id']=$category_id=$this->input->get('id',true);
		
		if(!is_numeric($category_id)){
			redirect('admin/category');
		}
		
		
		$data['username'] = $this->session->userdata('username');		
		$id = $this->session->userdata('id');
		
		
		$submit = $this->input->post("submit",true);
		if($submit){
			$data['category_name'] = trim($this->input->post('category_name',true));			
			$data['sort_order'] =$data_update['sort_order'] = trim($this->input->post('sort_order',true));			
			
			$total_num1 =$this->Category_model->category_name_validation($category_id,$data['category_name'],'1');
			
			if($total_num1=="0"){
				$data_update['category_name'] =$data['category_name'];
			}
			$description= trim($this->input->post('description',true));
		
		
		
			$this->form_validation->set_rules('category_name', 'Category Name', 'required');
			$this->form_validation->set_rules('sort_order', 'Sort Order', 'required');
		
						
			//$this->category_name_check($category_id,$data['category_name']);				 				
			$total_num =$this->Category_model->category_name_validation($category_id,$data['category_name']);
		
		if($total_num!="0"){
			$data['error']="Category Name already exists";
		} else {
		
			if ($this->form_validation->run() == True){
				if (!empty($_FILES['userfile']['name'])) {
					$config['upload_path'] = CATEGORY_IMAGE_UPLOAD;
					$config['overwrite'] =true;
					$config['allowed_types'] = MARKET_NEWS_IMAGE_TYPE;
					$config['max_size']	= CATEGORY_IMAGE_MAX_SIZE;
					$config['max_width']  = CATEGORY_IMAGE_MAX_WIDTH;				
					$config['max_height']  = CATEGORY_IMAGE_MAX_HEIGHT;
					$config['file_name'] = $data['category_name'];
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload()) {				
						$error = array('error' => $this->upload->display_errors());	
					}  else {					
						$image_data = $this->upload->data();
						$data_update['image_url']=$image_location=CATEGORY_IMAGE_UPLOAD.$image_data['orig_name'];		
						
						$thumbpath=CATEGORY_IMAGE_UPLOAD.$image_data['raw_name'].'_thumbnail'.$image_data['file_ext'];
						$data_update['image_thumbnail_url']=$thumbpath;
						
						$this->makeThumbnails($data_update['image_url'],$thumbpath,THUMBNAIL_IMAGE_MAX_WIDTH,THUMBNAIL_IMAGE_MAX_HEIGHT);
											
					}				
				}
				
				$data_update['description']=$description." updated by admin ";
				$data_update['updated_on']=date("Y-m-d H:i:s");
				$data_update['updated_by']=$data['username'];
				
				//////
				$this->db->where('category_id',$category_id);
				$this->db->update('product_category', $data_update);
				//echo $this->db->last_query();
				//exit;
			
				$this->session->set_flashdata('success', 'Success: Category has been successfully updated');
				redirect('admin/category/edit?id='.$data['category_id']);	
				///////
				
			}			
								
				
			} 
		}
		 $category_detail =$this->Category_model->product_category($category_id);
	
		$data['success'] = $this->session->flashdata('success');
		foreach($category_detail as $category_row){			
			$data['category_id'] = $category_row->category_id;
			$data['category_name'] = $category_row->category_name;
			$data['description']= $category_row->description;
			$data['image_url'] = $category_row->image_url;			
			$data['sort_order'] = $category_row->sort_order;			
			$data['image_thumbnail_url'] = $category_row->image_thumbnail_url;			
		}
		
		if($data['image_url']==""){
			$data['image_url']="assets/img/default.jpg";
		}
		/* echo "<pre>";
		print_r($data['master_attribute_type']);
		exit; //  */
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('category_edit_view', $data);
		$this->load->view('footer', $data);
		///////////
		 
		//echo "</pre>";
		//print_r($data);
		
	}
	public function add12(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		
		
		$data['master_attribute_header']=$this->Master_model->master_attribute_header();
			
		$data['master_attribute_type']=$this->Master_model->master_attribute_type();
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
				$this->db->insert('attribute', $data_save); 
				$this->session->set_flashdata('message', 'Success attribute added');
				redirect('admin/attribute/add');	
			}
			
			
		}
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('attribute_add_view', $data);
		$this->load->view('footer', $data);
	}
		
	
}
