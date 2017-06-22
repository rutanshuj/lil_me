<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email  stock
class Excel_uploader extends Admin_Controller {
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
	function mail_testing(){
		/* $this->load->library('email');

$this->email->from('your@example.com', 'your name');
$this->email->to('someone@example.com');
$this->email->cc('another@another-example.com');
$this->email->bcc('them@their-example.com');

$this->email->subject('email test');
$this->email->message('testing the email class.');

$this->email->send(); */
	}
	
	function download_excel(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$data['successful'] = $this->session->flashdata('successful');
		
		$id = $this->session->userdata('id');
	   
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('download_excel_view', $data);

		$this->load->view('footer', $data);
		
	}
	function index() {	
    	
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
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
		$this->load->view('upload_form_view', $data);

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
	    //$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumn      = 'J'; 
	    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
	    $nrColumns = ord($highestColumn) - 64;
	   // $header_t= "The worksheet ".$worksheetTitle." has ".$nrColumns . ' columns (A-' . $highestColumn . ') and ' . $highestRow . ' row.';
	    $header_t= "The worksheet has ".$nrColumns . ' columns (A-' . $highestColumn . ') and ' . $highestRow . ' rows.';
		  
		  
		      
	
		 // $table .='<table class="table table-bordered table-striped dataTable" id="example6" border="2px" >';
		  $table .='<table border="2px" style="border-collapse: separate;border-spacing: 2px;border-color: grey">';
	    for ($row = 1; $row <= $highestRow; ++ $row) {
			if($row=="1"){
				$table .= '<thead>'; 
			} else  if($row=="2"){
				$table .= '<tbody>';
			}
			
			//if($row=="1"){
			//	$table .= '<tr style="position: fixed;" title="'.$worksheet->getCellByColumnAndRow('0', $row)->getValue().'">';
				
				
			//} else {
				$table .= '<tr title="'.$worksheet->getCellByColumnAndRow('0', $row)->getValue().'">';
			//}
			
			
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
	/* 	echo "<pre>";
		print_r($data['table']);exit; */
		
		 $this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('upload_form_view', $data);

		$this->load->view('footer', $data);
		   
		   
		   
}else {
			$this->session->set_flashdata('error', 'Please select excel file');
			redirect('admin/excel_uploader');
		}
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	function excel_upload()
	{
		
		
		
		
		
		
		
		
		
		$userfile_tmp_name= trim($this->input->post('file_full_path',true));
		if(isset($userfile_tmp_name)&&($userfile_tmp_name!="")){
			$_FILES['userfile']['tmp_name']=$userfile_tmp_name;
		}
		
		ini_set('max_execution_time', 200);
		
		
		if(isset($_FILES["userfile"]["tmp_name"]) && ($_FILES["userfile"]["tmp_name"]!="")){
		
		
		
		
		
		
		
		
		
		
		
		
		
		//echo basename($_FILES["fileToUpload"]["tmp_name"]);
			//$objPHPExcel = PHPExcel_IOFactory::load(($_FILES["fileToUpload"]["tmp_name"]));
			$objPHPExcel = PHPExcel_IOFactory::load(($_FILES["userfile"]["tmp_name"]));
			$dataArr = array();
			
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
				//$maxCell = $worksheet->getHighestRowAndColumn();
				//$data = $worksheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);
				$worksheetTitle     = $worksheet->getTitle();
				$highestRow         = $worksheet->getHighestRow(); // e.g. 10
				$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
				 
				$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
				$arrayCount = count($allDataInSheet);
			}
			$j=1;$previous_id=0;
			$product_name='';$category_name='';$gender='';
			for ($row = 2; $row <= $arrayCount; ++ $row)
			{
			
				$i=0;
				if( trim($allDataInSheet[$row]["A"]) != '') {
					$product_name= trim($allDataInSheet[$row]["A"]);
				}
				if( trim($allDataInSheet[$row]["B"]) != '') {
					$category_name= trim($allDataInSheet[$row]["B"]);
				}
				if( trim($allDataInSheet[$row]["C"]) != '') {
					$gender= trim($allDataInSheet[$row]["C"]);
				}
					//echo $product_name." ".$category_name." ".$subcategory_name."<br>";
				 $product_id=$this->Jewellerymodel->addJewelleryproduct($category_name,$gender,$product_name);
				
				 $size_id='';$quantity='';
				  $size_name= trim($allDataInSheet[$row]["D"]);
				
				 $quantity= trim($allDataInSheet[$row]["E"]);
				 	
				 
				 if(isset($size_name) and  $size_name!=''){
					 $size_id=$this->Jewellerymodel->addsize($size_name);
					$product_opt_id=$this->Jewellerymodel->mapProduct_option($product_id,NULL,$quantity,$size_id);	
					
				} else{
					
					$product_opt_id=$this->Jewellerymodel->mapProduct_option($product_id,NULL,$quantity,$size_id);
				}
				
				// $color_name= trim($allDataInSheet[$row]["E"]);
				
				 
				
				 
			
				for ($col = 5; $col < $highestColumnIndex;  $col++) {
				   // echo"<br>". $worksheet->getCellByColumnAndRow($col, 1);
					
					//=================to do ::add foreign key constraint=======================
					if(trim($worksheet->getCellByColumnAndRow($col, $row)!=''))
					{
						$attribute_id=$this->Jewelleryattributemodel->
						insertAttributes($worksheet->getCellByColumnAndRow($col, 1),'GENERAL',$col,'PRODUCT DETAILS',
							'admin');
						
						$insertflag= $this->Jewelleryattributemodel->
						insertAttributesValue($attribute_id,$product_id,$worksheet->getCellByColumnAndRow($col, $row),
							'admin');
					}
				}
				
			}
			$successful.=($row-2)." products uploaded";
			
			$this->session->set_userdata('success', $successful);
		} else {
			$this->session->set_userdata('error', 'Please select excel file');
			//$this->session->set_flashdata('error', 'Please select excel file');
			//redirect('admin/excel_uploader');
		}
}
	
	
	
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* function excel_upload(){
		
		//echo trim($this->input->post('file_full_path',true));
		
		$userfile_tmp_name= trim($this->input->post('file_full_path',true));
		if(isset($userfile_tmp_name)&&($userfile_tmp_name!="")){
			$_FILES['userfile']['tmp_name']=$userfile_tmp_name;
		}
		
		ini_set('max_execution_time', 200);
		
		
		if(isset($_FILES["userfile"]["tmp_name"]) && ($_FILES["userfile"]["tmp_name"]!="")){
			$count=0;
			
			$objPHPExcel = PHPExcel_IOFactory::load($_FILES["userfile"]["tmp_name"]);
			
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			$worksheetTitle     = $worksheet->getTitle();
			$highestRow         = $worksheet->getHighestRow(); // e.g. 10
			//$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
			$highestColumn      = 'I'; 
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			$nrColumns = ord($highestColumn) - 64;
			
			$successful="The worksheet ".$worksheetTitle." has ".$nrColumns . ' columns (A-' . $highestColumn . ') and ' . $highestRow . ' row.';
			
			
			
			
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			$arrayCount = count($allDataInSheet);
			
			for ($row = 2; $row <= $arrayCount; ++ $row)
			{
			  
			   $product_name= trim($allDataInSheet[$row]["A"]);
			   $category_name= trim($allDataInSheet[$row]["B"]);
			   $subcategory_name=trim($allDataInSheet[$row]["C"]); 
				

				
			   $product_id=$this->Jewellerymodel->addJewelleryproduct($category_name,$subcategory_name,$product_name);
			 
				//for ($col = 3; $col < $highestColumnIndex; ++ $col) {
				for ($col = 3; $col < $highestColumnIndex;  $col++) {
			   // echo"<br>". $worksheet->getCellByColumnAndRow($col, 1);

				//=================to do ::add foreign key constraint=======================
					$attribute_id=$this->Jewelleryattributemodel->
					insertAttributes($worksheet->getCellByColumnAndRow($col, 1),'GENERAL',$col,'PRODUCT DETAILS',
						'admin');
					$insertflag= $this->Jewelleryattributemodel->
					insertAttributesValue($attribute_id,$product_id,$worksheet->getCellByColumnAndRow($col, $row),
						'admin');
						if($insertflag==1){
						
							
						} else{
						//	echo "Error Occured";
						//	break;
						}
					//echo"<br>". $worksheet->getCellByColumnAndRow($col, 1);
					//echo $worksheet->getCellByColumnAndRow($col, $row)."<br>";
					
					}
					
				}
			
			//echo ($row-2)." products uploaded";
			$successful.=($row-2)." products uploaded";
			//$this->session->set_flashdata('success', $successful);
			$this->session->set_userdata('success', $successful);
			//redirect('admin/excel_uploader');
		   }
    
		} else {
			$this->session->set_userdata('error', 'Please select excel file');
			//$this->session->set_flashdata('error', 'Please select excel file');
			//redirect('admin/excel_uploader');
		}
	
	
	} */

}
