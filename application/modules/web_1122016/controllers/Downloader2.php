<?php 
error_reporting(E_ALL);
/// check email 
class Downloader2 extends CI_Controller {
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
		$previous_opt_group_id=0;
        $attribute_idArr=array();
		
        $objPHPExcel = new PHPExcel();
    

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue("A1", 'tag') 
                                    ->setCellValue("B1", 'items')
                                    ->setCellValue("C1", 'category'); 
         $row = 2;
		 $row_addition=0;
         $col = 3;
		$products=$this->Jewellerymodel->getstock();
		 $attrcol=7;
		
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
        
				$this->db->select('opt_group_id')
				->from('product_option_mapper pom')
				->where('product_id',$value->product_id)
				->group_by('opt_group_id');
				$query= $this->db->get();
				$group_data=$query->result();
				
				$optcol=1;
			foreach($group_data as $group)
				{
					$gid_arr[]=$group->opt_group_id;
				}
				$i=0;
				//echo $group->opt_group_id;
				$this->db->select('po.opt_value,quantity,pom.opt_group_id')
				->from('product_option_mapper pom')
				->join('product_options po','po.option_id=pom.option_id')
				->where('product_id',$value->product_id)
				->where_in('pom.opt_group_id',$gid_arr);
				
				$query= $this->db->get();
				$options_data=$query->result();
				$count=count($options_data);
				foreach($options_data as $options)
				{
				echo $previous_opt_group_id;
				if( $previous_opt_group_id >=  $options->opt_group_id)
				{
					$optcol=$optcol-2;
				}
				else{
			
				$optcol=$optcol+2;	
				}
				echo ($row+$i) ." ".$optcol."<br>";
				echo "<pre>";
				print_r($options);
				echo "</pre>"; 
			
						//$row=$row+($i);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($optcol, $row+$i, $options->opt_value);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($optcol+1, $row+$i, $options->quantity);
						
				$previous_opt_group_id=$options->opt_group_id;
					
				}
			
			
		
			
		 
	
		$row++;	
        }
			echo "<pre>";
				print_r($options_row);
				echo "</pre>"; 
		/*
		echo "<pre>";
		print_r($group_opts);
		echo "</pre>";
		
		echo "<pre>";
		print_r($products);
		echo "</pre>";
		header ( 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
        header ( 'Content-Disposition: attachment;filename="results.xls"' );
        header ( 'Cache-Control: max-age=0' );
        $objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' );
		ob_end_clean();
        $objWriter->save ( 'php://output' );*/
		$previous_name=$value->product_name;
		
	}
	
		
	}