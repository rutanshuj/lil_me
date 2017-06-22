<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->library('session');
	}
    public function index() {
		$this->session->unset_userdata('username');
		redirect("admin/login");
		exit;
    }
}

