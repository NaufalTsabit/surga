</div>
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

  <h3>VALIDASI SMS</h3>
        <div class="well col-md-6">
          <table id="tabel_sms" class="table table-bordered table-striped table-hover cw-table-list">
            <thead>
            <tr class='info'>
              <th>Id</th>
              <th>Nomor Pengirim</th>
              <th>Waktu</th>
              <th>Isi Aduan</th>
              <th>Tindak Lanjut</th>
            </tr>
            </thead>
            <tfoot>
            <tr class="info">
              <th>Id</th>
              <th>Nomor Pengirim</th>
              <th>Waktu</th>
              <th>Isi Aduan</th>
              <th>Tindak Lanjut</th>
            </tr>
            </tfoot>
            <tbody>
              <?php $i = 0; foreach ($table as $key => $value):?>
                  <tr>
                    <td style="vertical-align:middle;"><?php echo $value->id;?></td>
                    <td style="vertical-align:middle;"><?php echo $value->nomor_pengirim ?></td>
                    <td style="vertical-align:middle;"><?php echo $value->waktu ?></td>
                    <td title="<?php echo $value->isi; ?>" style="max-width:300px; display: -webkit-box;-webkit-line-clamp: 4;-webkit-box-orient: vertical; overflow:hidden;"><?php echo $value->isi ?></td>
                    <td>
                      <a class="btn btn-primary btn-xs" style="margin:3px;" onclick="tindak(this)">Tindak lanjut</a>
                        <br/>
                      <a class="btn btn-info btn-xs" style="margin:3px;" onclick="alert(this.parentNode.parentNode.cells[3].innerHTML)">Detail</a>
                        <br/>
                      <!-- <a class="btn btn-danger btn-xs" style="margin:3px;">Hapus</a> -->
                    </td>
                  </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="col-md-6">
          <form class="well form-horizontal" method="POST" action="">
          <fieldset>

          <!-- Form Name -->
          <legend>Masukkan Aduan Baru</legend>

          <input id="id_aduan" name="id_aduan" class="id_aduan" type="hidden">
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="nomor_ktp">Nomor KTP</label>  
            <div class="col-md-4">
            <input id="nomor_ktp" name="nomor_ktp" type="text" placeholder="Nomor KTP" class="form-control input-md" required="">
              
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="nama">Nama</label>  
            <div class="col-md-4">
            <input id="nama" name="nama" type="text" placeholder="Nama" class="form-control input-md" required="">
              
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="no_telp">Nomor Telepon</label>  
            <div class="col-md-4">
            <input id="no_telp" name="no_telp" type="text" placeholder="Nomor Telepon" class="form-control input-md" required="">
              
            </div>
          </div>

          <!-- Textarea -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="isi_aduan">Isi Aduan</label>
            <div class="col-md-4">                     
              <textarea class="form-control" style="height:113px;width:300px;" id="isi_aduan" name="isi_aduan" required></textarea>
            </div>
          </div>

          <!-- Button (Double) -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="submit">Kirim Sebagai Aduan Baru</label>
            <div class="col-md-8">
              <button id="submit" name="submit" class="btn btn-primary">Ya</button>
              <button id="batal" name="batal" class="btn btn-danger" onclick="bersih()">Batal</button>
            </div>
          </div></fieldset>
          </fieldset>
          </form>
        </div>
    </div>

<script type="text/javascript">
      function tindak(data)
      {
        
        var nama = document.getElementById('nama');
        var no_ktp = document.getElementById('nomor_ktp');
        var no_telp = document.getElementById('no_telp');
        var isi_aduan = document.getElementById('isi_aduan');
        var id = document.getElementById('id_aduan');
        id.value = data.parentNode.parentNode.cells[0].innerHTML;
        nama.value = "";
        no_ktp.value = "";
        no_telp.value = data.parentNode.parentNode.cells[1].innerHTML;      
        isi_aduan.value = data.parentNode.parentNode.cells[3].innerHTML;

      }

      function bersih()
      {
        var nama = document.getElementById('nama');
        var no_ktp = document.getElementById('nomor_ktp');
        var no_telp = document.getElementById('no_telp');
        var isi_aduan = document.getElementById('isi_aduan');
        var id = document.getElementById('id_aduan');

        id.value = "";
        nama.value = "";
        no_ktp.value = "";
        no_telp.value = "";      
        isi_aduan.value = ""; 
      }
    $(document).ready(function() {
      

      // DataTable
      var table = $('#tabel_sms').DataTable();
   
      // Apply the search
      table.columns().eq( 0 ).each( function ( colIdx ) {
          $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
              table
                  .column( colIdx )
                  .search( this.value )
                  .draw();
          } );
      } );
  } );
</script>
<style>
  .info>th{
    vertical-align : middle;
    text-align : center;
  }
  .cw-table-list{
    margin:1px !important;
    table-layout:fixed;  
  }
  .cw-table-list td{
    padding-bottom: 0px !important;  
    overflow:hidden;
  }
}
</style>