<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('Fungsi'); ?>
<?php 
    foreach ($pdm_perkara as $perkara) {
      # code...
      //echo $perkara['PDM_TERSANGKA'][0]['nama'];
    } 
  ?>
<form action="<?php echo url_for('dntpidum/update?id='.$perkara->getId()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<input type="hidden" name="nilaiConter" id="nilaiConter">
<input type="hidden" name="idperkara" value="<?php echo $perkara->getId() ?>" />
<div class="form-inline">
  <label>
    No. Perkara
  </label>
  <input type="text" name="nomor_perkara" value="<?php echo $perkara->getNomorPerkara() ?>" />
  <select name="apb_aps" class="span1">
    <option value="1" <?php echo $perkara->getJnsPelimpahan() == 1 ? 'selected' : '' ?>>Apb</option>
    <option value="2" <?php echo $perkara->getJnsPelimpahan() == 2 ? 'selected' : '' ?>>Aps</option>
  </select>
</div>

<div>&nbsp;</div>
<ul class="nav nav-tabs" id="myTab">
  <?php for ($i=1; $i <= count($tersangka) ; $i++) { ?>
    <li id="tab_li<?php echo $i; ?>"><a href="#new_tab_id<?php echo $i ?>" data-toggle="tab">Terdakwa <?php echo $i; ?></a></li>
  <?php } ?>
</ul>

