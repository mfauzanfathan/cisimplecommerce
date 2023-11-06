<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gantipass extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->appurl = 'index.php/gantipass';
		$this->uricontroller = base_url($this->appurl);
		$this->load->Model("gantipassmodel");
		if(!$this->session->userdata('username')){
			redirect(base_url('index.php/login'));
		}	
	}
	
	public function index($renderData=""){	 
		$dataheader = array('keywords'=>'cms,simple,codeigniter','author'=>'Wahyu Pramusinto','description'=>'cisimple','title'=>'CISIMPLE');
		$this->load->view('template/header',$dataheader);
		$this->load->view('template/nav');
		$this->load->view('pages/gantipass');
		$this->load->view('template/footer');
	}
	public function save(){
		$passLama = $this->input->post('passLama');
		$passBaru1 = $this->input->post('passBaru1');
		$passBaru2 = $this->input->post('passBaru2');
		if(strlen($passBaru1)<6){
			$this->data['message'] = array("danger","Password baru minimal 6 karakter",0);
		}else if($passBaru1<>$passBaru2){
			$this->data['message'] = array("danger","Password baru dan konfirmasi password tidak sama",0);
		}else{
			$this->data['message'] = $this->gantipassmodel->cekpasslama($this->session->userdata('username'),$passLama);
			if($this->data['message'][0]=='success'){
				$this->data['message'] = $this->gantipassmodel->save($this->session->userdata('username'),$passBaru1);
			}
		}
		//die(print_r($this->data['message']));
		$dataheader = array('keywords'=>'cms,simple,codeigniter','author'=>'Wahyu Pramusinto','description'=>'cisimple','title'=>'CISIMPLE');
		
		$this->load->view('template/header',$dataheader);
		$this->load->view('template/nav');
		$this->load->view('pages/gantipass',$this->data);
		$this->load->view('template/footer');
	}
}
