
<h2><i class='fa fa-key'></i> <span class="text-primary">Ganti Password</span></h2>
<?php
if(isset($message)){
	echo "<p class='informasi text-center bg-".$message[0]."'>".$message[1]."</p>";	
}
?>
<form class="form-horizontal" role="form" action="<?php echo base_url('index.php/gantipass/save');?>" method="post" id='form1' onsubmit="return cekdata()">
  <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Password Lama</label>
    <div class="col-sm-5">
      <input type="password" id="passLama" required name="passLama" class="form-control" placeholder="password lama">
    </div>
  </div>
   <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Password Baru</label>
    <div class="col-sm-5">
      <input type="password" id="passBaru1" required name="passBaru1" class="form-control"  placeholder="password baru (min 6 karakter)">
    </div>
  </div>
  <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Konfirmasi Password Baru</label>
    <div class="col-sm-5">
      <input type="password" id="passBaru2" required name="passBaru2" class="form-control" placeholder="konfirmasi password baru">
    </div>
  </div>
  <div class="form-group">
  <label class="col-sm-3 control-label"></label>
   <div class="col-sm-5">
      <input type="submit" id="tblsimpan" name="tblsimpan" class="btn btn-primary" value="Simpan">
    </div>
  </div>
  </form>
  <script>
  function cekdata(){
	if($('#passBaru1').val()!=$('#passBaru2').val()){
		alert('Password baru dan konfirmasi password baru tidak sama');
		return false;
	}else if($('#passBaru1').val().length<6){
		alert('Password baru minimal 6 karakter');
		return false;
	}else{
		return true;
	}
  }
  </script>
