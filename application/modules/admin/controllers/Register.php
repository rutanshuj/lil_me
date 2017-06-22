<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	public $page='register';
	public function __construct() {
		
	parent::__construct();
		$user_session = $this->session->userdata('username');
		$this->load->helper(array('form', 'url')); 
		$this->load->library('form_validation');
		$this->load->model('master_model');	
		$this->load->model('user_model');	
		if(!empty($user_session)) {				
			redirect('admin/dashboard');
			exit;				
		}		
	}
	public function asdasda(){
		$new_sub_admin_mail =$this->config->item('new_sub_admin_mail');
		$new_sub_admin_mail['subject'];
		$new_sub_admin_mail['body'];
		print_r($sdas);
	}
	public function index() {
		//// get all city 
		$data['master_city'] = $this->master_model->city();
		$city_id= array();
		foreach($data['master_city'] as $key_value){			
			$city_id[$key_value->id]=$key_value->city_name;
		}
		
		$data['first_name']=$first_name = trim($this->input->post("first_name",true));
		$data['last_name']=$last_name = trim($this->input->post("last_name",true));
		$data['password']=$password = trim($this->input->post("password",true));
		$data['re_password']=$re_password = trim($this->input->post("re_password",true));
		$data['email']=$email = trim($this->input->post("email",true));
		$data['p_phone']=$p_phone = trim($this->input->post("p_phone",true));
		$data['s_phone']=$s_phone = trim($this->input->post("s_phone",true));
		$data['city']=$city = trim($this->input->post("city",true));
		$data['username']=$username = trim($this->input->post("username",true));		
		$submit = $this->input->post("submit",true);
		if($submit){
			$mails_body="";
			if(isset($data['username'])){
				$mails_body.="Username : ".$data['username'];
			}
			if(isset($data['first_name'])){
				$mails_body.="<br>Name : ".$data['first_name']." ".$data['last_name'];
			}
			if(isset($data['email'])){
				$mails_body.="<br>Email : ".$data['email'];
			}
			if(isset($data['p_phone'])){
				$mails_body.="<br>Phone : ".$data['p_phone'];
			}
			if(isset($data['city'])){
				
				$mails_body.="<br>City : ".$city_id[$key_value->id];
			}
			
			$this->form_validation->set_rules('first_name', 'Enter Your First Name', 'required');
			//$this->form_validation->set_rules('last_name', 'Enter Your Last Name', 'required');
			$this->form_validation->set_rules('username', 'Enter Username', 'required|is_unique[admin_details.username]');
			//$this->form_validation->set_message('is_unique', '%s already registered, please log in!');
			$this->form_validation->set_rules('password', 'Enter Password', 'required|min_length[6]');
			$this->form_validation->set_rules('re_password', 'Retype Password', 'required|matches[password]');
			$this->form_validation->set_rules('email', 'Enter Your Email Id', 'required|valid_email|is_unique[admin_details.email_id]');
			$this->form_validation->set_rules('p_phone', 'Enter Primary Phone Number', 'required|numeric');
			//$this->form_validation->set_rules('s_phone', 'Enter Secondary Phone Number', 'required');
			$this->form_validation->set_rules('city', 'Select Your City', 'required');
			
			
			if ($this->form_validation->run() == True){ 
		
			 	$data = array(
				   'username' => $data['username'] ,
				   'password' => md5($data['password']) ,
				   'firstname' => $data['first_name'],
				   'lastname' => $data['last_name'],
				   'email_id' => $data['email'],
				   'primary_phone_number' => $data['p_phone'],
				   'secondary_phone_number' => $data['s_phone'],
				   'role' => 'pending',
				   'city' => $data['city'],			   
				   'created_by' => $data['username']			   
				);
				$this->session->set_flashdata('message', 'You have successfully registered. Please contact your administrator.');
				$this->user_model->user_register($data); 
				//// send mail to admin/dashboard
				//$new_sub_admin_mail=$this->config->item('new_sub_admin_mail') ;
				
				
				
				
				$this->db->select('email_id');
				$this->db->from('admin_details');
				$this->db->where('username','admin');
				$query = $this->db->get();
				$ret = $query->row();
				$ret->email_id;


				$new_sub_admin_mail =$this->config->item('new_sub_admin_mail');					
				$mail_b=str_replace("ABCDEFGH",$mails_body,$new_sub_admin_mail['body']);				
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= "From: <".$new_sub_admin_mail['email'].">" . "\r\n";
				$headers .= 'Bcc: pankajcse1983@gmail.com' . "\r\n";

				mail($ret->email_id,$new_sub_admin_mail['subject'],$mail_b,$headers);
				
				////	


				
				
			}
		}	
		
		$data['page'] = $this->page;
		
		$this->load->view('header', $data);		
		$this->load->view('register_view', $data);
		$this->load->view('footer', $data);					
	}
	
}
