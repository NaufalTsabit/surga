<style type="text/css">
	tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

    h3 {
        border-bottom: thin groove black;
        padding-bottom: 0px;

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
	.flexigrid div.form-div input[type=text] {                
                font-size: 16px;  
                height:35px;      
	}
	tr.as {
		color: black;
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
	#footer1 {
		float: left;
		text-align: left;
		width: 30%;
		
	}
	#footer2 {
		float: right;
		width: 50%;
		
	}

</style>

<h3>NOTIFIKASI</h3>


<div style="padding-left: 0;" class="col-md-7">

</div>

<div style="padding-right: 0;" class="col-md-5">
	<div style="padding-right: 0; " class="col-md-6">
		<p> <font color="black">Cari Berdasarkan Kolom:  </font> </p>
		<select id="cari" name="cari" style="width: 100%">
		     <option value="-1" selected="selected">Semua Kolom</option> 
		    <option value="0">ID </option>
		    <option value="1">Nama</option>
		    <option value="2">Jabatan</option>
		    <option value="3">Selang Hari Pengecekan</option>
		    <option value="4">No HP</option>
		    <option value="5">Waktu Pengecekan</option>
		    <option value="6">Tanggal Mulai Pengecekan</option>
		   
		</select>
	</div>

	<div style="padding-right: 0;" class="col-md-6">
		<p> <font color="black">Masukkan Keyword</font> </p>
		<p id="text_keyword"></p>
	</div>
	
</div>

<br><br><br>

<table id="list_notif" class="table ukuran">
	<thead>
		<tr class="as">
			<th>ID</th>
			<th>Nama</th>
			<th>Jabatan</th>
			<th>Selang Hari Pengecekan</th>
			<th>No HP</th>
			<th>Waktu Pengecekan</th>
			<th>Tanggal Mulai Pengecekan</th>
			<th>Aksi</th>
			<!--
			<th>Prioritas</th>
			-->
		
		</tr>
	</thead>

	<tbody  >
		<?php foreach ($list_notif as $key => $value): ?>

		<tr class="as">
		
			<td align="center"><?php echo ($value['id_pengaturan']); ?></td>
			<td><?php echo $value['nama']; ?></td>
			<td><?php echo $value['jabatan']; ?></td>
			<td><?php echo $value['selang_hari']; ?></td>
			<td><?php echo $value['no_hp_walikota']; ?></td>
			<td align="center"><?php echo $value['waktu_pengecekan']; ?></td>
			<td align="center"><?php echo $value['tgl_start_notif']; ?></td>
			<td align="center">
				<button type="button" class="fnDpt btn-info" data-tipe="0" data-id="<?php echo ($key); ?>" data-toggle="modal" data-target="#myModalEdit">Edit</button>
				<button type="button" class="fnDpt btn-danger" data-tipe="1" data-id="<?php echo ($key); ?>" data-toggle="modal" data-target="#myModalDelete">Hapus</button>
			</td>


			
		</tr>
		<?php endforeach;?>
	</tbody>
</table>


<div id="myModalAdd" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <form id="add" role="form" method="POST" action="<?php echo site_url('admin/notifikasi'); ?>">
      <div class="modal-body">
        	
        	<div class="form-group">
              <label for="usrname">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">    
            </div>
            <div class="form-group">
              <label for="usrname">Jabatan</label>
              <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan">    
            </div>
            <div class="form-group">
              <label for="usrname">Selang Hari Cek Notifikasi (Angka)</label>
              <input name="selang_hari" class="form-control"  id="selang_hari" onKeyPress="return numbersonly(this, event)" placeholder="Masukkan Selang Hari (berapa hari sekali)">            
            </div>
            <div class="form-group">
              <label for="psw">No HP</label>
              <input type="text" class="form-control" id="no_hp_walikota" name="no_hp_walikota" onKeyPress="return numbersonly(this, event)" placeholder="Masukkan Nomor HP">
            </div>
            <div class="form-group">
              <label for="psw">Waktu Pengecekan</label>
              <input class="form-control" id="timepicker" name="waktu_pengecekan" type="text" value="00:00:00"></input>
              <!--
              <input type="text" class="form-control" id="waktu_pengecekan" name="waktu_pengecekan" placeholder="Masukkan Nomor HP">
              -->
            </div>
            
            <div class="form-group">
              <label for="psw">Tanggal Mulai Notifikasi</label>
              <input type="text" class="form-control" name="tgl_start_notif" id="datepicker" value="<?php echo $tgl_skr; ?>">
              <!--
              <input type="text" class="form-control" id="tgl_start_notif" name="tgl_start_notif" placeholder="Masukkan Apakah Mitra">
				-->
            </div>
               
      </div>
      <div class="modal-footer">
      	<div id="footer1">
     		<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
     		
 		</div>
 		<div id="footer2">
      		<input align="left" type="submit" class="btn btn-primary" name="add" id="add" value="Submit" />
      	</div>
  
      </div>
      </form>
    </div>

  </div>
