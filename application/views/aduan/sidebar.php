<style type="text/css">
	button {
		margin: 5px 0px;
	}

	.table {
		border-collapse:collapse; 
		table-layout:fixed; 
		width:350px;
		border: 0px solid black;
	}

	.table th {
    border: 0px solid black;
	}
   	.table td {
   		width:200px; 
   		word-wrap:break-word;
   		max-width:100px;
   		border: 0px solid black;
   	}



   	.label{
    display:block;
    float:left;
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
<div class="panel panel-primary">
	<div class="panel-heading">
		Status Aduan
	</div>
<?php if ($this->session->userdata('data_petugas')): ?>
	<?php
		$data = $this->session->userdata('data_petugas');
		// print_r($list_chat);
	?>
<form id="sidebar_form" class="form-horizontal" role="form" action="<?php echo site_url('aduan/update_info').'/'.$nomor_aduan; ?>" method="POST">
<?php else:?>
<form id="sidebar_form" class="form-horizontal" role="form">
<?php endif;?>
	<ul class="list-group">
		<?php if ($this->session->userdata('data_petugas') && $aduan['info'] == '2'): ?>
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-4">Alasan</div>
				<div class="col-md-8">
					<p><?php echo $aduan['info_detail']; ?></p>
				</div>
			</div>
		</li>
		<?php endif; ?>
		
		<?php if ($this->session->userdata('data_petugas')): ?>
		<li class="list-group-item">
			<div class="row">
			<div class="col-md-4">Aduan Dari</div>
			<div class="col-md-8">: 
					<?php echo $aduan['via_sms'] == '1' ? 'SMS' : 'Website'; ?>
			</div>

			<div class="col-md-4">Nama</div>
			<div class="col-md-8">: 
					<?php echo $aduan['nama']; ?>
			</div>

			<div class="col-md-4">NIK</div>
			<div class="col-md-8">: 
					
					
						
					<a class="modalajax" data-toggle="modal" data-target="#asem" style="color: rgba(50, 142, 208, 0.9);" href="#">
						<span style="display:none;">
							<?php echo $aduan["no_identitas"];?>
						</span>
						<font color="blue">
							<?php echo $aduan['no_identitas']; ?> 
						</font>
					</a>

					
			</div>
			<!--
			<table class="table">
				<tbody>
					<tr>
						<td>Aduan Dari</td>
						<td>wkwkwkwkwk	</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>wkwkwkwkwk	</td>
					</tr>
					<tr>
						<td>NIK</td>
						<td>wkwkwkwkwk	</td>
					</tr>
				</tbody>
			</table>
			-->
			</div>
		</li>
		<?php endif; ?>
		
		<!--
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-5">Departemen</div>
				<div class="col-md-12">
					<?php if ($aduan['id_status'] == '1'): ?>
						<div class="label label-danger pull-right">Belum Diterima</div>
					<?php endif;?>

					<?php if ($aduan['id_status'] != '1'): ?>
						<div class="label label-default pull-right"><?php echo $aduan['nama_departemen']; ?></div>
					<?php endif;?>
						
					<?php if ($this->session->userdata('data_petugas') && $data['role'] == '1'): ?>
					<select class="form-control" name="departemen" id="departemen" style="margin-top: 10px">
					<?php foreach ($get_department as $key => $value): ?>
					<option data-mitra="<?php echo $value['apakah_mitra']; ?>" value="<?php echo $value['id_departemen']; ?>" <?php if ($value['id_departemen']==$aduan['id_departemen']) echo "selected"; ?>><?php echo $value['nama_departemen']; ?></option>
					<?php endforeach;?>
					</select>
					<?php endif;?> 
				</div>
			</div>
		</li>
		-->
		<!--
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-5">Petugas</div>
				<div class="col-md-7">
					<div class="label label-<?php echo $aduan['nama_petugas'] ? 'success' : 'danger'; ?> pull-right"><?php echo $aduan['nama_petugas'] ? $aduan['nama_petugas'] : 'Belum Ada'; ?></div>
					
					<?php if ($this->session->userdata('data_petugas') && ($data['role'] == '1' || $data['role'] == '2')): ?>
					<select class="form-control" name="petugas" id="petugas" style="margin-top: 10px">
					<?php foreach ($get_petugas as $key => $value): ?>
					<option value="<?php echo $value['id_petugas']; ?>" <?php if ($value['id_petugas']==$aduan['id_petugas']) echo "selected"; ?>><?php echo $value['nama_petugas']; ?></option>
					<?php endforeach;?>
					</select>
					-->
					<!-- <div class="checkbox">
						<label>
							<input type="checkbox"> Notifikasikan SMS ke Petugas
						</label>
					</div> -->
					<!--
					<?php endif;?>
				</div>
			</div>
		</li>
		-->
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-5">Status Sekarang</div>
				<div class="col-md-7">
					<div class="label label-<?php echo $aduan['class_status']; ?> pull-right"><?php echo $aduan['nama_status']; ?></div>
					<?php if ($aduan['status'] == '7' || $aduan['status'] == '8'): ?>
						<br> <div class="label label-default pull-right"> <?php echo $aduan['nama_departemen']; ?> </div>
					<?php endif;?>

				</div>
			</div>
		</li>
		
		<?php if ($kategori != ''): ?>
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-5">Kategori Aduan</div>
				<div class="col-md-7">
					<div class="label label-default pull-right"> <?php echo $kategori; ?> </div>
				</div>
			</div>
		</li>
		<?php endif;?>

	<li class="list-group-item">
	</li>
	<label class="col-md-12 text-center">History Status</label>
	<div class="row">
		
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th class="text-center">Status</th>
						<th class="text-center">Waktu</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($history_status as $key => $value): ?>
					<tr>
						<td wrap>
							<div class="label label-<?php echo $value['class_status']; ?>"><?php echo $value['nama_status']; ?></div> <br> <br>
							

							<p><?php echo $value['info_status_aduan']; ?> </p>
							
						</td>
						<td><?php $wkt = explode(' ', $value['waktu_status_aduan']); echo "Tanggal: $wkt[0]<br>Jam: $wkt[1]"; ?></td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>


  <?php if ($data_petugas = $this->session->userdata('data_petugas')): ?>
  <li class="list-group-item">
  <div class="row">
  	<!--
	<label class="col-md-5">Prioritas</label>
	<div class="col-md-7">
		<div class="label pull-right label-<?php echo $aduan['class_prioritas']; ?>"><?php echo $aduan['nama_prioritas']; ?></div>
		<select class="form-control" name="prioritas" id="prioritas" style="margin-top: 10px; margin-bottom: 10px">
		<?php foreach ($get_priority as $key => $value): ?>
		<option value="<?php echo $value['id_prioritas']; ?>" <?php if ($value['id_prioritas']==$aduan['id_prioritas']) echo "selected"; ?>><?php echo $value['nama_prioritas']; ?></option>
		<?php endforeach;?>
		</select>
	</div>
	-->
  </div>
  <input type="hidden" name="sms_notif" id="sms_notif" value="0" />
  <div class="row">
		<div class="col-md-12">
			<?php if ($data_petugas['role'] == '1'): ?>
				
				<!--
					<?php if ($aduan['id_status'] == '1') echo "disable"; ?>

					<center><input <?php if ($aduan['id_status'] != '1') echo "disabled"; ?> onclick="return confirm('Yakin Aduan Diterima?')" align="left" type="submit" class="btn btn-success" name="diterima" id="diterima" value="Diterima" /></center>
					<br>
					-->
				
					<center><button <?php if ($aduan['id_status'] != '1') echo "disabled"; ?> type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalTerima">Diterima</button></center>
					<br>
				
					<center><button <?php if ($aduan['id_status'] != '5' && $aduan['id_status'] != '6') echo "disabled"; ?> type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalTerus">Diteruskan</button></center>
					<br>
				<!--
				<input align="left" type="submit" class="btn btn-success" name="diteruskan" id="diteruskan" value="Diteruskan" />
				
				
				<button type="button" id="update_btn" class="btn btn-primary">Diterima</button>
				
				<button type="button" id="update_btn" class="btn btn-primary">Diteruskan</button>
				-->
			<?php endif;?>
			
			<?php if ($data_petugas['role'] == '3' && $data_petugas['departemen'] == $aduan['id_departemen']): ?>
				<center><input <?php if ($aduan['id_status'] != '7') echo "disabled"; ?> onclick="return confirm('Yakin Aduan Diterima?')" align="left" type="submit" class="btn btn-success" name="diterimaDpt" id="diterimaDpt" value="Diterima" /></center>
				<br>
				<center><button <?php if ($aduan['id_status'] != '7') echo "disabled"; ?> onclick="return confirm('Yakin Aduan Dikembalikan?')" id="kembali_btn" href="" class="btn btn-danger">Kembalikan</button></center>
				<br>
			<?php endif;?>
			<!--
			<center><a style="padding: 6px 12px;" href="<?php echo site_url('aduan/spam').'/'.$nomor_aduan; ?>" onclick="return confirm('Yakin tandai sebagai spam?')" class="btn btn-warning">Tandai Sebagai Spam</a></center>
			<br>
			-->
			<?php if ($data_petugas['role'] == '4'): ?>
				<center><a style="padding: 6px 12px;" href="<?php echo site_url('aduan/hapus').'/'.$nomor_aduan; ?>" onclick="return confirm('Yakin Aduan dihapus?')" class="btn btn-danger">Hapus</a></center>
			<?php endif; ?>
		</div>
	</div>
  <!--
  <div class="row">
		<div class="col-md-12">
			<?php if ($data_petugas['role'] != '4'): ?>
				<button type="button" id="update_btn" class="btn btn-primary">Update</button>
			<?php endif;?>
			<a style="padding: 6px 12px;" href="<?php echo site_url('aduan/spam').'/'.$nomor_aduan; ?>" onclick="return confirm('Yakin tandai sebagai spam?')" class="btn btn-warning">Tandai Sebagai Spam</a>
			<?php if ($data_petugas['role'] == '3'): ?>
				<button id="kembali_btn" href="" class="btn btn-danger">Kembalikan</button>
			<?php endif;?>
			<?php if ($this->session->userdata('petugas_admin')): ?>
			<center><a style="padding: 6px 12px;" href="<?php echo site_url('aduan/spam').'/'.$nomor_aduan; ?>" onclick="return confirm('Yakin tandai sebagai spam?')" class="btn btn-warning">Tandai Sebagai Spam</a></center>
			<?php endif; ?>
		</div>
	</div>
	-->
  </li>
  </ul>
  <?php endif; ?>
  <br><br>
  </div>



<div id="myModalTerus" class="modal fade" role="dialog">
	<br> <br><br><br><br>
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Aduan Ini Diteruskan Ke </h4>
      </div>

      <div class="modal-body">
        	
            <div class="form-group">
              <select class="form-control" name="departemen" id="departemen" style="margin-top: 10px">
					<?php foreach ($get_department as $key => $value): ?>
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
      		<input onclick="return confirm('Yakin Aduan Diteruskan?')" align="left" type="submit" class="btn btn-success" name="diteruskan" id="diteruskan" value="Submit" />
      	</div>
      </div>
  
    </div>

  </div>
</div>


<div id="myModalTerima" class="modal fade" role="dialog">
	<br> <br><br><br><br>
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Aduan Ini Diterima di Kategori = </h4>
      </div>

      <div class="modal-body">
        	
            <div class="form-group">
			  <input type="hidden" name="diterima" id="diterima" />
              <select class="form-control" name="kategori" id="kategori" style="margin-top: 10px">
					<?php foreach ($get_kategori as $key => $value): ?>
					<option value="<?php echo $value['id_kategori']; ?>" ><?php echo $value['nama_kategori']; ?></option>
					<?php endforeach;?>
				</select>
            </div>
           
               
      </div>
      <div class="modal-footer">
        
        
        <div id="footer1">
     		<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
 		</div>
 		<div id="footer2">
      		<input onclick="return confirm('Yakin Aduan Ini Diterima di Kategori yang Anda Pilih ?')" align="left" type="submit" class="btn btn-success" name="diterima" id="diterima" value="Submit" />
      	</div>
      </div>
  
    </div>

  </div>
</div>

</form>



<?php if ($this->session->userdata('data_petugas')): ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<br><br><br><br><br><br>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Alasan Pengembalian</h4>
      </div>
      <div class="modal-body">
      	<div id="msg" style="display:none" class="alert alert-danger" role="alert"></div>
  		<p>Tuliskan Alasan Pengembalian</p>
		<textarea class="form-control" id="alasan" name="alasan"></textarea>
      </div>
      <div class="modal-footer">
        
        
        <div id="footer1">
     		<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
 		</div>
 		<div id="footer2">
      		<button id="kembali_submit" type="button" class="btn btn-primary">Kembalikan</button>
      	</div>
      </div>
    </div>
  </div>
</div>
<?php endif;?>



<?php if ($this->session->userdata('data_petugas')): ?>
<script type="text/javascript">
    $( document ).ready(function() {
    	$('#kembali_btn').click(function() {
    		$('#myModal').modal();
    		return false;
    	});
    	$('#kembali_submit').click(function() {
    		
    		$.post('<?php echo site_url("aduan/kembali/$nomor_aduan"); ?>', { alasan: $('#alasan').val() }, function( data ) {

    			if (data.class == 'danger') {
    				$('#msg').html(data.msg);
    				$('#msg').show();
    			} else {
					window.location.replace('<?php echo site_url("petugas"); ?>');
    			}
			}, "json");
			return false;
    	});
        $("#departemen").select2();
        $("#status").select2();
        $("#prioritas").select2();
        $("#petugas").select2();

        $('#update_btn').click(function() {
			var selected = $('#departemen').find('option:selected');
			var extra = selected.data('mitra');
			$('#sms_notif').val('0');
        	if (extra) {
				var r = confirm("Departemen Termasuk Departemen Mitra, Apakah akan mengirimkan SMS Pemberitahuan?");
				if (r == true) {
					$('#sms_notif').val('1');
				} else {
					$('#sms_notif').val('0');
				}
        	}
        	$('#sidebar_form').submit();
        });
    });
</script>
<?php endif;?>