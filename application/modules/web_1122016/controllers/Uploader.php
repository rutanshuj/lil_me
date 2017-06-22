<?php 
error_reporting(E_ALL);
/// check email 
class Uploader extends CI_Controller {
	public function __construct() {		
		parent::__construct();
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); 
		$this->load->library('PHPExcel');
		$this->load->model('Jewellerymodel');
		$this->load->model('Jewelleryattributemodel');
		 require_once APPPATH.'third_party/PHPExcel/IOFactory.php';
	}
	function index()
	{
		$this->load->view('excel_upload');	
		//$this->load->view('home');
		//$this->load->view('footer');	
	}
	function excel_upload()
	{
		//echo basename($_FILES["fileToUpload"]["tmp_name"]);
		$objPHPExcel = PHPExcel_IOFactory::load(($_FILES["fileToUpload"]["tmp_name"]));
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
		$product_name='';$category_name='';$subcategory_name='';
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
				$subcategory_name= trim($allDataInSheet[$row]["C"]);
				}
			 //echo $product_name." ".$category_name." ".$subcategory_name."<br>";
			 $product_id=$this->Jewellerymodel->addJewelleryproduct($category_name,$subcategory_name,$product_name);
			 //echo $product_id."<br>";
			 for ($col = 3; $col < 6;  $col=$col+2) {
				
			 $opt_group_id=$this->Jewellerymodel->insertG_option($worksheet->getCellByColumnAndRow($col, 1));
			 if($worksheet->getCellByColumnAndRow($col,$row)->getValue()!='' and $worksheet->getCellByColumnAndRow($col+1,$row)!='')
			 {
			 $option_id=$this->Jewellerymodel->insertProduct_option($opt_group_id,$worksheet->getCellByColumnAndRow($col,$row)->getValue());		 
			 $product_opt_id=$this->Jewellerymodel->mapProduct_option($product_id,$option_id,$opt_group_id,$worksheet->getCellByColumnAndRow($col+1,$row));
			 echo " ".$product_opt_id ." "."<br>";
			 }
			
			// echo $worksheet->getCellByColumnAndRow($col,$row)->getValue()." ".$worksheet->getCellByColumnAndRow($col+1,$row)."<br>";
			 
			}
			for ($col = 6; $col < $highestColumnIndex;  $col++) {
			   // echo"<br>". $worksheet->getCellByColumnAndRow($col, 1);

				//=================to do ::add foreign key constraint=======================
					$attribute_id=$this->Jewelleryattributemodel->
					insertAttributes($worksheet->getCellByColumnAndRow($col, 1),'GENERAL',$col,'1',
						'admin');
					$insertflag= $this->Jewelleryattributemodel->
					insertAttributesValue($attribute_id,$product_id,$worksheet->getCellByColumnAndRow($col, $row),
						'admin');
			}
	}
}
}
?>