<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminkategori extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kategorimodel');
	}
	public function index()
	{
		$dataheader = array('keywords'=>'cms,simple,codeigniter','author'=>'Wahyu Pramusinto','description'=>'cisimple','title'=>'CISIMPLE');
		$this->load->view('template/header',$dataheader);
		$this->load->view('template/nav');
		$data['listdata'] = $this->Kategorimodel->getKategori();
		$this->load->view('pages/adminkategori', $data);
		$this->load->view('template/footer');
	}
	public function save() {
		$dt['idkategori'] = $this->input->post('idkategori');
		$dt['namakategori'] = $this->input->post('namakategori');

		if($this->input->post('hidkategori')=='')
		{
			$x = $this->Kategorimodel->save($dt);
		}else{
			$x = $this->Kategorimodel->update($dt,$this->input->post('hidkategori'));
		}
		echo json_encode($x);
	}
	public function getData() {
		echo json_encode( $this->Kategorimodel->getData()	);
	}
	public function getDataById() {
		$a = $this->Kategorimodel->getDataById($_POST['id']);
		echo json_encode($a[0]);
	}
	public function deleteData() {
		$x = $this->Kategorimodel->deletedata($_POST['id']);
		echo json_encode($x);
	}
}