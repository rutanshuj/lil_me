<?php
date_default_timezone_set('Asia/Kolkata');
class Genericmodel extends CI_Model
{
	

	function getproducts($inString=false,$user_id=false)
	{	
		$products=array();
		// case insensitive string comparison
		//$searchString=strtolower($inString);
		$string=$searchString=strtolower(trim($inString));
		//print_r($inString);
		$cat_flag;
		$i=0;
		
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
						
						$getname ="SELECT attribute_value,pc.category_slug
						FROM attribute_value av,product_category pc,product p
						WHERE av.product_id=".$row->product_id."
						and p.category_id=pc.category_id				
						and av.attribute_id =
						(select attribute_id
						from attribute
						where attribute_name LIKE 'product name')";
						$getname_query = $this->db->query($getname);
						foreach ($getname_query->result() as $name) {
							 $row->product_name=$name->attribute_value;
							 $row->category_slug=$name->category_slug;
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

				/* if(count($products)>0)
				{
						$json = array('message' => 'Success', 'statusCode'=>1,'data'=>$products);
				}
				else
				{
					$json = array('message' => 'No products available', 'statusCode'=>0);
				} */
		return $products;
		}


   
		function getdiamonds($whereArr)
		{
			//print_r($whereArr);
			$query="select * from stock_search where ";
			foreach ($whereArr as $key=>$attributes )
			{
				if(is_array($attributes) && $key=='Shape' && count($attributes)>1)
				{
				//echo count($attributes);
					$attribute_string= implode("','",$attributes);
					$query.=$key." IN ('".$attribute_string."') and ";
				}
				if(is_array($attributes) && $key=='Lab' && count($attributes)>1)
				{
					$attribute_string= implode("','",$attributes);
					$query.=$key." IN ('".$attribute_string."') and ";
				}
				if(is_array($attributes) && $key=='Color' && count($attributes)>1)
				{
				$attribute_string= implode("','",$attributes);
				$query.=$key." IN ('".$attribute_string."') and ";
				}
				if(is_array($attributes) && $key=='Weight' && count($attributes)>1)
				{
				$attribute_string= implode(" ",$attributes);
				$attribute_string=str_replace(' ',' and ',$attribute_string);
				$query.=$key." between ".$attribute_string." and ";
				}
				if(is_array($attributes) && $key=='Table' && count($attributes)>1)
				{
				//$attribute_string= implode("','",$attributes);
				$query.="tbl between ".$attributes[0]." and ".$attributes[1]." and ";
				}
				if(is_array($attributes) && $key=='Depth' && count($attributes)>1)
				{
				//$attribute_string= implode("','",$attributes);
				$query.="Depth between ".$attributes[0]." and ".$attributes[1]." and ";
				}
				if(is_array($attributes) && $key=='Clarity' && count($attributes)>1)
				{
				$attribute_string= implode("','",$attributes);
				$query.=$key." IN ('".$attribute_string."') and ";
				}
				if(is_array($attributes) && $key=='Cut_Grade' && count($attributes)>1)
				{
					
				$attribute_string= strtolower(implode("','",$attributes));
				$attribute_string=str_replace('very ','V',$attribute_string);
				$attribute_string=str_replace('good','G',$attribute_string);
				$attribute_string=str_replace('excellent','EX',$attribute_string);
				$query.=$key." IN ('".$attribute_string."') and ";
				}
				if(is_array($attributes) && $key=='Symmetry' && count($attributes)>1)
				{
				$attribute_string= strtolower(implode("','",$attributes));
				$attribute_string=str_replace('very ','V',$attribute_string);
				$attribute_string=str_replace('good','G',$attribute_string);
				$attribute_string=str_replace('excellent','EX',$attribute_string);
				$query.=$key." IN ('".$attribute_string."') and ";
				}
				if(is_array($attributes) && $key=='Polish' && count($attributes)>1)
				{  
				$attribute_string= strtolower(implode("','",$attributes));
				$attribute_string=str_replace('very ','V',$attribute_string);
				$attribute_string=str_replace('good','G',$attribute_string);
				$attribute_string=str_replace('excellent','EX',$attribute_string);
				$query.=$key." IN ('".$attribute_string."') and ";
				}
				
				if(is_array($attributes) && $key=='Fluorescence_Intensity' && count($attributes)>1)
				{

				$attribute_string= strtolower(implode("','",$attributes));
				//echo $attribute_string;
				$attribute_string=str_replace('faint','FNT',$attribute_string);
				$attribute_string=str_replace('slight','STG',$attribute_string);
				$attribute_string=str_replace('none','NON',$attribute_string);
				$query.="Fluorescence_Intensity IN ('".$attribute_string."') and ";
				}
				if(is_array($attributes) && $key=='diameter' && count($attributes)>1)
				{
				//echo count($attributes);
				//print_r($attributes[1]);							
				$query.="min_diameter >=".$attributes[0];
				$query.=" AND max_diameter <= ".$attributes[1]." and ";
				}
				if(is_array($attributes) && $key=='pricePerCarat' && count($attributes)>1)
				{
				//echo count($attributes);
				//print_r($attributes[1]);							
				$query.=" Price >=".$attributes[0];
				$query.=" AND Price <= ".$attributes[1]." and ";
				}

				if(is_array($attributes) && $key=='height' && count($attributes)>1)
				{
				//echo count($attributes);
				//print_r($attributes[1]);							
				$query.="height >=".$attributes[0];
				$query.=" AND height <= ".$attributes[1]." and";
				}

			}  
			$query=substr($query,0,-4); 
			
			
			//print_r($query);
			//print_r($no_end);
			$getdata = $this->db->query($query);
			$data= $getdata->result();
			if($getdata->num_rows()==0)
					{	
						$json =array('message' => 'No diamond for this particular Search', 'statusCode'=>0);
					}
			else{
				foreach ($getdata->result() as $row)
						    {
						  if(is_null($row->Cash_Price))
						  {
						  	$row->Cash_Price=0;
						  }

						  if(is_null($row->Price))  
						  {
						  	$row->Price=0;
						  }
						    }
			$json =array('message' => 'success', 'statusCode'=>1,'data'=>$data);
			}
			return $json;
		}
	}   

?>