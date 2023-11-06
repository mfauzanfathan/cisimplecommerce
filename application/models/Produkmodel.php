<?php
error_reporting (E_ALL ^ E_WARNING||E_NOTICE);
class Produkmodel extends CI_Model {
    function __construct()
    {
        parent::__construct();
		$this->tabel = "produk";
    }
	function getProduk(){
		$this->db->select('idproduk,idkategori');
		$this->db->from($this->tabel);
		$this->db->order_by('namaproduk','asc');
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	function save($data){
		$this->db->select('idproduk');
		$this->db->from($this->tabel);
		$this->db->where('idproduk',$data['idproduk']);
		$query = $this->db->get();
		if($query->num_rows()>0){
			$msg = "Data gagal disimpan<br>Username sudah digunakan"; $stat = "danger";
		}else{
			if($this->db->insert($this->tabel,$data)){
				$msg = "Data berhasil disimpan"; $stat="success";
			}else{
				 $msg = "Data gagal disimpan<br>"; $stat = "danger";
			}
		}
		return array($stat,$msg);
	}
	function update($data,$id){
		$this->db->where('idproduk', $id);
		if($this->db->update($this->tabel, $data)){
			$msg = "Data berhasil diubah"; $stat="success";
		}else{
			 $msg = "Data gagal diubah<br>"; $stat = "danger";
		}
		return array($stat,$msg);
	}
	function getData(){
		$this->db->select('idproduk,idkategori,namaproduk,harga');
		$this->db->from($this->tabel);
		$this->db->order_by('namaproduk','asc');
		$query = $this->db->get(); $row = $query->result_array();
		return $row;
	}
	function deletedata($id){
		$msg = "Data berhasil dihapus"; $stat="success";
		$this->db->where('idproduk', $id);
		$exe = $this->db->delete($this->tabel); 
		if(!$exe){ $msg = "Data gagal dihapus<br>"; $stat = "danger"; }
		return array($stat,$msg);
	}
	function getDataById($data){
		$this->db->select('idproduk,idkategori,namaproduk,harga');
		$this->db->from($this->tabel);
		$this->db->where('idproduk', $data);
		$query = $this->db->get(); $row = $query->result_array();
		return $row;
	}
}
?>