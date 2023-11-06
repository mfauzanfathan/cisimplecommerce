<?php
error_reporting (E_ALL ^ E_WARNING||E_NOTICE);
class Penjualanmodel extends CI_Model {
    function __construct()
    {
        parent::__construct();
		$this->tabel = "penjualan";
		$this->tabeldetail = "detilpenjualan";
		$this->tabelbarang = "produk";
		$this->tabelkatbarang = "kategori";
		$this->tabelcustomer = "customer";
    }	
	function save($data){
		if($this->db->insert($this->tabel,$data)){
			$msg = "Data berhasil disimpan";$stat="success";
		}else{
			$msg = "Data gagal disimpan <br>";
			$stat = "danger";
		}	
		return array($stat,$msg);
	}
	function saveDetail($datadetail){	
		if($this->db->insert($this->tabeldetail,$datadetail)){
	//	echo $this->db->last_query();
			return true;
		}else{
			return false;
		}
	}
	function getDataBarang($idproduk){
		$this->db->select('idproduk,namaproduk,harga');
		$this->db->from($this->tabelbarang);
		$this->db->join($this->tabelkatbarang, $this->tabelkatbarang.'.idkategori = '.$this->tabelbarang.'.idkategori');
		if($idproduk!=''){
			$this->db->where('idproduk',$idproduk);
		}
		$this->db->order_by('namaproduk','asc');
		$query = $this->db->get();
		$row = $query->result_array();
		$row[0]['harga'] = round($row[0]['harga'],0);
		return $row;
	}
	function getDataCustomer(){
		$this->db->select('*');
		$this->db->from($this->tabelcustomer);
		$this->db->order_by('namacustomer','asc');
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
}
?>