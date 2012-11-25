<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<input type="hidden" name="nilaiConter" id="nilaiConterRampasan">
<?php endif; ?>
<button type="button" id="add_rampasan" >Tambah Barang Rampasan</button>
<ul class="nav nav-tabs" id="tabRampasan">
  
</ul>
<div class="tab-content rampasan">
  
</div>

<!--<ul class="nav nav-tabs" id="tabPenyelesaian">
  <li id="tab_li_proses"><a data-toggle="tab" href="#proses">Proses Lelang</a></li>
  <li id="tab_li_hambatan"><a data-toggle="tab" href="#hambatan">Hambatan Lelang</a></li>
  <li id="tab_li_petunjuk"><a data-toggle="tab" href="#petunjuk_penyelesaian">Petunjuk Penyelesaian</a></li>
</ul>
<div class="tab-content penyelesaian">
  <div id="proses" class="tab-pane">
	<div class="span11">
	  <div class="row">
		<div class="form-inline">
		  <label><div class="span2">No. BA Lelang</div> &nbsp;<input type="text" name="no_ba_lelang" /></label>
		  <label><div class="span1">Tanggal</div> &nbsp;<input type="text" name="tgl_lelang" id="datepicker" class="span2-edit" /></label>
		</div>
		<div class="form-inline">
		  <label><div class="span2">Taksiran</div> &nbsp;<input type="text" name="taksiran" /></label>
		</div>
		<div class="form-inline">
		  <label><div class="span2">Nilai Wajar Hasil Lelang</div> &nbsp;<input type="text" name="nilai_wajar" /></label>
		</div>
		<div class="form-inline">
		  <label><div class="span2">Tempat Penyimpanan</div> &nbsp;<input type="text" name="tempat_penyimpanan" /></label>
		</div>
		<div class="form-inline">
		  <label>
			&nbsp;<div class="span2">Kondisi</div>
			  <select name="kondisi" class="span2">
				<option value="0">--Pilih--</option>
				<option value="1">Baik</option>
				<option value="2">Rusak</option>
				<option value="3">Rusak Berat</option>
			  </select>
		  </label>
		</div>
		<div class="form-inline">
		  <label>
			<div class="span2">Hasil Lelang</div>
			  &nbsp;<div class="input-prepend">
				<span class="add-on">Rp.</span>
				<input id="hasil_lelang" name="hasil_lelang" type="text" />
			  </div>
		  </label>
		</div>		
	  </div>
	  <table class="table table-bordered table-striped">
		<thead>
		  <tr>
			<th>Tanggal Lelang</th>
			<th>No. BA Lelang</th>
			<th>Taksiran</th>
			<th>Hasil Lelang</th>
			<th>Hambatan / Permasalahan</th>
			<th>Petunjuk Penyelesaian</th>
			<th>Action
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td>aaaa</td>
			<td>aaaa</td>
			<td>aaaa</td>
			<td>aaaa</td>
			<td>aaaa</td>
			<td>aaaa</td>
			<td>aaaa</td>
		  </tr>
		  <tr>
			<td>bbb</td>
			<td>bbb</td>
			<td>bbb</td>
			<td>bbb</td>
			<td>bbb</td>
			<td>bbb</td>
			<td>bbb</td>
		  </tr>
		</tbody>
	  </table>
	</div>
  </div>
  <div id="hambatan" class="tab-pane">
	<div class="span11">
	  <div class="row">
		<div class="form-inline">
		  <label><div class="span1">Hambatan</div> <textarea name="hambatan" class="span4"></textarea></label>
		</div>
		<div class="form-inline">
		  <label><div class="span1">Usulan</div> <textarea name="usulan" class="span4"></textarea></label>
		</div>
	  </div>
	</div>
  </div>
  <div id="petunjuk_penyelesaian" class="tab-pane">
  <div class="span11">
	  <div class="row">
		<div class="form-inline">
		  <label><div class="span2">Keterangan / Catatan</div> <textarea name="keterangan" class="span4"></textarea></label>
		</div>
	  </div>
	</div>
  </div>
</div>-->



