<?php use_helper('Fungsi'); ?>
<?php use_helper('Dnt'); ?>
<form action="<?php echo url_for('dntdatun/update') ?>" method="post" enctype="multipart/form-data">
	<ul class="nav nav-tabs" id="tabTersangka">
		<?php for ($i=1; $i <= count($tersangka) ; $i++) { ?>
		  <li id="tab_li<?php echo $i; ?>"><a href="#tersangka_edit<?php echo $i ?>" data-toggle="tab">Tersangka <?php echo $i; ?></a></li>
		<?php } ?>
	</ul>
	<div class="tab-content datun">
		<?php $m = 1; $k = 1;?>
		<?php foreach($tersangka as $tersangka): ?>
			<input type="hidden" name="id_perkara" value="<?php echo $tersangka['ID_PERKARA'] ?>">
			<input type="hidden" name="id_tersangka[]" value="<?php echo $tersangka['ID_TERSANGKA'] ?>">
			<div class="tab-pane in active" id="tersangka_edit<?php echo $m ?>">
				<div class="form-inline">
					<label class="span2">Nama Terdakwa</label>
					<input type="text" name="terdakwa" value="<?php echo $tersangka['NAMA'] ?>">
				</div>
				<legend>Hasil Dinas</legend>
				<label>Uang Pengganti Pidsus</label>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Amar Putusan (Rp.)</th>
							<th>Amar Putusan ($)</th>
							<th>Setor (Rp.)</th>
							<th>Setor ($)</th>
							<th>Tanggal</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Rp. <?php echo $tersangka['UP_RUPIAH'] ?></td>
							<td>$.  <?php echo $tersangka['UP_LAINNYA'] ?></td>
							<td>Rp. <?php echo $tersangka['UANG_PENGGANTI_DIBAYAR'] ?></td>
							<td>$.  <?php echo $tersangka['UANG_PENGGANTI_LAIN_DIBAYAR'] ?></td>
							<td><?php echo $tersangka['TGL_STR'] ?></td>
						</tr>

					</tbody>
				</table>
				<?php
					foreach(getDtnPup($tersangka['ID_TERSANGKA'],$tersangka['ID_PERKARA']) as $pup):
					//echo $pup['NO_SKK'];
					endforeach;
					
					//$pup = $pup['ID'] ? $pup['ID'] : '';
				?>
				<input type="hidden" name="id_pup[]" value="<?php echo $pup['ID'] ?>">
				<input type="hidden" name="id_dtn_pup<?php echo $m ?>[]" value="<?php echo $pup['ID'] ?>">
				<div class="form-inline">
					<label class="span2">No/Tgl SKK</label>
					<input type="text" name="no_skk[]" value="<?php echo $pup['NO_SKK'] ?>">
					<input type="text" class="span2-edit datepicker" name="tgl_skk[]" value="<?php echo getTanggal($pup['TGL_SKK']) ?>">
				</div>
				
				<div class="form-row">&nbsp;</div>
				<div class="form-inline">
					<label class="span2">PUP Yang Diputus</label>
					<div class="input-prepend">
						<span class="add-on">Rp.</span><input type="text" name="pup_diputus_rp[]" id="pup_diputus_rp<?php echo $m ?>" class="span2" value="<?php echo $pup['PUP_RUPIAH'] ?>">
					</div>
					<div class="input-prepend">
						<span class="add-on">$</span><input type="text" name="pup_diputus_usd[]" id="pup_diputus_usd<?php echo $m ?>" class="span2" value="<?php echo $pup['PUP_LAINNYA'] ?>">
					</div>
				</div>
				<div class="form-row">&nbsp;</div>
				<label>Pembayaran Uang Pengganti Datun</label>
				<input type="button" class="btn btn-warning" value="Tambah" id="tambahup<?php echo $m ?>" onclick=tambahup("<?php echo $m ?>")>
				<div style="overflow-x:scroll;">
					<table id="tblup<?php echo $m ?>" class="table table-bordered table-striped">
						
						<thead>
							<tr>
								<th>Jumlah Pembayaran (Rp.)</th>
								<th>Jumlah Pembayaran <br /> (Mata Uang Lain)</th>
								<th>Sisa Pembayaran (Rp.)</th>
								<th>Sisa Pembayaran <br /> (Mata Uang Lain)</th>
								<th>Tanggal</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                                                    <?php $s = 1;  ?>
							<?php foreach(getDtnPembayaran($pup['ID']) as $dtnPembayaran): ?>
							
							
							<input type="hidden" name="id_pembayaran" value="<?php echo $dtnPembayaran['ID'] ?>">
							<tr id="datatr<?php echo $m ?>_<?php echo $s ?>">
								<td>
									<div class="input-prepend-edit">
										<span class="add-on">Rp.</span><input type="text" name="jml_bayar_rp<?php echo $m ?>[]" value="<?php echo $dtnPembayaran['BAYAR_RUPIAH'] ?>" class="span2" id="setor_rp_<?php echo $m ?>_<?php echo $s ?>" onkeyup=hitungrp('<?php echo $m ?>','<?php echo $s ?>')>
									</div>
								</td>
								<td>
									<div class="input-prepend-edit">
										<span class="add-on">$</span><input type="text" name="jml_bayar_usd<?php echo $m ?>[]" value="<?php echo $dtnPembayaran['BAYAR_LAINNYA'] ?>" class="span2" id="setor_usd_<?php echo $m ?>_<?php echo $s ?>" onkeyup=hitungusd('<?php echo $m ?>','<?php echo $s ?>')>
									</div>
								</td>
								<td>
									<div class="input-prepend-edit">
										<span class="add-on">Rp.</span><input type="text" name="sisa_rp<?php echo $m ?>[]" value="<?php echo $dtnPembayaran['SISA_RUPIAH'] ?>" class="span2" id="sisa_rp_<?php echo $m ?>_<?php echo $s ?>" >
									</div>
								</td>
								<td>
									<div class="input-prepend-edit">
										<span class="add-on">$</span><input type="text" name="sisa_usd<?php echo $m ?>[]" value="<?php echo $dtnPembayaran['SISA_LAINNYA'] ?>" class="span2" id="sisa_usd_<?php echo $m ?>_<?php echo $s ?>" >
									</div>
								</td>
								<td>
									<div class="input-prepend-edit-date">
										<input type="text" class="datepicker span2-edit datepicker" name="tgl_bayar<?php echo $m ?>[]" value="<?php echo $dtnPembayaran['TGL_BUKTI_SETOR'] ?>">
									</div>
								</td>
								<td>
									<input type="button" class="btn btn-danger" value="Hapus">
								</td>
							</tr>
							<?php $s++; endforeach;?>
                                                        <input type="hidden" name="hdnpembayaran" id="hdnpembayaran<?php echo $m ?>" value="<?php echo $s-1 ?>">
						</tbody>
					</table>
				</div>
				<div class="form-row">&nbsp;</div>
				<div class="form-inline">
					<label class="span2">Keterangan</label>
					<textarea class="span4" name="keterangan[]"><?php echo $pup['KETERANGAN'] ?></textarea>
				</div>
			</div>
		<?php $m++; endforeach; ?>
	</div>
	<input type="submit" class="btn btn-warning" value="Simpan">
