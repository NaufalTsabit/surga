

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

	h3 {
        border-bottom: thin groove black;
        padding-bottom: 0px;

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
    	color: #fff;
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


</style>

<h3>REPORT</h3>

<div id="content1" class="form-group">
	               
     &nbsp;
     <br>
    
    <a href="<?php echo site_url('petugas/report'); ?>" class="btn btn-primary btn-sm">
          <span class="glyphicon glyphicon-arrow-left"></span> Kembali
        </a>
	<a href='<?php echo site_url('petugas/doprint/false/'.$kategori.'/'.$aturData);?>' target="_blank" class="btn btn-info btn-sm">
	 <span class="glyphicon glyphicon-download-alt"></span> Download
	</a>
	
	
</div>

	<div  id="content2" align="right">
	 
	  <p align="left"> <font color="black">Cari Berdasarkan Kolom:  </font> </p>
		<select id="cari" name="cari" style="width: 185px">
		    <option value="-1" selected="selected">Semua Kolom</option> 
		    <!--
		    <option value="0">Nomor Aduan</option>
		    <option value="1">Nama</option>
		    <option value="2">Waktu</option>
		    <option value="3">Topik</option>
		  	<option value="4">Isi</option>
		    <option value="5">Departemen</option>
		    <option value="6">Status</option>

		    <option value="7">Jalur</option>
		    -->
		
		</select>

		
	</div> 

	<div  id="content3">
	 
	   <p> <font color="black">Maukkan Keyword</font> </p>
		<p id="text_keyword"></p>


	</div> 

<table id="list_aduan" class="table ukuran">
	<thead>
		<tr class="as">

		<?php if ($app0 == "1"): ?>
			<th>Nomor Aduan</th>
		<?php endif;?>
		<?php if ($app1 == "1"): ?>
			<th>Nama</th>
		<?php endif;?>
		<?php if ($app2 == "1"): ?>
			<th>Waktu</th>
		<?php endif;?>
		<!--
		<?php if ($app3 == "1"): ?>
			<th>Topik</th>
		<?php endif;?>
		-->
		<?php if ($app4 == "1"): ?>
			<th>Isi</th>
		<?php endif;?>
		<?php if ($app5 == "1"): ?>
			<th>Departemen</th>
		<?php endif;?>
		<?php if ($app6 == "1"): ?>
			<th>Status</th>
		<?php endif;?>
		<?php if ($app7 == "1"): ?>
			<th>Jalur</th>
		<?php endif;?>
			
			
		</tr>
	</thead>

	<tbody  >
		<?php foreach ($list_aduan as $key => $value): ?>

		<tr class="as">
			
			<?php if ($app0 == "1"): ?>
				<td align="center"><?php echo ($value['id_aduan'] - $max_aduan); ?></td>
			<?php endif;?>

			<?php if ($app1 == "1"): ?>
				<td><a class="modalajax" data-toggle="modal" data-target="#mymodal" style="color: rgba(50, 142, 208, 0.9);" href="#"><span style="display:none;"><?php echo $value["no_identitas"];?></span><?php echo $value['nama']; ?></td>
			<?php endif;?>

			<?php if ($app2 == "1"): ?>
				<td><?php echo $value['waktu']; ?> <br/> <abbr class="timeago" title="<?php echo $value['waktu']; ?>"></abbr></td>
			<?php endif;?>
			<!--
			<?php if ($app3 == "1"): ?>
				<td><?php echo $value['topik']; ?></td>
			<?php endif;?>
			-->
			<?php if ($app4 == "1"): ?>
				<td>


					<?php if ($value['id_status'] == '4' && $jawaban == '1'): ?>
						<p style="font-size: 13px;">  <u>Aduan :</u>  </p>
							<?php echo $value['isi']; ?>
						
						<hr>
						<p style="font-size: 13px;">  <u>Jawaban :</u>  </p>

						<?php foreach ($value['list_chat'] as $key2 => $valueChat): ?>
							
							<?php if ($key2 == 0): ?>
								<?php continue; ?>
							<?php endif;?>

							<?php echo $valueChat['isi_detail']; ?>
							<br>

						<?php endforeach;?>
					
					<?php else: ?>
						<?php echo $value['isi']; ?>
					<?php endif;?>
				</td>

			<?php endif;?>

			<?php if ($app5 == "1"): ?>
				<td>
					<?php if($value['info'] == '4'):  ?>
						<?php echo $value['nama_departemen']; ?>
					<?php endif;?>
				</td>
			<?php endif;?>

			<?php if ($app6 == "1"): ?>
				<td class="<?php echo $value['class_status']; ?>"><?php echo $value['nama_status']; ?></td>
			<?php endif;?>

			<?php if ($app7 == "1"): ?>
				<td><?php echo $value['via_sms'] == '1' ? 'SMS' : 'Website'; ?></td>
			<?php endif;?>

		</tr>
		<?php endforeach;?>
	</tbody>
</table>





<!-- timeago js digunakan untuk waktu -->
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
          	 "order": [[ 2, "desc" ]],            
             "dom": '<"top"flp<"clear">>rt<"bottom"ip<"clear">>'
	    } )

    	table.$('tr:odd').css('backgroundColor', '#E0E0E0');

    	

       	var $el = $('#cari');
       	$el.data('oldVal',  $el.val() );

       	//var x = $el.val();
       	var title = $el.val();
       	$('#text_keyword').html('<input title="temp" style="height:23px;" type="text" id="'+title+'" placeholder="masukkan keyword " />');

       	
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
				
				$('#text_keyword').html('<input title="temp" type="text" id="'+title+'" placeholder="masukkan keyword " />');

		        $('input[title="temp"]').keyup(function(){
					    table
					    .search($(this).val()).draw() ;
			      
				});
       				
			} else {

				$('#text_keyword').html('<input title="temp" type="text" id="'+title+'" placeholder="masukkan keyword " />');

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