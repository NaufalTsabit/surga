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

<h3>MANAJEMEN PETUGAS</h3>


<div style="padding-left: 0;" class="col-md-7">
	<br>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAdd">Tambah Petugas</button>
</div>

<div style="padding-right: 0;" class="col-md-5">
	<div style="padding-right: 0; " class="col-md-6">
		<p> <font color="black">Cari Berdasarkan Kolom:  </font> </p>
		<select id="cari" name="cari" style="width: 100%">
		   <option value="-1" selected="selected">Semua Kolom</option> 
		    <option value="0">Id Petugas</option>
		    <option value="1">Username</option>
		    <option value="2">Password</option>
		    <option value="3">Nama</option>
		    <option value="4">Email</option>
		    <option value="5">No HP</option> 
		   
		    <option value="6">Departemen</option>
		    <option value="7">Role</option>
		    <option value="8">Aplikasi Tambahan</option>
		   
		</select>
	</div>

	<div style="padding-right: 0;" class="col-md-6">
		<p> <font color="black">Masukkan Keyword</font> </p>
		<p id="text_keyword"></p>
	</div>
	
</div>




<br><br><br>

<table id="list_petugas" class="table ukuran">
	<thead>
		<tr class="as">
			<th>ID</th>
			<th>Username</th>
			<th>Password</th>
			<th>Nama</th>
			<th>Email</th>
			<th>No HP</th>
			
			<th>Departemen</th>
			<th>Role</th>
			<th>Aplikasi Tambahan</th>
			<th>Aksi</th>
		
		</tr>
	</thead>

	<tbody  >
		<?php foreach ($list_petugas as $key => $value): ?>

		<tr class="as">
			<td align="center"><?php echo ($value['id_petugas']); ?></td>
			<td align="center"><?php echo ($value['username_petugas']); ?></td>
			<td><?php echo $value['password_petugas']; ?></td>
			<td><?php echo $value['nama_petugas']; ?></td>
			<td align="center"><?php echo $value['email_petugas']; ?></td>
			<td align="center"><?php echo $value['no_hp_petugas']; ?></td>
			<!--
			<td align="center"><?php echo $value['jobdesc_petugas']; ?></td>
			-->
			<td align="center">
				<?php if($value['role'] == '3'):  ?>
					<?php echo $value['nama_departemen']; ?>
				<?php endif;?>
			</td>

			<td align="center"><?php echo $value['nama_role']; ?></td>
			<td align="center"><?php echo $value['aplikasi']; ?></td>
			
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
	<br><br><br>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Petugas</h4>
      </div>
      <form id="add" role="form" method="POST" action="<?php echo site_url('admin/user'); ?>">

        <fieldset id="field1">
	      	<div class="modal-body">
	        	
	            <div class="form-group">
	              <label for="psw">Role</label>
	              	<select onChange="setRole(this)" class="form-control" name="role" id="role2" style="margin-top: 10px">
						<?php foreach ($list_role as $key => $value): ?>
							<option value="<?php echo $value['id_role']; ?>" ><?php echo $value['nama_role']; ?></option>
						<?php endforeach;?>
					</select>
	            </div>

	        </div>

	     	<div class="modal-footer">
		     	<div id="footer1">
		     		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	     		</div>
	     		<div id="footer2">
		      		<input type="button" name="Next" class="next btn btn-primary" value="Next" />
		      	</div>
		       
		        
	      	</div>
      </fieldset>

      <fieldset id="field2">
      	<div class="modal-body">
        	
        	
            <div class="form-group">
              <label for="usrname">Username</label>
              <input type="text" class="form-control" id="username_petugas" name="username_petugas" placeholder="Masukkan Username">    
            </div>
            <div class="form-group">
              <label for="psw">Password</label>
              <input type="text" class="form-control" id="password_petugas" name="password_petugas" placeholder="Masukkan Password">
            </div>
            <div class="form-group">
              <label for="psw">Nama</label>
              <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" placeholder="Masukkan Nama">
            </div>
            <div class="form-group">
              <label for="psw">Email</label>
              <input type="text" class="form-control" id="email_petugas" name="email_petugas" placeholder="Masukkan Email">
            </div>
            <div class="form-group">
              <label for="psw">No HP</label>
              <input type="text" class="form-control" id="no_hp_petugas" name="no_hp_petugas" placeholder="Masukkan Nomor HP">
            </div>
        </div>

     	<div class="modal-footer">

     		<div id="footer1">
	     		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	     		<input type="button" name="Prev" class="prev btn btn-warning" value="Previous" />
     		</div>
     		<div id="footer2">
	      		<input type="button" name="Next" class="next btn btn-primary" value="Next" />
	      	</div>
    		       
      	</div>
     </fieldset>

     <fieldset id="field3">

       	<div class="modal-body">
            <!--
            <div class="form-group">
              <label for="psw">Jobdesk</label>
              <textarea class="form-control" rows="3" id="jobdesc_petugas" name="jobdesc_petugas" placeholder="Masukkan Jobdesk"></textarea>
            </div>
            -->
            <div id="dept" class="form-group">
            	<label for="psw">Departemen</label>
                <select class="form-control" name="departemen" id="departemen" style="margin-top: 10px">
					<?php foreach ($list_departemen as $key => $value): ?>
					<option value="<?php echo $value['id_departemen']; ?>" ><?php echo $value['nama_departemen']; ?></option>
					<?php endforeach;?>
				</select>
            </div>
            <div class="form-group">
            	<label for="psw">Aplikasi</label>
            	<br>

            		
            		<div id="app1">
            			<input disabled checked type="checkbox" id="inbox" name="inbox" value="Inbox"> &nbsp; Inbox Aduan
            		</div>

				<?php foreach ($list_app as $key => $value): ?>

					<?php if ($key < 4) continue;  ?>
					<?php if ($key == 8) continue;  ?>

					<?php if ($key%2 == 0): ?>
						<div id="app1">
						 	<input type="checkbox" id="app" name="app[]" value="<?php echo $value['id_all_app']; ?>">
								&nbsp;
							<?php echo $value['desc_app']; ?>
						</div>
					<?php endif;?>
					
					<?php if ($key%2 == 1): ?>
						<div id="app2">
						 	<input type="checkbox" id="app" name="app[]" value="<?php echo $value['id_all_app']; ?>">
								&nbsp;
							<?php echo $value['desc_app']; ?>
						</div>
					<?php endif;?>

				<?php endforeach;?>
				
            </div>
            <br><br><br><br><br><br><br>

         </div>

         <div class="modal-footer">
         	<div id="footer1">
	     		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	     		<input type="button" name="Prev" class="prev btn btn-warning" value="Previous" />
     		</div>
     		<div id="footer2">
	      		<input align="left" type="submit" class="btn btn-success" name="add" id="add" value="Submit" />
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
        <h4 class="modal-title">Edit Petugas</h4>
      </div>
        <form id="edit" role="form" method="POST" action="<?php echo site_url('admin/user'); ?>">
	      <div class="modal-body">
	        	<!--
	        	<input type="text" name="bookId" id="bookId" value=""/>
	        	-->
	        	<div class="form-group">
	              <label for="usrname">Id Petugas</label>
	              <input readonly="readonly" retype="text" class="form-control" id="id_petugas" name="id_petugas" value="" >
	            </div>
	            
	            <div class="form-group">
	              <label for="psw">Role</label>
	              	<select onChange="setRole2(this)" class="form-control" name="role" id="role" style="margin-top: 10px">
						<?php foreach ($list_role as $key => $value): ?>
							<option value="<?php echo $value['id_role']; ?>" ><?php echo $value['nama_role']; ?></option>
						<?php endforeach;?>
					</select>
	            </div>

	            <div class="form-group">
	              <label for="usrname">Username</label>
	              <input type="text" class="form-control" id="username_petugas" name="username_petugas" value="" >    
	            </div>
	            <div class="form-group">
	              <label for="psw">Password</label>
	              <input type="text" class="form-control" id="password_petugas" name="password_petugas" >
	            </div>
	            <div class="form-group">
	              <label for="psw">Nama</label>
	              <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" >
	            </div>
	         
	            
	            
			
	      </div>
	      <div class="modal-footer">
	        
	      </div>
      
    </div>

  </div>

  <div class="modal-dialog">
  <br><br>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> </h4>
      </div>
    
	      <div class="modal-body">

      	   <div class="form-group">
              <label for="psw">Email</label>
              <input type="text" class="form-control" id="email_petugas" name="email_petugas" >
            </div>
	        <div class="form-group">
	              <label for="psw">No HP</label>
	              <input type="text" class="form-control" id="no_hp_petugas" name="no_hp_petugas" >
	         </div>	
	         <!--
	        <div class="form-group">
              <label for="psw">Jobdesk</label>
              <textarea class="form-control" rows="3" id="jobdesc_petugas" name="jobdesc_petugas" ></textarea>
            </div>
            -->

            <div id="dept2" class="form-group">
            	<label for="psw">Departemen</label>
                <select class="form-control" name="departemen" id="departemen" style="margin-top: 10px">
					<?php foreach ($list_departemen as $key => $value): ?>
					<option value="<?php echo $value['id_departemen']; ?>" ><?php echo $value['nama_departemen']; ?></option>
					<?php endforeach;?>
				</select>
            </div>
            <div class="form-group">
            	<label for="psw">Aplikasi</label>
            	<br>

            		
            		<div id="app1">
            			<input disabled checked type="checkbox" id="inbox" name="inbox" value="Inbox"> &nbsp; Inbox Aduan
            		</div>

				<?php foreach ($list_app as $key => $value): ?>

					<?php if ($key < 4) continue;  ?>
					<?php if ($key == 8) continue;  ?>

					<?php if ($key%2 == 0): ?>
						<div id="app1">
						 	<input type="checkbox" id="<?php echo "app".$value['id_all_app']; ?>" name="app[]" value="<?php echo $value['id_all_app']; ?>">
								&nbsp;
							<?php echo $value['desc_app']; ?>
						</div>
					<?php endif;?>
					
					<?php if ($key%2 == 1): ?>
						<div id="app2">
						 	<input type="checkbox" id="<?php echo "app".$value['id_all_app']; ?>" name="app[]" value="<?php echo $value['id_all_app']; ?>">
								&nbsp;
							<?php echo $value['desc_app']; ?>
						</div>
					<?php endif;?>

				<?php endforeach;?>
				
            </div>
            <br><br><br><br><br><br>
			
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
        <h4 class="modal-title">Hapus Data Petugas</h4>
      </div>
        <form id="edit" role="form" method="POST" action="<?php echo site_url('admin/user'); ?>">
	      <div class="modal-body">
	        	<!--
	        	<input type="text" name="bookId" id="bookId" value=""/>
	        	-->
	        	<div class="form-group">
	              <label for="usrname">Id Petugas</label>
	              <input readonly="readonly" retype="text" class="form-control" id="id_petugas" name="id_petugas" value="" >
	            </div>
	            
	            <div class="form-group">
	              <label for="psw">Role</label>
	              	<select disabled class="form-control" name="role" id="role" style="margin-top: 10px">
						<?php foreach ($list_role as $key => $value): ?>
							<option value="<?php echo $value['id_role']; ?>" ><?php echo $value['nama_role']; ?></option>
						<?php endforeach;?>
					</select>
	            </div>

	            <div class="form-group">
	              <label for="usrname">Username</label>
	              <input readonly="readonly" type="text" class="form-control" id="username_petugas" name="username_petugas" value="" >    
	            </div>
	            <div class="form-group">
	              <label for="psw">Password</label>
	              <input readonly="readonly" type="text" class="form-control" id="password_petugas" name="password_petugas" >
	            </div>
	            <div class="form-group">
	              <label for="psw">Nama</label>
	              <input readonly="readonly" type="text" class="form-control" id="nama_petugas" name="nama_petugas" >
	            </div>
	        
	            
	            
			
	      </div>
	      <div class="modal-footer">
	        
	      </div>
      
    </div>

  </div>

  <div class="modal-dialog">
  <br><br>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> </h4>
      </div>
    
	      <div class="modal-body">

	          <div class="form-group">
	              <label for="psw">Email</label>
	              <input readonly="readonly" type="text" class="form-control" id="email_petugas" name="email_petugas" >
	            </div>
	        <div class="form-group">
	              <label for="psw">No HP</label>
	              <input readonly="readonly" type="text" class="form-control" id="no_hp_petugas" name="no_hp_petugas" >
	         </div>	
	         <!--
	        <div class="form-group">
              <label for="psw">Jobdesk</label>
              <textarea readonly="readonly" class="form-control" rows="3" id="jobdesc_petugas" name="jobdesc_petugas" ></textarea>
            </div>
            -->
            <div id="dept3" class="form-group">
            	<label for="psw">Departemen</label>
                <select disabled class="form-control" name="departemen" id="departemen" style="margin-top: 10px">
					<?php foreach ($list_departemen as $key => $value): ?>
					<option value="<?php echo $value['id_departemen']; ?>" ><?php echo $value['nama_departemen']; ?></option>
					<?php endforeach;?>
				</select>
            </div>
            <div class="form-group">
            	<label for="psw">Aplikasi</label>
            	<br>

            		
            		<div id="app1">
            			<input disabled checked type="checkbox" id="inbox" name="inbox" value="Inbox"> &nbsp; Inbox Aduan
            		</div>

				<?php foreach ($list_app as $key => $value): ?>

					<?php if ($key < 4) continue;  ?>
					<?php if ($key == 8) continue;  ?>
					
					<?php if ($key%2 == 0): ?>
						<div id="app1">
						 	<input disabled type="checkbox" id="<?php echo "appd".$value['id_all_app']; ?>" name="app[]" value="<?php echo $value['id_all_app']; ?>">
								&nbsp;
							<?php echo $value['desc_app']; ?>
						</div>
					<?php endif;?>
					
					<?php if ($key%2 == 1): ?>
						<div id="app2">
						 	<input disabled type="checkbox" id="<?php echo "appd".$value['id_all_app']; ?>" name="app[]" value="<?php echo $value['id_all_app']; ?>">
								&nbsp;
							<?php echo $value['desc_app']; ?>
						</div>
					<?php endif;?>

				<?php endforeach;?>
				
            </div>
            <br><br><br><br><br><br>
			
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

