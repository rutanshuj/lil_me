<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email  stock
class Product_download_excel extends Admin_Controller {
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
         $this->load->model('Jewellerymodel');
         $this->load->helper(array('form', 'url'));
         require_once APPPATH.'third_party/PHPExcel/IOFactory.php';
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		 
		
		
	}
	 function download_excel()
    {
		
        $attribute_idArr=array();
        $objPHPExcel = new PHPExcel();
    

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue("A1", 'Product ID') 
                                    ->setCellValue("B1", 'Category')
                                    ->setCellValue("C1", 'Sub-Category'); 
         $row = 2;
         $col = 3;
        
        $products=$this->Jewellerymodel->getstock();
		
		
        $attributes=$this->Jewelleryattributemodel->getAttributes();
         foreach ($attributes as $field)
        {
            $attribute_idArr[]=$field->attribute_id;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field->attribute_name);
            $col++;
        }
        foreach ($products as $key => $value) {

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $value->product_name);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $value->category_name);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $value->subcategory_name);
        $attrcol=3;
        foreach ($attribute_idArr as $attribute_id) {
        $attribute_data=$this->Jewelleryattributemodel->
                        getProductwiseAttributes($value->product_id,$attribute_id);
						if(isset($attribute_data->attribute_value)){
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($attrcol, $row, $attribute_data->attribute_value);
						} else {
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($attrcol, $row, '');
						}
	     $attrcol++;
        }

        $row++;
        }
   
    
        $objPHPExcel->getActiveSheet()->setCellValue("A1", 'Product ID') 
                                    ->setCellValue("B1", 'Category')
                                    ->setCellValue("C1", 'Sub-Category'); 
       

        $objPHPExcel->setActiveSheetIndex(0);
		
		
        header ( 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
        header ( 'Content-Disposition: attachment;filename="results.xls"' );
        header ( 'Cache-Control: max-age=0' );
        $objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' );
		ob_end_clean();
        $objWriter->save ( 'php://output' );

}
	function index() {	
    	
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$data['successful'] = $this->session->flashdata('successful');
		
		$id = $this->session->userdata('id');
	   
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('product_download_excel_view', $data);

		$this->load->view('footer', $data);
      
    }

	
	
}
