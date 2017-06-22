<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email  stock
class Product_bulk_image_upload extends Admin_Controller {
	public $page='excel_uploader';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->model('Usermodel');
		$this->load->Model('Adminmodel');
		$this->load->model('Jewellerymodel');
		$this->load->Model('Diamondmodel');
		$this->load->library('unzip');
		$this->load->library('image_lib');
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		 
		
		
	}
		function index() {	
    	
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
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
		$id = $this->session->userdata('id');
	   
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('product_bulk_image_upload_view', $data);

		$this->load->view('footer', $data);
      
    }
function zipupload_jewellery(){
	
	$data['username'] = $this->session->userdata('username');
	
	
	
	
	$zip=$_FILES["userfile"]["tmp_name"];
	
	
	$this->unzip->allow(array('css', 'js', 'png', 'gif', 'jpeg', 'jpg', 'tpl', 'html', 'swf','JPG','PNG','Gif'));
	$data=$this->unzip->extract($zip,"./assets/img/product");
	
	
	$filenames=$data['filename'];
	$file_location=$data['file_locations'];
	$count=0;
			for($i = 0; $i < count($filenames); $i++) {
					
			$imageArr=explode(".",$filenames[$i]);
			$product_id=$this->Jewellerymodel->getproductName($imageArr[0]);
			$img_url=substr($file_location[$i],2);
			
			if($product_id!=0) {
			
				$thumb_file=chop($img_url,$filenames[$i]).$imageArr[0]."_thumb.".$imageArr[1];
				copy ( $file_location[$i] , $thumb_file);
				echo $this->make_thumb($file_location[$i],$thumb_file,320);


				$this->db->select('image_id')
				->from('product_images')
				->where('image_url',$img_url);
				$query_getimage=$this->db->get();
			
				if($query_getimage->num_rows()==0) {				
					$insertData = array(
				   'image_url' => $img_url,
				   'image_thumbnail_url' =>  $thumb_file,
				   'product_id' => $product_id ,
				   'created_on' => date('Y-m-d H:i:s'),
				   'created_by' => $this->username ,
				   'updated_on' => date('Y-m-d H:i:s'),
				   'updated_by'=>$this->username);
					if($this->db->insert('product_images', $insertData)) {						
						$count++;
					} 				
				} else {
					foreach ($query_getimage->result() as $key=>$img) {					
						$updateData = array(
						'image_url' => $img_url,
						'image_thumbnail_url' =>  $thumb_file,
						'product_id' => $product_id ,
						'updated_on' => date('Y-m-d H:i:s'),
						'updated_by'=>$this->username);
						$this->db->where('image_id',$img->image_id);
						$this->db->update('product_images',$updateData); 
						if($this->db->affected_rows()==1) {  					
							$count++;
						}
				}					
			}
		}		
	 }
	 if($count=="0"){
		 $this->session->set_userdata('error', "zero image uploaded");
		//$this->session->set_flashdata('error', "zero image uploaded");
	 } else {
		 $this->session->set_userdata('success', $count." images uploaded");
	 }
	// redirect('admin/jewellery_bulk_image_upload');
	
	
	}
	function make_thumb($src, $dest, $desired_width) {
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
	
	
}
