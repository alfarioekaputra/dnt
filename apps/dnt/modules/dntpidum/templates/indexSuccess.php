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
</script>
<form class="form-horizontal">
	<label>Kejaksaan <input type="text" class="input-xlarge" name="kejaksaan"><button class="btn">...</button><input type="checkbox" value="">Semua Sub</label>
	<label>
		Filter &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select class="span2">
			  <option>No. Register</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
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
          <th class="data" style="text-align: center; color: #FFFFFF;">No. Register</th>
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

