<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email 
class Mood extends Admin_Controller {
	public $page='mood';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('Mood_model');
	
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		 $this->load->library('make_thumbnails');
		
	}
	
	
	
	
	
	public function index(){ ///add
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		
		
		
		
		$data['result']=$this->Mood_model->mood_images();
	
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('mood_view', $data);
		$this->load->view('footer', $data);
		
	}
	
	
	public function mood_modify(){
		$this->load->library('make_thumbnails');
		
		$data['page'] = $this->page;
		$attribute_value = array();
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		
		$image_del=$this->input->post('image_del',true);
		$delete=$this->input->post('delete',true);
		
		$upload=$this->input->post('upload',true);
		  
		if(isset($upload)){
			//print_r($_FILES['multi_upload']['name']['0']);
			//echo count($_FILES['multi_upload']['name']);//exit;
			if(isset($_FILES['multi_upload']['name']['0'])&&(!empty($_FILES['multi_upload']['name']['0']))){
			//exit;	
				///
			
				$count = count($_FILES['multi_upload']['name']);
				
				if($count!="0"){					
					$config['upload_path'] = MOOD_IMAGE_UPLOAD;
					$config['allowed_types'] = MOOD_IMAGE_TYPE;
					$config['max_size']	= MOOD_IMAGE_MAX_SIZE;
					$config['max_width']  = MOOD_IMAGE_MAX_WIDTH;				
					$config['max_height']  = MOOD_IMAGE_MAX_HEIGHT;
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
							$data_save['image_url']=$image_location=MOOD_IMAGE_UPLOAD.$image_data['file_name'];					
							$thumbpath=MOOD_IMAGE_UPLOAD.$image_data['raw_name'].'_thumbnail'.$image_data['file_ext'];
							
							$data_save['image_thumbnail_url']=$thumbpath;
							
							
							$this->make_thumbnails->create_thumbnails($data_save['image_url'],$thumbpath,MOOD_THUMBNAIL_IMAGE_MAX_WIDTH,MOOD_THUMBNAIL_IMAGE_MAX_HEIGHT);			
							
							 $product_images_save[]=array(
								'image_url'=>substr($data_save['image_url'], 2),
								'image_thumbnail_url'=>substr($data_save['image_thumbnail_url'], 2),								
								'created_on'=>date("Y-m-d H:i:s"),
								'created_by'=>$data['username'],
								'updated_on'=>date("Y-m-d H:i:s"),
								'updated_by'=>$data['username']
							);	
						}
					}
					$this->db->set('counter', '`counter`+1', FALSE);		
					$this->db->update('mood_image_counter');
					$this->db->insert_batch('mood_images', $product_images_save); 
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
				$query = $this->db->get('mood_images');	
				$result=$query->result_array();			
			
				foreach($result as $del_url){					
					@unlink($del_url['image_url']);
					@unlink($del_url['image_thumbnail_url']);
					
				}
				

				$this->db->set('counter', '`counter`+1', FALSE);		
				$this->db->update('mood_image_counter');

				$this->db->where_in('image_id', $image_del);
				$this->db->delete('mood_images');				
				$data['success'] = "success: Image has beed successfully deleted";				
			} else{				
				$data['error'] = "Please select at least one image for delete";
			}
			//exit;
		}
		
		
		
		
		$data['result']=$this->Mood_model->mood_images();
		
		//echo "<pre>";
		//print_r($data['product_images']);exit;
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('image_edit_view', $data);
		
		$this->load->view('footer', $data);
	
	
	}
	
}
