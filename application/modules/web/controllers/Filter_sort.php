<?php

//header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
class Filter_sort extends CI_controller {

	 function __construct()
    {
        parent::__construct();
      	//$this->load->Model('filter_model');
    }
	
	function filter_data_post(){
		$cate_id=$this->input->post('category_id');
		$sub_cate_id=$this->input->post('sub_category_id');
		$order_by=$this->input->post('order_by');
		
		
		
		$f_size=$f_color=$f_price=$f_print=$size_value=$color_value=$price_value=$print_value=array();
		$price_filter =array();
		$i="0";
		$data['statusCode']="0";
		$data['message']="Zero record found please try again";
		//$data['selected_data']['print']= $data['selected_data']['color']=$data['selected_data']['price']= $data['selected_data']['size']=
		$t_price=array();
		
			
			$price=$this->input->post('price',true);			
			$print=$this->input->post('print',true);
			$size=$this->input->post('size',true);
			$color=$this->input->post('color',true);
			
			
			
			
			
			
			/// ,product.product_name as product_name
			
			$this->db->select('filter_product_list.product_id as 	product_id, filter_product_list.size as size ,filter_product_list.color as color ,filter_product_list.price as price, filter_product_list.print as print, product_images.image_url as image_url, product_images.image_thumbnail_url as image_thumbnail_url');	

			if(is_numeric($cate_id)){	
				$this->db->where('filter_product_list.cate_id',$cate_id);
			}
			
			/// $price
			// SELECT * FROM `filter_product_list` WHERE ((`price`>'0' and `price`<'40000' ) or (`price`>'76100' and `price`<'122600' )) and `cate_id`='159'
			
			
			if(is_array($price)&&(count($price)>'0')){
			
				$where_price="(";
				foreach($price as $fil_price){
					$explod_data=explode('-',$fil_price);					
					//$t_price[]=$explod_data['0'];
					//$t_price[]=$explod_data['1'];
					$where_price.="(filter_product_list.price>='$explod_data[0]' and filter_product_list.price<='$explod_data[1]' ) or ";
				}
				$where_price=trim(substr( $where_price, 0, -4 ));
				$where_price.=")";
				 $this->db->where($where_price);
			}
			
			
			
			if(is_array($color)&&(count($color)>'0')){
			
			//$data['selected_data']['color']=$color;
			
				$where_color="(";
				foreach($color as $fil_color){
					$where_color.="filter_product_list.color='$fil_color' or ";
				}
				 $where_color=trim(substr( $where_color, 0, -4 ));
				$where_color.=")";				
				//$data['where_color']=$where_color;
				$this->db->where($where_color);
			}
			// print
			if(is_array($print)&&(count($print)>'0')){
				
				//$data['selected_data']['print']=$print;
	
				
				$where_print="(";
				foreach($print as $fil_color){
					$where_print.="filter_product_list.print='$fil_color' or ";
				}
				 $where_print=trim(substr( $where_print, 0, -4 ));
				$where_print.=")";				
				//$data['where_print']=$where_print;
				$this->db->where($where_print);
			}
			/// size
			if(is_array($size)&&(count($size)>'0')){
				
			//$data['selected_data']['size']=$size;
				$where_size="(";
				foreach($size as $fil_size){
					$where_size.="filter_product_list.size='$fil_size' or ";
				}
				$where_size=trim(substr( $where_size, 0, -4 ));
				$where_size.=")";				
				//$data['where_size']=$where_size;
				$this->db->where($where_size);
			}
			
			if(is_numeric($sub_cate_id)){
				$this->db->where('filter_product_list.sub_cate_id',$sub_cate_id);
			}
			$this->db->from('filter_product_list');
			$this->db->join('product_images','filter_product_list.product_id=product_images.product_id','left');
			//$this->db->join('product','filter_product_list.product_id=product.product_id','left');
			
			$this->db->where('filter_product_list.is_active','1');
			
			if($order_by=="desc"){
				$this->db->order_by('filter_product_list.price', 'desc');
			} else {
				$this->db->order_by('filter_product_list.price', 'asc');
			}
			$query = $this->db->get('');
			$result= $query->result();
			
			$product_details =$data['products']=array();
			
			foreach($result as $result_row){
				$f_size[$result_row->size]=$result_row->size;
				$f_color[$result_row->color]=$result_row->color;
				$f_price[$result_row->price]=$result_row->price;
				$t_price[]=$result_row->price;
				$f_print[$result_row->print]=$result_row->print;
				
				
				
				
				
				if($result_row->image_url==""){
					//$image_url=base_url().NOIMAGE;
					$image_url='';
				} else {
					if(!isset($product_image[$result_row->product_id])){
						$image_url=base_url().$result_row->image_url;
					} 
				}
				if($result_row->image_thumbnail_url==""){
					$image_thumbnail_url='';
					//$image_thumbnail_url=base_url().NOIMAGE;
				} else {
					if(!isset($product_image[$result_row->product_id])){
						$image_thumbnail_url=base_url().$result_row->image_url;
					} 
				}
				$product_image[$result_row->product_id]=$result_row->product_id;
				if(!isset($product_details[$result_row->product_id])){
				$product_details[$result_row->product_id]=array(
					'product_id'=>$result_row->product_id,				
					'image_url'=>$image_url,
					'image_thumbnail_url'=>$image_thumbnail_url
				);
				}
				
				
			}
			
			
			foreach($product_details as $products_row){
				$data['products'][]=array(
					'product_id'=>$products_row['product_id'],				
					'image_url'=>$products_row['image_url'],
					'image_thumbnail_url'=>$products_row['image_thumbnail_url']
				);
			}
			if(count($t_price)>0){
				$max_price=max($t_price);
				$min_price=min($t_price);
			
			
			//SELECT * FROM `master_price_filter` where min_price>'6000' and  min_price<'70000'
			
			///////////
			
				$this->db->select('price_filter_title');
				$this->db->where('max_price >=',$min_price);
				$this->db->where('min_price <=',$max_price);
			
				$this->db->from('master_price_filter');
				$query_pri = $this->db->get('');
				$result_pri= $query_pri->result();
				foreach($result_pri as $result_pri_row){
					$price_filter[]=$result_pri_row->price_filter_title;
				}
			}
			///////////
			
			
			
			
			foreach($f_size as $v_size){
				$i++;
				$size_value[]=$v_size;	
			}
			foreach($f_color as $v_color){
				$i++;
				$color_value[]=$v_color;	
			}
			foreach($f_price as $v_price){
				$i++;
				$price_value[]=$v_price;	
			}
			foreach($f_print as $v_print){
				$i++;
				$print_value[]=$v_print;	
			}
			
			
			
			
			
			//echo "</pre>";
			if($i!="0"){
				$data['statusCode']="1";
				$data['message']="More then zero product found";
			} 
		//} else {
		//	$data['statusCode']="0";
		//	$data['message']="some data is missing";
		//}
		//$data['filter_data']=array('price'=>$price_filter,'size'=>$size_value,'color'=>$color_value,'print'=>$print_value);
		print_r(json_encode($data));
	}
	
