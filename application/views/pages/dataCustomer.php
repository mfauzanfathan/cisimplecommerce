<style>
.dengar{background-color:red;color:white;}
.success{background-color:green;color:white;}
</style>
<h2><span class="text-primary"> Customer </span>     </h2>
<div id='divform'>
	<form class="form-horizontal" role="form" action="<?php echo base_url('index.php/admincustomer/save');?>" method="post" id='form1'>
  <div class="form-group">
  <label for="" class="col-sm-3 control-label">Id Customer</label>
   <div class="col-sm-5">
   <input type="text" class="form-control" id="idcustomer" name="idcustomer" placeholder="idcustomer" maxlength='100'>
  </div>
  </div>
  <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Nama Customer</label>
    <div class="col-sm-5">
      <input type="text"  class="form-control" id="namacustomer" name="namacustomer" placeholder="namacustomer" maxlength='25' required value="" autofocus>
    </div>
  </div>
  <div class="form-group">
  <label for="alamat" class="col-sm-3 control-label">Alamat</label>
   <div class="col-sm-5">
   <input type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat" maxlength='255'>
  </div>
  </div>
  <div class="form-group">
  <label for="pass" class="col-sm-3 control-label">No Hp</label>
   <div class="col-sm-5">
   <input type="text" class="form-control" id="nohp" name="nohp" placeholder="nohp" maxlength='100'>
  </div>
  </div>
  <div class="form-group">
  <label for="pass" class="col-sm-3 control-label">Email</label>
   <div class="col-sm-5">
   <input type="text" class="form-control" id="email" name="email" placeholder="email" maxlength='100'>
  </div>
  </div>
  <div class="form-group">
      <label for="simpan" class="col-sm-3 control-label"></label>
    <div class="col-sm-5">
<input type='hidden' id='hidcustomer' name='hidcustomer'>
    	<input type="submit" class="btn btn-primary" name="tblsimpan" id="tblsimpan" value="save">
      <input type="button" class="btn btn-info" name="tblreset" id="tblreset" value="reset" onclik='backbutton() '>
      <input type="button" class="btn btn-danger" value="close" onclick="$('#divform').fadeOut() ;">
    </div>
  </div>
</form>
</div>
 <div class="row">
 	<div class="col-lg-12"> 
    <div class="box">
      <header> <h5>Data Customer</h5> </header>
      <div class='table-responsive'>
        <table id="tabledata" class="table table-bordered table-condensed table-hover table-striped">
          <thead> <tr> <th>Id Customer</th> <th>Nama Customer</th> <th>Alamat</th> <th>No Hp</th> <th>Email</th> <th>Action</th> </tr> </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(e) {
	 $("#form1").submit(function() {
        var datastring = $("#form1").serialize();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('index.php/admincustomer/save')?>",
			data: datastring,
			dataType: "json",
			success: function(data) {
				$('#divpesan').addClass(data.stat);
				$('#divpesan').html(data.msg);
				listdata();
			},
			error: function() {
				alert('Error');
			}
		});
		return false;
    })
	listdata();
});
function listdata(){
	//ambil data AJAX dan tampilkan ke table id='tabledata'
	$('#tabledata tbody').html('')
	$.ajax({
		type: "GET",
			url: "<?php echo base_url('index.php/admincustomer/getData')?>",
			dataType: "json",
			success: function(data) {
				$.each(data, function(i, item) {
					var baris = "<tr><td>"+item.idcustomer+"</td><td>"+item.namacustomer+"</td><td>"+item.alamat+"</td><td>"+item.nohp+"</td><td>"+item.email+"</td>";
					baris += "<td><a href=# onclick=ambilData('"+item.customer+"')>Ubah</a> | ";
					baris += "<a href='#' onclick=hapusData('"+item.customer+"')>Hapus</a></td></tr>";
					//alert(baris);
					$("#tabledata tbody").append(baris)
				})
			},
			error: function() {
				alert('Error');
			}
	});
}
function ambilData(id){
	//kosongkan div pesan form
	$('#divpesan').removeClass('danger,success');
	$('#form1').each (function(){
		this.reset();
	});
	$.post('<?php echo base_url('index.php/admincustomer/getDataById')?>',{id:id},function(data){
		$('#customer,#hidcustomer').val(data.customer).attr('readonly','readonly');
		$('#namacustomer').val(data.namacustomer);
	},'json');
}
function hapusData(id){
	if(confirm('apakah yakin akan menghapus data?')){
		$('#divpesan').removeClass('danger,success');
		$('#form1').each (function(){
			this.reset();
		});
		$.post('<?php echo base_url('index.php/admincustomer/deleteData')?>',{id:id},function(data){
			$('#divpesan').addClass(data.stat);
			$('#divpesan').html(data.msg);		
			$('#customer,#hidcustomer').val(data.customer).attr('readonly','readonly');
			$('#namacustomer').val(data.namacustomer);
			listdata();
		},'json');
	}
}
function backbutton()
{
	document.location = '<?php echo base_url('index.php/admincustomer/')?>';
}
</script>