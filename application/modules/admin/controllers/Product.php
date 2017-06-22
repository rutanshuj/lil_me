<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email  stock
class Product extends Admin_Controller {
	public $page='product';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('Product_model');
		$this->load->Model('Category_model');
		//$this->load->Model('Sub_category_model');
		$this->load->Model('Stock_model');
	
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		 
		
	}
	
	public function image_edit(){
		$this->load->library('make_thumbnails');
		
		$data['page'] = $this->page;
		$attribute_value = array();
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$data['product_id']=$insert_id=$this->input->get('id',true);
		if(!is_numeric($data['product_id'])){
			redirect('admin/project');
		}
		$image_del=$this->input->post('image_del',true);
		$delete=$this->input->post('delete',true);
		//$multi_upload=$this->input->post('multi_upload',true);
		$upload=$this->input->post('upload',true);
		  
		if(isset($upload)){
			//print_r($_FILES['multi_upload']['name']['0']);
			//echo count($_FILES['multi_upload']['name']);//exit;
			if(isset($_FILES['multi_upload']['name']['0'])&&(!empty($_FILES['multi_upload']['name']['0']))){
			//exit;	
			$product_details = $this->Product_model->get_product_details($data['product_id']);
			///
			
				$count = count($_FILES['multi_upload']['name']);
				
				if($count!="0"){					
					$config['upload_path'] = CATEGORY_IMAGE_UPLOAD;
					$config['allowed_types'] = MARKET_NEWS_IMAGE_TYPE;
					$config['max_size']	= CATEGORY_IMAGE_MAX_SIZE;
					$config['max_width']  = CATEGORY_IMAGE_MAX_WIDTH;				
					$config['max_height']  = CATEGORY_IMAGE_MAX_HEIGHT;
					$this->load->library('upload', $config);
										
					for($i=0;$i<$count;$i++){
															
						
						$_FILES['userfile']['name']= $_FILES['multi_upload']['name'][$i];
						$_FILES['userfile']['type']= $_FILES['multi_upload']['type'][$i];
						$_FILES['userfile']['tmp_name']= $_FILES['multi_upload']['tmp_name'][$i];
						$_FILES['userfile']['error']= $_FILES['multi_upload']['error'][$i];
						$_FILES['userfile']['size']= $_FILES['multi_upload']['size'][$i];
						$config['file_name'] = uniqid();		
						$this->upload->initialize($config);
						
						if ( ! $this->upload->do_upload()) {				
							$error[] = array('error' => $this->upload->display_errors());
							
						}  else {					
							$image_data = $this->upload->data();							
							$data_save['image_url']=$image_location=CATEGORY_IMAGE_UPLOAD.$image_data['file_name'];					
							$thumbpath=CATEGORY_IMAGE_UPLOAD.$image_data['raw_name'].'_thumbnail'.$image_data['file_ext'];
							
							$data_save['image_thumbnail_url']=$thumbpath;
							
							
							$this->make_thumbnails->create_thumbnails($data_save['image_url'],$thumbpath,THUMBNAIL_IMAGE_MAX_WIDTH,THUMBNAIL_IMAGE_MAX_HEIGHT);			
							
							 $product_images_save[]=array(
								'image_url'=>substr($data_save['image_url'], 2),
								'image_thumbnail_url'=>substr($data_save['image_thumbnail_url'], 2),
								'product_id'=>$insert_id,
								'created_on'=>date("Y-m-d H:i:s"),
								'created_by'=>$data['username'],
								'updated_on'=>date("Y-m-d H:i:s"),
								'updated_by'=>$data['username']
							);	
						}
					}
					$this->db->insert_batch('product_images', $product_images_save); 
					$data['success']="success: Image has beed successfully updated";		
				}	
			//exit;
			} else {
				$data['error'] = "Please select at least one image for upload";
			}
		
		}
		if(isset($delete)){			
			if(is_array($image_del)&&(!empty($image_del))){	

				$this->db->select('image_url,image_thumbnail_url');		
					
				$this->db->where_in('image_id', $image_del);
				$query = $this->db->get('product_images');	
				$result=$query->result_array();			
				
				foreach($result as $del_url){					
					@unlink($del_url['image_url']);
					@unlink($del_url['image_thumbnail_url']);
					
				}


			
				$this->db->where_in('image_id', $image_del);				
				$this->db->delete('product_images');			
				$data['success'] = "success: Image has been successfully deleted";				
			} else{				
				$data['error'] = "Please select at least one image for delete";
			}
		}
		
		
		
		
		$data['product_images']=$this->Product_model->product_images($data['product_id']);
		//print_r($data['product_images']);
		//exit;
		//echo "<pre>";
		//print_r($data['product_images']);exit;
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('pro_image_edit_view', $data);
		
		$this->load->view('footer', $data);
		
	}
	public function edit(){
		$data['page'] = $this->page;
		$attribute_value = array();
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');
		$data['product_id']=$this->input->get('id',true);
		$data['category_id']="";
		$data['attribute'] = $this->Product_model->get_attribute_field();
		
		$submit=$this->input->post("submit",true);
		if($submit){
			$hot_product_checkbox=$new_product_checkbox="0";
			 $product_name =$update_product['product_name']= trim($this->input->post("product_id",true));
			
			 $new_product_checkbox = trim($this->input->post("new_product_checkbox",true));
			
			 $hot_product_checkbox = trim($this->input->post("hot_product_checkbox",true));
			
			 $new_product_checkbox =$update_product['is_new']=  ($new_product_checkbox==1) ? 1 : 0;
			
			 $hot_product_checkbox =$update_product['is_hot']=  ($hot_product_checkbox==1) ? 1 : 0;
			
			
			
			
			$category_id =$update_product['category_id']=   trim($this->input->post("category_id",true));			
			$gender =$update_product['gender']=  trim($this->input->post("gender",true));			
			$describe =$update_product['description']=   trim($this->input->post("describe",true));
			
			$this->form_validation->set_rules('product_id', 'Product Name', 'required');
			$this->form_validation->set_rules('category_id', 'category', 'required');
			//$this->form_validation->set_rules('sub_category', 'sub-category', 'required');
			
			$product_attribute_save = array();
			if ($this->form_validation->run() == True){
				
				//$update_product['created_by']=$data['username'];
				$update_product['updated_by']=$data['username'];
				$update_product['updated_on']=date("Y-m-d H:i:s"); 				
				
				$this->db->where('product_id', $data['product_id']);
				$this->db->update('product', $update_product); 
				
				$insert_id = $data['product_id'];				
								
				$product_attribute = $this->input->post("product_attribute",true);
				
				foreach($product_attribute as $key=>$value){
					if(!empty($value)){
						$product_attribute_save[]=array(						
							'attribute_id'=>$key,
							'product_id'=>$insert_id,
							'attribute_value'=>$value,
							'updated_by'=>$data['username'],
							'updated_on'=>date("Y-m-d H:i:s")
						);						
					}					
				}
				$this->db->where('product_id', $insert_id)->delete('attribute_value');

				if(!empty($product_attribute_save)){
					$this->db->insert_batch('attribute_value', $product_attribute_save); 
				}
				
				$this->session->set_flashdata('success', 'Success: Product '.$product_id.' was updated');
				redirect('admin/product/edit?id='.$data['product_id']);				
			}			
		}		
		
		$data['product_images']=$this->Product_model->product_images($data['product_id']);		
		//echo "<pre>";
		//print_r($data['product_images']);exit;
		$product_details = $this->Product_model->get_product_details($data['product_id']);
		
		$data['gender_list'] = $this->Stock_model->gender_list();
		
		
		
		
		
		foreach($product_details as $product_row){
			$data['product_name']=$product_row->product_name;
			$data['category_id']=$product_row->category_id;
			$data['gender']=$product_row->gender;
			$data['description']=$product_row->description;
			$data['is_hot']=$product_row->is_hot;
			$data['is_new']=$product_row->is_new;
		}
		$sub_cate_data="";
		
		$data['sub_cate_data']=$sub_cate_data;
		
		
		$attribute_data = $this->Product_model->product_attribute_value($data['product_id']);
		foreach($attribute_data as $attribute_row){			
			$attribute_value[$attribute_row->attribute_id]=$attribute_row->attribute_value;
		}
		$data['attribute_value']=$attribute_value;
		
		$data['category_list'] = $this->Category_model->product_category();
		
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('product_edit_view', $data);
		
		$this->load->view('footer', $data);
		
	}
	
	
	public function get_product_ids(){
		$sub_category_id = $this->input->post("sub_category_id",true);
		$product_data="";
		$product_array = $this->Product_model->get_product_by_sub_category($sub_category_id);
		
		$product_data.="<option value=''>--select--</option>";
		
		if(count($product_array)>0){
			foreach($product_array as $product_row){
				$product_data.="<option value='$product_row->product_id'>".$product_row->product_name."</option>";			 
			}
		} else {
			$product_data.="<option value=''>Please select another Category</option>";
		}		 
		echo $product_data;
		
	}
	public function get_sub_category_ids(){
		$category_id = $this->input->post("category_id",true);
		 
		$sub_cate_data="";
		/* $sub_cate = $this->Sub_category_model->get_sub_cate_by_cate_id($category_id);
		$sub_cate_data.="<option value=''>--select--</option>";
		if(count($sub_cate)>0){
			foreach($sub_cate as $sub_cate_row){
				$sub_cate_data.="<option value='$sub_cate_row->subcategory_id'>".$sub_cate_row->subcategory_name."</option>";			 
			}
		} else {
			$sub_cate_data.="<option value=''>Please select another Category</option>";
		}	 */	 
		$result['sub_cate_data']=$sub_cate_data;
		///////
				
		$product_data="";
		$product_array = $this->Product_model->get_product_by_sub_category('A',$category_id);
		
		$product_data.="<option value=''>--select--</option>";
		
		if(count($product_array)>0){
			foreach($product_array as $product_row){
				$product_data.="<option value='$product_row->product_id'>".$product_row->product_name."</option>";			 
			}
		} else {
			$product_data.="<option value=''>Please select another Category</option>";
		}		 
		
		$result['product_data']=$product_data;
		
		
		
		echo json_encode($result);
		
	}	
	public function index(){
		$this->load->library('make_thumbnails');
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');
		$data['attribute'] = $this->Product_model->get_attribute_field();
		$data['category_list'] = $this->Category_model->product_category();
		$data['gender_list'] = $this->Stock_model->gender_list();
		
		$submit = $this->input->post("submit",true);
		if($submit){
			$hot_product_checkbox=$new_product_checkbox="0";
			 $product_id =$save_product['product_name']= trim($this->input->post("product_id",true));
			
			 $new_product_checkbox = trim($this->input->post("new_product_checkbox",true));
			
			 $hot_product_checkbox = trim($this->input->post("hot_product_checkbox",true));
			
			 $new_product_checkbox =$save_product['is_new']=  ($new_product_checkbox==1) ? 1 : 0;
			
			 $hot_product_checkbox =$save_product['is_hot']=  ($hot_product_checkbox==1) ? 1 : 0;
			
			
			
			
			$category_id =$save_product['category_id']=   trim($this->input->post("category_id",true));			
			$gender =$save_product['gender']=  trim($this->input->post("gender",true));			
			$describe =$save_product['description']=   trim($this->input->post("describe",true));
			
			$this->form_validation->set_rules('product_id', 'Product Name', 'required');
			$this->form_validation->set_rules('category_id', 'category', 'required');
			//$this->form_validation->set_rules('sub_category', 'sub-category', 'required');
			
			$product_attribute_save =$product_images_save =array();
			if ($this->form_validation->run() == True){
				
				$save_product['created_by']=$data['username'];
				$save_product['updated_by']=$data['username'];
				$save_product['updated_on']=date("Y-m-d H:i:s"); 
				
				$this->db->insert('product', $save_product); 
				$insert_id = $this->db->insert_id();				
				$count = count($_FILES['multi_upload']['name']);
				
				if($count!="0"){					
					$config['upload_path'] = CATEGORY_IMAGE_UPLOAD;
					$config['allowed_types'] = MARKET_NEWS_IMAGE_TYPE;
					$config['max_size']	= CATEGORY_IMAGE_MAX_SIZE;
					$config['max_width']  = CATEGORY_IMAGE_MAX_WIDTH;				
					$config['max_height']  = CATEGORY_IMAGE_MAX_HEIGHT;
					$this->load->library('upload', $config);
										
					for($i=0;$i<$count;$i++){
															
						
						$_FILES['userfile']['name']= $_FILES['multi_upload']['name'][$i];
						$_FILES['userfile']['type']= $_FILES['multi_upload']['type'][$i];
						$_FILES['userfile']['tmp_name']= $_FILES['multi_upload']['tmp_name'][$i];
						$_FILES['userfile']['error']= $_FILES['multi_upload']['error'][$i];
						$_FILES['userfile']['size']= $_FILES['multi_upload']['size'][$i];
						$config['file_name'] = $save_product['product_name'].str_pad($i, 3, '0', STR_PAD_LEFT);		
						$this->upload->initialize($config);
						
						if ( ! $this->upload->do_upload()) {				
							$error[] = array('error' => $this->upload->display_errors());	
						}  else {					
							$image_data = $this->upload->data();							
							$data_save['image_url']=$image_location=CATEGORY_IMAGE_UPLOAD.$image_data['file_name'];					
							$thumbpath=CATEGORY_IMAGE_UPLOAD.$image_data['raw_name'].'_thumbnail'.$image_data['file_ext'];
							
							$data_save['image_thumbnail_url']=$thumbpath;
							
							
							$this->make_thumbnails->create_thumbnails($data_save['image_url'],$thumbpath,THUMBNAIL_IMAGE_MAX_WIDTH,THUMBNAIL_IMAGE_MAX_HEIGHT);			
							
							 $product_images_save[]=array(
								'image_url'=>$data_save['image_url'],
								'image_thumbnail_url'=>$data_save['image_thumbnail_url'],
								'product_id'=>$insert_id,
								'created_on'=>date("Y-m-d H:i:s"),
								'created_by'=>$data['username'],
								'updated_on'=>date("Y-m-d H:i:s"),
								'updated_by'=>$data['username']
							);	
						}
					}
					if(!empty($product_images_save)){
						$this->db->insert_batch('product_images', $product_images_save); 						
					}
				}				
				$product_attribute = $this->input->post("product_attribute",true);
				
				foreach($product_attribute as $key=>$value){
					if(!empty($value)){
						$product_attribute_save[]=array(						
							'attribute_id'=>$key,
							'product_id'=>$insert_id,
							'attribute_value'=>$value,
							'updated_by'=>$data['username'],
							'updated_on'=>date("Y-m-d H:i:s")
						);						
					}					
				}
				if(!empty($product_attribute_save)){
					$this->db->insert_batch('attribute_value', $product_attribute_save); 
				}
				$this->session->set_flashdata('success', 'Success: Product '.$product_id.' has been successfully added');
				redirect('admin/product');
				
			}
			 
			
		}
		
		//product
		/* echo"<pre>";
		print_r($data['category_list']);exit; */
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('product_add_view', $data);
		
		$this->load->view('footer', $data);
	}
	public function update(){
		
	}
	public function product_delete(){
		$data['page'] = $this->page;
		$attribute_value = array();
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');
		$data['product_id']=$this->input->post('products',true);
		
		$data['category_id']="";
		$data['attribute'] = $this->Product_model->get_attribute_field();
		$submit=$this->input->post("submit",true);
		
		if($submit){		
		
			
			if(is_numeric($data['product_id'])){
				$updateProduct= array(
					'updated_on'=>date('Y-m-d H:i:s'),
					'is_active'=>0,
					'updated_by'=>$data['username']
				);
				//$this->db->where('product_id', $data['product_id'])->delete('attribute_value'); 
				//$this->db->where('product_id', $data['product_id'])->delete('product');
				$this->db->where('product_id', $data['product_id']);
				 $this->db->update('product',$updateProduct);
				//$this->db->where('product_id', $data['product_id'])->delete('product_images');
				
				$this->session->set_flashdata('success', 'Success: Product has been successfully deleted');				
			} else {
				$this->session->set_flashdata('error', 'Unable to delete, please try again');
			}			
			redirect('admin/product/product_delete');	
		}	
		$data['category_list'] = $this->Category_model->product_category();
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('product_delete_view', $data);		
		$this->load->view('footer', $data);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function manage_stock(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$data['stock_list'] = $this->Stock_model->stock_list();
		
		$submit = $this->input->post("submit",true);
		$product_id = trim($this->input->post("product_id",true));
		if(($submit)&&(is_array($product_id))){			
			$this->db->where_in('product_id',$product_id );
			$this->db->delete('product');
			$this->session->set_flashdata('message', 'Success stock deleted');
			redirect('admin/stock/manage_stock');
		}
		
		

		
		///////////
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('manage_stock_view', $data);
		$this->load->view('footer', $data);
	}
	public function index1(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$data['stock_list'] = $this->Stock_model->stock_list();
		/* echo "<pre>";
		print_r($data); exit; */
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		//$this->load->view('stock_view', $data);
		$this->load->view('stock_view_rnd', $data);
		$this->load->view('footer', $data);
		
		
	}
	
	

	
	
	
	
	 
 
	
		
	
}
