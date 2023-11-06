<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penjualan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->Model("Penjualanmodel");
	}
	public function index(){
		$dataheader = array('keywords'=>'cms,simple,codeigniter','author'=>'Wahyu Pramusinto','description'=>'cisimple','title'=>'CISIMPLE');
		$this->load->view('template/header',$dataheader);
		$this->load->view('template/nav');
		$this->getDataBarang();
		$this->getDataCustomer();
		
		$this->load->view('pages/penjualan',$this->data);
		$this->load->view('template/footer');
	}
	public function getDataCustomer(){
		$this->data['listdatacust'] = $this->Penjualanmodel->getDataCustomer();
	}
	
	public function getDataBarang()
	{
		if(isset($_POST['id'])) {
			$data['idproduk'] = $_POST['id'];
			$brg = $this->Penjualanmodel->getDataBarang($data['idproduk']);
			echo json_encode($brg[0]);
		}else{
			$data['idproduk'] = '';
			
			$this->data['listdatabarangtoko'] = $this->Penjualanmodel->getDataBarang($data['idproduk']);
		}
	}
	
	public function save(){
		$data['tgltransaksi'] = $this->input->post("tgltransaksi");
		$data['idcustomer'] = $this->input->post("idcustomer");	
		if($this->input->post("tblsimpan")){
			$this->data['message'] = $this->Penjualanmodel->save($data);	
			if($this->data['message'][0]=='success'){
				//get last id insert
				$idtransaksi = $this->db->insert_id();
			//looping untuk tdetilpo
				$jumlah = $this->input->post("jumlah");
				$hargajual = $this->input->post("hargajual");
				$jumlahpo = 0;
				$datadetail['idtransaksi'] = $idtransaksi;
				foreach($this->input->post("idproduk") as $index=>$kdbrg){
					$datadetail['idproduk'] = $kdbrg;
					$datadetail['jumlah'] = $jumlah[$index];
					$datadetail['hargajual'] = $hargajual[$index];
					$jumlahpo = $jumlahpo + ($datadetail['hargajual'] * $datadetail['jumlah']);
					$this->Penjualanmodel->saveDetail($datadetail);
				}			
			}
			//tampilkan halaman hasilpesan
			$dataheader = array('keywords'=>'cms,simple,codeigniter','author'=>'Wahyu Pramusinto','description'=>'cisimple','title'=>'CISIMPLE');
			$this->hasil['status'] = $this->data['message'][0];
			$this->hasil['pesan'] = $this->data['message'][1];
			
			$this->load->view('template/header',$dataheader);
			$this->load->view('template/nav');
			$this->load->view('pages/hasilpesan',$this->hasil);
			$this->load->view('template/footer');
			
		}else{
			redirect($this->index());
		}
	}
}
