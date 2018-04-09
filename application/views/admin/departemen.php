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

<h3>MANAJEMEN DEPARTEMEN</h3>
<ul class="nav nav-pills">

  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'dashboard') echo "active"; ?>"></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'user') echo "active"; ?>"></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'departemen') echo "active"; ?>"></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'pengaturan') echo "active"; ?>"></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'aktivitas') echo "active"; ?>"></li> 


</ul>

<div style="padding-left: 0;" class="col-md-7">

</div>

<div style="padding-right: 0;" class="col-md-5">
	<div style="padding-right: 0; " class="col-md-6">
		<p> <font color="black">Cari Berdasarkan Kolom:  </font> </p>
		<select id="cari" name="cari" style="width: 100%">
    		<option value="-1" selected="selected">Semua Kolom</option> 
		    <option value="0">Id Departemen</option>
		    <option value="1">Nama Departemen</option>
		    <option value="2">kepala Departemen</option>
		    <option value="3">No HP</option>
		    <option value="4">Apakah Mitra</option>
		    <option value="5">Induk Departemen</option>
		   
		</select>
	</div>

	<div style="padding-right: 0;" class="col-md-6">
		<p> <font color="black">Masukkan Keyword</font> </p>
		<p id="text_keyword"></p>
	</div>
	
</div>


<br><br><br>

