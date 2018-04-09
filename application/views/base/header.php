<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sistem Layanan Aduan Pemerintah Kota Kediri</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/jquery-ui.css');?>" rel="stylesheet">
    <?php 
    foreach($css_files as $file): ?>
        <?php if (strpos($file, 'http://') !== false || strpos($file, 'https://') !== false): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php else:?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url($file); ?>" />
        <?php endif;?>
    <?php endforeach; ?>

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.tmpl.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <?php foreach($js_files as $file): ?>
        <?php if (strpos($file, 'http://') !== false || strpos($file, 'https://') !== false): ?>
        <script src="<?php echo $file; ?>"></script>
        <?php else: ?>
        <script src="<?php echo base_url($file); ?>"></script>
        <?php endif;?>
    <?php endforeach; ?>

    <style type="text/css">
        .btn-file {
          position: relative;
          overflow: hidden;
        }
        .btn-file input[type=file] {
          position: absolute;
          top: 0;
          right: 0;
          min-width: 100%;
          min-height: 100%;
          font-size: 100px;
          text-align: right;
          filter: alpha(opacity=0);
          opacity: 0;
          background: red;
          cursor: inherit;
          display: block;
        }
        input[readonly] {
          background-color: white !important;
          cursor: text !important;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Sistem Layanan Pengaduan Masyarakat</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (!$this->session->userdata('data_petugas') && !$this->session->userdata('petugas_stat')): ?>
                        <li>
                            <a href="<?php echo site_url('aduan/baru'); ?>">Buat Aduan</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('aduan/cek'); ?>">Cek Aduan</a>
                        </li>
                        <?php endif;?>
                        <!-- <li>
                            <a href="#">Tentang Kami</a>
                        </li> -->
                        <?php
                            if ($this->session->userdata('data_petugas')) {
                                $data_petugas = $this->session->userdata('data_petugas');
                            } else if ($this->session->userdata('petugas_stat')) {
                                $data_petugas = $this->session->userdata('petugas_stat');
                            }  else if ($this->session->userdata('petugas_admin')) {
                                $data_petugas = $this->session->userdata('petugas_admin');
                            }
                        ?>
                        <?php if (isset($data_petugas)): ?>
                            <li class="active">
                                <a href="<?php echo site_url('login'); ?>">Beranda</a>
                            </li>
                            <?php if ($data_petugas['id_role'] == '2'): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manajemen Data<strong class="caret"></strong></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo site_url('departemen/manajemen_user');?>">Data Petugas</a>
                                    </li>
                                </ul>
                            </li>
                            <?php endif;?>
                            <li>
                                <a><?php echo $data_petugas['nama_departemen'];?> - Halo, <?php echo $data_petugas['nama_petugas'];?></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('logout'); ?>">Logout</a>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?php echo site_url('login'); ?>">Login Petugas</a>
                            </li>
                        <?php endif;?>
                        <li>
                            <a>&#9742 (0341) 4432-123</a>
                        </li>
                    </ul>
                </div>

            </nav>
        </div>
    </div>
