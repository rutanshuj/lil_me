<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email  stock
class Diamond_excel_uploader extends Admin_Controller {
	public $page='diamond_excel_uploader';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->library('PHPExcel');
         $this->load->model('Jewelleryattributemodel');
         $this->load->model('Diamondattributemodel');
         $this->load->model('Jewellerymodel');
         $this->load->model('Diamondmodel');
         $this->load->helper(array('form', 'url'));
         require_once APPPATH.'third_party/PHPExcel/IOFactory.php';
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		 
		
		
	}
	
	function index() {	
    	
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		
		
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
		$this->load->view('diamond_upload_form_view', $data);

		$this->load->view('footer', $data);
      
    }

	
function excel_verify_upload(){
	
	$data['page'] = $this->page;
	
	$config['upload_path'] = './assets/upload_excel';
	$config['allowed_types'] = 'xls|xlsx';
	$config['overwrite'] = true;
	$config['encrypt_name'] = true;
	$this->load->library('upload', $config);
	if ($this->upload->do_upload()){
		$excel_full_path=$this->upload->data();
		$data['file_full_path']=$excel_full_path['full_path'];
	}else {
		//print_r($this->upload->display_errors());
	}

if(isset($_FILES["userfile"]["tmp_name"]) && ($_FILES["userfile"]["tmp_name"]!="")){
    	$count=0;
		$table="";
		$header_t="";
    	//$objPHPExcel =$_FILES["userfile"]["tmp_name"];
    	$objPHPExcel = PHPExcel_IOFactory::load($_FILES["userfile"]["tmp_name"]);
    	// echo json_encode($_FILES);
    	//echo json_encode($objPHPExcel);
    	//echo $this->load->view('abc',$objPHPExcel,true);
    	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
	    $worksheetTitle     = $worksheet->getTitle();
	    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
	    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
	    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
	    $nrColumns = ord($highestColumn) - 64;
	    $header_t= "The worksheet ".$worksheetTitle." has ".$nrColumns . ' columns (A-' . $highestColumn . ') and ' . $highestRow . ' row.';
		  
		 // $table .='<table class="table table-bordered table-striped dataTable" id="example6" border="2px" >';
		 $table .='<table border="2px" style="border-collapse: separate;border-spacing: 2px;border-color: grey">';
	    for ($row = 1; $row <= $highestRow; ++ $row) {
			if($row=="1"){
				$table .= '<thead>';
			} else  if($row=="2"){
				$table .= '<tbody>';
			}
			$table .= '<tr>';
			
			for ($col = 0; $col < $highestColumnIndex; ++ $col) {
				$cell = $worksheet->getCellByColumnAndRow($col, $row);

				$val = $cell->getValue();
				$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
				if($row=="1"){
					$table .= '<th class="no-sort">' . $val . '</th>';
				} else {
					$table .= '<td>' . $val . '</td>';
				}
			}
			$table .= '</tr>';
			if($row=="1"){
					$table .= '</thead>';
			} 
			
	        
	    }
	    $table .= '</tbody></table>';
		
		
		
		
		    
		   }
		   
		$data['table']=$table;
		$data['header_t']=$header_t;
		
		 $this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('diamond_upload_form_view', $data);

		$this->load->view('footer', $data);
		   
		   
		   
}else {
			$this->session->set_flashdata('error', 'Please select excel file');
			redirect('admin/diamond_excel_uploader');
		}
		
		
		
	}
	
	
	function diamond_excel_upload(){
		$userfile_tmp_name= trim($this->input->post('file_full_path',true));
		if(isset($userfile_tmp_name)&&($userfile_tmp_name!="")){
			$_FILES['userfile']['tmp_name']=$userfile_tmp_name;
		}
		
		ini_set('max_execution_time', 200);
		
		
		if(isset($_FILES["userfile"]["tmp_name"]) && ($_FILES["userfile"]["tmp_name"]!="")){
		$count=0;
			//$objPHPExcel =$_FILES["userfile"]["tmp_name"];
			$objPHPExcel = PHPExcel_IOFactory::load($_FILES["userfile"]["tmp_name"]);

			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			$worksheetTitle     = $worksheet->getTitle();
			$highestRow         = $worksheet->getHighestRow(); // e.g. 10
			$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			$nrColumns = ord($highestColumn) - 64;
			/* echo "<br>The worksheet ".$worksheetTitle." has ";
			echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
			echo ' and ' . $highestRow . ' row.'; */
		  
		  $successful="The worksheet ".$worksheetTitle." has ".$nrColumns . ' columns (A-' . $highestColumn . ') and ' . $highestRow . ' row.';
		  
		  
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			$arrayCount = count($allDataInSheet);
			 //print_r($allDataInSheet);
			//fetch categories and sub categories;
			for ($row = 2; $row <= $arrayCount; ++ $row)
			{
			  
			   $diamond_name= trim($allDataInSheet[$row]["A"]);
			   $certificate_tag= trim($allDataInSheet[$row]["B"]);
			   $subcategory_name=trim($allDataInSheet[$row]["C"]); 
				  //echo $subcategory_name." ".$category_name;

				
			   $product_id=$this->Diamondmodel->
						addDiamondProducts($diamond_name,$certificate_tag);
			  
				for ($col = 2; $col < $highestColumnIndex; ++ $col) {
			   // echo"<br>". $worksheet->getCellByColumnAndRow($col, 1);

				//=================to do ::add foreign key constraint=======================
				$attribute_id=$this->Diamondattributemodel->
				insertDiamondAttributes($worksheet->getCellByColumnAndRow($col, 1),'GENERAL',$col,'DIAOMOND DETAILS',
					$this->username);
				$insertflag= $this->Diamondattributemodel->
				insertDiamondAttributesValue($attribute_id,$product_id,$worksheet->getCellByColumnAndRow($col, $row),
					$this->username);
				if($insertflag==1)
				{
					
				}
				else{
					//echo "Error Occured";
					//break;
				}			
				
				 }
				}
			
			
			
			$successful.=($row-2)." products uploaded";
			$this->session->set_userdata('success', $successful);
			//redirect('admin/diamond_excel_uploader');
			
			
		   }
		   } else {
			$this->session->set_userdata('error', 'Please select excel file');
			//redirect('admin/diamond_excel_uploader');
		
		}
	
	
	
	
	
	
	
	
	
	
	
	
	}

}
