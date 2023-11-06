<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admincustomer extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Customermodel');
	}
	public function index()
	{
		$dataheader = array('keywords'=>'cms,simple,codeigniter','author'=>'Wahyu Pramusinto','description'=>'cisimple','title'=>'CISIMPLE');
		$this->load->view('template/header',$dataheader);
		$this->load->view('template/nav');
		$data['listdata'] = $this->Customermodel->getCustomer();
		$this->load->view('pages/dataCustomer', $data);
		$this->load->view('template/footer');
	}
	public function save() {
		$dt['idcustomer'] = $this->input->post('idcustomer');
		$dt['namacustomer'] = $this->input->post('namacustomer');
		$dt['alamat'] = $this->input->post('alamat');
        $dt['nohp'] = $this->input->post('nohp');
        $dt['email'] = $this->input->post('email');

		if($this->input->post('hidcustomer')=='')
		{
			$x = $this->Customermodel->save($dt);
		}else{
			$x = $this->Customermodel->update($dt,$this->input->post('hidcustomer'));
		}
		echo json_encode($x);
	}
	public function getData() {
		echo json_encode( $this->Customermodel->getData()	);
	}
	public function getDataById() {
		$a = $this->Customermodel->getDataById($_POST['id']);
		echo json_encode($a[0]);
	}
	public function deleteData() {
		$x = $this->Customermodel->deletedata($_POST['id']);
		echo json_encode($x);
	}
}