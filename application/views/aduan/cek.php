    </div>
</div>
<div class="docs-header" style="min-height: 90%;">
    <div class="topic" style="min-height: 100%; z-index: 999;">
        <div class="container" style="color: rgba(50, 142, 208, 0.9);">
            <div class="col-md-6 col-md-offset-3" style="margin-top: 5%;">
            <style type="text/css">
            label {
                color: #fff;
            }
            </style>
                <form role="form" method="POST" action="<?php site_url('login'); ?>">
                    <h4 class="text-center" style="font-size: 30px">
                        Cek Aduan Anda
                    </h4>
                    <?php if ($this->session->flashdata('msg')): ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('msg'); ?></div>
                    <?php endif;?>
                    <div class="form-group row">
                         <label class="col-md-4">Tahun Aduan</label>
                         <div class="col-md-8">
                            <select class="form-control" id="tahun_aduan" name="tahun_aduan">
                                <?php for ($i = date('Y'); $i >= 2014 ; $i--): ?>
                                    <option value="<?php echo $i;?>" <?php if ($i == date('Y')) echo "selected";?> ><?php echo $i;?></option>
                                <?php endfor;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                         <label class="col-md-4">Nomor Aduan</label>
                         <div class="col-md-8">
                            <input type="text" class="form-control" id="nomor_aduan" name="nomor_aduan" placeholder="Nomor Aduan">
                        </div>
                    </div>
                    <div class="form-group row">
                         <label class="col-md-4">Tanggal Lahir Anda</label>
                         <div class="col-md-8">
                             <div class="row">
                                 <div class="col-md-4">
                                     <select id="tanggal" name="tanggal" style="width: 100%">
                                        <?php for ($i=1; $i < 32 ; $i++) {?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select id="bulan" name="bulan" style="width: 100%">
                                        <option value="01">Januari</option> 
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select id="tahun" name="tahun" style="width: 100%">
                                        <?php for ($i=1940; $i <= date('Y')-17 ; $i++) {?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                         <label class="col-md-4">Nomor HP</label>
                         <div class="col-md-8">
                            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="Nomor HP">
                            <p class="help-block" style="font-style:italic; color: #fff;">
                                    * Jika memasukkan aduan lewat sms.
                                </p>
                        </div>
                    </div>
                    <div class="form-group row">
                         <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary btn-block">Cek Detail Pengaduan</button>
                        </div>
                    </div>
                </form>

                <script type="text/javascript">
                    $( document ).ready(function() {
                        // $("#tgl_lahir").datepicker({
                        //     language: "id",
                        //     autoclose: true
                        // });
                        $("#tanggal").select2();
                        $("#bulan").select2();
                        $("#tahun").select2();
                    });
                </script>
            </div>
        </div>
    </div>
</div>