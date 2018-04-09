<br/><br/><br/><br/><br/>
<style type="text/css">
	tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    .flexigrid div.form-div input[type=text] {                
                font-size: 14px;  
                height:35px;      
    }
    .flexigrid div.form-div a {                
                font-size: 14px;  
                height:30px;      
    }
    .wrapper {
    text-align: center;
    }
</style>
<!--
<ul class="nav nav-pills">
 
	<li class="<?php if (strtolower($this->uri->segment(2)) == 'dashboard') echo "active"; ?>"><a href="<?php echo site_url('admin/dashboard'); ?>" style="cursor:pointer;">Seluruh Aduan</a></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'user') echo "active"; ?>"><a href="<?php echo site_url('admin/user'); ?>" style="cursor:pointer;">Manajemen Petugas</a></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'departemen') echo "active"; ?>"><a href="<?php echo site_url('admin/departemen'); ?>" style="cursor:pointer;">Manajemen Departemen</a></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'pengaturan') echo "active"; ?>"><a href="<?php echo site_url('admin/pengaturan'); ?>" style="cursor:pointer;">Pengaturan</a></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'aktivitas') echo "active"; ?>"><a href="<?php echo site_url('admin/aktivitas'); ?>" style="cursor:pointer;">Aktivitas</a></li> 
-->
<!--
	<li class="<?php if (strtolower($this->uri->segment(2)) == 'dashboard') echo "active"; ?>"><a href="<?php echo site_url('admin/dashboard'); ?>" style="cursor:pointer;">Seluruh Aduan</a></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'user') echo "active"; ?>"><a href="<?php echo site_url('admin/user'); ?>" style="cursor:pointer;">Manajemen Petugas</a></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'departemen') echo "active"; ?>"><a href="<?php echo site_url('admin/departemen'); ?>" style="cursor:pointer;">Manajemen Departemen</a></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'pengaturan') echo "active"; ?>"><a href="<?php echo site_url('admin/pengaturan'); ?>" style="cursor:pointer;">Pengaturan</a></li>
  	<li class="<?php if (strtolower($this->uri->segment(2)) == 'aktivitas') echo "active"; ?>"><a href="<?php echo site_url('admin/aktivitas'); ?>" style="cursor:pointer;">Aktivitas</a></li> 
</ul>
-->


 <div class="dropdown">
  <a href="<?php echo site_url('login'); ?>" class="btn btn-info ">Kembali </a>
  
  <button class="btn btn-primary dropdown-toggle pull-right" type="button" data-toggle="dropdown">Menu Pengaturan
  <span class="caret "></span></button>
  <ul class="dropdown-menu dropdown-menu-right">
    <li><a href="<?php echo site_url('admin/departemen'); ?>">Manajemen Departemen</a></li>
    <li><a href="<?php echo site_url('admin/user'); ?>">Manajemen Petugas</a></li>
    <li><a href="<?php echo site_url('admin/pengaturan'); ?>">Manajemen Peringatan</a></li>
    <li><a href="<?php echo site_url('admin/aktivitas'); ?>">Aktivitas</a></li>
  </ul>
  
</div>
<br>

<?php echo $output;?>