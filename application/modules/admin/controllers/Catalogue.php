<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email 
class Catalogue extends Admin_Controller {
	public $page='catalogue';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('Catalogue_model');
		$this->load->library('unzip');
		
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
	
	
	public function bulk_upload(){
		$data['page'] = $this->page;		
		
		$upload = $this->input->post('upload',true);
		if($upload=="Bulk Upload"){
			
			
			if($_FILES["userfile"]["size"]!="0"){
				$zip=$_FILES["userfile"]["tmp_name"];
			
			
			$this->unzip->allow(array('pdf'));
			$result=$this->unzip->extract($zip,"./assets/product_catalog");
			
			
			$filenames=$result['filename'];
			$file_location=$result['file_locations'];
			$count=0;
			$save_data=array();
				for($i = 0; $i < count($filenames); $i++) {						
					
					//CATALOG_THUMBNAIL substr($file_location[$i],2)
				
				$file_name = md5(date("m-d-y-H:i:s")).".jpg";				
				//$save_data['catalog_thumbnail']=CATALOG_THUMBNAIL.$file_name;
				$img = new imagick($file_location[$i].'[0]');
				$img->setImageFormat('jpg');
				$img->writeImage(CATALOG_THUMBNAIL.$file_name);
				/////////
			
					
					
					$save_data[] =array(
						'catalog_title'=>substr($filenames[$i], 0, -4),
						'catalog_url'=>substr($file_location[$i],2),
						'catalog_size'=>filesize($file_location[$i]),
						'created_on'=>date("Y-m-d H:i:s"),
						'catalog_thumbnail'=>substr(CATALOG_THUMBNAIL.$file_name,2),
						'created_by'=>$this->username,
						'updated_on'=>date("Y-m-d H:i:s"),
						'updated_by'=>$this->username
					);	
							
				}
				if(count($save_data)!="0"){				
					$this->db->insert_batch('product_catalog', $save_data);
					$data['success']="success : All file has successfully uploaded";
				}
			} else {
				$data['error']="Error : Please select zip folder";
			}
		
		}
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('catalogue_bulk_upload_view', $data);
		$this->load->view('footer', $data);
		
		
	}
	
	public function catalogue_delete(){
		$id = $this->input->get('id',true);
		$headline =$this->input->get('headline',true);
		if(is_numeric($id)){
			$data['catalogue']=$this->Catalogue_model->product_catalogue($id);			
			if(count($data['catalogue'])==1){			
				foreach($data['catalogue'] as $catalogue_data){
					@unlink($catalogue_data['catalog_url']);
				}
				$this->db->where('catalog_id', $id);
				$this->db->delete('product_catalog'); 
			}
			$this->session->set_flashdata('success','Success: Catalogue ( '.$headline.' ) has been deleted successfully');
			redirect('admin/catalogue/update');
		} else {
			redirect('admin/catalogue/update');
		}
	}
	public function index(){ ///add
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');	
		 
	
	
		
		$upload =$this->input->post('upload',true);
		$save_data['keywords'] =$this->input->post('keywords',true);
		
		if($upload=="upload"){
			 $config['upload_path']   = CATALOG_UPLOAD; 
			 $config['allowed_types'] = 'pdf'; 
			
			 $this->load->library('upload', $config);
				
			 if ( ! $this->upload->do_upload('userfile')) {
				$data['error'] =$this->upload->display_errors(); 
				
			 }			
			 else { 
				$upload_data= $this->upload->data(); 
				$save_data= array();
				$save_data['catalog_title']=$upload_data['raw_name'] ;/// name
				$save_data['catalog_size']=$upload_data['file_size'] ;/// size
				$save_data['created_by']=$save_data['updated_by']= $data['username']; /// username 
				$save_data['catalog_url']= substr(CATALOG_UPLOAD.$upload_data['file_name'],2);/// location
				$save_data['updated_on']=$save_data['created_on']= date("Y-m-d H:i:s");
				///////
				//CATALOG_THUMBNAIL
				
				
				/////////
			//print_r($_FILES['userfile1']);
			
				if(isset($_FILES['userfile1'])){
					$temp = explode(".", $_FILES["userfile1"]["name"]);
					$newfilename = md5(date("m-d-y-H:i:s")) . '.' . end($temp);
					
					$save_data['catalog_thumbnail']=substr(CATALOG_THUMBNAIL.$newfilename, 2);
					
					move_uploaded_file($_FILES["userfile1"]["tmp_name"], CATALOG_THUMBNAIL . $newfilename);
				} else {
					$file_name = md5(date("m-d-y-H:i:s")).".jpg";				
					$save_data['catalog_thumbnail']=substr(CATALOG_THUMBNAIL.$file_name, 2);
					$img = new imagick($save_data['catalog_url'].'[0]');
					$img->setImageFormat('jpg');
					$img->writeImage(CATALOG_THUMBNAIL.$file_name);
				}
			
			
				$this->db->insert('product_catalog',$save_data);
				exit;
				$this->session->set_flashdata('success','success: File has been successfully uploaded');
				redirect('admin/catalogue');
			 }
			
		}
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('catalogue_view', $data);
		$this->load->view('footer', $data);
		
	}
	public function update(){
		$data['page'] = $this->page;
		$data['success'] = $this->session->flashdata('success');
		$data['catalogue']=$this->Catalogue_model->product_catalogue();
		//echo"<pre>";
	//	print_r($data['catalogue']);
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('catalogue_update_view', $data);
		$this->load->view('footer', $data);
	}
	
	
	
	
	public function add(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		
		$id = $this->session->userdata('id');		
		
		$data['category_name'] =$data_save['category_name']= trim($this->input->post('category_name',true));
		$data['sort_order'] =$data_save['sort_order']= trim($this->input->post('sort_order',true));
		
		
		
		$this->form_validation->set_rules('category_name', 'Category Name', 'required');
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
	
	
	
	
	
	
	
	
	public function catalogue_pdf(){
		$catalogue_id =trim($this->input->get('id',true));
		$data['error']="1";
		if(is_numeric($catalogue_id)){
			$data['error']="0";	
			
			
			
			
			
			$this->db->select('catalog_id,catalog_url,catalog_title')
				->from('product_catalog')
				->where('catalog_id',$catalogue_id);
				$query=$this->db->get();
				$result=$query->row();
				
				$data['catalog_id']=$result->catalog_id;
				$data['catalog_url']=base_url()."/".$result->catalog_url;
				$data['catalog_title']=$result->catalog_title;
				
		
			
		} 
		$this->load->view('catalogue_pdf.php',$data);
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
	
}