<div class="tab-content">
  <?php $m = 1; $k = 1; $s = 1; ?>
  <?php foreach ($tersangka as $datatersangka) : ?>
  <input type="hidden" name="hidenIdTersangka[]" id="hidenIdTersangka<?php echo $m; ?>" value="<?php echo $datatersangka['ID'] ?>" >
  <div class="tab-pane in active" id="new_tab_id<?php echo $m ?>"> 
    <div class="row">
      <div class="span5">
        <label>Nama</label>  <?php echo $formTersangka['nama']->render(array('name' => 'nama_terdakwa[]', 'class' => 'span3', 'value' => $datatersangka['NAMA'])) ?> 
        <label>Tempat/Tanggal Lahir</label>  <?php echo $formTersangka['tempat_lahir']->render(array('name' => 'tempat_lahir[]', 'class' => 'span3-edit', 'value' => $datatersangka['TEMPAT_LAHIR'])) ?>  <input type="text" id="data_tgllahir1" onChange=addtgllahir("1") class="datepicker span2-edit" name="tgl_lahir[]" value="<?php echo getTanggal($datatersangka['TGL_LAHIR']) ?>">
        <label>Usia</label>  <?php echo $formTersangka['umur']->render(array('name' => 'umur[]', 'id' => 'data_umur1', 'class' => 'span1', 'readonly' => 'true', 'value' => $datatersangka['UMUR'])) ?>
        <label>Jenis Kelamin</label>
          <select name="jkl[]" class="span2" id="jkl">
            <option value="0">-- jenis kelamin --</option>
              <option value="1" <?PHP if($datatersangka['JKL']=='1'){ echo 'selected';} ?>>Laki - Laki</option>
              <option value="2" <?PHP if($datatersangka['JKL']=='2'){ echo 'selected';} ?>>Perempuan</option></select>
          </select>
        <label>Alamat</label>  <textarea name="alamat[]" class="span4"><?php echo $datatersangka['ALAMAT'] ?></textarea> 
      </div>
      
      <div class="span3"> 
        <label>Agama</label>
          <select name="id_agama[]" class="span3">
            <option value="" >--- Agama ---</option>
            <option value="1" <?PHP if($datatersangka['ID_AGAMA']=='1'){ echo 'selected';} ?>>Islam</option>
            <option value="2" <?PHP if($datatersangka['ID_AGAMA']=='2'){ echo 'selected';} ?>>Kristen Protestan</option>
            <option value="3" <?PHP if($datatersangka['ID_AGAMA']=='3'){ echo 'selected';} ?>>Kristen Katolik</option>
            <option value="4" <?PHP if($datatersangka['ID_AGAMA']=='4'){ echo 'selected';} ?>>Hindu</option>
            <option value="5" <?PHP if($datatersangka['ID_AGAMA']=='5'){ echo 'selected';} ?>>Budha</option>
          </select>
        <label>Pekerjaan</label>  <?php echo $formTersangka['pekerjaan']->render(array('name' => 'pekerjaan[]', 'class' => 'span3', 'value' => $datatersangka['PEKERJAAN'])) ?> 
        <label>Kewarganegaraan</label>  <?php echo $formTersangka['kewarganegaraan']->render(array('name' => 'kewarganegaraan[]', 'class' => 'span3', 'value' => $datatersangka['KEWARGANEGARAAN'])) ?> 
        <label>Pendidikan</label>
          <select name="pendidikan[]" class="span3">
            <option value="" >--- Pilih Pendidikan ---</option>
            <option value="1" <?PHP if($datatersangka['PENDIDIKAN']=='1'){ echo 'selected';} ?>>Tidak Tamat SD</option>
            <option value="2" <?PHP if($datatersangka['PENDIDIKAN']=='2'){ echo 'selected';} ?>>SD / SR</option>
            <option value="3" <?PHP if($datatersangka['PENDIDIKAN']=='3'){ echo 'selected';} ?>>SMP / SLTP</option>
            <option value="4" <?PHP if($datatersangka['PENDIDIKAN']=='4'){ echo 'selected';} ?>>SMA / SLTA</option>
            <option value="5" <?PHP if($datatersangka['PENDIDIKAN']=='5'){ echo 'selected';} ?>>Diploma / Sarjana Muda</option>
            <option value="6" <?PHP if($datatersangka['PENDIDIKAN']=='6'){ echo 'selected';} ?>>Sarjana (S1)</option>
            <option value="7" <?PHP if($datatersangka['PENDIDIKAN']=='7'){ echo 'selected';} ?>>Pascasarjana (S2)</option>
            <option value="8" <?PHP if($datatersangka['PENDIDIKAN']=='8'){ echo 'selected';} ?>>Doktor (S3)</option>
            <option value="9" <?PHP if($datatersangka['PENDIDIKAN']=='9'){ echo 'selected';} ?>>Profesor</option>
          </select>
      </div> 
    </div>

    <hr />
    <legend><b>Putusan Inkrah</b></legend>
    <div class="form-inline">
      <label class="span3-label">No. Amar Putusan Inkrah</label>
        <?php
          foreach($pdm_perkara as $dataperkara):
          endforeach;
          foreach(getDetails('UPAYA_BANDING',$datatersangka['ID']) as $banding):
          endforeach;
          foreach(getDetails('UPAYA_KASASI',$datatersangka['ID']) as $kasasi):
          endforeach;
        
          if($datatersangka['PUTUSAN_UPAYA_HUKUM'] == '1'){
            $NoAmarPutusan = $dataperkara->getNoLimpahPk();
            $TglPutusan = $dataperkara->getTglPutusanPn();
          }elseif($datatersangka['PUTUSAN_TETAP'] == '2'){
            $NoAmarPutusan = $banding['NO_PUTUSAN'];
            $TglPutusan = $banding['TGL_PUTUSAN'];
          }elseif ($datatersangka['PUTUSAN_TETAP'] == '3') {
            $NoAmarPutusan = $kasasi['NO_PUTUSAN'];
            $TglPutusan = $kasasi['TGL_PUTUSAN'];
          }
          
          $bandingid = $banding['ID'] ? $banding['ID'] : '';
          $kasasiid = $kasasi['ID'] ? $kasasi['ID'] : '';
        ?>
        <input type="hidden" name="idbanding[]" value="<?php echo $bandingid ?>" />
        <input type="hidden" name="idkasasi[]" value="<?php echo $kasasiid ?>" />
        <input type="text" name="no_amar_putusan[]" value="<?php echo $NoAmarPutusan; ?>" class="span3" /> <input type="text" name="tgl_putusan[]" value="<?php echo getTanggal($TglPutusan); ?>" class="datepicker span2-edit" />
        <select class="span1" name="jns_pengadilan_putusan[]">
          <option value="">Pilih</option>
          <option value="1" <?php if($datatersangka['PUTUSAN_UPAYA_HUKUM'] == '1'){echo 'selected';} ?>>PN</option>
          <option value="2" <?php if($datatersangka['PUTUSAN_TETAP'] == '2'){echo 'selected';} ?>>PT</option>
          <option value="3" <?php if($datatersangka['PUTUSAN_TETAP'] == '3'){echo 'selected';} ?>>MA</option>
        </select>
    </div>
    <div class="row">&nbsp;</div>
    <div class="form-inline">
      <div style="margin-right:0px; float:right;"><input type="button" id="add_pasal<?php echo $m; ?>" onclick=addpasal('<?php echo $m ?>') value="Tambah" class="btn btn-warning"></div>
      <label class="span3-label"></label>
      Pasal Didakwakan <br /><br /> 
      <div id="divPasalDakwa<?php echo $m; ?>" style="margin-left:220px; float:left;">
        <?php foreach(getDetilPasalTersangka($datatersangka['ID']) as $pasal): ?>
          <input type="hidden" name="idpasal<?php echo $m ?>[]" id="idpasal<?php echo $k; ?>" value="<?php echo $pasal['ID'] ?>" />
          <textarea name="pasal_didakwakan<?php echo $m ?>[]" id="pasal_didakwakan<?php echo $k ?>" class="span4"><?php echo $pasal['PASAL']; ?></textarea> &nbsp;<input type="button" class="btn btn-danger" value="-" id="close_pasal<?php echo $k ?>" onClick=deletePasalDakwa("<?php echo $k ?>")>
        <?php
            $k++;
            endforeach;
        ?>
        <input type="hidden" name="nilai_n" id="nilai_p" value="<?php echo $k; ?>">
      </div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="form-inline">
      <label class="span3-label">Jenis Putusan</label>
        <select class="span3" name="jns_putusan[]" id="jns_putusan<?php echo $m; ?>" onChange=pilihJnsPutusan('<?php echo $m; ?>')>
            <option value="0">Pilih Jenis Putusan</option>
            <option value="1" <?php if($datatersangka['JENIS_PUTUSAN'] == '1'){ echo 'selected'; } ?>>Pidana Mati</option>
            <option value="2" <?php if($datatersangka['JENIS_PUTUSAN'] == '2'){ echo 'selected'; } ?>>Seumur Hidup</option>
            <option value="3" <?php if($datatersangka['JENIS_PUTUSAN'] == '3'){ echo 'selected'; } ?>>Pidana Penjara</option>
            <option value="4" <?php if($datatersangka['JENIS_PUTUSAN'] == '4'){ echo 'selected'; } ?>>Pidana Kurungan-Denda</option>
            <option value="5" <?php if($datatersangka['JENIS_PUTUSAN'] == '5'){ echo 'selected'; } ?>>Bebas</option>
            <option value="6" <?php if($datatersangka['JENIS_PUTUSAN'] == '6'){ echo 'selected'; } ?>>Pidana Bersyarat/Percobaan</option>
            <option value="7" <?php if($datatersangka['JENIS_PUTUSAN'] == '7'){ echo 'selected'; } ?>>Pidana Pengawasan</option>
          </select>
    </div>
      <!--div yang ditampilkan berdasarkan jenis pututsan-->
      <div id="pidana_mati<?php echo $m?>" style="<?php echo $datatersangka['JENIS_PUTUSAN'] == '1' ? 'display:' : 'display:none' ?>">
        <label class="span3-label">&nbsp;</label>
        Biaya Perkara &nbsp; <div class="input-prepend"><span class="add-on">Rp.</span><input type="text" id="biaya_perkara_mati" name="biaya_perkara_mati[]" value="<?php echo $datatersangka['PJ_BIAYA'] ?>" class="span2 numeric mirror<?php echo $m ?>" onkeyup=mirror("<?php echo $m ?>") /></div>
      </div>
      <div id="seumur_hidup<?php echo $m?>" style="<?php echo $datatersangka['JENIS_PUTUSAN'] == '2' ? 'display:' : 'display:none' ?>">
        <label class="span3-label">&nbsp;</label>
        Biaya Perkara &nbsp; <div class="input-prepend"><span class="add-on">Rp.</span><input type="text" id="biaya_seumur_hidup<?php echo $m ?>" name="biaya_seumur_hidup[]" value="<?php echo $datatersangka['PJ_BIAYA'] ?>" class="span2 numeric mirror<?php echo $m ?>" onkeyup=mirror2("<?php echo $m ?>") /></div>
      </div>
      <div id="pidana_penjara<?php echo $m?>" style="<?php echo $datatersangka['JENIS_PUTUSAN'] == '3' ? 'display:' : 'display:none' ?>">
        <legend>Pidana Penjara:</legend>
        <label class="span3-label">Pidana Badan</label>
          <div class="input-prepend">
            <input class="span1" id="pj_badan_tahun" size="16" type="text" name="pj_badan_tahun[]" value="<?php echo $datatersangka['PJ_BADAN_TAHUN'] ?>"><span class="add-on">Tahun</span>
            <input class="span1" id="pj_badan_bulan" size="16" type="text" name="pj_badan_bulan[]" value="<?php echo $datatersangka['PJ_BADAN_BULAN'] ?>"><span class="add-on">Bulan</span>
            <input class="span1" id="pj_badan_hari" size="16" type="text" name="pj_badan_hari[]" value="<?php echo $datatersangka['PJ_BADAN_HARI'] ?>"><span class="add-on">Hari</span>
          </div>
        <label class="span3-label">Denda</label>
          <div class="input-prepend">
            <span class="add-on">Rp.</span><input class="span2" id="denda" size="16" type="text" name="pj_denda[]" value="<?php echo $datatersangka['PJ_DENDA_RP'] ?>">
          </div>
        <label class="span3-label">Subsidair</label>
          <div class="input-prepend">
            <input class="span1" id="pj_subsidair_tahun" size="16" type="text" name="pj_subsidair_tahun[]" value="<?php echo $datatersangka['PJ_SUB_TAHUN'] ?>"><span class="add-on">Tahun</span>
            <input class="span1" id="pj_subsidair_bulan" size="16" type="text" name="pj_subsidair_bulan[]" value="<?php echo $datatersangka['PJ_SUB_BULAN'] ?>"><span class="add-on">Bulan</span>
            <input class="span1" id="pj_subsidair_hari" size="16" type="text" name="pj_subsidair_hari[]" value="<?php echo $datatersangka['PJ_SUB_HARI'] ?>"><span class="add-on">Hari</span>
          </div>
        <label class="span3-label">Biaya Perkara</label>
          <div class="input-prepend">
            <span class="add-on">Rp.</span><input class="span2" id="pj_biaya_perkara" size="16" type="text" name="pj_biaya_perkara[]" value="<?php echo $datatersangka['PJ_BIAYA'] ?>">
          </div>
        <label class="span3-label">Pidana Tambahan</label>
          <textarea rows="3" name="pj_pidana_tambahan[]"><?php echo $datatersangka['PUTUSAN_TAMBAHAN'] ?></textarea>
        <legend>&nbsp;</legend>
      </div>
      <div id="pidana_kurungan_denda<?php echo $m?>" style="<?php echo $datatersangka['JENIS_PUTUSAN'] == '4' ? 'display:' : 'display:none' ?>">
        <legend>Pidana Kurungan:</legend>
        <label class="span3-label">Kurungan</label>
          <div class="input-prepend">
            <input class="span1" id="pk_kurungan_tahun" size="16" type="text" name="pk_kurungan_tahun[]" value="<?php echo $datatersangka['KURUNGAN_TAHUN'] ?>"><span class="add-on">Tahun</span>
            <input class="span1" id="pk_kurungan_bulan" size="16" type="text" name="pk_kurungan_bulan[]" value="<?php echo $datatersangka['KURUNGAN_BULAN'] ?>"><span class="add-on">Bulan</span>
            <input class="span1" id="pk_kurungan_hari" size="16" type="text" name="pk_kurungan_hari[]" value="<?php echo $datatersangka['KURUNGAN_HARI'] ?>"><span class="add-on">Hari</span>
          </div>
        <label class="span3-label">Denda</label>
          <div class="input-prepend">
            <span class="add-on">Rp.</span><input class="span2" id="pk_denda" size="16" type="text" name="pk_denda[]" value="<?php echo $datatersangka['DENDA'] ?>">
          </div>
        <label class="span3-label">Biaya Perkara</label>
          <div class="input-prepend">
            <span class="add-on">Rp.</span><input class="span2" id="pk_biaya_perkara" size="16" type="text" name="pk_biaya_perkara[]" value="<?php echo $datatersangka['PJ_BIAYA'] ?>">
          </div>
        <label class="span3-label">Pidana Tambahan</label>
          <textarea rows="3" name="pk_pidana_tambahan"><?php echo $datatersangka['PUTUSAN_TAMBAHAN'] ?></textarea>
        <legend>&nbsp;</legend>
      </div>
      <div id="pidana_bersyarat<?php echo $m?>" style="<?php echo $datatersangka['JENIS_PUTUSAN'] == '6' ? 'display:' : 'display:none' ?>">
        <legend>Pidana Bersyarat/Percobaan:</legend>
        <label class="span3-label">Pidana Badan</label>
          <div class="input-prepend">
            <input class="span1" id="pb_badan_tahun" size="16" type="text" name="pb_badan_tahun[]" value="<?php echo $datatersangka['PJ_BADAN_TAHUN'] ?>"><span class="add-on">Tahun</span>
            <input class="span1" id="pb_badan_bulan" size="16" type="text" name="pb_badan_bulan[]" value="<?php echo $datatersangka['PJ_BADAN_BULAN'] ?>"><span class="add-on">Bulan</span>
            <input class="span1" id="pb_badan_hari" size="16" type="text" name="pb_badan_hari[]" value="<?php echo $datatersangka['PJ_BADAN_HARI'] ?>"><span class="add-on">Hari</span>
          </div>
        <label class="span3-label">Masa Percobaan</label>
          <div class="input-prepend">
            <input class="span1" id="pb_percobaan_tahun" size="16" type="text" name="pb_percobaan_tahun[]" value="<?php echo $datatersangka['PJ_PIDANA_COBA_THN'] ?>"><span class="add-on">Tahun</span>
            <input class="span1" id="pb_percobaan_bulan" size="16" type="text" name="pb_percobaan_bulan[]" value="<?php echo $datatersangka['PJ_PIDANA_COBA_BLN'] ?>"><span class="add-on">Bulan</span>
            <input class="span1" id="pb_percobaan_hari" size="16" type="text" name="pb_percobaan_hari[]" value="<?php echo $datatersangka['PJ_PIDANA_COBA_HARI'] ?>"><span class="add-on">Hari</span>
          </div>
        <label class="span3-label">Denda</label>
          <div class="input-prepend">
            <span class="add-on">Rp.</span><input class="span2" id="pb_denda" size="16" type="text" name="pb_denda[]" value="<?php echo $datatersangka['DENDA'] ?>">
          </div>
        <label class="span3-label">Subsidair</label>
          <div class="input-prepend">
            <input class="span1" id="pb_subsidair_tahun" size="16" type="text" name="pb_subsidair_tahun[]" value="<?php echo $datatersangka['PJ_SUB_TAHUN'] ?>"><span class="add-on">Tahun</span>
            <input class="span1" id="pb_subsidair_bulan" size="16" type="text" name="pb_subsidair_bulan[]" value="<?php echo $datatersangka['PJ_SUB_BULAN'] ?>"><span class="add-on">Bulan</span>
            <input class="span1" id="pb_subsidair_hari" size="16" type="text" name="pb_subsidair_hari[]" value="<?php echo $datatersangka['PJ_SUB_HARI'] ?>"><span class="add-on">Hari</span>
          </div>
        <label class="span3-label">Biaya Perkara</label>
          <div class="input-prepend">
            <span class="add-on">Rp.</span><input class="span2" id="pb_biaya_perkara" size="16" type="text" name="pb_biaya_perkara[]" value="<?php echo $datatersangka['PJ_BIAYA'] ?>">
          </div>
        <label class="span3-label">Pidana Tambahan</label>
          <textarea rows="3" name="pb_pidana_tambahan[]"><?php echo $datatersangka['PUTUSAN_TAMBAHAN'] ?></textarea>
        <legend>&nbsp;</legend>
      </div>
      <div id="pidana_pengawasan<?php echo $m?>" style="<?php echo $datatersangka['JENIS_PUTUSAN'] == '7' ? 'display:' : 'display:none' ?>">
        <legend>Pidana Pengawasan:</legend>
        <div class="form-inline">
          <label class="span3-label">Pidana Pengawasan</label>
            <select name="pp_combo[]">
              <option value="0">Pilih Jenis Pidana Pengawasan</option>
              <option value="1" <?php if($datatersangka['PDN_PENGAWASAN'] == '1'){echo 'selected';} ?>>Dikembalikan Kepada Orang Tua</option>
              <option value="0" <?php if($datatersangka['PDN_PENGAWASAN'] == '2'){echo 'selected';} ?>>Diserahkan Kepada Negara</option>
            </select>
        </div>
        <label class="span3-label">Biaya Perkara</label>
          <div class="input-prepend">
            <span class="add-on">Rp.</span><input class="span2" id="pp_biaya_perkara" size="16" type="text" name="pp_biaya_perkara[]" value="<?php echo $datatersangka['PJ_BIAYA'] ?>">
          </div>
        <legend>&nbsp;</legend>
      </div>
      <!--end div yang ditampilakan berdasarkan jenis putusan-->
    <div class="row">&nbsp;</div>
    <div class="form-inline">
      <label class="span3-label">Tanggal P.48</label>
        <input type="text" name="tgl_p48[]" value="<?php echo getTanggal($datatersangka['TGL_EKSEKUSI'])?>"  class="datepicker span2-edit" />
        &nbsp;Tanggal BA Eksekusi &nbsp; <input type="text" name="tgl_ba_eksekusi[]" class="datepicker span2-edit" />
    </div>
    <div class="row">&nbsp;</div>
    <div class="form-inline">
      <label class="span3-label">Tempat Penahanan</label>
        <?php
          foreach(getDetails('PENAHANAN', $datatersangka['ID']) as $penahanan):
          endforeach;
          
          if($datatersangka['PUTUSAN_UPAYA_HUKUM'] == '1'){
            $jnsTahan = $penahanan['KETUAPN_IDLOKTAHAN'];
            $tglMulai = $penahanan['KETUAPN_START'];
            $tglSelesai = $penahanan['KETUAPN_END'];
          }elseif($datatersangka['PUTUSAN_TETAP'] == '2'){
            $jnsTahan = $penahanan['KETUAPT_IDLOKTAHAN'];
            $tglMulai = $penahanan['KETUAPT_START'];
            $tglSelesai = $penahanan['KETUAPT_END'];
          }elseif ($datatersangka['PUTUSAN_TETAP'] == '3') {
            $jnsTahan = $penahanan['HAKIM1_IDLOKTAHAN'];
            $tglMulai = $penahanan['HAKIM1_START'];
            $tglSelesai = $penahanan['HAKIM1_END'];
          }
          
        ?>
        <select class="span2" name="jns_tahanan">
            <option value="1" <?php if($jnsTahan == '1'){ echo 'selected'; } ?>>Rutan</option>
            <option value="2" <?php if($jnsTahan == '2'){ echo 'selected'; } ?>>Kota</option>
            <option value="3" <?php if($jnsTahan == '3'){ echo 'selected'; } ?>>Rumah</option>
          </select>
        <input type="text" name="tgl_penahanan_mulai" value="<?php echo getTanggal($tglMulai) ?>" class="datepicker span2-edit" /> s/d <input type="text" name="tgl_penahanan_selesai" value="<?php echo getTanggal($tglSelesai) ?>" class="datepicker span2-edit" />
    </div>
    <div class="row">&nbsp;</div>
    <div class="form-inline">
      <label class="span3-label">Keterangan Penahanan</label>
        <input type="text" name="keterangan_tahanan" class="span5" />
    </div>
    <div class="row">&nbsp;</div>
    <hr />
    <legend><b>Hasil Dinas</b></legend>
    <?php
      foreach(getSetorDnt($dataperkara->getId(), $datatersangka['ID']) as $setorDnt):
      endforeach;
      
    ?>
    <input type="hidden" name="id_setor_dnt" value="<?php echo $setorDnt['ID'] ?>" />
    <div class="form-inline">
      <label>Amar Putusan</label>&nbsp;
      <div class="input-prepend">
        <span class="add-on">Rp.</span><input type="text" id="denda_hsl_dinas<?php echo $m ?>" name="denda_hsl_dinas[]" value="<?php echo $setorDnt['DENDA'] ?>" class="span2 uang1" />
      </div>
    </div>
    <div style="overflow-x:scroll;">
      <legend>Pembayaran Denda</legend>
      <table class="table" id="tbl_denda<?php echo $m ?>">
        <input type="hidden" name="hdnpembayaran" id="hdnpembayaran" value="0">
        <thead>
          <tr>
            <th><input type="button" class="btn btn-warning" value="tambah" id="tambah_denda<?php echo $m ?>" onClick=tambahDenda("<?php echo $m ?>")></th>
            <th>Setor</th>
            <th>Sisa</th>
            <th>No. SSBP</th>
            <th>Tanggal SSBP</th>
            <th>No. Bukti Setor</th>
            <th>Tanggal Setor</th>
            <th>Keterangan</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach(getDetailSetor($setorDnt['ID'], 2) as $detailSetor): ?>
          <tr id="datatr<?php echo $s; ?>">
            <td></td>
            <td>
              <div class="input-prepend-edit">
               <span class="add-on">Rp.</span><input type="text" name="denda_setor<?php echo $m; ?>[]" class="span2 setor<?php echo $s; ?>" value="<?php echo $detailSetor['SETOR'] ?>" onkeyup=hitung("<?php echo $s; ?>") >
              </div>
            </td>
            <td>
            <div class="input-prepend-edit">
               <span class="add-on">Rp.</span><input type="text" name="denda_sisa<?php echo $m; ?>[]" value="<?php echo $detailSetor['SISA'] ?>" class="span2 sisa<?php echo $s; ?>">
            </div>
            </td>
            <td>
              <input type="text" name="denda_ssbp<?php echo $m; ?>[]" value="<?php echo $detailSetor['NO_SSBP'] ?>" class="span2">
            </td>
            <td>
              <div class="input-prepend-edit-date">
                 <input type="text" id="denda_tgl_ssbp<?php echo $m; ?>" name="denda_tgl_ssbp<?php echo $m; ?>[]" value="<?php echo getTanggal($detailSetor['TGL_SSBP']) ?>" class="datepicker span2-edit">
              </div>
            </td>
            <td>
              <input type="text" name="denda_bukti_setor<?php echo $m; ?>[]" value="<?php echo $detailSetor['NO_BUKTI_STR'] ?>" class="span2">
            </td>
            <td>
              <div class="input-prepend-edit-date">
                <input type="text" name="denda_tgl_setor<?php echo $m; ?>[]" value="<?php echo getTanggal($detailSetor['TGL_STR']) ?>" class="datepicker span2-edit">
              </div>
            </td>
            <td>
              <input type="text" name="denda_keterangan<?php echo $m; ?>[]" value="<?php echo $detailSetor['KETERANGAN'] ?>" class="span2">
            </td>
            <td>
              <input type="button" class="btn btn-danger" value="-" id="hapus_denda<?php echo $s; ?>" onClick=deleteDenda("<?php echo $s; ?>")>
            </td>
          </tr>
          <?php
              $idDetailSetor = $detailSetor['ID'] ? $detailSetor['ID'] : '';
              $idSetorDnt = $detailSetor['ID_STR_DNT'] ? $detailSetor['ID_STR_DNT'] : '';
          ?>  
          <input type="hidden" name="iddetailsetor[]" value="<?php echo $idDetailSetor ?>" />
          <input type="hidden" name="idsetordnt[]" value="<?php echo $idSetorDnt ?>" />
          <?php $s++; endforeach; ?>
          <input type="hidden" name="nilai_hsl_dinas" id="nilai_hsl_dinas" value="<?php echo $s; ?>">
        </tbody>
      </table>
    </div>
    <?php
      foreach(getDetailSetor($setorDnt['ID'], 1) as $detailSetorBp):
      endforeach;
      
      
      $statusBP = $detailSetorBp['STATUS'] ? $detailSetorBp['STATUS'] : '';
      $idBp = $detailSetorBp['ID'] ? $detailSetorBp['ID'] : '';
      $statusHD = $detailSetor['STATUS'] ? $detailSetor['STATUS'] : '';
    ?>
    
    <input type="hidden" name="statusBP[]" value="<?php echo $statusBP ?>" />
    <input type="hidden" name="idBp[]" value="<?php echo $idBp ?>" />
    <input type="hidden" name="statusHD[]" value="<?php echo $statusHD ?>" />
    <div style="overflow-x:scroll;">
      <table class="table">
        <thead>
          <tr>
            <th></th>
            <th>Amar Putusan</th>
            <th>Setor</th>
            <th>No. SSBP</th>
            <th>Tanggal SSBP</th>
            <th>No. Bukti Setor</th>
            <th>Tanggal Setor</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Biaya Perkara</td>
            <td>
              <div class="input-prepend-edit">
                <span class="add-on">Rp.</span><input type="text" name="bp_amar_putusan[]" value="<?php echo $setorDnt['PJ_BIAYA'] ?>" class="span2">
              </div>
            </td>
            <td>
              <div class="input-prepend-edit">
                <span class="add-on">Rp.</span><input type="text" name="bp_setor[]" value="<?php echo $detailSetorBp['SETOR'] ?>" class="span2">
              </div>
            </td>
            <td>
              <input type="text" name="bp_no_ssbp[]" value="<?php echo $detailSetorBp['NO_SSBP'] ?>" class="span2">
            </td>
            <td>
              <div class="input-prepend-edit-date">
                <input type="text" name="bp_tgl_ssbp[]" value="<?php echo getTanggal($detailSetorBp['TGL_SSBP']) ?>" class="datepicker span2-edit">
              </div>
            </td>
            <td>
              <input type="text" name="bp_no_bukti_setor[]" value="<?php echo $detailSetorBp['NO_BUKTI_STR'] ?>" class="span2">
            </td>
            <td>
              <div class="input-prepend-edit-date">
                <input type="text" name="bp_tgl_setor[]" value="<?php echo getTanggal($detailSetorBp['TGL_STR']) ?>" class="datepicker span2-edit">
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <?php 
    $m++;  
    endforeach; 
  ?>
