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
		$this->db->order_by("sort_order","asc");
		$this->db->select('category_id,category_slug,category_name,description,image_url,image_thumbnail_url,sort_order');		
		$query = $this->db->get('product_category');		
		return $query->result() ;
	}
	function get_genders()
	{
		$this->db->select('distinct(gender)');
		$this->db->from('product');
		$query = $this->db->get();
		return $query->result();
	}
	
	function category_deleted($id= false){
		$this->db->where('category_id', $id);
		$this->db->delete('product_category');	
			
	}
	
	
	function get_products_criteriaWise($category_id,$size_id,$gender,$sortflag,$limit,$start)
	{
		//echo $start." ".$limit;
		$products=array();
		$this->db->limit($limit, $start);
		$this->db->select('distinct(p.product_id),p.product_name,pt.Price');
		$this->db->from('product p');
		$this->db->where('p.is_active',1);
		//$this->db->join('product_category pc','p.category_id=pc.category_id');
		$this->db->join('pricing_table pt','pt.product_id=p.product_id');
		$this->db->where('p.category_id',$category_id);
		/*  echo"<pre>";
		print_r($gender);
		echo"</pre>";
		echo"<pre>";
		print_r($size_id);
		echo"</pre>";
		die(); */
		if(isset($size_id) and count($size_id)>0)
		{
		$this->db->where_in('pom.size_id',$size_id);
		$this->db->join('product_option_mapper pom','pom.product_id=p.product_id');		
		}
		if(isset($gender) and count($gender)>0)
		{
		$this->db->where_in('p.gender',$gender);
		}
		
		
		if(isset($sortflag) and $sortflag!='')
		{
		
		if($sortflag=='1')
		{
			
		$this->db->order_by("convert('Price', decimal(10,2)) desc");
		}
		else if($sortflag=='2'){
		$this->db->join('attribute_value', 'attribute_value.product_id=p.product_id');
		$this->db->join('attribute', 'attribute_value.attribute_id=attribute.attribute_id');
		$this->db->where('attribute_name','Product Name');
		$this->db->order_by("attribute_value","asc");
		}
		else if($sortflag=='3')
		{
		$this->db->join('attribute_value', 'attribute_value.product_id=p.product_id');
		$this->db->join('attribute', 'attribute_value.attribute_id=attribute.attribute_id');
		$this->db->or_where('attribute_name','Discount');
		
		}
		else if($sortflag=='4'){
			$this->db->order_by("convert('Price', decimal(10,2))");
		}
		}else
		{
		$this->db->order_by("convert(`Price`, decimal(10,2))");
		}
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit;
		// echo '<pre>';
		// print_r($query->result());
		// echo '</pre>';
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
							 $row->product_slug=url_title($name->attribute_value, 'dash', true);
						}
					
					$this->db->limit(1)
					->from('product_images')
           			->where('product_id',$row->product_id)
					->order_by('image_id','asc');
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