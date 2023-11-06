<style>
.danger{background-color:red;color:white;}
.success{background-color:green;color:white;}
</style>
<h2><span class="text-primary">Master User</span>	</h2>
<div id='divform'>
  <form class="form-horizontal" role="form" action="<?php echo base_url('index.php/adminuser/save');?>" method="post" id='form1'>
  <div class="form-group">
    <label for="idkategori" class="col-sm-3 control-label">Id Kategori</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="idkategori" name="idkategori" placeholder="idkategori" maxlength='25' required value="" autofocus>
    </div>
  </div>
  <div class="form-group">
  <label for="namakategori" class="col-sm-3 control-label">Nama Kategori</label>
   <div class="col-sm-5">
   <input type="text" class="form-control" id="namakategori" name="namakategori" placeholder="namakategori"  maxlength='255'>
  </div>
  </div>
  <div class="form-group">
	  <label for="simpan" class="col-sm-3 control-label"></label>
    <div class="col-sm-5">
<input type='hidden' id='hiduser' name='hiduser'>
      <input type="submit" class="btn btn-primary" name="tblsimpan" id="tblsimpan" value="Save">
	  <input type="button" class="btn btn-info" name="tblreset" id="tblreset" value="Reset" onclick='backbutton()'>
	  <input type="button" class="btn btn-danger" value="Close" onclick="$('#divform').fadeOut();">	
  </div>
</form>
</div>
<div class="row">
  <div class="col-lg-12">
	<div class="box">
	  <header> <h5>Master Kategori</h5> </header>
	  <div class='table-responsive'>
		<table id="tabledata" class="table table-bordered table-condensed table-hover table-striped">
		  <thead> <tr> <th>Id Kategori</th> <th>Nama Kategori</th> <th>Action</th> </tr> </thead>
		  <tbody></tbody>
		</table>
		</div>
	</div>
  </div>
</div><!-- /.row -->
<script>
$(document).ready(function(e) {
	 $("#form1").submit(function() {
        var datastring = $("#form1").serialize();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('index.php/adminkategori/save')?>",
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
			url: "<?php echo base_url('index.php/adminkategori/getData')?>",
			dataType: "json",
			success: function(data) {
				$.each(data, function(i, item) {
					var baris = "<tr><td>"+item.idkategori+"</td><td>"+item.namakategori+"</td>";
					baris += "<td><a href=# onclick=ambilData('"+item.kategori+"')>Ubah</a> | ";
					baris += "<a href='#' onclick=hapusData('"+item.kategori+"')>Hapus</a></td></tr>";
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
	$.post('<?php echo base_url('index.php/adminuser/getDataById')?>',{id:id},function(data){
		$('#user,#hiduser').val(data.kategori).attr('readonly','readonly');
		$('#nama').val(data.namakategori);
	},'json');
}
function hapusData(id){
	if(confirm('apakah yakin akan menghapus data?')){
		$('#divpesan').removeClass('danger,success');
		$('#form1').each (function(){
			this.reset();
		});
		$.post('<?php echo base_url('index.php/adminkategori/deleteData')?>',{id:id},function(data){
			$('#divpesan').addClass(data.stat);
			$('#divpesan').html(data.msg);		
			$('#kategori,#hidkategori').val(data.user).attr('readonly','readonly');
			$('#namakategori').val(data.nama);
			listdata();
		},'json');
	}
}
function backbutton()
{
	document.location = '<?php echo base_url('index.php/adminkategori/')?>';
}
</script>
