<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagination_Model extends CI_Model {
function __construct() {
parent::__construct();
}
// Count all record of table "contact_info" in database.
public function record_count($category_id) {
		
		$this->db->select('count(*)');
		$this->db->from('product p');
		$this->db->join('product_category pc','p.category_id=pc.category_id');
		$this->db->where('pc.category_id',$category_id);
		$query = $this->db->get();
	return $query->num_rows();
}

// Fetch data according to per_page limit.


function get_products_criteriaWise($category_id,$size=false,$gender=false,$sortflag=false,$sortparam=false,$limit,$start)
	{  
	echo $limit."<br>".$start;
		$products=array();
		$this->db->limit($limit, $start);	
		$this->db->select('p.product_id,p.product_name');
		$this->db->from('product p');
		/*$this->db->where('p.is_active',1);
		$this->db->join('product_category pc','p.category_id=pc.category_id');
		$this->db->where('pc.category_id',$category_id);
		 if(isset($size) and is_numeric($size))
		{
		$this->db->where('pom.size_id',$size);
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
		} */
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