</div>

<div id="myModalEdit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Data</h4>
      </div>
        <form id="edit" role="form" method="POST" action="<?php echo site_url('admin/notifikasi'); ?>">
	      <div class="modal-body">
	        	<!--
	        	<input type="text" name="bookId" id="bookId" value=""/>
	        	-->
	        	<div class="form-group">
	              <label for="usrname">ID</label>
	              <input readonly="readonly" retype="text" class="form-control" id="id_pengaturan" name="id_pengaturan" value="" >
	            </div>
	            
	            <div class="form-group">
	              <label for="usrname">Nama</label>
	              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">    
	            </div>
	            <div class="form-group">
	              <label for="usrname">Jabatan</label>
	              <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan">    
	            </div>
	            <div class="form-group">
	              <label for="usrname">Selang Hari Cek Notifikasi</label>
	          
	              <input name="selang_hari" class="form-control"  id="selang_hari" onKeyPress="return numbersonly(this, event)">
	            
	            </div>
	            <div class="form-group">
	              <label for="psw">No HP</label>
	              <input type="text" class="form-control" id="no_hp_walikota" name="no_hp_walikota" onKeyPress="return numbersonly(this, event)">
     
	            </div>
	            <div class="form-group">
	              <label for="psw">Waktu Pengecekan</label>
	              <input type="text" class="form-control" id="waktu_pengecekan" name="waktu_pengecekan" value="">
	            </div>
	            
	            <div class="form-group">
	              <label for="psw">Tanggal Mulai Notifikasi</label>
	              
	              <input type="text" class="form-control" name="tgl_start_notif" id="tgl_start_notif" value="">
	            </div>
	               
	            
	      </div>
	      <div class="modal-footer">
	      	<div id="footer1">
     			<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
     		
	 		</div>
	 		<div id="footer2">
	      		<input onclick="return confirm('Yakin diubah?')" align="left" type="submit" class="btn btn-success" name="edit" id="edit" value="Update" />
	      	</div>
	        
	       
	      </div>
      </form>
    </div>

  </div>
</div>

<div id="myModalDelete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hapus Data </h4>
      </div>
      <form id="delete" role="form" method="POST" action="<?php echo site_url('admin/notifikasi'); ?>">
	      <div class="modal-body">
	        	<!--
	        	<input type="text" name="bookId" id="bookId" value=""/>
	        	-->
	        	<div class="form-group">
	              <label for="usrname">ID</label>
	              <input readonly="readonly" retype="text" class="form-control" id="id_pengaturan" name="id_pengaturan" value="" >
	            </div>
	            
	            <div class="form-group">
	              <label for="usrname">Nama</label>
	              <input readonly="readonly" type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">    
	            </div>
	            <div class="form-group">
	              <label for="usrname">Jabatan</label>
	              <input readonly="readonly" type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan">    
	            </div>
	            <div class="form-group">
	              <label for="usrname">Selang Hari Cek Notifikasi</label>
	              <input readonly="readonly" type="text" class="form-control" id="selang_hari" name="selang_hari" value="" >
	            
	            </div>
	            <div class="form-group">
	              <label for="psw">No HP</label>
	              <input readonly="readonly" type="text" class="form-control" id="no_hp_walikota" name="no_hp_walikota">
	            </div>
	            <div class="form-group">
	              <label for="psw">Waktu Pengecekan</label>
	              <input readonly="readonly" type="text" class="form-control" id="waktu_pengecekan" name="waktu_pengecekan" >
	            </div>
	            
	            <div class="form-group">
	              <label for="psw">Tanggal Mulai Notifikasi</label>
	              <input readonly="readonly" type="text" class="form-control" id="tgl_start_notif" name="tgl_start_notif" >
	            </div>

	               
	      </div>
	      <div class="modal-footer">
	        
	       
	        <div id="footer1">
     			<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
     		
	 		</div>
	 		<div id="footer2">
	      		<input onclick="return confirm('Yakin dihapus?')" align="left" type="submit" class="btn btn-success" name="delete" id="delete" value="Hapus" />
	      	</div>
	      </div>
      </form>
    </div>

  </div>
</div>




<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">


<script type="text/javascript">

