<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dataUser extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dataUsermodel');
		$this->load->library('fpdf_gen');
	}
	public function index(){
		$dataheader = array('keywords'=>'cms,simple,codeigniter','author'=>'Wahyu Pramusinto','description'=>'cisimple','title'=>'CISIMPLE');
		$this->load->view('template/header',$dataheader);
		$this->load->view('template/nav');
		
		$data['user'] = $this->dataUsermodel->getUser();
		$this->load->view('pages/dataUser',$data);
	
		$this->load->view('template/footer');
		
	}
	public function cetakpdf(){
		$data= $this->dataUsermodel->getUser();
		
		$this->fpdf->SetFont('Arial','B',16);
		
		//buat judul table
		$judul = "LAPORAN DATA USER";
		$this->fpdf->Cell(0,20, $judul, '0', 1, 'C');
		
		$header = array(
			array("label"=>"USERNAME", "length"=>30, "align"=>"L"),
			array("label"=>"NAMA", "length"=>50, "align"=>"L")
		);
		#buat header tabel
		$this->fpdf->SetFont('Arial','','10');
		$this->fpdf->SetFillColor(255,0,0);
		$this->fpdf->SetTextColor(255);
		$this->fpdf->SetDrawColor(128,0,0);
		foreach ($header as $kolom) {
			$this->fpdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
		}
		$this->fpdf->Ln();
		
		#tampilkan data tabelnya
		$this->fpdf->SetFillColor(224,235,255);
		$this->fpdf->SetTextColor(0);
		$this->fpdf->SetFont('');
		$fill=false;
		foreach ($data as $baris) {
			$i = 0;
			foreach ($baris as $cell) {
				$this->fpdf->Cell($header[$i]['length'], 5, $cell, 1, '0', $kolom['align'], $fill);
				$i++;
			}
			$fill = !$fill;
			$this->fpdf->Ln();
		}

		echo $this->fpdf->Output();
	}
}