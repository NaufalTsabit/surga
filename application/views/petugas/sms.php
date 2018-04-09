<style type="text/css">
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

     h3 {
        border-bottom: thin groove black;
        padding-bottom: 0px;

    }
</style>
<h3>Kirim SMS</h3>

<form class="well" role="form" method="POST" action="<?php echo site_url('petugas/sms'); ?>">
	
	<?php if (isset($error)): ?>
    <div class="alert alert-danger" role="alert">Error!<?php echo $error; ?></div>
    <?php endif;?>
    <?php if (isset($success)): ?>
    <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
    <?php endif;?>
	<div class="form-group">
        <label>Tujuan</label>
        <select class="form-control" name="tujuan[]" id="tujuan" multiple>
		    <?php $ctr = 0; foreach ($all_hp as $key => $value): ?>
		    <option value="<?php echo $ctr++.'_'.$value['no_hp_petugas']?>"><?php echo $value['nama_petugas'].' ('.$value['no_hp_petugas'].')'; ?></option>
			<?php endforeach; ?>
    	</select>
    </div>
    <div class="form-group">
        <label>Isi</label>
        <textarea class="form-control" id="isi" name="isi"><?php echo set_value('isi'); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
</form>

<script type="text/javascript">
    $(document).ready(function() {
    	$('#tujuan').select2();
        <?php if (isset($success)): ?>
        $('#isi').val("");
        <?php endif;?>
	} );
</script>
