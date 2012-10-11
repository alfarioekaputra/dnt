<?php use_helper('Pagination') ?>
<script type="text/javascript">
	$(function(){
       
	  oTable = $('#table_index_pidum').dataTable({
	    'bProcessing': true,
	    'bServerSide': true,
         //"bJQueryUI": true,
		 "bSort": false,
	    "sPaginationType": "full_numbers",
            "sDom": '<"H"lr>t<"F"ip>',
            "oLanguage": {
						"sSearch": '',
						"sLengthMenu": "&nbsp;",
						"sZeroRecords": "Data tidak ditemukan",
						"sInfo": "Tampilkan _START_ sampai _END_ baris dari jumlah total _TOTAL_ baris",
						"sInfoEmpty": "Tampilkan 0 sampai 0 dari 0 jumlah baris",
						"sInfoFiltered": "(Memfilter dari _MAX_ jumlah baris)",
						"oPaginate": {
                					"sFirst": "Awal",
							"sLast": "Akhir",
							"sNext": "Berikutnya",
							"sPrevious": "Sebelumnya"
            					}
		

					},
	    'sAjaxSource': "<?php echo url_for('dntpidum/getdataindexpidum') ?>",
       //    "fnServerData": function ( sSource, aoData, fnCallback ) {
     // $.getJSON( sSource, [ {"name": "searchnya", "value":$("#searchnya").val()} ], function (json) {
     //     fnCallback(json)
   // } );
//}
"fnServerData": function ( sSource, aoData, fnCallback ) {
			/* Add some extra data to the sender */
			aoData.push( { "name": "searchnya", "value": $("#cari_data_index_pidum").val() } );
			aoData.push( { "name": "filter", "value": $("#filter_cari_index_pidum").val() } );
			aoData.push( { "name": "kejati", "value": $("#idKejaksaan_IndexPidum").val() } );
			aoData.push( { "name": "semuasub", "value": $("#semuasub_indexpidum").val() } );
			$.getJSON( sSource, aoData, function (json) {
				/* Do whatever additional processing you want on the callback, then tell DataTables */
				fnCallback(json)
				
			} );
			
		}

       
	 });
		$('#tombol_cari_index_pidum').click(function() {
   // Reload data based on choice
   				oTable.fnReloadAjax();
			});
			
     });
  $.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
{
	
    if ( typeof sNewSource != 'undefined' && sNewSource != null )
    {
        oSettings.sAjaxSource = sNewSource;
    }
    this.oApi._fnProcessingDisplay( oSettings, true );
    var that = this;
    var iStart = oSettings._iDisplayStart;
     
    oSettings.fnServerData( oSettings.sAjaxSource, [], function(json) {
        /* Clear the old information from the table */
        that.oApi._fnClearTable( oSettings );
         
        /* Got the data - add it to the table */
       for ( var i=0 ; i<json.aaData.length ; i++ )
        {
            that.oApi._fnAddData( oSettings, json.aaData[i] );
        }
         
        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
        that.fnDraw( that );
         
        if ( typeof bStandingRedraw != 'undefined' && bStandingRedraw === true )
        {
            oSettings._iDisplayStart = iStart;
            that.fnDraw( false );
        }
         
        that.oApi._fnProcessingDisplay( oSettings, false );
         
        /* Callback user function - for event handlers etc */
        if ( typeof fnCallback == 'function' && fnCallback != null )
        {
            fnCallback( oSettings );
        }
    } );
}
$(function() {
 $('a[data-toggle=modal]').click(function(e) {
	e.preventDefault();
	var href = $(e.target).attr('href');
	if (href.indexOf('#') == 0) {
	 $(href).modal('show');
	} else {
	  $.get(href, function(data) {
		$('<div class="modal">' + data + '</div>').modal('show').appendTo('body');
		
		$('#modal').modal('hide');
      });
	}
  });
 
 
});
</script>
<form class="form-horizontal">
	<label>Kejaksaan <input type="text" class="input-xlarge-edit" name="txt_kejaksaan" id="txt_kejaksaan"><a data-toggle="modal" href="#myModal" data-target="#modal" class="btn btn-warning">...</a><input type="checkbox" value="1">Semua Sub</label>
	<input type="hidden" name="txt_kejaksaan_id" id="txt_kejaksaan_id" />
	<label>
		Filter &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select class="span2">
			  <option value="1">No. Perkara</option>
			  <option value="2">Nama Terdakwa</option>
			  <option value="3">No. Amar putusan</option>
			  <option value="4">Tanggal</option>
			  <option value="5">Tahun</option>
			  <option value="6">Status</option>
			</select>
			<input type="text" id="satker" name="filter" size="60" />
			<button class="btn">Cari</button>
	</label>
</form>
<a class="btn btn-warning" href="<?php echo url_for('dntpidum/new') ?>">Tambah</a>
<div>&nbsp;</div>
<table cellspacing="1" width="100%" class="listing_table" id="table_index_pidum">
    <thead style="background: #b46a01 ;">
      <tr>
          <th class="data" style="text-align: center; color: #FFFFFF;">No. Perkara</th>
          <th class="data" style="text-align: center; color: #FFFFFF;">Nama Terdakwa</th>
		  <th class="data" style="text-align: center; color: #FFFFFF;">No. Amar Putusan</th>
		  <th class="data" style="text-align: center; color: #FFFFFF;">Tanggal</th>
		  <th class="data" style="text-align: center; color: #FFFFFF;">Status</th>
		  <th class="data" style="text-align: center; color: #FFFFFF;">Action</th>
      </tr>
    </thead>
    <tbody>
	</tbody>
    </table>  

