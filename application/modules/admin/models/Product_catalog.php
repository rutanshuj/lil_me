<?php
class Product_catalog extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
		$this->load->library('email');
    }
	
	function dashBoard_data(){
		$this->db->select('count(*) as number_of_stocks')
		->from('product_catalog');
		//->where('is_active','1')
      //  ->where_not_in('status','sold');
        $query_productCount = $this->db->get();
        $diamond_count=$query_productCount->row();
        $returnArr['number_of_stocks']=$diamond_count->number_of_stocks;

       
        $this->db->select('max(updated_on) as last_updated_on')
		->from('product_catalog');
        $query_LastUpdate = $this->db->get();
        $last_diamond_update=$query_LastUpdate->row();
        $returnArr['last_updated_on']=$last_diamond_update->last_updated_on;
        return $returnArr;
	}
	
	
   /*  function dataForDashBoard()
    {
    	$this->db->select('count(*)')
		->from('product_catalog')
        ->where_not_in('status','sold');
        $query_productCount = $this->db->get();
        $returnArr['diamondCount']=$query_productCount->row();

        $this->db->select('max(updated_on)')
		->from('product_catalog');
        $query_LastUpdate = $this->db->get();
        $returnArr['LastDiamondUpdate']=$query_LastUpdate->row();
        return $returnArr;
    }

    function getproductName($product_name)
    {
        //echo $product_name;
       $query_getName="SELECT * FROM product_diamond WHERE INSTR('".$product_name."',product_name)";
       
        $query_getProductName = $this->db->query($query_getName);
       if($query_getProductName->num_rows()!=0)
       {
        $row=$query_getProductName->row();
        return $row->product_id;
       }
       else{
        return 0;
       }
    }

    function getcertName($cert_name)
    {
        //echo $product_name;
       $query_getName="SELECT * FROM product_diamond WHERE INSTR('".$cert_name."',certificate)";
       
        $query_getProductName = $this->db->query($query_getName);
       if($query_getProductName->num_rows()!=0)
       {
        $row=$query_getProductName->row();
        return $row->product_id;
       }
       else{
        return 0;
       }
    }
    function addDiamondProducts($product_name,$certificate_tag)
    {
        $whereArr=array('product_name'=>$product_name);
                 $this->db->select('product_id')
                ->from('product_diamond')
                ->where($whereArr);
         $query_product=$this->db->get();
        if($query_product->num_rows()==0)
            {    
                 $insertProduct = array('product_name' => $product_name,
                                'certificate'=>$certificate_tag,
                                'created_on'=>date('Y-m-d H:i:s'),
                                'created_by'=>'EXCEL',
                                'updated_on'=>date('Y-m-d H:i:s'),
                                'updated_by'=>'admin',
                                'status'=>'AVAILABLE'); 
                 $this->db->insert('product_diamond',$insertProduct);  
           
                 if($this->db->affected_rows()==1)  
                {
                    $product_id=$this->db->insert_id();
                }
                return $product_id;
           }
           else{
            $row=$query_product->row();
            $product_id=$row->product_id;
            $updateProduct = array('product_name' => $product_name,
                                'certificate'=>$certificate_tag,
                                'created_on'=>date('Y-m-d H:i:s'),
                                'created_by'=>'EXCEL',
                                'updated_on'=>date('Y-m-d H:i:s'),
                                'updated_by'=>'admin',
                                'status'=>'AVAILABLE');
                $this->db->where('product_id',$product_id);
                 $this->db->update('product_diamond',$updateProduct); 
               if($this->db->affected_rows()==1)  
                {
                    return $product_id;
                }
           }  
    }

      function getDiamondstock($category_id=false,$subcategory_id=false)
    {          
                 $this->db->select('product_id,product_name,certificate')
                ->from('product_diamond p');
              
                 $query_getProducts = $this->db->get();
                return $query_getProducts->result();
               
    } */
 }   
?>