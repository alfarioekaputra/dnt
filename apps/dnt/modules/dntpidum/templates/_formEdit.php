<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<form action="<?php echo url_for('dntpidum/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<input type="hidden" name="nilaiConter" id="nilaiConter">
<?php endif; ?>
<div class="form-inline">
  <label>
    No. Register
  </label>
  <?php echo $form['PDM_PERKARA']['nomor_perkara']->render() ?>
  <select name="apb_aps" class="span1">
    <option value="1" selected="true">Apb</option>
    <option value="2">Aps</option>
  </select>
</div>
<div>&nbsp;</div>
<button type="button" id="add_tersangka" >Tambah Terdakwa</button>
<ul class="nav nav-tabs" id="myTab">
  <li id="tab_li1"><a href="#new_tab_id1" data-toggle="tab">Terdakwa 1</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane in active" id="new_tab_id1"> 
    <div class="row">
      <div class="span5">
        <label>Nama</label>  <?php echo $form['nama']->render(array('name' => 'nama_terdakwa[]', 'class' => 'span3')) ?> 
        <label>Tempat/Tanggal Lahir</label>  <?php echo $form['tempat_lahir']->render(array('name' => 'tempat_lahir[]', 'class' => 'span3-edit')) ?>  <?php echo $form['tgl_lahir']->render(array('name' => 'tgl_lahir[]', 'class' => 'datepicker span2-edit', 'id' => 'data_tgllahir1', 'onchange' => 'addtgllahir("1")')) ?>
        <label>Usia</label>  <?php echo $form['umur']->render(array('name' => 'umur[]', 'id' => 'data_umur1', 'class' => 'span1', 'readonly' => 'true')) ?>
        <label>Jenis Kelamin</label>  <?php echo $form['jkl']->render(array('name' => 'jkl[]', 'class' => 'span2')) ?>
        <label>Alamat</label>  <?php echo $form['alamat']->render(array('name' => 'alamat[]', 'class' => 'span4')) ?> 
      </div>
      
      <div class="span3"> 
        <label>Agama</label>  <?php echo $form['id_agama']->render(array('name' => 'id_agama[]', 'class' => 'span3')) ?>
        <label>Pekerjaan</label>  <?php echo $form['pekerjaan']->render(array('name' => 'pekerjaan[]', 'class' => 'span3')) ?> 
        <label>Kewarganegaraan</label>  <?php echo $form['kewarganegaraan']->render(array('name' => 'kewarganegaraan[]', 'class' => 'span3')) ?> 
        <label>Pendidikan</label>  <?php echo $form['pendidikan']->render(array('name' => 'pendidikan[]', 'class' => 'span3')) ?>
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
      <label class="span3-pasal">Pasal Didakwakan<br /><input type="text"></label>
      <label class="span2">Tambah<br /><btn class="btn">+</btn></label>
    </div>
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
</div>
<input type="submit" value="Simpan" class="btn btn-warning" />
</form>
<script type="text/javascript">

  $(function() {
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
  
  var tab_counter = 2;
	var addtab=2;

    function addTab() {
        $('.tab-content').append(
          '<div class="tab-pane in active" id="new_tab_id'+tab_counter+'">' +
            '<div class="row">' +
              '<div class="span5">' +
                '<label>Nama</label>' + '<?php echo $formTersangka['nama']->render(array('class' => 'span3')) ?>' +
                '<label>Tempat/Tanggal Lahir</label>' + '<?php echo $formTersangka['tempat_lahir']->render(array('class' => 'span3-edit')) ?>' + '<input type="text" id="data_tgllahir'+tab_counter+'" onChange=addtgllahir("'+tab_counter+'") class="datepicker span2-edit" />' +
                '<label>Usia</label>' + '<input type="text" id="data_umur'+tab_counter+'" class="span1" />' +
                '<label>Jenis Kelamin</label>' + '<select name="pdm_tersangka[jkl]" class="span2" id="pdm_tersangka_jkl">' +
                                                    '<option value="0">--jenis kelamin--</option>' +
                                                    '<option value="1">Laki-laki</option>' +
                                                    '<option value="2">Perempuan</option>' +
                                                  '</select>' +
                '<label>Alamat</label>' + '<?php echo $formTersangka['alamat']->render(array('class' => 'span5')) ?>' +
              '</div>' +
              '<div class="span3">' +
                '<label>Agama</label>' + '<select name="pdm_tersangka[id_agama]" class="span3" id="pdm_tersangka_id_agama">' +
                                            '<option value="0">--Agama--</option>' +
                                            '<option value="1">Islam</option>' +
                                            '<option value="2">Kristen Protestan</option>' +
                                            '<option value="3">Kristen Katolik</option>' +
                                            '<option value="4">Hindu</option>' +
                                            '<option value="5">Budha</option>' +
                                          '</select>' +
                '<label>Pekerjaan</label>' + '<?php echo $formTersangka['pekerjaan']->render(array('class' => 'span3')) ?>' +
                '<label>Kewarganegaraan</label>' + '<?php echo $formTersangka['kewarganegaraan']->render(array('class' => 'span3')) ?>' +
                '<label>Pendidikan</label>' + '<select name="pdm_tersangka[pendidikan]" class="span3" id="pdm_tersangka_pendidikan">' +
                                                  '<option value="0">--Pendidikan--</option>' +
                                                  '<option value="1">Tidak Tamat SD</option>' +
                                                  '<option value="2">SD / SR</option>' + 
                                                  '<option value="3">SMP / SLTP</option>' +
                                                  '<option value="4">SMA / SLTA</option>' +
                                                  '<option value="5">Diploma / Sarjana Muda</option>' +
                                                  '<option value="6">Sarjana (S1)</option>' +
                                                  '<option value="7">Pascasarjana (S2)</option>' +
                                                  '<option value="8">Doktor (S3)</option>' +
                                                  '<option value="9">Profesor</option>' +
                                                '</select>' +
              '</div>' +
            '</div>' +
            '<hr />' +
            '<legend><b>Putusan Inkrah</b></legend>' +
            '<div class="form-inline">' +
              '<label class="span3-label">No. Amar Putusan Inkrah</label>' +
                '<input type="text" name="no_amar_putusan" class="span3" /> <input type="text" name="tgl_putusan" class="datepicker span2-edit" />' +
                '<select class="span1" name="jns_pengadilan_putusan">' +
                    '<option value="1">PN</option>' +
                    '<option value="2">PT</option>' +
                    '<option value="3">MA</option>' +
                  '</select>' +
            '</div>' +
            '<div class="row">&nbsp;</div>' +
            '<div class="form-inline">' +
              '<label class="span3-label">Posisi Kasus</label>' +
                '<textarea class="span5" style="height: 100px;"></textarea>' +
            '</div>' +
            '<div class="row">&nbsp;</div>' +
            '<div class="form-inline">' +
              '<label class="span3-label"></label>' +
              '<label class="span3-pasal">Pasal Didakwakan<br /><input type="text"></label>' +
              '<label class="span2">Tambah<br /><btn class="btn">+</btn></label>' +
            '</div>' +
            '<div class="form-inline">' +
              '<label class="span3-label">Jenis Putusan</label>' +
                '<select class="span3" name="jns_putusan">' +
                    '<option value="1">Pidana Mati</option>' +
                    '<option value="2">Seumur Hidup</option>' +
                    '<option value="3">Pidana Penjara</option>' +
                    '<option value="4">Pidana Kurungan-Denda</option>' +
                    '<option value="5">Bebas</option>' +
                  '</select>' +
            '</div>' +
            '<div class="row">&nbsp;</div>' +
            '<div class="form-inline">' +
              '<label class="span3-label">Tanggal P.48</label>' +
                '<input type="text" name="tgl_p48" class="datepicker span2-edit" />' +
                '&nbsp;Tanggal BA Eksekusi &nbsp; <input type="text" name="tgl_ba_eksekusi" class="datepicker span2-edit" />' +
            '</div>' +
            '<div class="row">&nbsp;</div>' +
            '<div class="form-inline">' +
              '<label class="span3-label">Tempat Penahanan</label>' +
                '<select class="span2" name="jns_tahanan">' +
                    '<option value="1">Rutan</option>' +
                    '<option value="2">Kota</option>' +
                    '<option value="3">Rumah</option>' +
                  '</select>' +
                '<input type="text" name="tgl_penahanan_mulai" class="datepicker span2-edit" /> s/d <input type="text" name="tgl_penahanan_selesai" class="datepicker span2-edit" />' +
            '</div>' +
            '<div class="row">&nbsp;</div>' +
            '<div class="form-inline">' +
              '<label class="span3-label">Keterangan Penahanan</label>' +
                '<input type="text" name="keterangan_tahanan" class="span5" />' +
            '</div>' +
            '<div class="row">&nbsp;</div>' +
            '<hr />' +
            '<legend><b>Hasil Dinas</b></legend>' +
            '<table class="table">' +
              '<thead>' +
                '<tr>' +
                  '<th></th>' +
                  '<th>Amar Putusan</th>' +
                  '<th>Total Setoran</th>' +
                  '<th>Sisa</th>' +
                '</tr>' +
              '</thead>' +
              '<tbody>' +
                '<tr>' +
                  '<td>Denda Ganti</td>' +
                  '<td>' +
                    '<div class="input-prepend">' +
                      '<span class="add-on">Rp</span><input type="text" name="denda_amar_putusan" class="span2">' +
                    '</div>' +
                  '</td>' +
                  '<td>' +
                    '<div class="input-prepend">' +
                      '<span class="add-on">Rp</span><input type="text" name="denda_total_setoran" class="span2">' +
                    '</div>' +
                  '</td>' +
                  '<td>' +
                    '<div class="input-prepend">' +
                      '<span class="add-on">Rp</span><input type="text" name="denda_sisa" class="span2">' +
                    '</div>' +
                  '</td>' +
                '</tr>' +
                '<tr>' +
                  '<td>Biaya Perkara</td>' +
                  '<td>' +
                    '<div class="input-prepend">' +
                      '<span class="add-on">Rp</span><input type="text" name="biaya_amar_putusan" class="span2">' +
                    '</div>' +
                  '</td>' +
                  '<td>' +
                    '<div class="input-prepend">' +
                      '<span class="add-on">Rp</span><input type="text" name="biaya_total_setoran" class="span2">' +
                    '</div>' +
                  '</td>' +
                  '<td>' +
                    '<div class="input-prepend">' +
                      '<span class="add-on">Rp</span><input type="text" name="biaya_sisa" class="span2">' +
                    '</div>' +
                  '</td>' +
                '</tr>' +
                '<tr>' +
                  '<td>Uang Rampasan</td>' +
                  '<td>' +
                    '<div class="input-prepend">' +
                      '<span class="add-on">Rp</span><input type="text" name="uang_amar_putusan" class="span2">' +
                    '</div>' +
                  '</td>' +
                  '<td>' +
                    '<div class="input-prepend">' +
                      '<span class="add-on">Rp</span><input type="text" name="uang_total_setoran" class="span2">' +
                    '</div>' +
                  '</td>' +
                  '<td>' +
                    '<div class="input-prepend">' +
                      '<span class="add-on">Rp</span><input type="text" name="uang_sisa" class="span2">' +
                    '</div>' +
                  '</td>' +
                '</tr>' +
              '</tbody>' +
            '</table>' +
          '</div>' 
        );
        $('#myTab').append('<li id="tab_li'+tab_counter+'"><a href="#new_tab_id'+tab_counter+'" data-toggle="tab">Terdakwa '+tab_counter+' <span class="" onClick=dlttabtersangka("'+tab_counter+'","'+nourut+'") > | <i class="icon-remove-sign"></i></span></a></li>');
        $('#myTab a:last').tab('show');
        
        tab_counter++;
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
    
  var nourut = 2;
  
  $('#add_tersangka').button().click(function()
    {
        addTab();
        handeltgl($(document));
    });
  
  $("#add_tersangka").click(function() {
        $('#nilaiConter').val(tab_counter-1);
    });
  
</script>