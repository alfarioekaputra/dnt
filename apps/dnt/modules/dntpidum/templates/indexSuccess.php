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
		oTablePdm = $('#table_index_pidum').dataTable( {
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
			"sAjaxSource": "<?php echo url_for('dntpidum/getdataindexpidum') ?>",
			
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
				
			},
			"fnRowCallback": function( nRow, aData, iDisplayIndex,iDisplayIndexFull) {

				$(nRow).children().each(function(index, td) {

					if(index == 4)  {

						if ($(td).html() === "MERAH") {
							$(td).css("background-color", "#FF0000");
							$(td).css("color", "#FF0000");
						} 
						else if ($(td).html() === "KUNING") {
							$(td).css("background-color", "#FFFF00");
							$(td).css("color", "#FFFF00");
						}                    
						else if ($(td).html() === "HIJAU") {
							$(td).css("background-color", "#00FF00");
							$(td).css("color", "#00FF00");
						}                    
					}
				});                       
				return nRow;
			  },
		} );
		$('#tombol_cari_index_pidum').click(function() {
			// Reload data based on choice
			oTablePdm.fnReloadAjax();
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
	
	function pdmgantiIndexvaluecheckbox(){
		if ($('#semuasub_indexpidum').attr('checked')) {
			$('#semuasub_indexpidum').val('1');
		}
		else{
			$('#semuasub_indexpidum').val('0');
		}
	}
</script>
<!--<form method="post" action="">-->
	<div class="form-inline">
		<label class="span1">
			Kejaksaan
		</label>
		&nbsp;
			<input type="text" class="input-xlarge-edit" name="txt_kejaksaan" id="txt_kejaksaan"><a data-toggle="modal" href="#myModal" data-target="#myModal" class="btn btn-warning" id="popup">...</a><input type="checkbox" name="semuasub_indexpidum" id="semuasub_indexpidum" value="0" onclick="pdmgantiIndexvaluecheckbox()">Semua Sub
			<input type="hidden"  name="idKejaksaan_IndexPidum" id="idKejaksaan_IndexPidum" value="<?php echo $kode_satker ?>">
	</div>
	<div class="form-inline">
		<label class="span1">
			Filter
		</label>
		&nbsp;
			<select id="filter_cari_index_pidum" class="span2" name="filter_cari_index_pidum">
			  <option value="1">No. Perkara</option>
			  <option value="2">Nama Terdakwa</option>
			  <option value="3">No. Amar putusan</option>
			  <option value="4">Tanggal</option>
			  <option value="5">Tahun</option>
			  <option value="6">Status</option>
			</select>
			<input type="text" id="cari_data_index_pidum" name="cari_data_index_pidum" size="60" />
			<input type="button" name="tombol_cari_index_pidum" class="btn" id="tombol_cari_index_pidum" value="Cari">
		</label>
	</div>
	<input type="hidden" name="txt_kejaksaan_id" id="txt_kejaksaan_id" />
<!--</form>-->
<a class="btn btn-warning" href="<?php echo url_for('dntpidum/new') ?>">Tambah</a>
<div>&nbsp;</div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped dataTable" id="table_index_pidum" aria-describedby="example_info">
    <thead style="background: #FAA938 ;">
      <tr>
          <th>No. Perkara</th>
          <th>Nama Terdakwa</th>
		  <th>No. Amar Putusan</th>
		  <th>Tanggal</th>
		  <th>Status</th>
		  <th>Action</th>
      </tr>
    </thead>
    <tbody>
	</tbody>
    </table>  

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
    <!--<button class="btn btn-primary">Simpan</button>-->
  </div>
</div>
<script type="text/javascript">
	$("#popup").click(function() {
        $('.modal-body').load("<?php echo url_for('dntpidum/kejati') ?>");
		
    });
	
</script>

