<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
class Homemodel extends CI_Model
{
	
	function getMoodImages()
	{		
			$news=array();
			$images=array();
			$this->db->limit(5);
			$this->db->select('image_url')
			->from('mood_images');
			$query = $this->db->get();
			
			 foreach ($query->result() as $row)
			 {
			$images[]= URL_CONST. str_replace('\\', '/',$row->image_url);
			 }
			$this->db->limit(5)  
			->select('headline')
			->from('market_news')
			->order_by("updated_on", "desc");
			//->order_by("priority", "asc");
			$query = $this->db->get();
			$data=$query->result();
			
			foreach ($query->result() as $row) {
			$news[]=$row->headline;
			}
			
			$json = array('message' => 'success', 'statusCode'=>1,'images' => $images,'news'=>$news);
			return $json;
	}	
	function getcatalogData()
	{
		$this->db->select('*')
			->from('product_catalog');
			$query = $this->db->get();
			if($query->num_rows()!=0)
				{
					foreach ($query->result() as $row)
				   {
						$row->catalog_url=URL_CONST.$row->catalog_url;
						$row->catalog_thumbnail=URL_CONST.$row->catalog_thumbnail;
						$data[]=$row;
				   }
				   $json =array('message' => 'success', 'statusCode'=>1,'data'=>$data);
				}
				else{
					$json =array('message' => 'No data available', 'statusCode'=>0);
				}
				return $json;
	}
	function getCategorywiseProductCount()
	{
		
			$this->db->select('category_id,category_name')
			->from('product_category')
			->where('is_active',1)
			->order_by('sort_order'); 
			$product_count=0;
			$query = $this->db->get();
			//$count=$query->num_rows();
			$data= $query->result();
			$all_prod=array('category_id'=>'','category_name'=>'All Products');
			array_push($data,$all_prod);  
			$json = array('message' => 'success', 'statusCode'=>1,'data'=>$data);		  
			
			return $json;
}
	//done 
function getProducts_categoryWise($cat_id,$user_id)
	{
		$prod_all=array();
		$prod_hot=array();
		$prod_new=array();
		$brandsArr=array();
		//echo $subcat_id."shdkj";
		
		$defult_subcat=0;
	
		$row=array();
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
			
			
			//$whereArr2=array('p.category_id'=>$cat_id);
				
				//print_r($whereArr2);
				$this->db->select('product_id,product_name')
				->from('product p')
				->where('p.is_active',1)
				->join('product_category pc','p.category_id=pc.category_id');
				if(isset($cat_id) and $cat_id!='')
				{

				$this->db->where('p.category_id',$cat_id);	
				}
				$all_data=$this->db->get();
				
				if($all_data->num_rows()>0)
				{
					
				foreach ($all_data->result() as $row) {

					// get product image data 
					$product_id=$row->product_id;
			      	 $this->db->limit(1)
					->from('product_images')
           			->where('product_id',$product_id)
					->order_by('image_id','asc');
					$getImg = $this->db->get();
					$imgData=$getImg->result();
					foreach ($getImg->result() as  $imgRow) {
					$default_img=URL_CONST. str_replace('\\', '/',$imgRow->image_url);
					$default_thumb=URL_CONST. str_replace('\\', '/',$imgRow->image_thumbnail_url);
					$row->image_url=$default_img;
					$row->thumbnail_url=$default_thumb;
					
					}
					if($getImg->num_rows()==0)
					{	
						$row->image_url=' ';
					}
					//get product name fr selected product_id
						$getname ="SELECT attribute_value
						FROM attribute_value av
						WHERE av.product_id=".$product_id." and av.attribute_id =
						(select attribute_id
						from attribute 
						where attribute_name LIKE 'Product name')";  
						$getname_query = $this->db->query($getname);
						foreach ($getname_query->result() as $name) {
								 $row->product_name=$name->attribute_value;
								}
					// check if the product is in favourites
							if($user_id==""||is_null($user_id))
						{
							$row->is_favorite=0;
						}
						else{
						$getfav="select * from favorites where user_id=".$user_id." and product_id=".$product_id;
						$getfav_query = $this->db->query($getfav);
						if($getfav_query->num_rows()==0)
						{
							$row->is_favorite=0;
						}  
						else{
							$row->is_favorite=1;
						}
						}
					// get the price 
						$getprice="select price from pricing_table where product_id=".$product_id;
						$getprice_query = $this->db->query($getprice);
						if($getprice_query->num_rows()==0)
						{
							$row->price='';
						}  
						else{
							foreach ($getprice_query->result() as $a) {
							//$row->price =$a->Price;
						}
						}
				} 
				$prod_all=$all_data->result();
				
				
				$json = array('message' => 'success', 'statusCode'=>1,'size'=>$size,'sex'=>$sex,'products'=>$prod_all );
			
			}
			else{
				$json =array('message' => 'No data available', 'statusCode'=>0);
		}
		  
			return $json;    
		}


function removeFavorites($user_id,$product_id)
{
	//$this->db->delete('mytable', array('id' => $id)); 
	$this->db->delete('favorites', array('user_id' => $user_id,'product_id'=>$product_id)); 
	//echo $this->db->affected_rows();
	$effect=$this->db->affected_rows() != 1 ? 0 : 1;
	if($effect)
	{
	 $eventCode=6;
     $updateFlag=$this->Usermodel->updateActivity($user_id,$product_id,$eventCode);	
	 return($updateFlag['statusCode']);
	}
	else{
		return $effect;
	}
}



function addNewfavorites($user_id,$user_name,$product_id)
	{  
	
	
	
	
	$this->load->helper('date');
	$data = array(
   'user_id' => $user_id ,
   'product_id' => $product_id ,   
   'updated_on'=>date('Y-m-d-H-i-s')
	);
		$CI =& get_instance();
        $CI->load->model('Usermodel');
        $eventCode=5;
        $updateFlag=$this->Usermodel->updateActivity($user_id,$product_id,$eventCode);
        if($updateFlag['statusCode']){
		$this->db->insert('favorites',$data);
		return ($this->db->affected_rows() != 1) ? 0 : 1;
		}
		else{
		return 0;
		}
	} 
function getProducts_BrandWise($cat_id,$subcat_id,$user_id,$brands)
{ 			$whereArr=array('b.category_id'=>$cat_id,'b.subcategory_id'=>$subcat_id);
			$brandsArr=array();
			$this->db->select('p.product_id')
			->from('brands_data b')
			->join('product p','p.product_id=b.product_id')
			->where('p.is_active',1)
			->where_in('brand_name',$brands)
            ->where($whereArr);  
			$query = $this->db->get();
			$data= $query->result();
			//print_r($data); 
			$this->db->select('distinct(brand_name)')
				->from('brands_data b')
				->where($whereArr);
			$getbrands = $this->db->get();
			foreach ($getbrands->result() as $brand)
			{
			array_push($brandsArr, $brand->brand_name);
			}
			//$output['brands'][]=$brandsArr;
			if($query->num_rows()!=0)
			{
			foreach ($query->result() as $row) {
			$product_id= $row->product_id;  
			$this->load->Model('servicemodel');
			$output[]=$this->servicemodel->getProductDetailsByID($product_id,$user_id,1,NULL);
			
			}
			$json = array('message' => 'success', 'statusCode'=>1,'data'=>$output,'brands'=>$brandsArr);
			}
			else{
			$json = array('message' => 'No data available', 'statusCode'=>0);	
			}

		
		return $json;
} 

function getfavouritesByUserId($user_id)
{ 			$this->db->select('distinct(p.product_id)')
			->from('favorites f')
            ->join('product p','p.product_id=f.product_id')
			->where('p.is_active',1)
			->where('user_id',$user_id);
			$query = $this->db->get();
			$data= $query->result();
			if($query->num_rows()!=0)
			{
			foreach ($query->result() as $row) {
			$product_id= $row->product_id;  
			$this->load->Model('servicemodel');
			$output[]=$this->servicemodel->getProductDetailsByID($product_id,$user_id,1,NULL);
			}
			$json = array('message' => 'success', 'statusCode'=>1,'data'=>$output);
			}
			else{
			$json = array('message' => 'No data available', 'statusCode'=>0);	
			}

		
		return $json;
} 
function removeAllFavouritesByUser($user_id)
{
	
	$this->db->delete('favorites', array('user_id' => $user_id)); 
	//echo $this->db->affected_rows();
	$effect=$this->db->affected_rows() > 0 ? $this->db->affected_rows() : 0;
		if($effect)
		{
		 $eventCode=10;
		 //$updateFlag=$this->Usermodel->updateActivity($user_id,$product_id,$eventCode);	
		return $effect;
		}
		else{
			return $effect;
		}
	
	
}
function addToMemo($user_id,$user_name,$product_id)
{
		$this->load->helper('date');
		$data = array(
	   'user_id' => $user_id ,
	   'status'=>'request',
	   'product_id' => $product_id ,
	   'quantity '=>1,
	   'requested_date '=>NULL,
	   'request '=>1,
	   'request_approve_date'=>NULL
		);

			$CI =& get_instance();
	        $CI->load->model('UserModel');
	        $eventCode=4;
	        $updateFlag=$this->UserModel->updateActivity($user_id,$user_name,$product_id,$eventCode);
	        if($updateFlag['statusCode']){
			$this->db->insert('out_on_memo',$data);
			return ($this->db->affected_rows() != 1) ? 0 : 1;
			}
			else{
			return 0;
			}

}

function filterProductsByPrice($cat_id,$size,$sex,$user_id,$sortflag,$where_or=false)
	{
	$output=array();
	$brandsArr=array();
	$whereArr=array();
	if($cat_id!='')
	{
	$whereArr=array('p.category_id'=>$cat_id);
	}
	//echo "first if block".$from. "  ".$to;
	if($sortflag==0)
		{
		//echo "second if block";
		$this->db->select('*');
		$this->db->from('pricing_table pt');
		$this->db->join('product p','pt.product_id=p.product_id');
		if(count($size)>0)
		{
		$this->db->join('product_option_mapper pom','p.product_id=pom.product_id');
		$this->db->where_in('size_id',$size);
		}
		if(count($sex)>0)
		{
		$this->db->where_in('p.gender',$sex);
		}
		if($where_or!=""){
		$this->db->where($where_or);	
		}
		
		$this->db->order_by('cast(`Price` as decimal)');
		$this->db->where('p.is_active',1);
		if(count($whereArr)>0){
		$this->db->where($whereArr);
		}
		$query = $this->db->get();
		}else{
		//echo "second else block";
		$this->db->select('*');
		$this->db->from('pricing_table pt');
		$this->db->join('product p','pt.product_id=p.product_id');
		if(count($size)>0)
		{
		$this->db->join('product_option_mapper pom','p.product_id=pom.product_id');
		$this->db->where_in('size_id',$size);
		}
		if(count($sex)>0)
		{
		$this->db->where_in('p.gender',$sex);
		}
		if(count($whereArr)>0){
		$this->db->where($whereArr);
		}
		$this->db->where('p.is_active',1);
		$this->db->order_by('convert(`Price`, decimal)desc');
		$query = $this->db->get();
		}
	
	//->where('Price <=', $to);
	//array_shift($output);
	
	//$data=$query->result();
	/* echo "<pre>";
	print_r($query->result());
	echo "</pre>"; */
		foreach ($query->result() as $row) {
					$product_id=$row->product_id;
					$row->price=$row->Price;
			      	 $this->db->select('*')
					->from('product_images')
           			->where('product_id',$product_id);
					$getImg = $this->db->get();
					$imgData=$getImg->result();
					foreach ($getImg->result() as  $imgRow) {
					$default_img=URL_CONST. str_replace('\\', '/',$imgRow->image_url);
					$default_thumb=URL_CONST. str_replace('\\', '/',$imgRow->image_thumbnail_url);
					$row->image_url=$default_img;
					$row->thumbnail_url=$default_thumb;
					
					}
					if($getImg->num_rows()==0)
					{	
						$row->image_url=' ';
					}
					//get product name fr selected product_id
						$getname ="SELECT attribute_value
						FROM attribute_value av
						WHERE av.product_id=".$product_id." and av.attribute_id =
						(select attribute_id
						from attribute 
						where attribute_name LIKE 'product name')";  
						$getname_query = $this->db->query($getname);
						foreach ($getname_query->result() as $name) {
								 $row->product_name=$name->attribute_value;
								}
					// check if the product is in favourites
						$getfav="select * from favorites where user_id=".$user_id." and product_id=".$product_id;
						$getfav_query = $this->db->query($getfav);
						if($getfav_query->num_rows()==0)
						{
							$row->is_favorite=0;
						}  
						else{
							$row->is_favorite=1;
						}
					
			$output[]=$row;
		}
		
			
		if(count($output)>0)
		{
		$json = array('message' => 'success', 'statusCode'=>1,'data'=>$output);
		}
		else{
		$json = array('message' => 'No products available', 'statusCode'=>0);	
		}
		return $json;
		}


}
?>  