var current_fs, next_fs, previous_fs;
var left, opacity, scale;
var animating;
var fieldsetn = 1;
var erros = 0;

$('#field1').show("slow");
$('#field2').hide();
$('#field3').hide();
$('#dept').hide();


$(".next").click(function() {
    

    if (fieldsetn == 1) {
	    $('#field1').hide();
	    $('#field2').show("fast");
	    $('#field3').hide();
	    fieldsetn = 2;

	} else if (fieldsetn == 2) {
	    $('#field1').hide();
	    $('#field2').hide();
	    $('#field3').show("fast");

	    fieldsetn = 3;

	} 


}); 



$(".prev").click(function() {
    

    if (fieldsetn == 2) {
	    $('#field1').show("fast");
	    $('#field2').hide();
	    $('#field3').hide();
	    fieldsetn = 1;

	} else if (fieldsetn == 3) {
	    $('#field1').hide();
	    $('#field2').show("fast");
	    $('#field3').hide();

	    fieldsetn = 2;

	} 


}); 


function setRole(a)
{
    a = document.getElementById('role2');

    if(a.value != '3'){
    	$('#dept').hide();
    }
    else
    {
    	$('#dept').show();
    }
    
 
}

function setRole2(a)
{
    a = document.getElementById('role');

    if(a.value != '3'){
    	$('#dept2').hide();
    }
    else
    {
    	$('#dept2').show();
    }
    
 	//alert(a.value);
}