	function filter_option_by_subcat_post(){
		$cate_id=$this->input->post('category_id');
		$sub_cate_id=$this->input->post('sub_category_id');
		$is_all=$this->input->post('is_all');
		$f_size=$f_color=$f_price=$f_print=$size_value=$color_value=$price_value=$print_value=array();
		$price_filter =array();
		$i="0";
		$data['statusCode']="1";
		$data['message']="Zero record found please try again";
		//$data['selected_data']['print']= $data['selected_data']['color']=$data['selected_data']['price']= $data['selected_data']['size']=
		
		
		$t_price=$c_b_price_array=	$data['data']['price_selected']= $data['data']['price_available']= $data['data']['price_not_available']= $data['data']['size_selected']= $data['data']['size_available']=$data['data']['size_not_available']=$data['data']['color_selected']= $data['data']['color_available']=$data['data']['color_not_available']=$data['data']['print_selected']= $data['data']['print_available']=$data['data']['print_not_available']=array();

		
		
		
		
		///////////////
		//master_size -- size_id, size_title ,is_active
		//master_price_filter -- price_filter_id, price_filter_title ,min_price,max_price
		//master_print ---- print_id,print_title,is_active
		//master_color ----- color_id , color_title	,is_active
		
		$this->db->select('size,color,price,print');
		$this->db->from('filter_product_list');
		$this->db->where('is_active','1');
		$query1 = $this->db->get('');
		$result1= $query1->result();
		
		
		
		/////////////// according to cate & sub
		$this->db->select('size,color,price,print');
		$this->db->from('filter_product_list');
		$this->db->where('is_active','1');
		if(is_numeric($cate_id)){
			$this->db->where('cate_id',$cate_id);
		}
		if(is_numeric($sub_cate_id)){
			$this->db->where('sub_cate_id',$sub_cate_id);
		}
		$query2 = $this->db->get('');
		$result2= $query2->result();
		
		///////////
		
		
		//if((is_numeric($cate_id))&&(is_numeric($sub_cate_id))){
			$data['selected_data']['category_id']=(int)$cate_id;
			$data['selected_data']['sub_category_id']=(int)$sub_cate_id;
			
			$price=$this->input->post('price',true);
			
			
			
			
			
			
			$print=$this->input->post('print',true);
			$size=$this->input->post('size',true);
			$color=$this->input->post('color',true);
			
			$this->db->select('size,color,price,print');
			
			if(is_numeric($cate_id)){
				$this->db->where('cate_id',$cate_id);
			}
			
			/// $price
			// SELECT * FROM `filter_product_list` WHERE ((`price`>'0' and `price`<'40000' ) or (`price`>'76100' and `price`<'122600' )) and `cate_id`='159'
			
			$selected_s =$selected_color=$selected_print=$selected_fil_price=array();
			if(is_array($price)&&(count($price)>'0')){
				
			
			//$data['selected_data']['price']=$price;
			
				
				
				$where_price="(";
				foreach($price as $fil_price){
					
					
					$selected_fil_price[$fil_price]=$fil_price;
					
					$explod_data=explode('-',$fil_price);					
					//$t_price[]=$explod_data['0'];
					//$t_price[]=$explod_data['1'];
					$where_price.="(price>='$explod_data[0]' and price<='$explod_data[1]' ) or ";
				}
				$where_price=trim(substr( $where_price, 0, -4 ));
				$where_price.=")";
				 $this->db->where($where_price);
			}
			
			
			
			if(is_array($color)&&(count($color)>'0')){
			
			//$data['selected_data']['color']=$color;
			
				$where_color="(";
				foreach($color as $fil_color){
					
					
					$selected_color[$fil_color]=$fil_color;
					$where_color.="color='$fil_color' or ";
				}
				 $where_color=trim(substr( $where_color, 0, -4 ));
				$where_color.=")";				
				
				$this->db->where($where_color);
			}
			// print 
			if(is_array($print)&&(count($print)>'0')){
				
				//$data['selected_data']['print']=$print;
	
				
				$where_print="(";
				foreach($print as $fil_color1){
					$selected_print[$fil_color1]=$fil_color1;
					$where_print.="print='$fil_color1' or ";
				}
				 $where_print=trim(substr( $where_print, 0, -4 ));
				$where_print.=")";				
				
				$this->db->where($where_print);
			}
			/// size
			
			if(is_array($size)&&(count($size)>'0')){
				
				
			//$data['selected_data']['size']=$size;
				$where_size="(";
				foreach($size as $fil_size){
					$selected_s[$fil_size]=$fil_size;
					$where_size.="size='$fil_size' or ";
				}
				$where_size=trim(substr( $where_size, 0, -4 ));
				$where_size.=")";				
				
				$this->db->where($where_size);
			}
			
			if(is_numeric($sub_cate_id)){
				$this->db->where('sub_cate_id',$sub_cate_id);
			}
			$this->db->from('filter_product_list');
			$this->db->where('is_active','1');
			$query = $this->db->get('');
			$result= $query->result();
			//echo "<pre>";
			//print_r($result);
			$f_size=$f_color=$f_print=array();
			foreach($result as $result_row){
				
				
				
				$f_size[$result_row->size]=$result_row->size;
				$f_color[$result_row->color]=$result_row->color;
				$f_price[$result_row->price]=$result_row->price;
				$t_price[]=$result_row->price;
				$f_print[$result_row->print]=$result_row->print;
				
			}
			if(count($t_price)>0){
				$max_price=max($t_price);
				$min_price=min($t_price);
			
			
			//SELECT * FROM `master_price_filter` where min_price>'6000' and  min_price<'70000'
			
			///////////
			
				$this->db->select('price_filter_title');
				$this->db->where('max_price >=',$min_price);
				$this->db->where('min_price <=',$max_price);
			
				$this->db->from('master_price_filter');
				$query_pri = $this->db->get('');
				$result_pri= $query_pri->result();
				foreach($result_pri as $result_pri_row){
					$price_filter[]=$result_pri_row->price_filter_title;
				}
			}
			
			//cate with sub
			
			foreach($result2 as $key1_row1){
				$c_b_size[$key1_row1->size]=$key1_row1->size;
				
				
				
				$c_b_color[$key1_row1->color]=$key1_row1->color;
				$c_b_price[$key1_row1->price]=$key1_row1->price;
				$c_b_price_array[]=$key1_row1->price;
				$c_b_print[$key1_row1->print]=$key1_row1->print;				
				
			}
			
			$c_b_max_price2=max($c_b_price_array);
			$c_b_min_price2=min($c_b_price_array);
			
			$this->db->select('price_filter_title');
			$this->db->where('max_price >=',$c_b_min_price2);
			$this->db->where('min_price <=',$c_b_max_price2);
		
			$this->db->from('master_price_filter');
			$query_pri2 = $this->db->get('');
			$result_pri2= $query_pri2->result();
			foreach($result_pri2 as $result_pri_row2){
				$price_filter2[$result_pri_row2->price_filter_title]=$result_pri_row2->price_filter_title;
			}
			
			/////////////////////////   size,color,price,print    //////////////////////////////////////////////////////
			$all_size=$all_color=$all_price=$all_print=array();
			
			//$f_size=$f_color=$f_print=array(); 
			
			$all_price_array=array();
			
			foreach($result1 as $key_row){
				$all_size[$key_row->size]=$key_row->size;
				
				
				
				$all_color[$key_row->color]=$key_row->color;
				$all_price[$key_row->price]=$key_row->price;
				$all_price_array[]=$key_row->price;
				
				$all_print[$key_row->print]=$key_row->print;				
				//$data['size_sls'][]=array('content'=>$key_row->size,'isSelect'=>'','isSelect'=>'');
			}
			
			$max_price1=max($all_price_array);
			$min_price1=min($all_price_array);
			
			
			$this->db->select('price_filter_title');
			$this->db->where('max_price >=',$min_price1);
			$this->db->where('min_price <=',$max_price1);
		
			$this->db->from('master_price_filter');
			$query_pri1 = $this->db->get('');
			$result_pri1= $query_pri1->result();
			foreach($result_pri1 as $result_pri_row1){
				$price_filter1[$result_pri_row1->price_filter_title]=$result_pri_row1->price_filter_title;
			}
			
			foreach($price_filter1 as $price_filter1_value){
				
				if(isset($selected_fil_price[$price_filter1_value])){					
					$data['data']['price_selected'][]=array('content'=>$price_filter1_value,'isSelect'=>'1','isAvailable'=>'1');			
				} else 				
				if(isset($price_filter2[$price_filter1_value])){
					$data['data']['price_available'][]=array('content'=>$price_filter1_value,'isSelect'=>'0','isAvailable'=>'1');
				} else {
					$data['data']['price_not_available'][]=array('content'=>$price_filter1_value,'isSelect'=>'0','isAvailable'=>'0');
				}
				
			}
			
			foreach($all_size as $all_size_value){
				
				if(isset($selected_s[$all_size_value])){					
					$data['data']['size_selected'][]=array('content'=>$all_size_value,'isSelect'=>'1','isAvailable'=>'1');			
				} else 				
				if(isset($c_b_size[$all_size_value])){
					$data['data']['size_available'][]=array('content'=>$all_size_value,'isSelect'=>'0','isAvailable'=>'1');
				} else {
					$data['data']['size_not_available'][]=array('content'=>$all_size_value,'isSelect'=>'0','isAvailable'=>'0');
				}		
				
			}
			foreach($all_color as $all_color_value){
				
				if(isset($selected_color[$all_color_value])){					
					$data['data']['color_selected'][]=array('content'=>$all_color_value,'isSelect'=>'1','isAvailable'=>'1');			
				} else 				
				if(isset($c_b_color[$all_color_value])){
					$data['data']['color_available'][]=array('content'=>$all_color_value,'isSelect'=>'0','isAvailable'=>'1');
				} else {
					$data['data']['color_not_available'][]=array('content'=>$all_color_value,'isSelect'=>'0','isAvailable'=>'0');
				}		
				
			}
			foreach($all_print as $all_print_value){
				
				if(isset($selected_print[$all_print_value])){					
					$data['data']['print_selected'][]=array('content'=>$all_print_value,'isSelect'=>'1','isAvailable'=>'1');			
				} else 				
				if(isset($c_b_print[$all_print_value])){
					$data['data']['print_available'][]=array('content'=>$all_print_value,'isSelect'=>'0','isAvailable'=>'1');
				} else {
					$data['data']['print_not_available'][]=array('content'=>$all_print_value,'isSelect'=>'0','isAvailable'=>'0');
				}		
				
			}
			
			
			//echo "</pre>";
			if($i!="0"){
				$data['statusCode']="1";
				$data['message']="More then zero filter list";
			} 
		//} else {
		//	$data['statusCode']="0";
		//	$data['message']="some data is missing";
		//}
		//$data['data']=array('price'=>$price_filter,'size'=>$size_value,'color'=>$color_value,'print'=>$print_value);
		print_r(json_encode($data));
	}
	
