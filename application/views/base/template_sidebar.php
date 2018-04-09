<?php echo $_header?>
    </div>
</div>
<div class="docs-header" style="min-height: 90%;">
    <div class="w3-container" style="min-height: 100%; z-index: 999; padding: 70px 0 60px;">
        <div class="container" style="color: rgba(50, 142, 208, 0.9);">

        <?php if($this->session->userdata('data_petugas')) {?>
        &nbsp; &nbsp;
        <a href="<?php echo site_url('petugas/inbox'); ?>" class="btn btn-primary btn-sm">
          <span class="glyphicon glyphicon-arrow-left"></span> Kembali
        </a>
         
        
				<br><br>
         <?php }?>
        	
        	
	        <div class="col-md-8">
	 			<?php echo $_content?>
	 		</div>
	        <div class="col-md-4">
				<?php echo $_sidebar?>
	        </div>
	 	</div>
	</div>
</div>

<?php echo $_footer?>