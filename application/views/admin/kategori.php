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

	#app1 {
		float: left;
		text-align: left;
		width: 50%;
		
	}

	#app2 {
		float: left;
		width: 50%;
		
	}



</style>

<h3>MANAJEMEN KATEGORI</h3>


<div style="padding-left: 0;" class="col-md-7">
	<br>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAdd">Tambah Kategori</button>
</div>

<br><br><br>

<table id="list_petugas" class="table ukuran">
	<thead>
		<tr class="as">
			<th>ID Kategori</th>
			<th>Nama Kategori</th>
			<th></th>
		</tr>
	</thead>

	<tbody  >
		<?php foreach ($list_kategori as $key => $value): ?>

		<tr class="as">
			<td align="center"><?php echo ($value['id_kategori']); ?></td>
			<td align="center"><?php echo ($value['nama_kategori']); ?></td>
			
			<td>
				<button type="button" class="fnDpt btn-info" data-tipe="0" data-id="<?php echo ($key); ?>" data-toggle="modal" data-target="#myModalEdit">Edit</button>
				<?php if ($value['id_kategori'] > 6) { ?>
					<button type="button" class="fnDpt btn-danger" data-tipe="1" data-id="<?php echo ($key); ?>" data-toggle="modal" data-target="#myModalDelete">Hapus</button>				
				<?php } ?>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>


<div id="myModalAdd" class="modal fade" role="dialog">

  <div class="modal-dialog">
	<br><br><br>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Kategori</h4>
      </div>
      <form id="add" role="form" method="POST" action="<?php echo site_url('admin/kategori'); ?>">

      <fieldset id="field2">
      	<div class="modal-body">        	
        	
            <div class="form-group">
              <label for="nama_kategori">Nama Kategori Aduan</label>
              <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan Nama Kategori" required>    
            </div>

         <div class="modal-footer">
         	<div id="footer1">
	     		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     		</div>
     		<div id="footer2">
	      		<input align="left" type="submit" class="btn btn-success" name="add" id="add" value="Submit" />
	      	</div>
	        
      	 </div>
		</div>
     </fieldset>
		        
      </form>
    </div>

  </div>
</div>

<!-- EDIT___________________________________________________________ -->
<div id="myModalEdit" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <br><br>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Kategori Aduan</h4>
      </div>
        <form id="edit" role="form" method="POST" action="<?php echo site_url('admin/kategori'); ?>">
	      <div class="modal-body">
		  
	        	<div class="form-group">
	              <label for="id_kategori">Id Kategori</label>
	              <input readonly="readonly" retype="text" class="form-control" id="id_kategori" name="id_kategori" value="" >
	            </div>
				
	            <div class="form-group">
	              <label for="nama_kategori">Nama Kategori</label>
	              <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="" >    
	            </div>
			
	      </div>
	      <div class="modal-footer">
	      	<div id="footer1">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
  <br><br>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hapus Data Kategori</h4>
      </div>
        <form id="edit" role="form" method="POST" action="<?php echo site_url('admin/kategori'); ?>">
	      <div class="modal-body">
		  
	        	<div class="form-group">
	              <label for="id_kategori">Id Kategori</label>
	              <input readonly="readonly" retype="text" class="form-control" id="id_kategori" name="id_kategori" value="" >
	            </div>

	            <div class="form-group">
	              <label for="nama_kategori">Nama Kategori</label>
	              <input readonly="readonly" type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="" >    
	            </div>
	      </div>
	      <div class="modal-footer">
	      	<div id="footer1">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	        <div id="footer2">
	        	
	        	<input onclick="return confirm('Yakin dihapus?')" align="left" type="submit" class="btn btn-success" name="delete" id="delete" value="Delete" />
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
     	$id_kategori = array();
	    $nama_kategori = array();
	    
	    foreach ($list_kategori as $key => $value) {	    		
	    		array_push($id_kategori, $value['id_kategori']);
	    		array_push($nama_kategori, $value['nama_kategori']);
	    }
	?>
	var id_kategori = <?php echo json_encode($id_kategori); ?>;
	var nama_kategori = <?php echo json_encode($nama_kategori); ?>;

	$(".modal-body #id_kategori").val( id_kategori[id] );
    $(".modal-body #nama_kategori").val( nama_kategori[id] );
    
});

</script>