<?php

date_default_timezone_set('Asia/Kolkata');
class Servicemodel extends CI_Model
{
	
function getProductDetailsByID($product_id,$user_id,$fav_flag=false,$search_flag=false)
{	
	$size=array();
	$this->db->select('product_id,product_name,category_id,description')
	->from('product')
	->where('product_id',$product_id);	
	$query = $this->db->get();
	$data=$query->result();
	
				foreach ($query->result() as $row) {
					 $this->db->select('image_url,image_thumbnail_url')
					->from('product_images')
           			->where('product_id',$product_id);
					$getImg = $this->db->get();
					//to fetch			
					if(isset($fav_flag) or isset($search_flag))
					{
					
						if($getImg->num_rows() > 0)
						{
							$imgRow = $getImg->row(); 
							
							$default_img=URL_CONST. str_replace('\\', '/',$imgRow->image_url);
							$default_thumb=URL_CONST. str_replace('\\', '/',$imgRow->image_thumbnail_url);
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
							$default_img=URL_CONST. str_replace('\\', '/',$imgRow->image_url);
							$default_thumb=URL_CONST. str_replace('\\', '/',$imgRow->image_thumbnail_url);
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
							$row->price =$a->Price;
								}
						}

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
								and av.attribute_id=a.attribute_id and av.attribute_value <> '' order by sort_order";
								//echo $get_data;	
								$get_data_query=$this->db->query($get_data);
								//print_r($get_data_query->num_rows());
								if($get_data_query->num_rows() !=0)     
								{
								$row->$attr_header=$get_data_query->result();
								}
								//$row->$attrs;
					}
					$this->db->select('quantity,size_title')
					->from('product_option_mapper pom')
					->join('master_size ms','ms.size_id=pom.size_id')
           			->where('product_id',$product_id);
					$getsize=$this->db->get();
					 foreach ($getsize->result() as $size_row)
					 {
						 $size[]=$size_row->size_title;
					 }
					 $row->size=$size;
					}
							//$row->attributes=$data;
				
				
           		}
				//$json = ('message' => 'success', 'statusCode'=>1,'data'=>$data);
				//print_r($id_arr);
           		//print_r($json);
				return $row;
			}

	}

?>