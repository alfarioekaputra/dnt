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
<div class="tab-content tersangka">
  
</div>
<hr />
<legend><b>Posisi Kasus</b></legend>
<div class="form-inline">
  <label class="span3-label">Posisi Kasus</label>
  <textarea name="posisi_kasus" class="span5" style="height: 100px;"></textarea>
</div>
<hr />
 
<legend><b>Barang Rampasan</b><br /> <a class="btn btn-warning" data-toggle="modal" href="http://localhost/dnt/web/dnt" data-target="#myModal" >Tambah</a></legend>
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
<!-- Modal -->
<div id="myModal" class="modal large hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Barang Bukti</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <!--<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>-->
    <button class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>
<script type="text/javascript">
  $(document).ready(function() {
        $('.modal-body').load("<?php echo url_for('barangRampasan/new') ?>");
   
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
      $('.tab-content.tersangka').append(
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
              'Biaya Perkara &nbsp; <div class="input-prepend"><span class="add-on">Rp.</span><input type="text" id="biaya_perkara'+addtab+'" name="biaya_perkara[]" class="span2 numeric mirror'+addtab+'" onkeyup=mirror("'+addtab+'") /></div>'+
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
                  '<span class="add-on">Rp.</span><input class="span2 numeric" id="denda'+addtab+'" size="16" type="text" name="pj_denda[]" onkeyup=mirror("'+addtab+'")>'+
                '</div>'+
              '<label class="span3-label">Subsidair</label>'+
                '<div class="input-prepend">'+
                  '<input class="span1" id="pj_subsidair_tahun" size="16" type="text" name="pj_subsidair_tahun[]"><span class="add-on">Tahun</span>'+
                  '<input class="span1" id="pj_subsidair_bulan" size="16" type="text" name="pj_subsidair_bulan[]"><span class="add-on">Bulan</span>'+
                  '<input class="span1" id="pj_subsidair_hari" size="16" type="text" name="pj_subsidair_hari[]"><span class="add-on">Hari</span>'+
                '</div>'+
              '<label class="span3-label">Biaya Perkara</label>'+
                '<div class="input-prepend">'+
                  '<span class="add-on">Rp.</span><input class="span2 numeric" id="pj_biaya_perkara'+addtab+'" size="16" type="text" name="pj_biaya_perkara[]" onkeyup=mirror("'+addtab+'")>'+
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
                  '<span class="add-on">Rp.</span><input class="span2" id="pk_denda'+addtab+'" size="16" type="text" name="pk_denda[]" onkeyup=mirror("'+addtab+'")>'+
                '</div>'+
              '<label class="span3-label">Biaya Perkara</label>'+
                '<div class="input-prepend">'+
                  '<span class="add-on">Rp.</span><input class="span2" id="pk_biaya_perkara'+addtab+'" size="16" type="text" name="pk_biaya_perkara[]" onkeyup=mirror("'+addtab+'")>'+
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
          '<div id="hasil_dinas'+addtab+'" style="display:none;">'+
            '<legend><b>Hasil Dinas</b></legend>'+
            '<div class="form-inline">'+
              '<label>Amar Putusan</label>&nbsp;'+
              '<div class="input-prepend">'+
                '<span class="add-on">Rp.</span><input type="text" id="denda_hsl_dinas'+addtab+'" name="denda_hsl_dinas[]" class="span2 uang'+addtab+'" />'+
              '</div>'+
            '</div>'+
            '<div style="overflow-x:scroll;">'+
              '<legend>Pembayaran Denda</legend>'+
              '<table class="table table-bordered" id="tbl_denda'+addtab+'">'+
                '<input type="hidden" name="hdnpembayaran" id="hdnpembayaran'+addtab+'" value="0">'+
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
          '</div>'+
          '<div id="bp'+addtab+'" style="display:none;">'+
            '<div style="overflow-x:scroll;">'+
              '<table class="table table-bordered">'+
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
      $("#hasil_dinas" + nilai).hide();
      $("#bp" + nilai).hide();
    }else if(combo=='1'){
      $("#pidana_mati_seumur_hidup" + nilai).show();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
      $("#hasil_dinas" + nilai).hide();
      $("#bp" + nilai).show();
    }else if(combo=='2'){
      $("#pidana_mati_seumur_hidup" + nilai).show();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
      $("#hasil_dinas" + nilai).hide();
      $("#bp" + nilai).show();
    }else if(combo=='3'){
      $("#pidana_mati_seumur_hidup" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).show();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
      $("#hasil_dinas" + nilai).show();
      $("#bp" + nilai).show();
    }else if(combo=='4'){
      $("#pidana_mati_seumur_hidup" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).show();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
      $("#hasil_dinas" + nilai).show();
      $("#bp" + nilai).show();
    }else if(combo=='5'){
      $("#pidana_mati_seumur_hidup" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
      $("#hasil_dinas" + nilai).hide();
      $("#bp" + nilai).hide();
    }else if(combo=='6'){
      $("#pidana_mati_seumur_hidup" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).show();
      $("#pidana_pengawasan" + nilai).hide();
      $("#hasil_dinas" + nilai).show();
      $("#bp" + nilai).show();
    }else if(combo=='7'){
      $("#pidana_mati_seumur_hidup" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).show();
      $("#hasil_dinas" + nilai).hide();
      $("#bp" + nilai).show();
    }
  }

  var IdPasalDakwa = 1;
  function addpasal(sRowId){
    $("#divPasalDakwa"+sRowId).append('<br /><textarea name="pasal_didakwakan'+sRowId+'[]" id="pasal_didakwakan'+IdPasalDakwa+'" class="span4"></textarea> &nbsp;<input type="button" class="btn btn-danger" value="-" id="close_pasal'+IdPasalDakwa+'" onClick=deletePasalDakwa("'+IdPasalDakwa+'")>');
    IdPasalDakwa++;
  }
  
  count = 1;
  function tambahDenda(value){
    var noterakhir=$("#hdnpembayaran"+value).val();
    var randomnumber=parseInt(noterakhir)+1;
    $("#hdnpembayaran"+value).val(randomnumber);
    
    $("#tbl_denda"+value).append(
        '<tr id="datatr'+value+'_'+randomnumber+'">'+
          '<td></td>'+
          '<td>'+
            '<div class="input-prepend-edit">'+
               '<span class="add-on">Rp.</span><input type="text" name="denda_setor'+value+'[]" class="span2" id="setor_'+value+'_'+randomnumber+'" onkeyup=hitung(\''+value+'\',\''+randomnumber+'\') >'+
            '</div>'+
          '</td>'+
          '<td>'+
            '<div class="input-prepend-edit">'+
               '<span class="add-on">Rp.</span><input type="text" name="denda_sisa'+value+'[]" class="span2" id="sisa_'+value+'_'+randomnumber+'">'+
            '</div>'+
          '</td>'+
          '<td>'+
            '<input type="text" name="denda_ssbp'+value+'[]" class="span2" id="denda_ssbp_'+value+'_'+randomnumber+'">'+
          '</td>'+
          '<td>'+
            '<div class="input-prepend-edit-date">'+
               '<input type="text" id="denda_tgl_ssbp_'+value+'_'+randomnumber+'" name="denda_tgl_ssbp'+value+'[]" class="datepicker span2-edit">'+
            '</div>'+
          '</td>'+
          '<td>'+
            '<input type="text" name="denda_bukti_setor'+value+'[]" class="span2" id="denda_bukti_setor_'+value+'_'+randomnumber+'">'+
          '</td>'+
          '<td>'+
            '<div class="input-prepend-edit-date">'+
              '<input type="text" id="denda_tgl_setor_'+value+'_'+randomnumber+'" name="denda_tgl_setor'+value+'[]" class="datepicker span2-edit">'+
            '</div>'+
          '</td>'+
          '<td>'+
            '<input type="text" name="denda_keterangan'+value+'[]" class="span2" id="denda_keterangan_'+value+'_'+randomnumber+'">'+
          '</td>'+
          '<td>'+
            '<input type="button" class="btn btn-danger" value="Hapus" onClick=deleteDenda(\''+value+'\',\''+randomnumber+'\')>'+
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
    if($('#biaya_perkara'+value).val()){
      $("#bp_amar_putusan"+value).val($('#biaya_perkara'+value).val());
    }else if($('#denda'+value).val() != null && $('#pj_biaya_perkara'+value).val() != ''){
      $("#denda_hsl_dinas"+value).val($('#denda'+value).val());
      $("#bp_amar_putusan"+value).val($('#pj_biaya_perkara'+value).val());
    }
  }
  
  function hitung(tab,row)
  {
    var rowIndex = $("#datatr"+tab+"_"+row).closest('tr').prevAll().length +1;
    var jumlahrow =$("#tbl_denda"+tab+" tr").length ;
    
    if(rowIndex == 1){
    //alert("rowindex"+rowIndex+"jumlahrow"+jumlahrow);
       var besarDenda= $("#denda_hsl_dinas"+tab).val();  
       $("#setor_"+tab+"_"+row).live('keyup',function () {
           if(parseInt($(this).val()) > parseInt(besarDenda)){
                alert('Jumlah Cicilan Lebih Besar Dari Besar Denda');
                $(this).val("0")
                return false;
           }
           var besarSisaDenda= parseInt(besarDenda)-parseInt($(this).val());
           $("#sisa_"+tab+"_"+row).val(besarSisaDenda);
           if($(this).val()==null ||$(this).val()==""){
              $("#sisa_"+tab+"_"+row).val("");
           }
       });//end live func
    }else{
        //alert("rowindex1 "+rowIndex+"jumlahrow1 "+jumlahrow);
       var sisaBesarDenda= $("#sisa_"+tab+"_"+(row-1)).val(); 
       //alert(sisaBesarDenda);
       $("#setor_"+tab+"_"+row).live('keyup',function () {
           if(parseInt($(this).val()) > parseInt(sisaBesarDenda)){
                alert('Jumlah Cicilan Lebih Besar Dari Besar Denda11');
                $(this).val("0")
                return false;
           }
           var besarSisaDenda= parseInt(sisaBesarDenda)-parseInt($(this).val());
           $("#sisa_"+tab+"_"+row).val(besarSisaDenda);
           if($(this).val()==null ||$(this).val()==""){
              $("#sisa_"+tab+"_"+row).val("");
           }
       });//end live func
    } 
        
  }
  
  function deleteDenda(tab,row){
    var rowIndex = $("#datatr"+tab+"_"+row).closest('tr').prevAll().length+1;
    var jumlahrowAwal = $("#tbl_denda"+tab+" tr").length;
    //alert(jumlahrowAwal);
    var cicilan = [];
    for(var i=1;i<jumlahrowAwal;i++){
        
        if(i!=row){
            cicilan.push({
              cicil: $("#setor_"+tab+"_"+i).val(),
              sisa: $("#sisa_"+tab+"_"+i).val(),
              denda_ssbp: $("#denda_ssbp_"+tab+"_"+i).val(),
              denda_tgl_ssbp: $("#denda_tgl_ssbp_"+tab+"_"+i).val(),
              denda_bukti_setor: $("#denda_bukti_setor_"+tab+"_"+i).val(),
              denda_tgl_setor: $("#denda_tgl_setor_"+tab+"_"+i).val(),
              denda_keterangan: $("#denda_keterangan_"+tab+"_"+i).val(),
            });
        }
        jqRow = $("#datatr"+tab+"_"+i);
        jqRow.remove();
    }
    $("#tbl_denda"+tab).trigger("update");
    hitungDendaAfterDel(tab,row,rowIndex,jumlahrowAwal,cicilan);
  }

  function hitungDendaAfterDel(tab,row,rowIndex,jumlahrowAwal,cicilan){
      var row2 = $("#tbl_denda"+tab);
      var hidden = $("#hdnpembayaran"+tab).val();
      
      var noterakhir=$("#hdnpembayaran"+tab).val();
      var randomnumber=parseInt(noterakhir)-1;
      $("#hdnpembayaran"+tab).val(randomnumber);
      var newRow2 = row2;
      var jumlahrow =$("#tbl_denda"+tab+" tr").length -2;
      var besarDenda= $("#denda_hsl_dinas"+tab).val(); 
      var totalCicil = 0;
      $.each(cicilan, function(index,value) { 
      totalCicil = parseInt(totalCicil) + parseInt(value.cicil);
      if(index==0){ //jika cicilan pertama
          value.sisa = parseInt(besarDenda) - parseInt(value.cicil);
      }else{ 
          value.sisa = parseInt(besarDenda) - parseInt(totalCicil);
      }
      //alert(parseInt(index)+1);
          newRow2.append(
              '<tr id="datatr'+tab+'_'+(parseInt(index)+1)+'">'+
                '<td></td>' +
                '<td>'+
                  '<div class="input-prepend-edit">'+
                    '<span class="add-on">Rp.</span><input type="text" name="denda_setor'+tab+'[]" id="setor_'+tab+'_'+(parseInt(index)+1)+'" value="'+value.cicil+'" onkeyup="hitung(\''+value+'\',\''+(parseInt(index)+1)+'\')" class="span2">'+
                  '</div>'+
                '</td>'+
                '<td>'+
                  '<div class="input-prepend-edit">'+
                    '<span class="add-on">Rp.</span><input type="text" name="denda_sisa'+tab+'[]" id="sisa_'+tab+'_'+(parseInt(index)+1)+'" value="'+value.sisa+'" id="sisa_'+tab+'_'+(parseInt(index)+1)+'" class="span2">'+
                  '</div>'+
                '</td>'+
                '<td>'+
                  '<input type="text" name="denda_ssbp'+value+'[]" class="span2" id="denda_ssbp_'+value+'_'+(parseInt(index)+1)+'" value="'+value.denda_ssbp+'">'+
                '</td>'+
                '<td>'+
                  '<div class="input-prepend-edit-date">'+
                     '<input type="text" id="denda_tgl_ssbp_'+value+'_'+(parseInt(index)+1)+'" name="denda_tgl_ssbp'+value+'[]" class="datepicker span2-edit" value="'+value.denda_tgl_ssbp+'">'+
                  '</div>'+
                '</td>'+
                '<td>'+
                  '<input type="text" name="denda_bukti_setor'+value+'[]" class="span2" id="denda_bukti_setor_'+value+'_'+(parseInt(index)+1)+'" value="'+value.denda_bukti_setor+'">'+
                '</td>'+
                '<td>'+
                  '<div class="input-prepend-edit-date">'+
                    '<input type="text" id="denda_tgl_setor_'+value+'_'+(parseInt(index)+1)+'" name="denda_tgl_setor'+value+'[]" class="datepicker span2-edit" value="'+value.denda_tgl_setor+'">'+
                  '</div>'+
                '</td>'+
                '<td>'+
                  '<input type="text" name="denda_keterangan'+value+'[]" class="span2" id="denda_keterangan_'+value+'_'+(parseInt(index)+1)+'" value="'+value.denda_keterangan+'">'+
                '</td>'+
                '<td>'+
                '<td><input type="button" value="hapus" onclick=deleteDenda(\''+tab+'\',\''+(parseInt(index)+1)+'\')></td>'+
              '</tr>'
      
          );
          //alert(jumlahrow);
          if($("#setor_"+tab+"_"+(parseInt(index)+1)).val() == 'undefined'){
              //alert(test);
              jqRow = $("#datatr"+tab+"_"+hidden);
              jqRow.remove();
          }
      });	//end each
      
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