<table id="list_departemen" class="table ukuran">
	<thead>
		<tr class="as">
			<th>id departemen</th>
			<th>Nama Departemen</th>
			<th>Nama Kepala</th>
			<th>No HP</th>
			<th>Apakah Mitra</th>
			<th>Induk Departemen</th>
			<th>Aksi</th>
			<!--
			<th>Prioritas</th>
			-->
		
		</tr>
	</thead>

	<tbody  >
		<?php foreach ($list_departemen2 as $key => $value): ?>

		<tr class="as">
		
			<td align="center"><?php echo ($value['id_departemen']); ?></td>
			<td><?php echo $value['nama_departemen']; ?></td>
			<td><?php echo $value['nama_kepala']; ?></td>
			<td align="center"><?php echo $value['no_hp']; ?></td>

			<td align="center"><?php echo $value['apakah_mitra'] == '1' ? 'Ya' : 'Tidak'; ?></td>
			<td align="center"><?php echo $value['nama_induk']; ?></td>
			<td>
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
        <h4 class="modal-title">Tambah Departemen</h4>
      </div>
      <form id="add" role="form" method="POST" action="<?php echo site_url('admin/departemen'); ?>">
      <div class="modal-body">
        	
            <div class="form-group">
              <label for="usrname">Nama Departemen</label>
              <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" value="<?php echo set_value('nama_departemen') ?>" placeholder="Masukkan Nama Departemen">
            
            </div>
            <div class="form-group">
              <label for="psw">Nama Kepala</label>
              <input type="text" class="form-control" id="nama_kepala" name="nama_kepala" placeholder="Masukkan Nama Kepala">
            </div>
            <div class="form-group">
              <label for="psw">No HP</label>
              <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor HP">
            </div>
            <!--
            <div class="form-group">
              <label for="psw">Apakah Mitra</label>
              <input type="text" class="form-control" id="apakah_mitra" name="apakah_mitra" placeholder="Masukkan Apakah Mitra">
            </div>
			-->
			<div class="form-group">
			<label for="psw">Apakah Mitra</label>
	            <select class="form-control" id="apakah_mitra" name="apakah_mitra" style="width: 200px">
		            <option value="0">Tidak</option>
		            <option value="1">YA</option>
		       
		    	</select>
	    	</div>

	    	<div id="dept" class="form-group">
            	<label for="psw">Induk Departemen (jika ada)</label>
                <select class="form-control" name="induk_departemen" id="induk_departemen" style="margin-top: 10px">
                	<option value="0">-</option>
					<?php foreach ($list_departemen as $key => $value): ?>
					<option value="<?php echo $value['id_departemen']; ?>" ><?php echo $value['nama_departemen']; ?></option>
					<?php endforeach;?>
				</select>
            </div>
               
      </div>
      <div class="modal-footer">
        
       
        	<div id="footer1">
	        	<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
	        </div>
	        <div id="footer2">
	        	<input align="left" type="submit" class="btn btn-primary" name="add" id="add" value="Tambah" />
	        	
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
        <h4 class="modal-title">Data Departemen</h4>
      </div>
        <form id="edit" role="form" method="POST" action="<?php echo site_url('admin/departemen'); ?>">
	      <div class="modal-body">
	        	<!--
	        	<input type="text" name="bookId" id="bookId" value=""/>
	        	-->
	        	<div class="form-group">
	              <label for="usrname">Id Departemen</label>
	              <input readonly="readonly" retype="text" class="form-control" id="id_departemen" name="id_departemen" value="" >
	            </div>
	            
	            <div class="form-group">
	              <label for="usrname">Nama Departemen</label>
	              <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" value="" >
	            
	            </div>
	            <div class="form-group">
	              <label for="psw">Nama Kepala</label>
	              <input type="text" class="form-control" id="nama_kepala" name="nama_kepala">
	            </div>
	            <div class="form-group">
	              <label for="psw">No HP</label>
	              <input type="text" class="form-control" id="no_hp" name="no_hp" >
	            </div>
	            <!--
	            <div class="form-group">
	              <label for="psw">Apakah Mitra</label>
	              <input type="text" class="form-control" id="apakah_mitra" name="apakah_mitra" >
	            </div>
	               -->
	            <div class="form-group">
	            <label for="psw">Apakah Mitra</label>
	            <select class="form-control" id="apakah_mitra" name="apakah_mitra" style="width: 200px">
		            <option value="0">Tidak</option>
		            <option value="1">YA</option>
		       
		    	</select>

		    	<div id="dept" class="form-group">
            	<label for="psw">Induk Departemen</label>
                <select class="form-control" name="induk_departemen" id="induk_departemen" style="margin-top: 10px">
                	<option value="0">-</option>
					<?php foreach ($list_departemen as $key => $value): ?>
					<option value="<?php echo $value['id_departemen']; ?>" ><?php echo $value['nama_departemen']; ?></option>
					<?php endforeach;?>
				</select>
            	</div>

	    	</div>
	      </div>
	      <div class="modal-footer">
	                
	        <div id="footer1">
	        	<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
	        </div>
	        <div id="footer2">
	        	<input onclick="return confirm('Yakin diedit?')" align="left" type="submit" class="btn btn-success" name="edit" id="edit" value="Update" />
	        	
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
        <h4 class="modal-title">Hapus Data Departemen</h4>
      </div>
      <form id="delete" role="form" method="POST" action="<?php echo site_url('admin/departemen'); ?>">
	      <div class="modal-body">
	        	<!--
	        	<input type="text" name="bookId" id="bookId" value=""/>
	        	-->
	        	<div class="form-group">
	              <label for="usrname">Id Departemen</label>
	              <input readonly="readonly" retype="text" class="form-control" id="id_departemen" name="id_departemen" value="" >
	            </div>
	            
	            <div class="form-group">
	              <label for="usrname">Nama Departemen</label>
	              <input readonly="readonly" type="text" class="form-control" id="nama_departemen" name="nama_departemen" value="" >
	            
	            </div>
	            <div class="form-group">
	              <label for="psw">Nama Kepala</label>
	              <input readonly="readonly" type="text" class="form-control" id="nama_kepala" name="nama_kepala">
	            </div>
	            <div class="form-group">
	              <label for="psw">No HP</label>
	              <input readonly="readonly" type="text" class="form-control" id="no_hp" name="no_hp" >
	            </div>
	            <!--
	            <div class="form-group">
	              <label for="psw">Apakah Mitra</label>
	              <input readonly="readonly" type="text" class="form-control" id="apakah_mitra" name="apakah_mitra" >
	            </div>
				-->
	            <div class="form-group">
	            <label for="psw">Apakah Mitra</label>
		            <select readonly="readonly" disabled="disabled" class="form-control" id="apakah_mitra" name="apakah_mitra" style="width: 200px">
			            <option value="0">Tidak</option>
			            <option value="1">YA</option>
			       
			    	</select>
	    		</div>

	    		<div id="dept" class="form-group">
            	<label for="psw">Induk Departemen</label>
                <select  readonly="readonly" disabled="disabled" class="form-control" name="induk_departemen" id="induk_departemen" style="margin-top: 10px">
                	<option value="0">-</option>
					<?php foreach ($list_departemen as $key => $value): ?>
					<option value="<?php echo $value['id_departemen']; ?>" ><?php echo $value['nama_departemen']; ?></option>
					<?php endforeach;?>
				</select>
            	</div>
	         
	               
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
     	$id_departemen = array();
	    $nama_departemen = array();
	    $nama_kepala = array();
	    $no_hp = array();
	    $apakah_mitra = array();
	    $induk_departemen = array();
	    foreach ($list_departemen as $key => $value) {
	    		
	    		array_push($id_departemen, $value['id_departemen']);
	    		array_push($nama_departemen, $value['nama_departemen']);
	        	array_push($nama_kepala, $value['nama_kepala']);
	    		array_push($no_hp, $value['no_hp']);
	        	array_push($apakah_mitra, $value['apakah_mitra']);
	        	array_push($induk_departemen, $value['induk_departemen']);
	        
	    }
	?>
	var id_departemen = <?php echo json_encode($id_departemen); ?>;
	var nama_departemen = <?php echo json_encode($nama_departemen); ?>;
	var nama_kepala = <?php echo json_encode($nama_kepala); ?>;
	var no_hp = <?php echo json_encode($no_hp); ?>;
	var apakah_mitra = <?php echo json_encode($apakah_mitra); ?>;
	var induk_departemen = <?php echo json_encode($induk_departemen); ?>;

	$(".modal-body #id_departemen").val( id_departemen[id] );
    $(".modal-body #nama_departemen").val( nama_departemen[id] );
    $(".modal-body #nama_kepala").val( nama_kepala[id] );
    $(".modal-body #no_hp").val( no_hp[id] );
    $(".modal-body #apakah_mitra").val( apakah_mitra[id] );
    $(".modal-body #induk_departemen").val( induk_departemen[id] );
});

$(document).ready(function() {
    $("abbr.timeago").timeago();
   		var table = $('#list_departemen').DataTable( {
	        "language": {
	            "lengthMenu": "Tampilkan _MENU_ data per halaman",
	            "zeroRecords": "data tidak tersedia",
	            "info": "Showing page _PAGE_ of _PAGES_",
	            "infoEmpty": "No records available",
	            "infoFiltered": "(filtered from _MAX_ total records)",
	            "sSearch": "cari"
	        },
	        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
	        	//alert(aData[8]);
                    if ( aData[8] == "Ya" )
                    {

                        $('td', nRow).css('background-color', 'Red');
                    }
                    else
                    {
                       // $('td', nRow).css('background-color', 'Green');

                    }
                },
       		 "order": [[ 1, "asc" ]],
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

				$('#text_keyword').html('<input title="temp" style="height:23px; width:100%;" type="text" id="'+title+'" placeholder="masukkan keyword " />');

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