	function index(){
		$data['data']['price_selected']= $data['data']['price_available']= $data['data']['price_not_available']= $data['data']['size_selected']= $data['data']['size_available']=$data['data']['size_not_available']=$data['data']['color_selected']= $data['data']['color_available']=$data['data']['color_not_available']=$data['data']['print_selected']= $data['data']['print_available']=$data['data']['print_not_available']=array();
		//$data['data']['price_not_available1']=$data['data']['size_not_available1']=$data['data']['print_not_available1']=$data['data']['color_not_available1']=$data['data']['price_available1']=$data['data']['size_available1']=$data['data']['color_available1']=$data['data']['print_available1']
		$cate_id=$this->input->post('category_id');
		$sub_cate_id=$this->input->post('sub_category_id');		
		$price=$this->input->post('price',true);
		$print=$this->input->post('print',true);
		$size=$this->input->post('size',true);
		$color=$this->input->post('color',true);		
		
		$result_color=$this->filter_option_by_subcat_v2($cate_id,$sub_cate_id,$price,$print,$size,null); // color
		if(array($color)&&count($color)>0){
			$result_color['color_available1'];
			foreach($result_color['color_available1'] as $color_available1_value){
				if(in_array($color_available1_value,$color)){
					$data['data']['color_selected'][]=array('content'=>$color_available1_value,'isSelect'=>'1','isAvailable'=>'1');
				} else {
					$data['data']['color_available'][]=array('content'=>$color_available1_value,'isSelect'=>'0','isAvailable'=>'1');
				}
			}
			
			
			//$result_color['color_not_available1'];
			foreach($result_color['color_not_available1'] as $color_not_available1_value){
				if(in_array($color_not_available1_value,$color)){
					$data['data']['color_selected'][]=array('content'=>$color_not_available1_value,'isSelect'=>'1','isAvailable'=>'1');
				} else {
					$data['data']['color_not_available'][]=array('content'=>$color_not_available1_value,'isSelect'=>'0','isAvailable'=>'0');
				}
			}
			
			


			
		} else {
			$data['data']['color_available']=$result_color['color_available'];
			$data['data']['color_selected']=$result_color['color_selected'];
			$data['data']['color_not_available']=$result_color['color_not_available'];			
		}		
		
				
	
		$result_size=$this->filter_option_by_subcat_v2($cate_id,$sub_cate_id,$price,$print,null,$color); //size
				
		if(array($size)&&count($size)>0){
			$result_size['size_available1'];
			foreach($result_size['size_available1'] as $size_available1_value){
				if(in_array($size_available1_value,$size)){
					$data['data']['size_selected'][]=array('content'=>$size_available1_value,'isSelect'=>'1','isAvailable'=>'1');
				} else {
					$data['data']['size_available'][]=array('content'=>$size_available1_value,'isSelect'=>'0','isAvailable'=>'1');
				}
			}	

			$result_size['size_not_available1'];
			foreach($result_size['size_not_available1'] as $size_not_available1_value){
				if(in_array($size_not_available1_value,$size)){
					$data['data']['size_selected'][]=array('content'=>$size_not_available1_value,'isSelect'=>'1','isAvailable'=>'1');
				} else {
					$data['data']['size_not_available'][]=array('content'=>$size_not_available1_value,'isSelect'=>'0','isAvailable'=>'0');
				}
			}
			
		} else {
			$data['data']['size_available']=$result_size['size_available'];
			$data['data']['size_selected']=$result_size['size_selected'];
			$data['data']['size_not_available']=$result_size['size_not_available'];
		}				
		
		
		
		$result_print=$this->filter_option_by_subcat_v2($cate_id,$sub_cate_id,$price,null,$size,$color); //print
				
		if(array($print)&&count($print)>0){
			$result_print['print_available1'];
			foreach($result_print['print_available1'] as $print_available1_value){
				if(in_array($print_available1_value,$print)){
					$data['data']['print_selected'][]=array('content'=>$print_available1_value,'isSelect'=>'1','isAvailable'=>'1');
				} else {
					$data['data']['print_available'][]=array('content'=>$print_available1_value,'isSelect'=>'0','isAvailable'=>'1');
				}
			}
			
			$result_print['print_not_available1'];
			foreach($result_print['print_not_available1'] as $print_not_available1_value){
				if(in_array($print_not_available1_value,$print)){
					$data['data']['print_selected'][]=array('content'=>$print_not_available1_value,'isSelect'=>'1','isAvailable'=>'1');
				} else {
					$data['data']['print_not_available'][]=array('content'=>$print_not_available1_value,'isSelect'=>'0','isAvailable'=>'0');
				}
			}
		} else {
			$data['data']['print_available']=$result_print['print_available'];
			$data['data']['print_selected']=$result_print['print_selected'];
			$data['data']['print_not_available']=$result_print['print_not_available'];
		}
		
		
		
				
		
		$result_price=$this->filter_option_by_subcat_v2($cate_id,$sub_cate_id,null,$print,$size,$color); //price
		if(array($price)&&count($price)>0){
			$result_price['price_available1'];
			foreach($result_price['price_available1'] as $price_available1_value){
				if(in_array($price_available1_value,$price)){
					$data['data']['price_selected'][]=array('content'=>$price_available1_value,'isSelect'=>'1','isAvailable'=>'1');
				} else {
					$data['data']['price_available'][]=array('content'=>$price_available1_value,'isSelect'=>'0','isAvailable'=>'1');
				}
			}

			$result_price['price_not_available1'];
			foreach($result_price['price_not_available1'] as $price_not_available1_value){
				if(in_array($price_not_available1_value,$price)){
					$data['data']['price_selected'][]=array('content'=>$price_not_available1_value,'isSelect'=>'1','isAvailable'=>'1');
				} else {
					$data['data']['price_not_available'][]=array('content'=>$price_not_available1_value,'isSelect'=>'0','isAvailable'=>'0');
				}
			}

			
		} else {
			$data['data']['price_available']=$result_price['price_available'];
			$data['data']['price_selected']=$result_price['price_selected'];
			$data['data']['price_not_available']=$result_price['price_not_available'];	
		}
		
			
		
				
		if((count($result_price['price_available'])<1)&&(count($result_print['print_available'])<1)&&(count($result_size['size_available'])<1)&&(count($result_color['color_available'])<1)){
			$data['statusCode']="0";
			$data['message']="zero filter list";
		} else {
			$data['statusCode']="1";
			$data['message']="More then zero filter list";
		}
		echo"<pre>";
		print_r($data);
		echo"</pre>";
		return $data;
	}
	
