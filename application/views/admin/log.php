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

	h3 {
        border-bottom: thin groove black;
        padding-bottom: 0px;

    }
</style>

<h3>AKTIVITAS</h3>
<ul class="nav nav-pills">

  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'dashboard') echo "active"; ?>"></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'user') echo "active"; ?>"></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'departemen') echo "active"; ?>"></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'pengaturan') echo "active"; ?>"></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'aktivitas') echo "active"; ?>"></li> 


</ul>

<div style="padding-left: 0;" class="col-md-7">
 <br>
	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalDeleteAll">Hapus Semua</button>
	</div>

	<div style="padding-right: 0;" class="col-md-5">
		<div style="padding-right: 0; " class="col-md-6">
			<p> <font color="black">Cari Berdasarkan Kolom:  </font> </p>
			<select id="cari" name="cari" style="width: 100%">
			    <option value="-1" selected="selected">Semua Kolom</option> 
			    <option value="0">Id Aktivitas</option>
			    <option value="1">Tanggal Aktivitas</option>
			    <option value="2">Id Petugas</option>
			    <option value="3">Waktu Aktivitas</option>
			    <option value="4">Nama Aktivitas</option>
			    <option value="5">Nama User</option>
			   
			</select>
		</div>

		<div style="padding-right: 0;" class="col-md-6">
			<p> <font color="black">Masukkan Keyword</font> </p>
			<p id="text_keyword"></p>
		</div>
		
	</div>


<br><br><br>

<table id="list_aktivitas" class="table ukuran">
	<thead>
		<tr class="as">
			<th>No Aktivitas</th>
			<th>Tanggal Aktivitas</th>
			<th>ID Petugas</th>
			<th>Waktu Aktivitas</th>
			<th>Nama Aktivitas</th>
			<th>Nama User</th>
			
			<th>Aksi</th>

		
		</tr>
	</thead>

	<tbody  >
		<?php foreach ($list_aktivitas as $key => $value): ?>

		<tr class="as">
		
			<td align="center"><?php echo ($value['id_aktivitas']); ?></td>
			<td><?php echo $value['tanggal_aktivitas']; ?></td>
			<td><?php echo $value['id_petugas']; ?></td>
			<td align="center"><?php echo $value['waktu_aktivitas']; ?></td>
			<td align="center"><?php echo $value['nama_aktivitas'];?></td>
			<td align="center"><?php echo $value['nama_user'];?></td>
			<td>

				<button type="button" class="fnDpt btn-danger" data-tipe="1" data-id="<?php echo ($key); ?>" data-toggle="modal" data-target="#myModalDelete">Hapus</button>
			</td>


			
		</tr>
		<?php endforeach;?>
	</tbody>
</table>


<div id="myModalDeleteAll" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hapus Semua Data Aktivitas/Log? </h4>
      </div>
      <form id="delete" role="form" method="POST" action="<?php echo site_url('admin/aktivitas'); ?>">
	      <div class="modal-body">
	        	<!--
	        	<input type="text" name="bookId" id="bookId" value=""/>
	        	-->
	        	
	               
	      </div>
	      <div class="modal-footer">
	        
	
	        <div id="footer1">
     			<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
     		
	 		</div>
	 		<div id="footer2">
	      		<input onclick="return confirm('Yakin Hapus Semua Data?')" align="left" type="submit" class="btn btn-danger" name="deleteAll" id="deleteAll" value="Hapus" />
	      	</div>
	      </div>
      </form>
    </div>

  </div>
</div>


