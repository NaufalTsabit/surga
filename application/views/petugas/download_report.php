

<style type="text/css">
	tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
	table, th, td {
	    border: 1px solid black;
	    border-collapse: collapse;
	}

    
	.table {

		border-color: #000;
		border-style: solid;
		outline-color: #000;
	}
	
	#content1 {
		float: left;
		width: 70%;
		
	}
	#content4 {
		float: left;
		width: 30%;
		
	}

	#content2 {
		float: left;
		width: 70%;
		
	}
	#content3 {
		float: left;
		width: 30%;
		
	}
	


</style>

<div id="content4" >

	<img align="top" src="<?php echo base_url('assets/new/img/pemkot-kediri.png');?>" height="75">
	
</div>

<div id="content1" vertical-align= "middle" >
 
	<p align="left" style="font-size:25px; vertical-align: middle;"> 
	<br>
	Rekap Aduan Suara Warga Kota Kediri 
	</p>

</div>

<div id="content2" >
	<p align="left">
		Tanggal :  <?php echo $tanggal_mulai; ?>
		 s/d  <?php echo $tanggal_selesai; ?>
	</p>
	
	<p align="left">
		SKPD :  <?php echo $departemen; ?>
	</p>
	
	
	
</div>

<div id="content3" >

	<p align="left">
		Status :  <?php echo $status; ?>
	</p>
	
</div>

<br>
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
				<td><?php echo $value['nama']; ?></td>
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