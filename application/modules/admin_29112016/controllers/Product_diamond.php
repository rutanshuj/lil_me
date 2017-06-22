<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email  stock
class Product_diamond extends Admin_Controller {
	public $page='product_diamond';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('Product_diamond_model');
		$this->load->Model('Product_model');
		$this->load->Model('Category_model');
		$this->load->Model('Sub_category_model');
	
		
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
			redirect('admin/product_diamond');
		}
		$image_del=$this->input->post('image_del',true);
		$delete=$this->input->post('delete',true);
		//$multi_upload=$this->input->post('multi_upload',true);
		$upload=$this->input->post('upload',true);
		  
		if(isset($upload)){
			//print_r($_FILES['multi_upload']['name']['0']);
			//echo count($_FILES['multi_upload']['name']);exit;
			if(isset($_FILES['multi_upload']['name']['0'])&&(!empty($_FILES['multi_upload']['name']['0']))){
			//exit;	
			$product_details = $this->Product_diamond_model->get_product_details($data['product_id']);
			///
			
				$count = count($_FILES['multi_upload']['name']);
				
				if($count!="0"){					
					$config['upload_path'] = DIAMOND_IMAGE_UPLOAD_LOCATION;
					$config['allowed_types'] = DIAMOND_IMAGE_TYPE;
					$config['max_size']	= DIAMOND_IMAGE_MAX_SIZE;
					$config['max_width']  = DIAMOND_IMAGE_MAX_WIDTH;				
					$config['max_height']  = DIAMOND_IMAGE_MAX_HEIGHT;
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
							$data_save['image_url']=$image_location=DIAMOND_IMAGE_UPLOAD_LOCATION.$image_data['file_name'];					
							$thumbpath=DIAMOND_IMAGE_UPLOAD_LOCATION.$image_data['raw_name'].'_thumbnail'.$image_data['file_ext'];
							
							$data_save['image_thumbnail_url']=$thumbpath;
							
							
							$this->make_thumbnails->create_thumbnails($data_save['image_url'],$thumbpath,DIAMOND_THUMBNAIL_IMAGE_MAX_WIDTH,DIAMOND_THUMBNAIL_IMAGE_MAX_HEIGHT);			
							
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
					$this->db->insert_batch('product_images_diamond', $product_images_save); 
					
					$data['success']="success: Image has beed successfully updated";					
				}	
			
			} else {
				$data['error'] = "Please select at least one image for upload";
			}
		
		}
		if(isset($delete)){			
			if(is_array($image_del)&&(!empty($image_del))){			
				$this->db->where_in('image_id', $image_del);				
				$this->db->delete('product_images_diamond');			
				$data['success'] = "success: Image has beed successfully deleted";				
			} else{				
				$data['error'] = "Please select at least one image for delete";
			}
		}
		
		
		
		
		$data['product_images']=$this->Product_diamond_model->product_images($data['product_id']);
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('diamond_image_edit_view', $data);
		
		$this->load->view('footer', $data);
		
	}
	
	// category_list
	public function edit(){
		$this->load->library('make_thumbnails');
		
		$data['page'] = $this->page;
		$attribute_value = array();
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');
		$id = $this->session->userdata('id');
		$data['product_id']=$this->input->get('id',true);
		$data['category_id']="";
		$data['attribute'] = $this->Product_diamond_model->get_attribute_field();
		
		//// get all projects
		 $data['diamond_pro']= $this->Product_diamond_model->get_product_details();
		
		
		 $submit=$this->input->post("submit",true); 
		if($submit){
			$diamond_error="";
			
			//$hot_product_checkbox=$new_product_checkbox="0";
			  $product_name =$update_product['product_name']= trim($this->input->post("product_name",true));
			 $certificate =$update_product['certificate']=   trim($this->input->post("certificate",true));		//	exit;
		//	$sub_category =$update_product['subcategory_id']=  trim($this->input->post("sub_category",true));			
			//$describe =$update_product['description']=   trim($this->input->post("describe",true));
			
			$this->form_validation->set_rules('product_name', 'Product Name', 'required');
			//$this->form_validation->set_rules('certificate', 'certificate', 'required');
			//$this->form_validation->set_rules('sub_category', 'sub-category', 'required');
			
			$product_attribute_save = array();
			if ($this->form_validation->run() == True){
				
				$update_product['created_by']=$data['username'];
				$update_product['updated_by']=$data['username'];
				$update_product['updated_on']=date("Y-m-d H:i:s");				
				
				$this->db->where('product_id', $data['product_id']);
				$this->db->update('product_diamond', $update_product); 
				
				
				$count = count($_FILES['userfile']['name']);
				if($_FILES['userfile']['name']!=""){
					
					if($certificate==""){
						$diamond_error="1";
						$data['error']="Please enter Certificate Name";						
					} else {
						$config['upload_path'] = DIAMOND_CERTIFICATE_UPLOAD_LOCATION;
						$config['allowed_types'] = DIAMOND_CERTIFICATE_TYPE;
						$config['max_size']	= DIAMOND_CERTIFICATE_MAX_SIZE;
						$config['max_width']  = DIAMOND_CERTIFICATE_MAX_WIDTH;				
						$config['max_height']  = DIAMOND_CERTIFICATE_MAX_HEIGHT;
						$config['file_name'] = $update_product['certificate'];
						$this->load->library('upload', $config);
					
					////////////
					
					if ( ! $this->upload->do_upload()) {		
						$diamond_error="1";				
						$data['error']="Certificate has not uploaded please try again";
						$error[] = array('error' => $this->upload->display_errors());	
					}  else {	
																	
						$diamond_image_data = $this->upload->data();
						
						$save_diamond['diamond_image_url']=$image_location=DIAMOND_CERTIFICATE_UPLOAD_LOCATION.$diamond_image_data['file_name'];					
						$save_diamond['diamond_image_thumbnail_url']=DIAMOND_CERTIFICATE_UPLOAD_LOCATION.$diamond_image_data['raw_name'].'_thumbnail'.$diamond_image_data['file_ext'];
										
						$this->make_thumbnails->create_thumbnails($save_diamond['diamond_image_url'],$save_diamond['diamond_image_thumbnail_url'],CERTIFICATE_THUMBNAIL_IMAGE_MAX_WIDTH,CERTIFICATE_THUMBNAIL_IMAGE_MAX_HEIGHT);			
						
						 $diamond_product_images_save=array(
							'image_url'=>$save_diamond['diamond_image_url'],
							'image_thumbnail_url'=>$save_diamond['diamond_image_thumbnail_url'],
							//'product_id'=>$data['product_id'],
							'created_on'=>date("Y-m-d H:i:s"),
							'created_by'=>$data['username'],
							'updated_on'=>date("Y-m-d H:i:s"),
							'updated_by'=>$data['username']
						);

						//$diamond_product_images_save['product_id']=$insert_id;
						////////////////
						//$this->db->insert('certificate_images_diamond', $diamond_product_images_save); 
						
						///if found then update else insert
						
						
						 $total_certificat_count= $this->db->where('product_id', $data['product_id'])->count_all_results('certificate_images_diamond');
						
						
						if($total_certificat_count=="0"){
							$diamond_product_images_save['product_id']=$data['product_id'];
							$this->db->insert('certificate_images_diamond', $diamond_product_images_save);
						} else {
						
							$this->db->where('product_id', $data['product_id']);
							$this->db->update('certificate_images_diamond', $diamond_product_images_save);
						}
					}
					}
					
				}
			
				/* echo $this->db->last_query();
				exit;
				 */
				 if($diamond_error==""){
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
					$this->db->where('product_id', $insert_id)->delete('attribute_value_diamond');

					if(!empty($product_attribute_save)){
						$this->db->insert_batch('attribute_value_diamond', $product_attribute_save); 
					}
					$this->session->set_flashdata('success', 'Success: Product '.$product_id.' was updated');
					
					redirect('admin/product_diamond/edit?id='.$data['product_id']);	
				 }				
			}			
		}		
		
		$data['product_images']=$this->Product_diamond_model->product_images($data['product_id']);		
		
		$product_details = $this->Product_diamond_model->get_product_details($data['product_id']);
		
		//echo "<pre>";print_r($product_details);exit;
		
		foreach($product_details as $product_row){
			$data['product_name']=$product_row->product_name;
			$data['certificate']=$product_row->certificate;
			$data['status']=$product_row->status;
		
		}
		$sub_cate_data="";
		if(is_numeric($data['category_id'])){
			$sub_cat_array = $this->Sub_category_model->get_sub_cate_by_cate_id($data['category_id']);
			foreach($sub_cat_array as $sub_cat_row){
				$selected="";
				
				if($data['subcategory_id']==$sub_cat_row->subcategory_id){
					$selected="selected";					
				}
				$sub_cate_data.="<option value='$sub_cat_row->subcategory_id' $selected>".$sub_cat_row->subcategory_name."</option>";
				
			}			
		}
		$data['sub_cate_data']=$sub_cate_data;
		
		
		$attribute_data = $this->Product_diamond_model->product_attribute_value($data['product_id']);
		foreach($attribute_data as $attribute_row){			
			$attribute_value[$attribute_row->attribute_id]=$attribute_row->attribute_value;
		}
		$data['attribute_value']=$attribute_value;
		
		$data['certificate_images'] = $this->Product_diamond_model->certificate_images_diamond($data['product_id']);
	//	echo "<pre>";
//		print_r($certificate_images->image_url);exit;
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('diamond_product_edit_view', $data);
		
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
		$sub_cate = $this->Sub_category_model->get_sub_cate_by_cate_id($category_id);
		$sub_cate_data.="<option value=''>--select--</option>";
		if(count($sub_cate)>0){
			foreach($sub_cate as $sub_cate_row){
				$sub_cate_data.="<option value='$sub_cate_row->subcategory_id'>".$sub_cate_row->subcategory_name."</option>";			 
			}
		} else {
			$sub_cate_data.="<option value=''>Please select another Category</option>";
		}		 
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
	
		$data['attribute'] = $this->Product_diamond_model->get_attribute_field();
		
		
		
		$submit = $this->input->post("submit",true);
		if($submit){
			
			$stock_name =$data['product_name']=$save_product['product_name']= trim($this->input->post("stock_name",true));
			$save_product['status']='AVAILABLE';
				
						
			$certificate_name =$save_product['certificate']=  trim($this->input->post("certificate_name",true));
			
			$this->form_validation->set_rules('stock_name', 'stock name', 'required');
			//$this->form_validation->set_rules('certificate_name', 'certificate name', 'required');
			
			///$_FILES['certificate']['name']
			
			$product_attribute_save = array();
			if ($this->form_validation->run() == True){
				
				$save_product['created_by']=$data['username'];
				$save_product['updated_by']=$data['username'];
				$save_product['updated_on']=date("Y-m-d H:i:s"); 
				
				///// certificate image upload
				
				
				$config['upload_path'] = DIAMOND_CERTIFICATE_UPLOAD_LOCATION;
				$config['allowed_types'] = DIAMOND_CERTIFICATE_TYPE;
				$config['max_size']	= DIAMOND_CERTIFICATE_MAX_SIZE;
				$config['max_width']  = DIAMOND_CERTIFICATE_MAX_WIDTH;				
				$config['max_height']  = DIAMOND_CERTIFICATE_MAX_HEIGHT;
				$this->load->library('upload', $config);
				
				$_FILES['userfile']['name']= $_FILES['certificate']['name'];
				$_FILES['userfile']['type']= $_FILES['certificate']['type'];
				$_FILES['userfile']['tmp_name']= $_FILES['certificate']['tmp_name'];
				$_FILES['userfile']['error']= $_FILES['certificate']['error'];
				$_FILES['userfile']['size']= $_FILES['certificate']['size'];
				$config['file_name'] = $save_product['certificate'];		
				$this->upload->initialize($config);
				$diamond_error=$certificate_image_save="";
				///////////
				if($_FILES['certificate']['name']!=''){
					
					if($certificate_name==""){
						$diamond_error="1";	
						$data['error']= "Please Enter Certificate Name";
					}					
					if ( ! $this->upload->do_upload()) {		
						$diamond_error="1";				
						$data['error']="Certificate has not uploaded please try again";
						$error[] = array('error' => $this->upload->display_errors());	
					}  else {	
					
						$certificate_image_save= "yes";
						
						$diamond_image_data = $this->upload->data();
						
						$save_diamond['diamond_image_url']=$image_location=DIAMOND_CERTIFICATE_UPLOAD_LOCATION.$diamond_image_data['file_name'];					
						$save_diamond['diamond_image_thumbnail_url']=DIAMOND_CERTIFICATE_UPLOAD_LOCATION.$diamond_image_data['raw_name'].'_thumbnail'.$diamond_image_data['file_ext'];
						
						
						
						
						$this->make_thumbnails->create_thumbnails($save_diamond['diamond_image_url'],$save_diamond['diamond_image_thumbnail_url'],CERTIFICATE_THUMBNAIL_IMAGE_MAX_WIDTH,CERTIFICATE_THUMBNAIL_IMAGE_MAX_HEIGHT);			
						
						 $diamond_product_images_save=array(
							'image_url'=>$save_diamond['diamond_image_url'],
							'image_thumbnail_url'=>$save_diamond['diamond_image_thumbnail_url'],
							//'product_id'=>$insert_id,
							'created_on'=>date("Y-m-d H:i:s"),
							'created_by'=>$data['username'],
							'updated_on'=>date("Y-m-d H:i:s"),
							'updated_by'=>$data['username']
						);	
					}		
				}
				
				/////////
				
				
				
				
				
				
				
				
				if($diamond_error!="1"){					
				
					
				
				///// certificate image upload -- code end
				
				
					$this->db->insert('product_diamond', $save_product); 
					$insert_id = $this->db->insert_id();
					
					if($certificate_image_save=="yes"){
					
						$diamond_product_images_save['product_id']=$insert_id;
						///////////////
						$this->db->insert('certificate_images_diamond', $diamond_product_images_save); 
						/////				
					}
					$count = count($_FILES['multi_upload']['name']);
				
					if($count!="0"){					
						$config['upload_path'] = DIAMOND_IMAGE_UPLOAD_LOCATION;
						$config['allowed_types'] = DIAMOND_IMAGE_TYPE;
						$config['max_size']	= DIAMOND_IMAGE_MAX_SIZE;
						$config['max_width']  = DIAMOND_IMAGE_MAX_WIDTH;				
						$config['max_height']  = DIAMOND_IMAGE_MAX_HEIGHT;
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
								$data_save['image_url']=$image_location=DIAMOND_IMAGE_UPLOAD_LOCATION.$image_data['file_name'];					
								$thumbpath=DIAMOND_IMAGE_UPLOAD_LOCATION.$image_data['raw_name'].'_thumbnail'.$image_data['file_ext'];
								
								$data_save['image_thumbnail_url']=$thumbpath;
								
								
								$this->make_thumbnails->create_thumbnails($data_save['image_url'],$thumbpath,DIAMOND_THUMBNAIL_IMAGE_MAX_WIDTH,DIAMOND_THUMBNAIL_IMAGE_MAX_HEIGHT);			
								
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
						if((isset($product_images_save))&is_array($product_images_save) &&(!empty($product_images_save))){
							$this->db->insert_batch('product_images_diamond', $product_images_save); 						
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
						$this->db->insert_batch('attribute_value_diamond', $product_attribute_save); 
					}
					$this->session->set_flashdata('success', 'Success: Product '.$product_id.' has been successfully added');
					redirect('admin/product_diamond');
				}
			}
			 
			
		}
		
		//product
		/* echo"<pre>";
		print_r($data['category_list']);exit; */
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('diamond_product_add_view', $data);
		
		
		
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
		$data['product_id']=$this->input->post('product_id',true);
		
		
		
		
		$data['diamond_pro']= $this->Product_diamond_model->get_product_details();
	//	echo "<pre>";
		//print_r($data['diamond_pro']); exit;
		$submit=$this->input->post("submit",true);
		
		if($submit){		
		
			
			if(is_numeric($data['product_id'])){
				$this->db->where('product_id', $data['product_id'])->delete('attribute_value_diamond'); 
				$this->db->where('product_id', $data['product_id'])->delete('product_diamond');
				$this->db->where('product_id', $data['product_id'])->delete('product_images_diamond');
				
				$this->session->set_flashdata('success', 'Success: Product has been successfully deleteed');				
			}	else {
				$this->session->set_flashdata('error', 'Unable to delete, please try again');
			}			
			redirect('admin/product_diamond/product_delete');	
		}	
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('diamond_product_delete_view.php', $data);		
		$this->load->view('footer', $data);
	}
	
	
	
	
		
	
}
