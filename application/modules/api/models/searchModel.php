<?php
class searchModel extends CI_Model
{
	function getProducts($whereArr)
	{
		$attr_arr[]='';
		$arr='';
		$arr_polish='';
		foreach ($whereArr as $attr => $attr_value) {
		array_push($attr_arr,$attr);
		if($attr=='Fluor.')
		{  //echo "jksdskdsl";
			$arr=$attr_value;
			array_shift($arr);
			
		}
		if($attr=='Polish')
		{  
		
			$arr_polish=$attr_value;
			//array_shift($arr);
			
		}
		if($attr=='Clarity')
		{  
		
			$arr_clarity=$attr_value;
			//array_shift($arr);
			
		}


		
	}
				/*array_shift($attr_arr);
			
				print_r($attr_arr);
				print_r($arr);
  				print_r($arr_polish);
  				print_r($arr_clarity);*/
					$this->db->select('attribute_id')
					->from('attribute a')
					->where_in('attribute_name',$attr_arr);
					$query = $this->db->get();
					$data=$query->result();
					$data = $query->result_array();
					//print_r($data);
					 foreach ($query->result() as $row)
					  	 {
					  	 	$attribute_id[]= $row->attribute_id;
					  	 }
					   		//print_r($attribute_id);

					$where = "FIND_IN_SET('".$attribute_id."',attribute_id )";
					$attr_arr = array('attribute_id' =>$attribute_id );
					$this->db->select('*')
					->from('productattributedata')
					->where($where);			
					/*->where_in('attribute_value' ,$arr_polish)
					->where_in('attribute_value' ,$arr_polish);*/
						
           			
           			$query = $this->db->get();
					$product_data=$query->result();

					
}
  
}
?>   