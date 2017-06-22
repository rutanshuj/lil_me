<?php
header('Content-Type: application/json');
require(APPPATH.'libraries/REST_Controller.php');
class Homecontroller extends REST_Controller
{	
	 public function __construct() {
        parent:: __construct();
        $this->load->helper("url");
		$this->load->Model('Homemodel');
		$this->load->Model('Usermodel');
		$this->load->library("pagination");
		$this->load->Model('Servicemodel');
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
    }
	function catalogdata_post()
	{
		$user_id=trim($this->input->post('user_id',true));  
		$api_key=trim($this->input->post('api_key',true));
		//$this->form_validation->set_rules('user_id', 'user_id', 'required');
		//$this->form_validation->set_rules('api_key', 'api_key', 'required');
		
		
		
	
			$validUser=1;//$this->Usermodel->isValidUser($user_id,$api_key);
			//echo $validUser."jnxkn";  
			if($validUser){
				
			$data=$this->Homemodel->getcatalogData();
			
			}
			else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}
		
			//$this->response($data);
			echo json_encode($data);
		
	}
	function getcategorydata_post()
	{
		$user_id=trim($this->input->post('user_id'));  
		$api_key=trim($this->input->post('api_key'));
		//gives the category data and its product count  
		//input validation
	
			$validUser=1;//$this->Usermodel->isValidUser($user_id,$api_key);
			//echo $validUser."jnxkn";  
			if($validUser){
				$status_code="200";
				$data['statusCode']=1;
				$data=$this->Homemodel->getCategorywiseProductCount();
				
			}
			else{
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
		
		
		//$this->response($data,$status_code);  
		echo json_encode($data);
	}
	
	function gethomepageimages_get()
	{
		$data=$this->Homemodel->getMoodImages();
		//////////
		$this->db->select('counter');
		$this->db->from('mood_image_counter');
		$query = $this->db->get(); 
		$count=$query->row();
	
		$data['image_verson']=$count->counter;
		echo json_encode($data);
	}
	function getsubcategorywiseproducts_post()
	{
		$cat_id=$this->input->post('category_id');
		
		$user_id=trim($this->input->post('user_id',true));
		$api_key=trim($this->input->post('api_key',true));
		
		
		
		$status_code="500";
	
		
			$validUser=1;//$this->Usermodel->isValidUser($user_id,$api_key);
			if($validUser){
				$status_code="200";
				$data = $this->Homemodel->getProducts_categoryWise($cat_id,$user_id);
				
				 
			}   
			else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}
	
		echo json_encode($data,true);
		
		//$this->response($data,$status_code);  
	}
        
		
	function getproductsbrandwise_post()
	{
		$cat_id=$this->input->post('category_id');
		$subcat_id=$this->input->post('subcategory_id');
		$brands=$this->input->post('brands');
		//$brands=json_decode($brands);
		//print_r($brands);
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('api_key', 'api_key', 'required');
		
		$status_code="500";
		if ($this->form_validation->run() == FALSE){		
			//// set error 
			
			$data['statusCode']=0;
			$data['message']='Some data is missing';	
			
		} else {
		
		
		
			$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
			if($validUser){
				$status_code="200";
				$data = $this->Homemodel->getProducts_BrandWise($cat_id,$subcat_id,$user_id,$brands);

			}   
			else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}
		}
		//$this->response($data,$status_code);  
		echo json_encode($data);
	}

	
	function addtofavourites_post()
	{
		$user_id = trim($this->input->post('user_id',true));
		$api_key=trim($this->input->post('api_key',true));
		$user_name = trim($this->input->post('user_name',true));
		$product_id=trim($this->input->post('product_id',true));
		$like_flag=trim($this->input->post('like_flag',true));
		
		
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('api_key', 'api_key', 'required');
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
		$status_code="500";
		if ($this->form_validation->run() == FALSE){		
			//// set error 
			
			$data['statusCode']=0;
			$data['message']='Some data is missing';	
			
		} else {
			if($validUser){
			$status_code="200";
			switch ($like_flag) {
				case 0:
							$flag =$this->Homemodel->removeFavorites($user_id,$product_id);
							//echo $flag;
							if($flag==1)
							{
								$data['statusCode']=1;
								$data['message']='Favorite Removed';
								
							}
							else{
								$data['statusCode']=0;
								$data['message']="Couldn't Be Removed From Favorites" ;
							}
					break;
				case 1:
							//echo $product_id;

							$flag =$this->Homemodel->addNewfavorites($user_id,$user_name,$product_id);
							if($flag==1)
							{
								$data['statusCode']=1;
								$data['message']='Favorite Added';
								
							}
							else{
								$data['statusCode']=0;
								$data['message']="Couldn't be Added To Favorites" ;
							}
				break;
				default:
					
					break;
			}
			}
			else{
				
				
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
		}
	//print_r		
	//	$this->response($data,$status_code);
	echo json_encode($data);
	}  

	function getfavourites_post()
	{
		
		$user_id = trim($this->input->post('user_id',true));
		$api_key=trim($this->input->post('api_key',true));
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
			if($validUser){
				$status_code="200";
				$data=$this->Homemodel->getfavouritesByUserId($user_id); 

				$data_message= $this->Usermodel->isValidUser_veryfy($user_id,$api_key);
				
				 				
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
		
		//$this->response($data);
		echo json_encode($data);
	}
	function getproductdetails_post()   
	{
		$product_id=trim($this->input->post('product_id',true));
		$user_id=trim($this->input->post('user_id',true));
		$api_key=trim($this->input->post('api_key',true));
		
		
		
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('api_key', 'api_key', 'required');
		
		$status_code="500";
		if ($this->form_validation->run() == FALSE){		
			//// set error 
			
			$json['statusCode']=0;
			$json['message']='Some data is missing';	
			
		} else {
		   $status_code="200";
		
			
			$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
			if($validUser){
				$data[]=$this->Servicemodel->getProductDetailsByID($product_id,$user_id,NULL,NULL); 
				$json = array('message' => 'success', 'statusCode'=>1,'data'=>$data);
			}else{
				 $data_message= $this->Usermodel->isValidUser_veryfy($user_id,$api_key);
			if($data_message=="2"){
			
				$json['statusCode']=0;
				$json['message']='Unauthorised Access';
			} else
			if($data_message!="1"){
				$json['message']=$data_message;
				$json['statusCode']=0;
			
			} else {
			
				$json['statusCode']=0;
				$json['message']='Unauthorised Access';
			}
				
				
				
				//$json['statusCode']=0;
				//$json['message']='Unauthorised Access';

			}
		}
		//$this->response($json,$status_code);
		echo json_encode($json);

	}
	function removeallfavourites_post()
	{
		$user_id = $this->input->post('user_id');
		$api_key=$this->input->post('api_key');	
		$this->load->Model('Usermodel');
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
		 
		if($validUser){
		$count=$this->Homemodel->removeAllFavouritesByUser($user_id);
		$data['statusCode']=1;
		$data['message']=$count." Products Removed From Favorites.";
		}   
		else{
			
			
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
		$this->response($data);
    }
		function getdataforfilter_get()
	{
		$size=array();
		$sex=array();
		 $this->db->select('*')
				->from('master_size');
		$query_getOptions= $this->db->get();
		 foreach ($query_getOptions->result() as $size_row)
					 {
					$row['size_id']=$size_row->size_id;
					$row['size_title']=$size_row->size_title;
					$size[]=$row;
					 }
		$this->db->select('distinct(gender)')
				->from('product')
				->where("gender <>''");
		$query_get= $this->db->get();
		 foreach ($query_get->result() as $gender_row)
					 {
					$sex[]=$gender_row->gender;
					
					 }
			$json = array('message' => 'success', 'statusCode'=>1,'size'=>$size,'sex'=>$sex);
			echo json_encode($json);
	}
	function filterproducts_post()
	{
	//echo "marooooooooo";
		$cat_id=$this->input->post('category_id');
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$size=$this->input->post('size');		
		$gender=$this->input->post('gender',true);
		$sex=$this->input->post('sex');
		
		$sortflag=$this->input->post('sortflag');
		//$brands=$this->input->post('brands');  

		
		$where_or="(";
		if(is_array($gender)){
			foreach($gender as $value_key=>$value_value){	
				$where_or.=" gender='".$value_value."' OR";
			}
		}
		if(strlen($where_or)!="1"){
			$where_or=substr($where_or, 0, -2);
			$where_or.=")";
		} else {
			$where_or="";
		}
		
		
		
		
		$this->load->Model('Homemodel');
		$this->load->Model('Usermodel');
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
		if($validUser){
		$data=$this->Homemodel->filterProductsByPrice($cat_id,$size,$sex,$user_id,$sortflag,$where_or);
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
		 
		//$this->response($data);
		echo json_encode($data);
	}

	function requestMemo_post()
	{
		$user_name=trim($this->input->post('user_name',true));
		$user_id = trim($this->input->post('user_id',true));
		$product_id=trim($this->input->post('product_id',true));
		
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		
		
		$status_code="500";
		if ($this->form_validation->run() == FALSE){		
			//// set error 
			
			$data['statusCode']=0;
			$data['message']='Some data is missing';	
			
		} else {
		
			$flag=$this->Homemodel->addToMemo($user_id,$user_name,$product_id); 
			if($flag==1)
			{ 	$status_code="200";
				$data['statusCode']=1;
				$data['message']='Data inserted successfully';
				
			} else {
				$data['statusCode']=0;
				$data['message']="Couldn't be added to favorites" ;
			}
		}	
			
		//$this->response($data,$status_code);
		echo json_encode($data);
	}
	
	function catalog_search_post()
	{
		$input=$this->input->post('input');
		$user_id=trim($this->input->post('user_id',true));  
		$api_key=trim($this->input->post('api_key',true));
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('api_key', 'api_key', 'required');
		
		
		if ($this->form_validation->run() == FALSE){
			
			//// set error 
			
			$json['statusCode']=0;
			$json['message']='Some data is missing';	
			
		} else {
	
			$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
			//echo $validUser."jnxkn";  
			if($validUser){
			$sql ="SELECT * FROM product_catalog WHERE ( catalog_title LIKE '%".$input."%' OR keywords LIKE '%".$input."%' )";
			$query = $this->db->query($sql);
					
			if($query->num_rows()!=0)
				{
				 foreach ($query->result() as $row)
				   {	
				$row->catalog_url=URL_CONST.$row->catalog_url;
				$row->catalog_thumbnail=URL_CONST.$row->catalog_thumbnail;
				   $data[]=$row;
				   }
					$json = array('message' => 'success', 'statusCode'=>1,'data'=>$data);
				}
				else
				 {
					 $json =array('message' => 'No Data Available', 'statusCode'=>0);
				 }
			 }
			else{
				$data_message= $this->Usermodel->isValidUser_veryfy($user_id,$api_key);
			if($data_message=="2"){
			
				$json['statusCode']=0;
				$json['message']='Unauthorised Access';
			} else
			if($data_message!="1"){
				$json['message']=$data_message;
				$json['statusCode']=0;
			
			} else {
			
				$json['statusCode']=0;
				$json['message']='Unauthorised Access';
			}
			
				
				
				//$json['statusCode']=0;
				//$json['message']='Unauthorised Access';
			}
		
			 
		}
		//$this->response($json);  
		echo json_encode($data);
	}
	
	}


?>  