<script type="text/javascript" >
  $(document).ready(function(){
	$('#tabPenyelesaian a[href="#proses"]').tab('show');
	
	$("#datepicker").datepicker({
		  changeMonth: true,
		  changeYear: true,
		  showOn: "button",
		  buttonImage: "<?php echo image_path('calendar.gif') ?>",
		  buttonImageOnly: true,
		  yearRange: '1910:+0',
		  dateFormat: 'dd-mm-yy',
	  });
  });
  var tab_counter_rampasan = 1;
  var addtabRampasan=1;
  
  function addTabRampasan(){
	  $('.rampasan').append(
		  '<div class="tab-pane in active" id="rampasan_id'+addtabRampasan+'">' +
			  '<div class="span11">' +
				  '<div class="row">' +
					  '<div class="form-inline">' +
						  '<label><div class="span1">Jenis</div> <input type="text" name="jenis[]" id="jenis'+addtabRampasan+'"></label>' +
					  '</div>' +
					  '<div class="form-inline">' +
						  '<label><div class="span1">Jumlah</div> <input type="text" name="jumlah[]" ></label>' +
						  '<label>'+
							'<div class="span1">Satuan</div>'+
							'<select name="satuan[]" class="span2">'+
							  '<option value="0">--Pilih--</option>'+
							  <?php foreach($resultData as $satuan): ?>
							  '<option value="<?php echo $satuan['ID'] ?>"><?php echo $satuan['SATUAN'] ?></option>'+
							  <?php endforeach; ?>
							'</select>'+
						  '</label>' +
					  '</div>' +
					  '<div class="form-inline">' +
						  '<label><div class="span1">Pemilik</div> <input type="text" name="pemilik[]" ></label>' +
					  '</div>' +
					  '<div class="form-inline">' +
						  '<label>' +
							'<div class="span1">Petunjuk</div>' +
							'<select name="petunjuk[]" class="span3">' +
								'<option value="0">--Pilih--</option>' +
								'<option value="1">Dihibahkan</option>' +
								'<option value="2">Dimusnahkan</option>' +
								'<option value="3">Lelang</option>' +
							'</select>' +
						  '</label>' +
					  '</div>' +
				  '</div>' +
			  '</div>' +
			  '<legend>Penyelesaian Barang Rampasan</legend>' +
			  '<input type="button" class="btn btn-warning" value="tambah" id="tambah_lelang" onClick=tambahLelang("'+addtabRampasan+'")>' +
			  '<input type="hidden" name="hdnlelang" id="hdnlelang" value="0">' +
			  '<table class="table table-bordered table-striped" id="tbl_lelang'+addtabRampasan+'">' +
				'<thead>' +
				  '<tr>' +
					'<th>No. BA Lelang</th>' +
					'<th>Tanggal Lelang</th>' +
					'<th>Taksiran</th>' +
					'<th>Nilai Wajar / <br /> Hasil Lelang</th>' +
					'<th>Tempat Penyimpanan</th>' +
					'<th>Kondisi</th>' +
					'<th>Hasil Lelang</th>' +
					'<th>Hambatan / Permasalahan</th>' +
					'<th>Petunjuk Penyelesaian</th>' +
					'<th>Action</th>' +
				  '</tr>' +
				'</thead>' +
				'<tbody>' +
				  
				'</tbody>' +
			  '</table>' +
		  '</div>'
	  );
	  $('#tabRampasan').append('<li id="tab_li_rampas'+addtabRampasan+'"><a href="#rampasan_id'+addtabRampasan+'" data-toggle="tab">Barang Rampasan '+addtabRampasan+' <span class="" onClick=dlttabrampasan("'+addtabRampasan+'","'+nourut+'") > | <i class="icon-remove-sign"></i></span></a></li>');
	  $('#tabRampasan a:last').tab('show');
	
	addtabRampasan++;
  }
  
  count = 1;
  function tambahLelang(value){
	var noterakhir=$("#hdnlelang").val();
	var randomnumber=parseInt(noterakhir)+1;
	$("#hdnlelang").val(randomnumber);
	
	$("#tbl_lelang"+value).append(
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
  
  var nourut = 2;
  $('#add_rampasan').button().click(function(){
	  addTabRampasan();
	  //handeltgl($(document));
  });
  
  $("#add_rampasan").click(function() {
	  $('#nilaiConterRampasan').val(tab_counter_rampasan-1);
  });
  
  
</script>
