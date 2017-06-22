
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email 
class Home extends CI_Controller {
	public function __construct() {		
		parent::__construct();
		if(!isset($_SESSION)) 
			{ 
				session_start(); 
			}
		$this->load->helper(array('form', 'url')); // add from helper 
		$this->load->library('form_validation'); 
		$this->load->library('pagination'); 
		
		$this->load->Model('Category_model');
		$this->load->Model('Pagination_Model');
		$this->load->Model('Product_model');
		$this->load->Model('Cart_model');
		$this->load->Model('Genericmodel');
		$this->load->database();
		$this->load->library('social_media_lib');
		$this->load->model('Jewellerymodel');
		$this->load->model('Homemodel');
		$this->load->model('User_model');
		$this->load->model('Jewelleryattributemodel');
		include_once APPPATH."libraries/facebook-api-php-codexworld/facebook.php";
	}
	
	function favorites()
	{
		//$data['page'] = $this->page;
		try{
		$data['page_name']= "favorites";
		$data['username'] = $this->session->userdata('username');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$id = $this->session->userdata('user_id');
		$data['page_no']=$page=$this->uri->segment(4,0);
		//echo $page;
		$data['category_list'] = $this->Category_model->product_category();
		
		
		$config = array();
		$config["base_url"] = base_url() . "web/home/favorites/";
		$total_row = $this->User_model->favorites_count($id);;
		
		//echo $total_row;
		$config["total_rows"] = $total_row;
		$config["per_page"] = 8;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = $total_row;
		$data['num_links']=$total_row;
		$this->pagination->initialize($config);
		$str_links = $this->pagination->create_links();
		$data["links"] = $this->pagination->create_links();//ceil($total_row/$config["per_page"]);
		
		if($page=='')
		{
			$data['page_no']=$page=1;
		}
		
		
		$page=$page-1;
		$page=$page*$config["per_page"];
		$data['favorites']=$this->User_model->user_favorites($id,$config["per_page"],$page);
		
		//$data['fb_data']=$this->fb_login();
		/* echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die(); */ 
		$this->load->view('header',$data);	
		$this->load->view('favorite_view',$data);
		$this->load->view('footer');
		}
		catch(Exception $e){
		   show_404();
		}
	}
	function index()
	{
		$data_fb= array();
		//$data['page'] = $this->page;
		$data['page_name']= "home";
		
		$fb_user=$this->session->userdata('fbuser');
		$this->social_media_lib->get_social_login_links();	
		
		$cart_data=array();
		$data['username'] = $this->session->userdata('username');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$user_id=$this->session->userdata('user_id');
		$api_key =$this->session->userdata('api_key');
		$data['category_list'] = $this->Category_model->product_category();
		$data['home_images'] = $this->Homemodel->getMoodImages();
		
		
		
	
		/* echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die();
		 */
		$this->load->view('header',$data);	
		$this->load->view('home',$data);
		$this->load->view('footer');		
		
		
		}
	
	
	
	function product_details()
	{
		
		$user_id =$this->session->userdata('user_id');
		$api_key = $this->session->userdata('api_key');
		$data['category_list'] = $this->Category_model->product_category();
		$data['page_name']= "";
		$data['product_id']=$product_id=$this->uri->segment(4);
		if (isset($product_id)&& is_numeric($product_id))
		{
		$data['product_data']=$this->Product_model->get_product_details($product_id);
		if(is_null($data['product_data']))
		{
		redirect('web/home/show_error');	
		}
		else{
		$data['like_flag']=$this->Product_model->is_favorite($user_id,$data['product_id']);	
		$this->load->view('header',$data);	
		$this->load->view('product_detail',$data);
		$this->load->view('footer');	
		}
		
		}
		else{
		 show_404();	
		}
		
		/* echo"<pre>";
		print_r($this->session->userdata);
		echo"</pre>"; 
		die(); */ 
		/* echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die(); */
		
	}
	function search()
	{
	$input=$this->input->get('input');
	$data['category_list'] = $this->Category_model->product_category();
	$data['product_list']=	$this->Genericmodel->getproducts($input);
	$data['page_name']= "";
	/* 	echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die(); */
	$this->load->view('header',$data);	
	$this->load->view('product_list',$data);
	$this->load->view('footer');
	}
	
	function cart()
	{
		/* echo"<pre>";
		print_r($this->session->userdata);
		echo"</pre>"; 
		die(); */
		$user_id =$this->session->userdata('user_id');//1;
		$api_key =$this->session->userdata('api_key');//'fb0aa13efb9ac71e1c09094d7102d798'; 
		$data['category_list'] = $this->Category_model->product_category();
		$data['home_images'] = $this->Homemodel->getMoodImages();
		$data['cart_list']=$this->Cart_model->get_cartList($user_id,$api_key);	
		$data['page_name']= "";
		/* echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die(); */
		$this->load->view('header',$data);	
		$this->load->view('cart',$data);
		$this->load->view('footer');
	}
	
