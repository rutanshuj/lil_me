<?php

class Homemodel extends CI_Model
{
	
	function getMoodImages()
	{		
			$news=array();
			$images=array();
			$this->db->select('image_url')
			->from('mood_images')
			->where('is_mobile',0);
			$query = $this->db->get();
			
			 foreach ($query->result() as $row)
			 {
			$images[]= base_url(). $row->image_url;
			 }
			
			
			$json = array('message' => 'success', 'statusCode'=>1,'images' => $images);
			return $images;
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

			 foreach ($query->result() as $row)
			   {	
			   		$cat_id= $row->category_id;
			   		$this->db->select('subcategory_id,subcategory_name')
					->from('product_subcategory')
					->where('is_active',1)
					->where('category_id',$cat_id)
					->order_by('sort_order');
					
					$subcat_query = $this->db->get();
					$subcat_data =$subcat_query->result();
					if(count($subcat_data)!=0)
					{
						$row->subcategory=$subcat_data;
					}
					else{
						$subcat['subcategory_id']=$row->category_id;
						$subcat['subcategory_name']=$row->category_name;
						$row->subcategory[]=$subcat;
					}
								      			   	    
				   }

			   		

			// Sub Category List
				
		

			$json = array('message' => 'success', 'statusCode'=>1,'data'=>$data);		  
			
			return $json;
}
	//done 
function getProducts_categoryWise($cat_id,$subcat_id=false,$user_id)
	{
		$prod_all=array();
		$prod_hot=array();
		$prod_new=array();
		$brandsArr=array();
		//echo $subcat_id."shdkj";
		
		$defult_subcat=0;
		$this->db->select('subcategory_id,subcategory_name')
		->from('product_subcategory')
		->where('is_active',1)
		->where('product_subcategory.category_id',$cat_id)
		->order_by('sort_order');
		$subcat_query = $this->db->get();
		//create list of subcategories and their respective ids
		if($subcat_query->num_rows()!=0)
		{
			foreach ($subcat_query->result() as $row1)
			{
			$row1->subcategory_name= strtolower($row1->subcategory_name);
			$subcategory[]=$row1;
			
			}  
		}
		//print_r($subcategory);
			if(empty($subcat_id)||is_null($subcat_id)||!isset($subcat_id))
			{
				//echo "in if clause";
			$this->db->limit(1)   
			->from('product_subcategory')
			->where('is_active',1)
			->where('product_subcategory.category_id',$cat_id);

			$get_default_subcat = $this->db->get();
			foreach ($get_default_subcat->result() as $row)
			{
			$row = $get_default_subcat->row(); 
			$default_subcat= $row->subcategory_id;
			}
			}
			if(empty($subcat_id)||is_null($subcat_id)||!isset($subcat_id))
			{
			$whereArr=array('category_id'=>$cat_id,'subcategory_id'=>$default_subcat);
			$whereArr2=array('p.category_id'=>$cat_id,'p.subcategory_id'=>$default_subcat);
			$this->db->select('distinct(brand_name)')
				->from('brands_data')
				->where($whereArr);
			$getbrands = $this->db->get();	
			}
			else{
			$whereArr=array('category_id'=>$cat_id,'subcategory_id'=>$subcat_id);
			$whereArr2=array('p.category_id'=>$cat_id,'p.subcategory_id'=>$subcat_id);
			$this->db->select('distinct(brand_name)')
				->from('brands_data')
				->where($whereArr);
			$getbrands = $this->db->get();	
			}
			//create list of brands 
			foreach ($getbrands->result() as $brand)
			{
			array_push($brandsArr, $brand->brand_name);
			}	
				//print_r($whereArr2);
				$this->db->select('product_id,product_name')
				->from('product p')
				->where('p.is_active',1)
				->join('product_category pc','p.category_id=pc.category_id')
				->join('product_subcategory ps','p.subcategory_id=ps.subcategory_id')
				->where($whereArr2);
				$all_data=$this->db->get();
				if($all_data->num_rows()>0)
				{
					
				foreach ($all_data->result() as $row) {

					// get product image data 
					$product_id=$row->product_id;
			      	 $this->db->limit(1)
					->from('product_images')
           			->where('product_id',$product_id)
					->order_by('image_id','desc');
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
				
				
				$json = array('message' => 'success', 'statusCode'=>1,'subcategory' => $subcategory,'brands'=>$brandsArr,'products'=>$prod_all );
			
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

function filterProductsByPrice($cat_id,$subcat_id,$from,$to,$user_id,$sortflag,$brands)
	{
	$output=array();
	$whereArr=array('p.category_id'=>$cat_id,'p.subcategory_id'=>$subcat_id);
	$brandsArr=array();
	$whereArr2=array('b.category_id'=>$cat_id,'b.subcategory_id'=>$subcat_id);
	//echo "first if block".$from. "  ".$to;
	if(isset($from) && isset($to) && $from!="" && $from !="" )
	{
		
		if($sortflag ==0)
		{
		//echo "if 0";
		
		$this->db->select('*');
		$this->db->from('pricing_table pt');
		$this->db->join('product p','pt.product_id=p.product_id');
		$this->db->where($whereArr);
		if(count($brands)>0)
		{
		$this->db->join('brands_data bt','p.product_id=bt.product_id');
		$this->db->where_in('brand_name',$brands);
		}
		
		$this->db->where('pt.Price  >='.$from);
		$this->db->where('pt.Price  <='.$to);
		$this->db->where('p.is_active',1);
		$this->db->order_by('convert(`Price`, decimal)');        
		    
		$query = $this->db->get();    
		}
		else{
		//echo "first else block";
		$this->db->select('*');
		$this->db->from('pricing_table pt');
		$this->db->join('product p','pt.product_id=p.product_id');
		$this->db->where($whereArr);
		if(count($brands)>0)
		{
		$this->db->join('brands_data bt','p.product_id=bt.product_id');
		$this->db->where_in('brand_name',$brands);
		}
		
		$this->db->where('pt.Price  >='.$from);
		$this->db->where('pt.Price  <='.$to);
		$this->db->where('p.is_active',1);
		$this->db->order_by('convert(`Price`, decimal) desc');
		
		$query = $this->db->get();  
		}
		
	}
	else if(isset($sortflag)&& empty($from) && empty($to))
	{
		if($sortflag==0)
		{
		//echo "second if block";
		$this->db->select('*');
		$this->db->from('pricing_table pt');
		$this->db->join('product p','pt.product_id=p.product_id');
		if(count($brands)>0)
		{
		$this->db->join('brands_data bt','p.product_id=bt.product_id');
		$this->db->where_in('brand_name',$brands);
		}
		$this->db->order_by('cast(`Price` as decimal)');
		$this->db->where('p.is_active',1);
		$this->db->where($whereArr);
		
		$query = $this->db->get();
		}else{
		//echo "second else block";
		$this->db->select('*');
		$this->db->from('pricing_table pt');
		$this->db->join('product p','pt.product_id=p.product_id');
		if(count($brands)>0)
		{
		$this->db->join('brands_data bt','p.product_id=bt.product_id');
		$this->db->where_in('brand_name',$brands);
		}
		$this->db->where($whereArr);
		$this->db->where('p.is_active',1);
		$this->db->order_by('convert(`Price`, decimal)desc');
		$query = $this->db->get();
		}
	}
	//->where('Price <=', $to);
	//array_shift($output);
	
	//$data=$query->result();
	/*echo "<pre>";
	print_r($query->result());
	echo "</pre>";*/
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
		
			$this->db->select('distinct(brand_name)')
				->from('brands_data b')
				->where($whereArr2);
			$getbrands = $this->db->get();
			foreach ($getbrands->result() as $brand)
			{
			array_push($brandsArr, $brand->brand_name);
			}
		if(count($output)>0)
		{
		$json = array('message' => 'success', 'statusCode'=>1,'data'=>$output,'brands'=>$brandsArr);
		}
		else{
		$json = array('message' => 'No products available', 'statusCode'=>0);	
		}
		return $json;
		}


}
?>  