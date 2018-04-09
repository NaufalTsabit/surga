<div class="col-md-12">
<style type="text/css">
	tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    table {
    border: 1px solid black;
	}

    td {
    border: 1px solid darkgrey;
	}
	th {
    border: 1px solid darkgrey;
	}
   
    .pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover {
    	background-color: #4EA9F7;
		border-color: #4EA9F7;
		color: #fff !important;
    }

    .modal {
	  text-align: center;
	}

	.modal:before {
	  display: inline-block;
	  vertical-align: middle;
	  content: " ";
	  height: 100%;
	}

	.modal-dialog {
	  display: inline-block;
	  text-align: left;
	  vertical-align: middle;
	}
    .pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
    	color: #aab2bd;
    }
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    	background-color: #37bc9b;
		border-color: #37bc9b;
		color: #fff !important;
    }
    .topic .container .pagination>li>a, .topic .container .pagination>li>span {
    	color: #747474;
    	text-decoration: none;
    }
    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate  {
    	color: #000;
        font-weight: bold;
    }
    .table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
    	vertical-align: middle;
    	color: #fff;
    	text-align: center;
    }
    .badge, .label {
    	background-color: #3BAFDA;
    }
    .nav>li>a:focus, .nav>li>a:hover {
    	background-color: #FFF;
		color: #3BAFDA;
    }
     .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
     	text-decoration: none;
     }
     .topic .container a {
     	text-decoration: none;
     }
     .dataTables_filter {
	     display: none;
	}
	.as {
		color: black;
		background-color: #3BAFDA;
	}
	.as2 {
		color: white;
		background-color: #3BAFDA;
	}
	.tablepress thead tr th,
	.tablepress tfoot th {
		background-color: #000000;
	}
	.table {

		border-color: #000;
		border-style: solid;
		outline-color: #000;
	}
	.hehe {

		border-color: #000;
		border-style: solid;
		outline-color: #000;
	}
	.ukuran {
		font-size:13px;
	}
	#content1 {
	float: left;
	width: 67%;

	}
	#content2 {
		float: left;
		width: 15%;
		
	}
	#content3 {
		float: right;
		width: 15%;
		
	}
</style>

<div id="content1" class="form-group">
                            
<p hidden id="temp"><?php echo $tipe; ?></p>
    &nbsp;
    <p> <font color="black">Cari Berdasarkan Tahun:</font> </p>
    <select id="tahun" name="tahun" style="width: 200px">
        <?php for ($i = date('Y'); $i >= 2014 ; $i--): ?>
            <option value="<?php echo $i;?>" <?php if ($i == $tahun_ini) echo "selected";?> ><?php echo $i;?></option>
        <?php endfor;?>
    </select>
</div>
<div id="content2" align="right">
&nbsp;
	<p> <font color="black">Cari Berdasarkan Kolom:</font> </p>
	<select id="cari" name="cari" style="width: 185px">
		<option value="-1" selected="selected">Semua Kolom</option> 
		<option value="0">Nomor Aduan</option>
		<option value="1">Nama</option>
		<option value="2">Waktu</option>
		

	

		<option value="3">Departemen</option>
		<option value="4">Status</option>
		<!--
		<option value="7">Prioritas</option>
		-->
		<option value="5">Jalur</option>
		<!--
		<option value="7">Spam</option>
		-->
	</select>

	
</div> 

<div  id="content3">
	 &nbsp;
	   <p> <font color="black">Masukkan Keyword</font> </p>
		<p id="text_keyword"></p>
</div> 

