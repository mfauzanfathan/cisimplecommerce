<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminuser extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dataUsermodel');
	}
	public function index()
	{
		$dataheader = array('keywords'=>'cms,simple,codeigniter','author'=>'Wahyu Pramusinto','description'=>'cisimple','title'=>'CISIMPLE');
		$this->load->view('template/header',$dataheader);
		$this->load->view('template/nav');
		$data['listdata'] = $this->dataUsermodel->getUser();
		$this->load->view('pages/dataUser', $data);
		$this->load->view('template/footer');
	}
	public function save() {
		$dt['user'] = $this->input->post('user');
		$dt['nama'] = $this->input->post('nama');
		$dt['pass'] = md5($this->input->post('pass'));
		if($this->input->post('hiduser')=='')
		{
			$x = $this->dataUsermodel->save($dt);
		}else{
			$x = $this->dataUsermodel->update($dt,$this->input->post('hiduser'));
		}
		echo json_encode($x);
	}
	public function getData() {
		echo json_encode( $this->dataUsermodel->getData()	);
	}
	public function getDataById() {
		$a = $this->dataUsermodel->getDataById($_POST['id']);
		echo json_encode($a[0]);
	}
	public function deleteData() {
		$x = $this->dataUsermodel->deletedata($_POST['id']);
		echo json_encode($x);
	}
}