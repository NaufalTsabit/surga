<style type="text/css">
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

    #content1 {
        float: left;
        width: 15%;

    }
    #content2 {
        float: left;
        width: 85%;
        
    }
    #view1 {
        float: left;
        text-align: left;
        width: 50%;
        
    }

    #view2 {
        float: left;
        width: 50%;
        
    }
    h3 {
        border-bottom: thin groove black;
        padding-bottom: 0px;

    }
       
</style>

<h3>Rekap Laporan Aduan</h3>
<form class="well" role="form" method="POST" action="<?php echo site_url('petugas/report'); ?>">
	
	<?php if (isset($error)): ?>
    <div class="alert alert-danger" role="alert">Error!<?php echo $error; ?></div>
    <?php endif;?>
    <?php if (isset($success)): ?>
    <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
    <?php endif;?>

    <div class="form-group">
        <div id="content1">
            Periode
        </div>
         <div id="content2">
            <select onChange="setRole(this)" class="form-group" id="periode" name="periode">
                <option value="0" selected="selected" > Harian </option>
                <option value="1" > Bulanan </option>
                <option value="2" > Tahunan </option>
                
                
            </select>
        </div>
    </div>
    <br>
    <div id="harian" class="form-group"> 
        <div id="content1">
        Tanggal 
        </div>
        <div id="content2">
            <input type="text" name="tanggal_mulai" id="datepicker" value="01/01/2015">
             s/d <input type="text" name="tanggal_selesai" id="datepicker2" value="<?php echo $tgl_skr; ?>">
         </div>
    </div>
    <div id="bulanan" class="form-group"> 
        <div id="content1">
        Bulan 
        </div>
        <div id="content2">
            <select id="bulan" name="bulan" style="width: 100px">
                <option value="01" >Januari</option> 
                <option value="02" >Februari</option>
                <option value="03" >Maret</option>
                <option value="04" >April</option>
                <option value="05" >Mei</option>
                <option value="06" >Juni</option>
                <option value="07" >Juli</option>
                <option value="08" >Agustus</option>
                <option value="09" >September</option>
                <option value="10" >Oktober</option>
                <option value="11" >November</option>
                <option value="12" >Desember</option>
            </select>

            <select id="tahun" name="tahun">
                <?php for ($i = date('Y'); $i >= 2014 ; $i--): ?>
                    <option value="<?php echo $i;?>" <?php if ($i == date('Y')) echo "selected";?> ><?php echo $i;?></option>
                <?php endfor;?>
            </select>

            s/d

            <select id="bulan2" name="bulan2" style="width: 100px">
                <option value="01" >Januari</option> 
                <option value="02" >Februari</option>
                <option value="03" >Maret</option>
                <option value="04" >April</option>
                <option value="05" >Mei</option>
                <option value="06" >Juni</option>
                <option value="07" >Juli</option>
                <option value="08" >Agustus</option>
                <option value="09" >September</option>
                <option value="10" >Oktober</option>
                <option value="11" >November</option>
                <option value="12" >Desember</option>
            </select>

            <select id="tahun2" name="tahun2">
                <?php for ($i = date('Y'); $i >= 2014 ; $i--): ?>
                    <option value="<?php echo $i;?>" <?php if ($i == date('Y')) echo "selected";?> ><?php echo $i;?></option>
                <?php endfor;?>
            </select>
         </div>
    </div>
    
    <div id="tahunan" class="form-group"> 
        <div id="content1">
        Tahun
        </div>
        <div id="content2">


            <select id="tahun" name="tahun">
                <?php for ($i = date('Y'); $i >= 2014 ; $i--): ?>
                    <option value="<?php echo $i;?>" <?php if ($i == date('Y')) echo "selected";?> ><?php echo $i;?></option>
                <?php endfor;?>
            </select>

            s/d

            <select id="tahun2" name="tahun2">
                <?php for ($i = date('Y'); $i >= 2014 ; $i--): ?>
                    <option value="<?php echo $i;?>" <?php if ($i == date('Y')) echo "selected";?> ><?php echo $i;?></option>
                <?php endfor;?>
            </select>
         </div>
    </div>
    
    <br><br>
    <div class="form-group">
        <div id="content1">
            Departemen
        </div>
         <div id="content2">
            <select onChange="setRole2(this)" class="form-group" id="departemen" name="departemen">
                <option value="0" selected="selected"> Semua Departemen </option>
                <?php foreach ($departemen as $key => $value): ?>
                     <option value="<?php echo $value['id_departemen']; ?>" <?php echo set_select('departemen', $value['id_departemen']); ?>><?php echo $value['nama_departemen']; ?></option>
                <?php endforeach;?>  
            </select>
        </div>
    </div>

    <div id="cek_dept" class="form-group">
        <div id="content1">
            Jenis Data
        </div>
         <div id="content2">
            <select class="form-group" id="cek_induk" name="cek_induk">
                <option value="0" selected="selected"> Hanya Internal SKPD </option>
                <option value="1" > Dengan Anggota SKPD </option>               
            </select>
        </div>
    </div>

    <div class="form-group">
        <div id="content1">
        Status
        </div>
        <div id="content2">
            <select class="form-group" id="status" name="status">
                <option value="0" selected="selected"> Semua Status </option>
                <?php foreach ($status as $key => $value): ?>
                    <?php if ($key == 1 || $key == 2): ?>
                        <?php continue; ?>
                    <?php endif;?>
                     <option value="<?php echo $value['id_status']; ?>" <?php echo set_select('status', $value['id_status']); ?>><?php echo $value['nama_status']; ?></option>
                <?php endforeach;?>  
            </select>
        </div>
    </div>

    <div class="form-group">
        <div id="content1">
        Tampilkan Jawaban
        </div>
        <div id="content2">
            <input type="radio" name="jawaban" value="1">Iya  &nbsp;
            <input type="radio" name="jawaban" value="0" checked>Tidak
        </div>
        <br>
    </div>
   
    <hr>
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalDownload">Atur Data</button>
   <!--
    <input type="submit" class="btn btn-primary" name="excel" value="Download Excel">
    -->
     <input type="submit" class="btn btn-primary" name="lihat" value="Lihat Data">