	function show_error()
	{
		$data['category_list'] = $this->Category_model->product_category();
		$data['page_name']= "";
		$this->load->view('header',$data);	
		$this->load->view('error_page');
		$this->load->view('footer');	
	}
	
	function result_not_found()
	{
		$data['category_slug']=$this->session->userdata('category_slug');
		$data['category_list'] = $this->Category_model->product_category();
		$data['page_name']= "";
		$this->load->view('header',$data);	
		$this->load->view('result_not_found_view');
		$this->load->view('footer');	
	}
	function thankyou_page()
	{
		$data['category_list'] = $this->Category_model->product_category();
		$data['page_name']= "";
		$this->load->view('header',$data);	
		$this->load->view('thank_you');
		$this->load->view('footer');	
	}
	function tnc()
	{
		$data['category_list'] = $this->Category_model->product_category();
		$data['page_name']= "";
		$this->load->view('header',$data);	
		$this->load->view('termscondition');
		$this->load->view('footer');	
	}
	function products_by_param()
	{
		
		$gender=array();
		$size=array();
		$data['page_name']= "gallery";
		try{
		$data['category_list'] = $this->Category_model->product_category();
		$data['category_slug']=$category_slug=$this->uri->segment(2,0);
		$data['page_no']=$page=$this->uri->segment(3,0);
		
		$user_id = $this->session->userdata('user_id');
		$api_key = $this->session->userdata('api_key');
		$this->session->set_userdata('category_slug', $category_slug);
		$this->db->select('category_id,category_name'); 
		$this->db->from('product_category');	
		$this->db->where('category_slug',$category_slug);
		$query = $this->db->get();
		if($query->num_rows()!=0)
		{
		$category_data=$query->row();
		$data['category_id']=$category_id=$category_data->category_id;
		$data['category_name']=$category_data->category_name;
		}
		else{
		 redirect('web/home/show_error');
		}
		$data['sortflag']=$sortflag=$this->input->post('sortflag');
		
		$data['selected_size']=$size=$this->input->post('size');
		$data['seleted_gender']=$gender=$this->input->post('gender');
		
		$data['size_array']=$this->Jewelleryattributemodel->get_size();
		$data['gender_list']=$this->Category_model->get_genders();
		
		
		//echo $this->db->last_query();
		
		$config = array();
		$config["base_url"] = base_url() . "products/".$category_slug.'/';
		$total_row = $this->Pagination_Model->record_count($category_id);
		
		//echo $total_row;
		$config["total_rows"] = $total_row;
		$config["per_page"] = 8;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = $total_row;
		$data['num_links']=$total_row;
		$this->pagination->initialize($config);
		$str_links = $this->pagination->create_links();
		$data["links"] = $this->pagination->create_links();//ceil($total_row/$config["per_page"]);
		
		if($page=='')
		{
			$data['page_no']=$page=1;
		}
		
		
		$page=$page-1;
		$page=$page*$config["per_page"];
		
		$data['product_list'] = $this->Category_model->get_products_criteriaWise($category_id,$size,$gender,$sortflag,$config["per_page"],$page);
		if(count($data['product_list'])==0)	
		{
		redirect('web/home/result_not_found');	
		}
		/* 	echo"<pre>";
		print_r($data);
		echo"</pre>"; 
		die(); */
			$this->load->view('header',$data);	
			$this->load->view('product_list2',$data);
			$this->load->view('footer');
		}
		catch(Exception $e){
		   redirect('web/home/show_error');
		}
		
	}
	function about_us()                  
	{
		$data['page_name']= "";
		$data['category_list'] = $this->Category_model->product_category();
		$this->load->view('header',$data);	
		$this->load->view('about_us');
		$this->load->view('footer');
	}
	function faqs()
	{
		$data['page_name']= "";
		$data['category_list'] = $this->Category_model->product_category();
		$this->load->view('header',$data);		
		$this->load->view('faqs');
		$this->load->view('footer');
	}
	function demo_url()
	{
		$name = 'Sets And Suits';
		$seo_name = url_title($name, 'dash', true);
		echo $seo_name;
		
	}
	function crop()
	{
			
		$this->load->view('crop');
		
	}
	function profile()
	{
		$data['category_list'] = $this->Category_model->product_category();
		//print_r($data);
		$this->load->view('header',$data);	
		$this->load->view('profile',$data);
		$this->load->view('footer');		
			
		
		
	}
	function contact_us()
	{
		$data['page_name']= "";
		$data['category_list'] = $this->Category_model->product_category();
		$this->load->view('header',$data);	
		$this->load->view('contact');
		$this->load->view('footer');
	}
	
	public function logout() {
		$data['page_name']= "";
		$data['userData']=$this->session->userdata('userData');
		/* echo"<pre>";
			print_r($data);
			echo"</pre>"; 
			die(); */
		$this->session->unset_userdata('userData');
		$this->googleplus->revokeToken();
        $this->session->sess_destroy();
		redirect('/web/home');
    }
}
?>