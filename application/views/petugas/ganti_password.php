
<style type="text/css">

     h3 {
        border-bottom: thin groove black;
        padding-bottom: 0px;

    }
</style>

<h3>Ubah Password</h3>


<form class="form-horizontal well" method="POST">
	<?php if (isset($error) || isset($success)): ?>
		<div class="alert alert-<?php echo isset($error) ? 'danger' : 'success'; ?> alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo isset($error) ? $error : $success; ?>
		</div>
	<?php endif; ?>
  <div class="form-group">
    <label class="col-sm-2 control-label">Password Lama</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="pass_lama" name="pass_lama" placeholder="Password Lama">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Password Baru</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="pass_baru" name="pass_baru" placeholder="Password Baru">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Ulangi Password Baru</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="repass_baru" name="repass_baru" placeholder="Ulangi Password Baru">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Ubah</button>
    </div>
  </div>
</form>