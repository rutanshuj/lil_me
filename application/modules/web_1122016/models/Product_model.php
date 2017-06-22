<?php
class Product_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
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
	
	function get_product_details($product_id=false){
		if(is_numeric($product_id)){
			$this->db->where('product.product_id',$product_id);	
		}
		$this->db->where('product.is_active','1');	
		$this->db->select('attribute_value as product_name,price,brand_name as brand');	
		$this->db->from('product');
		$this->db->join('brands_data', 'product.product_id = brands_data.product_id','left');
		$this->db->join('pricing_table', 'product.product_id = pricing_table.product_id','left');
		$this->db->join('attribute_value', 'attribute_value.product_id = product.product_id','left');
		$this->db->join('attribute', 'attribute.attribute_id = attribute_value.attribute_id','left');
		$this->db->where('`attribute_value`.`attribute_id` IN (SELECT `attribute_id` FROM `attribute` where attribute_name="Product name")', NULL, FALSE);
		$query = $this->db->get();		
		//return 
		return($query->result()) ;
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