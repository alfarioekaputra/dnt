<?php use_helper('Fungsi'); ?>
<?php use_helper('Dnt'); ?>
<form method="post" action="<?php echo url_for('barangRampasan/update') ?>">
<input type="hidden" name="sf_method" value="put" />
<input type="hidden" name="nilaiConter" id="nilaiConterRampasan">

<ul class="nav nav-tabs" id="tabRampasan">
  <?php for ($i=1; $i <= count($resultData) ; $i++) { ?>
    <li id="tab_li<?php echo $i; ?>"><a href="#barang_rampasan_edit<?php echo $i ?>" data-toggle="tab">Barang Rampasan <?php echo $i; ?></a></li>
  <?php } ?>
</ul>
<div class="tab-content rampasan">
<?php $m = 1; $k = 1; $s = 1; ?>
<?php foreach($resultData as $barbuk): ?>
	<div class="tab-pane in active" id="barang_rampasan_edit<?php echo $m ?>">
		<div class="span11">
			<div class="row">
				<div class="form-inline">
					<label><div class="span1">Jenis</div> <input type="text" name="jenis[]" id="jenis'" value="<?php echo $barbuk['NAMA'] ?>"></label>
				</div>
				<div class="form-inline">
					<label><div class="span1">Jumlah</div> <input type="text" name="jumlah[]" value="<?php echo $barbuk['JUMLAH'] ?>"></label>
					<label>
						<div class="span1">Satuan</div>
						<select name="satuan[]" class="span2">
							<option value="<?php echo $barbuk['ID_SATUAN'] ?>"><?php echo $barbuk['SATUAN'] ?></option>
							<?php foreach($resultSatuan as $satuan): ?>
								<option value="<?php echo $satuan['ID'] ?>"><?php echo $satuan['SATUAN'] ?></option>
							<?php endforeach; ?>
						</select>
					</label>
				</div>
				<div class="form-inline">
					<label><div class="span1">Pemilik</div> <input type="text" name="pemilik[]" value="<?php echo $barbuk['PEMILIK'] ?>"></label>
				</div>
				<div class="form-inline">
					<label>
					<div class="span1">Petunjuk</div>
						<select name="petunjuk[]" class="span3">
							<option value="0">--Pilih--</option>
							<option value="DIHIBAHKAN" <?php if($barbuk['PETUNJUK'] == 'DIHIBAHKAN'){ echo 'selected'; } ?>>Dihibahkan</option>
							<option value="DIMUSNAHKAN" <?php if($barbuk['PETUNJUK'] == 'DIMUSNAHKAN'){ echo 'selected'; } ?>>Dimusnahkan</option>
							<option value="LELANG" <?php if($barbuk['PETUNJUK'] == 'LELANG'){ echo 'selected'; } ?>>Lelang</option>
						</select>
					</label>
				</div>
			</div>
		</div>
		<input type="hidden" name="idLelang[]" value="<?php echo $barbuk['ID_LELANG'] ?>">
		<input type="hidden" name="idBarbuk[]" value="<?php echo $barbuk['IDBARBUK'] ?>">
		<input type="button" class="btn btn-warning" value="tambah" id="tambah_lelang" onClick=tambahLelang("'<?php echo $m; ?>'")>
		<input type="hidden" name="hdnlelang" id="hdnlelang" value="0">
		<table class="table table-bordered table-striped" id="tbl_lelang">
		  <thead>
			<tr>
			  <th>No. BA Lelang</th>
			  <th>Tanggal Lelang</th>
			  <th>Taksiran</th>
			  <th>Nilai Wajar / <br /> Hasil Lelang</th>
			  <th>Tempat Penyimpanan</th>
			  <th>Kondisi</th>
			  <th>Hasil Lelang</th>
			  <th>Hambatan / Permasalahan</th>
			  <th>Petunjuk Penyelesaian</th>
			  <th>Action
			</tr>
		  </thead>
		  <tbody>
			<tr id="data_lelang<?php echo $m ?>">
				<td><input type="text" name="no_ba_lelang<?php echo $m; ?>[]" class="span2" value="<?php echo $barbuk['NO_BA'] ?>"></td>
				<td>
				  <div class="input-prepend-edit-date">
					<input type="text" name="tgl_lelang<?php echo $m; ?>[]" class="datepicker span2-edit" value="<?php echo getTanggal($barbuk['TGL_LELANG']) ?>">
				  </td>
				<td><input type="text" name="taksiran<?php echo $m; ?>[]" class="span2" value="<?php echo $barbuk['TAKSIRAN'] ?>"></td>
				<td><input type="text" name="nilai_wajar_hasil_lelang<?php echo $m; ?>[]" class="span2" value="<?php echo $barbuk['NILAI_WAJAR'] ?>"></td>
				<td><input type="text" name="tempat_penyimpanan<?php echo $m; ?>[]" class="span2" value="<?php echo $barbuk['PENYIMPANAN'] ?>"></td>
				<td>
				  <select name="kondisi<?php echo $m; ?>[]" class="span2">
					<option value="0">--Pilih--</option>
					<option value="1" <?php echo $barbuk['KONDISI'] == '1' ? 'selected' : '' ?>>Baik</option>
					<option value="2" <?php echo $barbuk['KONDISI'] == '2' ? 'selected' : '' ?>>Rusak</option>
					<option value="3" <?php echo $barbuk['KONDISI'] == '3' ? 'selected' : '' ?>>Rusak Berat</option>
				  </select>
				</td>
				<td><input type="text" name="hasil_lelang<?php echo $m; ?>[]" class="span2" value="<?php echo $barbuk['HASIL_LELANG'] ?>"></td>
				<td><textarea name="hambatan<?php echo $m; ?>[]" class="span3"><?php echo $barbuk['HAMBATAN'] ?></textarea></td>
				<td><textarea name="catatan<?php echo $m; ?>[]" class="span3"><?php echo $barbuk['PETUNJUK'] ?></textarea></td>
				<td>Edit | Delete</td>
			</tr>
		  </tbody>
		</table>
	</div>
	<?php $m++; endforeach; ?>
