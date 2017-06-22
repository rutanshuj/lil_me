<?php
class Product_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		setlocale(LC_MONETARY, 'en_IN');
		
    }
	
	function get_attribute_field(){
		$this->db->select('attribute_id, attribute_name,attribute_type,attribute_header,sort_order');		
		$this->db->order_by('sort_order','asc');
		$query = $this->db->get('attribute');		
		return $query->result() ;
	}
	
	function product_images($product_id=false){
		if(is_numeric($product_id)){
			$this->db->where('product_id',$product_id);	
		}
		$this->db->select('image_id, image_url,image_thumbnail_url,product_id');	
		
		$query = $this->db->get('product_images');		
		return $query->result() ;
	}
	
	function product_attribute_value($product_id=false){
		if(is_numeric($product_id)){
			$this->db->where('product_id',$product_id);	
		}
		$this->db->select('attribute_value_id, attribute_id,product_id,attribute_value');	
		
		$query = $this->db->get('attribute_value');		
		return $query->result() ;
	}
	function is_favorite($user_id=false,$product_id=false){
		
		$this->db->select('*');	
		$this->db->where('product_id',$product_id);	
		$this->db->where('user_id',$user_id);	
		$query = $this->db->get('favorites');
		
		if($query->num_rows()==0)		
			return 0;
		else
			return 1;
		
	}
	
	function get_product_details($product_id=false){
	$size=array();
	$this->db->select('product_id,product_name,category_id,description')
	->from('product')
	->where('product_id',$product_id);	
	$query = $this->db->get();
	//$data=$query->result();
	if($query->num_rows()!=0)
	{		
				foreach ($query->result() as $row) {
					 $this->db->select('image_url,image_thumbnail_url')
					->from('product_images')
           			->where('product_id',$product_id)
					->order_by('image_id','asc');
					$getImg = $this->db->get();
					//to fetch			
					if(isset($fav_flag) or isset($search_flag))
					{
					
						if($getImg->num_rows() > 0)
						{
							$imgRow = $getImg->row(); 
							
							$default_img=str_replace('\\', '/',$imgRow->image_url);
							$default_thumb=str_replace('\\', '/',$imgRow->image_thumbnail_url);
							$row->image_url=$default_img;
							$row->thumbnail_url=$default_thumb;
						}
						else					
						{	
							$row->image_url=' ';
						}				
					}
					else
					{
					if($getImg->num_rows() > 0)
						{
							foreach ($getImg->result() as  $imgRow) {
							$default_img= str_replace('\\', '/',$imgRow->image_url);
							$default_thumb=str_replace('\\', '/',$imgRow->image_thumbnail_url);
							$row->image_url[]=$default_img;
														
							}
						}
							else{
								$row->image_url[]='';	
							}		
					}
					
					
				
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


					
							
						// get the price 
						$getprice="select price from pricing_table where product_id=".$product_id;
						$getprice_query = $this->db->query($getprice);
						if($getprice_query->num_rows()==0)
						{
							$row->price='';
						}  
						else{
							foreach ($getprice_query->result() as $a) {
								
							
							$row->price =$a->Price;
								}
						}
					$this->db->select('attribute_value');
					$this->db->from('attribute_value');
					$this->db->join('product', 'product.product_id = attribute_value.product_id','left');
					$this->db->where('`attribute_value`.`attribute_id` IN 
					(SELECT `attribute_id` FROM `attribute` where attribute_name="Description")', NULL, FALSE);
					$this->db->where('product.product_id',$product_id);
					$get_description = $this->db->get();
					$row->description=$get_description->row();
					//to get attribute lists in key-pair format
					if(!isset($fav_flag) and !isset($search_flag))
					{
					$get_attr_id= "SELECT attribute_header,GROUP_CONCAT(attribute_id) as attr_ids
				     FROM attribute
				     GROUP BY attribute_header";
				    
				    $get_attr_id_query = $this->db->query($get_attr_id);
					//print_r($get_attr_id_query->result());  
				    foreach ($get_attr_id_query->result() as $attr_row)
					{
						$id_arr=$attr_row->attr_ids;
						
						$attr_header=$attr_row->attribute_header;
								$get_data="select attribute_name,av.attribute_value 
								from attribute_value av,attribute a
								where av.attribute_id in(".$id_arr.") and attribute_name <> 'C.NO' and product_id=".$product_id." 
								and av.attribute_id=a.attribute_id and av.attribute_value <> '' and a.attribute_name <> 'Price'
								and a.attribute_name <> 'Description' and a.attribute_name <> 'Product name'
								order by sort_order";
								//echo $get_data;	
								$get_data_query=$this->db->query($get_data);
								//print_r($get_data_query->num_rows());
								if($get_data_query->num_rows() !=0)     
								{
								$row->attributes=$get_data_query->result();
								}
								//$row->$attrs;
					}
					$this->db->select('quantity,size_title,ms.size_id')
					->from('product_option_mapper pom')
					->join('master_size ms','ms.size_id=pom.size_id')
           			->where('product_id',$product_id);
					$getsize=$this->db->get();
					 foreach ($getsize->result() as $size_row)
					 {
						 $size[$size_row->size_id]=$size_row->size_title;
					 }
					 $row->size=$size;
					}
				
				
           		}
/* 				echo "<pre>";
				print_r($row);
				echo "</pre>"; */
				return $row;
	}
	else{
		return NULL; 
	}
		
		
		
	}
	function get_product_by_sub_category($sub_category_id=false,$category_id=false){
		
		if(is_numeric($sub_category_id)){
			$this->db->where('subcategory_id',$sub_category_id);
		}
		if(is_numeric($category_id)){
			$this->db->where('category_id',$category_id);
		}
		$this->db->where('is_active','1');
		$this->db->select('product_id, product_name');		
					
		$query = $this->db->get('product');		
		return $query->result() ;
	}
	
	
	
	
	
	
	
	
	function category_name_validation($category_id= false ,$category_name= false,$id=false){
		
		if($id=="1"){
			$this->db->where('category_id',$category_id);
		} else {
			$this->db->where('category_id !=',$category_id);
		}
		$this->db->where('category_name',$category_name);
		$query = $this->db->get('product_category');
		return $rowcount = $query->num_rows();
	}
	function product_category($category_id=false,$category_name=false){	
		if(is_numeric($category_id)){
			$this->db->where('category_id',$category_id);
		}
		if(is_numeric($category_name)){
			$this->db->where('category_name',$category_name);
		}
		$this->db->where('is_active','1');
		$this->db->select('category_id, category_name,description,image_url,image_thumbnail_url');		
		$query = $this->db->get('product_category');		
		return $query->result() ;
	}
	public function getproducts($inString=false,$user_id=false)
	{	
	$output[]='';
	
		$string=$searchString=strtolower(trim($inString));
		
		$cat_flag;
		$i=0;
					array_shift($output);
					$this->db->select('*')
					->from('product_subcategory');
					
					$subcat_query = $this->db->get();
					
					$data= $subcat_query->result();
						foreach ($subcat_query->result() as $row)
						    {
						   	$subcategory_id= $row->subcategory_id;
							/// after modification
							   	$subcategory[$subcategory_id]=$subcategory_name= strtolower($row->subcategory_name);

								
							}
							
							// check if searched word is category 
							
							foreach ($subcategory as $key => $value) {
							
								similar_text($value, $string, $sim);
							
								if($sim > 80){
									$searchString=str_replace($string,$value,$searchString);
									break;
								}
							}
					
		
		//echo $searchString;
		$inString=explode(" ",$searchString);
		$getdata="select distinct product_id from general_search where";
		foreach ($inString as $key => $string)
		 {	
		 	$getdata.="  concatdata like'%".$string."%' and";
		 }
		$getdata=substr($getdata,0,-3); 
		//echo $getdata;
		$query = $this->db->query($getdata);
				
		if($query->num_rows()==0)
			{
				$json = array('message' => 'failure', 'statusCode'=>0);
			}
		//print_r($query->result());
		foreach ($query->result() as $row) {
			$product_id= $row->product_id;
			$this->load->Model('serviceModel');

			$output[]=$this->serviceModel->getProductDetailsByID($product_id,$user_id,NULL,1);
			
			
			}

				if(count($output)>0)
				{
						$json = array('message' => 'success', 'statusCode'=>1,'data'=>$output);
				}
				else
				{
					$json = array('message' => 'No Products Available', 'statusCode'=>0);
				}
		return $json;
		}
	
	
}
?>