<?php
class Gantipassmodel extends CI_Model {
    function __construct()
    {
        parent::__construct();
		$this->tabel = "user";
    }
	
	function cekpasslama($user,$pass){
		$this->db->select('user');	
		$this->db->from($this->tabel);
		$this->db->where('user', $user, TRUE);
		$this->db->where('pass',"md5(md5('$pass'))", FALSE);
		$query = $this->db->get();		
		if ($query->num_rows() == 0){
			$ret = array("danger","Password Lama anda Salah",0);
		}else{
			$ret = array("success","Password Benar",0);
		}
		return $ret;
	}
	function save($user,$passbaru){
		$data['pass'] = md5(md5($passbaru));
		$this->db->where('user', $user);
		if($this->db->update($this->tabel, $data)){
			$msg = "Password anda berhasil diubah";$num="0";$stat="success";
		//	echo $this->db->last_query();
		}else{
			$msg = "Password anda gagal diubah <br> ".$this->db->_error_message();
			$num = $this->db->_error_number();
			$stat = "danger";
		}
		return array($stat,$msg,$num);
	}
}
?>