<div id="myModalDownload" class="modal fade" role="dialog">
<br><br><br>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pengaturan Data</h4>
      </div>
     
      <div class="modal-body">
            <label for="usrname">Centang data yang ingin ditampilkan</label>

            <!--
            <div class="form-group">
              <button type="button" class="btn btn-primary">Semua</button>     
            </div>
            -->
             <div class="form-group">
                
                    <div id="view1">
                        <input checked type="checkbox" id="app0" name="app0" value="1">
                                &nbsp;
                        Nomor Aduan
                    </div>

                    <div id="view2">
                        <input checked type="checkbox" id="app1" name="app1" value="1">
                                &nbsp;
                        Nama
                    </div>

                    <div id="view1">
                        <input checked type="checkbox" id="app2" name="app2" value="1">
                                &nbsp;
                        Waktu
                    </div>

                   
                    <div id="view1">
                        <input checked type="checkbox" id="app4" name="app4" value="1">
                                &nbsp;
                        Isi
                    </div>

                    <div id="view2">
                        <input checked type="checkbox" id="app5" name="app5" value="1">
                        &nbsp;
                        Departemen
                    </div>

                    <div id="view1">
                        <input checked type="checkbox" id="app6" name="app6" value="1">
                                &nbsp;
                        Status
                    </div>

                    <div id="view2">
                        <input checked type="checkbox" id="app7" name="app7" value="1">
                                &nbsp;
                        Jalur
                    </div>
               
             </div>
               
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     
    </div>

  </div>
</div>

    <!-- <input type="submit" class="btn btn-primary" name="word" value="Download Word"> -->
</form>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">

<script type="text/javascript">    

$('#harian').show();
$('#bulanan').hide();
$('#tahunan').hide();

$('#cek_dept').hide();

function setRole(a)
{
    a = document.getElementById('periode');

    if(a.value == '0'){
        
        $('#harian').show();
        $('#bulanan').hide();
        $('#tahunan').hide();
    }
    else if(a.value == '1')
    {
        $('#harian').hide();
        $('#bulanan').show();
        $('#tahunan').hide();
    }
    else
    {
        $('#harian').hide();
        $('#bulanan').hide();
        $('#tahunan').show();
    }
    
}

function setRole2(a)
{
    a = document.getElementById('departemen');

     <?php
        $list_induk_dept = array();
        
        foreach ($list_induk as $key => $value) {
        
            if($key == 0)
            {
                continue;
            }

            array_push($list_induk_dept, $value['induk_departemen']);
                
        }

    ?>

    var list_induk_dept = <?php echo json_encode($list_induk_dept); ?>;    
    var flag = 0;

    for (var j = 0; j < list_induk_dept.length; j++) {
        if(list_induk_dept[j] == a.value)
        {
            flag = 1;

        }
    }


    if(flag == 1)
    {
        $('#cek_dept').show();
    }
    else
    {
        $('#cek_dept').hide();
    }


    
 
}

$(function() {

        $( "#datepicker" ).datepicker();
        $( "#datepicker2" ).datepicker();
  });
  
    $(document).ready(function() {
    	$('#tahun').select2();
         
	} );
</script>