$(document).on("click", ".fnDpt", function () {
     var id = $(this).data('id');
     var tipe = $(this).data('tipe');

     <?php
     	$id_petugas = array();
	    $username_petugas = array();
	    $password_petugas = array();
	    $nama_petugas = array();
	    $email_petugas = array();
	    $no_hp_petugas = array();
	    $jobdesc_petugas = array();
	    $departemen = array();
	    $role = array();
	    
	    foreach ($list_petugas as $key => $value) {
	    		
	    		array_push($id_petugas, $value['id_petugas']);
	    		array_push($username_petugas, $value['username_petugas']);
	        	array_push($password_petugas, $value['password_petugas']);
	    		array_push($nama_petugas, $value['nama_petugas']);
	        	array_push($email_petugas, $value['email_petugas']);
	        	array_push($no_hp_petugas, $value['no_hp_petugas']);
	        	array_push($jobdesc_petugas, $value['jobdesc_petugas']);
	    		array_push($departemen, $value['departemen']);
	        	array_push($role, $value['role']);
	        
	    }
	?>
	var id_petugas = <?php echo json_encode($id_petugas); ?>;
	var username_petugas = <?php echo json_encode($username_petugas); ?>;
	var password_petugas = <?php echo json_encode($password_petugas); ?>;
	var nama_petugas = <?php echo json_encode($nama_petugas); ?>;
	var email_petugas = <?php echo json_encode($email_petugas); ?>;
	var no_hp_petugas = <?php echo json_encode($no_hp_petugas); ?>;
	var jobdesc_petugas = <?php echo json_encode($jobdesc_petugas); ?>;
	var departemen = <?php echo json_encode($departemen); ?>;
	var role = <?php echo json_encode($role); ?>;

	$(".modal-body #id_petugas").val( id_petugas[id] );
    $(".modal-body #username_petugas").val( username_petugas[id] );
    $(".modal-body #password_petugas").val( password_petugas[id] );
    $(".modal-body #nama_petugas").val( nama_petugas[id] );
    $(".modal-body #email_petugas").val( email_petugas[id] );
    $(".modal-body #no_hp_petugas").val( no_hp_petugas[id] );
    $(".modal-body #jobdesc_petugas").val( jobdesc_petugas[id] );
    $(".modal-body #departemen").val( departemen[id] );
    $(".modal-body #role").val( role[id] );

    if(role[id] != '3')
    {
    	$('#dept2').hide();
    	$('#dept3').hide();
    }
    else
    {
    	$('#dept2').show();
    	$('#dept3').show();
    }



    <?php
    	$id_app = array();
    	$id_ptgs = array();
    	//$temp = json_decode($json);
    	foreach ($list_user_app as $key => $value) {
    	
	    	
	    		
	    	array_push($id_app, $value['id_app']);
	    		
	    	
    		array_push($id_ptgs, $value['petugas']);
   
    	}

	?>

	var id_app = <?php echo json_encode($id_app); ?>;
	var id_ptgs = <?php echo json_encode($id_ptgs); ?>;
	var k = 0;

	var temp_app = [];
	for (var j = 0; j < id_app.length; j++) {
		if(id_petugas[id] == id_ptgs[j])
		{
			temp_app[k] = id_app[j];
			k++;
			
		}
	}

    

   	
	//$(".modal-body #username_petugas").val( k );
	
		
	
    for (var d = 5; d <= id_app.length; d++) {
    	var flag = 0;

    	for (var a = 0; a < k; a++) {
    		if(temp_app[a] <= 4 )
    		{
    			continue;
    		}

    		if(d == temp_app[a])
    		{
    			flag = 1;
    			break;
    		}
    		else
    		{
    			flag = 0;
    		}

    	}
    	
    	var id = d;   	
	    var idn = id.toString();	    
	    if(tipe == 0)
	    {
	    	var temp = "app" + idn;	 
	    }
	    else
	    {
	    	var temp = "appd" + idn;	
	    }
	  	 		  	
	    var x = document.getElementById(temp);
	    //x.checked = true;
	    if(flag == 1)
	    {
	    	//alert(temp);
	    	x.checked = true;
	    } else {
	    	x.checked = false;
	    }
	        
    	
    }
    
   
    
});

$(document).ready(function() {
    $("abbr.timeago").timeago();
   		var table = $('#list_petugas').DataTable( {
	        "language": {
	            "lengthMenu": "Tampilkan _MENU_ data per halaman",
	            "zeroRecords": "data tidak tersedia",
	            "info": "Halaman _PAGE_ dari _PAGES_",
	            "infoEmpty": "data tidak tersedia",
	            "infoFiltered": "(filtered from _MAX_ total records)",
	            "sSearch": "cari"
	        },
       		 //"order": [[ 6, "asc" ]],
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