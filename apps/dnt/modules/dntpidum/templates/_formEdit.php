<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<form action="<?php echo url_for('dntpidum/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<input type="hidden" name="nilaiConter" id="nilaiConter">
<?php endif; ?>
<div class="form-inline">
  <?php 
    foreach ($pdm_perkara as $perkara) {
      # code...
      //echo $perkara['PDM_TERSANGKA'][0]['nama'];
    } 
  ?>
  <label>
    No. Perkara
  </label>
  <input type="text" name="nomor_perkara" value="<?php echo $perkara->getNomorPerkara() ?>" />
  <select name="apb_aps" class="span1">
    <option value="1" selected="true">Apb</option>
    <option value="2">Aps</option>
  </select>
</div>

<div>&nbsp;</div>
<ul class="nav nav-tabs" id="myTab">
  <?php for ($i=1; $i <= count($pdm_tersangka) ; $i++) { ?>
    <li id="tab_li<?php echo $i; ?>"><a href="#new_tab_id<?php echo $i ?>" data-toggle="tab">Terdakwa <?php echo $i; ?></a></li>
  <?php } ?>
</ul>

<div class="tab-content">
  <?php $m = 1; $k = 1; ?>
  <?php foreach ($pdm_tersangka as $datatersangka) : ?>
  <div class="tab-pane in active" id="new_tab_id<?php echo $m ?>"> 
    <div class="row">
      <div class="span5">
        <label>Nama</label>  <?php echo $formTersangka['nama']->render(array('name' => 'nama_terdakwa[]', 'class' => 'span3', 'value' => $datatersangka->getNama())) ?> 
        <label>Tempat/Tanggal Lahir</label>  <?php echo $formTersangka['tempat_lahir']->render(array('name' => 'tempat_lahir[]', 'class' => 'span3-edit', 'value' => $datatersangka->getTempatLahir())) ?>  <?php echo $formTersangka['tgl_lahir']->render(array('name' => 'tgl_lahir[]', 'class' => 'datepicker span2-edit', 'id' => 'data_tgllahir1', 'onchange' => 'addtgllahir("1")', 'value' => $datatersangka->getTglLahir())) ?>
        <label>Usia</label>  <?php echo $formTersangka['umur']->render(array('name' => 'umur[]', 'id' => 'data_umur1', 'class' => 'span1', 'readonly' => 'true', 'value' => $datatersangka->getUmur())) ?>
        <label>Jenis Kelamin</label>  <?php echo $formTersangka['jkl']->render(array('name' => 'jkl[]', 'class' => 'span2')) ?>
        <label>Alamat</label>  <textarea name="alamat[]" class="span4"><?php echo $datatersangka->getAlamat() ?></textarea> 
      </div>
      
      <div class="span3"> 
        <label>Agama</label>  <?php echo $formTersangka['id_agama']->render(array('name' => 'id_agama[]', 'class' => 'span3')) ?>
        <label>Pekerjaan</label>  <?php echo $formTersangka['pekerjaan']->render(array('name' => 'pekerjaan[]', 'class' => 'span3', 'value' => $datatersangka->getPekerjaan())) ?> 
        <label>Kewarganegaraan</label>  <?php echo $formTersangka['kewarganegaraan']->render(array('name' => 'kewarganegaraan[]', 'class' => 'span3', 'value' => $datatersangka->getKewarganegaraan())) ?> 
        <label>Pendidikan</label>  <?php echo $formTersangka['pendidikan']->render(array('name' => 'pendidikan[]', 'class' => 'span3')) ?>
      </div> 
    </div>

    <hr />
    <legend><b>Putusan Inkrah</b></legend>
    <div class="form-inline">
      <label class="span3-label">No. Amar Putusan Inkrah</label>
        <input type="text" name="no_amar_putusan" class="span3" /> <input type="text" name="tgl_putusan" class="datepicker span2-edit" />
        <select class="span1" name="jns_pengadilan_putusan">
            <option value="1">PN</option>
            <option value="2">PT</option>
            <option value="3">MA</option>
          </select>
    </div>
    <div class="row">&nbsp;</div>
    <div class="form-inline">
      <label class="span3-label">Posisi Kasus</label>
        <textarea class="span5" style="height: 100px;"></textarea>
    </div>
    <div class="row">&nbsp;</div>
    <div class="form-inline">
      <label class="span3-label"></label>
      <label class="span3-pasal1">Pasal Didakwakan <div style="margin-right:-80px; float:right;"><input class="btn btn-warning" type="button" value="Tambah" onclick="addpasal('1')" id="add_pasal1" ></div><br /><br /><textarea name="pasal_didakwakan1[]" id="pasal_didakwakan1" class="span4"></textarea></label>
    </div>
    <div class="row">&nbsp;</div>
    <div class="form-inline">
      <label class="span3-label">Jenis Putusan</label>
        <select class="span3" name="jns_putusan">
            <option value="1">Pidana Mati</option>
            <option value="2">Seumur Hidup</option>
            <option value="3">Pidana Penjara</option>
            <option value="4">Pidana Kurungan-Denda</option>
            <option value="5">Bebas</option>
          </select>
    </div>
    <div class="row">&nbsp;</div>
    <div class="form-inline">
      <label class="span3-label">Tanggal P.48</label>
        <input type="text" name="tgl_p48" class="datepicker span2-edit" />
        &nbsp;Tanggal BA Eksekusi &nbsp; <input type="text" name="tgl_ba_eksekusi" class="datepicker span2-edit" />
    </div>
    <div class="row">&nbsp;</div>
    <div class="form-inline">
      <label class="span3-label">Tempat Penahanan</label>
        <select class="span2" name="jns_tahanan">
            <option value="1">Rutan</option>
            <option value="2">Kota</option>
            <option value="3">Rumah</option>
          </select>
        <input type="text" name="tgl_penahanan_mulai" class="datepicker span2-edit" /> s/d <input type="text" name="tgl_penahanan_selesai" class="datepicker span2-edit" />
    </div>
    <div class="row">&nbsp;</div>
    <div class="form-inline">
      <label class="span3-label">Keterangan Penahanan</label>
        <input type="text" name="keterangan_tahanan" class="span5" />
    </div>
    <div class="row">&nbsp;</div>
    <hr />
    <legend><b>Hasil Dinas</b></legend>
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>Amar Putusan</th>
          <th>Total Setoran</th>
          <th>Sisa</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Denda Ganti</td>
          <td>
            <div class="input-prepend">
              <span class="add-on">Rp</span><input type="text" name="denda_amar_putusan" class="span2">
            </div>
          </td>
          <td>
            <div class="input-prepend">
              <span class="add-on">Rp</span><input type="text" name="denda_total_setoran" class="span2">
            </div>
          </td>
          <td>
            <div class="input-prepend">
              <span class="add-on">Rp</span><input type="text" name="denda_sisa" class="span2">
            </div>
          </td>
        </tr>
        <tr>
          <td>Biaya Perkara</td>
          <td>
            <div class="input-prepend">
              <span class="add-on">Rp</span><input type="text" name="biaya_amar_putusan" class="span2">
            </div>
          </td>
          <td>
            <div class="input-prepend">
              <span class="add-on">Rp</span><input type="text" name="biaya_total_setoran" class="span2">
            </div>
          </td>
          <td>
            <div class="input-prepend">
              <span class="add-on">Rp</span><input type="text" name="biaya_sisa" class="span2">
            </div>
          </td>
        </tr>
        <tr>
          <td>Uang Rampasan</td>
          <td>
            <div class="input-prepend">
              <span class="add-on">Rp</span><input type="text" name="uang_amar_putusan" class="span2">
            </div>
          </td>
          <td>
            <div class="input-prepend">
              <span class="add-on">Rp</span><input type="text" name="uang_total_setoran" class="span2">
            </div>
          </td>
          <td>
            <div class="input-prepend">
              <span class="add-on">Rp</span><input type="text" name="uang_sisa" class="span2">
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php 
    $m++;  
    endforeach; 
  ?>
</div>
<script type="text/javascript">
$(function () {
    $('#myTab a:first').tab('show');

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
</script>