<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
	 public function __construct()
       {
            parent::__construct();
            // Your own constructor code
			$this->session->sess_destroy();
			redirect(base_url());
       }	
	public function index()
	{
		// Your own constructor code
			$this->session->sess_destroy();
			redirect(base_url());
	}
}