<!--<a class="to_modal btn" href="<?php //echo url_for('dntpidum/dataKejati/idkejati/tab1') ?>" data-toggle="modal" data-target="#myModal">Launch Modal</a>-->
<!--<a data-toggle="modal" href="#myModal" data-target="#modal">click me</a>-->

<div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">INSTANSI</h3>
  </div>
  <div class="modal-body">
    <script type="text/javascript">
 $(function(){
       
	  oTable = $('#tabelpilihkejati_pidum').dataTable({
	    'bProcessing': true,
	    'bServerSide': true,
         //"bJQueryUI": true,
		 "bSort": false,
	    "sPaginationType": "full_numbers",
            "sDom": '<"H"lr>t<"F"ip>',
            "oLanguage": {
						"sSearch": '',
						"sLengthMenu": "",
						"sZeroRecords": "Data tidak ditemukan",
						"sInfo": "Tampilkan _START_ sampai _END_ baris dari jumlah total _TOTAL_ baris",
						"sInfoEmpty": "Tampilkan 0 sampai 0 dari 0 jumlah baris",
						"sInfoFiltered": "(Memfilter dari _MAX_ jumlah baris)",
						"oPaginate": {
                					"sFirst": "Awal",
							"sLast": "Akhir",
							"sNext": "Berikutnya",
							"sPrevious": "Sebelumnya"
            					}
		

					},
	    'sAjaxSource': "<?php echo url_for('dntpidum/getDataKejatiPidum') ?>",
       //    "fnServerData": function ( sSource, aoData, fnCallback ) {
     // $.getJSON( sSource, [ {"name": "searchnya", "value":$("#searchnya").val()} ], function (json) {
     //     fnCallback(json)
   // } );
//}
"fnServerData": function ( sSource, aoData, fnCallback ) {
			/* Add some extra data to the sender */
			aoData.push( { "name": "pilihanSearchKejati", "value": $("#pilihanSearchKejati").val() } );
			aoData.push( { "name": "cariKejati", "value": $("#cariKejati").val() } );
			aoData.push( { "name": "pilihkejatitab", "value": $("#pilihkejatitab").val() } );
			//aoData.push( { "name": "semuasub", "value": $("#semuasub_indexpidum").val() } );
			$.getJSON( sSource, aoData, function (json) {
				/* Do whatever additional processing you want on the callback, then tell DataTables */
				fnCallback(json)
				
			} );
			
		}

       
	 });
		$('#tombolcarikejati_pidum').click(function() {
   // Reload data based on choice
   				oTable.fnReloadAjax();
			});
			
     });
  $.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
{
    if ( typeof sNewSource != 'undefined' && sNewSource != null )
    {
        oSettings.sAjaxSource = sNewSource;
    }
    this.oApi._fnProcessingDisplay( oSettings, true );
    var that = this;
    var iStart = oSettings._iDisplayStart;
     
    oSettings.fnServerData( oSettings.sAjaxSource, [], function(json) {
        /* Clear the old information from the table */
        that.oApi._fnClearTable( oSettings );
         
        /* Got the data - add it to the table */
       for ( var i=0 ; i<json.aaData.length ; i++ )
        {
            that.oApi._fnAddData( oSettings, json.aaData[i] );
        }
         
        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
        that.fnDraw( that );
         
        if ( typeof bStandingRedraw != 'undefined' && bStandingRedraw === true )
        {
            oSettings._iDisplayStart = iStart;
            that.fnDraw( false );
        }
         
        that.oApi._fnProcessingDisplay( oSettings, false );
         
        /* Callback user function - for event handlers etc */
        if ( typeof fnCallback == 'function' && fnCallback != null )
        {
            fnCallback( oSettings );
        }
    } );
}

</script>
<script type="text/javascript">
	function goPilihKejati(value){
		var satker = value.split("#");
		$("#txt_kejaksaan_id").val(satker[0]);
		$("#txt_kejaksaan").val(satker[1]);
	}
</script>
<div class="form_row"> <label for="kriteria">Filter</label>
    <select id="pilihanSearchKejati" class="ncus" name="pilihanSearchKejati">
    	<option value="" selected>Pilih</option>
        <option value="1" selected>Kode</option>
        <option value="2">Nama</option>
    </select>
    <input align="left" type="text" name="cariKejati" id="cariKejati" >
    <input type="submit" name="cari" class="ncusbtn" id="tombolcarikejati_pidum" value="Cari">
    <input type="hidden" name="pilihkejatitab" id="pilihkejatitab" value="<?php echo $idkejati; ?>" />
</div>

<div id="list-kejati">
<table class="table table-bordered" id="tabelpilihkejati_pidum" cellspacing="1" width="100%">
  <thead style="background: #b46a01 ;">
    <tr >
        <th width="20%" style="text-align: center; color: #FFFFFF;"><font size="2px"> KODE </font></th>
      <th width="70%" style="text-align: center; color: #FFFFFF;"><font size="2px">SATKER </font></th>
      <th width="10%" style="text-align: center; color: #FFFFFF;"><font size="2px">PILIH </font></th>
    </tr>
  </thead>
 <tbody>
  
  </tbody>
</table>
</div>
  </div>
  
</div>