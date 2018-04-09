<style type="text/css">
	.bs-callout-danger h4 {
		color: #7E7E7E;
	}
	.bs-callout-danger {
		color: #767676;
	}
</style>
<div class="panel panel-primary">
	<div class="panel-heading">
		Detail Aduan
	<!-- <h4>#<?php echo $aduan['id_aduan'].' '.$aduan['topik'];?></h4> -->
	</div>
	<div class="panel-body">
	<!--
	<h4 style="color: #868686">#<?php echo ($aduan['id_aduan'] - $max_aduan).'/'.$tahun_aduan.' '.$aduan['topik'];?></h4>
	-->
	<h4 style="color: #868686">#<?php echo ($aduan['id_aduan'] - $max_aduan).' '.$aduan['topik'];?></h4>
	<?php if ($this->session->flashdata('msg')): ?>
	<div class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert"><?php echo $this->session->flashdata('msg'); ?></div>
	<?php endif;?>

	<?php foreach ($aduan['list_chat'] as $key => $value): ?>
		<?php if ($value['petugas_detail']): ?>
		<div class="bs-callout bs-callout-right bs-callout-info"><h4><?php echo $value['nama_petugas']; ?> (<?php echo $value['nama_departemen']; ?>)</h4><div class="wkt"><?php echo $value['waktu_detail']; ?>&nbsp;&nbsp;&nbsp;<abbr class="timeago" title="<?php echo $value['waktu_detail']; ?>"></abbr></div><p><?php echo $value['isi_detail']; ?></p></div>
		<?php else: ?>
		<div class="bs-callout bs-callout-left bs-callout-danger"><h4><?php echo $value['nama']; ?></h4><div class="wkt"><?php echo $value['waktu_detail']; ?>&nbsp;&nbsp;&nbsp;<abbr class="timeago" title="<?php echo $value['waktu_detail']; ?>"></abbr></div><p><?php echo $value['isi_detail']; ?></p>
			<br>
			<?php if ($value['upload']): ?>
				<p ><b>File Pendukung : </b></p>
				<?php foreach ($value['upload'] as $key2 => $value2): ?>
				
				<img src="<?php echo base_url('assets/new/img/download.png');?>" height="25">
				<a style="color: blue" target="_blank" href="<?php echo site_url('uploads').'/'.$value2['path_upload'] ?>"><?php echo $value2['orig_name']; ?></a>
				<br>
				<?php endforeach;?>
			<?php endif;?>
		</div>
		<?php endif;?>
	<?php endforeach;?>

	

	<?php if ($this->session->userdata('data_petugas') && $role_petugas != '4'): ?>
	<div>
		<form id="textarea_jawab" method="POST" action="<?php site_url('aduan/jawab'); ?>">
		<input type="hidden" value="<?php echo $aduan['id_aduan']; ?>" name="nomor_aduan" />
		<?php if ($aduan['no_hp']): ?>
			<input type="radio" id="radio_web" name="tipe_jawaban" value="web" checked> Via Web &nbsp;
			<input type="radio" id="radio_sms" name="tipe_jawaban" value="sms"> Via SMS (Jawaban akan dikirimkan ke hp pengadu)
			<br><br>
		<?php endif; ?>
		<div id="container_web">
			<textarea rows="5" class="form-control" id="isi_detail" name="isi_detail"></textarea>
		</div>
		<?php if ($aduan['no_hp']): ?>
			<div id="container_sms">
				<textarea maxlength="140" rows="5" class="form-control" id="isi_detail_sms" name="isi_detail_sms"></textarea>
				<p class="pull-right"><span id="sisa_karakter">140</span> karakter tersisa</p>
			</div>
		<?php endif; ?>
		<br/>
		<button type="submit" class="btn btn-primary">Kirim</button>
		</form>

			<?php if ($aduan['id_status'] != '4' || $option_jawaban == 1): ?>

				<?php if ($role_petugas == '1'): ?>
					
					<?php if ($aduan['id_status'] != '1' && $aduan['info'] != '4'): ?>
						<button id="show_textarea_button" type="button" class="btn btn-primary">Klik Disini Untuk Menjawab</button>
					<?php endif;?>
				<?php endif;?>

				<?php if ($role_petugas == '3'): ?>
					<?php if ($aduan['id_status'] == '8' || $aduan['id_status'] == '4'): ?>
						<button id="show_textarea_button" type="button" class="btn btn-primary">Klik Disini Untuk Menjawab</button>
					<?php endif;?>
				<?php endif;?>

			<?php endif;?>
			
			
	</div>
	<?php endif;?>
			
	<?php if ($aduan['latitude'] != '' && $aduan['longitude'] != '' ): ?>
		<br/><div id="googleMap" style="width:100%;height:380px;"></div>
	<?php endif;?>
	</div>
	
</div>

<script type="text/javascript">

	<?php if ($aduan['latitude'] != '' && $aduan['longitude'] != '' ): ?>
	var map;
	function initialize() {
		var location;
		var mapProp = {
			center: new google.maps.LatLng(-7.820951, 112.005936),
			zoom: 12,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

		var citMarker = new google.maps.Marker({
			position: new google.maps.LatLng(<?php echo $aduan['latitude']; ?>, <?php echo $aduan['longitude']; ?>)
		});
		citMarker.setMap(map);

		var infowindow = new google.maps.InfoWindow({
			content: "<?php echo $aduan['nama'] . " (". $aduan['no_hp'] . ") - " . $aduan['isi'] . ' ('. $aduan['nama_kategori'] .') - ' . $aduan['nama_departemen'] .' , ' . $aduan['waktu']; ?>"
		});

		google.maps.event.addListener(citMarker, 'click', function() {
			map.setZoom(15);
			map.setCenter(citMarker.getPosition());
			infowindow.open(map, citMarker);
		});

	}
	<?php endif;?>
	
	
    $( document ).ready(function() {
		
		<?php if ($aduan['latitude'] != '' && $aduan['longitude'] != '' ): ?>
			google.maps.event.addDomListener(window, 'load', initialize);
		<?php endif;?>
	
    	<?php if ($this->session->flashdata('class') == 'success'): ?>
		$("html, body").animate({ scrollTop: $(document).height() }, "slow");
		<?php endif;?>
		$("abbr.timeago").timeago();
		$('#show_textarea_button').hide();
		$('#container_sms').hide();
		<?php $data_petugas = $this->session->userdata('data_petugas'); ?>
		<?php if (isset($data_petugas) && $data_petugas['role'] != '4'): ?>
		$('#show_textarea_button').show();
		$('#textarea_jawab').hide();
		$('#show_textarea_button').click(function() {
			$('#show_textarea_button').hide();
			$('#textarea_jawab').show("slow");
		});
		<?php endif;?>
		<?php if ($aduan['no_hp']): ?>
		$('#radio_sms').click(function() {
			$('#container_sms').show();
			$('#container_web').hide();
		});
		$('#radio_web').click(function() {
			$('#container_sms').hide();
			$('#container_web').show();
		});
		$('#isi_detail_sms').keyup(function() {			
			var len = $(this).val().length;
			$('#sisa_karakter').text(140-len);
		});
		<?php endif;?>
    });
</script>