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
<table id="list2"></table>
<div id="pager2"></div>

<script type="text/javascript">
	jQuery("#list2").jqGrid({
   	url:'dnt_dev.php',
	datatype: "json",
   	colNames:['No. Register','Nama Terdakwa', 'No. Amar Putusan'],
   	colModel:[
   		{name:'inst_satkerkd',index:'inst_satkerkd', width:150},
   		{name:'inst_satkerinduk',index:'inst_satkerinduk', width:120},
   		{name:'inst_nama',index:'inst_nama', width:100}		
   	],
   	rowNum:10,
   	rowList:[10,20,30],
   	pager: '#pager2',
   	sortname: 'id',
    viewrecords: true,
    sortorder: "desc",
    caption:"JSON Example"
});
//jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});
</script>