</div>
<hr />
<legend>Posisi Kasus</legend>
<div class="form-inline">
  <label class="span3-label">Posisi Kasus</label>
  <textarea class="span5" name="posisi_kasus" style="height: 100px;"><?php echo $dataperkara->getPosisiKasus(); ?></textarea>
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
  

  var tab_counter = 1;
	var addtab=1;

  function addTab() {
      $('.tab-content').append(
        '<div class="tab-pane in active" id="new_tab_id'+addtab+'">' +
          '<div class="row">' +
            '<div class="span5">' +
              '<label>Nama</label>' +  '<?php echo $formTersangka['nama']->render(array('name' => 'nama_terdakwa[]', 'class' => 'span3')) ?>' +
              '<label>Tempat/Tanggal Lahir</label>' + '<?php echo $formTersangka['tempat_lahir']->render(array('name' => 'tempat_lahir[]', 'class' => 'span3-edit')) ?>' +  '<input type="text" id="data_tgllahir'+addtab+'" onChange=addtgllahir("'+addtab+'") class="datepicker span2-edit" name="tgl_lahir[]" maxlength="10">' +
              '<label>Usia</label>' +  '<input type="text" id = "data_umur'+addtab+'" class="span1" name="umur[]" readonly="true">' +
              '<label>Jenis Kelamin</label>' +
                '<select name="jkl[]" class="span2" id="jkl">'+
                  '<option value="" selected="selected">Pilih</option>'+
                  <?php foreach($jkl_db as $jkl_db): ?>
                  '<option value="<?php echo $jkl_db->getId() ?>"><?php echo $jkl_db->getNama() ?></option>'+
                  <?php endforeach; ?>
                '</select>' +
              '<label>Alamat</label>' +  '<?php echo $formTersangka['alamat']->render(array('name' => 'alamat[]', 'class' => 'span4')) ?> ' +
            '</div>' +
            
            '<div class="span3"> ' +
              '<label>Agama</label>' +
                '<select name="id_agama[]" class="span2" id="jkl">'+
                  '<option value="" selected="selected">Pilih</option>'+
                  <?php foreach($agama_db as $agama_db): ?>
                  '<option value="<?php echo $agama_db->getId() ?>"><?php echo $agama_db->getNama() ?></option>'+
                  <?php endforeach; ?>
                '</select>' +
              '<label>Pekerjaan</label>' +  '<?php echo $formTersangka['pekerjaan']->render(array('name' => 'pekerjaan[]', 'class' => 'span3')) ?>' +
              '<label>Kewarganegaraan</label>' +  '<?php echo $formTersangka['kewarganegaraan']->render(array('name' => 'kewarganegaraan[]', 'class' => 'span3')) ?>' +
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
            '<div id="pidana_mati'+addtab+'" style="display:none;">'+
              '<label class="span3-label">&nbsp;</label>'+
              'Biaya Perkara &nbsp; <div class="input-prepend"><span class="add-on">Rp.</span><input type="text" id="biaya_perkara_mati" name="biaya_perkara_mati[]" class="span2 numeric mirror'+addtab+'" onkeyup=mirror("'+addtab+'") /></div>'+
            '</div>'+
            '<div id="seumur_hidup'+addtab+'" style="display:none;">'+
              '<label class="span3-label">&nbsp;</label>'+
              'Biaya Perkara &nbsp; <div class="input-prepend"><span class="add-on">Rp.</span><input type="text" id="biaya_seumur_hidup mirror'+addtab+'" name="biaya_seumur_hidup[]" class="span2 numeric" /></div>'+
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
              '<input type="text" name="tgl_p48" class="datepicker span2-edit" />'+
              '&nbsp;Tanggal BA Eksekusi &nbsp; <input type="text" name="tgl_ba_eksekusi[]" class="datepicker span2-edit" />'+
          '</div>'+
          '<div class="row">&nbsp;</div>'+
          '<div class="form-inline">'+
            '<label class="span3-label">Tempat Penahanan</label>'+
              '<select class="span2" name="jns_tahanan">'+
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
          '<legend><b>Posisi Kasus</b></legend>'+
          '<div class="form-inline">'+
            '<label class="span3-label">Posisi Kasus</label>'+
              '<textarea name="posisi_kasus" class="span5" style="height: 100px;"></textarea>'+
          '</div>'+
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
                  '<th><input type="button" class="btn btn-warning" value="tambah" id="tambah_denda1" onClick=tambahDenda("'+addtab+'")></th>'+
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
                      '<span class="add-on">Rp.</span><input type="text" name="bp_amar_putusan[]" class="span2">'+
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
          '<hr />'+
          '<legend><b>Barang Rampasan</b></legend>'+
          '<div style="overflow-x:scroll">'+
            '<table class="table">'+
              '<thead>'+
                '<tr>'+
                  '<th>No. Perkara</th>'+
                  '<th>Jenis Barang</th>'+
                  '<th>No. BA Lelang</th>'+
                  '<th>Hasil Lelang</th>'+
                  '<th>Setor</th>'+
                  '<th>No. Bukti Setor</th>'+
                  '<th>Tanggal Setor</th>'+
                  '<th>Status</th>'+
                  '<th>Tambah</th>'+
                '</tr>'+
              '</thead>'+
              '<tbody>'+
                '<tr>'+
                  '<td>'+
                    '<input type="text" name="br_no_perkara[]" class="span2">'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" name="br_jenis_barang[]" class="span2">'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" name="br_no_ba_lelang[]" class="span2">'+
                  '</td>'+
                  '<td>'+
                    '<div class="input-prepend-edit">'+
                      '<span class="add-on">Rp.</span><input type="text" name="br_hasil_lelang[]" class="span2">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                    '<div class="input-prepend-edit">'+
                      '<span class="add-on">Rp.</span><input type="text" name="br_setor[]" class="span2">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" name="br_no_bukti_setor[]" class="span2">'+
                  '</td>'+
                  '<td>'+
                    '<div class="input-prepend-edit-date">'+
                      '<input type="text" name="br_tgl_setor[]" class="datepicker span2-edit">'+
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
      $("#pidana_mati" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='1'){
      $("#pidana_mati" + nilai).show();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='2'){
      $("#pidana_mati" + nilai).hide();
      $("#seumur_hidup" + nilai).show();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='3'){
      $("#pidana_mati" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).show();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='4'){
      $("#pidana_mati" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).show();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='5'){
      $("#pidana_mati" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='6'){
      $("#pidana_mati" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).show();
      $("#pidana_pengawasan" + nilai).hide();
    }else if(combo=='7'){
      $("#pidana_mati" + nilai).hide();
      $("#seumur_hidup" + nilai).hide();
      $("#pidana_penjara" + nilai).hide();
      $("#pidana_kurungan_denda" + nilai).hide();
      $("#pidana_bersyarat" + nilai).hide();
      $("#pidana_pengawasan" + nilai).show();
    }
  }
  
  nilai_pasal = $('#nilai_p').val();
  var IdPasalDakwa = parseInt(nilai_pasal);
  function addpasal(sRowId){
    $("#divPasalDakwa"+sRowId).append('<br /><textarea name="new_pasal_didakwakan'+sRowId+'[]" id="new_pasal_didakwakan'+IdPasalDakwa+'" class="span4"></textarea> &nbsp;<input type="button" class="btn btn-danger" value="-" id="close_pasal'+IdPasalDakwa+'" onClick=deletePasalDakwa("'+IdPasalDakwa+'")>');
    IdPasalDakwa++;
  }
  
  function tambahDenda(value){
    var noterakhir=$("#hdnpembayaran").val();
    var randomnumber=parseInt(noterakhir)+1;
    $("#hdnpembayaran").val(randomnumber);
    
    nilai_pasal = $('#nilai_hsl_dinas').val();
  var nilaiHslDinas = parseInt(nilai_pasal);
    
    $("#tbl_denda"+value).append(
        '<tr id="datatr'+randomnumber+'">'+
          '<td></td>'+
          '<td>'+
            '<div class="input-prepend-edit">'+
               '<span class="add-on">Rp.</span><input type="text" name="new_denda_setor'+value+'[]" class="span2 setor'+nilaiHslDinas+'" onkeyup=hitung("'+nilaiHslDinas+'") >'+
            '</div>'+
          '</td>'+
          '<td>'+
            '<div class="input-prepend-edit">'+
               '<span class="add-on">Rp.</span><input type="text" name="new_denda_sisa'+value+'[]" class="span2 sisa'+nilaiHslDinas+'">'+
            '</div>'+
          '</td>'+
          '<td>'+
            '<input type="text" name="new_denda_ssbp'+value+'[]" class="span2">'+
          '</td>'+
          '<td>'+
            '<div class="input-prepend-edit-date">'+
               '<input type="text" id="denda_tgl_ssbp'+tab_counter+'" name="new_denda_tgl_ssbp'+value+'[]" class="datepicker span2-edit">'+
            '</div>'+
          '</td>'+
          '<td>'+
            '<input type="text" name="new_denda_bukti_setor'+value+'[]" class="span2">'+
          '</td>'+
          '<td>'+
            '<div class="input-prepend-edit-date">'+
              '<input type="text" name="new_denda_tgl_setor'+value+'[]" class="datepicker span2-edit">'+
            '</div>'+
          '</td>'+
          '<td>'+
            '<input type="text" name="new_denda_keterangan'+value+'[]" class="span2">'+
          '</td>'+
          '<td>'+
            '<input type="button" class="btn btn-danger" value="-" id="hapus_denda'+randomnumber+'" onClick=deleteDenda("'+randomnumber+'")>'+
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
    $("#denda_hsl_dinas"+value).val($('.mirror'+value).val());
    
  }

  function mirror2(value)
  {
    $("#denda_hsl_dinas"+value).val($('.mirror'+value).val());
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