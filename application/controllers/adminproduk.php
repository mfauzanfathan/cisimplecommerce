<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminproduk extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Produkmodel');
	}
	public function index(){
		$dataheader = array('keywords'=>'cms,simple,codeigniter','author'=>'Wahyu Pramusinto','description'=>'cisimple','title'=>'CISIMPLE');
		$this->load->view('template/header',$dataheader);
		$this->load->view('template/nav');
		$data['listdata'] = $this->Produkmodel->getData();
		$this->load->view('pages/adminproduk',$data);
		$this->load->view('template/footer');
	}	
    public function save(){
		$dt['idproduk'] = $this->input->post('idproduk');
		$dt['idkategori'] = $this->input->post('idkategori');
		$dt['namaproduk'] = $this->input->post('namaproduk');
		$dt['harga'] = $this->input->post('harga');
		if($this->input->post('hidproduk')=='')
		{
			$x = $this->Produkmodel->save($dt);
		}else{
			$x = $this->Produkmodel->update($dt,$this->input->post('hidproduk'));
		}
		echo json_encode($x);
		
		return $this->index();
	}
	public function getData(){
		echo json_encode( $this->Produkmodel->getData() );
	}
	public function getDataById(){
		$a = $this->Produkmodel->getDataById($_POST['id']);
		echo json_encode($a[0]);
	}
	public function deleteData(){
		$id = $this->uri->segment(3);

		$x =  $this->Produkmodel->deletedata($id);
		echo json_encode($x);
		return $this->index();
	}
}