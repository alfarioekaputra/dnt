<?php use_helper('Pagination') ?>
<script type="text/javascript">
	
	/* API method to get paging information */
	$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
	{
		return {
			"iStart":         oSettings._iDisplayStart,
			"iEnd":           oSettings.fnDisplayEnd(),
			"iLength":        oSettings._iDisplayLength,
			"iTotal":         oSettings.fnRecordsTotal(),
			"iFilteredTotal": oSettings.fnRecordsDisplay(),
			"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
			"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
		};
	}
	/* Bootstrap style pagination control */
	$.extend( $.fn.dataTableExt.oPagination, {
		"bootstrap": {
			"fnInit": function( oSettings, nPaging, fnDraw ) {
				var oLang = oSettings.oLanguage.oPaginate;
				var fnClickHandler = function ( e ) {
					e.preventDefault();
					if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
						fnDraw( oSettings );
					}
				};

				$(nPaging).addClass('pagination').append(
					'<ul>'+
						'<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
						'<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
					'</ul>'
				);
				var els = $('a', nPaging);
				$(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
				$(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
			},

			"fnUpdate": function ( oSettings, fnDraw ) {
				var iListLength = 5;
				var oPaging = oSettings.oInstance.fnPagingInfo();
				var an = oSettings.aanFeatures.p;
				var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

				if ( oPaging.iTotalPages < iListLength) {
					iStart = 1;
					iEnd = oPaging.iTotalPages;
				}
				else if ( oPaging.iPage <= iHalf ) {
					iStart = 1;
					iEnd = iListLength;
				} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
					iStart = oPaging.iTotalPages - iListLength + 1;
					iEnd = oPaging.iTotalPages;
				} else {
					iStart = oPaging.iPage - iHalf + 1;
					iEnd = iStart + iListLength - 1;
				}

				for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
					// Remove the middle elements
					$('li:gt(0)', an[i]).filter(':not(:last)').remove();

					// Add the new list items and their event handlers
					for ( j=iStart ; j<=iEnd ; j++ ) {
						sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
						$('<li '+sClass+'><a href="#">'+j+'</a></li>')
							.insertBefore( $('li:last', an[i])[0] )
							.bind('click', function (e) {
								e.preventDefault();
								oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
								fnDraw( oSettings );
							} );
					}

					// Add / remove disabled classes from the static elements
					if ( oPaging.iPage === 0 ) {
						$('li:first', an[i]).addClass('disabled');
					} else {
						$('li:first', an[i]).removeClass('disabled');
					}

					if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
						$('li:last', an[i]).addClass('disabled');
					} else {
						$('li:last', an[i]).removeClass('disabled');
					}
				}
			}
		}
	} );
	
	/* Table initialisation */
	$(document).ready(function() {
		oTable = $('#table_index_pidum').dataTable( {
			"bProcessing": true,
			"bServerSide": true,
			"bFilter":false,
			"sDom": "<'row'<'span8'l><'span8'f>r>t<'row'<'span8'i><'span8'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sSearch": '',
				"sLengthMenu": '',
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
			"sAjaxSource": "<?php echo url_for('barangRampasan/getDataIndexRampasan') ?>",
			
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
		} );
		$('#tombol_cari_index_pidum').click(function() {
			// Reload data based on choice
			oTable.fnReloadAjax();
		});
	} );
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
	<label>Kejaksaan <input type="text" class="input-xlarge-edit" name="txt_kejaksaan" id="txt_kejaksaan"><a data-toggle="modal" href="#myModal" data-target="#myModal" class="btn btn-warning">...</a><input type="checkbox" value="1">Semua Sub</label>
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
<a class="btn btn-warning" href="<?php echo url_for('barangRampasan/new') ?>">Tambah</a>
<div>&nbsp;</div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped dataTable" id="table_index_pidum" aria-describedby="example_info">
    <thead style="background: #FAA938 ;">
      <tr>
          <th>No. Perkara</th>
          <th>Jenis Barang</th>
		  <th>Tempat Penyimpanan</th>
		  <th>Kondisi</th>
		  <th>Status</th>
		  <th>Action</th>
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
	    "sPaginationType": "bootstrap",
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
    <input type="submit" name="cari" class="btn" id="tombolcarikejati_pidum" value="Cari">
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