</form>
<script type="text/javascript">
	$(function () {
		$('#tabTersangka a:first').tab('show');
	
		$( ".datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: "<?php echo image_path('calendar.gif') ?>",
			buttonImageOnly: true,
			yearRange: '1910:+0',
			dateFormat: 'dd-mm-yy',
		});
	})
	
	
	function tambahup(value){
		
		if($("#hdnpembayaran"+value).val() == null){
			var noterakhir=0;
			var randomnumber=parseInt(noterakhir)+1;
		}else{
			var noterakhir=$("#hdnpembayaran"+value).val();
			var randomnumber=parseInt(noterakhir)+1;
                        alert(randomnumber);
		}
		
		$("#hdnpembayaran"+value).val(randomnumber);
		
		$("#tblup"+value).append(
			'<tr id="datatr'+value+'_'+randomnumber+'">'+
				'<td>'+
					'<div class="input-prepend-edit">'+
						'<span class="add-on">Rp.</span><input type="text" name="new_jml_bayar_rp'+value+'[]" class="span2" id="setor_rp_'+value+'_'+randomnumber+'" onkeyup=hitungrp(\''+value+'\',\''+randomnumber+'\')>'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<div class="input-prepend-edit">'+
						'<span class="add-on">$</span><input type="text" name="new_jml_bayar_usd'+value+'[]" class="span2" id="setor_usd_'+value+'_'+randomnumber+'" onkeyup=hitungusd(\''+value+'\',\''+randomnumber+'\') >'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<div class="input-prepend-edit">'+
						'<span class="add-on">Rp.</span><input type="text" name="new_sisa_rp'+value+'[]" class="span2" id="sisa_rp_'+value+'_'+randomnumber+'" >'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<div class="input-prepend-edit">'+
						'<span class="add-on">$</span><input type="text" name="new_sisa_usd'+value+'[]" class="span2" id="sisa_usd_'+value+'_'+randomnumber+'" >'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<div class="input-prepend-edit-date">' +
						'<input type="text" class="datepicker span2-edit datepicker" name="new_tgl_bayar'+value+'[]">'+
					'</div>' +
				'</td>'+
				'<td>'+
					'<input type="button" class="btn btn-danger" value="Hapus">'+
				'</td>'+
			'</tr>'
		);
		
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
	
	function hitungrp(tab,row)
	{
		var rowIndex = $("#datatr"+tab+"_"+row).closest('tr').prevAll().length +1;
		var jumlahrow =$("#tblup"+tab+" tr").length ;
		
		if(rowIndex == 1){
		//alert("rowindex"+rowIndex+"jumlahrow"+jumlahrow);
		   var besarDenda= $("#pup_diputus_rp"+tab).val();  
		   $("#setor_rp_"+tab+"_"+row).live('keyup',function () {
			   if(parseInt($(this).val()) > parseInt(besarDenda)){
					alert('Jumlah Cicilan Lebih Besar Dari Besar Denda');
					$(this).val("0")
					return false;
			   }
			   var besarSisaDenda= parseInt(besarDenda)-parseInt($(this).val());
			   $("#sisa_rp_"+tab+"_"+row).val(besarSisaDenda);
			   if($(this).val()==null ||$(this).val()==""){
				  $("#sisa_rp_"+tab+"_"+row).val("");
			   }
		   });//end live func
		}else{
			//alert("rowindex1 "+rowIndex+"jumlahrow1 "+jumlahrow);
		   var sisaBesarDenda= $("#sisa_rp_"+tab+"_"+(row-1)).val(); 
		   //alert(sisaBesarDenda);
		   $("#setor_rp_"+tab+"_"+row).live('keyup',function () {
			   if(parseInt($(this).val()) > parseInt(sisaBesarDenda)){
					alert('Jumlah Cicilan Lebih Besar Dari Besar Denda11');
					$(this).val("0")
					return false;
			   }
			   var besarSisaDenda= parseInt(sisaBesarDenda)-parseInt($(this).val());
			   $("#sisa_rp_"+tab+"_"+row).val(besarSisaDenda);
			   if($(this).val()==null ||$(this).val()==""){
				  $("#sisa_rp_"+tab+"_"+row).val("");
			   }
		   });//end live func
		}
	}
	
	function hitungusd(tab,row)
	{
		var rowIndex = $("#datatr"+tab+"_"+row).closest('tr').prevAll().length +1;
		var jumlahrow =$("#tblup"+tab+" tr").length ;
		
		if(rowIndex == 1){
		//alert("rowindex"+rowIndex+"jumlahrow"+jumlahrow);
		   var besarDenda= $("#pup_diputus_usd"+tab).val();  
		   $("#setor_usd_"+tab+"_"+row).live('keyup',function () {
			   if(parseInt($(this).val()) > parseInt(besarDenda)){
					alert('Jumlah Cicilan Lebih Besar Dari Besar Denda');
					$(this).val("0")
					return false;
			   }
			   var besarSisaDenda= parseInt(besarDenda)-parseInt($(this).val());
			   $("#sisa_usd_"+tab+"_"+row).val(besarSisaDenda);
			   if($(this).val()==null ||$(this).val()==""){
				  $("#sisa_usd_"+tab+"_"+row).val("");
			   }
		   });//end live func
		}else{
			//alert("rowindex1 "+rowIndex+"jumlahrow1 "+jumlahrow);
		   var sisaBesarDenda= $("#sisa_usd_"+tab+"_"+(row-1)).val(); 
		   //alert(sisaBesarDenda);
		   $("#setor_usd_"+tab+"_"+row).live('keyup',function () {
			   if(parseInt($(this).val()) > parseInt(sisaBesarDenda)){
					alert('Jumlah Cicilan Lebih Besar Dari Besar Denda11');
					$(this).val("0")
					return false;
			   }
			   var besarSisaDenda= parseInt(sisaBesarDenda)-parseInt($(this).val());
			   $("#sisa_usd_"+tab+"_"+row).val(besarSisaDenda);
			   if($(this).val()==null ||$(this).val()==""){
				  $("#sisa_usd_"+tab+"_"+row).val("");
			   }
		   });//end live func
		}
	}
</script>
