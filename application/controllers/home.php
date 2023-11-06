<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('username')){
			redirect(base_url('index.php/login'));
		}
	}
	public function index() {
	$dataheader = array('keywords'=>'cms,simple,codeigniter','author'=>'Wahyu Pramusinto','description'=>'cisimple',
	'title'=>'CISIMPLE');
	$this->load->view('template/header',$dataheader);
	$this->load->view('template/nav');
	$this->load->view('pages/home');
	$this->load->view('template/footer');
	}
}