	function filter_option_by_subcat_v2($cate_id,$sub_cate_id,$price,$print,$size,$color){
		
		
		
		$is_all=$this->input->post('is_all');
		$f_size=$f_color=$f_price=$f_print=$size_value=$color_value=$price_value=$print_value=array();
		$price_filter =array();
		$i="0";
		$data['statusCode']="1";
		$data['message']="Zero record found please try again";
	
		$t_price=$c_b_price_array=	$data['data']['price_selected']= $data['data']['price_available']= $data['data']['price_not_available']= $data['data']['size_selected']= $data['data']['size_available']=$data['data']['size_not_available']=$data['data']['color_selected']= $data['data']['color_available']=$data['data']['color_not_available']=$data['data']['print_selected']= $data['data']['print_available']=$data['data']['print_not_available']=$data['data']['price_not_available1']=$data['data']['size_not_available1']=$data['data']['print_not_available1']=$data['data']['color_not_available1']=$data['data']['price_available1']=$data['data']['size_available1']=$data['data']['color_available1']=$data['data']['print_available1']=array();

		$this->db->select('size,color,price,print');
		$this->db->from('filter_product_list');
		$this->db->where('is_active','1');
		$query1 = $this->db->get('');
		$result1= $query1->result();
		
		
		
		/////////////// according to cate & sub
		$this->db->select('size,color,price,print');
		$this->db->from('filter_product_list');
		$this->db->where('is_active','1');
		if(is_numeric($cate_id)){
			$this->db->where('cate_id',$cate_id);
		}
		if(is_numeric($sub_cate_id)){
			$this->db->where('sub_cate_id',$sub_cate_id);
		}
		$query2 = $this->db->get('');
		$result2= $query2->result();
		
		///////////
		
		
		//if((is_numeric($cate_id))&&(is_numeric($sub_cate_id))){
			$data['selected_data']['category_id']=(int)$cate_id;
			$data['selected_data']['sub_category_id']=(int)$sub_cate_id;
			
			
			
			$this->db->select('size,color,price,print');
			
			if(is_numeric($cate_id)){
				$this->db->where('cate_id',$cate_id);
			}
			
			/// $price
			// SELECT * FROM `filter_product_list` WHERE ((`price`>'0' and `price`<'40000' ) or (`price`>'76100' and `price`<'122600' )) and `cate_id`='159'
			
			$selected_s =$selected_color=$selected_print=$selected_fil_price=array();
			if(is_array($price)&&(count($price)>'0')){
			
				$where_price="(";
				foreach($price as $fil_price){
					
					
					$selected_fil_price[$fil_price]=$fil_price;
					
					$explod_data=explode('-',$fil_price);					
					//$t_price[]=$explod_data['0'];
					//$t_price[]=$explod_data['1'];
					$where_price.="(price>='$explod_data[0]' and price<='$explod_data[1]' ) or ";
				}
				$where_price=trim(substr( $where_price, 0, -4 ));
				$where_price.=")";
				 $this->db->where($where_price);
			}
			
			
			
			if(is_array($color)&&(count($color)>'0')){
			
				$where_color="(";
				foreach($color as $fil_color){
					
					
					$selected_color[$fil_color]=$fil_color;
					$where_color.="color='$fil_color' or ";
				}
				 $where_color=trim(substr( $where_color, 0, -4 ));
				$where_color.=")";				
				
				$this->db->where($where_color);
			}
			// print 
			if(is_array($print)&&(count($print)>'0')){
				
				$where_print="(";
				foreach($print as $fil_color1){
					$selected_print[$fil_color1]=$fil_color1;
					$where_print.="print='$fil_color1' or ";
				}
				 $where_print=trim(substr( $where_print, 0, -4 ));
				$where_print.=")";				
				
				$this->db->where($where_print);
			}
			/// size
			
			if(is_array($size)&&(count($size)>'0')){
				
				
			//$data['selected_data']['size']=$size;
				$where_size="(";
				foreach($size as $fil_size){
					$selected_s[$fil_size]=$fil_size;
					$where_size.="size='$fil_size' or ";
				}
				$where_size=trim(substr( $where_size, 0, -4 ));
				$where_size.=")";				
				
				$this->db->where($where_size);
			}
			
			if(is_numeric($sub_cate_id)){
				$this->db->where('sub_cate_id',$sub_cate_id);
			}
			$this->db->from('filter_product_list');
			$this->db->where('is_active','1');
			$query = $this->db->get('');
			$result= $query->result();
			//echo "<pre>";
			//print_r($result);
			$f_size=$f_color=$f_print=array();
			foreach($result as $result_row){
			
				$f_size[$result_row->size]=$result_row->size;
				$f_color[$result_row->color]=$result_row->color;
				$f_price[$result_row->price]=$result_row->price;
				$t_price[]=$result_row->price;
				$f_print[$result_row->print]=$result_row->print;
				
			}
			if(count($t_price)>0){
				$max_price=max($t_price);
				$min_price=min($t_price);
			
			
			//SELECT * FROM `master_price_filter` where min_price>'6000' and  min_price<'70000'
			
			///////////
			
				$this->db->select('price_filter_title');
				$this->db->where('max_price >=',$min_price);
				$this->db->where('min_price <=',$max_price);
			
				$this->db->from('master_price_filter');
				$query_pri = $this->db->get('');
				$result_pri= $query_pri->result();
				foreach($result_pri as $result_pri_row){
					$price_filter[]=$result_pri_row->price_filter_title;
					$price_filter2222[$result_pri_row->price_filter_title]=$result_pri_row->price_filter_title;
				}
			}
			
			//cate with sub
			
			foreach($result2 as $key1_row1){
				$c_b_size[$key1_row1->size]=$key1_row1->size;
				
				
				
				$c_b_color[$key1_row1->color]=$key1_row1->color;
				$c_b_price[$key1_row1->price]=$key1_row1->price;
				$c_b_price_array[]=$key1_row1->price;
				$c_b_print[$key1_row1->print]=$key1_row1->print;				
				
			}
			if(isset($c_b_price_array))
			{
			$c_b_max_price2=max($c_b_price_array);
			$c_b_min_price2=min($c_b_price_array);	
			}
			
			
			$this->db->select('price_filter_title');
			$this->db->where('max_price >=',$c_b_min_price2);
			$this->db->where('min_price <=',$c_b_max_price2);
		
			$this->db->from('master_price_filter');
			$query_pri2 = $this->db->get('');
			$result_pri2= $query_pri2->result();
			foreach($result_pri2 as $result_pri_row2){
				$price_filter2[$result_pri_row2->price_filter_title]=$result_pri_row2->price_filter_title;
			}
			
			/////////////////////////   size,color,price,print    //////////////////////////////////////////////////////
			$all_size=$all_color=$all_price=$all_print=array();
			
			$all_price_array=array(); 
			
			
			
			foreach($result1 as $key_row){
				$all_size[$key_row->size]=$key_row->size;
				
				
				
				$all_color[$key_row->color]=$key_row->color;
				$all_price[$key_row->price]=$key_row->price;
				$all_price_array[]=$key_row->price;
				
				$all_print[$key_row->print]=$key_row->print;				
				//$data['size_sls'][]=array('content'=>$key_row->size,'isSelect'=>'','isSelect'=>'');
			}
			if(isset($all_price_array) && count($all_price_array)>0)
			{
			$max_price1=max($all_price_array);
			$min_price1=min($all_price_array);
			}
			
			$this->db->select('price_filter_title');
			$this->db->where('max_price >=',$min_price1);
			$this->db->where('min_price <=',$max_price1);
		
			$this->db->from('master_price_filter');
			$query_pri1 = $this->db->get('');
			$result_pri1= $query_pri1->result();
			foreach($result_pri1 as $result_pri_row1){
				$price_filter1[$result_pri_row1->price_filter_title]=$result_pri_row1->price_filter_title;
			}
			
			foreach($price_filter1 as $price_filter1_value){
				
				if(isset($selected_fil_price[$price_filter1_value])){					
					$data['data']['price_selected'][]=array('content'=>$price_filter1_value,'isSelect'=>'1','isAvailable'=>'1');			
				} else 				
				if(isset($price_filter2222[$price_filter1_value])){
					$data['data']['price_available1'][]=$price_filter1_value;
					
					$data['data']['price_available'][]=array('content'=>$price_filter1_value,'isSelect'=>'0','isAvailable'=>'1');
				} else {
					$data['data']['price_not_available1'][]=$price_filter1_value;
					$data['data']['price_not_available'][]=array('content'=>$price_filter1_value,'isSelect'=>'0','isAvailable'=>'0');
				}
				
			}
			
			foreach($all_size as $all_size_value){
				
				if(isset($selected_s[$all_size_value])){					
					$data['data']['size_selected'][]=array('content'=>$all_size_value,'isSelect'=>'1','isAvailable'=>'1');			
				} else 				
				if(isset($f_size[$all_size_value])){
					$data['data']['size_available1'][]=$all_size_value;
					$data['data']['size_available'][]=array('content'=>$all_size_value,'isSelect'=>'0','isAvailable'=>'1');
				} else {
					$data['data']['size_not_available1'][]=$all_size_value;
					$data['data']['size_not_available'][]=array('content'=>$all_size_value,'isSelect'=>'0','isAvailable'=>'0');
				}		
				
			}
			foreach($all_color as $all_color_value){
				
				if(isset($selected_color[$all_color_value])){					
					$data['data']['color_selected'][]=array('content'=>$all_color_value,'isSelect'=>'1','isAvailable'=>'1');			
				} else 				
				if(isset($f_color[$all_color_value])){
					$data['data']['color_available1'][]=$all_color_value;
					$data['data']['color_available'][]=array('content'=>$all_color_value,'isSelect'=>'0','isAvailable'=>'1');
				} else {
					$data['data']['color_not_available1'][]=$all_color_value;
					$data['data']['color_not_available'][]=array('content'=>$all_color_value,'isSelect'=>'0','isAvailable'=>'0');
				}		
				
			}
			foreach($all_print as $all_print_value){
				
				if(isset($selected_print[$all_print_value])){					
					$data['data']['print_selected'][]=array('content'=>$all_print_value,'isSelect'=>'1','isAvailable'=>'1');			
				} else 				
				if(isset($f_print[$all_print_value])){
					$data['data']['print_available1'][]=$all_print_value;
					$data['data']['print_available'][]=array('content'=>$all_print_value,'isSelect'=>'0','isAvailable'=>'1');
				} else {
					
					$data['data']['print_not_available1'][]=$all_print_value;
					$data['data']['print_not_available'][]=array('content'=>$all_print_value,'isSelect'=>'0','isAvailable'=>'0');
				}		
				
			}
			
		return $data['data'];
		//return (json_encode($data['data']));
	}
	function filter_option_get(){
		$price_val=$size_val=$color_val=$print_val=array();
		$status_code="200";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		/// price
		$this->db->select('price_filter_title');
		$this->db->from('master_price_filter');
		$i="0";
		$query = $this->db->get('');
		$price_attri= $query->result();
		foreach($price_attri as $price_attri_rows){
			$i++;
			$price_val[]=$price_attri_rows->price_filter_title;
		}
		//$data_array=array('price'=>$price_val);
		/// size 
		$this->db->select('size_title');
		
		$this->db->where('is_active','1');
		$this->db->from('master_size');
		$query = $this->db->get('');
		$size_attri= $query->result();
		foreach($size_attri as $size_attri_rows){
			$i++;
			$size_val[]=$size_attri_rows->size_title;
		}
		/// color 
		$this->db->select('color_title');
		
		$this->db->where('is_active','1');
		$this->db->from('master_color');
		$query = $this->db->get('');
		$color_attri= $query->result();
		foreach($color_attri as $color_attri_rows){
			$i++;
			$color_val[]=$color_attri_rows->color_title;
		}
		//print
		$this->db->select('print_title');
		
		$this->db->where('is_active','1');
		$this->db->from('master_print');
		$query = $this->db->get('');
		$print_attri= $query->result();
		foreach($print_attri as $print_attri_rows){
			$i++;
			$print_val[]=$print_attri_rows->print_title;
		}
		
		if($i=="0"){
			$data['statusCode']="0";
			$data['message']="Zero filter list";
		} else {
			$data['statusCode']="1";
			$data['message']="More then zero filter list";			
		}
		
		
		$data['data']=array('price'=>$price_val,'size'=>$size_val,'color'=>$color_val,'print'=>$print_val);
		
		
		print_r(json_encode($data));
		
	}
	