<div id="myModalDelete" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <br><br>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hapus Data Aktivitas/Log</h4>
      </div>
      <form id="delete" role="form" method="POST" action="<?php echo site_url('admin/aktivitas'); ?>">
	      <div class="modal-body">
	        	<!--
	        	<input type="text" name="bookId" id="bookId" value=""/>
	        	-->
	        	<div class="form-group">
	              <label for="usrname">Id Aktivitas</label>
	              <input readonly="readonly" retype="text" class="form-control" id="id_aktivitas" name="id_aktivitas" value="" >
	            </div>
	            
	            <div class="form-group">
	              <label for="usrname">Tanggal Aktivitas</label>
	              <input readonly="readonly" type="text" class="form-control" id="tanggal_aktivitas" name="tanggal_aktivitas" value="" >
	            
	            </div>
	            <div class="form-group">
	              <label for="psw">ID Petugas</label>
	              <input readonly="readonly" type="text" class="form-control" id="id_petugas" name="id_petugas">
	            </div>
	            <div class="form-group">
	              <label for="psw">Waktu Aktivitas</label>
	              <input readonly="readonly" type="text" class="form-control" id="waktu_aktivitas" name="waktu_aktivitas" >
	            </div>
	            <div class="form-group">
	              <label for="psw">Nama Aktivitas</label>
	              <input readonly="readonly" type="text" class="form-control" id="nama_aktivitas" name="nama_aktivitas" >
	            </div>
	            <div class="form-group">
	              <label for="psw">Nama User</label>
	              <input readonly="readonly" type="text" class="form-control" id="nama_user" name="nama_user" >
	            </div>

	            <!--
	            <div class="form-group">
	              <label for="psw">Apakah Mitra</label>
	              <input readonly="readonly" type="text" class="form-control" id="apakah_mitra" name="apakah_mitra" >
	            </div>
				-->

	               
	      </div>
	      <div class="modal-footer">
	        
	        
	         <div id="footer1">
     			<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
     		
	 		</div>
	 		<div id="footer2">
	      		<input onclick="return confirm('Yakin dihapus?')" align="left" type="submit" class="btn btn-danger" name="delete" id="delete" value="Hapus" />
	      	</div>
	      </div>
      </form>
    </div>

  </div>
</div>


<!-- timeago js digunakan untuk waktu -->
<script type="text/javascript">

$(document).on("click", ".fnDpt", function () {
     var id = $(this).data('id');
     var tipe = $(this).data('tipe');

     <?php
     	$id_aktivitas = array();
	    $tanggal_aktivitas = array();
	    $id_petugas = array();
	    $waktu_aktivitas = array();
	    $nama_aktivitas = array();
	    $nama_user = array();
	    foreach ($list_aktivitas as $key => $value) {
	    		
	    		array_push($id_aktivitas, $value['id_aktivitas']);
	    		array_push($tanggal_aktivitas, $value['tanggal_aktivitas']);
	        	array_push($id_petugas, $value['id_petugas']);
	    		array_push($waktu_aktivitas, $value['waktu_aktivitas']);
	        	array_push($nama_aktivitas, $value['nama_aktivitas']);
	        	array_push($nama_user, $value['nama_user']);
	        
	    }
	?>
	var id_aktivitas = <?php echo json_encode($id_aktivitas); ?>;
	var tanggal_aktivitas = <?php echo json_encode($tanggal_aktivitas); ?>;
	var id_petugas = <?php echo json_encode($id_petugas); ?>;
	var waktu_aktivitas = <?php echo json_encode($waktu_aktivitas); ?>;
	var nama_aktivitas = <?php echo json_encode($nama_aktivitas); ?>;
	var nama_user = <?php echo json_encode($nama_user); ?>;

	$(".modal-body #id_aktivitas").val( id_aktivitas[id] );
    $(".modal-body #tanggal_aktivitas").val( tanggal_aktivitas[id] );
    $(".modal-body #id_petugas").val( id_petugas[id] );
    $(".modal-body #waktu_aktivitas").val( waktu_aktivitas[id] );
    $(".modal-body #nama_aktivitas").val( nama_aktivitas[id] );
    $(".modal-body #nama_user").val( nama_user[id] );
});

$(document).ready(function() {
    $("abbr.timeago").timeago();
   		var table = $('#list_aktivitas').DataTable( {
	        "language": {
	            "lengthMenu": "Tampilkan _MENU_ data per halaman",
	            "zeroRecords": "data tidak tersedia",
	            "info": "Showing page _PAGE_ of _PAGES_",
	            "infoEmpty": "No records available",
	            "infoFiltered": "(filtered from _MAX_ total records)",
	            "sSearch": "cari"
	        },
	         "order": [[ 0, "desc" ]],
             "dom": '<"top"flp<"clear">>rt<"bottom"ip<"clear">>'
	    } )

    	table.$('tr:odd').css('backgroundColor', '#E0E0E0');



       	var $el = $('#cari');
       	$el.data('oldVal',  $el.val() );

       	//var x = $el.val();
       	var title = $el.val();
       	$('#text_keyword').html('<input title="temp" style="height:23px; width:100%;" type="text" id="'+title+'" placeholder="masukkan keyword " />');

       	
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
				
				$('#text_keyword').html('<input title="temp" style="height:23px; width:100%;" type="text" id="'+title+'" placeholder="masukkan keyword " />');

		        $('input[title="temp"]').keyup(function(){
					    table
					    .search($(this).val()).draw() ;
			      
				});
       				
			} else {

				$('#text_keyword').html('<input title="temp" style="height:23px;width:100%;" type="text" id="'+title+'" placeholder="masukkan keyword " />');

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

</script>