$(function() {

        $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#tgl_start_notif" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#timepicker" ).timepicker({ 'timeFormat': 'H:i:s' });
        $( "#waktu_pengecekan" ).timepicker({ 'timeFormat': 'H:i:s' });
        
  });



$(document).on("click", ".fnDpt", function () {
     var id = $(this).data('id');
     var tipe = $(this).data('tipe');

     <?php
     	$id_pengaturan = array();
	    $selang_hari = array();
	    $no_hp_walikota = array();
	    $waktu_pengecekan = array();
	    $tgl_start_notif = array();
	    $nama = array();
	    $jabatan = array();
	    foreach ($list_notif as $key => $value) {
	    		
	    		array_push($id_pengaturan, $value['id_pengaturan']);
	    		array_push($selang_hari, $value['selang_hari']);
	        	array_push($no_hp_walikota, $value['no_hp_walikota']);
	    		array_push($waktu_pengecekan, $value['waktu_pengecekan']);
	        	array_push($tgl_start_notif, $value['tgl_start_notif']);
	        	array_push($nama, $value['nama']);
	        	array_push($jabatan, $value['jabatan']);
	        
	    }
	?>
	var id_pengaturan = <?php echo json_encode($id_pengaturan); ?>;
	var selang_hari = <?php echo json_encode($selang_hari); ?>;
	var no_hp_walikota = <?php echo json_encode($no_hp_walikota); ?>;
	var waktu_pengecekan = <?php echo json_encode($waktu_pengecekan); ?>;
	var tgl_start_notif = <?php echo json_encode($tgl_start_notif); ?>;
	var nama = <?php echo json_encode($nama); ?>;
	var jabatan = <?php echo json_encode($jabatan); ?>;

	$(".modal-body #id_pengaturan").val( id_pengaturan[id] );
    $(".modal-body #selang_hari").val( selang_hari[id] );
    $(".modal-body #no_hp_walikota").val( no_hp_walikota[id] );
    $(".modal-body #waktu_pengecekan").val( waktu_pengecekan[id] );
    $(".modal-body #tgl_start_notif").val( tgl_start_notif[id] );
    $(".modal-body #nama").val( nama[id] );
    $(".modal-body #jabatan").val( jabatan[id] );
});



$(document).ready(function() {
    $("abbr.timeago").timeago();
   		var table = $('#list_notif').DataTable( {
	        "language": {
	            "lengthMenu": "Tampilkan _MENU_ data per halaman",
	            "zeroRecords": "data tidak tersedia",
	            "info": "Showing page _PAGE_ of _PAGES_",
	            "infoEmpty": "No records available",
	            "infoFiltered": "(filtered from _MAX_ total records)",
	            "sSearch": "cari"
	        },
	        
       
             "dom": '<"top"flp<"clear">>rt<"bottom"ip<"clear">>'
	    } )

    	table.$('tr:odd').css('backgroundColor', '#E0E0E0');

    	$('input.timepicker').timepicker({});

       	var $el = $('#cari');
       	$el.data('oldVal',  $el.val() );

       	//var x = $el.val();
       	var title = $el.val();
       	$('#text_keyword').html('<input title="temp" style="height:23px; width: 100%;" type="text" id="'+title+'" placeholder="masukkan keyword " />');

       	
       	 $('input[title="temp"]').keyup(function(){
			    table
			    .search($(this).val()).draw() ;
	      
		});

       	$el.change(function(){
       
            var $this = $(this);
            var newValue = $this.data('newVal', $this.val());  
	        var title = $this.val();
	        
			if(title == -1){
				//document.getElementById("demo").innerHTML =  $this.val();
				
				$('#text_keyword').html('<input title="temp" style="height:23px; width: 100%;" type="text" id="'+title+'" placeholder="masukkan keyword " />');

		        $('input[title="temp"]').keyup(function(){
					    table
					    .search($(this).val()).draw() ;
			      
				});
       				
			} else {

				$('#text_keyword').html('<input title="temp" style="height:23px; width: 100%;" type="text" id="'+title+'" placeholder="masukkan keyword " />');

		        $('input[title="temp"]').keyup(function () {
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
   

} );


function numbersonly(myfield, e, dec) { 
	var key; var keychar; 
	if (window.event) 
		key = window.event.keyCode; 
	else if (e) key = e.which; 
	else return true; keychar = String.fromCharCode(key); 
	// control keys 
	if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ) 
		return true; 
	// numbers 
	else if ((("0123456789").indexOf(keychar) > -1)) 
		return true; 
		// decimal point jump 
	else if (dec && (keychar == ".")) 
	{ 
		myfield.form.elements[dec].focus(); 
		return false; 
	} else 
		return false; 
}


</script>




