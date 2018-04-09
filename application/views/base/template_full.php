<?php echo $_header?>
<style type="text/css">

.badge, .label {
    	background-color: #FF0000;
    }

</style>

<div class="docs-header" style="min-height: 90%;">
    <div class="w3-container" style="min-height: 100%; z-index: 999; padding: 0px 0 20px;">
        <div class="container" style="color: rgba(0, 0, 0, 1);">
            <div class="col-md-12" style="margin-top: 5%;">
					<?php 
					if ($this->session->userdata('data_petugas')) $data_petugas = $this->session->userdata('data_petugas');
					else if ($this->session->userdata('petugas_stat')) $data_petugas = $this->session->userdata('petugas_stat');
					else if ($this->session->userdata('petugas_admin')) $data_petugas = array('list_app' => array());
					?>

					
					
				<?php echo $_content?>
			</div>
		</div>
	</div>
</div>
<div>
<?php echo $_footer?>