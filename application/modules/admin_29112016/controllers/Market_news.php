<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email 
class Market_news extends Admin_Controller {
	public $page='market_news';
	public function __construct() {		
		parent::__construct();
		$user_session = $this->session->userdata('username');			
		if(empty($user_session)) {			
			$this->session->set_flashdata('error', 'Your session has expired');
			redirect();
			exit;			
		}
		$this->username =$this->session->userdata('username');
		$this->load->Model('Market_news_model');
		$this->load->Model('Master_model');
		
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); // use for from validation
		 
		
	}
	
	public function ios_push_notification($message, $devicetoken){
		define("API_ACCESS_KEY", "AIzaSyC_9synajSZ612oPHMJdKwO8xfBXe5tj-c");
		$passphrase = 'joashp';
		$deviceToken = $devicetoken;
		$ctx = stream_context_create();
		// ck.pem is your certificate file
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', self::$passphrase);
		// Open a connection to the APNS server
		$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);
		// Create the payload body
		$body['aps'] = array(
			'alert' => array(
			    
                'body' => $message,
			 ),
			'sound' => 'default'
		);
		// Encode the payload as JSON
		$payload = json_encode($body);
		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));
		
		// Close the connection to the server
		fclose($fp);
		if (!$result)
			return 'Message not delivered' . PHP_EOL;
		else
			return 'Message successfully delivered' . PHP_EOL;
	}
	public function android_push_notification($message,$registrationids){
		define("API_ACCESS_KEY", "AIzaSyC_9synajSZ612oPHMJdKwO8xfBXe5tj-c");
		$msg = array(    
			'msg'   => $message
		);
		 $fields = array(    
			'registration_ids'  => $registrationids,
			'data'          => $msg
		);
		$headers = array(
		
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
		curl_setopt($ch,CURLOPT_POST, true );
		curl_setopt($ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode( $fields ));
		$result = curl_exec($ch);
		curl_close($ch);

	}
	public function index(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');		
		
		$data['user_type']=$this->Master_model->user_type();
		
		
		$submit= trim($this->input->post('submit',true));
		
		
		if($submit){
			$user_type_id= trim($this->input->post('user_type_id',true));
			$data_save['notification']= trim($this->input->post('notification',true));
			$ios_push_notification = array();
			$android_push_notification = array();
			
			$push_notification_users=$this->Market_news_model->notification_user_type($user_type_id);
			$and_de="0";
			foreach($push_notification_users as $push_row){
				if($push_row->device_type=="android"){	
					$and_de++;				
					array_push($android_push_notification, $push_row->gcm_id);
				}
				if($push_row->device_type=="ios"){
					array_push($ios_push_notification, $push_row->device_id);
				}
			}
			
			
			if(!empty($android_push_notification)){
				$this->android_push_notification($data_save['notification'],$android_push_notification);
				
				$this->session->set_flashdata('success', 'Success:: Notified to '.count($android_push_notification).' users and not able to send 0 due to device problem');
				
			}
			if(!empty($ios_push_notification)){
				//$this->android_push_notification($data_save['notification'],$android_push_notification);				
			}
			redirect('admin/market_news');
		}
		
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('push_notification_view', $data);
		$this->load->view('footer', $data);
	}
	
	public function news_delete(){
		$id=trim($this->input->get('id',true));
		$headline=trim($this->input->get('headline',true));
		$message = "Error:: ".$headline." is not deleted, please try again";
		$i="0";
		if(is_numeric($id)){			
			$i++;
			$this->Market_news_model->Market_news_deleted($id);			
			$message = "Successful:: ".$headline." news deleted";		
		} 
		if($i=="0"){
			$this->session->set_flashdata('error', $message);
		} else {
			$this->session->set_flashdata('success', $message);
		}
		
		
		redirect('admin/market_news/manage_news');
	}
	public function manage_news(){
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');		
		
		$data['market_news']=$this->Market_news_model->get_news();
		
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('manage_news_view', $data);
		$this->load->view('footer', $data);
		
		
		
		
	}
	public function edit(){
		$data['page'] = $this->page;
		
		$data['news_id']=$news_id=$this->input->get('id',true);
		if(!is_numeric($news_id)){
			redirect('admin/market_news/manage_news');
		}
		/// get news id
		
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');
		
		
		$data['news_category']=$this->Master_model->news_category();
		$data['news_priority_m']=$this->Master_model->news_priority();
		
		$news_detail =$this->Market_news_model->get_news($news_id);
		foreach($news_detail as $news_row){
			$news_row->news_id;
			$data['news_category_id'] = $news_row->news_category_id;
			$data['news_priority'] = $news_row->priority;
			$data['image_url']= $news_row->image_url;
			$data['headline'] = $news_row->headline;
			$data['news_detail'] =$news_row->details;
			$news_row->news_category_name;
		}
		
		
		
		$submit = $this->input->post("submit",true);
		if($submit){
			$data_update['headline']=$data['headline'] =$headline = trim($this->input->post('headline',true));
			$data_update['details']=$data['news_detail'] =$news_detail = trim($this->input->post('news_detail',true));
			$data_update['news_category']=$data['news_category_id'] =$news_category_id = trim($this->input->post('news_category_id',true));
			$data_update['priority']=$data['news_priority'] = $news_priority = trim($this->input->post('news_priority',true));
			
			

			$this->form_validation->set_rules('headline', 'Headline', 'required');
			$this->form_validation->set_rules('news_detail', 'News Detail', 'required');
			$this->form_validation->set_rules('news_category_id', 'Select News Category', 'required');
			$this->form_validation->set_rules('news_priority', 'News Priority', 'required');
			
			if ($this->form_validation->run() == True){
				$is_error="0";
				$image_location="";
				if (!empty($_FILES['userfile']['name'])) {
					///////////////// 
					$config['upload_path'] = MARKET_NEWS_IMAGE_UPLOAD;
					$config['allowed_types'] = MARKET_NEWS_IMAGE_TYPE;
					$config['max_size']	= MARKET_NEWS_IMAGE_MAX_SIZE;
					$config['max_width']  = MARKET_NEWS_IMAGE_MAX_WIDTH;				
					$config['max_height']  = MARKET_NEWS_IMAGE_MAX_HEIGHT;
					$config['file_name'] = md5(uniqid($_FILES['userfile']['name']));
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload()) {				
						$error = array('error' => $this->upload->display_errors());
						$is_error++;
					}  else {					
						$image_data = $this->upload->data();
						$data_update['image_url']=$data['image_url']=$image_location=MARKET_NEWS_IMAGE_UPLOAD.$image_data['orig_name'];
					}
					///////////
				}
				
				
				
				
				
				
				$data_update['updated_by']=$data['username'];
				$data_update['updated_on']=date("Y-m-d H:i:s");
				
				if($is_error=="0"){									
					$this->db->where('news_id', $news_id);
					$this->db->update('market_news', $data_update);

					
					$this->session->set_flashdata('message', 'Success: Market News news updated');
					$this->session->set_flashdata('success', 'Success: Market News news updated');
					redirect('admin/market_news/edit?id='.$data['news_id']);		
				}
			}else {
				$data['error']="yes";
			}
			
		}
		///////////
		
		///////////
		/* echo "</pre>";
		print_r($data);
		exit; */
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('manage_news_edit_view', $data);
		$this->load->view('footer', $data);
	}
	public function add(){
		
		$data['page'] = $this->page;
		
		$data['username'] = $this->session->userdata('username');
		$data['message'] = $this->session->flashdata('message');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('id');
		
		
		$data['news_category']=$this->Master_model->news_category();
		
		
		
		$submit=$this->input->post('submit',true);
		
		$submit = $this->input->post("submit",true);
		if($submit){
			$data['headline'] =$headline = trim($this->input->post('headline',true));
			$data['news_detail'] =$news_detail = trim($this->input->post('news_detail',true));
			$data['news_category_id'] =$news_category_id = trim($this->input->post('news_category_id',true));
			$data['news_priority'] = $news_priority = trim($this->input->post('news_priority',true));
			
			

			$this->form_validation->set_rules('headline', 'Headline', 'required');
			$this->form_validation->set_rules('news_detail', 'News Detail', 'required');
			$this->form_validation->set_rules('news_category_id', 'Select News Category', 'required');
			$this->form_validation->set_rules('news_priority', 'News Priority', 'required');
			
			if ($this->form_validation->run() == True){	
				$is_error="0";
				$image_location="";
				if (!empty($_FILES['userfile']['name'])) {
					/////////////////  MARKET_NEWS_IMAGE_TYPE
					$config['upload_path'] = MARKET_NEWS_IMAGE_UPLOAD;
					$config['allowed_types'] = MARKET_NEWS_IMAGE_TYPE;
					$config['max_size']	= MARKET_NEWS_IMAGE_MAX_SIZE;
					$config['max_width']  = MARKET_NEWS_IMAGE_MAX_WIDTH;				
					$config['max_height']  = MARKET_NEWS_IMAGE_MAX_HEIGHT;
					$config['file_name'] = md5(uniqid($_FILES['userfile']['name']));
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload()) {				
						$error = array('error' => $this->upload->display_errors());
						$data['error_m'] = $this->upload->display_errors();
						$is_error++;
					}  else {					
						$image_data = $this->upload->data();
						$image_location=MARKET_NEWS_IMAGE_UPLOAD.$image_data['orig_name'];
					}
					///////////
				}
				
				if($is_error=="0"){
					$data_save = array(
					   'news_category' => $news_category_id ,
					   'priority' => $news_priority ,
					   'image_url' => $image_location,
					   'headline' => $headline,
					   'details' => $news_detail,
					   'updated_on' => date("Y-m-d H:i:s"),
					   'created_by' => $data['username']
					   
					);
					
					$this->db->insert('market_news', $data_save); 
					$this->session->set_flashdata('message', 'Success: Market News news added');
					$this->session->set_flashdata('success', 'Success: Market News news added');
					redirect('admin/market_news/add');		
				}
			} else {
				$data['error']="yes";
			}
			
		}
		
		/* echo "</pre>"; 
		print_r($data);
		exit; */
		$this->load->view('header', $data);
		$this->load->view('sub_header', $data);		
		$this->load->view('sidebar', $data);
		$this->load->view('manage_news_add_view', $data);
		$this->load->view('footer', $data);
		
		
	}
	
	

	
	
}
