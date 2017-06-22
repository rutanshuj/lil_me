<?php
class Category_model extends CI_Model
{
	public function __construct(){
    
        parent::__construct();
		
    }
	function category_name_validation($category_id= false ,$category_name= false,$id=false){
		
		if($id=="1"){
			$this->db->where('category_id',$category_id);
		} else {
			$this->db->where('category_id !=',$category_id);
		}
		$this->db->where('category_name',$category_name);
		$this->db->where('is_active',1);
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
		$this->db->where('product_category.is_active','1');
		$this->db->select('category_id, category_name,description,image_url,image_thumbnail_url,sort_order');		
		$query = $this->db->get('product_category');		
		return $query->result() ;
	}
	
	function category_deleted($id= false){
		$this->db->where('category_id', $id);
		$this->db->delete('product_category');	
		///////
		//$this->db->where('category_id', $id);
		//$this->db->delete('product_subcategory');	
		////
		//$this->db->where('category_id', $id);
		//$this->db->delete('product');	
	}
	function get_category_products($id=false)
	{
		$products=array();
		$this->db->select('product_id,product_name')
				->from('product p')
				->where('p.is_active',1)
				->join('product_category pc','p.category_id=pc.category_id')
				->where('pc.category_id',$id);
				$query = $this->db->get();
		foreach ($query->result() as $row) {
					
					$getname ="SELECT attribute_value
						FROM attribute_value av
						WHERE av.product_id=".$row->product_id." and av.attribute_id =
						(select attribute_id
						from attribute 
						where attribute_name LIKE 'product name')";
						$getname_query = $this->db->query($getname);
						foreach ($getname_query->result() as $name) {
							 $row->product_name=$name->attribute_value;
						}
					
					$this->db->limit(1)
					->from('product_images')
           			->where('product_id',$row->product_id)
					->order_by('image_id','desc');
					$getImg = $this->db->get();
				
					//print_r($getImg->result());
					//$default_img=URL_CONST. str_replace('\\', '/',$imgRow->image_url);
					//$default_thumb=URL_CONST. str_replace('\\', '/',$imgRow->image_thumbnail_url);
					if($getImg->num_rows()==0)
					{	
						$row->image_url=' ';
						$row->thumbnail_url=' ';
					}
					else{
					$imgRow=$getImg->row();
					$row->image_url=$imgRow->image_url;
					$row->thumbnail_url=$imgRow->image_thumbnail_url;	
					}
					
					$products[]=$row;
		}
		
		return $products;
	}
	
	function get_products_criteriaWise($category_id,$size_id,$gender,$sortflag,$sortparam)
	{
		$products=array();
		$this->db->select('p.product_id,p.product_name');
		$this->db->from('product p');
		$this->db->where('p.is_active',1);
		$this->db->join('product_category pc','p.category_id=pc.category_id');
		$this->db->where('pc.category_id',$category_id);
		if(isset($size_id) and is_numeric($size_id))
		{
		$this->db->where('pom.size_id',$size_id);
		$this->db->join('product_option_mapper pom','pom.product_id=p.product_id');		
		}
		if(isset($gender) and $gender!='')
		{
		$this->db->where('p.gender',$gender);
		}
		if(isset($sortflag) and $sortflag!='')
		{
		if($sortflag==0)
		{
			$sort='asc';
		}
		else{
			$sort='desc';
		}
		$this->db->join('pricing_table pt','p.product_id=pt.product_id');
		$this->db->order_by("convert(`Price`, decimal)".$sort);
		}
		if(isset($sortparam) and $sortparam!='')
		{
		if($sortparam=='name')
		{
			
		}
		else{
			
		}
		}
		$query = $this->db->get();
	//	print_r($query->result());
	
		foreach ($query->result() as $row) {
					
					
					$getname ="SELECT attribute_value
						FROM attribute_value av
						WHERE av.product_id=".$row->product_id." and av.attribute_id =
						(select attribute_id
						from attribute 
						where attribute_name LIKE 'product name')";
						$getname_query = $this->db->query($getname);
						foreach ($getname_query->result() as $name) {
							 $row->product_name=$name->attribute_value;
						}
					
					$this->db->limit(1)
					->from('product_images')
           			->where('product_id',$row->product_id)
					->order_by('image_id','desc');
					$getImg = $this->db->get();
				
					if($getImg->num_rows()==0)
					{	
						$row->image_url=' ';
						$row->thumbnail_url=' ';
					}
					else{
					$imgRow=$getImg->row();
					$row->image_url=$imgRow->image_url;
					$row->thumbnail_url=$imgRow->image_thumbnail_url;	
					}
					
					$products[]=$row;
		}
		return $products;
		
		
	}
}
?>