</div>

<input type="hidden" name="idPerkara" value="<?php echo $barbuk['ID_PERKARA'] ?>">

<input type="submit" value="Simpan" class="btn btn-warning" />
</form>
<script type="text/javascript">
	$('#tabRampasan a:first').tab('show');
	
	count = 1;
	function tambahLelang(value){
	  var noterakhir=$("#hdnlelang").val();
	  var randomnumber=parseInt(noterakhir)+1;
	  $("#hdnlelang").val(randomnumber);
	  
	  $("#tbl_lelang").append(
		  '<tr id="data_lelang'+randomnumber+'">'+
			'<td><input type="text" name="no_ba_lelang'+value+'[]" class="span2"></td>'+
			'<td>'+
			  '<div class="input-prepend-edit-date">'+
				'<input type="text" name="tgl_lelang'+value+'[]" class="datepicker span2-edit">'+
			  '</td>'+
			'<td><input type="text" name="taksiran'+value+'[]" class="span2"></td>'+
			'<td><input type="text" name="nilai_wajar_hasil_lelang'+value+'[]" class="span2"></td>'+
			'<td><input type="text" name="tempat_penyimpanan'+value+'[]" class="span2"></td>'+
			'<td>' +
			  '<select name="kondisi'+value+'[]" class="span2">' +
				'<option value="0">--Pilih--</option>' +
				'<option value="1">Baik</option>' +
				'<option value="2">Rusak</option>' +
				'<option value="3">Rusak Berat</option>' +
			  '</select>' +
			'</td>'+
			'<td><input type="text" name="hasil_lelang'+value+'[]" class="span2"></td>'+
			'<td><textarea name="hambatan'+value+'[]" class="span3"></textarea></td>'+
			'<td><textarea name="catatan'+value+'[]" class="span3"></textarea></td>'+
			'<td>Edit | Delete</td>'+
		  '</tr>'
		);
		count++;
  
		$(document).ready(function() {
		  $( ".datepicker" ).datepicker({
			  changeMonth: true,
			  changeYear: true,
			  showOn: "button",
			  buttonImage: "<?php echo image_path('calendar.gif') ?>",
			  buttonImageOnly: true,
			  yearRange: '1910:+0',
			  dateFormat: 'dd-mm-yy',
		  });
	  });
	}
</script>