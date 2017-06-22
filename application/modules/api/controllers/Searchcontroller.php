<?php
header('Content-type: application/json');
require(APPPATH.'libraries/REST_Controller.php');
class SearchController extends REST_Controller
{	
	 function __construct()
    {
        parent::__construct();
      
    }
function getStockSearch_post()
	{	 
		$shapeArr[]= '';
		$sizeArr[]='';
		$colorArr[]='';
		$flour_intensity_arr[]='';
		$flour_color_arr[]='';
		$clarityArr[]='';
		$color[]='';$polishArr[]='';$symmetryArr[]='';
		$clarity='';$size='';$cutArr[]='';$gradingArr[]='';
		$diameter_arr[]='';$depthArr[]='';
		$height_arr[]=$black_incl_arr[]='';
		$cash_arr[]='';
		$central_incl_arr[]='';
		$tableArr[]='';
		$input=$this->input->post('input');
		$input=json_decode($input);
		//echo json_last_error();
		//die();
		foreach ($input as $key=>$attributes )
		{ //print_r($key);
			if($key=='shape' and count($attributes)>0)
			{ array_shift($shapeArr);
				foreach($attributes as $key=> $value)
				{
				$shapeArr[]= $value;
				}
			}
			if($key=='size' and count($attributes)>0)
			{ array_shift($sizeArr);
				foreach($attributes as $key=> $value)
				{
				$sizeArr[]= $value;
				}
			}
			if($key=='table' and count($attributes)>0)
			{ array_shift($tableArr);
				foreach($attributes as $key=> $value)
				{
				$tableArr[]= $value;
				}
			}
			if($key=='clarity' and count($attributes)>0)
			{ array_shift($clarityArr);
				foreach($attributes as $key=> $value)
				{
				$clarityArr[]= $value;
				}
			}
			if($key=='cut' and count($attributes)>0)
			{ array_shift($cutArr);
				foreach($attributes as $key=> $value)
				{
				$cutArr[]= $value;
				}
			}
			if($key=='depth' and count($attributes)>0)
			{ array_shift($depthArr);
				foreach($attributes as $key=> $value)
				{
				$depthArr[]= $value;
				}
			}
			if($key=='symmetry' and count($attributes)>0)
			{ array_shift($symmetryArr);
				foreach($attributes as $key=> $value)
				{
				$symmetryArr[]= $value;
				}
			}
			if($key=='grading' and count($attributes)>0)
			{ array_shift($gradingArr);
				foreach($attributes as $key=> $value)
				{
				$gradingArr[]= $value;
				}
			}
			if($key=='polish' and count($attributes)>0)
			{ array_shift($polishArr);
				foreach($attributes as $key=> $value)
				{
				$polishArr[]= $value;
				}
			}
			if( $key=='color' )
			{ 		
				foreach($attributes as $index=>$value)
				{
					if($index=='range' and count($value)>1)
					{array_shift($colorArr);
						foreach($value as $key=> $color)
							{
							$colorArr[]= $color;
							}
					}
					
				
				}
			
			}
			if( $key=='fluorescence' )
			{
				foreach($attributes as $index=> $value)
				{
				if($index=='intensity' and count($value)>1)
					{	array_shift($flour_intensity_arr);
					foreach ($value as $index => $intensity) {
					array_push($flour_intensity_arr, $intensity);
					}
				
				}
				if($index=='color'and  count($value)>1)
					{  array_shift($flour_color_arr);
					foreach ($value as $index => $grading) {
					array_push($flour_color_arr, $grading);
					}
				
				}
				}
			}

			if( $key=='inclusion' )
			{
				foreach($attributes as $index=> $value)
				{
				if($index=='black' and count($value)> 1)
					{	
					array_shift($black_incl_arr);
					foreach ($value as $index => $intensity) {
					array_push($black_incl_arr, $intensity);
					}
				
				}
				if($index=='central' and count($value)> 1)
					{ 
					 array_shift($central_incl_arr);
					foreach ($value as $index => $grading) {
					array_push($central_incl_arr, $grading);
					}
				
				}
				}
			}
			if( $key=='measurement' )
			{
				foreach($attributes as $index=> $value)
				{
				if($index=='diameter' and count($value)> 1)
					{	//echo count($value);
					array_shift($diameter_arr);
					foreach ($value as $index => $intensity) {
					array_push($diameter_arr, $intensity);
					}
				
				}
				if($index=='depth' and count($value)> 1)
					{  array_shift($height_arr);
					foreach ($value as $index => $grading) {
					array_push($height_arr, $grading);
					}
				
				}
				}
			}

			if( $key=='price' )
			{
				foreach($attributes as $index=> $value)
				{
				if($index=='total' and count($value)> 1)
					{	//echo count($value);
					array_shift($diameter_arr);
					foreach ($value as $index => $intensity) {
					array_push($diameter_arr, $intensity);
					}
				
				}
				if($index=='ct' and count($value)> 1)
					{  array_shift($cash_arr);
					foreach ($value as $index => $price) {
					array_push($cash_arr, $price);
					}
				
				}
				}
			}


		}
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$this->load->Model('UserModel');
		$this->load->Model('genericModel');	
		$whereArr = array('Color'=> $colorArr, 'Shape' => $shapeArr,'Weight'=>$sizeArr,'Size.'=>$size,
					'Clarity'=>$clarityArr,'Cut_Grade'=>$cutArr,'Lab'=>$gradingArr,'Table'=>$tableArr,'Depth'=>$depthArr,
					'Polish'=>$polishArr,'Symmetry'=>$symmetryArr,'Fluorescence_Intensity'=>$flour_intensity_arr,
					'Fluorescence_color'=>$flour_color_arr,'diameter'=>$diameter_arr,'height'=>$height_arr,
					'black_inclusion'=>$black_incl_arr,'central_inclusion'=>$central_incl_arr,'pricePerCarat'=>$cash_arr);
	//print_r($whereArr);
	//die();
		$validUser=$this->UserModel->isValidUser($user_id,$api_key);
        if($validUser){
		$data =$this->genericModel->getdiamonds($whereArr); 
		}else{
			
			$data['statusCode']=0;
			$data['message']='Unauthorised Access';

		}
	
	$this->response($data);
	}

	function genericSearch_post()
	{
		$input=$this->input->post('input');
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$this->load->Model('UserModel');
		$this->load->Model('genericModel');	
		
		$validUser=1;//$this->UserModel->isValidUser($user_id,$api_key);
        if($validUser){
			$data=$this->genericModel->getproducts($input,$user_id);  
		}else{
			
			
			$data_message= $this->Usermodel->isValidUser_veryfy($user_id,$api_key);
			if($data_message=="2"){
			
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			} else
			if($data_message!="1"){
				$data['message']=$data_message;
				$data['statusCode']=0;
			
			} else {
			
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}
			
			//$data['statusCode']=0;
			//$data['message']='Unauthorised Access';

		}
		echo json_encode($data);
			//$this->response($data);
	}

	function getDiamondDetails()
	{
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$diamond_id=$this->input->post('diamond_id');
		$this->load->Model('UserModel');
		$this->load->Model('diamondSearchModel');	
	}
}

?> 