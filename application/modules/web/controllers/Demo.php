<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/// check email 
class demo extends CI_Controller {
	public function __construct() {		
		parent::__construct();
		if(!isset($_SESSION)) 
			{ 
				session_start(); 
			}
		}
}
?>