</div>
  </div>
  <div class="docs-header" style="min-height: 90%;">
    <div class="topic" style="min-height: 100%; z-index: 999;">
        <div class="container">
          <!-- <div class="col-md-4">
            <h2 style="font-weight: 300; margin-top: 0">Suara Warga Kota Kediri</h2>
            <h4>Kirimkan keluhan anda melalui SMS ke nomor <strong style="color: #1E8BC3;">081333702221</strong> dengan format <strong style="color: #1E8BC3;">nik</strong>#<strong style="color: #1E8BC3;">nama</strong>#<strong style="color: #1E8BC3;">isi_aduan</strong>.</h4>
            <h4>Atau laporkan keluhan anda melalui form berikut <span class="glyphicon glyphicon-chevron-right" style="position: relative; top: 4px"></span></h4>
          </div> -->
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 style="font-weight: 300; margin-top: -30px; margin-bottom: 40px;">Suara Warga Kota Kediri</h2>
            </div>
          </div>
          <div class="col-md-8 col-md-offset-2">
            <form role="form" method="POST" action="<?php echo site_url('aduan/add_landing'); ?>" enctype="multipart/form-data">
                <?php if (form_error('topik')): ?>
                <div class="form-group has-error has-feedback row">
                  <label class="col-md-5 control-label">Topik Pengaduan Anda - <i style="color: #F55384; font-size: 12px;">Wajib diisi</i></label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" id="topik" name="topik" placeholder="<?php echo form_error('topik'); ?>" value="<?php echo set_value('topik'); ?>">
                    <span class="glyphicon glyphicon-remove form-control-feedback" style="right: 10px;"></span>
                  </div>
                </div>
                <?php else:?>
                <div class="form-group row">
                  <label class="col-md-5 control-label">Topik Pengaduan Anda - <i style="color: #F55384; font-size: 12px;">Wajib diisi</i></label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" id="topik" name="topik" value="<?php echo set_value('topik'); ?>">
                  </div>
                </div>
                <?php endif;?>
                <div class="form-group row" style="color: #000">
                  <label class="col-md-5 control-label" style="color: rgba(255, 255, 255, 0.8);">Pilih Departemen - <i style="color: #F55384; font-size: 12px;">Wajib diisi</i></label>
                  <div class="col-md-7">
                    <select class="form-control" id="departemen" name="departemen">
                      <?php foreach ($departemen as $key => $value): ?>
                      <option value="<?php echo $value['id_departemen']; ?>" <?php echo set_select('departemen', $value['id_departemen']); ?>><?php echo $value['nama_departemen']; ?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                    <script type="text/javascript">
                    $( document ).ready(function() {
                      $("#departemen").select2();
                    });
                  </script>
                </div>
                <?php if (form_error('isi')): ?>
                <div class="form-group row form-group has-error has-feedback">
                  <label class="col-md-5 control-label">Isi Pengaduan Anda - <i style="color: #F55384; font-size: 12px;">Wajib diisi</i></label>
                  <div class="col-md-7">
                    <!-- <p><i>Deskripsikan dengan jelas aduan anda</i></p> -->
                    <textarea rows="5" class="form-control" id="isi" name="isi" placeholder="<?php echo form_error('isi'); ?>"><?php echo set_value('isi'); ?></textarea>
                    <span class="glyphicon glyphicon-remove form-control-feedback" style="right: 10px;"></span>
                  </div>
                </div>
                <?php else:?>
                <div class="form-group row">
                  <label class="col-md-5 control-label">Isi Pengaduan Anda - <i style="color: #F55384; font-size: 12px;">Wajib diisi</i></label>
                  <div class="col-md-7">
                    <!-- <p><i>Deskripsikan dengan jelas aduan anda</i></p> -->
                    <textarea rows="5" class="form-control" id="isi" name="isi"><?php echo set_value('isi'); ?></textarea>
                  </div>
                </div>
                <?php endif;?>
                <div class="form-group row" style="color: #000">
                  <div class="col-md-7 pull-right">
                    <button type="submit" class="btn btn-primary btn-block">Buat Aduan</button>
                  </div>
                </div>
            </form>
          </div>
          <div class="row" style="margin-top: 20px">
            <div class="col-md-8 col-md-offset-2 text-center">
              <p class="lead">Atau kirimkan keluhan anda melalui SMS ke nomor <strong style="color: #1E8BC3;">081333702221</strong> dengan format <strong style="color: #1E8BC3;">nik</strong>#<strong style="color: #1E8BC3;">nama</strong>#<strong style="color: #1E8BC3;">isi_aduan</strong>.</p>
            </div>
          </div>
        </div>
    </div>
  </div>