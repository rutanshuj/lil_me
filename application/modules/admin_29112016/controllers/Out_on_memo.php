<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email  stock
class Out_on_memo extends Admin_Controller {
	public $page='out_on_memo';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('Out_on_memo_model');
		$this->load->library('session');
	
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		 
		
	}
	
	public function reject(){
		/// out_on_memo/memo_requests
		///SuccessMemo request has been rejected
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$out_on_memo_id=$this->input->get('id',true);
		
		
		$this->load->helper('email');
	
		$memo_reject = $this->config->item('memo_reject');		
		
		
		
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From: ".$memo_reject['email']."" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		
		
		$email=trim($this->input->get('email',true));
	
		$fullname=trim($this->input->get('fullname',true));
		if(is_numeric($out_on_memo_id)){			
			$data_update = array(
               'status' => 'reject',
               'request' => '0',
               'updated_on' => date("Y-m-d H:i:s"),
               'updated_by' => $data['username']
            );
			$this->Out_on_memo_model->memo_reject($out_on_memo_id,$data_update);
			$this->session->set_flashdata('success', 'Success: Memo request has been rejected');
			if(valid_email($email)){
				$memo_reject['body']= str_replace("FULLNAME",$fullname,$memo_reject['body']);
				
				mail($email,$memo_reject['subject'],$memo_reject['body'],$headers);	
			}
			redirect('admin/out_on_memo/memo_requests');	
		}
		
	}
	public function index(){
		/// Memo Dashboard		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$current_date=date("Y-m-d");
		$data['due_today'] = $this->Out_on_memo_model->get_Due_memo($current_date,'request');
		
		
		$data['out_on_memo'] = $this->Out_on_memo_model->get_Due_memo(Null,'approve','1');
		/* echo"<pre>";
		print_r($data['out_on_memo']);
		exit; */
		/// Due Today --- current date 
		/// Out On Memo --- approve ,request = 1 if Expired On missing then +7 days
		
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('memo_dashboard_view', $data);
		
		$this->load->view('footer', $data);
		
	}
	public function memo_requests(){
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$data['memo_requests'] = $this->Out_on_memo_model->get_Due_memo(null,'request',null);
		$data['total_memo_request']=count($data['memo_requests']);
		
		/* 
		echo"<pre>";
		print_r($data);
		exit; */
		$success_m =$this->session->userdata('success');
		 $error_m =$this->session->userdata('error');
		 
		 
		 if(isset($success_m)&&($success_m !="")){
			$data['success']=$success_m;			
			$this->session->unset_userdata('success');
		}		
        if(isset($error_m)&&($error_m !="")){
			$data['error']=$error_m;			
			$this->session->unset_userdata('error');
		}
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('memo_requests_view', $data);
		
		$this->load->view('footer', $data);
	}
	
	public function on_memo_status_return(){
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$out_on_memo_id=$this->input->get('id',true);
		if(is_numeric($out_on_memo_id)){			
			$data_update = array(
               'status' => 'return',
               'request' => '0',
               'updated_on' => date("Y-m-d H:i:s"),
               'updated_by' => $data['username']
            );
			$this->Out_on_memo_model->memo_reject($out_on_memo_id,$data_update);
			$this->session->set_flashdata('success', 'Success: Memo request has been changed');
			redirect('admin/out_on_memo/on_memo_status');	
		}
	}
	
	public function on_memo_status_sole(){
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$out_on_memo_id=$this->input->get('id',true);
		$product_id=$this->input->get('product_id',true);
		if(is_numeric($out_on_memo_id)){			
			$data_update = array(
               'status' => 'sold',
               'request' => '0',
               'updated_on' => date("Y-m-d H:i:s"),
               'updated_by' => $data['username']
            );
			$this->Out_on_memo_model->memo_reject($out_on_memo_id,$data_update);
			
			$product_update = array(
               'status' => 'SOLD',              
               'updated_on' => date("Y-m-d H:i:s"),
               'updated_by' => $data['username']
            );
			$this->db->where('product_id', $product_id);
			$this->db->update('product', $product_update); 
			
			
			
			
			
			
			
			$this->session->set_flashdata('success', 'Success: Product has been sold');
			redirect('admin/out_on_memo/on_memo_status');	
		}
	}
	
	public function approve(){
		$memo_requests_date = $this->input->post("memo_requests_date",true);
		
		$expiry_date = $this->input->post("expiry_date",true);
		$product_name = $this->input->post("product_name",true);
		$memo_id = $this->input->post("memo_id",true);
		$product_id = $this->input->post("product_id",true);
		$fullname = $this->input->post("fullname",true);
		
		$this->load->helper('email');
	
		$memo_accept = $this->config->item('memo_accept');		
		//$headers = "From: ".$memo_accept['email']."" . "\r\n" ;
		
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From: ".$memo_accept['email']."" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		
		
		$email=trim($this->input->post('email',true));

		
		
		
		$data['username'] = trim($this->session->userdata('username'));	
		if(isset($memo_requests_date) && isset($memo_id)){
			$data_update = array(
               'memo_request_date' => $memo_requests_date,               
               'request_approve_date' => $memo_requests_date,               
               'expiry_date' => $expiry_date,               
               'status' => 'approve',               
               'updated_on' => date("Y-m-d H:i:s"),
               'updated_by' => $data['username']
            );
			$this->db->where('out_on_memo_id',$memo_id);
			
			$this->db->update('out_on_memo',$data_update); 
			
			
			$product_update = array(
               'status' => 'OUT ON MEMO',              
               'updated_on' => date("Y-m-d H:i:s"),
               'updated_by' => $data['username']
            );
			$this->db->where('product_id', $product_id);
			$this->db->update('product', $product_update); 
			
			
			
			
			$result['result12']= $this->db->last_query();
			if(valid_email($email)){
				$memo_accept['body']= str_replace("FULLNAME",$fullname,$memo_accept['body']);
				$memo_accept['body']= str_replace("PRODUCTID",$product_name,$memo_accept['body']);
				$memo_accept['body']= str_replace("MEMOREQUESTDATE",date("M-d, Y", strtotime($memo_requests_date)),$memo_accept['body']);
				
				
				
				mail($email,$memo_accept['subject'],$memo_accept['body'],$headers);	
			}
		}
		$this->session->set_userdata('success', 'Memo request has been approve till '.$expiry_date.' for project '.$product_name);
		$result['result']="successfully updated";		
		echo json_encode($result);		
	}
	
	
	
	public function extend(){
		$date_id = $this->input->post("date_id",true);
		$id = $this->input->post("id",true);
		$data['username'] = $this->session->userdata('username');	
		if(isset($date_id) && isset($id)){
			$data_update = array(
               'expiry_date' => $date_id,               
               'updated_on' => date("Y-m-d H:i:s"),
               'updated_by' => $data['username']
            );
			$this->db->where('out_on_memo_id', $id);
			$this->db->update('out_on_memo', $data_update); 
		}
		
		$result['result']="successfully updated";		
		echo json_encode($result);		
	}
	
	public function on_memo_status(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');
		
		/// approve , request =1
		$data['memo_history'] = $this->Out_on_memo_model->get_Due_memo(Null,'approve','1');
		//memo_history_total
		$data['memo_history_total']= count($data['memo_history']);
		// status --- solerequest --- 0 
		/* echo"<pre>"; 
		print_r($data['memo_history']);
		exit; */
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('on_memo_status_view', $data);
		
		$this->load->view('footer', $data);
	}
	public function memo_history(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		//$data['attribute'] = $this->Product_model->get_attribute_field();
		$data['memo_history'] = $this->Out_on_memo_model->get_Due_memo(Null,Null,'0');
		/* echo"<pre>";
		print_r($data['memo_history']);
		exit; */
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('memo_history_view', $data);
		
		$this->load->view('footer', $data);
	}
	
	
	
	public function manual_add_select_user(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		//$data['attribute'] = $this->Product_model->get_attribute_field();
		//// get user 
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('manual_add_view', $data);
		
		$this->load->view('footer', $data);
	}
	public function manual_add_select_product(){
		$data['out_on_memo_user_id'] = $this->session->userdata('out_on_memo_user_id');
		if(!is_numeric($data['out_on_memo_user_id'])){
			redirect('admin/out_on_memo/manual_add');
		}
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		
		
		$submit = $this->input->post('submit',true);
		$product_id = $this->input->post('product_id',true);
		if(array($product_id)&&(isset($submit))){
			if(!empty($product_id)){
				$this->session->set_userdata('out_on_memo_product_id', $product_id);
				redirect('admin/out_on_memo/manual_add_make_memo');
			} else {
				$data['message'] ="Please select at least one checkbox";
			}
		}
		$data['product_select']['0']='0';
		$out_on_memo_product_id = $this->session->userdata('out_on_memo_product_id');
		if(isset($out_on_memo_product_id)&&(is_array($out_on_memo_product_id))){
			foreach($out_on_memo_product_id as $key=>$value){
				$data['product_select'][$key]=$key;
			}
		}
		/* echo "<pre>";
		print_r($data['product_select']);
		exit; */ 
		$data['step_two_product'] = $this->Out_on_memo_model->step_two_product();
		/* echo "<pre>";
		print_r($data['step_two_product']);
		
		/// get product
		exit; */
		$this->load->Model('Category_model');
		$this->load->Model('Sub_category_model');
		$category_list = $this->Category_model->product_category();
		$cate_select="";
		foreach($category_list as $category_list_row){			
			$cate_select .= "<option value=\"".$category_list_row->category_name."\">".$category_list_row->category_name."</option>";		
		}
		
		$sub_category_list = $this->Sub_category_model->sub_category();
		$sub_category_select="";
		foreach($sub_category_list as $sub_category_row){			
			$sub_category_select .= "<option value=\"".$sub_category_row->subcategory_name."\">".$sub_category_row->subcategory_name."</option>";		
		}
		
		
		
		$data['cate_select']=$cate_select;
		$data['sub_category_select']=$sub_category_select;
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('manual_add_step_second_view', $data);
		
		$this->load->view('footer', $data);
	}
	public function manual_add_make_memo(){
		$data['page'] = $this->page;
		
		
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		//$data['attribute'] = $this->Product_model->get_attribute_field();
		// set date
		$submit = trim($this->input->post('submit',true));
		$memo_date = trim($this->input->post('memo_date',true));
		
		
		$expiry_date = trim($this->input->post('expiry_date',true));
		if($submit){
			$data['error']="";
			if($memo_date<date("Y-m-d")){
				$data['error']= "Invalid Memo Date";
			} 
			if($memo_date>$expiry_date){
				$data['error']= "Expiry Date should be greater then Memo Date";
			}
			
			$this->form_validation->set_rules('memo_date', 'Memo Date', 'required');
			$this->form_validation->set_rules('expiry_date', 'Expiry Date', 'required');			
			if (($this->form_validation->run() == True)&&(empty($data['error']))){
				$this->session->set_userdata('memo_date', $memo_date);
				$this->session->set_userdata('expiry_date', $expiry_date);
				redirect('admin/out_on_memo/manual_add_confirmation');
			}
			
			
		}
		$data['out_on_memo_product_id'] = $this->session->userdata('out_on_memo_product_id');
		$data['out_on_memo_user_id'] = $this->session->userdata('out_on_memo_user_id');
		$data['memo_date'] = $this->session->userdata('memo_date');
		$data['expiry_date'] = $this->session->userdata('expiry_date');
		
		/* echo "<pre>";
		print_r($data);
		exit;  */
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('manual_add_make_memo_view', $data);
		
		$this->load->view('footer', $data);
	}
	
	public function memo_sent(){
		
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		
		$data['product_memo_details'] = $this->session->userdata('product_memo_details');
		/* echo"<pre>";
		print_r($data['product_memo_details']);
		exit;
		 */
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('manual_add_memo_sent_view', $data);
		
		$this->load->view('footer', $data);
	}
	
	public function manual_add_confirmation(){
		$data['page'] = $this->page;
		$data['out_on_memo_user_id'] = $this->session->userdata('out_on_memo_user_id');
		$data['username'] = $this->session->userdata('username');
		
		$data['out_on_memo_product_id'] = $this->session->userdata('out_on_memo_product_id');		
		$data['memo_date'] = $this->session->userdata('memo_date');
		$data['expiry_date'] = $this->session->userdata('expiry_date');
		
		
		$data['user_details'] = $this->Out_on_memo_model->user_details_get($data['out_on_memo_user_id']);
		
		foreach($data['user_details'] as $u_details){
			$data['selected_user']=	$u_details->firstname." ".$u_details->lastname ;
		}
		
		
		$result =$this->db->select('product_name')->where_in('product_id', $data['out_on_memo_product_id'])->get('product')->result();
		
		$submit = trim($this->input->post('submit',true));
		if($submit){
			$data_save=$product_memo_details=array();
			$product_status_update = array();
			foreach($data['out_on_memo_product_id'] as $product_value){
				$product_status_update[]=array(
				'product_id'=>$product_value,
				'status'=>'OUT ON MEMO'
				);
			}
			$this->db->update_batch('product',$product_status_update, 'product_id');
						
			foreach($result as $key1=>$value2){
				$product_memo_details[]=array(
					'user_name'=>$data['selected_user'],
					'product_id'=>$value2->product_name,
					'request_sent_on'=>$data['memo_date'],
					'memo_date_requested'=>$data['memo_date'],
					'memo_date_sent'=>$data['memo_date'],
					'expiry_date'=>$data['expiry_date'],
					'current_status'=>'OUT ON MEMO'
				);
			}
			foreach($data['out_on_memo_product_id'] as $key=>$value){

				/* $product_memo_details[]=array(
					'user_name'=>$data['selected_user'],
					'product_id'=>$value,
					'request_sent_on'=>$data['memo_date'],
					'memo_date_requested'=>$data['memo_date'],
					'memo_date_sent'=>$data['memo_date'],
					'expiry_date'=>$data['expiry_date'],
					'current_status'=>'OUT ON MEMO'
				); */
			
				$data_save[]=array(
					'user_id'=>$data['out_on_memo_user_id'],
					'product_id'=>$value,
					'status'=>'approve',
					'quantity'=> '1',
					'memo_request_date'=>$data['memo_date'],
					'request_approve_date'=>$data['memo_date'],
					'expiry_date'=>$data['expiry_date'],
					'request'=>'1',
					'created_on'=>date("Y-m-d H:i:s"),
					'created_by'=>$data['username'],
					'updated_on'=>date("Y-m-d H:i:s"),
					'updated_by'=>$data['username']
				);				
			}
			if(count($data_save)>0){
				//echo "<pre>";
				//print_r($data_save); /// save this on out_on_memo
				
				$this->db->insert_batch('out_on_memo',$data_save);
				
				//print_r($product_memo_details); /// save this on out_on_memo
				$this->session->set_userdata('product_memo_details', $product_memo_details);
				
				$this->session->unset_userdata('out_on_memo_user_id');
				$this->session->unset_userdata('out_on_memo_product_id');
				/// 
				// session free 
				// create session array 
				
				$this->session->set_flashdata('message', 'Successfully Memo added');
				redirect('admin/out_on_memo/memo_sent');	
				
			}
			/* table =out_on_memo
			
			*/
			/* echo "<pre>";
		print_r($data);
		exit;  */
			
		}
		
		/* echo "<pre>";
		print_r($data);
		exit;  */
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		//$data['attribute'] = $this->Product_model->get_attribute_field();
		
		/// confirmation and send 
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('manual_add_confirmation_view', $data);
		
		$this->load->view('footer', $data);
	}
	
	
	
	 public function manual_add(){
		$data['page'] = $this->page;
		
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$data['user_details'] = $this->Out_on_memo_model->user_details_get();
		$user_id = $this->input->post('user_id',true);
		$submit = $this->input->post('submit',true);
		if(isset($submit)&&(is_numeric($user_id))){
			$this->session->set_userdata('out_on_memo_user_id', $user_id);
			redirect('admin/out_on_memo/manual_add_select_product');
		}
		$data['out_on_memo_user_id'] = $this->session->userdata('out_on_memo_user_id');
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('manual_add_step_first_view', $data);
		
		$this->load->view('footer', $data);
	} 
	
	
	
	
	public function edit(){
		$data['page'] = $this->page;
		$attribute_value = array();
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$data['product_id']=$this->input->get('id',true);
		$data['category_id']="";
		$data['attribute'] = $this->Product_model->get_attribute_field();
		$submit=$this->input->post("submit",true);
		if($submit){
			$hot_product_checkbox=$new_product_checkbox="0";
			 $product_name =$update_product['product_name']= trim($this->input->post("product_id",true));
			
			 $new_product_checkbox = trim($this->input->post("new_product_checkbox",true));
			
			 $hot_product_checkbox = trim($this->input->post("hot_product_checkbox",true));
			
			 $new_product_checkbox =$update_product['is_new']=  ($new_product_checkbox==1) ? 1 : 0;
			
			 $hot_product_checkbox =$update_product['is_hot']=  ($hot_product_checkbox==1) ? 1 : 0;
			
			
			
			
			$category_id =$update_product['category_id']=   trim($this->input->post("category_id",true));			
			$sub_category =$update_product['subcategory_id']=  trim($this->input->post("sub_category",true));			
			$describe =$update_product['description']=   trim($this->input->post("describe",true));
			
			$this->form_validation->set_rules('product_id', 'Product Name', 'required');
			$this->form_validation->set_rules('category_id', 'category', 'required');
			$this->form_validation->set_rules('sub_category', 'sub-category', 'required');
			
			$product_attribute_save = array();
			if ($this->form_validation->run() == True){
				
				$update_product['created_by']=$data['username'];
								
				
				$this->db->where('product_id', $data['product_id']);
				$this->db->update('product', $update_product); 
				
				$insert_id = $data['product_id'];				
				/* $count = count($_FILES['multi_upload']['name']);
				
				if($count!="0"){					
					$config['upload_path'] = CATEGORY_IMAGE_UPLOAD;
					$config['allowed_types'] = MARKET_NEWS_IMAGE_TYPE;
					$config['max_size']	= CATEGORY_IMAGE_MAX_SIZE;
					$config['max_width']  = CATEGORY_IMAGE_MAX_WIDTH;				
					$config['max_height']  = CATEGORY_IMAGE_MAX_HEIGHT;
					$this->load->library('upload', $config);
										
					for($i=0;$i<$count;$i++){
															
						
						$_FILES['userfile']['name']= $_FILES['multi_upload']['name'][$i];
						$_FILES['userfile']['type']= $_FILES['multi_upload']['type'][$i];
						$_FILES['userfile']['tmp_name']= $_FILES['multi_upload']['tmp_name'][$i];
						$_FILES['userfile']['error']= $_FILES['multi_upload']['error'][$i];
						$_FILES['userfile']['size']= $_FILES['multi_upload']['size'][$i];
						$config['file_name'] = $save_product['product_name'].str_pad($i, 3, '0', STR_PAD_LEFT);		
						$this->upload->initialize($config);
						
						if ( ! $this->upload->do_upload()) {				
							$error[] = array('error' => $this->upload->display_errors());	
						}  else {					
							$image_data = $this->upload->data();							
							$data_save['image_url']=$image_location=CATEGORY_IMAGE_UPLOAD.$image_data['file_name'];					
							$thumbpath=CATEGORY_IMAGE_UPLOAD.$image_data['raw_name'].'_thumbnail'.$image_data['file_ext'];
							
							$data_save['image_thumbnail_url']=$thumbpath;
							
							
							$this->make_thumbnails->create_thumbnails($data_save['image_url'],$thumbpath,THUMBNAIL_IMAGE_MAX_WIDTH,THUMBNAIL_IMAGE_MAX_HEIGHT);			
							
							 $product_images_save[]=array(
								'image_url'=>$data_save['image_url'],
								'image_thumbnail_url'=>$data_save['image_thumbnail_url'],
								'product_id'=>$insert_id,
								'created_on'=>date("Y-m-d H:i:s"),
								'created_by'=>$data['username'],
								'updated_on'=>date("Y-m-d H:i:s"),
								'updated_by'=>$data['username']
							);	
						}
					}
					$this->db->insert_batch('product_images', $product_images_save); 						
				} */				
				$product_attribute = $this->input->post("product_attribute",true);
				
				foreach($product_attribute as $key=>$value){
					if(!empty($value)){
						$product_attribute_save[]=array(						
							'attribute_id'=>$key,
							'product_id'=>$insert_id,
							'attribute_value'=>$value,
							'updated_by'=>$data['username'],
							'updated_on'=>date("Y-m-d H:i:s")
						);						
					}					
				}
				$this->db->where('product_id', $insert_id)->delete('attribute_value');

				if(!empty($value)){
					$this->db->insert_batch('attribute_value', $product_attribute_save); 
				}
				
				$this->session->set_flashdata('message', 'Success Product '.$product_id.' was updated');
				redirect('admin/product/edit?id='.$data['product_id']);				
			}			
		}		
		
		$data['product_images']=$this->Product_model->product_images($data['product_id']);		
		
		$product_details = $this->Product_model->get_product_details($data['product_id']);
		
		
		
		foreach($product_details as $product_row){
			$data['product_name']=$product_row->product_name;
			$data['category_id']=$product_row->category_id;
			$data['subcategory_id']=$product_row->subcategory_id;
			$data['description']=$product_row->description;
			$data['is_hot']=$product_row->is_hot;
			$data['is_new']=$product_row->is_new;
		}
		$sub_cate_data="";
		if(is_numeric($data['category_id'])){
			$sub_cat_array = $this->Sub_category_model->get_sub_cate_by_cate_id($data['category_id']);
			foreach($sub_cat_array as $sub_cat_row){
				$selected="";
				
				if($data['subcategory_id']==$sub_cat_row->subcategory_id){
					$selected="selected";					
				}
				$sub_cate_data.="<option value='$sub_cat_row->subcategory_id' $selected>".$sub_cat_row->subcategory_name."</option>";
				
			}			
		}
		$data['sub_cate_data']=$sub_cate_data;
		
		
		$attribute_data = $this->Product_model->product_attribute_value($data['product_id']);
		foreach($attribute_data as $attribute_row){			
			$attribute_value[$attribute_row->attribute_id]=$attribute_row->attribute_value;
		}
		$data['attribute_value']=$attribute_value;
		
		$data['category_list'] = $this->Category_model->product_category();
		
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('product_edit_view', $data);
		
		$this->load->view('footer', $data);
		
	}
	
	
	public function get_product_ids(){
		$sub_category_id = $this->input->post("sub_category_id",true);
		$product_data="";
		$product_array = $this->Product_model->get_product_by_sub_category($sub_category_id);
		
		$product_data.="<option value=''>--select--</option>";
		
		if(count($product_array)>0){
			foreach($product_array as $product_row){
				$product_data.="<option value='$product_row->product_id'>".$product_row->product_name."</option>";			 
			}
		} else {
			$product_data.="<option value=''>Please select another Category</option>";
		}		 
		echo $product_data;
		
	}
	public function get_sub_category_ids(){
		$category_id = $this->input->post("category_id",true);
		 
		$sub_cate_data="";
		$sub_cate = $this->Sub_category_model->get_sub_cate_by_cate_id($category_id);
		$sub_cate_data.="<option value=''>--select--</option>";
		if(count($sub_cate)>0){
			foreach($sub_cate as $sub_cate_row){
				$sub_cate_data.="<option value='$sub_cate_row->subcategory_id'>".$sub_cate_row->subcategory_name."</option>";			 
			}
		} else {
			$sub_cate_data.="<option value=''>Please select another Category</option>";
		}		 
		$result['sub_cate_data']=$sub_cate_data;
		///////
				
		$product_data="";
		$product_array = $this->Product_model->get_product_by_sub_category('A',$category_id);
		
		$product_data.="<option value=''>--select--</option>";
		
		if(count($product_array)>0){
			foreach($product_array as $product_row){
				$product_data.="<option value='$product_row->product_id'>".$product_row->product_name."</option>";			 
			}
		} else {
			$product_data.="<option value=''>Please select another Category</option>";
		}		 
		
		$result['product_data']=$product_data;
		
		
		
		echo json_encode($result);
		
	}	
	public function index1(){
		$this->load->library('make_thumbnails');
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$data['attribute'] = $this->Product_model->get_attribute_field();
		$data['category_list'] = $this->Category_model->product_category();
		
		
		$submit = $this->input->post("submit",true);
		if($submit){
			$hot_product_checkbox=$new_product_checkbox="0";
			 $product_id =$save_product['product_name']= trim($this->input->post("product_id",true));
			
			 $new_product_checkbox = trim($this->input->post("new_product_checkbox",true));
			
			 $hot_product_checkbox = trim($this->input->post("hot_product_checkbox",true));
			
			 $new_product_checkbox =$save_product['is_new']=  ($new_product_checkbox==1) ? 1 : 0;
			
			 $hot_product_checkbox =$save_product['is_hot']=  ($hot_product_checkbox==1) ? 1 : 0;
			
			
			
			
			$category_id =$save_product['category_id']=   trim($this->input->post("category_id",true));			
			$sub_category =$save_product['subcategory_id']=  trim($this->input->post("sub_category",true));			
			$describe =$save_product['description']=   trim($this->input->post("describe",true));
			
			$this->form_validation->set_rules('product_id', 'Product Name', 'required');
			$this->form_validation->set_rules('category_id', 'category', 'required');
			$this->form_validation->set_rules('sub_category', 'sub-category', 'required');
			
			$product_attribute_save = array();
			if ($this->form_validation->run() == True){
				
				$save_product['created_by']=$data['username'];
				
				$this->db->insert('product', $save_product); 
				$insert_id = $this->db->insert_id();				
				$count = count($_FILES['multi_upload']['name']);
				
				if($count!="0"){					
					$config['upload_path'] = CATEGORY_IMAGE_UPLOAD;
					$config['allowed_types'] = MARKET_NEWS_IMAGE_TYPE;
					$config['max_size']	= CATEGORY_IMAGE_MAX_SIZE;
					$config['max_width']  = CATEGORY_IMAGE_MAX_WIDTH;				
					$config['max_height']  = CATEGORY_IMAGE_MAX_HEIGHT;
					$this->load->library('upload', $config);
										
					for($i=0;$i<$count;$i++){
															
						
						$_FILES['userfile']['name']= $_FILES['multi_upload']['name'][$i];
						$_FILES['userfile']['type']= $_FILES['multi_upload']['type'][$i];
						$_FILES['userfile']['tmp_name']= $_FILES['multi_upload']['tmp_name'][$i];
						$_FILES['userfile']['error']= $_FILES['multi_upload']['error'][$i];
						$_FILES['userfile']['size']= $_FILES['multi_upload']['size'][$i];
						$config['file_name'] = $save_product['product_name'].str_pad($i, 3, '0', STR_PAD_LEFT);		
						$this->upload->initialize($config);
						
						if ( ! $this->upload->do_upload()) {				
							$error[] = array('error' => $this->upload->display_errors());	
						}  else {					
							$image_data = $this->upload->data();							
							$data_save['image_url']=$image_location=CATEGORY_IMAGE_UPLOAD.$image_data['file_name'];					
							$thumbpath=CATEGORY_IMAGE_UPLOAD.$image_data['raw_name'].'_thumbnail'.$image_data['file_ext'];
							
							$data_save['image_thumbnail_url']=$thumbpath;
							
							
							$this->make_thumbnails->create_thumbnails($data_save['image_url'],$thumbpath,THUMBNAIL_IMAGE_MAX_WIDTH,THUMBNAIL_IMAGE_MAX_HEIGHT);			
							
							 $product_images_save[]=array(
								'image_url'=>$data_save['image_url'],
								'image_thumbnail_url'=>$data_save['image_thumbnail_url'],
								'product_id'=>$insert_id,
								'created_on'=>date("Y-m-d H:i:s"),
								'created_by'=>$data['username'],
								'updated_on'=>date("Y-m-d H:i:s"),
								'updated_by'=>$data['username']
							);	
						}
					}
					$this->db->insert_batch('product_images', $product_images_save); 						
				}				
				$product_attribute = $this->input->post("product_attribute",true);
				
				foreach($product_attribute as $key=>$value){
					if(!empty($value)){
						$product_attribute_save[]=array(						
							'attribute_id'=>$key,
							'product_id'=>$insert_id,
							'attribute_value'=>$value,
							'updated_by'=>$data['username'],
							'updated_on'=>date("Y-m-d H:i:s")
						);						
					}					
				}
				if(!empty($value)){
					$this->db->insert_batch('attribute_value', $product_attribute_save); 
				}
				$this->session->set_flashdata('message', 'Success Product '.$product_id.' was added');
				redirect('admin/product');
				
			}
			 
			
		}
		
		//product
		/* echo"<pre>";
		print_r($data['category_list']);exit; */
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('product_add_view', $data);
		
		$this->load->view('footer', $data);
	}
	public function update(){
		
	}
	public function product_delete(){
		$data['page'] = $this->page;
		$attribute_value = array();
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$id = $this->session->userdata('id');
		$data['product_id']=$this->input->post('products',true);
		
		$data['category_id']="";
		$data['attribute'] = $this->Product_model->get_attribute_field();
		$submit=$this->input->post("submit",true);
		
		if($submit){		
		
			$this->session->set_flashdata('message', 'Unable to delete, please try again');
			if(is_numeric($data['product_id'])){
				$this->db->where('product_id', $data['product_id'])->delete('attribute_value'); 
				$this->db->where('product_id', $data['product_id'])->delete('product');
				$this->db->where('product_id', $data['product_id'])->delete('product_images');
				
				$this->session->set_flashdata('message', 'Success Product was deleteed');				
			}			
			redirect('admin/product/product_delete');	
		}	
		$data['category_list'] = $this->Category_model->product_category();
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('product_delete_view', $data);		
		$this->load->view('footer', $data);
	}
	
	
	
		
	 
 
	
		
	
}
