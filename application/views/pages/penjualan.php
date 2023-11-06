<h2><i class='fa fa-user'></i> <span class="text-primary">Penjualan</span></h2>
<div id='divform'>
  <form class="form-horizontal" role="form" action="<?php echo base_url('index.php/penjualan/save');?>" method="post" id='form1' onsubmit="return cekdata()">
  <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Tanggal (YYYY-MM-DD)</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="tgltransaksi" name="tgltransaksi" placeholder="Tanggal Penjualan" required autofocus >
    </div>
  </div>
  <div class="row form-group">
  <label for="alamat" class="col-sm-3 control-label">Customer</label>
   <div class="col-sm-5">
       <select name='idcustomer' id='idcustomer' class="form-control chosen-select"  style="width:440px" required>
	<option value=""></option>
		<?php
		foreach($listdatacust as $index=>$value):
		?>
		<option value='<?php echo $value['idcustomer']?>'><?php echo $value['namacustomer'];?></option>
		<?php endforeach; ?>		
		</select>
  </div>
  </div>
  <hr>
  <div class='row text-left'> <div class='col-sm-12'>
  <button type="button" class='btn btn-primary' onclick='popbarang()'>Pilih Barang</button>
  </div> </div>
  <a name='linkdata'> </a>
  <table class='table' id='tabeldatax'> <thead>
  <tr> <th>Kode</th> <th>Nama Barang</th> <th>Qty</th> <th>Price (Rp)</th>
  <th>Total (Rp)</th> <th>Action</th> </tr>
  </thead> <tbody> </tbody>
    <tfoot> <tr> <td>&nbsp;</td> <td>Total</td> <td id='totalqty'></td>
  <td>&nbsp;</td> <td id='grandtotal'  class='text-right'></td>
  <td>&nbsp;</td> <td>&nbsp;</td> </tr> </tfoot>
  </table>
  <input type='hidden' id='hidqty' value='0'> <input type='hidden' id='hidgrandtotal' value='0'>
  </div>
  <div class="form-group">
	  <label for="simpan" class="col-sm-3 control-label"></label>
    <div class="col-sm-5">
	  <input type="submit" class="btn btn-primary btn-sm" name="tblsimpan" id="tblsimpan" value="Save">
	  <input type="button" class="btn btn-info btn-sm" name="tblhitung" id="tglhitung" value="Hitung" onclick='hitungulang()'>
	
	  <input type="button" class="btn btn-info btn-sm" name="tblreset" id="tblreset" value="Reset" onclick='backbutton()'>
    </div>
  </div>
</form>
</div>
<!-- pop barang-->
<div class="modal fade bs-example-modal-lg" id="divpopbarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Pilih Data Barang</h4>
      </div>
      <div class="modal-body">
		<table class="table table-bordered table-condensed table-hover table-striped" id='tabelpopbarang'>
		<thead> <tr> <th>Kode Produk</th> <th>Nama Barang</th>
		<th>Harga</th> <th>Qty</th> <th></th> </tr> </thead>
		<tbody>
		<?php
		foreach($listdatabarangtoko as $databarang):
		?>
		<tr>
		<td><?php echo $databarang['idproduk'];?></td>
		<td><?php echo $databarang['namaproduk'];?></td>
		<td><?php echo $databarang['harga'];?></td>
		<td align='right'><input type='number' id='qty_<?php echo $databarang['idproduk']?>'></td>		
		<td><input type='button' class='btn btn-primary btn-xs' value='Pilih' onclick="inputbarang('<?php echo $databarang['idproduk']?>')"></td>
		</tr>
		<?php endforeach; ?>
		</tbody> </table> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> </div> </div> </div>
<script>
function openform(){
	resetform();
}
function backbutton(){
	document.location='<?php echo base_url('index.php/penjualan/')?>';
}
function resetform(){
	$('#form1').each (function(){ this.reset(); });
}
function inputbarang(kode){
	qty = $('#qty_'+kode).val();
	if($.isNumeric(qty)){
		$.post('<?php echo base_url('index.php/penjualan/getDataBarang')?>',{id:kode},function(data){
			harga = data.harga;
			idproduk = data.idproduk;
			qty2 = parseInt(qty);
			totalharga = harga * qty2; 
			hidqty = parseInt($('#hidqty').val()) + qty2;
			hidgrandtotal = parseInt($('#hidgrandtotal').val()) + totalharga;
			$('#hidgrandtotal').val(hidgrandtotal);
			$('#hidqty').val(hidqty);
			if($("#listbrg_"+idproduk).length > 0) {
			//if exists remove first
			$("#listbrg_"+idproduk).remove();
			}
			row = '<tr id="listbrg_'+idproduk+'" class="datalistbarang">';
			row += '<td>'+data.idproduk+'<input type="hidden" name="idproduk[]" value="'+idproduk+'" readonly></td>';
			row += '<td>'+data.namaproduk+'</td>';
			row += '<td><input type="text" size="4" name="jumlah[]" class="jumlah" id="jumlah_'+idproduk+'" value="'+qty2+'" class="maskangka text-right"></td>';
			row += '<td><input type="text" width="10" class="hargajual" name="hargajual[]" id="hargajual_'+idproduk+'" value="'+harga+'" class="maskangka text-right"></td>';
			row += '<td class=text-right><span id="spantotaljual_'+idproduk+'" class="totaljual">'+totalharga+'</span></td>';
			row += '<td><a href="#linkdata" onclick=hapuslist("'+idproduk+'")>Delete</a>&nbsp;<a href="#linkdata" onclick=savelist("'+idproduk+'")>Save</a></td>';
			row += '</tr>';
			$('#tabeldatax tbody').append(row);
				hitungulang();
		},'json');
	}else{
		alert('Qty harus berupa angka');
		$('#qty').val('').focus();
	}
} 
function popbarang(){
	$('#divpopbarang').modal('show');
}
function hapuslist(id){
	if(confirm('Apakah anda yakin akan menghapus data?')){
		idrow = "listbrg_"+id;
		$('#'+idrow).hide().remove();
		hitungulang();
	}
}
function savelist(id){
	idrow = "listbrg_"+id;
	harga = $('#hargajual_'+id).val();
	qty2 = parseInt($('#jumlah_'+id).val());
	totalharga = harga * qty2;
	$('#spantotaljual_'+id).html(totalharga);
	hitungulang();
}
function cekdata(){
	if($('.datalistbarang').length>0){
		return true;
	}else if($('#tgltransaksi').val()==''){
		alert('Tanggal Jual belum diisi');
		return false;
	}else{
		alert('Data barang masih kosong. Silakan diisi terlebih dahulu');
		return false;
	}
}
function hitungulang(){
	totaljumlah = 0; totaljual = 0;
	$('.jumlah').each(function(){
		if($.isNumeric(this.value)){
			totaljumlah = totaljumlah + parseInt(this.value);
		 }
	});
	$('#totalqty').html(totaljumlah);
	$('.totaljual').each(function(){
		a = $(this).text(); po = a;
			if($.isNumeric(po)){
				totaljual = totaljual + parseInt(po);
			 }
		});
	$('#grandtotal').html(totaljual);
}
</script>