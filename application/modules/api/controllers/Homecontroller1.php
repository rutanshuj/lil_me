<?php
header('Content-Type: application/json');
require(APPPATH.'libraries/REST_Controller.php');
class Homecontroller1 extends REST_Controller
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
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('api_key', 'api_key', 'required');
		
		
		if ($this->form_validation->run() == FALSE){
			
			//// set error 
			
			$data['statusCode']=0;
			$data['message']='Some data is missing';	
			
		} else {
	
			$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
			//echo $validUser."jnxkn";  
			if($validUser){
				
			$data=$this->Homemodel->getcatalogData();
			
			}
			else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}
		}
			$this->response($data);
		
	}
	function getcategorydata_post()
	{
		$user_id=trim($this->input->post('user_id',true));  
		$api_key=trim($this->input->post('api_key',true));
		//gives the category data and its product count  
		//input validation
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('api_key', 'api_key', 'required');
		
		
		if ($this->form_validation->run() == FALSE){
			
			//// set error 
			
			$data['statusCode']=0;
			$data['message']='Some data is missing';	
			
		} else {
	
			$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
			//echo $validUser."jnxkn";  
			if($validUser){
				$status_code="200";
				$data['statusCode']=1;
				$data=$this->Homemodel->getCategorywiseProductCount();
			}
			else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
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
				$json['statusCode']=0;
				$json['message']='Unauthorised Access';
			}
		
			 
		}
		$this->response($json);  
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
		////////////
		// $status_code="200";
		 $this->response($data);  
	}
	function getsubcategorywiseproducts_post()
	{
		$cat_id=$this->input->post('category_id');
		$subcat_id=$this->input->post('subcategory_id');
		//$page_no=$this->input->post('page_no');
		// echo $cat_id;
		$user_id=trim($this->input->post('user_id',true));
		$api_key=trim($this->input->post('api_key',true));
		
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
				$data = $this->Homemodel->getProducts_categoryWise($cat_id,$subcat_id,$user_id);

			}   
			else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';
			}
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
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';

			}
		}
	//print_r		
		$this->response($data,$status_code);
	}  

	function getfavourites_post()
	{
		
		$user_id = trim($this->input->post('user_id',true));
		$api_key=trim($this->input->post('api_key',true));
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
			if($validUser){
				$status_code="200";
				$data=$this->Homemodel->getfavouritesByUserId($user_id);  
			}else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';

			}
		
		$this->response($data);
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
			
			$data['statusCode']=0;
			$data['message']='Some data is missing';	
			
		} else {
		   $status_code="200";
		
			
			$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
			if($validUser){
				$data[]=$this->Servicemodel->getProductDetailsByID($product_id,$user_id,NULL,NULL); 
				$json = array('message' => 'success', 'statusCode'=>1,'data'=>$data);
			}else{
				$data['statusCode']=0;
				$data['message']='Unauthorised Access';

			}
		}
		$this->response($json,$status_code);

	}
	function removeAllFavourites_post()
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
			$data['statusCode']=0;
			$data['message']='Unauthorised Access';
		}
		$this->response($data);
    }
	function filterproducts_post()
	{
	
		$cat_id=$this->input->post('category_id');
		$subcat_id=$this->input->post('subcategory_id');
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$from=$this->input->post('from');
		$to=$this->input->post('to');
		$sortflag=$this->input->post('sortflag');
		$brands=$this->input->post('brands');

		$this->load->Model('Homemodel');
		$this->load->Model('Usermodel');
		$validUser=$this->Usermodel->isValidUser($user_id,$api_key);
		if($validUser){
		$data=$this->Homemodel->filterProductsByPrice($cat_id,$subcat_id,$from,$to,$user_id,$sortflag,$brands);
		}else{
			$data['statusCode']=0;
			$data['message']='Unauthorised Access';

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
			
		$this->response($data,$status_code);
	}
	
	}


?>  