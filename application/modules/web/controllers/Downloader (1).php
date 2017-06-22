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
    

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue("A1", 'tag') 
                                    ->setCellValue("B1", 'items')
                                    ->setCellValue("C1", 'category'); 
         $row = 2;
         $col = 3;
		$products=$this->Jewellerymodel->getstock();
		
		//print_r($products);exit;
        $group_opts=$this->Jewelleryattributemodel->getGroupOptions();
		$quant_col=$col;
		 foreach ($group_opts as $option)
        {
            $opt_group_idArr[]=$option->opt_group_id;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $option->opt_group_name);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1, 1, 'quantity');
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
		//echo "<pre>";
		//print_r($value);
		//echo "</pre>";
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $value->product_name);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $value->category_name);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $value->subcategory_name);
        $optcol=3; $attrcol=7;
		
		// $options_data=$this->Jewelleryattributemodel->getProductwiseOptions($value->product_id,$opt_group_id);	
		//echo $value->opt_group_id;
		$last_row=$row;
		foreach($opt_group_idArr as $opt_group_id )
		{ //echo $opt_group_id;
		
			
			 	$this->db->select('quantity,opt_value,pom.opt_group_id')
				->from('product_option_mapper pom')
				->join('product_options po','po.option_id=pom.option_id','left')
				->where('pom.opt_group_id',$opt_group_id)
				->where('product_id',$value->product_id);
				$query= $this->db->get();
				$options_data=$query->result();
				//echo "<pre>";
				//print_r($options_data);
				//echo "</pre>";
			$i=0;
				foreach($options_data as $options){
					echo $optcol." ".$row;
					echo $options->opt_value." ".$options->quantity."<br>";
						//if($i!=0)
						//$row=$row+($i);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($optcol, $last_row+$i, $options->opt_value);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($optcol+1, $last_row+$i, $options->quantity);
						$i++;
					 $row++;
						} 
				$optcol=$optcol+2;
				$options_arr[]=$options->opt_group_id;
				//$optrow=$row+2;
				//break;
		}
		// exit;
			/* foreach ($attribute_idArr as $attribute_id) {
			$attribute_data=$this->Jewelleryattributemodel->getProductwiseAttributes($value->product_id,$attribute_id);
					
						if(isset($attribute_data->attribute_value)){
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($attrcol, $row, $attribute_data->attribute_value);
						} else {
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($attrcol, $row, '');
						}
	     $attrcol++;
		 //$optcol++;
			} */

       
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
		$previous_name=$value->product_name;
		
	}
	
		
	}