<table id="list_aduan" class="table ukuran">
	<thead >
		<tr class="as2">
			<th> <font class="as2">Nomor Aduan </font></th>
			<th> <font class="as2">Nama</font></th>
			<th> <font class="as2">Waktu</font></th>
			<th> <font class="as2">Topik</font></th>
			<!--
			<th> <font class="as2">Isi</font></th>
			-->
			<th> <font class="as2">Departemen</font></th>
			<th> <font class="as2">Status</font></th>
			<!--
			<th>Prioritas</th>
			-->
			<th> <font class="as2">Jalur</font></th>
			<th> <font class="as2">Aksi </font> </th>
		</tr>
	</thead>
	<!--
	<tfoot>
		<tr>
			<th>Nomor Aduan</th>
			<th>Nama</th>
			<th>Waktu</th>
			<th>Topik</th>
			<th>Isi</th>
			<th>Departemen</th>
			<th>Status</th>
			<th>Prioritas</th>
			<th>Jalur</th>
			<th>Aksi</th>
		</tr>
	</tfoot>
	-->
	<tbody >
		<?php foreach ($list_aduan as $key => $value): ?>
		<tr class="as ">
		<!--
			<td><?php echo ($value['id_aduan'] - $max_aduan).'/'.$tahun_ini; ?></td>
			-->
			<td align="center"><?php echo ($value['id_aduan'] - $max_aduan); ?></td>
			<td><a class="modalajax" data-toggle="modal" data-target="#mymodal" style="color: rgba(50, 142, 208, 0.9);" href="#"><span style="display:none;"><?php echo $value["no_identitas"];?></span><?php echo $value['nama']; ?></a></td>
			<td><?php echo $value['waktu']; ?> <br/> <abbr class="timeago" title="<?php echo $value['waktu']; ?>"></abbr></td>
			<td><?php echo $value['topik']; ?></td>
			<!--
			<td><?php echo substr($value['isi'], 0, 25).'...'; ?></td>
			-->
			<td>
				<?php if($value['info'] == '4'):  ?>
					<?php echo $value['nama_departemen']; ?>
				<?php endif;?>
			</td>
			<td ><?php echo $value['nama_status']; ?></td>
			<!--
			<td class="<?php echo $value['class_prioritas']; ?>"><?php echo $value['nama_prioritas']; ?></td>
			-->
			<td><?php echo $value['via_sms'] == '1' ? 'SMS' : 'Website'; ?></td>
			<td><a class="btn btn-info" href="<?php echo site_url('aduan/jawab').'/'.$value['id_aduan']; ?>">Tindak Lanjut</a></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>

<script type="text/javascript">    
    $(document).ready(function() {
	$("abbr.timeago").timeago();
   		var table = $('#list_aduan').DataTable( {
	        "language": {
	            "lengthMenu": "Tampilkan _MENU_ data per halaman",
	            "zeroRecords": "data tidak tersedia",
	            "info": "Showing page _PAGE_ of _PAGES_",
	            "infoEmpty": "No records available",
	            "infoFiltered": "(filtered from _MAX_ total records)",
	            "sSearch": "cari"
	        },
	        "order": [[ 2, "desc" ]],
	        "dom": '<"top"flp<"clear">>rt<"bottom"ip<"clear">>'
    	} )
    	
   		table.$('tr:odd').css('backgroundColor', '#E0E0E0');

   		var tahun = $('#tahun').val();
   		table.column(2).search(tahun).draw();

   		var $ol = $('#tahun');
       	$ol.data('oldVall',  $ol.val() );

       	$ol.change(function(){
            //store new value
            
	         


            var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
			var segment_array = segment_str.split( '/' );
			var last_segment = segment_array[3];
			var temp = document.getElementById("temp").innerHTML;

			//alert(segment_str);
			//alert(last_segment); // alerts segment4
			//alert(temp); // alerts segment4
			var loc = window.location.href;
			var tahun = $('#tahun').val();
	        

            var url_detail = "dashboard2/" + temp + "/" + tahun;

			index = loc.indexOf("dashboard");

			if (index > 0) {
			  window.location = loc.substring(0, index) + url_detail ;
			}
       	
    	});


       	var $el = $('#cari');
       	$el.data('oldVal',  $el.val() );

       	//var x = $el.val();
       	var title = $el.val();
       	$('#text_keyword').html('<input type="text" id="'+title+'" placeholder="masukkan keyword " />');

       	
       	 $('input').keyup(function(){
			    table
			    .search($(this).val()).draw() ;
	      
		});

       	$el.change(function(){
            //store new value
            var $this = $(this);
            var newValue = $this.data('newVal', $this.val());
      
	        var title = $this.val();
	        	
			if(title == -1){
				//document.getElementById("demo").innerHTML =  $this.val();
				
				$('#text_keyword').html('<input type="text" id="'+title+'" placeholder="masukkan keyword " />');

		        $('input').keyup(function(){
					    table
					    .search($(this).val()).draw() ;
			      
				});
       				
			} else {
				//document.getElementById("demo").innerHTML = "asdasd";
				$('#text_keyword').html('<input type="text" id="'+title+'" placeholder="masukkan keyword " />');

		        $('input').keyup(function () {
		            table
		                .column( $this.val() )
		                .search( this.value )
		                .draw();
			      
				});
			}

       	})
       	.focus(function(){
            // Get the value when input gains focus
            var oldValue = $(this).data('oldVal');
       	});
    });
</script>