	function filter_post(){
		$status_code="200";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		
		$price=trim($this->input->post('price',true));
		$print=trim($this->input->post('print',true));
		$size=trim($this->input->post('size',true));
		$color=trim($this->input->post('color',true));
		
		
		
		
		
		
		if(($price!="")||($print!="")||($size!="")||($color!="")){
			//// select
			$this->db->select('attribute_id,attribute_name');
			$this->db->from('attribute');
			$this->db->order_by('sort_order','desc');
			$query = $this->db->get('');
			$pro_attri= array();
			
			$result_data = $query->result() ;
			echo "<pre>";
			print_r($result_data);
			
			foreach($result_data as $rows){
				$pro_attri[$rows->attribute_name]=$rows->attribute_id;
				//$rows->attribute_name;
			}
			
			echo "</pre>";
//			$conditions = '((`username`="'.$username.'" )OR `email`="'.$email.' OR `mobile`="'.$mobile.'"') AND `password`="'.$password.'"';          

			if($price!==""){
				$price_id="";
				if(isset($pro_attri['price'])){
					$price_id=$pro_attri['price'];
				}
				if(isset($pro_attri['Price'])){
					$price_id=$pro_attri['Price'];
				}
				if(isset($pro_attri['PRICE'])){
					$price_id=$pro_attri['PRICE'];
				}
				$conditions="'(";
				foreach($price as $price_row){
					$price_exp=explode('-',$price_row);
					//$price_exp['0'];
					//$price_exp['1'];
					
					$conditions.="(`username`=".$price_id." and `username`>=".$price_exp['0']." and `username`<=".$price_exp['1'].") OR";
					
					
					
				}
				//echo $conditions
			
			}
			if($print!==""){
				
			}
			if($size!==""){
				
			}
			if($color!==""){
				
			}
			echo "eeeeeeeeeeeeeeeeeee";
		}
		
		
		
		
		
		
	}
	function order_placed_post(){
		$status_code="200";
		$user_id=$this->input->post('user_id');
		$api_key=$this->input->post('api_key');
		$cart_id=$this->input->post('cart_id');
		
		$data['statusCode']=0;
		if(is_numeric($user_id)&&is_array($cart_id)){
			
			foreach($cart_id as $c_id){
				$update_data[]= array(				
				'id'=>$c_id,
				'user_id'=>$user_id,
				'cart_status'=>'order_placed'				
				);
			}
			$this->db->update_batch('cart',$update_data, 'id','user_id');   
			
			
			$afftected_rows = $this->db->affected_rows();
			if($afftected_rows!=0){
				$data['statusCode']=1;
				$data['message']='Order placed successfully';
			} else{
				$data['message']='Invalid cart_id';
			}
			
		} else {
			$data['message']='Some data is missing';
		}
		//$this->response($data,$status_code);
		echo json_encode($data);
	}
	
	
	
	
	
	}
?>      