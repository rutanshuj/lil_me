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
		 $this->load->library('unzip');
		$this->load->library('image_lib');
		
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
	function make_thumb_zip($src, $dest, $desired_width) {
	/* read the source image */
	 $info = pathinfo($src);
	 $extension = strtolower($info['extension']);
	 switch ($extension) {
                case 'jpg':
                    $source_image = imagecreatefromjpeg($src);
                    break;
                case 'jpeg':
                    $source_image = imagecreatefromjpeg($src);
                    break;
                case 'png':
                    $source_image = imagecreatefrompng($src);
                    break;
                case 'gif':
                    $source_image = imagecreatefromgif($src);
                    break;
                default:
                    $source_image = imagecreatefromjpeg($src);
            }

	//$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	//to mk background white
	//$background = imagecreatetruecolor($desired_width, $desired_height);//create the background 130x130
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	$white = imagecolorallocate($virtual_image, 255, 255, 255); 
	imagefill($virtual_image,0,0,$white);
	
	
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	 imagejpeg($virtual_image, $dest);
	}
	
	public function zip_upload(){
		
		
		$data['username'] = $this->session->userdata('username');
	
	
		$is_mobile= $this->input->get('is_mobile',true);
		
		if($is_mobile!="1"){
			$is_mobile="0";
		}
		
		$zip=$_FILES["userfile"]["tmp_name"];
		
		
		$this->unzip->allow(array('css', 'js', 'png', 'gif', 'jpeg', 'jpg', 'tpl', 'html', 'swf','JPG','PNG','Gif'));
		$data=$this->unzip->extract($zip,"./assets/img/mood_image");
		echo "<pre>";
		print_r($data);
		
		
		$filenames=$data['filename'];
		$file_location=$data['file_locations'];
		$count=0;
		for($i = 0; $i < count($filenames); $i++) {
				$count++;
			$imageArr=explode(".",$filenames[$i]);
			$img_url=substr($file_location[$i],2);			
			
			$thumb_file=chop($img_url,$filenames[$i]).$imageArr[0]."_thumb.".$imageArr[1];
			copy ( $file_location[$i] , $thumb_file);
			$this->make_thumb_zip($file_location[$i],$thumb_file,320);
			$insertData[] = array(
			   'image_url' => $img_url,
			   'image_thumbnail_url' =>  $thumb_file,			  
			   'is_mobile' => $is_mobile ,
			   'created_on' => date('Y-m-d H:i:s'),
			   'created_by' => $this->username ,
			   'updated_on' => date('Y-m-d H:i:s'),
			   'updated_by'=>$this->username
			);			 					
			
		}		
	
		 if($count=="0"){
			 $this->session->set_userdata('error', "zero image uploaded");
			//$this->session->set_flashdata('error', "zero image uploaded");
		 } else {
			 
			 
			 $this->db->insert_batch('mood_images', $insertData);
			 
			 
			 $this->session->set_userdata('success', $count." images uploaded");
		 }
	 
	 
		
		
	}
	
	public function bulk_image_upload(){
		
		$data['page'] = $this->page;
		$data['error'] = $this->session->flashdata('error');
		$data['successful'] = $this->session->flashdata('successful');
		$success_m =$this->session->userdata('success');
		$error_m =$this->session->userdata('error');
		
		if(isset($success_m)&&($success_m !="")){
			$data['success']=$success_m;			
			$this->session->unset_userdata('success');
		}		
        if(isset($error_m)&&($error_m !="")){
			$data['error']=$error_m;			
			$this->session->unset_userdata('error');
		}
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		
		$this->load->view('bulk_image_upload_view');
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
