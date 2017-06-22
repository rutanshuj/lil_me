<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Base_Controller extends MX_Controller {

    public $ajax_controller = false;

    public function __construct()
    {
        parent::__construct();

		//Load Project specific configuration file
        //$this->config->load('project_specific_config_file');

        // Don't allow non-ajax requests to ajax controllers
		if ($this->ajax_controller and !$this->input->is_ajax_request()){exit;}

        $this->load->library('session');
        $this->load->helper('url');

        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper('number');
		$this->load->helper('pager');

		$this->load->helper('date');
		$this->load->helper('redirect');
		


    }

}

?>