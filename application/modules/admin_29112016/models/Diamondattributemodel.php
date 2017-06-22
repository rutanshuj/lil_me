<?php
error_reporting(E_ALL);
class Diamondattributemodel extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
		$this->load->library('email');
		$this->load->database();
    }

   function getAttributes()
   {
   	 $this->db->select('*')
      ->from('attribute_diamond ');
     $query_getAttributes= $this->db->get();
     $result=$query_getAttributes->result();
     return $result;
   }
   function getProductwiseAttributes($product_id,$attribute_id)
   {
   	 $whereArr=array('av.attribute_id'=>$attribute_id,'av.product_id'=>$product_id);
   	 $this->db->select('attribute_name,attribute_value')
       ->from('product_diamond p')
       ->join('attribute_value_diamond av','av.product_id=p.product_id','left')
       ->join('attribute_diamond a','av.attribute_id=a.attribute_id','left')
       ->where($whereArr);
     $query_getAttributes= $this->db->get();
     
     return $query_getAttributes->row();
   }
    function updateAttributes($attribute_name,
    	$attribute_type=false,
    	$sort_order=false,
    	$attribute_header=false,
    	$admin_name=false)
   {
   	$updateData = array(
			   'attribute_name' => $attribute_name ,
			   'attribute_type' =>  $attribute_type,
			   'sort_order' => $sort_order ,
			   'attribute_header' => $attribute_header ,			   
			   'updated_on' => date('Y-m-d H:i:s'),
			   'updated_by'=>$admin_name);
			  
	   	$this->db->where('attribute_id', $attribute_id);
		$this->db->update('attribute_diamond', $updateData);
		if($this->db->affected_rows()==1)
		{
	     return 1;
		}
		else{
		return 0;
		}
	}
   
  function deleteAttribute($attribute_id)
	{
	$this->db->delete('attribute_diamond', array('attribute_id' => $attribute_id)); 
	$effect=$this->db->affected_rows() > 0 ? $this->db->affected_rows() : 0;
		if($effect)
		{
		return $effect;
		}
		else{
		return $effect;
		}
	}
	function insertDiamondAttributes($attribute_name,$attribute_type=false,
    	$sort_order=false,$attribute_header=false,$admin_name=false)
   {
   
   	$this->db->select('attribute_id')
            ->from('attribute_diamond')
            ->where('attribute_name',$attribute_name);
    $query_attribute=$this->db->get();

    if($query_attribute->num_rows()==0)
    {      
   	$insertData = array(
			   'attribute_name' => $attribute_name ,
			   'attribute_type' =>  $attribute_type,
			   'sort_order' => $sort_order ,
			   'attribute_header' => $attribute_header ,
			   'created_on'=>date('Y-m-d H:i:s'),		   
			   'updated_on' => date('Y-m-d H:i:s'),
			   'updated_by'=>$admin_name);
			  
	   
        $this->db->insert('attribute_diamond', $insertData);  
		
		if($this->db->affected_rows()==1)
		{
	    $attribute_id=$this->db->insert_id();
		}
		
	}else{
        $row=$query_attribute->row();
        $attribute_id=$row->attribute_id;
        }
        return $attribute_id;
 	}
 	function insertDiamondAttributesValue($attribute_id,$product_id,$attribute_value,$admin_name=false)
   {
   	$whereArr=array('attribute_id'=>$attribute_id,'product_id'=>$product_id);
   	$this->db->select('attribute_value_id')
            ->from('attribute_value_diamond')
            ->where($whereArr);
    $query_attributeValue=$this->db->get();

    if($query_attributeValue->num_rows()==0)
    {      
   	$insertData = array(
			  'attribute_id'=>$attribute_id,
				'product_id'=>$product_id,
				'attribute_value'=>$attribute_value,
				'updated_on' => date('Y-m-d H:i:s'),
			   'updated_by'=>$admin_name);
			  
	   
        $this->db->insert('attribute_value_diamond', $insertData);  
		
			if($this->db->affected_rows()==1)
			{
		   	return 1;
			}
			else{
	        return 0;
	        }
	}
	else{
			$row=$query_attributeValue->row();
            $attribute_value_id=$row->attribute_value_id;
			$updateData = array(
			'attribute_id'=>$attribute_id,
			'product_id'=>$product_id,
			'attribute_value'=>$attribute_value,
			'updated_on' => date('Y-m-d H:i:s'),
			'updated_by'=>$admin_name);
		 $this->db->where('attribute_value_id',$attribute_value_id);
         $this->db->update('attribute_value_diamond',$updateData); 
         if($this->db->affected_rows()==1)  
                {
                 return 1;
                }  
            else{
       	 return 0;
        		}
        
 	}
	}
}