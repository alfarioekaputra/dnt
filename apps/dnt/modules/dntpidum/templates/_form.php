<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<form action="<?php echo url_for('dntpidum/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<input type="hidden" name="nilaiConter" id="nilaiConter">
<?php endif; ?>
<div class="form-inline">
  <label>
    No. Perkara
  </label>
  <input type="text" name="nomor_perkara" />
  <select name="apb_aps" class="span1">
    <option value="1" selected="true">Apb</option>
    <option value="2">Aps</option>
  </select>
</div>
<div>&nbsp;</div>
<button type="button" id="add_tersangka" >Tambah Terdakwa</button>
<ul class="nav nav-tabs" id="myTab">
  
</ul>
<div class="tab-content">
  
</div>
<hr />
<legend><b>Posisi Kasus</b></legend>
<div class="form-inline">
  <label class="span3-label">Posisi Kasus</label>
  <textarea name="posisi_kasus" class="span5" style="height: 100px;"></textarea>
</div>
<hr />
<legend><b>Barang Rampasan</b></legend>
<div style="overflow-x:scroll">
  <table class="table">
    <thead>
      <tr>
        <th>No. Perkara</th>
        <th>Jenis Barang</th>
        <th>No. BA Lelang</th>
        <th>Hasil Lelang</th>
        <th>Setor</th>
        <th>No. Bukti Setor</th>
        <th>Tanggal Setor</th>
        <th>Status</th>
        <th>Tambah</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <input type="text" name="br_no_perkara[]" class="span2">
        </td>
        <td>
          <input type="text" name="br_jenis_barang[]" class="span2">
        </td>
        <td>
          <input type="text" name="br_no_ba_lelang[]" class="span2">
        </td>
        <td>
          <div class="input-prepend-edit">
            <span class="add-on">Rp.</span><input type="text" name="br_hasil_lelang[]" class="span2">
          </div>
        </td>
        <td>
          <div class="input-prepend-edit">
            <span class="add-on">Rp.</span><input type="text" name="br_setor[]" class="span2">
          </div>
        </td>
        <td>
          <input type="text" name="br_no_bukti_setor[]" class="span2">
        </td>
        <td>
          <div class="input-prepend-edit-date">
            <input type="text" name="br_tgl_setor[]" class="datepicker span2-edit">
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<input type="submit" value="Simpan" class="btn btn-warning" />
</form>
<script type="text/javascript">
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
  

  var tab_counter = 1;
	var addtab=1;

  function addTab() {
      $('.tab-content').append(
        '<div class="tab-pane in active" id="new_tab_id'+addtab+'">' +
          '<div class="row">' +
            '<div class="span5">' +
              '<label>Nama</label>' +  '<?php echo $form['nama']->render(array('name' => 'nama_terdakwa[]', 'class' => 'span3')) ?>' +
              '<label>Tempat/Tanggal Lahir</label>' + '<?php echo $form['tempat_lahir']->render(array('name' => 'tempat_lahir[]', 'class' => 'span3-edit')) ?>' +  '<input type="text" id="data_tgllahir'+addtab+'" onChange=addtgllahir("'+addtab+'") class="datepicker span2-edit" name="tgl_lahir[]" maxlength="10">' +
              '<label>Usia</label>' +  '<input type="text" id = "data_umur'+addtab+'" class="span1" name="umur[]" readonly="true">' +
              '<label>Jenis Kelamin</label>' +
                '<select name="jkl[]" class="span2" id="jkl">'+
                  '<option value="" selected="selected">Pilih</option>'+
                  <?php foreach($jkl_db as $jkl_db): ?>
                  '<option value="<?php echo $jkl_db->getId() ?>"><?php echo $jkl_db->getNama() ?></option>'+
                  <?php endforeach; ?>
                '</select>' +
              '<label>Alamat</label>' +  '<?php echo $form['alamat']->render(array('name' => 'alamat[]', 'class' => 'span4')) ?> ' +
            '</div>' +
            
            '<div class="span3"> ' +
              '<label>Agama</label>' +
                '<select name="id_agama[]" class="span2" id="jkl">'+
                  '<option value="" selected="selected">Pilih</option>'+
                  <?php foreach($agama_db as $agama_db): ?>
                  '<option value="<?php echo $agama_db->getId() ?>"><?php echo $agama_db->getNama() ?></option>'+
                  <?php endforeach; ?>
                '</select>' +
              '<label>Pekerjaan</label>' +  '<?php echo $form['pekerjaan']->render(array('name' => 'pekerjaan[]', 'class' => 'span3')) ?>' +
              '<label>Kewarganegaraan</label>' +  '<?php echo $form['kewarganegaraan']->render(array('name' => 'kewarganegaraan[]', 'class' => 'span3')) ?>' +
              '<label>Pendidikan</label>' +
                '<select name="pendidikan[]" class="span2" id="jkl">'+
                  '<option value="" selected="selected">Pilih</option>'+
                  <?php foreach($pendidikan_db as $pendidikan_db): ?>
                  '<option value="<?php echo $pendidikan_db->getId() ?>"><?php echo $pendidikan_db->getNama() ?></option>'+
                  <?php endforeach; ?>
                '</select>' +
            '</div>' + 
          '</div>' +
          '<hr />' +
          '<legend><b>Putusan Inkrah</b></legend>'+
          '<div class="form-inline">'+
            '<label class="span3-label">No. Amar Putusan Inkrah</label>'+
              '<input type="text" name="no_amar_putusan_inkrah[]" class="span3" /> <input type="text" name="tgl_putusan_inkrah[]" class="datepicker span2-edit" />'+
              '<select class="span1" name="jns_pengadilan_putusan[]">'+
                  '<option value="1">PN</option>'+
                  '<option value="2">PT</option>'+
                  '<option value="3">MA</option>'+
                '</select>'+
          '</div>'+
          '<div class="row">&nbsp;</div>'+
          '<div class="form-inline">'+
            '<div style="margin-right:0px; float:right;"><input type="button" id="add_pasal1" onclick=addpasal("'+addtab+'") value="Tambah" class="btn btn-warning"></div>'+
            '<label class="span3-label"></label>'+
            'Pasal Didakwakan <br /><br />'+ 
            '<div id="divPasalDakwa'+addtab+'" style="margin-left:220px; float:left;">'+
              '<textarea name="pasal_didakwakan'+addtab+'[]" id="pasal_didakwakan'+addtab+'" class="span4"></textarea>'+
            '</div>'+
          '</div>'+
          '<div class="row">&nbsp;</div>'+
          '<div class="form-inline">'+
            '<label class="span3-label">Jenis Putusan</label>'+
              '<select class="span3" name="jns_putusan[]" id="jns_putusan'+addtab+'" onChange=pilihJnsPutusan("'+addtab+'")>'+
                  '<option value="0">Pilih Jenis Putusan</option>'+
                  '<option value="1">Pidana Mati</option>'+
                  '<option value="2">Seumur Hidup</option>'+
                  '<option value="3">Pidana Penjara</option>'+
                  '<option value="4">Pidana Kurungan-Denda</option>'+
                  '<option value="5">Bebas</option>'+
                  '<option value="6">Pidana Bersyarat/Percobaan</option>'+
                  '<option value="7">Pidana Pengawasan</option>'+
                '</select>'+
          '</div>'+
            //div yang ditampilkan berdasarkan jenis pututsan
            '<div id="pidana_mati_seumur_hidup'+addtab+'" style="display:none;">'+
              '<label class="span3-label">&nbsp;</label>'+
              'Biaya Perkara &nbsp; <div class="input-prepend"><span class="add-on">Rp.</span><input type="text" id="biaya_perkara" name="biaya_perkara[]" class="span2 numeric mirror'+addtab+'" onkeyup=mirror("'+addtab+'") /></div>'+
            '</div>'+
            '<div id="seumur_hidup'+addtab+'" style="display:none;">'+
              '<label class="span3-label">&nbsp;</label>'+
              'Biaya Perkara &nbsp; <div class="input-prepend"><span class="add-on">Rp.</span><input type="text" id="biaya_seumur_hidup mirror'+addtab+'" name="biaya_seumur_hidup[]" class="span2 numeric" mirror'+addtab+'" onkeyup=mirror("'+addtab+'") /></div>'+
            '</div>'+
            '<div id="pidana_penjara'+addtab+'" style="display:none; background-color:#FFFFFF;">'+
              '<legend>Pidana Penjara:</legend>'+
              '<label class="span3-label">Pidana Badan</label>'+
                '<div class="input-prepend">'+
                  '<input class="span1" id="pj_badan_tahun" size="16" type="text" name="pj_badan_tahun[]"><span class="add-on">Tahun</span>'+
                  '<input class="span1" id="pj_badan_bulan" size="16" type="text" name="pj_badan_bulan[]"><span class="add-on">Bulan</span>'+
                  '<input class="span1" id="pj_badan_hari" size="16" type="text" name="pj_badan_hari[]"><span class="add-on">Hari</span>'+
                '</div>'+
              '<label class="span3-label">Denda</label>'+
                '<div class="input-prepend">'+
                  '<span class="add-on">Rp.</span><input class="span2" id="denda" size="16" type="text" name="pj_denda[]">'+
                '</div>'+
              '<label class="span3-label">Subsidair</label>'+
                '<div class="input-prepend">'+
                  '<input class="span1" id="pj_subsidair_tahun" size="16" type="text" name="pj_subsidair_tahun[]"><span class="add-on">Tahun</span>'+
                  '<input class="span1" id="pj_subsidair_bulan" size="16" type="text" name="pj_subsidair_bulan[]"><span class="add-on">Bulan</span>'+
                  '<input class="span1" id="pj_subsidair_hari" size="16" type="text" name="pj_subsidair_hari[]"><span class="add-on">Hari</span>'+
                '</div>'+
              '<label class="span3-label">Biaya Perkara</label>'+
                '<div class="input-prepend">'+
                  '<span class="add-on">Rp.</span><input class="span2" id="pj_biaya_perkara" size="16" type="text" name="pj_biaya_perkara[]">'+
                '</div>'+
              '<label class="span3-label">Pidana Tambahan</label>'+
                '<textarea rows="3" name="pj_pidana_tambahan[]"></textarea>'+
              '<legend>&nbsp;</legend>'+
            '</div>'+
            '<div id="pidana_kurungan_denda'+addtab+'" style="display:none; background-color:#FFFFFF">'+
              '<legend>Pidana Kurungan:</legend>'+
              '<label class="span3-label">Kurungan</label>'+
                '<div class="input-prepend">'+
                  '<input class="span1" id="pk_kurungan_tahun" size="16" type="text" name="pk_kurungan_tahun[]"><span class="add-on">Tahun</span>'+
                  '<input class="span1" id="pk_kurungan_bulan" size="16" type="text" name="pk_kurungan_bulan[]"><span class="add-on">Bulan</span>'+
                  '<input class="span1" id="pk_kurungan_hari" size="16" type="text" name="pk_kurungan_hari[]"><span class="add-on">Hari</span>'+
                '</div>'+
              '<label class="span3-label">Denda</label>'+
                '<div class="input-prepend">'+
                  '<span class="add-on">Rp.</span><input class="span2" id="pk_denda" size="16" type="text" name="pk_denda[]">'+
                '</div>'+
              '<label class="span3-label">Biaya Perkara</label>'+
                '<div class="input-prepend">'+
                  '<span class="add-on">Rp.</span><input class="span2" id="pk_biaya_perkara" size="16" type="text" name="pk_biaya_perkara[]">'+
                '</div>'+
              '<label class="span3-label">Pidana Tambahan</label>'+
                '<textarea rows="3" name="pk_pidana_tambahan"></textarea>'+
              '<legend>&nbsp;</legend>'+
            '</div>'+
            '<div id="pidana_bersyarat'+addtab+'" style="display:none; background-color:#FFFFFF">'+
              '<legend>Pidana Bersyarat/Percobaan:</legend>'+
              '<label class="span3-label">Pidana Badan</label>'+
                '<div class="input-prepend">'+
                  '<input class="span1" id="pb_badan_tahun" size="16" type="text" name="pb_badan_tahun[]"><span class="add-on">Tahun</span>'+
                  '<input class="span1" id="pb_badan_bulan" size="16" type="text" name="pb_badan_bulan[]"><span class="add-on">Bulan</span>'+
                  '<input class="span1" id="pb_badan_hari" size="16" type="text" name="pb_badan_hari[]"><span class="add-on">Hari</span>'+
                '</div>'+
              '<label class="span3-label">Masa Percobaan</label>'+
                '<div class="input-prepend">'+
                  '<input class="span1" id="pb_percobaan_tahun" size="16" type="text" name="pb_percobaan_tahun[]"><span class="add-on">Tahun</span>'+
                  '<input class="span1" id="pb_percobaan_bulan" size="16" type="text" name="pb_percobaan_bulan[]"><span class="add-on">Bulan</span>'+
                  '<input class="span1" id="pb_percobaan_hari" size="16" type="text" name="pb_percobaan_hari[]"><span class="add-on">Hari</span>'+
                '</div>'+
              '<label class="span3-label">Denda</label>'+
                '<div class="input-prepend">'+
                  '<span class="add-on">Rp.</span><input class="span2" id="pb_denda" size="16" type="text" name="pb_denda[]">'+
                '</div>'+
              '<label class="span3-label">Subsidair</label>'+
                '<div class="input-prepend">'+
                  '<input class="span1" id="pb_subsidair_tahun" size="16" type="text" name="pb_subsidair_tahun[]"><span class="add-on">Tahun</span>'+
                  '<input class="span1" id="pb_subsidair_bulan" size="16" type="text" name="pb_subsidair_bulan[]"><span class="add-on">Bulan</span>'+
                  '<input class="span1" id="pb_subsidair_hari" size="16" type="text" name="pb_subsidair_hari[]"><span class="add-on">Hari</span>'+
                '</div>'+
              '<label class="span3-label">Biaya Perkara</label>'+
                '<div class="input-prepend">'+
                  '<span class="add-on">Rp.</span><input class="span2" id="pb_biaya_perkara" size="16" type="text" name="pb_biaya_perkara[]">'+
                '</div>'+
              '<label class="span3-label">Pidana Tambahan</label>'+
                '<textarea rows="3" name="pb_pidana_tambahan[]"></textarea>'+
              '<legend>&nbsp;</legend>'+
            '</div>'+
            '<div id="pidana_pengawasan'+addtab+'" style="display:none; background-color:#FFFFFF">'+
              '<legend>Pidana Pengawasan:</legend>'+
              '<div class="form-inline">'+
                '<label class="span3-label">Pidana Pengawasan</label>'+
                  '<select name="pp_combo[]">'+
                    '<option value="0">Pilih Jenis Pidana Pengawasan</option>'+
                    '<option value="1">Dikembalikan Kepada Orang Tua</option>'+
                    '<option value="0">Diserahkan Kepada Negara</option>'+
                  '</select>'+
              '</div>'+
              '<label class="span3-label">Biaya Perkara</label>'+
                '<div class="input-prepend">'+
                  '<span class="add-on">Rp.</span><input class="span2" id="pp_biaya_perkara" size="16" type="text" name="pp_biaya_perkara[]">'+
                '</div>'+
              '<legend>&nbsp;</legend>'+
            '</div>'+
            //end div yang ditampilakan berdasarkan jenis putusan-
          '<div class="row">&nbsp;</div>'+
          '<div class="form-inline">'+
            '<label class="span3-label">Tanggal P.48</label>'+
              '<input type="text" name="tgl_p48[]" class="datepicker span2-edit" />'+
              '&nbsp;Tanggal BA Eksekusi &nbsp; <input type="text" name="tgl_ba_eksekusi[]" class="datepicker span2-edit" />'+
          '</div>'+
          '<div class="row">&nbsp;</div>'+
          '<div class="form-inline">'+
            '<label class="span3-label">Tempat Penahanan</label>'+
              '<select class="span2" name="jns_tahanan[]">'+
                  '<option value="0">--Pilih--</option>'+
                  '<option value="1">Rutan</option>'+
                  '<option value="2">Kota</option>'+
                  '<option value="3">Rumah</option>'+
                '</select>'+
              '<input type="text" name="tgl_penahanan_mulai[]" class="datepicker span2-edit" /> s/d <input type="text" name="tgl_penahanan_selesai[]" class="datepicker span2-edit" />'+
          '</div>'+
          '<div class="row">&nbsp;</div>'+
          '<div class="form-inline">'+
            '<label class="span3-label">Keterangan Penahanan</label>'+
              '<input type="text" name="keterangan_tahanan[]" class="span5" />'+
          '</div>'+
          '<div class="row">&nbsp;</div>'+
          '<hr />'+
          '<br />'+
          '<legend><b>Hasil Dinas</b></legend>'+
          '<div class="form-inline">'+
            '<label>Amar Putusan</label>&nbsp;'+
            '<div class="input-prepend">'+
              '<span class="add-on">Rp.</span><input type="text" id="denda_hsl_dinas'+addtab+'" name="denda_hsl_dinas[]" class="span2 uang'+addtab+'" />'+
            '</div>'+
          '</div>'+
          '<div style="overflow-x:scroll;">'+
            '<legend>Pembayaran Denda</legend>'+
            '<table class="table" id="tbl_denda'+addtab+'">'+
              '<input type="hidden" name="hdnpembayaran" id="hdnpembayaran" value="0">'+
              '<thead>'+
                '<tr>'+
                  '<th><input type="button" class="btn btn-warning" value="tambah" id="tambah_denda'+addtab+'" onClick=tambahDenda("'+addtab+'")></th>'+
                  '<th>Setor</th>'+
                  '<th>Sisa</th>'+
                  '<th>No. SSBP</th>'+
                  '<th>Tanggal SSBP</th>'+
                  '<th>No. Bukti Setor</th>'+
                  '<th>Tanggal Setor</th>'+
                  '<th>Keterangan</th>'+
                  '<th></th>'+
                '</tr>'+
              '</thead>'+
              '<tbody>'+
                
              '</tbody>'+
            '</table>'+
          '</div>'+
          '<div style="overflow-x:scroll;">'+
            '<table class="table">'+
              '<thead>'+
                '<tr>'+
                  '<th></th>'+
                  '<th>Amar Putusan</th>'+
                  '<th>Setor</th>'+
                  '<th>No. SSBP</th>'+
                  '<th>Tanggal SSBP</th>'+
                  '<th>No. Bukti Setor</th>'+
                  '<th>Tanggal Setor</th>'+
                '</tr>'+
              '</thead>'+
              '<tbody>'+
                '<tr>'+
                  '<td>Biaya Perkara</td>'+
                  '<td>'+
                    '<div class="input-prepend-edit">'+
                      '<span class="add-on">Rp.</span><input type="text" name="bp_amar_putusan[]" id="bp_amar_putusan'+addtab+'" class="span2 numeric">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                    '<div class="input-prepend-edit">'+
                      '<span class="add-on">Rp.</span><input type="text" name="bp_setor[]" class="span2">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" name="bp_no_ssbp[]" class="span2">'+
                  '</td>'+
                  '<td>'+
                    '<div class="input-prepend-edit-date">'+
                      '<input type="text" name="bp_tgl_ssbp[]" class="datepicker span2-edit">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" name="bp_no_bukti_setor[]" class="span2">'+
                  '</td>'+
                  '<td>'+
                    '<div class="input-prepend-edit-date">'+
                      '<input type="text" name="bp_tgl_setor[]" class="datepicker span2-edit">'+
                    '</div>'+
                  '</td>'+
                '</tr>'+
              '</tbody>'+
            '</table>'+
          '</div>'+
        '</div>'+
      '</div>'
      );
      $('#myTab').append('<li id="tab_li'+addtab+'"><a href="#new_tab_id'+addtab+'" data-toggle="tab">Terdakwa '+addtab+' <span class="" onClick=dlttabtersangka("'+addtab+'","'+nourut+'") > | <i class="icon-remove-sign"></i></span></a></li>');
      $('#myTab a:last').tab('show');
      
      addtab++;
  }
  
  function pilihJnsPutusan(nilai)
  {
    var combo = $("#jns_putusan" + nilai).val();
    if(combo=='0'){
      $("#pidana_mati_seumur_hidup" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='1'){
      $("#pidana_mati_seumur_hidup" + nilai).show();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='2'){
      $("#pidana_mati_seumur_hidup" + nilai).show();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='3'){
      $("#pidana_mati_seumur_hidup" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).show();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='4'){
      $("#pidana_mati_seumur_hidup" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).show();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='5'){
      $("#pidana_mati_seumur_hidup" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='6'){
      $("#pidana_mati_seumur_hidup" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).show();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='7'){
      $("#pidana_mati_seumur_hidup" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).show();
    }
  }

  var IdPasalDakwa = 1;
  function addpasal(sRowId){
    $("#divPasalDakwa"+sRowId).append('<br /><textarea name="pasal_didakwakan'+sRowId+'[]" id="pasal_didakwakan'+IdPasalDakwa+'" class="span4"></textarea> &nbsp;<input type="button" class="btn btn-danger" value="-" id="close_pasal'+IdPasalDakwa+'" onClick=deletePasalDakwa("'+IdPasalDakwa+'")>');
    IdPasalDakwa++;
  }
  
  count = 1;
  function tambahDenda(value){
    var noterakhir=$("#hdnpembayaran").val();
    var randomnumber=parseInt(noterakhir)+1;
    $("#hdnpembayaran").val(randomnumber);
    
    $("#tbl_denda"+value).append(
        '<tr id="datatr'+randomnumber+'">'+
          '<td></td>'+
          '<td>'+
            '<div class="input-prepend-edit">'+
               '<span class="add-on">Rp.</span><input type="text" name="denda_setor'+value+'[]" class="span2 setor'+randomnumber+'" onkeyup=hitung("'+randomnumber+'") >'+
            '</div>'+
          '</td>'+
          '<td>'+
            '<div class="input-prepend-edit">'+
               '<span class="add-on">Rp.</span><input type="text" name="denda_sisa'+value+'[]" class="span2 sisa'+randomnumber+'">'+
            '</div>'+
          '</td>'+
          '<td>'+
            '<input type="text" name="denda_ssbp'+value+'[]" class="span2">'+
          '</td>'+
          '<td>'+
            '<div class="input-prepend-edit-date">'+
               '<input type="text" id="denda_tgl_ssbp'+count+'" name="denda_tgl_ssbp'+value+'[]" class="datepicker span2-edit">'+
            '</div>'+
          '</td>'+
          '<td>'+
            '<input type="text" name="denda_bukti_setor'+value+'[]" class="span2">'+
          '</td>'+
          '<td>'+
            '<div class="input-prepend-edit-date">'+
              '<input type="text" id="denda_tgl_setor'+count+'" name="denda_tgl_setor'+value+'[]" class="datepicker span2-edit">'+
            '</div>'+
          '</td>'+
          '<td>'+
            '<input type="text" name="denda_keterangan'+value+'[]" class="span2">'+
          '</td>'+
          '<td>'+
            '<input type="button" class="btn btn-danger" value="-" id="hapus_denda'+randomnumber+'" onClick=deleteDenda("'+randomnumber+'")>'+
          '</td>'+
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

  function addtgllahir(sRowId)
    {
       /* DAY_MSECONDS = 1000 * 60 * 60 * 24;
        var sundayCheck = 0;
        var totalDays = 0;


        sundayCheck = new Date($("#data_tgllahir" + sRowId ).datepicker("getDate"));

        var d1_ms = sundayCheck.getYear();
        date_obj = new Date();
        var waktu = date_obj.getYear();
        var umur = waktu - d1_ms;
        $('#data_umur'+ sRowId).val(umur);*/
		
		var d =$("#data_tgllahir" + sRowId ).val().split('-'); 
				var today=new Date(); 
				var bday=new Date(d[2],d[1],d[0]); 
				var by=bday.getFullYear(); 
				var bm=bday.getMonth()-1; 
				var bd=bday.getDate(); 
				var age=0; var dif=bday; 
				while(dif<=today){ 
				var dif = new Date(by+age,bm,bd); 
				age++; 
				} 
				age +=-2 ; 
					 $('#data_umur'+ sRowId).val(age);

    }
  
  function handeltgl(root)
    {
        if (root == null)  root = $(document);

        root.find(".datepicker").datepicker('destroy').datepicker({
            showOn: 'button',
            changeMonth: true,
            changeYear: true,
	    yearRange: '1910:today',
            buttonImage: '<?php echo image_path('calendar.gif') ?>',
            buttonImageOnly: true,
            dateFormat: 'dd-mm-yy'
        });
    }
  
  function dlttabtersangka(sRowId,nourut)
    {
		//alert(sRowId);
        $('#tab_li'+sRowId).remove();
        $('#new_tab_id'+sRowId).remove();
        $('#myTab a:last').tab('show');
        //var $tabs = $('#new_tab_id1').tab();
        //$tabs.tab('hide', sRowId);
		//tab_counter--;
		//var nilai_id_tambahTab = $("#id_tambahTab-"+nourut).val();
  		//var b= parseInt(nilai_id_tambahTab)-1;
 		 //$("#id_tambahTab-"+nourut).val(b);
		// alert(b);

    }

  function deletePasalDakwa(value)
  {
    $('#pasal_didakwakan'+value).remove();
    $('#close_pasal'+value).remove();
  }
  
  function deleteDenda(value)
  {
    $('#datatr'+value).remove();
  }
  var nourut = 2;
  
  $('#add_tersangka').button().click(function()
    {
        addTab();
        handeltgl($(document));
    });
  
  
  
  $("#add_tersangka").click(function() {
        $('#nilaiConter').val(tab_counter-1);
    });

  $(document).ready(function(){
    $('.numeric').live('keyup', function (e) {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
    
    /*$("#biaya_perkara_mati").live('keyup', function(){
      $("#denda_hsl_dinas1").val($(this).val());
    });

    $("#biaya_seumur_hidup").live('keyup', function(){
      $("#denda_hsl_dinas1").val($(this).val());
    });*/
  });
  
  function mirror(value)
  {
    $("#bp_amar_putusan"+value).val($('.mirror'+value).val());
  }
  
  function hitung(value)
  {
    var uang  = parseInt($('.uang'+value).val());
    var setor = parseInt($('.setor'+value).val());
    
    $("#tbl_denda1").each(function() {
      $this = $(this)
      if($("input.setor"+value).attr('class') == 'span2 setor1'){
        var sisa  = uang - setor;
        $('.sisa1').val(sisa);
      }else{
        var k = value - 1;
        var j = value + 1;
        
        var a = $("input.sisa"+k).val();
        var b = $("input.setor"+value).val();
        
        var sisa2 = a - b;
        $('.sisa'+value).val(sisa2);
        //alert($("input.sisa"+value).toggleClass('span2 sisa2 span2 asdf'));
        
      }
      
    });    
    
    /*var uang  = parseInt($('.uang'+value).val());
    var setor = parseInt($('.setor'+value).val());
    
    var abc = value ++;
    
    //alert(abc);
    
    var setor2 = parseInt($('.setor'+abc).val());
    
    var sisa  = uang - setor;
    $('.sisa'+value).val(sisa);
    
    var sisa2 = $('.sisa1').val() - setor2;
    $('.sisa2').val(sisa2);*/
    
  }
  
</script>