<?php
error_reporting(E_ALL);
class Jewellerymodel extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
		//$this->load->library('email');
        $this->load->helper('date');
    }
    function dataForDashBoard()
    {
		$this->db->select('count(*) as jewellery_stock')
		->from('product')
        ->where_not_in('status','sold');
        $query_product_count = $this->db->get();
        $jewellery_count=$query_product_count->row();
        $returnArr['number_of_stocks']=$jewellery_count->jewellery_stock;
		
        $where_arr= array('role'=>'pending','is_enable'=>0);
        $this->db->select('max(updated_on) as last_updated_on')
		->from('product');
        $query_LastUpdate = $this->db->get();
        $last_jewellery_update=$query_LastUpdate->row();
        $returnArr['last_updated_on']=$last_jewellery_update->last_updated_on;
		
        return $returnArr;
    	/* $this->db->select('count(*)')
		->from('product')
        ->where_not_in('status','sold');
        $query_productCount = $this->db->get();
        $returnArr['jewelleryCount']=$query_productCount->row();
        $where_arr= array('role'=>'pending','is_enable'=>0);
        $this->db->select('max(updated_on)')
		->from('product');
        $query_LastUpdate = $this->db->get();
        $returnArr['LastJewelleryUpdate']=$query_LastUpdate->row();
        return $returnArr */;
    }
	function dashBoard_jewelleryFavorites(){
		$this->db->select('count(*)as fav_count, p.product_id as product_id, f.updated_on as updated_on,pi.image_id as image_id,pi.image_url as image_url,pi.image_thumbnail_url as image_thumbnail_url,p.product_name as product_name') 
        ->from('favorites f') 
        ->join('product p','p.product_id=f.product_id')
        ->join('product_images pi','pi.product_id=p.product_id')
        ->order_by('count(*)','desc')
        ->group_by('f.product_id');
       
        $query_getFavrites = $this->db->get();
        $result=$query_getFavrites->result();
        return $result;
	}
       function getjewelleryFavorites()
    {
		
		
        $this->db->select('count(*)as fav_count') 
        ->from('favorites f') 
        ->join('product p','p.product_id=f.product_id')
        ->order_by('count(*)','desc')
        ->group_by('f.product_id');
       
        $query_getFavorites = $this->db->get();
        $result=$query_getFavorites->result();
        return $result;
    }

    function getstock($category_id=false,$subcategory_id=false)
    {          
                 $this->db->select('product_id,product_name,subcategory_name,category_name')
                ->from('product p')
                ->join('product_category pc','p.category_id=pc.category_id','left')
                ->join('product_subcategory ps','p.subcategory_id=ps.subcategory_id','left');
                 $query_getProducts = $this->db->get();
                return $query_getProducts->result();
               
    }
   
    function getproductName($product_name)
    {
       // echo $product_name."<br>";
       $query_getName="SELECT * FROM product WHERE INSTR('".$product_name."',product_name)";
       
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
    function addJewelleryproduct($category_name,$subcategory_name,$product_name)
    {

        $this->db->select('category_id')
            ->from('product_category')
            ->where('category_name',$category_name);

           
        $query_getcategory=$this->db->get();

        if($query_getcategory->num_rows()==0)
        {

        $insertCategory = array('category_name' => $category_name,
                                'description'=>'Added by EXCEL updated by admin',
                                'created_on'=>date('Y-m-d H:i:s'),
                                'created_by'=>'EXCEL',
                               'updated_on'=>date('Y-m-d H:i:s'),
                               'updated_by'=>'admin' );
           $this->db->insert('product_category',$insertCategory);  
            
          if($this->db->affected_rows()==1)  
           {
               $category_id=$this->db->insert_id();
           }
        }else{
                $row=$query_getcategory->row();
                $category_id=$row->category_id;
        }

             
            $whereArr=array('category_id'=>$category_id,'subcategory_name'=>$subcategory_name);
             $this->db->select('subcategory_id')
            ->from('product_subcategory')
            ->where($whereArr);
            $query_subgetcategory=$this->db->get();

            
            if($query_subgetcategory->num_rows()==0)
            {
            
                $insertSubcategory = array('subcategory_name' => $subcategory_name,
                                'category_id'=>$category_id,
                                'description'=>'Added by EXCEL updated by admin',
                                'created_on'=>date('Y-m-d H:i:s'),
                                'created_by'=>'EXCEL',
                                'updated_on'=>date('Y-m-d H:i:s'),
                                'updated_by'=>'admin'); 
                 $this->db->insert('product_subcategory',$insertSubcategory);  
        
                if($this->db->affected_rows()==1)  
                {
                    $subcategory_id=$this->db->insert_id();
                }
            }else{
                    $row=$query_subgetcategory->row();
                    $subcategory_id=$row->subcategory_id;
                }
                 $whereArr=array('product_name'=>$product_name);
                 $this->db->select('product_id')
                ->from('product')
                ->where($whereArr);
                $query_product=$this->db->get();

            
            if($query_product->num_rows()==0)
            {    
                 $insertProduct = array('product_name' => $product_name,
                                'category_id'=>$category_id,
                                'subcategory_id'=>$subcategory_id,
                                'is_hot'=>0,
                                'is_new'=>0,
                                'created_on'=>date('Y-m-d H:i:s'),
                                'created_by'=>'EXCEL',
                                'updated_on'=>date('Y-m-d H:i:s'),
                                'updated_by'=>'admin',
                                'status'=>'AVAILABLE'); 
                 $this->db->insert('product',$insertProduct);  
           
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
                                'category_id'=>$category_id,
                                'subcategory_id'=>$subcategory_id,
                                'is_hot'=>0,
                                'is_new'=>0,
                                'created_on'=>date('Y-m-d H:i:s'),
                                'created_by'=>'EXCEL',
                                'updated_on'=>date('Y-m-d H:i:s'),
                                'updated_by'=>'admin'); 
                $this->db->where('product_id',$product_id);
                 $this->db->update('product',$updateProduct); 
               if($this->db->affected_rows()==1)  
                {
                    return $product_id;
                }
           }  

    }
        

    


}   

?>