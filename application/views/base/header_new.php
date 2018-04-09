<!DOCTYPE html>
<html lang="id" style="height: 100%; width: 100%">
  <head>
    <meta charset="utf-8">
    <title>Sistem Layanan Aduan Pemerintah Kota Kediri</title>
    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="<?php echo base_url('assets/new/img/favicon.png');?>"/>
    <link rel="bookmark" href="<?php echo base_url('assets/new/img/favicon.png');?>"/>
    <!-- site css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/new/css/site.min.css');?>">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
    <?php
    foreach($css_files as $file): ?>
        <?php if (strpos($file, 'http://') !== false || strpos($file, 'https://') !== false): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php else:?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url($file); ?>" />
        <?php endif;?>
    <?php endforeach; ?>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo base_url('assets/new/js/site.min.js');?>"></script>

    <?php foreach($js_files as $file): ?>
        <?php if (strpos($file, 'http://') !== false || strpos($file, 'https://') !== false): ?>
        <script src="<?php echo $file; ?>"></script>
        <?php else: ?>
        <script src="<?php echo base_url($file); ?>"></script>
        <?php endif;?>
    <?php endforeach; ?>


    <style>
      .container2 {
     
      margin: 0 auto;
      width: 90%;
    }

    #judul {
        display: none;
        
    }


    @media screen and (min-device-width: 992px) {

    #judul {
        display: inline;
        
      }
    }

    @media screen and (min-device-width: 470px) and (max-device-width: 767px){

    #judul {
        display: inline;
        
    }


  }

    </style>
  </head>


  <body style="height: 100%; width: 100%; overflow-x: hidden; background-color: rgb(241, 242, 246);">

    <!--nav-->
     <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <br><br><br>
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="border-bottom: thin groove lightgrey;">Detil Pengadu</h4>
                      </div>
                      <div class="modal-body">
                        <p>
                        No. KTP : <br/>
                        Nama : <br/>
                        Nomor HP : <br/>
                        Email : <br/>
                        Tgl Lahir : <br/>
                        </p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
      <nav class="navbar navbar-default navbar-custom" role="navigation" style="min-height: 50px;">
        <div class="container2">
          <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Tampilkan Menu</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            
           
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url('assets/new/img/pemkot-kediri.png');?>" height="42"> 
          

              </a>
         
                <a id="judul" class="nav-link" style="line-height: 70px; color: #4d4d4d; font-size:160%; font-weight: bold;">
                  <span>
                  
                   surga.kedirikota.go.id
                   </span>
                </a>
            
            <!--
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/new/img/logo.png');?>" height="40"></a>
            -->
            </div>
          <script type="text/javascript">
              jQuery(function($){
                   $('a.modalajax').click(function(ev){
                       ev.preventDefault();
                       var uid = $(this).children()[0].innerHTML;
                       $.get('<?php echo site_url("petugas/getPengadu/")?>'+'/'+uid, function(html){
                           console.log(html);
                           $('#mymodal .modal-body').html(html);
                           $('#mymodal').modal('show', {backdrop: 'static'});
                       });
                   });
              });
          </script>
          <div class="collapse navbar-collapse" >
            <ul class="nav navbar-nav navbar-right">
              <?php if (!$this->session->userdata('data_petugas') && !$this->session->userdata('petugas_stat') && !$this->session->userdata('petugas_admin')): ?>
              <li>
                  <a style="color: #4d4d4d;" class="nav-link <?php if (strtolower($this->uri->segment(2)) == 'buat' or strtolower($this->uri->segment(2)) == 'add') { echo "current"; } ?>" href="<?php echo site_url('aduan/buat'); ?>">Buat Aduan</a>
              </li>
              <li>
                  <a style="color: #4d4d4d;" class="nav-link <?php if (strtolower($this->uri->segment(2)) == 'cek' or strtolower($this->uri->segment(2)) == 'jawab') { echo "current"; } ?>" href="<?php echo site_url('aduan/cek'); ?>">Cek Aduan</a>
              </li>
              <?php endif;?>
              <?php
                  if ($this->session->userdata('data_petugas')) {
                      $data_petugas = $this->session->userdata('data_petugas');
                  } else if ($this->session->userdata('petugas_stat')) {
                      $data_petugas = $this->session->userdata('petugas_stat');
                  } else if ($this->session->userdata('petugas_admin')) {
                      $data_petugas = $this->session->userdata('petugas_admin');
                  }
              ?>
              <?php if (isset($data_petugas)): ?>
                <!--
                  <li class="nav-link <?php if (strtolower($this->uri->segment(2)) == 'petugas') { echo "current"; } ?>">
                      <a href="<?php echo site_url('login'); ?>">Beranda</a>
                  </li>
                  -->


                   <li>
                      <?php if ($data_petugas['role'] == '1'): ?>
                      <a class="nav-link" style="color: #4d4d4d">POOL</a>
                      <?php endif;?>
                      <?php if ($data_petugas['role'] == '3'): ?>
                      <a class="nav-link" style="color: #4d4d4d"><?php echo $data_petugas['nama_departemen'] ?></a>
                      <?php endif;?>
                      <?php if ($data_petugas['role'] == '4'): ?>
                      <a class="nav-link" style="color: #4d4d4d">ADMIN</a>
                      <?php endif;?>
                   </li>

                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #4d4d4d">Menu<strong class="caret"></strong></a>
                      <ul class="dropdown-menu">
                          
                          <?php if ($data_petugas['role'] == '4'): ?>
                          <li class="<?php if (strtolower($this->uri->uri_string()) == "admin/dashboard") echo "active"; ?>"> <a href="<?php echo site_url()."admin/dashboard"; ?>" style="cursor:pointer;"> Inbox Seluruh Aduan <?php if ($jum_0 > 0): ?><span class="badge"><?php echo $jum_0; ?></span> <?php endif ?></a></li>
                        <?php endif;?>
                        <?php if ($data_petugas['role'] != '4'): ?>
                          <li class="<?php if (strtolower($this->uri->uri_string()) == "petugas/inbox") echo "active"; ?>"> <a href="<?php echo site_url()."petugas/inbox"; ?>" style="cursor:pointer;"> Inbox <?php if ($jum_0 > 0): ?><span class="badge"><?php echo $jum_0; ?></span> <?php endif ?></a></li>
                        <?php endif;?>

                          <?php foreach ($data_petugas['list_app'] as $key => $value): 
                          $badge = -1;
                      
                          if ($value['url_app'] == "petugas/dashboard/0") continue;
                          else if ($value['url_app'] == "petugas/dashboard/1") continue;
                          else if ($value['url_app'] == "petugas/dashboard/2") continue;
                          else if ($value['url_app'] == "petugas/dashboard/3") continue;
                          else if ($value['url_app'] == "admin/dashboard" && $data_petugas['role'] == '4') continue;
                          ?>
                            <?php if ($value['url_app'] == "admin/pengaturan"): ?>
                              <li class="dropdown-submenu <?php if (strtolower($this->uri->uri_string()) == $value['url_app']) echo "active"; ?>">
                                    <a href="<?php echo site_url().$value['url_app']; ?>">Pengaturan</a>
                                    <ul class="dropdown-menu">
                           
                                        <li><a href="<?php echo site_url().'admin/notifikasi'; ?>">Notifikasi</a></li>
                                        <li><a href="<?php echo site_url().'admin/option'; ?>">Jalur SMS</a></li>
                                        <li><a href="<?php echo site_url().'admin/option_jawaban'; ?>">Menjawab Aduan</a></li>
                                        <li><a href="<?php echo site_url().'admin/maintance'; ?>">Maintance</a></li>
                          
                                    </ul>
                                </li>
                            <?php else: ?>
                              <li class="<?php if (strtolower($this->uri->uri_string()) == $value['url_app']) echo "active"; ?>"><a href="<?php echo site_url().$value['url_app']; ?>" style="cursor:pointer;"><?php echo $value['desc_app']?> <?php if ($badge >= 0): ?> <span class="badge"><?php echo $badge; ?></span> <?php endif ?></a> </li>
                            <?php endif;?>
                         

                        <?php endforeach?>
                      </ul>    
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
                  <!--
                  <li class="nav-link <?php if (strtolower($this->uri->segment(2)) == 'ganti_password') { echo "current"; } ?>">
                      <a href="<?php echo site_url('petugas/ganti_password'); ?>">Ubah Password</a>
                  </li>
                  -->
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #4d4d4d"><?php echo $data_petugas['nama_petugas'];?><strong class="caret"></strong></a>
                      <ul class="dropdown-menu">
                          <li>
                              <a href="<?php echo site_url('petugas/ganti_password'); ?>">Ubah Password</a>
                          </li>
                          <li>
                              <<a href="<?php echo site_url('logout'); ?>">Logout</a>
                          </li>
                      </ul>    
                  </li>
                  <!--
                  <li>
                      <a href="<?php echo site_url('logout'); ?>">Logout</a>
                  </li>
                  -->
              <?php else: ?>
              <?php endif;?>

              <?php if (!isset($data_petugas)): ?>
              <li><a class="nav-link" style="color: #4d4d4d">&#9993 081 333 70 222 1</a></li>
               <?php endif;?>
             
             <!--
              <li><a href="http://bit.ly/evaluasi_surga">Evaluasi</a></li>
              -->
              <!-- <li><a class="nav-link <?php if (strtolower($this->uri->segment(2)) == 'beranda') { echo "current"; } ?>" href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
              <li><a class="nav-link" href="<?php echo site_url('aduan/buat'); ?>">Buat Aduan</a></li>
              <li><a class="nav-link" href="<?php echo site_url('aduan/cek'); ?>">Cek Aduan</a></li>
              <li><a class="nav-link" href="free-psd.html">Login Petugas</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manajemen Data<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo site_url('departemen/manajemen_user');?>">Data Petugas</a>
                    </li>
                </ul>
              </li>
              <li><a href="tel:(0341) 4432-123">&#9742 (0341) 4432-123</a></li> -->

              <!--
                   <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                                    <ul class="dropdown-menu">
                                        
                                            
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">One more separated link</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </li>
-->
            </ul>
          </div>
        </div>
      </nav>

