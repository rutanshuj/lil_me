<?php 
error_reporting(E_ALL);
/// check email 
class Downloader extends CI_Controller {
	public function __construct() {		
		parent::__construct();
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); 
		$this->load->library('PHPExcel');
		$this->load->model('Jewellerymodel');
		$this->load->model('Jewelleryattributemodel');
		 $this->load->model('Diamondattributemodel');
		 require_once APPPATH.'third_party/PHPExcel/IOFactory.php';
	}
	function index()
	{
	}
	function download_excel()
    {
		$previous_name="";
		$count=0;
        $attribute_idArr=array();
        $objPHPExcel = new PHPExcel();
    $attributes=$this->Jewelleryattributemodel->getAttributes();
        

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue("A1", 'tag') 
                                    ->setCellValue("B1", 'items')
                                    ->setCellValue("C1", 'Category')
									->setCellValue("D1", 'Size')
									
									->setCellValue("E1", 'Quantity'); 
         $row = 2;
         $col = 5;
		$products=$this->Jewellerymodel->getstock();
		 foreach ($attributes as $field)
        {
            $attribute_idArr[]=$field->attribute_id;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field->attribute_name);
            $col++;
        }
		
		//print_r($products);exit; attribute_idArr
        $group_opts=$this->Jewelleryattributemodel->getGroupOptions();
		$quant_col=$col;
		 foreach ($group_opts as $option)
        {
            $opt_group_idArr[]=$option->opt_group_id;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $option->opt_group_name);
			//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1, 1, 'quantity');
            $col=$col+2;
			
        }
	 foreach ($products as $key => $value) {
		if($previous_name==$value->product_name)
		{
			$count++;
			$value->product_name='';
			$value->category_name='';
			$value->subcategory_name='';
			//echo $count."<br>";
		}else
		{
			$previous_name=$value->product_name;
			
		}
		
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $value->product_name);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $value->category_name);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $value->subcategory_name);
        $optcol=3; $attrcol=5;
		
		$last_row=$row;
		 
		
		 
		 
		 
		$this->db->select('pom.quantity as quantity,ms.size_title as size_title')
				->from('product_option_mapper pom')
				
				->join('master_size ms','ms.size_id=pom.size_id','left')
				
				->where('product_id',$value->product_id);
				$query= $this->db->get();
				$options_data=$query->result();
		
		
		$last_row=$row;
		foreach($options_data as $options_row){
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $options_row->size_title);
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $options_row->quantity);
			   $row++;
		}
		echo $row."<br>";
		
		//echo $query->num_rows() ." ";
		$attrrow=$row-$query->num_rows();
		foreach ($attribute_idArr as $attribute_id) {
			$attribute_data=$this->Jewelleryattributemodel->getProductwiseAttributes($value->product_id,$attribute_id);
			
						if(isset($attribute_data->attribute_value)){
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($attrcol, $attrrow, $attribute_data->attribute_value);
						} else {
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($attrcol, $attrrow, '');
						}
	     $attrcol++;
		// $row++;
			}  
		
		
		
       
        }
		
		/*
		echo "<pre>";
		print_r($group_opts);
		echo "</pre>";
		
		echo "<pre>";
		print_r($products);
		echo "</pre>";*/
		header ( 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
        header ( 'Content-Disposition: attachment;filename="results.xls"' );
        header ( 'Cache-Control: max-age=0' );
        $objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' );
		ob_end_clean();
        $objWriter->save ( 'php://output' );
		
		
	}
	
		
	}